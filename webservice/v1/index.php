<?php
// Requires database files
require '../connect.php';
require '../RESTServer.php';

// Imports WS classes

require 'users/Users.php';


$server = new RESTServer('debug');
$server->addClass('Users');
$server->handle();
