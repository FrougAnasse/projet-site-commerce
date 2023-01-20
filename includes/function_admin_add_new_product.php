<?php


/**
 * TODO
 */
function addNewProduct($name,$description,$price,$stock,$cat,$image,$color,$size)
{
	//insetion dans la table product
	insertProduct($name,$description,$price,$stock,$cat,$image);

	//recupération de l'id généré
	$id=getIdProduct($name);

	//insertion dans la couleur
	insertProductType($color,$id,$stock,$size,$image,$size);
}

/**
 * TODO
 */
function insertProduct($name,$description,$price,$stock,$cat,$image) {
   require('connexionBDD.php');
   
   $sql="INSERT INTO `products`(`Name`, `Description`, `Price`, `stock`, `Category`, `Image`) VALUES (?,?,?,?,?,?)";
   $bdd->prepare($sql)->execute([$name,$description,$price,$stock,$cat,$image]); 
}


/**
 * TODO
 */
function insertProductType($color,$id,$stock,$image,$size){
	
	require('connexionBDD.php');

	$sql="INSERT INTO `pruduct-type`(`color`, `id-product`, `stock`, `image`, `size`) VALUES (?,?,?,?,?)";
	$bdd->prepare($sql)->execute( [$color,$id,$stock,$size,$image] );		
}


/**
 * TODO
 */
function getAllCategoryProducts(){
	
	require('connexionBDD.php');

	$arraySelectCat=[];

	$sql="SELECT * FROM `category` WHERE 1";
	
	$result = $bdd->prepare($sql);
	$result->execute();

	while($Category = $result->fetch()) {
	   $arrayInfo=[$Category[0],$Category[2]];
	   $arraySelectCat[]=$arrayInfo;
    }
	return $arraySelectCat;
}

/**
 * TODO
 */
function getIdProduct($name){

	require('connexionBDD.php');

	$sql="SELECT `ID` FROM `products` WHERE `name`='".$name."'";
	
	$result = $bdd->prepare($sql);
	$result->execute();

	$id=-5;

	echo ('out');
	While($idd = $result->fetch()){
		 $id=$idd['ID'];
	}
	return $id;
}

