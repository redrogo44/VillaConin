<?php
error_reporting(0);
//print_r($_POST);
include("configuraciones.php");
conectar();
$numeroSemana = date("W");
$Con = "Select descripcion From Configuraciones Where id=2";
$contr=mysql_fetch_array(mysql_query($Con));
$Contratos=explode(",",$contr['descripcion']);
$Ncontratos=count($Contratos);
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Asignacion de meseros".$numeroSemana.".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Documento sin título</title>
<?php

function n_contratos($Contratos)
{
		echo "<td align='center' style='width:50px;'></td>";			
	for($in=0;$in<count($Contratos);$in++){
		echo "<td align='center'>".$Contratos[$in]."</td>";
	}
}
$bandera=0;
function evento($Contratos){
		echo "<td align='center'></td>";			

	for($in=0;$in<count($Contratos);$in++)
	{
		$q=mysql_query("select tipo from contrato where Numero='".$Contratos[$in]."'");
		if (mysql_num_rows($q)<1) 
		{
			$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$Contratos[$in]."'");
			if(mysql_num_rows($Ea)<1)
			{
				$Ear=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$Contratos[$in]."'");
				$m=mysql_fetch_array($Ear);$bandera=1;
			}
			else
			{$m=mysql_fetch_array($Ea);}
		}
		else
		{
			$m=mysql_fetch_array($q);
		}
		if($bandera==0)
		{
		echo "<td align='center'>".utf8_encode(utf8_decode($m['tipo']))."</td>";
		}
		if($bandera==1)
		{
		echo "<td align='center'>".utf8_encode(utf8_decode('Recaudacion'))."</td>";	
		}
		$bandera=0;

	}
}
function invitados($Contratos){
		echo "<td align='center'></td>";			

	for($in=0;$in<count($Contratos);$in++)
	{
		$t=0;
		$q=mysql_query("select * from contrato where Numero='".$Contratos[$in]."'");
		if (mysql_num_rows($q)<1) 
		{
			$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$Contratos[$in]."'");
			if(mysql_num_rows($Ea)<1)
			{
				$Ear=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$Contratos[$in]."'");
				$mr=mysql_fetch_array($Ear);$bandera=1;
			}
			else{		$m=mysql_fetch_array($Ea);	}
		}
		else
		{
			$m=mysql_fetch_array($q);
		}
		if($bandera==0)
		{
		$Tota=total_comensales($Contratos[$in],$m['facturaado']);
	     $TTOal=$Tota[0]+$Tota[1]+$Tota[2];
		$t=$m['c_ninos']+$m['c_jovenes']+$m['c_adultos']+$TTOal;
		$ad=$Tota[0]+$m['c_adultos'];
		$jo=$Tota[1]+$m['c_jovenes'];
		$ni=$Tota[2]+$m['c_ninos'];

		echo "<td align='center'>Adultos = ".$ad."<br>Jovenes = ".$jo."<br>Niños = ".$ni."<br>Total = ".$t."</td>";
		}
		if($bandera==1)
		{
			echo "<td align='center'>Total de<br> Comensales = ".$mr['comensales']."</td>";
		}
		$bandera=0;
	}
}
function salon($Contratos){	
		echo "<td align='center'></td>";				
	for($in=0;$in<count($Contratos);$in++){

		$q=mysql_query("select salon from contrato where Numero='".$Contratos[$in]."'");
		if (mysql_num_rows($q)<1) 
		{
			$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$Contratos[$in]."'");
			if(mysql_num_rows($Ea)<1)
			{
				$Ear=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$Contratos[$in]."'");
				$m=mysql_fetch_array($Ear);
			}
			else{		$m=mysql_fetch_array($Ea);	}
		}
		else
		{
		$m=mysql_fetch_array($q);
		}
		echo "<td align='center'>".$m['salon']."</td>";
	}
}
function nom_dia($fecha)
{
				$ex=explode("-",$fecha);
				 $dia= date("w",mktime(0, 0, 0, $ex[1], $ex[2],$ex[0]));// dia de la semana
				 if($dia==0)
				 {return "Domingo";} 
				 if($dia==1)
				 {return "Lunes";}
				  if($dia==2)
				 {return "Martes";} 
				  if($dia==3)
				 {return "Miercoles";}
				  if($dia==4)
				 {return "Jueves"; }
				  if($dia==5)
				 {return "Viernes";} 
				  if($dia==6)
				 {return "Sabado";}
			
}

function dia($Contratos){
		echo "<td align='center'></td>";			

	for($in=0;$in<count($Contratos);$in++){
		$q=mysql_query("select Fecha from contrato where Numero='".$Contratos[$in]."'");
		if (mysql_num_rows($q)<1) 
		{
			$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$Contratos[$in]."'");
			if(mysql_num_rows($Ea)<1)
			{
				$Er=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$Contratos[$in]."'");
				$m=mysql_fetch_array($Er);	$bandera=1;
			}
			else
			{		$m=mysql_fetch_array($Ea);		}
		}
		else
		{
			$m=mysql_fetch_array($q);
		}
		if($bandera==0){	echo "<td align='center'>".nom_dia($m['Fecha'])."</td>";	}
		if($bandera==1){	echo "<td align='center'>".nom_dia($m['fecha'])."</td>";	}
		$bandera=0;
	}
}
function fecha($Contratos){
		echo "<td align='center'></td>";			

	for($in=0;$in<count($Contratos);$in++)
	{
		$q=mysql_query("SELECT Fecha from contrato where Numero='".$Contratos[$in]."'");
		if (mysql_num_rows($q)<1) 
		{
			$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$Contratos[$in]."'");
			if(mysql_num_rows($Ea)<1)
			{
				$Er=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$Contratos[$in]."'");
				$m=mysql_fetch_array($Er);	$bandera=1;
			}
			else
			{		$m=mysql_fetch_array($Ea);		}
		}
		else{
		$m=mysql_fetch_array($q);
		}
		if($bandera==1)
		{	$ex=explode("-",$m['fecha']);	}
		if($bandera==0)
		{		$ex=explode("-",$m['Fecha']);	}
		echo "<td align='center'>".$ex[1]."-".$ex[2]."-".$ex[0]."</td>";
	$bandera=0;		
	}
}
function entrada($Contratos){
		echo "<td align='center'></td>";			

	for($in=0;$in<count($Contratos);$in++){
		/*$q="select Fecha from contrato where Numero='".$Contratos[$in]."'";
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		$ex=explode("-",$m['Fecha']);*/
		echo "<td align='center'>????</td>";
	}
}
function salida($Contratos){
		echo "<td align='center'></td>";			

	for($in=0;$in<count($Contratos);$in++){
		/*$q="select Fecha from contrato where Numero='".$Contratos[$in]."'";
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		$ex=explode("-",$m['Fecha']);*/
		echo "<td align='center'>????</td>";
	}
}
function prom_meseros($Contratos){
		echo "<td align='center'></td>";			

	$prome=explode(',', $_GET['prom']);
	for($in=0;$in<count($Contratos);$in++){
		/*$q="select Fecha from contrato where Numero='".$Contratos[$in]."'";
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		$ex=explode("-",$m['Fecha']);*/
		
		echo "<td align='center'>".$prome[$in]."</td>";
	}
}
function num_meseros($Contratos){
		echo "<td align='center'></td>";			

	$Tt=explode(',', $_GET['cantida']);
	for($in=0;$in<count($Contratos);$in++){
		/*$q="select Fecha from contrato where Numero='".$Contratos[$in]."'";
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		$ex=explode("-",$m['Fecha']);*/
		echo "<td align='center'>".$Tt[$in]."</td>";
	}
}
function meseros($Contratos)
{
		echo "<td align='center'></td>";			

$ORDEN=OrdenaMeseros();
	$MTIPO=mysql_query("SELECT * FROM Meseros GROUP BY ".$ORDEN);
	
	echo "<tr><td colspan='".(count($Contratos)+2)."' align='center'><b bgcolor='#FFF300' style='color:#042843' >MESEROS CON DISPONIBILIDAD Y ASIGNACION DE EVENTO</b></td></tr>";
	
	while ($MESTIPO=mysql_fetch_array($MTIPO)) 
	{
		$q="select * from Meseros where disponibilidad2='si' and confirmacion='si' order by ap,am,nombre";
		$r=mysql_query($q);
		echo"<tr><td colspan='".(count($Contratos)+2)."' bgcolor='#00ABFF' align='center'><b>".$MESTIPO['tipo']."</b></td></tr>";
		while($me=mysql_fetch_array($r))
		{
				if($me['tipo'] == $MESTIPO['tipo'])
				{
					echo "<tr>";
			
					echo "<td bgcolor='#A0EEFF'>".$me['ap']." ".$me['am']." ".$me['nombre']."</td>";
					echo "<td bgcolor='#A0EEFF'>".$me['comentarios']."</td>";
					$id=$me['id'];
					for($in=0;$in<count($Contratos);$in++)
					{
						$query=mysql_query("select Meseros from contrato where Numero='".$Contratos[$in]."'");
						if(mysql_num_rows($query)<1)
						{
							$Eaa=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$Contratos[$in]."'");
							if(mysql_num_rows($Eaa)<1)
							{
							$Eara=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$Contratos[$in]."'");
							$mostrar=mysql_fetch_array($Eara);
							}
							else{
							$mostrar=mysql_fetch_array($Eaa);							
							}
						}
						else
						{
							$mostrar=mysql_fetch_array($query);
						}
						$mesero=explode(',',$mostrar['Meseros']);
						$bandera=0;
						for($index=0;$index<count($mesero);$index++)
						{
							if($mesero[$index]==$id)
							{
							$bandera=1;
							}
						}
					
						if($bandera==0)
						{
							echo "<td></td>";
						}
						else
						{
							echo "<td align='center' >X</td>";

						}
						$bandera=0;
					}
					echo "</tr>";

				}
		}
	}
	
	
	//////////////////////	PLANTILLA	//////////////////77
	echo "<tr><td colspan='".(count($Contratos)+2)."' align='center' bgcolor='#F2C43A'><b bgcolor='#FFF300' style='color:#042843' >MESEROS CON DISPONIBILIDAD Y SIN ASIGNACION DE EVENTO</b></td></tr>";
	
	$MTIPO2=mysql_query("SELECT * FROM Meseros GROUP BY ".$ORDEN);
	while ($MESTIPO=mysql_fetch_array($MTIPO2)) 
	{
		$qq="select * from Meseros where confirmacion='no' and disponibilidad2='si'  order by ap,am,nombre";
		$r=mysql_query($qq);
		echo"<tr><td colspan='".(count($Contratos)+2)."' bgcolor='#00ABFF' align='center'><b>".$MESTIPO['tipo']."</b></td></tr>";
		while($me=mysql_fetch_array($r))
		{
				if($me['tipo'] == $MESTIPO['tipo'])
				{
					echo "<tr>";
			
					echo "<td bgcolor='#FBE3B7'>".$me['ap']." ".$me['am']." ".$me['nombre']."</td>";
					echo "<td bgcolor='#FBE3B7'>".$me['comentarios']."</td>";

					$id=$me['id'];
					for($in=0;$in<count($Contratos);$in++)
					{
						$query=mysql_query("select Meseros from contrato where Numero='".$Contratos[$in]."'");
						if(mysql_num_rows($query)<1)
						{
							$Eaa=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$Contratos[$in]."'");
							if(mysql_num_rows($Eaa)<1)
							{
							$Eara=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$Contratos[$in]."'");
							$mostrar=mysql_fetch_array($Eara);
							}
							else{
							$mostrar=mysql_fetch_array($Eaa);							
							}	
						}
						else
						{
						$mostrar=mysql_fetch_array($query);
						}
						$mesero=explode(',',$mostrar['Meseros']);
						$bandera=0;
						for($index=0;$index<count($mesero);$index++)
						{
							if($mesero[$index]==$id)
							{
							$bandera=1;
							}
						}
					
						if($bandera==0)
						{
							echo "<td></td>";
						}
						else
						{
							echo "<td align='center'>X</td>";

						}
						$bandera=0;
					}
					echo "</tr>";

				}
		}
	}
	echo "<tr><td colspan='".(count($Contratos)+2)."' align='center' bgcolor='#FA679D'><b bgcolor='#FFF300' style='color:#042843' >MESEROS SIN DISPONIBILIDAD</b></td></tr>";

	$MTIPO3=mysql_query("SELECT * FROM Meseros GROUP BY ".$ORDEN);
	while ($MESTIPO=mysql_fetch_array($MTIPO3)) 
	{
		$q="select * from Meseros where disponibilidad2='no' order by ap,am,nombre";
		$r=mysql_query($q);
		echo"<tr><td colspan='".(count($Contratos)+2)."' bgcolor='#00ABFF' align='center'><b>".$MESTIPO['tipo']."</b></td></tr>";
		while($me=mysql_fetch_array($r))
		{
				if($me['tipo'] == $MESTIPO['tipo'])
				{
					echo "<tr>";
			
					echo "<td bgcolor='#F09C9C'><b>".$me['ap']." ".$me['am']." ".$me['nombre']."</b></td>";
					echo "<td bgcolor='#F09C9C'>".$me['comentarios']."</td>";

					$id=$me['id'];
					for($in=0;$in<count($Contratos);$in++)
					{
						$query=mysql_query("select Meseros from contrato where Numero='".$Contratos[$in]."'");
						if(mysql_num_rows($query)<1)
						{
							$Eaa=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$Contratos[$in]."'");
							if(mysql_num_rows($Eaa)<1)
							{
							$Eara=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$Contratos[$in]."'");
							$mostrar=mysql_fetch_array($Eara);
							}
							else{
							$mostrar=mysql_fetch_array($Eaa);							
							}			
						}
						else
						{
							$mostrar=mysql_fetch_array($query);
						}
						$mesero=explode(',',$mostrar['Meseros']);
						$bandera=0;
						for($index=0;$index<count($mesero);$index++)
						{
							if($mesero[$index]==$id)
							{
							$bandera=1;
							}
						}
					
						if($bandera==0)
						{
							echo "<td></td>";
						}
						else
						{
							echo "<td align='center' >X</td>";

						}
						$bandera=0;
					}
					echo "</tr>";

				}
		}
	}
	///////////////////////////////////////////////////77
}
function total_comensales($n,$fac){

	$congral=mysql_query("select count(*) as total from contrato where Numero like '".$n."-%'");
	$gral=mysql_fetch_array($congral);

	if($gral['total']>0){//////////////es un contrato gral
		if($fac=='si'){
			$q='select * from cargofac where numcontrato like "'.$n.'%" and tipo="Comensales"';
		}else{
			$q='select * from cargo where numcontrato like "'.$n.'%" and tipo="Comensales"';
		}
	}else{//////es un contrato normal o subcontrato
		if($fac=='si'){
			$q='select * from cargofac where numcontrato="'.$n.'" and tipo="Comensales"';
		}else{
			$q='select * from cargo where numcontrato="'.$n.'" and tipo="Comensales"';
		}
	}
	
	$r=mysql_query($q);
	$cantidades;
	while($m=mysql_fetch_array($r)){
		$arreglo=explode(' ',$m['concepto']);
		$cantidades[0]=$cantidades[0]+$arreglo[4];
		$cantidades[1]=$cantidades[1]+$arreglo[15];
		$cantidades[2]=$cantidades[2]+$arreglo[26];
	}
	
	return $cantidades;
}
?>
</head>
<body>
<table BORDER ='1'>
<tr><td>ASIGNACION DE MESEROS PARA LOS EVENTOS DE LA  SEMANA <?php echo $numeroSemana;?></td></tr>
<tr><td>No. CONTRATO</td><?php n_contratos($Contratos); ?></tr>
<tr><td>TIPO DE EVENTO</td><?php evento($Contratos); ?></tr>
<tr><td># DE INVITADOS</td><?php invitados($Contratos); ?></tr>
<tr><td>SALON</td><?php salon($Contratos); ?></tr>
<tr><td>DIA</td><?php dia($Contratos); ?></tr>
<tr><td>FECHA</td><?php fecha($Contratos); ?></tr>
<tr><td>HORA DE ENTRADA</td><?php entrada($Contratos); ?></tr>
<tr><td>HORA DE SALIDA</td><?php salida($Contratos); ?></tr>
<tr><td>PROMEDIO MESEROS</td><?php prom_meseros($Contratos); ?></tr>
<tr><td>MESEROS SELECCIONADOS</td><?php num_meseros($Contratos); ?></tr>

<tr bgcolor="#D1FF00"><td border='0' align="center" colspan="<?php echo (count($Contratos)+1);?>"><h6><b>PLANTILLA MESEROS</b></h6></td></tr>
<?php meseros($Contratos);
header('Location: ReconfirmaM.php');
mysql_query("UPDATE Meseros SET disponibilidad2='no', confirmacion='no' Where 1 ");
?>
</table>
</body>
</html>