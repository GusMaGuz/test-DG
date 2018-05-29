<?php
session_start();

include_once("comision/cobromovimiento.php");
require("conexion.php");

		$idsocio = $_SESSION['sesionP'];
		include_once("infosocios/info_transferencias.php"); 

	$ahorro = $f['ahorro']; 
	$inversion = $f['inverflex']; 
	$saldo = $f['saldo_p']; 

	$cantidad = $_POST['saldo']; 
	$retiro = $_POST['retiro']; 
	$deposito = $_POST['deposito'];

	$cantidadcomision = $cantidad + $cobro;

	if($retiro == 1){
		$nomret1 = "Ahorro";
		if($cantidadcomision <= $ahorro){
			if($deposito == 2){
				$nomdep1 = "Inversion";
				$nueahorro = $ahorro - $cantidadcomision;
				$nueinversion = $cantidad + $inversion;

				header("location:comp_transferencia.php?cantidad=$cantidad&nomret=$nomret1&nueahorro=$nueahorro&nueinversion=$nueinversion&nomdep=$nomdep1&transferencia=1&comision=$cobro&cantidadT=$cantidadcomision");
			}
		}
		else{
			echo utf8_decode('<script>alert("La cantidad ingresada mas la comisión debe ser menor a la cantidad de cuenta de retiro.")</script>');
			echo "<script>location.href='../Socio/transferencia.php'</script>";
		}
	}
	elseif($retiro == 2){
		$nomret2 = "Inversion";
		if($cantidadcomision <= $inversion){
			if($deposito == 1){
				$nomdep2 = "Ahorro";
				$nueinversion2 = $inversion - $cantidadcomision;
				$nueahorro2 = $cantidad + $ahorro;

				header("location:comp_transferencia.php?cantidad=$cantidad&nomret=$nomret2&nueahorro=$nueahorro2&nueinversion=$nueinversion2&nomdep=$nomdep2&transferencia=1&comision=$cobro&cantidadT=$cantidadcomision");
			}
		}
		else{
			echo utf8_decode('<script>alert("La cantidad ingresada mas la comisión debe ser menor a la cantidad de cuenta de retiro.")</script>');
			echo "<script>location.href='../Socio/transferencia.php'</script>";
		}
	}
	elseif($retiro == 3){
		$nomret3 = "Saldo prepago";
		if($cantidadcomision <= $saldo){
			if($deposito == 1){
				$nomdep3 = "Ahorro";
				$nuesaldop = $saldo - $cantidadcomision;
				$nueahorro3 = $cantidad + $ahorro;

				header("location:comp_transferencia.php?cantidad=$cantidad&nomret=$nomret3&nueahorro=$nueahorro3&nueinversion=$nuesaldop&nomdep=$nomdep3&transferencia=2&comision=$cobro&cantidadT=$cantidadcomision");
			}
			elseif($deposito == 2){
				$nomdep4 = "Inversion";
				$nuesaldop2 = $saldo - $cantidadcomision;
				$nueinversion3 = $cantidad + $inversion;

				header("location:comp_transferencia.php?cantidad=$cantidad&nomret=$nomret3&nueahorro=$nuesaldop2&nueinversion=$nueinversion3&nomdep=$nomdep4&transferencia=3&comision=$cobro&cantidadT=$cantidadcomision");
			}
		}
		else{
			echo utf8_decode('<script>alert("La cantidad ingresada mas la comisión debe ser menor a la cantidad de cuenta de retiro.")</script>');
			echo "<script>location.href='../Socio/transferencia.php'</script>";
		}
	}
?>