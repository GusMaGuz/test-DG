<?php
	//Codigo en servidor web host ,         usuario,     contraseña,    base de datos
	/*$link =mysqli_connect("localhost","dasandap_admin","9Mhr5].xXpBF","dasandap_cpt");
		if($link){
			mysqli_select_db($link,"dasandap_cpt");
		}*/
	$link =mysqli_connect("localhost","root","");
	if($link){
		mysqli_select_db($link,"sificoop");
	}
?>