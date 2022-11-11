<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\HashException;

/**
 *
 *
 * @param \HashContext $context Hashing context returned by hash_init.
 * @param string $filename URL describing location of file to be hashed; Supports fopen wrappers.
 * @param \HashContext|null $stream_context Stream context as returned by stream_context_create.
 * @throws HashException
 *
 */
function hash_update_file(\HashContext $context, string $filename, ?\HashContext $stream_context = null): void
{
    if ($stream_context !== null) {
        Call::invoke('hash_update_file',HashException::class,false, $context, $filename, $stream_context);
    } else {
        Call::invoke('hash_update_file',HashException::class,false, $context, $filename);
    }
}

