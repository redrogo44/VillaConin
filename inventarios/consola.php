<?php
require 'funciones.php';
conectar();
/*
$s=mysql_query("select * from detalle where id_producto=193 or id_producto=194");
while($m=mysql_fetch_array($s)){
	$p=mysql_fetch_array(mysql_query("select * from producto where id_producto=".$m['id_producto']));
	echo $m['id']."__".$m['cantidad']."__".$p['nombre']."__".$m['precio_adquisicion']."__".$m['id']."__".$m['importe']."__".$m['tipo']."<br>";
	
}*/
$s=mysql_query("select * from producto where id_categoria=2");
while($m=mysql_fetch_array($s)){
	$r=mysql_query("update inventario set fecha='2015-03-07',hora='15:53:18' where id_producto=".$m['id_producto']);
}

?>