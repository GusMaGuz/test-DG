<?php
/*session_start();
$registroslis = $_SESSION['listado'];//Registros devueltos por proveedor de servicios
//$idsocio = $_SESSION['sesionP'];//Id de socio

	$id_cadena = "00001";
	$id_tienda = "00010";
	$id_terminal = "0000000001";
	//$folio = $_GET['folio'];
	//$fechaLocal = $_GET['fecha'];
	//$referencia = $_GET['refe']; 
	//$monto = $_GET['monto']; 
	//$sku = $_GET['sku'];
	$folio = trim($_REQUEST['folio']);
	$fechaLocal = trim($_REQUEST['fecha']);
	$referencia = trim($_REQUEST['refe']);
	$monto = trim($_REQUEST['monto']); 
	$sku = trim($_REQUEST['sku']);

	//echo utf8_decode('<script>alert("'.$folio.' '.$fechaLocal.' '.$referencia.' '.$monto.' '.$sku.'")</script>');

	//$Nuecantretiro = $_GET['nuecantret'];//Nueva cantidad de la cuenta de retiro
	//$nomretiro = $_GET['nomret'];//Nombre de la cuenta de retiro
	//$numeroretiro = $_GET['retiro'];//Numero de la cuenta de retiro
	//$cantidadTotal = $_GET['cantidadT'];//Cantidad total con la comision
	//$descripServicio = $_GET['descrip'];//Descripcion de servicio
	//$operador = $_GET['operador'];//Nombre del operador del servicio

	$Nuecantretiro = $_REQUEST['nuecantret'];//Nueva cantidad de la cuenta de retiro
	$nomretiro = $_REQUEST['nomret'];//Nombre de la cuenta de retiro
	$numeroretiro = $_REQUEST['retiro'];//Numero de la cuenta de retiro
	$cantidadTotal = $_REQUEST['cantidadT'];//Cantidad total con la comision
	$descripServicio = $_REQUEST['descrip'];//Descripcion de servicio
	$operador = $_REQUEST['operador'];//Nombre del operador del servicio

	$codigo; 

	require("conexionwsdl.php");

	$proxy = $client->getProxy();

	$parametros = array('id_cadena'=>$id_cadena, 
						'id_tienda'=>$id_tienda,
						'id_terminal'=>$id_terminal,
						'folio'=>$folio,
						'fechaLocal'=>$fechaLocal,
						'referencia'=>$referencia,
						'monto'=>$monto,
						'sku'=>$sku);

	$resultcon = $proxy->consultaVenta($parametros);

	if($soapErr = $proxy->getError()){ 
		//echo 'Error: '.$soapErr;
	}
	else{
		$respuestacon = array($resultcon); 
		$_SESSION['respuestaVen']=$respuestacon;

	  	$codigo = $respuestacon[0]['return']['respuesta']['codigoRespuesta'];
	  	
	  	if($codigo == 0){
	  		header("location:comp_pagoservicios.php?nuecantret=$Nuecantretiro&nomret=$nomretiro&retiro=$numeroretiro&cantidadT=$cantidadTotal&descrip=$descripServicio&operador=$operador");
	  	}
	  	else{
	  		verificarerror($codigo);
	  	}
	}


function verificarerror($res){
	if($res == 1){
		echo utf8_decode('<script>alert("Número de teléfono ingresado no es valido.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 2){
		echo utf8_decode('<script>alert("Destino no disponible. Error del proveedor.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 3){
		echo utf8_decode('<script>alert("Monto ingresado o producto no valido.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 4){
		echo utf8_decode('<script>alert("Número de teléfono ingresado no es válido para abono de tiempo aire.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 5 || $res == 6 || $res == 7){
		echo utf8_decode('<script>alert("El servicio de pagos no esta disponible, se encuentra en mantenimiento. Codigo '.$res.'")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 8){
		echo utf8_decode('<script>alert("Pago de servicio cancelado. Fallo en tiempo de respuesta.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 9 || $res == 10){
		echo utf8_decode('<script>alert("Pago de servicio cancelado. Error del proveedor.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 11 || $res == 12){
		echo utf8_decode('<script>alert("Pago de servicio cancelado. Petición rechazada por proveedor.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 13){
		echo utf8_decode('<script>alert("Pago de servicio cancelado. Error del proveedor.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 14){
		echo utf8_decode('<script>alert("Pago de servicio cancelado. Activación no permitida para la region.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 26){
		echo utf8_decode('<script>alert("Pago de servicio cancelado. No se permiten recargas consecutivas.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 28){
		echo utf8_decode('<script>alert("Pago de servicio cancelado. Reintento no valido, espere 5 minutos.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 34){
		echo utf8_decode('<script>alert("Pago de servicio cancelado. Hay una recarga en progreso para el mismo número o referencia .")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 35){
		echo utf8_decode('<script>alert("Pago de servicio cancelado. Monto máximo de venta se ha alcanzado en el día para este número o referencia.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 66){
		echo utf8_decode('<script>alert("Verificando pago. Error en base de datos de proveedor.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 30){
		echo utf8_decode('<script>alert("Pago de servicio cancelado. Alguno de los parametros no están en el formato correcto.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 99){
		echo utf8_decode('<script>alert("Pago de servicio cancelado. No se puede procesar la transacción ya que hay otra transacción de características	similares en proceso.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 65){
		echo utf8_decode('<script>alert("Pago de servicio cancelado. El tipo de pago solicitado no existe.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 67){
		echo utf8_decode('<script>alert("Verificando pago. La transacción ya se envió al proveedor, y se está esperando su respuesta.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 68){
		echo utf8_decode('<script>alert("Pago de servicio cancelado. Error de fault al conectar con proveedor de servicios.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
	else if($res == 69){
		echo utf8_decode('<script>alert("Pago de servicio cancelado. Error al conectar con proveedor de servicios.")</script>');
		echo "<script>location.href='../pagoServicios.php'</script>";
	}
}*/

	//echo utf8_decode('<script>alert("Archivo consulta venta")</script>');
	/*$id_cadena = "00001";
	$id_tienda = "00010";
	$id_terminal = "0000000001";
	$folio = trim($_GET["folio"]);
	$fechaLocal = trim($_GET["fecha"]);
	$referencia = trim($_GET["refe"]); 
	$monto = trim($_GET["monto"]); 
	$sku = trim($_GET["sku"]);*/

	/*$id_cadena = "00001";
	$id_tienda = "00010";
	$id_terminal = "0000000001";
	$folio = 1526374859;
	$fechaLocal = "20180324 12:48:16";
	$referencia = trim($_GET["refe"]); 
	$monto = trim($_GET["monto"]); 
	$sku = trim($_GET["sku"]);;


	//$codigo; 
	
	//ini_set('default_socket_timeout', 10);//Tiempo en segundos asignado para respuesta
	require("conexionwsdl.php");
	//Define parametros a enviar 
	$parametros = array('id_cadena'=>$id_cadena, 
						'id_tienda'=>$id_tienda,
						'id_terminal'=>$id_terminal,
						'folio'=>$folio,
						'fechaLocal'=>$fechaLocal,
						'referencia'=>$referencia,
						'monto'=>$monto,
						'sku'=>$sku);

	//Llamamos al método del servicio web y enviamos paramentros
	$result = $client->call("consultaVenta",$parametros); 

	if ($client->fault) {
 		print_r($result);
 		//$codigo = 68; //Error Fault en peticion
	} 
	else {
 		// Check for errors
 		$err = $client->getError();
 		if ($err) {
  			// Display the error
  			echo '<h2>Error</h2><pre>' . $err . '</pre>';
  			//$codigo = 69; //Error al realizar peticion
 		}
 		else {
  			// Display the result
  			//unset($_SESSION['respuestaVen']);
  			//$respuestacon = array($result);//El resultado de la petición la almaceno en un arreglo
  			//$_SESSION['respuestaVen']=$respuestacon;

  			//$codigo = $respuesta[0]['return']['respuesta']['codigoRespuesta'];
  			echo "Consulta de ventas."; 
  			echo "<br>";

  			foreach ($result as $info) {//Imprimo el contenido del arreglo por medio de iteracion foreach
  				print_r($info);
  			}

  			echo "<br>";

  			echo '<h2>Request</h2>';
			echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
			echo '<h2>Response</h2>';
			echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
			echo htmlspecialchars($client->response, ENT_QUOTES) . '</b></p>';
			echo '<p><b>Debug: <br>';
			echo htmlspecialchars($client->debug_str, ENT_QUOTES) .'</b></p>';
 		}
	}*/

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//require_once 'simplexml_dump.php';
//require_once 'simplexml_tree.php';

//Data, connection, auth
/*$soapUrl = "https://testservice.bluewebsoft.com:443/wsServicios/Servicio?WSDL";
$soapUser = "prueba";  //  username
$soapPassword = "6I64p9x5u9pdS9W"; // password

$id_cadena = "00001";
$id_tienda = "00010";
$id_terminal = "0000000001";
$folio = "7812963540";
date_default_timezone_set('America/Mexico_City');
$date = date_create();
$fechaLocal =(string) date_format($date,'Ymd H:i:s');
//$fechaLocal = trim($_REQUEST['fecha']);
$referencia ="2227619550"; 
$monto ="200.0"; 
$sku = "TELCTAE200MXN";

// xml post structure
$xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ws="http://ws.tae.com/">
   <soapenv:Header/>
   <soapenv:Body>
      <ws:venta>
         <sku>' . $sku . '</sku>
         <fechaLocal>' . $fechaLocal . '</fechaLocal>
         <referencia>' . $referencia . '</referencia>
         <monto>' . $monto . '</monto>
         <id_cadena>' . $id_cadena . '</id_cadena>
         <id_tienda>' . $id_tienda . '</id_tienda>
         <id_terminal>' . $id_terminal . '</id_terminal>
         <folio>' . $folio . '</folio>
      </ws:venta>
   </soapenv:Body>
</soapenv:Envelope>';


//Hearders 
$headers = array(
    "Content-type: text/xml;charset=\"utf-8\"",
    "Accept: text/xml",
    "Cache-Control: no-cache",
    "Pragma: no-cache",
    "SOAPAction:\"\"",
    "Content-length: " . strlen($xml_post_string),
); //SOAPAction: your op URL

$url = $soapUrl;

// PHP cURL  for https connection with auth
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $soapUser . ":" . $soapPassword); // username and password - declared at the top of the doc
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_TIMEOUT, 40);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// converting
$response = curl_exec($ch);

if($response === TRUE){
	echo $response . "<br>";

	curl_close($ch);

	// simplifying structure
	$response1 = str_replace("<S:Body>", "", $response);
	$response2 = str_replace("</S:Body>", "", $response1);
	$response1 = str_replace("<return>", "", $response);
	$response2 = str_replace("</return>", "", $response1);

	// convertingc to XML
	$parser = simplexml_load_string($response2);
	$parser->registerXPathNamespace("S", "http://schemas.xmlsoap.org/soap/envelope/");
	$parser->registerXPathNamespace("ns2", "http://ws.tae.com/");

	echo "<br>";
	foreach ($parser->xpath('//respuesta') as $header) {
	    echo "codigoRespuesta: " . (string) $header->codigoRespuesta . "<br>";
	    echo "descripcionRespuesta: " . (string) $header->descripcionRespuesta . "<br>";
	}

	foreach ($parser->xpath('//transactionInfo') as $header) {
	    echo "autorizacion: " . (string) $header->autorizacion . "<br>";
	    echo "comision: " . (string) $header->comision . "<br>";
	    echo "fechaLocal: " . (string) $header->fechaLocal . "<br>";
	    echo "horaLocal: " . (string) $header->horaLocal . "<br>";
	    echo "folio: " . (string) $header->folio . "<br>";
	    echo "importe: " . (string) $header->importe . "<br>";
	    echo "referencia: " . (string) $header->referencia . "<br>";
	    echo "sku: " . (string) $header->sku . "<br>";
	    echo "informacionAdicional: " . (string) $header->informacionAdicional . "<br>";
	    echo "vigencia: " . (string) $header->vigencia . "<br>";
	}
	//curl_close($ch);
}
else{
	$xml_post_stringC = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ws="http://ws.tae.com/">
	   <soapenv:Header/>
	   <soapenv:Body>
	      <ws:consultaVenta>
	         <sku>' . $sku . '</sku>
	         <fechaLocal>' . $fechaLocal . '</fechaLocal>
	         <referencia>' . $referencia . '</referencia>
	         <monto>' . $monto . '</monto>
	         <id_cadena>' . $id_cadena . '</id_cadena>
	         <id_tienda>' . $id_tienda . '</id_tienda>
	         <id_terminal>' . $id_terminal . '</id_terminal>
	         <folio>' . $folio . '</folio>
	      </ws:consultaVenta>
	   </soapenv:Body>
	</soapenv:Envelope>';

	//Hearders 
	$headersC = array(
	    "Content-type: text/xml;charset=\"utf-8\"",
	    "Accept: text/xml",
	    "Cache-Control: no-cache",
	    "Pragma: no-cache",
	    "SOAPAction:\"\"",
	    "Content-length: " . strlen($xml_post_stringC),
	); //SOAPAction: your op URL

	$url = $soapUrl;

	// PHP cURL  for https connection with auth
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERPWD, $soapUser . ":" . $soapPassword); // username and password - declared at the top of the doc
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_stringC); // the SOAP request
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headersC);

	// converting
	$responseC = curl_exec($ch);

	if($responseC === TRUE){
		echo $responseC . "<br>";

		curl_close($ch);

		// simplifying structure
		$response1 = str_replace("<S:Body>", "", $responseC);
		$response2 = str_replace("</S:Body>", "", $response1);
		$response1 = str_replace("<return>", "", $responseC);
		$response2 = str_replace("</return>", "", $response1);

		// convertingc to XML
		$parser = simplexml_load_string($response2);
		$parser->registerXPathNamespace("S", "http://schemas.xmlsoap.org/soap/envelope/");
		$parser->registerXPathNamespace("ns2", "http://ws.tae.com/");

		echo "<br>";
		foreach ($parser->xpath('//respuesta') as $header) {
		    echo "codigoRespuesta: " . (string) $header->codigoRespuesta . "<br>";
		    echo "descripcionRespuesta: " . (string) $header->descripcionRespuesta . "<br>";
		}

		foreach ($parser->xpath('//transactionInfo') as $header) {
		    echo "autorizacion: " . (string) $header->autorizacion . "<br>";
		    echo "comision: " . (string) $header->comision . "<br>";
		    echo "fechaLocal: " . (string) $header->fechaLocal . "<br>";
		    echo "horaLocal: " . (string) $header->horaLocal . "<br>";
		    echo "folio: " . (string) $header->folio . "<br>";
		    echo "importe: " . (string) $header->importe . "<br>";
		    echo "referencia: " . (string) $header->referencia . "<br>";
		    echo "sku: " . (string) $header->sku . "<br>";
		    echo "informacionAdicional: " . (string) $header->informacionAdicional . "<br>";
		    echo "vigencia: " . (string) $header->vigencia . "<br>";
		}
	}
	else{
		die('cURL error: '.curl_error($ch)."<br />\n");
	}
}*/
?>