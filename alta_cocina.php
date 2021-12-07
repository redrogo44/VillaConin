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
$producto = $_POST	["nomen"];
$descripcion = $_POST["desc"];
$tipo = $_POST	["tipo"];
$buenestado = $_POST	["bue"];
$malestado = $_POST		["mal"];
$total = $_POST ["bue"]+ $_POST	["mal"];
$comentarios = $_POST ["com"];	
print_r($_POST);

$conexion=mysql_query("INSERT INTO TManteleria (producto,descripcion,tipo,buenestado,malestado,total,comentarios) VALUES
	('$producto','$descripcion','$tipo','$buenestado','$malestado','$total','$comentarios')",$conexion);
if ($insertar) { 
	
die("datos no insertados: " . mysql_error()); 
}
?> 
<script language="javascript">
alert("registro realizado exitosamente");
location.href='index.php';
</script>
</body>
</html>