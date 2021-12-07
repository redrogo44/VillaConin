<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
<?php
session_start();
require("funciones2.php");
conectar();

$registro=$_SESSION['usu'];
$producto = $_POST	["produ"];
$descripcion = $_POST["desc"];
$cantidad = $_POST	["cant"];
$precio = $_POST	["prec"];
$costo = $_POST		["cost"];

$conexion=mysql_query("INSERT INTO TInventarios (producto,descripcion,cantidad,precio,costo) VALUES
	('$producto','$descripcion','$cantidad','$precio','$costo')",$conexion);
if ($insertar) { 
	
die("datos no insertados: " . mysql_error()); 
}
?> 
<script language="javascript">
alert("registro exitoso");
location.href='index.php';
</script>
</body>
</html>