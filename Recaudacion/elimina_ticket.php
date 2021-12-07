<?php
require('../funciones2.php');
conectar();
//print_r($_POST);
if($_POST['tipo']=='vinos')
{
	$v="UPDATE `tickets_vinos` SET `estatus`='CANCELADO' WHERE id=".$_POST['id'];
	$s=mysql_query("SELECT * FROM tickets_vinos WHERE id_ticket=".$_POST['id']);
	$st=mysql_fetch_array($s);
	$producto=explode(",", $st['productos']);
	$cantidad=explode(",", $st['cantidades']);
	for($i=1;$i<count($producto);$i++)
	{
		$dp=mysql_query("SELECT * FROM `producto` WHERE `nombre`='".$producto[$i]."'");
		$idp=mysql_fetch_array($dp);
		$idpp=$idp['id_producto'];
		$sip=mysql_query('SELECT * FROM `inventario` WHERE id_producto='.$idpp);
		$sipp=mysql_fetch_array($sip);
		$cpr=$sipp['IR'];
		$cpr=$cpr+$cantidad[$i];
		mysql_query("UPDATE `inventario` SET `IR`=".$cpr." WHERE `id_producto`=".$idpp);		
	}
				
	mysql_query($v);
	echo "vino";
}
else if ($_POST['tipo']=='alimentos') 
{
	mysql_query("UPDATE `tickets` SET `estatus`='CANCELADO' WHERE id=".$_POST['id']);
	echo "alimento";
}
?>