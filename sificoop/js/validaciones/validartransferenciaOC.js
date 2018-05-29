(function(){
    var validaform = function(e){
        if(selectS.selectedIndex==0){
          alert("No has seleccionado un número de socio a transferir");
          e.preventDefault();
        }
        else if(selectD.selectedIndex==0){
          alert("No has seleccionado una cuenta destino a transferir");
          e.preventDefault();
        }
        else if(selectR.selectedIndex==0){
          alert("No has seleccionado una cuenta de retiro");
          e.preventDefault();
        }
        else if(cantidad.value==""){
          alert("No has ingresado una cantidad a transferir");
          e.preventDefault();
        }
        else{
          var reply = confirm("Se aplicará una comisión de 3 pesos por movimiento.\n¿Esta seguro de realizar esta transferencia?");
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
    var selectS = document.getElementById('Selectsocio');
    var selectD = document.getElementById('Selectdestino');
    var selectR = document.getElementById('Selectretiro');
    var cantidad = document.getElementById('vspre');

    formulario.addEventListener("submit",validaform);
      
}());