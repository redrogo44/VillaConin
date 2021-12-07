<?php
require "../funciones2.php";
conectar();

$in=mysql_fetch_array( mysql_query("SELECT * FROM producto WHERE id_producto=".$_POST["id"]));
$inv=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$_POST["id"]));

$porcion=$_POST["cantidad"]/$inv["Equivalencia"];
$costo=$porcion*$inv["precio"];
echo number_format($costo,3);
?>