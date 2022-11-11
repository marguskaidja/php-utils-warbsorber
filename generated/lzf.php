<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\LzfException;

/**
 * lzf_compress compresses the given
 * data string using LZF encoding.
 *
 * @param string $data The string to compress.
 * @return string Returns the compressed data.
 * @throws LzfException
 *
 */
function lzf_compress(string $data): string
{
    return Call::invoke('lzf_compress',LzfException::class,false, $data);
}


/**
 * lzf_compress decompresses the given
 * data string containing lzf encoded data.
 *
 * @param string $data The compressed string.
 * @return string Returns the decompressed data.
 * @throws LzfException
 *
 */
function lzf_decompress(string $data): string
{
    return Call::invoke('lzf_decompress',LzfException::class,false, $data);
}

