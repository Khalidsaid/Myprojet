<?php
include("config.php");

$reference = $_SESSION['reference'];
$user = mysql_fetch_array(mysql_query("select * from myvtc_users where email='" . $_SESSION['myvtclogin'] . "'"));
$ll=mysql_query("select reservation_attente.depart,reservation_attente.arrivee,reservation_attente.id,reservation_attente.dtdeb,reservation_attente.codecommande,reservation_attente.prix from myvtc_users inner join reservation_attente on reservation_attente.id_user = myvtc_users.id where  myvtc_users.id=" .$user['id']. " order by reservation_attente.id desc limit 1")or die(mysql_error());
$commande = mysql_fetch_array($ll);
mysql_query("update reservation_attente set etat=1 where codecommande='" . $commande['codecommande'] . "'")or die(mysql_error());

$headers = 'From: contact@reserveruncab.com' . "\r\n" .
        'Reply-To: contact@reserveruncab.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

$message = "Bonjour " . $user["prenom"] . ",

Fécilitation ! Votre paiement sur le site ReserverUnCab.com a été effectué avec succès.

Votre détail commande est comme suit :\n
Départ : ".$commande['depart']."\n\n
Arrivée : ".$commande['arrivee']."\n\n
Prix : ".$commande['prix']."\n\n
Date : ".$commande['dtdeb']."\n\n

L'équipe ReserverUnCab.com.";
mail($_SESSION['myvtclogin'], "Validation de paiement ReserverUnCab.com", $message, $headers);
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

                                            <blockquote style="text-align: left"><h3>Paiement validé</h3></blockquote>
                                            
                                            <div class="col-sm-12">

                                                <p>Merci pour votre confiance.</p>
                                                <p>Votre commande a été payée. Vous recevez un mail de confirmation sur votre boite de messagerie.</p>
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
        <script type="text/javascript">
            var geocoder = new google.maps.Geocoder();
            var address = "41, RUE AUGUSTIN HENRY Elbeuf France"; //Add your address here, all on one line.
            var latitude;
            var longitude;
            var color = "#ffffff"; //Set your tint color. Needs to be a hex value.

            function getGeocode() {
                geocoder.geocode({'address': address}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        latitude = results[0].geometry.location.lat();
                        longitude = results[0].geometry.location.lng();
                        initGoogleMap();
                    }
                });
            }

            function initGoogleMap() {
                var styles = [
                    {
                        stylers: [
                            {saturation: -100}
                        ]
                    }
                ];

                var options = {
                    mapTypeControlOptions: {
                        mapTypeIds: ['Styled']
                    },
                    center: new google.maps.LatLng(latitude, longitude),
                    zoom: 13,
                    scrollwheel: false,
                    navigationControl: false,
                    mapTypeControl: false,
                    zoomControl: true,
                    disableDefaultUI: true,
                    mapTypeId: 'Styled'
                };
                var div = document.getElementById('contact-map');
                var map = new google.maps.Map(div, options);
                marker = new google.maps.Marker({
                    map: map,
                    draggable: false,
                    animation: google.maps.Animation.DROP,
                    position: new google.maps.LatLng(latitude, longitude)
                });
                var styledMapType = new google.maps.StyledMapType(styles, {name: 'Styled'});
                map.mapTypes.set('Styled', styledMapType);

                var infowindow = new google.maps.InfoWindow({
                    content: "<div class='iwContent'>" + address + "</div>"
                });
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });


                bounds = new google.maps.LatLngBounds(
                        new google.maps.LatLng(-49.29104050000001, -1.0055671999999731),
                        new google.maps.LatLng(49.29104050000001, 1.0055671999999731));

                rect = new google.maps.Rectangle({
                    bounds: bounds,
                    fillColor: color,
                    fillOpacity: 0.2,
                    strokeWeight: 0,
                    map: map
                });
            }
            google.maps.event.addDomListener(window, 'load', getGeocode);</script>
    </body>

</html>