<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
<?php
session_start();
REQUIRE 'funciones2.php';
$registro=$_POST['vendedor'];
$fdr= date("y/m/d H:i:s");
$nombre = $_POST["nom"]; 
$ap = $_POST["ap"]; 
$am = $_POST["am"]; 
$fecha = $_POST["fecha"]; 
$invitados = $_POST["comenzales"];
$telefono = $_POST["tel"];
$mail = $_POST["mail"]; 
$tipo = $_POST["tipo"];
$medio = $_POST["medio"]; 
conectar();
$insertar=mysql_query("INSERT INTO preregistro (nombre,ap,am,fecha,invitados,telefono,mail,tipo,medio,registro,fdr)  VALUES ('$nombre','$ap','$am','$fecha','$invitados','$telefono','$mail','$tipo','$medio','$registro','$fdr')");
if (!$insertar) { 
die("datos no insertados: " . mysql_error()); 
}


?> 


<script language="javascript">
alert("registro exitoso");
location.href='index.php';
</script>

  

</body>
</html>