<?php
include("config.php");
if (!isset($_SESSION['myvtclogin']))
    header("location:connexion.php");
$menu=5;
$user = mysql_fetch_array(mysql_query("select * from myvtc_users where email='" . $_SESSION['myvtclogin'] . "'"));
?>
<!DOCTYPE HTML>
<!--
        Developer : Said KHALID, khalidsaid.box@gmail.com, 2015.
-->
<html>

    <head>
        <title>Mes commandes</title>
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
                   <img src="images/logo.png" /><br>
                    <img src="images/titre.png" />
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
                                        <div class="col-xs-12 col-sm-12">

                                            <div class="col-sm-3 well">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li><a href="profil.php"> <i class="fa fa-user"></i> Mon compte</a></li>
                                                    <li class="active"><a href="commande.php"> <i class="fa fa-money"></i> Mes commandes</a></li>
                                                    <li><a href="deconnect.php"> <i class="fa fa-sign-out"></i> Déconnexion</a></li>

                                                </ul>
                                            </div>
                                            <div class="col-sm-9">
                                                <?php
                                                $sql = mysql_query("select depart, arrivee, heure, prix, DATE_FORMAT(dtdeb, '%d/%m/%Y') as dtdeb from reservation_attente where id_user=" . $user['id'] ." AND etat='1'");
                                                $nb = mysql_num_rows($sql);
                                                if ($nb > 0) {
                                                    ?>
                                                    <table border="1">
													
                                                        <tr>
                                                            <th class="col-md-4" style="border: 1px solid #ccc; font-weight: bold">Départ</th>
                                                        <th class="col-md-4" style="border: 1px solid #ccc; font-weight: bold">Arrivé</th>
                                                        <th class="col-md-2" style="border: 1px solid #ccc; font-weight: bold">Date</th>
                                                        <th class="col-md-1" style="border: 1px solid #ccc; font-weight: bold">Heure</th>
                                                        <th class="col-md-1" style="border: 1px solid #ccc; font-weight: bold">Prix</th>
                                                        </tr>
                                                        <?php
                                                        
                                                            while ($data = mysql_fetch_array($sql)) {
                                                                ?>
                                                                <tr>
                                                                    <td style="border: 1px solid #ccc; text-align: left; padding-left: 5px; padding-right: 5px;"><?php echo $data['depart']; ?></td>
                                                                    <td style="border: 1px solid #ccc; text-align: left; padding-left: 5px; padding-right: 5px;"><?php echo $data['arrivee']; ?></td>
                                                                    <td style="border: 1px solid #ccc"><?php echo $data['dtdeb']; ?></td>
                                                                    <td style="border: 1px solid #ccc"><?php echo $data['heure']; ?></td>
                                                                    <td style="border: 1px solid #ccc"><?php echo $data['prix']; ?> €</td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <div class="col-md-12">Vous n'avez aucune commande. Passez votre commande en cliquant <a href="index.php">ici</a></div>
                                                            <?php
                                                        }
                                                        ?>
														
                                                    </table>
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
    </body>

</html>