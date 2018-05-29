<?php
$credito = $_POST["credito"];

require("../conexion.php");

$sql=mysqli_query($link,"SELECT tipo_pre, in_nor, fec_ent, fec_ven, c_entreg, saldo, abono_cap, i_n_d_vig, i_n_d_vig_m, i_m_d_vig, iva_int, t_mora, modalidad, frecuencia, prox_pago FROM informacion WHERE contrato='$credito'");
$f=mysqli_fetch_array($sql);

echo "<font face='arial' size=2 color='black' >Tipo de prestamo: </font>";
echo "<font face='arial' size=2 color='black' >".$f['tipo_pre']."</font>";
echo "<br>";
echo "<br>";
echo "<font face='arial' size=2 color='black' >Interés normal: </font>";
echo "<font face='arial' size=2 color='black' >".$f['in_nor']."</font>";
echo "<br>";
echo "<br>";
echo "<font face='arial' size=2 color='black' >Fecha de entrega: </font>";
echo "<font face='arial' size=2 color='black' >".$f['fec_ent']."</font>";
echo "<br>";
echo "<br>";
echo "<font face='arial' size=2 color='black' >Fecha de vencimiento: </font>";
echo "<font face='arial' size=2 color='black' >".$f['fec_ven']."</font>";
echo "<br>";
echo "<br>";
echo "<font face='arial' size=2 color='black' >Cantidad entregada: </font>";
echo "<font face='arial' size=2 color='black' >".$f['c_entreg']."</font>";
echo "<br>";
echo "<br>";
echo "<font face='arial' size=2 color='black' >Saldo a pagar: </font>";
echo "<font face='arial' size=2 color='black' >".$f['saldo']."</font>";
echo "<br>";
echo "<br>";
echo "<font face='arial' size=2 color='black' >Abono a capital: </font>";
echo "<font face='arial' size=2 color='black' >".$f['abono_cap']."</font>";
echo "<br>";
echo "<br>";
echo "<font face='arial' size=2 color='black' >Interés devengado vigente: </font>";
echo "<font face='arial' size=2 color='black' >".$f['i_n_d_vig']."</font>";
echo "<br>";
echo "<br>";
echo "<font face='arial' size=2 color='black' >Interés devengado vigente moratorio: </font>";
echo "<font face='arial' size=2 color='black' >".$f['i_n_d_vig_m']."</font>";
echo "<br>";
echo "<br>";
echo "<font face='arial' size=2 color='black' >Interés moratorio devengado vigente: </font>";
echo "<font face='arial' size=2 color='black' >".$f['i_m_d_vig']."</font>";
echo "<br>";
echo "<br>";
echo "<font face='arial' size=2 color='black' >Modalidad: </font>";
echo "<font face='arial' size=2 color='black' >".$f['modalidad']."</font>";
echo "<br>";
echo "<br>";
echo "<font face='arial' size=2 color='black' >Frecuencia: </font>";
echo "<font face='arial' size=2 color='black' >".$f['frecuencia']."</font>";
echo "<br>";
echo "<font face='arial' size=2 color='black' >Proximo pago: </font>";
echo "<font face='arial' size=2 color='black' >".$f['prox_pago']."</font>";
?>