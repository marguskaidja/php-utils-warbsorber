<?php

namespace Safe;

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\FuncCall\RenameFunctionRector;
use function array_merge;
use function file_exists;

class FileCreator
{

    /**
     * This function generate an improved php lib function in a php file
     *
     * @param Method[] $functions
     * @param string $path
     */
    public function generatePhpFile(array $functions, string $path): void
    {
        $path = rtrim($path, '/').'/';
        $phpFunctionsByModule = [];
        foreach ($functions as $function) {
            $writePhpFunction = new WritePhpFunction($function);
            $phpFunctionsByModule[$function->getModuleName()][] = $writePhpFunction->getPhpFunctionalFunction();
        }

        foreach ($phpFunctionsByModule as $module => $phpFunctions) {
            $lcModule = \lcfirst($module);
            $stream = \fopen($path.$lcModule.'.php', 'w');
            if ($stream === false) {
                throw new \RuntimeException('Unable to write to '.$path);
            }
            \fwrite($stream, "<?php\n
namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\\" . $this->toExceptionName($module) . ";
");
            foreach ($phpFunctions as $phpFunction) {
                \fwrite($stream, $phpFunction."\n");
            }
            \fclose($stream);
        }
    }

    /**
     * @param Method[] $functions
     * @return string[]
     */
    private function getFunctionsNameList(array $functions): array
    {
        $functionNames = array_map(function (Method $function) {
            return $function->getFunctionName();
        }, $functions);
        $specialCases = require __DIR__.'/../config/specialCasesFunctions.php';
        $functionNames = array_merge($functionNames, $specialCases);
        natcasesort($functionNames);
        $excludeCases = require __DIR__.'/../config/ignoredFunctions.php';
        return array_diff($functionNames, $excludeCases);
    }


    /**
     * This function generate a PHP file containing the list of functions we can handle.
     *
     * @param Method[] $functions
     * @param string $path
     */
    public function generateFunctionsList(array $functions, string $path): void
    {
        $functionNames = $this->getFunctionsNameList($functions);
        $stream = fopen($path, 'w');
        if ($stream === false) {
            throw new \RuntimeException('Unable to write to '.$path);
        }
        fwrite($stream, "<?php\n
return [\n");
        foreach ($functionNames as $functionName) {
            fwrite($stream, '    '.\var_export($functionName, true).",\n");
        }
        fwrite($stream, "];\n");
        fclose($stream);
    }

    /**
     * Generates a configuration file for replacing all functions when using rector/rector.
     *
     * @param Method[] $functions
     * @param string $path
     */
    public function generateRectorFile(array $functions, string $path): void
    {
        $functionNames = $this->getFunctionsNameList($functions);

        $stream = fopen($path, 'w');

        if ($stream === false) {
            throw new \RuntimeException('Unable to write to '.$path);
        }

        $header = <<<'TXT'
<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\FuncCall\RenameFunctionRector;

// This file configures rector/rector to replace all PHP functions with their equivalent "safe" functions.
return static function (RectorConfig $rectorConfig): void {
	$rectorConfig->ruleWithConfiguration(
		RenameFunctionRector::class,[
TXT;

        fwrite($stream, $header);

        foreach ($functionNames as $functionName) {
            fwrite($stream, "            '$functionName' => 'margusk\\Warbsorber\\Functions\\$functionName',\n");
        }

        fwrite($stream, "        ]);\n};\n");
        fclose($stream);
    }

    public function createExceptionFile(string $moduleName): void
    {
        $exceptionsDir = __DIR__ . '/../../generated/Exceptions';
        $exceptionName = self::toExceptionName($moduleName);
        if (!file_exists(__DIR__.'/../../src/Warbsorber/Functions/Exceptions/'.$exceptionName.'.php')) {
            \file_put_contents(
                $exceptionsDir . '/'.$exceptionName.'.php',
                <<<EOF
<?php
namespace margusk\Warbsorber\Functions\Exceptions;

use margusk\Warbsorber\Exception\CallException;

class {$exceptionName} extends CallException
{
}

EOF
            );
        }
    }

    /**
     * Generates the name of the exception class
     *
     * @param string $moduleName
     * @return string
     */
    public static function toExceptionName(string $moduleName): string
    {
        return str_replace('-', '', \ucfirst($moduleName)).'Exception';
    }
}
