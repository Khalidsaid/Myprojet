<?php
include("config.php");
 
require 'phpmailer/class.phpmailer.php';

$id_cmd = $_GET['id'];
//$user = mysql_fetch_array(mysql_query("select * from client_tel where email='" . $_SESSION['myvtclogin'] . "'"));
$ll = mysql_query("select reservation_tel.depart,reservation_tel.arrivee,reservation_tel.id as id_cmd,reservation_tel.dtdeb,reservation_tel.prix,reservation_tel.dtdeb,client_tel.email,reservation_tel.heure from client_tel inner join reservation_tel on reservation_tel.client = client_tel.id where  client_tel.id=" . $_GET['id'] . " order by reservation_tel.id desc limit 1")or die(mysql_error());
$commande = mysql_fetch_array($ll);

$mail = new PHPMailer;


$mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
$mail->Port = 26;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'contact@reserveruncab.com';                // SMTP username
$mail->Password = 'Balloo94';                  // SMTP password
                           // Enable encryption, 'ssl' also accepted

$mail->From = 'contact@reserveruncab.com';
$mail->FromName = 'ReserverUnCab';
$mail->AddAddress($_SESSION['myvtclogin'], "Confirmation"); // Add address


$mail->Subject = 'Validation de paiement ReserverUnCab.com';
$mail->Body    = "Bonjour,

Fécilitation ! Votre paiement sur le site ReserverUnCab.com a été effectué avec succès.

Voici le détail de votre commande :\n
Départ : " . $commande['depart'] . "\n\n
Arrivée : " . $commande['arrivee'] . "\n\n
Prix : " . $commande['prix'] . "\n\n
Date : " . $commande['dtdeb'] . "\n\n

L'équipe ReserverUnCab.com.";


$mail->AddAttachment("Facture_" . $commande['id_cmd'] . ".pdf");  
   // Pour finir, on envoi l'e-mail
   $mail->send();

?>
<!DOCTYPE HTML>
<!--
        Developer : Said KHALID, khalidsaid.box@gmail.com, 2015.
-->
<html>

    <head>
        <title>Validation de paiement</title>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!-- BooStrap -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.css" />

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery-1.11.0.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript" LANGUAGE="JavaScript"></script>


        <link rel="stylesheet" href="css/datepicker3.css" />
        <style>
            form input {padding-bottom: 0px !important; padding-top: 0px !important;}

        </style>
    </head>

    <body  class="homepage">
        <div id="page-wrapper">

            <!-- Header -->
            <div id="header-wrapper">
                <div id="header">

                    <!-- Logo -->
                    <h3><img src="images/logo.png"/></h3>

                    <!-- Nav -->
                    <?php include("module/menu.php"); ?>

                    <?php include("module/connexion.php"); ?>
                    <!-- Banner -->
                    <hr>
                    <div class="container">
                        <div class="row" style="margin-top: 0px;">
                            <div class="col-xs-12">

                                <div class="main">

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-11 col-sm-offset-1">

                                            <blockquote style="text-align: center"><h3>Paiement validé</h3></blockquote>

                                            <div class="col-sm-12">

                                                <p>Merci pour votre confiance.</p>
                                                <p>Votre commande a été validée. Vous receverez un mail de confirmation sur votre boite de messagerie.</p>
                                                <p>Cliquer <a href="http://reserveruncab.com/">ici</a> pour retourner à la page d'accueil.</p>

                                            </div>

                                        </div> 
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>







                </div>
            </div>

            <!-- Main -->


            <!-- Footer -->
            <?php include("module/footer.php"); ?>

        </div>

        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.dropotron.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/skel-viewport.min.js"></script>
        <script src="assets/js/util.js"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <script src="assets/js/main.js"></script>
        <script src="css/moment-with-locales.js" type="text/javascript" LANGUAGE="JavaScript"></script>
        <script src="css/bootstrap-datetimepicker.js" type="text/javascript" LANGUAGE="JavaScript"></script>
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

    </body>

</html>