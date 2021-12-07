<?php
require('../funciones2.php');
conectar();

$p=mysql_query("SELECT * FROM producto WHERE id_categoria=1");
$numax=0;
while($pr=mysql_fetch_array($p))
{
	echo  "<br>".$pr['nombre']." ".$pr['descripcion']."<br>";

		$nom=$pr['nombre'];
		$l=strlen($nom);
		$rest = substr($nom,0 ,-($l-2));
		echo $nom="10".$pr['id_categoria'].$numax;
		$numax++;
		echo "<br>";

		mysql_query("UPDATE `producto` SET `codigo`='".$nom."' WHERE `id_producto`=".$pr['id_producto']);
	echo "<script>	
				window.open('codigos/index.php?codigo=".$nom."', '_blank', 'width=200, height=100');								
		</script>";
}
?>