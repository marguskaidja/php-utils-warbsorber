<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\UopzException;

/**
 * Makes class extend parent
 *
 * @param string $class The name of the class to extend
 * @param string $parent The name of the class to inherit
 * @throws UopzException
 *
 */
function uopz_extend(string $class, string $parent): void
{
    Call::invoke('uopz_extend',UopzException::class,false, $class, $parent);
}


/**
 * Makes class implement interface
 *
 * @param string $class
 * @param string $interface
 * @throws UopzException
 *
 */
function uopz_implement(string $class, string $interface): void
{
    Call::invoke('uopz_implement',UopzException::class,false, $class, $interface);
}

