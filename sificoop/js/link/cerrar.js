(function(){

	var cerrarsesion = function(){
		location.href = "conexiones/cerrarsesion.php";
	};

	var link = document.getElementById('cerrar');
	link.addEventListener("click",cerrarsesion);

}());