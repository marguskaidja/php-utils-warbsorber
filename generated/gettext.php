<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\GettextException;

/**
 * The bindtextdomain function sets or gets the path
 * for a domain.
 *
 * @param string $domain The domain.
 * @param string $directory The directory path.
 * An empty string means the current directory.
 * If NULL, the currently set directory is returned.
 * @return string The full pathname for the domain currently being set.
 * @throws GettextException
 *
 */
function bindtextdomain(string $domain, string $directory): string
{
    return Call::invoke('bindtextdomain',GettextException::class,false, $domain, $directory);
}

