<?php
	session_start();
	require("conexion.php");

	//$idsocio = $_SESSION['sesionRC'];
	$idsocio = $_POST['socio'];
	$token = $_POST['token'];

	$contra = md5($_POST['contrasena']); 
	$repcontra = md5($_POST['repcontrasena']);

	if($contra==$repcontra){
		$sql = "UPDATE socio SET contrasena='$contra' WHERE id_socio='$idsocio'"; 
		$res = mysqli_query($link,$sql);
		$borrar = "DELETE FROM cretoclave WHERE token = '$token'";
		$resborr = mysqli_query($link,$borrar);
		if($res && $resborr){
			echo utf8_decode('<script>alert("Su contraseña ha sido modificada exitosamente.")</script>');
			mysqli_close($link);
			echo "<script>location.href='cerrarsesion.php'</script>";
		}
		else{
			echo "Error al modificar ", mysqli_error();
		}
	}
	else{
		echo utf8_decode('<script>alert("Atención, sus contraseñas no coinciden, verifique sus contraseñas ingresadas.")</script>');
		echo "<script>location.href='../cambioC.php'</script>";	
	}
	
?>