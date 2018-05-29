<?php
require_once('nusoap-master/src/nusoap.php'); 

	$username = "prueba"; 
	$password = "6I64p9x5u9pdS9W";

	$client = new nusoap_client('https://testservice.bluewebsoft.com/wsServicios/Servicio?wsdl', true);

	$err = $client->getError(); 
	if ($err) { 
	    echo '<h2>Error</h2><pre>' . $err . '</pre>'; 
	} 

	//Ingresamos usuario y contraseña paara el servicio weB
	$client->setCredentials($username,$password); 

	//Define parametros a enviar 
	date_default_timezone_set('America/Mexico_City');
	$id_cadena = "00001";
	$id_tienda = "00010";
	$id_terminal = "1234567890";
	$folio = "1213141516";
	$fechaLocal = date('Ymd H:i:s');
	$referencia = "3411461234";
	$monto = "200";
	$sku = "TELCTAE200MXN";
	//Parametros a enviar 
	$parametros = array('id_cadena'=>$id_cadena, 
						'id_tienda'=>$id_tienda,
						'id_terminal'=>$id_terminal,
						'folio'=>$folio,
						'fechaLocal'=>$fechaLocal,
						'referencia'=>$referencia,
						'monto'=>$monto,
						'sku'=>$sku);

	//Llamamos al método del servicio web y enviamos paramentros
	$result = $client->call("venta",$parametros);

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
  			echo '<h2>Result Venta</h2><pre>';
  			$registros = array($result);//El resultado de la petición la almaceno en un arreglo

  			echo "Codigo: ".$registros[0]['return']['respuesta']['codigoRespuesta']." -> ".$registros[0]['return']['respuesta']['descripcionRespuesta'];
  			echo "<br>";
  			echo "<br>";

  			echo '<div class="contTabla">';
				echo '<table border="1" class="tabla">';
					echo "<tr>";
						echo "<th>Autorizacion</th>";
						echo "<th>Comision</th>";
						echo "<th>Fecha local</th>";
						echo "<th>Folio</th>";
						echo "<th>Hora local</th>";
						echo "<th>Importe</th>";
						echo "<th>Informacion adicional</th>";
						echo "<th>Referencia</th>";
						echo "<th>Sku</th>";
						echo "<th>Vigencia</th>";
					echo "</tr>";
					echo "Cantidad de registros devueltos: ".$cantreg =  count($registros[0]['return']['transactionInfo']);
					echo "<br>";
					echo "<br>";
					echo "<tr><td>".$registros[0]['return']['transactionInfo']['autorizacion']."</td><td>".$registros[0]['return']['transactionInfo']['comision']."</td><td>".$registros[0]['return']['transactionInfo']['fechaLocal']."</td><td>".$registros[0]['return']['transactionInfo']['folio']."</td><td>".$registros[0]['return']['transactionInfo']['horaLocal']."</td><td>".$registros[0]['return']['transactionInfo']['importe']."</td><td>".$registros[0]['return']['transactionInfo']['informacionAdicional']."</td><td>".$registros[0]['return']['transactionInfo']['referencia']."</td><td>".$registros[0]['return']['transactionInfo']['sku']."</td><td>".$registros[0]['return']['transactionInfo']['vigencia']."</td></tr>\n"; 
  					/*for($x=0; $x<$cantreg; $x++){
  						echo "<tr><td>".$x."</td><td>".$registros[0]['return']['transactionInfo']['autorizacion']."</td><td>".$registros[0]['return']['transactionInfo']['comision']."</td><td>".$registros[0]['return']['transactionInfo']['fechaLocal']."</td><td>".$registros[0]['return']['transactionInfo']['folio']."</td><td>".$registros[0]['return']['transactionInfo']['horaLocal']."</td><td>".$registros[0]['return']['transactionInfo']['importe']."</td><td>".$registros[0]['return']['transactionInfo']['informacionAdicional']."</td><td>".$registros[0]['return']['transactionInfo']['referencia']."</td><td>".$registros[0]['return']['transactionInfo']['sku']."</td><td>".$registros[0]['return']['transactionInfo']['vigencia']."</td></tr>\n"; 
  					}*/	
				echo '</table>';
			echo '</div>';

  			foreach ($registros as $info) {//Imprimo el contenido del arreglo por medio de iteracion foreach
  				print_r($info);
  			}
  			echo '</pre>';
 		}
	}

	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
?>