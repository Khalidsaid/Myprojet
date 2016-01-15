<?php

$dbhost = '.mysql.db';
$dbuser = '';
$dbpass = '';
$dbname = '';

/* 
 *	Establish connection
 */ 
$con = new PDO('mysql:host='.$dbhost.'; dbname='.$dbname, $dbuser, $dbpass);  
$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$con->exec("SET CHARACTER SET utf8");