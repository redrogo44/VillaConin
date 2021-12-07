<?php
require 'funciones2.php';
conectar();
$acumulado_pagar=0;
$acumulado_abono=0;
$acumulado_faltante=0;
echo "<table border='1'>";
echo "<tr><td>Tipo</td><td>Contrato</td><td>Saldo inicial</td><td>Cargos</td><td>Abonos</td><td>Restante</td></tr>";
$contratos=mysql_query("select * from contrato where Fecha>='".date('Y-m-d')."' and Numero not like '%-%'");
while($m=mysql_fetch_array($contratos)){
	$contratosgral=mysql_query("select count(*) as t from contrato where Numero like '".$m['Numero']."%'");
	$sub=mysql_fetch_array($contratosgral);
	if($sub['t']>1){ 
		//echo "<td>contrato gral</td><td>".$m['Numero']."</td><td>".($sub['t']-1)." de subcontratos<br>";
		///recorremos los sub-contratos
		$sub=mysql_query('select * from contrato where Numero like "%-%"');
		while($subcontrato=mysql_fetch_array($sub)){
			$si=saldo_inicial_aux($subcontrato['Numero'],$subcontrato['facturado']);
			$cargos=cargos_aux($subcontrato['Numero'],$subcontrato['facturado']);
			$abonos=abonos_aux($subcontrato['Numero'],$subcontrato['facturado']);
			$restante=$si+$cargos-$abonos;
			$acumulado_pagar=$acumulado_pagar+$si+$cargos;
			$acumulado_abono=$acumulado_abono+$abonos;
			$acumulado_faltante=$acumulado_faltante+$restante;
			echo "<tr><td>subcontrato</td><td>".$subcontrato['Numero']."</td><td>".$si."</td><td>".$cargos."</td><td>".$abonos."</td><td>".$restante."</td></tr>";
		}
	}else{
		$si=saldo_inicial_aux($m['Numero'],$m['facturado']);
		$cargos=cargos_aux($m['Numero'],$m['facturado']);
		$abonos=abonos_aux($m['Numero'],$m['facturado']);
		$restante=$si+$cargos-$abonos;
		$acumulado_pagar=$acumulado_pagar+$si+$cargos;
		$acumulado_abono=$acumulado_abono+$abonos;
		$acumulado_faltante=$acumulado_faltante+$restante;
		echo "<tr><td></td><td>".$m['Numero']."</td><td>".$si."</td><td>".$cargos."</td><td>".$abonos."</td><td>".$restante."</td></tr>";
	}
}
echo "<tr><td colspan='3'></td><td>total<br>".$acumulado_pagar."</td><td>abonos<br>".$acumulado_abono."</td><td>restante<br>".$acumulado_faltante."</td></tr>";
echo "</table>"; 


function saldo_inicial_aux($numero,$facturado){
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
				$S1=($t_adultos*$p_adultos)+($t_jovenes*$p_jovenes)+($t_ninos*$p_ninos);
				$S2=$S1*1.16;
				$SI=$S2+$deposito;
			}else{
				$SI=($t_adultos*$p_adultos)+($t_jovenes*$p_jovenes)+($t_ninos*$p_ninos)+($deposito);
			}
		return $SI;
	}
	////////////////cargos
	function cargos_aux($numero,$fac){
		if($fac=='si'){
				$queryc="select sum(cantidad) as t from cargofac where numcontrato='".$numero."'";
			}else{
				$queryc="select sum(cantidad) as t from cargo where numcontrato='".$numero."'";
			}
			$resultado2=mysql_query($queryc);
			$m2=mysql_fetch_array($resultado2);
			return $m2['t'];
	}
	////////////////abonos
	function abonos_aux($numero,$fac){
		if($fac=='si'){
				$queryc="select sum(cantidad) as t from abonofac where numcontrato='".$numero."'";
			}else{
				$queryc="select sum(cantidad) as t from abono where numcontrato='".$numero."'";
			}
			$resultado2=mysql_query($queryc);
			$m2=mysql_fetch_array($resultado2);
			return $m2['t'];
	}
?>