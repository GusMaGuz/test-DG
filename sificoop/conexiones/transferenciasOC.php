<?php
	session_start();

	include_once("comision/cobromovimiento.php");
	require("conexion.php");
	$idsocio = $_SESSION['sesionP'];

		include_once("infosocios/info_transferencias.php"); 

	//Variables de información BD de socio que transfiere
	$ahorro = $f['ahorro']; 
	$inversion = $f['inverflex']; 
	$saldo = $f['saldo_p']; 

	//Variables de valores por POST
	$sociotransferir = $_POST['transferir'];
	$deposito = $_POST['deposito'];
	$retiro = $_POST['retiro']; 
	$cantidad = $_POST['saldo'];

	$cantidadcomision = $cantidad + $cobro;

		//Consultas de socio a transferir
		$consultatransferir=mysqli_query($link,"SELECT ahorro, inverflex FROM informacion WHERE socio='$sociotransferir'");
		$res=mysqli_fetch_array($consultatransferir);

		$consultatransferir2=mysqli_query($link,"SELECT saldo_p FROM socio WHERE id_socio='$sociotransferir'");
		$res2=mysqli_fetch_array($consultatransferir2);

	//Variables de informacion BD de socio a transferir
	$ahorrotransferir = $res['ahorro'];
	$inversiontransferir = $res['inverflex'];
	$saldotransferir = $res2['saldo_p'];

	if($retiro == 1){
		$nomret1 = "Ahorro";
		if($cantidadcomision <= $ahorro){
			if($deposito == "Ahorro"){
				$nueahorro = $ahorro - $cantidadcomision;//Cantidad total en ahorro transfiere
				$nuedeposito = $cantidad + $ahorrotransferir;//Cantidad total en ahorro transferido
				
				$sqltransfiere = "UPDATE informacion SET  ahorro='$nueahorro' WHERE socio='$idsocio'";
				$restransfiere = mysqli_query($link,$sqltransfiere);

				$sqltransferir = "UPDATE informacion SET  ahorro='$nuedeposito' WHERE socio='$sociotransferir'";
				$restransferir = mysqli_query($link,$sqltransferir);

				if($restransfiere && $restransferir){
					header("location:comp_transferenciaOC.php?sociotransferi=$sociotransferir&deposito=$deposito&retiro=$nomret1&cantidadtr=$nueahorro&cantidad=$cantidad&comision=$cobro&cantidadT=$cantidadcomision");
				} 
				else{
					echo '<script>alert("No se pudo realizar la transferencia.")</script>';
					mysqli_close($link);
				}
			}
			elseif ($deposito == "Inversion") {
				$nueahorro = $ahorro - $cantidadcomision;
				$nuedeposito = $cantidad + $inversiontransferir;

				$sqltransfiere = "UPDATE informacion SET  ahorro='$nueahorro' WHERE socio='$idsocio'";
				$restransfiere = mysqli_query($link,$sqltransfiere);

				$sqltransferir = "UPDATE informacion SET inverflex='$nuedeposito' WHERE socio='$sociotransferir'";
				$restransferir = mysqli_query($link,$sqltransferir);

				if($restransfiere && $restransferir){
					header("location:comp_transferenciaOC.php?sociotransferi=$sociotransferir&deposito=$deposito&retiro=$nomret1&cantidadtr=$nueahorro&cantidad=$cantidad&comision=$cobro&cantidadT=$cantidadcomision");
				} 
				else{
					echo '<script>alert("No se pudo realizar la transferencia.")</script>';
					mysqli_close($link);
				}
			}
			else if($deposito == "Saldo"){
				$nueahorro = $ahorro - $cantidadcomision;//Cantidad total en ahorro transfiere
				$nuedeposito = $cantidad + $saldotransferir;//Cantidad total en saldo prepago transferido
				
				$sqltransfiere = "UPDATE informacion SET  ahorro='$nueahorro' WHERE socio='$idsocio'";
				$restransfiere = mysqli_query($link,$sqltransfiere);

				$sqltransferir = "UPDATE socio SET saldo_p='$nuedeposito' WHERE id_socio='$sociotransferir'";
				$restransferir = mysqli_query($link,$sqltransferir);

				if($restransfiere && $restransferir){
					header("location:comp_transferenciaOC.php?sociotransferi=$sociotransferir&deposito=$deposito&retiro=$nomret1&cantidadtr=$nueahorro&cantidad=$cantidad&comision=$cobro&cantidadT=$cantidadcomision");
				} 
				else{
					echo '<script>alert("No se pudo realizar la transferencia.")</script>';
					mysqli_close($link);
				}
			}
		}
		else{
			echo utf8_decode('<script>alert("La cantidad ingresada mas la comisión debe ser menor a la cantidad de cuenta de retiro.")</script>');
			echo "<script>location.href='../Socio/transferenciacuentas.php'</script>";
		}
	}
	else if($retiro == 2){
		$nomret2 = "Inversion";
		if($cantidadcomision <= $inversion){
			if($deposito == "Ahorro"){
				$nueinversion2 = $inversion - $cantidadcomision;//Total en la cuenta de inversion del que transfiere
				$nuedeposito = $cantidad + $ahorrotransferir;//Total en la cuenta ahorro a transferir

				$sqltransfiere = "UPDATE informacion SET inverflex='$nueinversion2' WHERE socio='$idsocio'";
				$restransfiere = mysqli_query($link,$sqltransfiere);

				$sqltransferir = "UPDATE informacion SET ahorro='$nuedeposito' WHERE socio='$sociotransferir'";
				$restransferir = mysqli_query($link,$sqltransferir);

				if($restransfiere && $restransferir){
					header("location:comp_transferenciaOC.php?sociotransferi=$sociotransferir&deposito=$deposito&retiro=$nomret2&cantidadtr=$nueinversion2&cantidad=$cantidad&comision=$cobro&cantidadT=$cantidadcomision");
				} 
				else{
					echo '<script>alert("No se pudo realizar la transferencia.")</script>';
					mysqli_close($link);
				}
			}
			elseif ($deposito == "Inversion") {
				$nueinversion2 = $inversion - $cantidadcomision;
				$nuedeposito = $cantidad + $inversiontransferir;

				$sqltransfiere = "UPDATE informacion SET  inverflex='$nueinversion2' WHERE socio='$idsocio'";
				$restransfiere = mysqli_query($link,$sqltransfiere);

				$sqltransferir = "UPDATE informacion SET inverflex='$nuedeposito' WHERE socio='$sociotransferir'";
				$restransferir = mysqli_query($link,$sqltransferir);
				
				if($restransfiere && $restransferir){
					header("location:comp_transferenciaOC.php?sociotransferi=$sociotransferir&deposito=$deposito&retiro=$nomret2&cantidadtr=$nueinversion2&cantidad=$cantidad&comision=$cobro&cantidadT=$cantidadcomision");
				} 
				else{
					echo '<script>alert("No se pudo realizar la transferencia.")</script>';
					mysqli_close($link);
				}
			}
			else if($deposito == "Saldo"){
				$nueinversion2 = $inversion - $cantidadcomision;//Total en la cuenta de inversion del que transfiere
				$nuedeposito = $cantidad + $saldotransferir;//Total en la cuenta ahorro a transferir

				$sqltransfiere = "UPDATE informacion SET inverflex='$nueinversion2' WHERE socio='$idsocio'";
				$restransfiere = mysqli_query($link,$sqltransfiere);

				$sqltransferir = "UPDATE socio SET saldo_p='$nuedeposito' WHERE id_socio='$sociotransferir'";
				$restransferir = mysqli_query($link,$sqltransferir);

				if($restransfiere && $restransferir){
					header("location:comp_transferenciaOC.php?sociotransferi=$sociotransferir&deposito=$deposito&retiro=$nomret2&cantidadtr=$nueinversion2&cantidad=$cantidad&comision=$cobro&cantidadT=$cantidadcomision");
				} 
				else{
					echo '<script>alert("No se pudo realizar la transferencia.")</script>';
					mysqli_close($link);
				}
			}
		}
		else{
			echo utf8_decode('<script>alert("La cantidad ingresada mas la comisión debe ser menor a la cantidad de cuenta de retiro.")</script>');
			echo "<script>location.href='../Socio/transferenciacuentas.php'</script>";
		}
	}
	elseif($retiro == 3){
		$nomret3 = "Saldo prepago";
		if($cantidadcomision <= $saldo){
			if($deposito == "Ahorro"){
				$nuesaldop = $saldo - $cantidadcomision;//Cantidad total en saldo prepago para el que transfiere
				$nuedeposito = $cantidad + $ahorrotransferir;//Cantidad total en cuenta de ahorro al de transferir

				$sqltransfiere = "UPDATE socio SET saldo_p='$nuesaldop' WHERE id_socio='$idsocio'";
				$restransfiere = mysqli_query($link,$sqltransfiere);

				$sqltransferir = "UPDATE informacion SET ahorro='$nuedeposito' WHERE socio='$sociotransferir'";
				$restransferir = mysqli_query($link,$sqltransferir);

				if($restransfiere && $restransferir){
					header("location:comp_transferenciaOC.php?sociotransferi=$sociotransferir&deposito=$deposito&retiro=$nomret3&cantidadtr=$nuesaldop&cantidad=$cantidad&comision=$cobro&cantidadT=$cantidadcomision");
				} 
				else{
					echo '<script>alert("No se pudo realizar la transferencia.")</script>';
					mysqli_close($link);
				}
			}
			elseif ($deposito == "Inversion") {
				$nuesaldop = $saldo - $cantidadcomision;
				$nuedeposito = $cantidad + $inversiontransferir;

				$sqltransfiere = "UPDATE socio SET saldo_p='$nuesaldop' WHERE id_socio='$idsocio'";
				$restransfiere = mysqli_query($link,$sqltransfiere);

				$sqltransferir = "UPDATE informacion SET inverflex='$nuedeposito' WHERE socio='$sociotransferir'";
				$restransferir = mysqli_query($link,$sqltransferir);
				
				if($restransfiere && $restransferir){
					header("location:comp_transferenciaOC.php?sociotransferi=$sociotransferir&deposito=$deposito&retiro=$nomret3&cantidadtr=$nuesaldop&cantidad=$cantidad&comision=$cobro&cantidadT=$cantidadcomision");
				} 
				else{
					echo '<script>alert("No se pudo realizar la transferencia.")</script>';
					mysqli_close($link);
				}
			}
			else if($deposito == "Saldo"){
				$nuesaldop = $saldo - $cantidadcomision;//Cantidad total en saldo prepago para el que transfiere
				$nuedeposito = $cantidad + $saldotransferir;//Cantidad total en cuenta de saldo prepago al de transferir

				$sqltransfiere = "UPDATE socio SET saldo_p='$nuesaldop' WHERE id_socio='$idsocio'";
				$restransfiere = mysqli_query($link,$sqltransfiere);

				$sqltransferir = "UPDATE socio SET saldo_p='$nuedeposito' WHERE id_socio='$sociotransferir'";
				$restransferir = mysqli_query($link,$sqltransferir);

				if($restransfiere && $restransferir){
					header("location:comp_transferenciaOC.php?sociotransferi=$sociotransferir&deposito=$deposito&retiro=$nomret3&cantidadtr=$nuesaldop&cantidad=$cantidad&comision=$cobro&cantidadT=$cantidadcomision");
				} 
				else{
					echo '<script>alert("No se pudo realizar la transferencia.")</script>';
					mysqli_close($link);
				}
			}
		}
		else{
			echo utf8_decode('<script>alert("La cantidad ingresada mas la comisión debe ser menor a la cantidad de cuenta de retiro.")</script>');
			echo "<script>location.href='../Socio/transferenciacuentas.php'</script>";
		}
	}
?>