<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(

	//Default config - PostgresSQL
	'driver'       		=> 'Postgres',
	//Schema Name
	'database_name'		=> 'Xwood',
	//Table that contains your users and passwords
	'table_name'		=> 'Person',
	//Name of column User
	'column_user'  		=> 'username',
	//Name of column Password
	'column_password'  	=> 'password',
	//Method used to create the password(hash)
	'hash_method'  		=> 'sha1',
	//Cypher to create the password
	'hash_key'			=> '!!hashRenanKeyMurussi**',
	//Kohana Session
	'session_type' 		=> Session::$default,
	//Kohana Session Key
	'session_key'  		=> 'auth_user',

	/* //***************************
	//Default config Auth with FILES
	'driver'       => 'File',
	'hash_method'  => 'sha256',
	'hash_key'     => NULL,
	'lifetime'     => 1209600,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',

	// Username/password combinations for the Auth File driver
	'users' => array(
		// 'admin' => 'b3154acf3a344170077d11bdb5fff31532f679a1919e716a02',
	),
	*/

);
