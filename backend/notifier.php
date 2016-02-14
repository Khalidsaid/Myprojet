<?php
include("../config.php");
include("util.php");
if (!isset($_SESSION['backend']))
    header("location:login.php");
$client = mysql_fetch_array(mysql_query("select myvtc_users.nom,myvtc_users.prenom,myvtc_users.type_user,reservation_attente.depart,myvtc_users.tel,reservation_attente.arrivee,reservation_attente.id,reservation_attente.heure,reservation_attente.dtdeb,reservation_attente.prix from myvtc_users, reservation_attente where reservation_attente.id_user = myvtc_users.id and reservation_attente.id=" . $_GET['id']));
$pourcentage = mysql_fetch_array(mysql_query("select * from pourcentage where id=1"));
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

                                        <form class="form-horizontal" method="post" action="">

                                            <div class="form-group center">

                                                <div class="col-lg-8">
                                                    <button type="button" class="btn btn-primary" onclick="notifchauffeur(<?php echo $_GET['id']; ?>)">Modifier</button>
                                                </div>
                                            </div><!-- /.form-group -->


                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Chauffeur</label>
                                                <div class="col-lg-8">

                                                    <select class="form-control"name="chauffeur" id="chauffeur" onchange="part_societe_fct()">
                                                        <option></option>
                                                        <?php
                                                        $sql_chauffeur = mysql_query("select * from chauffeur");
                                                        while ($data_chauffeur = mysql_fetch_array($sql_chauffeur)) {
                                                            ?>
                                                            <option value="<?php echo $data_chauffeur['id_chauffeur']; ?>"><?php echo $data_chauffeur['prenom'] . " " . $data_chauffeur['nom']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Type User</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="type_user" placeholder="Type User" value="<?php echo $client['type_user']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Nom</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="nom" placeholder="Nom" value="<?php echo $client['nom']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Prénom</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="prenom" placeholder="Prénom" value="<?php echo $client['prenom']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Téléphone</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="tel" placeholder="Téléphone" value="<?php echo $client['tel']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Départ</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="depart" placeholder="Départ" value="<?php echo $client['depart']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Arrivée</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="arrivee" name="arrivee" placeholder="Arrivee" value="<?php echo $client['arrivee']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Date</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="date11" placeholder="Adresse" value="<?php echo $client['dtdeb']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Heure</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="heure" placeholder="Heure" value="<?php echo $client['heure']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group" id="part_chauffeur_bloc">
                                                <label for="text1" class="control-label col-lg-4">Part de la société</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="part_societe" placeholder="Part de la société" value="<?php echo $p = ($client['prix'] * $pourcentage['part_societe']) / 100; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group" >
                                                <label for="text1" class="control-label col-lg-4">Part du chauffeur</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="part_chauffeur" placeholder="Part du chauffeur" value="<?php echo $p = ($client['prix'] * $pourcentage['part_chauffeur']) / 100; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Prix</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="prix" placeholder="Prix" value="<?php echo $client['prix']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->

                                        </form>
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
            <p>2014 &copy; Metis Bootstrap Admin Template</p>
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
                var type_user = document.getElementById("type_user").value;
                var chauffeur = document.getElementById("chauffeur").value;
                var part_societe = 0;
                if (chauffeur == 5) {
                    part_societe = 0;
                } else {
                    part_societe = document.getElementById("part_societe").value;
                }
                var part_chauffeur = document.getElementById("part_chauffeur").value;
                $.ajax({
                    url: 'notifchauffeur.php?prenom=' + prenom + '&nom=' + nom + '&chauffeur=' + chauffeur + '&tel=' + tel + '&depart=' + depart + '&arrivee=' + arrivee + '&date=' + date + '&heure=' + heure + '&id=' + id + '&prix=' + prix + '&type_user=' + type_user + '&part_chauffeur=' + part_chauffeur + '&part_societe=' + part_societe,
                    success: function (data) {
                        var t = eval(data);

                        alert("Chauffeur Notifié !");
                        window.location="commande.php"
                    }
                });
            }
            function part_societe_fct() {
                var chauffeur = document.getElementById("chauffeur").value;
                if (chauffeur == 5) {
                    document.getElementById("part_societe").disabled = true;
                    document.getElementById("part_societe").value = '';

                } else {
                    document.getElementById("part_societe").disabled = false;
                    
                }
            }
        </script>


        <script src="assets/js/style-switcher.min.js"></script>
    </body>
