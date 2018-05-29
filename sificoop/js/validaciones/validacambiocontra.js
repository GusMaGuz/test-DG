(function(){

  var contrasena  = function(){
    var n = cont.value;
      if(n == ""){
        cont.select();
      }
      else if(!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/.test(n)){
        alert("Su contraseña debe de contener mas de 8 caracteres, incluyendo al menos una letra mayuscula, minuscula, número y caracter especial($@%&). No ingrese espacio en blanco");
        cont.value= "";
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

  //Funcion para validar formulario index
  var validaform = function(e){
    if(cont.value == "" || repcon.value == ""){
      alert("Complete los campos.");
      e.preventDefault();
    }
  };

  //Variables para validar formulario
  var formulario = document.getElementById('valform');
  formulario.addEventListener("submit",validaform);

  var cont = document.getElementById('contra');
  cont.addEventListener("blur",contrasena);

  var repcon = document.getElementById('repcontra');
  repcon.addEventListener("blur",verificacontra);

})();

