(function(){
	//Funcion para validar Numeros
  var validarsocio = function(){
    var n = validas.value;
      if(n == ""){
        validas.select();
      }
      else if(!/^[0-9]{5,8}/.test(n)){
        alert("Escriba su numero de socio de 5 digitos");
        validas.value= "";
      }
  };

  var validas = document.getElementById('vis');
  validas.addEventListener("blur",validarsocio);


}());