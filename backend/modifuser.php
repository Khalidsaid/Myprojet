<?php

include("config.php");



$id = $_GET['id'];
$prenom = $_GET['prenom'];
$nom = $_GET['nom'];
$cp = $_GET['cp'];
$adresse = $_GET['adresse'];
$ville = $_GET['ville'];
$email = $_GET['email'];
$parrain = $_GET['parrain'];
$promos = $_GET['promos'];
$type_user = $_GET['type_user'];
$societe = $_GET['societe'];
$fax = $_GET['fax'];
$url = $_GET['url'];
$siren = $_GET['siren'];
$tva = $_GET['tva'];

$sql = mysql_query("update myvtc_users set prenom='" . $prenom . "', nom='" . $nom . "', cp='" . $cp . "', adresse='" . $adresse . "', ville='" . $ville . "',  promos='" . $promos . "',type_user='" . $type_user . "',societe='" . $societe . "',fax='" . $fax . "',url='" . $url . "',siren='" . $siren . "',tva='" . $tva . "' where id=" . $id)or die(mysql_error());

$rs = "[";

$rs.="{message:'ok'},";

$rs.="]";



echo $rs;
?>