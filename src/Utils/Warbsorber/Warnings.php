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
    /** @var Entry[] array */
    protected array $entries;

    /**
     * @param Entry[] $entries
     */
    public function __construct(array $entries) {
        $this->entries = $entries;
    }

    /**
     * @return Entry[]
     */
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

    /**
     * Removes built-in function prefix (e.g. "fopen(): ") from messages and returns
     * cloned instance of Warnings object
     *
     * @param string $funcName
     *
     * @return static
     */
    public function removeFunctionPrefix(string $funcName): static
    {
        /** @var Entry[] $entries */
        $entries = [];
        foreach ($this->entries as $entry) {
            $newEntry = $entry->removeFunctionPrefix($funcName);
            $entries[] = $newEntry;
        }

        $obj = clone $this;
        $obj->entries = $entries;
        return $obj;
    }
}
