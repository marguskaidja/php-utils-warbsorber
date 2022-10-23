<?php

/**
 * This file is part of the margusk/Utils/Warbsorber package.
 *
 * @author  Margus Kaidja <margusk@gmail.com>
 * @link    https://github.com/marguskaidja/php-utils-warbsorber
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

declare(strict_types=1);

namespace margusk\Utils\Warbsorber;

use ArrayAccess;
use BadMethodCallException;
use Countable;
use IteratorAggregate;
use OutOfRangeException;

/**
 * Represents a set of warnings absorbed during a margusk\Utils\Warbsorber() call
 */
class Warnings implements IteratorAggregate, Countable, ArrayAccess
{
    /** @var Entry[] array */
    protected array $entries;

    /**
     * @param  Entry[]  $entries
     */
    public function __construct(array $entries)
    {
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

    public function offsetGet(mixed $offset): Entry
    {
        if (!isset($this->entries[$offset])) {
            throw new OutOfRangeException('Undefined array key "'.$offset.'"');
        }

        return $this->entries[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new BadMethodCallException('warnings array can\'t be changed');
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->entries[$offset]);
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new BadMethodCallException('warnings array entries can\'t be unset');
    }

    /**
     * Removes built-in function prefix (e.g. "fopen(): ") from messages and returns
     * cloned instance of Warnings object
     *
     * @param  string  $funcName
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
