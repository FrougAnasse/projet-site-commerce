
const queryString = window.location.search;  //parametre de l'url
const urlParams = new URLSearchParams(queryString);
const product = urlParams.get('product')
const categ = urlParams.get('categ')

// modification des paramétres d'un produit 
$(document).ready(function() {
	//appel fonction de supression
	$('#suppress-product').on('click',function(e){  // changement du nom
		const action_type=0 //type d'action modifier == 1 , supprimer == 0

		XhrAction(product,categ,action_type)
		
		alert('done')
		
    	return false;
	}),
	//appel fonction de modification
	$('#change-name-product').on('click',function(e){  // changement du nom
		const action_type=1 //type d'action modifier == 1 , supprimer == 0
		const target='Name' // le nom de la collone sql a modifier

		let value=$('#change-name').val()

		if(value!="" && value!="undefined"){
			XhrAction(product,categ,value,action_type,target)
		}else{
			alert("veulliez rentrer un nouveau nom")
		}
    	return false;
	}),
	$('#change-price-product').on('click',function(e){ // changement du prix
		const action_type=1 //type d'action modifier == 1 , supprimer == 0
		const target='Price' // le nom de la collone sql a modifier

		let value=parseInt($('#change-price').val())

		if(Number.isInteger(value) && value>0){
			XhrAction(product,categ,value,action_type,target)
		}else{
			alert("veulliez rentrer un nouveau prix");
		}
    	return false;
	}),
	$('#change-desc-product').on('click',function(e){ // changement de la description
		const action_type=1 //type d'action modifier == 1 , supprimer == 0
		const target='Description' // le nom de la collone sql a modifier

		let value=$('#change-desc').val()
		
		if(value!="" && value!="undefined"){
			XhrAction(product,categ,value,action_type,target)
		}else{
			alert("veulliez rentrer un nouveau prix");
		}
    	return false;
	})
})

// ajout d'une nouvelle couleur
$(document).ready(function() {

	$('#add-new-color').on('click',function(e){  // changement du nom
		let new_color=$('#productColor').val();
		let stock=parseInt($('#stockNewColor').val())
		let image=""; // TODO
		
		alert(new_color);
		 if(new_color!=undefined && new_color!="" ){
			if(Number.isInteger(stock) && stock>0){
				
				const action_type=2 

				XhrAction(product,categ,'',action_type,'',new_color,'',stock)
				
				
					
				return false;
			}else{
				alert('stock');
			}
		 }else{
			alert('new');
		 }
	});

}) 


/**
 * TODO
 * @param {*} product 
 * @param {*} categ 
 * @param {*} value 
 * @param {*} action_type 
 * @param {*} target 
 */
function XhrAction(product,categ,value='',action_type,target='',new_color='',image='',stock=''){
	var xhr= new XMLHttpRequest()

	xhr.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			console.log(this.response);
		}else if(this.readyState == 4){
			alert("une erreur est survenue")
		}
	}

	let url="http://localhost/WelcomeToDubai/assetAdmin/script-admin.php?product="+product+"&categ="+categ+"&value="+value+"&action="+action_type+"&target="+target+"&new_color="+new_color+"&stock="+stock;

	alert(url)
	xhr.open("GET",url,true)
	xhr.send()
}