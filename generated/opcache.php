<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\OpcacheException;

/**
 * This function compiles a PHP script and adds it to the opcode cache without
 * executing it. This can be used to prime the cache after a Web server
 * restart by pre-caching files that will be included in later requests.
 *
 * @param string $filename The path to the PHP script to be compiled.
 * @throws OpcacheException
 *
 */
function opcache_compile_file(string $filename): void
{
    Call::invoke('opcache_compile_file',OpcacheException::class,false, $filename);
}


/**
 * This function returns state information about the in-memory cache instance. It will not return any
 * information about the file cache.
 *
 * @param bool $include_scripts Include script specific state information
 * @return array Returns an array of information, optionally containing script specific state information.
 * @throws OpcacheException
 *
 */
function opcache_get_status(bool $include_scripts = true): array
{
    return Call::invoke('opcache_get_status',OpcacheException::class,false, $include_scripts);
}

