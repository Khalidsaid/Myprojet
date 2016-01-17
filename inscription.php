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
        <title>Inscription</title>
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
            form label {color:#000}

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
                    if (isset($_POST['email'])) {
                        $login = mysql_real_escape_string($_POST["email"]);
                        $pwd = mysql_real_escape_string($_POST["pwd"]);
                        $pwd2 = mysql_real_escape_string($_POST["pwd2"]);
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
                        $headers = 'From: info@illico-immat.fr' . "\r\n" .
                                'Reply-To: info@illico-immat.fr' . "\r\n" .
                                'X-Mailer: PHP/' . phpversion();
                        if ($pwd == $pwd2) {
                            $sql_exist = mysql_query("select * from myvtc_users where email='" . $login . "'");
                            $nb = mysql_num_rows($sql_exist);
                            if ($nb == 0) {
                                mysql_query("insert into myvtc_users(type_user,nom,prenom,adresse,cp,ville,tel,email,pwd,date_add,status,parrain,fax,url,siren,tva,societe)values('" . $type_user . "','" . $nom . "','" . $prenom . "','" . $adresse . "','" . $cp . "','" . $ville . "','" . $tel . "','" . $login . "','" . $password . "','" . date('Y-m-d H:i:s') . "',1,'" . $parrain . "','" . $fax . "','" . $url . "','" . $siren . "','" . $tva . "','" . $societe . "')")or die(mysql_error());

                                $_SESSION['myvtclogin'] = $login;
                                $message = "Bonjour Madame, Monsieur,\n

Nous vous remercions de votre visite sur le site ReserverUnCab.com. Vous pouvez des-à-présent profiter des prestations de l'équipe ReserverUnCab.com.\n";
                                mail($login, "Inscription au site ReserverUnCab.com", $message, $headers);
                                echo '<script>window.location="profil.php"</script>';
                            } else {
                                echo '<script>alert("Adresse mail déjà existante !")</script>';
                                echo '<script>history.back()</script>';
                            }
                        } else {
                            echo '<script>alert("Mot de passe éronnée")</script>';
                            echo '<script>history.back()</script>';
                        }
                    }
                    ?>
                    <hr>
                    <div class="container">
                        <div class="row" style="margin-top: 0px;">
                            <div class="col-xs-12">

                                <div class="main">

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">

                                            <blockquote style="text-align: left"><h3>Espace d'inscription</h3></blockquote>

                                            <div class="col-sm-12">
                                                <form action="" name="inscription-form" role="form" class="form-horizontal" method="post" accept-charset="utf-8">

                                                    <div class="form-group" style="text-align: left;">
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <div class="input-group">
                                                                <label style="font-weight: bold;">Vous êtes </label><br>
                                                                <label class="checkbox-inline registeredv" style="font-weight: bold; font-size: 15px" onclick="show_bloc()"><input type="radio" name="type_user" value="Professionnel" checked=""> Professionnel</label>
                                                                <label class="checkbox-inline noregisteredv" style="font-weight: bold; font-size: 15px" onclick="hide_bloc()"><input type="radio" name="type_user" value="Particulier"> Particulier</label>
                                                            </div>
                                                        </div>

                                                    </div> 
                                                    <div class="form-group" style="text-align: left;">
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Prénom</label>
                                                            <input name="prenom" placeholder="Prénom" class="form-control" type="text" id="prenom" required="" />
                                                        </div>
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Nom</label>
                                                            <input name="nom" placeholder="Nom" class="form-control" type="text" id="nom" required="" />
                                                        </div>
                                                    </div> 
                                                    <div class="form-group" style="text-align: left;">
                                                        <div class="col-md-12" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Adresse postale</label>
                                                            <textarea name="adresse" placeholder="Adresse postale" class="form-control" type="text" id="adresse"></textarea>
                                                        </div>
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Ville</label>
                                                            <input name="ville" placeholder="Ville" class="form-control" type="text" id="ville" />
                                                        </div>
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Code postal</label>
                                                            <input name="cp" placeholder="Code postal" class="form-control" type="text" id="cp" />
                                                        </div>
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Téléphone</label>
                                                            <input name="tel" placeholder="Téléphone" class="form-control" type="text" id="tel" />                                                        
                                                        </div>
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Parrain</label>
                                                            <input name="parrain" placeholder="Parrain" class="form-control" type="text" id="parrain" />                                                        
                                                        </div>
                                                    </div> 
                                                    <div class="form-group" style="text-align: left;">
                                                        <div class="col-md-6" style="padding-top: 10px;">
                                                            <label style="font-weight: bold;">Email</label>
                                                            <input name="email" placeholder="Email" class="form-control" type="email" id="email" required=""/>
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
                                                    <div class="form-group" style="text-align: left;">
                                                        <div id="bloc_pro">
                                                            <div class="col-md-6" style="padding-top: 10px;">

                                                                <label style="font-weight: bold;">Société</label>
                                                                <input type="text" name="societe" class="form-control" placeholder="Société">
                                                            </div>
                                                            <div class="col-md-6" style="padding-top: 10px;">
                                                                <label style="font-weight: bold;">Fax</label>
                                                                <input type="text" name="fax" class="form-control" placeholder="Fax">
                                                            </div>

                                                            <div class="col-md-6" style="padding-top: 10px;">
                                                                <label style="font-weight: bold;">Site web</label>
                                                                <input type="text" name="url" class="form-control" placeholder="Site web">
                                                            </div>


                                                            <div class="col-md-6" style="padding-top: 10px;">
                                                                <label style="font-weight: bold;">SIREN</label>
                                                                <input type="text" name="siren" class="form-control" placeholder="SIREN">
                                                            </div>
                                                            <div class="col-md-6" style="padding-top: 10px;">
                                                                <label style="font-weight: bold;">Numéro TVA</label>
                                                                <input type="text" name="tva" class="form-control" placeholder="Numéro TVA">
                                                            </div>
                                                        </div>
                                                    </div> 


                                                    <div class="form-group" style="text-align: left">
                                                        <div class="col-md-6">
                                                            <button  class="btn btn-success btn-lg" type="submit">Valider </button>

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