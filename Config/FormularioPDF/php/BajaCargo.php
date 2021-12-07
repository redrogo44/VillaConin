<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php

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
<meta http-equiv="refresh" content="3; url=http://www.pruebasvilla.mbrsoluciones.com.mx/index.php" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
			
<script>
function cargar() {
	window.open("http://www.pruebasvilla.mbrsoluciones.com.mx/CancelacionCargo.php");
}
</script>

<?php
conectar();
$id=$_GET['numero'];
// Insertar Tabla CargosCancelados

$buscar="SELECT * from cargo WHERE id=".$id."";
$consulta1=mysql_query($buscar);
while($muestra=mysql_fetch_array($consulta1)){
 	 	 	
    $nom = $muestra["numcontrato"]; 
    $con = $muestra["concepto"]; 
    $total =$muestra["cantidad"]; 
	$fechacargo=$muestra["fecha"];	
	$fechaactual=date("d-m-Y");

	}
$insertar=mysql_query("INSERT INTO Cancelaciones(numcontrato,concepto, cantidad, fechamovimiento, fecha, folio) VALUES ('".$nom."','".$con."',".$total.",'".$fechaactual."','".$fechacargo."','".$id."')");
die($insertar);
$cons_q="select * from contrato where Numero='".$nom."'";
$consulta=mysql_query($cons_q);
while($can=mysql_fetch_array($consulta)){
	$cantidad=$can['sa']-$total;
	}
$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$nom."'");
if (!$insertar) { 
die("'".$insertar."' mbr datos no insertados:" . mysql_error()); 
}

$borrarcargo="DELETE FROM `cargo` WHERE Numero"
?>
</head> 
<body onload="cargar()">
</body>
</html>