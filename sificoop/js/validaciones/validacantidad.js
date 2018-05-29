(function(){
	//Funcion para validar Numeros
  var validarcantidad = function(){
    var n = cantidad.value;
      if(n == ""){
        cantidad.select();
      }
      else if(!/^(\d)+((\.)(\d){1,2})?$/.test(n)){
        alert("Escriba una cantidad valida. Ej= 400.50 \nSi la cantidad no tiene centavos solo escriba Ej= 400.00\nEvita espacios.");
        cantidad.value= "";
      }
  };

  var cantidad = document.getElementById('vspre');
  cantidad.addEventListener("blur",validarcantidad);


}());