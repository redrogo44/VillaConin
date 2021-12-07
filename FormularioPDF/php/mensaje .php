<?php
require 'funciones2.php';
conectar();
$result=mysql_query("select * from contrato where Numero='".$_POST['numero']."'");
$mostrar=mysql_fetch_array($result);
	$msj='<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	</head>
	<body>';
	
	$msj=$msj."Estimado cliente:<br>
	
	
	Este correo electrónico ha sido generado automáticamente por el sistema, por lo que le solicitamos no responder a este mensaje, ya que las respuestas a este correo electrónico no serán leídas. En caso de tener alguna duda referente a la información contenida, llame para su aclaración a los siguientes números telefónicos:
	<br>
	(442) 2.77.40.32 o 2.77.41.17
	De lunes a sábado
	De 10:00am a 6:00pm<br><br>";
	
$abonos=abono($mostrar['Numero']);
$msj=$msj."<br><br>";
$msj=$msj."<table border='0' align='center'><tr>";
$fechas=explode('%',$mostrar['fechas']);
$monto=explode('%',$mostrar['monto']);
	$i=0;$x=0;
//////////cargos dividido por las fechas para el reajuste del abono	
$extra=cargos($mostrar['Numero'],$mostrar['facturado']);
	//////////cantidad de fechas pasadas
	while($x<count($fechas)-1){
	$abono_teorico=round($monto[$x],2);
		if(strtotime($fechas[$x])<strtotime(date('Y-m-d'))){
			if($abono_teorico<=$abonos){
				$msj=$msj."<td style='background:#99FF99;'>Fecha<br>".$fechas[$x]."<br>Monto:<br>".$abono_teorico."</td>";
				$abonos=$abonos-$abono_teorico;
			}else{
				if($mas==1){
					$msj=$msj."<td style='background:#FFCC99;'>Fecha<br>".$fechas[$x]."<br>Faltante:<br>".$abono_teorico."</td>";
				}else{
					$faltante=$abono_teorico-$abonos;
					$abonos=$abonos-$abono_teorico;
					$msj=$msj."<td style='background:#FFCC99;'>Fecha<br>".$fechas[$x]."<br>Faltante:<br>".$faltante."</td>";
					$mas=1;
				}
				
			}
		}else{
			$msj=$msj."<td >Fecha<br>".$fechas[$x]."<br>Monto:<br>$".$abono_teorico."<br></td>";
		}
		$x++;
		if(($x%6)==0){
			$msj=$msj."</tr><tr>";
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
					$msj=$msj."<td style='background:#FFCC99;'>Fecha<br>".$fechas[count($fechas)-2]."<br>Cargos<br>$".$extra."</td>";
				}else{
					$resta=$sumamontos+$extra-abono($mostrar['Numero']);
					$msj=$msj."<td style='background:#99FF99;'>Fecha<br>".$fechas[count($fechas)-2]."<br>Cargos<br>$".$resta."</td>";
				}
			}else{
				$msj=$msj."<td style='background:#FFCC99;'>Fecha<br>".$fechas[count($fechas)-2]."<br>Cargos<br>$".$extra."</td>";
			}
		}else{
			$msj=$msj."<td>Fecha <br>".$fechas[count($fechas)-2]."<br>Cargos<br>$".$extra."</td>";
		}
	}
	
	
$msj=$msj."</tr>";

	
	
	
	
	
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
			if($m2['t']<=0 || $m2['t']==''){
				$m2['t']=0;
			}
			return $m2['t'];
	}
	
	$msj=$msj."</body>
	</html>";
	
	//mail($_POST['correo'], 'IMPORTANTE PAGOS', $msj, "From: administracion@sistemavc.com \r\n");
	mail('benja_map@hotmail.com', 'IMPORTANTE PAGOS', utf8_decode($msj), "From: administracion@sistemavc.com \r\nContent-type: text/html\r\n");

?>