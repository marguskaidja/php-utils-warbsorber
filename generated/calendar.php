<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\CalendarException;

/**
 * Return the Julian Day for a Unix timestamp
 * (seconds since 1.1.1970), or for the current day if no
 * timestamp is given. Either way, the time is regarded
 * as local time (not UTC).
 *
 * @param int $timestamp A unix timestamp to convert.
 * @return int A julian day number as integer.
 * @throws CalendarException
 *
 */
function unixtojd(int $timestamp = null): int
{
    if ($timestamp !== null) {
        return Call::invoke('unixtojd',CalendarException::class,false, $timestamp);
    } else {
        return Call::invoke('unixtojd',CalendarException::class,false);
    }
}

