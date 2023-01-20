// ajoutarticle panier

const btnAddProduct= document.getElementById('btn-add-product')

btnAddProduct.addEventListener("click",function(e){
    e.preventDefault()
   
    // récpération des paramétre get de l'url
    const queryString = window.location.search;  //paramétre de l'url
    const urlParams = new URLSearchParams(queryString);
    const product = urlParams.get('product')
    const categ = urlParams.get('categ')
    const action_type=0                       // l'action qui consiste à ajouter un produit est 0

    var xhr= new XMLHttpRequest()

    xhr.onreadystatechange= function(){
        if(this.readyState== 4 && this.status == 200){
            console.log(this.response)
        }else if(this.readyState == 4){
            alert("une erreur est survenue")
        }
    }

    let url="./asset/script_add_product.php?product="+product+"&categ="+categ+"&action="+action_type;

    actualisation_add_produit()

    xhr.open("GET",url,true)
    xhr.send()

    return false;
})



function actualisation_add_produit(){
    $actualisation_nbr_produit=$('.schema-panel>a').html()
    $actualisation_nbr_produit++
    $('.schema-panel>a').text(""+$actualisation_nbr_produit)
}