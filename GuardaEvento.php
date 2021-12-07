<?php
require "funciones2.php";
	conectar();	
	print_r($_POST);
		echo $Numero=nombrecontrato($_POST['fecha'],$_POST['salon'],$_POST['vendedor']);
	if ($_POST['Depender']=='si') 
	{
	$tipo=explode("%",$_POST['TE']);		
		echo $inser="INSERT INTO `Eventos_Adicionales`(`Numero`, `c_jovenes`, `Fecha`, `salon`, `Vendedor`, `Contrato_Referencia`, `tipo`, `c_adultos`, `c_ninos`) VALUES ('".$Numero."',".$_POST['c_jovenes'].",'".$_POST['fecha']."','".$_POST['salon']."','".$_POST['vendedor']."','".$_POST['referencia']."','".$tipo[0]."',".$_POST['c_adultos'].",".$_POST['c_ninos'].");";
		 mysql_query($inser) or die(mysql_error());		
	}
	if ($_POST['Depender']=='no') 
	{
	$tipo=explode("%",$_POST['TE2']);	
		echo $inser="INSERT INTO `Eventos_Adicionales`(`Numero`, `c_jovenes`, `Fecha`, `salon`, `Vendedor`, `Contrato_Referencia`, `tipo`, `c_adultos`, `c_ninos`) VALUES ('".$Numero."',".$_POST['c_jovenes'].",'".$_POST['fecha']."','".$_POST['salon']."','".$_POST['vendedor']."','NULL','".$tipo[0]."',".$_POST['c_adultos'].",".$_POST['c_ninos'].");";
		 mysql_query($inser) or die(mysql_error());		
	}

$tipo='';$Numero='';
function nombrecontrato($f,$s,$v)
{
	$nombre;
	//salon
	if($s=="Fundador de Conin"){
		$nombre='X';
		}
	else if($s=="Real de Conin"){
		$nombre='Y';
			} 
	else if($s=="Alcazar de Conin"){
		$nombre='Z';
		}
	else if($s=="Solar de Conin"){
		$nombre='W';
		}
	else if($s=="Solar de Conin"){
		$nombre='W';
		}
	else if($s=="Marques"){
		$nombre='V';
		}
	//fecha	
	$fecha=explode("-",$f);
	$nombre=$nombre . $fecha[2] . $fecha[1];
	$vi=(int)$fecha[0];
	$vi=$vi-2000;
	$nombre=$nombre . $vi;
	/*vendedor
	if($v=="Luis"){
		$nombre=$nombre . "L";
		}
	else if($v=="Oscar"){
		$nombre=$nombre . "O";
		}
		else if($v=="Eduardo"){
		$nombre=$nombre . "E";
		}
*/
	$L=substr($v,-(strlen($str)),1); 
		$nombre=$nombre.$L;
	return $nombre;
}
?>
<script>
	window.close();
</script>