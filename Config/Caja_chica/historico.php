<?php
require('../configuraciones.php');
conectar();
$q=mysql_query("select * from Cuentas where id=2");
$cuenta=mysql_fetch_array($q);

echo "<table>";
echo "<tr><td style='background-color:lightgreen;'><br></td>
		  <td style='background-color:lightblue;'><br></td>
		  <td style='background-color:red;'><br></td>
		  <td style='background-color:yellow;'><br></td></tr>";
echo "<tr><td >Ingreso</td>
		  <td >Egreso</td>
		  <td >Cancelado</td>
		  <td >Corte por Dia</td></tr>";
echo "</table><br><br>";

echo "<table border='1'>";
echo "<tr><td>Fecha</td><!--td>FDR</td--><td>Movimiento</td><td>Cantidad</td><td>Saldo Inicial</td><td>Saldo final</td></tr>";
echo "<tr><td>---------</td><!--td>-------</td--><td>Creacion Cuenta</td><td>".$cuenta["saldo_inicial"]."</td><td>$".money_format("%i",0)."</td><td>$".money_format("%i",$cuenta["saldo_inicial"])."</td></tr>";
$fechac="2016-03-12";
////movimientos de la cuenta
$mov=mysql_query("select * from Movimientos_Cuentas where fecha!='0000-00-00' order by fecha"); 
$acumulado=$cuenta["saldo_inicial"];
while($m=mysql_fetch_array($mov)){
	 
	///////SI CAMBIAMOS DE DIA REGISTRAMOS EL TOTAL AL DIA ANTERIOR
	if($m["fecha"]!=$fechac){
		$fechac=$m["fecha"];
		echo "<tr><td colspan='5' style='background-color:yellow;' align='right'>$".money_format("%i",$acumulado)."</td></tr>";
	}
	
	 
	
	
	///validamos que el movimiento sea de efectivo
	if($m["cuenta_receptora"]==2 || $m["cuenta_emisor"]==2){
			$color="white";
			////validamos si es un ingreso a la cuenta de efectivo
			if($m["cuenta_receptora"]==2){
				$color="lightgreen"; 
				///////validamos si el movimiento fue cancelado
				if($m["estatus"]!="activo"){
					$color="red";
				}
			}

			////validamos si es un egreso a la cuenta de efectivo
			if($m["cuenta_emisor"]==2){
				$color="lightblue";
				///////validamos si el movimiento fue cancelado
				if($m["estatus"]!="activo"){
					$color="red";
				}else{ 
					$m["cantidad"]=$m["cantidad"]*(-1);
				}
			}
 
			echo "<tr style='background-color:".$color.";'>";
			echo "<td>".$m["fecha"]."</td>";
			echo "<!--td>".$m["fdr"]."</td-->";
			echo "<td>".$m["concepto"]."</td>";
			echo "<td>$".money_format("%i",$m["cantidad"])."</td>";
			if($color=="red"){
				$m["cantidad"]=0;
			}
			echo "<td>$".money_format("%i",$acumulado)."</td>";
			$acumulado=$acumulado+$m["cantidad"];
			echo "<td>$".$acumulado."</td>";
			echo "</tr>";	
	}
	
	
	
}

echo "</table>";
?>