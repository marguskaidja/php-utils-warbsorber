<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\RnpException;

/**
 * Private keys used for decryption should be loaded into the FFI object before calling this function.
 * If password encryption was used, then password provider should be set by calling
 * rnp_ffi_set_pass_provider.
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $input Encrypted message.
 * @return  Decrypted message on success.
 * @throws RnpException
 *
 */
function rnp_decrypt(\RnpFFI $ffi, string $input)
{
    return Call::invoke('rnp_decrypt',RnpException::class,false, $ffi, $input);
}


/**
 *
 *
 * @param string $input Input string containing OpenPGP data, either in binary or ASCII-armored format.
 * @param int $flags See RNP_JSON_DUMP_* predefined constants.
 * @return  JSON string with dump.
 * @throws RnpException
 *
 */
function rnp_dump_packets_to_json(string $input, int $flags)
{
    return Call::invoke('rnp_dump_packets_to_json',RnpException::class,false, $input, $flags);
}


/**
 *
 *
 * @param string $input Input string containing OpenPGP data, either in binary or ASCII-armored format.
 * @param int $flags See RNP_DUMP_* predefined constants.
 * @return  Text describing packet sequence.
 * @throws RnpException
 *
 */
function rnp_dump_packets(string $input, int $flags)
{
    return Call::invoke('rnp_dump_packets',RnpException::class,false, $input, $flags);
}


/**
 *
 *
 * @param string $pub_format the format of the public keyring, RNP_KEYSTORE_GPG or other
 * RNP_KEYSTORE_* constant.
 * @param string $sec_format the format of the secret keyring, RNP_KEYSTORE_GPG or other
 * RNP_KEYSTORE_* constant
 * @return  Returns RnpFFI object on success.
 * @throws RnpException
 *
 */
function rnp_ffi_create(string $pub_format, string $sec_format)
{
    return Call::invoke('rnp_ffi_create',RnpException::class,false, $pub_format, $sec_format);
}


/**
 * Sets password provider function. This function can ask for the password on a standard input
 * (if PHP script is executed in a command line environment), display GUI dialog or provide
 * password in any other possible ways. Requested passwords are used to encrypt or decrypt
 * secret keys or perform symmetric encryption/decryption operations.
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param callable $password_callback The function that is to be called for every password request.  It has the following signature:
 *
 * boolpassword_callback
 * stringkey_fp
 * stringpgp_context
 * stringpassword
 *
 *
 * $key_fp - The key fingerprint, if any. Can be empty.
 * $pgp_context - String describing why the key is being requested.
 * $password - Password string reference where provided password should be stored to.
 *
 * Callback function should return TRUE if password was successfully set or FALSE on failure.
 * @throws RnpException
 *
 */
function rnp_ffi_set_pass_provider(\RnpFFI $ffi, callable $password_callback): void
{
    Call::invoke('rnp_ffi_set_pass_provider',RnpException::class,false, $ffi, $password_callback);
}


/**
 *
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $input OpenPGP packets containing key(s) to be loaded. Can be either binary or ASCII armored.
 * @param int $flags See RNP_LOAD_SAVE_* predefined constants.
 * @return  JSON string with information about new and updated keys on success.
 * @throws RnpException
 *
 */
function rnp_import_keys(\RnpFFI $ffi, string $input, int $flags)
{
    return Call::invoke('rnp_import_keys',RnpException::class,false, $ffi, $input, $flags);
}


/**
 *
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $input OpenPGP packets containing signatures to be imported. Can be either binary or ASCII armored.
 * @param int $flags Currently must be 0.
 * @return  JSON string with information about updated keys on success.
 * @throws RnpException
 *
 */
function rnp_import_signatures(\RnpFFI $ffi, string $input, int $flags)
{
    return Call::invoke('rnp_import_signatures',RnpException::class,false, $ffi, $input, $flags);
}


/**
 *
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $key_fp Primary key fingerprint.
 * @param string $subkey_fp Subkey to export. Can be an empty string
 * to pick the first suitable subkey.
 * @param string $uid User ID to export. Can be an empty string
 * if exported key has only one uid.
 * @param int $flags Only RNP_KEY_EXPORT_BASE64 is currently supported. Enabling
 * it would export base64-encoded key data instead of binary.
 * @return  OpenPGP packets of exported key on success.
 * @throws RnpException
 *
 */
function rnp_key_export_autocrypt(\RnpFFI $ffi, string $key_fp, string $subkey_fp, string $uid, int $flags)
{
    return Call::invoke('rnp_key_export_autocrypt',RnpException::class,false, $ffi, $key_fp, $subkey_fp, $uid, $flags);
}


/**
 * Note: to revoke a key you'll need to import this signature into the keystore or use
 * rnp_key_revoke function.
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $key_fp Key fingerprint of the primary key to be revoked.
 * @param int $flags RNP_KEY_EXPORT_ARMORED or 0.
 * @param array $options An associative array with options.
 * @return  Exported revocation signature on success.
 * @throws RnpException
 *
 */
function rnp_key_export_revocation(\RnpFFI $ffi, string $key_fp, int $flags, array $options = null)
{
    if ($options !== null) {
        return Call::invoke('rnp_key_export_revocation',RnpException::class,false, $ffi, $key_fp, $flags, $options);
    } else {
        return Call::invoke('rnp_key_export_revocation',RnpException::class,false, $ffi, $key_fp, $flags);
    }
}


/**
 *
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $key_fp Key fingerprint.
 * @param int $flags See RNP_KEY_EXPORT_* predefined constants
 * (except RNP_KEY_EXPORT_BASE64).
 * @return  OpenPGP packets of exported key (binary or ASCII-armored) on success.
 * @throws RnpException
 *
 */
function rnp_key_export(\RnpFFI $ffi, string $key_fp, int $flags)
{
    return Call::invoke('rnp_key_export',RnpException::class,false, $ffi, $key_fp, $flags);
}


/**
 *
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $key_fp Key fingerprint.
 * @return  An associative array with information about the key.
 * @throws RnpException
 *
 */
function rnp_key_get_info(\RnpFFI $ffi, string $key_fp)
{
    return Call::invoke('rnp_key_get_info',RnpException::class,false, $ffi, $key_fp);
}


/**
 * Note: you need to call rnp_save_keys to write updated keyring(s) out.
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $key_fp Key fingerprint.
 * @param int $flags See RNP_KEY_REMOVE_* constants. Flag RNP_KEY_REMOVE_SUBKEYS will work only for
 * the primary key and will remove all of its subkeys as well.
 * @throws RnpException
 *
 */
function rnp_key_remove(\RnpFFI $ffi, string $key_fp, int $flags): void
{
    Call::invoke('rnp_key_remove',RnpException::class,false, $ffi, $key_fp, $flags);
}


/**
 * Note: you need to call rnp_save_keys to write updated keyring(s) out.
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $key_fp Key fingerprint.
 * @param int $flags Currently must be 0.
 * @param array $options An associative array with options.
 * @throws RnpException
 *
 */
function rnp_key_revoke(\RnpFFI $ffi, string $key_fp, int $flags, array $options = null): void
{
    if ($options !== null) {
        Call::invoke('rnp_key_revoke',RnpException::class,false, $ffi, $key_fp, $flags, $options);
    } else {
        Call::invoke('rnp_key_revoke',RnpException::class,false, $ffi, $key_fp, $flags);
    }
}


/**
 *
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $identifier_type Key identifier type ("userid", "keyid", "grip", "fingerprint").
 * @return  An associative array where key is an identifier string and value is a PGP key fingerprint.
 * @throws RnpException
 *
 */
function rnp_list_keys(\RnpFFI $ffi, string $identifier_type)
{
    return Call::invoke('rnp_list_keys',RnpException::class,false, $ffi, $identifier_type);
}


/**
 * Note that for G10, the input must be a directory (which must already exist).
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $format The key format of the data (GPG, KBX, G10).
 * @param string $input_path file or directory containing the keys.
 * @param int $flags See RNP_LOAD_SAVE_* flags description.
 * @throws RnpException
 *
 */
function rnp_load_keys_from_path(\RnpFFI $ffi, string $format, string $input_path, int $flags): void
{
    Call::invoke('rnp_load_keys_from_path',RnpException::class,false, $ffi, $format, $input_path, $flags);
}


/**
 * Note that for G10, the input must be a directory (which must already exist).
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $format The key format of the data (GPG, KBX, G10).
 * @param string $input OpenPGP packets containing key(s) to be loaded. Can be either binary or ASCII armored.
 * @param int $flags See RNP_LOAD_SAVE_* flags description.
 * @throws RnpException
 *
 */
function rnp_load_keys(\RnpFFI $ffi, string $format, string $input, int $flags): void
{
    Call::invoke('rnp_load_keys',RnpException::class,false, $ffi, $format, $input, $flags);
}


/**
 * Note: only valid userids are checked while searching by userid.
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $identifier_type Identifier type string: "userid", "keyid", "fingerprint", "grip".
 * @param string $identifier PGP User ID (name and email) for "userid" type, hexadecimal string
 * that represents key id, fingerprint or key grip correspondingly.
 * @return  Returns hexadecimal fingerprint of the key found on success.
 * @throws RnpException
 *
 */
function rnp_locate_key(\RnpFFI $ffi, string $identifier_type, string $identifier)
{
    return Call::invoke('rnp_locate_key',RnpException::class,false, $ffi, $identifier_type, $identifier);
}


/**
 *
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $message Message to be encrypted.
 * @param array $recipient_keys_fp Array with fingerprints of recipient's keys. At least one key must be present.
 * @param array $options An associative array with options.
 * @return  Encrypted data on success.
 * @throws RnpException
 *
 */
function rnp_op_encrypt(\RnpFFI $ffi, string $message, array $recipient_keys_fp, array $options = null)
{
    if ($options !== null) {
        return Call::invoke('rnp_op_encrypt',RnpException::class,false, $ffi, $message, $recipient_keys_fp, $options);
    } else {
        return Call::invoke('rnp_op_encrypt',RnpException::class,false, $ffi, $message, $recipient_keys_fp);
    }
}


/**
 *
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $userid PGP User ID - text that is intended to represent
 * the name and email address of the key holder.
 * @param string $key_alg Primary key algorithm (i.e. 'RSA', 'DSA', etc).
 * @param string $sub_alg Subkey algorithm. If not set, subkey will not be generated.
 * @param array $options An associative array with options.
 * @return  Fingerprint of the generated primary key. This fingerprint can be used
 * later to reference the key in sign and encrypt operations. The key data is stored in FFI
 * memory context and can be saved using
 * rnp_save_keys or rnp_save_keys_to_path.
 * @throws RnpException
 *
 */
function rnp_op_generate_key(\RnpFFI $ffi, string $userid, string $key_alg, string $sub_alg = null, array $options = null)
{
    if ($options !== null) {
        return Call::invoke('rnp_op_generate_key',RnpException::class,false, $ffi, $userid, $key_alg, $sub_alg, $options);
    } elseif ($sub_alg !== null) {
        return Call::invoke('rnp_op_generate_key',RnpException::class,false, $ffi, $userid, $key_alg, $sub_alg);
    } else {
        return Call::invoke('rnp_op_generate_key',RnpException::class,false, $ffi, $userid, $key_alg);
    }
}


/**
 *
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $data Data to be signed.
 * @param array $keys_fp Array with key fingerprints. At least one key must be provided.
 * Keys should be present in ffi.
 * @param array $options An associative array with options.
 * @return  Cleartext signed message containing source data with
 * additional headers and ASCII-armored signature on success.
 * @throws RnpException
 *
 */
function rnp_op_sign_cleartext(\RnpFFI $ffi, string $data, array $keys_fp, array $options = null)
{
    if ($options !== null) {
        return Call::invoke('rnp_op_sign_cleartext',RnpException::class,false, $ffi, $data, $keys_fp, $options);
    } else {
        return Call::invoke('rnp_op_sign_cleartext',RnpException::class,false, $ffi, $data, $keys_fp);
    }
}


/**
 *
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $data Data to be signed.
 * @param array $keys_fp Array with key fingerprints. At least one key must be provided.
 * Keys should be present in ffi.
 * @param array $options An associative array with options.
 * @return  Detached signature(s) data on success.
 * @throws RnpException
 *
 */
function rnp_op_sign_detached(\RnpFFI $ffi, string $data, array $keys_fp, array $options = null)
{
    if ($options !== null) {
        return Call::invoke('rnp_op_sign_detached',RnpException::class,false, $ffi, $data, $keys_fp, $options);
    } else {
        return Call::invoke('rnp_op_sign_detached',RnpException::class,false, $ffi, $data, $keys_fp);
    }
}


/**
 *
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $data Data to be signed.
 * @param array $keys_fp Array with key fingerprints. At least one key must be provided.
 * Keys should be present in ffi.
 * @param array $options An associative array with options.
 * @return  Data with embedded signature(s) on success.
 * @throws RnpException
 *
 */
function rnp_op_sign(\RnpFFI $ffi, string $data, array $keys_fp, array $options = null)
{
    if ($options !== null) {
        return Call::invoke('rnp_op_sign',RnpException::class,false, $ffi, $data, $keys_fp, $options);
    } else {
        return Call::invoke('rnp_op_sign',RnpException::class,false, $ffi, $data, $keys_fp);
    }
}


/**
 *
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $data Source data.
 * @param string $signature Detached signature data.
 * @return  An associative array with information about verification results.
 *
 * "signatures" sub-array.
 * @throws RnpException
 *
 */
function rnp_op_verify_detached(\RnpFFI $ffi, string $data, string $signature)
{
    return Call::invoke('rnp_op_verify_detached',RnpException::class,false, $ffi, $data, $signature);
}


/**
 *
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $data Signed data.
 * @return  An associative array with information about verification results.
 *
 * "signatures" sub-array.
 * @throws RnpException
 *
 */
function rnp_op_verify(\RnpFFI $ffi, string $data)
{
    return Call::invoke('rnp_op_verify',RnpException::class,false, $ffi, $data);
}


/**
 * Saves keys present in the FFI object (loaded or generated) to the specified file or directory.
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $format The key format of the data (GPG, KBX, G10).
 * @param string $output_path File or directory path where keys should be saved to.
 * @param int $flags See RNP_LOAD_SAVE_* flags description.
 * @throws RnpException
 *
 */
function rnp_save_keys_to_path(\RnpFFI $ffi, string $format, string $output_path, int $flags): void
{
    Call::invoke('rnp_save_keys_to_path',RnpException::class,false, $ffi, $format, $output_path, $flags);
}


/**
 * Note that for G10, the output must be a directory (which must already exist).
 *
 * @param \RnpFFI $ffi The FFI object returned by rnp_ffi_create.
 * @param string $format The key format of the data (GPG, KBX, G10).
 * @param string $output key packets will be saved to the string referenced by output.
 * @param int $flags See RNP_LOAD_SAVE_* flags description.
 * @throws RnpException
 *
 */
function rnp_save_keys(\RnpFFI $ffi, string $format, string &$output, int $flags): void
{
    Call::invoke('rnp_save_keys',RnpException::class,false, $ffi, $format, $output, $flags);
}


/**
 * Get the JSON formatted string containing array of supported rnp feature values (algorithms, curves, etc) by type.
 *
 * @param string $type See RNP_FEATURE_* constants for supported values.
 * @return  String containing JSON formatted array of supported algorithms, curves, etc.
 * @throws RnpException
 *
 */
function rnp_supported_features(string $type)
{
    return Call::invoke('rnp_supported_features',RnpException::class,false, $type);
}

