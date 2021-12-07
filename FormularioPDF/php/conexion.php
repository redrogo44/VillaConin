<?php

	$servidor = "localhost";
	$usuario = "sistem68_mbr";
	$contra = "qrodigo44";
	
	$conexion = mysql_connect($servidor, $usuario , $contra) or die ("No hay conexion");
		$db = mysql_select_db("formulariopdf") or die ("No hay conexion");

?>
