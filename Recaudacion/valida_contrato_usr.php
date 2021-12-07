<?php
	require("../funciones2.php");
	conectar();
	$bandera=0;
//print_r($_POST);
	$us=mysql_query("SELECT * FROM usuarios WHERE nombre='".$_POST['nombre']."' and usuario='".$_POST['usuario']."' ");
	$con=mysql_fetch_array($us);
	$contrato=$con['Contrato'];
function dia_anterior()
{
    $sol = (strtotime(date('Y-m-d')) - 3600);
    return date('Y-m-d', $sol);
}  

  $fg="SELECT * FROM Eventos_Recaudacion WHERE fecha >='".dia_anterior()."' AND fecha <=  '".date('Y-m-d')."' AND corte='no' AND estatus='ACTIVO'";
	$f=mysql_query($fg);
	if(mysql_num_rows($f)>0)
	{ 
		while($er=mysql_fetch_array($f))
		{
			$cot=$er['Numero'].",".$cot;
			if($er['Numero']==$contrato)
			{
				$bandera=1;
				break;
			}
			else{$bandera=0;}
		}

	}
	//echo "SELECT * FROM Eventos_Recaudacion WHERE Numero='".$contrato."' ";
	$l=mysql_fetch_array(mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$contrato."' "));
		if ($l['corte']=='si') 
		{
			$contrato='no hay eventos';
			$bandera=1;
		}

	if($bandera==1)
	{
		
		echo $contrato;
	}
	if($bandera==0)
		{echo "no existe".",".$cot;}
?>