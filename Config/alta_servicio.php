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
//print_r($_POST);
session_start();
$registro=$_SESSION['usu'];
$servicio=$_POST['servicio'];
$descripcion=$_POST['descripcion'];
$categoria=$_POST['categoria'];
$precio=$_POST['precio'];

if($_POST['tipo']=='insertar')
{	
    /*/////////buscamos si en la formula existe el manejo de comensales
     $_POST['formula']=strtolower($_POST['formula']);
    $cadena_de_texto = $_POST['formula'];
    $cadena_buscada   = 'comensales';
    $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada)
 
//se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
    if ($posicion_coincidencia === false) {
       $in="INSERT INTO `Servicios`(Servicio, descripcion, tipo, precio,unidad,formula,tipo_calculo) VALUES('".strtoupper($servicio)."','".$descripcion."','".$categoria."',".$precio.",'".$_POST['unidad']."','".$_POST['formula']."','OTRO')";
		mysql_query($in) or die("datos no insertados: " . mysql_error()); 
    } else {
         $in="INSERT INTO `Servicios`(Servicio, descripcion, tipo, precio,unidad,formula,tipo_calculo) VALUES('".strtoupper($servicio)."','".$descripcion."','".$categoria."',".$precio.",'".$_POST['unidad']."','".$_POST['formula']."','COMENSAL')";
		mysql_query($in) or die("datos no insertados: " . mysql_error()); 
    }   */
    
    $in="INSERT INTO `Servicios`(Servicio, descripcion, tipo, precio,unidad) VALUES('".strtoupper($servicio)."','".$descripcion."','".$categoria."',".$precio.",'".$_POST['unidad']."')";
		mysql_query($in) or die("datos no insertados: " . mysql_error()); 
    
}

if($_POST['tipo']=="Modificar")
{
    
    $up="UPDATE Servicios SET Servicio='".strtoupper($servicio)."',descripcion='".$descripcion."',tipo='".$categoria."',precio=".$precio.",unidad='".$_POST['unidad']."'  WHERE id=".$_POST['id'];	
	mysql_query($up); 
    
    $redireccionar="Conf_Servicios.php";
    
}

if($_GET['Eliminar']=="Eliminar")
{
	$del="DELETE FROM `Servicios` WHERE id=".$_GET['numero'];
	mysql_query($del);
}
?> 
<script language="javascript">
//alert("registro realizado exitosamente");
<?php
    if(!isset($redireccionar)){
        echo "location.href='Conf_Servicios.php'";
    }else{
        echo "location.href='".$redireccionar."'";
    }
?>

</script>
</body>
</html>