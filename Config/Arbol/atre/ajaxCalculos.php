<?php
session_start();
require('../../configuraciones.php');
	conectar();	
	date_default_timezone_set('America/Mexico_City');
//print_r($_POST);

if (isset($_POST['tipo'])&&$_POST['tipo']=='numeroEventos') 
{
	$totalEventos=0;
	$contratos=mysql_fetch_array(mysql_query("SELECT COUNT( Numero ) AS t FROM contrato WHERE Fecha >=  '".$_POST['fecha1']."' AND Fecha <=  '".$_POST['fecha2']."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8; "));
	$recaudacion=mysql_fetch_array(mysql_query("SELECT COUNT( Numero ) AS t FROM Eventos_Recaudacion WHERE Fecha >=  '".$_POST['fecha1']."' AND Fecha <=  '".$_POST['fecha2']."' AND estatus='ACTIVO' "));	 			
	$adicionales=mysql_fetch_array(mysql_query("SELECT COUNT( Numero ) AS t FROM Eventos_Adicionales WHERE Fecha >=  '".$_POST['fecha1']."' AND Fecha <=  '".$_POST['fecha2']."' "));	 			
	echo ($contratos['t']+$recaudacion['t']+$adicionales['t']);

}
if (isset($_POST['tipo'])&&$_POST['tipo']=='comensales') 
{
	$contratos=mysql_fetch_array(mysql_query("SELECT SUM( c_adultos ) AS a, SUM( c_jovenes ) AS j, SUM( c_ninos ) AS n  FROM contrato WHERE Fecha >=  '".$_POST['fecha1']."' AND Fecha <=  '".$_POST['fecha2']."' AND tipo!='MOSTRADOR'"));	 						
		$comensales['total']=($contratos['a']+$contratos['j']+$contratos['n']);
		$comensales['adultos']=$contratos['a'];
		$comensales['jovenes']=$contratos['j'];
		$comensales['ninos']=$contratos['n'];
	
	$cagos=mysql_query("SELECT Numero, facturado FROM contrato WHERE Fecha >=  '".$_POST['fecha1']."' AND Fecha <=  '".$_POST['fecha2']."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8;  ");
		while ($comensalesCargos=mysql_fetch_array($cagos)) 
			{							
				$tcc=total_comen($comensalesCargos['Numero'] , $comensalesCargos['facturado']);
				$comensales['adultos']+=$tcc[0];
				$comensales['jovenes']+=$tcc[1];
				$comensales['ninos']+=$tcc[2];
				$comensales['total']+=($tcc[0]+$tcc[1]+$tcc[2]);
			}
	$adicionales=mysql_fetch_array(mysql_query("SELECT SUM( c_adultos ) AS a, SUM(c_jovenes) AS j, SUM(c_ninos) AS n FROM Eventos_Adicionales WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."' "));
	$comensales['total']+=($adicionales['a']+$adicionales['j']+$adicionales['n']);
		$comensales['adultos']+=$adicionales['a'];
		$comensales['jovenes']+=$adicionales['j'];
		$comensales['ninos']+=$adicionales['n'];		
	echo "<ul>
			<li>Adultos: <font color='green'><strong>".$comensales['adultos']."</strong></font></li>
			<li>Jovenes:  <font color='green'<strong>".$comensales['jovenes']."</strong></font></li>
			<li>Niños:  <font color='green'<strong>".$comensales['ninos']."</strong></font></li>
		  </ul><font color='red'><b id='totalComensales'>".$comensales['total']."</b></font>";

}
if (isset($_POST['tipo'])&&$_POST['tipo']=='cobrado') 
{
	$totalCobrado=0;$_SESSION["TotalCobrado"]=0;
	$contratos=mysql_query("SELECT * FROM contrato WHERE Fecha >=  '".$_POST['fecha1']."' AND Fecha <=  '".$_POST['fecha2']."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8; ");
	echo "<ul>";
			while ($c=mysql_fetch_array($contratos)) 
			{
				$totalContrato=0;
				echo "<li><strong>".$c['Numero']."</strong>
						<ul>
							<li>Costo de Evento: <font color='green'><strong> $ ".money_format("%i",$c['si'])."</strong></font></li>
							<li>Cargos";	
					$totalContrato+=$c['si'];							
								$cargo=mysql_query("SELECT * FROM contrato WHERE Numero='".$c['Numero']."' ");
								while($ca=mysql_fetch_array($cargo))
								{
									if($ca['facturado']=='si')
									{	
										  $car=mysql_query("SELECT * FROM `cargofac` WHERE `numcontrato` LIKE '".$c['Numero']."'");
									}
									else
									{
									  $car=mysql_query("SELECT * FROM `cargo` WHERE `numcontrato` LIKE '".$c['Numero']."'");
									} 	
									while($carg=mysql_fetch_array($car))
									{						
										echo "<ul>
												<li>".$carg['concepto']."</li>
											  </ul><font color='green'><strong> $ ".money_format("%i",$carg['cantidad'])."</strong></font>";
											  $totalContrato+=$carg['cantidad'];
									}
								}
								$devolucion=mysql_fetch_array(mysql_query("SELECT * FROM TDevoluciones WHERE Numero='".$c['Numero']."' "));
								$totalContrato-=$devolucion['Total'];
						echo"</li>
							<li>Devolucion <font color='green'><strong> $ ".money_format("%i", $devolucion['Total'])."</strong></font></li>							
						</ul><font color='red'><strong> $ ".money_format("%i", $totalContrato)."</strong></font>
					  </li>";	
					  $totalCobrado+=$totalContrato;
			}
	echo"</ul> <font color='red'><strong id='tcobrado'> $ ".money_format("%i", $totalCobrado)."</strong></font>";
	//$_SESSION["TotalCobrado"]=$_SESSION["TotalCobrado"]+$totalCobrado;
}

if (isset($_POST['tipo'])&&$_POST['tipo']=='eventosAdicionales') 
{
	$adicionales=mysql_query("SELECT * FROM `Eventos_Adicionales` WHERE `Fecha`>= '".$_POST['fecha1']."' AND `Fecha`<= '".$_POST['fecha2']."' ");
	echo "<ul>";
		while ($a=mysql_fetch_array($adicionales)) 
		{
			echo "<li><strong>".$a['Numero']."</strong></li>";
		}
	echo "</ul>";
}
if (isset($_POST['tipo'])&&$_POST['tipo']=='eventosRecaudacion') 
{
	$recaudacion=mysql_query("SELECT * FROM `Eventos_Recaudacion` WHERE `fecha`>= '".$_POST['fecha1']."' AND `fecha`<= '".$_POST['fecha2']."' AND estatus='ACTIVO' ");
	echo "<ul>";
	$ttRecaudacion=0;
		while ($r=mysql_fetch_array($recaudacion)) 
		{$totalRecaudacion=0;
			echo "<li><strong>".$r['Numero']."   (Alimentos)</strong>
						<ul>";
							$tic=mysql_query("SELECT * FROM tickets WHERE referencia='".$r['Numero']."' ORDER BY folio");
							while($t=mysql_fetch_array($tic))
							{$total_ticket=0;
								echo "<li>".$t['folio']."
											<ul>";
													$c=explode(",",$t['cantidades']);
													$p=explode(",",$t['productos']);
													$tt=explode(",",$t['totales']);
													for ($i=1; $i <count($c) ; $i++) 
													{ 
														echo "<li>".$c[$i].", ".$p[$i].", $ ".money_format("%i",$tt[$i])."</li>";
														$total_ticket+=$tt[$i];
													}
								echo "		</ul><font> $ ".money_format("%i",$total_ticket)."</font>
									  </li>	";
									  $totalRecaudacion+=$total_ticket;
							}
							$ttRecaudacion+=$totalRecaudacion;
			echo "		</ul><font> $ ".money_format("%i",$totalRecaudacion)."</font>
				  </li>";
		}
	//$_SESSION["TotalCobrado"]=$_SESSION["TotalCobrado"]+$ttRecaudacion;
	echo "</ul><font> $ <b id='RecaudacionA'>".money_format("%i",$ttRecaudacion)."</b></font>";
	
}
if (isset($_POST['tipo'])&&$_POST['tipo']=='gastoInsumo') 
{
//echo "SELECT * FROM corte_inventario WHEre fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."'";
	$f=mysql_query("SELECT * FROM corte_inventario WHEre fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."'");
	$ids='';
	while ($m=mysql_fetch_array($f)) 
	{
		if (empty($ids)) 
		{
			$ids="id=".$m['id_corte_inventario'];																	
		}
		else 
		{
			$ids=$ids." OR id=".$m['id_corte_inventario'];
		}
	}
	   $tabla="SELECT * FROM detalle WHERE ".$ids." and gasto='no'";
		$c=mysql_query("SELECT * FROM categoria WHERE tipo='INSUMO' order by nombre	");
		
		echo "<ul id='red' class='treeview-red'>";$totalInsumos=0;
			while ($ca=mysql_fetch_array($c)) 
			{				$totalCategoria=0;
				if(tieneMovimiento($ca['id_categoria'],$tabla)>0)
				{				
				echo "
						<li><span>".$ca['nombre']."</span>
							<ul >";
								$s=mysql_query("SELECT * FROM subcategoria WHERE  id_categoria=".$ca['id_categoria']." order by nombre");
								while ($su=mysql_fetch_array($s)) 
								{$tsub=0;
										echo "<li><span>".$su['nombre']."<font><b></b></font></span>
												  <ul>";
														$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$su['id_subcategoria']." order by nombre");
														while ($pr=mysql_fetch_array($p)) 
														{ 																						
															
															echo "Summma   ******   ".$tproducto=suma_todo($pr['id_producto'],$tabla);
															//$tproducto=buscaVinos($pr['id_producto']);
															echo "<br> Producto  ".$tproducto;
																if($tproducto>0)
																{
																 	echo '<li><span>'.$pr["nombre"]." (".$pr["descripcion"].')'."   ".'<font color="red"><b> $ '.money_format("%i",$tproducto).'</b></font></span></li>';
																 	 $tsub=$tsub+$tproducto;	
																}																																																			
														}	
											echo "</ul><font color='green'><b> $ ".money_format("%i",$tsub)."</b></font>
											  </li>";			
											  $totalCategoria+=$tsub;
								}
								$totalInsumos+=$totalCategoria;
				  echo "	</ul><font color='green'><b> $ ".money_format("%i",$totalCategoria)."</b></font>
				  		</li>";
				}
			}
		echo "</ul><font color='green'><b id='gInsumo' > $ ".money_format("%i",$totalInsumos)."</b></font>";
		$_SESSION["TotalCobrado"]+=$totalInsumos;
}
if (isset($_POST['tipo'])&&$_POST['tipo']=='gastoActivo') 
{
	$totalActivos=0;

	$totalCompras=0;
	echo "
			<ul>
				<li><span>Compras</span>
					<ul>
						<li><strong> A </strong>
							<ul>";
								$tabla="SELECT * FROM detalle WHERE ".$ids;
									$c=mysql_query("SELECT * FROM categoria WHERE tipo='ACTIVO' AND nombre!='VINOS' order by nombre");
									$totalFacturado=0;
									while ($ca=mysql_fetch_array($c)) 
									{
										if(movimientoCF($ca['id_categoria'],'facturado')>0)
										{
										echo '
												<li><span>'.$ca['nombre'].' <font><b></b></font></span>
													<ul>';
														$tcatfac=0;											
															$s=mysql_query("SELECT * FROM subcategoria WHERE  id_categoria=".$ca['id_categoria']." order by nombre");
															while ($su=mysql_fetch_array($s)) 
															{$tsubfac=0;
																echo'
																		<li><span>'.$su['nombre'].' <font><b></b></font></span>
																		<ul>';
																																	
																			$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$su['id_subcategoria']." order by nombre");
																			while ($pr=mysql_fetch_array($p)) 
																			{ 
																				$tproducto=0;															
																					 $tproducto=suma_activos($pr['id_producto'],'facturado');
																						if($tproducto>0){
																							echo '
																									<li><span>'.$pr["nombre"]." (".$pr["descripcion"].')'."   ".'<font color="red"><b> $ '.money_format("%i",$tproducto).'</b></font></span></li>
																					 			 ';
																						}
																					 	
																				$tsubfac=$tsubfac+$tproducto;	
																				$TCA=$TCA+$tproducto;
																			}															
															   echo'</ul>'." 	".'<font color="red"><b>$ '.money_format("%i",$tsubfac).'</b></font>
																</li>';
													 			$tcatfac=$tcatfac+$tsubfac;													
															}
															echo '</ul><font color="red"><b> $ '.money_format("%i",$tcatfac).'</b></font>
												</li>	 ';	
											 $ttipofac=$ttipofac+$tcatfac;
										}		
										$totalFacturado=$totalFacturado+$ttipofac;						
									}	
							///se asigna la sumatoria de todos los producto que se revisaron
							$totalCompras=$TCA;
						echo"</ul><font color='green'><b> $ ".money_format("%i",$totalCompras)."</b></font>
						</li>	
					<li><strong> B </strong>
						<ul>";
								$tabla="SELECT * FROM detalle WHERE ".$ids;
								$c=mysql_query("SELECT * FROM categoria WHERE tipo='ACTIVO' AND nombre!='VINOS' order by nombre");
								$totalNoFacturado=0;
								while ($ca=mysql_fetch_array($c)) 
								{
									if(movimientoCF($ca['id_categoria'],'no facturado')>0)
									{
									echo '
											<li><span>'.$ca['nombre'].' <font><b></b></font></span>
												<ul>';
													$tcatnofac=0;											
												$s=mysql_query("SELECT * FROM subcategoria WHERE  id_categoria=".$ca['id_categoria']." order by nombre");
												while ($su=mysql_fetch_array($s)) 
												{$tsubnofac=0;
													echo'
															<li><span>'.$su['nombre'].' <font><b></b></font></span>
																<ul>';
																																
																$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$su['id_subcategoria']." order by nombre");
																while ($pr=mysql_fetch_array($p)) 
																{ 
																	$tproducto=0;															
																		 $tproducto=suma_activos($pr['id_producto'],'no facturado');
																		 if ($tproducto>0) 
																		 {
																		 	echo '
																						<li><span>'.$pr["nombre"]." (".$pr["descripcion"].')'."   ".'<font color="red"><b> $ '.money_format("%i",$tproducto).'</b></font></span></li>
																		 			 ';
																		 			 $tsubnofac=$tsubnofac+$tproducto;	
																		 }
																																			
																}															
														   echo'</ul>'." 	".'<font color="red"><b> $ '.money_format("%i",$tsubnofac).'</b></font>
															</li>										
														';
												 $tcatnofac=$tsubnofac+$tcatnofac;													
												}

									  	  echo '</ul><font color="red"><b> $ '.money_format("%i",$tcatnofac).'</b></font>
											</li>
									  	 ';	
								 $ttiponofac+=$tcatnofac;		

									}
								}
								$totalCompras+=$ttiponofac;								
								$totalActivos+=$totalCompras;								
			      echo "</ul><font color='green'><b> $ ".money_format("%i",$ttiponofac)."</b></font>
					</li>								
				</ul><font color='red'><b> $ ".money_format("%i",$totalCompras)."</b></font>
			</li>
			<li>Faltantes
				<ul>";
					$f=mysql_query("SELECT * FROM corte_inventario WHEre fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."'");
						$idss='';
						while ($mm=mysql_fetch_array($f)) 
						{
							if (empty($idss)) 
							{
								$idss="id=".$mm['id_corte_inventario'];																	
							}
							else 
							{
									$idss=$idss." OR id=".$mm['id_corte_inventario'];
							}
						}
						$totalFaltantes=0;
						$tabla2="SELECT * FROM detalle WHERE ".$idss;
						$cc=mysql_query("SELECT * FROM categoria WHERE tipo='ACTIVO' order by nombre");
						while ($caa=mysql_fetch_array($cc)) 
						{
							if(faltantesGAvtivo($caa['id_categoria'],$tabla2)>0)
							{
							echo '
									<li><span>'.$caa['nombre'].' <font><b></b></font></span>
										<ul>';
											$tcatfal=0;											
										$sf=mysql_query("SELECT * FROM subcategoria WHERE  id_categoria=".$caa['id_categoria']." order by nombre");
										while ($suf=mysql_fetch_array($sf)) 
										{$tsubfal=0;
											echo'
													<li><span>'.$suf['nombre'].' <font><b></b></font></span>
														<ul>';
																														
														$pf=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$suf['id_subcategoria']." order by nombre");
														while ($prf=mysql_fetch_array($pf)) 
														{ 
															$tproductofal=0;															
																 $tproductofal=suma_faltantes($prf['id_producto'],$tabla2);
																 if ($tproductofal>0) 
																 {
																 	echo '
																				<li><span>'.$prf["nombre"]." (".$prf["descripcion"].')'."   ".'<font color="red"><b> $ '.money_format("%i",$tproductofal).'</b></font></span></li>
																 			 ';
																 			 $tsubfal=$tsubfal+$tproductofal;	
																 }
																																	
														}															
												   echo'</ul>'." 	".'<font color="red"><b> $ '.money_format("%i",$tsubfal).'</b></font>
													</li>										
												';
										 $tcatfal=$tsubfal+$tcatfal;													
										}
							$totalFaltantes+=$tcatfal;
							  	  echo '</ul><font color="red"><b> $ '.money_format("%i",$tcatfal).'</b></font>
									</li>
							  	 ';	
							}						 
						}	
								
		  echo" </ul><font color='red'><b> $ ".money_format("%i",$totalFaltantes)."</b></font>
			</li>
		</ul><font color='green'><b id='gActivo'> $ ".money_format("%i",$totalActivos)."</b></font>";
		$_SESSION["TotalCobrado"]+=$totalActivos;
}
if (isset($_POST['tipo'])&&$_POST['tipo']=='gastoOperativo') 
{
	$fc=mysql_query("SELECT * FROM compra WHEre fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."'");
	$idsc='';
	while ($m=mysql_fetch_array($fc)) 
	{
		if (empty($idsc)) 
		{	$idsc="id=".$m['id_compra'];	}
		else 
		{
			$idsc=$idsc." OR id=".$m['id_compra'];
		}
	}
	$fcf=mysql_query("SELECT * FROM comprafac WHEre fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."'");							
	$idscf='';
	while ($m=mysql_fetch_array($fcf)) 
	{
		if (empty($idscf)) 
		{
		$idscf="id=".$m['id_compra'];																	
		}
		else 
		{
			$idscf=$idscf." OR id=".$m['id_compra'];
		}
	}
	 $tabla="select * from (SELECT * FROM detalle WHERE ".$idsc." OR ".$idscf.") as x ";									 	
		$ll=mysql_query("SELECT * FROM categoria WHERE tipo='OPERATIVO' order by nombre");	
	echo "<ul>";
	while($cat=mysql_fetch_array($ll))
	{		

			$su=mysql_query("SELECT * FROM subcategoria WHERE id_categoria=".$cat['id_categoria']." order by nombre");
			while ($sub=mysql_fetch_array($su))
			 {
			 	$go=0;
				echo "<br>Gasto Operativo **".$go=GastoOpe($sub['id_subcategoria'],$tabla);					
				if($go>0)
				{

			 	$gas_sub=0;
				echo "<li><span>".$sub['nombre']."</span>
						<ul>";
							$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$sub['id_subcategoria']." order by nombre");
							while($pro=mysql_fetch_array($p))
							{
								//echo $pro['nombre'];
									$gasto_produ=totalGastos($pro['id_producto'],$tabla);
									if($gasto_produ>0)
									{
									echo '<li><span>'.$pro["nombre"]." (".$pro["descripcion"].')'."   ".'<font color="red"><b> $ '.money_format("%i",$gasto_produ).'</b></font></span></li>';
									$gas_sub=$gas_sub+$gasto_produ;											
									}																	
							}
				  echo '</ul><font color="red"><b> $ '.money_format("%i",$gas_sub).'</b></font>	
					  </li>';											
					  	$gasto_tipo=$gasto_tipo+$gas_sub;
				 }
			}
		
	}
	echo "</ul><font color='green'><b id='gOperativo'> $ ".money_format("%i",$gasto_tipo)."</b></font>	";
	$_SESSION["TotalCobrado"]+=$gasto_tipo;
}
if (isset($_POST['tipo'])&&$_POST['tipo']=='nomina') 
{
	echo " 
			<ul>
				<li><span>Meseros</span>
					<ul>";
						$con=mysql_query("SELECT * FROM contrato WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."'");
									$qu='';
									$tms=0;
									$totalMeseros=0;
									while($cont=mysql_fetch_array($con))
									{
										if(empty($qu))
										{
											$qu="contratos='".$cont['Numero']."'";
										}
										else
										{
											$qu=$qu." OR contratos='".$cont['Numero']."'";
										}
										
									}			
									$con=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."'");							
									$tms=0;
									while($cont=mysql_fetch_array($con))
									{
										if(empty($qu))
										{
											$qu="contratos='".$cont['Numero']."'";
										}
										else
										{
											$qu=$qu." OR contratos='".$cont['Numero']."'";
										}
										
									}									
									$cat=mysql_query("SELECT * FROM Configuraciones WHERE tipo='Nomina'");
									$tmes=0;
									while ($cate=mysql_fetch_array($cat)) 
									{
										$tcate=suma_Nomina_Meseros($cate['descripcion'],$qu);
										if($tcate>0)										
										{
										echo '<li class="open">'.$cate['descripcion']." <font color ='red'><b> $ ".money_format("%i",$tcate).'</b></font></span>';
												$tms=$tms+$tcate;
										}
									}
									$totalMeseros+=$tms;
			   echo "</ul><font color ='red'><b> $ ".money_format("%i",$tms)."</b></font></span>
				</li>
				<li>Empleados
					<ul>"; 

							/*if(NominaM('Confirmacion_Nomina_Construccion')>0)
							{
								echo "
									<li>
										Construcción
										<ul>";
								$tc=0; $templeado=0;
								$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Construccion` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
								while ($c=mysql_fetch_array($co)) 
								{
									$nombres=explode(",",$c['nombres']);
									$total=explode(",",$c['Total_nomina']);									
									for ($i=1; $i <count($nombres) ; $i++) 
									{ 
										echo "<li> ".$nombres[$i].",  $ ".money_format("%i",$total[$i])."</li>";
										$tc+=$total[$i];
									}
								}
								echo "</ul><font color='blue'> ".money_format("%i",$tc)."</font>
										</li>";
							}*/
							if(NominaEv('Confirmacion_Nomina_Eventos')>0)
							{
									echo"
									<li>Eventos
										<ul>";
										$templeado+=$tc;
										 $te=0;
											$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Eventos` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
											while ($c=mysql_fetch_array($co)) 
											{
												$nombres=explode(",",$c['nombres']);
												$total=explode(",",$c['totales']);									
												for ($i=1; $i <count($nombres) ; $i++) 
												{ 
													echo "<li> ".$nombres[$i].", $ ".money_format("%i",$total[$i])."</li>";
													$te+=$total[$i];
												}
											}
										$templeado+=$te;								
								  echo "</ul><font color='blue'> ".money_format("%i",$te)."</font>
									</li>";
							}
					 	if(NominaEv('Confirmacion_Nomina_Extras')>0)
					 	{
					 		echo "<li>Extras
							<ul>";
								$tex=0;
								$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Extras` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
								while ($c=mysql_fetch_array($co)) 
								{
									$nombres=explode(",",$c['nombres']);
									$total=explode(",",$c['totales']);									
									for ($i=1; $i <count($nombres) ; $i++) 
									{ 
										echo "<li> ".$nombres[$i].", $ ".money_format("%i",$total[$i])."</li>";
										$tex+=$total[$i];
									}
								}
							$templeado+=$tex;	
					   echo "</ul><font color='blue'> ".money_format("%i",$tex)."</font>
						</li>";
					 	}
						if(NominaM('Confirmacion_Nomina_Planta')>0)
						{
							echo "<li> Planta
							<ul>";
									$tp=0;
								$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Planta` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
								while ($c=mysql_fetch_array($co)) 
								{
									$nombres=explode(",",$c['nombres']);
									$total=explode(",",$c['Total_nomina']);									
									for ($i=1; $i <count($nombres) ; $i++) 
									{ 
										echo "<li> ".$nombres[$i].", $ ".money_format("%i",$total[$i])."</li>";
										$tp+=$total[$i];
									}
								}
							$templeado+=$tp;
					   echo "</ul><font color='blue'> ".money_format("%i",$tp)."</font>
						</li>";
						}
						if(NominaCo('Cornfirmacion_Nomina_Comision')>0)
						{
							echo "<li>Comisión
							<ul>";
								$tco=0;
								$co=mysql_query("SELECT * FROM `Cornfirmacion_Nomina_Comision` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
								while ($c=mysql_fetch_array($co)) 
								{
									$nombres=explode(",",$c['nombres']);
									$total=explode(",",$c['neto']);									
									for ($i=1; $i <count($nombres) ; $i++) 
									{ 
										echo "<li> ".$nombres[$i].", $ ".money_format("%i",$total[$i])."</li>";
										$tco+=$total[$i];
									}
								}
							$templeado+=$tco;
					  echo "</ul><font color='blue'> ".money_format("%i",$tco)."</font>
						</li>";

						}
						$totalMeseros+=$templeado;
				echo"</ul><font color='blue'> ".money_format("%i",$templeado)."</font>
				</li>
			</ul><font color ='green'><b id='gNomina'> $ ".money_format("%i",$totalMeseros)."</b></font></span>
		 ";
		 $_SESSION["TotalCobrado"]+=$totalMeseros;
}
if(isset($_POST['tipo'])&&$_POST['tipo']=='premioLealtad')
{
	echo "
			<ul>
				<li><span>Meseros</span>
					<ul>";
							$con=mysql_query("SELECT * FROM contrato WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."'");
									$qu='';
									$tmsp=0;$totalPremioLealtad=0;
									while($cont=mysql_fetch_array($con))
									{
										if(empty($qu))
										{
											$qu="contratos='".$cont['Numero']."'";
										}
										else
										{
											$qu=$qu." OR contratos='".$cont['Numero']."'";
										}
										
									}									
									$cat=mysql_query("SELECT * FROM Configuraciones WHERE tipo='Nomina'");
									$tmesp=0;
									while ($cate=mysql_fetch_array($cat)) 
									{
										 $tcatep=suma_puntos_Meseros($cate['descripcion'],$qu);
										if($tcatep>0)										
										{
										echo '<li class="open">'.$cate['descripcion']." <font color ='red'><b> $ ".money_format("%i",$tcatep).'</b></font></span>';
												$tmsp=$tmsp+$tcatep;
										}
									}	
									$totalPremioLealtad+=$tmsp;	
			echo "	</ul><font color ='red'><b> $ ".money_format("%i",$tmsp)."</b></font></span>
				</li>
				<li>Empleados
					<ul>
					";$tPN=0;
					if(PuntosN('Cornfirmacion_Nomina_Comision')>0)
					{
							echo "<li>Comisión
									<ul>";
										$tco=0;
										$co=mysql_query("SELECT * FROM `Cornfirmacion_Nomina_Comision` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si'");
										while ($c=mysql_fetch_array($co)) 
										{
											$nombres=explode(",",$c['nombres']);
											$total=explode(",",$c['puntos']);									
											for ($i=1; $i <count($nombres) ; $i++) 
											{ 
												$nom=explode("-",$nombres[$i]);
												echo "<li> ".$nom[0].", $ ".money_format("%i",$total[$i])."</li>";
												$tco+=$total[$i];
											}
										}
									$templeado+=$tco;
									$tPN+=$tco;
							  echo "</ul><font color='blue'> ".money_format("%i",$tco)."</font>
							</li>";
					}
					if(PuntosN('Confirmacion_Nomina_Planta')>0)
					{
						
							echo "<li> Planta
							<ul>";
									$tp=0;
								$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Planta` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
								while ($c=mysql_fetch_array($co)) 
								{
									$nombres=explode(",",$c['nombres']);
									$total=explode(",",$c['puntos']);									
									for ($i=1; $i <count($nombres) ; $i++) 
									{ 
										$nom=explode("-", $nombres[$i]);
										echo "<li> ".$nom[0].", $ ".money_format("%i",$total[$i])."</li>";
										$tp+=$total[$i];
									}
								}
							$templeado+=$tp;
							$tPN+=$tp;
					   echo "</ul><font color='blue'> ".money_format("%i",$tp)."</font>
						</li>";
					}
					if(PuntosN('Confirmacion_Nomina_Extras')>0)
					{
						echo "<li>Extras
							<ul>";
								$tex=0;
								$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Extras` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
								while ($c=mysql_fetch_array($co)) 
								{
									$nombres=explode(",",$c['nombres']);
									$total=explode(",",$c['puntos']);									
									for ($i=1; $i <count($nombres) ; $i++) 
									{ 
										$nom=explode("-", $nombres[$i]);
										echo "<li> ".$nom[0].", $ ".money_format("%i",$total[$i])."</li>";
										$tex+=$total[$i];
									}
								}
							$templeado+=$tex;
							$tPN+=$tex;	
					   echo "</ul><font color='blue'> ".money_format("%i",$tex)."</font>
						</li>";				
					}
					if(PuntosN('Confirmacion_Nomina_Eventos')>0)
					{
						echo"
							<li>Eventos
								<ul>";
								$templeado+=$tc;
								 $te=0;
									$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Eventos` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
									while ($c=mysql_fetch_array($co)) 
									{
										$nombres=explode(",",$c['nombres']);
										$total=explode(",",$c['puntos']);									
										for ($i=1; $i <count($nombres) ; $i++) 
										{ 
											$nom=explode("-", $nombres[$i]);
											echo "<li> ".$nom[0].", $ ".money_format("%i",$total[$i])."</li>";
											$te+=$total[$i];
										}
									}
								$templeado+=$te;	
								$tPN+=$te;							
						  echo "</ul><font color='blue'> ".money_format("%i",$te)."</font>
							</li>";
					}
					/*if(PuntosN('Confirmacion_Nomina_Extras')>0)
					{
						echo "
							<li>
								Construcción
								<ul>";
						$tc=0; $templeado=0;
						$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Construccion` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
						while ($c=mysql_fetch_array($co)) 
						{
							$nombres=explode(",",$c['nombres']);
							$total=explode(",",$c['puntos']);									
							for ($i=1; $i <count($nombres) ; $i++) 
							{ 
								$nom=explode("-", $nombres[$i]);
								echo "<li> ".$nom[0].",  $ ".money_format("%i",$total[$i])."</li>";
								$tc+=$total[$i];
							}
						}
						$tPN+=$tc;
						echo "</ul><font color='blue'> ".money_format("%i",$tc)."</font>
								</li>";
					}*/

					$totalPremioLealtad+=$tPN;
			echo"	</ul><font color='blue'> $ <b id='puntosNominas'>".money_format("%i",$tPN)."</b></font>
				</li>
			</ul><font color ='green'><b id='premio'> $ ".money_format("%i",$totalPremioLealtad)."</b></font></span>
		 ";
		 $_SESSION["TotalCobrado"]+=$totalPremioLealtad;
}

if (isset($_POST['tipo'])&&$_POST['tipo']=='gastoInversion') 
{
	
		$fc=mysql_query("SELECT * FROM compra WHEre fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."'");
		$idsc='';
			while ($m=mysql_fetch_array($fc)) 
			{
				if (empty($idsc)) 
				{
				$idsc="id=".$m['id_compra'];																	
				}
				else 
				{
					$idsc=$idsc." OR id=".$m['id_compra'];
				}
			}
		$fcf=mysql_query("SELECT * FROM comprafac WHEre fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."'");							
			$idscf='';
			while ($m=mysql_fetch_array($fcf)) 
			{
				if (empty($idscf)) 
				{
				$idscf="id=".$m['id_compra'];																	
				}
				else 
				{
					$idscf=$idscf." OR id=".$m['id_compra'];
				}
			}
			$gastoInversion=0;
			 $tabla="select * from (SELECT * FROM detalle WHERE ".$idsc." OR ".$idscf.") as x ";					
			 echo "<ul>"			;
				$c=mysql_query("SELECT * FROM categoria WHERE tipo ='INVERSION' order by nombre");
				$cat=mysql_fetch_array($c);
					$su=mysql_query("SELECT * FROM subcategoria WHERE id_categoria=".$cat['id_categoria']." order by nombre");
					while ($sub=mysql_fetch_array($su))
					 {$gas_sub2=0;
					 	$gai=0;
					 	echo "<br> GAstoo ".$gai=MovimientoInversion($sub['id_subcategoria'],$tabla);
					 	if($gai>0)
					 	{
						echo "<li>".$sub['nombre']." 	
								<ul>";
									$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$sub['id_subcategoria']." order by nombre");
									while($pro=mysql_fetch_array($p))
									{
										//echo $pro['nombre'];
											$gasto_produ=totalGastos($pro['id_producto'],$tabla);			
											if($gasto_produ>0)											
											{
												echo '<li><span>'.$pro["nombre"]." (".$pro["descripcion"].')<font color="red"><b> $ '.money_format("%i",$gasto_produ).'</b></font></span></li>';
											$gas_sub2+=$gasto_produ;
											}
																																							
									}
						  echo '</ul><font color="red"><b> $ '.money_format("%i",$gas_sub2).'</b></font>	
							  </li>';	
						}	  $gastoInversion+=$gas_sub2;
					 }	
	
	
		//echo "<li>Nomina</li>";
		//NOMINA DE CONSTRUCCION	
			echo "<li>Nomina Construcción
						<ul>";
							$tc=0; $templeado=0;
							$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Construccion` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
							while ($c=mysql_fetch_array($co)){
									$nombres=explode(",",$c['nombres']);
									$total=explode(",",$c['Total_nomina']);									
									for ($i=1; $i <count($nombres) ; $i++) { 
										echo "<li> ".$nombres[$i].",  $ ".money_format("%i",$total[$i])."</li>";
										$tc+=$total[$i];
									}
							}
				echo "</ul><font color='blue'> ".money_format("%i",$tc)."</font>
				</li>";
				$gastoInversion=$gastoInversion+$tc;
		////////////premios de lealtad Construccion
		//echo "<li>Premio de Lealtad</li>";
	
			echo "<li>Premio de Lealtad Construcción
						<ul>";
							$tc=0; $templeado=0;
							$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Construccion` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
							while ($c=mysql_fetch_array($co)) 
							{
								$nombres=explode(",",$c['nombres']);
								$total=explode(",",$c['puntos']);									
								for ($i=1; $i <count($nombres) ; $i++) 
								{ 
									$nom=explode("-", $nombres[$i]);
									echo "<li> ".$nom[0].",  $ ".money_format("%i",$total[$i])."</li>";
									$tc+=$total[$i];
								}
							}
							$tPN+=$tc;
				echo "</ul><font color='blue'> ".money_format("%i",$tc)."</font>
				</li>";
	
					$gastoInversion=$gastoInversion+$tc;
	
		echo "</ul><font color='blue'><b> $ ".money_format("%i",$gastoInversion)."</b></font>";
	
	
}
if (isset($_POST['tipo'])&&$_POST['tipo']=='gastoPersonal') 
{
	$totalGasto=0;
	echo "<ul>";
			$c=mysql_query("SELECT * FROM categoria ");
			while ($ca=mysql_fetch_array($c)) 
			{$totalCategoria=0;
				if(MovimientoGastoPersonal($ca['id_categoria'])>0)
				{
				echo $s=mysql_query("SELECT * FROM subcategoria WHERE  id_categoria=".$ca['id_categoria']." order by nombre");				
							while ($su=mysql_fetch_array($s)) 
							{		$totalSubCategoria=0;					
								echo "<li>".$su['nombre']."
										<ul>";
											$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$su['id_subcategoria']." order by nombre" );
											while ($pr=mysql_fetch_array($p)) 
											{ 
												$totalSubCategoria+=$totalProducto=gasto_personal($pr['id_producto']);
												if($totalProducto>0){
													echo "<li>".$pr['nombre']."<font color='green'><strong> $ ".money_format("%i",$totalProducto)."</strong></font></li>";	
												}
											}
								echo " </ul><font color='green'><strong> $ ".money_format("%i",$totalSubCategoria)."</strong></font>
									 </li>";
								$totalCategoria+=$totalSubCategoria;
							}	

			      // echo"</ul><font color='green'><strong> $ ".money_format("%i",$totalCategoria)."</strong></font>";
			      	 $totalGasto+=$totalCategoria;
			    }
			}
	echo "</ul><font color='blue'><strong> $ ".money_format("%i",$totalGasto)."</strong></font>";
}
if(isset($_POST['tipo'])&&$_POST['tipo']=='vinos')	
{
	$totalVinos=0;
	$su=mysql_query("SELECT * FROM subcategoria WHERE id_categoria=1 ORDER BY nombre");
	echo "<ul>";
			while($s=mysql_fetch_array($su))
			{
				
				$totalCategoria=0;
			 echo "
				   <li>".$s['nombre']."
				   		<ul>";
				   		$pr=mysql_query("SELECT * FROM producto where id_subcategoria=".$s['id_subcategoria']." ORDER BY nombre ");
				   		while($p=mysql_fetch_array($pr))
				   		{
				   			$t=buscaVinos($p['id_producto']);				   		
				   				echo "<li>".$p['nombre']."<font><b> $ ".money_format("%i",$t)."</b></font></li>";
				   				$totalCategoria+=$t;				   		
				   		}
			echo  "		</ul><font><b> $ ".money_format("%i",$totalCategoria)."</b></font></li>
					</li>";		
				$totalVinos+=$totalCategoria;
				
			}
	echo "</ul><font><b> $ ".money_format("%i",$totalVinos)."</b></font></li>";
}

if(isset($_POST['tipo'])&&$_POST['tipo']=='ventasVinos')	
{
	$venta=mysql_query("SELECT * FROM venta WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' ");
	echo "<ul>"; $tt=0;
	while($v=mysql_fetch_array($venta))
	{
		///////validamos que en el contenido de la compra exista almenos una venta de vino
		//////Desglozamos la venta
		if(valida_venta($v['id_venta'])){
			$totv=0;
			echo "<li><ul>";
			$det=mysql_query("SELECT * FROM detalle where tipo='venta' AND id=".$v['id_venta']);
			while ($d=mysql_fetch_array($det)) 
			{
				$p=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$d['id_producto']));
				if($p['id_categoria']=='1')
				{  
					//$UC=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$d['id_producto']));
					//$t=($d['cantidad']*($d['precio_venta']-$UC['precio']));
					$t=($d['cantidad']*($d['precio_venta']-$d['precio_adquisicion']));
					//$t=$d['cantidad']*$d['precio_venta'];
					if($t>0)
					{
						echo "<li>".$p['nombre']."<fon><b> $ ".money_format("%i",$t)."</b></font></li>";
						$totv=$totv+$t;
						$tt=$tt+$t;
					}


				}
			}
			echo "</ul><font>".$v['id_venta']."<b> $ ".money_format("%i",$totv)."</b></font></li>";
		}
		 
	}
	echo "</ul><font><b> $ ".money_format("%i",$tt)."</b></font>";
	//$_SESSION["TotalCobrado"]=$_SESSION["TotalCobrado"]+$tt;
}
if(isset($_POST['tipo'])&&$_POST['tipo']=='ventasT')
{
	$venta=mysql_query("SELECT * FROM venta WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' ");
	echo "<ul>"; $tt=0;
	while($v=mysql_fetch_array($venta))
	{
		$det=mysql_query("SELECT * FROM detalle where tipo='venta' AND id=".$v['id_venta']);
		while ($d=mysql_fetch_array($det)) 
		{

			$p=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$d['id_producto']));
			if($p['id_categoria']!='1')
			{

				$t=($d['cantidad']*($d['precio_venta']-$d['precio_adquisicion']));
				if($t>0)
				{
					echo "<li>".$p['nombre']."<font><b> $ ".money_format("%i",$t)."</b></font></li>";
					$tt+=$t;
				}
					
				
			} 
		}
	}
	//$_SESSION["TotalCobrado"]=$_SESSION["TotalCobrado"]+$tt;
	echo "</ul><font><b> $ ".money_format("%i",$tt)."</b></font>";
	
}
if(isset($_POST['tipo'])&&$_POST['tipo']=='Cancelaciones')
{
	$c=mysql_query("SELECT * FROM Cancelaciones WHERE 	concepto='cancelacion de contrato' AND fechamovimiento>='".$_POST['fecha1']."' AND 	fechamovimiento<='".$_POST['fecha2']."' ");
	 $tt=0;
	echo "<ul>";
	while($cancelacion=mysql_fetch_array($c))
	{
		echo "<li>".$cancelacion['numcontrato']."<font><b> $ ".money_format("%i",$cancelacion["cantidad"])."</b></font></li>";
		$tt=$tt+$cancelacion["cantidad"];
	}
	//$_SESSION["TotalCobrado"]=$_SESSION["TotalCobrado"]+$tt;
	echo "</ul><font><b> $ ".money_format("%i",$tt)."</b></font>";
}
if(isset($_POST['tipo'])&&$_POST['tipo']=='totalCobrado')
{	//print_r($_SESSION);
	
	echo "$ ".money_format("%i",$_SESSION["TotalCobrado"]); 
}

	//////////////////////		FUNCIONES PHP 		///////////////////////

/////////////////	FUNCIONES PHP 	///////////////////////7

	function total_comen($n,$fac)
	{

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
	function suma_todo($idp,$ids)
	{	
		//	echo $idp;
			//echo $ids;
		
				$q="SELECT * FROM (".$ids.") as x WHERE id_producto=".$idp." AND tipo='faltante'";
				$r=mysql_query($q);
				while($m=mysql_fetch_array($r))
				{
					 $t+=($m['cantidad']*$m['precio_adquisicion']);
				}						 
				 $pp=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$idp));			
				 $ca=mysql_query("SELECT * FROM categoria WHERE id_categoria=".$pp['id_categoria']);
				 $cac=mysql_fetch_array($ca);
				 echo "<br>*************		<font color='blue'>".$cac['tipo']."</font>		******************";			 
				 if ($cac['tipo']=='INSUMO') 
				 {		
				 		$t=$t*(-1);	 
				 }	
			return $t;
	}
	function suma_activos($idp,$fac)
	{
		$tt=0;
		if ($fac=='facturado') 
		{	$tipo='comprafac'; 	}
		else
		{	$tipo='compra';	}
		$c=mysql_query("SELECT * FROM ".$tipo." WHERE fecha>='".$_POST['fecha1']."' and Fecha <='".$_POST['fecha2']."'");
		while ($comp=mysql_fetch_array($c))
		{
			$gf="SELECT * FROM detalle WHERE tipo='".$tipo."' and id=".$comp['id_compra'];
			$d=mysql_query("SELECT * FROM detalle WHERE tipo='".$tipo."' and id=".$comp['id_compra']);
			while ($det=mysql_fetch_array($d)) 
			{
				if ($det['id_producto']==$idp) 
				{
					$m=mysql_query("SELECT * FROM producto WHERE id_producto=".$det['id_producto']);
					$pro=mysql_fetch_array($m);				
					$c=mysql_query("SELECT * FROM categoria WHERE id_categoria=".$pro['id_categoria']);
					$cat=mysql_fetch_array($c);
					if ($cat['tipo']=='ACTIVO') 
					{
						if ($fac=='facturado')
						 {				 	
								$impuesto='1.'.$pro['impuesto'];		
						 }
						 else{$impuesto=1;}
						 $tt=$tt+($det['cantidad']*$det['precio_adquisicion'])*$impuesto;
					}
									
					/*echo $J="SELECT * FROM producto WHERE id_producto=".$det["id_producto"];
						$pro=mysql_query($J);					
						$produc = mysql_fetch_array($pro);
						$tt=($det['cantidad']*$det['precio_adquisicion'])*(1.$produc['impuesto']);
						*/
				}
			}

		}

			return $tt;
	}



	function suma_faltantes($idp,$ids)
	{
	//	echo $idp;
		// echo $ids;
		$q="SELECT SUM(cantidad) as t FROM (".$ids.") as x WHERE id_producto=".$idp." AND tipo='faltante'";
			$r=mysql_query($q);
			$m=mysql_fetch_array($r);
			$i=mysql_query("SELECT * FROM inventario  WHERE id_producto=".$idp);
			$in=mysql_fetch_array($i);			
			 $t=$m['t']*$in['precio'];		 
			 $t=$t*(-1);
			return $t;
	}
	function totalGastos($pro,$idss)
	{
		//echo $pro."<br>";
		//echo $idss."<br>";

		$t=0;
			$q="SELECT * FROM (".$idss.") as x WHERE id_producto=".$pro." AND  tipo='comprafac'";
			$r=mysql_query($q);
			while($m=mysql_fetch_array($r))
			{
				$i=mysql_query("SELECT * FROM inventario  WHERE id_producto=".$idp);
				$in=mysql_fetch_array($i);	
				$in['precio'];		
				 $t=$m['cantidad']*$m['precio_adquisicion']+$t; 			
			}
			$q="SELECT * FROM (".$idsc.") as x WHERE id_producto=".$idp." AND  tipo='compra'";
			$r=mysql_query($q);
			while($m=mysql_fetch_array($r))
			{
				$i=mysql_query("SELECT * FROM inventario  WHERE id_producto=".$idp);
				$in=mysql_fetch_array($i);	
				$in['precio'];		
				 $t=$m['cantidad']*$m['precio_adquisicion']+$t; 			
			}
			 
			return $t;
	}
	function suma_Nomina_Meseros($cate,$que)
	{
		
		$Total=0;	
		 $g="SELECT meseros FROM TMeserosEvento WHERE ".$que;
		$t=mysql_query($g);
		while($idm=mysql_fetch_array($t))
		{
			$iddm=explode(",", $idm['meseros']);		
			for($i=0;$i<=count($iddm); $i++)
			{

				/*
				SEPARAMOS EL REGISTRO DE MESEROS 
				RECORDANDO QUE: 
				LA POSICION 0 ES EL ID DEL MESERO
				LA POSICION 1 ES EL ID DE LA CATEGORIA
				LA POSISION 2 ES EL PAGO POR EVENTO
				Y LA POSICION 3 SON LOS PUNTOS
				*/
					$id=explode("-",$iddm[$i]);		
					$ct=mysql_query("SELECT * FROM Configuraciones WHERE id=".$id[1]);
						$dc=mysql_fetch_array($ct);	
					if($dc['descripcion']==$cate)
					{	
						$Total=$Total+$id[2];
					}
				
			}
			
		}
		//echo $Total;
		return $Total;
	}
	function suma_puntos_Meseros($cate,$que)
	{
		
		$Totalp=0;	
		$g="SELECT meseros FROM TMeserosEvento WHERE ".$que;
		$t=mysql_query($g);
		while($idm=mysql_fetch_array($t))
		{
			$iddm=explode(",", $idm['meseros']);		
			for($i=0;$i<=count($iddm); $i++)
			{
				/*
				SEPARAMOS EL REGISTRO DE MESEROS 
				RECORDANDO QUE: 
				LA POSICION 0 ES EL ID DEL MESERO
				LA POSICION 1 ES EL ID DE LA CATEGORIA
				LA POSISION 2 ES EL PAGO POR EVENTO
				Y LA POSICION 3 SON LOS PUNTOS
				*/
					$id=explode("-",$iddm[$i]);		
					$ct=mysql_query("SELECT * FROM Configuraciones WHERE id=".$id[1]);
						$dc=mysql_fetch_array($ct);	
					if($dc['descripcion']==$cate)
					{	
						$Totalp=$Totalp+$id[3];
					}
				
			}
			
		}
		//echo $Total;
		return $Totalp;
	}
	function gasto_personal($id)
	{
		$total=0;
		$g=mysql_fetch_array(mysql_query("SELECT SUM( importe ) AS total FROM  `vista_gasto_personal` WHERE fecha>='".$_POST['fecha1']."'  AND fecha <='".$_POST['fecha2']."' AND `id_producto`=".$id));		
		if($g['total']!='NULL'||$g['total']!='')
			$total+=$g['total'];			
		$gf=mysql_fetch_array(mysql_query("SELECT SUM( importe ) AS total FROM vista_gasto_personal_facturado WHERE fecha>='".$_POST['fecha1']."'  AND fecha <='".$_POST['fecha2']."' AND id_producto=".$id));		
		if($gf['total']!='NULL'||$gf['total']!='')	
			$total+=$gf['total'];
		
		return $total;
	}
	function buscaVinos($id)
	{
		   // INICIALIZAMOS LAS VARIABLES 
		$c=0;//COMPRAS
		$cf=0;// COMPRAS FACTURADAS
		$e=0;	// ENTRADAS
		$s=0;	 // SALIDAS
		$v=0;	// VENTAS
		$f=0; ///faltante corte de inventario
		// BUSCAMOS DE LA TABLA DETALLE TODAS LAS COMPRAS, COMPRAS FAC Y ENTRADAS  DE ESE PRODUCTO
		// $total ="SELECT SUM(`importe`) AS c FROM `detalle` WHERE `tipo`='compra' and `id_producto`=".$id;
		 $c=mysql_fetch_array(mysql_query("SELECT SUM(`cantidad`) AS c FROM `detalle` WHERE `tipo`='compra' and `id_producto`=".$id));
		$cf=mysql_fetch_array(mysql_query("SELECT SUM(`cantidad`) AS cf FROM `detalle` WHERE `tipo`='comprafac' and `id_producto`=".$id));
		$e=mysql_fetch_array(mysql_query("SELECT SUM(`cantidad`) AS e FROM `detalle` WHERE `tipo`='entrada' and `id_producto`=".$id));

		//	BUSCAMOS TODAS LAS SALIDAS Y VENTAS DE LA TABLA DETALLE DE EL PRODUCTO EN TURNO
		$s=mysql_fetch_array(mysql_query("SELECT SUM(`cantidad`) AS s FROM `detalle` WHERE `tipo`='salida' and `id_producto`=".$id));
		$v=mysql_fetch_array(mysql_query("SELECT SUM(`cantidad`) AS v FROM `detalle` WHERE `tipo`='venta' and `id_producto`=".$id));
		$f=mysql_fetch_array(mysql_query("SELECT SUM(`cantidad`) AS f FROM `detalle` WHERE `tipo`='faltante' and `id_producto`=".$id));

		// LA IVERSION ACTUAL DE VINOS SE CALCULARIA CON LA SUMATORIA DE ENTRADAS,COMPRAS Y COMPRAS FAC MENOS LA SUMATORIA DE VENTAS Y SALIDAS POR PRODUCTO EN TURNO..
		
		$total=($c['c']+$cf['cf']+$e['e'])-($s['s']+$v['v'])+$f['f'];
		$ucosto=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$id));
		echo $total=$total*$ucosto["precio"];
		
		return $total;
		
	}

	function tieneMovimiento($cat,$tabla)
	{
		$tproducto=0;
		$s=mysql_query("SELECT * FROM subcategoria WHERE  id_categoria=".$cat." order by nombre");
		while ($su=mysql_fetch_array($s)) 
		{
			$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$su['id_subcategoria']." order by nombre");
			while ($pr=mysql_fetch_array($p)) 
			{ 																						
				
				$tproducto+=suma_todo($pr['id_producto'],$tabla);			
					
			}			
		}
		return $tproducto;
	}
	function movimientoCF($cat,$f)
	{
		$tproducto=0;
		$s=mysql_query("SELECT * FROM subcategoria WHERE  id_categoria=".$cat." order by nombre");
		while ($su=mysql_fetch_array($s)) 
		{
			$tsubfac=0;
			$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$su['id_subcategoria']." order by nombre");
			while ($pr=mysql_fetch_array($p)) 
			{ 
				
				$tproducto+=suma_activos($pr['id_producto'],$f);			
			}
		}
		return $tproducto;
	}
	function faltantesGAvtivo($cat,$tabla2)
	{
		$tproductofal=0;
		$sf=mysql_query("SELECT * FROM subcategoria WHERE  id_categoria=".$cat." order by nombre");
		while ($suf=mysql_fetch_array($sf)) 
		{			
		$pf=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$suf['id_subcategoria']." order by nombre");
				while ($prf=mysql_fetch_array($pf)) 
				{ 																			
				 	$tproductofal+=suma_faltantes($prf['id_producto'],$tabla2);
				}
		}
		return $tproductofal;
	}
	function GastoOpe($cat,$tabla)
	{
	
				//$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$sub['id_subcategoria']." order by nombre");
				$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$cat." order by nombre");
				while($pro=mysql_fetch_array($p))
				{
					//echo $pro['nombre'];
						$gasto_produ+=totalGastos($pro['id_producto'],$tabla);
				}				 
			 
			 return $gasto_produ;
	}
	function MovimientoGastoPersonal($cat)
	{
		$totalSubCategoria=0;	
	 $s=mysql_query("SELECT * FROM subcategoria WHERE  id_categoria=".$cat." order by nombre");	
		while ($su=mysql_fetch_array($s)) 
		{									
			$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$su['id_subcategoria']." order by nombre" );
			while ($pr=mysql_fetch_array($p)) 
			{ 
					$totalSubCategoria+=gasto_personal($pr['id_producto']);							
			}		
		}
		return $totalSubCategoria;				      
	}
	function MovimientoInversion($cat, $tabla)
	{
		$gasto_produ=0;
		$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$cat." order by nombre");
		while($pro=mysql_fetch_array($p))
		{
			//echo $pro['nombre'];
				$gasto_produ+=totalGastos($pro['id_producto'],$tabla);								
		}
		return $gasto_produ;
	}
	function NominaM($nom)
	{
		$tc=0; $templeado=0;
		$co=mysql_query("SELECT * FROM `".$nom."` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
		while ($c=mysql_fetch_array($co)) 
		{			
			$total=explode(",",$c['Total_nomina']);									
			for ($i=1; $i <count($total) ; $i++) 
			{ 				
				$tc+=$total[$i];
			}
		}
		return $tc;
	}
	function NominaEv($nom)
	{
		$templeado+=$tc;
		 $te=0;
			$co=mysql_query("SELECT * FROM `".$nom."` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
			while ($c=mysql_fetch_array($co)) 
			{		
				$total=explode(",",$c['totales']);									
				for ($i=1; $i <count($total) ; $i++) 
				{ 				
					$te+=$total[$i];
				}
			}
		return $te;
	}
	function NominaCo()
	{
		$tco=0;
		$co=mysql_query("SELECT * FROM `Cornfirmacion_Nomina_Comision` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
		while ($c=mysql_fetch_array($co)) 
		{			
			$total=explode(",",$c['neto']);									
			for ($i=1; $i <count($total) ; $i++) 
			{ 			
				$tco+=$total[$i];
			}
		}
		return $tco;
	}
	function PuntosN($nom)
	{
		$tco=0;
		//echo "SELECT * FROM `".$nom."` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ";
		$co=mysql_query("SELECT * FROM `".$nom."` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
		while ($c=mysql_fetch_array($co)) 
		{			
			$total=explode(",",$c['puntos']);									
			for ($i=1; $i <count($total) ; $i++) 
			{ 				
				$tco+=$total[$i];
			}
		}
		echo "Puntos C ".$tco;
		return $tco;
	}
	function valida_venta($id){
		$bandera=false;$contador=0;
		$det=mysql_query("SELECT * FROM detalle where tipo='venta' AND id=".$id);
		while ($d=mysql_fetch_array($det)) 
		{
			$p=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$d['id_producto']));
			if($p['id_categoria']=='1')
			{  	
				$contador++;
			}
		}
		
		if($contador>0){
			$bandera=true;
		}
		return $bandera;
	}
	/*function MovimientoVinos($cat)
	{
		$totalCategoria=0;		
		$pr=mysql_query("SELECT * FROM producto where id_subcategoria=".$cat." ORDER BY nombre ");
		while($p=mysql_fetch_array($pr))
		{
			$t=buscaVinos($p['id_producto']);
			if($t>0)
			{				
				$totalCategoria+=$t;
			}
		}
		return $totalCategoria;
	}*/
/////////	TERMINA FUNCIONES PHP 	/////////////////////////////
?>