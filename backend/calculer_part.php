<?php

include("config.php");
$prix = $_GET['prix'];



$pourcentage = mysql_fetch_array(mysql_query("select * from pourcentage where id=1"));
$part_societe = ($prix * $pourcentage['part_societe']) / 100;
$part_chauffeur = ($prix * $pourcentage['part_chauffeur']) / 100;

$rs = "[";
$rs.="{part_societe:'" . $part_societe . "',part_chauffeur:'" . $part_chauffeur . "'},";
$rs.="]";

echo $rs;
?>