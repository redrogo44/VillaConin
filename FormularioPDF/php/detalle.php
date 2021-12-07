<html>
<head>
 <link rel="stylesheet" href="subcontratos.css" type="text/css" /> 
 <link rel="stylesheet" href="demo.css">
</head>
<body>
<div id="style2"class="style2">
<?php
require 'funciones2.php';
conectar();
$result=mysql_query("select * from contrato where Numero='".$_POST['numero']."'");
$mostrar=mysql_fetch_array($result);
//echo "Numero de cliente:".$mostrar['id_cliente']."<br>";
$rc=mysql_query("select * from cliente where id=".$mostrar['id_cliente']);
$mc=mysql_fetch_array($rc);
echo "Nombre:".$mc['nombre']." ".$mc['ap']." ".$mc['am']."<br>";
echo "Numero de contrato:".$mostrar['Numero']."<br>";
echo "Telefono:".$mc['tel']."<br><br>";
$info='this.value,"'.$mostrar['Numero'].'"';
echo "<button value='".$mc['mail']."' onclick='correo(".$info.");cerrar_ventana()'>Enviar correo</button>";
$abonos=abono($mostrar['Numero']);
echo "<br><br>";
echo "<table border='0' align='center'><tr>";
$fechas=explode('%',$mostrar['fechas']);
$monto=explode('%',$mostrar['monto']);
	$i=0;$x=0;
//////////cargos dividido por las fechas para el reajuste del abono	
$extra=cargos($mostrar['Numero'],$mostrar['facturado']);
	//////////cantidad de fechas pasadas
	while($x<count($fechas)-1){
	$abono_teorico=round($monto[$x];
		if(strtotime($fechas[$x])<strtotime(date('Y-m-d'))){
			if($abono_teorico<=$abonos){
				echo "<td style='background:#99FF99;'>Fecha<br>".$fechas[$x]."<br>Monto:<br>".$abono_teorico."</td>";
				$abonos=$abonos-$abono_teorico;
			}else{
				if($mas==1){
					echo "<td style='background:#FFCC99;'>Fecha<br>".$fechas[$x]."<br>Faltante:<br>".$abono_teorico."</td>";
				}else{
					$faltante=$abono_teorico-$abonos;
					$abonos=$abonos-$abono_teorico;
					echo "<td style='background:#FFCC99;'>Fecha<br>".$fechas[$x]."<br>Faltante:<br>".$faltante."</td>";
					$mas=1;
				}
			}
		}else{
			echo "<td >Fecha<br>".$fechas[$x]."<br>Monto:<br>".$abono_teorico."</td>";
		}
		$x++;
		if(($x%6)==0){
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
					echo "<td style='background:#FFCC99;'>Fecha<br>".$fechas[count($fechas)-2]."<br>Cargos<br>$".$extra."</td>";
				}else{
					$resta=$sumamontos+$extra-abono($mostrar['Numero']);
					echo "<td style='background:#99FF99;'>Fecha<br>".$fechas[count($fechas)-2]."<br>Cargos<br>$".$resta."</td>";
				}
			}else{
				echo "<td style='background:#FFCC99;'>Fecha<br>".$fechas[count($fechas)-2]."<br>Cargos<br>$".$extra."</td>";
			}
		}else{
			echo "<td>Fecha Q<br>".$fechas[count($fechas)-2]."<br>Cargos<br>$".$extra."</td>";
		}
	}
	
echo "</tr>";

	
	
	
	
	
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
?>
</div>
</body>
</html>