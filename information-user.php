<?php 
    session_start();
    // CONNEXION A LA BDD
    require('./includes/connexionBDD.php');

    // RECUPERATION DES INFOS CLIENTS
    $mail = $_SESSION['email'];
    $req = $bdd->prepare('SELECT Sexe, Firstname, Lastname, Tel, Mail FROM customers WHERE Mail = ?');
    $req->execute(array($mail)) or die(print_r($req->errorInfo()));
    while($resultat = $req->fetch()) {
        $Sexe= $resultat['Sexe'];
        $Firstname= $resultat['Firstname'];
        $Lastname= $resultat['Lastname'];
        $Tel= $resultat['Tel'];
        $Mail= $resultat['Mail'];
    }
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
    <script src="https://kit.fontawesome.com/18a82933ab.js" crossorigin="anonymous"></script>

</head>
    <body>    
        <?php include("./header.php"); ?>
        <div class="menu-inscription">
            <div class="navbar-inscription">
                <p>VOS INFORMATIONS</p>
            </div>
            <form class="form-inscription" action="inscription.php" method="post">
                <!-- <li class="label-inscription"><label for="quality"><?php if($Sexe == 1) { echo 'Monsieur';} else { echo 'Madame';}?></label></li> -->
                <li class="label-inscription"><label for="firstname">Prénom</label></li>
                <li class="input-inscription"><input type="text" name="firstname" value=<?php echo $Firstname ?> required></li>
                <li class="label-inscription"><label for="lastname">Nom</label></li>
                <li class="input-inscription"><input type="text" name="lastname" value=<?php echo $Lastname ?> required></li>
                <li class="label-inscription"><label for="tel">Téléphone</label></li>
                <li class="input-inscription"><input type="text" name="tel" value=<?php echo $Tel ?> required></li>  
                <li class="label-inscription"><label for="mail">Mail</label></li>
                <li class="input-inscription"><input type="text" name="mail" value=<?php echo $Mail ?> required></li>                                              
                <li><input class="button-submit button-submit-3" type="submit" value="VALIDATION"></li>                                               
            </form>
        </div>
        <?php include("./footer.php"); ?>
    </body>
</html>        