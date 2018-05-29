<?php
session_start();
//header("Content-Type: text/html; charset=iso-8859-1 ");

require('../fpdf/fpdf.php');
require("conexion.php");
require("generador.php");

	$abonocapital = $_GET['abonoC'];
	$nombrecredito = $_GET['nomcre']; 
	$cuentaret = $_GET['cuentaret'];
	$nuevosaldo = $_GET['saldoR']; 
	$total = $_GET['cantidadT']; 
	$depositar = $_GET['credito'];
	$nuevoCR = $_GET['nuevoCR'];
	$tipopago = $_GET['pago']; 
	date_default_timezone_set('America/Mexico_City');
	$fecha = date("Y/m/d");

	$idsocio = $_SESSION['sesionP'];
	$validar = false; 

	$id = "PA".$idgen."";

	if($tipopago == 1){
		$sqlsaldo = "UPDATE informacion SET  saldo = '$nuevosaldo' WHERE contrato='$depositar'";
			$res = mysqli_query($link,$sqlsaldo);

		$sqlahorro= "UPDATE informacion SET ahorro = '$nuevoCR' WHERE socio='$idsocio'"; 
			$resahorro = mysqli_query($link,$sqlahorro);

		$sqlpago = "INSERT INTO pagos(id_pago, monto_p, nom_credP, fecha_p, c_retiroP, saldo_actual, cant_TretiroP, contrato, id_socio) VALUES ('$id','$abonocapital', '$nombrecredito', '$fecha', '$cuentaret', '$nuevosaldo', '$total','$depositar','$idsocio')";
			$respago = mysqli_query($link,$sqlpago); 

			if($res && $resahorro && $respago){
				$validar = true; 
			} 
			else{
				echo '<script>alert("No se pudo realizar el pago.")</script>';
				mysqli_close($link);
				echo "<script>location.href='../Socio/pagos.php'</script>";
			}
	}
	elseif ($tipopago == 2) {
		$sqlsaldo1 = "UPDATE informacion SET  saldo = '$nuevosaldo' WHERE contrato='$depositar'";
			$res1 = mysqli_query($link,$sqlsaldo1);

		$sqlinversion= "UPDATE informacion SET inverflex = '$nuevoCR' WHERE socio='$idsocio'"; 
			$resinversion = mysqli_query($link,$sqlinversion);

		$sqlpago1 = "INSERT INTO pagos(id_pago, monto_p, nom_credP, fecha_p, c_retiroP, saldo_actual, cant_TretiroP, contrato, id_socio) VALUES ('$id','$abonocapital', '$nombrecredito', '$fecha', '$cuentaret', '$nuevosaldo', '$total','$depositar','$idsocio')";
			$respago1 = mysqli_query($link,$sqlpago1); 

			if($res1 && $resinversion && $respago1){
				$validar = true; 
			} 
			else{
				echo '<script>alert("No se pudo realizar el pago.")</script>';
				mysqli_close($link);
				echo "<script>location.href='../Socio/pagos.php'</script>";
			}
	}
	elseif ($tipopago == 3) {
		$sqlsaldo2 = "UPDATE informacion SET  saldo = '$nuevosaldo' WHERE contrato='$depositar'";
			$res2 = mysqli_query($link,$sqlsaldo2);

		$sqlsaldoprepago= "UPDATE socio SET saldo_p = '$nuevoCR' WHERE id_socio='$idsocio'"; 
			$ressaldoprepago = mysqli_query($link,$sqlsaldoprepago);

		$sqlpago2 = "INSERT INTO pagos(id_pago, monto_p, nom_credP, fecha_p, c_retiroP, saldo_actual, cant_TretiroP, contrato, id_socio) VALUES ('$id','$abonocapital', '$nombrecredito', '$fecha', '$cuentaret', '$nuevosaldo', '$total','$depositar','$idsocio')";
			$respago2 = mysqli_query($link,$sqlpago2); 

			if($res2  && $ressaldoprepago && $respago2){
				$validar = true; 
			} 
			else{
				echo '<script>alert("No se pudo realizar el pago.")</script>';
				mysqli_close($link);
				echo "<script>location.href='../Socio/pagos.php'</script>";
		}
	}

	if($validar == true){

		class PDF extends FPDF{

			function Header(){
				require("conexion.php");
				$idsocio = $_SESSION['sesionP'];

				$datos = mysqli_query($link,"SELECT id_socio, nombre, ap, am FROM socio WHERE id_socio='$idsocio'");
				$detalle = mysqli_fetch_array($datos);

				//Linea azul 
				date_default_timezone_set('America/Mexico_City');
				$this->SetFillColor(31,97,141);
				$this->Cell(0,6,'',0,0,'C','true');
				//Logo
				$this->Image('../images/SIFICOOP.png',10,25,33,'JPG');
				$this->SetFont('Arial','B',15);
				$this->Ln(18);
				$this->Cell(80);
				$this->Cell(30,10,'SIFICOOP');
				$this->Cell(38);
				$this->SetFont('Arial','',12);
				$this->Cell(0,10,date('d-m-Y H:i:s'),0);
				$this->Ln(20);
				$this->Cell(75);
				$this->SetFont('Arial','B',13);
				$this->Cell(100,10,utf8_decode("Pago de crédito"),0);
				$this->Ln(30);
				$this->SetFont('Arial','',13);
				$this->Cell(100,10,'FOLIO: '.$GLOBALS["id"].' ',0);
				$this->Ln(12);
				$this->Cell(100,10,utf8_decode("Socio/Nombre: ".$detalle[0]."/ ".$detalle[1]." ".$detalle[2]." ".$detalle[3].". "),0);
				$this->Ln(20);
				$this->Cell(185,0,'',1);
				$this->Ln(8);
			}

			function Footer(){
				$this->Ln(118);
				$this->SetFont('Arial','',10);
				$this->Cell(100,10,utf8_decode("Domicilio: Avenida Tecnológico #1234"),0);
				$this->Cell(20);
				$this->Cell(100,10,utf8_decode("Correo electrónico: contacto@sificoop.com"),0);
				$this->Ln(8);
				$this->Cell(100,10,utf8_decode("Número telefónico: (341) 41 1 2345 / (333) 33 4 1234"),0);
				$this->Cell(20);
				$this->Cell(100,10,utf8_decode("Sitio web: https://www.sificoop.com"),0);
				$this->Ln();

				$this->SetFillColor(31,97,141);
				$this->Cell(0,6,'',0,0,'C','true');
			}

			function BasicTable($header){
				$depositar = $_GET['credito'];
				$nombrecredito = $_GET['nomcre'];
				$cuentaret = $_GET['cuentaret'];
				$total = $_GET['cantidadT'];  

				$com = $_GET['comision']; 
				$cantidadT = $_GET['cantidadTCo']; 

				//Cabecera
			    $this->SetFont('Arial','B',11);
			    foreach($header as $col)
			        $this->Cell(32,7,$col);
			    $this->Ln(10);

			    $this->SetFont('Arial','',11);
			    $this->Cell(32,7,$depositar);
			    $this->Cell(32,7,$nombrecredito);
			    $this->Cell(32,7,$cuentaret);
			    $this->Cell(32,7,'$'.$total.'');
			    $this->Cell(32,7,'$'.$com.'');
			    $this->Cell(32,7,'$'.$cantidadT.'');
			}
		}

		$pdf = new PDF();
		//Titulos de las columnas
		$header = array(utf8_decode("Crédito"), utf8_decode("Nombre crédito"),'Cuenta retiro', 'Cantidad', utf8_decode("Comisión"), 'Total');
		$pdf->SetFont('Arial','',11);
		$pdf->AddPage();
		$pdf->BasicTable($header);
		$pdf->Ln(20);
		$pdf->Cell(20,0,'Saldo restante: $'.$nuevosaldo.'',0);
		$pdf->OutPut('Comprobante_pago.pdf','I'); 

		/*$pdf = new PDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',13);
		$pdf->Cell(70); 
		$pdf->Cell(30,10,'Pago realizado',0);
		$pdf->Ln(20);
		$pdf->SetFont('Arial','',0);
		$pdf->Cell(30,0,'Numero de socio:',0);
		$pdf->Cell(10); 
		$pdf->Cell(30,0,$detalle[0],0);
		$pdf->Ln(10);
		$pdf->Cell(30,0,'Nombre de socio:',0); 
		$pdf->Cell(10);
		$pdf->Cell(38,0,$detalle[1],0);
		$pdf->Cell(25,0,$detalle[2],0);
		$pdf->Cell(30,0,$detalle[3],0);
		$pdf->Ln(20);
		$pdf->Cell(20,0,'Credito:',0);
		$pdf->Cell(5);
		$pdf->Cell(20,0,$depositar,0);
		$pdf->Ln(10);
		$pdf->Cell(28,0,'Nombre de credito:',0);
		$pdf->Cell(15);
		$pdf->Cell(30,0,$nombrecredito,0);
		$pdf->Ln(10);
		$pdf->Cell(30,0,'Cuenta de retiro:',0);
		$pdf->Cell(10);
		$pdf->Cell(30,0,$cuentaret,0);
		$pdf->Ln(10);
		$pdf->Cell(20,0,'Cantidad total de pago: $',0);
		$pdf->Cell(35);
		$pdf->Cell(30,0,$total,0);
		$pdf->Ln(10);
		$pdf->Cell(20,0,'Saldo restante: $',0);
		$pdf->Cell(18);
		$pdf->Cell(30,0,$nuevosaldo,0);
		$pdf->Ln(10);*/
	}
?>