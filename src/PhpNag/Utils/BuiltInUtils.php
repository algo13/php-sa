<?php
namespace PhpNag\Utils;

final class BuiltInUtils
{
    public static function getDeprecatedFunc($name)
    {
        // removedFunctionNames => [deprecated, removed, alternative]
        // order by PHP Manual Function Reference
        static $cache = [
            // Other Services > LDAP > LDAP Functions
            'ldap_sort' => ['7.0.0', null],
            // Other Services > Network > Network Functions
            'define_syslog_variables' => ['5.3', '5.4', null],
            // Affecting PHP's Behaviour > PHP Options/Info > PHP Options/Info Functions
            'dl' => ['5.3.0', '7.0.0', 'Warning: This function was removed from most SAPIs in PHP 5.3.0, and was removed from PHP-FPM in PHP 7.0.0.'],
            'magic_quotes_runtime' => ['5.3.0', '7.0.0', 'alias set_magic_quotes_runtime()'],
            'set_magic_quotes_runtime' => ['5.3.0', '7.0.0', null],
            'php_logo_guid' => ['*', '5.5', null],
            'php_egg_logo_guid' => ['*', '5.5', null],
            'php_real_logo_guid' => ['*', '5.5', null],
            'zend_logo_guid' => ['*', '5.5', null],
            // Cryptography Extensions > Mcrypt > Mcrypt Functions
            'mcrypt_cbc' => ['5.5.0', '7.0.0', 'mcrypt_decrypt(), mcrypt_encrypt()'],
            'mcrypt_cfb' => ['5.5.0', '7.0.0', 'mcrypt_decrypt(), mcrypt_encrypt()'],
            'mcrypt_ecb' => ['5.5.0', '7.0.0', 'mcrypt_decrypt(), mcrypt_encrypt()'],
            'mcrypt_generic_end' => ['5.3.0', '7.0.0', 'mcrypt_generic_deinit()'],
            'mcrypt_ofb' => ['5.5.0', '7.0.0', 'mcrypt_decrypt(), mcrypt_encrypt()'],
            'mcrypt_get_key_size' => ['7.1.0', '8.0.0', null],
            'mcrypt_get_block_size' => ['7.1.0', '8.0.0', null],
            'mcrypt_get_cipher_name' => ['7.1.0', '8.0.0', null],
            'mcrypt_create_iv' => ['7.1.0', '8.0.0', null],
            'mcrypt_list_algorithms' => ['7.1.0', '8.0.0', null],
            'mcrypt_list_modes' => ['7.1.0', '8.0.0', null],
            'mcrypt_get_iv_size' => ['7.1.0', '8.0.0', null],
            'mcrypt_encrypt' => ['7.1.0', '8.0.0', null],
            'mcrypt_decrypt' => ['7.1.0', '8.0.0', null],
            'mcrypt_module_open' => ['7.1.0', '8.0.0', null],
            'mcrypt_generic_init' => ['7.1.0', '8.0.0', null],
            'mcrypt_generic' => ['7.1.0', '8.0.0', null],
            'mdecrypt_generic' => ['7.1.0', '8.0.0', null],
            'mcrypt_generic_deinit' => ['7.1.0', '8.0.0', null],
            'mcrypt_enc_self_test' => ['7.1.0', '8.0.0', null],
            'mcrypt_enc_is_block_algorithm_mode' => ['7.1.0', '8.0.0', null],
            'mcrypt_enc_is_block_algorithm' => ['7.1.0', '8.0.0', null],
            'mcrypt_enc_is_block_mode' => ['7.1.0', '8.0.0', null],
            'mcrypt_enc_get_block_size' => ['7.1.0', '8.0.0', null],
            'mcrypt_enc_get_key_size' => ['7.1.0', '8.0.0', null],
            'mcrypt_enc_get_supported_key_sizes' => ['7.1.0', '8.0.0', null],
            'mcrypt_enc_get_iv_size' => ['7.1.0', '8.0.0', null],
            'mcrypt_enc_get_algorithms_name' => ['7.1.0', '8.0.0', null],
            'mcrypt_enc_get_modes_name' => ['7.1.0', '8.0.0', null],
            'mcrypt_module_self_test' => ['7.1.0', '8.0.0', null],
            'mcrypt_module_is_block_algorithm_mode' => ['7.1.0', '8.0.0', null],
            'mcrypt_module_is_block_algorithm' => ['7.1.0', '8.0.0', null],
            'mcrypt_module_is_block_mode' => ['7.1.0', '8.0.0', null],
            'mcrypt_module_get_algo_block_size' => ['7.1.0', '8.0.0', null],
            'mcrypt_module_get_algo_key_size' => ['7.1.0', '8.0.0', null],
            'mcrypt_module_get_supported_key_sizes' => ['7.1.0', '8.0.0', null],
            'mcrypt_module_close' => ['7.1.0', '8.0.0', null],
            // Database Extensions > Vendor Specific Database Extensions > Mssql > Mssql Functions
            'mssql_bind' => [null, '7.0.0', 'PDOStatement::bindParam(), PDOStatement::bindValue(), sqlsrv_prepare(), odbc_prepare()'],
            'mssql_close' => [null, '7.0.0', 'sqlsrv_close(), odbc_close(), odbc_close_all()'],
            'mssql_connect' => [null, '7.0.0', 'PDO::__construct(), sqlsrv_connect(), odbc_connect()'],
            'mssql_data_seek' => [null, '7.0.0', 'Using an OFFSET clause with a query issued through PDO_SQLSRV, PDO_ODBC, SQLSRV, or the unified ODBC driver.'],
            'mssql_execute' => [null, '7.0.0', 'Using an EXEC query issued through PDO_SQLSRV, PDO_ODBC, SQLSRV, or the unified ODBC driver.'],
            'mssql_fetch_array' => [null, '7.0.0', 'PDOStatement::fetch(), sqlsrv_fetch_array(), odbc_fetch_array()'],
            'mssql_fetch_assoc' => [null, '7.0.0', 'PDOStatement::fetch(), sqlsrv_fetch_array(), odbc_fetch_array()'],
            'mssql_fetch_batch' => [null, '7.0.0', null],
            'mssql_fetch_field' => [null, '7.0.0', 'PDOStatement::getColumnMeta(), sqlsrv_field_metadata(), The various odbc_field_* functions in the unified ODBC driver.'],
            'mssql_fetch_object' => [null, '7.0.0', 'PDOStatement::fetchObject(), sqlsrv_fetch_object(), odbc_fetch_object()'],
            'mssql_fetch_row' => [null, '7.0.0', 'PDOStatement::fetch(), sqlsrv_fetch_array(), odbc_fetch_row()'],
            'mssql_field_length' => [null, '7.0.0', 'PDOStatement::getColumnMeta(), sqlsrv_field_metadata(), odbc_field_len()'],
            'mssql_field_name' => [null, '7.0.0', 'PDOStatement::getColumnMeta(), sqlsrv_field_metadata(), odbc_field_name()'],
            'mssql_field_seek' => [null, '7.0.0', null],
            'mssql_field_type' => [null, '7.0.0', 'PDOStatement::getColumnMeta(), sqlsrv_field_metadata(), odbc_field_type()'],
            'mssql_free_result' => [null, '7.0.0', 'odbc_free_result()'],
            'mssql_free_statement' => [null, '7.0.0', 'sqlsrv_free_stmt()'],
            'mssql_get_last_message' => [null, '7.0.0', 'PDOStatement::errorInfo(), sqlsrv_errors(), odbc_errormsg()'],
            'mssql_guid_string' => [null, '7.0.0', null],
            'mssql_init' => [null, '7.0.0', 'Using an EXEC query issued through PDO_SQLSRV, PDO_ODBC, SQLSRV, or the unified ODBC driver.'],
            'mssql_min_error_severity' => [null, '7.0.0', null],
            'mssql_min_message_severity' => [null, '7.0.0', null],
            'mssql_next_result' => [null, '7.0.0', 'PDOStatement::nextRowset(), sqlsrv_next_result(), odbc_next_result()'],
            'mssql_num_fields' => [null, '7.0.0', 'PDOStatement::columnCount(), sqlsrv_num_fields(), odbc_num_fields()'],
            'mssql_num_rows' => [null, '7.0.0', 'PDOStatement::rowCount(), sqlsrv_num_rows(), odbc_num_rows()'],
            'mssql_pconnect' => [null, '7.0.0', 'PDO::__construct(), sqlsrv_connect(), odbc_pconnect()'],
            'mssql_query' => [null, '7.0.0', 'PDO::query(), sqlsrv_query(), odbc_exec()'],
            'mssql_result' => [null, '7.0.0', 'odbc_result()'],
            'mssql_rows_affected' => [null, '7.0.0', 'PDOStatement::rowCount(), sqlsrv_rows_affected()'],
            'mssql_select_db' => [null, '7.0.0', 'PDO_SQLSRV DSN, PDO_ODBC DSN, sqlsrv_connect(), odbc_connect()'],
            // Database Extensions > Vendor Specific Database Extensions > MySQL > MySQL (Original) > MySQL Functions
            'mysql_db_query' => ['5.3.0', '7.0.0', 'mysql_select_db and mysql_query'],
            'mysql_escape_string' => ['4.3.0', '7.0.0', 'mysql_real_escape_string'],
            'mysql_list_dbs' => ['5.4.0', '7.0.0', 'SQL Query: SHOW DATABASES'],
            'mysqli_bind_param' => ['5.3.0', '5.4.0', 'Alias mysqli_stmt_bind_param'],
            'mysqli_bind_result' => ['5.3.0', '5.4.0', 'Alias mysqli_stmt_bind_result'],
            'mysqli_client_encoding' => ['5.3.0', '5.4.0', 'Alias mysqli_character_set_name'],
            'mysqli_fetch' => ['5.3.0', '5.4.0', 'Alias mysqli_stmt_fetch'],
            'mysqli_get_metadata' => ['5.3.0', '5.4.0', 'Alias mysqli_stmt_result_metadata'],
            'mysqli_param_count' => ['5.3.0', '5.4.0', 'Alias mysqli_stmt_param_count'],
            'mysqli_send_long_data' => ['5.3.0', '5.4.0', 'Alias mysqli_stmt_send_long_data'],
            // Database Extensions > Vendor Specific Database Extensions > OCI8 > OCI8 Obsolete Aliases and Functions
            'ocibindbyname' => ['5.4', null, 'alias oci_bind_by_name'],
            'ocicancel' => ['5.4', null, 'oci_cancel'],
            'ocicloselob' => ['5.4', null, 'OCI-Lob::close'],
            'ocicollappend' => ['5.4', null, 'OCI-Collection::append'],
            'ocicollassign' => ['5.4', null, 'OCI-Collection::assign'],
            'ocicollassignelem' => ['5.4', null, 'OCI-Collection::assignElem'],
            'ocicollgetelem' => ['5.4', null, 'OCI-Collection::getElem'],
            'ocicollmax' => ['5.4', null, 'OCI-Collection::max'],
            'ocicollsize' => ['5.4', null, 'OCI-Collection::size'],
            'ocicolltrim' => ['5.4', null, 'OCI-Collection::trim'],
            'ocicolumnisnull' => ['5.4', null, 'oci_field_is_null'],
            'ocicolumnname' => ['5.4', null, 'oci_field_name'],
            'ocicolumnprecision' => ['5.4', null, 'oci_field_precision'],
            'ocicolumnscale' => ['5.4', null, 'oci_field_scale'],
            'ocicolumnsize' => ['5.4', null, 'oci_field_size'],
            'ocicolumntype' => ['5.4', null, 'oci_field_type'],
            'ocicolumntyperaw' => ['5.4', null, 'oci_field_type_raw'],
            'ocicommit' => ['5.4', null, 'oci_commit'],
            'ocidefinebyname' => ['5.4', null, 'oci_define_by_name'],
            'ocierror' => ['5.4', null, 'oci_error'],
            'ociexecute' => ['5.4', null, 'oci_execute'],
            'ocifetch' => ['5.4', null, 'oci_fetch'],
            'ocifetchinto' => ['5.4', null, null],
            'ocifetchstatement' => ['5.4', null,'oci_fetch_all'],
            'ocifreecollection' => ['5.4', null, 'OCI-Collection::free'],
            'ocifreecursor' => ['5.4', null, 'oci_free_statement'],
            'ocifreedesc' => ['5.4', null, 'OCI-Lob::free'],
            'ocifreestatement' => ['5.4', null, 'oci_free_statement'],
            'ociinternaldebug' => ['5.4', null, 'oci_internal_debug'],
            'ociloadlob' => ['5.4', null, 'OCI-Lob::load'],
            'ocilogoff' => ['5.4', null, 'oci_close'],
            'ocilogon' => ['5.4', null, 'oci_connect'],
            'ocinewcollection' => ['5.4', null, 'oci_new_collection'],
            'ocinewcursor' => ['5.4', null, 'oci_new_cursor'],
            'ocinewdescriptor' => ['5.4', null, 'oci_new_descriptor'],
            'ocinlogon' => ['5.4', null, 'oci_new_connect'],
            'ocinumcols' => ['5.4', null, 'oci_num_fields'],
            'ociparse' => ['5.4', null, 'oci_parse'],
            'ociplogon' => ['5.4', null, 'oci_pconnect'],
            'ociresult' => ['5.4', null, 'oci_result'],
            'ocirollback' => ['5.4', null, 'oci_rollback'],
            'ocirowcount' => ['5.4', null, 'oci_num_rows'],
            'ocisavelob' => ['5.4', null, 'OCI-Lob::save'],
            'ocisavelobfile' => ['5.4', null, 'OCI-Lob::import'],
            'ociserverversion' => ['5.4', null, 'oci_server_version'],
            'ocisetprefetch' => ['5.4', null, 'oci_set_prefetch'],
            'ocistatementtype' => ['5.4', null, 'oci_statement_type'],
            'ociwritelobtofile' => ['5.4', null, 'OCI-Lob::export'],
            'ociwritetemporarylob' => ['5.4', null, 'OCI-Lob::writeTemporary'],
            // Human Language and Character Encoding Support > intl > IntlDateFormatter
            'datefmt_set_timezone_id' => ['5.5.0', '7.0.0', 'datefmt_set_timezone'],
            //'IntlDateFormatter::setTimeZoneId' => ['5.5.0', '7.0.0', 'IntlDateFormatter::setTimeZone()'],
            // Image Processing and Generation > GD > GD and Image Functions
            'imagepsbbox' => ['', '7.0.0', ''],
            'imagepsencodefont' => ['', '7.0.0', ''],
            'imagepsextendedfont' => ['', '7.0.0', ''],
            'imagepsfreefont' => ['', '7.0.0', ''],
            'imagepsloadfont' => ['', '7.0.0', ''],
            'imagepsslantfont' => ['', '7.0.0', ''],
            'imagepstext' => ['', '7.0.0', ''],
            // Mathematical Extensions > Math > Math Functions
            'getrandmax' => ['7.1.0', '8.0.0', 'mt_getrandmax'],
            'rand' => ['7.1.0', '8.0.0', 'mt_rand'],
            'srand' => ['7.1.0', '8.0.0', 'mt_srand'],
            // Other Basic Extensions > Streams > Stream Functions
            'set_socket_blocking' => ['5.3.0', '7.0.0', 'alias stream_set_blocking()'],
            // Session Extensions > Sessions > Session Functions
            'session_is_registered' => ['5.3.0', '5.4.0', 'isset($_SESSION[\'varname\'])'],
            'session_register' => ['5.3.0', '5.4.0', '$_SESSION'],
            'session_unregister' => ['5.3.0', '5.4.0', 'unset($_SESSION[\'varname\']);'],
            'session_unset' => ['4.1.0', null, 'Note:Only use session_unset() for older deprecated code that does not use $_SESSION.'],
            // Text Processing > POSIX Regex > POSIX Regex Functions
            'ereg_replace' => ['5.3.0', '7.0.0', 'preg_replace'], //< PCRE,fnmatch
            'ereg' => ['5.3.0', '7.0.0', 'preg_match'],
            'eregi_replace' => ['5.3.0', '7.0.0', 'preg_replace'],
            'eregi' => ['5.3.0', '7.0.0', 'preg_match'],
            'split' => ['5.3.0', '7.0.0', 'preg_split'],
            'spliti' => ['5.3.0', '7.0.0', 'preg_split'],
            'sql_regcase' => ['5.3.0', '7.0.0', 'PCRE,fnmatch'],
            // Text Processing > Strings > String Functions
            'crc32' => ['', '', 'deprecated(32bit/64bit)'],
            // Variable and Type Related Extensions > Classes/Objects > Classes/Object Functions
            '__autoload' => ['7.1.0', '8.0.0', null],
            'call_user_method_array' => ['4.1.0', '7.0.0', 'call_user_func_array()'],
            'call_user_method' => ['4.1.0', '7.0.0', 'call_user_func()'],
            // Variable and Type Related Extensions > Function Handling > Function handling Functions
            'create_function' => ['7.1.0', '8.0.0', null],
            // Variable and Type Related Extensions > Variable handling > Variable handling Functions
            'import_request_variables' => ['5.3.0', '5.4.0', null], //< bug?
        ];
        if (array_key_exists($name, $cache)) {
            return $cache[$name];
        }
        return false;
    }
    public static function getDeprecatedIni($name)
    {
        static $cache = array(
            // Affecting PHP's Behaviour > PHP Options/Info > Installing/Configuring
            'magic_quotes_gpc' => ['5.3.0', '5.4.0'],
            'magic_quotes_runtime' => ['5.3', '5.4'],
            // Database Extensions > Vendor Specific Database Extensions > Sybase > Installing/Configuring
            'magic_quotes_sybase' => ['5.3', '5.4'],
            // Human Language and Character Encoding Support > iconv > Installing/Configuring
            'iconv.input_encoding' => ['5.6', null],
            'iconv.output_encoding' => ['5.6', null],
            'iconv.internal_encoding' => ['5.6', null],
            // Human Language and Character Encoding Support > Multibyte String > Installing/Configuring
            'mbstring.http_input' => ['5.6.0', null, 'default_charset'],
            'mbstring.http_output' => ['5.6.0', null, 'default_charset'],
            'mbstring.internal_encoding' => ['5.6.0', null, 'default_charset'],
            'mbstring.script_encoding' => [null, '5.4.0', 'zend.script_encoding'],
            'mbstring.func_overload' => [null, '7.1'],
            // Other Basic Extensions > Misc. > Installing/Configuring
            'highlight.bg' => ['5.3', '5.4'],
            // Other Services > Network > Installing/Configuring
            'define_syslog_variables' => ['5.3', '5.4'],
            // Session Extensions > Sessions > Installing/Configuring
            'session.bug_compat_42' => ['5.3', '5.4'],
            'session.bug_compat_warn' => ['5.3', '5.4'],
            // Features > Safe Mode
            'safe_mode' => ['5.3', '5.4'],
            'safe_mode_gid' => ['5.3', '5.4'],
            'safe_mode_include_dir' => ['5.3', '5.4'],
            'safe_mode_exec_dir' => ['5.3', '5.4'],
            'safe_mode_allowed_env_vars' => ['5.3', '5.4'],
            'safe_mode_protected_env_vars' => ['5.3', '5.4'],
            // Appendices > php.ini directives [Language and Misc Configuration Options]
            'y2k_compliance' => [null, '5.4'],
            'allow_call_time_pass_reference' => ['5.3', '5.4'],
            'zend.ze1_compatibility_mode' => [null, '5.3.0'],
            // Appendices > php.ini directives [Data Handling Configuration Options]
            'register_globals' => [null, '5.4.0'],
            'register_long_arrays' => ['5.3.0', '5.4.0'],
            'always_populate_raw_post_data' => ['5.6.0', '7.0.0'],
        );
        if (array_key_exists($name, $cache)) {
            return $cache[$name];
        }
        return false;
    }
    public static function isReturnMixed($name)
    {
        static $functions = null;
        if ($functions === null) {
            $functions = array_flip([
                // Database Extensions > Vendor Specific Database Extensions > SQLite > SQLite Functions
                'sqlite_query', //< resource/false
                // File System Related Extensions > Directories > Directory Functions
                'readdir', //< string/false
                // File System Related Extensions > Filesystem > Filesystem Functions
                'fgetc', //< string/false
                'file_gut_contents', //< string/false
                'file_put_contents', //< int/false
                // Human Language and Character Encoding Support > iconv > iconv Functions
                'iconv_strpos', 'iconv_strrpos ', //< int/false
                // Human Language and Character Encoding Support > Multibyte String > Multibyte String Functions
                'mb_strlen', //< int/false
                // Image Processing and Generation > GD > GD and Image Functions
                'imagecolorallocate', 'imagecolorallocatealpha', //< int/false
                // Process Control Extensions > PCNTL > PCNTL Functions
                'pcntl_getpriority', //< int/false
                // Other Services > cURL > cURL Functions
                'curl_exec', //< mixed/false
                // Other Services > Sockets > Socket Functions
                'socket_recvfrom', //< int/false
                // Text Processing > PCRE > PCRE Functions
                'preg_match_all', //< iny/false
                'preg_match', //< 1/0/false
                // Text Processing Strings > String Functions
                'convert_uudecode', 'convert_uuencode', 'hex2bin', 'md5_file', //< string/false
                'metaphone', 'quotemeta', 'setlocale', 'sha1_file', 'stristr', //< string/false
                'strpbrk', 'strrchr', 'strstr', 'strtok', //< string/false
                'strtr', //< string/false/null
                'substr', //< string/false/''
                'explode', //< array/false
                'stripos', 'strpos', 'strripos', 'strrpos', 'substr_compare', //< int/false
                // Variable and Type Related Extensions > Arrays > Array Functions
                'array_search', 'current', 'next', 'pos', 'prev', 'reset', //< mixed/false
                // XML Manipulation > SimpleXML > SimpleXML Functions
                'simplexml_import_dom', 'simplexml_load_file', 'simplexml_load_string', //< SimpleXMLElement/false
            ]);
        }
        return array_key_exists($name, $functions);
    }
    public static function getDeprecatedGlobals($name)
    {
        static $cache = [
            // deprecated, removed
            'HTTP_SERVER_VARS' => ['4.1.0', '5.4.0', '$_SERVER'],
            'HTTP_GET_VARS' => ['4.1.0', null, '$_GET'],
            'HTTP_POST_VARS' => ['4.1.0', null, '$_POST'],
            'HTTP_POST_FILES' => ['4.1.0', null, '$_FILES'],
            'HTTP_SESSION_VARS' => ['4.1.0', null, '$_SESSION'],
            'HTTP_ENV_VARS' => ['4.1.0', null, '$_ENV'],
            'HTTP_COOKIE_VARS' => ['4.1.0', null, '$_COOKIE'],
            'HTTP_RAW_POST_DATA' => ['5.6.0', '7.0.0', 'php://input'],
            'php_errormsg' => ['7.1.0', '8.0.0', 'error_get_last()'],
        ];
        if (array_key_exists($name, $cache)) {
            return $cache[$name];
        }
        return false;
    }
    private function __construct()
    {
    }
}
