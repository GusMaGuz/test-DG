<?php
	session_start(); 
	unset($_SESSION['sesionRS']);
	unset($_SESSION['sesionRC']);
	unset($_SESSION['sesionP']);
	unset($_SESSION['sesionA']); 
	unset($_SESSION['listado']);//Nuevo
	unset($_SESSION['respuestaVen']);//Nuevo
	
	session_destroy();
	//header("Location: https://www.dasandapps.com/CPT/"); 
	header("Location: http://localhost/"); 
	exit; 
?>