<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start(); 
require 'funciones2.php';
conectar();
validarsesion();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language=javascript> 
function ventanaSecundaria (){ 
   window.open("logisticaPDF.php") 
} 
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
<?php
	if($_POST['op']=="Modificar"){
		$q="delete from logistica where numero='".$_POST['numero']."'";
		$r=mysql_query($q);
		echo '<meta http-equiv="Refresh" content="0;url=NuevaLogistica.php?numero='.$_POST['numero'].'">';
	}else{
		$hoy=date('Y-m-d');
		if($_POST['c1']>0 && !empty($_POST['c1']) && $_POST['m1']!=""){
			$q="INSERT INTO logistica(numero,producto,cantidad,fecha,usuario) VALUES ('".$_POST['numero']."','".$_POST['m1']."',".$_POST['c1'].",'".$hoy."','".$_SESSION['usu']."')";
			$r=mysql_query($q);
		}
		if($_POST['c2']>0 && !empty($_POST['c2']) && $_POST['m2']!=""){
			$q="INSERT INTO logistica(numero,producto,cantidad,fecha,usuario) VALUES ('".$_POST['numero']."','".$_POST['m2']."',".$_POST['c2'].",'".$hoy."','".$_SESSION['usu']."')";
			$r=mysql_query($q);
		}
		if($_POST['c3']>0 && !empty($_POST['c3']) && $_POST['m3']!=""){
			$q="INSERT INTO logistica(numero,producto,cantidad,fecha,usuario) VALUES ('".$_POST['numero']."','".$_POST['m3']."',".$_POST['c3'].",'".$hoy."','".$_SESSION['usu']."')";
			$r=mysql_query($q);
		}
		if($_POST['c4']>0 && !empty($_POST['c4']) && $_POST['m4']!=""){
			$q="INSERT INTO logistica(numero,producto,cantidad,fecha,usuario) VALUES ('".$_POST['numero']."','".$_POST['m4']."',".$_POST['c4'].",'".$hoy."','".$_SESSION['usu']."')";
			$r=mysql_query($q);
		}
		for($i=1;$i<=$_POST['actividades'];$i++)
		{
			echo $_SESSION["hora".$i.""]=$_POST["inicio".$i.""];
			echo $_SESSION["fin".$i.""]=$_POST["fin".$i.""];
			echo $_SESSION["actividad".$i.""]=$_POST["actividad".$i.""];
			
		}
		echo $_SESSION['actividades']=$_POST['actividades'];
		 $_SESSION['menu']=$_POST['menu'];$_SESSION['ninos']=$_POST['ninos'];
		 $_SESSION['observaciones']=$_POST['observaciones'];$_SESSION['seradicionales']=$_POST['seradicionales'];
		 $_SESSION['FESTEJADOS']=$_POST['festejados'];

		
		echo "<script>
		window.open('logisticaPDF.php');
		alert('Registro de manteleria exitoso');
		</script>";
		
		echo '<meta http-equiv="Refresh" content="0;url=BuscarContrato.php">';
	}
?>
</body>
</html>

