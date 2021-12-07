<?php
require("../../configuraciones.php");
conectar();

function busca_e($tipo,$text)
{
	$R="SELECT * FROM Empleados WHERE ".$tipo."='".$text."'"
	$e=mysql_query($R);
return $R;
}
?>