// supression d'un article dans 

$(document).ready(function() {
    $('tr[name^="tr-"]').on('click', function (e) {     
        
        const product=$(this).data("product")
        const categ=$(this).data("categ")
        const idproduct=$(this).data("idproduct")
        const action_type=1

        var xhr= new XMLHttpRequest()

        xhr.onreadystatechange= function(){
            if(this.readyState== 4 && this.status == 200){
                console.log(this.response);
            }else if(this.readyState == 4){
                alert("une erreur est survenue")
            }
        }

        let url="./asset/script_add_product.php?product="+product+"&categ="+categ+"&action="+action_type;

        constid="tr-"+idproduct
        $(this).css('display','none')
        actualisation_del_produit()

        xhr.open("GET",url,true)
        xhr.send()

        return false;
    });   
});


function actualisation_del_produit(){
    $actualisation_nbr_produit=$('.schema-panel>a').html()
    $actualisation_nbr_produit--
    $('.schema-panel>a').text(""+$actualisation_nbr_produit)
}