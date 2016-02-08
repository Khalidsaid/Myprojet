<?php
include("../config.php");
include("util.php");
if (!isset($_SESSION['backend']))
    header("location:login.php");
$client = mysql_fetch_array(mysql_query("select myvtc_users.nom,myvtc_users.prenom, chauffeur.nom, chauffeur.prenom as chauff, chauffeur.nom as name, reservation_attente.heure,reservation_attente.depart,myvtc_users.tel,reservation_attente.arrivee,reservation_attente.id,reservation_attente.dtdeb,reservation_attente.prix from chauffeur, myvtc_users, reservation_attente where  reservation_attente.id_user = myvtc_users.id and chauffeur.id_chauffeur=reservation_attente.chauffeur and reservation_attente.id=" . $_GET['id']));
$pourcentage = mysql_fetch_array(mysql_query("select * from pourcentage where id=1"));
$nom_chauffeur = mysql_fetch_array(mysql_query("select * from chauffeur where id_chauffeur =" . $data['chauffeur']));


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
<!doctype html>
<html>
    <head>
	
		<script>
		
		    var price2 = "undefined";
            var pricepro;
            var codepromo = 0;
			var avanceoufutur = 0;
			var prixtotal = 0;
			
          function onload() {
                getprix();
         

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
                var aeroports = "Aéroport de Orly, Orly";
                if (aero.indexOf(aeroports) >= 0) {
                    return true;
                } else {
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
			
			// init map google with itineraire and autocomplete

            function initMap() {
                var a = document.getElementById("depart").value;
               
                var origin_place_id = null;
                var destination_place_id = null;
                var travel_mode = google.maps.TravelMode.DRIVING;
                var map = new google.maps.Map(document.getElementById('bannner'), {
                    mapTypeControl: true,
                    zoom: 9,
                    navigationControl: true,
                    mapTypeControl: true,
                            scaleControl: true,
                    draggable: true,
                    componentRestrictions: {
                        country: "fr"
                    }
                });


                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;
                directionsDisplay.setMap(map);

                var origin_input = document.getElementById('depart');
                var destination_input = document.getElementById('arrivee');

                var origin_autocomplete = new google.maps.places.Autocomplete(origin_input);
                origin_autocomplete.bindTo('bounds', map);
                var destination_autocomplete =
                        new google.maps.places.Autocomplete(destination_input);
                destination_autocomplete.bindTo('bounds', map);

                // Sets a listener on a radio button to change the filter type on Places
                // Autocomplete.


                function expandViewportToFitPlace(map, place) {
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                }

                origin_autocomplete.addListener('place_changed', function () {
                    codeAddress();
                    var place = origin_autocomplete.getPlace();
                    if (!place.geometry) {
                        window.alert("Autocomplete's returned place contains no geometry");
                        return;
                    }
                    expandViewportToFitPlace(map, place);

                    // If the place has a geometry, store its place ID and route if we have
                    // the other place ID
                    origin_place_id = place.place_id;
                    route(origin_place_id, destination_place_id, travel_mode,
                            directionsService, directionsDisplay);
                });

                destination_autocomplete.addListener('place_changed', function () {
                    codeAddress();
                    var place = destination_autocomplete.getPlace();
                    if (!place.geometry) {
                        window.alert("Autocomplete's returned place contains no geometry");
                        return;
                    }
                    expandViewportToFitPlace(map, place);

                    // If the place has a geometry, store its place ID and route if we have
                    // the other place ID
                    destination_place_id = place.place_id;
                    route(origin_place_id, destination_place_id, travel_mode,
                            directionsService, directionsDisplay);
                });

                function route(origin_place_id, destination_place_id, travel_mode,
                        directionsService, directionsDisplay) {

                    if (!origin_place_id || !destination_place_id) {
                        return;
                    }
                    directionsService.route({
                        origin: {
                            'placeId': origin_place_id
                        },
                        destination: {
                            'placeId': destination_place_id
                        },
                        travelMode: travel_mode
                    }, function (response, status) {
                        if (status === google.maps.DirectionsStatus.OK) {
                            directionsDisplay.setDirections(response);
                        } else {
                            window.alert('Itineraire impossible ');
                        }
                    });
                }
            }



            // Obtenir le code postale de départ
            var geocoder;
            var mavar;
            var map;
            function codeAddress() {

                geocoder = new google.maps.Geocoder();
                var address = document.getElementById('depart').value;
                var aero_dep = checkAero(address);
                var garedep = checkGare(address);


                geocoder.geocode({'address': address}, function (results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {

                        for (var component in results[0]['address_components']) {

                            for (var i in results[0]['address_components'][component]['types']) {

                                if (results[0]['address_components'][component]['types'][i] == "postal_code") {

                                    var state = results[0]['address_components'][component]['long_name'];
                                    res = state.substring(0, 2);


                                    if (res == '91' || res == '92' || res == '93' || res == '94' || res == '95' || res == '75' || res == '77' || res == '78' || aero_dep || garedep)
                                    {
                                        //alert("Depart d'ile de france : OK");
                                        window.mavar = true;
                                    } else
                                    {
                                        //alert("Depart d'ile de france : NON");
                                        window.mavar = false;
                                    }
                                }
                            }

                        }
                    } else {

                    }

                });
            }

			function checkAdvanceorAsap() {

              //Heure courante.
			  
				var EnteredDate = document.getElementById("dtdeb").value;
			
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
                if ( date == jour && year == annee && month == mois)
                {
				   window.avanceoufutur = 15;
				   return true;
                } else
                {
                   window.avanceoufutur = 8;
				   return false;
                }

            }

				function genererPrix() {

              //
			  calculDistance();
			  
			

            }



            function callback(response, status) {



                var prixtotal = 0;
                //r?cup?ration des champs du formulaire
                var adr_dep = document.getElementById('depart').value;
                var adr_arr = document.getElementById('arrivee').value;

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

                if ((mavar == true && mavar2 == true && mavar3 == true) || (mavar4 == true && mavar5 == true && mavar3 == true))
                {
                    window.prixtotal = 0;
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
                                    } else
                                    {
                                        prix = Math.round(parseInt(dist / 1000) * window.price);
                                    }

                                    if ((prix < 15 && todayoradvance == true) || (prix < 8 && todayoradvance == false))
                                    {
                                        window.prixtotal = window.avanceoufutur;
                                        prix = window.prixtotal;
                                     
                                        document.getElementById('prix').value = prix ;
                                    } else
                                    {

                                        document.getElementById('prix').value = prix ;
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

            function calculDistance() {



                //r?cup?ration des champs du formulaire
                var adr_dep = document.getElementById('depart').value;
                var adr_arr = document.getElementById('arrivee').value;

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

            function getprix() {

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


		
		</script>
        <meta charset="UTF-8">
        <title>Detail Commande</title>

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
        <link rel="stylesheet" href="assets/lib/jquery-inputlimiter/jquery.inputlimiter.1.0.css">
        <link rel="stylesheet" href="assets/lib/bootstrap-daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/Uniform.js/2.1.2/themes/default/css/uniform.default.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.3/jquery.tagsinput.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.1/css/bootstrap3/bootstrap-switch.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker3.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.0.1/css/bootstrap-colorpicker.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css">

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

            function hideInput()
            {

                if (document.getElementById('client').value != "")
                {
                    document.getElementById('nom').disabled = true;
                    document.getElementById('prenom').disabled = true;
                    document.getElementById('tel').disabled = true;
                    document.getElementById('email').disabled = true;
                } else
                {
                    document.getElementById('nom').disabled = false;
                    document.getElementById('prenom').disabled = false;
                    document.getElementById('tel').disabled = false;
                    document.getElementById('email').disabled = false;
                }
            }
        </script>
        <link rel="stylesheet" href="assets/css/style-switcher.css">
        <link rel="stylesheet/less" type="text/css" href="assets/less/theme.less">
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.2.0/less.min.js"></script>

        <!--Modernizr-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    </head>
     <body onload="javascript:onload()">
	         <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyBPTlib2Fu69g_aIhZDcYUvz424TxCz7y4&signed_in=true&libraries=places&callback=initAutocomplete&callback=initMap" async defer></script>

        <div class="bg-dark dk" id="wrap">
            <div id="top">
                <!-- .navbar -->
                <header class="head">
                    <div class="search-bar">
                        <img src="../images/logo.png" class="img-responsive" style="width: 160px; margin-left: 12px;" alt="">
                    </div><!-- /.search-bar -->
                    <div class="main-bar">
                        <h3>
                            <i class="fa fa-phone"></i>&nbsp; Commande par telephone</h3>
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

                        <!--BEGIN INPUT TEXT FIELDS-->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="box dark">
                                    <header>
                                        <div class="icons">
                                            <i class="fa fa-edit"></i>
                                        </div>
                                        <h5>Nouvelle Commande</h5>

                                        <!-- .toolbar -->
                                        <div class="toolbar">
                                            <nav style="padding: 8px;">

                                                <a href="javascript:;" class="btn btn-default btn-xs full-box">
                                                    <i class="fa fa-expand"></i>
                                                </a>

                                            </nav>
                                        </div><!-- /.toolbar -->
                                    </header>
                                    <div id="div-1" class="body">

                                        <form class="form-horizontal" method="post" action="">

                                            <div class="form-group center">

                                                <div class="col-lg-8">
                                                    <button type="button" class="btn btn-primary" onclick="addCommande()">Ajouter la commande</button>

                                                </div>
                                            </div><!-- /.form-group -->

											   <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Date</label>
                                                <div class="col-lg-8">
                                                    <input type="date" id="dtdeb" placeholder="Date"  class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                    
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Depart</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="depart" placeholder="Depart" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
											  
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Heure</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="heure" placeholder="Heure" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Arrivee</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="arrivee" placeholder="Arrivee" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
											   <div class="form-group">
                                                 <label for="text1" class="control-label col-lg-4">Générer le prix</label>
                                                <div class="col-lg-8">
												 <button type="button" id="genererprix" class="btn btn-primary" onClick="javascript:genererPrix()">Prix</button>
                                                  
                                                </div>
                                            </div><!-- /.form-group -->
											      <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Prix</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="prix" name="prix" placeholder="Prix" class="form-control"/>
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Client</label>
                                                <div class="col-lg-8">

                                                    <select class="form-control" name="client" id="client"  onChange="javascript:hideInput();">
                                                        <option></option>
                                                        <?php
                                                        $sql_chauffeur = mysql_query("select * from client_tel");
                                                        while ($data_chauffeur = mysql_fetch_array($sql_chauffeur)) {
                                                            ?>
                                                            <option value="<?php echo $data_chauffeur['id']; ?>"><?php echo $data_chauffeur['prenom'] . " " . $data_chauffeur['nom']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div><!-- /.form-group -->
                                  
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">ou Mobile client</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="tel" placeholder="Tel" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Nom</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="nom" placeholder="Nom" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Prenom</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="prenom" name="prenom" placeholder="Prenom" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Email</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="email" name="email" placeholder="Email" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
												<div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Passager</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="passager" name="passager" placeholder="Passager" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Valises</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="valise" name="valise" placeholder="Valises" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->    
										

                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Chauffeur</label>
                                                <div class="col-lg-8">

                                                    <select class="form-control" name="chauffeur" id="chauffeur">
                                                        <option></option>
                                                        <?php
                                                        $sql_chauffeur = mysql_query("select * from chauffeur");
                                                        while ($data_chauffeur = mysql_fetch_array($sql_chauffeur)) {
                                                            ?>
                                                            <option value="<?php echo $data_chauffeur['id_chauffeur']; ?>"><?php echo $data_chauffeur['prenom'] . " " . $data_chauffeur['nom']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div><!-- /.form-group -->
											          <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Paiement</label>
                                                <div class="col-lg-8">

                                                    <select class="form-control" name="paiement" id="paiement">
                                                        <option></option>

                                                        <option value="CB">CB</option>
                                                        <option value="ESPECE">Especes</option>

                                                    </select>
                                                </div>
                                            </div><!-- /.form-group -->


                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Si societe :</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="societe" placeholder="Nom Societe" value="<?php echo $client['societe']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">SIREN</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="siren" placeholder="SIREN" value="<?php echo $client['siren']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
											   <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Note</label>
                                                <div class="col-lg-8">
                                                    <textarea id="note" placeholder="Note"  class="form-control"></textarea>
                                                </div>
                                            </div><!-- /.form-group -->

                                            <div class="row-flex" id="select_vehicle">
                                                <div class="col" >
                                                    <div class="vehicle_selected" >
                                                        <input class="vehicle_select_now" type="radio" id="vehicle_type_id1" value="1" name="vehicle_type[]" checked="">
                                                        <label for="vehicle_type_id1" style="border-style : ridge;">
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <i></i>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-6 nopadding-right info_vehicle">4 x <i class="fa fa-user"></i></div>
                                                                <div class="col-xs-6 nopadding-left info_vehicle">2 x <i class="fa fa-suitcase"></i></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <p>Berline</p>
                                                                </div>
                                                            </div>
                                                        </label>



                                                        <input class="vehicle_select_now" type="radio" id="vehicle_type_id3" value="3" name="vehicle_type[]">
                                                        <label for="vehicle_type_id3" style="border-style : ridge;">
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <i></i>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-6 nopadding-right info_vehicle">7 x <i class="fa fa-user"></i></div>
                                                                <div class="col-xs-6 nopadding-left info_vehicle">7 x <i class="fa fa-suitcase"></i></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <p>Van</p>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group center">

                                                <div class="col-lg-8">
                                                    <button type="button" class="btn btn-primary" onclick="addCommande()">Ajouter la commande</button>
                                                </div>
                                            </div><!-- /.form-group -->
											<div id="bannner"></div>


                                        </form>
                                    </div>

                                </div>
                            </div>

                            <!--END TEXT INPUT FIELD-->


                        </div><!-- /.row -->

                    </div><!-- /.inner -->
                </div><!-- /.outer -->
            </div><!-- /#content -->

        </div><!-- /#wrap -->
        <footer class="Footer bg-dark dker">
            <p>2016 &copy; ReserverUnCab.com</p>
        </footer><!-- /#footer -->

        <!--jQuery -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/Uniform.js/2.1.2/jquery.uniform.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.3/jquery.tagsinput.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/autosize.js/1.18.17/jquery.autosize.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.1/js/bootstrap-switch.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.0.1/js/bootstrap-colorpicker.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>

        <!--Bootstrap -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

        <!-- MetisMenu -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.js"></script>

        <!-- Screenfull -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/screenfull.js/2.0.0/screenfull.min.js"></script>
        <script src="assets/lib/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
        <script src="assets/lib/jQuery.validVal/js/jquery.validVal.min.js"></script>
        <script src="assets/lib/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- Metis core scripts -->
        <script src="assets/js/core.min.js"></script>

        <!-- Metis demo scripts -->
        <script src="assets/js/app.js"></script>
        <script>
                                                        $(function () {
                                                            Metis.formGeneral();
                                                        });
        </script>

        <script>
            function addCommande() {

                if (document.getElementById('vehicle_type_id1').checked)
                {
                    var box = document.getElementById('vehicle_type_id1').value;
                } else if (document.getElementById('vehicle_type_id2').checked)
                {
                    var box = document.getElementById('vehicle_type_id2').value;
                } else if (document.getElementById('vehicle_type_id3').checked)
                {
                    var box = document.getElementById('vehicle_type_id3').value;
                }

                var chauffeur = document.getElementById("chauffeur").value;
                var prenom = document.getElementById("prenom").value;
                var nom = document.getElementById("nom").value;
                var tel = document.getElementById("tel").value;
                var depart = document.getElementById("depart").value;
                var arrivee = document.getElementById("arrivee").value;
                var date = document.getElementById("dtdeb").value;
                var heure = document.getElementById("heure").value;
                var prix = document.getElementById("prix").value;
                var societe = document.getElementById("societe").value;
                var siren = document.getElementById("siren").value;
                var part_societe = document.getElementById("part_societe").value;
                var part_chauffeur = document.getElementById("part_chauffeur").value;
                var client = document.getElementById("client").value;
                var paiement = document.getElementById("paiement").value;
                var valise = document.getElementById("valise").value;
                var passager = document.getElementById("passager").value;

                if (client == "" || client == "undefined")
                {
                    var client = "0";
                }

                $.ajax({
                    url: 'inserttelephonecmd.php?prenom=' + prenom + '&nom=' + nom + '&chauffeur=' + chauffeur + '&tel=' + tel + '&depart=' + depart + '&arrivee=' + arrivee + '&dtdeb=' + date + '&heure=' + heure + '&prix=' + prix + '&societe=' + societe + '&siren=' + siren + '&part_chauffeur=' + part_chauffeur + '&part_societe=' + part_societe + '&client=' + client + '&type_vehicule=' + box + '&paiement=' + paiement+ '&valise=' + valise+ '&passager=' + passager,
                    success: function (data) {
                        var t = eval(data);

                        alert("Commande ajouté !");
                        document.location.href = "http://reserveruncab.com/paiementValide.php";
                    }
                });
            }




        </script>


        <script src="assets/js/style-switcher.min.js"></script>
    </body>
