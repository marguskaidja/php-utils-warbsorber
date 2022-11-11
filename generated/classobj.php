<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\ClassobjException;

/**
 * Creates an alias named alias
 * based on the user defined class class.
 * The aliased class is exactly the same as the original class.
 *
 * @param string $class The original class.
 * @param string $alias The alias name for the class.
 * @param bool $autoload Whether to autoload if the original class is not found.
 * @throws ClassobjException
 *
 */
function class_alias(string $class, string $alias, bool $autoload = true): void
{
    Call::invoke('class_alias',ClassobjException::class,false, $class, $alias, $autoload);
}

