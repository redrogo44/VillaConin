<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Proyeccion</title>
 		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> 		
 		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>

<?php
require("../funciones2.php");
		conectar();		
?>
</head>
<body>


<?php
if (isset($_GET['Modifica'])) 
{
	echo'
	<div align="center">
	<br>
		<span><b>MENU PARA EL CONTRATO NUMERO '.$_GET['Numero'].'</b></span>';
		
			 $ccs=mysql_query("SELECT * FROM contrato Where Numero='".$_GET['Numero']."' ");
			$cs=mysql_fetch_array($ccs);			
		$com=total_comensales($cs['Numero'],$cs['facturado']);
		//   PLATILLOS
		$pls=mysql_query("SELECT * FROM `logistica_menu`WHERE `contrato` = '".$cs['Numero']."' ");

			while($ps=mysql_fetch_array($pls))
			{
				$np=$ps['titulo'].",".$np;
			}
		
		echo'<br>
				<font><b>Tipo de Evento</b></font>
				<font><b>'.$cs['tipo'].'</b></font><br>						
				<font><b>Numero de Comensales: </b></font>
				<font><b>'.($com[0]+$cs['c_adultos']+$com[1]+$cs['c_jovenes']+$com[2]+$cs['ninos']).'</b></font><br>
				<font color="#F99"><b>Platillos Seleccionados: </b></font>
				<font color="#F99"><b>'.$np.'</b></font><br><br>
			';

			echo '<form action="guarda_proyeccion.php" method="post"  name="guardap" accept-charset="utf-8">
		<input type="hidden" name="Contrato" value="'.$_GET['Numero'].'">
			';				
				$pr=mysql_query("SELECT * FROM `Proyeccion_menu` WHERE Contrato='".$cs['Numero']."' ");

				while ($proy=mysql_fetch_array($pr)) 
				{		
					$inc++;
											echo "
													<table border='10' bordercolor='#F98' >
														<caption>PLATILLOS</caption>														
														<tbody>
														<tr>	
															<td align='center' ><font><b>PLATILLO</b></font></td>
															<td align='center' ><font><b>INGREDIENTES</b></font></td>
															<td align='center' ><font><b>REQUERIDO</b></font></td>									
															<td align='center' ><font><b>TOTAL</b></font></td>
														</tr>
									
													";										
												$menu=mysql_fetch_array(mysql_query("SELECT * FROM Menus WHERE id_menu=".$proy['menu']));
																	$in=explode(",",$menu['ingredientes']);
																	$can=explode(",",$menu['cantidades']);
											$lp=mysql_fetch_array(mysql_query("SELECT * FROM `logistica_menu` WHERE `id`=".$proy['id_logistica']));																	
											
											echo " <input type='hidden' name='Menu-".$inc."' value='".$menu['id_menu']."' style='display:none' />";
											echo " <input type='hidden' name='Comensales-".$inc."' value='".$lp['cantidad']."' ";

												echo "<tr >
															
														<td align='center' rowspan=".count($in).">".$menu['nombre']."<br><br>"."<b>Comensales <input type='number' n value='".$p['cantidad']."' style='width:40px;background-color:#00FF9E;'  onchange='calcula(this.value,".$inc.",".count($in).",".$p['cantidad'].");'/>"."</td>										
															
																";
																	$in=explode(",",$menu['ingredientes']);
																	$tot=explode(",",$proy['total']);
																	for ($i=1; $i <count($in) ; $i++) 
																	{ 
																		//echo ($can[$i]*$proy['comensales'])."  ".($can[$i]."  ".$proy['comensales']);
																		$ingr=mysql_fetch_array(mysql_query("SELECT * FROM ingredientes WHERE id=".$in[$i]));

																		echo "
																				<th align='center' bgcolor='#FFDA52'>".$ingr['nombre']." ".$can[$i]." ".$ingr['unidad']." </th>																		
																				<td align='center'><input type='number' name='".$inc."requerido".$i."' id='requerido".$i."' value='".($can[$i]*$lp['cantidad'])."' style='width:50px;background-color: #59C3F5;' onchange='calcula_total(this.value,".$i.",".$inc.");' > ".$ingr['unidad']." <input type='hidden' name='".$inc."ingrediente".$i."' value='".$ingr['id']."' style='display:none' /></td>
																				<td align='center'><input type='number' name='".$inc."total".$i."' value='".$tot[$i]."' id='".$inc."total".$i."' title='".$inc."total".$i."' style='width:50px;background-color: #DCED7F; '></td>																			
																			  <tr>
																			  ";
																	}
																	echo " <input type='hidden' name='cantidad_Ingredientes-".$inc."' value='".count($in)."' style='display:none' />";
																	echo " <input type='hidden' name='id_proyeccion-".$inc."' value='".$proy['id']."' style='display:none' />";
															
											
												echo"							
												</tbody>
												</table>
												";

				}

				echo " <input type='hidden' name='cantidad_menus' value='".$inc."'>
				<input type='hidden' name='Modifica' value='1' style='display:none' />";
echo "
			<input type='button'  value='Modificar'  name='Modifica' onclick='modificar();'>
	</form>
</div>";
}
else
{
	?>
	<div align="center" id='nuevo'>
	<br>
		<span><b>MENU PARA EL CONTRATO NUMERO <?php echo $_GET['Numero'];?></b></span>	
		<?php
		
			 $cc=mysql_query("SELECT * FROM contrato Where Numero='".$_GET['Numero']."' ");
			$c=mysql_fetch_array($cc);			
		$comen=total_comensales($c['Numero'],$c['facturado']);
		//   PLATILLOS
		$pl=mysql_query("SELECT * FROM `logistica_menu`WHERE `contrato` = '".$c['Numero']."' ");
			while($p=mysql_fetch_array($pl))
			{
				$np=$p['titulo']." ,".$np;
			}
		?><br>
		<font color="#F00"><b>Tipo de Evento: </b></font>
		<font color="#F00"><b><?php echo $c['tipo']; ?></b></font><br>
		<font color="#F60"><b>Numero de Comensales: </b></font>
		<font color="#F60"><b><?php echo $comen[0]+$c['c_adultos']+$comen[1]+$c['c_jovenes']+$comen[2]+$c['ninos']; ?></b></font><br>
		<font color="#F99"><b>Platillos Seleccionados: </b></font>
		<font color="#F99"><b><?php echo $np; ?></b></font><br><br>
	
	<form action="guarda_proyeccion.php" method="post" name='guarda' accept-charset="utf-8">
		<input type="hidden" name="Contrato" value="<?php echo $_GET['Numero'];?>">
		<?php

			$pl=mysql_query("SELECT * FROM `logistica_menu`WHERE `contrato` = '".$c['Numero']."' ");
			$inc=0;
				while($p=mysql_fetch_array($pl))
				{
										$m=explode("%", $p['menu']);
										//echo count($m);
										if ($p['menu']!='')
										{
											$inc++;
						echo " <input type='hidden' name='id_logistica-".$inc."' value='".$p['id']."' style='display:none' />";																
											echo "
													<table border='10' bordercolor='#F98' bgcolor='#FDE5BC'>
														<caption>&nbsp;</caption>
														<thead>
															<tr>
																<th colspan='5' align='center'>".$p['titulo']." # de Comensales: <font color='#F99'><b>".$p['cantidad']."</b></font></th>
															</tr>
														</thead>
														<tbody>
														<tr>	
															<td align='center' ><font><b>PLATILLO</b></font></td>
															<td align='center' ><font><b>INGREDIENTES</b></font></td>
															<td align='center' ><font><b>REQUERIDO</b></font></td>									
															<td align='center' ><font><b>TOTAL</b></font></td>
														</tr>
									
													";
											for ($i=0; $i <count($m) ; $i++) 
											{ 
												$menu=mysql_fetch_array(mysql_query("SELECT * FROM Menus WHERE id_menu=".$m[$i]));
																	$in=explode(",",$menu['ingredientes']);
																	$can=explode(",",$menu['cantidades']);
																	$in=explode(",",$menu['ingredientes']);																	
											
											echo " <input type='hidden' name='Menu-".$inc."' value='".$menu['id_menu']."' style='display:none' />";
											echo " <input type='hidden' name='Comensales-".$inc."' value='".$p['cantidad']."' style='display:none' />";


												echo "<tr >
															
														<td align='center' rowspan=".count($in).">".$menu['nombre']."<br><br>"."<b>Comensales <input type='number' n value='".$p['cantidad']."' style='width:40px;background-color:#00FF9E;'  onchange='calcula(this.value,".$inc.",".count($in).",".$p['cantidad'].");'/>"."</td>
															
																";
																	for ($i=1; $i <count($in) ; $i++) 
																	{ 
																		$ingr=mysql_fetch_array(mysql_query("SELECT * FROM ingredientes WHERE id=".$in[$i]));
																		echo "
																				<th align='center'>".$ingr['nombre']." ".$can[$i]." ".$ingr['unidad']." </th>																		
																				<td align='center'><input type='number' name='".$inc."requerido".$i."' id='".$inc."requerido".$i."' value='".($can[$i]*$p['cantidad'])."' style='width:50px;background-color: #59C3F5;' onchange='calcula_total(this.value,".$i.",".$inc.");' readonly > ".$ingr['unidad']." <input type='hidden' name='".$inc."ingrediente".$i."' value='".$ingr['id']."' style='display:none' /></td>
																				<td align='center'><input type='number' name='".$inc."total".$i."' value='".($can[$i]*$p['cantidad'])."' id='".$inc."total".$i."' title='".$inc."total".$i."' style='width:60px;background-color:#EFFF01;' readonly></td>																			
																			  <tr>
																			  ";
																	}
																	echo " <input type='hidden' name='cantidad_Ingredientes-".$inc."' value='".count($in)."' style='display:none' />";
															
											}	
												echo"							
												</tbody>
												</table>
												";
										}																
				}


		?>
<br>		<input type="button" onclick="guardar();" value="Guardar">
	
<?php
}
?>
		<input type="hidden" name="cantidad_menus" value="<?php echo $inc; ?>">
	</form>
</div>
</body>
	<script type="text/javascript">
	function guardar()
	{
		if (confirm("ESTA USTED SEGUR@ DE GUARDAR LA PROYECCION")) 
			{guarda.submit();}
	}
		function calcula_total(v,f,inc)
		{
			//var t=document.getElementById(inc+'requerido'+f).value;
			//alert(t);
			document.getElementById(inc+'total'+f).value=v;
		}
	function muestra_nuevo()
	{
		alert("entro");
								
	}
	function calcula(a,b,c,d)	// #comensales , # de Menu, # de Ingredientes, # de Comensales originales
	{
		//alert('Entro '+a+" "+b+" "+c+" "+d);
		c=parseInt(c);
		for (var i=1; i <c; i++) 
		{
			//alert(b+"requerido"+c);
			var inc =document.getElementById(b+"requerido"+i).value; //ingrediente
			//alert(inc);
			inc=parseInt(inc);
			var ti=(inc/d);
			document.getElementById(b+'total'+i).value=(a*ti);	
		}
	}
	function modificar()
	{
		if (confirm("ESTA USTED SEGUR@ DE GUARDAR LA PROYECCION")) 
			{guardap.submit();}
	}
	</script>
</html>