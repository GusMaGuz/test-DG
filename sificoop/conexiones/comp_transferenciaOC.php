<?php
session_start();
require('../fpdf/fpdf.php');
require("conexion.php");
require("generador.php");
	
	$sociotransferir = $_GET['sociotransferi'];
	$deposito = $_GET['deposito'];
	$retiro = $_GET['retiro'];
	$cantidadTR = $_GET['cantidadtr'];
	$cantidad = $_GET['cantidad'];
	
	$idsocio = $_SESSION['sesionP'];

	date_default_timezone_set('America/Mexico_City');
	$fecha = date("Y/m/d");

	$id = "TO".$idgen."";//Número de folio para la transferencia.

	$sqlt1 = "INSERT INTO transferencias_oc(id_transferencia_oc,id_socio_transfiere, id_socio_transferir, coc_deposito, coc_retiro, cant_TretiroOc, fecha_transfe, monto_total) VALUES ('$id','$idsocio','$sociotransferir','$deposito','$retiro','$cantidadTR','$fecha','$cantidad')";
	$rest1 = mysqli_query($link,$sqlt1);

	if($rest1){

		class PDF extends FPDF{

			function Header(){
				require("conexion.php");
				$idsocio = $_SESSION['sesionP'];
				$sociotransferir = $_GET['sociotransferi'];

				$datos = mysqli_query($link,"SELECT id_socio, nombre, ap, am FROM socio WHERE id_socio='$idsocio'");
				$detalle = mysqli_fetch_array($datos);

				$datos2 = mysqli_query($link,"SELECT id_socio, nombre, ap, am FROM socio WHERE id_socio='$sociotransferir'");
				$detalle2 = mysqli_fetch_array($datos2);

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
				$this->Cell(100,10,'Transferencia a otras cuentas.',0);
				$this->Ln(30);
				$this->SetFont('Arial','',13);
				$this->Cell(100,10,'FOLIO: '.$GLOBALS["id"].' ',0);
				$this->Ln(12);
				$this->Cell(100,10,utf8_decode("Socio/Nombre: ".$detalle[0]."/ ".$detalle[1]." ".$detalle[2]." ".$detalle[3].". "),0);
				$this->Ln(20);
				$this->Cell(185,0,'',1);
				$this->Ln(4);
				$this->Cell(100,10,utf8_decode("Socio/Nombre a transferir: ".$detalle2[0]."/ ".$detalle2[1]." ".$detalle2[2]." ".$detalle2[3].". "),0);
				$this->Ln(18);
			}

			function Footer(){
				$this->Ln(120);
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
				$deposito = $_GET['deposito'];
				$retiro = $_GET['retiro'];

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
		$pdf->OutPut('Comprobante_transferencia_otras_cuentas.pdf','I'); 
	}
?>