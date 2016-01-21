<?php
include("config.php");
include("util.php");
if (!isset($_SESSION['backend']))
    header("location:login.php");

$client_pro=  mysql_query("select count(*) from myvtc_users where type_user='Professionnel'");
$nb_client_pro=  mysql_num_rows($client_pro);
$client_part=  mysql_query("select count(*) from myvtc_users where type_user='Particulier'");
$nb_client_part=  mysql_num_rows($client_part);
$commande=  mysql_query("select * from reservation");
$nb_commande=  mysql_num_rows($commande);
?>

<!doctype html>
<html class="no-js">
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.5/fullcalendar.min.css">

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
              <i class="fa fa-dashboard"></i>&nbsp; Dashboard</h3>
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
        <?php include("menu.php");  ?><!-- /#menu -->
      </div><!-- /#left -->
  <div id="content">
        <div class="outer">
          <div class="inner bg-light lter">
           
            <div class="text-center">
              <a class="quick-btn" href="client.php">
                <i class="fa fa-users fa-2x"></i>
                <span>PRO</span> 
                <span class="label label-default"><?php echo $nb_client_pro; ?></span> 
              </a> 
              <a class="quick-btn" href="client.php">
                <i class="fa fa-users fa-2x"></i>
                <span>Particuliers</span> 
                <span class="label label-danger"><?php echo $nb_client_part; ?></span> 
              </a> 
              <a class="quick-btn" href="commande.php">
                <i class="fa fa-money fa-2x"></i>
                <span>Commandes</span> 
                 <span class="label label-info"><?php echo $nb_commande; ?></span> 
              </a> 
              <a class="quick-btn" href="contact.php">
                <i class="fa fa-envelope fa-2x"></i>
                <span>Contacts</span> 
                <span class="label label-success">0</span> 
              </a> 
              
            </div>
            <hr>
          
            
          </div><!-- /.inner -->
        </div><!-- /.outer -->
      </div><!-- /#content -->
     
     
    </div><!-- /#wrap -->
    <footer class="Footer bg-dark dker">
      <p>2014 &copy; Metis Bootstrap Admin Template</p>
    </footer><!-- /#footer -->

    <!-- #helpModal -->
    <div id="helpModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
              in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal --><!-- /#helpModal -->

    <!--jQuery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.5/fullcalendar.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.18.4/js/jquery.tablesorter.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.selection.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.resize.min.js"></script>

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
      $(function() {
        Metis.dashboard();
      });
    </script>
    <script src="assets/js/style-switcher.min.js"></script>
  </body>