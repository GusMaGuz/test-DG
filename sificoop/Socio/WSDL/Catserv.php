<?php
//INFO http://php.net/manual/es/language.types.array.php
//https://www.anerbarrena.com/php-array-tipos-ejemplos-3876/
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
 		else {
  			// Display the result
  			//var_dump($result); //Muestra los valores crudos recibidos en una variable
  			echo '<h2>Result catalogoServicios</h2><pre>';
  			$registros = array($result);//El resultado de la petición la almaceno en un arreglo

  			echo "Codigo: ".$registros[0]['return']['respuesta']['codigoRespuesta']." -> ".$registros[0]['return']['respuesta']['descripcionRespuesta'];
  			echo "<br>";
  			echo "<br>";
  			echo '<div class="contTabla">';
				echo '<table border="1" class="tabla">';
					echo "<tr>";
						echo "<th>Posicion</th>";
						echo "<th>Categoria</th>";
						echo "<th>Descripcion</th>";
						echo "<th>Giro</th>";
						echo "<th>Grupo</th>";
						echo "<th>Informacion Adicional</th>";
						echo "<th>Operador</th>";
						echo "<th>Precio</th>";
						echo "<th>Sku</th>";
						echo "<th>Tipo producto</th>";
						echo "<th>Vigencia</th>";
					echo "</tr>";
					echo "Cantidad de registros devueltos: ".$cantreg =  count($registros[0]['return']['sku']);
					echo "<br>";
					echo "<br>";
  					for($x=0; $x<$cantreg; $x++){
  						echo "<tr><td>".$x."</td><td>".$registros[0]['return']['sku'][$x]['categoria']."</td><td>".$registros[0]['return']['sku'][$x]['descripcion']."</td><td>".$registros[0]['return']['sku'][$x]['giro']."</td><td>".$registros[0]['return']['sku'][$x]['grupo']."</td><td>".$registros[0]['return']['sku'][$x]['informacionAdicional']."</td><td>".$registros[0]['return']['sku'][$x]['operador']."</td><td>".$registros[0]['return']['sku'][$x]['precio']."</td><td>".$registros[0]['return']['sku'][$x]['sku']."</td><td>".$registros[0]['return']['sku'][$x]['tipoProducto']."</td><td>".$registros[0]['return']['sku'][$x]['vigencia']."</td></tr>\n"; 
  					}	
				echo '</table>';
			echo '</div>';

  			/*foreach ($registros as $info) {//Imprimo el contenido del arreglo por medio de iteracion foreach
  				print_r($info);
  			}*/
  			echo '</pre>';
 		}
	}

	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
?>