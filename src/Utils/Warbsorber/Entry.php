<?php

/**
 * This file is part of the utils-warbsorber package.
 *
 * @author  Margus Kaidja <margusk@gmail.com>
 * @link    https://github.com/marguskaidja/php-utils-warbsorber
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

declare(strict_types=1);

namespace margusk\Utils\Warbsorber;

use InvalidArgumentException;

/**
 * Represents a single warning
 *
 * @property-read int       $errNo
 * @property-read string    $errStr
 * @property-read string    $errFile
 * @property-read int       $errLine
 */
final class Entry
{
    public function __construct(
        protected int $errNo,
        protected string $errStr,
        protected string $errFile,
        protected int $errLine
    ) {
    }

    public function __get(string $name): mixed
    {
        if (isset($this->{$name})) {
            return $this->{$name};
        }

        throw new InvalidArgumentException(
            sprintf('unknown property "%s"', $name)
        );
    }
}
