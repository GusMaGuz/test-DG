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

 
  var numeros = document.getElementById('numberinp');
  numeros.addEventListener("blur",validarnumeros);


  
  var validaform = function(e){
    if(numeros.value == "" || contra.value == ""){
      alert("No has ingresado tu numero de socio o contraseña");
      e.preventDefault();
    }
  };

  
  var formulario = document.getElementById('valforindex'),
                 contra = document.getElementById('contrainp');

  formulario.addEventListener("submit",validaform);

})();

