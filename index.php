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

        <script type="text/javascript" async>



            //En attendant le webservice, le prix est statique
            price = 5;

            function onload() {
                document.getElementById('bannner').style.display = "none";
                document.getElementById('bannner2').style.display = "block";
                document.getElementById('more_passengers').style.display = "none";

            }

            function hidelogin()
            {
                document.getElementById('loginModal').style.display = "none";

            }

            function checkAndgo()
            {
                var totalpers = document.getElementById('nbpers').value;
                var totalbag = document.getElementById('nbbag').value;
                var adr_dep = document.getElementById('depart').value;
                var adr_arr = document.getElementById('arrivee').value;


                if (totalpers > 4 || totalbag > 4)
                {
                    document.getElementById('more_passengers').style.display = "block";

                } else if (adr_dep == '' || adr_arr == '')
                {
                    alert("Veuillez remplir les champs adresses");
                }
                else
                {
                    window.location.href = "recapitulatif.php?depart=" + adr_dep + "&arrivee=" + adr_arr;
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
                var aeroports = "Aéroport Paris Beauvais Tillé, Tillé";
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

                if (totalpers > 4 || totalbag > 4) {
                    document.getElementById('more_passengers').style.display = "block";
                } else {
                    document.getElementById('more_passengers').style.display = "none";
                }

            }

            function showMap() {
                document.getElementById('bannner').style.display = "block";
                document.getElementById('bannner2').style.display = "none";
            }

            function hideMap() {
                document.getElementById('bannner').style.display = "none";
                document.getElementById('bannner2').style.display = "none";
            }

            // init map google with itineraire and autocomplete

            function initMap() {
				var a = document.getElementById("depart").value;
				  if ( a == "")
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
                    center: {
                        lat: 47.3590900,
                        lng: 3.3852100
                    },
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

                //map.controls[google.maps.ControlPosition.TOP_LEFT].push(origin_input);
                //map.controls[google.maps.ControlPosition.TOP_LEFT].push(destination_input);

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




            function callback(response, status) {


                var prixtotal = 0;
                //r?cup?ration des champs du formulaire
                var adr_dep = document.getElementById('depart').value;
                var adr_arr = document.getElementById('arrivee').value;

                var a = checkOrly(adr_dep);
                var b = checkOrly(adr_arr)

                if (a == true || b == true)
                {
                    window.prixtotal = 49;
                }
                if (checkBeauvais(adr_dep) == true || checkBeauvais(adr_arr) == true)
                {
                    window.prixtotal = 49;
                }
                if (checkCharlle(adr_dep) == true || checkCharlle(adr_arr) == true)
                {
                    window.prixtotal = 49;
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
                                    document.getElementById('distance').innerHTML = '<b><i class="fa fa-car"></i> ' + parseInt(dist / 1000) + ' kilomètres<b> '; //distance en km
                                    if (window.prixtotal > 0)
                                    {
                                        prix = window.prixtotal;
                                    } else
                                    {
                                        prix = Math.round(parseInt(dist / 1000) * window.price);
                                    }
                                    document.getElementById('duree').innerHTML = '<b><i class="fa fa-clock-o"></i> ' + dure + '<b>';
                                    document.getElementById('prix').innerHTML = '<b><i class="fa fa-money"></i> Tarif : ' + prix + ' €<b>';
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

            function getPrix() {

                $.ajax({
                    method: "GET",
                    url: "http://aaaaaaa.fr/webservice/v1/users/getPrix",
                    success: function (data) {
                        var response = JSON.parse(data);

                        for (var i = 0; i < response.length; i++) {
                            window.price = response[i].prix;
                        }
                    }
                });


            }
            ;
        </script>
        <style>
            form input {padding-bottom: 0px !important; padding-top: 0px !important;}

        </style>
    </head>

    <body onload="javascript:onload()" class="homepage">
        <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyBPTlib2Fu69g_aIhZDcYUvz424TxCz7y4&signed_in=true&libraries=places&callback=initAutocomplete&callback=initMap" async defer></script>


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
                    <br/><br/>
                    <form id="form1" name="form1" action="" method="post" >
                        <section id="banner" style="height : 225px; ; z-index: 1; ">	
                            <header>

                                <h2 style="color: white; font-size: 25px; margin-bottom: 20px; display : block;">Réservez votre véhicule dès maintenant</h2>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-plane" style="color: #1E4F93"></i></button>
                                                <ul class="dropdown-menu">
                                                    <li><b style="padding-left: 5px;">Aéroports en Ile-de-France</b></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Terminal 2D, Aéroport Charles-de-Gaulle, Roissy-en-France, France'">Charles De Gaulle - Roissy</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Aéroport de Paris-Orly, Orly, France'">Orly</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Aéroport de Beauvais'">Beauvais</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Aéroport de Paris - Le Bourget, Le Bourget, France'">Le Bourget</a></li>

                                                </ul>
                                            </div>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-right-width: 1px !important; border-left-width: 1px !important; border-radius: 0px !important"><i class="fa fa-bus" style="color: #1E4F93"></i></button>
                                                <ul class="dropdown-menu">
                                                    <li><b style="padding-left: 5px;">Gares à Paris</b></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Gare Saint-Lazare, Paris, France'">Saint-Lazare</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Gare Montparnasse, Boulevard de Vaugirard, Paris, France'">Montparnasse</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Gare de Lyon, Place Louis Armand, Paris, France'">Lyon</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Paris Gare de le Est, Paris, France'">Est</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Gare du Nord, Rue de Dunkerque, Paris, France'">Nord</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Quai de Austerlitz, Quartier de la Gare, Paris, France'">Austerlitz</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('depart').value = 'Gare de Paris-Bercy, Boulevard de Bercy, Paris, France'">Bercy</a></li>
                                                </ul>
                                            </div><!-- /btn-group -->
                                            <input step="border-left-width: 0px;" type="text" id="depart" size="35" name="depart" class="form-control" placeholder="Adressse de départ" onkeypress="javascript:showMap()" />

                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-plane" style="color: #1E4F93"></i></button>
                                                <ul class="dropdown-menu">
                                                    <li><b style="padding-left: 5px;">Aéroports en Ile-de-France</b></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Terminal 2D, Aéroport Charles-de-Gaulle, Roissy-en-France, France'">Charles De Gaulle - Roissy</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Aéroport de Paris-Orly, Orly, France'">Orly</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Aéroport de Beauvais'">Beauvais</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Aéroport de Paris - Le Bourget, Le Bourget, France'">Le Bourget</a></li>

                                                </ul>
                                            </div>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-right-width: 1px !important; border-left-width: 1px !important; border-radius: 0px !important"><i class="fa fa-bus" style="color: #1E4F93"></i></button>
                                                <ul class="dropdown-menu">
                                                    <li><b style="padding-left: 5px;">Gares à Paris</b></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Gare Saint-Lazare, Paris, France'">Saint-Lazare</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Gare Montparnasse, Boulevard de Vaugirard, Paris, France'">Montparnasse</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Gare de Lyon, Place Louis Armand, Paris, France'">Lyon</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Paris Gare de le Est, Paris, France'">Est</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Gare du Nord, Rue de Dunkerque, Paris, France'">Nord</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Quai de Austerlitz, Quartier de la Gare, Paris, France'">Austerlitz</a></li>
                                                    <li style="cursor: pointer"><a onclick="document.getElementById('arrivee').value = 'Gare de Paris-Bercy, Boulevard de Bercy, Paris, France'">Bercy</a></li>
                                                </ul>
                                            </div><!-- /btn-group -->
                                            <input type="text" id="arrivee" size="35" name="arrivee" class="form-control" placeholder="Adresse d'arrivée" />
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                </div>
                                <div class="row">
                                    <div class="col-md-6" style="text-align: left; padding-top: 20px;">
                                        <label>Date</label>
                                        <div class="form-group">
                                            <div class="input-group date" data-provide="datepicker">
                                                <input type="text" class="form-control">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                        </div>

                                       


                                    </div><!-- /.col-lg-6 --> 
                                    <div class="col-md-6" style="text-align: left; padding-top: 20px;">
                                        <label>Heure</label>
                                        <div>
                                            <div class="col-md-6" style="padding-left: 0px; padding-right: 15px;">
                                                <select class="form-control" id="heyres" style="padding-left: 0px; padding-right: 0px;">
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
                                            <div class="col-md-6" style="padding-left: 15px; padding-right: 0px;">
                                                <select class="form-control" id="minutes" style="padding-left: 0px; padding-right: 0px;">
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
                                    <div class="col-md-6" style="text-align: left; padding-top: 10px;">
                                        <label>Passagers</label>
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
                                    <div class="col-md-6" style="text-align: left; padding-top: 10px;">
                                        <label>Valises</label>
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
                                    <div class="col-md-12" style="padding-top: 10px; padding-bottom: 10px; color: #000;font-weight : bold"><div id="more_passengers" style="color: white; display: none">Pour cette réservation, veuillez nous contacter au 06 58 54 98 25</div></div>

                                </div>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-success col-md-12" onclick="javascript:calculDistance();">Calculer le tarif</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-danger col-md-12" onclick="javascript:checkAndgo();">Valider la commande</button>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4" id="distance"></div>
                                    <div class="col-md-4" id="prix"></div>
                                    <div class="col-md-4" id="duree"></div>
                                </div>

                            </header>


                        </section>
                    </form>
                    <section id="bannner" style="height : 443px;  width: 100%; background-image: url('images/pic01.jpg'); position: relative; display: block; opacity: 0.8; "></section>
                    <section id="bannner2" style="height : 443px;  width: 100%; background-image: url('images/pic01.jpg'); position: relative; opacity: 0.8; "></section>
                </div>
                <br/><br/><br/><br/>
                <!-- Intro -->
                <section id="intro" class="container">
                    <div class="row">
                        <div class="4u 12u(mobile)">
                            <section class="first">
                                <i class="icon featured alt fa-space-shuttle"></i>
                                <header>
                                    <h2>Service Aéroport</h2>
                                </header>
                                <p>Réservez votre chauffeur en quelques clics, nous assurons notre service de qualité dans tous les aéroports.</p>
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
                                    <h2>Qualité</h2>
                                </header>
                                <p>Nos chauffeurs très aimables assureront votre comfort et bien être tout au long de votre voyage.</p>
                            </section>
                        </div>
                    </div>
                    <footer>
                        <ul class="actions">
                            <li><a href="#" class="button big btn btn-danger">Réservez maintenant</a></li>
                            <li><a href="#" class="button big btn btn-primary">Plus d'informations</a></li>
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
                                <h3>MYVTC EST UNE PLATEFORME PROPOSANT LA RÉSERVATION DE VOITURES AVEC CHAUFFEURS PRIVÉS DE VTC EN ILE-DE-FRANCE</h3>
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