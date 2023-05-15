//CHANGE ITENS CLIENTS 
$(document).ready(function () {
	$(".change_type").change(function () {
		$(this).find("option:selected")
			.each(function () {
				var optionValue = $(this).attr("id");
				if (optionValue) {
					$(".hide").not("." + optionValue).hide();
					$("." + optionValue).show();
				} else {
					$(".hide").hide();
				}
			});
	}).change();
});

function mostrarItem(){
	let item = document.querySelector('.itemOculto')
	let check = document.querySelector('.payment_situation')
	if(item.classList.contains('hide')){
		item.classList.remove('hide')
		item.classList.add('show')
	} else{
		item.classList.add('hide')
		item.classList.remove('show')
	}
}