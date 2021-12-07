<html>
<head>
	<style>
		progress {
			width: 500px;
			height: 20px;
			margin-top: 50px;
			/* Important Thing */
			-webkit-appearance: none;
			border: none;
		}

		/* All good till now. Now we'll style the background */
		progress::-webkit-progress-bar {
			background: black;
			border-radius: 50px;
			padding: 2px;
			box-shadow: 0 1px 0px 0 rgba(255, 255, 255, 0.2);
		}

		/* Now the value part */
		progress::-webkit-progress-value {
			border-radius: 50px;
			box-shadow: inset 0 1px 1px 0 rgba(255, 255, 255, 0.4);
			background:
				-webkit-linear-gradient(45deg, transparent, transparent 33%, rgba(0, 0, 0, 0.1) 33%, rgba(0, 0, 0, 0.1) 66%, transparent 66%),
				-webkit-linear-gradient(top, rgba(255, 255, 255, 0.25), rgba(0, 0, 0, 0.2)),
				-webkit-linear-gradient(left, #ba7448, #c4672d);
			
			/* Looks great, now animating it */
			background-size: 25px 14px, 100% 100%, 100% 100%;
			-webkit-animation: move 5s linear 0 infinite;
		}

		/* That's it! Now let's try creating a new stripe pattern and animate it using animation and keyframes properties  */

		@-webkit-keyframes move {
			0% {background-position: 0px 0px, 0 0, 0 0}
			100% {background-position: -100px 0px, 0 0, 0 0}
		}
		#box{
			color:#000;
			width: 100px;
			height: 120px;
			margin-top: 15px;
			padding-top: 15px;
			margin-left: 15px;
			float: left;
			background-color: rgba(43, 132, 255, 0.6);
			background: rgba(43, 132, 255, 0.6);
			
		}
		#box2{
			color:#000;
			width: 100px;
			height: 120px;
			margin-top: 15px;
			padding-top: 15px;
			margin-left: 15px;
			float: left;
			background-color: rgba(222, 150, 69, 1);
			background: rgba(222, 150, 69, 1);
			
		}
		#box3{
			color:#000;
			width: 100px;
			height: 120px;
			margin-top: 15px;
			padding-top: 15px;
			margin-left: 15px;
			float: left;
			background-color: rgba(255, 37, 24, 0.8);
			background: rgba(255, 37, 24, 0.8);
		}
		#box4{
			color:#000;
			width: 100px;
			height: 120px;
			margin-top: 15px;
			padding-top: 15px;
			margin-left: 15px;
			float: left;
			background-color: rgba(87, 192, 65, 0.6);
			background: rgba(87, 192, 65, 0.6);
		}
		#scroll {
			width: 500px;
			height: 250px;
			overflow-y: scroll;
		}
	</style>
</head>
<body>
<center>
<?php
require 'funciones2.php';
conectar();
global $ultima_fecha,$abono_ideal;
$numero=$_GET['num'];///----------------------------------------------------------------------variable que se trae para sacar informacin
$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
$m=mysql_fetch_array($q);
$q_sub=mysql_query('Select count(*) as t from subcontratos where numero like "'.$numero.'%"');
$m_sub=mysql_fetch_array($q_sub);

echo "<br>Numero :".$m['Numero']."<br>Nombre :".$m['nombre']."<br>";
//echo "Saldo inicial: $".$m['si']."<br>";
echo "Fecha del Evento: ".$m['Fecha']."<br>";
	//////////////////// barra porcentual de avance de los abonos contra saldo inicial
	$gral=mysql_query("select count(*) as t from contrato where Numero like '".$numero."-%'");
	$gral_m=mysql_fetch_array($gral);
	if($gral_m['t']==0){///validamos si es un contato sin subcontratos
		echo "Saldo inicial: $".saldoi($numero)."<br>";
		echo "<progress align='left' value='".abono($numero)."' max='".saldoi($numero)."'> </progress><strong style='font-size:30px;'>".porcentaje($numero)."</strong>";
	}else{
		echo "Saldo inicial: $".$m['si']."<br>";
		echo "<progress align='left' value='".abono2($numero)."' max='".saldoi2($numero)."'> </progress><strong style='font-size:30px;'>".porcentaje2($numero)."</strong>";
	}
	
	
	/////////////////VALIDADMOS SI ES SUB-CONTRATO/////////////////
	if(subcontrato($numero)){
		$q2=mysql_query('select * from subcontratos where numero="'.$numero.'"');
		$m2=mysql_fetch_array($q2);

		if($m2['fechas']!=''){////verificamos que tenga fechas
			echo "<div id='scroll'>";
			echo "<strong>Pago Ideal<strong><br>";
			idealsub1($numero);
			echo "</div>";
			echo "<div id='scroll'>";
			echo "<strong>Reajuste de Pago<strong><br>";
			reajustesub1($numero);
			echo "</div>";
		}else{
		echo "<div id='scroll'>";
		echo "<strong>Pago Ideal<strong><br>";
			idealsub2($numero);
			echo "</div>";
			echo "<div id='scroll'>";
			echo "<strong>Reajuste de Pago<strong><br>ERROR NO SE CUENTAN CON LAS FECHAS DE ABONOS";
			echo "</div>";
		}
	}elseif($m_sub['t']>0){////////////////////si es un contrato gral solo muestra porcentual
	
	
	
	}else{
		if($m['fechas']!=''){////verificamos que tenga fechas
		echo "<div id='scroll'>";
		echo "<strong>Pago Ideal<strong><br>";
			idealcontrato1($numero);
			echo "</div>";
			echo "<div id='scroll'>";
			echo "<strong>Reajuste de Pago<strong><br>";
			reajustecontrato1($numero);
			echo "</div>";
		}else{
		echo "<div id='scroll'>";
		echo "<strong>Pago Ideal<strong><br>";
			idealcontrato2($numero);
			echo "</div>";
			echo "<div id='scroll'>";
			echo "<strong>Reajuste de Pago<strong><br>ERROR NO SE CUENTAN CON LAS FECHAS DE ABONOS";
			echo "</div>";
		}
	}

/////////////////////////////////Funciones//////////////////////	

//validacion de subcontrato
	function subcontrato($numero){
		$c=explode('-',$numero);//arreglo separado por '-' 
		if(count($c)==1){//regresamos falso si es contrato
			$r=false;
		}else{//regresamos tre si es subcontrato
			$r=true;
		}
		return $r;
	}
//total de abonos correspondiente al contrato o subcontrato
	function abono($numero){
		$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
		$m=mysql_fetch_array($q);
		if($m['facturado']=='si'){
				$preabonos="select sum(cantidad) as t from abonofac where numcontrato='".$numero."'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}else{
				$preabonos="select sum(cantidad) as t from abono where numcontrato='".$numero."'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}
			return $total_abonos['t'];
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
	
//calculo del porcentaje de los abonos vs saldo inicial
	function porcentaje($numero){
		$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
		$m=mysql_fetch_array($q);
		if($m['facturado']=='si'){
				$preabonos="select sum(cantidad) as t from abonofac where numcontrato='".$numero."'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}else{
				$preabonos="select sum(cantidad) as t from abono where numcontrato='".$numero."'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}
			$p=($total_abonos['t']/saldoi($numero))*100;
			echo round($p,2)."%";
	}
	//total de abonos correspondiente al contrato o subcontrato
	function abono2($numero){
		$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
		$m=mysql_fetch_array($q);
		if($m['facturado']=='si'){
				$preabonos="select sum(cantidad) as t from abonofac where numcontrato like '".$numero."-%'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}else{
				$preabonos="select sum(cantidad) as t from abono where numcontrato like '".$numero."-%'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}
			return $total_abonos['t'];
	}
//saldo inicial del subcontrato o contrato
	function saldoi2($numero){
		$q=mysql_query('Select sum(si) as t from contrato where Numero like "'.$numero.'-%"');
		$m=mysql_fetch_array($q);
		return $m['t'];
	}
	
//calculo del porcentaje de los abonos vs saldo inicial
	function porcentaje2($numero){
		$q=mysql_query('Select sum(si) as t from contrato where Numero like "'.$numero.'-%"');
		$m=mysql_fetch_array($q);
		if($m['facturado']=='si'){
				$preabonos="select sum(cantidad) as t from abonofac where numcontrato like '".$numero."-%'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}else{
				$preabonos="select sum(cantidad) as t from abono where numcontrato like '".$numero."-%'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}
			$p=($total_abonos['t']/$m['t'])*100;
			echo round($p,2)."%";
	}
	/////////PAGO IDEAL DE SUBCONTRATOS CON FECHAS
	function idealsub1($numero){
		global $abono_ideal;
		$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
		$m=mysql_fetch_array($q);
		
		$q2=mysql_query('Select * from subcontratos where numero="'.$numero.'"');
		$m2=mysql_fetch_array($q2);
		
		$fechas=explode('%',$m2['fechas']);
		$pagos=saldoi($numero)/(count($fechas)-1);
		echo "<center><div id='scrolly'>";
		for($i = 0; $i < count($fechas)-1 ; $i++){
			echo "<div id='box'>";
				echo "Fecha:<br>".$fechas[$i]."<br><br>";
				echo "Monto:<br>$".round($pagos,2)."<br>";
			echo "</div>";
		}
		echo "</div></center>";
		$abono_ideal=round($pagos,2);
	}
	////////pago idela de subcontratos sin fechas
		function idealsub2($numero){
		global $ultima_fecha,$abono_ideal;
		$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
		$m=mysql_fetch_array($q);
	
		$q2=mysql_query('Select * from subcontratos where numero="'.$numero.'"');
		$m2=mysql_fetch_array($q2);
	
		$cantidad_abonos=n_meses($m2['fechaimp'],$m['Fecha']);
		$fecha=$m2['fechaimp'];
		$pagos=saldoi($numero)/($cantidad_abonos);
		echo "<center><div id='scrolly'>";
		for($i = 0; $i < $cantidad_abonos ; $i++){
		$nuevafecha = strtotime ( '+30day' , strtotime ( $fecha ) ) ;
		$fecha=date ( 'Y-m-j' , $nuevafecha );
			echo "<div id='box'>";
				echo "Fecha:<br>".$fecha."<br><br>";
				echo "Monto:<br>$".round($pagos,2)."<br>";
			echo "</div>";
		}
		echo "</div></center>";
		$abono_ideal=round($pagos,2);
	}
	function n_meses($imp,$fecha){
	$c=0;
	global $ultima_fecha;
	//debe de estar pagado un mes antes
	$nuevafecha = strtotime ( '-30day' , strtotime ( $fecha ) ) ;
	$fecha=date ( 'Y-m-d' , $nuevafecha );
	while($imp<$fecha){
		$nuevafecha = strtotime ( '-30day' , strtotime ( $fecha ) ) ;
		$fecha=date ( 'Y-m-d' , $nuevafecha );
		$ultima_fecha=$fecha;
		$c++;
	}
	if($c==0){
		$c=1;
	}
	return $c;
	}
	//////////////////pagos ideal para contrato con fechas////////// 
	
	function idealcontrato1($numero){
		global $abono_ideal;
		$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
		$m=mysql_fetch_array($q);
		
		$fechas=explode('%',$m['fechas']);
		$conceptos=explode('%',$m['concepto']);
		$montos=explode('%',$m['monto']);
		echo "<center><div id='scrolly'>";
		for($i = 0; $i < count($fechas)-1 ; $i++){
			echo "<div id='box'>";
				echo "Fecha:<br>".$fechas[$i]."<br>";
				echo "Concepto:<br>".$conceptos[$i]."<br>";
				echo "Monto:<br>$".$montos[$i]."<br>";
			echo "</div>";
		}
		echo "</div></center>";
		$abono_ideal=round($pagos,2);
	}
	//////////// pago ideal para contratos sin fechas
		function idealcontrato2($numero){
		global $ultima_fecha,$abono_ideal;
		$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
		$m=mysql_fetch_array($q);
		$cantidad_abonos=num_meses($numero);
		$fecha=$ultima_fecha;
		$pagos=saldoi($numero)/($cantidad_abonos);
		echo "<center><div id='scrolly'>";
		for($i = 0; $i < $cantidad_abonos ; $i++){
		$nuevafecha = strtotime ( '+30day' , strtotime ( $fecha ) ) ;
		$fecha=date ( 'Y-m-j' , $nuevafecha );
			echo "<div id='box'>";
				echo "Fecha:<br>".$fecha."<br><br>";
				echo "Monto:<br>$".round($pagos,2)."<br>";
			echo "</div>";
		}
		echo "</div></center>";
		$abono_ideal=round($pagos,2);
	}
	
	function num_meses($numero){
		global $ultima_fecha;
		$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
		$m=mysql_fetch_array($q);
		$nuevafecha = strtotime ( '-30day' , strtotime ( $m['Fecha'] ) ) ;
		$fecha=date ( 'Y-m-d' , $nuevafecha );
		$i=0;
		$hoy=date('Y-m-d');
		while($hoy<$fecha){
			$nuevafecha = strtotime ( '-30day' , strtotime ( $fecha) ) ;
			$fecha=date ( 'Y-m-d' , $nuevafecha );
			$i++;
			$ultima_fecha=$fecha;
		}
		return $i;
	}
	
	////////////////reajuste a subcontratos con fecha
	function reajustesub1($numero){
	global $abono_ideal;
	$q='select * from subcontratos where numero="'.$numero.'"';
	$r=mysql_query($q);
	$m=mysql_fetch_array($r);
	$hoy=date('Y-m-d');
	$ultimo_abono=ultimo_abono($numero);
	$fechas=arreglo($m['fechas']);
	$i=0;$aux=0;
		while($i<count($fechas)-1){
			if($fechas[$i]>=$hoy){////////fechas futuras
				if($aux==0){
					$x_anterior=round(suma_de_abonos($numero,date('Y-m-d'),2));
					$afa=round(suma_de_abonos($numero,$fechas[$i-1],2));
					$abono_ideal=(saldoi($numero)-$x_anterior)/(count($fechas)-($i+1));
					$aux=1;
				}
				echo "<div id='box4'>";
				echo "Fecha:<br>".$fechas[$i]."<br>";
				echo "Montos:<br>$".round($abono_ideal,2)."<br>";
				if($aux==1 && $x_anterior-$afa>0){
					echo "Pagado:<br>$".($x_anterior-$afa)."<br>";
					$aux++;
				}
				echo "</div>";
			}else{/////////fechas menores o iguales a hoy
				if(($i-1)>=0){/////////verificamos si existe la posicion de arreglo anterior
					if($ultimo_abono <= $fechas[$i-1]){
						echo "<div id='box3'>";
						echo "Fecha:<br>".$fechas[$i]."<br><br>";
						echo "Monto:<br>$".round($abono_ideal,2)."<br>";
						echo "</div>";
						//$alerta='update contrato set alerta=1 where Numero="'.$numero.'"';
						//echo $alerta;
						//$alert=mysql_query($alerta);
						break;
					}else{
						//$abono_ideal=(saldoi($numero)-abono($numero))/(count($fechas)-($i+1));
						echo "<div id='box'>";
						echo "Fecha:<br>".$fechas[$i]."<br><br>";
						$x_anterior=round(suma_de_abonos($numero,$fechas[$i-1],2));
						$x=round(suma_de_abonos($numero,$fechas[$i]),2);
						$result=$x-$x_anterior;
						echo "Monto:<br>$".$result."<br>";
						echo "</div>";
						$abono_ideal=(saldoi($numero)-abono($numero))/(count($fechas)-($i+2));
					}
				}else{
					echo "<div id='box'>";
					echo "Fecha:<br>".$fechas[$i]."<br><br>";
					$x=round(suma_de_abonos($numero,$fechas[$i]),2);
					echo "Monto:<br>$".$x."<br>";
					echo "</div>";
					$abono_ideal=(saldoi($numero)-$x)/(count($fechas)-($i+2));
				}
			}
			$i++;
		}
	}
	
	function arreglo($f){
		$fechas=explode("%",$f);
		return $fechas;
	}
	function ultimo_abono($numero){
	$datos="select facturado from contrato where Numero='".$numero."'";
	$datosr=mysql_query($datos);
	$datos_m=mysql_fetch_array($datosr);
	
	if($datos_m['facturado']=='si'){
		$q="select max(fechapago) as f from abonofac where numcontrato='".$numero."'";
	}else{
		$q="select max(fechapago) as f from abono where numcontrato='".$numero."'";
	}
	
	$r=mysql_query($q);
	$m=mysql_fetch_array($r);
	return $m['f'];
	}
	
	function suma_de_abonos($numero,$f){
		$datos="select * from contrato where Numero='".$numero."'";
		$datosr=mysql_query($datos);
		$datos_m=mysql_fetch_array($datosr);
				
		if($datos_m['facturado']=='si'){
			$q="select sum(cantidad) as c from abonofac where numcontrato='".$numero."' and fechapago<='".$f."'";
		}else{
			$q="select sum(cantidad) as c from abono where numcontrato='".$numero."' and fechapago<='".$f."'";
		}
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		return $m['c'];
	}
	
	function suma_de_abonos2($numero,$fl,$fi){
	$datos="select * from contrato where Numero='".$numero."'";
		$datosr=mysql_query($datos);
		$datos_m=mysql_fetch_array($datosr);
				
		if($datos_m['facturado']=='si'){
			$q="select sum(cantidad) as c from abonofac where numcontrato='".$numero."' and fechapago<='".$fl."' and fechapago>'".$fi."'";
		}else{
			$q="select sum(cantidad) as c from abono where numcontrato='".$numero."' and fechapago<='".$fl."' and fechapago>'".$fi."'";
		}
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		return $m['c'];
	
	
	}
	
	
	//////////////////////////reajuste de contratos con fechas
	
	function reajustecontrato1($numero){
	$q='select * from contrato where Numero="'.$numero.'"';
	$r=mysql_query($q);
	$m=mysql_fetch_array($r);
	$hoy=date('Y-m-d');
	$ultimo_abono=ultimo_abono($numero);
	$fechas=arreglo($m['fechas']);
	$concepto=explode('%',$m['concepto']);
	$monto=explode('%',$m['monto']);
	$total_teorico=0;$faltante=0;
	$abono_ideal=$monto[0];
	$i=0;
		while($i<count($fechas)-1){
		$total_teorico=$total_teorico+$monto[$i];
		$abono_ideal=($monto[$i]+$faltante);
			if($fechas[$i]>=$hoy){////////fechas futuras
				$x_anterior=round(suma_de_abonos($numero,$fechas[$i-1],2));
				$x=round(suma_de_abonos($numero,$fechas[$i]),2);
				$result=$x-$x_anterior;
				echo "<div id='box4'>";
					echo "Fecha:<br>".$fechas[$i]."<br>";
					echo "concepto:<br>".$concepto[$i]."<br>";
					echo "Monto:<br>$".round(($abono_ideal-$result),2)."<br>";
				echo "</div>";
				if(($abono_ideal-$result)<0){
					$faltante=($total_teorico-$x)/(count($fechas)-($i+2));
				}
				
			}else{/////////fechas menores o iguales a hoy
				if(($i-1)>=0){/////////verificamos si existe la posicion de arreglo anterior
					if($ultimo_abono <= $fechas[$i-1]){
						echo "<div id='box3'>";
						echo "Fecha:<br>".$fechas[$i]."<br>";
						echo "concepto:<br>".$concepto[$i]."<br>";
						echo "Monto:<br>$".round($abono_ideal,2)."<br>";
						echo "</div>";
					}else{
						echo "<div id='box'>";
						echo "Fecha:<br>".$fechas[$i]."<br>";
						$x_anterior=round(suma_de_abonos($numero,$fechas[$i-1],2));
						$x=round(suma_de_abonos($numero,$fechas[$i]),2);
						$result=$x-$x_anterior;
						echo "concepto:<br>".$concepto[$i]."<br>";
						echo "Monto:<br>$".$result."<br>";
						echo "</div>";
						$faltante=($total_teorico-$x)/(count($fechas)-($i+2));
					}
				}else{
					echo "<div id='box'>";
					echo "Fecha:<br>".$fechas[$i]."<br>";
					$x=round(suma_de_abonos($numero,$fechas[$i]),2);
					echo "concepto:<br>".$concepto[$i]."<br>";
					echo "Monto:<br>$".$x."<br>";
					echo "</div>";
					$faltante=($total_teorico-$x)/(count($fechas)-($i+2));	
				}
			}
			$i++;
		}
	}
	///////////////////////////////contratos o subcontratos sin fecha
	function reajuste_sin_fechas($numero){
	$q='select * from contrato where Numero="'.$numero.'"';
	$r=mysql_query($q);
	$m=mysql_fetch_array($r);
	$fecha=date('Y-m-d');
	$cantidad=numero_de_meses($fecha,$m['Fecha'])+1;
	$abono=(saldoi($numero)-abono($numero))/$cantidad;
	$ultimo_abono=ultimo_abono($numero);
	$f1 = strtotime ( '-30day' , strtotime ( date('Y-m-d') ) ) ;
	$f2=date('Y-m-d',$f1);
	while($i<=$cantidad){
		if($ultimo_abono<=$f2){
			echo "<div id='box3'>";
			echo "Fecha:<br>".$fecha."<br>";
			echo "Monto:<br>$".round($abono,2)."<br>";
			echo "</div>";
		}else{
			echo "<div id='box4'>";
			echo "Fecha:<br>".$fecha."<br>";
			echo "Monto:<br>$".round($abono,2)."<br>";
			echo "</div>";
		}
		$fechalimite = strtotime ( '+30day' , strtotime ( $fecha ) ) ;
		$fecha=date('Y-m-d',$fechalimite);
		$i++;
	}
	
	}
?>
</center>
</body>
</html>