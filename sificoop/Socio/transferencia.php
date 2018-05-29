<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<!--<script type="text/javascript" src="../js/validaformulario.js"></script>-->
</head>
<body class="bg-bodyF">
	<?php 
		require("../conexiones/conexion.php");
		$idsocio = $_SESSION['sesionP'];

		include_once("../conexiones/infosocios/info_transferencias.php"); 
	?>
	<div class="principal_FormT">
		<div class="CElement_FormT">
			<div class="CPF_FormT">
				<div class="CGUno_FormT">
					<font face="arial" size=3 color="black">Cuentas de retiro.</font>
					<form name="form1" action="../conexiones/transferencias.php" method="POST" id="valform">
						<select name="retiro" class="cuadrosT">
							<option selected="selected">Elija una opción</option>
							<option value="1">Ahorro <?php echo "$".$f['ahorro']?></option>
							<option value="2">Inversión <?php echo "$".$f['inverflex']?></option>
							<option value="3">Saldo prepago <?php echo "$".$f['saldo_p']?></option>
						</select>
						<br>
						<font face="arial" size=3 color="black">Cuentas de depósito:</font>
						<br>
						<select name="deposito" class="cuadrosT">
							<option selected="selected">Elija una opción</option>
							<option value="1">Ahorro </option>
							<option value="2">Inversión</option>
						</select>
						<br>
						<font face="arial" size=3 color="black">Cantidad a depositar $</font>
						<input type="text" name="saldo" maxlength="10" id="vspre" class="cuadrosT">
						<div class="botonesT">
							<input type="submit" class="buttonT" value="Realizar movimiento"/>
						</div>
					</form>
				</div>
			</div>	
		</div>
	</div>
	<script type="text/javascript" src="../js/validaciones/validacantidad.js"></script>
	<script type="text/javascript" src="../js/validaciones/validartransferencia.js"></script>
</body>
</html>