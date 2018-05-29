$(document).ready(main); 

var contador = 1; 

function main (){
	$('.bt-menu').click(function(){
		if(contador == 1){
			$('.contenedor').animate({
				left : '0'
			});
			contador = 0;
		}
		else{
			contador = 1; 
			$('.contenedor').animate({
				left : '-100%'
			});
		}
	});

	$('.submenu').click(function(){//Al dar click en la opcion que muestra submenu, muestra el submenu
		$(this).children('.children').slideToggle();
	});

	$('.a_children').click(function(){//Al dar click a alguna opcion de submenu se oculta todo el menu
		if(contador == 0){
			contador = 1; 
			$('.contenedor').animate({
				left : '-100%'
			});
		}
	});

	$('.ocultar').click(function(){//Al dar click a alguna de las opciones se oculta el menu
		if(contador == 0){
			contador = 1; 
			$('.contenedor').animate({
				left : '-100%'
			});
		}
	});
}