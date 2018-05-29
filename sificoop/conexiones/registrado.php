<?php
	session_start();
	//header("Content-Type: text/html;charset=utf-8");
	require("conexion.php");

	$idsocio = $_SESSION['sesionRS'];

	$nombre = $_POST['nombre'];
	$ap = $_POST['ap']; 
	$am = $_POST['am']; 
	$calle = $_POST['calle']; 
	$numero = $_POST['numIE'];
	$colonia = $_POST['colonia'];
	$localidad = $_POST['localidad']; 
	$correo = $_POST['correo'];
	$telF = $_POST['telefonoF'];
	$telC = $_POST['telefonoC']; 
	$contra = md5($_POST['contrasena']);
	$repcontra = md5($_POST['repcontrasena']);

	$fecha = date("Y/m/d"); 

	$ver= "no";
	if($contra==$repcontra){
		$sql = "INSERT INTO socio (id_socio, nombre, ap, am, calle, num, colonia, verificacion, correo_e, localidad, t_casa, t_celular, contrasena) VALUES ('$idsocio','$nombre','$ap','$am','$calle','$numero','$colonia','$ver','$correo','$localidad','$telF','$telC','$contra')";
		$res = mysqli_query($link,$sql);

		$sql2 = "INSERT INTO registra(fecha_reg, tipo_reg, id_socio) VALUES ('$fecha', 'Registro Socio', '$idsocio')";
		$res2 = mysqli_query($link,$sql2);
			if($res && $res2){
				echo utf8_decode('<script>alert("Usted ha sido registrado exitosamente.\nRecibirá notificación de SIFICOOP para su ingreso a la plataforma.")</script>');
				mysqli_close($link);
				echo "<script>location.href='cerrarsesion.php'</script>";
			}
			else{
				echo "Error al registrar.", mysqli_error();
			}
	}
	else{
		echo utf8_decode('<script>alert("Atención, sus contraseñas no coinciden, verifique sus contraseñas ingresadas.")</script>');
		echo "<script>location.href='../registroI.php'</script>";	
	}
?>