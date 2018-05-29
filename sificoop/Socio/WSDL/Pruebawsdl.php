<?php
$datos = array(
              array(array(1, 1, 1),
                    array(2, 2, 2),
                    array(3, 3, 3) 
                    ),
              array(array(4, 4, 4),
                    array(5, 5, 5),
                    array(6, 6, 6) 
                    ),
              array(array(7, 7, 7),
                    array(8, 8, 8),
                    array(9, 9, 9) 
                    )
              );
echo $datos[0][2][1];
echo "<br>";
echo "<br>";
echo var_dump($datos);
echo "<br>";
echo "<br>";

$info = array($datos);

foreach($info as $datos1)
  {
    echo "Primer foreach ";
    echo "<br>";
  foreach($datos1 as $datos2)
    {
      echo "Segundo foreach ";
      echo "<br>";
    foreach($datos2 as $datos3)
      {
        echo "Tercer foreach ".count($datos3);
        echo "<br>";
        foreach ($datos3 as $dato) {
          echo "$dato ";
        }
        echo "<br>";
      }
    echo "<br>";
    }
  echo "<br>";
  }
echo '</pre>';

echo $info[0][0][2][1];
//-----------------------------------------------------------------------------------------------------//
//$client  =  new  nusoap_client ('https://testservice.bluewebsoft.com/wsServicios/Servicio','wsdl');
/*require_once('nusoap-master/src/nusoap.php'); 

$proxyhost = "http://ws.tae.com/";
$proxyport = "http://ws.tae.com/";
$proxyusername = "prueba"; 
$proxypassword = "6I64p9x5u9pdS9W"; 

$client = new nusoap_client('https://testservice.bluewebsoft.com/wsServicios/Servicio?wsdl', true, 
							$proxyhost, $proxyport, $proxyusername, $proxypassword);

$err = $client->getError(); 
if ($err) { 
    echo '<h2>Error</h2><pre>' . $err . '</pre>'; 
}

$result = $client->call("catalogoServicios");

if ($client->fault) {
 echo '<h2>Fault</h2><pre>';
 print_r($result);
 echo '</pre>';
} else {
 // Check for errors
 $err = $client->getError();
 if ($err) {
  // Display the error
  echo '<h2>Error</h2><pre>' . $err . '</pre>';
 } else {
  // Display the result
  echo '<h2>Result</h2><pre>';
  print($result);
  echo '</pre>';
 }
}

echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';*/

//---------------------------------------------------------------------------------------------------//
/*$venta = $client->call("venta");
print_r($venta); 

$consuventa = $client->call("consultaVenta"); 
print_r($consuventa); 

$consucredito = $client->call("consultaCredito");
print_r($consucredito);

$respuesta = $client->call("catalogoServicios");
print_r($respuesta); */

//----------------------------------------------------------------------------------------------------//
/*$result = $client->call("catalogoServicios");
//$xml = $result->catalogoServiciosResponse;

  // procesar xml
  $xml = simplexml_load_string($result);
  foreach($xml -> Table as $table) 
  {
    $output .= "<p>$table->codigoRespuesta</p>";
    $output .= "<p>$table->DescripcionRespuesta</p>";
  }
  print_r($output);*/

//--------------------------------------------------------------------------------------------------------//
/*$respuesta = $client->call("catalogoServicios");

$result = obj2array($respuesta);

function obj2array($obj) {
  $out = array();
  foreach ($obj as $key => $val) {
    switch(true) {
        case is_object($val):
         $out[$key] = obj2array($val);
         break;
      case is_array($val):
         $out[$key] = obj2array($val);
         break;
      default:
        $out[$key] = $val;
    }
  }
  return $out;
}
print_r($result);*/

/*$result = array($respuesta);
echo $n=count($result);*/
//------------------------------------------------------------------------------------------------------------//
//FUNCIONO
/*$client  =  new  nusoap_client ( 'https://testservice.bluewebsoft.com/wsServicios/Servicio','wsdl'); 
$client -> soap_defencoding  =  'UTF-8'; 
$client -> decode_utf8  =  FALSE ;

// Calls 
$result  =  $client -> call ("catalogoServicios"," ");
echo $n=count($result);
echo "<br>"; 
print_r($result);*/

//----------------------------------------------------------------------------------------------------------------//
/*for($i=0; $i<$n; $i++){
    echo $item=$result[$i];
}*/

//print_r($respuesta);

/*$url = "https://testservice.bluewebsoft.com/wsServicios/Servicio?wsdl";
try {
 $client = new SoapClient($url, [ "trace" => 1 ] );
 $result = $client->ResolveIP( [ "ipAddress" => $argv[1], "licenseKey" => "0" ] );
 print_r($result);
} catch ( SoapFault $e ) {
 echo $e->getMessage();
}
echo PHP_EOL;*/

/*$servicio = "https://testservice.bluewebsoft.com/wsServicios/Servicio?wsdl"; 
$parametros = array(); 

//$parametros['idioma'] = "es"; 
$parametros['usuario'] = "prueba"; 
$parametros['password'] = "6I64p9x5u9pdS9W"; 

$client = new SoapClient($servicio, $parametros); */
?>