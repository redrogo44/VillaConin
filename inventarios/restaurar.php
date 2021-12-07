<?php
require 'funciones.php';
conectar();

$q="select * from borrados where id_borrados=".$_GET['id'];
//echo $q."<br>";
$r=mysql_query($q);
$m=mysql_fetch_array($r);
$arr=explode('%',$m['otros']);
$arr2=explode('%',$m['descripcion']);
//////restauramos el producto
if($m['tabla']=='producto'){
	mysql_query("insert into producto(id_producto,nombre,descripcion,id_unidad,id_categoria,id_subcategoria,impuesto)
		values(".$m['id_anterior'].",'".$m['nombre']."','".$arr2[0]."',".$arr2[1].",".$arr2[2].",".$arr2[3].",".$arr2[4].")"); 
		//echo "insert into producto(id_producto,nombre,descripcion,id_unidad,id_categoria,id_subcategoria,impuesto)
		//values(".$m['id_anterior'].",'".$m['nombre']."','".$arr2[0]."',".$arr2[1].",".$arr2[2].",".$arr2[3].",".$arr2[4].")<br>";
}
////rstauramos la referencia a movimientos en detalle 
for($i=0;$i<count($arr);$i++){
	if($arr[$i]!=''){
		mysql_query("update detalle set id_producto=".$m['id_anterior']." where id_detalle=".$arr[$i]);
		//echo "update detalle set id_producto=".$m['id_anterior']." where id_detalle=".$arr[$i]."<br>";
	}
}
//////restauramos la referencia a tabla de inventario
mysql_query("update inventario set id_producto=".$m['id_anterior']." where id_aux=".$arr2[5]);


/////eliminamos de la tabla borrados
mysql_query("delete from borrados where id_borrados=".$_GET['id']);
//echo "delete from borrados where id_borrados=".$_GET['id'];
header ("Location: cancelar.php");
?>
