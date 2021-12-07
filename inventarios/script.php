<?php
require 'funciones.php';
conectar();
$i=0;
$q=mysql_query("select * from detalle where tipo='compra'");
while($m=mysql_fetch_array($q)){
$i++;
	$p=mysql_fetch_array(mysql_query("select * from producto where id_producto=".$m["id_producto"]));
	if($p["impuesto"]>0){
		$t=$m["cantidad"]*$m["precio_adquisicion"]*(1+($p["impuesto"]/100));
		mysql_query("update detalle set importe=".$t." where id_detalle=".$m["id_detalle"]);
	}
}
echo $i;
?>