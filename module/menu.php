<nav id="nav">
    <ul>
        <li <?php if ($menu == 1) echo 'class="current"'; ?>><a href="index.php">Accueil</a></li>
        <li <?php if ($menu == 2) echo 'class="current"'; ?>>
            <a href="tarifs.php">Tarifs</a>
            <!--<ul>
                <li><a href="#">Aéroport</a></li>
                <li><a href="#">Course simple</a></li>
                <li><a href="#">Baggages</a></li>
                <li>
                    <a href="tarifs.php">Tarifs</a>
            <!-- <ul>
                 <li><a href="#">Aéroport</a></li>
                 <li><a href="#">Course simple</a></li>
                 <li><a href="#">Baggages</a></li>
             </ul>
         </li>

     </ul>-->
        </li>
        <li <?php if ($menu == 3) echo 'class="current"'; ?>><a href="faq.php">FAQ</a></li>
        <li <?php if ($menu == 4) echo 'class="current"'; ?>><a href="contact.php">Nous contacter</a></li>
        <?php
        if (!isset($_SESSION['myvtclogin'])) {
            ?>
            <li <?php if($menu==5)echo 'class="current"'; ?>><a href="connexion.php">Connexion</a></li>
            <?php
        } else {
            ?>
            <li <?php if ($menu == 5) echo 'class="current"'; ?>>
                <a href="profil.php">Mon compte</a>
                <ul>
                    <li><a href="deconnect.php">Deconnexion</a></li>

                </ul>
            </li>
            <?php
        }
        ?>

    </ul>
</nav>