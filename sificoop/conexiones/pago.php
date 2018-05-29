<?php
	session_start();

	include_once("comision/cobromovimiento.php");
	require("conexion.php");
	$idsocio = $_SESSION['sesionP'];
	include_once("infosocios/info_pagos.php"); 

	//Variables para almacenar consulta base de datos
	$ahorro = $f['ahorro']; 
	$inversion = $f['inverflex']; 
	$saldop = $f['saldo_p'];

	//Variables para almacenar lo recibido por POST
	$deposito = $_POST["deposito"];
	$depositar = $_POST["depositar"]; 
	$total = $_POST["Total"];//Total de abono capital mas iva
	$saldoform = $_POST["saldo"];//Abono a capital 

	//Consulta saldo restante del contrato
	$consaldo=mysqli_query($link,"SELECT saldo FROM informacion WHERE contrato='$depositar'");
	$resconsaldo=mysqli_fetch_array($consaldo);
	$saldo = $resconsaldo['saldo'];

	$totalcomision = $total + $cobro;//Cantidad total de pago mas la comision

	$sql3=mysqli_query($link,"SELECT abono_cap, nom_cred FROM informacion WHERE contrato='$depositar'");
	$f3=mysqli_fetch_array($sql3);

	//Variables para almacenar datos del contrato
	$abonocapital = $f3['abono_cap'];
    $nombrecredito = $f3['nom_cred'];

	//Variables para registros de tabla pagos
	$fecha = date("Y/m/d");
	$tipo_m = "Pago";

	if($deposito == 1){
		$nomret1 = "Ahorro";
		if($saldoform <= $saldo){
			if($saldo <= $abonocapital){
				if($totalcomision <= $ahorro){
					$nuevosaldo = $saldo - $saldoform; 
					$nuevoahorro = $ahorro - $totalcomision; 
					header("location:comp_pago.php?abonoC=$abonocapital&nomcre=$nombrecredito&cuentaret=$nomret1&saldoR=$nuevosaldo&cantidadT=$total&credito=$depositar&nuevoCR=$nuevoahorro&pago=1&comision=$cobro&cantidadTCo=$totalcomision");
				}
				else{
					echo utf8_decode('<script>alert("Total mas comisión debe ser menor a la cantidad de cuenta de retiro.")</script>');
					echo "<script>location.href='../Socio/pagos.php'</script>";
				}

			}
			else if($saldoform >= $abonocapital){
				if($totalcomision <= $ahorro){
					$nuevosaldo = $saldo - $saldoform; 
					$nuevoahorro = $ahorro - $totalcomision; 
					header("location:comp_pago.php?abonoC=$abonocapital&nomcre=$nombrecredito&cuentaret=$nomret1&saldoR=$nuevosaldo&cantidadT=$total&credito=$depositar&nuevoCR=$nuevoahorro&pago=1&comision=$cobro&cantidadTCo=$totalcomision");
					
				}
				else{
					echo utf8_decode('<script>alert("Total mas comisión debe ser menor a la cantidad de cuenta de retiro.")</script>');
					echo "<script>location.href='../Socio/pagos.php'</script>";
				}
			}
			else{
				echo '<script>alert("PAGO NO REALIZADO. \nSu cantidad ingresada no debe ser menor a la cantidad especificada en su credito. $ "+'.$abonocapital.')</script> ';
				echo "<script>location.href='../Socio/pagos.php'</script>";
			}
		}
		else{
			echo '<script>alert("PAGO NO REALIZADO. \nSu abono a capital debe ser menor o igual al saldo restante de su credito. $ "+'.$saldo.')</script> ';
			echo "<script>location.href='../Socio/pagos.php'</script>";
		}		
	}
	elseif($deposito == 2) {
		$nomret2 = "Inversion";
		if($saldoform <= $saldo){
			if($saldo <= $abonocapital){
				if($totalcomision <= $inversion){
					$nuevosaldo = $saldo - $saldoform; 
					$nuevainversion = $inversion - $totalcomision; 
					header("location:comp_pago.php?abonoC=$abonocapital&nomcre=$nombrecredito&cuentaret=$nomret2&saldoR=$nuevosaldo&cantidadT=$total&credito=$depositar&nuevoCR=$nuevainversion&pago=2&comision=$cobro&cantidadTCo=$totalcomision");
				}
				else{
					echo utf8_decode('<script>alert("Total mas comisión debe ser menor a la cantidad de cuenta de retiro.")</script>');
					echo "<script>location.href='../Socio/pagos.php'</script>";
				}
			}
			else if($saldoform >= $abonocapital){
				if($totalcomision <= $inversion){
					$nuevosaldo = $saldo - $saldoform; 
					$nuevainversion = $inversion - $totalcomision; 

					header("location:comp_pago.php?abonoC=$abonocapital&nomcre=$nombrecredito&cuentaret=$nomret2&saldoR=$nuevosaldo&cantidadT=$total&credito=$depositar&nuevoCR=$nuevainversion&pago=2&comision=$cobro&cantidadTCo=$totalcomision");
				}
				else{
					echo utf8_decode('<script>alert("Total mas comisión debe ser menor a la cantidad de cuenta de retiro.")</script>');
					echo "<script>location.href='../Socio/pagos.php'</script>";
				}
			}
			else{
				echo '<script>alert("PAGO NO REALIZADO. \nSu cantidad ingresada no debe ser menor a la cantidad especificada en su credito. $ "+'.$abonocapital.')</script> ';
				echo "<script>location.href='../Socio/pagos.php'</script>";
			}
		}
		else{
			echo '<script>alert("PAGO NO REALIZADO. \nSu abono a capital debe ser menor o igual al saldo restante de su credito. $ "+'.$saldo.')</script> ';
			echo "<script>location.href='../Socio/pagos.php'</script>";
		}	
	}
	elseif($deposito == 3){
		$nomret3 = "Saldo prepago";
		if($saldoform <= $saldo){
			if($saldo <= $abonocapital){
				if($totalcomision <= $saldop){
					$nuevosaldo = $saldo - $saldoform;
					$nuevosaldoprepago =  $saldop - $totalcomision; 
					header("location:comp_pago.php?abonoC=$abonocapital&nomcre=$nombrecredito&cuentaret=$nomret3&saldoR=$nuevosaldo&cantidadT=$total&credito=$depositar&nuevoCR=$nuevosaldoprepago&pago=3&comision=$cobro&cantidadTCo=$totalcomision");
				}
				else{
					echo utf8_decode('<script>alert("Total mas comisión debe ser menor a la cantidad de cuenta de retiro.")</script> ');
					echo "<script>location.href='../Socio/pagos.php'</script>";
				}
			}
			else if($saldoform >= $abonocapital){
				if($totalcomision <= $saldop){
					$nuevosaldo = $saldo - $saldoform;
					$nuevosaldoprepago =  $saldop - $totalcomision; 
					header("location:comp_pago.php?abonoC=$abonocapital&nomcre=$nombrecredito&cuentaret=$nomret3&saldoR=$nuevosaldo&cantidadT=$total&credito=$depositar&nuevoCR=$nuevosaldoprepago&pago=3&comision=$cobro&cantidadTCo=$totalcomision");
				}
				else{
					echo utf8_decode('<script>alert("Total mas comisión debe ser menor a la cantidad de cuenta de retiro.")</script>');
					echo "<script>location.href='../Socio/pagos.php'</script>";
				}
			}
			else{
				echo '<script>alert("PAGO NO REALIZADO. \nSu cantidad ingresada no debe ser menor a la cantidad especificada en su credito. $ "+'.$abonocapital.');</script> ';
				echo "<script>location.href='../Socio/pagos.php'</script>";	
			}
		}
		else{
			echo '<script>alert("PAGO NO REALIZADO. \nSu abono a capital debe ser menor o igual al saldo restante de su credito. $ "+'.$saldo.')</script> ';
			echo "<script>location.href='../Socio/pagos.php'</script>";
		}
	}
?>