(function(){
  
  var validarnumeros = function(){
    var n = numeros.value;
      if(n == ""){
        numeros.select();
      }
      else if(!/^([0-9])*$/.test(n)){
        alert("Escriba su numero de socio de 5 digitos");
        numeros.value= "";
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

  var validaform = function(e){
    if(numeros.value == "" || corr.value == ""){
      alert("Completa los campos");
      e.preventDefault();
    }
  };

  //Variables para validar formulario
  var formulario = document.getElementById('valform');
  formulario.addEventListener("submit",validaform);

  var numeros = document.getElementById('num');
  numeros.addEventListener("blur",validarnumeros);

  var corr = document.getElementById('valcor');
  corr.addEventListener("blur",correo);

})();