<?php

include("config.php");



$id = $_GET['id'];
$part_societe = $_GET['part_societe'];
$part_chauffeur = $_GET['part_chauffeur'];


$sql = mysql_query("update pourcentage set part_societe='" . $part_societe . "', part_chauffeur='" . $part_chauffeur . "' where id=" . $id)or die(mysql_error());

$rs = "[";

$rs.="{message:'ok'},";

$rs.="]";



echo $rs;
?>