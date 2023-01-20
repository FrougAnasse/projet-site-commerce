<?php 
    session_start();

    // Connexion à la BDD
    require_once('./includes/connexionBDD.php');
    require_once('./includes/function_customer.php');




    // TEST DE CONNEXION UTILISATEUR
    if(!empty($_POST['mail2']) && !empty($_POST['pwd'])) {
       // connect($_POST['mail2'],$_POST['pwd']);
       connect($_POST['mail2'],$_POST['pwd']);
        // VARIABLES
        /* $email = htmlspecialchars($_POST['mail2']);
        $mdp = htmlspecialchars($_POST['pwd']);
        $mdp = 'ffg'.sha1($mdp).sha1($mdp).'25'; 

        // TEST FORMAT ADRESSE MAIL SAISIE
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('location: ../WelcomeToDubai/connexion.php?error=true&pass=0');
            exit();
        }

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
	 }*/
    }

    // REORIENTATION DU CLIENT VERS LA PAGE INFORMATION S'IL EST CONNECTER
    if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1) {
        header('location: ../WelcomeToDubai/information-user.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WelcomeToDubai</title>
    <link rel="stylesheet" type="text/css" href="./styles.css">
    <link rel="icon" href="burj-khalifa.jpg" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/18a82933ab.js" crossorigin="anonymous"></script>
</head>
    <body>    
        <?php include("./header.php"); ?>

        <div class="menu-connection">
            <div class="navbar-connection">
                <p>IDENTIFIEZ-VOUS</p>
            </div>
            <div class="form-connection">
                <div class="main-menu-connection item1">
                    <div class="createUser">
                        <div class="title-connection">Créez votre compte</div>
                        <form class = "test inscription" action="connexion.php" method="post">
                            <li><div class="p p1">Saisissez votre adresse e-mail pour créer votre compte.</div></li>
                            <li><label for="mail">Adresse e-mail</label></li>
                            <li><input type="email" name="mail1" required></li>
                            <!-- <li><a href="inscription.php"><input class="button-submit button-submit-1" type="submit" value="CREEZ VOTRE COMPTE"></a></li> -->
                            <li><a href="inscription.php" class="button-submit button-submit-1" >CREEZ VOTRE COMPTE</a></li>
                        </form>
                    </div>
                </div>
                <div class="main-menu-connection item2">
                    <div class="createUser">
                        <div class="title-connection">Déjà inscrit ?</div>
                        <form class = "test connection" action="connexion.php" method="post">
                            <li><label for="mail">Adresse e-mail</label></li>
                            <li><input type="email" name="mail2" required></li>
                            <li><label for="pwd">Mot de passe</label></li>
                            <li><input type="password" name="pwd" required></li>
                            <li><div class="p p2"><a href="recup-pwd.php">Mot de passe oublié ?</a></div></li>
                            <li><input class="button-submit button-submit-2" type="submit" value="CONNEXION"></li>
                        </form>
                        <?php if(isset($_GET['error']) && isset($_GET['pass']) && $_GET['pass'] =='0' ) { ?>
                            <div class="div_message">
                                     <p>L'adresse mail saisie est incorrecte.</p>
                            </div>   
                        <?php } else if(isset($_GET['error']) && isset($_GET['pass']) && $_GET['pass'] =='1' ) { ?>
                            <div class="div_message">
                                <p>Mot de passe ou email invalide, veuillez saisir à nouveau votre mot de passe.</p>
                            </div>             
                        <?php } ?>   
                    </div>            
                </div>
            </div>

        </div>
        <?php include("./footer.php"); ?>
    </body>
</html>
