(function(){
  var validaform = function(e){
    if(document.form1.servicio.selectedIndex == 0){
      alert("No has seleccionado un servicio.");
      e.preventDefault();
    }
    else if(document.form1.retiro.selectedIndex == 0){
      alert("No has seleccionado una cuenta de retiro.");
      e.preventDefault();
    }
    else if(referencia.value == ""){
      alert("Ingresa referencia o número de celular.");
      e.preventDefault();
    }
    else{
      var reply = confirm("Se aplicará una comisión de 3 pesos por movimiento.\n ¿Esta seguro de realizar este pago?");
      if(reply==true){
        document.form1.submit();
        return true;
      }
      else{
        alert("Pago cancelado");
        e.preventDefault();
        return false;
      }
    }
  };

  var formulario = document.getElementById('valform');
  var referencia = document.getElementById('valref');

  formulario.addEventListener("submit",validaform);    
}());