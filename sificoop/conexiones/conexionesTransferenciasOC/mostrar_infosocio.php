<?php
$socio = $_POST["socio"];

require("../conexion.php");

$sql=mysqli_query($link,"SELECT nombre, ap, am, localidad FROM socio WHERE id_socio='$socio'");
$f=mysqli_fetch_array($sql);

echo "<table style='border: 1px solid #ddd;'>";
	echo "<tr>";
		echo "<td><font face='arial' size=3 color='black' >Información de socio:</font></td>";
	echo "</tr>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Nombre socio: </font></td>";
		echo "<td><font face='arial' size=2 color='black' > ".$f['nombre']." ".$f['ap']." ".$f['am']."</font></td>";
	echo "</tr>";
	echo "<br>";
	echo "<tr> ";
		echo "<td><font face='arial' size=2 color='black' >Localidad: </font></td>";
		echo "<td><font face='arial' size=2 color='black' >".$f['localidad']."</font></td>";
	echo "</tr>";
echo "</table>";