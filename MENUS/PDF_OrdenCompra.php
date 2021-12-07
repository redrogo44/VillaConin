<?php
require('../funciones2.php');
conectar();
//print_r($_POST);
//////obtenemos el ultimo corte de cocina insumo
$strUltimioCorte="''";
$catInsumo=mysql_query("select * from categoria where tipo='INSUMO'");
while($recorreCat=mysql_fetch_array($catInsumo)){
	///obtenemos la fecha del último corte de inventario
	$prin=mysql_fetch_array(mysql_query("select * from producto where id_categoria=".$recorreCat["id_categoria"]));
	$fuc=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$prin["id_producto"]));
	$date=explode("-",$fuc["fecha"]);
	$strUltimioCorte=$strUltimioCorte."+'".$recorreCat["nombre"]." último corte:".$date[2]."/".$date[1]."/".$date[0]."'  ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Orden de Compra Contrato <?php echo $_GET['Numero']; ?></title> 
		<link rel="stylesheet" type="text/css" href="estilos.css" />
	<script>
		function muestraCortes(){
			alert(<?php echo $strUltimioCorte; ?>);
		}
	</script>
</head> 
<body id="body" onload="muestraCortes()">
<img id='logo' src="../Imagenes/Villa Conin.png" border="0">

<div align="center"> 
	<?php
		$c=explode(",",$_POST['Contratos']);
		$creales='';
		for ($i=1; $i <count($c) ; $i++) 
		{ 
			$pm=mysql_query("SELECT * FROM Proyeccion_menu WHERE Contrato='".$c[$i]."' ");
			if (mysql_num_rows($pm)) 
			{				
				$creales=$creales.",".$c[$i];
			}			
		}

		//echo "Existentes ".$creales;

	echo '
	
	<h2><b>EVENTOS SOCIALES VILLA CONIN S.A. de C.V. </b></h2>

	<font><b><h4>CONTRATOS : '.$creales.'</h4><b></font>
<br><br>
		<table border="3" bgcolor="">
				<caption>ORDEN DE COMPRA '.date('Y-m-d').'</caption>
				<thead>
					<tr>
						<th align="center" colspan="8"><b>ORDEN DE COMPRA GENERAL</b></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td align="center"><font><b>ID</b></font></td>
						<td align="center"><font><b>INGREDIENTE</b></font></td>
						<td align="center"><font><b>DESCRIPCION</b></font></td>
						<td align="center"><font><b>NECESIDAD<BR>UNIDAD<BR>RECETARIO</b></font></td>
						
						<td align="center"><font><b>NECESIDAD<BR>UNIDAD<BR>COMPRA</b></font></td>
						<td align="center"><font><b>TENGO<br>UNIDAD<BR>COMPRA</b></font></td>
						<td align="center"><font><b>FALTA<BR>UNIDAD<BR>COMPRA</b></font></td>
						<td align="center"><font><b>COMPRA FINAL</b></font></td>
						<td align="center"><font><b>PRECIO PRODUCTO</b></font></td>		
					</tr>
					';
					$c=explode(",",$creales);
					sort($c, SORT_NATURAL | SORT_FLAG_CASE);

						$ingredientes='';$ingre2='';$proveedor='';
					for ($j=1; $j <count($c); $j++) 
					{ 
						$pm=mysql_query("SELECT * FROM Proyeccion_menu WHERE Contrato='".$c[$j]."' ");
						
							while ($pr=mysql_fetch_array($pm)) 
							{
								$in=explode(",",$pr['ingredientes']);

								$tot=explode(",",$pr['total']);
								for ($i=1; $i <count($in) ; $i++) 
								{ 
										$ingredientes=$ingredientes.",".$in[$i]."-".$tot[$i];									
								}
							}
					}
					
						//echo $ingredientes;
									$x=explode(",",$ingredientes);
									sort($x, SORT_NATURAL | SORT_FLAG_CASE);
									$ingrs = "";
									for ($k=1; $k <count($x) ; $k++) 
									{ 
										$y=explode("-",$x[$k]);										

											//echo "SELECT * FROM ingredientes WHERE id=".$x[$k];
											$r=mysql_fetch_array(mysql_query("SELECT * FROM inventario WHERE id_producto=".$y [0]));
											//$prin=mysql_fetch_array(mysql_query("select * from Proveedor_menu where id=".$r["ProveedorMenu"]));
											if($r['ProveedorMenu'] != "")
											{												
												$proveedor=$proveedor.",".$r["ProveedorMenu"];												
											}	
										if (isset($T[$y[0]])) 
										{
											$T[$y[0]]=$T[$y[0]]+$y[1];
										}
										else
										{
											$T[$y[0]]=$y[1];
										}
									}	
									$Tc = $T;
									 sort($Tc, SORT_NATURAL | SORT_FLAG_CASE);
						//			echo "<pre>";var_dump($T);
								
									$pl = array_keys($T);
									foreach ($pl as $key => $value) 
									{
										$p2a .= $value.",";
									}

									//var_dump($pl);
									//
									$p2a= substr($p2a,1);
									$p2a= substr($p2a,0,-1);
									//echo "<br><br>".$p2a."<br><br>";
									//echo "SELECT id_producto FROM `producto` WHERE `id_producto` in(".$p2a.") ORDER BY nombre";
									$pll = mysql_query("SELECT id_producto FROM `producto` WHERE `id_producto` in(".$p2a.") ORDER BY nombre");
									while ($ppll = mysql_fetch_array($pll)) 
									{
										foreach ($T as $key => $value) {
											if($ppll['id_producto'] == $key)
											{
												$Tt[$ppll['id_producto']] = $value;
											}
										}

									}
									//var_dump($Tt);
									//echo "<pre>";
									
					//echo "<br>Proveedor: ".$proveedor;
						$p1 = explode(",", $proveedor);
						sort($p1, SORT_NATURAL | SORT_FLAG_CASE);
						$ppp = array_unique($p1);
					//	echo "<br> PROVEEDORES";											
					//	var_dump($ppp);
					//	echo "<br>";
						foreach ($ppp as $pp) {
							$prodd.=$pp.",";
						}
						$prodd = substr($prodd,1);
						$prodd= substr($prodd,0,-1);
					//	echo "<br><br> pp ".$prodd."<br><br>";
					//
					//	echo "SELECT * FROM Proveedor_menu WHERE id in(".$prodd.") ORDER BY razon_social";
						$vc = mysql_query("SELECT * FROM Proveedor_menu WHERE id in(".$prodd.") ORDER BY razon_social");	
						 						
													
						$inc=0;

						$p=explode(",",$proveedor);
						sort($p, SORT_NATURAL | SORT_FLAG_CASE);
						for ($b=1; $b <count($p) ; $b++) 
						{ 
							if (isset($O[$p[$b]])) 
							{
							}
							else
							{
								$O[$p[$b]]=$p[$b];
							}
						}

					$tInve=0;

						sort($O, SORT_NATURAL | SORT_FLAG_CASE);
						
						while ($data = mysql_fetch_array($vc))
						{ 
							//$jj=mysql_fetch_array(mysql_query("SELECT * FROM Proveedor_menu WHERE id=".$valor." ORDER BY razon_social "));
							echo "<tr><td colspan='8' align='center' bgcolor='lightblue'><b>".$data['razon_social']."</b></td></tr>";
							
							foreach ($Tt as  $indice => $valor2) 
							{
								//echo $valor." == ".$indice."<br>";
								$inc++;
				    			$iin=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$indice));
								$x2=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$indice));
			
				    								//echo $iin['proveedor']." == ".$valor."<br>";
				    							if ($x2["ProveedorMenu"]==$data['id']) 
				    							{
													if(is_numeric($indice)){
														echo "<input type='hidden' id='Preciop".$iin['id_producto']."' name='' value='".$x2['precio']."'>";
														
														$x3=mysql_fetch_array(mysql_query("select * from unidad where id_unidad=".$iin["id_unidad"]));
														$existencia=TengoInventario($iin["id_producto"]);
														 
														echo "<tr>";
														echo "<td><font><b>".$iin['id_producto']."</b></font></td>";
														echo "<td><font><b>".$iin['nombre']."</b></font></td>";
														echo "<td><font><b>".$iin['descripcion']."</b></font></td>";
														///necesito unidad recetario
														echo "<td><font><b>".number_format($valor2,3)." ".$x2["UnidadMenu"]."</b></font>data";
														
														//necesito unidad de inventario
														echo "<td><font>".number_format(($valor2/$x2["Equivalencia"]),3)."</font> ".$x3['nombre']."</td>";
														echo "<input type='hidden'  value='".($valor2/$x2["Equivalencia"])."'>";
														
														///tengo en unidad de inventario
														echo "<td><font id='tengo".$iin['id_producto']."'>".number_format($existencia,3)."</font> ".$x3['nombre']."</td>";
														
														///falta en undidad de inventario
														$faltante=$existencia-($valor2/$x2["Equivalencia"]);
														if($faltante<0){ 
															$faltante=$faltante*(-1);
														}else{
															$faltante=0;
														}
														echo "<td><font>".number_format($faltante,3)."</font> ".$x3['nombre']."</td>";
														echo "<input type='hidden' id='faltante".$iin['id_producto']."' value='".$faltante."'>";
													///input de compra de producto
														echo "<td><font><input style='width:60px;background-color: #FFC574;' type='number'  value='".$faltante."' id='required".$iin['id_producto']."' onchange='calcula(".$iin['id_producto'].",this.value);'></font>".$x3['nombre']."</td>";
														$tInve+=($faltante*$x2['precio']);
														$faltante=$faltante*$x2['precio'];

														echo "<td align='center'><b>$ </b>
															<input type='text' style='width:80px;' id='PrecioXX".$iin['id_producto']."' name='totalP' value='".number_format($faltante,3)."' disabled></td>";
														echo "</tr>";
													/*	
				    								echo "
						    								<tr>
						    									<td><font><b>".$iin['id_producto']."</b></font></td>
						    									<td><font><b>".$iin['nombre']."</b></font></td>
						    									<td><font><b>".$iin['descripcion']."</b></font></td>
						    									<td align='center'><font><b>".$valor2." ".$x2["UnidadMenu"]."</b></font><input type='hidden' id='proyectado".$inc."' value=".$valor2." ".$iin['unidad']."></td>
																<td>".($valor2/$x2["Equivalencia"])." ".$x3['nombre']."</td>
						    									<td><font><b>".$existencias." ".$x3["nombre"]."</b></font></td>
						    									<td align='left'><font color='#F00'><b id='falta".$inc."'>0</b></font>".$x3["nombre"]."</td>
						    									<td align='left'><input type='number' name='total' id='total".$inc."' value='".$valor2."' style='width:60px;background-color: #FFC574;'> ".$x3['nombre']."</td>    								
						    								  </tr>";*/
													}
						    					}
							}
						}
/*
						while (current($O)) 
						{
							/*echo key($O)." ".$O[key($O)]."<br>";
									$h=mysql_fetch_array(mysql_query("SELECT * FROM Proveedor_menu WHERE id=".key($O)));
									echo "<tr><td colspan='5' align='center'><font color='#F0484473'><b>".$h['razon_social']."</b></font></td></tr>";
										 while (current($T)) 
										 {
				    						//echo $T[key($T)]." == ".key($T)."<br>";										 	
										 	$inc++;
				    							//echo ("SELECT * FROM ingredientes WHERE id=".key($T));
				    								$iin=mysql_fetch_array(mysql_query("SELECT * FROM ingredientes WHERE id=".key($T) ));
				    							//echo $iin['proveedor']."<br>";				    								
				    						echo $O[key($O)]." == ".$iin['proveedor']."<br>";										 

				    							/*if ($O[key($O)]==$iin['proveedor']) 
				    							{
				    								echo "
						    								<tr>
						    									<td><font><b>".$iin['nombre']."</b></font></td>
						    									<td align='center'><font><b>".$T[key($T)]." ".$iin['unidad']."</b></font><input type='hidden' id='proyectado".$inc."' value=".$T[key($T)]." ".$iin['unidad']."></td>
						    									<td><font><b><input type='number' min='0' name='tengo' value='0' style='width:60px;background-color: #DCED7F; ' onchange='calcula(this.value,".$inc.");'></b></font></td>
						    									<td align='center'><font color='#F00'><b id='falta".$inc."'>0</b></font></td>
						    									<td align='center'><input type='number' name='total' id='total".$inc."' value='".$T[key($T)]."' style='width:60px;background-color: #FFC574;'> ".$iin['unidad']."</td>    								
						    								  </tr>";
						    							
				    							
					    						next($T);					    					
				    						}



							next($O);
						}*/

					echo "<td colspan='8' align='left'>TOTAL PRODUCTOS:  </td><td align='center'> <b>$</b><input style='width:80px;' type='text' id='Totalt' name='' disabled> </td>";
			echo'	</tbody>
		</table>
		<br><input type="button" id="bimprimir" name="imprimir" value="Imprimir" onclick="imprime();">
		';
	?>
</div>
<script type="text/javascript">
	Totaltt();	
	/*function calcula(a,b,equivalencia)
	{
		//alert(a+" - "+b);
		var p=document.getElementById('proyectado'+b).value;
		var t=(p-(a*equivalencia));
		if (t<0) 
			{
				t=0;
			}
		document.getElementById("falta"+b).innerHTML=t;
		document.getElementById("total"+b).value=t/equivalencia;
		//alert(p);
	} */
	function calcula(id,cantidad){
		//alert("Entro  "+cantidad);
		var faltante=document.getElementById("faltante"+id).value;
		if(parseFloat(cantidad)>=parseFloat(faltante)){
		
		}else{
			alert("Error la cantidad minima es "+faltante);
			document.getElementById("required"+id).value=faltante;
			
		}
		precioX(cantidad,id);
	}
	function precioX(f,i)  // PRECIO DE EL TOTAL DE LA COMPRA DE PRODUCTO ULTIMA COLUMNA DE LA TABLA
	{
		//alert(f+" "+i);
		var p=document.getElementById("Preciop"+i).value;
		//alert(p);
		p=parseFloat(p);
		p=p*f;		
		document.getElementById("PrecioXX"+i).value=p;


		Totaltt();
    		
		//alert(t);
	}
	function Totaltt()
	{
		// RECORRER ELEMENTOS PARA LA SUMATORIA DE LOS TOTALES DE PRODUCTO
		var elementos = document.getElementsByName("totalP");
		var t=0;
		for (x=0;x<elementos.length;x++)
		{
			//alert(elementos[x].value);
			t+=parseFloat(elementos[x].value);
		}
		t=t.toFixed(3);
		document.getElementById("Totalt").value=t;
	}
	function imprime()
	{	document.getElementById("body").style.fontSize = "8px";
	 	y=document.getElementsByTagName("input");
		for (i = 0; i < y.length; i++) {
			y[i].style.fontSize = "8px";
			y[i].style.height = "10px";
		}
	 
	 
	 	document.getElementById('logo').style.display = 'none';
		document.getElementById('bimprimir').style.display = 'none';
		window.print();
	 	
	 
	 	///////////volvemos a cambiar el tamaño de las letras
	 	document.getElementById("body").style.fontSize = "16px";
	 	y=document.getElementsByTagName("input");
		for (i = 0; i < y.length; i++) {
			y[i].style.fontSize = "16px";
			y[i].style.height = "20px";
		}
	}

</script>
</body>
</html>

<?php
function TengoInventario($id){
	//obtenemos la fecha del ultimo corte 
	$info=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$id));
	
	//entradas
	$entradas=mysql_query("select * from entrada where fecha>'".$info["fecha"]."'");
	$cantidad_entrada=0;
	while($entradas2=mysql_fetch_array($entradas)){
		//if(strtotime($entrada2["fecha"]." ".$entrada2["hora"])==strtotime($info["fecha"]." ".$info["hora"])){
			///validamos el dia y si es igual sumamos las entradas posteriores a la hora
			$ce=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$id." and tipo='entrada' and id=".$entradas2['id_entrada']);
			$cante=mysql_fetch_array($ce);
			$cantidad_entrada=$cantidad_entrada+$cante['t'];
		//}
	}
	///salidas
	$salidas=mysql_query("select * from salida where fecha>'".$info["fecha"]."'");
	$cantidad_salida=0;
	while($salidas2=mysql_fetch_array($salidas)){
		//if(strtotime($salida2["fecha"]." ".$salida2["hora"])==strtotime($info["fecha"]." ".$info["hora"])){
			$cs=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$id." and tipo='salida' and id=".$salidas2['id_salida']);
			$cants=mysql_fetch_array($cs);
			$cantidad_salida=$cantidad_salida+$cants['t'];
		//}
	}
	
	//compras
	$compras=mysql_query("select id_compra from compra where fecha>'".$info["fecha"]."'");
	$comprasfac=mysql_query("select id_compra from comprafac where fecha>'".$info["fecha"]."'");
	$cantidad_compra=0;
	while($compras2=mysql_fetch_array($compras)){
		//if(strtotime($compras2["fecha"]." ".$compras2["hora"])==strtotime($info["fecha"]." ".$info["hora"])){
			$c=mysql_query("select sum(cantidad)as t,sum(importe) as imp from detalle where id_producto=".$id." and tipo='compra' and id=".$compras2['id_compra'].' and gasto="no"');
			$cant=mysql_fetch_array($c);
			$cantidad_compra=$cantidad_compra+$cant['t'];
		//}
	}
			
	while($comprasfac2=mysql_fetch_array($comprasfac)){
		//if(strtotime($comprasfac2["fecha"]." ".$comprasfac2["hora"])==strtotime($info["fecha"]." ".$info["hora"])){
			$c=mysql_query("select sum(cantidad)as t,sum(importe) as imp from detalle where id_producto=".$id." and tipo='comprafac' and id=".$comprasfac2['id_compra'].' and gasto="no"');
			$cant=mysql_fetch_array($c);
			$cantidad_compra=$cantidad_compra+$cant['t'];
		//}
	}
	
	/////////ventas
	$ventas=mysql_query("select * from venta where fecha>'".$info["fecha"]."'");
	$cantidad_venta=0;
	while($ventas2=mysql_fetch_array($ventas)){
		//if(strtotime($ventas2["fecha"]." ".$ventas2["hora"])==strtotime($info["fecha"]." ".$info["hora"])){
			$cv=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$id." and tipo='venta' and id=".$ventas2['id_venta']);
			$cantv=mysql_fetch_array($cv);
			$cantidad_venta=$cantidad_venta+$cantv['t'];
		//}
	}
	
	
	$inventario=$info["cantidad"]+$cantidad_compra+$cantidad_entrada-$cantidad_salida-$cantidad_venta;
	return $inventario;
}
?>