<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="shortcut icon" href="../images/favicon.ico"/>
	<title>Plataforma</title>
	<script Language="JavaScript">
	(function(){
		if(history.forward(1)){
		history.replace(history.forward(1));
		}
	})();
	</script>
</head>
<?php
	require("../conexiones/conexion.php");

	/*if (empty($_SESSION['sesionP'])){
		echo "<script>location.href='../conexiones/redirect.php'</script>";
	}

	$idsocio = $_SESSION['sesionP'];*/
	$idsocio = 46911;

	$sql = mysqli_query($link,"CALL CONSULTARNOMBRESOCIO('$idsocio')");
	//$sql=mysqli_query($link,"SELECT nombre FROM socio WHERE id_socio='$idsocio'");
	$res=mysqli_fetch_array($sql);

	include_once("WSDL/mostrarservicios.php");//(Se carga el listado de serviciosMovilMaxx)
?>
<!--<body class="margin-body bg-color" onLoad="ini();">-->
<body class="margin-body bg-color" onload="ini();" onkeypress="parar();" onclick="parar();">
	<div class="menu_bar">
		<a href="#" class="bt-menu"><span class="menu_span fa fa-bars fa-lg"></span></a>
	</div>
	<div class="cont-form-men">
		<div class="contenedor">
			<nav class="menu_nav">
				<div class="cont-info">
					<span class="fa fa-user-circle fa-5x"></span>
					<div class="alinear-text">
						<strong>Socio: <?php echo "".$res['nombre'].""?></strong>
					</div>
				</div>
				<ul class="menu_ul">
					<li class="menu_li"><a href="presentacion.html" target="form" class="menu_a ocultar"><span class="fa fa-home fa-lg"></span>&nbsp; Inicio</a></li>
					<li class="menu_li submenu">
						<a href="#" class="menu_a"><span class="fa fa-exchange fa-lg"></span>&nbsp; Transferencias<span class="iconsub fa fa-angle-down fa-lg""></span></a>
						<ul class="children">
							<li class="li_children"><a href="transferencia.php" target="form" class="a_children"><span class="fa fa fa-user fa-lg"></span>&nbsp; Entre mis cuentas</a></li>
							<li class="li_children"><a href="transferenciacuentas.php" target="form" class="a_children"><span class="fa fa fa-users fa-lg"></span>&nbsp; Entre otras cuentas</a></li>
						</ul>
					</li>
					<li class="menu_li"><a href="pagos.php" class="menu_a ocultar" target="form"><span class="fa fa-money fa-lg"></span>&nbsp; Pagos</a></li>
					<li class="menu_li"><a href="consultaMov.php" class="menu_a ocultar" target="form"><span class="fa fa-list-alt fa-lg"></span>&nbsp; Consultar movimientos</a></li>
					<li class="menu_li"><a href="google-maps.html" class="menu_a ocultar" target="form"><span class="fa fa-map-marker fa-lg"></span>&nbsp; Buscanos</a></li>
					<li class="menu_li"><a href="pagoServicios.php" class="menu_a ocultar" target="form"><span class="fa fa-credit-card fa-lg"></span>&nbsp; Pago servicios</a></li>
					<li class="menu_li"><a href="../conexiones/cerrarsesion.php" class="menu_a ocultar"><span class="fa fa-sign-out fa-lg"></span>&nbsp; Salir</a></li>
				</ul>
			</nav>
		</div>
		<iframe src="presentacion.html" class="formularios" name="form" frameborder="0" id="filecontainer"></iframe>
		<!--<iframe src="presentacion.html" class="formularios" name="form" frameborder="0"></iframe>-->
	</div>
	<script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="../js/main.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/wait.js"></script>
</body>
</html>