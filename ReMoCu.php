<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");

require 'funciones2.php';
conectar();

$c=mysql_query("select * from Movimientos_Cuentas");

echo "<table>";
echo "<tr><td>Fecha</td><td>Concepto</td><td>Cantidad</td><td>Tipo</td><td>Estatus</td><td>Cuenta Origen</td><td>Cuenta Destino</td></tr>";
while($m=mysql_fetch_array($c)){
	echo "<tr>";
	echo "<td>".$m["fecha"]."</td>";
	echo "<td>".$m["concepto"]."</td>";
	echo "<td>$".$m["cantidad"]."</td>";
	if($m["facturado"]==1){
		echo "<td>Facturado</td>";
	}else{
		echo "<td>No Facturado</td>";
	}
	echo "<td>".$m["estatus"]."</td>";
	
	if(is_numeric($m["cuenta_emisor"])){
		$cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$m["cuenta_emisor"]));
		echo "<td>".$cuenta["alias"]."</td>";
	}else{
		echo "<td>N/A</td>"; 
	}
	
	 
	if(is_numeric($m["cuenta_receptora"])){
		$cuenta2=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$m["cuenta_receptora"]));
		echo "<td>".$cuenta2["alias"]."</td>";
	}else{
		echo "<td>N/A</td>";
	}	
	
	echo "</tr>";
}
echo "</table>";
?>