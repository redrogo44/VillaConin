<?php
session_start();
require('../../configuraciones.php');
	conectar();	
	date_default_timezone_set('America/Mexico_City');
//print_r($_POST);

	$tipo=$_POST['tipo'];
	$fecha1=$_POST['fecha1'];
	$fecha2=$_POST['fecha2'];

	switch ($tipo) {
		case 'numeroEventos':
				nEventos();
			break;	
		case 'comensales':
				comensales();
			break;
		case 'cobrado':
				cobrado();
			break;
		case 'eventosAdicionales':
				eventosAdicionales();
			break;
		case 'eventosRecaudacion':
				eventosRecaudacion();
			break;
		case 'ventasVinos':
				ventaVinos();
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
		case 'gastoActivo':
				gastoActivo();
			break;
		case 'compras':
				compras();
				break;
		case 'gastoOperativo':
			// gastoOperativo();
		newGastoOperativoX();
			break;
		case 'nomina':
			// nomina();
			newNominaX();
			break;
		case 'premioLealtad':
			// premioLealtad();
			newPremioLealtadX();
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
		case 'comensalesGlobales':
			comensalesGlobales();
			break;
		default:
			# code...
			break;
	}



	function nEventos()
	{
		$totalEventos=0;
		$contratos=mysql_fetch_array(mysql_query("SELECT COUNT( Numero ) AS t FROM contrato WHERE Fecha >=  '".$_POST['fecha1']."' AND Fecha <=  '".$_POST['fecha2']."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8; "));
		// $recaudacion=mysql_fetch_array(mysql_query("SELECT COUNT( Numero ) AS t FROM Eventos_Recaudacion WHERE Fecha >=  '".$_POST['fecha1']."' AND Fecha <=  '".$_POST['fecha2']."' AND estatus='ACTIVO' "));	 			
		// $adicionales=mysql_fetch_array(mysql_query("SELECT COUNT( Numero ) AS t FROM Eventos_Adicionales WHERE Fecha >=  '".$_POST['fecha1']."' AND Fecha <=  '".$_POST['fecha2']."' "));	 			
		//echo ($contratos['t']+$recaudacion['t']+$adicionales['t']);
		echo ($contratos['t']);
	}
	function comensales()
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
		// $adicionales=mysql_fetch_array(mysql_query("SELECT SUM( c_adultos ) AS a, SUM(c_jovenes) AS j, SUM(c_ninos) AS n FROM Eventos_Adicionales WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."' "));
		// $comensales['total']+=($adicionales['a']+$adicionales['j']+$adicionales['n']);
		// $comensales['adultos']+=$adicionales['a'];
		// $comensales['jovenes']+=$adicionales['j'];
		// $comensales['ninos']+=$adicionales['n'];		
		echo ($comensales['adultos']+$comensales['jovenes']+$comensales['ninos']);




		
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
		$totalCobrado=0;$_SESSION["TotalCobrado"]=0;
		$contratos=mysql_query("SELECT * FROM contrato WHERE Fecha >=  '".$_POST['fecha1']."' AND Fecha <=  '".$_POST['fecha2']."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8; ");		
				while ($c=mysql_fetch_array($contratos)) 
				{
					$totalContrato=0;				
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
												  $totalContrato+=$carg['cantidad'];
										}
									}
									$devolucion=mysql_fetch_array(mysql_query("SELECT * FROM TDevoluciones WHERE Numero='".$c['Numero']."' "));
									$totalContrato-=$devolucion['Total'];						
						  			$totalCobrado+=$totalContrato;
				}
		echo money_format("%i", $totalCobrado);
	}
	function eventosAdicionales()
	{
		$adicionales=mysql_query("SELECT COUNT('Numero') as c FROM `Eventos_Adicionales` WHERE `Fecha`>= '".$_POST['fecha1']."' AND `Fecha`<= '".$_POST['fecha2']."' ");
	   $d=mysql_fetch_array($adicionales);
	   echo $d['c'];
	}
	function eventosRecaudacion()
	{
		$recaudacion=mysql_query("SELECT * FROM `Eventos_Recaudacion` WHERE `fecha`>= '".$_POST['fecha1']."' AND `fecha`<= '".$_POST['fecha2']."' AND estatus='ACTIVO' ");	
	$ttRecaudacion=0;
		while ($r=mysql_fetch_array($recaudacion)) 
		{$totalRecaudacion=0;		
							$tic=mysql_query("SELECT * FROM tickets WHERE referencia='".$r['Numero']."' ORDER BY folio");
							while($t=mysql_fetch_array($tic))
							{$total_ticket=0;						
													$c=explode(",",$t['cantidades']);
													$p=explode(",",$t['productos']);
													$tt=explode(",",$t['totales']);
													for ($i=1; $i <count($c) ; $i++) 
													{ 										
														$total_ticket+=$tt[$i];
													}					
									  $totalRecaudacion+=$total_ticket;
							}
							$ttRecaudacion+=$totalRecaudacion;
		}
	
	echo money_format("%i",$ttRecaudacion);
	}
	function ventaVinos()
	{
		$venta=mysql_query("SELECT * FROM venta WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' ");
		 $tt=0;
		while($v=mysql_fetch_array($venta))
		{
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
						//$UC=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$d['id_producto']));
						//$t=($d['cantidad']*($d['precio_venta']-$UC['precio']));
						$t=($d['cantidad']*($d['precio_venta']-$d['precio_adquisicion']));
						//$t=$d['cantidad']*$d['precio_venta'];
						if($t>0)
						{				
							$totv+=$t;
							$tt+=$t;
						}


					}
				}			
			}
			 
		}
		echo money_format("%i",$tt);
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
	function ventasT()
	{
		$venta=mysql_query("SELECT * FROM venta WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' ");
	 $tt=0;
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
						$tt+=$t;
					}
						
					
				} 
			}
		}
		echo money_format("%i",$tt);	
	}
	function Cancelaciones()
	{
		$c=mysql_query("SELECT * FROM Cancelaciones WHERE 	concepto='cancelacion de contrato' AND fechamovimiento>='".$_POST['fecha1']."' AND 	fechamovimiento<='".$_POST['fecha2']."' ");
		 $tt=0;	
		while($cancelacion=mysql_fetch_array($c))
		{		
			$tt=$tt+$cancelacion["cantidad"];
		}
		
		echo money_format("%i",$tt);
	}


	function gastoInsumo()
	{				
		
					$sqll= "SELECT SUM((cantidad*precio_adquisicion)*-1) AS TotalInumos FROM `GastoInsumo` WHERE `fecha` >= '".$_POST['fecha1']."' AND fecha <= '".$_POST['fecha2']."' AND `tipo`='faltante' AND `gasto`='no' AND id_producto IN (SELECT id_producto FROM Categorias_Subcategorias WHERE id_categoria in (18,5,2,8,6,4,7) );";
					$resInsumo= mysql_fetch_array( mysql_query($sqll));					
					echo number_format($resInsumo['TotalInumos'],3);	
	}
///////////////////////////////////////////////////// 	COMPRAS 		////////////////////////////////////////////////////
	function compras() // FACTURADAS
	{
		$c=mysql_query("SELECT * FROM comprafac WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' ");
		$t=0;
		$f='';
		while ($co=mysql_fetch_array($c)) 
		{
			$com=mysql_query("SELECT SUM(cantidad * precio_adquisicion) AS T FROM Compras_Facturadas WHERE tipo='comprafac' AND nombreCategoria!='VINOS' AND tipoCategoria='ACTIVO' AND id=".$co['id_compra']);
			$comp=mysql_fetch_array($com);
			$t+=$comp['T'];

			$f.=' - '.$co['fecha'];
		}

		$c2=compras2();
		$t+=$c2;
		echo number_format($t,3);
	}
	function compras2() // NO FACTURADAS
	{
		$cC=mysql_query("SELECT * FROM compra WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' ");
		$t=0;
		$f='';
		while ($coO=mysql_fetch_array($cC)) 
		{
			$com=mysql_query("SELECT SUM(cantidad * precio_adquisicion) AS T FROM Compras WHERE tipo='compra' AND nombreCategoria!='VINOS' AND tipoCategoria='ACTIVO' AND id=".$coO['id_compra']);
			$comp=mysql_fetch_array($com);
			$t+=$comp['T'];
	
		}
		return $t;
	}
////////////////////////////////////// 	TERMINA COMPRAS 	////////////////////////////////////////////////////////////
	function gastoOO($tabla,$ids,$tipo)
				{
					$t = 0;
					$pr = mysql_query("SELECT * FROM Categorias_Subcategorias WHERE id_subcategoria=".$ids);
					while($p = mysql_fetch_array($pr))
					{	
						//echo "SELECT * FROM Compras_Facturadas WHERE tipo='comprafac' AND `tipoCategoria` =  'OPERATIVO' AND fecha >= '".$_POST['fecha1']."' AND fecha <= '".$_POST['fecha2']."' id_producto =".$p['id_producto'];
						$comp = mysql_query("SELECT * FROM ".$tabla." WHERE tipo='".$tipo."' AND `tipoCategoria` =  'OPERATIVO' AND fecha >= '".$_POST['fecha1']."' AND fecha <= '".$_POST['fecha2']."' AND id_producto =".$p['id_producto']);
						while ($c = mysql_fetch_array($comp)) 
						{
							$t+= ($c['cantidad']*$c['precio_adquisicion']);
//								echo "<br>Subcategoria: ".$p['nombreSubcategoria']."  esto es T ".$t;
						}
					}
					return $t;					
				}
	function newGastoOperativoX () {
		$tt=0;
		$cas=mysql_query("SELECT * FROM  `Compras_Facturadas` WHERE tipoCategoria='OPERATIVO' GROUP BY  `nombreCategoria` ORDER BY  `nombreCategoria` ");
		while ($ca = mysql_fetch_array($cas)) 
		{								 
		 	$cate = mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='OPERATIVO' AND id_categoria =".$ca['id_categoria']." GROUP BY nombreSubcategoria ");
		 	while($cat = mysql_fetch_array($cate))
		 	{
		 		$tc = gastoOO("Compras_Facturadas",$cat['id_subcategoria'],"comprafac");
		 		if($tc>0)
		 		{
		 			$tt+=$tc;
		 			//echo "SELECT * FROM Categorias_Subcategorias WHERE id_subcategoria=".$cat['id_subcategoria'];
						$pr = mysql_query("SELECT * FROM Categorias_Subcategorias WHERE id_subcategoria=".$cat['id_subcategoria']);
						while($p = mysql_fetch_array($pr))
						{	
							//echo "SELECT * FROM Compras_Facturadas WHERE tipo='comprafac' AND `tipoCategoria` =  'OPERATIVO' AND fecha >= '".$_POST['fecha1']."' AND fecha <= '".$_POST['fecha2']."' AND id_producto =".$p['id_producto'];
							$comp = mysql_query("SELECT  SUM( cantidad * precio_adquisicion ) AS T FROM Compras_Facturadas WHERE tipo='comprafac' AND `tipoCategoria` =  'OPERATIVO' AND fecha >= '".$_POST['fecha1']."' AND fecha <= '".$_POST['fecha2']."' AND id_producto =".$p['id_producto']);
							while ($c = mysql_fetch_array($comp)) 
							{
								$t=0;
								$t+= ($c['T']);
							}
						}
		 		}
		 		
		 	}

		}
		///******//***
		$totslTodo = $tt;
		$tt=0;
		$cas=mysql_query("SELECT * FROM  `Compras` WHERE tipoCategoria='OPERATIVO' GROUP BY  `nombreCategoria` ORDER BY  `nombreCategoria` ");
		while ($ca = mysql_fetch_array($cas)) 
		{									 
		 	$cate = mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='OPERATIVO' AND id_categoria =".$ca['id_categoria']." GROUP BY nombreSubcategoria ");
		 	while($cat = mysql_fetch_array($cate))
		 	{
		 		$tc = gastoOO("Compras",$cat['id_subcategoria'],"compra");
		 		if($tc>0)
		 		{
		 			$tt+=$tc;
		 			//echo "SELECT * FROM Categorias_Subcategorias WHERE id_subcategoria=".$cat['id_subcategoria'];
						$pr = mysql_query("SELECT * FROM Categorias_Subcategorias WHERE id_subcategoria=".$cat['id_subcategoria']);
						while($p = mysql_fetch_array($pr))
						{	
							//echo "SELECT * FROM Compras_Facturadas WHERE tipo='comprafac' AND `tipoCategoria` =  'OPERATIVO' AND fecha >= '".$_POST['fecha1']."' AND fecha <= '".$_POST['fecha2']."' AND id_producto =".$p['id_producto'];
							$comp = mysql_query("SELECT  SUM( cantidad * precio_adquisicion ) AS T FROM Compras WHERE tipo='compra' AND `tipoCategoria` =  'OPERATIVO' AND fecha >= '".$_POST['fecha1']."' AND fecha <= '".$_POST['fecha2']."' AND id_producto =".$p['id_producto']);
							while ($c = mysql_fetch_array($comp)) 
							{
								$t=0;
								$t+= ($c['T']);
							}
						}
		 		}
		 		
		 	}

		}				
		$totslTodo += $tt;
		echo number_format($totslTodo,3);
	}

	function gastoOperativo()
	{
		$tt=0;$t=0;					
		$cas=mysql_query("SELECT * FROM  `Compras_Facturadas` WHERE tipoCategoria='OPERATIVO' GROUP BY  `nombreCategoria` ORDER BY  `nombreCategoria` ");
		while ($ca = mysql_fetch_array($cas)) 
		{																	 
		 	$cate = mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='OPERATIVO' AND id_categoria =".$ca['id_categoria']." GROUP BY nombreSubcategoria ");
		 	while($cat = mysql_fetch_array($cate))
		 	{							 						 	
				$pr = mysql_query("SELECT * FROM Categorias_Subcategorias WHERE id_subcategoria=".$cat['id_subcategoria']);
				while($p = mysql_fetch_array($pr))
				{								
					$comp = mysql_query("SELECT  SUM( cantidad * precio_adquisicion ) AS T FROM Compras_Facturadas WHERE tipo='comprafac' AND `tipoCategoria` =  'OPERATIVO' AND fecha >= '".$_POST['fecha1']."' AND fecha <= '".$_POST['fecha2']."' AND id_producto =".$p['id_producto']);
					while ($c = mysql_fetch_array($comp)) 
					{													
						$t+= ($c['T']);																								
					}
				}							 									 								 		
		 	}						 
		}											
		$casi=mysql_query("SELECT * FROM  `Compras` WHERE tipoCategoria='OPERATIVO' GROUP BY  `nombreCategoria` ORDER BY  `nombreCategoria` ");
		while ($ca2 = mysql_fetch_array($casi)) 
		{																 
		 	$cate2 = mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='OPERATIVO' AND id_categoria =".$ca2['id_categoria']." GROUP BY nombreSubcategoria ");
		 	while($cate = mysql_fetch_array($cate2))
		 	{
		 		 				 								 		
				$pr2 = mysql_query("SELECT * FROM Categorias_Subcategorias WHERE id_subcategoria=".$cate['id_subcategoria']);
				while($p = mysql_fetch_array($pr2))
				{							
					$comp = mysql_query("SELECT  SUM( cantidad * precio_adquisicion ) AS T FROM Compras WHERE tipo='compra' AND `tipoCategoria` =  'OPERATIVO' AND fecha >= '".$_POST['fecha1']."' AND fecha <= '".$_POST['fecha2']."' AND id_producto =".$p['id_producto']);
					while ($c = mysql_fetch_array($comp)) 
					{													
						$t+= ($c['T']);																								
					}
				}							 				 									 		
		 	}						 
		}				

		echo money_format("%i",$t);	
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
				$tms += $tcate;
			}
		}
		$totalMeseros+=$tms;			   						
		if(NominaEv('Confirmacion_Nomina_Eventos')>0)
		{							
			$templeado+=$tc;
			$te=0;
			$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Eventos` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
			while ($c=mysql_fetch_array($co)) 
			{
				$nombres=explode(",",$c['nombres']);
				$total=explode(",",$c['totales']);									
				for ($i=1; $i <count($nombres) ; $i++) 
				{ 									
					$te+=$total[$i];
				}
			}
			$templeado+=$te;														 
		}
		if(NominaEv('Confirmacion_Nomina_Extras')>0)
		{
			$tex=0;
			$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Extras` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
			while ($c=mysql_fetch_array($co)) 
			{
				$nombres=explode(",",$c['nombres']);
				$total=explode(",",$c['totales']);									
				for ($i=1; $i <count($nombres) ; $i++) 
				{ 									
					$tex+=$total[$i];
				}
			}
			$templeado+=$tex;						  
		}
		if(NominaM('Confirmacion_Nomina_Planta')>0)
		{							
			$tp=0;
			$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Planta` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
			while ($c=mysql_fetch_array($co)) 
			{
				$nombres=explode(",",$c['nombres']);
				$total=explode(",",$c['Total_nomina']);									
				for ($i=1; $i <count($nombres); $i++) 
				{ 									
					$tp+=$total[$i];
				}
			}
			$templeado+=$tp;				
		}
		if(NominaCo('Cornfirmacion_Nomina_Comision')>0)
		{							
			$tco=0;
			$co=mysql_query("SELECT * FROM `Cornfirmacion_Nomina_Comision` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
			while ($c=mysql_fetch_array($co)) 
			{
				$nombres=explode(",",$c['nombres']);
				$total=explode(",",$c['neto']);									
				for ($i=1; $i <count($nombres) ; $i++) 
				{ 										
					$tco+=$total[$i];
				}
			}
			$templeado+=$tco;					 
		}
		$totalMeseros+=$templeado;
		echo money_format("%i",$totalMeseros);
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
		return $Total;
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
	function newNominaX ()
	{
			/*
				SEPARAMOS EL REGISTRO DE MESEROS 
				RECORDANDO QUE: 
				LA POSICION 0 ES EL ID DEL MESERO
				LA POSICION 1 ES EL ID DE LA CATEGORIA
				LA POSISION 2 ES EL PAGO POR EVENTO
				Y LA POSICION 3 SON LOS PUNTOS
				*/
					$t=0;
						$cm=mysql_query("SELECT * FROM Meseros GROUP BY tipo ORDER BY tipo");
						while( $ca=mysql_fetch_array($cm))
						{
							$c=0;
							$mc=mysql_query("SELECT * FROM MeserosContrato WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."' ");
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
							$ma=mysql_query("SELECT * FROM MeserosAdicionales WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."' ");
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
						}
						$nc=mysql_query("SELECT totales, fecha FROM Confirmacion_Nomina_Eventos WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
						$tt=0;						
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['totales']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						 $nc=mysql_query("SELECT totales, fecha FROM Confirmacion_Nomina_Extras WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
						$tt=0;						
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['totales']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						  $nc=mysql_query("SELECT Total_nomina, fecha FROM Confirmacion_Nomina_Planta WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
						$tt=0;						
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['Total_nomina']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						  $nc=mysql_query("SELECT neto, fecha FROM Cornfirmacion_Nomina_Comision WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
						$tt=0;						
						while($nco=mysql_fetch_array($nc))
						{	
							$t=explode(",",$nco['neto']);
							for ($i=1; $i <count($t); $i++) { 
								$tt+=$t[$i];
							}
						}
						$tEm+=$tt;
						$t += $tEm;
		echo money_format("%i", $t);
	
	}

	///7/////////////7 	TERMINA NOMINA //////////////////////7
	function newPremioLealtadX()
	{
			/*
	SEPARAMOS EL REGISTRO DE MESEROS 
	RECORDANDO QUE: 
	LA POSICION 0 ES EL ID DEL MESERO
	LA POSICION 1 ES EL ID DE LA CATEGORIA
	LA POSISION 2 ES EL PAGO POR EVENTO
	Y LA POSICION 3 SON LOS PUNTOS
	*/
	$t=0;
		$cm=mysql_query("SELECT * FROM Meseros GROUP BY tipo ORDER BY tipo");
		while( $ca=mysql_fetch_array($cm))
		{
			$c=0;
			$mc=mysql_query("SELECT * FROM MeserosContrato WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha2']."' ");
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
			$ma=mysql_query("SELECT * FROM MeserosAdicionales WHERE Fecha>='".$_POST['fecha1']."' AND Fecha<='".$_POST['fecha3']."' ");
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
		
		}
			/***/
		$nc=mysql_query("SELECT puntos, fecha FROM Confirmacion_Nomina_Eventos WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
		$tt=0;						
		while($nco=mysql_fetch_array($nc))
		{	
			$t=explode(",",$nco['puntos']);
			for ($i=1; $i <count($t); $i++) { 
				$tt+=$t[$i];
			}
		}
		$tEm+=$tt;
		 $nc = mysql_query("SELECT puntos, fecha FROM Confirmacion_Nomina_Extras WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
		$tt=0;						
		while($nco=mysql_fetch_array($nc))
		{	
			$t=explode(",",$nco['puntos']);
			for ($i=1; $i <count($t); $i++) { 
				$tt+=$t[$i];
			}
		}
		$tEm+=$tt;
		  $nc=mysql_query("SELECT puntos, fecha FROM Confirmacion_Nomina_Planta WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
		$tt=0;						
		while($nco=mysql_fetch_array($nc))
		{	
			$t=explode(",",$nco['puntos']);
			for ($i=1; $i <count($t); $i++) { 
				$tt+=$t[$i];
			}
		}
		
		// $tEm+=$tt;
		// $nc = mysql_query("SELECT puntos, fecha FROM Cornfirmacion_Nomina_Comision WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
		// $tt=0;						
		// while($nco=mysql_fetch_array($nc))
		// {	
		// 	$t=explode(",",$nco['puntos']);
		// 	for ($i=1; $i <count($t); $i++) { 
		// 		$tt+=$t[$i];
		// 	}
		// }
		$tEm +=  $tt;
		$t += $tEm;
		echo money_format("%i", $t);
		
	}
	///////////////////  PREMIO DE LEALTAD  /////////////////////////777
	function premioLealtad()
	{		
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
							$tmsp=$tmsp+$tcatep;
						}
					}	
					$totalPremioLealtad+=$tmsp;				$tPN=0;
					if(PuntosN('Cornfirmacion_Nomina_Comision')>0)
					{
							$tco=0;
								$co=mysql_query("SELECT * FROM `Cornfirmacion_Nomina_Comision` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si'");
								while ($c=mysql_fetch_array($co)) 
								{
									$nombres=explode(",",$c['nombres']);
									$total=explode(",",$c['puntos']);									
									for ($i=1; $i <count($nombres) ; $i++) 
									{ 
										$nom=explode("-",$nombres[$i]);									
										$tco+=$total[$i];
									}
								}
							$templeado+=$tco;
							$tPN+=$tco;					
					}
					if(PuntosN('Confirmacion_Nomina_Planta')>0)
					{
													
						$tp=0;
						$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Planta` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
						while ($c=mysql_fetch_array($co)) 
						{
							$nombres=explode(",",$c['nombres']);
							$total=explode(",",$c['puntos']);									
							for ($i=1; $i <count($nombres) ; $i++) 
							{ 
								$nom=explode("-", $nombres[$i]);								
								$tp+=$total[$i];
							}
						}
					$templeado+=$tp;
					$tPN+=$tp;
					
					}
					if(PuntosN('Confirmacion_Nomina_Extras')>0)
					{						
								$tex=0;
								$co=mysql_query("SELECT * FROM `Confirmacion_Nomina_Extras` WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
								while ($c=mysql_fetch_array($co)) 
								{
									$nombres=explode(",",$c['nombres']);
									$total=explode(",",$c['puntos']);									
									for ($i=1; $i <count($nombres) ; $i++) 
									{ 
										$nom=explode("-", $nombres[$i]);								
										$tex+=$total[$i];
									}
								}
							$templeado+=$tex;
							$tPN+=$tex;						  
					}
					if(PuntosN('Confirmacion_Nomina_Eventos')>0)
					{	
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
											$te+=$total[$i];
										}
									}
								$templeado+=$te;	
								$tPN+=$te;													
					}			
					$totalPremioLealtad+=$tPN;
			echo money_format("%i",$totalPremioLealtad);
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
	//	echo "Puntos C ".$tco;
		return $tco;
	}


	//// 	GASTOS PERSOAMLES		///
	function gastoPersonal()
	{
			$totalGasto=0;	
			$c=mysql_query("SELECT * FROM categoria ");
			while ($ca=mysql_fetch_array($c)) 
			{
				$totalCategoria=0;
				$s=mysql_query("SELECT * FROM subcategoria WHERE  id_categoria=".$ca['id_categoria']." order by nombre");				
					while ($su=mysql_fetch_array($s)) 
					{		$totalSubCategoria=0;													
									$p=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$su['id_subcategoria']." order by nombre" );
									while ($pr=mysql_fetch_array($p)) 
									{ 
										$totalSubCategoria+=$totalProducto=gasto_personal($pr['id_producto']);												
									}							
						$totalCategoria+=$totalSubCategoria;
					}				   
		      	 $totalGasto+=$totalCategoria;
			    
			}
		echo money_format("%i",$totalGasto);
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

///////////// 		GASTO DE INVERSION 		////////////////////////77
	function gastoInversion()
	{
		$tgp=0;
					$ttp2=0;		
					$catt=mysql_query("SELECT nombreSubcategoria,id_subcategoria FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' GROUP BY nombreSubcategoria");
					while($ct=mysql_fetch_array($catt))
					{
						$tsub=0;
						$cf=mysql_query("SELECT * FROM Compras WHERE tipo='compra' AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ");
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
		               	$t=0;  // COMPRAS 
						$cf=mysql_query("SELECT * FROM Compras WHERE tipo='compra' AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ");
						while ($cfa=mysql_fetch_array($cf) )
						{
							$p=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
							while ($pr=mysql_fetch_array($p) )
							{											
								$t+=($cfa['cantidad']*$cfa['precio_adquisicion']);																			 
							}
						}
					}
					$nc=mysql_query("SELECT Total_nomina, fecha FROM Confirmacion_Nomina_Construccion WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
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
					 $nc=mysql_query("SELECT puntos, fecha FROM Confirmacion_Nomina_Construccion WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
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
						$tttggi = $ttp2+$ttpp+$tEm;					       
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////77
					       $tgif=0;					 
					$catt=mysql_query("SELECT nombreSubcategoria,id_subcategoria FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' GROUP BY nombreSubcategoria");
					while($ct=mysql_fetch_array($catt))
					{
						$tsub=0;
						$cf=mysql_query("SELECT * FROM Compras_Facturadas WHERE tipo='comprafac' AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ");
						while ($cfa=mysql_fetch_array($cf) )
						{
							$p=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND  id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
							while ($pr=mysql_fetch_array($p) )
							{								
									$tsub+=($cfa['cantidad']*$cfa['precio_adquisicion']);								
							}
						}						
					               	$t=0;  // COMPRAS 
									$cf=mysql_query("SELECT * FROM Compras_Facturadas WHERE tipo='comprafac' AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ");
									while ($cfa=mysql_fetch_array($cf) )
									{
										$p=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
										while ($pr=mysql_fetch_array($p) )
										{											
											$t+=($cfa['cantidad']*$cfa['precio_adquisicion']);																
										}
									}
					        $tgif+=$t;
					}					   
					echo  ($tttggi + $tgif );
	}	
	function vinos()
	{
		$totalVinos=0;
		$su=mysql_query("SELECT * FROM subcategoria WHERE id_categoria=1 ORDER BY nombre");		
			while($s=mysql_fetch_array($su))
			{
				
				$totalCategoria=0;
				   		$pr=mysql_query("SELECT * FROM producto where id_subcategoria=".$s['id_subcategoria']." ORDER BY nombre ");
				   		while($p=mysql_fetch_array($pr))
				   		{
				   			$t=buscaVinos($p['id_producto']);				   						   		
				   			$totalCategoria+=$t;				   		
				   		}
				$totalVinos+=$totalCategoria;
				
			}
	echo money_format("%i",$totalVinos);

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
	function comensalesGlobales()
	{
		$contratos=mysql_fetch_array(mysql_query("SELECT SUM( c_adultos ) AS a, SUM( c_jovenes ) AS j, SUM( c_ninos ) AS n, Numero  FROM contrato WHERE Fecha >=  '".$_POST['fecha1']."' AND Fecha <=  '".$_POST['fecha2']."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8;"));	 						
		$comensales['total']=($contratos['a']+$contratos['j']+$contratos['n']);		
	
		$cagos=mysql_query("SELECT Numero, facturado FROM contrato WHERE Fecha >=  '".$_POST['fecha1']."' AND Fecha <=  '".$_POST['fecha2']."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8;  ");
		while ($comensalesCargos=mysql_fetch_array($cagos)) 
			{											
				$comensales['total']+=($tcc[0]+$tcc[1]+$tcc[2]);
			}
		echo $comensales['total'];
	}
?>
