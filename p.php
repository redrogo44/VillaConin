<?php
require "funciones2.php";
conectar();
$ind=0;
$ind2=0;
$contratoss='';
$q=mysql_query("select * from contrato");
while($m=mysql_fetch_array($q)){
	$arr=explode('%',$m["fechas"]);
	$arr2=explode('%',$m["monto"]);
	//echo "|".count($arr)."|".$arr[count($arr)-1]."|".$arr[count($arr)-2]."|<br>";
	for($i=0;$i<count($arr);$i++){
		if($arr[$i]>='2015-04-13' && $arr[$i]<='2015-04-19'){
			$abonos=total_abonos($m['Numero'],$m['facturado']);
			$teo=teorico($m['Numero'],$i);
			echo $m['Numero']."_____________fecha: ".$arr[$i]."____abonos: ".$abonos."-------Teorico ".$teo."___ #:____".$i." De:".count($arr)."<br>";
			$ind++;
			if($abonos>=$teo){
				$ind2++;
				$contratoss=$contratoss."<br>".$m['Numero']."---$".$abonos."----$".$teo."-----".$arr2[$i]."-----$".$arr[$i];
			}
		}
	}
}

echo "<<<<<<<".$ind.">>>>>>";
echo "<<<<<<<".$ind2.">>>>>>";
echo "<<<<<<<".$contratoss.">>>>>>";
function total_abonos($numero,$r){
	if($r=='si'){
				$preabonos="select sum(cantidad) as t from abonofac where numcontrato='".$numero."' and fechapago<'2015-04-06'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}else{
				$preabonos="select sum(cantidad) as t from abono where numcontrato='".$numero."' and fechapago<'2015-04-06'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}
		return $total_abonos['t'];	
}


function teorico($n,$index){
	$query="select * from contrato where Numero='".$n."'";
	$resultado=mysql_query($query);
	$m=mysql_fetch_array($resultado);
	$montos=explode('%',$m['monto']);
	$t=0;
	for($i=0;$i<$index;$i++){
		$t=$t+$montos[$i];
	}
	
	return $t;
}

/*
function atraso($n){
	$sub=explode('-',$n);
	if(count($sub)>1){
		$query="select * from contrato where Numero='".$n."'";
		$resultado=mysql_query($query);
		$m=mysql_fetch_array($resultado);
		$subcontrato=mysql_query("select * from subcontratos where numero='".$m['Numero']."'");
		$
	}else{
		$query="select * from contrato where Numero='".$n."'";
		$resultado=mysql_query($query);
		$m=mysql_fetch_array($resultado);
		$fechas=explode('%',$m['fechas']);
		$montos=explode('%',$m['monto']);
	}
	
}*/
?>
