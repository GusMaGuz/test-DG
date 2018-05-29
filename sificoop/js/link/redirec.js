(function(){

	var redireccion = function(){
		location.href = "conexiones/redirect.php";
	};

	var link = document.getElementById('redirect');
	link.addEventListener("click",redireccion);

}());