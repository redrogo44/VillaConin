<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

<?php
require 'funciones2.php';
session_start();
$id = $_POST['id'];
$nomc=$_POST['nom'];
$ap=$_POST['ap'];
$am=$_POST['am'];
$mail=$_POST['mail'];
$rfc=$_POST['rfc'];
$rgm=$_POST['regimen'];						
$dcom=$_POST['comercial'];
$dom=$_POST['dom'];
$cp=$_POST['cp'];
$tel=$_POST['tel'];	
conectar();

$update=mysql_query("UPDATE cliente SET nombre = '".$nomc."' ,ap = '".$ap."',am ='".$am."',mail ='".$mail."',rfc ='".$rfc."', regimen = '".$rgm."', dcom = '".$dcom."', dom = '".$dom."', cp = '".$cp."', tel='".$tel."' where id = '".$id."'");
if (!$update) { 
die("Datos no Actualizados: " . mysql_error()); 
}
?> 
<script language="javascript">
alert("Actualizacion exitosa");
location.href='BuscarCliente.php';
</script>
</body>
</html>