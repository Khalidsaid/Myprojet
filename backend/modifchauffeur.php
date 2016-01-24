<?php

include("config.php");



$id = $_GET['id'];
$prenom = $_GET['prenom'];
$nom = $_GET['nom'];
$adresse = $_GET['adresse'];
$email = $_GET['email'];
$tel = $_GET['tel'];
$typevehicule = $_GET['typevehicule'];


$sql = mysql_query("update chauffeur set prenom='" . $prenom . "', nom='" . $nom . "',adresse='" . $adresse . "', email='" . $email . "',  tel='" . $tel . "',typevehicule='" . $typevehicule . "' where id_chauffeur=" . $id)or die(mysql_error());

$rs = "[";

$rs.="{message:'ok'},";

$rs.="]";



echo $rs;
?>