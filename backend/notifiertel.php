<?php
include("../config.php");
include("util.php");
if (!isset($_SESSION['backend']))
    header("location:login.php");
$client = mysql_fetch_array(mysql_query("select client_tel.nom,client_tel.prenom,client_tel.type_user,reservation_tel.depart,client_tel.tel,reservation_tel.arrivee,reservation_tel.id,reservation_tel.heure,reservation_tel.dtdeb,reservation_tel.prix from client_tel, reservation_tel where reservation_tel.client = client_tel.id and reservation_tel.id=" . $_GET['id']));
$pourcentage = mysql_fetch_array(mysql_query("select * from pourcentage where id=1"));
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
                                        <h5>Notifier Chauffeur</h5>
                                        <?php
                                        if (isset($_POST['id_cmd']) && isset($_POST['chauffeur'])) {
                                            $sql = mysql_query("update reservation_tel set id_chauffeur=" . $_POST['chauffeur'] . "  where id=" . $_POST['id_cmd']);
                                            if ($sql) {
                                                $ll = mysql_query("select client_tel.nom,client_tel.prenom,client_tel.type_user,client_tel.tel, reservation_tel.depart,reservation_tel.arrivee,reservation_tel.id as id_cmd,reservation_tel.dtdeb,reservation_tel.prix,reservation_tel.dtdeb,client_tel.email,reservation_tel.heure,reservation_tel.passager,reservation_tel.valise from client_tel inner join reservation_tel on reservation_tel.client = client_tel.id where  reservation_tel.id=" . $_POST['id_cmd'] . " order by reservation_tel.id desc limit 1")or die(mysql_error());
                                                $commande = mysql_fetch_array($ll);
                                               
                                                $nom_chauffeur = mysql_fetch_array(mysql_query("select * from chauffeur where id_chauffeur =" . $_POST['chauffeur']));
                                                $nom_complet = $nom_chauffeur['prenom'] . " " . $nom_chauffeur['nom'];

                                                $headers = 'From: contact@reserveruncab.com' . "\r\n" .
                                                        'Reply-To: contact@reserveruncab.com' . "\r\n" .
                                                        'X-Mailer: PHP/' . phpversion();
                                                $message = "Notification de réservation :\n
Client : " . $commande['type_user'] .": ".$commande['prenom'] ." ".$commande['nom']. "\n
Téléphone : " . $commande['tel']. "\n
Date : " . $commande['dtdeb'] . "\n
Heure : " . $commande['heure'] . "\n
Départ : " . $commande['depart'] . "\n
Arrivée : " . $commande['arrivee'] . "\n
Prix : " . $commande['prix'] . "\n
Passagers : " . $commande['passager'] . "\n
Valises : " . $commande['valise'] . "\n
";
                                                mail($nom_chauffeur['email'], "Notification sur ReserverUnCab.com", $message, $headers);





                                                echo "<script>alert('Chauffeur change !')</script>";
                                                echo "<script>window.location='commande.php'</script>";
                                            } else {
                                                echo "<script>alert('Erreur !')</script>";
                                                echo "<script>window.location='commande.php'</script>";
                                            }
                                        }
                                        ?>
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

                                        <form class="form-horizontal" method="post" action="notifiertel.php">


                                            <input type="hidden" name="id_cmd" value="<?php echo $_GET['id']; ?>" />
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
                                                    <br>

                                                    <button type="submit" class="btn btn-success">Modifier</button>
                                                </div>

                                            </div>
                                        </form>

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

                $.ajax({
                    url: 'notifchauffeurtel.php?chauffeur=' + chauffeur,                     success: function (data) {
                        var t = eval(data);
                        alert("Chauffeur Notifie !");
                        }
                    });
                            }
            </script>


            <script src="assets/js/style-switcher.min.js"></script>
    </body>
