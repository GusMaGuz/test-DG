<?php
session_start();
$registroslis = $_SESSION['listado'];

$pos = $_POST["posicion"];


echo "<font face='arial' size=3 color='black' >INFORMACIÓN SERVICIO</font>";
echo "<br>";
echo "<table class='tabla'>";
	echo "<tr> ";
		echo "<td><font face='arial' size=3 color='black' >Categoria: </font></td>";
		echo "<td><font face='arial' size=3 color='black' >".$registroslis[0]['return']['sku'][$pos]['categoria']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=3 color='black' >Descripción: </font></td>";
		echo "<td><font face='arial' size=3 color='black' >".$registroslis[0]['return']['sku'][$pos]['descripcion']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=3 color='black' >Giro: </font></td>";
		echo "<td><font face='arial' size=3 color='black' >".$registroslis[0]['return']['sku'][$pos]['giro']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=3 color='black' >Grupo: </font></td>";
		echo "<td><font face='arial' size=3 color='black' >".$registroslis[0]['return']['sku'][$pos]['grupo']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=3 color='black' >Información adicional: </font></td>";
		echo "<td><font face='arial' size=3 color='black' >".$registroslis[0]['return']['sku'][$pos]['informacionAdicional']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=3 color='black' >Operador: </font></td>";
		echo "<td><font face='arial' size=3 color='black' >".$registroslis[0]['return']['sku'][$pos]['operador']."</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=3 color='black' >Precio: </font></td>";
		echo "<td><font face='arial' size=3 color='black' >$ ".$registroslis[0]['return']['sku'][$pos]['precio']."</font></td>";
	echo "</tr>";
echo "</table>";
?>