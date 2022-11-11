<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\RpminfoException;

/**
 * Add an additional retrieved tag in subsequent queries.
 *
 * @param int $tag One of RPMTAG_* constant, see the rpminfo constants page.
 * @throws RpminfoException
 *
 */
function rpmaddtag(int $tag): void
{
    Call::invoke('rpmaddtag',RpminfoException::class,false, $tag);
}

