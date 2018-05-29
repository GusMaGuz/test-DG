(function(){
  var validarcantidad = function(){
    var n = monto.value;
    if(n == ""){
      monto.select();
    }
    else if(!/^(\d)+((\.)(\d){1,2})?$/.test(n)){
      alert("Escriba una cantidad valida. Ej= 400.50 \nSi la cantidad no tiene centavos solo escriba Ej= 400.00\nEvita espacios.");
      monto.value= "";
    }
  };

  var monto = document.getElementById('valmonto');
  monto.addEventListener("blur",validarcantidad);   
}());