<?php
session_start();
unset($_SESSION['myvtclogin']);
header("location:index.php");