<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="Refresh"  URL=http://www.pruebasvilla.mbrsoluciones.com.mx/index.php">

<title>Documento sin título</title>



</head>

<?
require("funciones2.php");
//// Modifica Todos los Saldos Actuales en el Sistema Cargando todos los abonos y cargos de la base de datos
$cons=mysql_query("Select ");
		
		$NumeroContrato=$_POST['nombre'];
       $folio=$_POST['numero'];
	   $fechaactual= date("d-m-Y");
	   $recibide=$_POST['recibide'];
	   $cantidadde=$_POST['cantidadde'];echo 
	   $concepto=$_POST['concepto'];
	   $fechaevento=$_POST['fecha_e'];
	   $tipoeveto=$_POST['tipo'];
	   $salon=$_POST['salon'];
	   $ncontrato=$_POST['nombre'];
	   
	  
 	$qs="select Numero,si from contrato";
    $consulta=mysql_query($qs);
	$totalabono;$totalcargo;
while($can=mysql_fetch_array($consulta))
	{
	
	 $sumaabono="select cantidad from abono where numcontrato='".$can['Numero']."'";
	  $consulta2=mysql_query($sumaabono);
	  while($can2=mysql_fetch_array($consulta2))
		{

			 $totalabono=$totalabono+$can2['cantidad'];
	
		}
		
		 $sumaabono="select cantidad from cargo where numcontrato='".$can['Numero']."'";
	  $consulta3=mysql_query($sumaabono);
	  while($can3=mysql_fetch_array($consulta3))
		{

			$totalcargo=$totalcargo+$can3['cantidad'];
	
		}
		
		$totalsa=$can['si']-$totalabono+$totalcargo;
		$modificasa="UPDATE contrato SET sa=".$totalsa." where Numero='".$can['Numero']."'";
		$consulta3=mysql_query($modificasa);
		//echo $modificasa."<br/>";
		$totalabono=0;$totalcargo=0;
		
	}

?>
<body onload="cargar()">
</body>
</html>