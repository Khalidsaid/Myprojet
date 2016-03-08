<?php
include("config.php");
require 'phpmailer/class.phpmailer.php';


$user = mysql_fetch_array(mysql_query("select * from myvtc_users where email='" . $_SESSION['myvtclogin'] . "'"));
$ll = mysql_query("select reservation_attente.depart,reservation_attente.arrivee,reservation_attente.id,DATE_FORMAT(reservation_attente.dtdeb, '%d/%m/%Y') as dtdeb,reservation_attente.codecommande,reservation_attente.prix,reservation_attente.heure from myvtc_users inner join reservation_attente on reservation_attente.id_user = myvtc_users.id where  myvtc_users.id=" . $user['id'] . " order by reservation_attente.id desc limit 1")or die(mysql_error());
$commande = mysql_fetch_array($ll);

mysql_query("update reservation_attente set etat=1 where codecommande='" . $commande['codecommande'] . "'")or die(mysql_error());

// reference the Dompdf namespace
//use Dompdf\Dompdf;

// instantiate and use the dompdf class
//$dompdf = new Dompdf();
$chaine = utf8_encode('<table border="0" style="width:100%">
            <tr>
                <td colspan="2" style="margin-right: 50px;"><img src="http://www.reserveruncab.com/images/logo.png" alt="" /></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center"><h2>Facture N&deg; ' . $commande['codecommande'] . '</h2></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left"><br><br><br><br>Bonjour ' . $user["prenom"] . ',<br><br>Ci-dessous, vous trouvez le d&eacute;tail de votre commande : <br><br><br></td>
            </tr>
             <tr>
                 <td colspan="2" >
                     <table border="1" style="width:600px">
                         <tr>
                             <td style="height:25px; width:200px">D&eacute;part</td>
                             <td> ' . $commande['depart'] . '</td>
                         </tr>
                         <tr style="height:35px">
                             <td style="height:25px">Arriv&eacute;e</td>
                             <td> ' . $commande['arrivee'] . '</td>
                         </tr>
                         <tr style="height:35px">
                             <td style="height:25px">Date</td>
                             <td> ' . $commande['dtdeb']  . '</td>
                         </tr>
                         <tr style="height:35px">
                             <td style="height:25px">Heure</td>
                             <td> ' . $commande['heure'] . '</td>
                         </tr>
                         <tr style="height:35px">
                             <td style="height:25px">Prix TTC</td>
                             <td> ' . $commande['prix'] . ' euros</td>
                         </tr>
                     </table>
                 </td>
               
            </tr>
            <tr>
                <td colspan="2" style="margin-right: 50px; padding-top:200px">L\'&eacute;quipe ReserverUnCab.com</td>
            </tr>
        </table>');
//$dompdf->loadHtml($chaine, 'UTF-8');
   

    require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($chaine);
    $content_PDF = $html2pdf->Output('', true);
	file_put_contents('Facture_' . $commande["codecommande"] . '.pdf', $content_PDF);
	

// (Optional) Setup the paper size and orientation
//$dompdf->setPaper('A4', 'paysage');

// Render the HTML as PDF
//$dompdf->render();

// Get the generated PDF file contents
//$pdf = $dompdf->output();
//file_put_contents('Facture_' . $commande["codecommande"] . '.pdf', $dompdf->output());

//$mail->IsSMTP();                                // Set mailer to use SMTP
$mail->Host = 'SSL0.OVH.NET';                 // Specify main and backup server
$mail->Port = 465; 

$mail = new PHPMailer;

$mail->IsHTML(true); 
$mail->CharSet = 'UTF-8';  
$mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
$mail->Port = 26;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'contact@reserveruncab.com';                // SMTP username
$mail->Password = 'Balloo94';                  // SMTP password
                           // Enable encryption, 'ssl' also accepted

$adresse_destinataire = 'contact@reserveruncab.com';						   
$mail->From = 'contact@reserveruncab.com';
$mail->FromName = 'ReserverUnCab';
//$mail->AddBCC($adresse_destinataire, $adresse_destinataire);
$mail->AddAddress($_SESSION['myvtclogin'], $_SESSION['myvtclogin']); // Add address


$mail->Subject = 'Validation de paiement ReserverUnCab.com';
$mail->Body    = "Bonjour " . $user["prenom"] . ",<br><br>

F&eacute;cilitation ! Votre paiement sur le site ReserverUnCab.com a &eacute;t&eacute; effectu&eacute; avec succ&egrave;s.<br><br>

Voici le d&eacute;tail de votre commande :<br><br>
Date : " . $commande['dtdeb'] ." à ".$commande['heure']. "<br><br>
D&eacute;part : " . $commande['depart'] . "<br><br>
Arriv&eacute;e : " . $commande['arrivee'] . "<br><br>
Prix : " . $commande['prix'] . "€<br><br>

L'&eacute;quipe ReserverUnCab.com.";


$mail->AddAttachment("Facture_" . $commande['codecommande'] . ".pdf");  
   // Pour finir, on envoi l'e-mail
   //$mail->send();
   
// Idem pour le chauffeur

$mail2->Host = 'SSL0.OVH.NET';                 // Specify main and backup server
$mail2->Port = 465; 

$mail2 = new PHPMailer;

$mail2->IsHTML(true); 
$mail2->CharSet = 'UTF-8';  
$mail2->Host = 'smtp.gmail.com';                 // Specify main and backup server
$mail2->Port = 26;                                    // Set the SMTP port
$mail2->SMTPAuth = true;                               // Enable SMTP authentication
$mail2->Username = 'contact@reserveruncab.com';                // SMTP username
$mail2->Password = 'Balloo94';      
$adresse_destinataire = 'contact@reserveruncab.com';						   
$mail2->From = 'contact@reserveruncab.com';
$mail2->FromName = 'ReserverUnCab';
$mail2->AddAddress($adresse_destinataire, $adresse_destinataire); // Add address


$mail2->Subject = 'Notification de reservation ReserverUnCab.com';
$mail2->Body    = "Salam Alaykoum,<br><br>

Cher Chauffeur, Une reservation sur le site ReserverUnCab.com a &eacute;t&eacute; effectu&eacute; avec succ&egrave;s !<br><br>

Voici le d&eacute;tail de la commande :<br><br>

Type: " . $user["type_user"] . " <br><br>
Client : " . $user["prenom"] . "<br><br>
Tel : " . $user["tel"] . " <br><br>
Date : " . $commande['dtdeb'] ." à ".$commande['heure']. "<br><br>
D&eacute;part : " . $commande['depart'] . "<br><br>
Arriv&eacute;e : " . $commande['arrivee'] . "<br><br>
Prix : " . $commande['prix'] . "€<br><br>

L'&eacute;quipe ReserverUnCab.com.";


   // Pour finir, on envoi l'e-mail
   //$mail2->send();  


?>
<!DOCTYPE HTML>
<!--
        Developer : Said KHALID, khalidsaid.box@gmail.com, 2015.
-->
<html>

    <head>
        <title>Validation de paiement</title>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
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