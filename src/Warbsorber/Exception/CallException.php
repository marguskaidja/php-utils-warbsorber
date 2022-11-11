<?php

declare(strict_types=1);

namespace margusk\Warbsorber\Exception;

use margusk\Accessors\Accessible;
use margusk\Accessors\Attr\Get;
use margusk\Warbsorber\Entry;
use margusk\Warbsorber\Warnings;
use RuntimeException;
use Throwable;

/**
 * @property-read string    $function
 * @property-read mixed     $result
 * @property-read Warnings  $warnings
 */
#[Get]
class CallException extends RuntimeException implements Marker
{
    use Accessible;

    protected function __construct(
        protected string $function,
        protected mixed $result,
        protected Warnings $warnings,
        string $message = "",
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        parent::__construct(
            $message,
            $code,
            $previous
        );
    }

    public static function dueInvokeFailed(string $function, mixed $result, Warnings $warnings, array $Args): static
    {
        $warnings = $warnings->removeFunctionPrefix($function);

        $message = implode(
            '. ',
            array_map(
                fn(Entry $e) => $e->errStr,
                $warnings->getArrayCopy()
            )
        );

        return new static(
            $function,
            $result,
            $warnings,
            $function . '(): ' . $message
        );
    }
}
