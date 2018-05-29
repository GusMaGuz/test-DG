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

		include_once("../conexiones/infosocios/info_pagos.php"); 
		//include_once("WSDL/mostrarservicios.php");
	?>
	<div class="C-Principal">
		<div class="C-Principal_element">
			<div class="C-Principal_Formu">
				<div class="C-Principal_Formu_ES">
					<form name="form1" action="WSDL/ventaservicio.php" method="POST" id="valform">
						<font face="arial" size=3 color="black">Elija un servicio.</font>
						<br>
							<select name="servicio" id="valorSelect" onchange="muestra_info();" class="cuadroelije">
								<option selected="selected">Elija una opción</option>
								<?php 
								$registroslis = $_SESSION['listado'];
								$cantreg =  count($registroslis[0]['return']['sku']);
								for($x=0; $x<$cantreg; $x++){
								?>
								<option value=<?php echo $x; ?>><?php echo $registroslis[0]['return']['sku'][$x]['descripcion']." ".$registroslis[0]['return']['sku'][$x]['operador']." --> $".$registroslis[0]['return']['sku'][$x]['precio'];?></option>
								<?php 
								} 
								?>
							</select>
						<br>
						<font face="arial" size=3 color="black">Elija una cuenta de retiro.</font>
						<select name="retiro" class="cuadroelije">
							<option selected="selected">Elija una opción</option>
							<option value="1">Ahorro <?php echo "$".$f['ahorro']?></option>
							<option value="2">Inversión <?php echo "$".$f['inverflex']?></option>
							<option value="3">Saldo prepago <?php echo "$".$f['saldo_p']?></opcion>
						</select>
						<br>
						<font face="arial" size=3 color="black">Ingrese número de celular o referencia.</font>
						<br>
						<input name="referencia" maxlength="13" id="valref" class="cuadroelije"/>
						<br>
						<div id="mostrarTotal">
							
						</div>
						<br>
						<div class="botoneselije">
							<input type="submit" class="buttonE" value="Realizar pago"/>
						</div>
					</form>
				</div>
				<div class="C-Principal_Formu_IS" id="mostrardatos">
					<font face='arial' size=3 color='black' >INFORMACIÓN SERVICIO</font>
				</div>
			</div>	
		</div>
	</div>
	<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
	<!--<script type="text/javascript" src="../js/cleave.min.js"></script>
	<script type="text/javascript" src="../js/validaciones/validacionescleave.js"></script>-->
	<script type="text/javascript" src="../js/validacionesMax/validarFormServ.js"></script>
	<script type="text/javascript" src="../js/validacionesMax/mostrarinfo.js"></script>
	<!--<script type="text/javascript" src="../js/validacionesMax/validamonto.js"></script>-->
</body>
</html>