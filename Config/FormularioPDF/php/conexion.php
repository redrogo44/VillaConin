<?php

	$servidor = "localhost";
	$usuario = "mbrsoluc_villaco";
	$contra = "}g8T^Tm7xesi";
	
	$conexion = mysql_connect($servidor, $usuario , $contra) or die ("No hay conexion");
		$db = mysql_select_db("formulariopdf") or die ("No hay conexion");

?>
