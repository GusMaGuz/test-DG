<?php
session_start();
$registroslis = $_SESSION['listado'];//Registros devueltos por proveedor de servicios
$idsocio = $_SESSION['sesionP'];//Id de socio

require("../../conexiones/conexion.php");
include_once("../../conexiones/comision/cobromovimiento.php");

$sql = mysqli_query($link,"CALL CONSULTARCUENTASSOCIO('$idsocio')");
$res=mysqli_fetch_array($sql);

$ahorro = $res['ahorro']; 
$inversion = $res['inverflex']; 
$saldo = $res['saldo_p']; 

mysqli_next_result($link);


$generafolio = mt_rand();
$consulfolio = mysqli_query($link,"CALL CONSULTARFOLIOEXIST('$generafolio')") or die(mysqli_error());
$resp=mysqli_fetch_array($consulfolio);

	
	$nuefolio;
	if($resp){
		$nuefolio = $idsocio.mt_rand(00000,99999); 
	}
	else{
		$nuefolio = $generafolio;
	}

mysqli_next_result($link);

	$servicio = $_POST['servicio'];//Numero de servicio a pagar
	$retiro = $_POST['retiro'];//Cuenta de retiro
	$descripcionServ = $_POST['descripcion'];//Descripcion del pago
	$operador = $_POST['operador'];//Operador del servicio
	$monto = $_POST['monto'];//Monto ingresado en text box
	$referencia = $_POST['referencia']; 
	$monto = $_POST['monto']; 
	$sku = $_POST['sku'];

	date_default_timezone_set('America/Mexico_City');
	$date = date_create();
	$fecham =(string) date_format($date,'Ymd H:i:s');
	$fechahorapbd = (string)date('YmdHis');


	function realizarventa(){
		require("conexionwsdl.php");

		$id_cadena = "00007";
		$id_tienda = "00001";
		$id_terminal = "0000000001";
		$folio = trim($GLOBALS['nuefolio']);//int
		$fechaLocal = trim($GLOBALS['fecham']);
		$referencia = trim($GLOBALS['referencia']); //int 
		$monto = trim($GLOBALS['monto']);//int
		$sku = trim($GLOBALS['sku']);//string

		$codigo; 

		$proxy = $client->getProxy();
		//Define parametros a enviar 
		$parametros = array('id_cadena'=>$id_cadena, 
							'id_tienda'=>$id_tienda,
							'id_terminal'=>$id_terminal,
							'folio'=>$folio,
							'fechaLocal'=>$fechaLocal,
							'referencia'=>$referencia,
							'monto'=>$monto,
							'sku'=>$sku);
		$result = $proxy->venta($parametros);
		
		if($soapErr = $proxy->getError()){
			if(empty($result)){
				$codigo = 69;
				unset($client);
			}
		}
		else{
			$respuesta = array($result);
			$_SESSION['respuestaVen']=$respuesta;

		  	$codigo = $respuesta[0]['return']['respuesta']['codigoRespuesta'];
		}
		return $codigo;
	}

	function consultaventa(){
		$id_cadena = "00007";
		$id_tienda = "00001";
		$id_terminal = "0000000001";
		$folio = trim($GLOBALS['nuefolio']);
		$fechaLocal = trim($GLOBALS['fecham']);
		$referencia = trim($GLOBALS['referencia']); 
		$monto = trim($GLOBALS['monto']);
		$sku = trim($GLOBALS['sku']);

		$codigoc; 

		//Define parametros a enviar 
		$parametros = array('id_cadena'=>$id_cadena, 
							'id_tienda'=>$id_tienda,
							'id_terminal'=>$id_terminal,
							'folio'=>$folio,
							'fechaLocal'=>$fechaLocal,
							'referencia'=>$referencia,
							'monto'=>$monto,
							'sku'=>$sku);


		$resp;
	    $initim = time();
	    $start;
	    do{
	      $valtim = time() - $initim; 
	      if($valtim <= 60){
	        $start = time();

	        require("conexionwsdl.php");
	        $proxy = $client->getProxy();
			$resultc = $proxy->consultaVenta($parametros);
			$respuestac = array($resultc);

		  	$codigoc = $respuestac[0]['return']['respuesta']['codigoRespuesta'];
		  	//unset($client);
		  	if($codigoc == 0){
		  		$_SESSION['respuestaVen']=$respuestac;
		  		break;
		  	}
	      }
	      else{
	        break;
	      }

	      $timing = time() - $start;
	      sleep(2);

	    }while($timing >= 0 && $timing < 8 && $codigoc == 66 || $codigoc == 67);

	    return $codigoc;
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
	}


	$respuesta; //VARIABLE GLOBAL PARA ALMACENAR LA RESPUESTA DEL METODO REALIZAR VENTA
	//Calculo de total de monto + comision
	$cantidadcomision = $monto + $cobro;

	$precio = $registroslis[0]['return']['sku'][$servicio]['precio'];//Traigo el precio del servicio elegido

	if($retiro == 1){
		if($monto == $precio){
			if($cantidadcomision <= $ahorro){
				$respuesta = realizarventa();
				if($respuesta == 0){
					$cuenta = "Ahorro";
					$nuevoahorro = $ahorro - $cantidadcomision;
					header("location:comp_pagoservicios.php?nuecantret=$nuevoahorro&nomret=$cuenta&retiro=1&cantidadT=$cantidadcomision&descrip=$descripcionServ&operador=$operador&fhpbd=$fechahorapbd");
				}
				else if($respuesta == 66 || $respuesta == 67 || $respuesta == 68 || $respuesta == 69 || $respuesta == 6){
					$respuestaconsulta = consultaventa();
					if($respuestaconsulta == 0){
						$cuenta = "Ahorro";
						$nuevoahorro = $ahorro - $cantidadcomision;
						header("location:comp_pagoservicios.php?nuecantret=$nuevoahorro&nomret=$cuenta&retiro=1&cantidadT=$cantidadcomision&descrip=$descripcionServ&operador=$operador&fhpbd=$fechahorapbd");
					}
					else{
						verificarerror($respuestaconsulta);
					}
				}
				else{
					verificarerror($respuesta);
				}
			}
			else{
				echo utf8_decode('<script>alert("La cantidad ingresada mas la comisión debe ser menor a la cantidad de cuenta de retiro.")</script>');
				echo "<script>location.href='../pagoServicios.php'</script>";
			}
		}
		else{
			echo utf8_decode('<script>alert("La cantidad ingresada debe ser igual al precio del servicio elegido.")</script>');
			echo "<script>location.href='../pagoServicios.php'</script>";
		}
	}
	else if($retiro == 2){
		if($monto == $precio){
			if($cantidadcomision <= $inversion){
				$respuesta = realizarventa();
				if($respuesta == 0){
					$cuenta = "Inversion"; 
					$nuevainversion = $inversion - $cantidadcomision;
					header("location:comp_pagoservicios.php?nuecantret=$nuevainversion&nomret=$cuenta&retiro=2&cantidadT=$cantidadcomision&descrip=$descripcionServ&operador=$operador&fhpbd=$fechahorapbd");
				}
				else if($respuesta == 66 || $respuesta == 67 || $respuesta == 68 || $respuesta == 69 || $respuesta == 6){
					$respuestaconsulta = consultaventa();
					if($respuestaconsulta == 0){
						$cuenta = "Inversion"; 
						$nuevainversion = $inversion - $cantidadcomision;
						header("location:comp_pagoservicios.php?nuecantret=$nuevainversion&nomret=$cuenta&retiro=2&cantidadT=$cantidadcomision&descrip=$descripcionServ&operador=$operador&fhpbd=$fechahorapbd");
					}
					else{
						verificarerror($respuestaconsulta);
					}
				}
				else{
					verificarerror($respuesta);
				}
			}
			else{
				echo utf8_decode('<script>alert("La cantidad ingresada mas la comisión debe ser menor a la cantidad de cuenta de retiro.")</script>');
				echo "<script>location.href='../pagoServicios.php'</script>";
			}
		}
		else{
			echo utf8_decode('<script>alert("La cantidad ingresada debe ser igual al precio del servicio elegido.")</script>');
			echo "<script>location.href='../pagoServicios.php'</script>";
		}
	}
	else if($retiro == 3){
		if($monto == $precio){
			if($cantidadcomision <= $saldo){
				$respuesta = realizarventa();
				if($respuesta == 0){
					$cuenta = "Saldo prepago";
					$nuevosaldo = $saldo - $cantidadcomision;
					header("location:comp_pagoservicios.php?nuecantret=$nuevosaldo&nomret=$cuenta&retiro=3&cantidadT=$cantidadcomision&descrip=$descripcionServ&operador=$operador&fhpbd=$fechahorapbd");
				}
				else if($respuesta == 66 || $respuesta == 67 || $respuesta == 68 || $respuesta == 69 || $respuesta == 6){
					$respuestaconsulta = consultaventa();
					if($respuestaconsulta == 0){
						$cuenta = "Saldo prepago";
						$nuevosaldo = $saldo - $cantidadcomision;
						header("location:comp_pagoservicios.php?nuecantret=$nuevosaldo&nomret=$cuenta&retiro=3&cantidadT=$cantidadcomision&descrip=$descripcionServ&operador=$operador&fhpbd=$fechahorapbd");
					}
					else{
						verificarerror($respuestaconsulta);
					}
				}
				else{
					verificarerror($respuesta);
				}
			}
			else{
				echo utf8_decode('<script>alert("La cantidad ingresada mas la comisión debe ser menor a la cantidad de cuenta de retiro.")</script>');
				echo "<script>location.href='../pagoServicios.php'</script>";
			}
		}
		else{
			echo utf8_decode('<script>alert("La cantidad ingresada debe ser igual al precio del servicio elegido.")</script>');
			echo "<script>location.href='../pagoServicios.php'</script>";
		}
	}
?>