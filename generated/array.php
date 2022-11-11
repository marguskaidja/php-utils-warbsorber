<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\ArrayException;

/**
 * Applies the user-defined callback function to each
 * element of the array. This function will recurse
 * into deeper arrays.
 *
 * @param array|object $array The input array.
 * @param callable $callback Typically, callback takes on two parameters.
 * The array parameter's value being the first, and
 * the key/index second.
 *
 * If callback needs to be working with the
 * actual values of the array, specify the first parameter of
 * callback as a
 * reference. Then,
 * any changes made to those elements will be made in the
 * original array itself.
 * @param mixed $arg If the optional arg parameter is supplied,
 * it will be passed as the third parameter to the
 * callback.
 * @throws ArrayException
 *
 */
function array_walk_recursive(&$array, callable $callback, $arg = null): void
{
    if ($arg !== null) {
        Call::invoke('array_walk_recursive',ArrayException::class,false, $array, $callback, $arg);
    } else {
        Call::invoke('array_walk_recursive',ArrayException::class,false, $array, $callback);
    }
}


/**
 * This function shuffles (randomizes the order of the elements in) an array.
 * It uses a pseudo random number generator that is not suitable for
 * cryptographic purposes.
 *
 * @param array $array The array.
 * @throws ArrayException
 *
 */
function shuffle(array &$array): void
{
    Call::invoke('shuffle',ArrayException::class,false, $array);
}

