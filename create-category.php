<?php
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }
// Connexion à la BDD
require('connexionBDD.php');

// Affichage des catégories existantes
$category = $bdd->query('SELECT * FROM category ORDER BY id desc');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WelcomeToDubai</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="burj-khalifa.jpg" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>

    <?php include("./navbarAdmin.php"); ?>

    <div class="menu-create-category">
        <div class="menu-category-created">
            <h2>Catégories</h2>
            <?php foreach ($category as $categorie) :; ?>
                <ul>
                    <li><?php echo $categorie[2]; ?></li>
                </ul>
            <?php endforeach ?>
        </div>
        <div class="menu-category-tocreate">
            <h2>Création d'une nouvelle catégorie</h2>

        </div>
    </div>

    <?php include("./footer.php"); ?>
</body>

</html>