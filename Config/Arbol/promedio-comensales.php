<?php
	require('../configuraciones.php');
		conectar();
		validarsesion();
	$nivel=$_SESSION['niv'];
	menuconfiguracion2();				
	$_SESSION['usu']=$_GET['usuario'];
	date_default_timezone_set('America/Mexico_City');
		

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Costo Promedio</title>
	<link rel="stylesheet" href="menu.css" />
		<link rel="stylesheet" href="jquery.treeview.css" />        
        <link rel="stylesheet" type="text/css" href="Arbol2/_styles.css" media="screen">
	<link rel="stylesheet" href="screen.css" />
	
	<script src="lib/jquery.js" type="text/javascript"></script>
	<script src="lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="jquery.treeview.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="demo.js"></script>
</head>
<body bgcolor="#FFFFFF" >
<br><br>
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
	<br><br>
	<?php
	if ($_POST['submit']):
		include('calculos.php');
		//	LLAMADA DE LOS DIFERENTES CALCULOS
			$numeroDeEventos=totalEventos($_POST['fecha1'],$_POST['fecha2']);	
			$comensales=comensalesContratos($_POST['fecha1'],$_POST['fecha2']);
			$contratos=enlistaContratos($_POST['fecha1'],$_POST['fecha2']);
			//echo "<br>LOS CONTRATOS SON ";
			//print_r($contratos);
	// 		DIV QUE MUESTRA LAS FECHAS DE CALCULO
		echo "<div id='fechas' align='center'><h2><font><b>FECHAS DE ".$_POST['fecha1']." HASTA ".$_POST['fecha2']."</b></font></h2></div>";		
		?>
			<div id='comensal' class="comensal">			
				<ul id="red" class="treeview-red">
					<li><span>Catidad de Eventos</span><font color="green"><b> <?php echo $numeroDeEventos;?></b></font></li>					
					<li><span>Catidad Total de Comensales</span><font color="green"><b> <?php echo $comensales['total']; ?></b></font>
						<ul>
							<li class="open"><span>Adultos</span><font color="green"><b> <?php echo $comensales['adultos']; ?></b></font></li>
							<li class="open"><span>Jovenes</span><font color="green"><b> <?php echo $comensales['jovenes']; ?></b></font></li>
							<li class="open"><span>Niños</span><font color="green"><b> <?php echo $comensales['ninos']; ?></b></font></li>
						</ul>
					</li>					
					<li><span>Cobrado</span>
						<?php
							for ($i=0; $i <count($contratos['Numero']) ; $i++) 
							{ 
								$totalCobrado=0;								
								$totalEvento=0;
								$totalCargos=0;
								$totalCobrado+=$contratos['si'][$i];																
								$totalEvento+=$totalCobrado;
								$cargos=enlistaCargos($contratos['Numero'][$i]);															
								echo "
										<ul>
											<li class='open'><span>".$contratos['Numero'][$i]."</span>
												<ul>
													<li><span>Cargos</span>	
														<ul>";														
															for ($j=0; $j <count($cargos['concepto']) ; $j++) 
															{ 
																echo "
																		<li ><span>".$cargos['concepto'][$j]."</span><font color='green'><b> $ ".money_format("%i",$cargos['cantidad'][$j])."</b></font>
																	 ";
																	 $totalCargos+=$cargos['cantidad'][$j];
															}													
												echo"	</ul>
														<font color='green'><b> $ ".money_format("%i", $totalCargos)."</b></font>
													</li>
													<li><span>Devolucion</span><font color='green'><b> $ ".money_format("%i",devolucion($contratos['Numero'][$i]))."</b></font></li>
													<li><span>Costo Evento</span><font color='green'><b> $ ".money_format("%i",$totalCobrado)."</b></font></li>
												</ul>
												<font color='green'><b> $ ".money_format("%i", ($totalEvento+$totalCargos-devolucion($contratos['Numero'][$i])))."</b></font>
											</li>

										</ul>
									";
							}
						?>						
						<span>=></span><font color="green"><b> $ <?php echo money_format("%i", ($totalEvento-devolucion($contratos['Numero'][$i])));?></b></font>
					</li>
					<li><span>Eventos Adicionales</span>
						<ul>
							<?php
								$adicionales=enlistaAdicionales($_POST['fecha1'],$_POST['fecha2']);
								for ($i=0; $i <count($adicionales) ; $i++) 
								{ 
									echo "<li><span>".$adicionales[$i]."</span>";
								}
							?>
						</ul>
					</li>
					<li><span>Eventos de Recaudacion</span>
						<ul>
							<?php
								$recaudacion=enlistaRecaudacion($_POST['fecha1'],$_POST['fecha2']);
								for ($i=0; $i <count($recaudacion) ; $i++) 
								{ 
									echo "<li><span>".$recaudacion[$i]."</span>";
								}
							?>
						</ul>
					</li>
			<!-- 	ESPACIOS ENTRE LISTAS DESPEGABLES	-->
					<li></li>
					<li></li>
			<!-- 	GASTOS		-->
					<li id="insumos"><span>Gastos Insumos</span>
						
					</li>
					<li id="activos"><span>Gastos Activo</span>
						
					</li>
					<li id="operativos"><span>Gastos Operativos</span>
						
					</li>
					<br><br>
					<li id="nomina"><span>Gastos Activo</span>
						
					</li>
					<li id="premioLealtad"><span>Gastos Operativos</span>
						
					</li>
				</ul>
			</div>
			
			<?php
	endif



	?>

<?php
	function gasto_personal($idp,$idsc)
	{
	  	   $t=0; 
			$q="SELECT * FROM (".$idsc.") as x WHERE id_producto=".$idp." AND  tipo='comprafac'";
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
	<script type="text/javascript">
		console.log('Termino de cargar');

		setTimeout(function (){
			//var tipo= "insumos" ;
			//var tipo = ["insumos", "activos","operativos"];
			$.each( [ "insumos", "activos","operativos","nomina","premioLealtad" ], function( i, l ){
  					//alert( "Index #" + i + ": " + l );
  					cargaExternos(l);
			});
		},1000);
		

            function cargaExternos(tipo)
            {            					    
            var f1='<?php echo $_POST["fecha1"]?>';
            var f2='<?php echo $_POST["fecha2"]?>';            
            var datos = {
            	"tipo":tipo,
                "fecha1" : f1,
                "fecha2" : f2
        		};
              $.ajax({
                    type: "POST",
                    url: "ajaxCalculos.php",
                    data: datos,
                    dataType: "html",
                    beforeSend: function(){
                          console.log('Conexion correcta ajax');
                    },
                    error: function(e){
                          alert("error petición ajax"+e);
                    },
                    success: function(data){                                                    
                         //alert('funciono'+data);  
                         $( "#"+tipo ).append( data );  
                         console.log('cargo '+tipo);
                    }
              });
                   
            }
				
	</script>
            }
</body>
</html>