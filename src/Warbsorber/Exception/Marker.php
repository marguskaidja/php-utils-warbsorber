<?php

declare(strict_types=1);

namespace margusk\Warbsorber\Exception;

use Throwable;

/**
 * Exception marker interface.
 *
 * All customized exceptions in this package MUST implement this interface.
 */
interface Marker extends Throwable
{
}
