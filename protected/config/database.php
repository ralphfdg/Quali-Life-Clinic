<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	'connectionString' => 'mysql:host=localhost;dbname=qualilife_db',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	'tablePrefix' => 'tbl_',

	// 3. Disable database profiling/logging for performance
    'enableProfiling' => false,
    'enableParamLogging' => false,
);