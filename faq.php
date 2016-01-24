<?php
include("config.php");
$menu=3;
?>
<!DOCTYPE HTML>
<!--
        Developer : Said KHALID, khalidsaid.box@gmail.com, 2015.
-->
<html>

    <head>
        <title>FAQ</title>
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
        <style>
            .accordion-toggle {cursor: pointer;}
            .accordion-content {display: none;}
            .accordion-content.default {display: block;}
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

                                            <blockquote style="text-align: left"><h3>FAQ</h3></blockquote>

                                            <div class="col-sm-12" style="text-align: left; margin-left: 0px; padding-left: 35px;">
                                                <div id="accordion">
                                                    <h4 class="accordion-toggle" style="background-color: rgb(238, 238, 238); padding: 10px; color: #1E4F93"> <i class="fa fa-question-circle"></i> Etes-vous un taxi?</h4>
                                                    <div class="accordion-content default">
                                                        <p style="padding-left: 25px; text-align: justify;">Nous sommes une société qui propose un service de Voiture de Tourisme avec Chauffeur (VTC). Contrairement à un taxi, nous fonctionnons uniquement par réservation (immédiate ou à l'avance). Nos chauffeurs ont une carte professionnelle de chauffeur de VTC et non une licence de taxi. Cependant ils ont tous une expérience significative dans le transport de personnes (certaines sont d'anciens chauffeurs de taxi) et suivi une formation au Premier Secours (PSC1). Nos véhicules ne sont pas équipés de compteurs. Le prix des courses est déterminé lors de la réservation, et contrairement au taxi, le prix d'une course entre deux points est toujours le même.</p>
                                                    </div>
                                                    <h4 class="accordion-toggle" style="background-color: rgb(238, 238, 238); padding: 10px; color: #1E4F93"> <i class="fa fa-question-circle"></i> Pourquoi demandez-vous un numéro de portable?</h4>
                                                    <div class="accordion-content">
                                                        <p style="padding-left: 25px; text-align: justify;">Afin de confirmer votre réservation, de vous prévenir par SMS de l'arrivée de votre voiture et pour que vous soyez en mesure de communiquer facilement avec votre chauffeur en cas de nécessité.</p>
                                                    </div>
                                                    <h4 class="accordion-toggle" style="background-color: rgb(238, 238, 238); padding: 10px; color: #1E4F93"> <i class="fa fa-question-circle"></i> Mon vol à pris du retard, m'attendrez-vous?</h4>
                                                    <div class="accordion-content">
                                                        <p style="padding-left: 25px; text-align: justify;">Nous suivons l'heure d'arrivée réelle des vols aux aéroports d'Orly et Roissy CDG et prévoyons systématiquement une attente de 30 minutes à partir de l'heure d'atterrissage de votre vol. Une somme forfaitaire de 5€ incluant 30 minutes d'attente et le coût du parking est ajoutée au prix de la course. Tout temps d'attente supérieur à 30 minutes est facturé.</p>
                                                    </div>
                                                    <h4 class="accordion-toggle" style="background-color: rgb(238, 238, 238); padding: 10px; color: #1E4F93"> <i class="fa fa-question-circle"></i> Comment est calculé le prix des courses?</h4>
                                                    <div class="accordion-content">
                                                        <p style="padding-left: 25px; text-align: justify;">Nos prix sont basés sur un forfait kilométrique très avantageux. ReserverUnCab fixe le prix de chaque course à l'avance, celui-ci ne change pas, contrairement aux taxis qui vous facturent en fonction du temps et de la distance. Nous ne facturons pas le temps et la distance d'approche contrairement aux taxis.</p>
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
        <script type="text/javascript">
            $(document).ready(function ($) {
                $('#accordion').find('.accordion-toggle').click(function () {

                    //Expand or collapse this panel
                    $(this).next().slideToggle('fast');

                    //Hide the other panels
                    $(".accordion-content").not($(this).next()).slideUp('fast');

                });
            });
        </script>
    </body>

</html>