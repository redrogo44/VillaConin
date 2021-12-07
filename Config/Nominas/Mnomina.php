<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
<?php
require("../configuraciones.php");
conectar();

print_r($_POST);
session_start();
$registro=$_SESSION['usu'];
if($_POST['categoria']=="MESERO")
{
	
	echo $up="UPDATE `Configuraciones` SET `valor`=".$_POST['sueldo'].",`puntos`=".$_POST['puntos']." WHERE descripcion='".$_POST['tipo']."'";
	mysql_query($up);
}
?> 
<script language="javascript">
alert("rREGISTRO MODIFICADO EXITOSAMENTE");
location.href="Nominas.php";
</script>
</body>
</html>