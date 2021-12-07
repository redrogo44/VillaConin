<?php
require 'funciones.php';
conectar();
if(isset($_POST['producto'])&& !empty($_POST['cantidad']) || $_POST['cantidad']>0){
	if($_POST['tipo']=='salida'){
		$_POST['cantidad']=$_POST['cantidad']*(-1);
	}
	$q="insert into salida(id_producto,cantidad,precio,formapago,fecha) values(".$_POST['producto'].",".$_POST['cantidad'].",0,'".$_POST['tipo']."','".date('Y-m-d')."')";
	$r=mysql_query($q);
	//$m=mysql_fetch_array($r);
}

$resultado=existencias($_POST['producto']);
	echo $resultado;

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