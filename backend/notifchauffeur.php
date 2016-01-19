<?php

include("config.php");



$id = $_GET['id'];
$prenom = $_GET['prenom'];
$nom = $_GET['nom'];
$chauffeur = $_GET['chauffeur'];
$tel = $_GET['tel'];
$depart = $_GET['depart'];
$arrivee = $_GET['arrivee'];
$date = $_GET['heure'];
$heure = $_GET['heure'];
$prix = $_GET['prix'];

$headers = 'From: info@reserveruncab.com' . "\r\n" .
        'Reply-To: info@reserveruncab.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
$message = "Notification de réservation :\n

Nom : " . $nom . "\n
Prénom : " . $prenom . "\n
Téléphone: " . $tel . "\n
Départ : " . $depart . "\n
Arrivée : " . $arrivee . "\n
Prix : " . $prix . "\n
Date : " . $date . "\n
Heure : " . $heure . "\n
";
mail($chauffeur, "Notification sur ReserverUnCab.com", $message, $headers);

$sql = mysql_query("update reservation set notif=1,chauffeur='".$chauffeur."' where id=" . $id)or die(mysql_error());

$rs = "[";

$rs.="{message:'ok'},";

$rs.="]";



echo $rs;
?>