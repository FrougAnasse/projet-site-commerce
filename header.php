
    <header>
        <nav>
            <div class="presentation">
                <p> Livraison express gratuite des 60€ d'achat</p>
            </div>
            <div class="navbar1">
                <div class="list-navbar1 logo-entreprise">
                    <!-- <li class="item-nav1 item1"> -->
                        <a lass="item-nav1 item1" href="index.php" class="accueil">		
                            <div class="container">
                                <svg viewBox="0 0 960 300">
                                    <symbol id="s-text">
                                    <text text-anchor="middle" x="50%" y="80%">DubaïLand</text>
                                    </symbol>
                                
                                    <g class = "g-ants">
                                    <use xlink:href="#s-text" class="text-copy"></use>
                                    <use xlink:href="#s-text" class="text-copy"></use>
                                    <use xlink:href="#s-text" class="text-copy"></use>
                                    <use xlink:href="#s-text" class="text-copy"></use>
                                    <use xlink:href="#s-text" class="text-copy"></use>
                                    </g>
                                </svg>
                            </div>
                        </a>
                </div>
                <div class="logo-connex-panel">
                    <div class="container-connex">
                        <div class="image-connex"><a href="connexion.php"><img src="./logo/user-solid-black.svg" alt="user"></a></div>
                        <!-- <div class="image-connex-survol">
                            <a href="connexion.php"><img src="user-solid-black.svg" alt="user"></a>
                            <div class="liste-connexion">
                                <div class="liste-connexion-item item1">Me connecter</div>
                                <div class="liste-connexion-item item2">Mes commandes</div>
                                <div class="liste-connexion-item item3">Mes points bonus</div>
                            </div>
                        </div> -->
                        <?php if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1) { ;?>                        
                           <div class="nom_utilisateur"><?php echo $_SESSION['pseudo'] ?></div>
                        <?php } ?>
                    </div>
                    <div class="container-panel">
                        <div class="panel"><a href="panel.php"><img src="./logo/bag-shopping-solid.svg" alt="panel"></a></div>
                        <?php   if(isset($_SESSION["panier"])) {
                                    $i = 0;
                                    foreach ($_SESSION["panier"] as $produit) : 
                                        $i = $i + 1;
                                    endforeach ;
                                    echo '<div class="schema-panel"><a href="panel.php">'.$i.'</a></div>' ;
                                }
                        ?> 
                        
                    </div>   
                    <div class="bouton-deconnexion">
                               <a href="deconnexion.php"><button class='deconnexion-button'>Se déconnecter</button></a> 
                               <!-- toujours metttre le lien avant le bouton sinon il faut cliquer sur les lettres et sa ma rendu fou -->
                    </div>                 
                </div>
            </div>
            <div class="navbar2">
                <form action="index.php" method = "get">
                <ul class="list-navbar2">
                    <li class="item-nav2 item0"> 
                            <input class="searchbar" type="text" class="searchbar" name="searchbar" placeholder="Rechercher">
                            <input class="searchbar-submit" type="submit" name="click" value="OK">
                    </li>
                    <li class="item-nav2 item1"> <input class="categ" type="submit" name="ABAYA" value="ABAYA"> </li>
                    <li class="item-nav2 item2"> <input class="categ" type="submit" name="VOILE" value="VOILE"> </li>
                    <li class="item-nav2 item3"> <input class="categ" type="submit" name="ROBE" value="ROBE"> </li>
                    <li class="item-nav2 item4"> <input class="categ" type="submit" name="CADEAUX" value="CADEAUX"> </li>
                </ul>
                </form>
            </div>
        </nav>
    </header>