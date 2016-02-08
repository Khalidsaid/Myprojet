<!DOCTYPE HTML>
<!--
        Developer : Said KHALID, khalidsaid.box@gmail.com, 2016.
-->
<?php
if (!isset($_SESSION)) {
    session_start();
}
$menu = 1;
?>
<html lang="fr-FR">

    <head>
        <title>Reserver Un Cab</title>
		<meta name="robots" content="index,follow">
		<meta name="keywords" content="vtc, taxi, taxi ile de france, reserver un cab, aeroport, transfert, transfert aeroport, cab, taxi paris, taxi pas cher, chauffeur privee, transport de personne" />
		<meta name="og:description" content="Vous chercher un VTC ? Faites un devis et profitez des prix pas cher !" />
		<meta name="og:title" content="Réservation et Devis VTC cab" />
		<meta name="title" content="Devis de réservation VTC cab" />
		<meta name="description" content="Vous chercher un VTC ? Faites un devis et profitez des prix pas cher !" />
		<meta name="author" content="">
		<link rel="alternate" href="http://reserveruncab.com" hreflang="fr" />
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

        <script type="text/javascript" async>

            var price = "undefined";
            var avanceoufutur = 0;

            function onload() {
                getprix();
                document.getElementById('bannner').style.display = "none";
                document.getElementById('bannner2').style.display = "block";
                document.getElementById('more_passengers').style.display = "none";

            }

            function hidelogin()
            {
                document.getElementById('loginModal').style.display = "none";
            }

            function checkDate() {

                var now = new Date();

                var annee = now.getFullYear();

                var jour = ("0" + now.getDate()).slice(-2);
                var mois = ("0" + (now.getMonth() + 1)).slice(-2);

                var EnteredDate = document.getElementById("datedep").value; //for javascript
                var EnteredDate = $("#datedep").val(); // For JQuery

                var date = EnteredDate.substring(0, 2);
                var month = EnteredDate.substring(3, 5);
                var year = EnteredDate.substring(6, 10);



                //Test date courante et date séléctionné
                if ((date >= jour && year >= annee && month >= mois))
                {

                } else
                {
                    alert("La date ne peux etre dans le passé !");
                    document.getElementById("datedep").value = "";
                    //document.location.href = "index.php";
                }



            }

            function checkAdvanceorAsap() {

                //Heure courante.

                var now = new Date();

                var annee = now.getFullYear();
                var mois = ('0' + now.getMonth() + 1).slice(-2);
                var jour = ('0' + now.getDate()).slice(-2);

                var EnteredDate = document.getElementById("datedep").value; //for javascript
                var EnteredDate = $("#datedep").val(); // For JQuery

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

            function checkonlytime()
            {


                //Heure courante.
                var now = new Date();
                var annee = now.getFullYear();
                var mois = ('0' + now.getMonth() + 1).slice(-2);
                var jour = ('0' + now.getDate()).slice(-2);
                var heure = ('0' + now.getHours()).slice(-2);
                var minute = ('0' + now.getMinutes()).slice(-2);
                var seconde = ('0' + now.getSeconds()).slice(-2);

                var EnteredDate = document.getElementById("datedep").value; //for javascript
                var EnteredDate = $("#datedep").val(); // For JQuery

                var date = EnteredDate.substring(0, 2);
                var  month= EnteredDate.substring(3, 5);
                var year = EnteredDate.substring(6, 10);

                var currentTime = new Date();
                var desti = document.getElementById("depart").value;
                if (checkParis(desti) == true)
                {
                    var result = currentTime.setMinutes(currentTime.getMinutes() + 45);
                } else
                {
                    var result = currentTime.setMinutes(currentTime.getMinutes() + 75);
                }
                var h = currentTime.getHours();
                var m = currentTime.getMinutes();

                //
                var hdep = document.getElementById("heyres").value;
                var mdep = document.getElementById("minutes").value;

                var heurecourante = hmsToSecondsOnly(h + ":" + m);
                var heureselection = hmsToSecondsOnly(hdep + ":" + mdep);
                //


                if ((heurecourante < heureselection && mois >= month && year >= annee && jour >= date) || (heurecourante > heureselection && mois < month && year <= annee) || (mois >= month && year >= annee && jour < date))
                {
                    return false;
                }
                else
                {
                    alert("Vous pouvez choisir un départ à partir de : " + h + " heures " + m + " minutes ");

                    document.getElementById("minutes").selectedIndex = 0;
                    return true;
                }

            }

            function hmsToSecondsOnly(str) {
                var p = str.split(':'),
                        s = 0, m = 1;

                while (p.length > 0) {
                    s += m * parseInt(p.pop(), 10);
                    m *= 60;
                }

                return s;
            }

            function checkMytime()
            {

                // Destination
                var desti = document.getElementById("depart").value;

                if (desti == "")
                {
                    alert('Veuillez selectionner une adresse de depart');
                    document.getElementById("heyres").selectedIndex = 0;
                    document.getElementById("minutes").selectedIndex = 0;
                } else if (document.getElementById("datedep").value == "")
                {

                    alert('Veuillez selectionner une date');
                    document.getElementById("heyres").selectedIndex = 0;
                    document.getElementById("minutes").selectedIndex = 0;

                }

                //Heure courante.
                var now = new Date();
                var annee = now.getFullYear();
                var mois = ('0' + now.getMonth() + 1).slice(-2);
                var jour = ('0' + now.getDate()).slice(-2);
                var heure = ('0' + now.getHours()).slice(-2);
                var minute = ('0' + now.getMinutes()).slice(-2);
                var seconde = ('0' + now.getSeconds()).slice(-2);

                var EnteredDate = document.getElementById("datedep").value; //for javascript
                var EnteredDate = $("#datedep").val(); // For JQuery

                var month = EnteredDate.substring(0, 2);
                var date = EnteredDate.substring(3, 5);
                var year = EnteredDate.substring(6, 10);

                if (document.getElementById("heyres").value < heure && mois == month && year == annee && jour == date)
                {

                    alert("L'heure ne peux etre dans le passé !");
                    document.getElementById("heyres").selectedIndex = 0;
                    document.getElementById("minutes").selectedIndex = 0;
                }

            }



            function checkAndgo()
            {

                var response = checkonlytime();

                if (response == true)
                {
                    return;
                }
                var mydate = document.getElementById('datedep').value;

                if (mydate == "")
                {
                    alert("Veuillez saisir une date");
                    return;
                }

                //Filtre départ d'ile de france

                if (!window.mavar)
                {
                    alert("Veuillez saisir une adresse de départ complète");
                    return;
                }


                var totalpers = document.getElementById('nbpers').value;
                var totalbag = document.getElementById('nbbag').value;
                var adr_dep = document.getElementById('depart').value;
                var adr_arr = document.getElementById('arrivee').value;
                var datedep = document.getElementById('datedep').value;
                var distance = document.getElementById('distance').innerHTML;
                var heyres = document.getElementById('heyres').value + ":" + document.getElementById('minutes').value;


                if (totalpers > 4 || totalbag > 3)
                {
                    document.getElementById('more_passengers').style.display = "block";

                } else if (adr_dep == '' || adr_arr == '')
                {
                    alert("Veuillez remplir les champs adresses");
                }
                else
                {
                    window.location.href = "recapitulatif.php?depart=" + adr_dep + "&arrivee=" + adr_arr + "&totalpers=" + totalpers + "&totalbag=" + totalbag + "&datedep=" + datedep + "&heyres=" + heyres + "&offre=" + window.prix;
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

            function annuler()
            {
                document.location.href = "index.php"

            }

            function verif() {
                var totalpers = document.getElementById('nbpers').value;
                var totalbag = document.getElementById('nbbag').value;

                if (totalpers > 4 || totalbag > 3) {
                    document.getElementById('more_passengers').style.display = "block";
                    document.getElementById('mybuton').style.display = "none";
                    document.getElementById('mybuton2').style.display = "none";
                } else {
                    document.getElementById('more_passengers').style.display = "none";
                    document.getElementById('mybuton').style.display = "block";
                    document.getElementById('mybuton2').style.display = "block";
                }

            }

            function showMap() {
                document.getElementById('bannner').style.display = "block";
                document.getElementById('bannner2').style.display = "none";
                document.getElementById('mapro').style.display = "none";
                document.getElementById('mapro2').style.display = "none";
            }

            function hideMap() {
                document.getElementById('bannner').style.display = "none";
                document.getElementById('bannner2').style.display = "none";
            }

            // init map google with itineraire and autocomplete

            function initMap() {
                var a = document.getElementById("depart").value;
                if (a == "")
                {
                    document.getElementById('bannner').style.display = "none";
                } else
                {
                    document.getElementById('bannner').style.display = "block";
                }
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





            function callback(response, status) {



                var prixtotal = 0;
                //r?cup?ration des champs du formulaire
                var adr_dep = document.getElementById('depart').value;
                var adr_arr = document.getElementById('arrivee').value;

                //Conditions départ de Paris
                /*if (checkParis(adr_dep) == true || checkOrly(adr_dep) == true || checkBeauvais(adr_dep) == true || checkCharlle(adr_dep) == true || checkBourget(adr_dep) == true)
                 {
                 
                 } else 
                 {
                 alert('Pour un départ hors de Paris ou Aeroports de Paris, veuillez nous contacter au 06 46 49 49 35 pour reserver');
                 document.location.href="index.php";
                 }*/

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
                                    } else
                                    {
                                        prix = Math.round(parseInt(dist / 1000) * window.price);
                                    }

                                    if ((prix < 15 && todayoradvance == true) || (prix < 8 && todayoradvance == false))
                                    {
                                        window.prixtotal = window.avanceoufutur;
                                        prix = window.prixtotal;
                                        document.getElementById('distance').innerHTML = '<b><i class="fa fa-car"></i> ' + parseInt(dist / 1000) + ' kilomètres<b> '; //distance en km
                                        document.getElementById('duree').innerHTML = '<b><i class="fa fa-clock-o"></i> ' + dure + '<b>';
                                        document.getElementById('prix').innerHTML = '<b><i class="fa fa-money"></i> Tarif : ' + prix + ' €<b>';
                                    } else
                                    {

                                        document.getElementById('distance').innerHTML = '<b><i class="fa fa-car"></i> ' + parseInt(dist / 1000) + ' kilomètres<b> '; //distance en km
                                        document.getElementById('duree').innerHTML = '<b><i class="fa fa-clock-o"></i> ' + dure + '<b>';
                                        document.getElementById('prix').innerHTML = '<b><i class="fa fa-money"></i> Tarif : ' + prix + ' €<b>';
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


                //initMap();
                document.getElementById("distance").style.display = "block";
                document.getElementById("prix").style.display = "block";


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
        <style>
            form input {
                padding-bottom: 0px !important;
                padding-top: 0px !important;
            }
            @media only screen and (max-width: 479px) {

                #form1{width: 300px !important}
            }
        </style>
    </head>

    <body onload="javascript:onload()" class="homepage">
        <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyBPTlib2Fu69g_aIhZDcYUvz424TxCz7y4&signed_in=true&libraries=places&callback=initAutocomplete&callback=initMap" async defer></script>


        <div id="page-wrapper">

            <!-- Header -->
            <div id="header-wrapper">
                <div id="header">

                    <!-- Logo -->
					<img src="images/logo.png"></img><br>
                    <img src="images/titre.png"></img>

                    <!-- Nav -->
                    <?php include("module/menu.php"); ?>

                    <?php include("module/connexion.php"); ?>
                    <!-- Banner -->
                    <br>
					<h2>Reservez plus vite en appelant au <a href="tel:0659342703"><input type="button" class="btn btn-danger small" value="06 59 34 27 03"></input></a></h2>
                    <br>
                    <form id="form1" name="form1" action="" method="post">

                        <section id="banner" style="z-index: 1; height: 225px; z-index: 1; margin-top: 0px; padding-top: 0px !important">
                            <header>

                                <h2 class="titre_haut">Réservez votre véhicule dès maintenant</h2>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 34px; width: 37px; padding-left: 12px; padding-right: 12px"><i class="fa fa-plane" style="color: #1E4F93"></i></button>
                                                <ul class="dropdown-menu">
                                                    <li><b style="padding-left: 5px;">Aéroports en Ile-de-France</b></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Aéroport Charles-de-Gaulle, Roissy-en-France, France';
            showMap();
            codeAddress()">Charles De Gaulle - Roissy</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Aéroport de Orly, Orly, France';
                                                                    showMap();
                                                                    codeAddress()">Orly</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Aéroport de Beauvais';
                                                                    showMap();
                                                                    codeAddress()">Beauvais</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Aéroport de Paris - Le Bourget, Le Bourget, France';
                                                                    showMap();
                                                                    codeAddress()">Le Bourget</a></li>

                                                </ul>
                                            </div>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 34px; width: 37px; padding-left: 12px; padding-right: 12px; border-right-width: 1px !important; border-left-width: 1px !important; border-radius: 0px !important"><i class="fa fa-bus" style="color: #1E4F93"></i></button>
                                                <ul class="dropdown-menu">
                                                    <li><b style="padding-left: 5px;">Gares à Paris</b></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Gare Saint-Lazare, Paris, France';
                                                                    showMap();
                                                                    codeAddress()">Saint-Lazare</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Gare Montparnasse, Boulevard de Vaugirard, Paris, France';
                                                                    showMap();
                                                                    codeAddress()">Montparnasse</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Gare de Lyon, Place Louis Armand, Paris, France';
                                                                    showMap();
                                                                    codeAddress()">Lyon</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Paris Gare de le Est, Paris, France';
                                                                    showMap();
                                                                    codeAddress()">Est</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Gare du Nord, Rue de Dunkerque, Paris, France';
                                                                    showMap();
                                                                    codeAddress()">Nord</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Quai de Austerlitz, Quartier de la Gare, Paris, France';
                                                                    showMap();
                                                                    codeAddress()">Austerlitz</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Gare de Paris-Bercy, Boulevard de Bercy, Paris, France';
                                                                    showMap();
                                                                    codeAddress()">Bercy</a></li>
                                                </ul>
                                            </div>
                                            <!-- /btn-group -->
                                            <input step="border-left-width: 0px;" type="text" id="depart" size="35" name="depart" class="form-control" placeholder="Adressse de départ" onkeypress="javascript:showMap()"/>

                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-md-6 col-sm-6">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 34px; width: 37px; padding-left: 12px; padding-right: 12px"><i class="fa fa-plane" style="color: #1E4F93"></i></button>
                                                <ul class="dropdown-menu">
                                                    <li><b style="padding-left: 5px;">Aéroports en Ile-de-France</b></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Aéroport Charles-de-Gaulle, Roissy-en-France, France';
                                                                    showMap()">Charles De Gaulle - Roissy</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Aéroport de Orly, Orly, France';
                                                                    showMap()">Orly</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Aéroport de Beauvais';
                                                                    showMap()">Beauvais</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Aéroport de Paris - Le Bourget, Le Bourget, France';
                                                                    showMap()">Le Bourget</a></li>

                                                </ul>
                                            </div>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 34px; width: 37px; padding-left: 12px; padding-right: 12px;border-right-width: 1px !important; border-left-width: 1px !important; border-radius: 0px !important"><i class="fa fa-bus" style="color: #1E4F93"></i></button>
                                                <ul class="dropdown-menu">
                                                    <li><b style="padding-left: 5px;">Gares à Paris</b></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Gare Saint-Lazare, Paris, France';
                                                                    showMap()">Saint-Lazare</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Gare Montparnasse, Boulevard de Vaugirard, Paris, France';
                                                                    showMap()">Montparnasse</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Gare de Lyon, Place Louis Armand, Paris, France';
                                                                    showMap()">Lyon</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Paris Gare de le Est, Paris, France';
                                                                    showMap()">Est</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Gare du Nord, Rue de Dunkerque, Paris, France';
                                                                    showMap()">Nord</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Quai de Austerlitz, Quartier de la Gare, Paris, France';
                                                                    showMap()">Austerlitz</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Gare de Paris-Bercy, Boulevard de Bercy, Paris, France';
                                                                    showMap()">Bercy</a></li>
                                                </ul>
                                            </div>
                                            <!-- /btn-group -->
                                            <input type="text" id="arrivee" size="35" name="arrivee" class="form-control" placeholder="Adresse d'arrivée"/>
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                    <!-- /.col-lg-6 -->

                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12" style="text-align: left; padding-top: 20px;">
                                        <label class="hidden-xs hidden-sm">Date</label>
                                        <div class="form-group">
                                            <div class="input-group date" data-provide="datepicker">
                                                <input type="text" class="form-control" id="datedep" onchange="javascript:checkDate()" value="<?php echo date("d/m/Y"); ?>" required="required">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                        </div>




                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-md-6 col-sm-12 col-xs-12" style="text-align: left; padding-top: 20px;">
                                        <label class="hidden-xs hidden-sm">Heure</label>
                                        <div>
                                            <div class="col-md-6 col-xs-6" style="padding-left: 0px; padding-right: 15px;">
                                                <select class="form-control" id="heyres" style="padding-left: 0px; padding-right: 0px;" onchange="javascript:checkMytime()">
                                                    <?php
                                                    for ($i = 0; $i < 24; $i++) {
                                                        ?>
                                                        <option>
                                                            <?php
                                                            if ($i < 10)
                                                                echo "0" . $i . "h";
                                                            else
                                                                echo $i . "h";
                                                            ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-xs-6" style="padding-left: 15px; padding-right: 0px;">
                                                <select class="form-control" id="minutes" style="padding-left: 0px; padding-right: 0px;" onchange="javascript:checkonlytime()">
                                                    <option>00 min</option>
                                                    <option>05 min</option>
                                                    <option>10 min</option>
                                                    <option>15 min</option>
                                                    <option>20 min</option>
                                                    <option>25 min</option>
                                                    <option>30 min</option>
                                                    <option>35 min</option>
                                                    <option>40 min</option>
                                                    <option>45 min</option>
                                                    <option>50 min</option>
                                                    <option>55 min</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: left; padding-top: 10px;">
                                        <label class="hidden-xs hidden-sm">Passagers</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1"> <i class="fa fa-users"></i></span>
                                            <select id="nbpers" class="form-control" onchange="javascript:verif()">
                                                <option selected="" value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: left; padding-top: 10px;">
                                        <label class="hidden-xs hidden-sm" >Valises</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1"> <i class="fa fa-suitcase"></i></span>
                                            <select id="nbbag" class="form-control" onchange="javascript:verif()">
                                                <option selected="" value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding-top: 10px; padding-bottom: 10px; color: white;font-weight : bold">
                                        <div id="more_passengers" style="color: white; display: none">Pour cette réservation, veuillez nous contacter au 06 58 54 98 25</div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-2 hidden-xs hidden-sm hidden"></div>
                                    <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 5px;">
                                        <button type="button" id="mybuton2" class="btn btn-success col-md-12" onclick="javascript:calculDistance();">Calculer le tarif</button>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 5px;">
                                        <button type="button" id="mybuton" class="btn btn-danger col-md-12" onclick="javascript:checkAndgo();">Valider la commande</button>
                                    </div>
                                    <div class="col-md-2 hidden-xs hidden-sm hidden"></div>
                                </div>
                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-md-4 col-xs-12" id="distance"></div>
                                    <div class="col-md-4 col-xs-12" id="prix"></div>
                                    <div class="col-md-4 col-xs-12" id="duree"></div>
                                </div>

                            </header>


                        </section>
                    </form>

                    <section id="bannner" style="height : 443px;  width: 100%; background-image: url('images/pic01.jpg'); position: relative; display: block; opacity: 0.8; "></section>
                    <section id="bannner2" style="height : 443px;  width: 100%; background-image: url('images/pic01.jpg'); position: relative; opacity: 0.8; "></section>
                </div>
                <i id="mapro" style="top: 260px;"><br/><h4>Soyez prévoyant !</h4> 
                    Réservez votre cab maintenant
                    ORLY
                    À PARTIR DE 
                    32€ CDG
                    À PARTIR DE 
                    42€
                    En réservant 24h à l’avance

                    Plus d'infos sur notre page <br/>
                    <a href="tarifs.php">- Offre Aéroport -</a></i>
                <i id="mapro2" style="top: 250px; right: 16px"><br/><h4>Offre spéciale !</h4> 
                    Votre 10 ème réservation est offerte. Profitez-en vite!</i>
                <br/>
                <br/>
                <br/>
                <br/>
                <!-- Intro -->
                <section id="intro" class="container" style="margin-top: 20px;">
                    <div class="row">
                        <div class="4u 12u(mobile)">
                            <section class="first">
                                <i class="icon featured alt fa-space-shuttle"></i>
                                <header>
                                    <h2>Service Aéroport</h2>
                                </header>
                                <p>Réservez votre chauffeur en quelques clics, nous assurons notre service de qualité dans tous les aéroports. Nos prix sont fixes et bas toutes l'année !</p>
                            </section>
                        </div>
                        <div class="4u 12u(mobile)">
                            <section class="middle">
                                <i class="icon featured  fa-hourglass-end"></i>
                                <header>
                                    <h2>Rapide</h2>
                                </header>
                                <p>Profitez d'un service très rapide grace à nos nombreux chauffeurs en service en île de france.</p>
                            </section>
                        </div>
                        <div class="4u 12u(mobile)">
                            <section class="last">
                                <i class="icon featured alt fa-star"></i>
                                <header>
                                    <h2>Qualité & Prix</h2>
                                </header>
                                <p>Nos chauffeurs très aimables assureront votre comfort et bien être tout au long de votre voyage.</p>
                                <p>Profitez de votre 10 eme course offerte au départ de Paris pour une personne parrainé .</p>
                            </section>
                        </div>
                    </div>
                    <footer>
                        <ul class="actions">
                            <li><a href="#" class="button big btn btn-danger">Réservez maintenant</a></li>
                            <li><a href="faq.php" class="button big btn btn-primary">Plus d'informations</a></li>
                        </ul>
                    </footer>
                </section>

            </div>
        </div>

        <!-- Main -->
        <div id="main-wrapper">
            <div class="container">

                <div class="row">
                    <div class="12u">

                        <!-- Blog -->
                        <section>
                            <header class="major">
                                <h2>Qui sommes nous?</h2>
                                <h3>ReserverUnCab EST UNE PLATEFORME PROPOSANT LA RÉSERVATION DE VOITURES AVEC CHAUFFEURS PRIVÉS DE VTC EN ILE-DE-FRANCE</h3>
                            </header>
                            <div class="row">
                                <div class="6u 12u(mobile)">
                                    <section class="box">
                                        <a href="#" class="image featured"><img src="images/chauffeur.jpg" alt="" /></a>
                                        <header>
                                            <h3>Nos engagements</h3>
                                            <li>Des offres dimensionnées à votre usage : ne payez que ce dont vous avez besoin.</li>
                                            <li>Des fonctionnalités dédiées aux entreprises : commandes invités, paiement fin de mois, reporting temps réel…</li>
                                            <li>Des solutions personnalisées : accompagnement, déploiement, communication, formation.</li>

                                        </header>

                                    </section>
                                </div>
                                <div class="6u 12u(mobile)">
                                    <section class="box">
                                        <a href="#" class="image featured"><img src="images/chauffeur2.jpg" alt="" /></a>
                                        <header>
                                            <h3>Qualité de service hors pair</h3>
                                            <li>Bénéficiez d'un service de haute qualité, fiable et disponible 7j/7, 24h/24.</li>
                                            <li>Réalisez jusqu'à 40% d'économies sur votre budget taxi actuel.</li>
                                            <li>Optez pour la transparence et l'efficacité : une équipe dédiée aux entreprises répond à vos questions sous 24h.</li>
                                        </header>
                                        <p>Connectez-vous et retrouvez un espace privé regroupant toutes vos informations client, réservations, etc...</p>

                                    </section>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>

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
    <script src="css/bootstrap-datepicker.js" type="text/javascript" LANGUAGE="JavaScript"></script>
    <script type="text/javascript">
                                            $('.datepicker').datepicker({
                                                format: 'dd/mm/yyyy',
                                                startDate: '-3d'
                                            });
    </script>
</body>

</html>