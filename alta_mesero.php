<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
<?php
require("configuraciones.php");
conectar();


session_start();
$registro=$_SESSION['usu'];
$nombre = $_POST	["nombre"];
$ap = $_POST["ap"];
$am = $_POST	["am"];
$tipo = $_POST	["categoria"];

$coins = $_POST ["coins"];
$fecha=$_POST["fechaingreso"];
$cel=$_POST['tm'];
$tcasa=$_POST['tc'];

$email=$_POST['email'];
$estatus=$_POST['estatus'];
$cel=$_POST['tm'];

if($_POST['tipo']=="insertar")
{
 $in="INSERT INTO `Meseros`(`nombre`, `ap`, `am`, `tipo`,  `fechaingreso`, `celular`, `telefono`, `correo`, `estatus`) VALUES 
							   ('".$nombre."','".$ap."','".$am."','".$tipo."','".$fecha."','".$cel."','".$tcasa."','".$email."','".$estatus."')";
mysql_query($in) or die("datos no insertados: " . mysql_error()); 
}
if($_POST['tipo']=="Modificar")
{
	$mod="UPDATE `Meseros` SET 
		`nombre`=	'".$nombre."',
		`ap`=			'".$ap."',
		`am`=			'".$am."',
		`tipo`=			'".$tipo."',
		`nivel`=		'".$nivel."',
		`fechaingreso`= '".$fecha."',
		`celular`=		'".$cel."',
		`telefono`=		'".$tcasa."',
		`comentarios`=	'".$comentarios."',
		`correo`=		'".$email."',
		`estatus`=		'".$estatus."' 
			WHERE id=".$_POST['numero']."";
		mysql_query($mod) or "DATOS NO INSERTADOS ".die(mysql_error());	
}
if($_POST['tipo']=="NCategoria")
{
		echo $Bus="Select * from Configuraciones where descripcion='".$tipo."'";

	if(mysql_num_rows(mysql_query($Bus))>0)
	{
		?>
			<script language="javascript">
			alert("**ERROR**   YA  EXISTE UN REGISTRO CON ESA CATEGORIA DE MESEROS... POR FAVOR VERIFICA TUS DATOS");
			</script>
	<?php 

	}
	else
	{
		// Insertar Nuevo Registro con nueva categoria
	 	$in="INSERT INTO `Meseros`(`nombre`, `ap`, `am`, `tipo`,  `fechaingreso`, `celular`, `telefono`, `correo`, `estatus`) VALUES 
							   ('".$nombre."','".$ap."','".$am."','".$tipo."','".$fecha."','".$cel."','".$tcasa."','".$email."','".$estatus."')";
		mysql_query($in) or die("datos no insertados: " . mysql_error()); 
		
		// Agregar Nomina de Nueva Categoria
		  $N="INSERT INTO `Configuraciones`( `nombre`, `tipo`, `valor`, `descripcion`,`puntos`) 
		VALUES ('Nomina Meseros ".$tipo."','Nomina',".$_POST['monto'].",'".$tipo."',".$_POST['puntos'].")";
		mysql_query($N);
	}
	
}
if($_GET['Eliminar']=="Eliminar")
{
	$del="DELETE FROM `Meseros` WHERE id=".$_GET['numero'];
	mysql_query($del);
}
?> 
<script language="javascript">
alert("registro realizado exitosamente");
location.href='Insert_Meseros.php';
</script>
</body>
</html>