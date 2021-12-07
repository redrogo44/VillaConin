<?php
require('../configuraciones.php');
	conectar();
	validarsesion();
	$nivel=$_SESSION['niv'];
	$_SESSION['usu']=$_GET['usuario'];
	date_default_timezone_set('America/Mexico_City');


	if (isset($_POST['tipo'])&&$_POST['tipo']=='abonos') 
	{

		$Total=0;		
		echo "<ul>
					<li><font color='red'><b> A  </b></font>
						<ul>";
							$TAbonoF=0;
							$aaf=mysql_query("SELECT * FROM abonofac where fechapago>='".$_POST['fecha1']."' AND fechapago<='".$_POST['fecha2']."' ORDER BY id");
							while ($abonof=mysql_fetch_array($aaf)) 
							{
								$c=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$abonof['cuenta']));
								echo '<li class="open"><span>'.$abonof['id'].', <font color="red"><b>'.$abonof['cantidad'].'</font>,<font color="#000"> '.$abonof['numcontrato'].'</font>, <font color="#87C5E1">'.$abonof['nomcontrato'].'</font>, <font color="#FA6BE0">'.$abonof['concepto']." Cuenta:".$c['alias'].'</b></font></span></li>';
								$TAbonoF=$TAbonoF+$abonof['cantidad'];

							}
						
			  	  echo "</ul><font color='blue'><b>    $ ".money_format("%i",$TAbonoF)."</b></font>";					$Total+=$TAbonoF;
			  echo "</li>
					<li class='nofac' style='display:none;'> <font color='red'><b> B  </b></font>
						<ul>";			
							$TAbono=0; 
							$aa=mysql_query("SELECT * FROM abono where fechapago>='".$_POST['fecha1']."' AND fechapago<='".$_POST['fecha2']."' ORDER BY id");
							while ($abono=mysql_fetch_array($aa)) 
							{
								$c=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$abono['cuenta']));

								echo '<li class="open"><span>'.$abono['id'].', <font color="red"><b>'.$abono['cantidad'].'</font>,<font color="#000"> '.$abono['numcontrato'].'</font>, <font color="#87C5E1">'.$abono['nomcontrato'].'</font>, <font color="#FA6BE0">'.$abono['concepto']." Cuenta: ".$c['alias'].'</b></font></span> </li>';
								$TAbono+=$abono['cantidad'];
							}	
						$Total+=$TAbono;								
					echo "</ul><font color='blue'><b>   $ ".money_format('%i',$TAbono)."</b></font>	
					</li>
			</ul><font color='blue'><strong class='fac'> $ ".money_format("%i",$TAbonoF)."</strong><strong class='nofac' style='display:none;'> $ ".money_format("%i",$Total)."</strong></font>";			
	} 
	if (isset($_POST['tipo'])&&$_POST['tipo']=='ventas') 
	{
		echo "<ul>";
			$TVentas=0;
			$vv=mysql_query("SELECT * FROM venta WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' ORDER BY id_venta");
		$TtVentas=0;
			while ($venta=mysql_fetch_array($vv)) 
			{
				$d=mysql_query("SELECT * FROM detalle WHERE tipo='venta' and id=".$venta['id_venta']." GROUP BY id");
				while ($detalle=mysql_fetch_array($d)) 
				{  $TVentas=0;
					echo "<li>".$detalle['id']."  
								<ul>";
								$d=mysql_query("SELECT * FROM detalle WHERE tipo='venta' and id=".$venta['id_venta']);
								while ($detalle=mysql_fetch_array($d)) 					
								{
									$producto=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$detalle['id_producto']));
								echo '
									<li class="open"><b><font color="red"> $ '.money_format("%i",$detalle['importe']).'</font>, <font color="#87C5E1">'.$detalle['cantidad']."   ".$producto['nombre'].'</font></b></li>							
									 ';	
									 $TVentas+=$detalle['importe'];
								}
								 $TtVentas+=$TVentas;
						  echo "</ul> <font color='#87C5E1'>  $  ".money_format("%i",$TVentas)."  ".$venta['formapago']."</font>
						 </li>";
										
				}							
			}			
		echo "</ul><font color='blue'><b> $".money_format("%i",$TtVentas)."</b></font>";
	}
	if (isset($_POST['tipo'])&&$_POST['tipo']=='recaudacion') 
	{
		echo "<ul>";
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
								echo "<li class='open'><span>".$ti['folio'].", <font color='red'> $".money_format("%i",$ti['Total'])."</font>  Pago en Efectivo</span>
										<ul>";
								$pr=explode(",",$ti['productos']);
								$can=explode(",",$ti['cantidades']);
								$tot=explode(",",$ti['totales']);
								for ($i=1; $i <count($pr) ; $i++) 
								{ 
									echo "<li><font color='blue'><b>".$can[$i]."    </b></font>  <font color='#87C5E1'><b>".$pr[$i]."</b></font><font color='red'><b> $ ".money_format("%i",$tot[$i])."</b></font>, </li>";								
								}
								$TTicket=$TTicket+$ti['Total'];
								echo "</ul> 
									</li>";

							}
								$TTTickets+=$TTicket;

						echo " </ul><font color='red'><b> $".money_format("%i",$TTicket)." ( Alimentos )</b></font></li>"; 
					}					
	echo "</ul><font color='blue'><b>  $".money_format("%i",$TTTickets)."</b></font>"; 
	}
	if(isset($_POST['tipo'])&&$_POST['tipo']=='compras-facturadas')
	{
		$TTCAE=0; $TCaC=0; $TTCaC=0;
		$cca=mysql_query("SELECT * FROM cancelacion WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND tipo='comprafac' ");
	echo "<ul>";
		while ($coca=mysql_fetch_array($cca)) 
		{
			$TCaC=0;
			$g=mysql_fetch_array(mysql_query("SELECT sum(importe) as total FROM detalle WHERE tipo='comprafac-cancelada' AND id=".$coca['id']));
			$TCaC=$g["total"];///total del importe en detalle
			////obtenemos el descuento y ajuste y volvemos a calcular el total de la compra
			$info_compra=mysql_fetch_array(mysql_query("select * from comprafac where id_compra=".$coca["id"]));
			$TCaC=$TCaC-$info_compra["descuento"]+$info_compra["iva"];///total de la compra
			
			echo "<li><span>".$coca['id_cancelacion'].', <font color="red">$ '.money_format("%i",$TCaC)."</font></span>
					<ul>";
						$h=mysql_query("SELECT * FROM detalle WHERE tipo='comprafac-cancelada' AND id=".$coca['id']);
						while($decoca=mysql_fetch_array($h))
						{
							$pro=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$decoca['id_producto']));
							echo "<li><b><font color='#87C5E1'>".$pro['nombre']." ".$pro['descripcion']."</font><font>$ ".money_format("%i",$decoca['importe'])."</font></b></li>";
						}
				echo "<li><b><font color='#87C5E1'>descuento</font><font>$ ".money_format("%i",$info_compra["descuento"])."</font></b></li>";
				echo "<li><b><font color='#87C5E1'>Ajuste</font><font>$ ".money_format("%i",$info_compra["iva"])."</font></b></li>";
			  echo "</ul>
				  </li>";
					$TTCaC=$TTCaC+$TCaC;		 										
		} 
		$TTCAE+=$TTCaC;
	echo "</ul><font color='blue'><b> $ ".money_format('%i',$TTCaC)."</b></font>";					
	}
	if(isset($_POST['tipo'])&&$_POST['tipo']=='compras-no-facturadas')
	{
		echo "<ul>";
				$TTCAE=0; $TCaC=0;$TTCaC=0;
				$cca=mysql_query("SELECT * FROM cancelacion WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND tipo='compra' ");
				while ($coca=mysql_fetch_array($cca)) 
				{
					$TCaC=0;
					$g=mysql_fetch_array(mysql_query("SELECT sum(importe) as total FROM detalle WHERE tipo='compra-cancelada' AND id=".$coca['id']));
					$TCaC=$g["total"];///total del importe en detalle
					////obtenemos el descuento y ajuste y volvemos a calcular el total de la compra
					$info_compra=mysql_fetch_array(mysql_query("select * from compra where id_compra=".$coca["id"]));
					$TCaC=$TCaC-$info_compra["descuento"]+$info_compra["iva"];///total de la compra

					echo "<li><span>".$coca['id_cancelacion'].', <font color="red">$ '.money_format("%i",$TCaC)."</font></span>
							<ul>";
							$h=mysql_query("SELECT * FROM detalle WHERE tipo='compra-cancelada' AND id=".$coca['id']);
								while($decoca=mysql_fetch_array($h))
								{
									$pro=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$decoca['id_producto']));
									echo "<li><b><font color='#87C5E1'>".$pro['nombre']." ".$pro['descripcion']."</font><font>$ ".money_format("%i",$decoca['importe'])."</font></b></li>";
								}
						echo "<li><b><font color='#87C5E1'>descuento</font><font>$ ".money_format("%i",$info_compra["descuento"])."</font></b>	</li>";
						echo "<li><b><font color='#87C5E1'>Ajuste</font><font>$ ".money_format("%i",$info_compra["iva"])."</font></b></li>";
					  echo "</ul>
						</li>";
					$TTCaC=$TTCaC+$TCaC;
										
				}
		$TTCAE+=$TTCaC;
		echo "</ul><font color='blue'><b> $ ".money_format("%i",$TTCaC)."</b></font>";
	}
	if(isset($_POST['tipo'])&&$_POST['tipo']=='contrato-ingresos')
	{
		$total=0;
		echo "<ul>";
					$ca=mysql_query("SELECT * FROM Cancelaciones WHERE tipo ='Contrato' AND fechamovimiento>='".$_POST['fecha1']."' AND fechamovimiento<='".$_POST['fecha2']."' AND facturado='no' ");
					while($c=mysql_fetch_array($ca))
					{
						if($c['devuelto']>0)
						{		
							echo "<li>".$c['numcontrato'].", $ ".money_format("%i",$c['devuelto'])."</li>";
							$total+=$c['devuelto'];
						}
					}
		echo "</ul><font color='blue'><b> $ ".money_format("%i",$total)."</b></font>";
	}
	if(isset($_POST['tipo'])&&$_POST['tipo']=='contrato-ingresos-fac')
	{
		$total=0;
		echo "<ul>";
					$ca=mysql_query("SELECT * FROM Cancelaciones WHERE tipo ='Contrato' AND fechamovimiento>='".$_POST['fecha1']."' AND fechamovimiento<='".$_POST['fecha2']."' AND facturado='si' ");
					while($c=mysql_fetch_array($ca))
					{
						if($c['devuelto']>0)
						{		
							echo "<li>".$c['numcontrato'].", $ ".money_format("%i",$c['devuelto'])."</li>";
							$total+=$c['devuelto'];
						}
					}
		echo "</ul><font color='blue'><b> $ ".money_format("%i",$total)."</b></font>";
	}
	if(isset($_POST['tipo'])&&$_POST['tipo']=='compras')
	{
		echo "<ul>";
		$TTCompras=0; $TEgresos=0;	$TCompras=0;
		$cf=mysql_query("SELECT * FROM comprafac WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."'  ");
			while ($compraf=mysql_fetch_array($cf)) 
			{
		
			$pro=mysql_fetch_array(mysql_query("SELECT * FROM proveedor WHERE id_proveedor=".$compraf['id_proveedor'] ));										
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
				 ///datos de la compra
				 $info_compra=mysql_fetch_array(mysql_query("select * from comprafac where id_compra=".$compraf['id_compra']));
				 ///datos de descuento y ajuste
				 $timpo=$timpo-$info_compra["descuento"]+$info_compra["iva"];
					$c=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$compraf['cuenta']));								
					echo '
					<li class="open"><span>'.$compraf['id_compra'].', <font color="red"> $ '.money_format("%i",$timpo).' Proveedor: '.$pro['nombre'].'</font>, <font color="#87C5E1">'.$compraf['formapago']." Cuenta:".$c['alias'].'</font></span>
						<ul>';
								$filas=explode(",", $producto);
								for ($i=1; $i <count($filas) ; $i++) 
								{ 
									echo "<li class='open'><span><b>".$filas[$i]."</b></span></li>";
								}
				 		echo "<li class='open'><span><b>Descuento"." <font color='red'>".money_format("%i",$info_compra["descuento"])."</font></b></span></li>";
				 		echo "<li class='open'><span><b>Ajuste"." <font color='red'>".money_format("%i",$info_compra["iva"])."</font></b></span></li>";
				echo '</ul>
					</li>							
				 ';		$TCompras=$TCompras+$timpo;
				}
			
			}
	echo "</ul><font color='blue'><b> $ ".money_format("%i",$TCompras)."</b></font>";
	}
	if (isset($_POST['tipo'])&&$_POST['tipo']=='compras-no') 
	{
		echo "<ul>";
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
				
				 ///datos de la compra
				 $info_compra=mysql_fetch_array(mysql_query("select * from compra where id_compra=".$compraf['id_compra']));
				 ///datos de descuento y ajuste
				 $timpo=$timpo-$info_compra["descuento"]+$info_compra["iva"];
				
				
			$c=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$compraf['cuenta']));								

				echo '
				<li class="open"><span>'.$compraf['id_compra'].', <font color="red"> $ '.money_format("%i",$timpo).' Proveedor: '.$pro['nombre'].'</font>, <font color="#FA6BE0">'.$pr['nombre'].'</font> <font color="#87C5E1">'.$compraf['formapago']." Cuenta:".$c['alias'].'</font></span>
					<ul>';
						$filas=explode(",", $producto);
						for ($i=1; $i <count($filas) ; $i++) 
						{ 
							echo "<li class='open'><span><b>".$filas[$i]."</b></span></li>";
						}
				echo "<li class='open'><span><b>Descuento"." <font color='red'>".money_format("%i",$info_compra["descuento"])."</font></b></span></li>";
				 echo "<li class='open'><span><b>Ajuste"." <font color='red'>".money_format("%i",$info_compra["iva"])."</font></b></span></li>";
			echo '	</ul>
				</li>							
			 ';		$TCompras=$TCompras+$timpo;
			}
		
		}
	echo "</ul><font color='blue'><b> $ ".money_format("%i",$TCompras)."</b></font>";
	}
	if (isset($_POST['tipo'])&&$_POST['tipo']=='devoluciones') 
	{
		echo "<ul>";
			$TDevoluciones=0;
			$dev=mysql_query("SELECT * FROM TDevoluciones WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."' AND estatus=1 ");
			while ($devolucion=mysql_fetch_array($dev)) 
			{
				$contrato=mysql_fetch_array(mysql_query("SELECT * FROM contrato WHERE Numero='".$devolucion['Numero']."' "));
				echo '
					<li class="open"><b>'.$devolucion['id'].', <font color="red"> $ '.money_format("%i",$devolucion['Total']).' Efectivo </font>, <font color="#FA6BE0">'.$devolucion['Numero'].'</font> <font color="#87C5E1">'.$contrato['nombre'].'</font></b></li>							
					';	
					$TDevoluciones=$TDevoluciones+$devolucion['Total'];		
			}				
	echo "</ul><font color='blue'><b> $ ".money_format("%i",$TDevoluciones)."</b></font>";
	}
	if (isset($_POST['tipo'])&&$_POST['tipo']=='abonos-egresos') 
	{
		echo "<ul>";
				echo "<li><font style='color:red;'><strong>A</strong></font><ul>";
				/////facturados
				$TACa=0;			
				$ac=mysql_query("SELECT * FROM Cancelaciones WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND tipo='Abono' and facturado='si'");
				while ($ca=mysql_fetch_array($ac)) 
				{
					echo "<li>".$ca['folio'].",  $ ".money_format("%i",$ca['cantidad']).", <font> ".$ca['numcontrato']."</font>, ".$ca['concepto']." </li>";
					$TACa+=$ca['cantidad'];
				}
				echo "</ul><b> $ ".money_format("%i",($TACa))."</b></li>";
				echo "<li class='nofac' style='display:none;'><font style='color:red;'><strong>B</strong></font><ul>";
				///no facturados
				$TACa2=0;			
				$ac2=mysql_query("SELECT * FROM Cancelaciones WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND tipo='Abono' and facturado='si'");
				while ($ca2=mysql_fetch_array($ac2)) 
				{
					echo "<li>".$ca2['folio'].",  $ ".money_format("%i",$ca2['cantidad']).", <font> ".$ca2['numcontrato']."</font>, ".$ca2['concepto']." </li>";
					$TACa2+=$ca2['cantidad'];
				}
				echo "</ul><b> $ ".money_format("%i",($TACa2))."</b></li>";
				
		echo "</ul><font color='blue'><strong class='fac'> $ ".money_format("%i",($TACa))."</strong><strong class='nofac' style='display:none;'> $ ".money_format("%i",(($TACa+$TACa2)))."</font>";
	}
	if (isset($_POST['tipo'])&&$_POST['tipo']=='cargos-egresos') 
	{
		echo "<ul>";
				$TCCa=0;
				$cc=mysql_query("SELECT * FROM Cancelaciones WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND tipo='Cargo' ");
				while ($car=mysql_fetch_array($cc)) 
				{
					echo '
						<li class="open"><b>'.$car['folio'].', <font color="red"> $ '.money_format("%i",$car['cantidad']).'</font>, <font color="#FA6BE0">'.$car['numcontrato'].'</font>, <font color="#87C5E1">'.$car['concepto'].'</font></b></li>																	
						';
						$TCCa=$TCCa+$car['cantidad'];
				}		
	echo "</ul><font color='blue'><b> $ ".money_format("%i",($TCCa))."</b></font>";
	}
	if (isset($_POST['tipo'])&&$_POST['tipo']=='ventas-egresos') 
	{
		echo "<ul>";
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
	 echo "</ul><font color='blue'><b> $ ".money_format("%i",($TVCa))."</b></font>";
	}
	if(isset($_POST['tipo'])&&$_POST['tipo']=='contrato-egresos')		
	{

		$total=0;
		echo "<ul>";
					$ca=mysql_query("SELECT * FROM Cancelaciones WHERE tipo ='Contrato' AND fechamovimiento>='".$_POST['fecha1']."' AND fechamovimiento<='".$_POST['fecha2']."' AND facturado='no' ");
					while($c=mysql_fetch_array($ca))
					{
						if($c['devuelto']<0)
						{		
							echo "<li>".$c['numcontrato'].", $ ".money_format("%i",$c['devuelto'])."</li>";
							$total+=($c['devuelto'] * -1);
						}
					}
		echo "</ul><font color='blue'><b> $ ".money_format("%i",$total)."</b></font>";
	}
	if(isset($_POST['tipo'])&&$_POST['tipo']=='contrato-egresos-fac')		
	{
		$total=0;
		echo "<ul>";
					$ca=mysql_query("SELECT * FROM Cancelaciones WHERE tipo ='Contrato' AND fechamovimiento>='".$_POST['fecha1']."' AND fechamovimiento<='".$_POST['fecha2']."' AND facturado='si' ");
					while($c=mysql_fetch_array($ca))
					{
						if($c['devuelto']<0)
						{		
							echo "<li>".$c['numcontrato'].", $ ".money_format("%i",$c['devuelto'])."</li>";
							$total+=($c['devuelto'] * -1);
						}
					}
		echo "</ul><font color='blue'><b> $ ".money_format("%i",$total)."</b></font>";
	}

	if(isset($_POST['tipo'])&&$_POST['tipo']=='traspasos')
	{
		////traspasos faturados activos y entre rango de fechs
		$mo=mysql_query("SELECT * FROM Movimientos_Cuentas where facturado='1' and cuenta_emisor REGEXP '^[0-9]+$' and cuenta_receptora REGEXP '^[0-9]+$' and estatus='activo' and fecha>='".$_POST["fecha1"]."' and fecha<='".$_POST["fecha2"]."'");
		echo "<ul><li><font style='color:red;'><strong>A</strong></font><ul>";
		while ($m=mysql_fetch_array($mo)) 
		{
			if($m['banco_emisor']!='Efectivo')
			{
				$b=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$m['banco_emisor']));
				$c=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$m['cuenta_emisor']));
			}
			else
			{
				$b['nombre']='Efectivo';
				$c['nombre']="Efectivo";
			}
			$br=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$m['banco_receptor']));
			$cr=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$m['cuenta_receptora']));

			echo "<li>Emisor: ".$b['nombre'].", Cuenta: ".$c['nombre'].", Cantidad:".$m['cantidad']."  ||    Receptor:".$br['nombre'].", Cuenta:".$cr['alias']."</li>";

		}
		echo "</ul></li>";
		////traspasos NO faturados activos y entre rango de fechas
		$mo2=mysql_query("SELECT * FROM Movimientos_Cuentas where facturado='0' and cuenta_emisor REGEXP '^[0-9]+$' and cuenta_receptora REGEXP '^[0-9]+$' and estatus='activo' and fecha>='".$_POST["fecha1"]."' and fecha<='".$_POST["fecha2"]."'");
		
		echo "<li class='nofac' style='display:none;'><font style='color:red;'><strong>B</strong></font><ul>";
		while ($m2=mysql_fetch_array($mo2)) 
		{
			if($m2['banco_emisor']!='Efectivo')
			{
				$b2=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$m2['banco_emisor']));
				$c2=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$m2['cuenta_emisor']));
			}
			else
			{
				$b2['nombre']='Efectivo';
				$c2['nombre']="Efectivo";
			}
			$br2=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$m2['banco_receptor']));
			$cr2=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$m2['cuenta_receptora']));

			echo "<li>Emisor: ".$b2['nombre'].", Cuenta: ".$c2['nombre'].", Cantidad:".$m2['cantidad']."  ||    Receptor:".$br2['nombre'].", Cuenta:".$cr2['alias']."</li>";

		}
		echo "</ul></li></ul>";
		
	}
	if(isset($_POST['tipo'])&&$_POST['tipo']=='saldos')
	{
		echo "<ul>
				<li> Efectivo 
					<ul>";
					$tee=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=2 "));
						
						///calculo del saldo inicial
					echo $si=saldo_inicial("2");
						////obtencion de los movimiento entre el rango de fechas
						echo "Recibidos".$recibidos=totalMovimientosRecibidos3("2");
						echo "Realizados".$realizados=totalMovimientosRealizados3("2");
						$ReA=RecaudacionAlimentos();// OBTENEMOS EL TOTAL DE LA RECUDACION DE ALIMENTOS
						$saldo_final=$si+$ReA+$recibidos-$realizados;
						echo "<li> Efectivo Saldo Inicial $ ".money_format("%i",$si)."</li>";
						echo "<li> Efectivo Final $ ".money_format("%i",$saldo_final)." </li>";
		  		echo "</ul>
		  		</li>";
				$ba=mysql_query("SELECT * FROM bancos");
				while ($b=mysql_fetch_array($ba)) 
				{
					echo "<li>".$b['nombre']; 
					echo "<ul>";
					$cu=mysql_query("SELECT * FROM Cuentas WHERE banco=".$b['id']);
						while ($c=mysql_fetch_array($cu))  
						{
							///calculo del saldo inicial
							$si=saldo_inicial($c['id']);
							////obtencion de los movimiento entre el rango de fechas
							$recibidos=totalMovimientosRecibidos3($c['id']);
							$realizados=totalMovimientosRealizados3($c['id']);
							$saldo_final=$si+$recibidos-$realizados;
							echo "<li>".$c["nombre"]."<ul>";
							echo "<li> Efectivo Saldo Inicial $ ".money_format("%i",$si)."</li>";
							echo "<li> Efectivo Final $ ".money_format("%i",$saldo_final)." </li>";
							echo "</ul></li>";
							/*$tmR=totalMovimientosRecibidos($c['id']);
							$tmH=totalMovimientosRealizados($c['id']);
							$si=$c['saldo_final']-$tmR+$tmH;
							echo "<li> ".$c['nombre'].",  Saldo Inicial: $ ".money_format("%i",$si)."</li>";
							echo "<li>".$c['nombre'].",  Saldo Final: $ ".money_format("%i",$c['saldo_final'])."</li>";*/
						}
					echo "</ul>";					
					echo "</li>"; 
				}  
		echo "</ul>";
	}
	if(isset($_POST['tipo'])&&$_POST['tipo']=='saldos2')
	{
		echo "<ul>
				<li> Efectivo 
					<ul>";
					$tee=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=2 "));
						
						///calculo del saldo inicial
					echo $si=saldo_inicialf("2");
						////obtencion de los movimiento entre el rango de fechas
						echo "Recibidos".$recibidos=totalMovimientosRecibidos3f("2");
						$ReA=RecaudacionAlimentos();// OBTENEMOS EL TOTAL DE LA RECUDACION DE ALIMENTOS
						echo "Realizados".$realizados=totalMovimientosRealizados3f("2");
						$saldo_final=$si+$recibidos-$realizados+$ReA;
						echo "<li> Efectivo Saldo Inicial $ ".money_format("%i",$si)."</li>";
						echo "<li> Efectivo Final $ ".money_format("%i",$saldo_final)." </li>";
		  		echo "</ul>
		  		</li>";
				$ba=mysql_query("SELECT * FROM bancos");
				while ($b=mysql_fetch_array($ba)) 
				{
					echo "<li>".$b['nombre']; 
					echo "<ul>";
					$cu=mysql_query("SELECT * FROM Cuentas WHERE banco=".$b['id']);
						while ($c=mysql_fetch_array($cu))  
						{
							///calculo del saldo inicial
							$si=saldo_inicialf($c['id']);
							////obtencion de los movimiento entre el rango de fechas
							$recibidos=totalMovimientosRecibidos3f($c['id']);
							$realizados=totalMovimientosRealizados3f($c['id']);
							$saldo_final=$si+$recibidos-$realizados;
							echo "<li>".$c["nombre"]."<ul>";
							echo "<li> Efectivo Saldo Inicial $ ".money_format("%i",$si)."</li>";
							echo "<li> Efectivo Final $ ".money_format("%i",$saldo_final)." </li>";
							echo "</ul></li>";
							/*$tmR=totalMovimientosRecibidos($c['id']);
							$tmH=totalMovimientosRealizados($c['id']);
							$si=$c['saldo_final']-$tmR+$tmH;
							echo "<li> ".$c['nombre'].",  Saldo Inicial: $ ".money_format("%i",$si)."</li>";
							echo "<li>".$c['nombre'].",  Saldo Final: $ ".money_format("%i",$c['saldo_final'])."</li>";*/
						}
					echo "</ul>";					
					echo "</li>"; 
				}  
		echo "</ul>";
	}
	if(isset($_POST['tipo'])&&$_POST['tipo']=='otrosingresos')
	{		
		////facturados 
		$pre=mysql_query("SELECT *  FROM prestamos WHERE fecha >=  '".$_POST['fecha1']." 00:00:00"."' AND fecha <=  '".$_POST['fecha2']." 23:59:59"."' AND cantidad > 0 AND facturado='1' AND estatus='activo' ");
		echo "<ul>";
		echo "<li><font style='color:red;'><strong>A</strong></font><ul>";
			while ($p=mysql_fetch_array($pre)) 
			{			$b['nombre']='';
					$c=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$p['cuenta']));
					if($c['banco'!='Efectivo'])
					{
						$b=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$c['banco']));
					}
					echo $cc="Banco: ".$b['nombre'].", Cuenta : ".$c['alias'];

				echo "<li>Folio: ".$p['id']." ".$p['nombre'].", $".money_format("%i",$p['cantidad']).", ".$p['formapago']." ".$cc."</li>";
				$t+=$p['cantidad'];
			}	
		echo "</ul></li>";
		echo "<li class='nofac' style='display:none;'><font style='color:red;'><strong>B</strong></font><ul>";
		///no facturado
		$pre2=mysql_query("SELECT *  FROM prestamos WHERE fecha >=  '".$_POST['fecha1']." 00:00:00"."' AND fecha <=  '".$_POST['fecha2']." 23:59:59"."' AND cantidad > 0 AND facturado='0' AND estatus='activo'");
		while ($p2=mysql_fetch_array($pre2)) 
			{		$b2['nombre']='';
					$c2=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$p2['cuenta']));
					if($c2['banco'!='Efectivo'])
					{
						$b2=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$c2['banco']));
					}
					echo $cc2="Banco: ".$b2['nombre'].", Cuenta : ".$c2['alias'];

				echo "<li>Folio: ".$p2['id']." ".$p2['nombre'].", $".money_format("%i",$p2['cantidad']).", ".$p2['formapago']." ".$cc2."</li>";
				$t2+=$p2['cantidad'];
			}	
		echo "</ul></li>";
		echo "</ul> <font><strong class='fac'> $  ".money_format("%i", ($t))."</strong><strong class='nofac' style='display:none;'> $  ".money_format("%i", ($t2))."</strong></font>";
		
	}
	if(isset($_POST['tipo'])&&$_POST['tipo']=='otros-egresos')
	{	
		//facturado
		$pre=mysql_query("SELECT *  FROM prestamos WHERE fecha >=  '".$_POST['fecha1']." 00:00:00"."' AND fecha <=  '".$_POST['fecha2']." 23:59:59"."' AND cantidad < 0 and facturado='1' and estatus='activo'");	
		echo "<ul>";
		echo "<li><font style='color:red;'><strong>A</strong></font><ul>";
		while ($p=mysql_fetch_array($pre)) 
		{
			$b['nombre']='';
				$c=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$p['cuenta']));
				if($c['banco'!='Efectivo'])
				{
					$b=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$c['banco']));
				}
				echo $cc="Banco: ".$b['nombre'].", Cuenta : ".$c['alias'];
		
			echo "<li>Folio: ".$p['id']." ".$p['nombre'].", $".money_format("%i",($p['cantidad']*-1)).", ".$p['formapago']." ".$cc."</li>";
			$t+=$p['cantidad'];
		}
		echo "</ul><strong > $  ".money_format("%i", ($t*-1))."</strong></li>";
		echo "<li class='nofac' style='display:none;'><font style='color:red;'><strong>B</strong></font><ul>";
		//No facturado
		$pre2=mysql_query("SELECT *  FROM prestamos WHERE fecha >=  '".$_POST['fecha1']." 00:00:00"."' AND fecha <=  '".$_POST['fecha2']." 23:59:59"."' AND cantidad < 0 and facturado='0' and estatus='activo'");
		while ($p2=mysql_fetch_array($pre2)) 
		{
			$b2['nombre']='';
				$c2=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$p2['cuenta']));
				if($c2['banco'!='Efectivo'])
				{
					$b2=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$c2['banco']));
				}
				echo $cc2="Banco: ".$b2['nombre'].", Cuenta : ".$c2['alias'];
		
			echo "<li>Folio: ".$p2['id']." ".$p2['nombre'].", $".money_format("%i",($p2['cantidad']*-1)).", ".$p2['formapago']." ".$cc2."</li>";
			$t2+=$p2['cantidad'];
		}
		echo "</ul></strong><strong > $  ".money_format("%i", ($t2*-1))."</strong></li>";
	echo "</ul><font><strong class='fac'> $  ".money_format("%i", ($t*-1))."</strong><strong class='nofac' style='display:none;'> $  ".money_format("%i", (($t2*-1)+($t*-1)))."</strong></font>";
	}
	if(isset($_POST['tipo'])&&$_POST['tipo']=='Nuevo_Movimiento')	
	{	
		if($_POST["facturado"]=="si"){
			$banM="1";
		}else{
			$banM="0";
		}
		//BUSCAMOS EL VALOR MAXIMO DE EL FOLIO ACTUALMENTE PARA COLOCARLO EN LA INSERCION DEL QUERY DE PRESTAMOS
		$folio=mysql_fetch_array(mysql_query("SELECT MAX(folio) AS f FROM prestamos WHERE facturado=".$banM));
		
		if($folio['f']==null|| $folio['f']=="")
		{
			$folio['f']=0;
		}
		
		
		$folio['f']=$folio['f']+1;
		
		mysql_query("INSERT INTO `prestamos`( `nombre`, `cantidad`, `formapago`,`cuenta`,facturado, folio) VALUES ('".$_POST['nombre']."',".$_POST['cantidad'].",'".$_POST['formaPago']."', ".$_POST['cuenta'].",'".$banM."', '".$folio['f']."' )");
		$movimiento="movimiento".$_POST["tipo"];
		////insercion en movimientos cuetas
		$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$_POST['cuenta']));
		// OBTENEMOS EL ID DEL ULTIMO REGISTRO
			$id=mysql_fetch_array(mysql_query("SELECT MAX(id) AS id FROM prestamos"));

		if($_POST["cantidad"]<0){///egreso
			$insert_movimiento=mysql_query("insert into Movimientos_Cuentas(fecha,banco_emisor,cuenta_emisor,banco_receptor,cuenta_receptora,cantidad, concepto,facturado,referencia) values('".date('Y-m-d')."','".$obtener_cuenta["banco"]."','".$obtener_cuenta["id"]."','movimiento','movimiento',".($_POST['cantidad']*-1).",'movimiento-prestamo','".$banM."',".$id['id']." )");
		}else{////ingreso
			$insert_movimiento=mysql_query("insert into Movimientos_Cuentas(fecha,banco_emisor,cuenta_emisor,banco_receptor,cuenta_receptora,cantidad, concepto,facturado, referencia) values('".date('Y-m-d')."','movimiento','movimiento','".$obtener_cuenta["banco"]."','".$obtener_cuenta["id"]."',".$_POST['cantidad'].",'movimiento-prestamo','".$banM."', ".$id['id']." )");
		}
		///actualizamos saldo final de la cuenta sumandole el abonos ya esta positivo o negativo por eso solo se suma 
		$saldo_actual_cuenta=$obtener_cuenta["saldo_final"]+$_POST['cantidad'];
		$actualiza_saldo_cuenta=mysql_query("update Cuentas set saldo_final=".$saldo_actual_cuenta." where id=".$_POST['cuenta']);
		
		echo "<script>
		setTimeout(function(){			
				opener.location.reload(); 
				window.close(); 
		}, 1900);				
			  </script>";
	}
	if(isset($_POST['tipo'])&&$_POST['tipo']=='nominas')	
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
									///////////	recaudacion///////////////////////////////////
									$er=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."'");							
									$tms=0;
									while($cont=mysql_fetch_array($er))
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
									///////////////////////////////////////////////////////
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
					<ul>
						<li>
							Construcción
							<ul>"; $tc=0; $templeado=0;
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
					 	echo"</ul><font color='blue'> ".money_format("%i",$tc)."</font>
						</li>
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
						</li>
						<li>Extras
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
						</li>
						<li> Planta
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
						</li>
						<li>Comisión
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
						</li>
					</ul><font color='blue'> ".money_format("%i",$templeado)."</font>
				</li>
			</ul><font color ='green'><b id='gNomina'> $ ".money_format("%i",($totalMeseros+$templeado))."</b></font></span>
		 ";
	}

if(isset($_POST['tipo'])&&$_POST['tipo']=='CancelarMovimiento')	
{
	mysql_query("UPDATE `prestamos` SET `estatus`='cancelado' WHERE `folio`='".$_POST['folio']."' AND `facturado`=".$_POST['facturado']);
	echo "SE HA CANCELADO EL MOVIMIENTO CON EXITO.";

	//MODIFICAMOS LA CUENTA A LA QUE SE LE CANCELO EL MOVIMIENTO
	$p=mysql_fetch_array(mysql_query("SELECT * FROM prestamos  WHERE `folio`='".$_POST['folio']."' AND `facturado`=".$_POST['facturado']));
	$c=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$p['cuenta']));
	$saldoFinal=$c['saldo_final']-$p['cantidad'];	
	mysql_query("UPDATE `Cuentas` SET `saldo_final`=".$saldoFinal." WHERE `id`=".$p['cuenta']);
	//MODIFICAMOS EL ESTATUS DEL MOVIMIENTO EN LA TABLA DE MOVIMIENTOS CUENTAS
	mysql_query("UPDATE `Movimientos_Cuentas` SET `estatus`='suspendido' WHERE `concepto`='movimiento-prestamo' AND `referencia`=".$p['id']);		

}

///////////////////////////////////// FUNCIONES php///////////////////////////////////777
function totalMovimientosRecibidos($id)
{
	$t=mysql_fetch_array(mysql_query("SELECT SUM(cantidad) AS t FROM Movimientos_Cuentas WHERE  cuenta_receptora=".$id));
	return $t['t'];
}
function totalMovimientosRealizados($id)
{
	$t=mysql_fetch_array(mysql_query("SELECT SUM(cantidad) AS t FROM Movimientos_Cuentas WHERE   cuenta_emisor=".$id));
	return $t['t'];
}

/////////////////////////////////////////////////////////para facturados y no facturados

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
function totalMovimientosRecibidos3($id)
{
	$t=mysql_fetch_array(mysql_query("SELECT SUM(cantidad) AS t FROM Movimientos_Cuentas WHERE fecha>='".$_POST["fecha1"]."' AND fecha<='".$_POST["fecha2"]."' AND cuenta_receptora=".$id." and estatus='activo'"));
	return $t['t'];
}
function totalMovimientosRealizados3($id)
{
	$t=mysql_fetch_array(mysql_query("SELECT SUM(`cantidad`) AS t FROM `Movimientos_Cuentas` WHERE fecha >= '".$_POST['fecha1']."' AND fecha <= '".$_POST['fecha2']."' AND `cuenta_emisor`=".$id." and estatus='activo'"));
	return $t['t'];
}

/////////////////////////////////////////////////////////solo facturados

function saldo_inicialf($id){
	//obtenemos saldo inicial cuando se creo la cuenta
	$info=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$id));
	///para obtener el saldo inicial entre el rango de fechas se calcula el saldo hasta la fecha de inicio del rango para tomarla como saldo inicial
	$saldo_inicial=$info["saldo_inicial"]+totalMovimientosRecibidos2f($id)-totalMovimientosRealizados2f($id);
	return $saldo_inicial;
}
function totalMovimientosRecibidos2f($id)
{//echo "SELECT SUM(cantidad) AS t FROM Movimientos_Cuentas WHERE  fecha >='".$_POST["fecha1"]."' AND fecha<= '".$_POST['fecha2']."' AND cuenta_receptora=".$id;
	$t=mysql_fetch_array(mysql_query("SELECT SUM(cantidad) AS t FROM Movimientos_Cuentas WHERE  fecha <'".$_POST["fecha1"]."'  AND cuenta_receptora=".$id." and facturado='1' and estatus='activo'"));
	return $t['t'];
}
function totalMovimientosRealizados2f($id)
{
	$t=mysql_fetch_array(mysql_query("SELECT SUM(cantidad) AS t FROM Movimientos_Cuentas WHERE fecha < '".$_POST["fecha1"]."'  AND cuenta_emisor=".$id." and facturado='1' and estatus='activo'"));
	return $t['t'];
}
function totalMovimientosRecibidos3f($id)
{
	$t=mysql_fetch_array(mysql_query("SELECT SUM(cantidad) AS t FROM Movimientos_Cuentas WHERE fecha>='".$_POST["fecha1"]."' AND fecha<='".$_POST["fecha2"]."' AND cuenta_receptora=".$id." and facturado='1' and estatus='activo'"));
	return $t['t'];
}
function totalMovimientosRealizados3f($id)
{
	$t=mysql_fetch_array(mysql_query("SELECT SUM(`cantidad`) AS t FROM `Movimientos_Cuentas` WHERE fecha >= '".$_POST['fecha1']."' AND fecha <= '".$_POST['fecha2']."' AND `cuenta_emisor`=".$id." and facturado='1' and estatus='activo'"));
	return $t['t'];
}

//////////////////////////////////////////////////////

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
	function RecaudacionAlimentos()
	{
		$t=mysql_fetch_array(mysql_query("SELECT SUM(  `Total` ) AS t FROM  `tickets`  WHERE  `fecha` >=  '".$_POST['fecha1']."' AND  `fecha` <=  '".$_POST['fecha2']."' AND estatus='ACTIVO' "))	;
		return $t['t'];
	}
?>