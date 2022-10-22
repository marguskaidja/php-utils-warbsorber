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

use ArrayIterator;

/**
 * Only purpose of this class is to have some Iterator method signatures
 * to be redefined for proper IDE autocompletion
 *
 * @method Entry    current()
 * @method int|null key()
 */
class WarningsIterator extends ArrayIterator
{
}
