<?php

include("config.php");

$etat = $_GET['etat'];
//$nom_chauffeur = mysql_fetch_array(mysql_query("select * from etat_boutique");

$sql = mysql_query("update etat_boutique set etat='" . $etat . "' ")or die(mysql_error());

$rs = "[";

$rs.="{message:'ok'},";

$rs.="]";



echo $rs;

?>