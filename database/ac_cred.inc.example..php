<?php
 
/**
 * ac_cred.inc.php: Secret Connection Credentials for a database class
 * @package Oracle
 */
 
/**
 * DB user name
 */
define('SCHEMA', 'infra');
 
/**
 * DB Password.
 *
 * Note: In practice keep database credentials out of directories
 * accessible to the web server.
 */
define('PASSWORD', '***REMOVED***');
 
/**
 * DB connection identifier
 */
define('DATABASE', '***REMOVED***');
 
/**
 * DB character set for returned data
 */
define('CHARSET', 'WE8MSWIN1252');
 
/**
 * Client Information text for DB tracing
 */
define('CLIENT_INFO', 'Banco de Produção');
 
?>