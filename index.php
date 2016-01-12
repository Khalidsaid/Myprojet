<!DOCTYPE HTML>
<!--
	Developer : Said KHALID, khalidsaid.box@gmail.com, 2015.
-->
<html>

<head>
    <title>MyVtc</title>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
    <!-- BooStrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-1.11.0.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript" LANGUAGE="JavaScript"></script>



    <script type="text/javascript" async>
	
	
	
        //En attendant le webservice, le prix est statique
        price = 5;
		
        function onload() {
            document.getElementById('closemap').style.display = "none";
            document.getElementById('more_passengers').style.display = "none";
        }
		
		function hidelogin()
		{
		   document.getElementById('loginModal').style.display = "none";
		   
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
		  document.location.href="index.php"
		 
		}

        function verif() {
            var totalpers = document.getElementById('nbpers').value;
            var totalbag = document.getElementById('nbbag').value;

            if (totalpers == "+" || totalbag == "+") {
                document.getElementById('more_passengers').style.display = "block";
            } else {
                document.getElementById('more_passengers').style.display = "none";
            }

        }

        function showMap() {
            document.getElementById('bannner').style.display = "block";
            document.getElementById('closemap').style.display = "block";
        }

        function hideMap() {
            document.getElementById('bannner').style.display = "none";
            document.getElementById('closemap').style.display = "none";
        }

        // init map google with itineraire and autocomplete

        function initMap() {


            var origin_place_id = null;
            var destination_place_id = null;
            var travel_mode = google.maps.TravelMode.DRIVING;
            var map = new google.maps.Map(document.getElementById('bannner'), {
                mapTypeControl: true,
                center: {
                    lat: 47.3590900,
                    lng: 3.3852100
                },
                zoom: 10,
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

            origin_autocomplete.addListener('place_changed', function() {
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

            destination_autocomplete.addListener('place_changed', function() {
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
                }, function(response, status) {
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
                                document.getElementById('distance').innerHTML = '<b>' + parseInt(dist / 1000) + ' kilomètres<b> '; //distance en km
								if (window.prixtotal > 0 )
								{
									prix = window.prixtotal;
								} else 
								{
                                prix = Math.round(parseInt(dist / 1000) * window.price);
								}
                                document.getElementById('duree').innerHTML = '<b>' + dure + '<b>';
                                document.getElementById('prix').innerHTML = '<b>Tarif : ' + prix + ' €<b>';
                                window.prixtotal = 0;
                            } else if (statut == 'NOT_FOUND') {
                                alert("impossible de localiser l'adresse d'arrivee");
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
                success: function(data) {
                    var response = JSON.parse(data);

                    for (var i = 0; i < response.length; i++) {
                        window.price = response[i].prix;
                    }
                }
            });


        };
    </script>
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
                <nav id="nav">
                    <ul>
                        <li class="current"><a href="index.html">Accueil</a></li>
                        <li>
                            <a href="#">Préstations</a>
                            <ul>
                                <li><a href="#">Aéroport</a></li>
                                <li><a href="#">Course simple</a></li>
                                <li><a href="#">Baggages</a></li>
                                <li>
                                    <a href="#">Tarifs</a>
                                    <ul>
                                        <li><a href="#">Aéroport</a></li>
                                        <li><a href="#">Course simple</a></li>
                                        <li><a href="#">Baggages</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </li>
                        <li><a href="left-sidebar.html">FAQ</a></li>
                        <li><a href="right-sidebar.html">Nous contacter</a></li>
                        <i><a href="javascript:void(0);" class="user-login-btn" data-toggle="modal" data-target="#loginModal">Connexion</a></i>

                    </ul>
                </nav>

                <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4>Connexion à votre compte</h4>
                            </div>
                            <div class="modal-body">

                                <form method="post" action="">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" id="login_user" placeholder="Nom d'utilisateur" required="">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" class="form-control" id="pwd_user" placeholder="Mot de passe" required="">
                                    </div>
                                    <br />
                                    <input type="button" class="btn btn-primary" value="Connexion" onclick="connexion()">
                                </form>
                                <a href="mot-de-passe-oublie" type="button" class="btn btn-link"><i class="fa fa-eraser"></i> Mot de passe oublié?</a>
                            </div>
                            <div class="modal-footer">

                                <a href="" onclick="javascript:hidelogin();" data-toggle="modal" data-target="#modal-register" type="button" class="btn btn-block btn-facebook btn-social"><i class="fa fa-lock"></i> Créer mon compte</a>

                            </div>
                        </div>
                    </div>
                </div>
				    <!-- MODAL -->
			
				<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4>Inscription</h4>
                            </div>
                            <div class="modal-body">

                                <form method="post" action="">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" id="lastname" placeholder="Nom" required="">
                                    </div>
									 <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" id="firstname" placeholder="Prénom" required="">
                                    </div>
									 <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" class="form-control" id="pwd_user" placeholder="Mot de passe" required="">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" class="form-control" id="pwd_user_conf" placeholder="Confirmation mot de passe" required="">
                                    </div>
									<div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                        <input type="text" class="form-control" id="email" placeholder="Email" required="">
                                    </div>
									 <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="text" class="form-control" id="mobilephone" placeholder="Téléphone mobile" required="">
                                    </div>
                                    <br />
                                    <input type="button" class="btn btn-success" value="M'inscrire!" onclick="inscription()">
									<input type="submit" class="btn btn-warning" value="Fermer" onclick="javascript:annuler()">
									
                                </form>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Banner -->
                <section id="banner">
			
                    <header>
                        <h2>Réservez votre véhicule</h2>
                        <p>dès maintenant</p>
                        <br />
                        <input type="text" id="depart" size="35" name="depart" placeholder="Départ" onkeypress="javascript:showMap()"></input>
                        <input type="text" id="arrivee" size="35" name="arrivee" placeholder="Arrivée"></input>
                        <input type="date" id="date" name="" placeholder="Date" placeholder="Date"></input>
                        <br />
                        <br />
                        <img src="images/pers.png" class="select_img" />
                        <select id="nbpers" class="select_pers" onchange="javascript:verif()">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>+</option>
                        </select>
                        <img src="images/baggage.png" class="select_img2" />
                        <select id="nbbag" class="select_bag" onchange="javascript:verif()">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>+</option>
                        </select>

                        <select id="minutes" class="select_bag2">
                            <option>00</option>
                            <option>05</option>
                            <option>10</option>
                            <option>15</option>
                            <option>20</option>
                            <option>25</option>
                            <option>30</option>
                            <option>35</option>
                            <option>40</option>
                            <option>45</option>
                            <option>50</option>
                            <option>55</option>
                        </select>
                        <select id="heyres" class="select_bag2">
                            <?php
									for ($i=0; $i<24; $i++)
									{
									?>
                                <option>
                                    <?php echo  $i ?>
                                </option>
                                <?php
									}
									?>
                        </select>
                        <label class="select_time">Heure</label>
                        <div id="more_passengers" class="passengers">Pour cette reservation, veuillez nous contacter au 06 58 54 98 25</div>

                        <br />
                        <br />
                        <br />
                        <button type="button" class="btn btn-success" onclick="javascript:calculDistance();">Tarif</button>
                        <button type="button" class="btn btn-danger" onclick="javascript:calculDistance();">Valider</button>

                    </header>

                    <div id="distance"></div>
                    <div id="prix"></div>
                    <div id="duree"></div>

                    <figure id="closemap">
                        <a href="javascript:hideMap()">
                            <img src="images/hide.png" id="imgclose" />
                            <figcaption>Fermer la carte</figcaption>
                        </a>
                    </figure>

                </section>


                <center>
                    <header id="bannner"></header>
                </center>



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
                                            <li>Bénéficiez d’un service de haute qualité, fiable et disponible 7j/7, 24h/24.</li>
                                            <li>Réalisez jusqu’à 40% d’économies sur votre budget taxi actuel.</li>
                                            <li>Optez pour la transparence et l’efficacité : une équipe dédiée aux entreprises répond à vos questions sous 24h.</li>
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
        <div id="footer-wrapper">
            <section id="footer" class="container">

                <div class="row">
                    <div class="4u 12u(mobile)">
                        <section>

                            <ul class="divided">
                                <li><a href="#">Nous contacter</a></li>
                                <li><a href="#">Fonctionnement</a></li>
                                <li><a href="#">Conditions générales</a></li>

                            </ul>
                        </section>
                    </div>
                    <div class="4u 12u(mobile)">
                        <section>
                            <ul class="divided">
                                <li><a href="#">Avantages</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>
                        </section>
                    </div>
                    <div class="4u 12u(mobile)">
                        <section>
                            <header>
                                <h2>Réseaux sociaux</h2>
                            </header>
                            <ul class="social">
                                <li><a class="icon fa-facebook" href="#"><span class="label">Facebook</span></a></li>
                                <li><a class="icon fa-twitter" href="#"><span class="label">Twitter</span></a></li>
                                <li><a class="icon fa-dribbble" href="#"><span class="label">Dribbble</span></a></li>
                                <li><a class="icon fa-linkedin" href="#"><span class="label">LinkedIn</span></a></li>
                                <li><a class="icon fa-google-plus" href="#"><span class="label">Google+</span></a></li>
                            </ul>

                            <img src="images/logo_paypal.jpg" />

                        </section>
                    </div>
                </div>
                <div class="row">
                    <div class="12u">

                        <!-- Copyright -->
                        <div id="copyright">
                            <ul class="links">
                                <li>&copy; Tout droit réservé.</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </section>
        </div>

    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.dropotron.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/skel-viewport.min.js"></script>
    <script src="assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="assets/js/main.js"></script>

</body>

</html>