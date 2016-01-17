<?php
session_start();
$dbroot='reserverrzad.mysql.db';
$dbuser='reserverrzad';
$dbpass='H6JVXGp5GSKG';
$dbname='reserverrzad';

$link =@mysql_connect($dbroot,$dbuser,$dbpass);
mysql_select_db("$dbname");
mysql_query("SET NAMES 'utf8'");
?>