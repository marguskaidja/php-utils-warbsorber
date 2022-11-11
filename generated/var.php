<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\VarException;

/**
 * Set the type of variable var to
 * type.
 *
 * @param mixed $var The variable being converted.
 * @param string $type Possibles values of type are:
 *
 *
 *
 * "boolean" or "bool"
 *
 *
 *
 *
 * "integer" or "int"
 *
 *
 *
 *
 * "float" or "double"
 *
 *
 *
 *
 * "string"
 *
 *
 *
 *
 * "array"
 *
 *
 *
 *
 * "object"
 *
 *
 *
 *
 * "null"
 *
 *
 *
 * @throws VarException
 *
 */
function settype(&$var, string $type): void
{
    Call::invoke('settype',VarException::class,false, $var, $type);
}

