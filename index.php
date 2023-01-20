<?php
session_start();

// Connexion à la BDD
require('./includes/connexionBDD.php');

// Affichage de base des produits 
$products = $bdd->query('SELECT * FROM products ORDER BY id LIMIT 100');

// Affichage des produits si utilisation de barre de recherche
$choose_product = "";
if (isset($_GET["click"]) and $_GET["click"] == "OK") {
    $_GET["searchbar"] = htmlspecialchars($_GET["searchbar"]); //pour sécuriser le formulaire contre les intrusions html
    $searchbar = $_GET["searchbar"];
    $searchbar = trim($searchbar); //pour supprimer les espaces dans la requête de l'internaute
    $searchbar = strip_tags($searchbar); //pour supprimer les balises html dans la requête
    $choose_product = $_GET["searchbar"];

    if (isset($searchbar)) {
        $searchbar = strtolower($searchbar);    // On met le texte saisie en minuscule
        $products = $bdd->prepare("SELECT * FROM products WHERE lower(name) LIKE ? OR lower(description) LIKE ?");
        $products->execute(array("%" . $searchbar . "%", "%" . $searchbar . "%"));
    }
}

// Affichage des produits si sélection d'une catégorie
if (isset($_GET["ABAYA"]) and $_GET["ABAYA"] == "ABAYA") {
    $products = $bdd->query('SELECT * FROM products where category = 1');
    $choose_product = 'ABAYA';
}
if (isset($_GET["VOILE"]) and $_GET["VOILE"] == "VOILE") {
    $products = $bdd->query('SELECT * FROM products where category = 2');
    $choose_product = 'VOILE';
}
if (isset($_GET["ROBE"]) and $_GET["ROBE"] == "ROBE") {
    $products = $bdd->query('SELECT * FROM products where category = 3');
    $choose_product = 'ROBE';
}
if (isset($_GET["CADEAUX"]) and $_GET["CADEAUX"] == "CADEAUX") {
    $products = $bdd->query('SELECT * FROM products where category = 4');
    $choose_product = 'CADEAUX';
}
// print_r($_SESSION);
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


    <form action="paiment.php" method="POST">
        <label for=prix">Prix :</label>
        <input type="text" name="prix" id="prix">
        <button>paye</button>
    </form>

    <?php include("./header.php"); ?>
    <div class="main-menu">
        <div class="main-menu-header">
            <h1>Produits : <?php echo $choose_product; ?></h1>
        </div>
        <div class="main-menu-center">
            <?php
            foreach ($products as $produit) :;
            ?>
                <div class="product">
                    <div class="picture-product">
                        <a href="products.php?product=<?php echo $produit[2] . '&categ=' . $produit[6]; ?>"><img src="images/<?php echo $produit[7]; ?>"></a>
                    </div>
                    <div class="description-product"><?php echo $produit[2]; ?></div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <?php include("./footer.php"); ?>

</body>

</html>