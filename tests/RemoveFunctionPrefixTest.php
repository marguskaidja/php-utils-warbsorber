<?php

declare(strict_types=1);

namespace margusk\Utils\Warbsorber\Tests;

use margusk\Utils\Warbsorber\Entry;
use PHPUnit\Framework\TestCase;

class RemoveFunctionPrefixTest extends TestCase
{
    public function dataProviderForFopenPrefixRemover(): array
    {
        $message = 'Operation failed';

        return [
            [
                'fopen(): ' . $message,
                $message,
            ],
            [
                'fopen(with,some,parameters): ' . $message,
                $message,
            ],
            [
                'fopen(with,some,brac): ket(symbols,in,parameters): ' . $message,
                $message,
            ]
        ];
    }

    /** @dataProvider dataProviderForFopenPrefixRemover */
    public function testFopenPrefixMustBeRemovedFromEntry(string $input, string $expected)
    {
        $entry = (new Entry(0, $input, '', 0))
            ->removeFunctionPrefix('fopen');

        $this->assertEquals($expected, $entry->errStr);
    }
}