<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start(); 
require 'funciones2.php';
conectar();
validarsesion();
$nivel=$_SESSION['niv'];
if($nivel==0)
{
menunivel0();				
}
if($nivel==1)
{
menunivel1();				
}
if($nivel==2)
{
menunivel2();
}
if($nivel==3)
{
menunivel3();
}
if($nivel==4)
{
menunivel4();
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<meta http-equiv="refresh" content="0; url=http:index.php" />
<?PHP

 

if($_GET['tipo']="Eliminar"&&$_POST['tipo']!="Modificar")
{
	echo "ENTRO A ELIMINAR";
	 $delete="DELETE FROM `TManteleria` WHERE id=".$_GET['numero'];
		mysql_query($delete) or die(mysql_error());
	$mensaje .= '<script name="accion">alert("SE ELIMINO CORRECTAMENTE ") </script>';

//por último checamos si hubo algún error
	if($mensaje != "")
	{
		echo $mensaje;
	}
}

 else if($_POST['tipo']="Modificar")
{
	echo "Entro a modificacion";
	$cons=mysql_query("Select ");
		  $nomen=$_POST['nomenclatura'];
		$des=$_POST['descripcion'];
		$be=$_POST['buenestado'];
		 $me=$_POST['malestado'];
		 $com=$_POST['comentarios'];
	   // BUSCAMOS MANTELES SELECCIONADOS
	   $cadenamanteles;$contador=0;
				for($i=1;$i<=65;$i++)
				{ 
					if($_POST[$i]=="")
						{}
					else 
						{
							$cadenamanteles=$cadenamanteles.$_POST[$i].",";
							$manteles[$contador] = $_POST[$i];  
							$contador++;
						
						}
				}
				 $cadenamanteles;
	 			$total=$be+$me;

	$q="UPDATE TManteleria SET producto='".$nomen."', descripcion ='".$des."', buenestado =".$be.", malestado =".$me.", total=".$total.", comentarios='".$com."' WHERE id=".$_POST['numero'];
	$co=mysql_query($q) or die(mysql_error());
}
else{echo "NO ENTRO A NINGUN LADO";}
?>
<script>
function cargar() {
	window.open("http:logisticaPDF.php");
}
</script>
</head> 
<body >
</body>
</html>

