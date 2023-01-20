<?php 
    session_start();

    // CONNEXION A LA BDD
    require('../includes/connexionBDD.php');
    
    // RECUPERATION DU PRODUIT CHOISI A PARTIR DE L'URL
    $urlProduct = $_GET['product'];
    $urlProduct = trim($urlProduct);
    $products = $bdd->prepare('SELECT * FROM products where Name= ?');
    $products->execute(array($urlProduct)) or die(print_r($products->errorInfo()));
    $i = 0;

    // RECUPERATION DE LA CATEGORIE DU PRODUIT CHOISI
    $urlcategory = $_GET['categ'];
    $categ = $bdd->prepare('SELECT Name FROM CATEGORY where id = ?');
    $categ->execute(array($urlcategory));
    while($Category = $categ->fetch()) {
        $i = 1;
        $nameCategory = $Category[0];
    };



    


/**
 * permet l'affichage de toutes les couleur présente pour un article
 */

function getProductColorInfo($id){
	require('../includes/connexionBDD.php');
   
	$sql="SELECT `color` FROM `pruduct-type` WHERE `id-product`=".$id;

	$array_color=[];

	$result = $bdd->prepare($sql);
	$result->execute();

	While($color = $result->fetch()){
        //print_r($color);
		 $array_color[]=$color['color'];
	}
	//echo print_r($array_color);

	return $array_color;
}

/**
 * TODO
*/
function getSizeProductSize($id){
    require('../includes/connexionBDD.php');
   
	$sql="SELECT DISTINCT `size` FROM `pruduct-type` WHERE `id-product`=".$id;

	$array_size=[];

	$result = $bdd->prepare($sql);
	$result->execute();

	While($size = $result->fetch()){
        //print_r($color);
		 $array_size[]=$size['size'];
	}
  /*  echo "aaaaaaaaaaaaaaaaaaaa<pre>";
	echo print_r($array_size);
    echo "</pre>";*/

	return $array_size;
}



/**
 * returne array contenant les stock selon taille et couleur 
 */
 function getProductGetStock($id){
	require('../includes/connexionBDD.php');
   
	$sql="SELECT `color`,`size`,`stock` FROM `pruduct-type` WHERE `id-product`=".$id;

	$array_stock=[];

	$result = $bdd->prepare($sql);
	$result->execute();

	While($sizeColor = $result->fetch()){
         
        $array_stock_by_color=[];
         $array_stock_by_color[]=$sizeColor['color'];
         $array_stock_by_color[]=$sizeColor['size'];
         $array_stock_by_color[]=$sizeColor['stock'];
		 
         $array_stock[]=$array_stock_by_color;
	}

    /*echo "<pre>";
	echo print_r($array_stock);
    echo "</pre>";*/

	return $array_stock;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WelcomeToDubai</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="icon" href="burj-khalifa.jpg" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/18a82933ab.js" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


</head>
    <body>    
        <?php include("../header.php"); ?>

        <h1>Ajout de nouvelle couleurs</h1>
            <div>
                <div class="input-div">
                    <label for="productColor">Choose a color :</label>
                    <select name="productColor" id="productColor">
                            <option value='red' > red </option>
                            <option value='blue' > blue </option>
                            <option value='jaune' > jaune </option>
                            <option value='black' > black </option>
                            <option value='red' > 'red' </option>
                    </select>
                </div>

                <input  type="text" id="stockNewColor">

                <div class="input-div">
                    <label for="Imageproduct">Products picture:</label>
                    <input type="file"
                        id="Imageproduct" name="Imageproduct"
                        accept="image/png, image/jpeg">
                </div>

                <button id="add-new-color" >new color</button>
            <div>
        <?php foreach ($products as $produit):?>
            
            <div class="main-menu-products">
                <h1>Accueil / <?php echo $nameCategory.' / '.$produit[2]; ?></h1>

                <button id="suppress-product" style="width:150px;min-height:75px;color:black;background-color:red">SUPPRESSION DE L'ARTICLE</button>
                <div class="products-global">
                    <div class="image-products">
                        <div class="secondary-image-products">
                            <div class="imagesecondary item1"><img src="../images/<?php echo $produit[7]; ?>"></div>
                            <div class="imagesecondary item2"><img src="../images/<?php echo $produit[7]; ?>"></div>
                            <div class="imagesecondary item3"><img src="../images/<?php echo $produit[7]; ?>"></div>
                            <div class="imagesecondary item4"><img src="../images/<?php echo $produit[7]; ?>"></div>
                            <div class="imagesecondary item5"><img src="../images/<?php echo $produit[7]; ?>"></div>
                        </div>
                        <div class="main-image-products"><img src="../images/<?php echo $produit[7]; ?>"></div>
                    </div>
                    <div class="name-price-products">
                        <div class="name-products"><?php echo $produit[2]; ?></div>
						<div class="admin-modify">
							<input  type="text" id="change-name">
							<button id="change-name-product">
						</div>
                        <div class="color-products">
                            <div class="color-actually"><strong>Couleur</strong> :  Kaki</div>
                            <div class="list-color-product">
                                <?php 
                                    $colors=getProductColorInfo($produit[0]);
                                    $sizes=getSizeProductSize($produit[0]);
                                    $AllStockByColorSize=getProductGetStock($produit[0]);
                                   
                                    foreach ($colors as $color):
                                ?>
                                         <div class="color-product" style="background-color:<?php echo $color; ?>"></div>
                                <?php  endforeach; ?> 
                               
                            </div>
                        </div>
                        
                        <div class="size-product">
                            <p>Taille Disponible : </p>
                            <select name="size" class="div-size">
                                <?php foreach($sizes as $size ): ?>
                                    <option value="<?php echo $size ?>"><?php echo $size ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="size-product">
                            <p>Stock disponible : </p>
                            <?php foreach($AllStockByColorSize as $StockByColorSize ):
                                
                                $it=0;
                                $colorProduct='';
                                $colorSize='';
                                $colorStock='';


                                foreach($StockByColorSize as $data ): 
                                        if($it==0):
                                            $colorProduct=$data;
                                        elseif($it==1):
                                            $colorSize=$data;
                                        else:
                                            $colorStock=$data;
                                        endif;

                                        $it++;
                                    ?>
                                <?php endforeach; 

                                ?>
                                
                                <p class="stock-producthidden" id="<?php echo $colorProduct.'-'.$colorSize?>">Stock pour <?php echo $colorProduct.' de taille '.$colorSize?>: <?php echo $colorStock ?> unités restante</option>
                                  
                            <?php endforeach; ?>
                        </div>


                        <div class="price-products">
                            <?php echo $produit[4]; ?> €

                            <div class="admin-modify">
						    	<input  type="text" id="change-price">
							    <button id="change-price-product">
						    </div>
                    
                        </div>
                        <div class="add-to-panel">
                            <button id="btn-add-product">AJOUTER AU PANIER</button>
                        </div>
                    </div>
                </div>
                <div class="products-description-avis">
                    <h1>Description du produit : </h1>
                    <div class="description-products2">
                        <?php echo $produit[3]; ?>
                        
                        <div class="admin-modify">
					    	<input  type="text" id="change-desc">
						    <button id="change-desc-product">
						</div>
                        
                        
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque, expedita consequatur, ex minima totam cum aspernatur, pariatur quos iusto at error. Deleniti iure, ipsam quasi voluptatem velit odit labore est. Ea quos esse nulla quisquam alias nam voluptas deleniti fugit qui beatae amet possimus perspiciatis, dolores ipsum blanditiis voluptate dolorem aliquid mollitia quo magni vitae excepturi dolorum neque! Nesciunt, rem! Debitis deleniti, vitae impedit, quo dolorem eaque officia inventore adipisci nostrum possimus odit nam amet doloribus voluptatibus sint unde accusamus ab aspernatur veritatis consectetur deserunt, magnam quod voluptate dolore? Consectetur. Delectus architecto iure corrupti vel, perspiciatis beatae similique nobis veniam dolor labore! Veniam ipsum earum, officiis tempore id amet hic perspiciatis illum harum reiciendis provident, veritatis at est esse natus.
                        Neque natus quis impedit sapiente, alias quos ipsum provident dignissimos consequuntur incidunt quia necessitatibus, corrupti earum. Commodi labore minus, repellat expedita quasi sint deserunt rerum unde, laborum asperiores nesciunt natus.
                        Atque dolor aliquid maiores perferendis consequuntur temporibus, quia pariatur accusantium alias, quae ratione, fuga nemo praesentium. Repudiandae assumenda, labore est, nulla maiores, ullam perferendis sit distinctio vero cum cumque autem.
                        Suscipit repudiandae labore eligendi consectetur delectus iste cumque esse quos officiis unde, quibusdam, distinctio quas sunt facilis beatae optio nihil tempora dolorem enim? Deserunt minus, praesentium nobis animi quis molestiae?
                        Itaque impedit recusandae velit at ipsam voluptatibus enim neque. Repudiandae temporibus, expedita iure impedit inventore blanditiis aperiam amet delectus nisi hic at ab excepturi accusamus doloribus corporis consequuntur quaerat nobis!
                        A, culpa corporis harum cumque asperiores cum animi, deserunt doloremque quia ipsum minima obcaecati consequatur atque exercitationem laudantium nisi non? Dolor odio nostrum quia fuga accusamus officiis qui dolore tempora.
                        Deleniti hic atque fugit error ea facere quis blanditiis quidem vel assumenda quam harum ullam velit accusamus amet asperiores a numquam voluptates, iure ducimus minus! Laudantium assumenda odio voluptate. Provident?</p>
                    </div>
                    <div class="avis-products">

                    </div>
                </div>
            </div>
        <?php endforeach ?>

        <?php include("../footer.php"); ?>
        <script src="../assetAdmin/modify-supp-product-admin.js"></script>
        <script src="../assetAdmin/modify-supp-product-admin.js"></script>
    </body>
</html>

<?php 

?>