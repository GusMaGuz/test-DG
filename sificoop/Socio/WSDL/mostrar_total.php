<?php
session_start();
$registroslis = $_SESSION['listado'];

$pos =$_POST["posicion"]; 

echo '<font face="arial" size=3 color="black">Ingrese el monto a pagar $</font>';
echo '<input type="text" name="monto" maxlength="10" id="valmonto" class="cuadroelije formatnumber" value="'.$registroslis[0]['return']['sku'][$pos]['precio'].'"/ required>';
echo "<br>";
echo '<input name="sku" type="hidden" value="'.$registroslis[0]['return']['sku'][$pos]['sku'].'"/>';
echo '<input name="descripcion" type="hidden" value="'.$registroslis[0]['return']['sku'][$pos]['descripcion'].'"/>';
echo '<input name="operador" type="hidden" value="'.$registroslis[0]['return']['sku'][$pos]['operador'].'"/>';
?>