(function(){
	var contrasena  = function(){
		var n = cont.value;
  		if(n == ""){
    		cont.select();
  		}
  		else if(!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/.test(n)){
   			alert("Su contraseña debe de contener mas de 8 caracteres, incluyendo al menos una letra mayuscula, minuscula, número y caracter especial($@%&). No ingrese espacio en blanco");
    		cont.value= "";
  		}
	};

	var verificacontra  = function(){
		var con = cont.value;
		var con2 = repcon.value;
  		if(con2 == ""){
    		repcon.select();
  		}
  		else if(con != con2){
   			alert("Tus contraseñas no coinciden");
    		repcon.value= "";
  		}
	};

	var validaform  = function(e){
		if(cont.value == "" || repcon.value == ""){
		   alert("Has dejado algún campo vacio");
		   e.preventDefault();
    	}
	};

	var formulario = document.getElementById('valform');
	formulario.addEventListener("submit",validaform);

	var repcon = document.getElementById('vpasco');
	repcon.addEventListener("blur",verificacontra);

	var cont = document.getElementById('vpas');
	cont.addEventListener("blur",contrasena);
}());
