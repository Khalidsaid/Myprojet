<?php
include("../config.php");
include("util.php");
if (!isset($_SESSION['backend']))
    header("location:login.php");
$client = mysql_fetch_array(mysql_query("select myvtc_users.nom,myvtc_users.prenom, chauffeur.nom, chauffeur.prenom as chauff, chauffeur.nom as name, reservation_attente.heure,reservation_attente.depart,myvtc_users.tel,reservation_attente.arrivee,reservation_attente.id,reservation_attente.dtdeb,reservation_attente.prix from chauffeur, myvtc_users, reservation_attente where  reservation_attente.id_user = myvtc_users.id and chauffeur.id_chauffeur=reservation_attente.chauffeur and reservation_attente.id=" . $_GET['id']));
$pourcentage = mysql_fetch_array(mysql_query("select * from pourcentage where id=1"));
$nom_chauffeur = mysql_fetch_array(mysql_query("select * from chauffeur where id_chauffeur =" . $data['chauffeur']));
?>
<!doctype html>
<html class="no-js">
    <head>
        <meta charset="UTF-8">
        <title>Detail Commande</title>

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
                            <i class="fa fa-phone"></i>&nbsp; Commande par telephone</h3>
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
                                        <h5>Nouvelle Commande</h5>

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
                                                    <button type="button" class="btn btn-primary" onclick="addCommande()">Ajouter la commande</button>
                                                </div>
                                            </div><!-- /.form-group -->


                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Depart</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="depart" placeholder="Depart" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Arrivee</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="arrivee" placeholder="Prenom" value="<?php echo $client['prenom']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
											 <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Client</label>
                                                  <div class="col-lg-8">

                                                    <select class="form-control" name="client" id="client">
                                                        <option></option>
                                                        <?php
                                                        $sql_chauffeur = mysql_query("select * from myvtc_users");
                                                        while ($data_chauffeur = mysql_fetch_array($sql_chauffeur)) {
                                                            ?>
                                                            <option value="<?php echo $data_chauffeur['tel']; ?>"><?php echo $data_chauffeur['prenom'] . " " . $data_chauffeur['nom']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div><!-- /.form-group -->
											   <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">ou Mobile client</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="tel" placeholder="Tel" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Nom</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="nom" placeholder="Nom" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Prenom</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="prenom" name="prenom" placeholder="Prenom" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
											    <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Valises</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="valise" name="valise" placeholder="Valises" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->    <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Passager</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="passager" name="passager" placeholder="Passager" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->

                                             <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Chauffeur</label>
                                                <div class="col-lg-8">

                                                    <select class="form-control" name="chauffeur" id="chauffeur">
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
                                                <label for="text1" class="control-label col-lg-4">Date</label>
                                                <div class="col-lg-8">
                                                    <input type="date" id="dtdeb" placeholder="Date"  class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Prix</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="prix" placeholder="Prix" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
											    <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Heure</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="heure" placeholder="Heure" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->

                                         
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Part chauffeur</label>
                                                <div class="col-lg-8">
                                            <input type="text" id="part_chauffeur" placeholder="Part chauffeur" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
											   <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Part societe</label>
                                                <div class="col-lg-8">
                                            <input type="text" id="part_societe" placeholder="Part societe" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                           
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Si societe :</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="societe" placeholder="Nom Societe" value="<?php echo $client['societe']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                          
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">SIREN</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="siren" placeholder="SIREN" value="<?php echo $client['siren']; ?>" class="form-control">
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
            function addCommande() {

                var chauffeur = document.getElementById("chauffeur").value;
                var prenom = document.getElementById("prenom").value;
                var nom = document.getElementById("nom").value;
                var tel = document.getElementById("tel").value;
                var depart = document.getElementById("depart").value;
                var arrivee = document.getElementById("arrivee").value;
                var date = document.getElementById("dtdeb").value;
                var heure = document.getElementById("heure").value;
                var prix = document.getElementById("prix").value;
                var societe = document.getElementById("societe").value;
				var siren = document.getElementById("siren").value;
				var part_societe = document.getElementById("part_societe").value;
				var part_chauffeur = document.getElementById("part_chauffeur").value;
				var client = document.getElementById("client").value;
				
                $.ajax({
                    url: 'inserttelephonecmd.php?prenom=' + prenom + '&nom=' + nom + '&chauffeur=' + chauffeur + '&tel=' + tel + '&depart=' + depart + '&arrivee=' + arrivee + '&dtdeb=' + date + '&heure=' + heure +  '&prix=' + prix+ '&societe=' + societe+ '&siren=' + siren+ '&part_chauffeur=' + part_chauffeur+ '&part_societe=' + part_societe+ '&client=' + client,
                    success: function (data) {
                        var t = eval(data);

                        alert("Chauffeur Notifié !");
                    }
                });
            }
        </script>


        <script src="assets/js/style-switcher.min.js"></script>
    </body>
