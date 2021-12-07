<?php
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

function n_contratos($Contratos){
	for($in=0;$in<count($Contratos);$in++){
		echo "<td align='center'>".$Contratos[$in]."</td>";
	}
}
function evento($Contratos){
	for($in=0;$in<count($Contratos);$in++){
		$q="select tipo from contrato where Numero='".$Contratos[$in]."'";
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		echo "<td align='center'>".utf8_encode($m['tipo'])."</td>";
	}
}
function invitados($Contratos){
	for($in=0;$in<count($Contratos);$in++){
		$t=0;
		$q="select * from contrato where Numero='".$Contratos[$in]."'";
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		$t=$m['c_ninos']+$m['c_jovenes']+$m['c_adultos'];
		echo "<td align='center'>".$t."</td>";
	}
}
function salon($Contratos){
	for($in=0;$in<count($Contratos);$in++){
		$q="select salon from contrato where Numero='".$Contratos[$in]."'";
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		echo "<td align='center'>".$m['salon']."</td>";
	}
}
function nom_dia($fecha){
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
	for($in=0;$in<count($Contratos);$in++){
		$q="select Fecha from contrato where Numero='".$Contratos[$in]."'";
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		echo "<td align='center'>".nom_dia($m['Fecha'])."</td>";
	}
}
function fecha($Contratos){
	for($in=0;$in<count($Contratos);$in++){
		$q="select Fecha from contrato where Numero='".$Contratos[$in]."'";
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		$ex=explode("-",$m['Fecha']);
		echo "<td align='center'>".$ex[1]."-".$ex[2]."-".$ex[0]."</td>";
	}
}
function entrada($Contratos){
	for($in=0;$in<count($Contratos);$in++){
		/*$q="select Fecha from contrato where Numero='".$Contratos[$in]."'";
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		$ex=explode("-",$m['Fecha']);*/
		echo "<td align='center'>????</td>";
	}
}
function salida($Contratos){
	for($in=0;$in<count($Contratos);$in++){
		/*$q="select Fecha from contrato where Numero='".$Contratos[$in]."'";
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		$ex=explode("-",$m['Fecha']);*/
		echo "<td align='center'>????</td>";
	}
}
function num_meseros($Contratos){
	for($in=0;$in<count($Contratos);$in++){
		/*$q="select Fecha from contrato where Numero='".$Contratos[$in]."'";
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		$ex=explode("-",$m['Fecha']);*/
		echo "<td align='center'>????</td>";
	}
}
function meseros($Contratos)
{
$ORDEN=OrdenaMeseros();
	$MTIPO=mysql_query("SELECT * FROM Meseros GROUP BY ".$ORDEN);
	
	echo "<tr><td colspan='".(count($Contratos)+1)."' align='center'><b bgcolor='#FFF300' style='color:#042843' >MESEROS CON DISPONIBILIDAD Y ASIGNACION DE EVENTO</b></td></tr>";
	
	while ($MESTIPO=mysql_fetch_array($MTIPO)) 
	{
		$q="select * from Meseros where disponibilidad='si' and confirmacion='si' order by tipo,porcentaje";
		$r=mysql_query($q);
		echo"<tr><td colspan='".(count($Contratos)+1)."' bgcolor='#00ABFF' align='center'><b>".$MESTIPO['tipo']."</b></td></tr>";
		while($me=mysql_fetch_array($r))
		{
				if($me['tipo'] == $MESTIPO['tipo'])
				{
					echo "<tr>";
			
					echo "<td bgcolor='#A0EEFF'>".$me['nombre']." ".$me['ap']." ".$me['am']."</td>";
					$id=$me['id'];
					for($in=0;$in<count($Contratos);$in++)
					{
						$query="select Meseros from contrato where Numero='".$Contratos[$in]."'";
						$result=mysql_query($query);
						$mostrar=mysql_fetch_array($result);
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
							echo "<td align='center' bgcolor='#00FF5A'>X</td>";

						}
						$bandera=0;
					}
					echo "</tr>";

				}
		}
	}
	
	
	//////////////////////	PLANTILLA	//////////////////77
	echo "<tr><td colspan='".(count($Contratos)+1)."' align='center' bgcolor='#F2C43A'><b bgcolor='#FFF300' style='color:#042843' >MESEROS CON DISPONIBILIDAD Y SIN ASIGNACION DE EVENTO</b></td></tr>";
	
	$MTIPO2=mysql_query("SELECT * FROM Meseros GROUP BY ".$ORDEN);
	while ($MESTIPO=mysql_fetch_array($MTIPO2)) 
	{
		$qq="select * from Meseros where disponibilidad='si' and confirmacion='no' order by nombre";
		$r=mysql_query($qq);
		echo"<tr><td colspan='".(count($Contratos)+1)."' bgcolor='#00ABFF' align='center'><b>".$MESTIPO['tipo']."</b></td></tr>";
		while($me=mysql_fetch_array($r))
		{
				if($me['tipo'] == $MESTIPO['tipo'])
				{
					echo "<tr>";
			
					echo "<td bgcolor='#FBE3B7'>".$me['nombre']." ".$me['ap']." ".$me['am']."</td>";
					$id=$me['id'];
					for($in=0;$in<count($Contratos);$in++)
					{
						$query="select Meseros from contrato where Numero='".$Contratos[$in]."'";
						$result=mysql_query($query);
						$mostrar=mysql_fetch_array($result);
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
							echo "<td align='center' bgcolor='#00FF5A'>X</td>";

						}
						$bandera=0;
					}
					echo "</tr>";

				}
		}
	}
	echo "<tr><td colspan='".(count($Contratos)+1)."' align='center' bgcolor='#FA679D'><b bgcolor='#FFF300' style='color:#042843' >MESEROS SIN DISPONIBILIDAD</b></td></tr>";

	$MTIPO3=mysql_query("SELECT * FROM Meseros GROUP BY ".$ORDEN);
	while ($MESTIPO=mysql_fetch_array($MTIPO3)) 
	{
		$q="select * from Meseros where disponibilidad='no' and confirmacion='no' order by tipo,porcentaje";
		$r=mysql_query($q);
		echo"<tr><td colspan='".(count($Contratos)+1)."' bgcolor='#00ABFF' align='center'><b>".$MESTIPO['tipo']."</b></td></tr>";
		while($me=mysql_fetch_array($r))
		{
				if($me['tipo'] == $MESTIPO['tipo'])
				{
					echo "<tr>";
			
					echo "<td bgcolor='#F09C9C'><b>".$me['nombre']." ".$me['ap']." ".$me['am']."</b></td>";
					$id=$me['id'];
					for($in=0;$in<count($Contratos);$in++)
					{
						$query="select Meseros from contrato where Numero='".$Contratos[$in]."'";
						$result=mysql_query($query);
						$mostrar=mysql_fetch_array($result);
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
							echo "<td align='center' bgcolor='#00FF5A'>X</td>";

						}
						$bandera=0;
					}
					echo "</tr>";

				}
		}
	}
	///////////////////////////////////////////////////77
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
<tr><td>DIA</td><?php dia($Contratos); ?></</tr>
<tr><td>FECHA</td><?php fecha($Contratos); ?></tr>
<tr><td>HORA DE ENTRADA</td><?php entrada($Contratos); ?></tr>
<tr><td>HORA DE SALIDA</td><?php salida($Contratos); ?></tr>
<tr><td># DE MESEROS</td><?php num_meseros($Contratos); ?></tr>
<tr bgcolor="#D1FF00"><td border='0' align="center" colspan="<?php echo (count($Contratos)+1);?>"><h6><b>PLANTILLA MESEROS</b></h6></td></tr>
<?php meseros($Contratos);
header('Location: ReconfirmaM.php');
?>
</table>
</body>
</html>