<?php

/**
 * This file is part of the margusk/warbsorber package.
 *
 * @author  Margus Kaidja <margusk@gmail.com>
 * @link    https://github.com/marguskaidja/php-warbsorber
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

declare(strict_types=1);

namespace margusk\Warbsorber\Tests;

use function margusk\Warbsorber;
use margusk\Warbsorber\Entry;
use PHPUnit\Framework\TestCase;

class CatchWarningsTest extends TestCase
{
    public function testWhenLevelHasEuserwarningThenEuserwarningsMustBeCatched(): void
    {
        $message = "this is purposedly triggered warning";

        $warnings = Warbsorber(function () use (&$message) {
            trigger_error($message, E_USER_WARNING);
        }, E_USER_WARNING);

        $this->assertCount(1, $warnings);
        $this->assertEquals(
            $message,
            $warnings[0]->errStr
        );
    }

    public function testMultipleWarningsMustBeCatched(): void
    {
        $testData = [];
        foreach (['E_USER_WARNING', 'E_USER_ERROR', 'E_USER_NOTICE'] as $errNo) {
            $testData[] = [
                'errNo' => constant($errNo),
                'errStr' => 'This is ' . $errNo
            ];
        }

        $warnings = Warbsorber(function () use (&$testData) {
            foreach ($testData as $e) {
                trigger_error(strval($e['errStr']), intval($e['errNo']));
            }
        });

        $this->assertCount(count($testData), $warnings);
        $this->assertEquals(
            $testData,
            array_map(function (Entry $e) {
                return [
                    'errNo' => $e->errNo,
                    'errStr' => $e->errStr,
                ];
            }, $warnings->getArrayCopy())
        );
    }

    public function testWhenLevelHasNoEuserwarningThenEuserwarningsMustNotBeCatched(): void
    {
        $message = "this is purposedly triggered warning";

        $oldDisplayErrors = ini_set('display_errors', '1');

        ob_start();

        $warnings = Warbsorber(function () use (&$message) {
            trigger_error($message, E_USER_WARNING);
        }, E_WARNING);

        $output = (string)ob_get_clean();

        ini_set('display_errors', (string)$oldDisplayErrors);

        $this->assertCount(0, $warnings);
        $this->assertMatchesRegularExpression(
            '/Warning: '.preg_quote($message).' in /',
            $output
        );
    }

    public function testFopenEwarningMustBeCatched(): void
    {
        $warnings = Warbsorber(function () {
            fopen("php://non-existent-stream", "r");
        }, E_WARNING);

        $this->assertCount(2, $warnings);

        $this->assertMatchesRegularExpression(
            '/' . preg_quote("Invalid php:// URL specified", '/') . '/',
            $warnings[0]->errStr
        );

        $this->assertMatchesRegularExpression(
            '/' . preg_quote("Failed to open stream: operation failed", '/') . '/',
            $warnings[1]->errStr
        );
    }
}
