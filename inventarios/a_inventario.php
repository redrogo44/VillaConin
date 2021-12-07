<?php
require 'funciones.php';
conectar();
//print_r($_POST);
if($_POST['etapa']==1){
	//mysql_query("insert into corte_inventario(fecha,hora)values('".$_POST['fecha']."','".$_POST['hora']."')");
	//echo "insert into corte_inventario(fecha,hora)values('".$_POST['fecha']."','".$_POST['hora']."')"."<br>";
	echo "INICIALIZANDO CORTE DE INVENTARIO";
}else if($_POST['etapa']==2){
	//////inventario inicial menos lo consumido se pone como suma porque viene en negativo
	$inv_actual=$_POST['ii']+$_POST['consumido'];
	//////////actualizamos la tabla inventario con lo que tenemos actualmente  en existencia
	/*mysql_query("update inventario set cantidad=".$inv_actual.",fecha='".$_POST['fecha']."',hora='".$_POST['hora']."' where id_producto=".$_POST['id']);*/
	mysql_query("update inventario set cantidad=".$inv_actual.",precio=".$_POST['costo'].",fecha='".$_POST['fecha']."',hora='".$_POST['hora']."' where id_producto=".$_POST['id']);
	//echo "update inventario set cantidad=".$inv_actual.",precio=".$_POST['costo'].",fecha='".$_POST['fecha']."',hora='".$_POST['hora']."' where id_producto=".$_POST['id']."<br>";
	/////////insertamos en detalle para guardar historico de cortes
	$max=mysql_fetch_array(mysql_query('select max(id_corte_inventario) as m from corte_inventario'));/////obtenemos al corte que pertence
	$importe=$_POST['consumido']*$_POST['costo'];
	if($max['m']==''){
		$max['m']=0;
	}
	$max['m']=$max['m']+1;
	mysql_query("insert into detalle(id,cantidad,id_producto,precio_adquisicion,precio_venta,importe,tipo) values(".$max['m'].",".$_POST['consumido'].",".$_POST['id'].",".$_POST['costo'].",0,".$importe.",'faltante')");			
	//echo "insert into detalle(id,cantidad,id_producto,precio_adquisicion,precio_venta,importe,tipo) values(".$max['m'].",".$_POST['consumido'].",".$_POST['id'].",".$_POST['costo'].",0,".$importe.",'faltante')"."<br>";
	$producto=mysql_fetch_array(mysql_query("select * from producto where id_producto=".$_POST['id']));
	echo "ACTUALIZANDO ".$producto['nombre']; 
}else if($_POST['etapa']==3){
	//mysql_query("insert into corte_inventario(fecha,hora)values('".$_POST['fecha']."','".$_POST['hora']."')");
	echo "FINALIZANDO....";
}
?>