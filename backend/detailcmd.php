<?php
include("../config.php");
include("util.php");
if (!isset($_SESSION['backend']))
    header("location:login.php");
$client = mysql_fetch_array(mysql_query("select myvtc_users.nom,myvtc_users.prenom,reservation_attente.chauffeur ,   reservation_attente.heure,reservation_attente.depart,myvtc_users.tel,reservation_attente.arrivee,reservation_attente.id,reservation_attente.dtdeb,reservation_attente.prix from myvtc_users, reservation_attente where  reservation_attente.id_user = myvtc_users.id  and reservation_attente.id=" . $_GET['id']));
$pourcentage = mysql_fetch_array(mysql_query("select * from pourcentage where id=1"));
$nom_chauffeur = mysql_fetch_array(mysql_query("select * from chauffeur where id_chauffeur =" . $client['chauffeur']));
?>
<!doctype html>
<html class="no-js">
    <head>
        <meta charset="UTF-8">
        <title>Détail Commande</title>

        <!--IE Compatibility modes-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!--Mobile first-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap.min.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">

        <!-- Metis core stylesheet -->
        <link rel="stylesheet" href="assets/css/main.min.css">

        <!-- metisMenu stylesheet -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.css">
        <link rel="stylesheet" href="assets/lib/jquery-inputlimiter/jquery.inputlimiter.1.0.css">
        <link rel="stylesheet" href="assets/lib/bootstrap-daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/Uniform.js/2.1.2/themes/default/css/uniform.default.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.3/jquery.tagsinput.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.1/css/bootstrap3/bootstrap-switch.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker3.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.0.1/css/bootstrap-colorpicker.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

        <!--[if lt IE 9]>
          <script src="assets/lib/html5shiv/html5shiv.js"></script>
          <script src="assets/lib/respond/respond.min.js"></script>
          <![endif]-->

        <!--For Development Only. Not required -->
        <script>
            less = {
                env: "development",
                relativeUrls: false,
                rootpath: "../assets/"
            };
        </script>
        <link rel="stylesheet" href="assets/css/style-switcher.css">
        <link rel="stylesheet/less" type="text/css" href="assets/less/theme.less">
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.2.0/less.min.js"></script>

        <!--Modernizr-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    </head>
    <body class="  ">
        <div class="bg-dark dk" id="wrap">
            <div id="top">
                <!-- .navbar -->
                <header class="head">
                    <div class="search-bar">
                        <img src="../images/logo.png" class="img-responsive" style="width: 160px; margin-left: 12px;" alt="">
                    </div><!-- /.search-bar -->
                    <div class="main-bar">
                        <h3>
                            <i class="fa fa-money"></i>&nbsp; Commande</h3>
                    </div><!-- /.main-bar -->
                </header><!-- /.head -->
            </div><!-- /#top -->
            <div id="left">
                <div class="media user-media bg-dark dker">
                    <div class="user-media-toggleHover">
                        <span class="fa fa-user"></span> 
                    </div>

                </div>

                <!-- #menu -->
                <?php include("menu.php"); ?><!-- /#menu -->
            </div><!-- /#left -->
            <div id="content">
                <div class="outer">
                    <div class="inner bg-light lter">

                        <!--BEGIN INPUT TEXT FIELDS-->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="box dark">
                                    <header>
                                        <div class="icons">
                                            <i class="fa fa-edit"></i>
                                        </div>
                                        <h5>Détail Commande</h5>

                                        <!-- .toolbar -->
                                        <div class="toolbar">
                                            <nav style="padding: 8px;">

                                                <a href="javascript:;" class="btn btn-default btn-xs full-box">
                                                    <i class="fa fa-expand"></i>
                                                </a>

                                            </nav>
                                        </div><!-- /.toolbar -->
                                    </header>
                                    <div id="div-1" class="body">

                                        <table border="1" style="width: 100%">
                                            <tr>
                                                <td>Départ</td>
                                                <td><?php  echo $client['depart']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Arrivée</td>
                                                <td><?php  echo $client['arrivee']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Chauffeur</td>
                                                <td><?php  echo $nom_chauffeur['nom']; echo " ";  echo $nom_chauffeur['prenom'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Date</td>
                                                <td><?php  echo $client['dtdeb']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Heure</td>
                                                <td><?php  echo $client['heure']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Prix Total</td>
                                                <td><?php  echo $client['prix']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Part Société</td>
                                                <td><?php  echo $p= ($client['prix']*$pourcentage['part_societe'])/100; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Part Chauffeur</td>
                                                <td><?php  echo $p= ($client['prix']*$pourcentage['part_chauffeur'])/100; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!--END TEXT INPUT FIELD-->


                        </div><!-- /.row -->

                    </div><!-- /.inner -->
                </div><!-- /.outer -->
            </div><!-- /#content -->

        </div><!-- /#wrap -->
        <footer class="Footer bg-dark dker">
            <p>2016 &copy; ReserverUnCab.com</p>
        </footer><!-- /#footer -->

        <!--jQuery -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/Uniform.js/2.1.2/jquery.uniform.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.3/jquery.tagsinput.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/autosize.js/1.18.17/jquery.autosize.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.1/js/bootstrap-switch.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.0.1/js/bootstrap-colorpicker.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>

        <!--Bootstrap -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

        <!-- MetisMenu -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.js"></script>

        <!-- Screenfull -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/screenfull.js/2.0.0/screenfull.min.js"></script>
        <script src="assets/lib/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
        <script src="assets/lib/jQuery.validVal/js/jquery.validVal.min.js"></script>
        <script src="assets/lib/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- Metis core scripts -->
        <script src="assets/js/core.min.js"></script>

        <!-- Metis demo scripts -->
        <script src="assets/js/app.js"></script>
        <script>
            $(function () {
                Metis.formGeneral();
            });
        </script>

        <script>
            function notifchauffeur(id) {

                var chauffeur = document.getElementById("chauffeur").value;
                var prenom = document.getElementById("prenom").value;
                var nom = document.getElementById("nom").value;
                var tel = document.getElementById("tel").value;
                var depart = document.getElementById("depart").value;
                var arrivee = document.getElementById("arrivee").value;
                var date = document.getElementById("date11").value;
                var heure = document.getElementById("heure").value;
                var prix = document.getElementById("prix").value;
                $.ajax({
                    url: 'notifchauffeur.php?prenom=' + prenom + '&nom=' + nom + '&chauffeur=' + chauffeur + '&tel=' + tel + '&depart=' + depart + '&arrivee=' + arrivee + '&date=' + date + '&heure=' + heure + '&id=' + id+ '&prix=' + prix,
                    success: function (data) {
                        var t = eval(data);

                        alert("Chauffeur Notifié !");
                    }
                });
            }
        </script>


        <script src="assets/js/style-switcher.min.js"></script>
    </body>
