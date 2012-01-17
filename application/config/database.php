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

$active_group = 'news';
$active_record = TRUE;



/*
$db['www']['hostname'] = '127.0.0.1';
$db['www']['username'] = 'root';
$db['www']['password'] = 'fdnq4u3A';
$db['www']['database'] = 'richard1_www';
$db['www']['dbdriver'] = 'mysql';
$db['www']['dbprefix'] = '';
$db['www']['pconnect'] = TRUE;
$db['www']['db_debug'] = TRUE;
$db['www']['cache_on'] = FALSE;
$db['www']['cachedir'] = '';
$db['www']['char_set'] = 'utf8';
$db['www']['dbcollat'] = 'utf8_general_ci';
$db['www']['swap_pre'] = '';
$db['www']['autoinit'] = TRUE;
$db['www']['stricton'] = FALSE;
*/
$db['news']['hostname'] = '127.0.0.1';
$db['news']['username'] = 'root';
$db['news']['password'] = 'fdnq4u3A';
$db['news']['database'] = 'richard1_news';
$db['news']['dbdriver'] = 'mysql';
$db['news']['dbprefix'] = '';
$db['news']['pconnect'] = TRUE;
$db['news']['db_debug'] = TRUE;
$db['news']['cache_on'] = FALSE;
$db['news']['cachedir'] = '';
$db['news']['char_set'] = 'utf8';
$db['news']['dbcollat'] = 'utf8_general_ci';
$db['news']['swap_pre'] = '';
$db['news']['autoinit'] = TRUE;
$db['news']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */