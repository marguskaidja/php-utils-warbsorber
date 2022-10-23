<?php

/**
 * This file is part of the margusk/Utils/Warbsorber package.
 *
 * @author  Margus Kaidja <margusk@gmail.com>
 * @link    https://github.com/marguskaidja/php-utils-warbsorber
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

declare(strict_types=1);

namespace margusk\Utils\Warbsorber\Tests;

use BadMethodCallException;
use OutOfRangeException;
use margusk\Utils\Warbsorber\Entry;
use margusk\Utils\Warbsorber\Warnings;
use PHPUnit\Framework\TestCase;

class WarningsArrayAccessTest extends TestCase
{
    public function testCorrectEntryKeyMustSucceed(): void
    {
        $expectedMessage = 'test error message';
        $warnings = new Warnings([
            new Entry(0, $expectedMessage, '', 0)
        ]);

        $this->assertEquals(true, isset($warnings[0]));
        $this->assertEquals($expectedMessage, $warnings[0]->errStr);
    }

    public function testEntriesCantBeOverwritten(): void
    {
        $warnings = new Warnings([]);

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('warnings array can\'t be changed');

        $warnings[1] = new Entry(0, '', '', 0);
    }

    public function testEntriesCantBeUnset(): void
    {
        $warnings = new Warnings([
             new Entry(0, '', '', 0)
        ]);

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('warnings array entries can\'t be unset');

        unset($warnings[0]);
    }

    public function testInvalidEntryKeyMustTriggerException(): void
    {
        $warnings = new Warnings([]);

        $offset = 10;
        $this->expectException(OutOfRangeException::class);
        $this->expectExceptionMessage('Undefined array key "' . $offset . '"');

        $warnings[$offset];
    }
}