<?php
require 'funciones.php';
conectar();
global $fechamax,$horamax,$show_all_can,$show_all_din;
date_default_timezone_set("America/Monterrey");
//print_r($_POST);
$resultado=mysql_query("select * from categoria where nombre='".$_POST['categoria']."'");
$número_filas = mysql_num_rows($resultado);///////////////////obtenemos el id de la categoria
if($número_filas>0){////////////////////si existe la categoria obtenemos sus subcategoria
	$categoria=mysql_fetch_array($resultado);
	$subresultado=mysql_query("select * from subcategoria where id_categoria=".$categoria['id_categoria']." order by nombre");
	$num_fil=mysql_num_rows($subresultado);
	if($num_fil>0){
			ultima_modificacion($categoria['id_categoria']);
			echo "<font color='white'><h1>".$_POST['categoria']."</h1></font>";
			while($subcategoria=mysql_fetch_array($subresultado)){
			echo "<font color='white'><h2>".$subcategoria['nombre']."</h2></font>";
			tabla($categoria['id_categoria'],$subcategoria['id_subcategoria']);
			}
	}else{//////////no existen subcategorias
		echo "No existen subcategorias para la categoria ".strtoupper($_POST['categoria']);
	}
}else{////////////mensaje de no existencia de categoria
	echo "seleccione una opcion correcta la categoria '".strtoupper($_POST['categoria'])."' no existe";
}
		echo "<div id='fecha' style='position:absolute;top:120px;right:130px;color:white;'>";
		echo "Total en piezas:".$show_all_can."<br>";
		echo "Total en dinero:".$show_all_din;
		echo "</div>";

function tabla($cat,$sub){
	global $horamax,$fechamax,$show_all_can,$show_all_din;
	$r=mysql_query('select * from producto where id_categoria='.$cat.' and id_subcategoria='.$sub." order by nombre");
	$nr=mysql_num_rows($r);
	if($nr>0){		
		echo "<table class='style1'>";
		echo "<tr><td>ID</td><td>NOMBRE</td><td>DESCRIPCION</td><td>UNIDAD</td><td>INVENTARIO<BR>INICIAL</td><td>ULTIMO<br>COSTO</td><td>PRECIO DE <br>VENTA</td><td colspan='2'>COMPRAS</td><td colspan='2'>ENTRADAS</td><td colspan='2'>SALIDAS</td><td colspan='2'>VENTAS</td><td colspan='2'>INVENTARIO<BR>ACTUAL</td></tr>";
		$acumulado_cantidad=0;
		$acumulado_dinero=0;
		while($item=mysql_fetch_array($r)){
			
			$inv=mysql_query("select * from inventario where id_producto=".$item['id_producto']);
			$inv2=mysql_fetch_array($inv);
			
			$unidad=mysql_fetch_array(mysql_query("select * from unidad where id_unidad=".$item["id_unidad"]));
			
			echo "<tr><td>".$item['id_producto']."</td><td>".$item['nombre']."</td><td>".$item['descripcion']."</td>"."<td>".$unidad["nombre"]."</td>"."<td align='center'>".$inv2['cantidad'];
			///////////id de compras hechas en el periodo
			$compras=mysql_query("select id_compra from compra where fecha>'".$fechamax."'");
			$comprasfac=mysql_query("select id_compra from comprafac where fecha>'".$fechamax."'");
			$cantidad_compra=0;
			$importe_compras=0;
			while($compras2=mysql_fetch_array($compras)){
				$c=mysql_query("select sum(cantidad)as t,sum(importe) as imp from detalle where id_producto=".$item['id_producto']." and tipo='compra' and id=".$compras2['id_compra'].' and gasto="no"');
				$cant=mysql_fetch_array($c);
				$cantidad_compra=$cantidad_compra+$cant['t'];
				$importe_compras=$importe_compras+$cant['imp'];
			}
			
			while($comprasfac2=mysql_fetch_array($comprasfac)){
				$c=mysql_query("select sum(cantidad)as t,sum(importe) as imp  from detalle where id_producto=".$item['id_producto']." and tipo='comprafac' and id=".$comprasfac2['id_compra'].' and gasto="no"');
				$cant=mysql_fetch_array($c);
				$cantidad_compra=$cantidad_compra+$cant['t'];
				$importe_compras=$importe_compras+$cant['imp'];
			}
			
			/////////entradas
			$entradas=mysql_query("select * from entrada where fecha>'".$fechamax."'");
			$cantidad_entrada=0;
			while($entradas2=mysql_fetch_array($entradas)){
				$ce=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$item['id_producto']." and tipo='entrada' and id=".$entradas2['id_entrada']);
				$cante=mysql_fetch_array($ce);
				$cantidad_entrada=$cantidad_entrada+$cante['t'];
			}
			
			/////////salidas
			$salidas=mysql_query("select * from salida where fecha>'".$fechamax."'");
			$cantidad_salida=0;
			while($salidas2=mysql_fetch_array($salidas)){
				$cs=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$item['id_producto']." and tipo='salida' and id=".$salidas2['id_salida']);
				$cants=mysql_fetch_array($cs);
				$cantidad_salida=$cantidad_salida+$cants['t'];
			}
			
			/////////ventas
			$ventas=mysql_query("select * from venta where fecha>'".$fechamax."'");
			$cantidad_venta=0;
			while($ventas2=mysql_fetch_array($ventas)){
				$cv=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$item['id_producto']." and tipo='venta' and id=".$ventas2['id_venta']);
				$cantv=mysql_fetch_array($cv);
				$cantidad_venta=$cantidad_venta+$cantv['t'];
			}
			
			//////////////inventario actual
			$inv_actual=$inv2['cantidad']+$cantidad_compra+$cantidad_entrada-$cantidad_salida-$cantidad_venta;
			$show_all_can=$show_all_can+$inv_actual;
			$show_all_din=$show_all_din+round(($inv_actual*$inv2['precio']),5);
			 
			///////////////impresion de las celdas
					/*//costo promedio
					if($inv_actual<=0){////validacion entre cero
						$cp=(round((($inv2['cantidad']*$inv2['precio'])+$importe_compras),5))/1;
					}else{
						$cp=(round((($inv2['cantidad']*$inv2['precio'])+$importe_compras),5))/$inv_actual;
					}*/
					$cp=$inv2['precio'];
					echo "</td><td align='center'>$".round($cp,5)."</td>
					<td align='center'>$ ".number_format($inv2['precio_venta'],3)."</td>";
					///COMPRAS
					echo "<td align='center'>".$cantidad_compra."</td><td align='right'>$".round(($cantidad_compra*$cp),5)."</td>";
					///entradas
					echo "<td align='center'>".$cantidad_entrada."</td><td align='right'>$".round(($cantidad_entrada*$cp),5)."</td>";
					///salidas
					echo "<td align='center'>".$cantidad_salida."</td><td align='right'>$".round(($cantidad_salida*$cp),5)."</td>";
					//ventas
					echo "<td align='center'>".$cantidad_venta."</td><td align='right'>$".round(($cantidad_venta*$cp),5)."</td>";
					////inventarios actual
					echo "<td align='center'>".$inv_actual."</td><td align='right'>$".round(($inv_actual*$inv2['precio']),5)."</td></tr>";
					$acumulado_cantidad=$acumulado_cantidad+$inv_actual; 
					$acumulado_dinero=$acumulado_dinero+round((($inv_actual*$inv2['precio'])),5); 
			  
		}  
		echo "<tr><td colspan='14' style='text-align: right;'>Total</td><td>".$acumulado_cantidad."</td><td colspan='2' align='center' style='text-align:center'>".$acumulado_dinero."</td></tr>";
		echo "</table><br><br><br><br>"; 
	}else{
		echo "NO EXISTEN PRODUCTOS EN ESTA SUBCATEGORIA";
	}
}

function ultima_modificacion($category){
	global $horamax,$fechamax;
	/////////////obtenemos los id de los productos correspondientes a la categoria
	$id="";$id2='';
	///////////////obtener la fecha maxima de modificacion del inventario
	$p=mysql_query("select * from producto where id_categoria=".$category);
	if(mysql_num_rows($p)>0){
		while($m=mysql_fetch_array($p)){
			if($id==''){
				$id="select max(fecha) as f from inventario where id_producto=".$m['id_producto'];
			}else{
				$id=$id." or id_producto=".$m['id_producto'];
			}
		}
	}
	$fecha=mysql_query($id);
	$mostrar_fecha=mysql_fetch_array($fecha);
	
	///////////buscar la hora mas reciente de modificacion
	$ph=mysql_query("select * from producto where id_categoria=".$category);
	if(mysql_num_rows($ph)>0){
		while($mh=mysql_fetch_array($ph)){
			if($id2==''){
				$id2="select max(hora) as h from inventario where id_producto=".$mh['id_producto'];
			}else{
				$id2=$id2." or id_producto=".$mh['id_producto'];
			}
		}
	}
	$hora=mysql_query($id2." and fecha='".$mostrar_fecha['f']."'");
	$mostrar_hora=mysql_fetch_array($hora);
	$fechamax=$mostrar_fecha['f'];
	$horamax=$mostrar_hora['h'];
	echo "<div id='fecha' style='position:absolute;top:160px;right:130px;color:white;'>";
	echo "Ultimo Corte:".$mostrar_fecha['f'];
	echo "</div>";
}

function extra_dia_piezas($tabla,$id_producto,$fecha,$hora){
	/*$q="select * from ".$tabla." where fecha='".$fecha."' and hora>'".$hora."'";
	$r=mysql_query($q);
	$total=0;
	while($m=mysql_fetch_array($r)){
		if($tabla=='comprafac'){
			$q2="select sum(cantidad) as t from detalle where id_producto=".$id_producto." and id=".$m['id_compra'].' and tipo="'.$tabla.'" and gasto="no"';
		}else{
			$q2="select sum(cantidad) as t from detalle where id_producto=".$id_producto." and id=".$m['id_'.$tabla].' and tipo="'.$tabla.'" and gasto="no"';
		}
		$r2=mysql_query($q2);
		$m2=mysql_fetch_array($r2);
		$total=$total+$m2['t'];
	}*/
	$total=0;
	return $total;
}
function extra_dia_importe($tabla,$id_producto,$fecha,$hora){
	/*$q="select * from ".$tabla." where fecha='".$fecha."' and hora>'".$hora."'";
	$r=mysql_query($q);
	$total=0;
	while($m=mysql_fetch_array($r)){
		if($tabla=='comprafac'){
			$q2="select sum(importe) as t from detalle where id_producto=".$id_producto." and id=".$m['id_compra'].' and tipo="'.$tabla.'" and gasto="no"';
		}else{
			$q2="select sum(importe) as t from detalle where id_producto=".$id_producto." and id=".$m['id_'.$tabla].' and tipo="'.$tabla.'" and gasto="no"';
		}
		$r2=mysql_query($q2);
		$m2=mysql_fetch_array($r2);
		$total=$total+$m2['t'];
	}*/
	$total=0;
	return $total;
}
?>