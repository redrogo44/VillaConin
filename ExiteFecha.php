<?php
require('funciones2.php');
conectar();
$nombre=nombrecontrato($_POST['fecha'],$_POST['salon']);
$Selec="SELECT * FROM contrato WHERE Numero like '".$nombre."%'";
$sql=mysql_query($Selec);
if (mysql_num_rows($sql)<1) 
{
	 $Slc=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero like '".$nombre."%'");
	echo mysql_num_rows($Slc);	
}
else 
{
	echo mysql_num_rows($sql);
}
function nombrecontrato($f,$s)
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
	//fecha	
	$fecha=explode("-",$f);
	$nombre=$nombre . $fecha[2] . $fecha[1];
	$vi=(int)$fecha[0];
	$vi=$vi-2000;
	$nombre=$nombre . $vi;
	//vendedor
	return $nombre;

}

?>