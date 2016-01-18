<?php
include("config.php");
$chaine_cmd = "";
// Identifiant unique
$identifiant = uniqid();
$depart = $_GET['depart'];
$arrivee = $_GET['arrivee'];
$totalpers = $_GET['totalpers'];
$totalbag = $_GET['totalbag'];
$datedep_tab = explode("/", $_GET['datedep']);
$datedep = $datedep_tab[2] . "-" . $datedep_tab[0] . "-" . $datedep_tab[1];
$heyres = $_GET['heyres'];
$distance = $_GET['distance'];
date_default_timezone_set('Europe/Paris');
$date = date('Y-m-d H:i:s');

$requete = "insert into reservation_attente(codecommande,depart, arrivee,passager,valise,dtdeb,heure,distance,  date_add, etat) values ('" . addslashes($identifiant) . "', '" . addslashes($depart) . "', '" . addslashes($arrivee) . "', '" . addslashes($totalpers) . "', '" . addslashes($totalbag) . "', '" . addslashes($datedep) . "', '" . addslashes($heyres) . "', '" . addslashes($distance) . "', '" . addslashes($date) . "', 0);";
$exec = mysql_query($requete)or die(mysql_error());
/* if(mysql_query($requete)){
  echo '<script>alert("requete réussi !")</script>';
  }else{
  echo '<script>alert("requete non reussi !")</script>';
  } */
$nb == 0;
if (isset($_SESSION['myvtclogin'])) {
    $user = mysql_fetch_array(mysql_query("select * from myvtc_users where email='" . $_SESSION['myvtclogin'] . "'"));
    if ($user['promos'] == 1) {
        $sql = mysql_query("select * from reservation where id_user=" . $user['id']);
        $nb = mysql_num_rows($sql);
    }
}
?>
<!DOCTYPE HTML>

<html>

    <head>
        <title>Récapitulatif</title>
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



        <script type="text/javascript" src="http://maps.google.com/maps/api/js?language=fr"></script>

        <script type="text/javascript">
            var price2 = "undefined";

            function onload() {
                calculDistance();
                getPrix();
            }

            function isNumber(n) {
                return !isNaN(parseFloat(n)) && isFinite(n);
            }

            function annuler()
            {
                document.location.href = "javascript:history.go(0)";

            }

            function modifier()
            {
                document.location.href = "index.php";

            }


            function getPrix() {

                $.ajax({
                    method: "GET",
                    url: "http://reserveruncab.com/webservice/v1/users/getPrix",
                    success: function (data) {
                        var response = JSON.parse(data);

                        for (var i = 0; i < response.length; i++) {
                            window.price = response[i].prix;
                        }
                    }
                });


            }


            function checkCode()
            {
                var code = document.getElementById('codepromo').value;

                $.ajax({
                    method: "GET",
                    url: "http://reserveruncab.com/webservice/v1/users/getCodepromo",
                    success: function (data) {
                        var response = JSON.parse(data);

                        for (var i = 0; i < response.length; i++)
                        {
                            if (code == response[i].value)
                            {
                                return true;
                            } else
                            {
                                return false;
                            }

                        }
                    }
                });


            }



            function getURIParameter(param, asArray) {
                return document.location.search.substring(1).split('&').reduce(function (p, c) {
                    var parts = c.split('=', 2).map(function (param) {
                        return decodeURIComponent(param);
                    });
                    if (parts.length == 0 || parts[0] != param)
                        return (p instanceof Array) && !asArray ? null : p;
                    return asArray ? p.concat(parts.concat(true)[1]) : parts.concat(true)[1];
                }, []);
            }

            function calculDistance() {

                //r?cup?ration des champs du formulaire


                var adr_dep = getURIParameter("depart");
                var adr_arr = getURIParameter("arrivee");

                var origine = adr_dep;
                var destination = adr_arr;

                //requ?te de distance aupr?s du service DistanceMatrix, avec ici une seule adresse de d?part et une seule d'arriv?e
                var service = new google.maps.DistanceMatrixService();
                service.getDistanceMatrix({
                    origins: [origine],
                    destinations: [destination],
                    travelMode: google.maps.TravelMode.DRIVING,
                    unitSystem: google.maps.UnitSystem.METRIC,
                    avoidHighways: false,
                    avoidTolls: false
                }, callback);


            }

            function callback(response, status) {
                if (status != google.maps.DistanceMatrixStatus.OK) {
                    alert('Erreur : ' + status); //message d'erreur du serveur distant GG Maps
                } else {
                    //rponses du serveur 
                    var origins = response.originAddresses;
                    var destinations = response.destinationAddresses;
                    window.price = 5;

                    for (var i = 0; i < origins.length; i++) {
                        var results = response.rows[i].elements;
                        var dep = origins[i];
                        if (dep != '') {
                            for (var j = 0; j < results.length; j++) {
                                var element = results[j];
                                var statut = element.status;
                                var arr = destinations[j];
                                if (statut == 'OK') {
                                    var dist = element.distance.value;
                                    var dure = element.duration.text;
                                    price2 = Math.round(parseInt(dist / 1000) * window.price);
                                    document.getElementById('prix').innerHTML = '<b>' + price2 + ' €<b>';
                                    document.getElementById('depart').innerHTML = '<b> ' + getURIParameter("depart") + '<b> ';
                                    document.getElementById('arrivee').innerHTML = '<b>' + getURIParameter("arrivee");
                                    +' kilomètres<b> ';
                                    document.getElementById('duree').innerHTML = '<b> ' + dure + '<b>';
                                    document.getElementById('amount').value = Math.round(parseInt(dist / 1000) * window.price);
                                } else if (statut == 'NOT_FOUND') {
                                    //alert("impossible de localiser l'adresse d'arrivee");
                                } else if (statut == 'ZERO_RESULTS') {
                                    //alert("impossible de calculer cette distance");
                                }
                            }
                        } else {
                            //alert("impossible de localiser l'adresse de depart");
                        }
                    }
                }


            }
        </script>
        <script>
            function connexion() {
                var login = document.getElementById("login_user").value;
                var pwd = document.getElementById("pwd_user").value;
                $.ajax({
                    url: 'connect.php?login=' + login + '&pwd=' + pwd,
                    success: function (data) {
                        var t = eval(data);
                        if (t[0]["message"] == "ok") {


                            location.reload();

                        } else {
                            alert("Veuillez vérifier vos paramètres de connexion !");

                        }
                    }
                });
            }
        </script>
        <style>
            form input {padding-bottom: 0px !important; padding-top: 0px !important;}

        </style>
    </head>

    <body onload="javascript:onload()" class="homepage">


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

                </div>
            </div>
            <section>

            </section>
            <!-- Intro -->


            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="paypal" name="paypal" method="post">


                <!--Paypal !-->
                <input type='hidden' name="amount" id="amount" />
                <input name="currency_code" type="hidden" value="EUR" />
                <input name="shipping" type="hidden" value="0.00" />
                <input name="tax" type="hidden" value="0.00" />
                <input name="return" type="hidden" value="/paiementValide.php" />
                <input name="cancel_return" type="hidden" value="/paiementAnnule.php" />
                <input name="notify_url" type="hidden" value="/validationPaiement.php" />
                <input name="cmd" type="hidden" value="_xclick" />
                <input name="business" type="hidden" value="ad.prestiges@gmail.com" />
                <input name="item_name" type="hidden" value="<?php echo $chaine_cmd; ?>" />
                <input name="no_note" type="hidden" value="1" />
                <input name="lc" type="hidden" value="FR" />
                <input name="bn" type="hidden" value="PP-BuyNowBF" />
                <input name="custom" type="hidden" value="<?php echo $identifiant; ?>" />


                <section>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <blockquote style="text-align: left"><h3>Récapitulatif </h3></blockquote>
                            <div class="row">
                                <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-arrow-circle-left"></i> Adresse de départ</div>
                                <div class="col-md-8" style="text-align: left"> <div id="depart" name="depart" style="font-size: 22px;"></div> </div>
                            </div>
                            <hr style="border: 1px dashed ! important;">
                            <div class="row">
                                <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-map-marker"></i> Adresse d'arrivée</div>
                                <div class="col-md-8" style="text-align: left"> <p id="arrivee" name="arrivee" style="font-size: 22px;"></p></div>
                            </div>
                            <hr style="border: 1px dashed ! important;">
                            <div class="row">
                                <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-clock-o"></i> Durée</div>
                                <div class="col-md-8" style="text-align: left">  <p id="duree" style="font-size: 22px;"></p></div>
                            </div>
                            <?php
                            if ($distance != 'undefined') {
                                ?>
                                <hr style="border: 1px dashed ! important;">
                                <div class="row">
                                    <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-clock-o"></i> Distance</div>
                                    <div class="col-md-8" style="text-align: left">  <p style="font-size: 22px;"><b><?php echo $distance; ?></b></p></div>
                                </div>
                                <?php
                            }
                            ?>
                            <hr style="border: 1px dashed ! important;">
                            <div class="row">
                                <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-clock-o"></i> Date</div>
                                <div class="col-md-8" style="text-align: left">  <p style="font-size: 22px;"><b><?php echo $datedep . " à " . $heyres; ?></b></p></div>
                            </div>
                            <?php
                            if ($nb != 9) {
                                ?>
                                <hr style="border: 1px dashed ! important;">
                                <div class="row">
                                    <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-money"></i> Prix</div>
                                    <div class="col-md-8" style="text-align: left"> <p id="prix" name="prix" style="font-size: 22px;"></p></div>
                                </div>
                                <?php
                            } if ($nb == 9) {
                                ?>
                                <hr style="border: 1px dashed ! important;">
                                <div class="row">
                                    <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-money"></i> Prix</div>
                                    <div class="col-md-8" style="text-align: left"><span id="prix" name="prix" style="width: 0px; color: rgb(255, 255, 255) ! important; display: none;"></span> <p  style="font-size: 22px;">Gratuit</p></div>
                                </div>
                                <?php
                            }
                            ?>
                            <hr style="border: 1px dashed ! important;">
                            <div class="row">
                                <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;">Code Promo ?</div>
                                <div class="col-md-3" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;">
                                    <input step="border-left-width: 0px;" type="text" id="depart" size="10" name="depart" class="form-control" placeholder="Code promo" onkeypress="javascript:checkCode()" />
                                    <br>
                                    <button type="button" class="btn btn-info col-md-12" onclick="javascript:checkCode();">Appliquer</button>
                                </div>
                                <div class="col-md-8" style="text-align: left"><?php
                                    if (!isset($_SESSION['myvtclogin'])) {
                                        ?>
                                        <a href="javascript:void(0);" class="button big btn btn-success" data-toggle="modal" data-target="#loginModal">Payer</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="#" class="button big btn btn-success" onclick="javascript:reservation(depart, arrivee, prix, iduser, email);
                                                    return false;">Payer</a>
                                           <?php
                                       }
                                       ?> <a href="javascript:modifier()" class="button big btn btn-warning">Modifier</a></div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-2"></div>

                    </div>
                    <br>
                    <br>
                    <footer>

                        <br><br>
                    </footer>
                </section>
            </form>

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