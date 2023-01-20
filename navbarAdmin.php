<?php
session_start();

// Connexion à la BDD
require('./includes/connexionBDD.php');


?>

<header>
    <ul>
        <li><a href="">Commandes</a></li>
        <li><a href="">Catalogues</a>
            <ul>
                <li><a href="">Catégories</a></li>
                <li><a href="">Produits</a></li>
            </ul>
        </li>
        <li><a href="">Clients</a></li>
        <li><a href="">SAV</a></li>
        <li><a href="">Statistiques</a></li>
    </ul>

</header>