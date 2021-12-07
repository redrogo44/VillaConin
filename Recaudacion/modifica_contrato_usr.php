<?php
	require("../funciones2.php");
	conectar();
	$bandera=0;
//print_r($_POST);
$R="UPDATE usuarios  SET  `Contrato`='".$_POST['contrato']."' WHERE nombre='".$_POST['nombre']."' and usuario='".$_POST['usuario']."' ";
	$us=mysql_query($R);
	echo "REGISTRO EXITOSO";
	
?>