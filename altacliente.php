<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'funciones2.php';
conectar();
validarsesion();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Villa conin</title>
</head>
<body>
<?php
session_start();
$registro=$_SESSION['usu'];
$fdr= date("y/m/d H:i:s");
$nombre = $_POST["nom"]; 
$ap = $_POST["ap"]; 
$am = $_POST["am"]; 
$mail = $_POST["mail"]; 
$rfc =strtoupper($_POST["rfc"]); 
$pg1 = $_POST["pg1"]; 
$dcom = $_POST["otro1"]; 
$dom = $_POST["dom"];
$cp = $_POST["cp"]; 
$tel = $_POST["tel"];
$id=$_POST["id"];
$tipo = $_POST["tipo"];
$medio = $_POST["medio"]; 

$q="select count(*) as t from cliente where rfc='".$rfc."'";
$r=mysql_query($q);
$m=mysql_fetch_array($r);
if($m['t']<1){
	$insertar=mysql_query("INSERT INTO cliente (nombre,ap,am,mail,rfc,regimen,dcom,dom,cp,tel,registro,fdr)  VALUES ('$nombre','$ap','$am','$mail','$rfc','$pg1','$dcom','$dom','$cp','$tel','$registro','$fdr')");
	$guardar=mysql_query("select * from preregistro where id='".$id."'");
	$nc=mysql_fetch_array(mysql_query("select max(id) as id from cliente"));
	mysql_query("update presupuesto set id_cliente=".$nc["id"]." where id_precliente=".$id);
	$guardar2=mysql_fetch_array($guardar);
	$fr=explode(' ',$guardar2['fdr']);
	$guardar3=mysql_query("insert into eliminados(fecha_registro,cliente,vendedor,tipo,medio_contacto,estatus) values('".$fr[0]."','".$guardar2['nombre']."','".$guardar2['registro']."','".$guardar2['tipo']."','".$guardar2['medio']."','cliente')");
	$borrar=mysql_query("delete from preregistro where id='".$id."'");
	}else{
		echo '<script language="javascript">
		alert("ERROR YA EXISTE CLIENTE CON MISMO RFC");
		location.href="http:index.php";
		</script>';
	}
?> 

<script language="javascript">
alert("registro exitoso");
location.href='http:index.php';
</script>

  

</body>
</html>
