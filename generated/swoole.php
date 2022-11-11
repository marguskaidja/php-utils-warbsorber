<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\SwooleException;

/**
 *
 *
 * @param string $hostname The host name.
 * @param callable $callback The host name.
 *
 * The IP address.
 * @throws SwooleException
 *
 */
function swoole_async_dns_lookup(string $hostname, callable $callback): void
{
    Call::invoke('swoole_async_dns_lookup',SwooleException::class,false, $hostname, $callback);
}


/**
 *
 *
 * @param string $filename The filename of the file being read.
 * @param string $callback The name of the file.
 *
 * The content read from the file.
 * @throws SwooleException
 *
 */
function swoole_async_readfile(string $filename, string $callback): void
{
    Call::invoke('swoole_async_readfile',SwooleException::class,false, $filename, $callback);
}


/**
 *
 *
 * @param string $filename The filename being written.
 * @param string $content The content writing to the file.
 * @param int $offset The offset.
 * @param callable $callback
 * @throws SwooleException
 *
 */
function swoole_async_write(string $filename, string $content, int $offset = null, callable $callback = null): void
{
    if ($callback !== null) {
        Call::invoke('swoole_async_write',SwooleException::class,false, $filename, $content, $offset, $callback);
    } elseif ($offset !== null) {
        Call::invoke('swoole_async_write',SwooleException::class,false, $filename, $content, $offset);
    } else {
        Call::invoke('swoole_async_write',SwooleException::class,false, $filename, $content);
    }
}


/**
 *
 *
 * @param string $filename The filename being written.
 * @param string $content The content writing to the file.
 * @param callable $callback
 * @param int $flags
 * @throws SwooleException
 *
 */
function swoole_async_writefile(string $filename, string $content, callable $callback = null, int $flags = 0): void
{
    if ($flags !== 0) {
        Call::invoke('swoole_async_writefile',SwooleException::class,false, $filename, $content, $callback, $flags);
    } elseif ($callback !== null) {
        Call::invoke('swoole_async_writefile',SwooleException::class,false, $filename, $content, $callback);
    } else {
        Call::invoke('swoole_async_writefile',SwooleException::class,false, $filename, $content);
    }
}


/**
 *
 *
 * @param callable $callback
 * @throws SwooleException
 *
 */
function swoole_event_defer(callable $callback): void
{
    Call::invoke('swoole_event_defer',SwooleException::class,false, $callback);
}


/**
 *
 *
 * @param int $fd
 * @throws SwooleException
 *
 */
function swoole_event_del(int $fd): void
{
    Call::invoke('swoole_event_del',SwooleException::class,false, $fd);
}


/**
 *
 *
 * @param int $fd
 * @param string $data
 * @throws SwooleException
 *
 */
function swoole_event_write(int $fd, string $data): void
{
    Call::invoke('swoole_event_write',SwooleException::class,false, $fd, $data);
}

