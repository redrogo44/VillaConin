<?php
require('../funciones2.php');
conectar();

	//print_r($_POST);
 $cm="SELECT * FROM Categorias_menu WHERE nombre='".$_POST['nombre']."' ";
	$m=mysql_query($cm);
	if (mysql_num_rows($m)>0) {
		$me=mysql_fetch_array($m);
		echo $me['nombre']." ".$me['descripcion'];
	}
	else
	{
		echo "no existe";
	}
	
		
	
?>