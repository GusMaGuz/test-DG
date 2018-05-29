<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body class="bg-bodyF">
	<div class="principal_FormC">
		<div class="CElement_FormC">
			<div class="CPF_FormC">
				<div class="CGUno_FormC">
					<font face="arial" size=3 color="black">Estos son los movimientos que ha realizado recientemente:</font>
					<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST"">
						<br>
						<font face="arial" size=3 color="black">Transferencias</font>
						<?php
						require("../conexiones/conexion.php");

						//session_start();
						//$idsocio = $_SESSION['sesionP'];
						$idsocio = 46911;

						$sql = mysqli_query($link, "SELECT id_transferencia_mc, monto_t, c_retiro, c_deposito, fecha_t FROM mis_cuentas WHERE id_socio = '$idsocio'");

						echo '<div class="contTabla">';
							echo '<table border="1" class="tabla">';
								echo "<tr>";
									echo "<th>Folio</th>";
									echo "<th>Monto total</th>";
									echo "<th>Cuenta de retiro</th>";
									echo "<th>Cuenta de depósito</th>";
									echo "<th>Fecha</th>";
								echo "</tr>";
						

								while ($row = mysqli_fetch_row($sql)){ 
									echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td></tr>\n"; 
								}
							echo '</table>';
						echo '</div>';
						?>
						<br>
						<font face="arial" size=3 color="black">Transferencias a otras cuentas</font>
						<?php
						$consultaoc = mysqli_query($link,"SELECT id_transferencia_oc, id_socio_transferir, coc_retiro, coc_deposito, monto_total, fecha_transfe FROM transferencias_oc WHERE id_socio_transfiere = '$idsocio'");
						echo '<div class="contTabla">';
							echo '<table border="1" class="tabla">';
								echo "<tr>";
									echo "<th>Folio</th>";
									echo "<th>Transfirio a</th>";
									echo "<th>Cuenta retiro</th>";
									echo "<th>Cuenta depósito</th>";
									echo "<th>Monto transferido</th>";
									echo "<th>Fecha transferencia</th>";
								echo "</tr>";
								
								while ($row3 = mysqli_fetch_row($consultaoc)){ 
			      				 echo "<tr><td>".$row3[0]."</td><td>".$row3[1]."</td><td>".$row3[2]."</td><td>".$row3[3]."</td><td>".$row3[4]."</td><td>".$row3[5]."</td></tr>\n"; 
								}
							echo '</table>';
						echo '</div>';
						?>
						<br>
						<font face="arial" size=3 color="black">Pagos</font>
						<?php
						$sql2 = mysqli_query($link,"SELECT monto_p, nom_credP, fecha_p, c_retiroP, saldo_actual, cant_TretiroP, contrato, id_pago FROM pagos WHERE id_socio = '$idsocio'");
						echo '<div class="contTabla">';
							echo '<table border="1" class="tabla">';
								echo "<tr>";
									echo "<th>Folio</th>";
									echo "<th>Contrato</th>";
									echo "<th>Nombre crédito</th>";
									echo "<th>Monto a pagar</th>";
									echo "<th>Cuenta retiro</th>";
									echo "<th>Cuenta total</th>";
									echo "<th>Saldo actual</th>";
									echo "<th>Fecha</th>";
								echo "</tr>";
								
								while ($row2 = mysqli_fetch_row($sql2)){ 
			      				 echo "<tr><td>".$row2[7]."</td><td>".$row2[6]."</td><td>".$row2[1]."</td><td>".$row2[0]."</td><td>".$row2[3]."</td><td>".$row2[5]."</td><td>".$row2[4]."</td><td>".$row2[2]."</td></tr>\n"; 
								}
							echo '</table>';
						echo '</div>';
						?>
					</form>		
				</div>
			</div>	
		</div>
	</div>
	<script type="text/javascript" src="../js/wait.js"></script>
</body>
</html>