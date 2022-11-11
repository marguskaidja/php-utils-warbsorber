<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\SolrException;

/**
 * This function returns the current version of the extension as a string.
 *
 * @return string It returns a string on success.
 * @throws SolrException
 *
 */
function solr_get_version(): string
{
    return Call::invoke('solr_get_version',SolrException::class,false);
}

