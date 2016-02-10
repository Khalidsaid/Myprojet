<?php
include("config.php");
include("util.php");
if (!isset($_SESSION['backend']))
    header("location:login.php");
mysql_query("update reservation_attente set archive=1 where reservation_attente.dtdeb<'" . date("Y-m-d") . "'");
mysql_query("update  reservation_tel set archive=1 where  reservation_tel.dtdeb<'" . date("Y-m-d") . "'");
?>
<!doctype html>
<html class="no-js">
    <head>
        <meta charset="UTF-8">
        <title>Commandes validees</title>

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
        <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">

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
                            <i class="fa fa-user"></i>&nbsp; Commande archivees</h3>
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

                        <!--Begin Datatables-->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="box">
                                    <header>
                                        <div class="icons">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <h5>Commande archivees</h5>
                                    </header>
                                    <div id="collapse4" class="body">
                                        <table id="dataTable" class="table table-bordered table-responsive table-condensed table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Prenom</th>
                                                    <th>Depart</th>
                                                    <th>Arrivee</th>
                                                    <th>Date</th>
                                                    <th>Total</th>
                                                    <th>Chauffeur</th>
                                                   
                                                 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = mysql_query("select  myvtc_users.nom, myvtc_users.prenom,  reservation_attente.heure,reservation_attente.chauffeur, reservation_attente.depart,reservation_attente.arrivee,DATE_FORMAT(reservation_attente.dtdeb, '%d/%m/%Y') as dtdeb,reservation_attente.prix from  myvtc_users inner join  reservation_attente on reservation_attente.id_user = myvtc_users.id where  reservation_attente.dtdeb>='2016-01-01'  AND reservation_attente.etat=1 and  reservation_attente.archive=1  ;");
                                                while ($data = mysql_fetch_array($sql)) {
                                                    $nom_complet1=  mysql_fetch_array(mysql_query("select chauffeur.nom,chauffeur.prenom from chauffeur where id_chauffeur=".$data['chauffeur']));
                                                    $nom_complet = $nom_complet1['nom'] . " " . $nom_complet1['prenom'];
                                                    ?>
                                                    <tr>

                                                        <td><?php echo $data['nom']; ?></td>
                                                        <td><?php echo $data['prenom']; ?></td>
                                                        <td><?php echo $data['depart'];?></td>
                                                        <td><?php echo $data['arrivee']; ?></td>
                                                        <td><?php echo $data['dtdeb']; ?></td>
                                                        <td><?php echo $data['prix']; ?> euros</td>
                                                        <td><?php echo $nom_complet; ?></td>
                                                       
                                                     
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
												  <?php
                                                $sql1 = mysql_query("select chauffeur.nom as chauffeurnom, chauffeur.prenom as chauffeurprenom, reservation_tel.id as id_cmd, client_tel.nom, client_tel.prenom, DATE_FORMAT(reservation_tel.dtdeb, '%d/%m/%Y') as dtdeb, prix  from reservation_tel, client_tel, chauffeur WHERE client_tel.id = reservation_tel.client AND reservation_tel.id_chauffeur=chauffeur.id_chauffeur AND reservation_tel.archive=1 AND reservation_tel.dtdeb<'" . date("Y-m-d") . "'");
                                                while ($data1 = mysql_fetch_array($sql1)) {                                                 
                                                    $nom_complet = $data1['chauffeurnom'] . " " . $data1['chauffeurprenom'];
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $data1['nom']; ?></td>
                                                        <td><?php echo $data1['prenom']; ?></td>
                                                        <td><?php echo $data1['depart'];?></td>
                                                        <td><?php echo $data1['arrivee']; ?></td>
                                                        <td><?php echo $data1['dtdeb']; ?></td>
                                                        <td><?php echo $data1['prix']; ?> euros</td>
                                                        <td><?php echo $nom_complet; ?></td>
                                                   
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.row -->

                        <!--End Datatables-->

                    </div><!-- /.inner -->
                </div><!-- /.outer -->
            </div><!-- /#content -->
            <div id="right" class="bg-light lter">


            </div><!-- /#right -->
        </div><!-- /#wrap -->
        <footer class="Footer bg-dark dker">
            <p>2015 &copy; Ad-prestiges</p>
        </footer><!-- /#footer -->

        <!--jQuery -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.4/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.18.4/js/jquery.tablesorter.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

        <!--Bootstrap -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

        <!-- MetisMenu -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.js"></script>

        <!-- Screenfull -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/screenfull.js/2.0.0/screenfull.min.js"></script>

        <!-- Metis core scripts -->
        <script src="assets/js/core.min.js"></script>

        <!-- Metis demo scripts -->
        <script src="assets/js/app.js"></script>
        <script>
            $(function () {
                Metis.MetisTable();
                Metis.metisSortable();
            });
	
        </script>
        <script src="assets/js/style-switcher.min.js"></script>
       
    </body>