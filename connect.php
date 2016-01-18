<?php

include("config.php");
$login = $_GET['login'];
$pwd = $_GET['pwd'];
$password = md5($pwd);
$sql = mysql_query("select *  from myvtc_users where email='" . $login . "' and pwd='" . $password . "'")or die(mysql_error());
$nb = mysql_num_rows($sql);
if ($nb > 0) {
    $data = mysql_fetch_array($sql);

    $etat = $data['status'];
    if ($etat == 1)
        $_SESSION['myvtclogin'] = $login;
    $rs = "[";

    $rs.="{message:'ok',etat:'" . $etat . "'},";

    $rs.="]";
} else {
    $rs = "[";

    $rs.="{message:'ko'},";

    $rs.="]";
}


echo $rs;
?>