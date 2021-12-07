<?php
require("../funciones2.php");
conectar();
//print_r($_POST);
$p=mysql_query("SELECT * FROM producto WHERE nombre='".$_POST['producto']."' ");
$pr=mysql_fetch_array($p);
$inv=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$pr["id_producto"]));
$unidad=mysql_fetch_array(mysql_query("select * from unidades_menu where descripcion='".$inv["UnidadMenu"]."'"));

echo $pr['nombre'].",".$pr['descripcion'].",".$unidad['nombre'].",".$pr['id_producto'];


?>