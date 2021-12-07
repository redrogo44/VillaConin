<?php
	error_reporting(0);
	require("configuraciones.php");
	conectar();
	echo $Sele="SELECT * FROM contrato WHERE Fecha >='2014-12-26' and Fecha <='2014-12-27'";
	$xx=mysql_query($Sele);
	while ($CA=mysql_fetch_array($xx)) 
	{
		echo $CA['Numero'].' Meseros  '.$CA['Meseros']."<br>";
		$Mes=explode(",", $CA['Meseros']);
		for ($i=0; $i <count($Mes)-1; $i++) 
		{ 
			echo $xd="UPDATE `Meseros` SET `disponibilidad2`='si',`confirmacion`='si' WHERE id=".$Mes[$i];
			echo "<br>";
		mysql_query($xd);
		}
	}
?>