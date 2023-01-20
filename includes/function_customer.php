<?php



/**
 * function who make the customer connect to our site
 * @param $mail : String - email of the user
 * @param $pwd : String - password of the user
 */
 function connect($mail,$pwd){

	 // Connexion à la BDD
	 require('connexionBDD.php');

	 // VARIABLES
	 $email = htmlspecialchars($mail);
	 $mdp = htmlspecialchars($pwd);
	 $mdp = 'ffg'.sha1($mdp).sha1($mdp).'25'; 

	 // TEST FORMAT ADRESSE MAIL SAISIE
	 if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		 header('location: ../WelcomeToDubai/connexion.php/?error=true&pass=0');
		 exit();
	 }

	 isAdmin($email,$mdp);

	 // VERIFICATION COMBINAISON MAIL/MDP
	 $req = $bdd->prepare('SELECT COUNT(*) as x FROM customers WHERE Mail = ? and password = ?');
	 $req->execute(array($email, $mdp)) or die(print_r($req->errorInfo()));
	 while($resultat = $req->fetch()) {
		 if($resultat['x'] == 0) {
			 header('location: ../WelcomeToDubai/connexion.php?error=true&pass=1');
			 exit();   
		 } else {
			 $_SESSION['connect'] = 1;
			 $req = $bdd->prepare('SELECT firstname FROM customers WHERE Mail = ? and password = ?');
			 $req->execute(array($email, $mdp)) or die(print_r($req->errorInfo()));
			 while($resultat = $req->fetch()) {
				 $prenom = $resultat['firstname'];
			 }
			 $_SESSION['pseudo']= $prenom;  
			 $_SESSION['email']= $email;                              
			 header('location: ../WelcomeToDubai/index.php');
			 exit();
		 }
	 }
 }

 /**
  * TODO
  */

  function isAdmin($email,$mdp){
	require('connexionBDD.php');

	$req = $bdd->prepare('SELECT COUNT(*) as x FROM admin WHERE mail = ? and password = ?');
	$req->execute(array($email, $mdp)) or die(print_r($req->errorInfo()));

	while($resultat = $req->fetch()) {
		if($resultat['x'] != 0) {
			$_SESSION['connect'] = 1;
			$req = $bdd->prepare('SELECT name FROM admin WHERE Mail = ? and password = ?');
			$req->execute(array($email, $mdp)) or die(print_r($req->errorInfo()));
			while($resultat = $req->fetch()) {
				$prenom = $resultat['firstname'];
			}
			$_SESSION['pseudo']= $prenom;  
			$_SESSION['email']= $email;                              
			header('location: ../WelcomeToDubai/index.php?admin=true');
			exit();
		}
	}
  }
 

/**
 * TODO
 */
 function disconnect(){
	session_start();
    session_unset();
    session_destroy();
    setcookie('auth', '', time()-1, '/', null, false, true);
    header('location: ../WelcomeToDubai/index.php');
    exit();
 }

 /**
 * TODO
 */

 function add_panier($product){

	require('connexionBDD.php');

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