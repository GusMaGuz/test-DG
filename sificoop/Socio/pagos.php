<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body class="bg-bodyF">
	<?php 
		require("../conexiones/conexion.php");
		//$idsocio = $_SESSION['sesionP'];
		$idsocio = 46911;

		include_once("../conexiones/infosocios/info_pagos.php"); 
	?>
	<div class="principal_FormP">
		<div class="CElement_FormP">
			<div class="CPFPa">
				<div class="CGDos_FormP" id="mostrardatos">
					<font face='arial' size=3 color='black' >INFORMACIÓN CREDITO</font>
				</div>
				<div class="CGUno_FormP">
					<font face="arial" size=3 color="black">Elija una cuenta de retiro.</font>
					<form name="form1" action="../conexiones/pago.php" method="POST" id="valform">
						<select name="deposito" class="cuadrosP">
							<option selected="selected">Elija una opción</option>
							<option value="1">Ahorro <?php echo "$".$f['ahorro']?></option>
							<option value="2">Inversión <?php echo "$".$f['inverflex']?></option>
							<option value="3">Saldo prepago <?php echo "$".$f['saldo_p']?></opcion>
						</select>
						<br>
						<font face="arial" size=3 color="black">Elija un prestamo a depositar.</font>
						<br>
							<select name="depositar" id="valorSelect" onchange="actualizar_info();" class="cuadrosP">
								<option selected="selected">Elija una opción</option>
								<?php 
								while($row = mysqli_fetch_row($sql3)){
								?>
								<option value=" <?php echo $row[0];?>"><?php echo $row[1];?></option>
								<?php 
								} 
								?>
							</select>
						<br>
						<div id="mostrarTotal">
							
						</div>
						<br>
						<div class="botonesP">
							<input type="submit" class="buttonP" value="Realizar pago"/>
						</div>
					</form>
				</div>
			</div>	
		</div>
	</div>
	<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../js/procesarPagos.js"></script>
	<script type="text/javascript" src="../js/validaciones/validacantidad.js"></script>
	<script type="text/javascript" src="../js/validaciones/validarpagos.js"></script>
</body>
</html>