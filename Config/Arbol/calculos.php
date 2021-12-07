<?php
	require_once('../configuraciones.php');		

	//echo " Calculos para el costo Promedio";
	conectar();
	$totalEventos=0;
	$comensales=array();
/*
	numeroContratos('2016-01-01','2016-01-20');
	enlistaContratos('2016-01-01','2016-01-20');
	numeroRecaudacion('2016-01-01','2016-01-20');
	numeroAdicionales('2016-01-01','2016-01-20');
	enlistaAdicionales('2016-01-01','2016-01-20');
*/
	// FECHAS 
//		FUNCION QUE CALCULA EL NUMERO DE CONTRATOS EXISTENTES ENTRE LAS FECHAS EXCEPCIONANDO LOS DE MOSTRADOR
	function numeroContratos($fecha1,$fecha2)			
	{	
		//echo "SELECT COUNT( Numero ) AS t FROM contrato WHERE Fecha >= '".$fecha1."' AND Fecha <=  '".$fecha2."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8"; 
		$Ne=mysql_fetch_array(mysql_query("SELECT COUNT( Numero ) AS t FROM contrato WHERE Fecha >=  '".$fecha1."' AND Fecha <=  '".$fecha2."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8; "));	 		
	//echo "<br>Numero de Contratos =>	".$Ne['t'];
	/*		echo "<br>Numero de ADULTOS =>	".$Ne['a'];
		echo "<br>Numero de JOVENES =>	".$Ne['j'];
		echo "<br>Numero de NIÑOS =>	".$Ne['n'];
	*/
		return $Ne['t'];;
	}
	//	FUNCION QUE ENLISTA LOS CONTRATOS ENTRE LAS FECHAS EXCEPTO LOS DE MMOSTRADOR
	function enlistaContratos($fecha1,$fecha2)	
	{
		$Ne=mysql_query("SELECT * FROM contrato WHERE Fecha >=  '".$fecha1."' AND Fecha <=  '".$fecha2."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8; ");	 		
		$i=0;
		$contratos= array();
		while ($c=mysql_fetch_array($Ne)) 
		{				
			$contratos['Numero'][$i]=$c['Numero'];
			$contratos['si'][$i]=$c['si'];	
			$i++;
		}
		//print_r($contratos);
		return $contratos;

	}
//FUNCION QUE CALCULA EL NUMERO DE EVENTOS DE RECAUDACION
	function numeroRecaudacion($fecha1,$fecha2)		
	{
		$Re=mysql_fetch_array(mysql_query("SELECT COUNT( Numero ) AS t FROM Eventos_Recaudacion WHERE Fecha >=  '".$fecha1."' AND Fecha <=  '".$fecha2."' "));	 		
		//echo "<br>Numero de Eventos de Recaudacion =>	".$totalEventos=$Re['t'];
		return $Re['t'];
	}
// FUNCION QUE ENLISTA LOS EVENTOS DE RECAUDACION
	function enlistaRecaudacion($fecha1,$fecha2)	
	{
		$Ne=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Fecha >=  '".$fecha1."' AND Fecha <=  '".$fecha2."' ");	 		
		$i=0;
		$recaudacion= array();
		while ($c=mysql_fetch_array($Ne)) 
		{				
			$recaudacion[$i]=$c['Numero'];
			$i++;
		}
		//print_r($recaudacion);		
		return $recaudacion;	
	}
// FUNCION QUE CALCULA EL NUMERO DE EVENTOS ADICIONALES
	function numeroAdicionales($fecha1,$fecha2)		
	{
		$Re=mysql_fetch_array(mysql_query("SELECT COUNT( Numero ) AS t FROM Eventos_Adicionales WHERE Fecha >=  '".$fecha1."' AND Fecha <=  '".$fecha2."' "));	 		
		//echo "<br>Numero de Eventos Adicionales =>	".$totalEventos=$Re['t'];
		return $Re['t'];
	}
// FUNCION QUE ENLISTA LOS EVENTOS DE RECAUDACION
	function enlistaAdicionales($fecha1,$fecha2)	
	{
		$Ne=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Fecha >=  '".$fecha1."' AND Fecha <=  '".$fecha2."' ");	 		
		$i=0;
		$adicionales= array();
		while ($c=mysql_fetch_array($Ne)) 
		{				
			$adicionales[$i]=$c['Numero'];
			$i++;
		}
		//print_r($adicionales);	
		return $adicionales;		
	}
// FUNCION QUE DEVUELVEL EL TOTAL DE EVENTOS
	function totalEventos($fecha1,$fecha2)
	{	
		//echo "FECHA 1 ".$fecha1."	=>	FECHA  2 ".$fecha2;
		$t=0;
		$t+=numeroContratos($fecha1,$fecha2);
		$t+=numeroRecaudacion($fecha1,$fecha2);
		$t+=numeroAdicionales($fecha1,$fecha2);	
		return $t;
	}


//		CALCULO DE COMENSALES	
	function comensalesContratos($fecha1,$fecha2)
	{
		
		$Ne=mysql_fetch_array(mysql_query("SELECT SUM( c_adultos ) AS a, SUM( c_jovenes ) AS j, SUM( c_ninos ) AS n  FROM contrato WHERE Fecha >=  '".$fecha1."' AND Fecha <=  '".$fecha2."' AND tipo!='MOSTRADOR'"));	 						
		$comensales['total']=$Ne['a']+$Ne['j']+$Ne['n'];
		$comensales['adultos']=$Ne['a'];
		$comensales['jovenes']=$Ne['j'];
		$comensales['ninos']=$Ne['n'];
		//echo "<br> COMESNADALES HASTA AHORAA:";
		//print_r($comensales);

		$Ne=mysql_query("SELECT Numero, facturado FROM contrato WHERE Fecha >=  '".$fecha1."' AND Fecha <=  '".$fecha2."' AND tipo!='MOSTRADOR' AND LENGTH(Numero)<=8;  ");
		while ($comensalesCargos=mysql_fetch_array($Ne)) 
			{							
				$tcc=total_comen($comensalesCargos['Numero'] , $comensalesCargos['facturado']);
				$comensales['adultos']+=$tcc[0];
				$comensales['jovenes']+=$tcc[1];
				$comensales['ninos']+=$tcc[2];
				$comensales['total']+=$tcc[0]+$tcc[1]+$tcc[2];
			}
			//print_r($comensales);
		return $comensales;
	}
//		FUNCION QUE DEVUELVE TODOS LOS CARGOS 
	function enlistaCargos($contrato)
	{		
		$cargos =array();
			$c=mysql_query("SELECT * FROM contrato WHERE Numero='".$contrato."' ");
			while($co=mysql_fetch_array($c))
			{
				if($co['facturado']=='si')
				{	
					  $car=mysql_query("SELECT * FROM `cargofac` WHERE `numcontrato` LIKE '".$contrato."'");
				}
				else
				{
				  $car=mysql_query("SELECT * FROM `cargo` WHERE `numcontrato` LIKE '".$contrato."'");
				} 
				$i=0;
				while($cargo=mysql_fetch_array($car))
				{
					$cargos['concepto'][$i]=$cargo['concepto'];
					$cargos['cantidad'][$i]=$cargo['cantidad'];					
					$i++;
				}						
			}
		return $cargos;
	}
//	FUNCION QUE DEVUELVE LA CANTIDAD DE LA DEVOLUCION 
	function devolucion($contrato)
	{
			$Dev=mysql_fetch_array(mysql_query("SELECT * FROM TDevoluciones WHERE Numero='".$contrato."' "));

			return $Dev['Total'];
	}
// FUNCION QUE DEVUELVE TODO LO DE GASTOS INSUMOS
	/*function insumos($fecha1,$fecha2)
	{
		$f=mysql_query("SELECT * FROM corte_inventario WHEre fecha>='".$fecha1"' AND fecha<='".$fecha2."' ");
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
	}
*/
//	FUNCION QUE DEVUELVE TODAS LAS CATEGORIAS DE ALMACEN DE TIPO INSUMO
	function categoriasInsumo()
	{
		$categoriaInsumo=array();
		$c=mysql_query("SELECT * FROM categoria WHERE tipo='INSUMO' order by nombre	");
		$i=0;
			while ($ca=mysql_fetch_array($c))
			{
				$categoriaInsumo[$i]=$ca['nombre'];
				$i++;
			} 		
			return $categoriaInsumo;
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
?>