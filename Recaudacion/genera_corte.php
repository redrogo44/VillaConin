<?php
require('../funciones2.php');
conectar();


		echo $qd="SHOW TABLE STATUS LIKE 'venta'";
		$r=mysql_query($qd);
		$muestra=mysql_fetch_array($r);
echo "<br>".$tti="SELECT * FROM tickets_vinos WHERE referencia='".$_GET['numero']."' and estatus='ACTIVO'";
$t=mysql_query($tti);
$productos='';$cantidades='';$totales='';$descripciones='';
while($ti=mysql_fetch_array($t))
{
	$producto=explode(",",$ti['productos']);
	$descripcion=explode(",",$ti['descripciones']);
	$cantidad=explode(",",$ti['cantidades']);
	$total=explode(",",$ti['totales']);
	
	for($i=0;$i<count($producto);$i++)
	{
		$productos=$productos.",".$producto[$i];	
		$descripciones=$descripciones.",".$descripcion[$i];
		$cantidades=$cantidades.",".$cantidad[$i];
		$totales=$totales.",".$total[$i];	
	}
}
$produ=explode(",",$productos);
	$des=explode(",",$descripciones);
	$canti=explode(",",$cantidades);
	$tot=explode(",",$totales);

for($j=2;$j<count($produ);$j++)
{
	echo	$pp="select * from producto where nombre='".$produ[$j]."'";
	$p=mysql_query($pp);
	$producto=mysql_fetch_array($p);
	$inv=mysql_query("select * from inventario where id_producto=".$producto['id_producto']);
	$inventario=mysql_fetch_array($inv);
	$importe=$canti[$j]*$inventario['precio_tienda'];
echo	"<br>".$det="insert into detalle(id,cantidad,id_producto,precio_adquisicion,precio_venta,importe,tipo)values(".$muestra['Auto_increment'].",".$canti[$j].",".$producto['id_producto'].",".$inventario['precio'].",".$inventario['precio_tienda'].",".$importe.",'venta')";
$in=mysql_query($det);
}
$q=mysql_query("insert into venta (`fecha`, `formapago`, `cuenta`, `hora`) values('".date('Y-m-d')."','EFECTIVO','','".date('H:i:s')."')");


$idDetalle=mysql_fetch_array(mysql_query("SELECT MAX(id_venta) FROM venta"));

// 	CAMPOS O AFECTACIONES EN CUENTAS Y MOVIMIENTOS FINANCIEROS
// 	
$total_venta=mysql_fetch_array(mysql_query("select sum(importe) as t from detalle where id=".$muestra['Auto_increment']." and tipo='venta'"));

$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=2"));
$insert_abono=mysql_query("insert into Movimientos_Cuentas(fecha,banco_emisor,cuenta_emisor,banco_receptor,cuenta_receptora,cantidad, concepto) values('".date('Y-m-d')."','venta','venta','".$obtener_cuenta["banco"]."','".$obtener_cuenta["id"]."',".$total_venta["t"].",'venta')");

///actualizamos saldo final de la cuneta sumandole el abonos 
		$saldo_actual_cuenta=$obtener_cuenta["saldo_final"]+$total_venta["t"];
		$actualiza_saldo_cuenta=mysql_query("update Cuentas set saldo_final=".$saldo_actual_cuenta." where id=".$_POST['cuenta']);
		
echo "<script>
		window.open('PDFcorte.php?numero=".$_GET['numero']."', '_blank');
		window.close();
	</script>";

?>