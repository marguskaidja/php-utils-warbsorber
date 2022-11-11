<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\FunchandException;

/**
 * Creates a function dynamically from the parameters passed, and returns a unique name for it.
 *
 * @param string $args The function arguments, as a single comma-separated string.
 * @param string $code The function code.
 * @return string Returns a unique function name as a string.
 * Note that the name contains a non-printable character ("\0"),
 * so care should be taken when printing the name or incorporating it in any other
 * string.
 * @throws FunchandException
 *
 */
function create_function(string $args, string $code): string
{
    return Call::invoke('create_function',FunchandException::class,false, $args, $code);
}


/**
 *
 *
 * @param callable(): void $callback The function to register.
 * @param mixed $args
 * @throws FunchandException
 *
 */
function register_tick_function(callable $callback,  ...$args): void
{
    if ($args !== []) {
        Call::invoke('register_tick_function',FunchandException::class,false, $callback, ...$args);
    } else {
        Call::invoke('register_tick_function',FunchandException::class,false, $callback);
    }
}

