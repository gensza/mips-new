<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|gege
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

//start : koneksi_databases_dynamic
$CI = &get_instance();
$CI->load->library('lib_databases');
// $CI->load->helper('sessioncheck');
$inis_config = $CI->lib_databases->inis_config();
$inis_db     = $CI->lib_databases->inis_db();

// $inis_db = check_db_pt();
//end : koneksi_databases_dynamic


$db['default']['hostname'] = '192.168.1.231';
$db['default']['username'] = 'mis';
$db['default']['password'] = 'msaljkt@88';
$db['default']['database'] = 'db_mips_' . $inis_config . '';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '{PRE}';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

/* DB CENTER */
$db['mips_center']['hostname'] = '192.168.1.231';
$db['mips_center']['username'] = 'mis';
$db['mips_center']['password'] = 'msaljkt@88';
$db['mips_center']['database'] = 'db_logistik_center';
$db['mips_center']['dbdriver'] = 'mysqli';
$db['mips_center']['dbprefix'] = '';
$db['mips_center']['pconnect'] = TRUE;
$db['mips_center']['db_debug'] = TRUE;
$db['mips_center']['cache_on'] = FALSE;
$db['mips_center']['cachedir'] = '';
$db['mips_center']['char_set'] = 'utf8';
$db['mips_center']['dbcollat'] = 'utf8_general_ci';
$db['mips_center']['swap_pre'] = '{PRE}';
$db['mips_center']['autoinit'] = TRUE;
$db['mips_center']['stricton'] = FALSE;
/* END DB CENTER */



$db['mips_gl_msal'] = array(
	'dsn'	=> '',
	'hostname' => '192.168.1.231',
	'username' => 'mis',
	'password' => 'msaljkt@88',
	'database' => 'db_mips_gl_msal',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['mips_gl_msal_site'] = array(
	'dsn'	=> '',
	'hostname' => '192.168.1.231',
	'username' => 'mis',
	'password' => 'msaljkt@88',
	'database' => 'db_mips_gl_msal_site',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['mips_gl_msal_pks'] = array(
	'dsn'	=> '',
	'hostname' => '192.168.1.231',
	'username' => 'mis',
	'password' => 'msaljkt@88',
	'database' => 'db_mips_gl_msal_pks',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);



$db['db_mips_cb_msal'] = array(
	'dsn'	=> '',
	'hostname' => '192.168.1.231',
	'username' => 'mis',
	'password' => 'msaljkt@88',
	'database' => 'db_mips_cb_msal',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['db_mips_cb_msal_site'] = array(
	'dsn'	=> '',
	'hostname' => '192.168.1.231',
	'username' => 'mis',
	'password' => 'msaljkt@88',
	'database' => 'db_mips_cb_msal_site',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
$db['db_mips_cb_msal_pks'] = array(
	'dsn'	=> '',
	'hostname' => '192.168.1.231',
	'username' => 'mis',
	'password' => 'msaljkt@88',
	'database' => 'db_mips_cb_msal_pks',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);




/* START-DB-MASTERCODE */
$db['mstcode']['hostname'] = '192.168.1.231';
$db['mstcode']['username'] = 'mis';
$db['mstcode']['password'] = 'msaljkt@88';
$db['mstcode']['database'] = 'db_mmop_ms_code';
$db['mstcode']['dbdriver'] = 'mysqli';
$db['mstcode']['dbprefix'] = '';
$db['mstcode']['pconnect'] = TRUE;
$db['mstcode']['db_debug'] = TRUE;
$db['mstcode']['cache_on'] = FALSE;
$db['mstcode']['cachedir'] = '';
$db['mstcode']['char_set'] = 'utf8';
$db['mstcode']['dbcollat'] = 'utf8_general_ci';
$db['mstcode']['swap_pre'] = '{PRE}';
$db['mstcode']['autoinit'] = TRUE;
$db['mstcode']['stricton'] = FALSE;
/* END-DB-MASTERCODE */

$db['mips_logistik_msal'] = array(
	'dsn'	=> '',
	'hostname' => '192.168.1.231',
	'username' => 'mis',
	'password' => 'msaljkt@88',
	'database' => 'new_logistikmsal_2021',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);



$db['db_personalia_msal'] = array(
	'dsn'	=> '',
	// 'hostname' => 'localhost',
	// 'username' => 'root',
	// 'password' => '',
	'hostname' => '192.168.1.231',
	'username' => 'mis',
	'password' => 'msaljkt@88',
	'database' => 'msalgrou_personalia',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);







/* End of file database.php */
/* Location: ./application/config/database.php */