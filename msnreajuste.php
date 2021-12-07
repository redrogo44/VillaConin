<?php
require("funciones2.php");
conectar();
function principal($numero){
		$msj='';
		global $ultima_fecha,$abono_ideal;
		//$numero=$_GET['num'];///----------------------------------------------------------------------variable que se trae para sacar informacin
		$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
		$m=mysql_fetch_array($q);
		$q_sub=mysql_query('Select count(*) as t from subcontratos where numero like "'.$numero.'%"');
		$m_sub=mysql_fetch_array($q_sub);
		$msj=$msj.'<table>';
		$msj=$msj."<tr><td>Numero</td><td>".$m['Numero']."</td></tr>";
		$msj=$msj."<tr><td>Nombre</td><td>".$m['nombre']."</td></tr>";
		$msj=$msj."<tr><td>Saldo inicial</td><td>$".$m['si']."</td></tr>";
		$msj=$msj."<tr><td>Cargos </td><td>$".cargo($m['Numero'])."</td></tr>";
		$msj=$msj."<tr><td>Fecha del Evento </td><td>".$m['Fecha']."</td></tr>";		
		
			$sentencia="select max(id) as d from Cancelaciones";
			$sentencia2=mysql_query($sentencia);
			$sentencia3=mysql_fetch_array($sentencia2);
			$abono_c="select * from Cancelaciones where id=".$sentencia3['d'];
			$abono_c2=mysql_query($abono_c);
			$cancelado=mysql_fetch_array($abono_c2);
		

		$msj=$msj."<tr><td >Monto del abono  cancelado</td><td>$".$cancelado['cantidad']."</td></tr>";	
		$msj=$msj.'</table><br><br>';
	//////////////////// barra porcentual de avance de los abonos contra saldo inicial
			$gral=mysql_query("select count(*) as t from contrato where Numero like '".$numero."-%'");
			$gral_m=mysql_fetch_array($gral);
			if($gral_m['t']==0){///validamos si es un contato sin subcontratos
				$msj=$msj."Total a pagar: $".saldoi($numero)."<br>";
				$porc=porcentaje($numero);
				$msj=$msj."<progress align='left' value='".abono($numero)."' max='".saldoi($numero)."'> </progress><strong style='font-size:30px;'>".$porc."</strong>";
			}else{
				$msj=$msj."Total a pagar: $".$m['si']."<br>";
				$porc=porcentaje2($numero);
				$msj=$msj."<progress align='left' value='".abono2($numero)."' max='".saldoi2($numero)."'> </progress><strong style='font-size:30px;'>".$porc."</strong>";
			}
			
			/////////////////VALIDADMOS SI ES SUB-CONTRATO/////////////////
			if(subcontrato($numero)){
				$q2=mysql_query('select * from subcontratos where numero="'.$numero.'"');
				$m2=mysql_fetch_array($q2);

				if($m2['fechas']!=''){////verificamos que tenga fechas
					$msj=$msj."<div id='scroll'>";
					$msj=$msj."<strong>Pago Ideal<strong><br>";
					$msj=$msj.idealsub1($numero);
					$msj=$msj."</div>";
					$msj=$msj."<div id='scroll'>";
					$msj=$msj."<strong>Reajuste de Pago<strong><br>";
					$msj=$msj.reajustesub1($numero);
					$msj=$msj."</div>";
				}else{
				$msj=$msj."<div id='scroll'>";
				$msj=$msj."<strong>Pago Ideal<strong><br>";
					$msj=$msj.idealsub2($numero);
					$msj=$msj."</div>";
					$msj=$msj."<div id='scroll'>";
					$msj=$msj."<strong>Reajuste de Pago<strong><br>ERROR NO SE CUENTAN CON LAS FECHAS DE ABONOS";
					$msj=$msj."</div>";
				}
			}elseif($m_sub['t']>0){////////////////////si es un contrato gral solo muestra porcentual
			
			
			
			}else{
				if($m['fechas']!=''){////verificamos que tenga fechas
				$msj=$msj."<div id='scroll'>";
				$msj=$msj."<strong>Pago Ideal<strong><br>";
					$msj=$msj.idealcontrato1($numero);
					$msj=$msj."</div>";
					$msj=$msj."<div id='scroll'>";
					$msj=$msj."<strong>Pagos Cubiertos<strong><br>";
					$msj=$msj.reajustecontrato1($numero);
					$msj=$msj."</div>";
				}else{
				$msj=$msj."<div id='scroll'>";
				$msj=$msj."<strong>Pago Ideal<strong><br>";
					idealcontrato2($numero);
					$msj=$msj."</div>";
					$msj=$msj."<div id='scroll'>";
					$msj=$msj."<strong>Reajuste de Pago<strong><br>ERROR NO SE CUENTAN CON LAS FECHAS DE ABONOS";
					$msj=$msj."</div>";
				}
			}

			return $msj;
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
			return round($p,2)."%";
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
			return round($p,2)."%";
	}
	/////////PAGO IDEAL DE SUBCONTRATOS CON FECHAS
	function idealsub1($numero){
		global $abono_ideal;
		$msj='';
		$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
		$m=mysql_fetch_array($q);
		
		$q2=mysql_query('Select * from subcontratos where numero="'.$numero.'"');
		$m2=mysql_fetch_array($q2);
		
		$fechas=explode('%',$m2['fechas']);
		$pagos=saldoi($numero)/(count($fechas)-1);
		$msj=$msj."<center><table><tr>";
		for($i = 0; $i < count($fechas)-1 ; $i++){
			$msj=$msj."<td style='background:#99FF99;'>";
				$msj=$msj."Fecha:<br>".$fechas[$i]."<br><br>";
				$msj=$msj."Monto:<br>$".round($pagos,2)."<br>";
			$msj=$msj."</td>";
		}
		$msj=$msj."</tr></table></center>";
		$abono_ideal=round($pagos,2);
		return $msj;
	}
	////////pago idela de subcontratos sin fechas
		function idealsub2($numero){
		$msj='';
		global $ultima_fecha,$abono_ideal;
		$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
		$m=mysql_fetch_array($q);
	
		$q2=mysql_query('Select * from subcontratos where numero="'.$numero.'"');
		$m2=mysql_fetch_array($q2);
	
		$cantidad_abonos=n_meses($m2['fechaimp'],$m['Fecha']);
		$fecha=$m2['fechaimp'];
		$pagos=saldoi($numero)/($cantidad_abonos);
		$msj=$msj."<center><div id='scrolly'>";
		for($i = 0; $i < $cantidad_abonos ; $i++){
		$nuevafecha = strtotime ( '+30day' , strtotime ( $fecha ) ) ;
		$fecha=date ( 'Y-m-j' , $nuevafecha );
			$msj=$msj."<div id='box'>";
				$msj=$msj."Fecha:<br>".$fecha."<br><br>";
				$msj=$msj."Monto:<br>$".round($pagos,2)."<br>";
			$msj=$msj."</div>";
		}
		$msj=$msj."</div></center>";
		$abono_ideal=round($pagos,2);
		return $msj;
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
		$msj='';
		global $abono_ideal;
		$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
		$m=mysql_fetch_array($q);
		$fechas=explode('%',$m['fechas']);
		$conceptos=explode('%',$m['concepto']);
		$montos=explode('%',$m['monto']);
		$msj=$msj."<center><table><tr>";
		for($i = 0; $i < count($fechas)-1 ; $i++){
			$msj=$msj. "<td style='background:#99FF99;'>";
				$msj=$msj."Fecha:<br>".$fechas[$i]."<br>";
				$msj=$msj."Concepto:<br>".$conceptos[$i]."<br>";
				$msj=$msj."Monto:<br>$".$montos[$i]."<br>";
			$msj=$msj. "</td>";
		}
		$var=cargo($m['Numero']);
		if($var>0){
			$msj=$msj. "<td style='background:#99FF99;'>";
				$msj=$msj."Fecha:<br>".$fechas[count($fechas)-2]."<br>";
				$msj=$msj."Concepto:<br>Cargos<br>";
				$msj=$msj."Monto:<br>$".$var."<br>";
			$msj=$msj. "</td>";
		}
		$msj=$msj."</tr></table></center>";
		$abono_ideal=round($pagos,2);
		return $msj;
	}
	//////////// pago ideal para contratos sin fechas
		function idealcontrato2($numero){
		global $ultima_fecha,$abono_ideal;
		$q=mysql_query('Select * from contrato where Numero="'.$numero.'"');
		$m=mysql_fetch_array($q);
		$cantidad_abonos=num_meses($numero);
		$fecha=$ultima_fecha;
		$pagos=saldoi($numero)/($cantidad_abonos);
		$msj=$msj."<center><div id='scrolly'>";
		for($i = 0; $i < $cantidad_abonos ; $i++){
		$nuevafecha = strtotime ( '+30day' , strtotime ( $fecha ) ) ;
		$fecha=date ( 'Y-m-j' , $nuevafecha );
			$msj=$msj."<div id='box'>";
				$msj=$msj."Fecha:<br>".$fecha."<br><br>";
				$msj=$msj."Monto:<br>$".round($pagos,2)."<br>";
			$msj=$msj."</div>";
		}
		$msj=$msj."</div></center>";
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
	$msj='';
	global $abono_ideal;
	$q='select * from subcontratos where numero="'.$numero.'"';
	$r=mysql_query($q);
	$m=mysql_fetch_array($r);
	$hoy=date('Y-m-d');
	$ultimo_abono=ultimo_abono($numero);
	$fechas=arreglo($m['fechas']);
	$i=0;$aux=0;
	$msj=$msj."<table><tr>";
		while($i<count($fechas)-1){
			if($fechas[$i]>=$hoy){////////fechas futuras
				if($aux==0){
					$x_anterior=round(suma_de_abonos($numero,date('Y-m-d'),2));
					$afa=round(suma_de_abonos($numero,$fechas[$i-1],2));
					$abono_ideal=(saldoi($numero)-$x_anterior)/(count($fechas)-($i+1));
					$aux=1;
				}
				$msj=$msj."<td width='60px'>";
				$msj=$msj."Fecha:<br>".$fechas[$i]."<br>";
				$msj=$msj."Montos:<br>$".round($abono_ideal,2)."<br>";
				if($aux==1 && $x_anterior-$afa>0){
					$msj=$msj."Pagado:<br>$".($x_anterior-$afa)."<br>";
					$aux++;
				}
				$msj=$msj."</td>";
			}else{/////////fechas menores o iguales a hoy
				if(($i-1)>=0){/////////verificamos si existe la posicion de arreglo anterior
					if($ultimo_abono <= $fechas[$i-1]){
						$msj=$msj."<td style='background:#FFCC99; width='60px'>";
						$msj=$msj."Fecha:<br>".$fechas[$i]."<br>";
						$msj=$msj."Monto:<br>$".round($abono_ideal,2)."<br>";
						$msj=$msj."</td>";
					}else{
						//$abono_ideal=(saldoi($numero)-abono($numero))/(count($fechas)-($i+1));
						$msj=$msj."<td style='background:#99FF99;' width='60px'>";
						$msj=$msj."Fecha:<br>".$fechas[$i]."<br>";
						$x_anterior=round(suma_de_abonos($numero,$fechas[$i-1],2));
						$x=round(suma_de_abonos($numero,$fechas[$i]),2);
						$result=$x-$x_anterior;
						$msj=$msj."Monto:<br>$".$result."<br>";
						$msj=$msj."</td>";
						$abono_ideal=(saldoi($numero)-abono($numero))/(count($fechas)-($i+2));
					}
				}else{
					$msj=$msj."<td style='background:#99FF99;' width='60px'>";
					$msj=$msj."Fecha:<br>".$fechas[$i]."<br>";
					$x=round(suma_de_abonos($numero,$fechas[$i]),2);
					$msj=$msj."Monto:<br>$".$x."<br>";
					$msj=$msj."</td>";
					$abono_ideal=(saldoi($numero)-$x)/(count($fechas)-($i+2));
				}
			}
			$i++;
		}
		$msj=$msj."</tr></table>";
		return $msj;
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
	$msj='';
	$q='select * from contrato where Numero="'.$numero.'"';
	$r=mysql_query($q);
	$m=mysql_fetch_array($r);
	$fechas=arreglo($m['fechas']);
	$concepto=explode('%',$m['concepto']);
	$monto=explode('%',$m['monto']);
	$total_abonos=abono($m['Numero']);
	$cargo=cargo($numero);
	$i=0;
	$hoy=date('Y-m-d');
	$msj=$msj."<table><tr>";
		while($i<count($fechas)-1){
			$monto[$i]=$monto[$i];
			if($fechas[$i]>=$hoy){////////fechas futuras
				if($total_abonos>0){
					$msj=$msj."<td>";
					$msj=$msj."Fecha:<br>".$fechas[$i]."<br>";
					$msj=$msj."concepto:<br>".$concepto[$i]."<br>";
					if($total_abonos < $monto[$i]){
						$extra=$monto[$i]-$total_abonos;
						$msj=$msj."Monto:<br>$".round($extra,2)."<br>";
						$msj=$msj."Pagado:<br>$".round($total_abonos,2)."<br>";
						$msj=$msj."</td>";
						$total_abonos=$total_abonos-$monto[$i];
					}else{
						$msj=$msj."Monto:<br>$".round($monto[$i],2)."<br>";
						$msj=$msj."Pagado:<br>$".round($monto[$i],2)."<br>";
						$msj=$msj."</td>";
						$total_abonos=$total_abonos-$monto[$i];
					}
				}else{
					$msj=$msj."<td>";
					$msj=$msj."Fecha:<br>".$fechas[$i]."<br>";
					$msj=$msj."concepto:<br>".$concepto[$i]."<br>";
					$msj=$msj."Monto:<br>$".round($monto[$i],2)."<br>";
					$msj=$msj."</td>";
				}
			}else{/////////fechas menores o iguales a hoy
					if($total_abonos < $monto[$i]){
						$msj=$msj."<td style='background:#FFCC99;'>";
						$msj=$msj."Fecha:<br>".$fechas[$i]."<br>";
						$msj=$msj."concepto:<br>".$concepto[$i]."<br>";
						if($jj!==1){
							$faltante=$monto[$i]-$total_abonos;
							$msj=$msj."Faltante:<br>$".round($faltante,2)."<br>";
							$msj=$msj."Pagado:<br>$".round($total_abonos,2)."<br>";
							$msj=$msj."</td>";
							$total_abonos=$total_abonos-$monto[$i];
							$jj=1;
						}else{
							$total_abonos=$total_abonos-$monto[$i];
							$msj=$msj."Faltante:<br>$".round($monto[$i],2)."<br>";
							$msj=$msj."</td>";
						}
					}else{
						$msj=$msj."<td style='background:#99FF99;'>";
						$msj=$msj."Fecha:<br>".$fechas[$i]."<br>";
						$msj=$msj."concepto:<br>".$concepto[$i]."<br>";
						$msj=$msj."Monto:<br>$".round($monto[$i],2)."<br>";
						$msj=$msj."Pagado:<br>$".round($monto[$i],2)."<br>";
						$msj=$msj."</td>";
						$total_abonos=$total_abonos-$monto[$i];
					}
			}
			$i++;
		}
		
		//////validamos que existan cargos
	if($cargo>0){
		////////////imprimimos cargos si es que la fecha es mayor igual al ultimo abono
		for($tm=0;$tm<count($monto);$tm++){
			$sumamontos=$sumamontos+$monto[$tm];
		}
		if($fechas[count($fechas)-2]<date('Y-m-d')){
			if($sumamontos<=abono($m['Numero'])){////imprimimos de colores segun el avance del pago de abonos y cargo
				if($sumamontos+$cargo<=abono($m['Numero'])){
					$msj=$msj."<td style='background:#99FF99;'>Fecha<br>".$fechas[count($fechas)-2]."<br>Concepto<br>Cargos<br>$".$cargo."<Faltante><br>$0<br>Pagado<br>$".$cargo."</td>";
				}else{
					$resta=$sumamontos+$cargo-abono($m['Numero']);
					$p=$cargo-$resta;
					$msj=$msj."<td style='background:#FFCC99;'>Fecha<br>".$fechas[count($fechas)-2]."<br>Concepto<br>Cargos<br>Faltante<br>$".$resta."<br>Pagado<br>$".$p."</td>";
				}
			}else{
				$msj=$msj."<td style='background:#FFCC99;'>Fecha<br>".$fechas[count($fechas)-2]."<br>Concepto<br>Cargos<br>Faltante<br>$".$cargo."<br>Abonos<br>$0</td>";
			}
		}else{
			if($sumamontos+$cargo<=abono($m['Numero'])){
				$msj=$msj."<td style='background:#FFCC99;'>Fecha<br>".$fechas[count($fechas)-2]."<br>Concepto<br>Cargos<br>Faltante<br>$0<br>Pagado<br>$".$cargo."</td>";
			}
			$msj=$msj."<td>Fecha <br>".$fechas[count($fechas)-2]."<br>Concepto<br>Cargos<br>Monto<br>$".$cargo."</td>";
		}
	}
		
	$msj=$msj."</tr></table>";
		return $msj;
	}
	
	
	function cargo($numero){
		$query="select * from contrato where Numero='".$numero."'";
		$resultado=mysql_query($query);
		$m=mysql_fetch_array($resultado);
		if($m['facturado']=='si'){
			$queryc="select sum(cantidad) as t from cargofac where numcontrato='".$numero."'";
		}else{
			$queryc="select sum(cantidad) as t from cargo where numcontrato='".$numero."'";
		}
		$resultado2=mysql_query($queryc);
		$m2=mysql_fetch_array($resultado2);
		
	return $m2['t'];
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
			$msj=$msj."<div id='box3'>";
			$msj=$msj."Fecha:<br>".$fecha."<br>";
			$msj=$msj."Monto:<br>$".round($abono,2)."<br>";
			$msj=$msj."</div>";
		}else{
			$msj=$msj."<div id='box4'>";
			$msj=$msj."Fecha:<br>".$fecha."<br>";
			$msj=$msj."Monto:<br>$".round($abono,2)."<br>";
			$msj=$msj."</div>";
		}
		$fechalimite = strtotime ( '+30day' , strtotime ( $fecha ) ) ;
		$fecha=date('Y-m-d',$fechalimite);
		$i++;
	}
	
	}
?>