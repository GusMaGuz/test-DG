<?php
require_once('nusoap-master/src/nusoap.php'); 

	$username = "prueba"; 
	$password = "6I64p9x5u9pdS9W";

	//$client = new nusoap_client('https://testservice.bluewebsoft.com/wsServicios/Servicio?wsdl', true);
	$client = new nusoap_client('https://testservice.bluewebsoft.com/wsServicios/Servicio?wsdl', 'wsdl' , false, false, false, false, 0, 40);
	
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = FALSE;
	//Ingresamos usuario y contraseña paara el servicio web
	$client->setCredentials($username,$password);

	$err = $client->getError(); 
	if ($err) { 
	    echo '<h2>Error</h2><pre>' . $err . '</pre>'; 
	}
?>