<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<?php
	require('../../configuraciones.php');
//require('funciones.php');
conectar();
$id=$_GET['i'];
?>

<div align="center" >
<h1>Confirmar Nomina Comisiones</h1>
		<form action="guardarComision.php" name="NominaComisiones" method="post" accept-charset="utf-8">
			<table border="3" id="tComision">
				<caption>Nomina de Comisión</caption>
				<thead>
					<tr>
						<th><b>Contratos</b></th>
						<th><b>Comensales</b></th>
						<?php
							$empleados=mysql_query("SELECT nombres,id FROM Cornfirmacion_Nomina_Comision Where id=".$id);
							$numEmpleados=0;
							$cnt=0;							
							 $e=mysql_fetch_array($empleados);

							$no=explode(",",$e['nombres']);
						
							for ($i=1; $i <count($no) ; $i++) 
							{ 		
							$n=explode("-",$no[$i]);
									$cnt++;
										echo "<th><b>Factor</b></th>";
										echo "<th><b>".$n[0]."</b></th>";
										echo "<input type='hidden' name='nombre".$cnt."' value='".$n[0]."-".$n[1]."'>";
										$numEmpleados++;									
						
							}
							echo "<th><b>Normal</b></th>";
							echo "<th><b>Aplicada</b></th>";							
						?>
						<input type="hidden" name="nEmpleados" class="empleados" value="<?php echo $numEmpleados;?>">
					</tr>
				</thead>
				<tbody>
				<tr>
				   <td align="right" colspan="2" bgcolor='#4CFFBB'><b>Dias Trabajados</b></td>
					<?php
						$ca=mysql_query("SELECT dias_trabajados, sueldos FROM Cornfirmacion_Nomina_Comision Where id=".$id);$inc=0;
							$ca=mysql_fetch_array($ca);
							$comi=explode(",", $ca['sueldos']);
							$dt=explode(",", $ca['dias_trabajados']);
							for ($i=1; $i <count($comi) ; $i++) 
							{ 								
								$inc++;
									echo "
									<td align='center' bgcolor='#4CFFBB'>
										<input type='number' style='width:25px' name='trabaja".$inc."' title='".$comi[$i]."' id='".$inc."' class='diasT' value='".$dt[$i]."' />
									</td>		

									<td align='center' bgcolor='#4CFFBB'><input type='text' style='width:55px' name='Sueldo".$inc."' id='Sueldo".$inc."' value='".$comi[$i]."' class='".$inc."'  required readonly /></td>";								
							}							
						
					?>	
				</tr>					
				<tr>					
                 <td align="right" colspan="2" bgcolor="#D97795"><b>Puntos</b></td>
                 <?php
					$ca=mysql_query("SELECT puntos FROM Cornfirmacion_Nomina_Comision Where id=".$id);
					$inc=0;					
					$ca=mysql_fetch_array($ca);

							$comi=explode(",", $ca['puntos']);
							for ($i=1; $i <count($comi) ; $i++) 
							{ 								
								$inc++;
									echo "
									<td align='center' bgcolor='#D97795'></td>									
									<td align='center' bgcolor='#D97795'><input type='text'  style='width:45px' name='Pt-".$inc."' value='".$comi[$i]."' required /></td>";								
							}							
						
                ?>
                </tr>
					<?php
						$f=mysql_query("SELECT nombres,costos_comensal, contratos,comensales,factores,comisiones, normales, aplicadas FROM Cornfirmacion_Nomina_Comision WHERE id=".$id);
						$f=mysql_fetch_array($f);
						$con=explode(",",$f['contratos']);
						$costoComensal=explode(",",$f['costos_comensal']);
						$nComensales=explode(",",$f['comensales']);
						$fac=explode(",",$f['factores']);
						$comision=explode(",",$f['comisiones']);
						$normal=explode(",",$f['normales']);
						$aplicada=explode(",",$f['aplicadas']);
						$nom=explode(",",$f['nombres']);
						$nomb=count($nom);
						$fff=1;
						//$nom=$nom-1;
							for ($i=1; $i <count($con) ; $i++) 
							{ 
							echo "<tr id='PrecioComen-".$i."'>";
								echo "<td colspan='2'>Precio Por Comensal</td>";
								for ($j=1; $j <count($nom) ; $j++) 
								{ 
									echo "<td colspan='2' align='center' >
										<input style='width:70px;' type='text' name='pComensal-".$j."-".$i."' title='pComensales".$i."' value='".$costoComensal[$j]."' class='PrecioComensal".$i." ' onchange='PrecioComensal(this.value,".$i.")' />
									  </td>";
								}
							echo "</tr>
							  	  <tr>";
									echo "<td><input type='text' name='Contrato-".$i."'  style='width:60px' placeholder='Contrato' value='".$con[$i]."' /></td>";  	  	
									echo "<td><input style='width:40px;' type='number' min='0' name='nComensales-".$i."' title='Comensal-' id='Comensal' placeholder='Comensal' class='cComensales".$i."' value='".$nComensales[$i]."' onchange='PrecioComensal(this.id,".$i.");'></td>";  	  	
										$ha+=$nomb;
										$cont=1;
									for ($j=$fff; $j <$ha; $j++) 
									{ 
										echo "<td>
											<input style='width:50px;' type='text' title='factor' name='factor-".$j."-".$i."' class='factor-".$j.$i."'  value='".$fac[$j]."' />
											 </td>";
										echo "<td>
											<input style='width:50px;' type='text' title='x' class='comision".$j.$i." ".$j." rComisiones".$j."' name='comisionContrato-".$j."-".$i."' id='x' value='".$comision[$j]."' />
										      </td>";
										      $cont++;				
											if($cont==$nomb)
											{
												$fff+=$cont;					
												$cont=1;
											}
									}
									echo "<td><input style='width:40px;' type='number' min='0' class='normal-".$i."' value='".$normal[$i]."' name='normal-".$i."' title='normal' onchange='CalculaFactor(this.value,".$i.")' /></td>";
									echo "<td><input style='width:40px;' type='number' min='0' class='aplicada-".$i."' value='".$aplicada[$i]."' name='aplicada-".$i."' title='aplica' onchange='CalculaFactor(this.value,".$i.")' /></td>";

					    	echo "</tr>";
								
							}
							$ff=$i;
						
					?>
/////////////////////////////////////////////////////////////////////////////////////////////



                 <tr>
					<td align='center' colspan="2">COMISION</td>	
                    <?php
						$ca=mysql_query("SELECT suma_comisiones FROM Cornfirmacion_Nomina_Comision Where id=".$id);
						$co=0;						
						$ca=mysql_fetch_array($ca);
										
										$comi=explode(",", $ca['suma_comisiones']);
										for ($i=1; $i <count($comi) ; $i++) 
										{ 
											
											 $co++;
												echo "												
												<td align='center' colspan='2'>												
												<p name='Comision".$co."' id='Comisiont".$co."'title='Comision".$co."'>".$comi[$i]."</p>
												<input type='hidden' name='Comision".$co."' id='Comision".$co."' title='Comision".$co."' value='".$comi[$i]."' />
												</td>";
											
										}							
												
					?>							
				</tr> 
				<tr>
					<td align='center' colspan="2">BRUTO</td>	
                    <?php
						$ca=mysql_query("SELECT bruto FROM Cornfirmacion_Nomina_Comision Where id=".$id);
						$co=0;						
							$ca=mysql_fetch_array($ca);
										$comi=explode(",", $ca['bruto']);
										for ($i=1; $i <count($comi) ; $i++) 
										{ 
											
											 $co++;
												echo "
												
												<td align='center' colspan='2'>
												
												<p name='Comision".$co."' id='Brutot".$co."' title='Comision".$co."'>".$comi[$i]."</p>
												<input type='hidden' name='Bruto".$co."' id='Bruto".$co."' title='Comision".$co."' value='".$comi[$i]."' />
												</td>";
											
										}												
					?>							
				</tr>          
				<tr>
					<td align='center' colspan="2">DESCUENTOS</td>	
                    <?php
						$ca=mysql_query("SELECT descuentos FROM Cornfirmacion_Nomina_Comision Where id=".$id);
						$co=0;						
							$ca=mysql_fetch_array($ca);
										$comi=explode(",", $ca['descuentos']);
										for ($i=1; $i <count($comi) ; $i++) 
										{ 
											 $co++;
												echo "
												
												<td align='center' colspan='2'>
												
												<input type='number' name='Descuento".$co."' class='Descuento".$co."' id='Descuento".$co."'  placeholder='Descuento  ó Aumento' onchange='calculaNeto();'  value ='".$comi[$i]."' />												
												</td>";
											
										}							
											
					?>							
				</tr>             				
				<tr>
					<td align='center' colspan="2">NETO</td>	
                    <?php
						$ca=mysql_query("SELECT neto FROM Cornfirmacion_Nomina_Comision WHERE id=".$id);
						$co=0;						
						$ca=mysql_fetch_array($ca);				
										$comi=explode(",", $ca['neto']);
										for ($i=1; $i <count($comi) ; $i++) 
										{ 
										
											$co++;
												echo "
												
												<td align='center' colspan='2'>
												
												<p name='Comision".$co."'  title='Comision".$co."' id='Netot".$co."'>".$comi[$i]."</p>
												<input type='hidden' name='Neto".$co."' id='Neto".$co."'  title='Comision".$co."' value='".$comi[$i]."' />
												</td>";
										}							
							
					?>							
				</tr>          
				</tbody>
			</table>
			<input type="hidden"  class="Fcontratos" value="<?php echo $ff+3;?>" />			
			<input type="hidden" name="Filas" class="Filas" value="<?php echo (count($con)-1);?>" />			
			<input type="hidden" name="Confirma" class="Filas" value='<?php echo $_GET['i'];?>' />			
			<input type="hidden" name="fecha" id="Fecha" />			
			<input type="hidden" name="texto" id="Texto" />			
		</form>
</div><br/><br/>
<div align="center">
	<button id="add">Agregar</button>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<button id="confirmar">Confirmar</button>
</div>

	<script src="comision.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>