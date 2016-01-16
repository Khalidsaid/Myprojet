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

$sql = mysql_query("update users set prenom='" . $prenom . "', nom='" . $nom . "', cp='" . $cp . "', adresse='" . $adresse . "', ville='" . $ville . "', email='" . $email . "', promos='" . $promos . "' where id_user=" . $id)or die(mysql_error());

$rs = "[";

$rs.="{message:'ok'},";

$rs.="]";



echo $rs;
?>