<?php

$action_type=$_GET['action'];
$action_type = trim($action_type);

if($action_type == 0 ){
    supProduct();
}

if($action_type == 1 ){
    modify();
}

if($action_type == 2){

	addNewColorProduct();
}

/**
 * TODO
 */
function supProduct(){
	require('../includes/connexionBDD.php');

	$idProduct=getIdProduct($bdd);

	$sql="DELETE FROM products WHERE id = '$idProduct'";

	$products =  $bdd->prepare($sql);
	$products->execute();

}
/**
 * TODO
 */
function modify(){
	require('../includes/connexionBDD.php');

	$idProduct=getIdProduct($bdd);

	$value = $_GET['value'];
	$value = trim($value);

	$target = $_GET['target'];
	$target = trim($target);

	$value= str_replace("'","\'",$value);
	
	$sql="UPDATE products
			SET $target = '$value'
			WHERE id = '$idProduct'";

	$products = $bdd->prepare($sql);
	$products->execute();
};

/**
 * TODO
 */
function addNewColorProduct(){

	require('../includes/connexionBDD.php');

	$color = $_GET['new_color'];
	$color = trim($color);

	$stock = $_GET['stock'];
	$stock = trim($stock);

	// TODO
	$image=$color.'.png';
	// $image = $_GET['image'];
	// $image = trim($image);

	$id=getIdProduct($bdd);

	$sql="INSERT INTO `pruduct-type`(`color`, `id-product`, `stock`, `image`) VALUES (?,?,?,?)";
	echo print_r($sql);
	$bdd->prepare($sql)->execute( [$color,$id,$stock,$color] );


	admin_log_file(['sql :::::::',$sql,'var ::::::',$color,$id,$stock,$color ]);

}

/**
 * TODO
 */
function getIdProduct($bdd){
	$urlProduct = $_GET['product'];
	$urlProduct = trim($urlProduct);

	$products = $bdd->prepare('SELECT id FROM products where Name= ?');
	$products->execute(array($urlProduct)) or die(print_r($products->errorInfo()));

	foreach ($products as $produit): 
		$idProduct=$produit['id'];
	endforeach ;

	return $idProduct;
}

/**
 * TODO
 */
function admin_log_file($description){
	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");

	$date=date(DATE_RFC2822);
	
	fwrite($myfile,$date);

	foreach($description as $line):
		print_r($line);
	//	fwrite($myfile, $description);
	endforeach;

	fclose($myfile);
}