<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<?php
require('../../configuraciones.php');
conectar();

$e=mysql_fetch_array(mysql_query("SELECT * FROM Empleados WHERE id=".$_POST['id']));
$fecha=mysql_fetch_array(mysql_query("SELECT * FROM Configuraciones WHERE id=3"));

$nombre=$e['nombre']." ".$e['apellidos'];
//echo $nombre." ".$fecha['descripcion'];

//	BUSCAMOS AL EMPLEADO EN LAS DIFERENTES NOMINAS EXISTENTES
echo "<br>".$nombre."
<p>Reajuste de Puntos: ".$e['reajuste']."<br/>Premio de Lealtad: ".$e['acumulado']."</p>";
	$nomCons=mysql_query("SELECT * FROM `Confirmacion_Nomina_Construccion` WHERE `fecha`>='".$fecha['descripcion']."' AND `confirmado`= 'si' ");
//	NOMINAS CONSTRUCCION
	$TotalCons=0;
	while($c=mysql_fetch_array($nomCons))
	{

		$Construccion= explode(",", $c['nombres']);
		for ($i=1; $i <count($Construccion) ; $i++) 
		{	$puntos=explode(",", $c['puntos']);
			$Const=explode("-", $Construccion[$i]);			
			if($Const[1]==$_POST['id'])
			{	
				$TotalCons+=$puntos[$i];
				//echo "<br> ID: ".$Const[1];				
			}
		}
	}

	if($TotalCons!=0)
	{
		echo "<p><b>Nomina Construccion: ".$TotalCons."</b></p>";
	}

//	NOMINA EVENTOS
//	
	$nomEve=mysql_query("SELECT * FROM `Confirmacion_Nomina_Eventos` WHERE `fecha`>= '".$fecha['descripcion']."' AND `confirmado`= 'si'");
	$TotalEvento=0;
	while($e=mysql_fetch_array($nomEve))
	{
		$Eventos= explode(",", $e['nombres']);
		for ($i=1; $i <count($Eventos) ; $i++) 
		{	$puntos=explode(",", $e['puntos']);
			$Eve=explode("-", $Eventos[$i]);			
			if($Eve[1]==$_POST['id'])
			{	
				$TotalEvento+=$puntos[$i];						
			}
		}
	}
	if($TotalEvento!=0)
	{	echo "<p><b>Nomina Eventos: ".$TotalEvento."</b></p>";	}


//	NOMINA EXTRAS
//	
	$nomEx=mysql_query("SELECT * FROM `Confirmacion_Nomina_Extras` WHERE `fecha`>='".$fecha['descripcion']."' AND `confirmado`='si' ");
	$TotalExt=0;

	while($ne=mysql_fetch_array($nomEx))
	{
		$Extras= explode(",", $ne['nombres']);
		for ($i=1; $i <count($Extras) ; $i++) 
		{	$puntos=explode(",", $ne['puntos']);
			$Ext=explode("-", $Extras[$i]);			
			if($Ext[1]==$_POST['id'])
			{	
				$TotalExt+=$puntos[$i];						
			}
		}
	}
	if($TotalExt!=0)
	{	echo "<p><b>Nomina Extra: ".$TotalExt."</b></p>";}

//	NOMINA PLANTA

$nomPla=mysql_query("SELECT * FROM `Confirmacion_Nomina_Planta` WHERE `fecha`>='".$fecha['descripcion']."' AND `confirmado`='si'");
	$TotalPla=0;

	while($pla=mysql_fetch_array($nomPla))
	{
		$Planta= explode(",", $pla['nombres']);
		for ($i=1; $i <count($Planta) ; $i++) 
		{	$puntos=explode(",", $pla['puntos']);
			$Plan=explode("-", $Planta[$i]);			
			if($Plan[1]==$_POST['id'])
			{	
				 $TotalPla+=$puntos[$i];						
			}
		}
	}
	if($TotalPla!=0)
	{	echo "<p><b>Nomina Planta: ".$TotalPla."</b></p>";}


//	NOMINA COMISION
//	
//	
$nomCo=mysql_query("SELECT * FROM `Cornfirmacion_Nomina_Comision` WHERE `fecha`='".$fecha['descripcion']."' AND `confirmado`='si'");
	$TotalCo=0;

	while($co=mysql_fetch_array($nomCo))
	{
		$Comision= explode(",", $co['nombres']);
		for ($i=1; $i <count($Comision) ; $i++) 
		{	$puntos=explode(",", $co['puntos']);
			$Coo=explode("-", $Comision[$i]);			
			if($Coo[1]==$_POST['id'])
			{	
				 $TotalCo+=$puntos[$i];						
			}
		}
	}
	if($TotalCo!=0)
	{	echo "
			<p><b>Nomina Comisiones: ".$TotalCo."</b></p>";}



echo "<div>
	<input type='button'  class='btn' onclick='abrirHistorial(this.name)' name='".$_POST['id']."' value='Historial'>
	<input type='button'  class='btn' onclick='Reajuste(this.name)' name='".$_POST['id']."' value='Reajuste de Puntos'>
	</div>";

?>

<script type="text/javascript">
	
</script>
</body>
</html>
