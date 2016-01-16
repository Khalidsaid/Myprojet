<nav id="nav">
    <ul>
        <li class="current"><a href="index.php">Accueil</a></li>
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
        <?php
        if (!isset($_SESSION['myvtclogin'])) {
            ?>
            <li><a href="connexion.php">Connexion</a></li>
            <?php
        } else {
            ?>
            <li><a href="profil.php">Mon compte</a></li>
            <?php
        }
        ?>

    </ul>
</nav>