<?php
require('../funciones2.php');
conectar();
$se="SELECT * FROM `productos_tiendita` WHERE codigo='".$_POST['codigo']."'";
$x=mysql_query($se);
if (mysql_num_rows($x)>0) 
{
	$pro=mysql_fetch_array($x);
	echo $pro['nombre'].",".$pro['descripcion'].",".$pro['precio'].",a".$pro['id'];
}
else
{
	$vi=mysql_query("SELECT * FROM producto WHERE codigo='".$_POST['codigo']."'");
	$vin=mysql_fetch_array($vi);
	$precio=mysql_query("SELECT * FROM inventario where id_producto=".$vin['id_producto']);
	$pre=mysql_fetch_array($precio);
	
	echo $vin['nombre'].",".$vin['descripcion'].",".$pre['precio_tienda'].",v".$vin['id_producto'].",".$pre['IR'].", esvino";
}

?>