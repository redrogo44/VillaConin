<?php
require 'funciones.php';
conectar();
echo "<center><h2>Categoria:".$_POST['categoria']."</h2><center>";
?>
<center><table class='style1'>
<tr><td>Producto</td><td>Descripcion</td><td>Unidad</td><td>Ultimo<br>Costo</td><td>Existencias</td><td>Entradas</td><td>Salidas</td><td colspan='2'>Ventas</td></tr>
<?php
$query="select * from categoria where nombre like '%".$_POST['categoria']."%'";
$resultado=mysql_query($query);
$mostrar=mysql_fetch_array($resultado);
$query2="select * from subcategoria where id_categoria=".$mostrar['id_categoria'];
$resultado2=mysql_query($query2);
while($mostrar2=mysql_fetch_array($resultado2)){
	echo "<tr><td colspan='11' >".$mostrar2['nombre']."</td></tr>";
	$producto="select * from producto where id_categoria=".$mostrar['id_categoria'].' and id_subcategoria='.$mostrar2['id_subcategoria'];
	$product=mysql_query($producto);
	while($mostrarp=mysql_fetch_array($product)){
		$unidad='select * from unidad where id_unidad='.$mostrarp['id_unidad'];
		$unidad2=mysql_query($unidad);
		$unidad3=mysql_fetch_array($unidad2);
		$max='select max(id_compra) as num from detalle_compra where id_producto='.$mostrarp['id_producto'];
		$max2=mysql_query($max);
		$max3=mysql_fetch_array($max2);
		$ultimoc='select precio from detalle_compra where id_producto='.$mostrarp['id_producto'].' and id_compra='.$max3['num'];
		$ultimoc2=mysql_query($ultimoc);
		$ultimoc3=mysql_fetch_array($ultimoc2);
		echo "<tr><td>".$mostrarp['nombre']."</td><td>".$mostrarp['descripcion']."</td><td>".$unidad3['nombre']."</td><td>".$ultimoc3['precio']."</td><td id='".$mostrarp['id_producto']."'>".existencias($mostrarp['id_producto'])."</td>";
		$info='insertar(this.value,"'.$mostrarp['id_producto'].'","entrada")';
		$info2='insertar(this.value,"'.$mostrarp['id_producto'].'","salida")';
		$venta='venta("'.$mostrarp['id_producto'].'")';
		echo "<td><form name='".$mostrarp['id_producto']."'>cantidad<br><input type='number' id='".$mostrarp['id_producto']."' name='producto' onblur='".$info."' min='0' onkeypress='ValidaSoloNumeros()'></form></td><td>cantidad<br><input type='number' onblur='".$info2."' min='0' onkeypress='ValidaSoloNumeros()'></td><td>cantidad<br><input id='c".$mostrarp['id_producto']."' type='number' min='0' onkeypress='ValidaSoloNumeros()'></td><td>precio<br><input id='p".$mostrarp['id_producto']."' type='number' onblur='".$venta."' min='0' ></td></tr>";
	}
}

function existencias($id){
	$t=0;
	$q=mysql_query('select sum(cantidad)as t from detalle_compra where id_producto='.$id);
	$r=mysql_fetch_array($q);
	
	$salidas=mysql_query("select sum(cantidad) as t from salida where id_producto=".$id);
	$salida=mysql_fetch_array($salidas);
	
	$t=$r['t']+$salida['t'];
	
	return $t;
}
?>
</table>