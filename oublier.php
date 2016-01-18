<?php
include("config.php");

function genererMDP($longueur = 8) {
    // initialiser la variable $mdp
    $mdp = "";

    // Définir tout les caractères possibles dans le mot de passe, 
    // Il est possible de rajouter des voyelles ou bien des caractères spéciaux
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    // obtenir le nombre de caractères dans la chaîne précédente
    // cette valeur sera utilisé plus tard
    $longueurMax = strlen($possible);

    if ($longueur > $longueurMax) {
        $longueur = $longueurMax;
    }

    // initialiser le compteur
    $i = 0;

    // ajouter un caractère aléatoire à $mdp jusqu'à ce que $longueur soit atteint
    while ($i < $longueur) {
        // prendre un caractère aléatoire
        $caractere = substr($possible, mt_rand(0, $longueurMax - 1), 1);

        // vérifier si le caractère est déjà utilisé dans $mdp
        if (!strstr($mdp, $caractere)) {
            // Si non, ajouter le caractère à $mdp et augmenter le compteur
            $mdp .= $caractere;
            $i++;
        }
    }

    // retourner le résultat final
    return $mdp;
}
?>
<!DOCTYPE HTML>
<!--
        Developer : Said KHALID, khalidsaid.box@gmail.com, 2015.
-->
<html>

    <head>
        <title>Mot de passe oublié</title>
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

                                            <blockquote style="text-align: left"><h3>Récupérer votre mot de passe oublié</h3></blockquote>
                                            <div class="col-sm-3" style="text-align: left">


                                            </div>
                                            <div class="col-sm-9">
                                                <?php
                                                if (isset($_POST['f1_email'])) {
                                                    $email = $_POST['f1_email'];
                                                    $sql = mysql_query("select * from myvtc_users where email='" . $email . "'");
                                                    $nb = mysql_num_rows($sql);
                                                    if ($nb > 0) {
                                                        $headers = 'From: info@reserveruncab.com' . "\r\n" .
                                                                'Reply-To: info@reserveruncab.com' . "\r\n" .
                                                                'X-Mailer: PHP/' . phpversion();
                                                        $new_pwd = genererMDP();
                                                        $pwd = md5($new_pwd);
                                                        mysql_query("update myvtc_users set pwd='" . $pwd . "' where email='" . $email . "'");
                                                        $msg = "Bonjour,\n\nVous avez demandé de ré-initialiser votre mot de passe.\n\nVotre nouvelle mot de passe est : " . $new_pwd . "\n\nCordialement,\nReserverUnCab.com Team. ";
                                                        mail($email, "Re-initialisation de mot de passe ReserverUnCab.com", $msg, $headers);
                                                        echo "<div style='clear: both; margin-bottom: 10px; color: rgb(68, 147, 186); font-style: italic;'>Un email vient d'être envoyer à votre boite de réception.</div>";
                                                    } else {
                                                        echo '<script>alert("Veuillez vérifier votre adresse mail ! ");</script>';
                                                    }
                                                }
                                                ?>
                                                <form action="" name="login-form" role="form" class="form-horizontal" method="post" accept-charset="utf-8">

                                                    <div style="margin-left: 0px; padding-left: 0px; padding-right: 10px;" class="col-md-9 col-xs-12">

                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon" style="color:rgb(64, 131, 196)">@</div>
                                                                <input class="form-control" type="email" name="f1_email" placeholder="Email" required="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-success" name="f1_button">Réinitialiser</button>

                                                </form>

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