<?php
require('../configuraciones.php');
conectar();


$s=mysql_query('SELECT * FROM corte_inventario WHERE fecha>="2015-01-27" and fecha<="2015-01-27"');
// RECORRE EL CORTE DE INVENTARIO DADO LAS FECHAS INGREADAS
while ($se=mysql_fetch_array($s)) 
{
	echo $se['id_corte_inventario']."<br>";

	$d=mysql_query("SELECT * FROM detalle WHERE tipo='faltante' and id=".$se['id_corte_inventario']);
	// RECORRE LA TABLA DETALLE EN BUSCA DE CAMBIOS
	while ($de=mysql_fetch_array($d)) 
	{
		$p=mysql_query("SELECT * FROM producto WHERE id_producto=".$de['id_producto']);
		while ($pr=mysql_fetch_array($p)) 
		{
		echo $de['tipo']." ".$de['id_producto']." ".$pr['nombre']."		Cantidad Faltante				".$de['cantidad']."<br>";					
		}
	}
}
?>