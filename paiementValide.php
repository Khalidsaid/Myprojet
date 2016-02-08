<?php
include("config.php");
 
require 'phpmailer/class.phpmailer.php';

$reference = $_SESSION['reference'];
$user = mysql_fetch_array(mysql_query("select * from myvtc_users where email='" . $_SESSION['myvtclogin'] . "'"));
$ll = mysql_query("select reservation_attente.depart,reservation_attente.arrivee,reservation_attente.id,reservation_attente.dtdeb,reservation_attente.codecommande,reservation_attente.prix,reservation_attente.dtdeb,reservation_attente.heure from myvtc_users inner join reservation_attente on reservation_attente.id_user = myvtc_users.id where  myvtc_users.id=" . $user['id'] . " order by reservation_attente.id desc limit 1")or die(mysql_error());
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
$mail->Body    = "Bonjour " . $user["prenom"] . ",

Fécilitation ! Votre paiement sur le site ReserverUnCab.com a été effectué avec succès.

Voici le détail de votre commande :\n
Départ : " . $commande['depart'] . "\n\n
Arrivée : " . $commande['arrivee'] . "\n\n
Prix : " . $commande['prix'] . "\n\n
Date : " . $commande['dtdeb'] . "\n\n

L'équipe ReserverUnCab.com.";


$mail->AddAttachment("Facture_" . $commande['codecommande'] . ".pdf");  
   // Pour finir, on envoi l'e-mail
   $mail->send();

/*function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $file = $path . $filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $header = "From: " . $from_name . " <" . $from_mail . ">\r\n";
    $header .= "Reply-To: " . $replyto . "\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--" . $uid . "\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message . "\r\n\r\n";
    $header .= "--" . $uid . "\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n";
    $header .= $content . "\r\n\r\n";
    $header .= "--" . $uid . "--";
    if (mail($mailto, $subject, "", $header)) {
        echo "mail send ... OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
    }
}

$my_file = "Facture_" . $commande['codecommande'] . ".pdf";
$my_path = "http://reserveruncab.com/";
$my_name = "ReserverUnCab";
$my_mail = "contact@reserveruncab.com";
$my_replyto = "contact@reserveruncab.com";
$my_subject = "Validation de paiement ReserverUnCab.com‏";
$my_message = "Bonjour " . $user["prenom"] . ",

Fécilitation ! Votre paiement sur le site ReserverUnCab.com a été effectué avec succès.

Voici le détail de votre commande :\n
Départ : " . $commande['depart'] . "\n\n
Arrivée : " . $commande['arrivee'] . "\n\n
Prix : " . $commande['prix'] . "\n\n
Date : " . $commande['dtdeb'] . "\n\n

L'équipe ReserverUnCab.com.";
mail_attachment($my_file, $my_path, $_SESSION['myvtclogin'], $my_mail, $my_name, $my_replyto, $my_subject, $my_message);*/
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