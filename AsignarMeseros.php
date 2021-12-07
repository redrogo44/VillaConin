<?php
require("configuraciones.php");
conectar();
pie();

$conscon="select descripcion, valor from Configuraciones where id=2";
$cons=mysql_fetch_array(mysql_query($conscon));
$valor=$cons['valor'];
$CONT = explode(",", $cons['descripcion']);
echo  $cons['descripcion'];
echo "Numero de Contratos". (count($CONT)-2);
   print_r($_POST);

///////////////////////		MESEROS


for($i=0;$i<$_POST['ncHECK'];$i++)
{
	if($_POST[$i]==$i)// Check Seleccionado
	{	
		for($j=0;$j<=($_POST['ncHECK']/(count($CONT)-2));$j++)
		{$M="Select * from Meseros Where id=".$_POST['Mesero'.$i];
			$mes=mysql_fetch_array(mysql_query($M));
			if($_POST['Mesero'.$j]==$mes['id'])
			{
				echo "<br>Numero de Check =  ".$_POST[$i]."  Contrato  a Asignar ".fmod($_POST[$i], (count($CONT)-2))." Mesero ".$mes['nombre']."<br>";
			}
			
		}
	
	}
}
?>