<?php
require 'funciones.php';
conectar();

$f1='2015-01-01';
$f2='2015-01-30';
//////////////compras no facturadas
$q="select * from compra where fecha>='".$f1."' and fecha<='".$f2."'";
$r=mysql_query($q);
$total=0;
while($m=mysql_fetch_array($r)){
	$q2="select * from detalle where id=".$m['id_compra']." and tipo='compra' and gasto='no' ";
	$r2=mysql_query($q2);
	while($m2=mysql_fetch_array($r2)){
		$producto=mysql_fetch_array(mysql_query("select * from producto where id_producto=".$m2['id_producto']));
		if(revisar_categoria($producto['id_categoria'])){
			$total=$total+($m2['cantidad']*$m2['precio_adquisicion']*(1+($producto['impuesto']/100)));
		}
	}
	$total=$total-$m['descuento']+$m['iva'];
}
echo "total compras no facturadas:".$total."<br>";
//////////////compras facturadas
$qf="select * from comprafac where fecha>='".$f1."' and fecha<='".$f2."'";
$rf=mysql_query($qf);
$totalf=0;
while($mf=mysql_fetch_array($rf)){
	$qf2="select * from detalle where id=".$mf['id_compra']." and tipo='comprafac' and gasto='no' ";
	$rf2=mysql_query($qf2);
	echo $qf2."<br>";
	while($mf2=mysql_fetch_array($rf2)){
		$productof=mysql_fetch_array(mysql_query("select * from producto where id_producto=".$mf2['id_producto']));
		if(revisar_categoria($productof['id_categoria'])){
			$totalf=$totalf+($mf2['cantidad']*$mf2['precio_adquisicion']*(1+($productof['impuesto']/100)));
		}
	}
	$totalf=$totalf-$mf['descuento']+$mf['iva'];
}
echo "total compras facturadas:".$totalf."<br>";
$total_final=$total+$totalf;
echo $total_final;
//echo $q."<br>".$q2."<br>";
//echo $qf."<br>".$qf2;

function revisar_categoria($ID){
	$e1="select * from categoria where nombre not like '%EQUIPO%'";
	$re=mysql_query($e1);
	$respuesta=false;
	while($cat=mysql_fetch_array($re)){
		if($cat['id_categoria']==$ID){
			$respuesta=true;
		}
	}
	return $respuesta;
}

?>