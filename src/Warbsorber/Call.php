<?php

/**
 * This file is part of the margusk/warbsorber package.
 *
 * @author  Margus Kaidja <margusk@gmail.com>
 * @link    https://github.com/marguskaidja/php-warbsorber
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

declare(strict_types=1);

namespace margusk\Warbsorber;

use margusk\Warbsorber\Exception\CallException;

use function margusk\Warbsorber;


class Call
{
    public static function invoke(
        string $function,
        string $exceptionClass,
        mixed $errorValue,
        &...$args
    ): mixed {
        $result = null;

        $warnings = Warbsorber(function () use ($function, $args, &$result) {
            $result = $function(...$args);
        });

        if ($result === $errorValue) {
            /** @var CallException $exceptionClass */
            throw $exceptionClass::dueInvokeFailed($function, $result, $warnings, $args);
        }

        return $result;
    }
}
