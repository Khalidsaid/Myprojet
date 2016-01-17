<?php

$dbhost = 'reserverrzad.mysql.db';
$dbuser = 'reserverrzad';
$dbpass = 'H6JVXGp5GSKG';
$dbname = 'reserverrzad';

/* 
 *	Establish connection
 */ 
$con = new PDO('mysql:host='.$dbhost.'; dbname='.$dbname, $dbuser, $dbpass);  
$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$con->exec("SET CHARACTER SET utf8");