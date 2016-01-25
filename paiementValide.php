<?php
include("config.php");
require_once 'autoload.inc.php';
require 'phpmailer/PHPMailerAutoload.php';



$reference = $_SESSION['reference'];
$user = mysql_fetch_array(mysql_query("select * from myvtc_users where email='" . $_SESSION['myvtclogin'] . "'"));
$ll = mysql_query("select reservation_attente.depart,reservation_attente.arrivee,reservation_attente.id,reservation_attente.dtdeb,reservation_attente.codecommande,reservation_attente.prix from myvtc_users inner join reservation_attente on reservation_attente.id_user = myvtc_users.id where  myvtc_users.id=" . $user['id'] . " order by reservation_attente.id desc limit 1")or die(mysql_error());
$commande = mysql_fetch_array($ll);
mysql_query("update reservation_attente set etat=1 where codecommande='" . $commande['codecommande'] . "'")or die(mysql_error());

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$chaine = utf8_encode('<table border="0" style="width:100%">
            <tr>
                <td colspan="2" style="text-align: center"><img src="http://www.reserveruncab.com/images/logo.png" alt="" /></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center"><h2>Facture N°</h2></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left"><br><br><br><br>Bonjour XXX,<br><br>Ci-dessous, vous trouvez le détail de votre commande : <br><br><br></td>
            </tr>
             <tr>
                 <td colspan="2" >
                     <table border="1" style="width:600px">
                         <tr>
                             <td style="height:25px; width:200px">Départ</td>
                             <td> Paris</td>
                         </tr>
                         <tr style="height:35px">
                             <td style="height:25px">Arrivé</td>
                             <td> Paris</td>
                         </tr>
                         <tr style="height:35px">
                             <td style="height:25px">Date</td>
                             <td> Paris</td>
                         </tr>
                         <tr style="height:35px">
                             <td style="height:25px">Heure</td>
                             <td> Paris</td>
                         </tr>
                         <tr style="height:35px">
                             <td style="height:25px">Prix</td>
                             <td> Paris</td>
                         </tr>
                     </table>
                 </td>
               
            </tr>
            <tr>
                <td colspan="2" style="text-align: center; padding-top:200px">L\'équipe ReserverUnCab.com</td>
            </tr>
        </table>');
$dompdf->loadHtml($chaine, 'UTF-8');


// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'paysage');

// Render the HTML as PDF
$dompdf->render();

// Get the generated PDF file contents
//$pdf = $dompdf->output();
 file_put_contents('Brochure.pdf', $dompdf->output());

// Output the generated PDF to Browser
$dompdf->stream();







$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'SSL0.OVH.NET';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'contact@reserveruncab.com';                 // SMTP username
$mail->Password = 'secret';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('contact@reserveruncab.com', 'ReserverUnCab');
$mail->addAddress($_SESSION['myvtclogin'], $user["prenom"]);     // Add a recipient


$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Validation de paiement ReserverUnCab.com';
$mail->Body = "Bonjour " . $user["prenom"] . ",

Fécilitation ! Votre paiement sur le site ReserverUnCab.com a été effectué avec succès.

Voici le détail de votre commande :\n
Départ : " . $commande['depart'] . "\n\n
Arrivée : " . $commande['arrivee'] . "\n\n
Prix : " . $commande['prix'] . "\n\n
Date : " . $commande['dtdeb'] . "\n\n

L'équipe ReserverUnCab.com.";
$mail->AltBody = '';

if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
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