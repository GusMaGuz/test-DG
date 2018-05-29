<?php
	//header("Content-Type: text/html;charset=utf-8");
	require("conexion.php");
	 
	$idsocio =  $_POST['numero'];
	$contrasena = md5($_POST['contra']);

	$veri = "si";

	$sql=mysqli_query($link,"SELECT id_ad, contrad FROM administrador WHERE id_ad='$idsocio'");
	if($f=mysqli_fetch_array($sql)){
		if($contrasena==$f['contrad']){
			session_start();
			$_SESSION['sesionA'] = $idsocio;
			echo '<script>alert("BIENVENIDO ADMINISTRADOR")</script> ';
			echo "<script>location.href='../Admin/'</script>";	
		}
		else{
			echo utf8_decode('<script>alert("Número o contraseña incorrectos.")</script>');
			echo "<script>location.href='redirect.php'</script>";
		} 
	}
	else{
		$sql=mysqli_query($link,"SELECT id_socio, contrasena, verificacion FROM socio WHERE id_socio='$idsocio'");
		if($f1=mysqli_fetch_array($sql)){
			if($contrasena==$f1['contrasena']){
				if($veri==$f1['verificacion']){
					session_start();
					$_SESSION['sesionP'] = $idsocio;
					echo utf8_decode('<script>alert("Bienvenido socio. Por seguridad contará con 5 minutos para realizar sus movimientos.")</script>');
					echo "<script>location.href='../Socio/'</script>";
				}
				else{
					echo utf8_decode('<script>alert("Aún no tienes acceso. SIFICOOP se lo notificará o comuniquese para mayor información.")</script>');
					echo "<script>location.href='redirect.php'</script>";	
				}
				
			}
			else{
				echo utf8_decode('<script>alert("Número de socio o contraseña incorrectos. Vuelva a ingresar sus datos.")</script>');
				echo "<script>location.href='redirect.php'</script>";
			}
		}
		else{
			echo utf8_decode('<script>alert("Número de socio no registrado, porfavor registrese.")</script>');
			echo "<script>location.href='redirect.php'</script>";	
		}
	}
?>