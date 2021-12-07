<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
<?php
require 'funciones2.php';
conectar();
session_start();
$registro=$_SESSION['usu'];
$producto = $_POST	["nomen"];
$descripcion = $_POST["desc"];
$tipo = $_POST	["tipo"];
$buenestado = $_POST	["bue"];
$malestado = $_POST		["mal"];
$total =  $_POST["bue"]+$_POST["mal"];
$costo = $_POST ["cost"];
$precio = $_POST ["pre"];
$comentarios = $_POST ["com"];


/////////////////////////7
////////	 COMPARAR NOMENCLATURAS
$Existe_numero="select count(producto)'c' from TManteleria where producto='".$producto."'";
$res_existe=mysql_query($Existe_numero);
$mbr=mysql_fetch_array($res_existe);
$ex=$mbr['c'];
if($ex>0){
			echo " 

			<script language='javascript'> 
		
			alert('YA EXISTE UNA NOMENCLATURA ASI, FAVOR DE VERIFICAR LOS DATOS'); 
			
			window.location='http:insert_manteleria.php';
			</script> 			
	
		";
		}


else{

////////////////////77//
$is="INSERT INTO TManteleria (producto,descripcion,tipo,buenestado,malestado,total,costo,precio,comentarios) VALUES('".$producto."','".$descripcion."','".$tipo."',".$buenestado.",".$malestado.",".$total.",".$costo.",".$precio.",'".$comentarios."')";
mysql_query($is) or	 die("datos no insertados: " . mysql_error()); 
}
?> 
<script language="javascript">
alert("registro de manteleria exitoso");
location.href='index.php';
</script>
</body>
</html>