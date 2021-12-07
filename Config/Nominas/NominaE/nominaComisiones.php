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

?>

<div align="center" >
		<form action="guardarComision.php" name="NominaComisiones" method="post"  accept-charset="utf-8">
			<table border="3" id="tComision">
				<caption>Nomina de Comisión</caption>
				<thead>
					<tr>
						<th><b>Contratos</b></th>
						<th><b>Comensales</b></th>
						<?php
							$empleados=mysql_query("SELECT id,nombre,categorias FROM Empleados");
							$numEmpleados=0;
							$cnt=0;
							while ($e=mysql_fetch_array($empleados))
							{
								$categoriaEmpleado=$e['categorias'];
								$categoriaEmpleado=explode(",",$categoriaEmpleado);

								for ($i=0; $i <count($categoriaEmpleado); $i++) 
								{ 
									if($categoriaEmpleado[$i]=="Comisiones")	
									{$cnt++;
										echo "<th><b>Factor</b></th>";
										echo "<th><b>".$e['nombre']."</b></th>";
										echo "<input type='hidden' name='nombre".$cnt."' value='".$e['nombre']."-".$e['id']."'>";
										$numEmpleados++;
									}
								}								
								
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
						$ca=mysql_query("SELECT * FROM Empleados");$inc=0;
						while ($com=mysql_fetch_array($ca)) 
						{
							$comi=explode(",", $com['categorias']);
							for ($i=0; $i <count($comi) ; $i++) 
							{ 
								if ($comi[$i]=='Comisiones') 
								{$inc++;
									echo "
									<td align='center' bgcolor='#4CFFBB'><input type='number' style='width:25px' name='trabaja".$inc."' title='".$com['sueldo']."' id='".$inc."' class='diasT'  required /></td>									
									<td align='center' bgcolor='#4CFFBB'><input type='text' style='width:55px' name='Sueldo".$inc."' id='Sueldo".$inc."' value='0' class='".$inc."' required readonly /></td>";
								}
							}							
						}
					?>	
				</tr>					
				<tr>					
                 <td align="right" colspan="2" bgcolor="#D97795"><b>Puntos</b></td>
                 <?php
					$ca=mysql_query("SELECT * FROM Empleados");$inc=0;
						while ($com=mysql_fetch_array($ca)) 
						{
							$comi=explode(",", $com['categorias']);
							for ($i=0; $i <count($comi) ; $i++) 
							{ 
								if ($comi[$i]=='Comisiones') 
								{$inc++;
									echo "
									<td align='center' bgcolor='#D97795'></td>									
									<td align='center' bgcolor='#D97795'><input type='text'  style='width:45px' name='Pt-".$inc."' value='0' required /></td>";
								}
							}							
						}
                ?>
                </tr>
                 <tr>
					<td align='center' colspan="2">COMISION</td>	
                    <?php
						$ca=mysql_query("SELECT * FROM Empleados");
						$co=0;						
									while ($com=mysql_fetch_array($ca)) 
									{
										
										$comi=explode(",", $com['categorias']);
										for ($i=1; $i <=count($comi) ; $i++) 
										{ 
											if ($comi[$i]=='Comisiones') 
											{ $co++;
												echo "
												
												<td align='center' colspan='2'>
												
												<p name='Comision".$co."' id='Comisiont".$co."'title='Comision".$co."'></p>
												<input type='hidden' name='Comision".$co."' id='Comision".$co."' title='Comision".$co."'>
												</td>";
											}
										}							
									}			
					?>							
				</tr> 
				<tr>
					<td align='center' colspan="2">BRUTO</td>	
                    <?php
						$ca=mysql_query("SELECT * FROM Empleados");
						$co=0;						
									while ($com=mysql_fetch_array($ca)) 
									{
										
										$comi=explode(",", $com['categorias']);
										for ($i=1; $i <=count($comi) ; $i++) 
										{ 
											if ($comi[$i]=='Comisiones') 
											{ $co++;
												echo "
												
												<td align='center' colspan='2'>
												
												<p name='Comision".$co."' id='Brutot".$co."' title='Comision".$co."'></p>
												<input type='hidden' name='Bruto".$co."' id='Bruto".$co."' title='Comision".$co."'>
												</td>";
											}
										}							
									}			
					?>							
				</tr>          
				<tr>
					<td align='center' colspan="2">DESCUENTOS</td>	
                    <?php
						$ca=mysql_query("SELECT * FROM Empleados");
						$co=0;						
									while ($com=mysql_fetch_array($ca)) 
									{
										
										$comi=explode(",", $com['categorias']);
										for ($i=1; $i <=count($comi) ; $i++) 
										{ 
											if ($comi[$i]=='Comisiones') 
											{ $co++;
												echo "
												
												<td align='center' colspan='2'>
												
												<input type='number' name='Descuento".$co."' class='Descuento".$co."' id='Descuento".$co."' value='0' placeholder='Descuento  ó Aumento' onchange='calculaNeto();'>												
												</td>";
											}
										}							
									}			
					?>							
				</tr>             				
				<tr>
					<td align='center' colspan="2">NETO</td>	
                    <?php
						$ca=mysql_query("SELECT * FROM Empleados");
						$co=0;						
									while ($com=mysql_fetch_array($ca)) 
									{
										
										$comi=explode(",", $com['categorias']);
										for ($i=1; $i <=count($comi) ; $i++) 
										{ 
											if ($comi[$i]=='Comisiones') 
											{ $co++;
												echo "
												
												<td align='center' colspan='2'>
												
												<p name='Comision".$co."'  title='Comision".$co."' id='Netot".$co."'></p>
												<input type='hidden' name='Neto".$co."' id='Neto".$co."'  title='Comision".$co."' />
												</td>";
											}
										}							
									}			
					?>							
				</tr>          
				</tbody>
			</table>
			<input type="hidden"  class="Fcontratos" value="3">			
			<input type="hidden" name="Filas" class="Filas" >			
		</form>
</div><br/><br/>
<div align="center">
	<button id="add">Agregar</button>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<button id="save">Guardar</button>
</div>

	<script src="comision.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>