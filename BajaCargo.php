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
<meta http-equiv="refresh" content="0; url=https://villaconin.mx" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cancelacion del Cargo</title>
			
<script>
function cargar() {
	window.open("https://villaconin.mx/CancelacionCargo.php");
}
</script>

<?php
conectar();
$id=$_GET['numero'];
$facturado=$_GET['facturado'];
// Insertar Tabla CargosCancelados

if($facturado=='si')
{
	$buscar="SELECT * from cargofac WHERE id=".$id."";

}
else
{
	 $buscar="SELECT * from cargo WHERE id=".$id."";
}

$consulta1=mysql_query($buscar);
$muestra=mysql_fetch_array($consulta1);
 	 	 	
    $nom = $muestra["numcontrato"]; 
    $con = $muestra["concepto"]; 
    $total =$muestra["cantidad"]; 
	$fechacargo=$muestra["fecha"];	
	$tipo=$muestra["tipo"];

	
	
$insertar="INSERT INTO Cancelaciones (numcontrato,concepto,cantidad,fechamovimiento,fecha,folio,tipo) VALUES ('".$nom."','".$con."',".$total.",'".$fechacargo."','".date('Y-m-d')."',".$id.",'Cargo');";
mysql_query($insertar);// Inserta los Datos

///   ELIMINAR COMENSALES SI ES QUE EXISTEN..



////

$cons_q="select * from contrato where Numero='".$nom."'";

$consulta=mysql_query($cons_q);
while($can=mysql_fetch_array($consulta)){
	$cantidad=$can['sa']-$total;
	$adultos=$can['c_adultos'];
	$jovenes=$can['c_jovenes'];
	$ninos=$can['c_ninos'];
	// MODIFICR CANTIDAD DE COMENSALES
	/*if($tipo == 'Comensales')
	{
		$Concepto=explode(",", $con);
		echo "Numero de Des= ".count($Concepto);
		for ($i=0; $i < count($Concepto); $i++) 
		{ 
			echo "<br>".$Concepto[$i];
			$Concepto1 = explode(" ", $Concepto[$i]);
				for ($j=0; $j <count($Concepto1) ; $j++) 
				{ 
					echo "<br>".$Concepto1[$j]." J=".$j;
					if($i==0 && $j==4)
					{
						$adultos=$adultos-$Concepto1[$j];
						echo $actualizar=mysql_query("UPDATE contrato SET c_adultos=".$adultos." WHERE Numero='".$nom."'");// Modificar CANTIDAD DE COMENSALES
					}
					if($i==1 && $j==4)
					{
						$jovenes=$jovenes-$Concepto1[$j];
						echo $actualizar=mysql_query("UPDATE contrato SET c_jovenes=".$jovenes." WHERE Numero='".$nom."'");// Modificar CANTIDAD DE COMENSALES
					}
					if($i==2 && $j==4)
					{
						$ninos=$ninos-$Concepto1[$j];
						echo $actualizar=mysql_query("UPDATE contrato SET c_ninos=".$ninos." WHERE Numero='".$nom."'");// Modificar CANTIDAD DE COMENSALES
					}
				}
		}

	}*/
	$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$nom."'");// Modificar el saldo actual
	}


if (!$insertar) { 
die("'".$insertar."' mbr datos no insertados:" . mysql_error()); 
}

///////////////////////////777

if($facturado=='si')
{
	$borrarcargo=mysql_query("DELETE FROM `cargofac` WHERE id='".$id."'");// Borrar Cargo de la tabla
}
else
{
	$borrarcargo=mysql_query("DELETE FROM `cargo` WHERE id='".$id."'");// Borrar Cargo de la tabla
}


?>
</head> 
<body onload="cargar()">
</body>
</html>