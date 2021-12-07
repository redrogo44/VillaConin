<?php
require 'funciones.php';
session_start();
conectar();
date_default_timezone_set("America/Monterrey");
//print_r($_POST);

if($_GET['etapa']==1){
////validacion de ultimo folio
	$max=mysql_query("select max(id_venta) as max from venta");
	$m=mysql_fetch_array($max);
	if($m['max']!=''){////////comparamos que sea el primer registro
		$det=mysql_query("select count(*) as c from detalle where id=".$m['max']." and tipo='venta'");
		$c_detalle=mysql_fetch_array($det);
		if($c_detalle['c']<=0){
			$delete=mysql_query("delete from venta where id_venta=".$m['max']);
			$act=mysql_query("ALTER TABLE venta AUTO_INCREMENT=".$m['max']);
		}
	}
	$q=mysql_query("insert into venta (fecha,hora) values('".date('Y-m-d')."','".date('H:i:s')."')");
	$f=mysql_query("select max(id_venta) as folio from venta");
	$nuevo_folio=mysql_fetch_array(mysql_query("select max(id_venta) as m from venta"));
	$_SESSION['folio_venta']=$nuevo_folio['m'];
	$folio=mysql_fetch_array($f);
	header("Location: venta.php?etapa=2&folio=".$folio['folio']);
	exit(); 
}elseif($_POST['etapa']==2 && $_POST['opcion']=='Guardar'){
	$p=mysql_query("select * from producto where nombre='".$_POST['producto']."'");
	$producto=mysql_fetch_array($p);
	$inv=mysql_query("select * from inventario where id_producto=".$producto['id_producto']);
	$inventario=mysql_fetch_array($inv);
	$importe=$_POST['cantidad']*$inventario['precio_venta'];
	$in=mysql_query("insert into detalle(id,cantidad,id_producto,precio_adquisicion,precio_venta,importe,tipo)values(".$_POST['folio'].",".$_POST['cantidad'].",".$producto['id_producto'].",".$inventario['precio'].",".$inventario['precio_venta'].",".$importe.",'venta')");
	header("Location: venta.php?etapa=2&folio=".$_POST['folio']);
}elseif($_POST['etapa']==2 && $_POST['opcion']=='Siguiente'){
	header("Location: venta.php?etapa=3&folio=".$_POST['folio']);
}elseif($_POST['etapa']==3 && $_POST['opcion']=='Finalizar'){
	$_SESSION['folio_venta']=0;
	echo "update venta set formapago='".$_POST['formapago']."',cuenta='".$_POST['cuenta']."' where id_venta=".$_POST['folio'];
	$finalizar=mysql_query("update venta set formapago='".$_POST['formapago']."',cuenta='".$_POST['cuenta']."' where id_venta=".$_POST['folio']);
	echo "<html><body><script>";
	echo 'window.open("PDF_venta.php?folio='.$_POST['folio'].'", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");';
	echo 'window.location="venta.php"';
	echo "</script></body></html>";
	
	$total_venta=mysql_fetch_array(mysql_query("select sum(importe) as t from detalle where id=".$_POST['folio']." and tipo='venta'"));
	
	////insercion en movimientos cuetas
		$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$_POST['cuenta']));
		$insert_abono=mysql_query("insert into Movimientos_Cuentas(fecha,banco_emisor,cuenta_emisor,banco_receptor,cuenta_receptora,cantidad, concepto,referencia) values('".date('Y-m-d')."','venta','venta','".$obtener_cuenta["banco"]."','".$obtener_cuenta["id"]."',".$total_venta["t"].",'venta',".$_POST['folio'].")");
		
	///actualizamos saldo final de la cuneta sumandole el abonos 
		$saldo_actual_cuenta=$obtener_cuenta["saldo_final"]+$total_venta["t"];
		$actualiza_saldo_cuenta=mysql_query("update Cuentas set saldo_final=".$saldo_actual_cuenta." where id=".$_POST['cuenta']);
	
	header("Location: venta.php");
}elseif($_GET['opcion']=='Borrar'){
	$delete=mysql_query("delete from detalle where id_detalle=".$_GET['id']);
	header("Location: venta.php?etapa=2&folio=".$_GET['folio']);
}else{
	echo "existe un error critico en la validacion de la venta";
	//header("Location: venta.php");
	}
?>