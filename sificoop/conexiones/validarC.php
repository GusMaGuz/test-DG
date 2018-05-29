<?php
	session_start(); 
	//header("Content-Type: text/html;charset=utf-8");
	require("conexion.php");

	/*$_SESSION['sesionRC'] = $_POST['numero'];
	$idsocio = $_SESSION['sesionRC'];*/
	$idsocio = $_POST['numero'];

	$correo = $_POST['correo']; 

	//Código NUEVO agregado
	$creatoken = "Tk".$idsocio.rand(1,9999999)."on";
	$token = sha1($creatoken);
	date_default_timezone_set('America/Mexico_City');
	$fecha = date("Y/m/d");

	$inse=mysqli_query($link,"INSERT INTO cretoclave(token, id_socio, fecha) VALUES ('$token','$idsocio','$fecha')");
	if($inse){
		$sql=mysqli_query($link,"SELECT correo_e, nombre FROM socio WHERE id_socio='$idsocio'");
		if($f=mysqli_fetch_array($sql)){
			if($correo==$f['correo_e']){
				$url = "https://www.dasandapps.com/SIFICOOP/cambioC.php?i=".$idsocio."&t=".$token."";//NUEVO
				require ("../phpmailer/class.phpmailer.php"); 
				$mail = new PHPMailer; 
				$mail->Host = "mail.dasandapps.com";
				$mail->From = "contactosificoop@dasandapps.com"; 
				$mail->FromName = "SIFICOOP"; 
				$mail->Subject = utf8_decode("Recuperación de contraseña (No responder a este correo)");
				$mail->addAddress($correo, "SIFICOOP");
				$mail->MsgHTML("Hola socio ".$f['nombre']."<br />
								<br />
							    SIFICOOP responde a su petici&oacute;n para recuperar su contrase&ntilde;a.<br />
							    <br />
							    Le proporcionamos el siguiente enlace para que pueda reestablecer su contrase&ntilde;a: Click <a href=".$url.">aqui</a>
							    <br />
							    El link caducar&aacute; muy pronto, asegurate de utilizarlo inmediatamente. 
							    <br /> 
							    <br />
							    Despu&eacute;s pruebe ingresando su n&uacute;mero de socio y contrase&ntilde;a, cualquier duda estamos a su disposici&oacute;n.<br />
							    Gracias.
							    <br />
							    <br />
							    Equipo de soporte t&eacute;cnico SIFICOOP.<br />
							");

				if($mail->Send()){
					echo utf8_decode('<script>alert("Se ha enviado a su correo electrónico información para recuperar su contraseña")</script>');
					echo "<script>location.href='redirect.php'</script>";
				}
			}
			else{
				echo utf8_decode('<script>alert("Su correo electrónico no coincide. Asegurese de ingresar el correcto.")</script>');
				echo "<script>location.href='../recuperarV.php'</script>";
			}
		}
		else{
			echo utf8_decode('<script>alert("Este correo electrónico no esta asociado a algun socio registrado. Registrese")</script>');
			mysqli_close($link);
			echo "<script>location.href='cerrarsesion.php'</script>";
		}
	}
	else{
		echo utf8_decode('<script>alert("Ha ocurrido un error al realizar la petición")</script>');
		mysqli_close($link);
		echo "<script>location.href='cerrarsesion.php'</script>";
	}
?>