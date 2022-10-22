<?php

/**
 * This file is part of the utils-warbsorber package.
 *
 * @author  Margus Kaidja <margusk@gmail.com>
 * @link    https://github.com/marguskaidja/php-utils-warbsorber
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

declare(strict_types=1);

namespace margusk\Utils;

use Closure;
use margusk\Utils\Warbsorber\Entry;
use margusk\Utils\Warbsorber\Warnings;

if (false === function_exists(__NAMESPACE__ . '\\Warbsorber')) {
    /**
     * Use this function to catch PHP warnings and/or errors during $callback execution.
     *
     * It's most useful when calling older built-in PHP functions which may
     * emit warnings/errors/notices instead of throwing exceptions.
     *
     * It works by installing temporarily it's internal error-handler, invokes $callback and
     * then restores old error-handler.
     *
     * Returns iterable object encapsulating all detected warnings.
     *
     * @link https://www.php.net/manual/en/errorfunc.constants.php
     * @link https://www.php.net/manual/en/function.set-error-handler.php
     *
     * @param  Closure  $callback   Encapsulates code to execute
     * @param  int      $level      One or combination of E_* constants
     *
     * @return Warnings
     */
    function Warbsorber(
        Closure $callback,
        int $level = E_ALL
    ): Warnings {
        $entries = [];

        /* Setup our error handler */
        set_error_handler(function (
            int $errNo,
            string $errStr,
            string $errFile,
            int $errLine
        ) use (&$entries) {
            $entries[] = new Entry(
                $errNo,
                $errStr,
                $errFile,
                $errLine
            );

            /* Return true to keep the internal handler quiet */
            return true;
        }, $level);

        /* Execute supplied code while catching all possible warnings same time */
        $callback();

        restore_error_handler();

        return new Warnings($entries);
    }
}
