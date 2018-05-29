(function(){
    var validaform = function(e){
        if(document.form1.deposito.selectedIndex == 0){
          alert("No has seleccionado una cuenta de retiro");
          e.preventDefault();
        }
        else if(document.form1.depositar.selectedIndex == 0){
          alert("No has seleccionado una opcion de prestamo a depositar");
          e.preventDefault();
        }
        else{
          var reply = confirm("Se aplicará una comisión de 3 pesos por movimiento.\n¿Esta seguro de realizar este pago?");
          if(reply==true){
            //alert("Enviando datos");
            document.form1.submit();
            return true;
          }
          else {
            alert("Pago cancelado");
            e.preventDefault();
            return false;
          }
        }
      };


    var formulario = document.getElementById('valform');
    var cantidad = document.getElementById('vspre');
    var select = document.getElementById('valorSelect');

    formulario.addEventListener("submit",validaform);
      
}());