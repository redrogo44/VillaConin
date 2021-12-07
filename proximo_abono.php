<?php
require 'funciones2.php';
conectar();
/*
$q="select * from contrato where Fecha>'2014-11-01' and estatus=1 and Numero not like '%-%' order by proximo_abono";
$r=mysql_query($q);
while($m=mysql_fetch_array($r)){
	$n=mysql_query("select * from contrato where Numero='".$m['Numero']."'");
	$m2=mysql_fetch_array($n);
	$fechas=explode('%',$m2['fechas']);
	$i=0;$x=0;
	while($x<count($fechas)-2){
		if(strtotime($fechas[$i])<strtotime(date('2015-01-18'))){
			$i++;
		}
		$x++;
	}

	$monto=explode("%",$m2['monto']);
	echo "contrato ".$m['Numero']." fecha proximo abono: ".$fechas[$i]." monto ".$monto[$i]."<br>";
	mysql_query("UPDATE contrato set proximo_abono='".$fechas[$i]."' where Numero='".$m2['Numero']."'");	
}

/*/////////////////subcontratos
$q="select * from contrato where Fecha>'2014-11-01' and Numero like '%-%' order by proximo_abono";
$r=mysql_query($q);
while($m=mysql_fetch_array($r)){
	$n=mysql_query("select * from subcontratos where numero='".$m['Numero']."'");
	$m2=mysql_fetch_array($n);
	$fechas=explode('%',$m2['fechas']);
	$i=0;$x=0;
	while($x<count($fechas)-2){
		if(strtotime($fechas[$i])<strtotime(date('2015-01-18'))){
			$i++;
		}
		$x++;
	}
	echo "sub contrato ".$m['Numero']." fecha proximo abono: ".$fechas[$i]."<br>";
	mysql_query("UPDATE contrato set proximo_abono='".$fechas[$i]."' where Numero='".$m2['numero']."'");
}	

?>