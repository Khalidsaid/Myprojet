<?php
include("config.php");
$menu=4;
?>
<!DOCTYPE HTML>
<!--
        Developer : Said KHALID, khalidsaid.box@gmail.com, 2015.
-->
<html>

    <head>
        <title>Contact</title>
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
                                    <?php
                                    if (isset($_POST['nom'])) {
                                        $nom = addslashes($_POST['nom']);
                                        $prenom = addslashes($_POST['prenom']);
                                        $email = addslashes($_POST['email']);
                                        $sujet = addslashes($_POST['sujet']);
                                        $msg = addslashes($_POST['msg']);
                                        $dt=date("Y-m-d H:i:s");
                                        

                                        $verif = mysql_query("insert into contact(nom,prenom,email,sujet,msg,dt)values('".$nom."','".$prenom."','".$email."','".$sujet."','".$msg."','".$dt."')")or die(mysql_error());
                                       
                                     
                                            echo "<script>alert('Message envoyé !');</script>";
                                       
                                         
                                            echo "<script>window.location='contact.php'</script>";
                                        
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-11 col-sm-offset-1">

                                            <blockquote style="text-align: left"><h3>Contact</h3></blockquote>
                                            <div class="col-sm-3 well" style="text-align: left">
                                                <i class="fa fa-home"></i></span> <b>ReserverUnCab.com</b><br>
                                                20 rue Saint John Perse <br>
                                                94450 Limeil-Brevannes, France<br>813 685 484 R.C.S. CRETEIL<br>
                                                <i class="fa fa-phone"></i> <b>06 59 34 27 03</b><br>
												

                                                <i class="fa fa-envelope"></i> <a href="mailto:contact@reserveruncab.com">contact@reserveruncab.com</a><br><br>
                                                <i class="fa fa-home"></i>Horaires :<br><b><span style="font-weight: bold">7j/7</span> <br>24h/24h</b><br>
                                             

                                            </div>
                                            <div class="col-sm-9">
                                                <form action="" name="login-form" role="form" class="form-horizontal" method="post" accept-charset="utf-8">

                                                    <div class="form-group">
                                                        <div class="col-md-7"><input name="nom" placeholder="Nom *" class="form-control" type="text" id="nom" required=""/></div>
                                                    </div> 

                                                    <div class="form-group">
                                                        <div class="col-md-7"><input name="prenom" placeholder="Prénom *" class="form-control" type="text" id="prenom" required=""/></div>
                                                    </div> 
                                                    <div class="form-group">
                                                        <div class="col-md-7"><input name="email" placeholder="Email *" class="form-control" type="email" id="email" required=""/></div>
                                                    </div> 
                                                    <div class="form-group">
                                                        <div class="col-md-7"><input name="tel" placeholder="Téléphone *" class="form-control" type="text" id="tel" required=""/></div>
                                                    </div> 
                                                    <div class="form-group">
                                                        <div class="col-md-7"><input name="sujet" placeholder="Votre sujet" class="form-control" type="text" id="sujet"/></div>
                                                    </div> 
                                                    <div class="form-group">
                                                        <div class="col-md-7"><textarea class="form-control" id="msg" name="msg" placeholder="Votre message *" required=""></textarea></div>
                                                    </div> 

                                                    <div class="form-group">
                                                        <div class="col-md-7 col-sm-offset-3">
                                                            <button  class="btn btn-success btn-lg" type="submit">Envoyer </button>

                                                        </div>
                                                    </div>
                                                    <hr>

                                                </form>
                                                <div class="page-header parallax">
                                               
													<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2630.6129026786834!2d2.470915815148826!3d48.751090816210564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e60b151d491b51%3A0x66d2b053cc08f026!2s20+Rue+St+John+Perse%2C+94450+Limeil-Br%C3%A9vannes!5e0!3m2!1sfr!2sfr!4v1453475956043" width="100%" height="300px" frameborder="0" style="border:0" allowfullscreen></iframe>
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
      
    </body>

</html>