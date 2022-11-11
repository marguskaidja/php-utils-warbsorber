<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\XmlrpcException;

/**
 * Sets xmlrpc type, base64 or datetime, for a PHP string value.
 *
 * @param string|\DateTime $value Value to set the type
 * @param string $type 'base64' or 'datetime'
 * @throws XmlrpcException
 *
 */
function xmlrpc_set_type(&$value, string $type): void
{
    Call::invoke('xmlrpc_set_type',XmlrpcException::class,false, $value, $type);
}

