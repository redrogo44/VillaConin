<?php
require('../funciones2.php');
conectar();
$se="SELECT * FROM `Eventos_Recaudacion` WHERE Numero='".$_POST['contrato']."'";
$x=mysql_query($se);
$co=mysql_fetch_array($x);
if($co['corte']=='si')
{
	echo 'si';
}
else
{echo 'no';}

?>