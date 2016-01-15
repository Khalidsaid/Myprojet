<?php

function getNomUser($login) {
    $sql = mysql_query("select * from users where email='" . $login . "'");
    $data = mysql_fetch_array($sql);
    return ucfirst($data['firstname']) . " " . strtoupper($data['lastname']);
}

?>