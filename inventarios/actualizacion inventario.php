<?php
require 'funciones.php';
conectar();

$q=mysql_query("select * from producto where id_categoria=2");
while($m=mysql_fetch_array($q)){
	mysql_query("update inventario set fecha='2015-03-07' where id_producto=".$m['id_producto']);
}
$q2=mysql_query("select * from producto where id_categoria=2");
while($m3=mysql_fetch_array($q2)){
	$m2=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$m3['id_producto']));
	echo $m2['id_producto']." ".$m2['fecha'];
}
?>