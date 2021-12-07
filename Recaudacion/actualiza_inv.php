<?php
require('../funciones2.php');
conectar();
	global $horamax,$fechamax,$show_all_can,$show_all_din;
	$r=mysql_query('select * from producto where id_categoria=1');
	$nr=mysql_num_rows($r);
	
	if($nr>0){		
		echo "<table class='style1'>";
		echo "<tr><td>ID</td><td>NOMBRE</td><td>DESCRIPCION</td><td>INVENTARIO<BR>INICIAL</td><td>COSTO<BR>PROMEDIO</td><td colspan='2'>INVENTARIO<BR>ACTUAL</td><td colspan='3'>INVENTARIO<BR>FISICO</td></tr>";
		
		while($item=mysql_fetch_array($r)){
			$inv=mysql_query("select * from inventario where id_producto=".$item['id_producto']);
			$inv2=mysql_fetch_array($inv);
			
			echo "<tr><td>".$item['id_producto']."</td><td>".$item['nombre']."</td><td>".$item['descripcion']."</td><td align='center'>".$inv2['cantidad']."</td>";
			///////////id de compras hechas en el periodo
			$compras=mysql_query("select id_compra from compra where fecha>'".$fechamax."'  and fecha<='".$_POST['fecha_max']."'");
			$comprasfac=mysql_query("select id_compra from comprafac where fecha>'".$fechamax."' and fecha<='".$_POST['fecha_max']."'");
			$cantidad_compra=0;
			$importe_compras=0;
			while($compras2=mysql_fetch_array($compras)){
				$c=mysql_query("select sum(cantidad)as t,sum(importe) as imp from detalle where id_producto=".$item['id_producto']." and tipo='compra' and id=".$compras2['id_compra'].' and gasto="no"');
				$cant=mysql_fetch_array($c);
				$cantidad_compra=$cantidad_compra+$cant['t'];
				$importe_compras=$importe_compras+$cant['imp'];
			}
			
			while($comprasfac2=mysql_fetch_array($comprasfac)){
				$c=mysql_query("select sum(cantidad)as t,sum(importe) as imp from detalle where id_producto=".$item['id_producto']." and tipo='comprafac' and id=".$comprasfac2['id_compra'].' and gasto="no"');
				$cant=mysql_fetch_array($c);
				$cantidad_compra=$cantidad_compra+$cant['t'];
				$importe_compras=$importe_compras+$cant['imp'];
			}
			
			//echo "<td align='center'>".$cantidad_compra."</td><td align='right'>$".$cantidad_compra*$inv2['precio']."</td>";
			/////////entradas
			$entradas=mysql_query("select * from entrada where fecha>'".$fechamax."' and fecha<='".$_POST['fecha_max']."'");
			$cantidad_entrada=0;
			while($entradas2=mysql_fetch_array($entradas)){
				$ce=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$item['id_producto']." and tipo='entrada' and id=".$entradas2['id_entrada']);
				$cante=mysql_fetch_array($ce);
				$cantidad_entrada=$cantidad_entrada+$cante['t'];
			}
			//echo "select * from entrada where fecha>='".$fechamax."' and hora>'".$horamax."' and fecha<='".$_POST['fecha_max']."'";
			/////////salidas
			$salidas=mysql_query("select * from salida where fecha>'".$fechamax."' and fecha<='".$_POST['fecha_max']."'");
			$cantidad_salida=0;
			while($salidas2=mysql_fetch_array($salidas)){
				$cs=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$item['id_producto']." and tipo='salida' and id=".$salidas2['id_salida']);
				$cants=mysql_fetch_array($cs);
				$cantidad_salida=$cantidad_salida+$cants['t'];
			}
			
			//echo "<td align='center'>".$cantidad_salida."</td><td align='right'>$".$cantidad_salida*$inv2['precio']."</td>";
			/////////ventas
			$ventas=mysql_query("select * from venta where fecha>'".$fechamax."' and fecha<='".$_POST['fecha_max']."'");
			$cantidad_venta=0;
			while($ventas2=mysql_fetch_array($ventas)){
				$cv=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$item['id_producto']." and tipo='venta' and id=".$ventas2['id_venta']);
				$cantv=mysql_fetch_array($cv);
				$cantidad_venta=$cantidad_venta+$cantv['t'];
			}
			//echo "<td align='center'>".$cantidad_venta."</td><td align='right'>$".$cantidad_venta*$inv2['precio']."</td>";
			//////////////inventario actual
			$inv_actual=$inv2['cantidad']+$cantidad_compra+$cantidad_entrada-$cantidad_salida-$cantidad_venta;
			$show_all_can=$show_all_can+$inv_actual;
			$show_all_din=$show_all_din+round((($inv2['cantidad']*$inv2['precio'])+$importe_compras),5);
			//////costo ponderado
			if($inv_actual<=0){////validacion entre cero
				$cp=(round((($inv2['cantidad']*$inv2['precio'])+$importe_compras),5))/1;
			}else{
				$cp=(round((($inv2['cantidad']*$inv2['precio'])+$importe_compras),5))/$inv_actual;
			}
			echo "<td align='center'>$".round($cp,5)."</td>";
			
			echo "<td align='center'>".$inv_actual."</td><td align='right'>$".round((($inv2['cantidad']*$inv2['precio'])+$importe_compras),5)."</td>";
			////input con el inventario inicial
			echo "<td><input type='number' id='cantidad".$item['id_producto']."' name='".$item['id_producto']."' style='width:50px;' onkeyup='calcular(".$item['id_producto'].")' value='".$inv_actual."'></td><td id='real".$item['id_producto']."'>0</td><td id='money".$item['id_producto']."'>$0</td></tr>";
			echo "<input type='hidden' id='".$item['id_producto']."'  value='".$inv_actual."'>";
			/////////cantidad real
			echo "<input type='hidden' id='".$item['id_producto']."'  value='".$inv_actual."'>";
			 $ir="UPDATE `inventario` SET `IR`=".$inv_actual." WHERE id_producto=".$item['id_producto'];
			mysql_query($ir);
			echo "<input type='hidden' id='faltantes-".$item['id_producto']."' name='faltantes-".$item['id_producto']."' value='0'>";
			//precio;
			echo "<input type='hidden' id='precio".$item['id_producto']."' name='costo-".$item['id_producto']."' value='".round($cp,5)."'>";
		}
		
		echo "</table><br><br><br><br>";
	}else{
		echo "NO EXISTEN PRODUCTOS EN ESTA SUBCATEGORIA";
	}

echo "<script>
	window.close();
</script>";
?>