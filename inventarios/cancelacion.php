<?php
require 'funciones.php';
conectar();
session_start();
date_default_timezone_set("America/Monterrey");
//print_r($_GET);
if($_GET['tabla']=='comprafac'){
	$_GET['tabla']='compra';
	$var='si';
	$datos_compra=mysql_fetch_array(mysql_query("select * from comprafac where id_compra=".$_GET['folio']));
	$cuenta=$datos_compra["cuenta"];
	$importe_compra=mysql_fetch_array(mysql_query("select sum(importe) as t from detalle where id=".$_GET["folio"]." and tipo='comprafac'"));
	$total=$importe_compra["t"]-$datos_compra["descuento"]+$datos_compra["iva"];
	/*//obtenemos los datos de la cuenta para devolver el dinero
	$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$cuenta));
	$insert_cancelacion_compra=mysql_query("insert into Movimientos_Cuentas(fecha,banco_emisor,cuenta_emisor,banco_receptor,cuenta_receptora,cantidad, concepto) values('".date('Y-m-d')."','cancelacion_comprafac','cancelacion_comprafac','".$obtener_cuenta["banco"]."','".$obtener_cuenta["id"]."',".$total.",'cancelacion_comprafac')");*/
	$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$cuenta));
	$upMC="update Movimientos_Cuentas set estatus='suspendido' where facturado='1' and referencia=".$_GET['folio']." and concepto='compra'";
	mysql_query($upMC);
	///actualizamos saldo final de la cuenta restandole lo devuelto al cliente ya viene en negativo por eso se suma 
	$saldo_actual_cuenta=$obtener_cuenta["saldo_final"]+$total;
	$actualiza_saldo_cuenta=mysql_query("update Cuentas set saldo_final=".$saldo_actual_cuenta." where id=".$cuenta);
	

}else if($_GET['tabla']=='compra'){
	$var='no';
	
	$datos_compra=mysql_fetch_array(mysql_query("select * from compra where id_compra=".$_GET['folio']));
	$cuenta=$datos_compra["cuenta"];
	$importe_compra=mysql_fetch_array(mysql_query("select sum(importe) as t from detalle where id=".$_GET["folio"]." and tipo='compra'"));
	$total=$importe_compra["t"]-$datos_compra["descuento"]+$datos_compra["iva"];
	/*//obtenemos los datos de la cuenta para devolver el dinero
	$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$cuenta));
	$insert_cancelacion_compra=mysql_query("insert into Movimientos_Cuentas(fecha,banco_emisor,cuenta_emisor,banco_receptor,cuenta_receptora,cantidad, concepto) values('".date('Y-m-d')."','cancelacion_compra','cancelacion_compra','".$obtener_cuenta["banco"]."','".$obtener_cuenta["id"]."',".$total.",'cancelacion_compra')");*/
	$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$cuenta));
	$upMC="update Movimientos_Cuentas set estatus='suspendido' where facturado='0' and referencia=".$_GET['folio']." and concepto='compra'";
	mysql_query($upMC);
	///actualizamos saldo final de la cuenta restandole lo devuelto al cliente ya viene en negativo por eso se suma 
	$saldo_actual_cuenta=$obtener_cuenta["saldo_final"]+$total;
	$actualiza_saldo_cuenta=mysql_query("update Cuentas set saldo_final=".$saldo_actual_cuenta." where id=".$cuenta);

}else if($_GET['tabla']=='venta'){
	
	$datos_compra=mysql_fetch_array(mysql_query("select * from venta where id_venta=".$_GET['folio']));
	$cuenta=$datos_compra["cuenta"];
	$importe_compra=mysql_fetch_array(mysql_query("select sum(importe) as t from detalle where id=".$_GET["folio"]." and tipo='venta'"));
	$total=$importe_compra["t"];
	/*//obtenemos los datos de la cuenta para devolver el dinero
	$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$cuenta));
	$insert_cancelacion_compra=mysql_query("insert into Movimientos_Cuentas(fecha,banco_emisor,cuenta_emisor,banco_receptor,cuenta_receptora,cantidad, concepto) values('".date('Y-m-d')."','cancelacion_venta','cancelacion_venta','".$obtener_cuenta["banco"]."','".$obtener_cuenta["id"]."',".$total.",'cancelacion_venta')");
	*/
	$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$cuenta));
	$upMC="update Movimientos_Cuentas set estatus='suspendido' where facturado='0' and referencia=".$_GET['folio']." and concepto='venta'";
	mysql_query($upMC);
	///actualizamos saldo final de la cuenta restandole lo devuelto al cliente ya viene en negativo por eso se suma 
	$saldo_actual_cuenta=$obtener_cuenta["saldo_final"]+$total;
	$actualiza_saldo_cuenta=mysql_query("update Cuentas set saldo_final=".$saldo_actual_cuenta." where id=".$cuenta);
	
	
}





?>
<html>
<head>
<script>
window.opener.location.reload();
</script>
</head>
<body onload='redireccionar();'>
<script>
window.open("PDF_<?php echo $_GET['tabla'];?>.php?tabla=<?php echo $_GET['tabla'];?>&folio=<?php echo $_GET['folio'];?>&cancelacion=1&type=<?php echo $var; ?>", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
window.close();
</script>
</body>
<html>