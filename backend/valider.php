<?php

include("config.php");



$id = $_GET['id'];
$sql = mysql_query("update reservation_attente set etat=1 where id=" . $id)or die(mysql_error());

$rs = "[";

$rs.="{message:'ok'},";

$rs.="]";



echo $rs;
?>