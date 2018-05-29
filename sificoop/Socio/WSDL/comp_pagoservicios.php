<?php
session_start();
require('../../fpdf/fpdf.php');
require("../../conexiones/conexion.php");
	
	$idsocio = $_SESSION['sesionP'];
	$respuestaVent = $_SESSION['respuestaVen'];//Almaceno en variable el arreglo que tiene la variable de sesion sobre respuesta de venta

	$folio = $respuestaVent[0]['return']['transactionInfo']['folio']; 
	$fecha = $respuestaVent[0]['return']['transactionInfo']['fechaLocal'];
	$referencia = $respuestaVent[0]['return']['transactionInfo']['referencia'];
	$monto = $respuestaVent[0]['return']['transactionInfo']['importe'];
	$sku = $respuestaVent[0]['return']['transactionInfo']['sku'];
	$autorizacion = $respuestaVent[0]['return']['transactionInfo']['autorizacion'];

	$vigencia = $respuestaVent[0]['return']['transactionInfo']['vigencia'];
	$info = $respuestaVent[0]['return']['transactionInfo']['informacionAdicional'];

	$Nuecantretiro = $_GET['nuecantret'];//Nueva cantidad de la cuenta de retiro
	$nomretiro = $_GET['nomret'];//Nombre de la cuenta de retiro
	$numeroretiro = $_GET['retiro'];//Numero de la cuenta de retiro
	$cantidadTotal = $_GET['cantidadT'];//Cantidad total con la comision
	$descripServicio = $_GET['descrip'];//Descripcion de servicio
	$operador = $_GET['operador'];//Nombre del operador del servicio
	$fechahora = $_GET['fhpbd'];

	/* VARIABLES PARA PRUEBAS
	$folio = $_GET['folio'];
	$fecha = 20180215;
	$referencia = 3411172143;
	$monto = 8.00;
	$sku = "SRVIZZIMXN";
	$autorizacion = 342741203;

	$vigencia = "60 DIAS";
	$info = "EN CASO DE PRESENTAR ALGUN PROBLEMA CON SU RECARGA FAVOR DE COMUICARSE  SIN COSTO: *264 O AL 01800-710-5687";
	//AQUI TERMINAN VARIABLES PARA PRUEBAS */

	date_default_timezone_set('America/Mexico_City');
	//$fechahora = date('YmdHis');
	$fechamov = date("Y/m/d");

	$validar = false; 

	if($numeroretiro == 1){
		/*$sql = "CALL CARGARNUEVACANTIDADAHORRO('$Nuecantretiro', '$idsocio')";
		$res = mysqli_query($link,$sql);

		mysqli_next_result($link);

		$sql2 = "CALL REGISTRARPAGOSPROVEEDOR('$folio','$fecha','$referencia','$monto','$sku','$autorizacion','$descripServicio','$operador','$fechahora','$fechamov','$cantidadTotal','$nomretiro','$idsocio')";
		$res2 = mysqli_query($link,$sql2);

		mysqli_next_result($link);
	
		if($res && $res2){
			$validar = true; 
		} 
		else{
			echo mysqli_error($link);
		}*/
		

		$sql = "CALL CARGARNUEVACANTIDADAHORRO('$Nuecantretiro', '$idsocio'); CALL REGISTRARPAGOSPROVEEDOR('$folio','$fecha','$referencia','$monto','$sku','$autorizacion','$descripServicio','$operador','$fechahora','$fechamov','$cantidadTotal','$nomretiro','$idsocio');";

		if(mysqli_multi_query($link, $sql)){
			do{
				if(!mysqli_more_results($link)){
					$res = true;
				}
			}while(mysqli_more_results($link) && mysqli_next_result($link));
		}

		if($res == true){
			$validar = true;
		}
		else{
			echo mysqli_error($link);
		}
	}

	elseif($numeroretiro == 2) { 
		/*$sql = "CALL CARGARNUEVACANTIDADINVERSION('$Nuecantretiro', '$idsocio')";
		$res = mysqli_query($link,$sql);

		mysqli_next_result($link);

		$sql2 = "CALL REGISTRARPAGOSPROVEEDOR('$folio','$fecha','$referencia','$monto','$sku','$autorizacion','$descripServicio','$operador','$fechahora','$fechamov','$cantidadTotal','$nomretiro','$idsocio')";
		$res2 = mysqli_query($link,$sql2);

		mysqli_next_result($link);

			if($res && $res2){
				$validar = true;
			} 
			else{
				echo mysqli_error($link);
			}*/

		$sql = "CALL CARGARNUEVACANTIDADINVERSION('$Nuecantretiro', '$idsocio'); CALL REGISTRARPAGOSPROVEEDOR('$folio','$fecha','$referencia','$monto','$sku','$autorizacion','$descripServicio','$operador','$fechahora','$fechamov','$cantidadTotal','$nomretiro','$idsocio');";

		if(mysqli_multi_query($link, $sql)){
			do{
				if(!mysqli_more_results($link)){
					$res = true;
				}
			}while(mysqli_more_results($link) && mysqli_next_result($link));
		}

		if($res == true){
			$validar = true;
		}
		else{
			echo mysqli_error($link);
		}

	}

	elseif($numeroretiro == 3){ 
		/*$sql = "CALL CARGARNUEVACANTIDADSALDO('$Nuecantretiro', '$idsocio')";
		$res = mysqli_query($link,$sql);

		mysqli_next_result($link);

		$sql2 = "CALL REGISTRARPAGOSPROVEEDOR('$folio','$fecha','$referencia','$monto','$sku','$autorizacion','$descripServicio','$operador','$fechahora','$fechamov','$cantidadTotal','$nomretiro','$idsocio')";
		$res2 = mysqli_query($link,$sql2);

		mysqli_next_result($link);

			if($res && $res2){
				$validar = true; 
			} 
			else{
				echo mysqli_error($link);
			}*/
		$sql = "CALL CARGARNUEVACANTIDADSALDO('$Nuecantretiro', '$idsocio'); CALL REGISTRARPAGOSPROVEEDOR('$folio','$fecha','$referencia','$monto','$sku','$autorizacion','$descripServicio','$operador','$fechahora','$fechamov','$cantidadTotal','$nomretiro','$idsocio');";

		if(mysqli_multi_query($link, $sql)){
			do{
				if(!mysqli_more_results($link)){
					$res = true;
				}
			}while(mysqli_more_results($link) && mysqli_next_result($link));
		}

		if($res == true){
			$validar = true;
		}
		else{
			echo mysqli_error($link);
		}
	}


if($validar == true){
	class PDF extends FPDF{

		function Header(){
			require("../../conexiones/conexion.php");
			$idsocio = $_SESSION['sesionP'];

			$datos = mysqli_query($link,"CALL CONSULTANOMBRESOCIOCOMP($idsocio)");
			$detalle = mysqli_fetch_array($datos);

			$descripServicio = $_GET['descrip'];//Descripcion de servicio
			$operador = $_GET['operador'];//Nombre del operador del servicio

			//Logo 
			date_default_timezone_set('America/Mexico_City');
			$this->SetFillColor(31,97,141);
			$this->Cell(0,6,'',0,0,'C','true');

			$this->Image('../../images/SIFICOOP.png',10,25,33,'JPG');
			$this->SetFont('Arial','B',15);
			$this->Ln(18);
			$this->Cell(80);
			$this->Cell(30,10,'SIFICOOP');
			$this->Cell(38);
			$this->SetFont('Arial','',12);
			$this->Cell(0,10,date('Y-m-d H:i:s'),0);
			$this->Ln(20);
			$this->Cell(59);
			$this->SetFont('Arial','B',13);
			$this->Cell(100,10,utf8_decode("Información de pago de servicio."),0);
			$this->Ln(30);
			$this->SetFont('Arial','',13);
			$this->Cell(100,10,'FOLIO: '.$GLOBALS["folio"].' ',0);
			$this->Ln(10);
			$this->Cell(100,10,utf8_decode("Socio/Nombre: ".$detalle[0]."/ ".$detalle[1]." ".$detalle[2]." ".$detalle[3].". "),0);
			$this->Ln(10);
			$this->Cell(100,10,utf8_decode("Descripcion/Operador: ".$descripServicio." / ".$operador),0);
			$this->Ln(18);
			$this->Cell(185,0,'',1);
			$this->Ln(8);
		}

		function Footer(){
			$this->Ln(60);
			$this->SetFont('Arial','',10);
			$this->Cell(100,10,utf8_decode("Domicilio: Avenida Tecnológico #1234"),0);
			$this->Cell(20);
			$this->Cell(100,10,utf8_decode("Correo electrónico: contacto@sificoop.com"),0);
			$this->Ln(8);
			$this->Cell(100,10,utf8_decode("Número telefónico: (341) 41 1 2345 / (333) 33 4 1234"),0);
			$this->Cell(20);
			$this->Cell(100,10,'Sitio web: https://www.sificoop.com',0);
			$this->Ln();

			$this->SetFillColor(31,97,141);
			$this->Cell(0,6,'',0,0,'C','true');
		}

		function BasicTable($header){

			//Cabecera
			$this->Cell(4);
		    $this->SetFont('Arial','B',13);
		    foreach($header as $col)
		        $this->Cell(90,7,$col,1,0,'C');
		    $this->Ln(10);

		    $nomretiro = $_GET['nomret'];//Nombre de la cuenta de retiro
			$cantidadTotal = $_GET['cantidadT'];//Cantidad total con la comision
		    $this->SetFont('Arial','',13);
		    $this->Cell(4);
		    $this->Cell(90,7,utf8_decode("Autorización"));
		    //$this->Cell(90,7,"514232");
		    $this->Cell(90,7,$GLOBALS["autorizacion"]);
		    $this->Ln(10);
		    $this->Cell(4);
		    $this->Cell(90,7,utf8_decode("Referencia(Cuenta/Número de celular)"));
		    //$this->Cell(90,7,"341321645");
		    $this->Cell(90,7,$GLOBALS["referencia"]);
		    $this->Ln(10);
		    $this->Cell(4);
		    $this->Cell(90,7,"Monto de servicio");
		    //$this->Cell(90,7,"100.0");
		    $this->Cell(90,7,"$".$GLOBALS["monto"]);
		    $this->Ln(10);
		    $this->Cell(4);
		    $this->Cell(90,7,"Fecha");
		    //$this->Cell(90,7,"20180208");
		    $this->Cell(90,7,$GLOBALS["fecha"]);
		    $this->Ln(10);
		    $this->Cell(4);
		    $this->Cell(90,7,utf8_decode("Monto total(Incluyendo comisión)"));
		    $this->Cell(90,7,"$".$cantidadTotal);
		    $this->Ln(10);
		    $this->Cell(4);
		    $this->Cell(90,7,"Cuenta de retiro");
		    $this->Cell(90,7,$nomretiro);
		    $this->Ln(10);
		    $this->Cell(4);
		    $this->Cell(90,7,"Vigencia");
		    //$this->Cell(90,7,"60 DIAS");
		    $this->Cell(90,7,$GLOBALS["vigencia"]);
		    $this->SetFont('Arial','',8);
		    $this->Ln(10);
		    $this->Cell(4);
		    $this->Cell(90,7,$GLOBALS["info"]);
		    //$this->Cell(90,7,"AQUÍ VA UN TEXTO MUY LARGO");
		    $this->Cell(90,7,"");
		}
	}

	$pdf = new PDF();
	//Titulos de las columnas
	$header = array('Dato', utf8_decode("Descripción"));
	$pdf->SetFont('Arial','',13);
	$pdf->AddPage();
	$pdf->BasicTable($header);
	$pdf->OutPut('Comprobante_pagoservicios.pdf','I'); 
} 
else{
	echo '<script>alert("No se pudo realizar el pago del servicio.")</script>';
	mysqli_close($link);
}
?>