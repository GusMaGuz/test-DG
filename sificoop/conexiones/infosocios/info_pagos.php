<?php
	//Este código es utilizado para extraer información y presentarla en la ventana de pagos, en el módulo de socios.
	
	$sql = mysqli_query($link,"SELECT informacion.ahorro, informacion.inverflex, socio.saldo_p FROM informacion INNER JOIN socio ON informacion.socio = socio.id_socio WHERE id_socio = '$idsocio'");
		$f=mysqli_fetch_array($sql);

	/*$sql=mysqli_query($link,"SELECT ahorro, inverflex FROM informacion WHERE socio='$idsocio'");
	$f=mysqli_fetch_array($sql);

	$sql2=mysqli_query($link,"SELECT saldo_p FROM socio WHERE id_socio='$idsocio'");
	$f2=mysqli_fetch_array($sql2);*/

	$sql3 = mysqli_query($link,"SELECT contrato, nom_cred FROM informacion WHERE socio='$idsocio'");
?>