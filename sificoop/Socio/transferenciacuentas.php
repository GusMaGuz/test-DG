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
		$idsocio = $_SESSION['sesionP'];

		include_once("../conexiones/infosocios/info_transferencias.php");
	?>
	<div class="principal_FormT">
		<div class="CElement_FormT">
			<div class="CPF_FormT">
				<div class="CGUno_FormT">
					<font face='arial' size=3 color='black'>Elija el número de socio a transferir.</font>
					<br>
					<form name="form1" action="../conexiones/transferenciasOC.php" method="POST" id="valform">
						<select name="transferir" id="Selectsocio" onchange="mostrar_info();" class="cuadrosT">
							<option selected="selected">Elija una opción</option>
							<?php 
							while($row = mysqli_fetch_row($sql3)){
							?>
							<option value="<?php echo $row[0];?>"><?php echo $row[0];?></option>
							<?php 
							} 
							?>
						</select>
						<br>
						<br>
						<div id="mostrardatos" class="mostrar">
						
						</div>
						<br>
						<font face='arial' size=3 color='black'>Elija la cuenta destino a transferir.</font>
						<br>
						<select name="deposito" id="Selectdestino" class="cuadrosT">
							<option selected="selected">Elija una opción</option>
							<option value="Ahorro">Ahorro</option>
							<option value="Inversion">Inversión</opcion>
							<option value="Saldo">Saldo prepago</opcion>
						</select>

						<span class="linea"></span>
						<br>
						<br>
						<font face="arial" size=3 color="black">Elija una cuenta de retiro.</font>
						<br>
						<select name="retiro" id="Selectretiro" class="cuadrosT">
							<option selected="selected">Elija una opción</option>
							<option value="1">Ahorro <?php echo "$".$f['ahorro']?></option>
							<option value="2">Inversión <?php echo "$".$f['inverflex']?></option>
							<option value="3">Saldo prepago <?php echo "$".$f['saldo_p']?></opcion>
						</select>
						<br>
						<font face="arial" size=3 color="black">Ingrese la cantidad a transferir.</font>
						<br>
						<input type="text" name="saldo" maxlength="10" id="vspre" class="cuadrosT">
						<div class="botonesT">
							<input type="submit" class="buttonT" value="Realizar transferencia"/>
						</div>
					</form>
				</div>
			</div>	
		</div>
	<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../js/procesarTOC.js"></script>
	<script type="text/javascript" src="../js/validaciones/validacantidad.js"></script>
	<script type="text/javascript" src="../js/validaciones/validartransferenciaOC.js"></script>
</body>
</html>