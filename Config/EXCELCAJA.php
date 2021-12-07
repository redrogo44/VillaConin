<?php

require 'funciones2.php';
conectar();
$ayer;
$total;$total2;$total3;$total4;$total5;$gastos_efec;
$depositos;$cargos;$efectivo;$tarjetas;
$ixe;$banamex_villa;$banamex_city;$banamex_puente;$otro;
$ixe2;$banamex_villa2;$banamex_city2;$banamex_puente2;$otro2;
$d=date('d-m-Y');
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Corte de caja ".$d.".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
 

 <head> 
 <title>Villa Conin</title>
 <?php
	function cuentas_egresos($cuenta,$cantidad){
	global $ixe2,$banamex_villa2,$banamex_city2,$banamex_puente2,$otro2;
		if($cuenta=='ixe fis'){
			$ixe2=$ixe2+$cantidad;
		}elseif($cuenta=='banamex villa'){
			$banamex_villa2=$banamex_villa2+$cantidad;
		}elseif($cuenta=='banamex tarjeta city'){
			$banamex_city2=$banamex_city2+$cantidad;
		}elseif($cuenta=='banamex puente'){
			$banamex_puente2=$banamex_puente2+$cantidad;
		}else{
			$otro2=$otro2+$cantidad;
		}
	}
	function cuentas($cuenta,$cantidad){
	global $ixe,$banamex_villa,$banamex_city,$banamex_puente,$otro;
		if($cuenta=='ixe fis'){
			$ixe=$ixe+$cantidad;
		}elseif($cuenta=='banamex villa'){
			$banamex_villa=$banamex_villa+$cantidad;
		}elseif($cuenta=='banamex tarjeta city'){
			$banamex_city=$banamex_city+$cantidad;
		}elseif($cuenta=='banamex puente'){
			$banamex_puente=$banamex_puente+$cantidad;
		}else{
			$otro=$otro+$cantidad;
		}
	}
 
	function ingresos(){
	global $total,$total2,$total3,$total4,$total5;
	$hoy=date('d-m-Y');
	$q="select * from abono where fechapago='".$hoy."' and concepto='Pago en Efectivo' order by id";
	$r=mysql_query($q);
	//abonos no facturados
	while($m=mysql_fetch_array($r)){
		echo "<tr><td>".$m['recibide']."</td><td>".$m['id']."</td><td>".$m['numcontrato']."</td><td>".$m['fechapago']."</td><td align='right'>".$m['cantidad']."</td><td></td><td></td><td></td><td></td></tr>";
		$total=$total+$m['cantidad'];
	}
	//abonos facturados
	$q="select * from abonofac where fechapago='".$hoy."' and concepto='Pago en Efectivo' order by id";
	$r=mysql_query($q);
	while($m=mysql_fetch_array($r)){
		echo "<tr><td>".$m['recibide']."</td><td>".$m['id']."</td><td>".$m['numcontrato']."</td><td>".$m['fechapago']."</td><td>".$m['cantidad']."</td><td></td><td></td><td></td><td></td></tr>";
		$total=$total+$m['cantidad'];
	}
	////////////////////////////////////PAGO POR TARJETA
	$q="select * from abono where fechapago='".$hoy."' and concepto='Pago con Tarjeta' order by id";
	$r=mysql_query($q);
	//abonos no facturados
	while($m=mysql_fetch_array($r)){
		echo "<tr><td>".$m['recibide']."</td><td>".$m['id']."</td><td>".$m['numcontrato']."</td><td>".$m['fechapago']."</td><td></td><td>".$m['cantidad']."</td><td></td><td></td><td></td></tr>";
		$total2=$total2+$m['cantidad'];
		cuentas($m['cuenta'],$m['cantidad']);
	}
	//abonos facturados
	$q="select * from abonofac where fechapago='".$hoy."' and concepto='Pago con Tarjeta' order by id";
	$r=mysql_query($q);
	while($m=mysql_fetch_array($r)){
		echo "<tr><td>".$m['recibide']."</td><td>".$m['id']."</td><td>".$m['numcontrato']."</td><td>".$m['fechapago']."</td><td></td><td>".$m['cantidad']."</td><td></td><td></td><td></td></tr>";
		$total2=$total2+$m['cantidad'];
		cuentas($m['cuenta'],$m['cantidad']);
	}
	////////////////////////////////////PAGO POR DEPOSITO
	$q="select * from abono where fechapago='".$hoy."' and concepto='Deposito' order by id";
	$r=mysql_query($q);
	//abonos no facturados
	while($m=mysql_fetch_array($r)){
		echo "<tr><td>".$m['recibide']."</td><td>".$m['id']."</td><td>".$m['numcontrato']."</td><td>".$m['fechapago']."</td><td></td><td></td><td>".$m['cantidad']."</td><td></td><td></td></tr>";
		$total3=$total3+$m['cantidad'];
		cuentas($m['cuenta'],$m['cantidad']);
	}
	//abonos facturados
	$q="select * from abonofac where fechapago='".$hoy."' and concepto='Deposito' order by id";
	$r=mysql_query($q);
	while($m=mysql_fetch_array($r)){
		echo "<tr><td>".$m['recibide']."</td><td>".$m['id']."</td><td>".$m['numcontrato']."</td><td>".$m['fechapago']."</td><td></td><td></td><td>".$m['cantidad']."</td><td></td><td></td></tr>";
		$total3=$total3+$m['cantidad'];
		cuentas($m['cuenta'],$m['cantidad']);
	}
	////////////////////////////////////PAGO POR CHEQUE
	$q="select * from abono where fechapago='".$hoy."' and concepto='Pago con Cheque' order by id";
	$r=mysql_query($q);
	//abonos no facturados
	while($m=mysql_fetch_array($r)){
		echo "<tr><td>".$m['recibide']."</td><td>".$m['id']."</td><td>".$m['numcontrato']."</td><td>".$m['fechapago']."</td><td></td><td></td><td></td><td>".$m['cantidad']."</td><td></td></tr>";
		$total4=$total4+$m['cantidad'];
		cuentas($m['cuenta'],$m['cantidad']);
	}
	//abonos facturados
	$q="select * from abonofac where fechapago='".$hoy."' and concepto='Pago con Cheque' order by id";
	$r=mysql_query($q);
	while($m=mysql_fetch_array($r)){
		echo "<tr><td>".$m['recibide']."</td><td>".$m['id']."</td><td>".$m['numcontrato']."</td><td>".$m['fechapago']."</td><td></td><td></td><td></td><td>".$m['cantidad']."</td><td></td></tr>";
		$total4=$total4+$m['cantidad'];
		cuentas($m['cuenta'],$m['cantidad']);
	}
	////////////////////////////////////PAGO POR Transferencia
	$q="select * from abono where fechapago='".$hoy."' and concepto='Transferencia' order by id";
	$r=mysql_query($q);
	//abonos no facturados
	while($m=mysql_fetch_array($r)){
		echo "<tr><td>".$m['recibide']."</td><td>".$m['id']."</td><td>".$m['numcontrato']."</td><td>".$m['fechapago']."</td><td></td><td></td><td></td><td></td><td>".$m['cantidad']."</td></tr>";
		$total5=$total5+$m['cantidad'];
		cuentas($m['cuenta'],$m['cantidad']);
	}
	//abonos facturados
	$q="select * from abonofac where fechapago='".$hoy."' and concepto='Transferencia' order by id";
	$r=mysql_query($q);
	while($m=mysql_fetch_array($r)){
		echo "<tr><td>".$m['recibide']."</td><td>".$m['id']."</td><td>".$m['numcontrato']."</td><td>".$m['fechapago']."</td><td></td><td></td><td></td><td></td><td>".$m['cantidad']."</td></tr>";
		$total5=$total5+$m['cantidad'];
		cuentas($m['cuenta'],$m['cantidad']);
	}
	echo "<tr><td></td><td></td><td></td><td>Total</td><td>$".$total."</td><td>$".$total2."</td><td>$".$total3."</td><td>$".$total4."</td><td>$".$total5."</td></tr>";
	}
	
	function categorias(){
		$r=mysql_query("select categoria from Gastos_categoria group by categoria order by categoria");
		while($m=mysql_fetch_array($r)){
			$r2=mysql_query("select count(*) as t from Gastos_categoria where sub_categoria!='' and categoria='".$m['categoria']."'");
			$m2=mysql_fetch_array($r2);
			echo "<td colspan='".$m2['t']."' align='center'>".$m['categoria']."</td>";
		}
	
	}
	
	function subcategorias(){
		$r=mysql_query("select categoria from Gastos_categoria group by categoria order by categoria");
		while($m=mysql_fetch_array($r)){
			$r2=mysql_query("select sub_categoria from Gastos_categoria where sub_categoria!='' and categoria='".$m['categoria']."' order by sub_categoria");
			while($m2=mysql_fetch_array($r2)){
				echo "<td>".$m2['sub_categoria']."</td>";
			}
		}
	}
	
	function egresos(){
	global $gastos_efec,$deposito,$cargos;
		$hoy=date('Y-m-d');
		$r=mysql_query("select * from Gastos where fecha='".$hoy."'");
		while($m=mysql_fetch_array($r)){
			echo "<tr>";
			echo "<td>".$m['concepto']."</td>";
			$r2=mysql_query("select categoria from Gastos_categoria group by categoria order by categoria");
			while($m2=mysql_fetch_array($r2)){
				$r3=mysql_query("select sub_categoria from Gastos_categoria where sub_categoria!='' and categoria='".$m2['categoria']."' order by sub_categoria");
				while($m3=mysql_fetch_array($r3)){
					if($m['categoria']==$m2['categoria'] && $m['subcategoria']==$m3['sub_categoria']){
						echo "<td align='right'>".$m['cantidad']."</td>";
					}else{
					echo "<td></td>";
					}
				}
			}
			if($m['subcategoria']=="EFECTIVO"){
				$gastos_efec=$gastos_efec+$m['cantidad'];
			}elseif($m['subcategoria']=="DEPOSITO"){
				$deposito=$deposito+$m['cantidad'];
				cuentas($m['cuenta'],$m['cantidad']);
			}else{
				$cargos=$cargos+$m['cantidad'];
				cuentas_egresos($m['cuenta'],$m['cantidad']);
			}
			echo "</tr>";
		}
		
		echo "<tr>";
		echo "<td>Total</td>";
		$r2=mysql_query("select categoria from Gastos_categoria group by categoria order by categoria");
		while($m2=mysql_fetch_array($r2)){
			$r3=mysql_query("select sub_categoria from Gastos_categoria where sub_categoria!='' and categoria='".$m2['categoria']."' order by sub_categoria");
			while($m3=mysql_fetch_array($r3)){
					$rt=mysql_query("select sum(cantidad) as t from Gastos where fecha='".$hoy."' and categoria='".$m2['categoria']."' and subcategoria='".$m3['sub_categoria']."'");
				$mt=mysql_fetch_array($rt);
				echo "<td align='right'>$".$mt['t']."</td>";
			}
		}
			echo "</tr>";
	
	}
	function saldos(){
	global $efectivo,$tarjetas;
	$efectivo=0;
	$tarjetas=0;
		$hoy= date('Y-m-d');
		$ultima=mysql_query('SELECT MAX( fecha ) as f FROM saldos where fecha<"'.$hoy.'"');
		$ultima_fecha=mysql_fetch_array($ultima);
		$ayer=$ultima_fecha['f'];
		$a=mysql_query("select * from saldos where fecha='".$ayer."'");
		while($m=mysql_fetch_array($a)){
			if($m['tipo']=='EFECTIVO'){
				$efectivo=$m['cantidad'];
			}else{
				$tarjetas=$tarjetas+$m['cantidad'];
			}
		}
		echo "<tr><td>EFECTIVO</td><td>$".$efectivo."</td></tr>";
		echo "<tr><td>TARJETAS</td><td>$".$tarjetas."</td></tr>";
		
	}
	function insertar_saldos(){
	global $ixe,$banamex_villa,$banamex_city,$otro;
	global $ixe2,$banamex_villa2,$banamex_city2,$banamex_puente2,$otro2;
	global $total,$total2,$total3,$total4,$total5,$efectivo,$gastos_efec,$tarjetas,$deposito,$cargos;
	$hoy= date('Y-m-d');
	$e=$efectivo+$total-$gastos_efec;
	$t=$tarjetas+$total2+$total3+$total4+$total5+$deposito-$cargos;
	$c=mysql_query('select count(*) as t from saldos where fecha="'.$hoy.'"');
	$c2=mysql_fetch_array($c);
	if($c2['t']>0){
		$r=mysql_query("UPDATE saldos SET cantidad=".$e." WHERE tipo='EFECTIVO' AND fecha='".$hoy."'");
		$rr=$ixe-$ixe2;
		$r2=mysql_query("UPDATE saldos SET cantidad=".$rr." WHERE tipo='TARJETAS' AND cuenta='ixe fis' AND fecha='".$hoy."'");
		$rr=$banamex_villa-$banamex_villa2;
		$r3=mysql_query("UPDATE saldos SET cantidad=".$rr." WHERE tipo='TARJETAS' AND cuenta='banamex villa' AND fecha='".$hoy."'");
		$rr=$banamex_city-$banamex_city2;
		$r4=mysql_query("UPDATE saldos SET cantidad=".$rr." WHERE tipo='TARJETAS' AND cuenta='banamex tarjeta city' AND fecha='".$hoy."'");
		$rr=$banamex_puente-$banamex_puente2;
		$r5=mysql_query("UPDATE saldos SET cantidad=".$rr." WHERE tipo='TARJETAS' AND cuenta='banamex puente' AND fecha='".$hoy."'");
		$rr=$otro-$otro2;
		$r6=mysql_query("UPDATE saldos SET cantidad=".$rr." WHERE tipo='TARJETAS' AND cuenta='otro' AND fecha='".$hoy."'");
	}else{
		$r=mysql_query("INSERT INTO saldos(tipo,cuenta,cantidad,fecha) values('EFECTIVO','',".$e.",'".$hoy."')");
		$rr=$ixe-$ixe2;
		$r2=mysql_query("INSERT INTO saldos(tipo,cuenta,cantidad,fecha) values('TARJETAS','ixe fis',".$rr.",'".$hoy."')");
		$rr=$banamex_villa-$banamex_villa2;
		$r3=mysql_query("INSERT INTO saldos(tipo,cuenta,cantidad,fecha) values('TARJETAS','banamex villa',".$rr.",'".$hoy."')");
		$rr=$banamex_city-$banamex_city2;
		$r4=mysql_query("INSERT INTO saldos(tipo,cuenta,cantidad,fecha) values('TARJETAS','banamex tarjeta city',".$rr.",'".$hoy."')");
		$rr=$banamex_puente-$banamex_puente2;
		$r5=mysql_query("INSERT INTO saldos(tipo,cuenta,cantidad,fecha) values('TARJETAS','banamex puente',".$rr.",'".$hoy."')");
		$rr=$otro-$otro2;
		$r6=mysql_query("INSERT INTO saldos(tipo,cuenta,cantidad,fecha) values('TARJETAS','otro',".$rr.",'".$hoy."')");
	}
	}
	function mostrar_tarjetas(){
		$hoy= date('Y-m-d');
		$ultima=mysql_query('SELECT MAX( fecha ) as f FROM saldos where fecha<"'.$hoy.'"');
		$ultima_fecha=mysql_fetch_array($ultima);
		$saldo=mysql_query("select * from saldos where fecha='".$hoy."'");
		while($m=mysql_fetch_array($saldo)){
			if($m['tipo']== 'EFECTIVO'){
				
			}else{
			$saldo2=mysql_query("select * from saldos where tipo='".$m['tipo']."' and cuenta='".$m['cuenta']."' and fecha='".$ultima_fecha['f']."'");
				while($m2=mysql_fetch_array($saldo2)){
				echo "<table border='1'>";
					echo "<tr><td colspan='3' align='center'>".$m['cuenta']."</td></tr>";
					echo "<tr><td>Concepto</td><td></td><td></td></tr>";
					echo "<tr><td>Saldo anterior</td><td>$".$m2['cantidad']."</td><td></td></tr>";
					echo "<tr><td>Ingresos</td><td>$".ingresos_tarjetas($m['cuenta'])."</td><td></td></tr>";
					echo "<tr><td>Egresos</td><td></td><td>$".egresos_tarjetas($m['cuenta'])."</td></tr>";
					echo "<tr><td></td><td>Total</td><td>$".total($m['cuenta'],$m2['cantidad'])."</td></tr>";
					echo "<tr></tr>";
					echo "<tr></tr>";
				echo "</table>";
				}
			}
		}
		}
	function ingresos_tarjetas($cuenta){
		global $ixe,$banamex_villa,$banamex_city,$banamex_puente,$otro;
		if($cuenta=='ixe fis'){
			return $ixe;
		}elseif($cuenta=='banamex villa'){
			return $banamex_villa;
		}elseif($cuenta=='banamex tarjeta city'){
			return $banamex_city;
		}elseif($cuenta=='banamex puente'){
			return $banamex_puente;
		}else{
			return $otro;
		}
	}
	function egresos_tarjetas($cuenta){
		global $ixe2,$banamex_villa2,$banamex_city2,$banamex_puente2,$otro2;
		if($cuenta=='ixe fis'){
			return $ixe2;
		}elseif($cuenta=='banamex villa'){
			return $banamex_villa2;
		}elseif($cuenta=='banamex tarjeta city'){
			return $banamex_city2;
		}elseif($cuenta=='banamex puente'){
			return $banamex_puente2;
		}else{
			return $otro2;
		}
	}
	function total($cuenta,$anterior){
		global $ixe,$banamex_villa,$banamex_city,$banamex_puente,$otro;
		global $ixe2,$banamex_villa2,$banamex_city2,$banamex_puente2,$otro2;
		if($cuenta=='ixe fis'){
			return $ixe-$ixe2+$anterior;
		}elseif($cuenta=='banamex villa'){
			return $banamex_villa-$banamex_villa2+$anterior;
		}elseif($cuenta=='banamex tarjeta city'){
			return $banamex_city-$banamex_city2+$anterior;
		}elseif($cuenta=='banamex puente'){
			return $banamex_puente-$banamex_puente2+$anterior;
		}else{
			return $otro-$otro2+$anterior;
		}
	}
	?>
 </head>
<body>
<center>
		<table border='1'>
			<tr><td colspan='2'>Saldos inciales</td></tr>
			<?php saldos();?>
			
		</table>
		<table >
			<tr></tr>
			<tr></tr>
			<tr></tr>
		</table>
		<table border='1'>
			<tr><th colspan='9' align='center'>ABONOS CONTRATOS</th></tr>
			<tr align='center'><th>Concepto</th><th>Recibo</th><th>Contrato</th><th>Fecha</th><th>Efectivo</th><th>Tarjeta</th><th>Deposito</th><th>Cheque</th><th>Transferencia</th></tr>
			<?php ingresos(); ?>
		</table>
		<table >
			<tr></tr>
			<tr></tr>
			<tr></tr>
		</table>
		<tr><td>GASTOS</td></tr>
		<table border='1'>
			<tr><td rowspan='2'>CONCEPTO</td><?php categorias();?></tr>
			<tr><?php subcategorias();?></tr>
			<?php egresos();?>
		</table>
		<table >
			<tr></tr>
			<tr></tr>
			<tr></tr>
		</table>
		<table border='1'>
			<tr><td colspan='2'>Saldos Finales</td></tr>
			<tr><td>Efectivo</td><td>$<?php echo $efectivo+$total-$gastos_efec;?></td></tr>
			<tr><td>Tarjetas</td><td>$<?php echo $tarjetas+$total2+$total3+$total4+$total5+$deposito-$cargos; ?></td></tr>
			<?php insertar_saldos(); ?>
		</table>
		<table >
			<tr></tr>
			<tr></tr>
			<tr></tr>
		</table>
		<table>
			<tr><th colspan='4' align='center'>Tarjetas</th></tr>
		</table>
		<?php mostrar_tarjetas(); ?>
		</center>
	</body>
</html>
