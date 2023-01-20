<?php

function get_tbody_var($panier){

    $nbProduitSession = count($panier);



    $array_all_info=[];

    $array_tbody=[];
    $all_cost = 0;

    $numProduitSession = 0;

    
    $j = 0;

    foreach ($panier as $produit) :
        $array_tr = []; 
        $id_tr='tr-'.$numProduitSession;
        $url_image = 'images/'.$produit[7];
        $name_product = $produit[2];
        $disponible ='Indisponible';
        if($produit[4] > 0) {  $disponible = 'Disponible'; }  
        $cost_product=$produit[4];
        $all_cost = $all_cost + $produit[4];
        $categ = $produit[6];

        array_push($array_tr,$id_tr,$url_image,$name_product,$disponible,$cost_product,$categ,$numProduitSession);
        array_push($array_tbody,$array_tr);

        $numProduitSession++; 

    endforeach;

    array_push($array_all_info,$array_tbody);
    array_push($array_all_info,$all_cost);

    return $array_all_info;
}

function get_tr_tbody($array_tr){
    foreach ($array_tr as $tr){
        print_r($tr);
        print_r('<br>');
    }
}