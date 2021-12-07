<!DOCTYPE html>
<html lang="es">
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
		<link rel="stylesheet" href="../Arbol/menu.css" />
		<link rel="stylesheet" href="../Arbol/jquery.treeview.css" />        
        <link rel="stylesheet" type="text/css" href="../Arbol/Arbol2/_styles.css" media="screen">
	<link rel="stylesheet" href="screen.css" />
	
	<script src="../Arbol/lib/jquery.js" type="text/javascript"></script>
	<script src="../Arbol/lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="../Arbol/jquery.treeview.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="../Arbol/demo.js"></script>
	
</head>
<body background="../../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFF" >
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
echo "<div id='fechas' align='center'><h2><font><b>FECHAS DE <font color='green'>".$_POST['fecha1']."</font> HASTA <font color='#F00'>".$_POST['fecha2']."</b></font></h2></div>";
?>
<br><br>
<div id="Abonos" class="comensal">
	<ul id="red" class="treeview-red">
		<li><span>INGRESOS</span>
			<ul>
				<li><span>ABONOS</span>
					<ul>
						<li class="open"><span> No Facturados</span>
							<ul>
								<?php
								$TIngresos=0;
								$TAbono=0;
								$TTAbonos=0;
								$aa=mysql_query("SELECT * FROM abono where fechapago>='".$_POST['fecha1']."' AND fechapago<='".$_POST['fecha2']."' ORDER BY id");
								while ($abono=mysql_fetch_array($aa)) 
								{
									echo '<li class="open"><span>'.$abono['id'].', <font color="red"><b>'.$abono['cantidad'].'</font>,<font color="#000"> '.$abono['numcontrato'].'</font>, <font color="#87C5E1">'.$abono['nomcontrato'].'</font>, <font color="#FA6BE0">'.$abono['concepto'].'</b></font></span> </li>';
									$TAbono=$TAbono+$abono['cantidad'];

								}
								?>
							</ul><font color='blue'><b>Total no Facturados $ <?php echo money_format("%i",$TAbono); $TTAbonos=$TTAbonos+$TAbono;?></b></font>	
						</li>
						<div class='oculto'>
							<li><span>Facturados</span>
								<ul>
									<?php
									$TAbonoF=0;
									$aaf=mysql_query("SELECT * FROM abonofac where fechapago>='".$_POST['fecha1']."' AND fechapago<='".$_POST['fecha2']."' ORDER BY id");
									while ($abonof=mysql_fetch_array($aaf)) 
									{
										echo '<li class="open"><span>'.$abonof['id'].', <font color="red"><b>'.$abonof['cantidad'].'</font>,<font color="#000"> '.$abonof['numcontrato'].'</font>, <font color="#87C5E1">'.$abonof['nomcontrato'].'</font>, <font color="#FA6BE0">'.$abonof['concepto'].'</b></font></span> </li>';
										$TAbonoF=$TAbonoF+$abonof['cantidad'];

									}
									?>
								</ul><font color='blue'><b>Total Facturados $ <?php echo money_format("%i",$TAbonoF); $TTAbonos=$TTAbonos+$TAbonoF?></b></font>
							</li>
						</div>					
					</ul><font color='blue'><b>Total de Abonos $ <?php echo money_format("%i",$TTAbonos); $TIngresos=$TIngresos+$TTAbonos;?></b></font>
				</li>				
				<li><span>VENTAS</span>
					<ul>
					<?php
								$TVentas=0;
						$vv=mysql_query("SELECT * FROM venta WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' ORDER BY id_venta");
						while ($venta=mysql_fetch_array($vv)) 
						{
							$d=mysql_query("SELECT * FROM detalle WHERE tipo='venta' and id=".$venta['id_venta']);
							while ($detalle=mysql_fetch_array($d)) 
							{
								echo '
									<li class="open"><b>'.$detalle['id'].', <font color="red"> $ '.money_format("%i",$detalle['importe']).'</font>, <font color="#87C5E1">'.$venta['formapago'].'</font></b></li>							
								 ';	
								 $TVentas=$TVentas+$detalle['importe'];
							}							
						}
					?>
					</ul><font color='blue'><b>Total de Ventas $ <?php echo money_format("%i",$TVentas); $TIngresos=$TIngresos+$TVentas;?></b></font>				
				</li>
				<li><span>EVENTOS RECAUDACION</span>
					<ul>
						<?php
						$TTicket=0;
						$TTTickets=0;
							$E=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."' AND estatus='ACTIVO' ");
							while ($Er=mysql_fetch_array($E)) 
							{
								echo "<li><span>".$Er['Numero']."</span>
										<ul>";
									$t=mysql_query("SELECT * FROM tickets WHERE referencia='".$Er['Numero']."' ORDER BY folio ");
									while ($ti=mysql_fetch_array($t)) 
									{
										echo "<li class='open'><span>".$ti['folio'].", <font color='red'> $".money_format("%i",$ti['Total'])."</font></span>
												<ul>";
										$pr=explode(",",$ti['productos']);
										$can=explode(",",$ti['cantidades']);
										$tot=explode(",",$ti['totales']);
										for ($i=1; $i <count($pr) ; $i++) 
										{ 
											echo "<li><font color='blue'><b>".$can[$i]."</b></font>  <font color='#87C5E1'><b>".$pr[$i]."</b></font><font color='red'><b> $ ".money_format("%i",$tot[$i])."</b></font></li>";								
										}
										$TTicket=$TTicket+$ti['Total'];
										echo "</ul> 
											</li>";

									}
										$TTTickets=$TTTickets+$TTicket;

								echo " </ul><font color='red'><b> $".money_format("%i",$TTicket)."</b></font>
									</li>"; 
							}
						?>
					</ul><?php echo "<font color='blue'><b>Total de Recaudacion $".money_format("%i",$TTTickets)."</b></font>"; $TIngresos=$TIngresos+$TTTicets;?>
				</li>
				<li><span>CANCELACIONES</span>
					<ul>
					<li><span>COMPRAS NO FACTURADAS</span>
						<ul>
							<?php
							$TTCAE=0;
							//echo "SELECT * FROM cancelacion WHERE fecha<='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND tipo='comprafac' ";
							$TCaC=0;
							$TTCaC=0;
								$cca=mysql_query("SELECT * FROM cancelacion WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND tipo='compra' ");
								while ($coca=mysql_fetch_array($cca)) 
								{
									$g=mysql_query("SELECT * FROM detalle WHERE tipo='compra-cancelada' AND id=".$coca['id']);
									while($decoca=mysql_fetch_array($g))
									{
										$TCaC=$TCaC+$decoca['importe'];
									}

									echo "<li><span>".$coca['id_cancelacion'].', <font color="red">$ '.money_format("%i",$TCaC)."</font></span>
											<ul>";
											$h=mysql_query("SELECT * FROM detalle WHERE tipo='compra-cancelada' AND id=".$coca['id']);
												while($decoca=mysql_fetch_array($h))
												{
													$pro=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$decoca['id_producto']));
													echo "<li><b><font color='#87C5E1'>".$pro['nombre']." ".$pro['descripcion']."</font><font>$ ".money_format("%i",$decoca['importe'])."</font></b></li>";
												}	
									  echo "</ul>
										</li>";
							$TTCaC=$TTCaC+$TCaC;
														
								}
							?>
						</ul><font color="blue"><b>Total de Compras no Facturadas $ <?php echo money_format("%i",$TTCaC);$TTCAE=$TTCAE+$TTCaC;?></b></font>
					</li>	
						<li><span>COMPRAS FACTURADAS</span>
						<ul>
							<?php
							$TTCAE=0;
							//echo "SELECT * FROM cancelacion WHERE fecha<='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND tipo='comprafac' ";
							$TCaC=0;
							$TTCaC=0;
								$cca=mysql_query("SELECT * FROM cancelacion WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND tipo='comprafac' ");
								while ($coca=mysql_fetch_array($cca)) 
								{
									$g=mysql_query("SELECT * FROM detalle WHERE tipo='comprafac-cancelada' AND id=".$coca['id']);
									while($decoca=mysql_fetch_array($g))
									{
										$TCaC=$TCaC+$decoca['importe'];
									}

									echo "<li><span>".$coca['id_cancelacion'].', <font color="red">$ '.money_format("%i",$TCaC)."</font></span>
											<ul>";
											$h=mysql_query("SELECT * FROM detalle WHERE tipo='comprafac-cancelada' AND id=".$coca['id']);
												while($decoca=mysql_fetch_array($h))
												{
													$pro=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$decoca['id_producto']));
													echo "<li><b><font color='#87C5E1'>".$pro['nombre']." ".$pro['descripcion']."</font><font>$ ".money_format("%i",$decoca['importe'])."</font></b></li>";
												}	
									  echo "</ul>
										</li>";
							$TTCaC=$TTCaC+$TCaC;
														
								}
							?>
						</ul><font color="blue"><b>Total de Compras Facturadas$ <?php echo money_format("%i",$TTCaC);$TTCAE=$TTCAE+$TTCaC;?></b></font>
					</li>					
			
									
				</ul><font color="blue"><b>Total Cancelaciones $ <?php echo money_format("%i",$TTCAE);?></b></font>
				</li>
			</ul><?php echo "<font color='blue'><b>Total Ingresos $".money_format("%i",$TIngresos)."</b></font>";?>
		</li>
		<li><span>EGRESOS</span>
			<ul>
				<li><span>COMPRAS</span>
					<ul>
						<li><span>FACTURADAS</span>
							<ul>
								<?php
								$TTCompras=0;
								$TEgresos=0;
								$TCompras=0;
									$cf=mysql_query("SELECT * FROM comprafac WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."'  ");
									while ($compraf=mysql_fetch_array($cf)) 
									{
										//	echo "SELECT * FROM detalle WHERE tipo='comprafac' AND id=".$compraf['id_compra'];
											$pr=mysql_fetch_array(mysql_query("SELECT * FROM proveedor WHERE id_proveedor=".$compraf['id_proveedor'] ));										
										$dcf=mysql_query("SELECT * FROM detalle WHERE tipo='comprafac' AND id=".$compraf['id_compra']." GROUP BY id ");
										while($detallec=mysql_fetch_array($dcf))
										{$timpo=0;$producto='';
											$x=mysql_query("SELECT * FROM detalle WHERE tipo='comprafac' AND id=".$compraf['id_compra']);
											while($totalV=mysql_fetch_array($x))
											{
												$timpo=$timpo+$totalV['importe'];
												$pr=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$totalV['id_producto']));
												$producto=$producto.",".$pr['nombre']." ".$pr['descripcion']." <font color='red'>".money_format("%i",$totalV['importe'])."</font>";
											}

											echo '
											<li class="open"><span>'.$compraf['id_compra'].', <font color="red"> $ '.money_format("%i",$timpo).'</font>, <font color="#FA6BE0">'.$pr['nombre'].'</font>, <font color="#87C5E1">'.$compraf['formapago'].'</font></span>
												<ul>';
														$filas=explode(",", $producto);
														for ($i=1; $i <count($filas) ; $i++) 
														{ 
															echo "<li class='open'><span><b>".$filas[$i]."</b></span></li>";
														}
										echo '</ul>
											</li>							
										 ';		$TCompras=$TCompras+$detallec['importe'];
										}
									
									}
								?>
							</ul><font color='blue'><b>Total de Compras Facturadas $ <?php echo money_format("%i",$TCompras); $TTCompras=$TTCompras+$TCompras;?></b></font>
						</li>
						<div class="oculto">
							<li><span>NO FACTURADAS</span>
								<ul>
									<?php
									$TCompras=0;
										$cf=mysql_query("SELECT * FROM compra WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' ");
										while ($compraf=mysql_fetch_array($cf)) 
										{
											//	echo "SELECT * FROM detalle WHERE tipo='comprafac' AND id=".$compraf['id_compra'];
											$pr=mysql_fetch_array(mysql_query("SELECT * FROM proveedor WHERE id_proveedor=".$compraf['id_proveedor']));
											$dcf=mysql_query("SELECT * FROM detalle WHERE tipo='compra' AND id=".$compraf['id_compra']." GROUP BY id");
											while($detallec=mysql_fetch_array($dcf))
											{
												$timpo=0;$producto='';
												$x=mysql_query("SELECT * FROM detalle WHERE tipo='compra' AND id=".$compraf['id_compra']);
												while($totalV=mysql_fetch_array($x))
												{
													$timpo=$timpo+$totalV['importe'];
													$pr=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$totalV['id_producto']));
													$producto=$producto.",".$pr['nombre']." ".$pr['descripcion']." <font color='red'>".money_format("%i",$totalV['importe'])."</font>";
												}
												echo '
												<li class="open"><span>'.$compraf['id_compra'].', <font color="red"> $ '.money_format("%i",$timpo).'</font>, <font color="#FA6BE0">'.$pr['nombre'].'</font> <font color="#87C5E1">'.$compraf['formapago'].'</font></span>
													<ul>';
														$filas=explode(",", $producto);
														for ($i=1; $i <count($filas) ; $i++) 
														{ 
															echo "<li class='open'><span><b>".$filas[$i]."</b></span></li>";
														}
											echo '	</ul>
												</li>							
											 ';		$TCompras=$TCompras+$detallec['importe'];
											}
										
										}
									?>
								</ul><font color='blue'><b>Total de Compras No Facturadas $ <?php echo money_format("%i",$TCompras); $TTCompras=$TTCompras+$TCompras;?></b></font>
						
							</li>							
						</div>
					</ul><font color='blue'><b>Total  Compras $ <?php echo money_format("%i",$TTCompras); $TEgresos=$TEgresos+$TTCompras;?></b></font>						
				</li>
				<li><span>DEVOLUCIONES</span>
					<ul>
						<?php
						$TDevoluciones=0;
							$dev=mysql_query("SELECT * FROM TDevoluciones WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."' AND estatus=1 ");
							while ($devolucion=mysql_fetch_array($dev)) 
							{
								$contrato=mysql_fetch_array(mysql_query("SELECT * FROM contrato WHERE Numero='".$devolucion['Numero']."' "));
								echo '
									<li class="open"><b>'.$devolucion['id'].', <font color="red"> $ '.money_format("%i",$devolucion['Total']).'</font>, <font color="#FA6BE0">'.$devolucion['Numero'].'</font> <font color="#87C5E1">'.$contrato['nombre'].'</font></b></li>							
									';	
									$TDevoluciones=$TDevoluciones+$devolucion['Total'];		
							}
							
						?>
					</ul><font color='blue'><b>Total Devoluciones $ <?php echo money_format("%i",$TDevoluciones); $TEgresos=$TEgresos+$TDevoluciones;?></b></font>						
				</li>
				<li><span>CANCELACIONES</span>
					<ul>
						<li><span>ABONOS</span>
							<ul>
								<?php
								$TACa=0;
									$ac=mysql_query("SELECT * FROM Cancelaciones WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND tipo='Abono' ");
									while ($ca=mysql_fetch_array($ac)) 
									{
										echo '
											<li class="open"><b>'.$ca['folio'].', <font color="red"> $ '.money_format("%i",$ca['cantidad']).'</font>, <font color="#FA6BE0">'.$ca['numcontrato'].'</font>, <font color="#87C5E1">'.$ca['concepto'].'</font></li>																	
											';
											$TACa=$TACa+$ca['cantidad'];
									}
								?>
							</ul><font color='blue'><b>Total Abonos Cancelados $ <?php echo money_format("%i",($TACa));?></b></font>
						</li>
						<li><span>CARGOS</span>
						<ul>
							<?php
								$TCCa=0;
									$cc=mysql_query("SELECT * FROM Cancelaciones WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND tipo='Cargo' ");
									while ($car=mysql_fetch_array($cc)) 
									{
										echo '
											<li class="open"><b>'.$car['folio'].', <font color="red"> $ '.money_format("%i",$car['cantidad']).'</font>, <font color="#FA6BE0">'.$car['numcontrato'].'</font>, <font color="#87C5E1">'.$car['concepto'].'</font></b></li>																	
											';
											$TCCa=$TCCa+$car['cantidad'];
									}
								?>
						</ul><font color='blue'><b>Total Cargos Cancelados $ <?php echo money_format("%i",($TCCa));?></b></font>
						</li>
						<li><span>VENTAS</span>
						<ul>

							<?php

							$TVCa=0;						
								$cve=mysql_query("SELECT * FROM cancelacion WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND tipo='venta' ");
								while ($cv=mysql_fetch_array($cve)) 
								{
									//echo "SELECT * FROM detalle WHERE tipo='venta-cancelada' AND id=".$cv['id'];									
									$devc=mysql_fetch_array(mysql_query("SELECT * FROM detalle WHERE tipo='venta-cancelada' AND id=".$cv['id']));									
									$pro=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$devc['id_producto']));
										echo '
											<li class="open"><b>'.$devc['id'].', <font color="red"> $ '.money_format("%i",$devc['importe']).'</font>, <font color="#FA6BE0">'.$pro['nombre'].' '.$pro['descripcion'].'</font></li>																	
											';
											$TVCa=$TVCa+$devc['importe'];
									
								}
							?>
						</ul><font color='blue'><b>Total Ventas Cancelados $ <?php echo money_format("%i",($TVCa));?></b></font>
						</li>
					</ul>
				</li>
			</ul><font color='blue'><b>Total Egresos $ <?php echo money_format("%i",($TEgresos));?></b></font>
						
		</li>
		
	</ul>
</div>
</body>
</html>