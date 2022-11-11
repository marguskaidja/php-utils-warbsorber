<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\InotifyException;

/**
 * Initialize an inotify instance for use with
 * inotify_add_watch
 *
 * @return resource A stream resource.
 * @throws InotifyException
 *
 */
function inotify_init()
{
    return Call::invoke('inotify_init',InotifyException::class,false);
}


/**
 * inotify_rm_watch removes the watch
 * watch_descriptor from the inotify instance
 * inotify_instance.
 *
 * @param resource $inotify_instance Resource returned by
 * inotify_init
 * @param int $watch_descriptor Watch to remove from the instance
 * @throws InotifyException
 *
 */
function inotify_rm_watch($inotify_instance, int $watch_descriptor): void
{
    Call::invoke('inotify_rm_watch',InotifyException::class,false, $inotify_instance, $watch_descriptor);
}

