<?php

include("config.php");



$id = $_GET['id'];
$prenom = $_GET['prenom'];
$nom = $_GET['nom'];
$chauffeur = $_GET['chauffeur'];
$tel = $_GET['tel'];
$depart = $_GET['depart'];
$arrivee = $_GET['arrivee'];
$heure = $_GET['heure'];
$prix = $_GET['prix'];
$dtdeb = $_GET['dtdeb'];
$valise = $_GET['valise'];
$passager = $_GET['passager'];
$part_societe = $_GET['part_societe'];
$part_chauffeur = $_GET['part_chauffeur'];
$client = $_GET['client'];
$siren = $_GET['siren'];
$societe = $_GET['societe'];
$type_vehicule = $_GET['box'];

$nom_chauffeur = mysql_fetch_array(mysql_query("select * from chauffeur where id_chauffeur =" . $chauffeur));
$nom_complet = $nom_chauffeur['prenom'] . " " . $nom_chauffeur['nom'];

$headers = 'From: info@reserveruncab.com' . "\r\n" .
        'Reply-To: info@reserveruncab.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
$message = "Notification de r�servation :\n


Nom : " . $nom . "\n
Pr�nom : " . $prenom . "\n
T�l�phone: " . $tel . "\n
D�part : " . $depart . "\n
Arriv�e : " . $arrivee . "\n
Prix : " . $prix . "\n
Date : " . $date . "\n
Heure : " . $heure . "\n
";
mail($nom_chauffeur['email'], "Notification sur ReserverUnCab.com", $message, $headers);



$sql = mysql_query("Insert into reservation_tel(id_chauffeur, tel, part_societe ,part_chauffeur, depart, arrivee, prix, date_add, dtdeb, heure, valise, passager, client, siren, societe, type_vehicule) values('".$chauffeur."','".$tel."', '".$part_societe."', '".$part_chauffeur."' , '".$depart."', '".$arrivee."', '".$prix."','" . date('d-m-Y') . "', '".$dtdeb."', '".$heure."', '".$valise."', '".$passager."','".$client."','".$siren."','".$societe."','".$type_vehicule."';"))or die(mysql_error());
echo $sql;
}
$rs = "[";

$rs.="{message:'ok'},";

$rs.="]";



echo $rs;
?>