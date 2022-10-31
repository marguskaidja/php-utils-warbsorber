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
use PHPUnit\Framework\TestCase;

class RestoreErrorHandlerTest extends TestCase
{
    public function testCustomErrorHandlerMustBeRestored()
    {
        $expectedMessage = "This message should be catched by previous error handler";
        $actualMessage = null;

        $previousHandler = set_error_handler(function(int $errNo, string $errStr) use (&$actualMessage) {
            $actualMessage = $errStr;
            return true;
        }, E_ALL);

        Warbsorber(function () {
            trigger_error("test message", E_USER_WARNING);
        }, E_USER_WARNING);

        /** @noinspection PhpRedundantOptionalArgumentInspection */
        trigger_error($expectedMessage, E_USER_NOTICE);

        set_error_handler($previousHandler);

        $this->assertEquals($expectedMessage, $actualMessage);
    }

    public function testDefaultErrorHandlerMustBeRestored()
    {
        $expectedMessage = "This message should be catched by previous error handler";

        $previousHandler = set_error_handler(null, E_ALL);

        Warbsorber(function () {
            trigger_error("test message", E_USER_WARNING);
        }, E_USER_WARNING);

        $oldDisplayErrors = ini_set('display_errors', '1');

        ob_start();
        /** @noinspection PhpRedundantOptionalArgumentInspection */
        trigger_error($expectedMessage, E_USER_NOTICE);
        $actualMessage = ob_get_clean();

        ini_set('display_errors', $oldDisplayErrors);

        set_error_handler($previousHandler);

        $this->assertMatchesRegularExpression(
            '/' . preg_quote('Notice: ' . $expectedMessage) . '/',
            $actualMessage
        );
    }
}