<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\FpmException;

/**
 * This function flushes all response data to the client and finishes the
 * request. This allows for time consuming tasks to be performed without
 * leaving the connection to the client open.
 *
 * @throws FpmException
 *
 */
function fastcgi_finish_request(): void
{
    Call::invoke('fastcgi_finish_request',FpmException::class,false);
}


/**
 * This function returns the full current FPM pool status as an associative array. It always
 * returns the full status, including per-process status information. See the
 * FPM status page guide for further
 * details.
 *
 * Note that this function will only be defined if FPM is being used to serve the script.
 *
 * @return array Associative array containing the full FPM pool status.
 * @throws FpmException
 *
 */
function fpm_get_status(): array
{
    return Call::invoke('fpm_get_status',FpmException::class,false);
}

