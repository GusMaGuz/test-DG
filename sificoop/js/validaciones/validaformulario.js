(function(){
	var nombre = function(){
		var n = nom.value;
  		if(n == ""){
    		nom.select();
  		}
  		else if(!/^[a-z-A-Z]+.+[a-z-A-Z]/.test(n)){
   			alert("Escriba su nombre correctamente. Evite espacios antes de escribir."); 
    		nom.value= "";
  		}
	};

	var apellidop = function(){
		var n = ap.value;
  		if(n == ""){
    		ap.select();
  		}
  		else if(!/^[a-z-A-Z]+.+[a-z-A-Z]/.test(n)){
   			alert("Escriba su apellido correctamente. Evite espacios antes de escribir."); 
    		ap.value= "";
  		}
	};

	var apellidom = function(){
		var n = am.value;
  		if(n == ""){
    		am.select();
  		}
  		else if(!/^[a-z-A-Z]+.+[a-z-A-Z]/.test(n)){
   			alert("Escriba su apellido correctamente. Evite espacios antes de escribir."); 
    		am.value= "";
  		}
	};

	var calle = function(){
		var n = call.value;
  		if(n == ""){
    		call.select();
  		}
      //else if(!/^[a-z-A-Z]+.+[a-z-A-Z]/.test(n)){
      else if(!/^[0-9-a-z-A-Z\-]{1,5}/.test(n)){
   			alert("Escriba el nombre de su calle. Evite espacios antes de escribir."); 
    		call.value= "";
  		}
	};

	var numero = function(){
		var n = numie.value;
  		if(n == ""){
    		numie.select();
  		}
  		else if(!/^[0-9-a-z-A-Z\-]{1,5}/.test(n)){
   			alert("Escriba una direccion valida. Evite espacios antes de escribir."); 
    		numie.value= "";
  		}
	};

	var colonia = function(){
		var n = col.value;
  		if(n == ""){
    		col.select();
  		}
      //else if(!/^[a-z-A-Z]+.+[a-z-A-Z]/.test(n)){
      else if(!/^[0-9-a-z-A-Z\-]{1,5}/.test(n)){
   			alert("Escriba el nombre de su colonia. Evite espacios antes de escribir."); 
    		col.value= "";
  		}
	};

	var localidad = function(){
		var n = local.value;
  		if(n == ""){
    		local.select();
  		}
  		else if(!/^[a-z-A-Z]+.+[a-z-A-Z]/.test(n)){
   			alert("Escriba el nombre de su localidad. Evite espacios antes de escribir.");
    		local.value= "";
  		}
	};

	var correo = function(){
		var n = corr.value;
  		if(n == ""){
    		corr.select();
  		}
  		else if(!/^[a-z-0-9\.\_\-]+@+[a-z]+.+[a-z]/.test(n)){
   			alert("Escriba un correo electronico valido");
    		corr.value= "";
  		}
	};

	var fijo = function(){
		var n = tel.value;
  		if(n == ""){
    		tel.select();
  		}
  		else if(!/^[0-9]{7,10}/.test(n)){
   			alert("Escriba su numero de telefono fijo de 12 digitos incluyendo lada. Ej=(013434100000)");
    		tel.value= "";
  		}
	};

	var celular  = function(){
		var n = cel.value;
  		if(n == ""){
    		cel.select();
  		}
  		else if(!/^[0-9]{10}/.test(n)){
   			alert("Escriba su numero de telefono celular de 10 digitos. Ej=(3414100000)");
    		cel.value= "";
  		}
	};

	var contrasena  = function(){
		var n = cont.value;
  		if(n == ""){
    		cont.select();
  		}
  		else if(!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/.test(n)){
   			alert("Su contraseña debe de contener mas de 8 caracteres, incluyendo al menos una letra mayuscula, minuscula, número y caracter especial($@%&). No ingrese espacio en blanco");
    		cont.value= "";
        cont.select();
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
		if(nom.value == "" || ap.value == "" || am.value == "" || call.value == "" || numie.value == "" || col.value == "" || local.value == "" || corr.value == "" || tel.value == "" || cel.value == "" || cont.value == "" || repcon.value == ""){
		   alert("Has dejado algún campo vacio");
		   e.preventDefault();
    	}
	};

	var formulario = document.getElementById('valforegistro');
	formulario.addEventListener("submit",validaform);

	var repcon = document.getElementById('vpasco');
	repcon.addEventListener("blur",verificacontra);

	var cont = document.getElementById('vpas');
	cont.addEventListener("blur",contrasena);

	var cel = document.getElementById('vtc');
	cel.addEventListener("blur",celular);

	var tel = document.getElementById('vtf');
	tel.addEventListener("blur",fijo);

	var corr = document.getElementById('valcor');
	corr.addEventListener("blur",correo);

	var local = document.getElementById('vlo');
	local.addEventListener("blur",localidad);

	var col = document.getElementById('vco');
	col.addEventListener("blur",colonia);

	var numie = document.getElementById('vn');
	numie.addEventListener("blur",numero);

	var call = document.getElementById('vc');
	call.addEventListener("blur",calle);

	var am = document.getElementById('vam');
	am.addEventListener("blur",apellidom);

	var ap = document.getElementById('vap');
	ap.addEventListener("blur",apellidop);

	var nom = document.getElementById('vno');
	nom.addEventListener("blur",nombre);

}());

//Este es el utilizado para registro de socio en administrador
/*function valid(){
	var n = document.getElementById("vis").value;
		if(!/^[0-9]{5,8}/.test(n)){
			alert("Escriba su numero de socio de 5 digitos");
		 	document.getElementById('vis').value = '';
		 	document.vis.focus();
		}
}*/
//Este es utilizado para el ingreso de cantidades en pagos, transferencias y registro de saldos
/*function valsp(){
		var n = document.getElementById("vspre").value;
		if(!/^(\d)+((\.)(\d){1,2})?$/.test(n)){
			alert("Escriba una cantidad valida. Ej= 400.50 \nSi la cantidad no tiene centavos solo escriba Ej= 400.00\nEvita espacios.");
		 	document.getElementById('vspre').value = '';
		 	document.vtc.focus();
		}
	}*/
