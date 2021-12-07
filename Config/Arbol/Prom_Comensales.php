<!DOCTYPE html>
<html lang="es|">
<head>
	<meta charset="UTF-8">
	<title>Villa Conin</title>
	<?php
		require('../configuraciones.php');
		conectar();
		validarsesion();
	$nivel=$_SESSION['niv'];
	menuconfiguracion2();				
	$_SESSION['usu']=$_GET['usuario'];
	date_default_timezone_set('America/Mexico_City');
	?>
		<link rel="stylesheet" href="menu.css" />
		<link rel="stylesheet" href="jquery.treeview.css" />        
        <link rel="stylesheet" type="text/css" href="Arbol2/_styles.css" media="screen">
	<link rel="stylesheet" href="screen.css" />
	
	<script src="lib/jquery.js" type="text/javascript"></script>
	<script src="lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="jquery.treeview.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="demo.js"></script>
	
</head>

<body background="../../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >

<br><br><br><br>
<div align="center">
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
<br><br><br><br>

<?php
echo "<div id='fechas' align='center'><h2><font><b>FECHAS DE ".$_POST['fecha1']." HASTA ".$_POST['fecha2']."</b></font></h2></div>";

$totalGastado=0;$TotalCobrado2=0;// Variable global para lo cobrado en General
if ($_POST['submit']) {

						$Ne=mysql_query("SELECT COUNT( Numero ) AS t FROM contrato WHERE Fecha >=  '".$_POST['fecha1']."'AND Fecha <=  '".$_POST['fecha2']."' AND tipo!='MOSTRADOR'");
						$Numero_Eventos=mysql_fetch_array($Ne);
						//echo "SELECT COUNT( Numero ) AS l FROM Eventos_Adicionales WHERE Fecha >=  '".$_POST['fecha1']."'AND Fecha <=  '".$_POST['fecha2']."'";
						$Nea=mysql_query("SELECT COUNT( Numero ) AS l FROM Eventos_Adicionales WHERE Fecha >=  '".$_POST['fecha1']."'AND Fecha <=  '".$_POST['fecha2']."'");
						$Numero_Eventos_Adicionales=mysql_fetch_array($Nea);
						$Total_Eventos=$Numero_Eventos_Adicionales['l']+$Numero_Eventos['t'];		

						$NeR=mysql_query("SELECT COUNT( Numero ) AS l FROM Eventos_Recaudacion WHERE fecha >=  '".$_POST['fecha1']."'AND fecha <=  '".$_POST['fecha2']."'");
						$Numero_Eventos_Recaudacion=mysql_fetch_array($NeR);
						$Total_Eventos=$Numero_Eventos_Recaudacion['l']+$Total_Eventos;					

		$TCC=mysql_query("SELECT SUM( c_adultos ) AS a, SUM( c_jovenes ) AS j, SUM( c_ninos ) AS n FROM  `contrato` WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."' AND tipo!='MOSTRADOR'");
						$TComen=mysql_fetch_array($TCC);
						$TCC_EA=mysql_query( "SELECT SUM( c_adultos ) AS a, SUM( c_jovenes ) AS j, SUM( c_ninos ) AS n FROM  `Eventos_Adicionales` WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."'");
						$T_EA=mysql_fetch_array($TCC_EA);
						$Total_Comensales=$TComen['a']+$TComen['j']+$TComen['n']+$T_EA['a']+$T_EA['j']+$T_EA['n'];
						$TComen_Cargo=mysql_query("SELECT * FROM contrato WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."'");
						$adul=0;$jove=0;$nin=0;
						while ($Ftc=mysql_fetch_array($TComen_Cargo)) 
						{							
							$tcc=total_comen($Ftc['Numero'] , $Ftc['facturado']);
							$adul=$tcc[0]+$adul;
							$jove=$tcc[1]+$jove;
							$nin=$tcc[2]+$nin;
						}
						$Total_Comensales=$Total_Comensales+$adul+$jove+$nin;
?>	
<div id='comensal' class="comensal">			
				<ul id="red" class="treeview-red">

				<li><span>Catidad de Eventos</span><font color="green"><b> <?php echo $Total_Eventos;?></b></font></li>					
					<li><span>Catidad Total de Comensales</span><font color="green"><b> <?php echo $Total_Comensales;?></b></font>
						<ul>
							<li class="open"><span>Adultos</span><font color="green"><b> <?php echo $TComen['a']+$adul;?></b></font></li>
							<li class="open"><span>Jovenes</span><font color="green"><b> <?php echo $TComen['j']+$jove;?></b></font></li>
							<li class="open"><span>Niños</span><font color="green"><b> <?php echo $TComen['n']+$nin;?></b></font></li>
						</ul>
					</li>
					<li><span>Cobrado</span>
						<ul>
                        <?php
							$con=mysql_query("SELECT * FROM contrato WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."' AND tipo!='MOSTRADOR'");
									$qu='';
									$tms=0;
									while($cont=mysql_fetch_array($con))
									{																		
										echo '<li class="open"><span>'.$cont['Numero'].'</span>
											  	<ul>
											  		<li><span>Cargos</span>
														<ul>';
															$totalCargos=0;$TotalCobrado=0;

															if($cont['facturado']=='si')
															{	
																  $car=mysql_query("SELECT * FROM `cargofac` WHERE `numcontrato` LIKE '".$cont['Numero']."'");															 															  
															}
															else
															{
															  $car=mysql_query("SELECT * FROM `cargo` WHERE `numcontrato` LIKE '".$cont['Numero']."'");															 															  																												
															}
															while($cargo=mysql_fetch_array($car))
															{
																echo "<li><span>".$cargo['concepto']."    <font color='red'><b> $ ".money_format("%i",$cargo['cantidad'])."</b></font></span></li>";
																$totalCargos=$totalCargos+$cargo['cantidad'];																
															}														  	
										echo '			</ul><font color="red"><b>'.money_format("%i",$totalCargos).'</b></font>
													</li>';
													$devo=0;
													$Dev=mysql_query("SELECT * FROM TDevoluciones WHERE Numero='".$cont['Numero']."'");
													$devo=mysql_fetch_array($Dev);
													$TotalCobrado=($totalCargos+$TotalCobrado+$cont['si'])-$devo['Total'];
													$TotalContratos=$TotalCobrado+$TotalContratos;
													
													echo'<li><span>Devolucion </span><font color="blue"><b> $ '.money_format("%i",$devo['Total']).'</b></font>	</li>
													<li><span>Costo Evento</span><font color="red"><b> $ '.money_format("%i",$cont['si']).'</b></font></span></li>';
																								
															
													echo'
												</ul><font color="red"><b> $ '.money_format("%i",$TotalCobrado).'</b></font>	
											  </li>';									
									}									
									
						?>
                      
						</ul><font color="red"><b> ..........................$ <?php echo money_format("%i",$TotalContratos);?></b></font>
                          <li><span>Eventos Adicionales</span>
                        	<ul>
                            <?php
							$ee="SELECT * FROM Eventos_Adicionales WHERE Fecha>='".$_POST['fecha1']."' and Fecha<='".$_POST['fecha2']."'";
							$Ea=mysql_query($ee);
							while($cont=mysql_fetch_array($Ea))
									{																		
										echo '<li><span>'.$cont['Numero'].'</span></li>';
									}
							?>
                            </ul>
                        </li>                        
						<?php $TotalCobrado2=$TotalCobrado2+$TotalContratos;?>                        
						 <li><span>Eventos Recaudacion</span>
                        	<ul>
                            <?php
							$er="SELECT * FROM Eventos_Recaudacion WHERE fecha>='".$_POST['fecha1']."' and fecha<='".$_POST['fecha2']."'";
							$Er=mysql_query($er);
							while($cont=mysql_fetch_array($Er))
									{																		
										echo '<li><span>'.$cont['Numero'].'</span></li>';
									}
							?>
                            </ul>
                        </li>					
					</li>
                    <li><span>TOTAL COBRADO <font color="#066264"><b> ................$ <?php echo money_format("%i",$TotalCobrado2);?></b></font> </span></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li><span>Gastos Insumos</span>
						<ul>
						<?php
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
							echo "SELECT * FROM detalle WHERE ".$ids." and gasto='no'";
							$tabla="SELECT * FROM detalle WHERE ".$ids." and gasto='no'";
							$c=mysql_query("SELECT * FROM categoria WHERE tipo='INSUMO' order by nombre	");
							while ($ca=mysql_fetch_array($c)) 
							{$tcat=0;
								echo '
										<li><span>'.$ca['nombre'].' <font><b></b></font></span>
											<ul>';
												//$tcat=0;											
											$s=mysql_query("SELECT * FROM subcategoria WHERE  id_categoria=".$ca['id_categoria']." order by nombre");
											while ($su=mysql_fetch_array($s)) 
											{$tsub=0;
												echo'
														<li><span>'.$su['nombre'].' <font><b></b></font></span>
															<ul>';
																															
															$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$su['id_subcategoria']." order by nombre");
															while ($pr=mysql_fetch_array($p)) 
															{ 
																														
																$tproducto=suma_todo($pr['id_producto'],$tabla);
																//echo "<br> to ".$tproducto;
																	if($tproducto>0)
																	{
																	 	echo '
																					<li><span>'.$pr["nombre"]." (".$pr["descripcion"].')'."   ".'<font color="red"><b> $ '.money_format("%i",$tproducto).'</b></font></span></li>
																	 			 ';
																	 			 $tsub=$tsub+$tproducto;	
																	}																																																			
															}															
													   echo'</ul>'." 	".'<font color="red"><b>$ '.money_format("%i",$tsub).'</b></font>
														</li>										
													';
											 $tcat=$tsub+$tcat;													
											}

								  	  echo '</ul>'." 	".'<font color="red"><b>$ '.money_format("%i",$tcat).'</b></font>
										</li>
								  	 ';	
							 $ttipo=$tcat+$ttipo;
							}

						echo'</ul>'."    ".'<font color="red"><b>'.".................".'$ '.money_format("%i",$ttipo).'</b></font>';
							 $totalGastado=$totalGastado+$ttipo;							
						?>					
					</li>
					<li><span>Gastos Activo</span>					
						<ul>
							<li><span>Compras</span>
								<ul>
									<li><span>Facturadas</span>
									<ul>
									<?php
											$tabla="SELECT * FROM detalle WHERE ".$ids;
											$c=mysql_query("SELECT * FROM categoria WHERE tipo='ACTIVO' order by nombre");
											while ($ca=mysql_fetch_array($c)) 
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
																					
																					 	echo '
																									<li><span>'.$pr["nombre"]." (".$pr["descripcion"].')'."   ".'<font color="red"><b> $ '.money_format("%i",$tproducto).'</b></font></span></li>
																					 			 ';
																					 			 $tsubfac=$tsubfac+$tproducto;	
																					
																																						
																			}															
																	   echo'</ul>'." 	".'<font color="red"><b>$ '.money_format("%i",$tsubfac).'</b></font>
																		</li>										
																	';
															 $tcatfac=$tsubfac+$tcatfac;													
															}

												  	  echo '</ul>'." 	".'<font color="red"><b>$ '.money_format("%i",$tcatfac).'</b></font>
														</li>
												  	 ';	
											 $ttipofac=$tcatfac+$ttipofac;		
																		
											}														
									?>
									</ul><font color="red"><b>$ <?php echo money_format("%i",$ttipofac)?></b></font>
									<?php $totfac=$ttipofac+$totfac;?>
									<li><span>No Facturados</span>
										<ul>
											<?php
											$tabla="SELECT * FROM detalle WHERE ".$ids;
											$c=mysql_query("SELECT * FROM categoria WHERE tipo='ACTIVO' order by nombre");
											while ($ca=mysql_fetch_array($c)) 
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
																	   echo'</ul>'." 	".'<font color="red"><b>$ '.money_format("%i",$tsubnofac).'</b></font>
																		</li>										
																	';
															 $tcatnofac=$tsubnofac+$tcatnofac;													
															}

												  	  echo '</ul>'." 	".'<font color="red"><b>$ '.money_format("%i",$tcatnofac).'</b></font>
														</li>
												  	 ';	
											 $ttiponofac=$tcatnofac+$ttiponofac;		

											}

									?>																		
										</ul><font color="red"><b>$ <?php echo money_format("%i",$ttiponofac)?></b></font>
										<?php $totnofac=$totnofac+$ttiponofac;
											$totalcompra=$totfac+$ttiponofac;
										?>
									</li>								
								</ul><font color="red"><b>$ <?php echo money_format("%i",$totalcompra)?></b></font>
							</li>
							<li><span>Faltantes</span>
								<ul>
									<?php
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
													$tabla2="SELECT * FROM detalle WHERE ".$idss;
													$cc=mysql_query("SELECT * FROM categoria WHERE tipo='ACTIVO' order by nombre");
													while ($caa=mysql_fetch_array($cc)) 
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
																			   echo'</ul>'." 	".'<font color="red"><b>$ '.money_format("%i",$tsubfal).'</b></font>
																				</li>										
																			';
																	 $tcatfal=$tsubfal+$tcatfal;													
																	}

														  	  echo '</ul>'." 	".'<font color="red"><b>$ '.money_format("%i",$tcatfal).'</b></font>
																</li>
														  	 ';	
													 $ttipofal=$tcatfal+$ttipofal;
													 $totalGastadofal=$ttipofal;
													}
											echo'</ul>'."    ".'<font color="red"><b>'.'$ '.money_format("%i",$ttipofal).'</b></font>';
											$totalGasto=$totalcompra+$ttipofal;
									?>					
								</ul><font color="red"><b>.................$ <?php echo money_format("%i",$totalGasto)?></b></font>
							</li>																					
					<li><span>Gastos Operativos</span>					
						<ul>
							<?php
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
							 $tabla="select * from (SELECT * FROM detalle WHERE ".$idsc." OR ".$idscf.") as x ";								
							 
							
								$ll=mysql_query("SELECT * FROM categoria WHERE tipo='OPERATIVO' order by nombre");	
														
								while($cat=mysql_fetch_array($ll))
								{							
									
									$su=mysql_query("SELECT * FROM subcategoria WHERE id_categoria=".$cat['id_categoria']." order by nombre");
									while ($sub=mysql_fetch_array($su))
									 {
									 	$gas_sub=0;
										echo "<li><span>".$sub['nombre']."</span>
												<ul>";
													$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$sub['id_subcategoria']." order by nombre");
													while($pro=mysql_fetch_array($p))
													{
														//echo $pro['nombre'];
															$gasto_produ=totalGastos($pro['id_producto'],$tabla);														
															echo '<li><span>'.$pro["nombre"]." (".$pro["descripcion"].')'."   ".'<font color="red"><b> $ '.money_format("%i",$gasto_produ).'</b></font></span></li>';
															$gas_sub=$$gas_sub+$gasto_produ;																												
													}
										  echo '</ul><font color="red"><b> $ '.money_format("%i",$gas_sub).'</b></font>	
											  </li>';											
											  	$gasto_tipo=$gasto_tipo+$gas_sub;
											  	$totalGastado=$totalGastado+$gasto_tipo;
									 }
								
								}
								
							?>
						</ul><font color="red"><b> ......................... $ <?php echo money_format("%i",$gasto_tipo);?></b></font>
					</li>					
                    <li></li>
                    <li></li>
                    <li></li>
					<li><span>Nominas</span>
						<ul>
							<li><span>Meseros</span>
								<ul>
									<?php
									$con=mysql_query("SELECT * FROM contrato WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."'");
									$qu='';
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
									?>
								</ul><font color="red"><b>$ <?php $tnomina=$tnomina+$tms; echo money_format("%i",$tms);?></b></font>                             
							</li>						
						</ul><font color="red"><b> ...........................$ <?php  echo money_format("%i",$tnomina);?></b></font>
						<?php $totalGastado=$totalGastado+$tnomina;
						$tttt=$TotalCobrado2-$totalGastado;
						?>
					</li>	
                    <li><span>Premio de Lealtad</span>
                    	<ul>
							<li><span>Meseros</span>
								<ul>
									<?php
									$con=mysql_query("SELECT * FROM contrato WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."'");
									$qu='';
									$tmsp=0;
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
									?>
								</ul><font color="red"><b>$ <?php $tnominap=$tnominap+$tmsp; echo money_format("%i",$tmsp);?></b></font>                             
							</li>						
						</ul><font color="red"><b> ..............$ <?php  echo money_format("%i",$tnominap);?></b></font>                        
                    </li>		
                    <?php $totalGastado=$totalGastado+$tnominap?>
                    <li></li>
                    <li></li>
                    <li></li>							
					<li class="open"><span>TOTAL GASTADO</span><font color="#066264"><b> ...............$ <?php echo money_format("%i",$totalGastado);?></b></font></li>
					<!--<li class="open"><span>PROMEDIO POR COMENSAL</span><font color="#FF8900"><b> $ <?php echo money_format("%i",round($tttt/$Total_Comensales));?></b></font></li>	-->
                    <li></li>
                    <li><span><b>Costo Promedio por Comensal</b></span><font color="#0095FF"><b> $ <?php echo money_format("%i",($totalGastado/$Total_Comensales));?></b></font>  </li>            
                    <li></li>
 	        		<li><span><b>Precio Promedio por Comensal</b></span><font color="#0095FF"><b> $ <?php echo money_format("%i",($TotalCobrado2/$Total_Comensales));?></b></font>  </li>          
            

					
			</ul>	
</div>

<div id="utilidad">
		<ul>
        	<li><span><b>Utilidad Bruta</b> </span><font color="#0095FF"><b> $ <?php echo money_format("%i",($TotalCobrado2-$totalGastado));?></b></font></li>                     
          </ul>
            <ol class="tree">
               <li> 	<label for="gastop">Gastos Personales</label> <input type="checkbox" id="gastop" /> 			
					<ol>
									<?php
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
							
							$tabla5="select * from (SELECT * FROM detalle WHERE ".$idsc." OR ".$idscf.") as x where x.gasto='si'";
							//echo $tabla2="SELECT * FROM detalle WHERE ".$idscf." and gasto like 'si'";
							$c=mysql_query("SELECT * FROM categoria WHERE 1");
							while ($ca=mysql_fetch_array($c)) 
							{
								echo '
										<li><label for="gastop_sub">'.$ca['nombre'].' </label> <input type="checkbox" id="gastop_sub" /> 
											<ol>';
												$tcat2=0;		
												//echo "SELECT * FROM subcategoria WHERE  id_categoria=".$ca['id_categoria'];									
											$s=mysql_query("SELECT * FROM subcategoria WHERE  id_categoria=".$ca['id_categoria']." order by nombre");
											while ($su=mysql_fetch_array($s)) 
											{$tsub2=0;
												echo'
														<li><label for="gastop_prod">'.$su['nombre'].' </label> <input type="checkbox" id="gastop_prod" />
															<ol>';
																															
															$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$su['id_subcategoria']." order by nombre" );
															while ($pr=mysql_fetch_array($p)) 
															{ 
																$tproducto2=0;															
																	 $tproducto2=gasto_personal($pr['id_producto'],$tabla5);
																	 if ($tproducto2>0) 
																	 {
																	 	echo '
																					<li><span>'.$pr["nombre"]." (".$pr["descripcion"].')'."   ".'<font color="red"><b> $ '.money_format("%i",$tproducto2).'</b></font></span></li>
																	 			 ';
																	 			 $tsub2=$tsub2+$tproducto2;	
																	 }
																																		
															}															
													   echo'</ol>'." 	".'<font color="red"><b>$ '.money_format("%i",$tsub2).'</b></font>
														</li>										
													';
											 $tcat2=$tsub2+$tcat2;													
											}

								  	  echo '</ol>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red"><b>$ '.money_format("%i",$tcat2).'</b></font>
										</li>
								  	 ';	
							 $ttipo2=$tcat2+$ttipo2;
							 //$totalGastado=$totalGastado+$ttipo2;
							}

						echo'</ol>'."    ".'<font color="red"><b>'."Total gasto personal  ".'$ '.money_format("%i",$ttipo2).'</b></font>';
						?>					                       					
            </ol>
            <ol class="tree">
            	<li><label for="gastoi">Gastos de Inversion</label> <input type="checkbox" id="gastoi" />
						<ol>
							<?php
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
							 $tabla="select * from (SELECT * FROM detalle WHERE ".$idsc." OR ".$idscf.") as x ";								
								$c=mysql_query("SELECT * FROM categoria WHERE tipo ='INVERSION' order by nombre");
								$cat=mysql_fetch_array($c);
									$su=mysql_query("SELECT * FROM subcategoria WHERE id_categoria=".$cat['id_categoria']." order by nombre");
									while ($sub=mysql_fetch_array($su))
									 {
									 	$gas_sub2=0;
										echo "<li><label for='gastoi_s'>".$sub['nombre']."</label> <input type='checkbox' id='gastoi_s' /> 	
												<ol>";
													$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$sub['id_subcategoria']." order by nombre");
													while($pro=mysql_fetch_array($p))
													{
														//echo $pro['nombre'];
															$gasto_produ=totalGastos($pro['id_producto'],$tabla);														
															echo '<li><span>'.$pro["nombre"]." (".$pro["descripcion"].')'."   ".'<font color="red"><b> $ '.money_format("%i",$gasto_produ).'</b></font></span></li>';
															$gas_sub2=$$gas_sub2+$gasto_produ2;																												
													}
										  echo '</ol><font color="red"><b> $ '.money_format("%i",$gas_sub2).'</b></font>	
											  </li>';											
											  	$gasto_tipo2=$gasto_tipo2+$gas_sub2;
											  	$totalGastado=$totalGastado+$gasto_tipo2;

									 }
								
							?>
						</ol><font color="red"><b>Total Gastos de Inversion  $ <?php echo money_format("%i",$gasto_tipo2);?></b></font>
					</li>
            </ol>
</div>
<?php
}

//			CALCULO DE INSUMOS
function suma_todo($idp,$ids)
{	
	//	echo $idp;
		// echo $ids;
	
			$q="SELECT * FROM (".$ids.") as x WHERE id_producto=".$idp." AND tipo='faltante'";
			$r=mysql_query($q);
			while($m=mysql_fetch_array($r))
			{
/*				echo "Cantidad ".$m['cantidad']."<br>";
				echo "Precio ".$m['precio_adquisicion']."<br>";
				echo "Total ".$m['cantidad']*$m['precio_adquisicion']."<br>";*/
				 $t=($m['cantidad']*$m['precio_adquisicion'])+$t;


			}
			/*$i=mysql_query("SELECT * FROM inventario  WHERE id_producto=".$idp);
			$in=mysql_fetch_array($i);
			mysql_num_rows($r); */
			 $pr=mysql_query("SELECT * FROM producto WHERE id_producto=".$idp);
			 $pp=mysql_fetch_array($pr);
			
			 $ca=mysql_query("SELECT * FROM categoria WHERE id_categoria=".$pp['id_categoria']);
			 $cac=mysql_fetch_array($ca);
			 //echo "<br>*************		<font color='blue'>".$cac['tipo']."</font>		******************";			 			 		
			 if ($cac['tipo']=='INSUMO') 
			 {
					//$in['precio'];		
			 		//$t=$m['t']*$in['precio'];
			 		$t=$t*(-1);	 
			 }
			// echo "<br>".$t;
		return $t;
}function gasto_personal($idp,$idsc)
{
  	   $t=0; 
		echo $q="SELECT * FROM (".$idsc.") as x WHERE id_producto=".$idp." AND  tipo='comprafac'";
		$r=mysql_query($q);
		while($m=mysql_fetch_array($r))
		{
			$i=mysql_query("SELECT * FROM inventario  WHERE id_producto=".$idp);
			$in=mysql_fetch_array($i);	
			$ppp=mysql_query("SELECT * FROM producto WHERE id_producto=".$idp);
			$prr=mysql_fetch_array($ppp);
			
				$in['precio'];		
			 	$t=$m['cantidad']*$m['precio_adquisicion']+$t; 	
			
					
		}
		 $q="SELECT * FROM (".$idsc.") as x WHERE id_producto=".$idp." AND  tipo='compra'";
		$r=mysql_query($q);
		while($m=mysql_fetch_array($r))
		{
			$i=mysql_query("SELECT * FROM inventario  WHERE id_producto=".$idp);
			$in=mysql_fetch_array($i);	
			$ppp=mysql_query("SELECT * FROM producto WHERE id_producto=".$idp);
			$prr=mysql_fetch_array($ppp);
			
				$in['precio'];		
			 	$t=$m['cantidad']*$m['precio_adquisicion']+$t; 	
		
		}
		 
		return $t;
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
		 mysql_num_rows($r);
		$in['precio'];		
		 $t=$m['t']*$in['precio'];		 
		 $t=$t*(-1);
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
function total_comen($n,$fac){

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
?>
</body>
</html> 