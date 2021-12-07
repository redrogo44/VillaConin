<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Relacion de Meseros en Nomina</title>
</head>
<body>
<?php
	require('../configuraciones.php');
		conectar();
		
	?>
	<div align="center">
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<label><font color="green"><b>De</b></font></label>&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="date" name="fecha1" />&nbsp;&nbsp;&nbsp;&nbsp;
					<label><font color="red"><b>Hasta</b></font></label>&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="date" name="fecha2" max="'.date('Y-m-d').'"/>&nbsp;&nbsp;&nbsp;&nbsp;";
					<input type="submit" name="submit">
				</form>
			</div>

<?php
if ($_POST['submit']) 	
{
	print_r($_POST);

	echo $f="SELECT * FROM contrato WHERE Fecha>='".$_POST['fecha1']."' and Fecha<='".$_POST['fecha2']."' AND tipo!='MOSTRADOR'  ";
	echo "<h1>CONTRATOS</h1>";
	$co=mysql_query($f);
	echo " 		<table border='5'>		
				<tr>
				<td align='center'>Mesero</td>
				<td align='center'>Categoria</td>
				<td align='center'>Sueldo x Evento</td>
				</tr>
		";
		$total_general=0;$con=0;
	while($contrato=mysql_fetch_array($co))
	{$total_evento=0;$con++;
		echo "<th colspan='3'> ".$con." ".$contrato['Numero']."</th>";
		$M=mysql_query("SELECT * FROM TMeserosEvento WHERE contratos='".$contrato['Numero']."'");
		$M=mysql_fetch_array($M);
		$mes=explode(",",$M['meseros']);
		for ($i=0; $i <count($mes) ; $i++) 
		{ $ids=explode("-",$mes[$i]);
			$MM=mysql_query("SELECT * FROM Meseros WHERE id=".$ids[0]);
			$mesero=mysql_fetch_array($MM);
			$cat=mysql_query("SELECT * FROM Configuraciones WHERE id=".$ids[1]);
			$Categoria=mysql_fetch_array($cat);
			echo "
					<tr>
					<td>".$mesero['nombre']." ".$mesero['ap']." ".$mesero['am']."</td>
					<td>".$Categoria['descripcion']."</td>
					<td>".$Categoria['valor']."</td>
					</tr>
				";
				$total_evento=$total_evento+$Categoria['valor'];
		}
		echo "<tr><td align='rigth' colspan='2'>Total Contrato ".$contrato['Numero']."</td><td align='center' bgcolor='#FE829B'><b>".$total_evento."</b></td></tr>";
	$total_general=$total_general+$total_evento;		
	}
		echo "<tr><td align='rigth' colspan='2'>Total de Nomina</td><td align='center' bgcolor='#82CDFE'><b>".$total_general."</b></td></tr>";	
	echo " 		</table>		";


	echo $f="SELECT * FROM Eventos_Adicionales WHERE Fecha>='".$_POST['fecha1']."' and Fecha<='".$_POST['fecha2']."' AND tipo!='MOSTRADOR'  ";
	echo "<h1>EVENTOS ADICIONALES</h1>";
	$co=mysql_query($f);
	echo " 		<table border='5'>		
				<tr>
				<td align='center'>Mesero</td>
				<td align='center'>Categoria</td>
				<td align='center'>Sueldo x Evento</td>
				</tr>
		";
		$total_general=0;$con=0;
	while($contrato=mysql_fetch_array($co))
	{$total_evento=0;$con++;
		echo "<th colspan='3'> ".$con." ".$contrato['Numero']."</th>";
		$M=mysql_query("SELECT * FROM TMeserosEvento WHERE contratos='".$contrato['Numero']."'");
		$M=mysql_fetch_array($M);
		$mes=explode(",",$M['meseros']);
		for ($i=0; $i <count($mes) ; $i++) 
		{ $ids=explode("-",$mes[$i]);
			$MM=mysql_query("SELECT * FROM Meseros WHERE id=".$ids[0]);
			$mesero=mysql_fetch_array($MM);
			$cat=mysql_query("SELECT * FROM Configuraciones WHERE id=".$ids[1]);
			$Categoria=mysql_fetch_array($cat);
			echo "
					<tr>
					<td>".$mesero['nombre']." ".$mesero['ap']." ".$mesero['am']."</td>
					<td>".$Categoria['descripcion']."</td>
					<td>".$Categoria['valor']."</td>
					</tr>
				";
				$total_evento=$total_evento+$Categoria['valor'];
		}
		echo "<tr><td align='rigth' colspan='2'>Total Contrato ".$contrato['Numero']."</td><td align='center' bgcolor='#FE829B'><b>".$total_evento."</b></td></tr>";
	$total_general=$total_general+$total_evento;		
	}
		echo "<tr><td align='rigth' colspan='2'>Total de Nomina</td><td align='center' bgcolor='#82CDFE'><b>".$total_general."</b></td></tr>";	
	echo " 		</table>		";

}
?>			
</body>
</html>