<?php
require('../funciones2.php');
conectar();
print_r($_POST);
$dp=mysql_query("SELECT * FROM `producto` WHERE `nombre`='".$_POST['producto']."'");
				$idp=mysql_fetch_array($dp);
				$idpp=$idp['id_producto'];
				$sip=mysql_query('SELECT * FROM `inventario` WHERE id_producto='.$idpp);
				$sipp=mysql_fetch_array($sip);
					echo "hay ".$cpr=$sipp['IR'];
		echo 		"<br>Cantidad= ".$cpr=$cpr+$_POST['cantidad'];
		mysql_query("UPDATE `inventario` SET `IR`=".$cpr." WHERE `id_producto`=".$idpp);
?>