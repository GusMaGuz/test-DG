<?php
$credito = $_POST["credito"];

require("../conexion.php");

$sql=mysqli_query($link,"SELECT tipo_pre, in_nor, fec_ent, fec_ven, c_entreg, saldo, abono_cap, i_n_d_vig, i_n_d_vig_m, i_m_d_vig, iva_int, t_mora, modalidad, frecuencia, prox_pago FROM informacion WHERE contrato='$credito'");
$f=mysqli_fetch_array($sql);

echo "<font face='arial' size=3 color='black' >INFORMACIÓN CREDITO</font>";
echo "<br>";
echo "<table class='tabla'>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Tipo de prestamo: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >".$f['tipo_pre']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Interés normal: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >".$f['in_nor']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Fecha de entrega: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >".$f['fec_ent']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Fecha de vencimiento: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >".$f['fec_ven']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Cantidad entregada: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >".$f['c_entreg']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Saldo a pagar: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >".$f['saldo']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Abono a capital: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >".$f['abono_cap']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Interés devengado vigente: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >".$f['i_n_d_vig']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Interés devengado vigente moratorio: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >".$f['i_n_d_vig_m']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Interés moratorio devengado vigente: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >".$f['i_m_d_vig']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Modalidad: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >".$f['modalidad']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Frecuencia: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >".$f['frecuencia']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Proximo pago: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >".$f['prox_pago']."</font></td>";
	echo "</tr>";
echo "</table>";
?>