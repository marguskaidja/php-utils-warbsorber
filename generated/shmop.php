<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\ShmopException;

/**
 * shmop_delete is used to delete a shared memory block.
 *
 * @param resource $shmop The shared memory block resource created by
 * shmop_open
 * @throws ShmopException
 *
 */
function shmop_delete($shmop): void
{
    Call::invoke('shmop_delete',ShmopException::class,false, $shmop);
}


/**
 * shmop_read will read a string from shared memory block.
 *
 * @param resource $shmop The shared memory block identifier created by
 * shmop_open
 * @param int $offset Offset from which to start reading
 * @param int $size The number of bytes to read.
 * 0 reads shmop_size($shmid) - $start bytes.
 * @return string Returns the data.
 * @throws ShmopException
 *
 */
function shmop_read($shmop, int $offset, int $size): string
{
    return Call::invoke('shmop_read',ShmopException::class,false, $shmop, $offset, $size);
}

