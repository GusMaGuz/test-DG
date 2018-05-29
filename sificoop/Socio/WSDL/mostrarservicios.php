<?php
	//$start = time(true);
	require("conexionwsdl.php"); 
	//Consume servicio SOAP
	$result = $client->call("catalogoServicios");

	if ($client->fault) {
		echo utf8_decode('<script>alert("Fault en servicios proveedor.")</script>');
 		//echo '<h2>Fault</h2><pre>';
 		print_r($result);
 		//echo '</pre>';
	} 
	else {
 		// Check for errors
 		$err = $client->getError();
 		if ($err) {
  			// Display the error
  			echo utf8_decode('<script>alert("Error al cargar datos de proveedor de servicios.")</script>');
  			echo '<h2>Error</h2><pre>' . $err . '</pre>';
 		}
 		else {
  			$registros = array($result);//El resultado de la petición la almaceno en un arreglo
  			$_SESSION['listado']=$registros;//Creo Variable de sesion para almacenar el arreglo
 		}
	}

/*$time_elapsed= round(time(true) - $start, 2);
echo '<script>alert("Tiempo que tardo en cargar el script '.$time_elapsed.' ")</script>';*/
?>