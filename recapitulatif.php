<!DOCTYPE HTML>
<!--
        Developer : Said KHALID, khalidsaid.box@gmail.com, 2015.
-->
<html>

<head>
    <title>MyVtc</title>
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
		  document.location.href="javascript:history.go(0)";
		 
		}
		
			function modifier()
		{
		  document.location.href="index.php";
		 
		}


        function getPrix() {

            $.ajax({
                method: "GET",
                url: "http://muslimcab.fr/webservice/v1/users/getPrix",
                success: function(data) {
                    var response = JSON.parse(data);

                    for (var i = 0; i < response.length; i++) {
                        window.price = response[i].prix;
                    }
                }
            });


        };



        function getURIParameter(param, asArray) {
            return document.location.search.substring(1).split('&').reduce(function(p, c) {
                var parts = c.split('=', 2).map(function(param) {
                    return decodeURIComponent(param);
                });
                if (parts.length == 0 || parts[0] != param) return (p instanceof Array) && !asArray ? null : p;
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
                                document.getElementById('prix').innerHTML = '<b><i class="fa fa-money"></i> Tarif : ' + price2 + ' €<b>';
                                document.getElementById('depart').innerHTML = '<b><i class="fa fa-location-arrow"></i> ' + getURIParameter("depart") + '<b> ';
                                document.getElementById('arrivee').innerHTML = '<b><i class="fa fa-map-marker"></i> ' + getURIParameter("arrivee"); + ' kilomètres<b> ';
                                document.getElementById('duree').innerHTML = '<b><i class="fa fa-clock-o"></i> ' + dure + '<b>';
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
            <header>
                <h2 style="color: #1E4F93; font-size: ; text-align : center">Recapitulatif</h2>
            </header>
        </section>
        <!-- Intro -->
        <input type='hidden' name="txtpickup" id="txtpickup" />
        <input type='hidden' name="txtdrop" id="txtdrop" />

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
                    <div class="3u 9u(mobile)">
                        <section class="first">
                            <header>
                                <h2 style="color : red;">Depart</h2>
                            </header>
                            <div id="depart" name="depart"></div>
                        </section>
                    </div>
                    <div class="3u 9u(mobile)">
                        <section class="middle">
                            <header>
                                <h2 style="color : red;">Arrivee</h2>
                            </header>
                            <p id="arrivee" name="arrivee"></p>
                        </section>
                    </div>
                    <div class="3u 9u(mobile)">
                        <section class="last">
                            <header>
                                <h2 style="color : red;">Distance</h2>
                            </header>
                            <p id="duree"></p>
                        </section>
                    </div>
                    <div class="3u 9u(mobile)">
                        <section class="middle">
                            <header>
                                <h2 style="color : red;">Prix</h2>
                            </header>
                            <p id="prix" name="prix"></p>
                        </section>
                    </div>
                </div>
                <br>
                <br>
                <footer>
                    <ul class="actions">
                        <?php 
			  if(!isset($_SESSION['id_user'])) {
			  ?>
                      <li><a href="javascript:void(0);" class="button big btn btn-success" data-toggle="modal" data-target="#loginModal">Payer</a></li>
              <?php
				
			   } else
			   {
			 ?>
                    <li><a href="#" class="button big btn btn-success" onclick="javascript:reservation(depart, arrivee, prix, iduser, email);return false;">Payer</a></li>
             <?php
			  }
			?>

                       <li><a href="javascript:modifier()" class="button big btn btn-warning">Modifier</a></li>
                    </ul>
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