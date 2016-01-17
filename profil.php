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
        <title>Mon compte</title>
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
        <script>
            function hide_bloc() {
                $("#bloc_pro").hide();
            }
            function show_bloc() {
                $("#bloc_pro").show();
            }
        </script>
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
                    if (isset($_POST['pwd'])) {
                        $login = mysql_real_escape_string($_POST["email"]);
                        $pwd = mysql_real_escape_string($_POST["pwd"]);
                        $prenom = mysql_real_escape_string($_POST["prenom"]);
                        $nom = mysql_real_escape_string($_POST["nom"]);
                        $adresse = mysql_real_escape_string($_POST["adresse"]);
                        $cp = mysql_real_escape_string($_POST["cp"]);
                        $ville = mysql_real_escape_string($_POST["ville"]);
                        $tel = mysql_real_escape_string($_POST["tel"]);
                        $parrain = mysql_real_escape_string($_POST["parrain"]);
                        $type_user = mysql_real_escape_string($_POST["type_user"]);
                        $fax = mysql_real_escape_string($_POST["fax"]);
                        $url = mysql_real_escape_string($_POST["url"]);
                        $siren = mysql_real_escape_string($_POST["siren"]);
                        $tva = mysql_real_escape_string($_POST["tva"]);
                        $societe = mysql_real_escape_string($_POST["societe"]);
                        $password = md5($pwd);

                        mysql_query("update myvtc_users set nom='" . $nom . "',prenom='" . $prenom . "',adresse='" . $adresse . "',ville='" . $ville . "',cp='" . $tel . "',nom='" . $tel . "',pwd='" . $password . "',parrain='" . $parrain . "',type_user='" . $type_user . "',societe='" . $societe . "',fax='" . $fax . "',url='" . $url . "',siren='" . $siren . "',tva='" . $tva . "' where email='" . $_SESSION['myvtclogin'] . "'")or die(mysql_error());

                       
                        echo '<script>alert("Modification effectuée avec succès !");</script>';
                        echo '<script>window.location="profil.php"</script>';
                    }
                    ?>
                    <hr>
                    <div class="container">
                        <div class="row" style="margin-top: 0px;">
                            <div class="col-xs-12">

                                <div class="main">

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">

                                            <div class="col-sm-3 well">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li class="active"><a href="profil.php"> <i class="fa fa-user"></i> Mon compte</a></li>
                                                    <li ><a href="commande.php"> <i class="fa fa-money"></i> Mes commandes</a></li>
                                                    <li><a href="deconnect.php"> <i class="fa fa-sign-out"></i> Déconnexion</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-9">
                                                <form action="" name="inscription-form" role="form" class="form-horizontal" method="post" accept-charset="utf-8">
                                                    <div class="form-group" style="text-align: left;">
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <div class="input-group">
                                                                <label style="font-weight: bold;">Vous êtes </label><br>
                                                                <label class="checkbox-inline registeredv" style="font-weight: bold; font-size: 15px" onclick="show_bloc()"><input type="radio" name="type_user" value="Professionnel" <?php if ($user['type_user'] == "Professionnel") echo "checked=''"; ?> > Professionnel</label>
                                                                <label class="checkbox-inline noregisteredv" style="font-weight: bold; font-size: 15px" onclick="hide_bloc()"><input type="radio" name="type_user" value="Particulier" <?php if ($user['type_user'] == "Particulier") echo "checked=''"; ?>> Particulier</label>
                                                            </div>
                                                        </div>

                                                    </div> 
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
                                                            <input name="tel" placeholder="Téléphone" value="<?php echo $user['tel']; ?>" class="form-control" type="text" id="tel" />                                                       
                                                        </div>
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Parrain</label>
                                                            <input name="parrain" placeholder="Parrain" value="<?php echo $user['parrain']; ?>" class="form-control" type="text" id="tel" />                                                       
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="text-align: left;">
                                                        <div id="bloc_pro" <?php if ($user['type_user'] == "Particulier") echo "style=display:none"; ?>>
                                                            <div class="col-md-6" style="padding-top: 10px;">

                                                                <label style="font-weight: bold;">Société</label>
                                                                <input type="text" name="societe" class="form-control" placeholder="Société" value="<?php echo $user['societe']; ?>">
                                                            </div>
                                                            <div class="col-md-6" style="padding-top: 10px;">
                                                                <label style="font-weight: bold;">Fax</label>
                                                                <input type="text" name="fax" class="form-control" placeholder="Fax" value="<?php echo $user['fax']; ?>">
                                                            </div>

                                                            <div class="col-md-6" style="padding-top: 10px;">
                                                                <label style="font-weight: bold;">Site web</label>
                                                                <input type="text" name="url" class="form-control" placeholder="Site web" value="<?php echo $user['url']; ?>">
                                                            </div>


                                                            <div class="col-md-6" style="padding-top: 10px;">
                                                                <label style="font-weight: bold;">SIREN</label>
                                                                <input type="text" name="siren" class="form-control" placeholder="SIREN" value="<?php echo $user['siren']; ?>">
                                                            </div>
                                                            <div class="col-md-6" style="padding-top: 10px;">
                                                                <label style="font-weight: bold;">Numéro TVA</label>
                                                                <input type="text" name="tva" class="form-control" placeholder="Numéro TVA" value="<?php echo $user['tva']; ?>">
                                                            </div>
                                                        </div>
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