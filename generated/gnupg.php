<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\GnupgException;

/**
 *
 *
 * @param resource $identifier The gnupg identifier, from a call to
 * gnupg_init or gnupg.
 * @param string $fingerprint The fingerprint key.
 * @param string $passphrase The pass phrase.
 * @throws GnupgException
 *
 */
function gnupg_adddecryptkey($identifier, string $fingerprint, string $passphrase): void
{
    Call::invoke('gnupg_adddecryptkey',GnupgException::class,false, $identifier, $fingerprint, $passphrase);
}


/**
 *
 *
 * @param resource $identifier The gnupg identifier, from a call to
 * gnupg_init or gnupg.
 * @param string $fingerprint The fingerprint key.
 * @throws GnupgException
 *
 */
function gnupg_addencryptkey($identifier, string $fingerprint): void
{
    Call::invoke('gnupg_addencryptkey',GnupgException::class,false, $identifier, $fingerprint);
}


/**
 *
 *
 * @param resource $identifier The gnupg identifier, from a call to
 * gnupg_init or gnupg.
 * @param string $fingerprint The fingerprint key.
 * @param string $passphrase The pass phrase.
 * @throws GnupgException
 *
 */
function gnupg_addsignkey($identifier, string $fingerprint, string $passphrase = null): void
{
    if ($passphrase !== null) {
        Call::invoke('gnupg_addsignkey',GnupgException::class,false, $identifier, $fingerprint, $passphrase);
    } else {
        Call::invoke('gnupg_addsignkey',GnupgException::class,false, $identifier, $fingerprint);
    }
}


/**
 *
 *
 * @param resource $identifier The gnupg identifier, from a call to
 * gnupg_init or gnupg.
 * @throws GnupgException
 *
 */
function gnupg_cleardecryptkeys($identifier): void
{
    Call::invoke('gnupg_cleardecryptkeys',GnupgException::class,false, $identifier);
}


/**
 *
 *
 * @param resource $identifier The gnupg identifier, from a call to
 * gnupg_init or gnupg.
 * @throws GnupgException
 *
 */
function gnupg_clearencryptkeys($identifier): void
{
    Call::invoke('gnupg_clearencryptkeys',GnupgException::class,false, $identifier);
}


/**
 *
 *
 * @param resource $identifier The gnupg identifier, from a call to
 * gnupg_init or gnupg.
 * @throws GnupgException
 *
 */
function gnupg_clearsignkeys($identifier): void
{
    Call::invoke('gnupg_clearsignkeys',GnupgException::class,false, $identifier);
}


/**
 *
 *
 * @param resource $identifier The gnupg identifier, from a call to
 * gnupg_init or gnupg.
 * @param string $key The key to delete.
 * @param bool $allow_secret It specifies whether to delete secret keys as well.
 * @throws GnupgException
 *
 */
function gnupg_deletekey($identifier, string $key, bool $allow_secret): void
{
    Call::invoke('gnupg_deletekey',GnupgException::class,false, $identifier, $key, $allow_secret);
}


/**
 * Toggle the armored output.
 *
 * @param resource $identifier The gnupg identifier, from a call to
 * gnupg_init or gnupg.
 * @param int $armor Pass a non-zero integer-value to this function to enable armored-output
 * (default).
 * Pass 0 to disable armored output.
 * @throws GnupgException
 *
 */
function gnupg_setarmor($identifier, int $armor): void
{
    Call::invoke('gnupg_setarmor',GnupgException::class,false, $identifier, $armor);
}


/**
 * Sets the mode for signing.
 *
 * @param resource $identifier The gnupg identifier, from a call to
 * gnupg_init or gnupg.
 * @param int $signmode The mode for signing.
 *
 * signmode takes a constant indicating what type of
 * signature should be produced. The possible values are
 * GNUPG_SIG_MODE_NORMAL,
 * GNUPG_SIG_MODE_DETACH and
 * GNUPG_SIG_MODE_CLEAR.
 * By default GNUPG_SIG_MODE_CLEAR is used.
 * @throws GnupgException
 *
 */
function gnupg_setsignmode($identifier, int $signmode): void
{
    Call::invoke('gnupg_setsignmode',GnupgException::class,false, $identifier, $signmode);
}

