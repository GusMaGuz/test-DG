<?php
	//header("Content-Type: text/html;charset=utf-8");
	require("conexion.php");

	$idsocio= $_POST['numero'];

	$sql=mysqli_query($link,"SELECT id_socio FROM socio WHERE id_socio='$idsocio'");
	if(mysqli_fetch_array($sql)){
		echo utf8_decode('<script>alert("Usted ya esta registrado. Cambie su contraseña")</script>');
		mysqli_close($link);
		echo "<script>location.href='cerrarsesion.php'</script>";
	}
	else{
		$sql2=mysqli_query($link,"SELECT socio FROM informacion WHERE socio='$idsocio'");
		if(mysqli_fetch_array($sql2)){
			session_start();
			$_SESSION['sesionRS'] = $idsocio;
			echo utf8_decode('<script>alert("Por seguridad, contará con 5 minutos para su registro.")</script>');
			echo "<script>location.href='../registroI.php'</script>";
		}
		else{
			echo utf8_decode('<script>alert("Usted no esta dado de alta en SIFICOOP. Comuniquese para mayor información.")</script>');
			mysqli_close($link);
			echo "<script>location.href='cerrarsesion.php'</script>";
		}
	}
?>