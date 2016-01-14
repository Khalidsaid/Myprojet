<?php
include("config.php");
if (!isset($_SESSION['myvtclogin']))
    header("location:connexion.php");

$user = mysql_fetch_array(mysql_query("select * from myvtc_users where email='" . $_SESSION['myvtclogin'] . "'"));
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
                    <?php
                    if (isset($_POST['email'])) {
                        $login = mysql_real_escape_string($_POST["email"]);
                        $pwd = mysql_real_escape_string($_POST["pwd"]);
                        $prenom = mysql_real_escape_string($_POST["prenom"]);
                        $nom = mysql_real_escape_string($_POST["nom"]);
                        $adresse = mysql_real_escape_string($_POST["adresse"]);
                        $cp = mysql_real_escape_string($_POST["cp"]);
                        $ville = mysql_real_escape_string($_POST["ville"]);
                        $tel = mysql_real_escape_string($_POST["tel"]);
                        $password = md5($pwd);

                        mysql_query("update myvtc_users set nom='" . $nom . "',prenom='" . $prenom . "',adresse='" . $adresse . "',ville='" . $ville . "',cp='" . $tel . "',nom='" . $tel . "',pwd='" . $password . "' where email='" . $_SESSION['myvtclogin'] . "'")or die(mysql_error());

                        $_SESSION['myvtclogin'] = $login;
                        echo '<script>window.location="profil.php"</script>';
                    }
                    ?>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="main">

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">

                                            <blockquote style="text-align: left"><h3>Mon compte</h3></blockquote>

                                            <div class="col-sm-12">
                                                <form action="" name="inscription-form" role="form" class="form-horizontal" method="post" accept-charset="utf-8">

                                                    <div class="form-group" style="text-align: left;">
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Prénom</label>
                                                            <input name="prenom" placeholder="Prénom" class="form-control" type="text" id="prenom" value="<?php echo $user['prenom']; ?>" required="" />
                                                        </div>
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Nom</label>
                                                            <input name="nom" placeholder="Nom" class="form-control" value="<?php echo $user['nom']; ?>" type="text" id="nom" required="" />
                                                        </div>
                                                    </div> 
                                                    <div class="form-group" style="text-align: left;">
                                                        <div class="col-md-12" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Adresse postale</label>
                                                            <textarea name="adresse" placeholder="Adresse postale" class="form-control" type="text" id="adresse"><?php echo $user['adresse']; ?></textarea>
                                                        </div>
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Ville</label>
                                                            <input name="ville" placeholder="Ville" class="form-control" value="<?php echo $user['ville']; ?>" type="text" id="ville" />
                                                        </div>
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Code postal</label>
                                                            <input name="cp" placeholder="Code postal" class="form-control" value="<?php echo $user['cp']; ?>" type="text" id="cp" />
                                                        </div>
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Téléphone</label>
                                                            <input name="tel" placeholder="Téléphone" value="<?php echo $user['tel']; ?>" class="form-control" type="text" id="tel" />                                                        </div>
                                                    </div> 
                                                    <div class="form-group" style="text-align: left;">
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Email</label>
                                                            <input name="email" placeholder="Email" value="<?php echo $user['email']; ?>" class="form-control" type="email" id="email" disabled=""/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="text-align: left;">
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Mot de passe</label>
                                                            <input name="pwd" placeholder="Mot de passe" class="form-control" type="password" id="pwd" required="" />
                                                        </div>
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Confirmer mot de passe</label>
                                                            <input name="pwd2" placeholder="Confirmer mot de passe" class="form-control" type="password" id="pwd1" required="" />
                                                        </div>
                                                    </div> 


                                                    <div class="form-group" style="text-align: left">
                                                        <div class="col-md-6">
                                                            <button  class="btn btn-success btn-lg" type="submit">Modifier </button>

                                                        </div>
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