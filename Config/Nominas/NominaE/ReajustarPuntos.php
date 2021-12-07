<?php
require('../../configuraciones.php');
//require('funciones.php');
conectar();
mysql_query("UPDATE Empleados SET acumulado='' WHERE 1");
$empleados=mysql_query("SELECT * FROM Empleados");
while ($e=mysql_fetch_array($empleados)) 
{	
	echo $e['nombre']." ".$e['categorias']."<br/>";
	$cate=explode(",",$e['categorias']);
	echo "id= ".$e['id'];
	for($i=1; $i<count($cate); $i++) 
	{ 
		echo $cate[$i]."<br/>";
		switch ($cate[$i]) 
		{
			case 'Planta':
					modifica($e['id'],'Confirmacion_Nomina_Planta');
				break;
			case 'Eventos':
					modifica($e['id'],'Confirmacion_Nomina_Eventos');
				break;	
			case "Construccion":
					modifica($e['id'],"Confirmacion_Nomina_Construccion");
				break;
			case "Extras":
					modifica($e['id'],"Confirmacion_Nomina_Extras");
				break;
			case "Comisiones":
					modifica($e['id'],"Cornfirmacion_Nomina_Comision");
				break;		
			default:
				# code...
				break;
		}
	}
}
reajuste();

function reajuste()
{
	$emp=mysql_query("SELECT * FROM Empleados");
	while($ee=mysql_fetch_array($emp))
	{
		$t=0;
		$t=$ee['acumulado']+$ee['reajuste'];
		mysql_query("UPDATE Empleados SET acumulado='".$t."' WHERE id=".$ee['id']);
	}
}
function modifica($ide,$tabla)
{	$total=0;
	$empl=mysql_fetch_array(mysql_query("SELECT * FROM Empleados WHERE id=".$ide));
	echo "Esto es el acumudo 1:  ".$total=$empl['acumulado'];
	$pla=mysql_query("SELECT * FROM ".$tabla." WHERE confirmado='si' ");
	while($p=mysql_fetch_array($pla))
	{
		$ids=explode(",",$p['nombres']);
		$puntos=explode(',',$p['puntos']);
		for ($i=1; $i <count($ids) ; $i++) 
		{ 
		
			$id=explode("-",$ids[$i]);

			if($id[1]==$ide)
			{
				$total+=$puntos[$i];
			}
		}		
	}
echo "<br>Puntos; ".$total;
	//$total+=$empl['reajuste'];
	echo "<br>Reajuste".$total;
	mysql_query("UPDATE Empleados SET acumulado='".$total."' WHERE id=".$ide);
}
?>