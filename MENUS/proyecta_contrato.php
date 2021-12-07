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
	mysql_query("DELETE FROM `Proyeccion_menu` WHERE `Contrato`='".$_GET['Numero']."' ");
}

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

			$pl=mysql_query("SELECT * FROM `logistica_menu`WHERE `contrato` = '".$_GET['Numero']."' ");
			$inc=1;
			$TotalPrice=0;
				while($p=mysql_fetch_array($pl))
				{

										$m=explode("%", $p['menu']);
										//echo count($m);
										if ($p['menu']!='')
										{
											echo "
													<table border='10' bordercolor='#F98' bgcolor='#FDE5BC'>
														<caption>&nbsp;</caption>
														<thead>
															<tr>
																<th colspan='5' align='center'>".$p['titulo']." # de Comensales: <font color='#F00'><b>".$p['cantidad']."</b></font></th>																
															</tr>
														</thead>
														<tbody>
														<tr>	
															<td align='center' ><font color='#007CFF'><b>PLATILLO</b></font></td>
															<td align='center' colspan='2' ><font color='#007CFF'><b>INSUMO UNITARIO</b></font></td>
															
															<td align='center' ><font color='#007CFF'><b>Costo<br>Proporcional</b></font></td>
															<td align='center' ><font color='#007CFF'><b>TOTAL COMPRA</b></font></td>
														</tr>
									
													";
											for ($i=0; $i <count($m) ; $i++) 
											{ 
												echo " <input type='hidden' name='id_logistica-".$inc."' value='".$p['id']."' style='display:none' />";																												
												$menu=mysql_fetch_array(mysql_query("SELECT * FROM Menus WHERE id_menu=".$m[$i]));
																	$in=explode(",",$menu['ingredientes']);
																	$can=explode(",",$menu['cantidades']);
																	$in=explode(",",$menu['ingredientes']);	
																	$comentario=explode("|",$menu['comentarios']);																
											
											echo " <input type='hidden' name='Menu-".$inc."' value='".$menu['id_menu']."' style='display:none' />";
											echo " <input type='hidden' name='Comensales-".$inc."' id='Comensales-".$inc."' value='".$p['cantidad']."' style='display:none' />";


												echo "<tr >
															
														<td align='center' rowspan=".count($in).">".$menu['nombre']."<br><br>"."<b>CALCULA <input type='number'  value='".$p['cantidad']."' style='width:40px;background-color:#FF7700;'  onchange='calcula(this.value , ".$inc." , ".count($in)." , ".$p['cantidad'].");'/>"."</td>
														
																";
																	for ($j=0; $j <count($in) ; $j++) 
																	{ 
																		$ingr=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$in[$j]));
																		$inv=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$in[$j]));
																		
																		if($ingr["nombre"]!=''){
																			$auxprice=(($can[$j]*$p['cantidad'])/$inv["Equivalencia"])*$inv["precio"];
																			$TotalPrice+=$auxprice;
																		echo "
																				<th align='center'>".$ingr['nombre']." ".$can[$j]." ".$inv['UnidadMenu']." <input type='hidden'   id='".$inc."ingrediente".$j."'  value=".$can[$j]."> </th>

																				<td>".$comentario[$j]."</td>															
																				<td align='center' style='display:none'><input type='number'  id='".$inc."requerido".$j."' value='".$p['cantidad']."' style='width:40px;background-color:#00FF9E;' style='width:50px;background-color: #59C3F5;' onchange='calcula_total(this.value,".$j.",".$inc.",".$can[$j].",".$inv["precio"].",".$inv["Equivalencia"].");' /><input type='hidden' name='".$inc."ingrediente".$j."' value='".$ingr['id_producto']."' style='display:none' /></td>
																				<td>
																				<input type='hidden' value='".$inv["Equivalencia"]."' id='".$inc."Equiv".$j."'>
																				<input type='hidden' value='".$inv["precio"]."' id='".$inc."Price".$j."'>
																			
																				<input type='text' id='".$inc."CostoPr".$j."' class='precioX' name='' value=".number_format($auxprice,3)." disabled>
																				</td>
																				<td align='center'><input type='number' name='".$inc."total".$j."' value='".($can[$j]*$p['cantidad'])."' id='".$inc."total".$j."' title='".$inc."total".$j."' style='width:60px;background-color:#EFFF01;' readonly>".$inv['UnidadMenu']."</td>																			
																			  <tr>
																			  ";	
																		}else{
																			echo "<td colspan='2' align='center'>".$in[$j]."</td></tr>";
																		}																	
																	}
																	echo " <input type='hidden' name='cantidad_Ingredientes-".$inc."' value='".count($in)."' style='display:none' />";
																	echo " <input type='hidden' name='menu_logistica-".$inc."' value='".$p['menu']."' style='display:none' />";																	
												  $inc++;			
											}	
											
											
												echo"							
												</tbody>
												</table>
												";
										}	
											

				}
echo "<div style='color: yellow;  background-color: blue; width:500px;'><b>Total: $ </b><span><b id='PrecioTotal'>".number_format($TotalPrice,3)."</b></span></div>
		";

		?>
<br>		<input type="button" onclick="guardar();" value="Guardar">	
		<input type="hidden" name="cantidad_menus" value="<?php echo $inc; ?>">
	</form>
</div>
</body>
	<script type="text/javascript">
	var Totalf=<?php echo $TotalPrice;?>;
	function guardar()
	{
		if (confirm("ESTA USTED SEGUR@ DE GUARDAR LA PROYECCION")) 
			{guarda.submit();}
	}
		function calcula_total(v,f,inc,t)
		{
			
			//alert(v+" "+f+ " "+inc+" "+t);
			//var t=document.getElementById(inc+'requerido'+f).value;
			document.getElementById(inc+'total'+f).value=(v*t);			
			
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
			if(document.getElementById(b+"requerido"+i)){
				//alert(b+"requerido"+c);
				var inc =document.getElementById(b+"requerido"+i).value; //ingrediente
				//alert(inc);
				inc=parseInt(inc);
				var ti=(inc/d);
				var ii=document.getElementById(b+'ingrediente'+i).value;
				var anterior=document.getElementById(b+'total'+i).value;
				equ=document.getElementById(b+"Equiv"+i).value;
				price=document.getElementById(b+"Price"+i).value;
				costo=parseFloat(((a*ii)/equ)*price).toFixed(3);
				document.getElementById(b+"CostoPr"+i).innerHTML="$"+costo;
				document.getElementById(b+'total'+i).value=(a*ii);	
				document.getElementById("Comensales-"+b).value=a;
				var actual=document.getElementById(b+'total'+i).value;
				aux=((actual-anterior)/equ);
				var diff=aux*price;
				Totalf+=diff;
				document.getElementById("PrecioTotal").innerHTML="$"+parseFloat(Totalf).toFixed(3);
			}
			
		}
	}
	function calculam(a,b,c,d)
	{
		//alert('Entro '+a+" "+b+" "+c+" "+d);
		c=parseInt(c);
		for (var i=1; i<c; i++) 
		{
			//alert(b+"mrequerido"+c);
			var inc =document.getElementById(b+"mrequerido"+i).value; //ingrediente
			//alert(inc);
			inc=parseInt(inc);
			var ti=(inc/d);
			//alert('Total '+(a*ti));
			document.getElementById(b+'mtotal'+i).value=(a*ti);	
			
			document.getElementById("mComensales-"+b).value=a;			
			
		}
	}
	function modificar()
	{
		if (confirm("ESTA USTED SEGUR@ DE GUARDAR LA PROYECCION")) 
			{guardap.submit();}
	}
	</script>
</html>