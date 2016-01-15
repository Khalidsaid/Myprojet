<?php
include("../config.php");
include("util.php");
if (!isset($_SESSION['backend']))
    header("location:login.php");
$client = mysql_fetch_array(mysql_query("select * from myvtc_users where id=" . $_GET['id']));
?>
<!doctype html>
<html class="no-js">
    <head>
        <meta charset="UTF-8">
        <title>Détail Client</title>

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
        </script>
        <link rel="stylesheet" href="assets/css/style-switcher.css">
        <link rel="stylesheet/less" type="text/css" href="assets/less/theme.less">
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.2.0/less.min.js"></script>

        <!--Modernizr-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    </head>
    <body class="  ">
        <div class="bg-dark dk" id="wrap">
           <div id="top">
                <!-- .navbar -->
                <header class="head">
                    <div class="search-bar">
                        <img src="../images/logo.png" class="img-responsive" style="width: 160px; margin-left: 12px;" alt="">
                    </div><!-- /.search-bar -->
                    <div class="main-bar">
                        <h3>
                            <i class="fa fa-user"></i>&nbsp; Clients</h3>
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
                <?php include("menu.php");  ?><!-- /#menu -->
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
                                        <h5>Détail Client</h5>

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
                                                    <button type="submit" class="btn btn-primary" onclick="modifuser(<?php echo $_GET['id']; ?>)">Modifier</button>
                                                </div>
                                            </div><!-- /.form-group -->
 
                                            
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Prénom</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="prenom" placeholder="Prénom" value="<?php echo $client['prenom']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Nom</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="nom" placeholder="Nom" value="<?php echo $client['nom']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Email</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $client['email']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                       
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Adresse</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="adresse" placeholder="Adresse" value="<?php echo $client['adresse']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Ville</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="ville" placeholder="Ville" value="<?php echo $client['ville']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Code postal</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="cp" placeholder="Code postal" value="<?php echo $client['cp']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                     
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Mobile</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="mobilephone" placeholder="Fax" value="<?php echo $client['tel']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="text1" class="control-label col-lg-4">Promos</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="promos" placeholder="Site Web" value="<?php echo $client['promos']; ?>" class="form-control">
                                                </div>
                                            </div><!-- /.form-group -->
										
               
                                           
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!--END TEXT INPUT FIELD-->

                          
                        </div><!-- /.row -->

                      

                       


                    </div><!-- /.inner -->
                </div><!-- /.outer -->
            </div><!-- /#content -->
            <div id="right" class="bg-light lter">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning!</strong>  Best check yo self, you're not looking too good.
                </div>

                <!-- .well well-small -->
                <div class="well well-small dark">
                    <ul class="list-unstyled">
                        <li>Visitor <span class="inlinesparkline pull-right">1,4,4,7,5,9,10</span>
                        </li>
                        <li>Online Visitor <span class="dynamicsparkline pull-right">Loading..</span>
                        </li>
                        <li>Popularity <span class="dynamicbar pull-right">Loading..</span>
                        </li>
                        <li>New Users <span class="inlinebar pull-right">1,3,4,5,3,5</span>
                        </li>
                    </ul>
                </div><!-- /.well well-small -->

                <!-- .well well-small -->
                <div class="well well-small dark">
                    <button class="btn btn-block">Default</button>
                    <button class="btn btn-primary btn-block">Primary</button>
                    <button class="btn btn-info btn-block">Info</button>
                    <button class="btn btn-success btn-block">Success</button>
                    <button class="btn btn-danger btn-block">Danger</button>
                    <button class="btn btn-warning btn-block">Warning</button>
                    <button class="btn btn-inverse btn-block">Inverse</button>
                    <button class="btn btn-metis-1 btn-block">btn-metis-1</button>
                    <button class="btn btn-metis-2 btn-block">btn-metis-2</button>
                    <button class="btn btn-metis-3 btn-block">btn-metis-3</button>
                    <button class="btn btn-metis-4 btn-block">btn-metis-4</button>
                    <button class="btn btn-metis-5 btn-block">btn-metis-5</button>
                    <button class="btn btn-metis-6 btn-block">btn-metis-6</button>
                </div><!-- /.well well-small -->

                <!-- .well well-small -->
                <div class="well well-small dark">
                    <span>Default</span> <span class="pull-right"><small>20%</small> </span>
                    <div class="progress xs">
                        <div class="progress-bar progress-bar-info" style="width: 20%"></div>
                    </div>
                    <span>Success</span> <span class="pull-right"><small>40%</small> </span>
                    <div class="progress xs">
                        <div class="progress-bar progress-bar-success" style="width: 40%"></div>
                    </div>
                    <span>warning</span> <span class="pull-right"><small>60%</small> </span>
                    <div class="progress xs">
                        <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
                    </div>
                    <span>Danger</span> <span class="pull-right"><small>80%</small> </span>
                    <div class="progress xs">
                        <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
                    </div>
                </div>
            </div><!-- /#right -->
        </div><!-- /#wrap -->
        <footer class="Footer bg-dark dker">
            <p>2014 &copy; Metis Bootstrap Admin Template</p>
        </footer><!-- /#footer -->

        <!-- #helpModal -->
        <div id="helpModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --><!-- /#helpModal -->

		
		      
		
		
		
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
											function modifuser(id) {
												var prenom = document.getElementById("prenom").value;
												var nom = document.getElementById("nom").value;
												var ville = document.getElementById("ville").value;
												var cp = document.getElementById("cp").value;
												var adresse = document.getElementById("adresse").value;
												var mdp = document.getElementById("mdp").value;
												var promos = document.getElementById("promos").value;
												var email = document.getElementById("email").value;
												$.ajax({
													url: 'modifuser.php?prenom=' + prenom + '&nom=' + nom + '&ville=' + ville +'&cp=' + cp +'&adresse=' + adresse +'&promos=' + promos +'&email=' + email ,
													success: function (data) {
														var t = eval(data);

														alert("Infos changé !");
													} 
												});
											}
										</script>
		
		
        <script src="assets/js/style-switcher.min.js"></script>
    </body>
