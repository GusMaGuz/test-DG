<?php
//INFO http://php.net/manual/es/language.types.array.php
	require_once('nusoap-master/src/nusoap.php'); 

	$username = "prueba"; 
	$password = "6I64p9x5u9pdS9W";

	$client = new nusoap_client('https://testservice.bluewebsoft.com/wsServicios/Servicio?wsdl', true);

	$err = $client->getError(); 
	if ($err) { 
	    echo '<h2>Error</h2><pre>' . $err . '</pre>'; 
	} 

	//Ingresamos usuario y contraseña paara el servicio web
	$client->setCredentials($username,$password); 

	//Llamamos al método del servicio web
	$result = $client->call("catalogoServicios");

	if ($client->fault) {
 		echo '<h2>Fault</h2><pre>';
 		print_r($result);
 		echo '</pre>';
	} 
	else {
 		// Check for errors
 		$err = $client->getError();
 		if ($err) {
  			// Display the error
  			echo '<h2>Error</h2><pre>' . $err . '</pre>';
 		} 
 		/*else {
  			// Display the result
  			var_dump($result);
  			echo '<h2>Result</h2><pre>';
  			print($result);
  			echo '</pre>';
 		}*/
 		else {
  			// Display the result
  			//var_dump($result); //Muestra los valores crudos recibidos en una variable
  			echo '<h2>Result</h2><pre>';
  			$registros = array($result);//El resultado de la petición la almaceno en un arreglo

  			foreach ($registros as $info) {//Imprimo el contenido del arreglo por medio de iteracion foreach
  				print_r($info);
  			}
  			echo '</pre>';
 		}
	}

	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
?>