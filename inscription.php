<?php 
    session_start();
    
    // ctype_alnum ; fonction a utiliser pour obliger l'utilisateur à n'utiliser que des lettres et des  chiffres pour le pseudo



    // INITIALISATION DES VARIABLES
    $quality = $firstname = $lastname = $tel = $mail = $pwd = $pwd2 = '' ;

    // Connexion à la BDD
    require('./includes/connexionBDD.php');

    // TEST DE CONNEXION UTILISATEUR
    if(!empty($_POST['quality']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['tel']) && !empty($_POST['mail']) && !empty($_POST['pwd']) && !empty($_POST['pwd2'])) {
        
        // VARIABLES
        $quality = htmlspecialchars($_POST["quality"]);
        $firstname = htmlspecialchars($_POST["firstname"]);
        $lastname = htmlspecialchars($_POST["lastname"]);
        $tel = htmlspecialchars($_POST["tel"]);
        $mail = htmlspecialchars($_POST["mail"]);
        $pwd = htmlspecialchars($_POST["pwd"]);
        $pwd2 = htmlspecialchars($_POST["pwd2"]);

        // TEST FORMAT ADRESSE MAIL SAISIE
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            header('location: ../WelcomeToDubai/inscription.php?error=true&pass=0');
            exit();
        }   

        // TEST COHERENCE DES PWD SAISIES
        if($pwd != $pwd2 ) {
            echo '123';
            header('location: ../WelcomeToDubai/inscription.php?error=true&pass=1');
            exit();            
        }

        // TEST UNICITE DU MAIL
        $req = $bdd->prepare('SELECT COUNT(*) as x FROM customers WHERE Mail = ?');
        $req->execute(array($mail)) or die(print_r($bdd->errorInfo()));
        while($resultat = $req->fetch()) {
            if($resultat['x'] == 1) {
                echo 'bug';
                header('location: ../WelcomeToDubai/inscription.php?error=true&pass=2');
                exit();   
            }
        }

        // SECURISATION PWD
        $pwd = 'ffg'.sha1($pwd).sha1($pwd).'25';

        // SI TOUT EST OK
        $req = $bdd->prepare('INSERT INTO customers (Sexe, Firstname, Lastname, Tel, Mail, Password) VALUES (?,?,?,?,?,?)');
        $req->execute(array($quality, $firstname, $lastname, $tel, $mail, $pwd)) or die(print_r($req->errorInfo()));   
        $_SESSION['connect'] = 1;
        $_SESSION['pseudo']= $firstname;   
        header('location: ../WelcomeToDubai/inscription.php?error=false&success=1');
        exit(); 
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
                <p>INSCRIVEZ-VOUS</p>
            </div>
            <form class="form-inscription" action="inscription.php" method="post">
                <li class="label-inscription"><label for="quality">Monsieur               Madame</label></li>
                <li class="checkbox">
                    <ul class="liste-checkbox">
                        <li class="input-inscription item1"><input type="radio" name="quality" value="1" required></li>
                        <li class="input-inscription item2"><input type="radio" name="quality" value="0" required></li>
                    </ul>
                </li>
                <li class="label-inscription"><label for="firstname">Prénom</label></li>
                <li class="input-inscription"><input type="text" name="firstname" required></li>
                <li class="label-inscription"><label for="lastname">Nom</label></li>
                <li class="input-inscription"><input type="text" name="lastname" required></li>
                <li class="label-inscription"><label for="tel">Téléphone</label></li>
                <li class="input-inscription"><input type="text" name="tel" required></li>  
                <li class="label-inscription"><label for="mail">Mail</label></li>
                <li class="input-inscription"><input type="text" name="mail" required></li> 
                <li class="label-inscription"><label for="pwd">Mot de passe</label></li>
                <li class="input-inscription"><input type="password" name="pwd" required></li> 
                <li class="label-inscription"><label for="pwd2">Confirmation du mot de passe</label></li>
                <li class="input-inscription"><input type="password" name="pwd2" required></li>                                               
                <li><input class="button-submit button-submit-3" type="submit" value="INSCRIPTION"></li>                                               
            </form>

            <?php if(isset($_GET['error']) && isset($_GET['pass']) && $_GET['pass'] =='0' ) { ?>
                <div class="div_message">
                     <p>L'adresse mail saisie est incorrecte.</p>
                </div>   
            <?php } else if(isset($_GET['error']) && isset($_GET['pass']) && $_GET['pass'] =='1' ) { ?>
                <div class="div_message">
                    <p>Les mots de passe ne sont pas identiques.</p>
                </div>   
            <?php } else if(isset($_GET['error']) && isset($_GET['pass']) && $_GET['pass'] =='2' ) { ?>
                <div class="div_message">
                     <p>Un compte est déjà associé à cette adresse mail.</p>
                </div>        
            <?php } else if(isset($_GET['success']) && $_GET['success'] =='1' ) { ?>
                <div class="div_message">
                     <p>Votre inscription est bien prise en compte.</p>
                </div>    
            <?php } ?>                                       
        </div>
        <?php include("./footer.php"); ?>
    </body>
</html>        