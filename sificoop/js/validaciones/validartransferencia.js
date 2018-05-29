(function(){
    function validar(){
      if(document.form1.retiro.value == document.form1.deposito.value){
        alert("No puede transferir entre cuentas iguales.");
        document.form1.retiro.value = '1';
        document.form1.deposito.value= '2';
      } 
    }

    var validaform = function(e){
      if(document.form1.retiro.selectedIndex == 0){
        alert("No has elegido una cuenta de retiro.");
        e.preventDefault();
      }
      else if(document.form1.deposito.selectedIndex == 0){
        alert("No has elegido una cuenta de deposito.");
        e.preventDefault();
      }
      else if(cantidad.value == ""){
        alert("Ingresa cantidad a depositar");
        e.preventDefault();
      }
      else if(document.form1.retiro.value == document.form1.deposito.value){
        alert("No puede transferir entre cuentas iguales.");
        document.form1.retiro.value = '1';
        document.form1.deposito.value= '2';
        e.preventDefault();
      } 
      else{
        var reply = confirm("Se aplicará una comisión de 3 pesos por movimiento.\n¿Esta seguro de realizar este movimiento?");
        if(reply==true){
          //alert("Enviando datos");
          document.form1.submit();
          return true;
        }
        else {
          alert("Transferencia cancelada");
          e.preventDefault();
          return false;
        }
      }
    };


    var formulario = document.getElementById('valform');
    var cantidad = document.getElementById('vspre');

    formulario.addEventListener("submit",validaform);
    cantidad.addEventListener("focus",validar);
    
  }());