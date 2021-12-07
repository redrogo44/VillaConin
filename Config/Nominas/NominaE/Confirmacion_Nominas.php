<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Confirmacion de Nomina</title>
</head>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="funciones_Nomina.js"></script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<?php
require('../../configuraciones.php');
//require('funciones.php');
conectar();

//print_r($_GET);
?>
<body>
<?php
if($_GET['tipo']=='comision')
{

	echo "
			<div align='center'><br></br><font color='blue' align='center'><b>NOMINA DE COMISIONES</b></font></div><br></br>
		";

	$f="SELECT * FROM `Cornfirmacion_Nomina_Comision` WHERE  id=".$_GET['id'];
	$C=mysql_query($f);
	$Com=mysql_fetch_array($C);		
	$nombre=explode(",",$Com['nombres']);
	$dias=explode(",",$Com['dias_trabajados']);
	$sueldos=explode(",",$Com['sueldos']);
	$puntos=explode(",",$Com['puntos']);
	$precioComensal=explode(",",$Com['costos_comensal']);
	$comensales=explode(",",$Com['comensales']);
	$comisiones=explode(",",$Com['comisiones']);
	$bruto=explode(",",$Com['bruto']);
	$descuentos=explode(",",$Com['descuentos']);
	$neto=explode(",",$Com['neto']);
	$contratos=explode(",",$Com['contratos']);
	$factor=explode(",",$Com['factores']);
	$sum_co=explode(",",$Com['suma_comisiones']);
	$normal=explode(",",$Com['normales']);
	$aplicada=explode(",",$Com['aplicadas']);
	echo"	
	 <form action='Acciones_Nomina.php' method='POST' name='comisiones' ONSUBMIT='return pregunta();'>      
		<table border='10' bordercolor='#000000' id='comision' name='comision'>
			<th colspan='12'>NOMINA DE COMISION</th>
			<tr>
				<td align='center'>Contratos</td>
				<td align='center'>Comensles</td>";		
				$numeroEmpleados=0;
					for($i=1;$i<count($nombre);$i++)
					{$numeroEmpleados++;
						$nomb=explode("-", $nombre[$i]);	
						echo"
							<td align='center'>Factor</td>
							<td align='center'>".$nomb[0]."</td>
						";
					}									
	echo "</tr>";
	echo "<tr>
			<td align='center' colspan='2'>Dias Trabajados</td>";		
			for($j=1;$j<count($nombre)	;$j++)
			{
				$ee=explode("-", $nombre[$j]);
				$e=mysql_fetch_array(mysql_query("SELECT * FROM Empleados WHERE id=".$ee[1]));
				echo"
							<td align='center'><input type='number' class='sueldoTr' title='".$j."' value='".$dias[$j]."' name='Dias_T-".$j."' style='width:30px;'/></td>
							<td align='center'><input type='text' name='Sueldo".$j."' title='".$e['sueldo']."' value='".$sueldos[$j]."' id='sueldo".$j."' onchange='re_Calcula(this.id,".$j.");' style='width:30px;'/></td>
				";
			}
echo "	</tr>";
echo "<tr>
			<td align='center' colspan='2'>Puntos</td>";
			$NumE=0;		
			for($j=1;$j<count($nombre)	;$j++)
			{$NumE++;
				echo"
							<td align='center' bgcolor='#CC6666'></td>
							<td align='center'><input type='text' name='Pt-".$j."' title='puntos".$j."' value='".$puntos[$j]."'  style='width:30px;'/></td>
				";
			}
echo "	</tr>";
$b=0;
		for($k=1;$k<count($comensales);$k++)
		{
			if($k>1)
				{
					 $b=$b+((count($comisiones)-1)/(count($comensales)-1));
					// echo "b es ".$b;
					//echo "<br>comisiones = ".count($comisiones)." comensales = ".count($comensales);
				}
			echo"<tr>	
					<td colspan='2' bgcolor='#FAFFBF'>Precio por Comensal</td>";
					for($c=1;$c<count($nombre);$c++)
					{	
					echo "
						<td colspan='2' align='center' bgcolor='#FAFFBF'><input type='text' class='PrecioComen".$c."' name='Precio_Comen".($b+$c)."' id='Precio_Comen".($b+$c)."' title='Precio_Comen".($b+$c)."' value='".$precioComensal[($b+$c)]."' style='width:60px;' onchange='modifica_Precio(this.id,".$c.",".($b+$c).",".$k.");'/></td>
						";
						//echo "<br>".($b+$c);
					}	
				
			echo "
				</tr>
				<tr>
				<td bgcolor='#F9D8D8'><input type='text'  name='Contrato".$k."' value='".$contratos[$k]."' /></td>
				<td bgcolor='#F9D8D8'><input type='number' name='Comensales-".$k."' value='".$comensales[$k]."' title='Comensales-".$k."' id='Comensales-".$k."'  style='width:50px;' onchange='movio_comensal(this.id,".$k.")' /></td>";
				
				for($l=1;$l<count($nombre);$l++)
				{	
					echo "
						<td align='center' bgcolor='#F9D8D8'><input type='text' class='".$k."' name='factor".($b+$l)."' value='".$factor[$b+$l]."' style='width:30px;' title='factor".($b+$l)."-".$l."' id='factor".($b+$l)."-".$l."' onchange='modifica_Precio(this.id,".$l.",".($b+$l).",".$k.");''/></td>
						<td align='center' bgcolor='#F9D8D8'><input type='text' class='Comision-".$l."' name='x".($b+$l)."'value='".$comisiones[$b+$l]."'  style='width:50px;' title='Comision-".($b+$l)."' id='Comision-".($b+$l)."'/></td>
						";
				}				
			echo "</tr>";			
		}
		echo "<tr>
		<td align='center' colspan='2'>COMISIONES</td>
			";
				for($m=1;$m<count($nombre);$m++)					
				{
					echo "
						<td align='center' colspan='2' ><input type='text' id='Comision".$m."' title='Comision".$m."' name='Comision".$m."' value='".$sum_co[$m]."' readonly='readonly' /></td>
						";
				}
		echo"</tr>";
		echo "<tr>
		<td align='center' colspan='2'>BRUTO</td>
			";
				for($m=1;$m<count($nombre);$m++)					
				{
					echo "
						<td align='center' colspan='2'><input type='text' id='Bruto".$m."' name='Bruto".$m."'  value='".$bruto[$m]."' readonly='readonly'/> </td>
						";
				}
		echo"</tr>";
		echo "<tr>
		<td align='center' colspan='2'>DESCUENTOS</td>
			";
				for($m=1;$m<count($nombre);$m++)					
				{
					echo "
						<td align='center' colspan='2'><input type='text' id='descuento".$m."' name='descuento".$m."' onChange='descuentos(this.id,".$m.")' value='".$descuentos[$m]."'/></td>
						";
				}
		echo"</tr>";
		echo "<tr>
		<td align='center' colspan='2'>NETO</td>
			";
				for($m=1;$m<count($nombre);$m++)					
				{
					echo "
						<td align='center' colspan='2'><input type='text' id='Neto".$m."' name='Neto".$m."' value='".$neto[$m]."' readonly='readonly'</td>
						";
				}
		echo"</tr>";
echo "</table>
		";
		echo '
			<table border="10" borde bordercolor="#000000" id="tablaExtraNominas" class="tablaExtraNominas" bgcolor="#fff">
            	<th colspan="2">RELACIONES</th>
                <tr><td colspan="2" style="height:50px;" bgcolor="#B1AAAA"></td></tr>
                <tr>
                	<td bgcolor="#860000" style="color:#FFF;"><b>NORMAL</b></td>
                	<td bgcolor="#860000" style="color:#FFF;"><b>APLICADA</b></td>
                </tr>                          ';
				for($h=1;$h<count($comensales);$h++)
				{
					echo "
						<tr>
							<td colspan='2' bgcolor='#F9D8D8' style='height:18px;'></td>
						</tr>
							<tr>
								<td align='center' bgcolor='#FAFFBF'><input type='text' title='normal-".$h."' name='normal-".$h."' value='".$normal[$h]."' id='normal-".$h."' style='width:30px;' onchange='movio_normal(this.id,".$h.",this.name)' /></td>
								<td align='center' bgcolor='#FAFFBF'><input type='text' title='aplicada-".$h."' name='aplicada-".$h."' value='".$aplicada[$h]."' id='aplicada-".$h."' style='width:30px;'onchange='movio_normal(this.id,".$h.",this.name)' /></td>
							</tr>
						";
				}
            echo'</table>
			<br></br><br></br><br></br><br></br>
			<input type="hidden" id="fecha_nomina" name="fecha"  />
			<input type="hidden" id="guarda" name="accion"  />
			<input type="hidden" name="NumeroE" value="'.(count($nombre)-1).'" />
			<input type="hidden" name="Filas" value="'.(count($comensales)-1).'" />
			<input type="hidden" name="Nomina" value="Comision-'.$_GET['id'].'" />
			<input type="hidden"   name="banco" id="Banco" value="" placeholder="">
       		<input type="hidden"  id="cuenta" name="cuenta" value="" placeholder="">       		
		</form>
		<input type="button" id="add" value="Agregar Fila">
		';
		
		echo "
		
		<div align='center' style='width:800px' style='background:#000'>
		
		<input type='submit' value='Confirmar Comisiones' name='tipo' onclick='Pregunta();'/>
		&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
		<input type='submit' value='Gurardar Comisiones' name='tipo' onclick='Pregunta2();' />
		&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
				<input type='button' name='cancelar' value='Cancelar' onclick='cancelar();'/>
				&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
				<a href='PDF_Nominas.php?tipo=comision&&id=".$_GET['id']."' target='_blank'>IMPRIMIR PDF</a>
				<br></br><br></br>	<br></br><br></br>	<br></br><br></br>	
		</div>
			";
}		
if($_GET['tipo']=='extras')
{	
	$nom=mysql_query("SELECT * FROM `Confirmacion_Nomina_Extras` WHERE id=".$_GET['id']);
	$nE=mysql_fetch_array($nom);
	
	$nombres=explode(",", $nE['nombres']);
	$costos=explode(",", $nE['costos']);
	$checks= $nE['checks'];
	$HE=explode(",", $nE['hora_entrada']);
	$HS=explode(",", $nE['hora_salida']);
	$totales=explode(",", $nE['totales']);
	$puntos=explode(",", $nE['puntos']);
	echo "
	 <form action='Acciones_Nomina.php' method='POST' name='extras' ONSUBMIT='return pregunta();'>      	
		<table border='10' bordercolor='#000000' id='comision'>
			<th colspan='12'>NOMINA DE EXTRAS</th>
			<tr>
				<td align='center'>Nombre</td>
				<td align='center'>Puntos</td>
				<td align='center'>Hora de Entrada</td>
				<td align='center'>Hora de Salida</td>
				<td align='center'>Lunes</td>
				<td align='center'>Martes</td>
				<td align='center'>Miercoles</td>
				<td align='center'>Jueves</td>
				<td align='center'>Viernes</td>
				<td align='center'>Sabado</td>
				<td align='center'>Domingo</td>
				<td align='center'>Total</td>
			</tr>";
			$b=0;$chek=0;
			for($i=1;$i<count($HE);$i++)
			{
				$nom=explode("-", $nombres[$i]);
				if($i>=2)
				{
					$b=$b+7;
				}
				echo'
					<tr>
								 <td colspan="4" bgcolor="#CCCCCC"></td>
			                    <td><input type="text" name="lunes'.$i.'"  	id="Lunes'.$i.'" class="extras" title="Lunes-'.$i.'"  		value="'.$costos[1+$b].'" style="width:60px;"/></td>
			                    <td><input type="text" name="martes'.$i.'" 	id="Martes'.$i.'" class="extras"	title="Martes-'.$i.'" 		value="'.$costos[2+$b].'"	style="width:60px;"/></td>
			                    <td><input type="text" name="miercoles'.$i.'" id="Miercoles'.$i.'" class="extras"	title="Miercoles-'.$i.'"		value="'.$costos[3+$b].'"	style="width:60px;"/></td>
			                    <td><input type="text" name="jueves'.$i.'" 	id="Jueves'.$i.'" class="extras"	title="Jueves-'.$i.'"		value="'.$costos[4+$b].'"	style="width:60px;"/></td>
			                    <td><input type="text" name="viernes'.$i.'" 	id="Viernes'.$i.'" class="extras"	title="Viernes-'.$i.'"		value="'.$costos[5+$b].'"	style="width:60px;"/></td>
			                    <td><input type="text" name="sabado'.$i.'" 	id="Sabado'.$i.'" class="extras"	title="Sabado-'.$i.'"		value="'.$costos[6+$b].'"	style="width:60px;"/></td>
			                    <td><input type="text" name="domingo'.$i.'" 	id="Domingo'.$i.'" class="extras"	title="Domingo-'.$i.'"		value="'.$costos[7+$b].'"	style="width:60px;"/></td>           
							</tr>
							<tr>
								<td align="center" style="width:180px;"><b style="width:180px;">'.$nom[0].'</b></td>
								<td align="center"><input type="text" name="puntos'.$i.'" value="'.$puntos[$i].'" style="width:60px;" /></td>
								<td align="center"><h6><b><input type="time" name="Hora_E'.$i.'" value="'.$HE[$i].'" style="width:110px;" /></b></h6></td>
								<td align="center"><b><input type="time" name="Hora_S'.$i.'" value="'.$HS[$i].'" style="width:110px;" /></b></td>';
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Lunes-'.$i.'" 		title="Lunes-'.$chek.'" 		onchange="calcula_Extra(this.id,'.$i.')" disabled /></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Martes-'.$i.'" 		title="Martes-'.$chek.'" 		onchange="calcula_Extra(this.id,'.$i.')" disabled /></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Miercoles-'.$i.'" 	title="Miercoles-'.$chek.'" 	onchange="calcula_Extra(this.id,'.$i.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Jueves-'.$i.'" 		title="Jueves-'.$chek.'" 		onchange="calcula_Extra(this.id,'.$i.')" disabled /></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Viernes-'.$i.'" 		title="Viernes-'.$chek.'" 	onchange="calcula_Extra(this.id,'.$i.')" disabled /></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Sabado-'.$i.'" 		title="Sabado-'.$chek.'" 		onchange="calcula_Extra(this.id,'.$i.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Domingo-'.$i.'" 		title="Domingo-'.$chek.'" 	onchange="calcula_Extra(this.id,'.$i.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><input type="text" name="total'.$i.'" title="total'.$i.'" id="total'.$i.'" value="'.$totales[$i].'" style="width:60px;" readonly="readonly" /></td>
              			   </tr>
					';

			}
		echo "</table>
		<input type='text' id='fecha_nomina' name='fecha'  />
			<input type='hidden' id='guarda' name='accion'  value='guardaExtra'/>
			<input type='hidden' name='NumeroE' value='".(count($nombre)-1)."' />
			<input type='hidden' name='Filas' value='".($i)."' />
			<input type='hidden' name='Nomina' value='Extras-".$_GET['id']."' />
            <input type='hidden' name='Checks' value='".$chek."' />			
			<input type='text'   name='banco' id='Banco' value='' placeholder=''>
       		<input type='text'  id='cuenta' name='cuenta' value='' placeholder=''>
		</form>
		<br></br><br></br>			
		<div align='center' style='width:800px' style='background:#000'>
		<br></br><br></br>	
				<input type='submit' value='Confirmar Extras' name='tipo' onclick='Pregunta_E();'/>
				&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
				<input type='submit' value='Gurardar Extras' name='tipo' onclick='Pregunta2_E();' />
				&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
				<input type='button' name='cancelar' value='Cancelar' onclick='cancelar();'/>
				&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
				<a href='PDF_Nominas.php?tipo=extras&&id=".$_GET['id']."' target='_blank'>IMPRIMIR PDF</a>
		</div>
			
		";
echo "<script>verifica_Check();</script>";
}
if($_GET['tipo']=='eventos')
{	
	$nom=mysql_query("SELECT * FROM `Confirmacion_Nomina_Eventos` WHERE id=".$_GET['id']);
	$nE=mysql_fetch_array($nom);
	$nombres=explode(",", $nE['nombres']);
	$costos=explode(",", $nE['costos']);
	$checks= $nE['checks'];
	$HE=explode(",", $nE['hora_entrada']);
	$HS=explode(",", $nE['hora_salida']);
	$totales=explode(",", $nE['totales']);
	$puntos=explode(",", $nE['puntos']);
	echo "
	 <form action='Acciones_Nomina.php' method='POST' name='eventos'>      	
		<table border='10' bordercolor='#000000' id='comision'>
			<th colspan='12'>NOMINA DE EVENTOS</th>
			<tr>
				<td align='center'>Nombre</td>
				<td align='center'>Puntos</td>
				<td align='center'>Hora de Entrada</td>
				<td align='center'>Hora de Salida</td>
				<td align='center'>Lunes</td>
				<td align='center'>Martes</td>
				<td align='center'>Miercoles</td>
				<td align='center'>Jueves</td>
				<td align='center'>Viernes</td>
				<td align='center'>Sabado</td>
				<td align='center'>Domingo</td>
				<td align='center'>Total</td>
			</tr>";
			$b=0;$chek=0;
			for($i=1;$i<count($HE);$i++)
			{
				$nom=explode("-", $nombres[$i]);
				if($i>=2)
				{
					$b=$b+7;
				}
				echo'
					<tr>

								 <td colspan="4" bgcolor="#CCCCCC"></td>
			                    <td><input type="text" name="lunes'.$i.'" class="evento" 	id="Lunes'.$i.'" 		title="Lunes-'.$i.'"  		value="'.$costos[1+$b].'"	style="width:60px;"/></td>
			                    <td><input type="text" name="martes'.$i.'" class="evento"	id="Martes'.$i.'"		title="Martes-'.$i.'" 		value="'.$costos[2+$b].'"	style="width:60px;"/></td>
			                    <td><input type="text" name="miercoles'.$i.'" class="evento" id="Miercoles'.$i.'" 	title="Miercoles-'.$i.'"		value="'.$costos[3+$b].'"	style="width:60px;"/></td>
			                    <td><input type="text" name="jueves'.$i.'" class="evento"	id="Jueves'.$i.'" 	title="Jueves-'.$i.'"		value="'.$costos[4+$b].'"	style="width:60px;"/></td>
			                    <td><input type="text" name="viernes'.$i.'" class="evento"	id="Viernes'.$i.'" 	title="Viernes-'.$i.'"		value="'.$costos[5+$b].'"	style="width:60px;"/></td>
			                    <td><input type="text" name="sabado'.$i.'" class="evento"	id="Sabado'.$i.'" 	title="Sabado-'.$i.'"		value="'.$costos[6+$b].'"	style="width:60px;"/></td>
			                    <td><input type="text" name="domingo'.$i.'"  class="evento"	id="Domingo'.$i.'" 	title="Domingo-'.$i.'"		value="'.$costos[7+$b].'"	style="width:60px;"/></td>           
							</tr>
							<tr>
								<td align="center" style="width:180px;"><b style="width:180px;">'.$nom[0]."- ".$nom[1].'</b></td>
								<td align="center"><input type="text" name="puntos'.$i.'" value="'.$puntos[$i].'" style="width:60px;" /></td>
								<td align="center"><h6><b><input type="time" name="Hora_E'.$i.'" value="'.$HE[$i].'" style="width:110px;" /></b></h6></td>
								<td align="center"><b><input type="time" name="Hora_S'.$i.'" value="'.$HS[$i].'" style="width:110px;" /></b></td>';
								  echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Lunes-'.$i.'" 		title="Lunes-'.$i.'" 		onchange="calcula_Extra(this.id,'.$i.')" disabled  /></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Martes-'.$i.'" 		title="Martes-'.$i.'" 		onchange="calcula_Extra(this.id,'.$i.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Miercoles-'.$i.'" 	title="Miercoles-'.$i.'" 	onchange="calcula_Extra(this.id,'.$i.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Jueves-'.$i.'" 		title="Jueves-'.$i.'" 		onchange="calcula_Extra(this.id,'.$i.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Viernes-'.$i.'" 		title="Viernes-'.$i.'" 	onchange="calcula_Extra(this.id,'.$i.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Sabado-'.$i.'" 		title="Sabado-'.$i.'" 		onchange="calcula_Extra(this.id,'.$i.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><b><input type="checkbox" name="'.$chek.'" value="'.$chek.'" id="Domingo-'.$i.'" 		title="Domingo-'.$i.'" 	onchange="calcula_Extra(this.id,'.$i.')" disabled/></b></td>';$chek++;
								echo '<td align="center"><input type="text" name="total'.$i.'" title="total'.$i.'" id="total'.$i.'" value="'.$totales[$i].'" style="width:60px;" readonly="readonly" /></td>
              			   </tr>
					';

			}
		echo "</table>
		<input type='hidden' id='fecha_nomina' name='fecha'  />
			<input type='hidden' id='guarda' name='accion'  />
			<input type='hidden' name='NumeroE' value='".(count($HE))."' />
			<input type='hidden' name='Filas' value='".(count($HE))."' />
			<input type='hidden' name='Nomina' value='Comision-".$_GET['id']."' />
			<input type='hidden'   name='banco' id='Banco' value='' placeholder=''/>
       		<input type='hidden'  id='cuenta' name='cuenta' value='' placeholder=''/>
       		<input type='hidden' name='Checks' value='".$chek."' />
		</form>
		<div align='center' style='width:800px' style='background:#000'>
		<br></br><br></br>	
				<input type='submit' value='Confirmar Eventos' name='tipo' onclick='Pregunta_Ev();'/>
				&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
				<input type='submit' value='Gurardar Eventos' name='tipo' onclick='Pregunta2_Ev();' />
				&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
				<input type='button' name='cancelar' value='Cancelar' onclick='cancelar();'/>
				&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
				<a href='PDF_Nominas.php?tipo=eventos&&id=".$_GET['id']."' target='_blank'>IMPRIMIR PDF</a>
		</div>
			
		";
echo "<script>verifica_Check();</script>";
}
if($_GET['tipo']=='planta')
{
echo'	<form action="Acciones_Nomina.php" method="post" id="formulario" name="planta" ONSUBMIT="return pregunta();"  >
        	<table id="planta" border="10" bordercolor="#000000"  bgcolor="#FFFFFF">
				<th colspan="12">NOMINA DE PLANTA</th>              
				<tr align="center">
					<td align="center">NOMBRE</td>
					<td align="center"><H6>Hora de Entrada</H6></td>
					<td align="center"><H6>Hora de Salida</H6></td>
					<td align="center"><H6>Salario Diario</H6></td>
					<td align="center"><H6>Dias Trabajados</H6></td>										
					<td align="center"><H6>Otros Pagos o Descuentos</H6></td>
					<td align="center"><H6>Salario por Semana</H6></td>					
					<td align="center"><H6>Puntos</H6></td>
					<td align="center"><H6>Total Nomina</H6></td>
				</tr>';
				$emp=mysql_query("SELECT * FROM Confirmacion_Nomina_Planta WHERE id=".$_GET['id']);$inc=0;$chek=0;
				$empl=mysql_fetch_array($emp);
				$nom=explode(",",$empl['nombres']);
				$he=explode(",",$empl['hora_entrada']);
				$hs=explode(",",$empl['hora_salida']);
				$salario=explode(",",$empl['salario']);
				$diast=explode(",",$empl['dias_trabajados']);
				$pagoevento=explode(",",$empl['pago_evento']);
				$neventos=explode(",",$empl['neventos_semana']);
				$pago_eventos=explode(",",$empl['total_eventos']);
				$salario_semana=explode(",",$empl['salario_semana']);
				$puntos=explode(",",$empl['puntos']);
				$descuentos=explode(",",$empl['descuentos']);
				$Total=explode(",",$empl['Total_nomina']);
				for($e=1;$e<count($he);$e++)
				{
					$nombre=explode("-",$nom[$e]);
				$inc++;								
					echo '				
						<tr>
							<td align="center" style="width:180px;"><h5><b style="width:180px;">'.$nombre[0].'</b></h5></td>
							<td><input type="time" 		name="Hora_E'.$inc.'" 		id="Hora_E'.$inc.'"  	value="'.$he[$e].'"	title="Hora_E'.$inc.'" 		style="width:110px;" /></td>
							<td><input type="time" 		name="Hora_S'.$inc.'" 		id="Hora_E'.$inc.'" 	value="'.$hs[$e].'"	title="Hora_S'.$inc.'" 		style="width:110px;" /></td>
							<td><input type="text" 		name="Salario'.$inc.'" 		id="Salario'.$inc.'"    value="'.$salario[$e].'" title="Salario'.$inc.'" style="width:40px;" 	readonly="readonly"/></td>
							<td><input type="number" 	name="Dias_T'.$inc.'" 		id="Dias_T'.$inc.'" 	value="'.$diast[$e].'"	title="Dias_T'.$inc.'" 		style="width:40px;" 	onchange="modifico_PagoXEvrnto(this.id,'.$inc.');"/></td>							
							<td><input type="text" 		name="Descuentos'.$inc.'" id="Descuentos'.$inc.'" value="'.$descuentos[$e].'"	title="Descuentos'.$inc.'"	 style="width:60px;" 		onchange="modifico_desceunto(this.id,'.$inc.');"/></td>
							<td><input type="text" 		name="Total_Semana'.$inc.'" id="Total_Semana'.$inc.'" value="'.$salario_semana[$e].'"	title="Total_Semana'.$inc.'" style="width:60px;" readonly="readonly"/></td>
							<td><input type="text" 		name="Puntos'.$inc.'" 		id="Puntos'.$inc.'" 	value="'.$puntos[$e].'"	title="Puntos'.$inc.'" 		style="width:60px;"/></td>										
							<td><input type="text" 		name="Total'.$inc.'" 		id="Total'.$inc.'" 		value="'.$Total[$e].'"	title="Total'.$inc.'" 		style="width:60px;" readonly="readonly"/></td>				
						<tr>  						 
  						 ';
				}			
echo'            </table>      
					<input type="hidden" id="fecha_nomina" name="fecha" value="'.date("Y-m-d").'"  />
					<input type="hidden" id="filas"  name="filas" value="'.$inc.'"  />
					<input type="hidden" name="Nomina" value="Plnata-'.$_GET['id'].'" />
					<input type="hidden" id="guarda" name="accion"  />
					<input type="hidden"   name="banco" id="Banco" value="" placeholder="">
       				<input type="hidden"  id="cuenta" name="cuenta" value="" placeholder="">
        </form>

              
        ';
echo "		<div align='center' style='width:800px' style='background:#000'>
		<br></br><br></br>	
				<input type='submit' value='Confirmar Planta' name='tipo' onclick='Pregunta_E3();'/>
				&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
				<input type='submit' value='Gurardar Planta' name='tipo' onclick='Pregunta2_E3();' />
				&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
				<input type='button' name='cancelar' value='Cancelar' onclick='cancelar();'/>
				&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
				<a href='PDF_Nominas.php?tipo=planta&&id=".$_GET['id']."' target='_blank'>IMPRIMIR PDF</a>
		</div>";
}
if($_GET['tipo']=='construccion')
{
echo'	<form action="Acciones_Nomina.php" id="construccion" method="post" name="construccion"  >
        	<table id="planta" border="10" bordercolor="#000000"  bgcolor="#FFFFFF">
				<th colspan="12">NOMINA DE CONSTRUCCION</th>              
				<tr align="center">
					<td align="center">NOMBRE</td>
					<td align="center"><H6>Hora de Entrada</H6></td>
					<td align="center"><H6>Hora de Salida</H6></td>
					<td align="center"><H6>Salario Diario</H6></td>
					<td align="center"><H6>Dias Trabajados</H6></td>										
					<td align="center"><H6>Otros Pagos o Descuentos</H6></td>
					<td align="center"><H6>Salario por Semana</H6></td>					
					<td align="center"><H6>Puntos</H6></td>
					<td align="center"><H6>Total Nomina</H6></td>
				</tr>';
				$emp=mysql_query("SELECT * FROM Confirmacion_Nomina_Construccion WHERE id=".$_GET['id']);$inc=0;$chek=0;
				$empl=mysql_fetch_array($emp);
				$nom=explode(",",$empl['nombres']);
				$he=explode(",",$empl['hora_entrada']);
				$hs=explode(",",$empl['hora_salida']);
				$salario=explode(",",$empl['salario']);
				$diast=explode(",",$empl['dias_trabajados']);
				$pagoevento=explode(",",$empl['pago_evento']);
				$neventos=explode(",",$empl['neventos_semana']);
				$pago_eventos=explode(",",$empl['total_eventos']);
				$salario_semana=explode(",",$empl['salario_semana']);
				$puntos=explode(",",$empl['puntos']);
				$descuentos=explode(",",$empl['descuentos']);
				$Total=explode(",",$empl['Total_nomina']);
				for($e=1;$e<count($he);$e++)
				{
					$nombre=explode("-",$nom[$e]);
				$inc++;								
					echo '				
						<tr>
							<td align="center" style="width:180px;"><h5><b style="width:180px;">'.$nombre[0].'</b></h5></td>
							<td><input type="time" 		name="Hora_E'.$inc.'" 		id="Hora_E'.$inc.'"  	value="'.$he[$e].'"	title="Hora_E'.$inc.'" 		style="width:100px;" /></td>
							<td><input type="time" 		name="Hora_S'.$inc.'" 		id="Hora_E'.$inc.'" 	value="'.$hs[$e].'"	title="Hora_S'.$inc.'" 		style="width:100px;" /></td>
							<td><input type="text" 		name="Salario'.$inc.'" 		id="Salario'.$inc.'"    value="'.$salario[$e].'" title="Salario'.$inc.'" style="width:40px;" 	readonly="readonly"/></td>
							<td><input type="number" 	name="Dias_T'.$inc.'" 		id="Dias_T'.$inc.'" 	value="'.$diast[$e].'"	title="Dias_T'.$inc.'" 		style="width:40px;" 	onchange="modifico_PagoXEvrnto(this.id,'.$inc.');"/></td>						
							<td><input type="text" 		name="Descuentos'.$inc.'" 	id="Descuentos'.$inc.'" value="'.$descuentos[$e].'"	title="Descuentos'.$inc.'"	 style="width:60px;" 		onchange="modifico_desceunto(this.id,'.$inc.');"/></td>
							<td><input type="text" 		name="Total_Semana'.$inc.'" id="Total_Semana'.$inc.'" value="'.$salario_semana[$e].'"	title="Total_Semana'.$inc.'" style="width:60px;" readonly="readonly"/></td>
							<td><input type="text" 		name="Puntos'.$inc.'" 		id="Puntos'.$inc.'" 	value="'.$puntos[$e].'"	title="Puntos'.$inc.'" 		style="width:60px;"/></td>										
							<td><input type="text" 		name="Total'.$inc.'" 		id="Total'.$inc.'" 		value="'.$Total[$e].'"	title="Total'.$inc.'" 		style="width:60px;" readonly="readonly"/></td>				
						<tr>  						 
  						 ';
				}			
echo'            </table>      
					<input type="hidden" id="fecha_nomina" name="fecha"  />
					<input type="hidden" id="filas"  name="filas" value="'.$inc.'"  />
					<input type="hidden" name="Nomina" value="Construccion-'.$_GET['id'].'" />
					<input type="hidden" id="guarda" name="accion"  />
					<input type="hidden"   name="banco" id="Banco" value="" placeholder="">
       				<input type="hidden"  id="cuenta" name="cuenta" value="" placeholder="">
        </form>';
echo "		<div align='center' style='width:800px' style='background:#000'>
		<br></br><br></br>	
				<input type='submit' value='Confirmar Construccion' name='tipo' onclick='Pregunta_E4();'/>
				&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
				<input type='submit' value='Gurardar Construccion' name='tipo' onclick='Pregunta2_E4();' />
				&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
				<input type='button' name='cancelar' value='Cancelar' onclick='cancelar();'/>
				&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp
				<a href='PDF_Nominas.php?tipo=construccion&&id=".$_GET['id']."' target='_blank'>IMPRIMIR PDF</a>
		</div>";
}
?>
</body>
<script>
verifica_Check();
  var NE="<?php echo count($nombre)-1; ?>";  
  NE=parseFloat(NE);
	function re_Calcula(id,c)
	{
		//alert('Entro '+c);
		//  TOTAL DE COMISIONES
		var co=document.getElementById("Comision"+c).value;
		co=parseFloat(co);
		//alert("Comision = "+co);
		//	SUELDO MODIFICADO
		var su=document.getElementById(id).value;
		//alert("Sueldo "+su);
		su=parseFloat(su);
		//	TOTAL
			var t=su+co;//alert(t);
		// NUEVO BRUTO
		document.getElementById("Bruto"+c).value=t;
		//	 DESCUENTOS
		var d=document.getElementById("descuento"+c).value;
		if(d==''||d==null){d=0;}
		d=parseFloat(d);
		//	 NUEVO NETO
			document.getElementById("Neto"+c).value=(t+d);		
	}
	function modifica_Precio(id,c,sig,f)
	{
		var v=parseFloat($("#"+id).val()); // OBTENERMOS EL VALOR
		if(isNaN(v)){v=0;}	
		// OBTENEMOS EL FACTOR
		/*var fa=parseFloat($("#factor"+sig+"-"+c).val());		
		if(isNaN(f)){f=0;}	*/
		// OBTENEMOS EL NUMERO DE COMENSALES
		var co=parseFloat($("#Comensales-"+f).val());		
		if(isNaN(c)){c=0;}	
		

		//	OBTENEMOS EL FACTOR DE LAS RELACIONES 
		var fa=parseFloat(obtenerFactor(f));
		if(isNaN(fa)){fa=0;}	

		
		// COLOCAMOS EL NUEVO FACTOR
		var ff=fa*v;
		$("#factor"+sig+"-"+c).val(ff);
		//	 COLOCAMOS LA NUEVA COMISION
		$("#Comision-"+c).val(ff*co);		

		// HACEMOS EL CALCULO DE LA COMISION
		 var tc=TotalComisiones(c);
		$("#Comision"+c).val(tc);	

		//	HACEMOS EL CALCULO DEL BRUTO
		var s=parseFloat($("#sueldo"+c).val());		
		if(isNaN(s)){s=0;}	
		var br=s+tc;
		$("#Bruto"+c).val(br);

		//	HACEMOS EL CALCULO DE LO NETO	
		var d=parseFloat($("#descuento"+c).val());		
		if(isNaN(d)){d=0;}	

		$("#Neto"+c).val(d+br);

	}
	function TotalComisiones(e)
	{
		var total=0;
		$(".Comision-"+e).each(function () {
			total+=parseFloat(this.value);
		});
		return total;
	}
	function obtenerFactor(f) //	RELACION APLICADA / NORMAL
	{
		var n=parseFloat($("#normal-"+f).val());
		if(isNaN(n)){n=0;}	
		var a=parseFloat($("#aplicada-"+f).val());
		if(isNaN(n)){n=0;}	

		var fac=a/n;
		return fac;
	}
	function movio_comensal(id,f)
	{
		var n = 1;
		 var NE="<?php echo count($nombre)-1; ?>";  
		if(f>1)
		{
			for (var i =n; i <f; i++) 
			{
				n+=parseFloat(NE);
			}
		}
		//alert("Esto es n "+n);
		var c=$("#"+id).val();						
		$("."+f).each(function (){		
			var fac=$(this).val();
			$("#Comision-"+n).val(fac*c);
			n++;
		});

		calcularTotales(fila,NE);
	}
	function calcularTotales(filas,tE)
	{
		//alert("Entro a recalculo "+filas+" Emple:  "+tE);
	var tv=filas*tE;
	for (var i = 1; i <= (tE); i++) 
	{ var t=0;
		$(".Comision-"+i).each(function() {
			
			t+=parseFloat($(this).val());
		});
		$("#Comision-"+i).text(t);
		$("#Comision"+i).val(t);
		$("#Bruto"+i).val((parseFloat($("#sueldo"+1).val())+t));
		$("#Neto"+i).val((parseFloat($("#sueldo"+1).val())+t));
	}
	}
		
	function movio_normal(id,f,tipo)
	{
		//console.log("id: "+id+" f:"+f+" tipo:"+tipo);
		//alert(tipo);v
	var inc=0;	
	
		if(f>1)
		{
			for (var i =1; i<f; i++) 
			{
				inc+=NE;
				//console.log("fila: "+f+" NE: "+NE);
			}
		}
		//console.log("EL INCREMENTEO ES :"+ inc);
		for(j=1;j<=NE;j++)
		{			
		//console.log("Valor de Comision:"+(inc+j));			
			var c_ant=document.getElementById("Comision-"+(inc+j)).value;	
			/*if(tipo=='normal-'+f)
			{
				//alert("es normal");
				var normal=document.getElementById(id).value;
				var aplicada=document.getElementById("aplicada-"+f).value;
				//alert("Precio_Comen"+(inc+j));				
			}
			if(tipo=='aplicada-'+f)
			{
				//alert("es aplicada");
				var aplicada=document.getElementById(id).value;
				var normal=document.getElementById("normal-"+f).value;
				//alert("Precio_Comen"+(inc+j));
			}*/

			var normal=parseFloat($("#normal-"+f).val());
			var aplicada=parseFloat($("#aplicada-"+f).val());
			if(isNaN(normal)){normal=0;}
			if(isNaN(aplicada)){aplicada=0;}
			//alert(normal+" => "+aplicada);

			var Precio_C=document.getElementById("Precio_Comen"+(inc+j)).value;
			if(Precio_C==''){Precio_C=0;}
			//console.log("Precio c: "+Precio_C+" Aplicada "+aplicada+" NORMAL "+ normal);
				var fac=(aplicada*Precio_C)/normal;
				
				document.getElementById("factor"+(inc+j)+"-"+j).value=fac;
////////////////////////////////			/////////////////////////////////////////////////////////////////////////////////////////////////////////
///
			//console.log("Comensales-"+f);
			var C=document.getElementById("Comensales-"+f).value;
			// CALCULAMOS LAS COMISIONES
			var comision=fac*C;
			document.getElementById("Comision-"+(inc+j)).value=comision;
			// OBTENEMOS LA SUMA DE COMISIONES
			var s_co=document.getElementById("Comision"+j).value;
			s_co=parseFloat(s_co);
			// CALCULAMOS LA NUEVA COMISION
			var nc=((s_co)-(c_ant))+comision;
		//alert("Suma de comisiones "+nc);
			document.getElementById("Comision"+j).value=nc;
			var su=document.getElementById("sueldo"+j).value;
			//alert("Sueldo "+su);
			su=parseFloat(su);
			//	TOTAL
				var t=su+nc;//alert(t);
			// NUEVO BRUTO
			document.getElementById("Bruto"+j).value=t;
			//	 DESCUENTOS
			var d=document.getElementById("descuento"+j).value;
			if(d==''||d==null){d=0;}
			d=parseFloat(d); //alert(d);
			//	 NUEVO NETO
				document.getElementById("Neto"+j).value=(t+d);	
		}
	}
	function cancelar()
	{
			if(confirm('Se Cancelara la Accion, no se guardara nada.. Esta segor@'))
			{
			 window.location ='Nominas.php';	
			}
	}
	function Pregunta()
	{
	  if (confirm('¿Estas seguro de Confirmar esta Comision?'))
	  {
		 window.open("https://greatmeeting.me/Config/Nominas/NominaE/confirmax.php?tipo=comision", "Confirmacion", "width=400, height=200");
		// window.open("http://qroodigo.com.mx/TesteoVillaConin/Config/Nominas/NominaE/confirmax.php?tipo=comision", "Confirmacion", "width=400, height=200");
		
		   document.getElementById("guarda").value="confirma_nomina_comision";		  
		   // document.comisiones.submit();
		  
	  } 
	} //
	function Pregunta2()
	{
		if(confirm("Esta Seguro de Guardar la Nomina Actual"))
		{
			 document.getElementById("guarda").value="guardar_nomina_comision";
		      document.comisiones.submit();
		}
	}
	function Pregunta_E()
	{
	  if (confirm('¿Estas seguro de Confirmar esta Nomina de Extras?'))
	  {
		 window.open("https://greatmeeting.me/Config/Nominas/NominaE/confirmax.php?tipo=extras", "Confirmacion", "width=400, height=200");
//		 window.open("http://qroodigo.com.mx/TesteoVillaConin/Config/Nominas/NominaE/confirmax.php?tipo=extras", "Confirmacion", "width=400, height=200");
		  
		   document.getElementById("guarda").value="confirma_nomina_extras";		  
		     //document.extras.submit();
		  
	  } 
	} 
	function Pregunta2_E()
	{
		if(confirm("Esta Seguro de Guardar la Nomina Actual"))
		{			
		      document.extras.submit();
		}
	}
	function Pregunta_Ev()
	{
	  if (confirm('¿Estas seguro de Confirmar esta Nomina de Eventos?'))
	  {
		 window.open("https://greatmeeting.me/Config/Nominas/NominaE/confirmax.php?tipo=eventos", "Confirmacion", "width=400, height=200");
		 
		   document.getElementById("guarda").value="confirma_nomina_eventos";		  
		    // document.eventos.submit();
		  
	  } 
	} 
	function Pregunta2_Ev()
	{
		if(confirm("Esta Seguro de Guardar la Nomina Actual"))
		{
			 document.getElementById("guarda").value="guardar_nomina_eventos";
		      document.eventos.submit();
		}
	}
	function calcula_Extra(n,f)
	{
		//alert("Entro " +n +" -- "+f);
		// 	OBTENEMOS LO QUE HAYA EN LOS TOTALES
		var total=document.getElementById("total"+f).value;
	//	alert(total);
		if(total==''||total==null||total=='NaN') // SI NO EXISTE NADA EN EL TOTAL ESTE SERA 0
		{
			total=0;			
		}
		total=parseFloat(total);
		// OBTENEMOS EL VALOR DE LA SEMANA QUE SE VA A SUMAR		
		var res = n.split("-"); 
		//alert(res[0]+res[1]);

		var dia=document.getElementById(res[0]+res[1]).value;
		dia=parseFloat(dia);
		//alert(document.getElementById(n).checked)
		if(document.getElementById(n).checked)
		{
			total=total+(parseFloat(dia));
		}
		else{
			total=total-(parseFloat(dia));
			document.getElementById(n).disabled=true;		
		//	alert(res[1]+res[2]);	
			document.getElementById(res[0]+res[1]).value='';
		}		
		//alert(total);
		document.getElementById("total"+f).value=total;		
	}
	function verifica_Check()
	{
		//alert("entro");
		var NChe="<?php echo $chek;?>";
		NChe=parseFloat(NChe);
	//	alert(NChe);
		var marcados="<?php echo $checks;?>";
		var marca=marcados.split(',');
	//alert(marca.length);
		
			for(var j=1; j<marca.length;j++)
			{
				
					var resto=(parseInt(marca[j])%7);
					//alert("j es "+j+" marca es"+marca[j]+" y el resto es "+resto);
					var f=parseInt(marca[j])/7;
//					alert(f);
					var n = f.toString(); 
					var fila=n.split(".");					
					var pos=parseInt(fila[0]);
					//alert("posicion = "+pos+"  resto = "+resto);
					switch(resto) 
					{
						case 0:						
							document.getElementById("Lunes-"+(pos+1)).disabled=false;						
							document.getElementById("Lunes-"+(pos+1)).checked = true;
							//document.getElementById("checkbox").checked = true;
							
							break;
						case 1:
							document.getElementById("Martes-"+(pos+1)).checked=true;
							document.getElementById("Martes-"+(pos+1)).disabled=false;												
							break;
						case 2:
							document.getElementById("Miercoles-"+(pos+1)).checked=true;
							document.getElementById("Miercoles-"+(pos+1)).disabled=false;						

							break;
						case 3:
							document.getElementById("Jueves-"+(pos+1)).checked=true;
							document.getElementById("Jueves-"+(pos+1)).disabled=false;						

							break;
						case 4:
							document.getElementById("Viernes-"+(pos+1)).checked=true;
							document.getElementById("Viernes-"+(pos+1)).disabled=false;						

							break;
						case 5:
							document.getElementById("Sabado-"+(pos+1)).checked=true;
							document.getElementById("Sabado-"+(pos+1)).disabled=false;						

							break;
						case 6:
							document.getElementById("Domingo-"+(pos+1)).checked=true;								
							document.getElementById("Domingo-"+(pos+1)).disabled=false;						

					} 
					
				}		
	}
	function modifico_PagoXEvrnto(id,f)
	{	// TOTAL DE	SEMANA ANTERIOR
		var Semana_Anterior=document.getElementById("Total_Semana"+f).value;
		if(Semana_Anterior==''||Semana_Anterior==null||Semana_Anterior=='NaN')
		{Semana_Anterior=0;}Semana_Anterior=parseFloat(Semana_Anterior);
		//		 CANTIDAD DE EVENTOS POR SEMANA
		var Eventos_Semana=document.getElementById("Dias_T"+f).value;
		if(Eventos_Semana==''||Eventos_Semana==null||Eventos_Semana=='NaN')
		{Eventos_Semana=0;}Eventos_Semana=parseFloat(Eventos_Semana);
		// PAGO POR EVENTO
		var PagoEvento=document.getElementById("Salario"+f).value;
		if(PagoEvento==''||PagoEvento==null||PagoEvento=='NaN')
		{PagoEvento=0;}PagoEvento=parseFloat(PagoEvento);
	
		var t=document.getElementById("Total"+f).value;
		if(t==''||t==null||t=='NaN')
		{t=0;}t=parseFloat(t);		
		
		//	CALCULO DE TOTAL SEMANA MODIFICADA
		 var Semana= Eventos_Semana * PagoEvento;
		 //		CALCULO DE NUEVO TOTAL
		 var total=0;
		 if(t>Semana_Anterior){var total= t - Semana_Anterior ;}
		 else{var total= Semana_Anterior - t;}
//		 alert(total);
		 //	CALCULAMOS EL TOTAL DE NUEVO
		 	//alert("total "+total+" Semana "+Semana);
		 total=total+Semana;
		 // COLOCAMOS LA NUEVA SEMANA
		 document.getElementById("Total_Semana"+f).value=Semana;
		 //	COLOCAMOS EL TOTAL
		 document.getElementById("Total"+f).value=total;
		calcula_descuento(f);
	}
	function calcula_descuento(f)
	{
		var d=document.getElementById("Descuentos"+f).value;
		if(d==''||d==null||d=='NaN')
		{d=0;}d=parseFloat(d);		
		var Semana=document.getElementById("Total_Semana"+f).value;
		if(Semana==''||Semana==null||Semana=='NaN')
		{Semana=0;}Semana=parseFloat(Semana);		
		var PE=document.getElementById("PagoEventos"+f).value;
		if(PE==''||PE==null||PE=='NaN')
		{PE=0;}PE=parseFloat(PE);		
			var total=Semana+PE+d;			
		document.getElementById("Total"+f).value=total;
	}
	function modifico_desceunto(id,f)
	{	
		//alert(id+" -- "+f);
		var d=document.getElementById(id).value;
		//alert("d es "+d);
		if(d==''||d==null||d=='NaN')
		{d=0;}d=parseFloat(d);					
		var salarioSemana=	document.getElementById("Total_Semana"+f).value;
		//alert("Salario es "+salarioSemana);
		if(salarioSemana==''||salarioSemana==null||salarioSemana=='NaN')
		{salarioSemana=0;}salarioSemana=parseFloat(salarioSemana);		
		/*var PE=document.getElementById("PagoEventos"+f).value;
		if(PE==''||PE==null||PE=='NaN')
		{PE=0;}PE=parseFloat(PE);		
	*/
		total=salarioSemana+d;		
		document.getElementById("Total"+f).value=total;
	}
	function calcula_PagoEventos(id,f)
	{
		var NumE=document.getElementById("Eventos_Sem"+f).value;
		if(NumE==''||NumE==null||NumE=='NaN')
		{NumE=0;}NumE=parseFloat(NumE);		
		var pago=document.getElementById("Pago_E"+f).value;
		if(pago==''||pago==null||pago=='NaN')
		{pago=0;}pago=parseFloat(pago);				
		var t=pago*NumE;
		document.getElementById("PagoEventos"+f).value=t;
		calcula_descuento(f);
	}
	function Pregunta_E3()
	{
	
	  if (confirm('¿Estas seguro de Confirmar esta Nomina de Planta?'))
	  {
		window.open("https://greatmeeting.me/Config/Nominas/NominaE/confirmax.php?tipo=planta", "Confirmacion", "width=400, height=200");
		  
		   document.getElementById("guarda").value="confirma_nomina_planta";		  
		      //document.planta.submit();
		  
	  } 
	  
	} 
	function Pregunta2_E3()
	{
		if(confirm("Esta Seguro de Guardar la Nomina Actual"))
		{
			 document.getElementById("guarda").value="guardar_nomina_planta";
		      document.planta.submit();
		}
	}
	function Pregunta_E4()
	{
	
	  if (confirm('¿Estas seguro de Confirmar esta Nomina de Construccion?'))
	  {
		window.open("https://greatmeeting.me/Config/Nominas/NominaE/confirmax.php?tipo=construccion", "Confirmacion", "width=400, height=200");		
		
		   document.getElementById("guarda").value="confirma_nomina_construccion";		  
		   //   document.construccion.submit();
		  
	  } 
	} 
	function Pregunta2_E4()
	{
		if(confirm("Esta Seguro de Guardar la Nomina Actual"))
		{
		//window.open("https://greatmeeting.me/Config/Nominas/NominaE/confirmax.php?tipo=construccion", "Confirmacion", "width=400, height=200");			
			 document.getElementById("guarda").value="guardar_nomina_construccion";
		     document.construccion.submit();
		}
	}


	$(".evento").change(function(){
		// OBTENERMOS EL TITLE QUE ES IGUAL AL ID DE SU CHECK CORRESPONDIENTE
		 var id=$("#"+this.id).attr("title");
		//	 HABILITAMOS MARCAMOS POR DEFECTO EL CHECK DE ACUERDO A LA CASILLA MODIFICADA
		//$("#e-"+id).prop("checked", true);
		document.getElementById(id).disabled=false;
		document.getElementById(id).checked=true;

		//	REALIZAMOS EL CALCULO DE ACUERDO AL VALOR 
		var indice=id.split("-");
		var t= parseFloat($("#total"+indice[1]).val());		
    	if(isNaN(t)){t=0;}		

		var v=parseFloat($("#"+indice[0]+indice[1]).val());		
		$("#total"+indice[1]).val(v+t);
	});
	$(".extras").change(function(){
		// OBTENERMOS EL TITLE QUE ES IGUAL AL ID DE SU CHECK CORRESPONDIENTE
		 var id=$("#"+this.id).attr("title");
		//	 HABILITAMOS MARCAMOS POR DEFECTO EL CHECK DE ACUERDO A LA CASILLA MODIFICADA
		//$("#e-"+id).prop("checked", true);
		document.getElementById(id).disabled=false;
		document.getElementById(id).checked=true;

		//	REALIZAMOS EL CALCULO DE ACUERDO AL VALOR 
		var indice=id.split("-");
		var t= parseFloat($("#total"+indice[1]).val());
		
    		if(isNaN(t)){t=0;}		
		var v=parseFloat($("#"+indice[0]+indice[1]).val());
		$("#total"+indice[1]).val(v+t);
	});


//		AGREGAR FILAS A LA TABLA DE NOMINA DE COMISION
//	
	var posicion='<?php echo $k;?>';
	//alert('posicion: '+posicion);
	posicion=parseInt(posicion);	
	var sig	=5+posicion;  var ll=0;var l=0;
	var NumE="<?php echo $NumE;?>";
	//alert("Numer de Em: "+NumE);
	Nume=parseInt(NumE); var ll=0;var otraT=posicion; var inc=1;var fila=1;
	 $("#add").click(function()
	 {
			 //alert('entro');	
			var table = document.getElementById("comision");	
			var row2=table.insertRow(sig);   sig++;  
		    var row = table.insertRow(sig);     
		    var cel= row2.insertCell(0);
		    cel.innerHTML="<td colspan='2'>Precio Por Comensal</td>";
		    cel.colSpan='2';
			cel.bgColor='#FAFFBF';

			var nne=0;
			if(posicion>1)
				{
					for (var i =1; i<posicion; i++) 
					{
						nne+=parseFloat(NumE);
						//console.log("fila: "+posicion+" NE: "+NumE);
					}
				}


		     for(i=1;i<=NumE;i++)
		     {
				ll++;
		       var cel2 = row2.insertCell(i);	  
	 cel2.innerHTML = "<input style='width:70px;' class='PrecioComen"+i+"' type='text' title='Precio_Comen"+(nne+i)+"' name='Precio_Comen"+(nne+i)+"-"+fila+"' id='Precio_Comen"+(nne+i)+"' />";
			   cel2.align='center';
			   cel2.colSpan='2';
			   cel2.bgColor='#FAFFBF';
		    }
			//
			//var numero = prompt("Introduzca Contrato", "");
		    var cell1 = row.insertCell(0);
		    var cell2 = row.insertCell(1);        
		    //var cell3 = row2.insertCell(1);                
		    cell1.innerHTML = "<input type='text' name='Contrato"+inc+"' value=''style='width:100px' />";
			cell1.align='center';
			cell1.bgColor='#F9D8D8';
		    cell2.innerHTML = "<input style='width:40px;' type='number' min='0' name='Comensal-"+inc+"' title='Comensales-"+posicion+"' id='Comensales-"+posicion+"' onChange='NComensal(this.id,"+posicion+")'/>";
		    cell2.align='center';
			cell2.bgColor='#F9D8D8';
			//alert(NumE +" => "+posicion);
			
		    for(i=1;i<=NumE;i++){
				
		       var cell1 = row.insertCell(i*2);
			   var cell2 = row.insertCell((i*2)+1);
			   cell1.innerHTML = "<input style='width:50px;' type='text' title='factor"+(nne+i)+"-"+i+"'name='factor-"+nne+"' id='factor"+(nne+i)+"-"+i+"'  >";
			   cell1.bgColor='#F9D8D8';
			   cell2.innerHTML = "<input style='width:50px;' class='Comision-"+i+"' type='text' title='Comision-"+(nne+i)+"' name='x"+(l)+"' id='Comision-"+(nne+i)+"' onchange='SumaC(this.value,this.id)'/>";
			   cell2.bgColor='#F9D8D8';
			}
			otraT=4+fila;
			alert(fila);
			sig++;			
			var table2 = document.getElementById("tablaExtraNominas");	   
		    var row4 = table2.insertRow(otraT+fila+1);  
		     var cel4 = row4.insertCell(0);
		      cel4.innerHTML="<td>que</td>";        
		      cel4.colSpan='2';
		      cel4.bgColor='F9D8D8';
		      cel4.height='15px';
		    var row2 = table2.insertRow(posicion+otraT);          
		    var cel2 = row2.insertCell(0);
		    var cel3 = row2.insertCell(1);  
		     //cel3.bgcolor="#F00";
		 //  var cel5 = row2.insertCell(2);  


		    cel2.innerHTML = "<input style='width:40px;' type='number' min='0' id='normal-"+posicion+"' name='normal-"+inc+"' title='normal-"+posicion+"' onChange='movio_normal(this.id,"+posicion+",this.name)'  />";   
		    cel3.innerHTML = "<input style='width:40px;' type='number' min='0' id='aplicada-"+posicion+"' name='aplicada-"+posicion+"' title='aplica-"+posicion+"' onChange='movio_normal(this.id,"+posicion+",this.name)' />";		   
		   

			otraT=otraT+2;inc++; fila++;posicion++;
			//document.getElementById("filas").value=fila;


        });
	
     function NComensal (id, f)
     {
     	var NumE="<?php echo $NumE;?>";
     	NumE=parseInt(NumE);
     	var nne=0;
     	if(f>1)
				{
					for (var i =1; i<f; i++) 
					{
						nne+=parseFloat(NumE);
						//console.log("fila: "+posicion+" NE: "+NumE);
					}
				}
		var C=parseInt($("#"+id).val());
		for (var i = 1; i <= NumE; i++) 
		{
			var fa=parseFloat($("#factor"+(nne+i)+"-"+i).val());
			$("#Comision-"+(nne+i)).val(C*fa);
			var t=parseFloat(TotalComisiones(i));
			$("#Comision"+i).val(t);
			var s=parseFloat($("#sueldo"+i).val());
			var b=s+t; //alert("sueldo "+s+" comisi "+t+" bruto "+b);
			$("#Bruto"+i).val(b);

			var d=parseFloat($("#descuento"+i).val());
			if(isNaN(d)){d=0;}

			$("#Neto"+i).val(b+d);

		}			    	
     }
  		
     function descuentos( id,e)
     { 
		var n=parseFloat($("#Bruto"+e).val());
			if(isNaN(n)){n=0;}
			var d=parseFloat($("#descuento"+e).val());

			$("#Neto"+e).val(n+d);


     }
     $(".sueldoTr").change(function() {
     	    
     	var d=parseFloat($(this).val());
     	var indice=parseInt($(this).attr('title'));
     //	alert(indice);
     	var s=parseFloat($("#sueldo"+indice).attr('title'));
     	//alert(s);
     	var t=d*s;
     	$("#sueldo"+indice).val(t);
     });
</script>
</html>