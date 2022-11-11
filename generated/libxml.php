<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\LibxmlException;

/**
 * Retrieve last error from libxml.
 *
 * @return \LibXMLError Returns a LibXMLError object if there is any error in the
 * buffer, FALSE otherwise.
 * @throws LibxmlException
 *
 */
function libxml_get_last_error(): \LibXMLError
{
    return Call::invoke('libxml_get_last_error',LibxmlException::class,false);
}


/**
 * Changes the default external entity loader.
 * This can be used to suppress the expansion of arbitrary external entities to avoid XXE attacks,
 * even when LIBXML_NOENT has been set for the respective operation,
 * and is usually preferable over calling libxml_disable_entity_loader.
 *
 * @param callable $resolver_function A callable with the following signature:
 *
 * resourcestringnullresolver
 * stringpublic_id
 * stringsystem_id
 * arraycontext
 *
 *
 *
 * public_id
 *
 *
 * The public ID.
 *
 *
 *
 *
 * system_id
 *
 *
 * The system ID.
 *
 *
 *
 *
 * context
 *
 *
 * An array with the four elements "directory", "intSubName",
 * "extSubURI" and "extSubSystem".
 *
 *
 *
 *
 * This callable should return a resource, a string from which a resource can be
 * opened. If NULL is returned, the entity reference resolution will fail.
 * @throws LibxmlException
 *
 */
function libxml_set_external_entity_loader(callable $resolver_function): void
{
    Call::invoke('libxml_set_external_entity_loader',LibxmlException::class,false, $resolver_function);
}

