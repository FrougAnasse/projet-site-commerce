<?php 

    require_once 'config.php';
   
    // Connexion à la BDD

    $host=CONFIG_DB_HOST;
    $dbname=CONFIG_DB_NAME; 
    $dbuser=CONFIG_DB_USER;
    $dbPassword=CONFIG_DB_PASSWORD;

    try {
        $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",  $dbuser, $dbPassword);
        
    } catch(Exception $e) {
        
        die('Erreur : '.$e->getMessage());
    }
