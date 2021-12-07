<?php
require 'funciones.php';
conectar();
session_start();
date_default_timezone_set("America/Monterrey");
if(isset($_GET['s_status']) && $_GET['s_status']==1){
////validacion de ultimo folio
	$max=mysql_query("select max(id_salida) as max from salida");
	$m=mysql_fetch_array($max);
	if($m['max']!=''){////////comparamos que sea el primer registro
		$det=mysql_query("select count(*) as c from detalle where id=".$m['max']." and tipo='salida'");
		$c_detalle=mysql_fetch_array($det);
		if($c_detalle['c']<=0){
			$delete=mysql_query("delete from salida where id_salida=".$m['max']);
			$act=mysql_query("ALTER TABLE salida AUTO_INCREMENT=".$m['max']);
		}
	}
////////////////
	$insert='insert into salida(fecha,hora)values("'.date('Y-m-d').'","'.date('H:i:s').'")';
	$consulta=mysql_query($insert);
	$nuevo_folio=mysql_fetch_array(mysql_query("select max(id_salida) as m from salida"));
	$_SESSION['folio_salida']=$nuevo_folio['m'];
	header("Location: salida.php?s_status=2");
	exit(); 
}elseif(isset($_POST['folio']) && $_POST['s_status']==2){
	$producto=mysql_query('select * from producto where nombre="'.$_POST['producto'].'"');
	$producto2=mysql_fetch_array($producto);
	$inventario=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$producto2['id_producto']));
	$insert='insert into detalle(id,cantidad,id_producto,precio_adquisicion,precio_venta,importe,tipo)values('.$_POST['folio'].','.$_POST['cantidad'].','.$producto2['id_producto'].','.$inventario['precio'].',0,'.$_POST['cantidad']*$inventario['precio'].',"salida")';
	//echo $insert;
	$consulta=mysql_query($insert);
	header("Location: salida.php?s_status=2?folio=".$_POST['folio']);
	exit(); 
}elseif(isset($_POST['opcion']) && $_POST['opcion']=='Finalizar'){
	$_SESSION['folio_salida']=0;
	echo "<html><body><script>";
	echo 'window.open("PDF_salida.php?folio='.$_POST['folio'].'", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");';
	echo 'window.location="salida.php"';
	echo "</script></body></html>";
	exit(); 
}elseif(isset($_GET['opcion']) && $_GET['opcion']=='borrar'){
	$q=mysql_query('select * from detalle where id_detalle='.$_GET['id_detalle']);
	$m=mysql_fetch_array($q);
	$b="delete from detalle where id_detalle=".$_GET['id_detalle'];
	mysql_query($b);
	header("Location: salida.php?s_status=2&folio=".$m['id']);
	exit(); 
}else{
	print_r($_POST);
	echo "ERROR CRITICO :FALTA DE VARIABLE";
}
?>