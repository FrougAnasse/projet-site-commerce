<?php

require_once('./function_admin_add_new_product.php');

if(isset($_POST['productName']) && !empty($_POST['productName']) && 
	isset($_POST['description']) && !empty($_POST['description']) && 
	isset($_POST['price']) && !empty($_POST['price']) &&
	isset($_POST['stock']) && !empty($_POST['stock']) &&
	isset($_POST['productCategory']) && !empty($_POST['productCategory']) &&
	isset($_POST['Imageproduct']) && !empty($_POST['Imageproduct']) &&
	isset($_POST['productColor']) && !empty($_POST['productColor']) &&
	isset($_POST['stockProduct'])&& !empty($_POST['productColor']))
{
	addNewProduct($_POST['productName'],$_POST['description'],$_POST['price'],$_POST['stock'],$_POST['productCategory'],$_POST['productName'],$_POST['productColor'],$_POST['stockProduct']);
}