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
$type_vehicule = $_GET['type_vehicule'];
$paiement = $_GET['paiement'];
$note = $_GET['note'];


//Ajout du client à la base si il n'a jamais command� par tel
if ($nom != "" or $tel != "" or $prenom != "") {

    $new_client = mysql_fetch_array(mysql_query("insert into client_tel (nom, prenom, email, tel) values('" . $nom . "','" . $prenom . "','" . $email . "','" . $tel . "')"));

    $client = mysql_insert_id();
    $nom = "";
    $tel = "";
    $prenom = "";
}

$nom_chauffeur = mysql_fetch_array(mysql_query("select * from chauffeur where id_chauffeur =" . $chauffeur));
$nom_complet = $nom_chauffeur['prenom'] . " " . $nom_chauffeur['nom'];



if ($client != "" or $client > 0) {

    $sql = mysql_query("INSERT INTO `reserverrzad`.`reservation_tel` ( `depart`, `arrivee`, `tel`, `prix`, `part_chauffeur`, `part_societe`, `dtdeb`, `date_add`, `heure`, `societe`, `siren`, `id_chauffeur`, `passager`, `valise`, `type_vehicule`, `client`, `etat`, `notif`, `archive`, `paiement`) VALUES ( '" . $depart . "', '" . $arrivee . "', '" . $tel . "', '" . $prix . "', '" . $part_chauffeur . "', '" . $part_societe . "', '" . $dtdeb . "', '" . date('Y-m-d') . "', '" . $heure . "', '" . $societe . "', '" . $siren . "', " . $chauffeur . ", " . $passager . ", " . $valise . ", " . $type_vehicule . ", '" . $client . "', 0, 1, 0, '" . $paiement . "');") or die(mysql_error());
    $id_cmd = mysql_insert_id();
    $ll = mysql_query("select client_tel.nom,client_tel.prenom,client_tel.type_user,client_tel.tel, reservation_tel.depart,reservation_tel.arrivee,reservation_tel.id as id_cmd,reservation_tel.dtdeb,reservation_tel.prix,reservation_tel.dtdeb,client_tel.email,reservation_tel.heure,reservation_tel.passager,reservation_tel.valise from client_tel inner join reservation_tel on reservation_tel.client = client_tel.id where  reservation_tel.id=" . $id_cmd . " order by reservation_tel.id desc limit 1")or die(mysql_error());
    $commande = mysql_fetch_array($ll);

    $headers = 'From: contact@reserveruncab.com' . "\r\n" .
            'Reply-To: contact@reserveruncab.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    $message = "Notification de réservation :\n
Client : " . $commande['type_user'] . ": " . $commande['prenom'] . " " . $commande['nom'] . "\n
Téléphone : " . $commande['tel'] . "\n
Date : " . $commande['dtdeb'] . "\n
Heure : " . $commande['heure'] . "\n
Départ : " . $commande['depart'] . "\n
Arrivée : " . $commande['arrivee'] . "\n
Prix : " . $commande['prix'] . "\n
Passagers : " . $commande['passager'] . "\n
Valises : " . $commande['valise'] . "\n
    ";
    mail($nom_chauffeur['email'], "Notification sur ReserverUnCab.com", $message, $headers);
} else {

    $sql = mysql_query("Insert into reservation_tel(id_chauffeur, tel, part_societe ,part_chauffeur, depart, arrivee, prix, date_add, dtdeb, heure, valise, passager, client, siren, societe, type_vehicule, etat, notif, archive, paiement, ,note) values('" . $chauffeur . "','" . $tel . "', '" . $part_societe . "', '" . $part_chauffeur . "' , '" . $depart . "', '" . $arrivee . "', '" . $prix . "','" . date('d-m-Y') . "', '" . $dtdeb . "', '" . $heure . "', '" . $valise . "', '" . $passager . "',0,'" . $siren . "','" . $societe . "','" . $type_vehicule . "', 0, 1, 0,'" . $paiement . "','" . $note . "';")or die(mysql_error());
    $id_cmd = mysql_insert_id();
    $sql2 = mysql_query("Insert into client_tel(nom, prenom, tel, email) values('" . $nom . "','" . $prenom . "','" . $tel . "','" . $email . "';")or die(mysql_error());
    $ll = mysql_query("select client_tel.nom,client_tel.prenom,client_tel.type_user,client_tel.tel, reservation_tel.depart,reservation_tel.arrivee,reservation_tel.id as id_cmd,reservation_tel.dtdeb,reservation_tel.prix,reservation_tel.dtdeb,client_tel.email,reservation_tel.heure,reservation_tel.passager,reservation_tel.valise from client_tel inner join reservation_tel on reservation_tel.client = client_tel.id where  reservation_tel.id=" . $id_cmd . " order by reservation_tel.id desc limit 1")or die(mysql_error());
    $commande = mysql_fetch_array($ll);

    $headers = 'From: contact@reserveruncab.com' . "\r\n" .
            'Reply-To: contact@reserveruncab.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    $message = "Notification de réservation :\n
Client : " . $commande['type_user'] . ": " . $commande['prenom'] . " " . $commande['nom'] . "\n
Téléphone : " . $commande['tel'] . "\n
Date : " . $commande['dtdeb'] . "\n
Heure : " . $commande['heure'] . "\n
Départ : " . $commande['depart'] . "\n
Arrivée : " . $commande['arrivee'] . "\n
Prix : " . $commande['prix'] . "\n
Passagers : " . $commande['passager'] . "\n
Valises : " . $commande['valise'] . "\n
    ";
    mail($nom_chauffeur['email'], "Notification sur ReserverUnCab.com", $message, $headers);
}



$rs = "[";

$rs.="{id:'" . $id_cmd . "'},";

$rs.="]";



echo $rs;
?>