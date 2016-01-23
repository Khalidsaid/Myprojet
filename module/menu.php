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
        <li><a href="faq.php">FAQ</a></li>
        <li><a href="contact.php">Nous contacter</a></li>
        <?php
        if (!isset($_SESSION['myvtclogin'])) {
            ?>
            <li><a href="connexion.php">Connexion</a></li>
            <?php
        } else {
            ?>
            <li>
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