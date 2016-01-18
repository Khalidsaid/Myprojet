<?php
include("config.php");
if (isset($_SESSION['myvtclogin']))
    header("location:profil.php");
?>
<!DOCTYPE HTML>
<!--
        Developer : Said KHALID, khalidsaid.box@gmail.com, 2015.
-->
<html>

    <head>
        <title>Connexion</title>
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
                                    if (isset($_POST['username'])) {
                                        $login = $_POST['username'];
                                        $pwd = md5($_POST['password']);
                                        
                                        $verif=  mysql_query("select * from myvtc_users where email='".$login."' and pwd='".$pwd."'");
                                        $nb=  mysql_num_rows($verif);
                                        if($nb==0){
                                            echo "<script>alert('Veuillez vérifier vos paramètres de connexion');</script>";
                                        }else{
                                            $_SESSION['myvtclogin'] = $login;
                                             echo "<script>window.location='profil.php'</script>";
                                        }
                                        
                                        
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-11 col-sm-offset-1">

                                            <blockquote style="text-align: left"><h3>Espace de connexion</h3></blockquote>

                                            <div class="col-sm-7 col-sm-offset-2">
                                                <form action="" name="login-form" role="form" class="form-horizontal" method="post" accept-charset="utf-8">

                                                    <div class="form-group">
                                                        <div class="col-md-7 col-sm-offset-3"><input name="username" placeholder="Email" class="form-control" type="text" id="UserUsername"/></div>
                                                    </div> 

                                                    <div class="form-group">
                                                        <div class="col-md-7 col-sm-offset-3"><input name="password" placeholder="Mot de passe" class="form-control" type="password" id="UserPassword"/></div>
                                                    </div> 

                                                    <div class="form-group">
                                                        <div class="col-md-7 col-sm-offset-3">
                                                            <button  class="btn btn-success btn-lg" type="submit">Connexion </button>
                                                            <br><br>
                                                            Mot de passe oublié ? cliquez <a href="oublier.php">ici</a>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="form-group">
                                                        <div class="col-md-7 col-sm-offset-3">
                                                            Vous n'avez pas encore de compte sur MyVTC?<br><br>
                                                            <a href="inscription.php"  class="btn  btn-primary">Créer votre compte</a></div>
                                                    </div>

                                                </form>
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