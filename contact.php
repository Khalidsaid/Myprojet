<?php
include("config.php");
?>
<!DOCTYPE HTML>
<!--
        Developer : Said KHALID, khalidsaid.box@gmail.com, 2015.
-->
<html>

    <head>
        <title>Contact</title>
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
                                    <?php
                                    if (isset($_POST['nom'])) {
                                        $nom = addslashes($_POST['nom']);
                                        $prenom = addslashes($_POST['prenom']);
                                        $email = addslashes($_POST['email']);
                                        $sujet = addslashes($_POST['sujet']);
                                        $msg = addslashes($_POST['msg']);
                                        $dt=date("Y-m-d H:i:s");
                                        

                                        $verif = mysql_query("insert into contact(nom,prenom,email,sujet,msg,dt)values('".$nom."','".$prenom."','".$email."','".$sujet."','".$msg."','".$dt."')")or die(mysql_error());
                                       
                                     
                                            echo "<script>alert('Message envoyé !');</script>";
                                       
                                         
                                            echo "<script>window.location='contact.php'</script>";
                                        
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-11 col-sm-offset-1">

                                            <blockquote style="text-align: left"><h3>Contact</h3></blockquote>
                                            <div class="col-sm-3 well" style="text-align: left">
                                                <i class="fa fa-home"></i></span> <b>ReserverUnCab.com</b><br>
                                                41, RUE AUGUSTIN HENRY <br>
                                                Elbeuf France<br><br>
                                                <i class="fa fa-phone"></i> <b>02 35 76 52 80</b><br>

                                                <i class="fa fa-envelope"></i> <a href="mailto:info@reserveruncab.com">info@reserveruncab.com</a><br><br>
                                                <i class="fa fa-home"></i>Horaires :<br><b><span style="font-weight: bold">Lundi</span> <br>14:00 – 18:30</b><br>
                                                <b><span style="font-weight: bold">Mardi - Vendredi</span> <br>09:30 – 12:30, 14:00 – 18:30</b><br>
                                                <b><span style="font-weight: bold">Samedi</span> <br>10:00 – 12:30, 13:30 – 16:30</b><br>
                                                <b><span style="font-weight: bold">Dimanche</span> <br>Fermé</b><br>

                                            </div>
                                            <div class="col-sm-9">
                                                <form action="" name="login-form" role="form" class="form-horizontal" method="post" accept-charset="utf-8">

                                                    <div class="form-group">
                                                        <div class="col-md-7"><input name="nom" placeholder="Nom *" class="form-control" type="text" id="nom" required=""/></div>
                                                    </div> 

                                                    <div class="form-group">
                                                        <div class="col-md-7"><input name="prenom" placeholder="Prénom *" class="form-control" type="text" id="prenom" required=""/></div>
                                                    </div> 
                                                    <div class="form-group">
                                                        <div class="col-md-7"><input name="email" placeholder="Email *" class="form-control" type="email" id="email" required=""/></div>
                                                    </div> 
                                                    <div class="form-group">
                                                        <div class="col-md-7"><input name="tel" placeholder="Téléphone *" class="form-control" type="text" id="tel" required=""/></div>
                                                    </div> 
                                                    <div class="form-group">
                                                        <div class="col-md-7"><input name="sujet" placeholder="Votre sujet" class="form-control" type="text" id="sujet"/></div>
                                                    </div> 
                                                    <div class="form-group">
                                                        <div class="col-md-7"><textarea class="form-control" id="msg" name="msg" placeholder="Votre message *" required=""></textarea></div>
                                                    </div> 

                                                    <div class="form-group">
                                                        <div class="col-md-7 col-sm-offset-3">
                                                            <button  class="btn btn-success btn-lg" type="submit">Envoyer </button>

                                                        </div>
                                                    </div>
                                                    <hr>

                                                </form>
                                                <div class="page-header parallax">
                                                    <div id="contact-map" style="width:100%;height:300px"></div>
                                                </div>
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