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
$paiement = $_GET['paiement'];


//Ajout du client � la base si il n'a jamais command� par tel
if ($nom !="" or $tel !="" or $prenom!="")
{
	$new_client = mysql_fetch_array(mysql_query("insert into client_tel (nom, prenom, email, tel) values('".$nom."','".$prenom."','".$email."','".$tel."')");
	$client = mysql_insert_id();
	$nom ="";
	$tel =""; 
	$prenom="";
}

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

if ($client != "" or $client > 0)
{
$sql = mysql_query("Insert into reservation_tel(id_chauffeur, tel, part_societe ,part_chauffeur, depart, arrivee, prix, date_add, dtdeb, heure, valise, passager, client, siren, societe, type_vehicule, etat, notif, archive, paiement) values('".$chauffeur."','".$tel."', '".$part_societe."', '".$part_chauffeur."' , '".$depart."', '".$arrivee."', '".$prix."','" . date('d-m-Y') . "', '".$dtdeb."', '".$heure."', '".$valise."', '".$passager."','".$client."','".$siren."','".$societe."','".$type_vehicule."', 0, 1, 0,'".$paiement."';")) or die(mysql_error());
} else
{
$sql = mysql_query("Insert into reservation_tel(id_chauffeur, tel, part_societe ,part_chauffeur, depart, arrivee, prix, date_add, dtdeb, heure, valise, passager, client, siren, societe, type_vehicule, etat, notif, archive, paiement) values('".$chauffeur."','".$tel."', '".$part_societe."', '".$part_chauffeur."' , '".$depart."', '".$arrivee."', '".$prix."','" . date('d-m-Y') . "', '".$dtdeb."', '".$heure."', '".$valise."', '".$passager."',0,'".$siren."','".$societe."','".$type_vehicule."', 0, 1, 0,'".$paiement."';"))or die(mysql_error());
$sql2 = mysql_query("Insert into client_tel(nom, prenom, tel, email) values('".$nom."','".$prenom."','".$tel."','".$email."';"))or die(mysql_error());
}


$rs = "[";

$rs.="{message:'ok'},";

$rs.="]";



echo $rs;
?>