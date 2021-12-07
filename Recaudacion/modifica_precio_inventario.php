<?php
require('../funciones2.php');
conectar();
$i=mysql_query("SELECT * FROM inventario");
while($in=mysql_fetch_array($i))
{
	mysql_query("UPDATE `inventario` SET `precio_tienda`='".$in['precio_venta']."' WHERE `id_producto`=".$in['id_producto']);
}



?>