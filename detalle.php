<html>
<head>
 <link rel="stylesheet" href="subcontratos.css" type="text/css" /> 
 <link rel="stylesheet" href="demo.css">
 <style>
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
 </style>
</head>
<body>
<div id="style2"class="style2" style='height:375px;width:500px; overflow: scroll;'>
<?php
require 'funciones2.php';
conectar();
$arre=explode('-',$_POST['numero']);
if(count($arre)>1){
	$result=mysql_query("select * from contrato where Numero='".$_POST['numero']."'");
	$mostrar=mysql_fetch_array($result);
	//echo "Numero de cliente:".$mostrar['id_cliente']."<br>";
	$rc=mysql_query("select * from subcontratos where numero='".$mostrar['Numero']."'");
	$mc=mysql_fetch_array($rc);
	echo "Nombre:".$mc['nombre']."<br>";
	echo "Numero de contrato:".$mostrar['Numero']."<br>";
	echo "Telefono:".$mc['telefono']."<br>";
	echo "E-mail:".$mc['correo']."<br>";
	$info='this.value,"'.$mostrar['Numero'].'"';
	echo "<button value='".$mc['correo']."' onclick='correo(".$info.");cerrar_ventana()'>Enviar correo</button><br>";
	reajustesub1($mostrar['Numero']);
}else{
	////////////////////contratos 
	$result=mysql_query("select * from contrato where Numero='".$_POST['numero']."'");
	$mostrar=mysql_fetch_array($result);
	//echo "Numero de cliente:".$mostrar['id_cliente']."<br>";
	$rc=mysql_query("select * from cliente where id=".$mostrar['id_cliente']);
	$mc=mysql_fetch_array($rc);
	echo "Nombre:".$mc['nombre']." ".$mc['ap']." ".$mc['am']."<br>";
	echo "Numero de contrato:".$mostrar['Numero']."<br>";
	echo "Telefono:".$mc['tel']."<br>";
	echo "E-mail:".$mc['mail']."<br><br>";
	$info='this.value,"'.$mostrar['Numero'].'"';
	echo "<button value='".$mc['mail']."' onclick='correo(".$info.");cerrar_ventana()'>Enviar correo</button>";
	$abonos=abono($mostrar['Numero']);
	echo "<br><br>";
	echo "<table border='0' align='center'><tr>";
	$fechas=explode('%',$mostrar['fechas']);
	$monto=explode('%',$mostrar['monto']);
	$i=0;$x=0;
	$extra=cargos($mostrar['Numero'],$mostrar['facturado']);
		//////////cantidad de fechas pasadas
		while($x<count($fechas)-1){
		$abono_teorico=$monto[$x];
			if(strtotime($fechas[$x])<strtotime(date('Y-m-d'))){
				if($abono_teorico<=$abonos){
					echo "<td style='background:#99FF99;'>Fecha<br>".$fechas[$x]."<br>Monto:<br>$".number_format($abono_teorico,2,".",",")."<br>Total Pagado:<br>$".number_format($abono_teorico,2,".",",")."<br>Faltante:<br>$0</td>";
					$abonos=$abonos-$abono_teorico;
				}else{
					if($mas==1){
						echo "<td style='background:#FFCC99;'>Fecha<br>".$fechas[$x]."<br>Monto:<br>$".number_format($abono_teorico,2,".",",")."<br>Pagado:<br>$0<br>Faltante:<br>$".number_format($abono_teorico,2,".",",")."</td>";
					}else{
						$faltante=$abono_teorico-$abonos;
						echo "<td style='background:#FFCC99;'>Fecha<br>".$fechas[$x]."<br>Monto:
                        <br>$".number_format($abono_teorico,2,".",",")."<br>Total Pagado:<br>$".number_format($abonos,2,".",",")."<br>Faltante:
                        <br>$".number_format($faltante,2,".",",")."</td>";
						$abonos=$abonos-$abono_teorico;
						$mas=1;
					}
				}
			}else{
				echo "<td >Fecha<br>".$fechas[$x]."<br>Monto:<br>$".number_format($abono_teorico,2,".",",")."</td>";
			}
			$x++;
			if(($x%5)==0){
				echo "</tr><tr>";
			}
		}
			//////validamos que existan cargos
		if($extra>0){
			////////////imprimimos cargos si es que la fecha es mayor igual al ultimo abono
			for($tm=0;$tm<count($monto);$tm++){
				$sumamontos=$sumamontos+$monto[$tm];
			}
			if($fechas[count($fechas)-2]<date('Y-m-d')){
				if($sumamontos<=abono($mostrar['Numero'])){////imprimimos de colores segun el avance del pago de abonos y cargo
					if($sumamontos+$extra<=abono($mostrar['Numero'])){
						echo "<td style='background:#99FF99;'>Fecha<br>".$fechas[count($fechas)-2]."<br>Monto de Cargos:<br>$".number_format($extra,2,".",",")."<br>Total Pagado:<br>$".number_format($extra,2,".",",")."<br>Faltante:<br>$0</td>";
					}else{
						$resta=$sumamontos+$extra-abono($mostrar['Numero']);
						$pagado=$extra-$resta;
						echo "<td style='background:#FFCC99;'>Fecha<br>".$fechas[count($fechas)-2]."<br>Monto de Cargos:<br>$".number_format($extra,2,".",",")."<br>Total Pagado:<br>$".number_format($pagado,2,".",",")."<br>Faltante:<br>$".number_format($resta,2,".",",")."</td>";
					}
				}else{
					echo "<td style='background:#FFCC99;'>Fecha<br>".$fechas[count($fechas)-2]."<br>Monto de Cargos:<br>$".number_format($extra,2,".",",")."<br>Total Pagado:<br>$0<br>Faltante:<br>$".number_format($extra,2,".",",")."</td>";
					}
			}else{
				echo "<td>Fecha<br>".$fechas[count($fechas)-2]."<br>Cargos<br>$".number_format($extra,2,".",",")."</td>";
			}
		}
		
	echo "</tr>";
}
	
	
	
	
	
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
	
		////////////////cargos
	function cargos($numero,$fac){
		if($fac=='si'){
				$queryc="select sum(cantidad) as t from cargofac where numcontrato='".$numero."'";
			}else{
				$queryc="select sum(cantidad) as t from cargo where numcontrato='".$numero."'";
			}
			$resultado2=mysql_query($queryc);
			$m2=mysql_fetch_array($resultado2);
			return $m2['t'];
	}
	
	///////////////reajuste 
	function reajustesub1($numero){
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
				echo "Montos:<br>$".number_format(round($abono_ideal,2),2,".",",")."<br>";
				if($aux==1 && $x_anterior-$afa>0){
					echo "Pagado:<br>$".number_format(($x_anterior-$afa),2,".",",")."<br>";
					$aux++;
				}
				echo "</div>";
			}else{/////////fechas menores o iguales a hoy
				if(($i-1)>=0){/////////verificamos si existe la posicion de arreglo anterior
					if($ultimo_abono <= $fechas[$i-1]){
						echo "<div id='box3'>";
						echo "Fecha:<br>".$fechas[$i]."<br><br>";
						echo "Monto:<br>$".number_format(round($abono_ideal,2),2,".",",")."<br>";
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
						echo "Monto:<br>$".number_format($result,2,".",",")."<br>";
						echo "</div>";
						$abono_ideal=(saldoi($numero)-abono($numero))/(count($fechas)-($i+2));
					}
				}else{
					echo "<div id='box'>";
					echo "Fecha:<br>".$fechas[$i]."<br><br>";
					$x=round(suma_de_abonos($numero,$fechas[$i]),2);
					echo "Monto:<br>$".number_format($x,2,".",",")."<br>";
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
			$SI=$SI-$m2['t'];
		return $SI;
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
?>
</div>
</body>
</html>