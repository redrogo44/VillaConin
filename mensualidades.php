<?php
/*
obtener suma de cargos 
obtener fechas
X=dividir cargos / numero de fechas

insertar la mensualidad
	monto segun fecha + X
	
where 
require 'funciones2.php';
conectar();
$q="select * from contrato where Fecha>='2014-10-28' and Numero not like '%-%' and estatus!=0 order by Fecha";
$r=mysql_query($q);
while($m=mysql_fetch_array($r)){
	if($m['facturado']=='si'){
		$queryc="select sum(cantidad) as t from cargofac where numcontrato='".$m['Numero']."'";
	}else{
		$queryc="select sum(cantidad) as t from cargo where numcontrato='".$m['Numero']."'";
	}
	$resultado2=mysql_query($queryc);
	$m2=mysql_fetch_array($resultado2);
	$cargos=$m2['t'];
	
	$fechas=explode('%',$m['fechas']);
	$extra=$cargos/(count($fechas)-1);
	 $i=0;$index=0;
	 $hoy=date('Y-m-d');
	 while($i<count($fechas)-1){
		if($fechas[$i]<$hoy){
			$index++;
		}
		$i++;
	 }
	 
	if($index>=count($fechas)-1){
		while($index>=count($fechas)-1){
			$index--;
		}
	}
	//echo "<br>".$m['estatus']."<br>";
	$monto=explode('%',$m['monto']);
	$mensualidad=round($monto[$index]+$extra,2);
	
	$update=mysql_query("UPDATE contrato set mensualidad=".$mensualidad.",proximo_abono='".$fechas[$index]."' where Numero='".$m['Numero']."'");
	echo "UPDATE contrato set mensualidad=".$mensualidad.",proximo_abono='".$fechas[$index]."' where Numero='".$m['Numero']."'<br>";

*/
require 'funciones2.php';
conectar();
$q="select * from contrato where Fecha>='2014-10-28' and Numero like '%-%' and estatus!=0 order by Fecha";
$r=mysql_query($q);
while($m=mysql_fetch_array($r)){

	$f=mysql_query('select fechas from subcontratos where numero="'.$m['Numero'].'"');
	$f2=mysql_fetch_array($f);
	$fechas=explode('%',$f2['fechas']);
	$abono=saldoi($m['Numero'])/(count($fechas)-1);
	 $i=0;$index=0;
	 $hoy=date('Y-m-d');
	 while($i<count($fechas)-1){
		if($fechas[$i]<$hoy){
			$index++;
		}
		$i++;
	 }
	 
	if($index>=count($fechas)-1){
		while($index>=count($fechas)-1){
			$index--;
		}
	}
	//echo "<br>".$m['estatus']."<br>";
	$mensualidad=round($abono,2);
	
	$update=mysql_query("UPDATE contrato set mensualidad=".$mensualidad.",proximo_abono='".$fechas[$index]."' where Numero='".$m['Numero']."'");
	echo "UPDATE contrato set mensualidad=".$mensualidad.",proximo_abono='".$fechas[$index]."' where Numero='".$m['Numero']."'<br>";
}
//saldo inicial del subcontrato o contrato
	function saldoi($numero){
		$query="select * from contrato where Numero='".$numero."'";
		$resultado=mysql_query($query);
		$m=mysql_fetch_array($resultado);
		$t_adultos=$m['c_adultos'];
		$t_jovenes=$m['c_jovenes'];
		$t_ninos=$m['c_ninos'];
		$p_adultos=$m['p_adultos'];
		$p_jovenes=$m['p_jovenes'];
		$p_ninos=$m['p_ninos'];
		$deposito=$m['deposito'];
			if($m['facturado']=='si'){
				$queryc="select sum(cantidad) as t from cargofac where numcontrato='".$numero."'";
				$S1=($t_adultos*$p_adultos)+($t_jovenes*$p_jovenes)+($t_ninos*$p_ninos);
				$S2=$S1*1.16;
				$SI=$S2+$deposito;
			}else{
				$queryc="select sum(cantidad) as t from cargo where numcontrato='".$numero."'";
				$SI=($t_adultos*$p_adultos)+($t_jovenes*$p_jovenes)+($t_ninos*$p_ninos)+($deposito);
			}
			$resultado2=mysql_query($queryc);
			$m2=mysql_fetch_array($resultado2);
			$SI=$SI+$m2['t'];
		return $SI;
	}
	
?>