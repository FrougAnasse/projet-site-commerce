<?php 
    session_start();

    // Connexion à la BDD
    require_once('../includes/connexionBDD.php');
    require_once('../includes/function_customer.php');

    require_once('../includes/function_admin_add_new_product.php');

    $arrayCategory=getAllCategoryProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WelcomeToDubai</title>
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <link rel="icon" href="burj-khalifa.jpg" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/18a82933ab.js" crossorigin="anonymous"></script>
</head>
    <body>    
        <?php include("../header.php"); ?>

        <script>
                async function uploadImage() 
                {
                    let data = document.getElementById("Imageproduct").files[0];
                    let entry = document.getElementById("Imageproduct").files[0];
                    console.log('doupload',entry,data)
                    fetch('./aimage/' + encodeURIComponent(entry.name), {method:'POST',body:data});
                    alert('your file has been uploaded');
                    location.reload();    
                }
        </script>

		<div>
                        
        <!-- action="./includes/addProduct.php" -->
            <form  action="../includes/addProduct.php" method="POST">
                <div class="input-div">
                    <label for="productName">Product Name:</label>
                    <input type="text" id="productName" name="productName"><br><br>
                </div>

                <div class="input-div">
                    <label for="description">Description :</label>
                    <input type="text" id="description" name="description"><br><br>
                </div>

                <div class="input-div">
                    <label for="price">Price :</label>
                    <input type="number" min="1" id="price" name="price"><br><br>
                </div>

                <div class="input-div">
                    <label for="stock">Stock :</label>
                    <input type="number" min="1" id="stock" name="stock"><br><br>
                </div>

                <div class="input-div">
                    <label for="stockProduct">Choose a color :</label>
                    <select name="stockProduct" id="stockProduct">
                            <option value='s' > S </option>
                            <option value='M' > M </option>
                            <option value='L' > L </option>
                            <option value='XXL' > XXL </option>
                    </select>
                </div>

                <div class="input-div">
                    <label for="productCategory">Choose a category :</label>
                    <select name="productCategory" id="productCategory">
                        <?php foreach ( $arrayCategory as $cat) : ?>
                            <option value=<?php echo $cat[0] ?> > <?php echo $cat[1] ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-div">
                    <label for="productColor">Choose a color :</label>
                    <select name="productColor" id="productColor">
                            <option value='red' > red </option>
                            <option value='blue' > blue </option>
                            <option value='yellow' > jaune </option>
                            <option value='black' > noir </option>
                            <option value='white' > 'blanc' </option>
                    </select>
                </div>


                <div class="input-div">
                    <label for="Imageproduct">Products picture:</label>
                    <input type="file"
                        id="Imageproduct" name="Imageproduct"
                        accept="image/png, image/jpeg">
                </div>

                <input type="submit" value="Submit">
            </form> 

            <button onclick="uploadImage()"></button>

        
		</div>

        <?php include("../footer.php"); ?>
    </body>
</html>
