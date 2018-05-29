<?php
$credito = $_POST["credito"];
$cantidad = $_POST["cantidad"];

require("../conexion.php");

$sql = mysqli_query($link,"SELECT i_n_d_vig, i_n_d_vig_m, i_m_d_vig, in_nor, iva_int, t_mora FROM informacion WHERE contrato='$credito'");
$res=mysqli_fetch_array($sql);

$cap = $cantidad; 
$idv = $res['i_n_d_vig']; 
$indvm = $res['i_n_d_vig_m'];
$imdv = $res['i_m_d_vig']; 
$int = $res['in_nor'];
$iva = $res['iva_int'];
$mora = $res['t_mora']; 

$resultado = $cap + $idv + $indvm + $imdv + $int + $iva + $mora; 

echo '<font face="arial" size=2 color="black">Capital $</font>';
echo '<input type="text" name="saldo" maxlength="10" id="vspre" class="cuadrosP" value="'.$cantidad.'" onblur="actualizar_total();"/ required>';
echo "<br>";
echo "<table class='tabla'>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Interés devengado vigente: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >$".$res['i_n_d_vig']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Interés devengado vigente moratorio: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >$".$res['i_n_d_vig_m']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Interés moratorio devengado vigente: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >$".$res['i_m_d_vig']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Interés normal:  </font></td>";
		echo "<td><font face='arial' size=2 color='black' >$".$res['in_nor']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Interés moratorio: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >$".$res['t_mora']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >IVA: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >$".$res['iva_int']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><B face='arial' size=2 color='black' >Saldo total a pagar: </B></td>";
		echo "<td><B face='arial' size=2 color='black' >$".$resultado."</B></td>";
	echo "</tr>";
echo "</table>";
echo '<input name="Total" type="hidden" value="'.$resultado.'"/>';

/*echo '<font face="arial" size=2 color="black">Capital $</font>';
echo '<input type="text" name="saldo" maxlength="10" id="vspre" class="cuadrosP" value="'.$cantidad.'" onblur="actualizar_total();"/ required>';
echo "<br>";
echo "<font face='arial' size=2 color='black'>Interés devengado vigente: </font>";
echo "<font face='arial' size=2 color='black'>".$res['i_n_d_vig']."</font>";
echo "<br>";
echo "<font face='arial' size=2 color='black'>Interés devengado vigente moratorio: </font>";
echo "<font face='arial' size=2 color='black'>".$res['i_n_d_vig_m']."</font>";
echo "<br>";
echo "<font face='arial' size=2 color='black'>Interés moratorio devengado vigente: </font>";
echo "<font face='arial' size=2 color='black'>".$res['i_m_d_vig']."</font>";
echo "<br>";
echo "<font face='arial' size=2 color='black'>Interés normal: </font>";
echo "<font face='arial' size=2 color='black'>".$res['in_nor']."</font>";
echo "<br>";
echo "<font face='arial' size=2 color='black'>Interés moratorio: </font>";
echo "<font face='arial' size=2 color='black'>".$res['t_mora']."</font>";
echo "<br>";
echo "<font face='arial' size=2 color='black'>IVA: </font>";
echo "<font face='arial' size=2 color='black'>".$res['iva_int']."</font>";
echo "<br>";
echo "<font face='arial' size=2 color='black'>Saldo total a pagar: $ </font>";
echo "<font face='arial' size=2 color='black'>".$resultado."</font>";
echo "<br>";
echo '<input name="Total" type="hidden" value="'.$resultado.'"/>';*/
?>