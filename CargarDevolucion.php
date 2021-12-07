<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
session_start();
require 'funciones2.php';
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
<meta http-equiv="refresh" content="0; url=index.php"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cancelacion del Cargo</title>
			


<?php
conectar();
session_start(); 



print_r($_POST)."<br>";
///////////////7  VALORES //////////////////////7

$id=$_POST['Numero'];

for($i=0;$i<count($_POST);$i++)
{
	if(isset($_POST['concepto'.$i]))
	{
	$Concepto=$Concepto.",".$_POST['concepto'.$i];  // Tomamos todos los Conceptos
	}
	if(isset($_POST['cantidad'.$i]))
	{
	$Cantidades=$Cantidades.",".$_POST['cantidad'.$i]; // Tomamos Todas las Cantidades
	}
	if(isset($_POST['precio'.$i])&&$_POST['cantidad'.$i])
	{
	$Precios=$Precios.",".$_POST['precio'.$i];	
	$Totales=$Totales.",".($_POST['precio'.$i]*$_POST['cantidad'.$i]);
	$Totalcargos=$Totalcargos+($_POST['precio'.$i]*$_POST['cantidad'.$i]);
	}
}

echo "Es nulo ".is_null($Totalcargos);
if(is_null($Totalcargos))
{
	$Totalcargos=0;
}
//////////////////////////////////////////////////////////////7

//Byscar Deposito inicial
$BD="select * from contrato where Numero='".$id."'";
$consulta=mysql_query($BD);	
while($can=mysql_fetch_array($consulta)){
	$deposito=$can['deposito'];
	}
	
echo "Total a Devolver = ".$TotalDevolucion=$deposito-$Totalcargos;
$hoy=date('Y-m-d');
echo $inser="INSERT INTO TDevoluciones(Numero, DepositoInicial, Cargos, Total,Fecha,Usuario,Descripcion,estatus,Precios,Cantidades) VALUES ('".$id."',".$deposito.",".$Totalcargos.",".$TotalDevolucion.",'".$hoy."','".$_SESSION['usu']."','".$Concepto."','0','".$Precios."','".$Cantidades."')";
$consulta2=mysql_query($inser);
$_SESSION['Numero'] = $id; 
// Insertar Tabla CargosCancelados
	/*/Modificar Deposito
$modificar="UPDATE contrato SET deposito=".$TotalDevolucion." WHERE Numero='".$id."'";
mysql_query($modificar);// Inserta los Datos
//Modificaar el status del contrato

*/
$Modific="UPDATE contrato SET estatus=2 WHERE Numero='".$id."'";
mysql_query($Modific);// Inserta los Datos



$_SESSION['Conceptos']=$Concepto;
$_SESSION['Cantidades']=$Cantidades;
$_SESSION['Precios']=$Precios;
$_SESSION['TotalCargos']=$Totalcargos;
$_SESSION['TotalDevolucion']=$TotalDevolucion;
$_SESSION['Totales']=$Totales;

?>

<script>
function cargar() {
	//window.open("");
}
</script>
</head> 
<body onload="cargar()">
</body>
</html>

