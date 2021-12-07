<?php
require('../funciones2.php');
conectar();
$c=mysql_query("SELECT * FROM `Subcategoria_menu` WHERE `id_categoria`=".$_POST['id']);
$a='';
while($t=mysql_fetch_array($c))
{
	$a=$t['id']."-".$t['nombre']."-".$t['descripcion'].",".$a;
}
echo $a;
?>