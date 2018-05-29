<?php
session_start();

require('../fpdf/fpdf.php');
require("conexion.php");
require("generador.php");
	
	$idsocio = $_SESSION['sesionP'];
	$cantidad = $_GET['cantidad'];
	$retiro = $_GET['nomret'];
	$nueahorro = $_GET['nueahorro'];
	$nueinversion = $_GET['nueinversion'];
	$deposito = $_GET['nomdep'];
	$trans = $_GET['transferencia'];

	$id = "TM".$idgen."";

	date_default_timezone_set('America/Mexico_City');
	$fecha = date("Y/m/d");
	$tipo_m = "Mis cuentas";

	$validar = false; 

	if($trans == 1){

		$sql = "UPDATE informacion SET  ahorro='$nueahorro', inverflex='$nueinversion' WHERE socio=$idsocio";
		$res = mysqli_query($link,$sql);

		$sqlt1 = "INSERT INTO mis_cuentas(id_transferencia_mc, monto_t, c_retiro, c_deposito, fecha_t, cant_TretiroT, cant_TdepositoT, id_socio) VALUES ('$id','$cantidad','$retiro','$deposito','$fecha','$nueahorro','$nueinversion','$idsocio')";
		$rest1 = mysqli_query($link,$sqlt1);

			if($res && $rest1){
				$validar = true; 
			} 
			else{
				mysqli_close($link);
			}

	}

	elseif($trans == 2) { //nueinversion=$nuesaldop

		$sql3 = "UPDATE informacion SET  ahorro='$nueahorro' WHERE socio=$idsocio";
		$res3 = mysqli_query($link,$sql3);

		$sql4 = "UPDATE socio SET saldo_p='$nueinversion' WHERE id_socio=$idsocio";
		$res4 = mysqli_query($link,$sql4);

		$sqlt3 = "INSERT INTO mis_cuentas(id_transferencia_mc, monto_t, c_retiro, c_deposito, fecha_t, cant_TretiroT, cant_TdepositoT, id_socio) VALUES ('$id','$cantidad','$retiro','$deposito','$fecha','$nueinversion','$nueahorro','$idsocio')";
		$rest3 = mysqli_query($link,$sqlt3);

			if($res3 && $res4 && $rest3){
				$validar = true;
			} 
			else{
				mysqli_close($link);
			}

	}

	elseif($trans == 3){ //nueahorro=$nuesaldop2

		$sql5 = "UPDATE informacion SET  inverflex='$nueinversion' WHERE socio=$idsocio";
		$res5 = mysqli_query($link,$sql5);

		$sql6 = "UPDATE socio SET saldo_p='$nueahorro' WHERE id_socio=$idsocio";
		$res6 = mysqli_query($link,$sql6);

		$sqlt4 = "INSERT INTO mis_cuentas(id_transferencia_mc, monto_t, c_retiro, c_deposito, fecha_t, cant_TretiroT, cant_TdepositoT, id_socio) VALUES ('$id','$cantidad','$retiro','$deposito','$fecha','$nueahorro','$nueinversion','$idsocio')";
		$rest4 = mysqli_query($link,$sqlt4);

			if($res5 && $res6 && $rest4){
				$validar = true; 
			} 
			else{
				mysqli_close($link);
			}

	}


if($validar == true){
	class PDF extends FPDF{

		function Header(){
			require("conexion.php");
			$idsocio = $_SESSION['sesionP'];

			$datos = mysqli_query($link,"SELECT id_socio, nombre, ap, am FROM socio WHERE id_socio='$idsocio'");
			$detalle = mysqli_fetch_array($datos);

			//Logo 
			date_default_timezone_set('America/Mexico_City');
			$this->SetFillColor(31,97,141);
			$this->Cell(0,6,'',0,0,'C','true');

			$this->Image('../images/SIFICOOP.png',10,25,33,'JPG');
			$this->SetFont('Arial','B',15);
			$this->Ln(18);
			$this->Cell(80);
			$this->Cell(30,10,'SIFICOOP');
			$this->Cell(38);
			$this->SetFont('Arial','',12);
			$this->Cell(0,10,date('Y-m-d H:i:s'),0);
			$this->Ln(20);
			$this->Cell(62);
			$this->SetFont('Arial','B',13);
			$this->Cell(100,10,'Transferencia entre cuentas.',0);
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
			$this->Ln(130);
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
			$cantidad = $_GET['cantidad'];
			$retiro = $_GET['nomret'];
			$deposito = $_GET['nomdep'];

			$com = $_GET['comision']; 
			$cantidadT = $_GET['cantidadT']; 

			//Cabecera
		    $this->SetFont('Arial','B',13);
		    foreach($header as $col)
		        $this->Cell(40,7,$col);
		    $this->Ln(10);

		    $this->SetFont('Arial','',13);
		    $this->Cell(40,7,$retiro);
		    $this->Cell(40,7,$deposito);
		    $this->Cell(40,7,'$'.$cantidad.'');
		    $this->Cell(40,7,'$'.$com.'');
		    $this->Cell(40,7,'$'.$cantidadT.'');
		}
	}

	$pdf = new PDF();
	//Titulos de las columnas
	$header = array('Cuenta retiro', utf8_decode("Cuenta depósito"), 'Cantidad', utf8_decode("Comisión"), 'Total');
	$pdf->SetFont('Arial','',13);
	$pdf->AddPage();
	$pdf->BasicTable($header);
	$pdf->OutPut('Comprobante_transferencia.pdf','I'); 
} 
else{
	echo '<script>alert("No se pudo realizar la transferencia.")</script>';
	mysqli_close($link);
}
?>