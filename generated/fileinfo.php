<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\FileinfoException;

/**
 * This function closes the instance opened by finfo_open.
 *
 * @param resource $finfo An finfo instance, returned by finfo_open.
 * @throws FileinfoException
 *
 */
function finfo_close($finfo): void
{
    Call::invoke('finfo_close',FileinfoException::class,false, $finfo);
}


/**
 * Procedural style
 *
 * Object-oriented style (constructor):
 *
 * This function opens a magic database and returns its instance.
 *
 * @param int $flags One or disjunction of more Fileinfo
 * constants.
 * @param string $magic_database Name of a magic database file, usually something like
 * /path/to/magic.mime. If not specified, the
 * MAGIC environment variable is used. If the
 * environment variable isn't set, then PHP's bundled magic database will
 * be used.
 *
 * Passing NULL or an empty string will be equivalent to the default
 * value.
 * @return resource (Procedural style only)
 * Returns an finfo instance on success.
 * @throws FileinfoException
 *
 */
function finfo_open(int $flags = FILEINFO_NONE, string $magic_database = null)
{
    if ($magic_database !== null) {
        return Call::invoke('finfo_open',FileinfoException::class,false, $flags, $magic_database);
    } else {
        return Call::invoke('finfo_open',FileinfoException::class,false, $flags);
    }
}


/**
 * Returns the MIME content type for a file as determined by using
 * information from the magic.mime file.
 *
 * @param string|resource $filename Path to the tested file.
 * @return string Returns the content type in MIME format, like
 * text/plain or application/octet-stream.
 * @throws FileinfoException
 *
 */
function mime_content_type($filename): string
{
    return Call::invoke('mime_content_type',FileinfoException::class,false, $filename);
}

