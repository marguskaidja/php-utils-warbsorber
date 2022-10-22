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

use IteratorAggregate;
use Countable;

/**
 * Represents a set of warnings absorbed during
 * an margusk\Utils\Warbsorber() call
 */
final class Warnings implements IteratorAggregate, Countable
{
    protected array $entries;

    public function __construct(array $entries) {
        $this->entries = $entries;
    }

    public function getArrayCopy(): array
    {
        return $this->entries;
    }

    public function getIterator(): WarningsIterator
    {
        return new WarningsIterator($this->entries);
    }

    public function count(): int
    {
        return count($this->entries);
    }
}
