var tiempo;
function ini() {
  tiempo = setTimeout("location.href='../conexiones/cerrarsesion.php';",600000);
  //tiempo = setTimeout('location="index.html"',60000);
}
function parar() {
  clearTimeout(tiempo);
  tiempo = setTimeout("location.href='../conexiones/cerrarsesion.php';",600000);
  alert("Se reinicio el tiempo.");
  //tiempo = setTimeout('location="index.html"',60000);
}


/*var iframe = $('#firstembed').contents();
iframe.find("<clickable_thing>").click(function(){
   alert("test");
});*/

/*var tiempo;//10000 = 10 segundos
	function ini() {
		tiempo = setTimeout("location.href='../conexiones/cerrarsesion.php';",300000 ); // 5 minutos 
	}*/