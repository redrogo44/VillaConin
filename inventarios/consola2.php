<?php
require 'funciones.php';
conectar();

$s=mysql_query("select * from inventario where id_producto=193 or id_producto=194");
while($m=mysql_fetch_array($s)){
	$p=mysql_fetch_array(mysql_query("select * from producto where id_producto=".$m['id_producto']));
	echo $m['cantidad']."__".$p['nombre']."__".$m['fecha']."<br>";
	
}
?>