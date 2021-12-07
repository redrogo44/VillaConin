<?php
require('../configuraciones.php');
	conectar();
	validarsesion();
	$nivel=$_SESSION['niv'];
	$_SESSION['usu']=$_GET['usuario'];
	date_default_timezone_set('America/Mexico_City');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Detalle de Cuenta</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<style type="text/css" media="screen">
		#resumen #Saldo1
		{
			display: inline-block;
			vertical-align: top;

		}
		/*
		#resumen
		{
			background: #F00;
		}
		#Saldo1
		{
			background: blue;
		}*/
	</style>
</head>
<body>
	<div align="center" class="col-lg-12">
			<h1>Detalle de Cuenta "Efectvo"</h1>
			<div>
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<label><font color="green"><b>De</b></font></label>&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="date" name="fecha1" />&nbsp;&nbsp;&nbsp;&nbsp;
					<label><font color="red"><b>Hasta</b></font></label>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php
					echo "<input type='date' name='fecha2' max='".date('Y-m-d')."'/>&nbsp;&nbsp;&nbsp;&nbsp;";
					//echo date('Y-m-d');
					?>
				<input type="submit" name='submit'>
				</form>
			</div>
	<?php if ($_POST['submit']):
		echo "<div id='fechas' align='center'><h2><font><b>FECHAS DE ".$_POST['fecha1']." HASTA ".$_POST['fecha2']."</b></font></h2></div>";		
		$info=mysql_fetch_array(mysql_query("select * from Cuentas where id=2"));
	?>
			<div id="Saldo1" class="col-lg-6"> 
				<h3>Calculo de Saldo Inicial</h3>
				<p>El saldo inicial se calcula obteniendo el saldo inicial al momento de crear la cuenta, hasta la fecha inicial del rango de Fechas mas (+) los movimientos recibidos, menos (-) los movimientos realizados.</p>
				<p>Saldo Inicial Inicio de los Tiempos: <?php echo $info["saldo_inicial"];?></p>
				<table>
					<caption>Movimientos Recibidos hasta la fecha <?php echo $_POST['fecha1']?></caption>
					<thead>
						<tr>
							<th>Banco Emisor</th>
							<th>Cuenta Emisora</th>
							<th>Cantidad</th>
							<th>Concepto</th>							
							<th>Fecha</th>							
						</tr>
					</thead>
					<tbody>
						<?php
						
							$mr=mysql_query("SELECT * FROM Movimientos_Cuentas WHERE  fecha <'".$_POST["fecha1"]."'  AND cuenta_receptora=2 AND estatus='activo' ");
							$movRealizados=0;
							while($m=mysql_fetch_array($mr))
							{								
								$cuenta=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$m['cuenta_emisor']));
								$banco=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$m['banco_emisor']));
								if($cuenta['alias']==''){$cuenta['alias']=$m['cuenta_emisor'];}
								if($banco['nombre']==''){$banco['nombre']=$m['banco_emisor'];}
								echo "<tr>";
										echo "  <td>".$banco['nombre']."</td>
												<td>".$cuenta['alias']."</td>
												<td>".$m['cantidad']."</td>
												<td>".$m['concepto']."</td>			
												<td>".$m['fecha']."</td>			
											  ";
											  $movRealizados+=$m['cantidad'];
								echo "</tr>";
							}
						?>
						<tr><td colspan="2">Total:</td><td id="MovimientosRecibidos"><?php echo $movRealizados;?></td></tr>
					</tbody>
				</table>
				<br/>
					<table>
					<caption>Movimientos Realizados hasta la fecha <?php echo $_POST['fecha1']?></caption>
					<thead>
						<tr>
							<th>Banco Receptor</th>
							<th>Cuenta Receptora</th>
							<th>Cantidad</th>
							<th>Concepto</th>							
							<th>Fecha</th>							
						</tr>
					</thead>
					<tbody>
						<?php
						
							$mr=mysql_query("SELECT * FROM Movimientos_Cuentas WHERE  fecha <'".$_POST["fecha1"]."'  AND cuenta_emisor=2 AND estatus='activo' ");
							$movRealizados=0;
							while($m=mysql_fetch_array($mr))
							{								
								$cuenta=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$m['cuenta_receptora']));
								$banco=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$m['banco_receptor']));
								if($cuenta['alias']==''){$cuenta['alias']=$m['cuenta_receptora'];}
								if($banco['nombre']==''){$banco['nombre']=$m['banco_receptor'];}
								echo "<tr>";
										echo "  <td>".$banco['nombre']."</td>
												<td>".$cuenta['alias']."</td>
												<td>".$m['cantidad']."</td>
												<td>".$m['concepto']."</td>			
												<td>".$m['fecha']."</td>			
											  ";
											  $movRealizados+=$m['cantidad'];
								echo "</tr>";
							}
						?>
						<tr><td colspan="2">Total:</td><td id="MovimientosRealizados"><?php echo $movRealizados;?></td></tr>
					</tbody>
				</table>
				<!--  	//////////////////////////////////////////////////////////////////////////////	-->
					<table>
					<caption>Movimientos Recibidos ENTRE FECHAS </caption>
					<thead>
						<tr>
							<th>Banco Emisor</th>
							<th>Cuenta Emisora</th>
							<th>Cantidad</th>
							<th>Concepto</th>							
							<th>Fecha</th>							
						</tr>
					</thead>
					<tbody>
						<?php
						
							$mr=mysql_query("SELECT * FROM Movimientos_Cuentas WHERE fecha>='".$_POST["fecha1"]."' AND fecha<='".$_POST["fecha2"]."' AND cuenta_receptora=2 and estatus='activo'");
							$movRealizados=0;
							while($m=mysql_fetch_array($mr))
							{								
								$cuenta=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$m['cuenta_emisor']));
								$banco=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$m['banco_emisor']));
								if($cuenta['alias']==''){$cuenta['alias']=$m['cuenta_emisor'];}
								if($banco['nombre']==''){$banco['nombre']=$m['banco_emisor'];}
								echo "<tr>";
										echo "  <td>".$banco['nombre']."</td>
												<td>".$cuenta['alias']."</td>
												<td>".$m['cantidad']."</td>
												<td>".$m['concepto']."</td>			
												<td>".$m['fecha']."</td>			
											  ";
											  $movRealizados+=$m['cantidad'];
								echo "</tr>";
							}
						?>
						<tr><td colspan="2">Total:</td><td id="MovimientosRecibidosF"><?php echo $movRealizados;?></td></tr>
					</tbody>
				</table>
				<br/>
					<table>
					<caption>Movimientos Realizados ENTRE FECHAS</caption>
					<thead>
						<tr>
							<th>Banco Receptor</th>
							<th>Cuenta Receptora</th>
							<th>Cantidad</th>
							<th>Concepto</th>							
							<th>Fecha</th>							
						</tr>
					</thead>
					<tbody>
						<?php
						
							$mr=mysql_query("SELECT *FROM `Movimientos_Cuentas` WHERE fecha >= '".$_POST['fecha1']."' AND fecha <= '".$_POST['fecha2']."' AND `cuenta_emisor`=2 and estatus='activo' ");
							$movRealizados=0;
							while($m=mysql_fetch_array($mr))
							{								
								$cuenta=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$m['cuenta_receptora']));
								$banco=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$m['banco_receptor']));
								if($cuenta['alias']==''){$cuenta['alias']=$m['cuenta_receptora'];}
								if($banco['nombre']==''){$banco['nombre']=$m['banco_receptor'];}
								echo "<tr>";
										echo "  <td>".$banco['nombre']."</td>
												<td>".$cuenta['alias']."</td>
												<td>".$m['cantidad']."</td>
												<td>".$m['concepto']."</td>			
												<td>".$m['fecha']."</td>			
											  ";
											  $movRealizados+=$m['cantidad'];
								echo "</tr>";
							}
						?>
						<tr><td colspan="2">Total:</td><td id="MovimientosRealizadosF"><?php echo $movRealizados;?></td></tr>
					</tbody>
				</table>
				<!-- 	///////////////////////////////////////////////////////////////////////		-->
				<table>
					<caption>Recaudacion Alimentos</caption>
					<thead>
						<tr>
							<th>ticket</th>
							<th>Contrato</th>
							<th>Total</th>
							<th>Fecha</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$tt=0;
							$ti=mysql_query("SELECT * FROM  `tickets`  WHERE  `fecha` >=  '".$_POST['fecha1']."' AND  `fecha` <=  '".$_POST['fecha2']."' AND estatus='ACTIVO' ");
							while ($t=mysql_fetch_array($ti)) 
							{
								echo "<tr>
										<td>".$t['folio']."</td>
										<td>".$t['referencia']."</td>
										<td>".$t['Total']."</td>
										<td>".$t['fecha']."</td>
									  </tr>";
									  $tt+=$t['Total'];
							}
						?> 
						<tr><td colspan="2">Total:</td>
							<td><b id="tick"><?php echo $tt;?></b></td>
						</tr>
					</tbody>
				</table>
			</div>
		<div id="resumen" class="col-lg-6">
			<p>Saldo Inicial Inicio de los Tiempos: <?php echo $info["saldo_inicial"];?></p>
			<p>Total de Movimientos Recibidos <b id="rec"></b></p>
			<p>Total de Movimientos Realizados <b id="rea"></b></p>
			<p>Total de Ticket Alimentos <b id="tic"></b></p>
			<p>Total de Movimientos Realizados ENTRE FECHAS  <b id="reaF"></b></p>
			<p>Total de Movimientos Recibidos ENTRE FECHAS  <b id="recF"></b></p>
			<p>Saldo Inicial =(SI inici de los tiempos + Movimientos Recibidos - Movimientos Realizados)</p>						
			<p>Saldo Inicial: <?php echo saldo_inicial("2");?></p>
			<br/>
			<p>Saldo Final=(Saldo Inicial + Movimientos Realizados ENTRE FECHAS + eventos Recaudacion Alimentos - Movimientos Realizados ENTRE FECHAS)</p>
			<p>Saldo Final: <b id="SalF"></b></p>
		</div>
	</div>
	<?php endif?>
</body>

<?php
///////////////// 	FUNCIONES PHP 		//////////////////////////

function saldo_inicial($id){
	//obtenemos saldo inicial cuando se creo la cuenta
	$info=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$id));
	///para obtener el saldo inicial entre el rango de fechas se calcula el saldo hasta la fecha de inicio del rango para tomarla como saldo inicial
	$saldo_inicial=$info["saldo_inicial"]+totalMovimientosRecibidos2($id)-totalMovimientosRealizados2($id);
	return $saldo_inicial;
}
function totalMovimientosRecibidos2($id)
{//echo "SELECT SUM(cantidad) AS t FROM Movimientos_Cuentas WHERE  fecha >='".$_POST["fecha1"]."' AND fecha<= '".$_POST['fecha2']."' AND cuenta_receptora=".$id;
	$t=mysql_fetch_array(mysql_query("SELECT SUM(cantidad) AS t FROM Movimientos_Cuentas WHERE  fecha <'".$_POST["fecha1"]."'  AND cuenta_receptora=".$id." and estatus='activo'"));
	return $t['t'];
}
function totalMovimientosRealizados2($id)
{
	$t=mysql_fetch_array(mysql_query("SELECT SUM(cantidad) AS t FROM Movimientos_Cuentas WHERE fecha < '".$_POST["fecha1"]."'  AND cuenta_emisor=".$id." and estatus='activo'"));
	return $t['t'];
}
?>
<script type="text/javascript">
	var rec=parseFloat($("#MovimientosRecibidos").text());
	var rea=parseFloat($("#MovimientosRealizados").text());
	var recF=parseFloat($("#MovimientosRecibidosF").text());
	var reaF=parseFloat($("#MovimientosRealizadosF").text());
	var tic=parseFloat($("#tick").text());
	$("#rec").text(rec);
	$("#rea").text(rea);
	$("#tic").text(tic);
	$("#recF").text(recF);
	$("#reaF").text(reaF);
	

var sf=(recF+tic)-reaF;
$("#SalF").text(sf);
	
</script>
</html>