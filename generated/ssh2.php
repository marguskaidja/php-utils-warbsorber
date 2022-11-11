<?php

namespace margusk\Warbsorber\Functions;

use margusk\Warbsorber\Call;
use margusk\Warbsorber\Functions\Exceptions\Ssh2Exception;

/**
 * Authenticate over SSH using the ssh agent
 *
 * @param resource $session An SSH connection link identifier, obtained from a call to
 * ssh2_connect.
 * @param string $username Remote user name.
 * @throws Ssh2Exception
 *
 */
function ssh2_auth_agent($session, string $username): void
{
    Call::invoke('ssh2_auth_agent',Ssh2Exception::class,false, $session, $username);
}


/**
 * Authenticate using a public hostkey read from a file.
 *
 * @param resource $session An SSH connection link identifier, obtained from a call to
 * ssh2_connect.
 * @param string $username
 * @param string $hostname
 * @param string $pubkeyfile
 * @param string $privkeyfile
 * @param string $passphrase If privkeyfile is encrypted (which it should
 * be), the passphrase must be provided.
 * @param string $local_username If local_username is omitted, then the value
 * for username will be used for it.
 * @throws Ssh2Exception
 *
 */
function ssh2_auth_hostbased_file($session, string $username, string $hostname, string $pubkeyfile, string $privkeyfile, string $passphrase = null, string $local_username = null): void
{
    if ($local_username !== null) {
        Call::invoke('ssh2_auth_hostbased_file',Ssh2Exception::class,false, $session, $username, $hostname, $pubkeyfile, $privkeyfile, $passphrase, $local_username);
    } elseif ($passphrase !== null) {
        Call::invoke('ssh2_auth_hostbased_file',Ssh2Exception::class,false, $session, $username, $hostname, $pubkeyfile, $privkeyfile, $passphrase);
    } else {
        Call::invoke('ssh2_auth_hostbased_file',Ssh2Exception::class,false, $session, $username, $hostname, $pubkeyfile, $privkeyfile);
    }
}


/**
 * Authenticate over SSH using a plain password. Since version 0.12 this function
 * also supports keyboard_interactive method.
 *
 * @param resource $session An SSH connection link identifier, obtained from a call to
 * ssh2_connect.
 * @param string $username Remote user name.
 * @param string $password Password for username
 * @throws Ssh2Exception
 *
 */
function ssh2_auth_password($session, string $username, string $password): void
{
    Call::invoke('ssh2_auth_password',Ssh2Exception::class,false, $session, $username, $password);
}


/**
 * Authenticate using a public key read from a file.
 *
 * @param resource $session An SSH connection link identifier, obtained from a call to
 * ssh2_connect.
 * @param string $username
 * @param string $pubkeyfile The public key file needs to be in OpenSSH's format. It should look something like:
 *
 * ssh-rsa AAAAB3NzaC1yc2EAAA....NX6sqSnHA8= rsa-key-20121110
 * @param string $privkeyfile
 * @param string $passphrase If privkeyfile is encrypted (which it should
 * be), the passphrase must be provided.
 * @throws Ssh2Exception
 *
 */
function ssh2_auth_pubkey_file($session, string $username, string $pubkeyfile, string $privkeyfile, string $passphrase = null): void
{
    if ($passphrase !== null) {
        Call::invoke('ssh2_auth_pubkey_file',Ssh2Exception::class,false, $session, $username, $pubkeyfile, $privkeyfile, $passphrase);
    } else {
        Call::invoke('ssh2_auth_pubkey_file',Ssh2Exception::class,false, $session, $username, $pubkeyfile, $privkeyfile);
    }
}


/**
 * Establish a connection to a remote SSH server.
 *
 * Once connected, the client should verify the server's hostkey using
 * ssh2_fingerprint, then authenticate using either
 * password or public key.
 *
 * @param string $host
 * @param int $port
 * @param array $methods methods may be an associative array with up to four parameters
 * as described below.
 *
 *
 * methods may be an associative array
 * with any or all of the following parameters.
 *
 *
 *
 * Index
 * Meaning
 * Supported Values*
 *
 *
 *
 *
 * kex
 *
 * List of key exchange methods to advertise, comma separated
 * in order of preference.
 *
 *
 * diffie-hellman-group1-sha1,
 * diffie-hellman-group14-sha1, and
 * diffie-hellman-group-exchange-sha1
 *
 *
 *
 * hostkey
 *
 * List of hostkey methods to advertise, comma separated
 * in order of preference.
 *
 *
 * ssh-rsa and
 * ssh-dss
 *
 *
 *
 * client_to_server
 *
 * Associative array containing crypt, compression, and
 * message authentication code (MAC) method preferences
 * for messages sent from client to server.
 *
 *
 *
 *
 * server_to_client
 *
 * Associative array containing crypt, compression, and
 * message authentication code (MAC) method preferences
 * for messages sent from server to client.
 *
 *
 *
 *
 *
 *
 *
 * * - Supported Values are dependent on methods supported by underlying library.
 * See libssh2 documentation for additional
 * information.
 *
 *
 *
 * client_to_server and
 * server_to_client may be an associative array
 * with any or all of the following parameters.
 *
 *
 *
 *
 * Index
 * Meaning
 * Supported Values*
 *
 *
 *
 *
 * crypt
 * List of crypto methods to advertise, comma separated
 * in order of preference.
 *
 * rijndael-cbc@lysator.liu.se,
 * aes256-cbc,
 * aes192-cbc,
 * aes128-cbc,
 * 3des-cbc,
 * blowfish-cbc,
 * cast128-cbc,
 * arcfour, and
 * none**
 *
 *
 *
 * comp
 * List of compression methods to advertise, comma separated
 * in order of preference.
 *
 * zlib and
 * none
 *
 *
 *
 * mac
 * List of MAC methods to advertise, comma separated
 * in order of preference.
 *
 * hmac-sha1,
 * hmac-sha1-96,
 * hmac-ripemd160,
 * hmac-ripemd160@openssh.com, and
 * none**
 *
 *
 *
 *
 *
 *
 *
 * Crypt and MAC method "none"
 *
 * For security reasons, none is disabled by the underlying
 * libssh2 library unless explicitly enabled
 * during build time by using the appropriate ./configure options.  See documentation
 * for the underlying library for more information.
 *
 *
 *
 * For security reasons, none is disabled by the underlying
 * libssh2 library unless explicitly enabled
 * during build time by using the appropriate ./configure options.  See documentation
 * for the underlying library for more information.
 * @param array $callbacks callbacks may be an associative array with any
 * or all of the following parameters.
 *
 *
 * Callbacks parameters
 *
 *
 *
 *
 * Index
 * Meaning
 * Prototype
 *
 *
 *
 *
 * ignore
 *
 * Name of function to call when an
 * SSH2_MSG_IGNORE packet is received
 *
 * void ignore_cb($message)
 *
 *
 * debug
 *
 * Name of function to call when an
 * SSH2_MSG_DEBUG packet is received
 *
 * void debug_cb($message, $language, $always_display)
 *
 *
 * macerror
 *
 * Name of function to call when a packet is received but the
 * message authentication code failed.  If the callback returns
 * TRUE, the mismatch will be ignored, otherwise the connection
 * will be terminated.
 *
 * bool macerror_cb($packet)
 *
 *
 * disconnect
 *
 * Name of function to call when an
 * SSH2_MSG_DISCONNECT packet is received
 *
 * void disconnect_cb($reason, $message, $language)
 *
 *
 *
 *
 * @return resource Returns a resource on success.
 * @throws Ssh2Exception
 *
 */
function ssh2_connect(string $host, int $port = 22, array $methods = null, array $callbacks = null)
{
    if ($callbacks !== null) {
        return Call::invoke('ssh2_connect',Ssh2Exception::class,false, $host, $port, $methods, $callbacks);
    } elseif ($methods !== null) {
        return Call::invoke('ssh2_connect',Ssh2Exception::class,false, $host, $port, $methods);
    } else {
        return Call::invoke('ssh2_connect',Ssh2Exception::class,false, $host, $port);
    }
}


/**
 * Close a connection to a remote SSH server.
 *
 * @param resource $session An SSH connection link identifier, obtained from a call to
 * ssh2_connect.
 * @throws Ssh2Exception
 *
 */
function ssh2_disconnect($session): void
{
    Call::invoke('ssh2_disconnect',Ssh2Exception::class,false, $session);
}


/**
 * Execute a command at the remote end and allocate a channel for it.
 *
 * @param resource $session An SSH connection link identifier, obtained from a call to
 * ssh2_connect.
 * @param string $command
 * @param string $pty
 * @param array $env env may be passed as an associative array of
 * name/value pairs to set in the target environment.
 * @param int $width Width of the virtual terminal.
 * @param int $height Height of the virtual terminal.
 * @param int $width_height_type width_height_type should be one of
 * SSH2_TERM_UNIT_CHARS or
 * SSH2_TERM_UNIT_PIXELS.
 * @return resource Returns a stream on success.
 * @throws Ssh2Exception
 *
 */
function ssh2_exec($session, string $command, string $pty = null, array $env = null, int $width = 80, int $height = 25, int $width_height_type = SSH2_TERM_UNIT_CHARS)
{
    if ($width_height_type !== SSH2_TERM_UNIT_CHARS) {
        return Call::invoke('ssh2_exec',Ssh2Exception::class,false, $session, $command, $pty, $env, $width, $height, $width_height_type);
    } elseif ($height !== 25) {
        return Call::invoke('ssh2_exec',Ssh2Exception::class,false, $session, $command, $pty, $env, $width, $height);
    } elseif ($width !== 80) {
        return Call::invoke('ssh2_exec',Ssh2Exception::class,false, $session, $command, $pty, $env, $width);
    } elseif ($env !== null) {
        return Call::invoke('ssh2_exec',Ssh2Exception::class,false, $session, $command, $pty, $env);
    } elseif ($pty !== null) {
        return Call::invoke('ssh2_exec',Ssh2Exception::class,false, $session, $command, $pty);
    } else {
        return Call::invoke('ssh2_exec',Ssh2Exception::class,false, $session, $command);
    }
}


/**
 * Accepts a connection created by a listener.
 *
 * @param resource $listener An SSH2 Listener resource, obtained from a call to ssh2_forward_listen.
 * @return  Returns a stream resource.
 * @throws Ssh2Exception
 *
 */
function ssh2_forward_accept($listener)
{
    return Call::invoke('ssh2_forward_accept',Ssh2Exception::class,false, $listener);
}


/**
 * Binds a port on the remote server and listen for connections.
 *
 * @param resource $session An SSH Session resource, obtained from a call to ssh2_connect.
 * @param int $port The port of the remote server.
 * @param string $host
 * @param int $max_connections
 * @return  Returns an SSH2 Listener.
 * @throws Ssh2Exception
 *
 */
function ssh2_forward_listen($session, int $port, string $host = null, int $max_connections = 16)
{
    if ($max_connections !== 16) {
        return Call::invoke('ssh2_forward_listen',Ssh2Exception::class,false, $session, $port, $host, $max_connections);
    } elseif ($host !== null) {
        return Call::invoke('ssh2_forward_listen',Ssh2Exception::class,false, $session, $port, $host);
    } else {
        return Call::invoke('ssh2_forward_listen',Ssh2Exception::class,false, $session, $port);
    }
}


/**
 *
 *
 * @param resource $pkey Publickey Subsystem resource created by ssh2_publickey_init.
 * @param string $algoname Publickey algorithm (e.g.): ssh-dss, ssh-rsa
 * @param string $blob Publickey blob as raw binary data
 * @param bool $overwrite If the specified key already exists, should it be overwritten?
 * @param array $attributes Associative array of attributes to assign to this public key.
 * Refer to ietf-secsh-publickey-subsystem for a list of supported attributes.
 * To mark an attribute as mandatory, precede its name with an asterisk.
 * If the server is unable to support an attribute marked mandatory,
 * it will abort the add process.
 * @throws Ssh2Exception
 *
 */
function ssh2_publickey_add($pkey, string $algoname, string $blob, bool $overwrite = false, array $attributes = null): void
{
    if ($attributes !== null) {
        Call::invoke('ssh2_publickey_add',Ssh2Exception::class,false, $pkey, $algoname, $blob, $overwrite, $attributes);
    } else {
        Call::invoke('ssh2_publickey_add',Ssh2Exception::class,false, $pkey, $algoname, $blob, $overwrite);
    }
}


/**
 * Request the Publickey subsystem from an already connected SSH2 server.
 *
 * The publickey subsystem allows an already connected and authenticated
 * client to manage the list of authorized public keys stored on the
 * target server in an implementation agnostic manner.
 * If the remote server does not support the publickey subsystem,
 * the ssh2_publickey_init function will return FALSE.
 *
 * @param resource $session
 * @return resource Returns an SSH2 Publickey Subsystem resource for use
 * with all other ssh2_publickey_*() methods.
 * @throws Ssh2Exception
 *
 */
function ssh2_publickey_init($session)
{
    return Call::invoke('ssh2_publickey_init',Ssh2Exception::class,false, $session);
}


/**
 * Removes an authorized publickey.
 *
 * @param resource $pkey Publickey Subsystem Resource
 * @param string $algoname Publickey algorithm (e.g.): ssh-dss, ssh-rsa
 * @param string $blob Publickey blob as raw binary data
 * @throws Ssh2Exception
 *
 */
function ssh2_publickey_remove($pkey, string $algoname, string $blob): void
{
    Call::invoke('ssh2_publickey_remove',Ssh2Exception::class,false, $pkey, $algoname, $blob);
}


/**
 * Copy a file from the remote server to the local filesystem using the SCP protocol.
 *
 * @param resource $session An SSH connection link identifier, obtained from a call to
 * ssh2_connect.
 * @param string $remote_file Path to the remote file.
 * @param string $local_file Path to the local file.
 * @throws Ssh2Exception
 *
 */
function ssh2_scp_recv($session, string $remote_file, string $local_file): void
{
    Call::invoke('ssh2_scp_recv',Ssh2Exception::class,false, $session, $remote_file, $local_file);
}


/**
 * Copy a file from the local filesystem to the remote server using the SCP protocol.
 *
 * @param resource $session An SSH connection link identifier, obtained from a call to
 * ssh2_connect.
 * @param string $local_file Path to the local file.
 * @param string $remote_file Path to the remote file.
 * @param int $create_mode The file will be created with the mode specified by
 * create_mode.
 * @throws Ssh2Exception
 *
 */
function ssh2_scp_send($session, string $local_file, string $remote_file, int $create_mode = 0644): void
{
    Call::invoke('ssh2_scp_send',Ssh2Exception::class,false, $session, $local_file, $remote_file, $create_mode);
}


/**
 * Sends an EOF to the stream; this is typically used to close standard input,
 * while keeping output and error alive. For example, one can send a remote
 * process some data over standard input, close it to start processing, and
 * still be able to read out the results without creating additional files.
 *
 * @param resource $channel An SSH stream; can be acquired through functions like ssh2_fetch_stream
 * or ssh2_connect.
 * @throws Ssh2Exception
 *
 */
function ssh2_send_eof($channel): void
{
    Call::invoke('ssh2_send_eof',Ssh2Exception::class,false, $channel);
}


/**
 * Attempts to change the mode of the specified file to that given in
 * mode.
 *
 * @param resource $sftp An SSH2 SFTP resource opened by ssh2_sftp.
 * @param string $filename Path to the file.
 * @param int $mode Permissions on the file. See the chmod for more details on this parameter.
 * @throws Ssh2Exception
 *
 */
function ssh2_sftp_chmod($sftp, string $filename, int $mode): void
{
    Call::invoke('ssh2_sftp_chmod',Ssh2Exception::class,false, $sftp, $filename, $mode);
}


/**
 * Creates a directory on the remote file server with permissions set to
 * mode.
 *
 * This function is similar to using mkdir with the
 * ssh2.sftp:// wrapper.
 *
 * @param resource $sftp An SSH2 SFTP resource opened by ssh2_sftp.
 * @param string $dirname Path of the new directory.
 * @param int $mode Permissions on the new directory.
 * The actual mode is affected by the current umask.
 * @param bool $recursive If recursive is TRUE any parent directories
 * required for dirname will be automatically created as well.
 * @throws Ssh2Exception
 *
 */
function ssh2_sftp_mkdir($sftp, string $dirname, int $mode = 0777, bool $recursive = false): void
{
    Call::invoke('ssh2_sftp_mkdir',Ssh2Exception::class,false, $sftp, $dirname, $mode, $recursive);
}


/**
 * Renames a file on the remote filesystem.
 *
 * @param resource $sftp An SSH2 SFTP resource opened by ssh2_sftp.
 * @param string $from The current file that is being renamed.
 * @param string $to The new file name that replaces from.
 * @throws Ssh2Exception
 *
 */
function ssh2_sftp_rename($sftp, string $from, string $to): void
{
    Call::invoke('ssh2_sftp_rename',Ssh2Exception::class,false, $sftp, $from, $to);
}


/**
 * Removes a directory from the remote file server.
 *
 * This function is similar to using rmdir with the
 * ssh2.sftp:// wrapper.
 *
 * @param resource $sftp An SSH2 SFTP resource opened by ssh2_sftp.
 * @param string $dirname
 * @throws Ssh2Exception
 *
 */
function ssh2_sftp_rmdir($sftp, string $dirname): void
{
    Call::invoke('ssh2_sftp_rmdir',Ssh2Exception::class,false, $sftp, $dirname);
}


/**
 * Creates a symbolic link named link on the remote
 * filesystem pointing to target.
 *
 * @param resource $sftp An SSH2 SFTP resource opened by ssh2_sftp.
 * @param string $target Target of the symbolic link.
 * @param string $link
 * @throws Ssh2Exception
 *
 */
function ssh2_sftp_symlink($sftp, string $target, string $link): void
{
    Call::invoke('ssh2_sftp_symlink',Ssh2Exception::class,false, $sftp, $target, $link);
}


/**
 * Deletes a file on the remote filesystem.
 *
 * @param resource $sftp An SSH2 SFTP resource opened by ssh2_sftp.
 * @param string $filename
 * @throws Ssh2Exception
 *
 */
function ssh2_sftp_unlink($sftp, string $filename): void
{
    Call::invoke('ssh2_sftp_unlink',Ssh2Exception::class,false, $sftp, $filename);
}


/**
 * Request the SFTP subsystem from an already connected SSH2 server.
 *
 * @param resource $session An SSH connection link identifier, obtained from a call to
 * ssh2_connect.
 * @return resource This method returns an SSH2 SFTP resource for use with
 * all other ssh2_sftp_*() methods and the
 * ssh2.sftp:// fopen wrapper.
 * @throws Ssh2Exception
 *
 */
function ssh2_sftp($session)
{
    return Call::invoke('ssh2_sftp',Ssh2Exception::class,false, $session);
}


/**
 * Open a shell at the remote end and allocate a stream for it.
 *
 * @param resource $session An SSH connection link identifier, obtained from a call to
 * ssh2_connect.
 * @param string $termtype termtype should correspond to one of the
 * entries in the target system's /etc/termcap file.
 * @param array $env env may be passed as an associative array of
 * name/value pairs to set in the target environment.
 * @param int $width Width of the virtual terminal.
 * @param int $height Height of the virtual terminal.
 * @param int $width_height_type width_height_type should be one of
 * SSH2_TERM_UNIT_CHARS or
 * SSH2_TERM_UNIT_PIXELS.
 * @return resource Returns a stream resource on success.
 * @throws Ssh2Exception
 *
 */
function ssh2_shell($session, string $termtype = "vanilla", array $env = null, int $width = 80, int $height = 25, int $width_height_type = SSH2_TERM_UNIT_CHARS)
{
    if ($width_height_type !== SSH2_TERM_UNIT_CHARS) {
        return Call::invoke('ssh2_shell',Ssh2Exception::class,false, $session, $termtype, $env, $width, $height, $width_height_type);
    } elseif ($height !== 25) {
        return Call::invoke('ssh2_shell',Ssh2Exception::class,false, $session, $termtype, $env, $width, $height);
    } elseif ($width !== 80) {
        return Call::invoke('ssh2_shell',Ssh2Exception::class,false, $session, $termtype, $env, $width);
    } elseif ($env !== null) {
        return Call::invoke('ssh2_shell',Ssh2Exception::class,false, $session, $termtype, $env);
    } else {
        return Call::invoke('ssh2_shell',Ssh2Exception::class,false, $session, $termtype);
    }
}

