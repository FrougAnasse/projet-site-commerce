<?php 
    session_start();

    // Connexion à la BDD
    require_once('./includes/connexionBDD.php');
    require_once('./model/model_panel.php');

    //print_r(get_tbody_var($_SESSION["panier"]));

    $nbProduitSession = 0;
    //print_r($_SESSION["panier"]);

    $info_tbody=get_tbody_var($_SESSION["panier"]);


    //print_r( $info_tbody);

    get_tr_tbody($info_tbody[0]);
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>

    <?php include("./header.php"); ?>
        
    <div class="menu-panel">
        <div class="header-panel">
            <div  class="title-panel">RECAPITULATIF DE LA COMMANDE</div>
            <div class="number-product-panel">Votre panier contient <?php echo $nbProduitSession; ?> produits</div>
        </div>
        
        <div class="suivi-panel">
            <div class="suivi-panel-item item1">01. Récapitulatif</div>
            <div class="suivi-panel-item item2">02. Connexion</div>
            <div class="suivi-panel-item item3">03. Adresse</div>
            <div class="suivi-panel-item item4">04. Livraison</div>
            <div class="suivi-panel-item item5">05. Paiement</div>
        </div>

        <div class="main-menu-panel">
            <table class="tableau-style">
                <thead>
                    <tr>
                        <th class="th-item1">Produit</th>
                        <th class="th-item2">Description</th>
                        <th class="th-item3">Disponibilité</th>
                        <th class="th-item4">Prix unitaire</th>
                        <th class="th-item5">Quantité</th>
                        <th class="th-item6"></th>
                        <th class="th-item7">Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if(!empty($info_tbody && $info_tbody[1]!= 0)) {
                            foreach ($info_tbody[0] as $produit) : 
                    ?> 
                                <tr name="<?php echo $produit[0]?>">
                                    <td class="td-item1"><div class="image-product-panel"><img src="<?php echo $produit[1] ?>"></div></td>
                                    <td class="td-item2">
                                        <div class="description-product-panel"><?php echo $produit[2] ?></div>
                                        <div class="size-product-panel">Taille : L/XL</div>
                                    </td>
                                    <td class="td-item3"><?php echo $produit[3] ?> </td>
                                    <td class="td-item4"><?php echo $produit[4].' €' ?></td>
                                    <td class="td-item5">
                                        <div class="quantity-product-panel">1</div>
                                        <div class="add-quantity-product">
                                            <button class="add-quantity-product-more item1">+</button>
                                            <button class="add-quantity-product-more item2">-</button>
                                        </div>
                                    </td>
                                    <td class="td-item6">
                                        <button id="btn-suppression"
                                                data-product="product=<?php echo $produit[2]?>" 
                                                data-categ="categ=<?php echo $produit[6]?>" 
                                                data-idproduct="<?php echo $numProduitSession  ?>"
                                        > x </button>
                                    </td>
                                    <td class="td-item7"><?php echo $produit[4].' €' ?></td>
                                </tr>
                                <?php 
                            endforeach ;
                        }
                        else { ?>
                            <tr>
                                <td class="td-item1" colspan=4><div class="panier-vide">Aucun produit sélectionné</div></td>
                            </tr>
                            <?php 
                        } ; ?>
                    
                    
                    
                    <!-- Partie total du tableau -->   
                    <tr>
                        <td class="td-item20 item1" rowspan=4 colspan=2>
                            <div class="bon-reduction">
                                <div class="bon-reduction-title">BONS DE REDUCTIONS</div>
                                <div class="searchbar-reduction">
                                    <form action="panel.php" method = "get">
                                        <input class="searchbar-reduc" type="text" name="searchbar" placeholder="Code réduction">
                                        <input class="searchbar-reduc-submit" type="submit" name="click" value="OK">
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td class="td-item20 item2" colspan=3>Total produits</td>
                        <td class="td-item20 item3" colspan=2><?php echo $info_tbody[1].' €'; ?></td>
                    </tr>  
                    <tr>
                        <td class="td-item20 item2" colspan=3>Bon réduction</td>
                        <td class="td-item20 item3" colspan=2></td>
                    </tr>
                    <tr>
                        <td class="td-item20 item2" colspan=3>Frais de port</td>
                        <td class="td-item20 item3" colspan=2>4.90 €</td>
                    </tr>
                    <tr>
                        <td class="td-item20 item2" colspan=3>Total TTC</td>
                        <td class="td-item20 item3" colspan=2><?php  echo $info_tbody[1].' €'; ?></td>
                    </tr>
                </tbody>


            </table>   
        </div>

        <div class="menu-commande">
            <div class="div-retour">
                <a href="index.php"><strong><</strong> CONTINUER MES ACHATS</a>
            </div>
            <?php if(!empty($_SESSION) && $_SESSION['connect'] = 1) { ?>            
                <div class="div-commande">
                    <a href="paiement.php">COMMANDER <strong>></strong></a>
                </div>
            <?php } else { ?>     
                <div class="div-commande-2">
                    <a href="">COMMANDER <strong>></strong></a>
                </div>
            <?php } ; ?>                                    
        </div>

        <?php if(!empty($_SESSION['connect']) && $_SESSION['connect'] != 1 && $numProduitSession > 0) { ?>            
            <div class="div-commande-impossible"><p>Veuillez vous connecter pour finaliser votre commande.</p></div>
        <?php } ; ?>                                    

        <div class="transport">
            <div class="div-image"><img src="truck-solid.svg" alt="truck"></div>
            <div class="div-text">
                <div class="div-main-text">Montant restant pour la livraison gratuire : 22,00 €</div>
                <div class="div-secondary-text">Livraison gratuinte à partir de : 50,00 €</div>
            </div>
        </div>

        <div class="vide"></div>

    </div>


    <?php include("./footer.php"); ?>
    <script src="./asset/script_del_product.js"></script>
</body>
</html>