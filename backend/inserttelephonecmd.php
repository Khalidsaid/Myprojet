<?php

include("config.php");



$id = $_GET['id'];
$prenom = $_GET['prenom'];
$nom = $_GET['nom'];
$chauffeur_id = $_GET['chauffeur'];
$tel = $_GET['tel'];
$depart = $_GET['depart'];
$arrivee = $_GET['arrivee'];
$date = $_GET['heure'];
$heure = $_GET['heure'];
$prix = $_GET['prix'];
$dtdeb = $_GET['dtdeb'];
$type_user = $_GET['type_user'];
$part_societe = $_GET['part_societe'];
$part_chauffeur = $_GET['part_chauffeur'];

$nom_chauffeur = mysql_fetch_array(mysql_query("select * from chauffeur where id_chauffeur =" . $chauffeur_id));
$nom_complet = $nom_chauffeur['prenom'] . " " . $nom_chauffeur['nom'];

$headers = 'From: info@reserveruncab.com' . "\r\n" .
        'Reply-To: info@reserveruncab.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
$message = "Notification de réservation :\n

Type : " . $type_user . "\n
Nom : " . $nom . "\n
Prénom : " . $prenom . "\n
Téléphone: " . $tel . "\n
Départ : " . $depart . "\n
Arrivée : " . $arrivee . "\n
Prix : " . $prix . "\n
Date : " . $date . "\n
Heure : " . $heure . "\n
";
mail($nom_chauffeur['email'], "Notification sur ReserverUnCab.com", $message, $headers);



$sql = mysql_query("Insert into reservation_attente(notif, chauffeur, part_societe ,part_chauffeur, depart, arrivee, prix, date_add, passager, valise, dtdeb, heure, distance) values('".$notif."', '".$chauffeur_id."', '".$part_societe."', '".$part_chauffeur."' , '".$depart."', '".$arrivee."', '".$prix."', '".$date_add."', '".$passager."','".$valise."', '".$dtdeb."', '".$heure."','".$distance."';"))or die(mysql_error());

}
$rs = "[";

$rs.="{message:'ok'},";

$rs.="]";



echo $rs;
?>