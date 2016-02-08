<?php
include("config.php");
include("util.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login Page</title>
        <meta name="msapplication-TileColor" content="#5bc0de" />
        <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />

        <!-- Bootstrap -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">

        <!-- Metis core stylesheet -->
        <link rel="stylesheet" href="assets/css/main.min.css">
    </head>
    <body class="login">
        <div class="form-signin">
            <div class="text-center">
                <img src="../images/logo.png" class="img-responsive" alt="Metis Logo">
            </div>
            <hr>
            <div class="tab-content">
                <div id="login" class="tab-pane active">
                    <?php
                    if (isset($_POST['login'])) {
                        $login = $_POST['login'];
                        $pwd = $_POST['pwd'];

                        $sql = mysql_query("select * from users where login='" . $login . "' and pwd='" . $pwd . "'");
                        $nb = mysql_num_rows($sql);

                        if ($nb != 0) {
                            $_SESSION['backend'] = $login;
                            echo '<script>window.location="index.php"</script>';
                        } else {
                            echo '<script>alert("Veuillez vérifier vos paramètres de connexion !");</script>';
                            echo '<script>window.location="login.php"</script>';
                        }
                    }
                    ?>
                    <form action="" method="post">
                        <p class="text-muted text-center">
                            Entrez vos identifiants
                        </p>
                        <input type="text" name="login" placeholder="Nom d'utilisateur" class="form-control top">
                        <input type="password" name="pwd" placeholder="Mot de passe" class="form-control bottom">

                        <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
                    </form>
                </div>


            </div>
            <hr>

        </div>

        <!--jQuery -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <!--Bootstrap -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            (function ($) {
                $(document).ready(function () {
                    $('.list-inline li > a').click(function () {
                        var activeForm = $(this).attr('href') + ' > form';
                        //console.log(activeForm);
                        $(activeForm).addClass('animated fadeIn');
                        //set timer to 1 seconds, after that, unload the animate animation
                        setTimeout(function () {
                            $(activeForm).removeClass('animated fadeIn');
                        }, 1000);
                    });
                });
            })(jQuery);
        </script>
    </body>
</html>