<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
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
$inis_config = $CI->lib_databases->inis_config();
$inis_db     = $CI->lib_databases->inis_db();
//end : koneksi_databases_dynamic


$db['default']['hostname'] = '192.168.1.237';
$db['default']['username'] = 'mis';
$db['default']['password'] = 'msaljkt@88';
$db['default']['database'] = 'dev_db_mips_' . $inis_config . '';
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


/* START-DB-GL */
$db['mips_gl']['hostname'] = '192.168.1.237';
$db['mips_gl']['username'] = 'mis';
$db['mips_gl']['password'] = 'msaljkt@88';
$db['mips_gl']['database'] = 'db_mips_gl_' . $inis_db . '';
// $db['mips_gl']['database'] = 'db_mips_gl_'.$inis_db;
// $db['mips_gl']['database'] = 'db_mips_gl_'.$inis_db.'_sblmcoba10digit';
$db['mips_gl']['dbdriver'] = 'mysqli';
$db['mips_gl']['dbprefix'] = '';
$db['mips_gl']['pconnect'] = TRUE;
$db['mips_gl']['db_debug'] = TRUE;
$db['mips_gl']['cache_on'] = FALSE;
$db['mips_gl']['cachedir'] = '';
$db['mips_gl']['char_set'] = 'utf8';
$db['mips_gl']['dbcollat'] = 'utf8_general_ci';
$db['mips_gl']['swap_pre'] = '{PRE}';
$db['mips_gl']['autoinit'] = TRUE;
$db['mips_gl']['stricton'] = FALSE;
/* END-DB-GL */


/* START-DB-CB */
$db['mips_caba']['hostname'] = '192.168.1.237';
$db['mips_caba']['username'] = 'mis';
$db['mips_caba']['password'] = 'msaljkt@88';
$db['mips_caba']['database'] = 'db_mips_cb_' . $inis_db . '';
$db['mips_caba']['dbdriver'] = 'mysqli';
$db['mips_caba']['dbprefix'] = '';
$db['mips_caba']['pconnect'] = TRUE;
$db['mips_caba']['db_debug'] = TRUE;
$db['mips_caba']['cache_on'] = FALSE;
$db['mips_caba']['cachedir'] = '';
$db['mips_caba']['char_set'] = 'utf8';
$db['mips_caba']['dbcollat'] = 'utf8_general_ci';
$db['mips_caba']['swap_pre'] = '{PRE}';
$db['mips_caba']['autoinit'] = TRUE;
$db['mips_caba']['stricton'] = FALSE;
/* END-DB-CB */


/* START-DB-MASTERCODE */
// $db['mstcode']['hostname'] = '192.168.1.237';
// $db['mstcode']['username'] = 'mis';
// $db['mstcode']['password'] = 'msaljkt@88';
// $db['mstcode']['database'] = 'db_mmop_ms_code';
// $db['mstcode']['dbdriver'] = 'mysqli';
// $db['mstcode']['dbprefix'] = '';
// $db['mstcode']['pconnect'] = TRUE;
// $db['mstcode']['db_debug'] = TRUE;
// $db['mstcode']['cache_on'] = FALSE;
// $db['mstcode']['cachedir'] = '';
// $db['mstcode']['char_set'] = 'utf8';
// $db['mstcode']['dbcollat'] = 'utf8_general_ci';
// $db['mstcode']['swap_pre'] = '{PRE}';
// $db['mstcode']['autoinit'] = TRUE;
// $db['mstcode']['stricton'] = FALSE;
/* END-DB-MASTERCODE */


/* START-DB-GL */
$db['mips_logistik']['hostname'] = '192.168.1.237';
$db['mips_logistik']['username'] = 'mis';
$db['mips_logistik']['password'] = 'msaljkt@88';
$db['mips_logistik']['database'] = 'new_logistikmsal_2021';
$db['mips_logistik']['dbdriver'] = 'mysqli';
$db['mips_logistik']['dbprefix'] = '';
$db['mips_logistik']['pconnect'] = TRUE;
$db['mips_logistik']['db_debug'] = TRUE;
$db['mips_logistik']['cache_on'] = FALSE;
$db['mips_logistik']['cachedir'] = '';
$db['mips_logistik']['char_set'] = 'utf8';
$db['mips_logistik']['dbcollat'] = 'utf8_general_ci';
$db['mips_logistik']['swap_pre'] = '{PRE}';
$db['mips_logistik']['autoinit'] = TRUE;
$db['mips_logistik']['stricton'] = FALSE;
// $db['mips_logistik']['hostname'] = '192.168.1.231';
// $db['mips_logistik']['username'] = 'mis';
// $db['mips_logistik']['password'] = 'msaljkt@88';
// $db['mips_logistik']['database'] = 'msalgrou_logistikmsal_arman';
// $db['mips_logistik']['dbdriver'] = 'mysqli';
// $db['mips_logistik']['dbprefix'] = '';
// $db['mips_logistik']['pconnect'] = TRUE;
// $db['mips_logistik']['db_debug'] = TRUE;
// $db['mips_logistik']['cache_on'] = FALSE;
// $db['mips_logistik']['cachedir'] = '';
// $db['mips_logistik']['char_set'] = 'utf8';
// $db['mips_logistik']['dbcollat'] = 'utf8_general_ci';
// $db['mips_logistik']['swap_pre'] = '{PRE}';
// $db['mips_logistik']['autoinit'] = TRUE;
// $db['mips_logistik']['stricton'] = FALSE;
/* END-DB-GL */


/* End of file database.php */
/* Location: ./application/config/database.php */