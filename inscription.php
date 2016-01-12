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



   
</head>

<body onload="javascript:onload()" class="homepage">


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
                            <a href="#">Pr�stations</a>
                            <ul>
                                <li><a href="#">A�roport</a></li>
                                <li><a href="#">Course simple</a></li>
                                <li><a href="#">Baggages</a></li>
                                <li>
                                    <a href="#">Tarifs</a>
                                    <ul>
                                        <li><a href="#">A�roport</a></li>
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
                                <h4>Connexion � votre compte</h4>
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
                                <a href="mot-de-passe-oublie" type="button" class="btn btn-link"><i class="fa fa-eraser"></i> Mot de passe oubli�?</a>
                            </div>
                            <div class="modal-footer">

                                <a href="inscription" type="button" class="btn btn-block btn-facebook btn-social"><i class="fa fa-lock"></i> Cr�er mon compte</a>

                            </div>
                        </div>
                    </div>
                </div>




                <!-- Banner -->
                <section id="banner">
                    <header>
                        <h2>Inscription</h2>
                        
                
                    </header>


                </section>


				     <section id="intro" class="container">
                    <div class="row">
                        <div class="8u 12u(mobile)">
                                                        <div class="row">

                                                            <div class="col-md-8">
                                                                <div class="signup-form">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label>Nom d'utilisateur *</label>
                                                                            <input type="email" class="form-control" name="login" placeholder="mail@example.com" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6 ">
                                                                            <label>Mot de passe *</label>
                                                                            <div class="" style="position: relative; display: block; vertical-align: baseline; margin: 0px 0px 5px;"><input type="password" name="pwd" placeholder="Saisir un mot de passe" class="form-control password-input margin-5 hideShowPassword-field" style="margin: 0px; padding-right: 46px;"></div>
                                                                            <a class="password-generate pass-actions" href="javascript:void(0);"><i class="fa fa-refresh"></i></a>
                                                                            <div class="progress"><div style="width: 0%" class="progress-bar password-output"></div></div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <label>Confirmer mot de passe *</label>
                                                                            <input type="password" class="form-control" name="pwd2" placeholder="Confirmer mot de passe" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label>Pr�nom *</label>
                                                                        <input type="text" name="prenom" class="form-control" placeholder="" required>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Nom *</label>
                                                                        <input type="text" name="nom" class="form-control" placeholder="" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label>Adresse</label>
                                                                        <input type="text" name="adresse" class="form-control" placeholder="" />
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>T�l�phone</label>
                                                                        <input type="text" name="tel" class="form-control" placeholder="">
                                                                    </div>
                                                                </div>  
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label>Code postal</label>
                                                                        <input type="text" name="cp" class="form-control" placeholder="">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Ville</label>
                                                                        <input type="text" name="ville" class="form-control" placeholder="">
                                                                    </div>
                                                                </div>


                                                                <div class="row" id="bloc_pro">
                                                                    <div class="col-md-6">

                                                                        <label>Soci�t�</label>
                                                                        <input type="text" name="societe" class="form-control" placeholder="">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Fax</label>
                                                                        <input type="text" name="fax" class="form-control" placeholder="">
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label>Site web</label>
                                                                        <input type="text" name="url" class="form-control" placeholder="">
                                                                    </div>


                                                                    <div class="col-md-6">
                                                                        <label>SIREN</label>
                                                                        <input type="text" name="siren" class="form-control" placeholder="">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Num�ro TVA</label>
                                                                        <input type="text" name="tva" class="form-control" placeholder="">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                   

                                                <button type="submit" class="btn btn-info">Cr�er mon compte</button>
                                          </section>
										  </div></div>
 
                <!-- Intro -->
           
                            <section class="first">
                                <i class="icon featured alt fa-space-shuttle"></i>
                                <header>
                                    <h2>Service A�roport</h2>
                                </header>
                                <p>R�servez votre chauffeur en quelques clics, nous assurons notre service de qualit� dans tous les a�roports.</p>
                            </section>
                        </div>
                        <div class="4u 12u(mobile)">
                            <section class="middle">
                                <i class="icon featured  fa-hourglass-end"></i>
                                <header>
                                    <h2>Rapide</h2>
                                </header>
                                <p>Profitez d'un service tr�s rapide grace � nos nombreux chauffeurs en service en �le de france.</p>
                            </section>
                        </div>
                        <div class="4u 12u(mobile)">
                            <section class="last">
                                <i class="icon featured alt fa-star"></i>
                                <header>
                                    <h2>Qualit�</h2>
                                </header>
                                <p>Nos chauffeurs tr�s aimables assureront votre comfort et bien �tre tout au long de votre voyage.</p>
                            </section>
                        </div>
                    </div>
                    <footer>
                        <ul class="actions">
                            <li><a href="#" class="button big">R�servez maintenant</a></li>
                            <li><a href="#" class="button alt big">Plus d'informations</a></li>
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
                                <h3>MYVTC EST UNE PLATEFORME PROPOSANT LA R�SERVATION DE VOITURES AVEC CHAUFFEURS PRIV�S DE VTC EN ILE-DE-FRANCE</h3>
                            </header>
                            <div class="row">
                                <div class="6u 12u(mobile)">
                                    <section class="box">
                                        <a href="#" class="image featured"><img src="images/chauffeur.jpg" alt="" /></a>
                                        <header>
                                            <h3>Nos engagements</h3>
                                            <li>Des offres dimensionn�es � votre usage : ne payez que ce dont vous avez besoin.</li>
                                            <li>Des fonctionnalit�s d�di�es aux entreprises : commandes invit�s, paiement fin de mois, reporting temps r�el?</li>
                                            <li>Des solutions personnalis�es : accompagnement, d�ploiement, communication, formation.</li>

                                        </header>

                                    </section>
                                </div>
                                <div class="6u 12u(mobile)">
                                    <section class="box">
                                        <a href="#" class="image featured"><img src="images/chauffeur2.jpg" alt="" /></a>
                                        <header>
                                            <h3>Qualit� de service hors pair</h3>
                                            <li>B�n�ficiez d?un service de haute qualit�, fiable et disponible 7j/7, 24h/24.</li>
                                            <li>R�alisez jusqu?� 40% d?�conomies sur votre budget taxi actuel.</li>
                                            <li>Optez pour la transparence et l?efficacit� : une �quipe d�di�e aux entreprises r�pond � vos questions sous 24h.</li>
                                        </header>
                                        <p>Connectez-vous et retrouvez un espace priv� regroupant toutes vos informations client, r�servations, etc...</p>

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
                                <li><a href="#">Conditions g�n�rales</a></li>

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
                                <h2>R�seaux sociaux</h2>
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
                                <li>&copy; Tout droit r�serv�.</li>
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