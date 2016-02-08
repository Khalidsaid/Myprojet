<?php
include("config.php");
$menu = 1;
$chaine_cmd = "Reservation sur ReserverUnCab";
// Identifiant unique
$identifiant = uniqid();
$_SESSION['reference'] = $identifiant;
$depart = $_GET['depart'];
$arrivee = $_GET['arrivee'];
$totalpers = $_GET['totalpers'];
$totalbag = $_GET['totalbag'];
$datedep_tab = explode("/", $_GET['datedep']);
$datedep = $datedep_tab[2] . "-" . $datedep_tab[0] . "-" . $datedep_tab[1];
$date_affichage=$datedep_tab[1] . "/" . $datedep_tab[0] . "/" . $datedep_tab[2];
$heyres = $_GET['heyres'];
date_default_timezone_set('Europe/Paris');
$date = date('Y-m-d H:i:s');

$requete = "insert into reservation_attente(codecommande,depart, arrivee,passager,valise,dtdeb,heure,distance,  date_add, etat) values ('" . addslashes($identifiant) . "', '" . addslashes($depart) . "', '" . addslashes($arrivee) . "', '" . addslashes($totalpers) . "', '" . addslashes($totalbag) . "', '" . trim($datedep) . "', '" . addslashes($heyres) . "', '" . addslashes($distance) . "', '" . addslashes($date) . "', 0);";
$exec = mysql_query($requete)or die(mysql_error());
/* if(mysql_query($requete)){
  echo '<script>alert("requete réussi !")</script>';
  }else{
  echo '<script>alert("requete non reussi !")</script>';
  } */
$nb == 0;
if (isset($_SESSION['myvtclogin'])) {
    $user = mysql_fetch_array(mysql_query("select * from myvtc_users where email='" . $_SESSION['myvtclogin'] . "'"));
    $check = mysql_fetch_array(mysql_query("select COUNT(*) as total from myvtc_users where parrain= '" . $_SESSION['myvtclogin'] . "'"));

    if ($user['promos'] == 1) {
        if ($check['total'] >= 1) {

            $sql = mysql_query("select * from reservation_attente inner join myvtc_users on reservation_attente.id_user= myvtc_users.id where parrain IS NOT NULL AND etat=1 AND id_user=" . $user['id']);
            $nb = mysql_num_rows($sql);
        }
    }
}


$user = mysql_fetch_array(mysql_query("select * from myvtc_users where email='" . $_SESSION['myvtclogin'] . "'"));
if ($user['type_user'] == 'Professionnel') {
    $req = mysql_fetch_array(mysql_query("select prixpro from prixkm where id=1"));
    $rr = $req['prixpro'];
    //prix pro
    echo "<script>window.pricepro = " . $rr . "</script>";
} else {
    echo "<script>window.pricepro = 0;</script>";
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
            var pricepro;
            var codepromo = 0;
            var avanceoufutur = 0;
            var prixtotal = 0;

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
                            //alert(response[i].value);
                            if (code == response[i].code)
                            {
                                codepromo = response[i].montant;
                                var mareponse = getURIParameter("offre");
                                if (mareponse == 39)
                                {
                                    alert("Les codes promos ne sont pas valable sur les offres aéroports");
                                }
                                else
                                {
                                    alert("Code ajouté avec succès !");
                                }
                                document.getElementById('codepromo').value = "";
                                calculDistance();
                                return true;
                            } else
                            {
                                alert("Code non valide !");
                                document.getElementById('codepromo').value = "";
                                return false;
                            }

                        }
                    }

                });


            }

            function checkParis(aero)
            {
                var aeroports = "Paris";
                if (aero.indexOf(aeroports) >= 0) {
                    return true;
                } else {
                    return false;
                }
            }

            function checkOrly(aero)
            {
                var aeroports = "Aéroport de Paris-Orly, Orly";
                if (aero.indexOf(aeroports) >= 0) {
                    return true;
                } else {
                    return false;
                }
            }
            function checkAero(aero)
            {
                var aeroports = "Aéroport";
                if (aero.indexOf(aeroports) >= 0) {
                    return true;
                } else {
                    return false;
                }
            }
            function checkCharlle(aero)
            {
                var aeroports = "Aéroport Charles-de-Gaulle, Roissy-en-France";
                if (aero.indexOf(aeroports) >= 0) {
                    return true;
                } else {
                    return false;
                }
            }
            function checkBeauvais(aero)
            {
                var aeroports = "Aéroport de Beauvais";
                if (aero.indexOf(aeroports) >= 0) {
                    return true;
                } else {
                    return false;
                }
            }
            function checkBourget(aero)
            {
                var aeroports = "Aéroport de Paris - Le Bourget, Le Bourget, France";
                if (aero.indexOf(aeroports) >= 0) {
                    return true;
                } else {
                    return false;
                }
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

            function reservation() {
                var price = document.getElementById("amounttxt").value;
                var ref = document.getElementById("myref").value;

                $.ajax({
                    url: 'reservation.php?price=' + price + "&ref=" + ref,
                    success: function (data) {
                        var t = eval(data);
                        document.paypal.submit();
                    }
                });



            }

            function checkAdvanceorAsap() {

                //Heure courante.

                var EnteredDate = getURIParameter("datedep");

                var now = new Date();

                var annee = now.getFullYear();
                var mois = ('0' + now.getMonth() + 1).slice(-2);
                var jour = ('0' + now.getDate()).slice(-2);

                //var EnteredDate = document.getElementById("datedep").value; //for javascript
                //var EnteredDate = $("#datedep").val(); // For JQuery

                var month = EnteredDate.substring(0, 2);
                var date = EnteredDate.substring(3, 5);
                var year = EnteredDate.substring(6, 10);


                //Test date courante et date séléctionné
                if (date == jour && year == annee && month == mois)
                {
                    window.avanceoufutur = 15;
                    return true;
                } else
                {
                    window.avanceoufutur = 8;
                    return false;
                }

            }

            function checkGare(aero)
            {
                var aeroports = "Gare";
                if (aero.indexOf(aeroports) >= 0) {
                    return true;
                } else {
                    return false;
                }
            }

            function callback(response, status) {

                //r?cup?ration des champs du formulaire
                var adr_dep = getURIParameter("depart");
                var adr_arr = getURIParameter("arrivee");



                // Prix fixe aéroports

                var a = checkOrly(adr_dep);
                var b = checkOrly(adr_arr);

                var c = checkBeauvais(adr_dep);
                var d = checkBeauvais(adr_arr);

                var e = checkCharlle(adr_dep);
                var f = checkCharlle(adr_arr);

                var g = checkBourget(adr_dep);
                var h = checkBourget(adr_arr);

                // Verifier si le départ est un aeroport et l'arrivée
                var aero_dep = checkAero(adr_dep);
                var aero_arr = checkAero(adr_arr);

                var chkdep = checkParis(adr_dep);
                var chkarr = checkParis(adr_arr);

                var mavar = checkGare(adr_dep);
                var mavar2 = checkParis(adr_dep);
                var mavar3 = checkParis(adr_arr);
                var mavar4 = checkParis(adr_dep);
                var mavar5 = checkGare(adr_arr);

                //Vérifier si la réservation est le jour même
                var todayoradvance = checkAdvanceorAsap();
                //alert(todayoradvance);

                if ((mavar == true && mavar2 == true && mavar3 == true) || (mavar4 == true && mavar5 == true && mavar3 == true))
                {
                    window.prixtotal = 19;
                    rep = true;
                } else
                {

                    var rep = false;
                }

                if (rep == false && (a == true && b == true) || (c == true && d == true) || (e == true && f == true) || (g == true && h == true))
                {
                    window.prixtotal = 0;
                    rep = true;
                } else if (rep == false && (aero_dep == true && chkarr == true) || (aero_arr == true && chkdep == true) || (aero_dep == true && aero_arr == true))
                {
                    if (rep == false && (a == true && chkarr == true) || (b == true && chkdep == true))
                    {
                        window.prixtotal = 39;
                        rep = true;
                    } else if (rep == false && (c == true && chkarr == true) || (d == true && chkdep == true))
                    {
                        window.prixtotal = 110;
                        rep = true;
                    } else if (rep == false && (e == true && chkarr == true) || (f == true && chkdep == true))
                    {
                        window.prixtotal = 49;
                        rep = true;
                    } else if (rep == false && (g == true && chkarr == true) || (h == true && chkdep == true))
                    {
                        window.prixtotal = 59;
                        rep = true;
                    } else if (rep == false && (b == true && e == true) || (a == true && f == true))
                    {
                        window.prixtotal = 69;
                        rep = true;
                    } else if (rep == false)
                    {
                        window.prixtotal = 0;
                        rep = true;
                    }
                }


                if (status != google.maps.DistanceMatrixStatus.OK) {
                    alert('Erreur : ' + status); //message d'erreur du serveur distant GG Maps
                } else {
                    //rponses du serveur 
                    var origins = response.originAddresses;
                    var destinations = response.destinationAddresses;


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
                                    if (window.prixtotal > 0)
                                    {

                                        prix = window.prixtotal;
                                    }

                                    if (window.prixtotal == 0 && window.pricepro > 0)
                                    {

                                        prix = Math.round(parseInt(dist / 1000) * window.pricepro);

                                    } else if (window.prixtotal == 0 && window.pricepro == 0)
                                    {

                                        prix = Math.round(parseInt(dist / 1000) * window.price);
                                    }


                                    if ((prix < 15 && todayoradvance == true))
                                    {
                                        //window.prixtotal = window.avanceoufutur;
                                        //prix = window.prixtotal;
                                        prix = 15;
                                        document.getElementById('duree').innerHTML = '<b><i class="fa fa-clock-o"></i> ' + dure + '<b>';
                                        document.getElementById('prix').innerHTML = '<b><i class="fa fa-money"></i> Tarif : ' + prix + ' €<b>';
                                        document.getElementById('amount').value = prix;
                                        document.getElementById('distance').innerHTML = '<b><i class="fa fa-car"></i> ' + parseInt(dist / 1000) + ' kilomètres<b> '; //distance en km
                                        document.getElementById('depart').innerHTML = '<b> ' + getURIParameter("depart") + '<b> ';
                                        document.getElementById('arrivee').innerHTML = '<b>' + getURIParameter("arrivee");
                                        document.getElementById('amounttxt').value = prix;
                                    } else if ((prix < 8 && todayoradvance == false))
                                    {
                                        prix = 8;
                                        document.getElementById('duree').innerHTML = '<b><i class="fa fa-clock-o"></i> ' + dure + '<b>';
                                        document.getElementById('prix').innerHTML = '<b><i class="fa fa-money"></i> Tarif : ' + prix + ' €<b>';
                                        document.getElementById('distance').innerHTML = '<b><i class="fa fa-car"></i> ' + parseInt(dist / 1000) + ' kilomètres<b> '; //distance en km
                                        document.getElementById('amount').value = prix;
                                        document.getElementById('depart').innerHTML = '<b> ' + getURIParameter("depart") + '<b> ';
                                        document.getElementById('arrivee').innerHTML = '<b>' + getURIParameter("arrivee");
                                        document.getElementById('amounttxt').value = prix;

                                    }

                                    if (prix > 15)
                                    {
                                        prix = (prix - window.codepromo);
                                        document.getElementById('duree').innerHTML = '<b><i class="fa fa-clock-o"></i> ' + dure + '<b>';
                                        document.getElementById('prix').innerHTML = '<b><i class="fa fa-money"></i> Tarif : ' + prix + ' €<b>';
                                        document.getElementById('distance').innerHTML = '<b><i class="fa fa-car"></i> ' + parseInt(dist / 1000) + ' kilomètres<b> '; //distance en km
                                        document.getElementById('amount').value = prix - window.codepromo;
                                        document.getElementById('depart').innerHTML = '<b> ' + getURIParameter("depart") + '<b> ';
                                        document.getElementById('arrivee').innerHTML = '<b>' + getURIParameter("arrivee");
                                        document.getElementById('amounttxt').value = prix;
                                    }
                                    window.prixtotal = 0;

                                } else if (statut == 'NOT_FOUND') {
                                    alert("impossible de localiser l'adresse d'arrivée");
                                } else if (statut == 'ZERO_RESULTS') {
                                    alert("impossible de calculer cette distance");
                                }
                            }
                        } else {
                            alert("impossible de localiser l'adresse de depart");
                        }
                    }
                }


            }



            function checkParis(aero)
            {
                var aeroports = "Paris";
                if (aero.indexOf(aeroports) >= 0) {
                    return true;
                } else {
                    return false;
                }
            }

            function checkOrly(aero)
            {
                var aeroports = "Aéroport de Paris-Orly, Orly";
                if (aero.indexOf(aeroports) >= 0) {
                    return true;
                } else {
                    return false;
                }
            }
            function checkCharlle(aero)
            {
                var aeroports = "Aéroport Charles-de-Gaulle, Roissy-en-France";
                if (aero.indexOf(aeroports) >= 0) {
                    return true;
                } else {
                    return false;
                }
            }
            function checkBeauvais(aero)
            {
                var aeroports = "Aéroport de Beauvais";
                if (aero.indexOf(aeroports) >= 0) {
                    return true;
                } else {
                    return false;
                }
            }
            function checkBourget(aero)
            {
                var aeroports = "Aéroport de Paris - Le Bourget, Le Bourget, France";
                if (aero.indexOf(aeroports) >= 0) {
                    return true;
                } else {
                    return false;
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
                <input name="notify_url" type="hidden" value="/paiementValide.php" />
                <input name="cmd" type="hidden" value="_xclick" />
                <input name="business" type="hidden" value="reserveruncab@gmail.com" />
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

                                <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-clock-o"></i> Date</div>
                                <div class="col-md-8" style="text-align: left">  <p style="font-size: 22px;"><b><?php echo $date_affichage . " à " . $heyres; ?></b></p></div>
                            </div>
                            <hr style="border: 1px dashed ! important;">
                            <div class="row">
                                <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-map-marker"></i> Adresse de départ</div>
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

                            <hr style="border: 1px dashed ! important;">
                            <div class="row">
                                <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-space-shuttle"></i> Distance</div>
                                <div class="col-md-8" style="text-align: left">  <p style="font-size: 22px;"><b id="distance"></b></p></div>
                            </div>
                            <hr style="border: 1px dashed ! important;">
                            <div class="row">
                                <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-suitcase"></i> Valises</div>
                                <div class="col-md-8" style="text-align: left">  <p style="font-size: 22px;"><b><?php echo $_GET['totalbag'];  ?></b></p></div>
                            </div>
                            <hr style="border: 1px dashed ! important;">
                            <div class="row">
                                <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-users"></i> Passagers</div>
                                <div class="col-md-8" style="text-align: left">  <p style="font-size: 22px;"><b><?php echo $_GET['totalpers'];  ?></b></p></div>
                            </div>



                            <script type="text/javascript">
                                var rep = getURIParameter("depart");
                                var bool = checkParis(rep);

<?php $marep = "<script>document.write(bool);</script>"; ?>
                            </script>

<?php
//echo $marep;
if ($nb != 9) {
    ?>
                                <hr style="border: 1px dashed ! important;">
                                <div class="row">
                                    <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-money"></i> Prix</div>
                                    <div class="col-md-8" style="text-align: left"> <p id="prix" name="prix" style="font-size: 22px;"></p><input type="hidden" id="amounttxt" /><input type="hidden" value="<?php echo $identifiant; ?>" id="myref" /></div>
                                </div>
    <?php
} if ($nb == 9 and $marep == true) {
    ?>
                                <hr style="border: 1px dashed ! important;">
                                <div class="row">
                                    <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-money"></i> Prix</div>
                                    <div class="col-md-8" style="text-align: left"><input type="hidden" id="amounttxt" /><span id="prix" name="prix" value="0" style="width: 0px; color: rgb(255, 255, 255) ! important; display: none;"></span><input type="hidden" value="<?php echo $identifiant; ?>" id="myref" /> <p  style="font-size: 22px;">Gratuit (offre parrainage de la 10e course)</p></div>
                                </div>
    <?php
} else if ($nb == 9 and $marep == false) {
    ?>
                                <hr style="border: 1px dashed ! important;">
                                <div class="row">
                                    <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;"><i class="fa fa-money"></i> Prix</div>
                                    <div class="col-md-8" style="text-align: left"> <p id="prix" name="prix" style="font-size: 22px;"></p><input type="hidden" id="amounttxt" /><input type="hidden" value="<?php echo $identifiant; ?>" id="myref" /></div>
                                </div>
    <?php
}
?>

                            <hr style="border: 1px dashed ! important;">


                            <div class="row">
                                <div class="col-md-4" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;">Code Promo ?</div>
                                <div class="col-md-3" style="text-align: left; color: rgb(30, 79, 147); font-size: 17px;">
                                    <input step="border-left-width: 0px;" type="text" id="codepromo" size="10" name="codepromo" class="form-control" placeholder="Code promo"/>

                                    <br>
                                    <button type="button" class="btn btn-info col-md-12" onclick="javascript:checkCode();">Appliquer</button>
                                </div>
                                <div class="col-md-8" style="text-align: left"><?php
if (!isset($_SESSION['myvtclogin'])) {
    ?>
                                        <a href="javascript:void(0);" class="button big btn btn-success" data-toggle="modal" data-target="#loginModal">Payer</a>
    <?php
} else {
    if ($nb == 9 && $marep == true) {
        ?>
                                            <a href="paiementValide.php" class="button big btn btn-success">Confirmer</a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="#" class="button big btn btn-success" onclick="javascript:reservation();
                                                            return false;">Payer</a>

                                            <?php
                                        }
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