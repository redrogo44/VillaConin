<?php
require 'funciones.php';
session_start();
conectar();
date_default_timezone_set("America/Monterrey");
$hoy=date('Y-m-d');
$hora=date('H:m:s');
$_SESSION['facturado']=$_POST['facturado'];
//print_r($_POST);
//print_r($_SESSION); 
///////////insertar compra
$proveedor=mysql_fetch_array(mysql_query("select * from proveedor where nombre='".$_POST['proveedor']."'"));
$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$_POST['cuenta']));


///validamos que tengamos la informacion de la cuenta si no es asi mostramos errar
if(!isset($obtener_cuenta["id"]) || empty($obtener_cuenta["id"])){
	echo "<html>";
	echo "<head>
		<script>
			function r(){
				if(confirm('Erro: Tiempo de espera terminado, No se encuentra la forma de pago o es nula id=".$obtener_cuenta["id"]."')){
					 window.location='compras.php';
				}else{
					window.location='compras.php';
				}
			}
		</script>";
	echo "</head>";
	echo "<body onload='r()'><body>";
	echo "</html>";
	
}else{
$compra='';
if($_POST['facturado']=='si'){
	$q="INSERT INTO comprafac(fecha,descuento,id_proveedor,iva,formapago,cuenta,hora) 
	VALUES ('".$hoy."',".$_POST['descuento'].",".$proveedor['id_proveedor'].",".$_POST['iva'].",'".$_POST['formapago']."','".$_POST['cuenta']."','".$hora."')";
	$compra='comprafac';
	$banMov="1";
}else{
	$q="INSERT INTO compra(fecha,descuento,id_proveedor,iva,formapago,cuenta,hora) 
	VALUES ('".$hoy."',".$_POST['descuento'].",".$proveedor['id_proveedor'].",".$_POST['iva'].",'".$_POST['formapago']."','".$_POST['cuenta']."','".$hora."')";
	$compra='compra';
	$banMov="0";
}
	mysql_query($q);
	
	$id_compra=mysql_fetch_array(mysql_query("select max(id_compra) as max from ".$compra));
	$cantidad=explode(",",$_POST['lista_cantidad']);
	$prooduct=explode(",",$_POST['lista_productos']);
	$costo=explode(",",$_POST['lista_costo']);
	$impuesto=explode(",",$_POST['lista_impuesto']);	
	$gasto=explode(",",$_POST['lista_gasto']);	
	$acumulado_MC=0;
	for($i=0;$i<count($cantidad);$i++){
		if($cantidad[$i]!=''){
			$producto=mysql_fetch_array(mysql_query("select * from producto where nombre='".$prooduct[$i]."'"));
			$categoria=mysql_fetch_array(mysql_query("select * from categoria where id_categoria=".$producto['id_categoria']));
			////////////////importe que contendra el iva si es facturado
			$import=($cantidad[$i]*$costo[$i])*(1+($impuesto[$i]/100));
			$acumulado_MC=$acumulado_MC+$import;
            /*if($compra=='comprafac'){
				$import=($cantidad[$i]*$costo[$i])*(1+($impuesto[$i]/100));
			}else{
				$import=($cantidad[$i]*$costo[$i]);
			}*/
			/////////////////si el produto es del tipo personal
			if($categoria['tipo']=='PERSONAL'){
				$qd="INSERT INTO detalle(id,cantidad,id_producto,precio_adquisicion,precio_venta,importe,tipo,gasto)
				VALUES (".$id_compra['max'].",".$cantidad[$i].",".$producto['id_producto'].",".$costo[$i].",0,".$import.",'".$compra."','si')";
				$up=mysql_query("update producto set impuesto=".$impuesto[$i]." where id_producto=".$producto['id_producto']);
				$up2=mysql_query("update inventario set precio=".$costo[$i]." where id_producto=".$producto['id_producto']); 
				mysql_query($qd);
			}else{
				$qd="INSERT INTO detalle(id,cantidad,id_producto,precio_adquisicion,precio_venta,importe,tipo,gasto)
				VALUES (".$id_compra['max'].",".$cantidad[$i].",".$producto['id_producto'].",".$costo[$i].",0,".$import.",'".$compra."','".$gasto[$i]."')";
				$up=mysql_query("update producto set impuesto=".$impuesto[$i]." where id_producto=".$producto['id_producto']);
				$up2=mysql_query("update inventario set precio=".$costo[$i]." where id_producto=".$producto['id_producto']);
				mysql_query($qd);
			}
		}
	}

	$acumulado_MC=$acumulado_MC-$_POST['descuento']+$_POST['iva'];

	////insercion en movimientos cuentas
		//$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$_POST['cuenta']));
		$insert_abono=mysql_query("insert into Movimientos_Cuentas(fecha,banco_emisor,cuenta_emisor,banco_receptor,cuenta_receptora,cantidad, concepto,facturado,referencia) values('".date('Y-m-d')."','".$obtener_cuenta["banco"]."','".$obtener_cuenta["id"]."','compra','compra',".$acumulado_MC.",'compra','".$banMov."',".$id_compra['max'].")");
		
	///actualizamos saldo final de la cuneta sumandole el abonos 
		$saldo_actual_cuenta=$obtener_cuenta["saldo_final"]-$acumulado_MC;
		$actualiza_saldo_cuenta=mysql_query("update Cuentas set saldo_final=".$saldo_actual_cuenta." where id=".$_POST['cuenta']);
		
		
	
	echo "<html><body><script>";
	echo 'window.open("PDF_compra.php?folio='.$id_compra['max'].'&type='.$_POST['facturado'].'", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");';
	echo 'window.location="compras.php"';
	echo "</script></body></html>";
	
}
?>