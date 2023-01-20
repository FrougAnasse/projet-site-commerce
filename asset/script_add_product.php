<?php
session_start();

$action_type=$_GET['action'];
$action_type = trim($action_type);

if($action_type == 0 ){
    add_product();
}

if($action_type == 1 ){
    del_product();
}

/**
 * ajout de produit
 */
function add_product(){
    // Connexion Ã  la BDD
    require_once('../includes/connexionBDD.php');

    // RECUPERATION DU PRODUIT CHOISI A PARTIR DE L'URL
    $urlProduct = $_GET['product'];
    $urlProduct = trim($urlProduct);
    $products = $bdd->prepare('SELECT * FROM products where Name= ?');
    $products->execute(array($urlProduct)) or die(print_r($products->errorInfo()));
    $categ = $_GET['categ'];
    $i = 0;

    foreach ($products as $produit): 
        $var = $produit;
        $i = $i + 1;
    endforeach ;
    $_SESSION["panier-temp"]=$var;
    $_SESSION["panier"][]=$_SESSION["panier-temp"];
}

/**
 * suppression de produit
 */
function del_product(){

    require_once('../includes/connexionBDD.php');

    $urlProduct = $_GET['numProduitSession'];
    array_splice($_SESSION["panier"], $urlProduct, 1);
}

/**
 * 
 */