<?php
		//Este código es utilizado para extraer informacion y presentarla en las ventanas de transferencias y transferencias a otras cuentas, en el módulo de socios. 

		//SELECT informacion.ahorro, informacion.inverflex, socio.saldo_p FROM informacion INNER JOIN socio ON informacion.socio = socio.id_socio WHERE id_socio = '46911'

		$sql = mysqli_query($link,"SELECT informacion.ahorro, informacion.inverflex, socio.saldo_p FROM informacion INNER JOIN socio ON informacion.socio = socio.id_socio WHERE id_socio = '$idsocio'");
		$f=mysqli_fetch_array($sql);

		/*$sql=mysqli_query($link,"SELECT ahorro, inverflex FROM informacion WHERE socio='$idsocio'");
		$f=mysqli_fetch_array($sql);

		$sql2=mysqli_query($link,"SELECT saldo_p FROM socio WHERE id_socio='$idsocio'");
		$f2=mysqli_fetch_array($sql2);*/

		//Este fragmento de código se utiliza en transferencias a otras cuentas
		$sql3 = mysqli_query($link,"SELECT id_socio_a_transferir FROM otras_cuentas WHERE id_socio_transfiere='$idsocio'");
?>