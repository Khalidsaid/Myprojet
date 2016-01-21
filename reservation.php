<?php

include("config.php");
$user = mysql_fetch_array(mysql_query("select * from myvtc_users where email='" . $_SESSION['myvtclogin'] . "'"));
$id_user = $user['id'];
$prix = $_GET['price'];

mysql_query("update reservation_attente set id_user=" . $id_user . ",prix='" . $prix . "' where codecommande='" . $_SESSION['reference'] . "'")or die(mysql_error());


$rs = "[";

$rs.="{message:'ok'},";

$rs.="]";



echo $rs;
?>