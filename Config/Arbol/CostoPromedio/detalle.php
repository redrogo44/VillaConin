  <style type="text/css">
  	table {
  border: 2px solid #42b983;
  border-radius: 3px;
  background-color: #fff;
}

th {
  background-color: #42b983;
  color: rgba(255,255,255,0.66);
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

td {
  background-color: #f9f9f9;
}

th, td {
  min-width: 120px;
  padding: 10px 20px;
}

th.active {
  color: #fff;
}

th.active .arrow {
  opacity: 1;
}
  </style>
  <?php
require('../../configuraciones.php');
		conectar();
		validarsesion();
	$nivel=$_SESSION['niv'];
	//menuconfiguracion2();				
	$_SESSION['usu']=$_GET['usuario'];
	date_default_timezone_set('America/Mexico_City');

$fecha1=$_GET['f1'];
$fecha2=$_GET['f2'];

	$tipo=$_GET['tipo'];
		switch ($tipo) {
			case 'ventasVinos':
					$tipo = "VENTA DE VINOS.";
				break;
			case 'eventos':
					$tipo = "EVENTOS.";
				break;
			case 'comensales':
					$tipo = "COMENSALES.";
				break;
			case 'eAdicional':
					$tipo = "EVENTOS ADICIONALES.";
				break;			
			case 'eRecaudacion':
					$tipo = "EVENTOS DE RECAUDACION.";
				break;
			case 'ventasT':
					$tipo = "VENTAS.";
				break;	
			case 'gastoInsumo':
					$tipo = "GASTO DE INSUMO";
				break;	
			case 'compras':
					$tipo = "GASTO ACTIVO.";
				break;	
			case 'gastoOperativo':
					$tipo = "GASTO OPERATIVO.";
				break;	
			case 'gastoPersonal':
					$tipo = "GASTOS PERSONALES.";
				break;

			default:
				# code...
				break;
		}


?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <style type="text/css">
  ul{
    list-style: none;
  }
  </style>
  <script>
  $(document).ready(function()
  {
    $(".btn-folder").on("click", function(e)
    {
      e.preventDefault();
      if($(this).attr("data-status") === "1")
      {
        $(this).attr("data-status", "0");
        $(this).find("span").removeClass("glyphicon-minus-sign").addClass("glyphicon-plus-sign")
      }
      else
      {
        $(this).attr("data-status", "1");
        $(this).find("span").removeClass("glyphicon-plus-sign").addClass("glyphicon-minus-sign")
      }
      $(this).next("ul").slideToggle();
    })
  });

  
     
  </script>
</head>
<body>
  <div class="container">   
   
    <div class="row col-lg-12" style='display: inline-block;'>
      <div class="col-md-12" id="nested" style="background: #222; color: #ddd">
        <h3 class="heading text-center">DETALLE: <?php echo $tipo; ?></h3><hr>

        	<?php
        		function eventos()
        		{    

        		
        			$totalEventos=0;
					$contratos=mysql_fetch_array(mysql_query("SELECT COUNT( Numero ) AS t FROM contrato WHERE Fecha >=  '".$_GET['f1']."' AND Fecha <=  '".$_GET['f2']."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8 "));
					$recaudacion=mysql_fetch_array(mysql_query("SELECT COUNT( Numero ) AS t FROM Eventos_Recaudacion WHERE Fecha >=  '".$_GET['f1']."' AND Fecha <=  '".$_GET['f2']."' AND estatus='ACTIVO' "));	 			
					$adicionales=mysql_fetch_array(mysql_query("SELECT COUNT( Numero ) AS t FROM Eventos_Adicionales WHERE Fecha >=  '".$_GET['f1']."' AND Fecha <=  '".$_GET['f2']."' "));	 								
					echo "<div class='col-md-12' align='center'>
							<h4>Numero de Eventos : <b>".($contratos['t'])."</b></h4>
							<div class='col-md-3'>
								<h5>Contratos</h5>
								<table>
									<thead>
										<tr>
											<th>Numero</th>
										</tr>
									</thead>
									<tbody>";
									$c=mysql_query("SELECT * FROM contrato WHERE Fecha >=  '".$_GET['f1']."' AND Fecha <=  '".$_GET['f2']."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8 ");
										while ($co=mysql_fetch_array($c)) 
										{
											echo "<tr><td>".$co['Numero']."</td></tr>";
										}
						echo "		</tbody>
								</table>
							</div>		";		
						// 	<div class='col-md-3'>
						// 		<h5>Eventos de Recaudacion</h5>
						// 		<table>
						// 			<thead>
						// 				<tr>
						// 					<th>Numero</th>
						// 				</tr>
						// 			</thead>
						// 			<tbody>";
						// 			$c=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Fecha >=  '".$_GET['f1']."' AND Fecha <=  '".$_GET['f2']."' AND estatus='ACTIVO' ");
						// 				while ($co=mysql_fetch_array($c)) 
						// 				{
						// 					echo "<tr><td>".$co['Numero']."</td></tr>";
						// 				}
						// echo "		</tbody>
						// 		</table>
						// 	</div>					
						// 	<div class='col-md-3'>
						// 		<h5>Eventos de Adicionales</h5>
						// 		<table>
						// 			<thead>
						// 				<tr>
						// 					<th>Numero</th>
						// 				</tr>
						// 			</thead>
						// 			<tbody>";
						// 			$c=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Fecha >=  '".$_GET['f1']."' AND Fecha <=  '".$_GET['f2']."' ");
						// 				while ($co=mysql_fetch_array($c)) 
						// 				{
						// 					echo "<tr><td>".$co['Numero']."</td></tr>";
						// 				}
						// echo "		</tbody>
						// 		</table>
						// 	</div>							
					 // </div>";

					
        		}
        		function comensales()
        		{
        			$contratos=mysql_fetch_array(mysql_query("SELECT SUM( c_adultos ) AS a, SUM( c_jovenes ) AS j, SUM( c_ninos ) AS n  FROM contrato WHERE Fecha >=  '".$_GET['f1']."' AND Fecha <=  '".$_GET['f2']."' AND tipo!='MOSTRADOR'"));	 						
					$comensales['total']=($contratos['a']+$contratos['j']+$contratos['n']);
					$comensales['adultos']=$contratos['a'];
					$comensales['jovenes']=$contratos['j'];
					$comensales['ninos']=$contratos['n'];
				
					$cagos=mysql_query("SELECT Numero, facturado FROM contrato WHERE Fecha >=  '".$_GET['f1']."' AND Fecha <=  '".$_GET['f2']."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8;  ");
					while ($comensalesCargos=mysql_fetch_array($cagos)) 
						{							
							$tcc=total_comen($comensalesCargos['Numero'] , $comensalesCargos['facturado']);
							$comensales['adultos']+=$tcc[0];
							$comensales['jovenes']+=$tcc[1];
							$comensales['ninos']+=$tcc[2];
							$comensales['total']+=($tcc[0]+$tcc[1]+$tcc[2]);
						}
					// $adicionales=mysql_fetch_array(mysql_query("SELECT SUM( c_adultos ) AS a, SUM(c_jovenes) AS j, SUM(c_ninos) AS n FROM Eventos_Adicionales WHERE Fecha>='".$_GET['f1']."' AND Fecha<='".$_GET['f2']."' "));
					// $comensales['total']+=($adicionales['a']+$adicionales['j']+$adicionales['n']);
					// $comensales['adultos']+=$adicionales['a'];
					// $comensales['jovenes']+=$adicionales['j'];
					// $comensales['ninos']+=$adicionales['n'];							
					echo "<div class='col-md-12'	align='center'>
							<h4>Numero de Comensales : <b>".($comensales['adultos']+$comensales['jovenes']+$comensales['ninos'])."</b></h4>					
								<div class='col-md-3' align='center'>
									<h5>Adultos: <b>".$comensales['adultos']."</b></h5>
								</div>
								<div class='col-md-3' align='center'>
									<h5>Jovenes: <b>".$comensales['jovenes']."</b></h5>
								</div>
								<div class='col-md-3' align='center'>
									<h5>". utf8_decode("Niños").": <b>".$comensales['ninos']."</b></h5>
								</div>
						  </div>";
        		}
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
				function cobrado()
				{

					echo "<div class='col-md-12' align='center'>
						<ul>";
							$totalCobrado=0;$_SESSION["TotalCobrado"]=0;
							$contratos=mysql_query("SELECT * FROM contrato WHERE Fecha >=  '".$_GET['f1']."' AND Fecha <=  '".$_GET['f2']."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8; ");		
									while ($c=mysql_fetch_array($contratos)) 
									{

										//echo  "<br>".$c['Numero']." - ".$c['deposito']. " - ".$c["si"]." - ". ($c['deposito']+$c["si"]) ;

										$totalContrato=0;				
											$totalContrato+=($c['si']);							
														$devolucion=mysql_fetch_array(mysql_query("SELECT * FROM TDevoluciones WHERE Numero='".$c['Numero']."' "));
														$totalContrato-=$devolucion['Total'];						
														$cargo=mysql_query("SELECT * FROM contrato WHERE Numero='".$c['Numero']."' ");
														while($ca=mysql_fetch_array($cargo))
														{
															if($ca['facturado']=='si')
															{	
																  $car=mysql_query("SELECT SUM(cantidad) AS tCargos FROM `cargofac` WHERE `numcontrato` LIKE '%".$ca['Numero']."%'");
															}
															else
															{
															  $car=mysql_query("SELECT SUM(cantidad) AS tCargos FROM `cargo` WHERE `numcontrato` LIKE '%".$ca['Numero']."%'");
															} 	
															$carg=mysql_fetch_array($car);															
															$totalContrato+=$carg['tCargos'];																			
															if($c['facturado'] == 'si')
															{
																$tt = $c['si']+$c['deposito'];
															}				  	
															else{
																$tt = $c['si'];
															}
															
															echo" <li style='margin: 5px 0px'>
															            <span><i class='glyphicon glyphicon-folder-open'></i></span>
															               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
															                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
															                ".$c['Numero'].": <font color='red'><b >".money_format("%i",$totalContrato)."</b></font>
															               </a>  
															               <ul>
															               		<li>Costo Evento : $ <b>".money_format("%i",$tt)." </b></li>
															               		<li>Cargos: $ <b>".$carg['tCargos']."</b></li>
															               		<li>Devolucion: $ <b>".$devolucion['Total']."</b></li>															               		
															               </ul>        
															          </li>";
														}
											  			$totalCobrado+=$totalContrato;
									}
							echo "<tr><td>Total Cobrado: </td><td><b>$ ".money_format("%i", ($totalCobrado))."<b></td></tr>";		
				  echo "</tbody>
					</table></div>";
					
				}
				function eAdicional()
				{

					$adicionales=mysql_query("SELECT COUNT('Numero') as c FROM `Eventos_Adicionales` WHERE `Fecha`>= '".$_GET['f1']."' AND `Fecha`<= '".$_GET['f2']."' ");
	   				$d=mysql_fetch_array($adicionales);	   				
	   				echo "<div class='col-md-12' align='center'>
	   						<h3>Eventos Adicionales: <b>".$d['c']."</b></h3>
								<div class='col-md-3' align='center'>							
									<table>
										<thead>
											<tr>
												<th>Numero</th>
											</tr>
										</thead>
										<tbody>";
											$adicionales=mysql_query("SELECT * FROM `Eventos_Adicionales` WHERE `Fecha`>= '".$_GET['f1']."' AND `Fecha`<= '".$_GET['f2']."' ");
	   										while($d=mysql_fetch_array($adicionales))
	   										{
												echo "<tr><td>".$d['Numero']."</td></tr>";
	   										}
								  echo "</tbody>
									</table>
								</div>
	   					  </div>";
				}
				function eRecaudacion()
				{				
							
				$trr=mysql_query("SELECT count(fecha) as cantidad FROM `Eventos_Recaudacion` WHERE `fecha`>= '".$_GET['f1']."' AND `fecha`<= '".$_GET['f2']."' AND estatus='ACTIVO' ");	 						$ttrr = mysql_fetch_array($trr);			
	   				echo "<div class='col-md-12' align='center'>
	   						<h3>".utf8_decode("Eventos de Recaudación: ".$ttrr['cantidad'])."</h3>
								<div class='col-md-3' align='center'>							
									<table>
										<thead>
											<tr>
												<th>Numero</th>
												<th>Cobrado</th>
											</tr>
										</thead>
										<tbody>";
											$recaudacion=mysql_query("SELECT * FROM `Eventos_Recaudacion` WHERE `fecha`>= '".$_GET['f1']."' AND `fecha`<= '".$_GET['f2']."' AND estatus='ACTIVO' ");	
											$ttRecaudacion=0;
												while ($r=mysql_fetch_array($recaudacion)) 
												{
													$totalRecaudacion=0;		
													$tic=mysql_query("SELECT SUM(Total) as total FROM tickets WHERE referencia='".$r['Numero']."' AND estatus='ACTIVO' ORDER BY folio");

													// while($t=mysql_fetch_array($tic))
													// {
													// 	$total_ticket=0;						
													// 	$c=explode(",",$t['cantidades']);
													// 	$p=explode(",",$t['productos']);
													// 	$tt=explode(",",$t['totales']);
													// 	for ($i=1; $i <count($c) ; $i++) 
													// 	{ 										
													// 		$total_ticket+=$tt[$i];
													// 	}					
													// 	  $totalRecaudacion+=$total_ticket;
													// }
													$t = mysql_fetch_array($tic);
													//$ttRecaudacion+=$totalRecaudacion;
													$ttRecaudacion+=$t['total'];
													echo "<tr><td>".$r['Numero']."</td><td>    $ ".money_format("%i", $t['total'])."</td></tr>";

												}
							
								  echo "</tbody>
								  		<tr><td>".utf8_decode( "Total Recaudación: ")." </td><td> <b> $ ".money_format("%i",$ttRecaudacion)."</b></td></tr>
									</table>
								</div>
	   					  </div>";
				}
				function ventasVinos()
				{
					echo "<ul>";
						$venta=mysql_query("SELECT * FROM venta WHERE fecha>='".$_GET['f1']."' AND fecha<='".$_GET['f2']."' ");
						 $tt=0;
						while($v=mysql_fetch_array($venta))
						{

							echo" <li style='margin: 5px 0px'>
						            <span><i class='glyphicon glyphicon-folder-open'></i></span>
						               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
						                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
						                Ticket #: ".$v['id_venta']."
						               </a>          
						          </li><ul>";
						///////validamos que en el contenido de la compra exista almenos una venta de vino
						//////Desglozamos la venta
							if(valida_venta($v['id_venta'])){
								$totv=0;			
								$det=mysql_query("SELECT * FROM detalle where tipo='venta' AND id=".$v['id_venta']);
								while ($d=mysql_fetch_array($det)) 
								{
									$p=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$d['id_producto']));
									if($p['id_categoria']=='1')
									{  										
										$t=($d['cantidad']*($d['precio_venta']-$d['precio_adquisicion']));
										if($t>0)
										{				
											$totv+=$t;
											$tt+=$t;
									echo" <li style='margin: 5px 0px'>
								            <span><i class='glyphicon glyphicon-folder-open'></i></span>
								               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
								                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
								                ".$p['nombre'].": <font color='red'><b >".$t."</b></font>
								               </a>          
								          </li>";
										}
									}
								}			
							}
						echo "</ul></li>"	 ;
						}
						echo "Total Venta de Vinos: $".money_format("%i",$tt);
					echo "</ul>";
				}
				function valida_venta($id)
				{
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
				function ventasT()
				{
					$venta=mysql_query("SELECT * FROM venta WHERE fecha >= '".$_GET['f1']."' AND fecha <= '".$_GET['f2']."' ");
					 $tt=0;
						while($v=mysql_fetch_array($venta))
						{
							$det=mysql_query("SELECT * FROM detalle where tipo='venta' AND id_producto != '' AND id=".$v['id_venta']);
								echo "<ul>";
							while ($d=mysql_fetch_array($det)) 
							{
								$p=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$d['id_producto']));
								if($p['id_categoria']!=1)
								{
									$t=($d['cantidad']*($d['precio_venta']-$d['precio_adquisicion']));
									if($t>0)
									{				
										$tt+=$t;
										
												echo " <li style='margin: 5px 0px'>
								            				<span><i class='glyphicon glyphicon-folder-open'></i></span>
								               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
								                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
								                ".utf8_decode($p['nombre']).$d['id'].": <font color='red'><b > $".$t."</b></font>
								               </a>          
								          </li>";
									}																			
								} 
							}
							echo "</ul>";
						}
						echo "Total de Ventas: $ ".money_format("%i",$tt);	
				}
				function Cancelaciones()
				{
					echo "<ul>";
						$c=mysql_query("SELECT * FROM Cancelaciones WHERE 	concepto='cancelacion de contrato' AND fechamovimiento>='".$_GET['f1']."' AND 	fechamovimiento<='".$_GET['f2']."' ");
						 $tt=0;	
						while($cancelacion=mysql_fetch_array($c))
						{		
							$tt=$tt+$cancelacion["cantidad"];
							echo " <li style='margin: 5px 0px'>
						              <span><i class='glyphicon glyphicon-folder-open'></i></span>
						               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
						                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
						                ".utf8_decode($cancelacion['numcontrato']).": <font color='red'><b > $ ".money_format("%i",$cancelacion["cantidad"])."</b></font>
						               </a>          
								    </li>";
						}
					echo "</ul>";
					echo "TOTAL CANCELACIONES: $ ".money_format("%i",$tt);
				}
				function gastoInsumo()
				{	
					echo "<ul>";

					$tt=0;
					$cs=mysql_query("SELECT  nombreSubcategoria,id_subcategoria,nombreCategoria,id_categoria FROM Categorias_Subcategorias WHERE  `tipoCategoria` = 'INSUMO' GROUP BY nombreCategoria");
					while($casu=mysql_fetch_array($cs))
					{

$tsub=0;
						$prcat=mysql_query("SELECT id_producto,nombreProducto FROM Categorias_Subcategorias WHERE id_categoria=".$casu['id_categoria']);
				               	while($pp=mysql_fetch_array($prcat))
				               	{
									$in=mysql_query("SELECT ((cantidad*precio_adquisicion)*-1) as total, id_producto FROM `GastoInsumo` WHERE `fecha`>='".$_GET['f1']."' AND fecha<='".$_GET['f2']."' AND `tipo`='faltante' AND `gasto`='no' AND id_producto=".$pp['id_producto']);	
									$tPro=0;
									while($t=mysql_fetch_array($in))
									{																							
										$tsub+=($t['total']);
									}	               														
				               	}

						echo " <li style='margin: 5px 0px'>
						              <span><i class='glyphicon glyphicon-folder-open'></i></span>
						               <a href='#'' data-status='0' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
						                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
						                ".utf8_decode($casu['nombreCategoria']).": <font color='red'><b > $ ".number_format($tsub,3)."</b></font>
						               </a>   
						               <ul>";
						              // echo "<br>SQL001<pre>SELECT id_producto,nombreProducto FROM Categorias_Subcategorias WHERE id_categoria=".$casu['id_categoria'];
						               	$prcat=mysql_query("SELECT id_producto,nombreProducto FROM Categorias_Subcategorias WHERE id_categoria=".$casu['id_categoria']);
						               $rrt=0;
						               	while($pp=mysql_fetch_array($prcat))
						               	{

						               		//echo "SELECT  SUM((cantidad*precio_adquisicion)*-1) AS TT FROM `GastoInsumo` WHERE `fecha` >= '".$_GET['f1']."' AND fecha <= '".$_GET['f2']."' AND `tipo`='faltante' AND `gasto`='no' AND id_producto =".$pp['id_producto'];
											$in=mysql_fetch_array(mysql_query("SELECT  SUM((cantidad*precio_adquisicion)*-1) AS TT FROM `GastoInsumo` WHERE `fecha` >= '".$_GET['f1']."' AND fecha <= '".$_GET['f2']."' AND `tipo`='faltante' AND `gasto`='no' AND id_producto =".$pp['id_producto']));	             
											if($in['TT']>0)
											{
												echo " <li style='margin: 5px 0px'>
											              <span><i class='glyphicon glyphicon-folder-open'></i></span>
											               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
											                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
											                ".utf8_decode($pp['nombreProducto']).": <font color='red'><b >".number_format($in['TT'],3)."</b></font>
											               </a>          
													 </li>";			
												$rrt+=$in['TT'];													 
											}																
						               	}
						               	$tt+=$rrt;
						          echo "</ul>       
							   </li>";			
					}
					$sqll= "SELECT SUM((cantidad*precio_adquisicion)*-1) AS TotalInumos FROM `GastoInsumo` WHERE `fecha` >= '".$_GET['f1']."' AND fecha <= '".$_GET['f2']."' AND `tipo`='faltante' AND `gasto`='no' AND id_producto IN (SELECT id_producto FROM Categorias_Subcategorias WHERE id_categoria in (18,5,2,8,6,4,7) );";
					$resInsumo= mysql_fetch_array( mysql_query($sqll));
					echo "</ul>";		
					echo "TOTAL GASTO INSUMO: $ ".number_format($resInsumo['TotalInumos']);		
				}				
				function tieneMovimientoCompra($tabla,$cat,$tipo)
				{
					$t=0;
					//echo "Tabla: ".$tabla." - ".$cat;
					//echo "<br> SELECT (cantidad * precio_adquisicion) AS T FROM ".$tabla." WHERE fecha >= '".$_GET['f1']."' AND fecha <= '".$_GET['f2']."' AND tipo='".$tipo."' AND nombreCategoria!='VINOS' AND tipoCategoria='ACTIVO' AND id_categoria = ".$cat;
					$m = mysql_query("SELECT (cantidad * precio_adquisicion) AS T FROM ".$tabla." WHERE fecha >= '".$_GET['f1']."' AND fecha <= '".$_GET['f2']."' AND tipo='".$tipo."' AND nombreCategoria!='VINOS' AND tipoCategoria='ACTIVO' AND id_categoria = ".$cat);
					 while($mv = mysql_fetch_array($m))
					 {					 	
					 	$t+=$mv['T'];
					 }
					 //echo "Total funcion = ".$t;
					return $t;
				}
				function compras() // FACTURADAS
				{
					echo "<div class='col-md-6' style='display:inline-block; align-vertical:block;'><h5><b>A</b></h5><ul>";

					$cat = mysql_query("SELECT nombreCategoria,id_categoria FROM Compras_Facturadas WHERE tipo='comprafac' AND nombreCategoria!='VINOS' AND tipoCategoria='ACTIVO' GROUP BY nombreCategoria");
					while ($nc = mysql_fetch_array($cat)) 
					{
						$tcat=0;
						$tcat = tieneMovimientoCompra("Compras_Facturadas",$nc['id_categoria'],"comprafac");
						if($tcat > 0)
						{					
							echo " <li style='margin: 5px 0px'>
						              <span><i class='glyphicon glyphicon-folder-open'></i></span>
						               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
						                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
						                ".utf8_decode($nc['nombreCategoria']).": <font color='red'><b >".number_format($tcat,3)."</b></font>
						               </a>          
								 <ul>";	

														
									$com=mysql_query("SELECT (cantidad * precio_adquisicion) AS T,id_producto,id FROM Compras_Facturadas WHERE fecha >= '".$_GET['f1']."' AND fecha <= '".$_GET['f2']."' AND tipo='comprafac' AND nombreCategoria!='VINOS' AND tipoCategoria='ACTIVO' AND id_categoria=".$nc['id_categoria']);
									while($comp=mysql_fetch_array($com))
									{
										if($comp['T']>0)
										{
											$t+=$comp['T'];					
											$p=mysql_fetch_array(mysql_query("SELECT nombre FROM producto WHERE id_producto=".$comp['id_producto']));
											echo " <li style='margin: 5px 0px'>
									              <span><i class='glyphicon glyphicon-folder-open'></i></span>
									               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
									                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
									                ".utf8_decode($p['nombre']).": <font color='red'><b >".number_format(($comp['T']),3)."</b></font>
									               </a>          
											 </li>";						
										}
										
									}								
							echo "</ul></li>";
						}

					}
					

					echo "</ul>
					COMPRAS 'A' : $ ".number_format($t,3)."
						</div>";
					compras2($t);			

				}
				function compras2($r) // NO FACTURADAS
				{
					echo "<div class='col-md-6' style='display:inline-block; align-vertical:block;'><h5><b>B</b></h5><ul>";		
					$cat2 = mysql_query("SELECT nombreCategoria,id_categoria FROM Compras WHERE tipo='compra' AND nombreCategoria!='VINOS' AND tipoCategoria='ACTIVO' GROUP BY nombreCategoria");				
					$t=0;	
					$ttt=0;	
					while ($ca=mysql_fetch_array($cat2)) 
					{
						$tcat=0;
						$tcat = tieneMovimientoCompra("Compras",$ca['id_categoria'],"compra");					
						if($tcat > 0)
						{	
							echo " <li style='margin: 5px 0px'>
						              <span><i class='glyphicon glyphicon-folder-open'></i></span>
						               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
						                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
						                ".utf8_decode($ca['nombreCategoria']).": <font color='red'><b >".number_format($tcat,3)."</b></font>
						               </a>          
								 <ul>";		


							$com=mysql_query("SELECT (cantidad * precio_adquisicion) AS T,id_producto FROM Compras WHERE fecha >='".$_GET['f1']."' AND fecha <= '".$_GET['f2']."' AND tipo='compra' AND nombreCategoria!='VINOS' AND tipoCategoria='ACTIVO' AND id_categoria=".$ca['id_categoria']);
							while($comp=mysql_fetch_array($com))
							{$t =0;
								if($comp['T']>0)
								{
									$t+=$comp['T'];					
									$ttt += $t;
									$p=mysql_fetch_array(mysql_query("SELECT nombre FROM producto WHERE id_producto=".$comp['id_producto']));
									echo " <li style='margin: 5px 0px'>
							              <span><i class='glyphicon glyphicon-folder-open'></i></span>
							               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
							                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
							                ".utf8_decode($p['nombre']).": <font color='red'><b >".number_format($t,3)."</b></font>
							               </a>          
									 </li>";						
								}							
							}
						}
						echo "</ul></li>";
					}
					echo "</ul>
					COMPRAS 'B': $ ".number_format($ttt,3)."
					</div>
					<div class='col-md-12' aling='center'>
					<div class='col-md-4' style='height:20px'></div>
						<h5><b>Total Gasto Activo: $ ".money_format("%i", ($r+$ttt))."</b></h5></div>
					";

				}
				function gastoOO($tabla,$ids,$tipo)
				{
					$t = 0;
					$pr = mysql_query("SELECT * FROM Categorias_Subcategorias WHERE id_subcategoria=".$ids);
					while($p = mysql_fetch_array($pr))
					{	
						//echo "SELECT * FROM Compras_Facturadas WHERE tipo='comprafac' AND `tipoCategoria` =  'OPERATIVO' AND fecha >= '".$_GET['f1']."' AND fecha <= '".$_GET['f2']."' id_producto =".$p['id_producto'];
						$comp = mysql_query("SELECT * FROM ".$tabla." WHERE tipo='".$tipo."' AND `tipoCategoria` =  'OPERATIVO' AND fecha >= '".$_GET['f1']."' AND fecha <= '".$_GET['f2']."' AND id_producto =".$p['id_producto']);
						while ($c = mysql_fetch_array($comp)) 
						{
							$t+= ($c['cantidad']*$c['precio_adquisicion']);
//								echo "<br>Subcategoria: ".$p['nombreSubcategoria']."  esto es T ".$t;
						}
					}
					return $t;					
				}
				function gastoOperativo()				
				{
					$tt=0;
					echo "<div class='col-md-6' style='display:inline-block; align-vertical:block;'><h5><b>A</b></h5><ul>";
					$cas=mysql_query("SELECT * FROM  `Compras_Facturadas` WHERE tipoCategoria='OPERATIVO' GROUP BY  `nombreCategoria` ORDER BY  `nombreCategoria` ");
					while ($ca = mysql_fetch_array($cas)) 
					{				
						echo "  <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                ".utf8_decode($ca['nombreCategoria']).": <font color='red'><b ></b></font>
					               </a>          
							 	<ul>";								 
							 	$cate = mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='OPERATIVO' AND id_categoria =".$ca['id_categoria']." GROUP BY nombreSubcategoria ");
							 	while($cat = mysql_fetch_array($cate))
							 	{
							 		$tc = gastoOO("Compras_Facturadas",$cat['id_subcategoria'],"comprafac");
							 		if($tc>0)
							 		{
							 		echo "  <li style='margin: 5px 0px'>
							              <span><i class='glyphicon glyphicon-folder-open'></i></span>
							               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
							                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
							                ".utf8_decode($cat['nombreSubcategoria']).": <font color='red'><b >".number_format($tc,3)."</b></font>
							               </a>          
							 			<ul>";
							 			$tt+=$tc;
							 			//echo "SELECT * FROM Categorias_Subcategorias WHERE id_subcategoria=".$cat['id_subcategoria'];
											$pr = mysql_query("SELECT * FROM Categorias_Subcategorias WHERE id_subcategoria=".$cat['id_subcategoria']);
											while($p = mysql_fetch_array($pr))
											{	
												//echo "SELECT * FROM Compras_Facturadas WHERE tipo='comprafac' AND `tipoCategoria` =  'OPERATIVO' AND fecha >= '".$_GET['f1']."' AND fecha <= '".$_GET['f2']."' AND id_producto =".$p['id_producto'];
												$comp = mysql_query("SELECT  SUM( cantidad * precio_adquisicion ) AS T FROM Compras_Facturadas WHERE tipo='comprafac' AND `tipoCategoria` =  'OPERATIVO' AND fecha >= '".$_GET['f1']."' AND fecha <= '".$_GET['f2']."' AND id_producto =".$p['id_producto']);
												while ($c = mysql_fetch_array($comp)) 
												{
													$t=0;
													$t+= ($c['T']);
														if($t>0)
														{
																	echo "  <li style='margin: 5px 0px'>
												              <span><i class='glyphicon glyphicon-folder-open'></i></span>
												               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
												                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
												                ".utf8_decode($p['nombreProducto']).": <font color='red'><b >".number_format($t,3)."</b></font>
												               </a>          
												 			<li>";
														}
												
												}
											}
							 		echo "</ul></li>";	
							 		}
							 		
							 	}
						  echo "</ul></li>";

					}				
					echo "</ul>TOTAL A: $ ".money_format("%i",$tt)."</div>";

				gastoOpeFac($tt);
				}
				function gastoOpeFac($ttt)
				{
					$tt=0;
					echo "<div class='col-md-6' style='display:inline-block; align-vertical:block;'><h5><b>B</b></h5><ul>";
					$cas=mysql_query("SELECT * FROM  `Compras` WHERE tipoCategoria='OPERATIVO' GROUP BY  `nombreCategoria` ORDER BY  `nombreCategoria` ");
					while ($ca = mysql_fetch_array($cas)) 
					{				
						echo "  <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                ".utf8_decode($ca['nombreCategoria']).": <font color='red'><b ></b></font>
					               </a>          
							 	<ul>";								 
							 	$cate = mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='OPERATIVO' AND id_categoria =".$ca['id_categoria']." GROUP BY nombreSubcategoria ");
							 	while($cat = mysql_fetch_array($cate))
							 	{
							 		$tc = gastoOO("Compras",$cat['id_subcategoria'],"compra");
							 		if($tc>0)
							 		{
							 		echo "  <li style='margin: 5px 0px'>
							              <span><i class='glyphicon glyphicon-folder-open'></i></span>
							               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
							                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
							                ".utf8_decode($cat['nombreSubcategoria']).": <font color='red'><b >".number_format($tc,3)."</b></font>
							               </a>          
							 			<ul>";
							 			$tt+=$tc;
							 			//echo "SELECT * FROM Categorias_Subcategorias WHERE id_subcategoria=".$cat['id_subcategoria'];
											$pr = mysql_query("SELECT * FROM Categorias_Subcategorias WHERE id_subcategoria=".$cat['id_subcategoria']);
											while($p = mysql_fetch_array($pr))
											{	
												//echo "SELECT * FROM Compras_Facturadas WHERE tipo='comprafac' AND `tipoCategoria` =  'OPERATIVO' AND fecha >= '".$_GET['f1']."' AND fecha <= '".$_GET['f2']."' AND id_producto =".$p['id_producto'];
												$comp = mysql_query("SELECT  SUM( cantidad * precio_adquisicion ) AS T FROM Compras WHERE tipo='compra' AND `tipoCategoria` =  'OPERATIVO' AND fecha >= '".$_GET['f1']."' AND fecha <= '".$_GET['f2']."' AND id_producto =".$p['id_producto']);
												while ($c = mysql_fetch_array($comp)) 
												{
													$t=0;
													$t+= ($c['T']);
														if($t>0)
														{
																	echo "  <li style='margin: 5px 0px'>
												              <span><i class='glyphicon glyphicon-folder-open'></i></span>
												               <a href='#'' data-status='hijos' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
												                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
												                ".utf8_decode($p['nombreProducto']).": <font color='red'><b >".number_format($t,3)."</b></font>
												               </a>          
												 			<li>";
														}
												
												}
											}
							 		echo "</ul></li>";	
							 		}
							 		
							 	}
						  echo "</ul></li>";

					}				
					$to=$ttt+$tt;
					echo "</ul>TOTAL B: $ ".money_format("%i",$tt)."</div>
					<div class='col-md-12'>
						<div class='col-md-4'></div>
						<b>TOTAL GASTO OPERATIVO = $ ".number_format($to,3)."</b>

					</div>";
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
				function totalGastos($pro,$idss)
				{
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
				function nomina()
				{
					/*
				SEPARAMOS EL REGISTRO DE MESEROS 
				RECORDANDO QUE: 
				LA POSICION 0 ES EL ID DEL MESERO
				LA POSICION 1 ES EL ID DE LA CATEGORIA
				LA POSISION 2 ES EL PAGO POR EVENTO
				Y LA POSICION 3 SON LOS PUNTOS
				*/
					echo "<div class='col-md-3' ><h5><b>Meseros</b></h5><ul>";
					$t=0;
						$cm=mysql_query("SELECT * FROM Meseros GROUP BY tipo ORDER BY tipo");
						while( $ca=mysql_fetch_array($cm))
						{
							$c=0;
							$mc=mysql_query("SELECT * FROM MeserosContrato WHERE Fecha>='".$_GET['f1']."' AND Fecha<='".$_GET['f2']."' ");
							while($mco=mysql_fetch_array($mc))
							{
								
								$m=explode(",", $mco['meseros']);
								for ($i=1; $i <count($m) ; $i++) 
								{ 
									$me=explode("-", $m[$i]);
									$mm=mysql_fetch_array(mysql_query("SELECT tipo FROM Meseros WHERE id=".$me[0]));
									if($mm['tipo']===$ca['tipo'])
									{
										$t+=$me[2];
										$c+=$me[2];
									}

								}
							}
							$ma=mysql_query("SELECT * FROM MeserosAdicionales WHERE Fecha>='".$_GET['f1']."' AND Fecha<='".$_GET['f2']."' ");
							while($mad=mysql_fetch_array($ma))
							{
								$m=explode(",", $mad['meseros']);
								for ($i=1; $i <count($m) ; $i++) 
								{ 
									$me=explode("-", $m[$i]);
									$mm=mysql_fetch_array(mysql_query("SELECT tipo FROM Meseros WHERE id=".$me[0]));
									if($mm['tipo']===$ca['tipo'])
									{
										$t+=$me[2];
										$c+=$me[2];
									}

								}	
							}
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                ".utf8_decode($ca['tipo']).": <font color='red'><b> $ ".number_format($c,3)."</b></font>
					               </a>          
						 		</li>";	
						}
					echo "</ul>
					Total Meseros: ".money_format("%i",$t)."
					</div>
					<div class='col-md-3' style='display:inline-block; vertical-align:top;' align='center'><h5><b>Empleados</b></h5>";
				////////////////////////////////////////////// NOMINA CONSTRUCCION 	///////////////////////////////////////////////					
					/*	$nc=mysql_query("SELECT Total_nomina, fecha FROM Confirmacion_Nomina_Construccion WHERE fecha>='".$_GET['f1']."' AND fecha<='".$_GET['f2']."' AND confirmado='si' ");
						$tt=0;
						$tEm=0;
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['Total_nomina']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					               ".utf8_decode("Nomina Construcción").": <font color='red'><b> $ ".number_format($tt,3)."</b></font>
					               </a>          
						 		</li>";	

						 */
				//////////////////////////////////////////////		TERMINA NOMINA CONSTRUCCION 	///////////////////////////////////////////////
						$nc=mysql_query("SELECT totales, fecha FROM Confirmacion_Nomina_Eventos WHERE fecha>='".$_GET['f1']."' AND fecha<='".$_GET['f2']."' AND confirmado='si' ");
						$tt=0;						
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['totales']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                Nomina Eventos: <font color='red'><b> $ ".number_format($tt,3)."</b></font>
					               </a>          
						 		</li>";	
						 $nc=mysql_query("SELECT totales, fecha FROM Confirmacion_Nomina_Extras WHERE fecha>='".$_GET['f1']."' AND fecha<='".$_GET['f2']."' AND confirmado='si' ");
						$tt=0;						
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['totales']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                Nomina Extras: <font color='red'><b> $ ".number_format($tt,3)."</b></font>
					               </a>          
						 		</li>";	
						  $nc=mysql_query("SELECT Total_nomina, fecha FROM Confirmacion_Nomina_Planta WHERE fecha>='".$_GET['f1']."' AND fecha<='".$_GET['f2']."' AND confirmado='si' ");
						$tt=0;						
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['Total_nomina']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                Nomina Planta: <font color='red'><b> $ ".number_format($tt,3)."</b></font>
					               </a>          
						 		</li>";	
						  $nc=mysql_query("SELECT neto, fecha FROM Cornfirmacion_Nomina_Comision WHERE fecha>='".$_GET['f1']."' AND fecha<='".$_GET['f2']."' AND confirmado='si' ");
						$tt=0;						
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['neto']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                ".utf8_decode("Nomina Comisión").": <font color='red'><b> $ ".number_format($tt,3)."</b></font>
					               </a>          
						 		</li>";	

					echo "</ul>
					TOTAL EMPLEADOS: $ ".$tEm."
					</div>
					";

				}
				function premioLealtad()
				{
								/*
				SEPARAMOS EL REGISTRO DE MESEROS 
				RECORDANDO QUE: 
				LA POSICION 0 ES EL ID DEL MESERO
				LA POSICION 1 ES EL ID DE LA CATEGORIA
				LA POSISION 2 ES EL PAGO POR EVENTO
				Y LA POSICION 3 SON LOS PUNTOS
				*/
					echo "<div class='col-md-3' ><h5><b>Meseros</b></h5><ul>";
					$t=0;
						$cm=mysql_query("SELECT * FROM Meseros GROUP BY tipo ORDER BY tipo");
						while( $ca=mysql_fetch_array($cm))
						{
							$c=0;
							$mc=mysql_query("SELECT * FROM MeserosContrato WHERE Fecha>='".$_GET['f1']."' AND Fecha<='".$_GET['f2']."' ");
							while($mco=mysql_fetch_array($mc))
							{
								
								$m=explode(",", $mco['meseros']);
								for ($i=1; $i <count($m) ; $i++) 
								{ 
									$me=explode("-", $m[$i]);
									$mm=mysql_fetch_array(mysql_query("SELECT tipo FROM Meseros WHERE id=".$me[0]));
									if($mm['tipo']===$ca['tipo'])
									{
										$t+=$me[3];
										$c+=$me[3];
									}

								}
							}
							$ma=mysql_query("SELECT * FROM MeserosAdicionales WHERE Fecha>='".$_GET['f1']."' AND Fecha<='".$_GET['f3']."' ");
							while($mad=mysql_fetch_array($ma))
							{
								$m=explode(",", $mad['meseros']);
								for ($i=1; $i <count($m) ; $i++) 
								{ 
									$me=explode("-", $m[$i]);
									$mm=mysql_fetch_array(mysql_query("SELECT tipo FROM Meseros WHERE id=".$me[0]));
									if($mm['tipo']===$ca['tipo'])
									{
										$t+=$me[3];
										$c+=$me[3];
									}

								}	
							}
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                ".utf8_decode($ca['tipo']).": <font color='red'><b> $ ".number_format($c,3)."</b></font>
					               </a>          
						 		</li>";	
						}
					echo "</ul>
					Total Contrato: ".money_format("%i",$t)."
					</div>
					<div class='col-md-3' style='display:inline-block; vertical-align:top;' align='center'><h5><b>Empleados</b></h5>";
		///////////////////////////////////////////  NOMINA CONSTRUCCION 	/////////////////////////////////////////////////////////////7				
						/*
						$nc=mysql_query("SELECT puntos, fecha FROM Confirmacion_Nomina_Construccion WHERE fecha>='".$_GET['f1']."' AND fecha<='".$_GET['f2']."' AND confirmado='si' ");
						$tt=0;
						$tEm=0;
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['puntos']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                ".utf8_decode("Nomina Construcción").": <font color='red'><b> $ ".number_format($tt,3)."</b></font>
					               </a>          
						 		</li>";	
						 */
		///////////////////////////////////////////  TERMINA NOMINA CONSTRUCCION 	/////////////////////////////////////////////////////////////7				

						$nc=mysql_query("SELECT puntos, fecha FROM Confirmacion_Nomina_Eventos WHERE fecha>='".$_GET['f1']."' AND fecha<='".$_GET['f2']."' AND confirmado='si' ");
						$tt=0;						
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['puntos']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                Nomina Eventos: <font color='red'><b> $ ".number_format($tt,3)."</b></font>
					               </a>          
						 		</li>";	
						 $nc=mysql_query("SELECT puntos, fecha FROM Confirmacion_Nomina_Extras WHERE fecha>='".$_GET['f1']."' AND fecha<='".$_GET['f2']."' AND confirmado='si' ");
						$tt=0;						
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['puntos']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                Nomina Extras: <font color='red'><b> $ ".number_format($tt,3)."</b></font>
					               </a>          
						 		</li>";	
						  $nc=mysql_query("SELECT puntos, fecha FROM Confirmacion_Nomina_Planta WHERE fecha>='".$_GET['f1']."' AND fecha<='".$_GET['f2']."' AND confirmado='si' ");
						$tt=0;						
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['puntos']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                Nomina Planta: <font color='red'><b> $ ".number_format($tt,3)."</b></font>
					               </a>          
						 		</li>";	
						  $nc=mysql_query("SELECT puntos, fecha FROM Cornfirmacion_Nomina_Comision WHERE fecha>='".$_GET['f1']."' AND fecha<='".$_GET['f2']."' AND confirmado='si' ");
						$tt=0;						
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['puntos']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                ".utf8_decode("Nomina Comisión").": <font color='red'><b> $ ".number_format($tt,3)."</b></font>
					               </a>          
						 		</li>";	

					echo "</ul>
					TOTAL EMPLEADOS: $ ".$tEm."
					</div>
					";			
				}
				function gastoPersonal()
				{
					echo "<div class='col-md-6' style='display:inline-block; align-vertical:block;'><h5>Gastos B</h5><ul>";
					$gp=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='PERSONAL' GROUP by  nombreSubcategoria");
					$tt=0;
					while($ga=mysql_fetch_array($gp))
					{
						$totalSubCategoria=0;
						$gpp=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE nombreSubcategoria='".$ga['nombreSubcategoria']."' ");						
						while($gaa=mysql_fetch_array($gpp))
						{
							$totalSubCategoria+=gasto_personal($gaa['id_producto']);										
						}
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                ".utf8_decode($ga['nombreSubcategoria']).": <font color='red'><b> $ ".number_format($totalSubCategoria,3)."</b></font>
					               </a> 
					               <ul>";
					               	$gpp=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE nombreSubcategoria='".$ga['nombreSubcategoria']."' ");						
									while($gaa=mysql_fetch_array($gpp))
									{
										$totalSubCategoria2=gasto_personal($gaa['id_producto']);										
										echo " <li style='margin: 5px 0px'>
									              <span><i class='glyphicon glyphicon-folder-open'></i></span>
									               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
									                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
									                ".utf8_decode($gaa['nombreProducto']).": <font color='red'><b> $ ".number_format($totalSubCategoria2,3)."</b></font>
									               </a> 
									            <li>";
									}
					         echo "</ul>         
						 		</li>";	
						 	$tt+=$totalSubCategoria;
					}

					echo "GASTOS PERSONALES : ".number_format($tt,3)."</ul></div>";				
					gastoPersonal2();
				}
				function gastoPersonal2()
				{
					echo "<div class='col-md-6' style='display:inline-block; align-vertical:block;'><h5>Gastos A</h5><ul>";
					$gp=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='PERSONAL' GROUP by  nombreSubcategoria");
					$tt=0;
					while($ga=mysql_fetch_array($gp))
					{
						$totalSubCategoria=0;
						$gpp=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE nombreSubcategoria='".$ga['nombreSubcategoria']."' ");						
						while($gaa=mysql_fetch_array($gpp))
						{
							$totalSubCategoria+=gasto_personal2($gaa['id_producto']);										
						}
						if($totalSubCategoria > 0)
						{
								echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                ".utf8_decode($ga['nombreSubcategoria']).": <font color='red'><b> $ ".number_format($totalSubCategoria,3)."</b></font>
					               </a> 
					               <ul>";
					               	$gpp=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE nombreSubcategoria='".$ga['nombreSubcategoria']."' ");						
									while($gaa=mysql_fetch_array($gpp))
									{
										$totalSubCategoria2=gasto_personal2($gaa['id_producto']);										
										echo " <li style='margin: 5px 0px'>
									              <span><i class='glyphicon glyphicon-folder-open'></i></span>
									               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
									                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
									                ".utf8_decode($gaa['nombreProducto']).": <font color='red'><b> $ ".number_format($totalSubCategoria2,3)."</b></font>
									               </a> 
									            <li>";
									}
					         echo "</ul>         
						 		</li>";	
						 	$tt+=$totalSubCategoria;		
						}
					
					}

					echo " Gastos Personales Facturados: ".number_format($tt,3)."</ul></div>";				
				}
				function gasto_personal($id)
				{
					$total=0;
					$g=mysql_fetch_array(mysql_query("SELECT SUM( importe ) AS total FROM  `vista_gasto_personal` WHERE fecha>='".$_GET['f1']."'  AND fecha <='".$_GET['f2']."' AND `id_producto`=".$id));		
					if($g['total']!='NULL'||$g['total']!='')
						$total+=$g['total'];								
					
					return $total;
				}
				function gasto_personal2($id)
				{
					$total=0;							
					$gf=mysql_fetch_array(mysql_query("SELECT SUM( importe ) AS total FROM vista_gasto_personal_facturado WHERE fecha>='".$_GET['f1']."'  AND fecha <='".$_GET['f2']."' AND id_producto=".$id));		
					if($gf['total']!='NULL'||$gf['total']!='')	
						$total+=$gf['total'];
					
					return $total;
				}
				function gastoInversion()
				{
					$tgp=0;
					$ttp2=0;
					echo "<div class='col-md-6'  style='display:inline-block; align-vertical:block;'><h5>Inversion B</h5><ul>";
					$catt=mysql_query("SELECT nombreSubcategoria,id_subcategoria FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' GROUP BY nombreSubcategoria");
					while($ct=mysql_fetch_array($catt))
					{
						$tsub=0;
						$cf=mysql_query("SELECT * FROM Compras WHERE tipo='compra' AND fecha BETWEEN '".$_GET['f1']."' AND '".$_GET['f2']."' ");
						while ($cfa=mysql_fetch_array($cf) )
						{
							$p=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND  id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
							while ($pr=mysql_fetch_array($p) )
							{								
									$tsub+=($cfa['cantidad']*$cfa['precio_adquisicion']);
								$tgp+=$tsub;
							}
						}
						$ttp2 +=$tsub;
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                ".utf8_decode($ct['nombreSubcategoria']).": <font color='red'><b> $ ".number_format($tsub,3)." </b></font>
					               </a> 
					               <ul>";

					               	$t=0;  // COMPRAS 
									$cf=mysql_query("SELECT * FROM Compras WHERE tipo='compra' AND fecha BETWEEN '".$_GET['f1']."' AND '".$_GET['f2']."' ");
									while ($cfa=mysql_fetch_array($cf) )
									{
										$p=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
										while ($pr=mysql_fetch_array($p) )
										{
											
												$t+=($cfa['cantidad']*$cfa['precio_adquisicion']);
												echo " <li style='margin: 5px 0px'>
											              <span><i class='glyphicon glyphicon-folder-open'></i></span>
											               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
											                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
											                ".utf8_decode($pr['nombreProducto']).": <font color='red'><b> $ ".number_format(($cfa['cantidad']*$cfa['precio_adquisicion']),3)."</b></font>
											               </a> 
											            <li>";
											
										}
									}

					        
					 		echo "</ul>
					           </li>";

					}
					$nc=mysql_query("SELECT Total_nomina, fecha FROM Confirmacion_Nomina_Construccion WHERE fecha>='".$_GET['f1']."' AND fecha<='".$_GET['f2']."' AND confirmado='si' ");
						$tt=0;
						$tEm=0;
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['Total_nomina']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					               ".utf8_decode("Nomina Construcción").": <font color='red'><b> $ ".number_format($tt,3)."</b></font>
					               </a>          
						 		</li>";	
					      

					 $nc=mysql_query("SELECT puntos, fecha FROM Confirmacion_Nomina_Construccion WHERE fecha>='".$_GET['f1']."' AND fecha<='".$_GET['f2']."' AND confirmado='si' ");
						$ttp=0;						
						$ttpp=0;
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['puntos']);
							for ($i=1; $i <count($t); $i++) { 
								$ttp+=$t[$i];
							}
						}
						$ttpp+=$ttp;
						$tEmp+=$ttp;
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                ".utf8_decode("Premio Lealtad Nomina Construcción").": <font color='red'><b> $ ".number_format($ttp,3)."</b></font>
					               </a>          
						 		</li>";	 
						 		$tttggi = $ttp2+$ttpp+$tEm;
					       echo "</ul>TOTAL GASTOS INVERSION : ".$tttggi."</div>";
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////77
					       $tgif=0;
					       echo "<div class='col-md-6'  style='display:inline-block; align-vertical:block;'><h5>Inversion A</h5><ul>";
					$catt=mysql_query("SELECT nombreSubcategoria,id_subcategoria FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' GROUP BY nombreSubcategoria");
					while($ct=mysql_fetch_array($catt))
					{
						$tsub=0;
						$cf=mysql_query("SELECT * FROM Compras_Facturadas WHERE tipo='comprafac' AND fecha BETWEEN '".$_GET['f1']."' AND '".$_GET['f2']."' ");
						while ($cfa=mysql_fetch_array($cf) )
						{
							$p=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND  id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
							while ($pr=mysql_fetch_array($p) )
							{								
									$tsub+=($cfa['cantidad']*$cfa['precio_adquisicion']);								
							}
						}
						echo " <li style='margin: 5px 0px'>
					              <span><i class='glyphicon glyphicon-folder-open'></i></span>
					               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
					                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
					                ".utf8_decode($ct['nombreSubcategoria']).": <font color='red'><b> $ ".number_format($tsub,3)." </b></font>
					               </a> 
					               <ul>";

					               	$t=0;  // COMPRAS 
									$cf=mysql_query("SELECT * FROM Compras_Facturadas WHERE tipo='comprafac' AND fecha BETWEEN '".$_GET['f1']."' AND '".$_GET['f2']."' ");
									while ($cfa=mysql_fetch_array($cf) )
									{
										$p=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
										while ($pr=mysql_fetch_array($p) )
										{
											
												$t+=($cfa['cantidad']*$cfa['precio_adquisicion']);

												echo " <li style='margin: 5px 0px'>
											              <span><i class='glyphicon glyphicon-folder-open'></i></span>
											               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
											                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
											                ".utf8_decode($pr['nombreProducto']).": <font color='red'><b> $ ".number_format(($cfa['cantidad']*$cfa['precio_adquisicion']),3)."</b></font>
											               </a> 
											            <li>";										
										}
									}

					        $tgif+=$t;
					 		echo "</ul>
					           </li>";
					}
					       echo "</ul></div>TOTAL GASTOS INVERSION B : ".$tgif."";
					echo "<div class='col-lg-12' align='center'><b>Total Inversion: ".( $tttggi + $tgif )."</b></div>";
				}	
				function vinos()
				{
				// 	echo "<div class='col-md-12'><ul>";
					
				// 	$totalVinos=0;
				// 	$su=mysql_query("SELECT * FROM subcategoria WHERE id_categoria=1 ORDER BY nombre");		
				// 		while($s=mysql_fetch_array($su))
				// 		{
				// 			$tsub=0;
				// 			$pr=mysql_query("SELECT * FROM producto where id_subcategoria=".$s['id_subcategoria']." ORDER BY nombre ");
				// 				   		while($p=mysql_fetch_array($pr))
				// 				   		{
				// 				   			$tsub+=buscaVinos($p['id_producto']);									   				  										   	
				// 				   		}
				// 			echo " <li style='margin: 5px 0px'>
				// 		              <span><i class='glyphicon glyphicon-folder-open'></i></span>
				// 		               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
				// 		                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
				// 		                ".utf8_decode($s['nombre']).": <font color='red'><b> $ ".number_format($tsub,3)."</b></font>
				// 		               </a> 
				// 		            <ul>";
							
				// 				$totalCategoria=0;
				// 				   		$pr=mysql_query("SELECT * FROM producto where id_subcategoria=".$s['id_subcategoria']." ORDER BY nombre ");
				// 				   		while($p=mysql_fetch_array($pr))
				// 				   		{
				// 				   			$t=buscaVinos($p['id_producto']);	

				// 				   			$totalCategoria+=$t;				   		
				// 				   			echo " <li style='margin: 5px 0px'>
				// 				              <span><i class='glyphicon glyphicon-folder-open'></i></span>
				// 				               <a href='#'' data-status='padre' name='eventos' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>
				// 				                <span class='glyphicon glyphicon-plus-sign' :' glyphicon glyphicon-minus-sign'></span> 
				// 				                ".utf8_decode($p['nombre']).": <font color='red'><b> $ ".number_format($t,3)."</b></font>
				// 				               </a> 
				// 				            <li>";
				// 				   		}
				// 				$totalVinos+=$totalCategoria;
				// 			echo "</ul></li>";
				// 		}
				// echo "TOTAL VINOS: $ ".money_format("%i",$totalVinos);
				// 	echo "</ul></div>";


						/////////////////////////////////////////////////////////////////////////////////////////

					global $fechamax,$horamax,$show_all_can,$show_all_din;
					//print_r($_POST);
					$resultado=mysql_query("SELECT * FROM categoria WHERE nombre ='VINOS' ");
					$número_filas = mysql_num_rows($resultado);///////////////////obtenemos el id de la categoria

					if($número_filas>0){////////////////////si existe la categoria obtenemos sus subcategoria
						while($categoria=mysql_fetch_array($resultado)){
						$subresultado=mysql_query("select * from subcategoria where id_categoria=".$categoria['id_categoria']." order by nombre");
						$num_fil=mysql_num_rows($subresultado);
						if($num_fil>0){
								ultima_modificacion($categoria['id_categoria']);
								echo "<font color=''><h1>".$_POST['categoria']."</h1></font>";
								while($subcategoria=mysql_fetch_array($subresultado)){
									echo "<font color=''><h2>".$subcategoria['nombre']."</h2></font>";
									tabla($categoria['id_categoria'],$subcategoria['id_subcategoria']);
								}
						}else{//////////no existen subcategorias
							echo "No existen subcategorias para la categoria ".strtoupper($_POST['categoria']);
						}
					  }
					}else{////////////mensaje de no existencia de categoria
						echo "seleccione una opcion correcta la categoria '".strtoupper($_POST['categoria'])."' no existe";
					}
							echo "<div id='fecha' style='position:absolute;top:120px;right:130px;'>";
							echo "Total en piezas:".$show_all_can."<br>";
							echo "Total en dinero: $ ".$show_all_din;
							echo "</div> <br><br/>";
					////////////////////////////////////////////////////////////////////////////////////

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
					$total=$total*$ucosto["precio"];
					
					return $total;
					
				}


				function tabla($cat,$sub){
					global $horamax,$fechamax,$show_all_can,$show_all_din;
					$r=mysql_query('select * from producto where id_categoria='.$cat.' and id_subcategoria='.$sub." order by nombre");
					$nr=mysql_num_rows($r);
					if($nr>0){		

						echo "<br><br><table class='style1' border= '1'>";
						echo "<tr aling='center'>
								<th>ID</th>
								<th>NOMBRE</th>
								<th>DESCRIPCION</th>
								<th>UNIDAD</th>
								<th>INVENTARIO<BR>INICIAL</th>
								<th>ULTIMO<br>COSTO</th>
								<th>PRECIO DE <br>VENTA</th>
								<th colspan='2' align='center'>COMPRAS</th>
								<th colspan='2' align='center'>ENTRADAS</th>
								<th colspan='2' align='center'>SALIDAS</th>
								<th colspan='2' align='center'>VENTAS</th>
								<th colspan='2' align='center'>INVENTARIO ACTUAL</th>
							</tr>";
						$acumulado_cantidad=0;
						$acumulado_dinero=0;
						while($item=mysql_fetch_array($r)){
							
							$inv=mysql_query("select * from inventario where id_producto=".$item['id_producto']);
							$inv2=mysql_fetch_array($inv);
							
							$unidad=mysql_fetch_array(mysql_query("select * from unidad where id_unidad=".$item["id_unidad"]));
							
							echo "<tr><td>".$item['id_producto']."</td><td>".$item['nombre']."</td><td>".$item['descripcion']."</td>"."<td>".$unidad["nombre"]."</td>"."<td align='center'>".$inv2['cantidad'];
							///////////id de compras hechas en el periodo
							$compras=mysql_query("select id_compra from compra where fecha>'".$fechamax."'");
							$comprasfac=mysql_query("select id_compra from comprafac where fecha>'".$fechamax."'");
							$cantidad_compra=0;
							$importe_compras=0;
							while($compras2=mysql_fetch_array($compras)){
								$c=mysql_query("select sum(cantidad)as t,sum(importe) as imp from detalle where id_producto=".$item['id_producto']." and tipo='compra' and id=".$compras2['id_compra'].' and gasto="no"');
								$cant=mysql_fetch_array($c);
								$cantidad_compra=$cantidad_compra+$cant['t'];
								$importe_compras=$importe_compras+$cant['imp'];
							}
							
							while($comprasfac2=mysql_fetch_array($comprasfac)){
								$c=mysql_query("select sum(cantidad)as t,sum(importe) as imp  from detalle where id_producto=".$item['id_producto']." and tipo='comprafac' and id=".$comprasfac2['id_compra'].' and gasto="no"');
								$cant=mysql_fetch_array($c);
								$cantidad_compra=$cantidad_compra+$cant['t'];
								$importe_compras=$importe_compras+$cant['imp'];
							}
							
							/////////entradas
							$entradas=mysql_query("select * from entrada where fecha>'".$fechamax."'");
							$cantidad_entrada=0;
							while($entradas2=mysql_fetch_array($entradas)){
								$ce=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$item['id_producto']." and tipo='entrada' and id=".$entradas2['id_entrada']);
								$cante=mysql_fetch_array($ce);
								$cantidad_entrada=$cantidad_entrada+$cante['t'];
							}
							
							/////////salidas
							$salidas=mysql_query("select * from salida where fecha>'".$fechamax."'");
							$cantidad_salida=0;
							while($salidas2=mysql_fetch_array($salidas)){
								$cs=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$item['id_producto']." and tipo='salida' and id=".$salidas2['id_salida']);
								$cants=mysql_fetch_array($cs);
								$cantidad_salida=$cantidad_salida+$cants['t'];
							}
							
							/////////ventas
							$ventas=mysql_query("select * from venta where fecha>'".$fechamax."'");
							$cantidad_venta=0;
							while($ventas2=mysql_fetch_array($ventas)){
								$cv=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$item['id_producto']." and tipo='venta' and id=".$ventas2['id_venta']);
								$cantv=mysql_fetch_array($cv);
								$cantidad_venta=$cantidad_venta+$cantv['t'];
							}
							
							//////////////inventario actual
							$inv_actual=$inv2['cantidad']+$cantidad_compra+$cantidad_entrada-$cantidad_salida-$cantidad_venta;
							$show_all_can=$show_all_can+$inv_actual;
							$show_all_din=$show_all_din+round(($inv_actual*$inv2['precio']),5);
							 
							///////////////impresion de las celdas
									/*//costo promedio
									if($inv_actual<=0){////validacion entre cero
										$cp=(round((($inv2['cantidad']*$inv2['precio'])+$importe_compras),5))/1;
									}else{
										$cp=(round((($inv2['cantidad']*$inv2['precio'])+$importe_compras),5))/$inv_actual;
									}*/
									$cp=$inv2['precio'];
									echo "</td><td align='center'>$".round($cp,5)."</td>
									<td align='center'>$ ".number_format($inv2['precio_venta'],3)."</td>";
									///COMPRAS
									echo "<td align='center'>".$cantidad_compra."</td><td align='right'>$".round(($cantidad_compra*$cp),5)."</td>";
									///entradas
									echo "<td align='center'>".$cantidad_entrada."</td><td align='right'>$".round(($cantidad_entrada*$cp),5)."</td>";
									///salidas
									echo "<td align='center'>".$cantidad_salida."</td><td align='right'>$".round(($cantidad_salida*$cp),5)."</td>";
									//ventas
									echo "<td align='center'>".$cantidad_venta."</td><td align='right'>$".round(($cantidad_venta*$cp),5)."</td>";
									////inventarios actual
									echo "<td align='center'>".$inv_actual."</td><td align='right'>$".round(($inv_actual*$inv2['precio']),5)."</td></tr>";
									$acumulado_cantidad=$acumulado_cantidad+$inv_actual; 
									$acumulado_dinero=$acumulado_dinero+round((($inv_actual*$inv2['precio'])),5); 
							  
						}  
						echo "<tr><td colspan='14' style='text-align: right;'>Total</td><td>".$acumulado_cantidad."</td><td>".$acumulado_dinero."</td></tr>";
						echo "</table><br><br><br><br>"; 
					}else{
						echo "NO EXISTEN PRODUCTOS EN ESTA SUBCATEGORIA";
					}
				}

				function ultima_modificacion($category){
	global $horamax,$fechamax;
	/////////////obtenemos los id de los productos correspondientes a la categoria
	$id="";$id2='';
	///////////////obtener la fecha maxima de modificacion del inventario
	$p=mysql_query("select * from producto where id_categoria=".$category);
	if(mysql_num_rows($p)>0){
		while($m=mysql_fetch_array($p)){
			if($id==''){
				$id="select max(fecha) as f from inventario where id_producto=".$m['id_producto'];
			}else{
				$id=$id." or id_producto=".$m['id_producto'];
			}
		}
	}
	$fecha=mysql_query($id);
	$mostrar_fecha=mysql_fetch_array($fecha);
	
	///////////buscar la hora mas reciente de modificacion
	$ph=mysql_query("select * from producto where id_categoria=".$category);
	if(mysql_num_rows($ph)>0){
		while($mh=mysql_fetch_array($ph)){
			if($id2==''){
				$id2="select max(hora) as h from inventario where id_producto=".$mh['id_producto'];
			}else{
				$id2=$id2." or id_producto=".$mh['id_producto'];
			}
		}
	}
	$hora=mysql_query($id2." and fecha='".$mostrar_fecha['f']."'");
	$mostrar_hora=mysql_fetch_array($hora);
	$fechamax=$mostrar_fecha['f'];
	$horamax=$mostrar_hora['h'];
	echo "<div id='fecha' style='position:absolute;top:160px;right:130px;color:white;'>";
	echo "Ultimo Corte:".$mostrar_fecha['f'];
	echo "</div>";
}

        	?>
      
    </div>
      
  </div>
</div>
<?php
	switch ($_GET['tipo']) 
	{
		case 'eventos':
					eventos();
			break;
		case 'comensales':
				comensales();
			break;
		case 'cobrado':
				cobrado();
				break;
		case 'eAdicional':
				eAdicional();
			break;
		case 'eRecaudacion':
				eRecaudacion();
			break;
		case 'ventasVinos':
				ventasVinos();
			break;
		case 'ventasT':
				ventasT();
			break;
		case 'Cancelaciones':
			Cancelaciones();
			break;
		case 'gastoInsumo':
				gastoInsumo();
				break;
		case 'compras':
				compras();
			break;
		case 'gastoOperativo':
				gastoOperativo();
			break;
		case 'nomina':
				nomina();
			break;
		case 'premioLealtad':
				premioLealtad();
				break;
		case 'gastoPersonal':
				gastoPersonal();
			break;
		case 'gastoInversion':
				gastoInversion();
			break;
		case 'vinos':
			vinos();
			break;
		default:
			# code...
			break;
	}

?>
</body>
</html>