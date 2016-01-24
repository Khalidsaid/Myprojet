<?php
include("config.php");
$menu=2;
?>
<!DOCTYPE HTML>
<!--
        Developer : Said KHALID, khalidsaid.box@gmail.com, 2015.
-->
<html>

    <head>
        <title>Tarifs</title>
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

                                            <blockquote style="text-align: left"><h3>Tarifs</h3></blockquote>

                                            <div class="col-sm-12" style="text-align: left; margin-left: 0px; padding-left: 35px;">
                                                <div class="col-md-3" style="border: 1px solid rgb(204, 204, 204); padding-left: 0px; padding-right: 0px;">
                                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px; background-color: rgb(30, 79, 147); color: rgb(255, 255, 255); text-align: center;"><h3>Trajet dans Paris</h3></div>
                                                    <div class="col-md-12" style="text-align: center; border-bottom: 1px solid rgb(204, 204, 204);"><h3 style="color: #D52349"><sup>€</sup><span style="font-size: 38px; padding-left: 5px;">30</span></h3></div>
                                                    <div class="col-md-12"><h3 style="text-align: center; font-size: 15px;"><b>1 à 3 passagers</b> inclus</h3></div>
                                                    <div class="col-md-12"><h3 style="text-align: center; font-size: 15px;"><b>4 à 5 passagers</b> +5€</h3></div>
                                                    <div class="col-md-12"><h3 style="text-align: center; font-size: 15px;"><b>6 à 8 passagers</b> +15€</h3></div>
                                                </div>
                                                <div class="col-md-3" style="border: 1px solid rgb(204, 204, 204); padding-left: 0px; padding-right: 0px;">
                                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px; background-color: rgb(30, 79, 147); color: rgb(255, 255, 255); text-align: center;"><h3>Paris ↔ Orly</h3></div>
                                                    <div class="col-md-12" style="text-align: center; border-bottom: 1px solid rgb(204, 204, 204);"><h3 style="color: #D52349"><sup>€</sup><span style="font-size: 38px; padding-left: 5px;">39</span></h3></div>
                                                    <div class="col-md-12"><h3 style="text-align: center; font-size: 15px;"><b>1 à 3 passagers</b> inclus</h3></div>
                                                    <div class="col-md-12"><h3 style="text-align: center; font-size: 15px;"><b>4 à 5 passagers</b> +5€</h3></div>
                                                    <div class="col-md-12"><h3 style="text-align: center; font-size: 15px;"><b>6 à 8 passagers</b> +15€</h3></div>
                                                </div>
                                                <div class="col-md-3" style="border: 1px solid rgb(204, 204, 204); padding-left: 0px; padding-right: 0px;">
                                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px; background-color: rgb(30, 79, 147); color: rgb(255, 255, 255); text-align: center;"><h3>Paris ↔ Roissy</h3></div>
                                                    <div class="col-md-12" style="text-align: center; border-bottom: 1px solid rgb(204, 204, 204);"><h3 style="color: #D52349"><sup>€</sup><span style="font-size: 38px; padding-left: 5px;">49</span></h3></div>
                                                    <div class="col-md-12"><h3 style="text-align: center; font-size: 15px;"><b>1 à 3 passagers</b> inclus</h3></div>
                                                    <div class="col-md-12"><h3 style="text-align: center; font-size: 15px;"><b>4 à 5 passagers</b> +5€</h3></div>
                                                    <div class="col-md-12"><h3 style="text-align: center; font-size: 15px;"><b>6 à 8 passagers</b> +15€</h3></div>
                                                </div>
                                                <div class="col-md-3" style="border: 1px solid rgb(204, 204, 204); padding-left: 0px; padding-right: 0px;">
                                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px; background-color: rgb(30, 79, 147); color: rgb(255, 255, 255); text-align: center;"><h3>Paris ↔ Beauvais</h3></div>
                                                    <div class="col-md-12" style="text-align: center; border-bottom: 1px solid rgb(204, 204, 204);"><h3 style="color: #D52349"><sup>€</sup><span style="font-size: 38px; padding-left: 5px;">89</span></h3></div>
                                                    <div class="col-md-12"><h3 style="text-align: center; font-size: 15px;"><b>1 à 3 passagers</b> inclus</h3></div>
                                                    <div class="col-md-12"><h3 style="text-align: center; font-size: 15px;"><b>4 à 5 passagers</b> +5€</h3></div>
                                                    <div class="col-md-12"><h3 style="text-align: center; font-size: 15px;"><b>6 à 8 passagers</b> +15€</h3></div>
                                                </div>


                                            </div>
                                            <hr>
                                            <div class="col-md-12" style="font-size: 19px; margin-top: 25px;">
                                                <p>Pour tout autre type de demande, merci de nous contacter via le formulaire de <a href="http://www.reserveruncab.com">DEVIS</a> ou par téléphone au :  +33(0)6.59.566.383</p>
                                                <span style="font-size: 13px; text-align: left; font-style: italic;">Surcharge de 5€ pour accueil personnalisé des voyageurs et parking si la prise en charge se fait à l'aéroport/gare.</span>
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