<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

// default database 
$db['default']['hostname'] = param('param_default_database_host');
$db['default']['username'] = param('param_default_database_username');
$db['default']['password'] = param('param_default_database_password');
$db['default']['database'] = param('param_default_database_database');
$db['default']['dbdriver'] = param('param_default_database_dbdriver');
$db['default']['dbprefix'] = param('param_default_database_dbprefix');
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

// default database 
$db['siebel']['hostname'] = param('param_default_database_host');
$db['siebel']['username'] = param('param_default_database_username');
$db['siebel']['password'] = param('param_default_database_password');
$db['siebel']['database'] = param('param_default_database_database');
$db['siebel']['dbdriver'] = param('param_default_database_dbdriver');
$db['siebel']['dbprefix'] = param('param_default_database_dbprefix');
$db['siebel']['pconnect'] = TRUE;
$db['siebel']['db_debug'] = TRUE;
$db['siebel']['cache_on'] = FALSE;
$db['siebel']['cachedir'] = '';
$db['siebel']['char_set'] = 'utf8';
$db['siebel']['dbcollat'] = 'utf8_general_ci';
$db['siebel']['swap_pre'] = '';
$db['siebel']['autoinit'] = TRUE;
$db['siebel']['stricton'] = FALSE;

// contactlist database 
$db['contact']['hostname'] = param('param_contact_database_host');
$db['contact']['username'] = param('param_contact_database_username');
$db['contact']['password'] = param('param_contact_database_password');
$db['contact']['database'] = param('param_contact_database_database');
$db['contact']['dbdriver'] = param('param_contact_database_dbdriver');
$db['contact']['dbprefix'] = param('param_contact_database_dbprefix');
$db['contact']['pconnect'] = TRUE;
$db['contact']['db_debug'] = TRUE;
$db['contact']['cache_on'] = FALSE;
$db['contact']['cachedir'] = '';
$db['contact']['char_set'] = 'utf8';
$db['contact']['dbcollat'] = 'utf8_general_ci';
$db['contact']['swap_pre'] = '';
$db['contact']['autoinit'] = TRUE;
$db['contact']['stricton'] = FALSE;

// ASW database 
$db['asw']['hostname'] = param('param_asw_database_host');
$db['asw']['username'] = param('param_asw_database_username');
$db['asw']['password'] = param('param_asw_database_password');
$db['asw']['database'] = param('param_asw_database_database');
$db['asw']['dbdriver'] = param('param_asw_database_dbdriver');
$db['asw']['dbprefix'] = param('param_asw_database_dbprefix');
$db['asw']['pconnect'] = TRUE;
$db['asw']['db_debug'] = TRUE;
$db['asw']['cache_on'] = FALSE;
$db['asw']['cachedir'] = '';
$db['asw']['char_set'] = 'utf8';
$db['asw']['dbcollat'] = 'utf8_general_ci';
$db['asw']['swap_pre'] = '';
$db['asw']['autoinit'] = TRUE;
$db['asw']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */