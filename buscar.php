<?php
require 'funciones.php';
conectar();
/////////////////encabezados
if($_POST['tabla']=="producto"){
	reporte_productos();
	exit();
}

$tipo_folio="A";
if($_POST['tabla']=='cancelacion'){
	echo "<table class='style2'>
	<tr><td>Ver</td><td>Folio</td><td>Fecha</td><td>Tipo</td></tr>";
}else{	
	if($_POST['tabla']!='borrados'){
		echo "<table class='style2'>
		<tr><td>Cancelar</td><td>Ver</td><td>Folio</td><td>Fecha</td></tr>";
		}
}


if($_POST['tabla']=='compra'){
	$comprasfac=mysql_query("select * from comprafac where id_compra like '%".$_POST['folio']."%'");
	$c=mysql_num_rows($comprasfac);
}

$r=mysql_query("select * from ".$_POST['tabla']." where id_".$_POST['tabla']." like '%".$_POST['folio']."%'");

if(mysql_num_rows($r)>0 || $c>0){
	if($c>0){
	//////////////////compras facturadas
		while($m2=mysql_fetch_array($comprasfac)){
		$cancelar="cancelar2(".$m2['id_'.$_POST['tabla']].")";
		$q2=mysql_query("select * from detalle where tipo='".$_POST['tabla']."fac' and id like'%".$m2['id_'.$_POST['tabla']]."%'");
		if(mysql_num_rows($q2)>0){
			echo "<tr><td align='center'><img src='imagenes/borrar.png' width='20px' height='20px' onclick='".$cancelar."'></td><td align='center'><img src='imagenes/info.png' width='20px' height='20px' onclick='ver2(".$m2['id_'.$_POST['tabla']].")'></td><td align='center'>".$tipo_folio.$m2['id_'.$_POST['tabla']]."</td><td align='center'>".$m2['fecha']."</td></tr>";
		}
		}
		
	}
	//////////separacion si es compra
	if($_POST['tabla']=='compra'){
				echo "</table><br><br>";
				echo "<div id='oculto' style='display:none;'>";
				echo "<table class='style2'>
	<tr><td>Cancelar</td><td>Ver</td><td>Folio</td><td>Fecha</td></tr>";
	}
	/////////////borrados
	if($_POST['tabla']=='borrados'){
				echo "<table class='style2'>
				<tr><td>Folio</td><td>Id anterior</td><td>Nombre</td><td>descripcion</td><td>Fecha</td></tr>";
			while($mm=mysql_fetch_array($r)){
				echo "<tr><td>".$mm['id_borrados']."</td><td>".$mm['id_anterior']."</td><td>".$mm['nombre']."</td><td>".$mm['descripcion']."</td><td>".$mm['fecha']."</td></tr>";
			}
			echo "</table>";
			exit();
		}
		
	/////////////asignacin de tipo b si tabla es compra	
	if($_POST['tabla']=='compra'){
		$tipo_folio="B";
	}else{
		$tipo_folio="";
	}
	//////////compras no facturadas y todas las otras tablas
	while($m=mysql_fetch_array($r)){
		if($_POST['tabla']=='cancelacion'){
			$q2=mysql_query("select * from detalle where tipo='".$m['tipo']."-cancelada' and id=".$m['id']);
			if(mysql_num_rows($q2)>0){
				if($m['tipo']=='comprafac'){/////////////////compra facturada cancelada
					echo "<tr><td align='center'><img src='imagenes/info.png' width='20px' height='20px' onclick='ver(".$m['id_'.$_POST['tabla']].")'></td><td align='center'>A".$m['id_'.$_POST['tabla']]."</td><td align='center'>".$m['fecha']."</td><td>compra</td></tr>";
				}elseif($m['tipo']=='compra'){///////////////compra cancelada
					echo "<tr><td align='center'><img src='imagenes/info.png' width='20px' height='20px' onclick='ver(".$m['id_'.$_POST['tabla']].")'></td><td align='center'>B".$m['id_'.$_POST['tabla']]."</td><td align='center'>".$m['fecha']."</td><td>compra</td></tr>";
				}else{//////////entradas salidas y ventas canceladas
					echo "<tr><td align='center'><img src='imagenes/info.png' width='20px' height='20px' onclick='ver(".$m['id_'.$_POST['tabla']].")'></td><td align='center'>".$m['id_'.$_POST['tabla']]."</td><td align='center'>".$m['fecha']."</td><td>".$m['tipo']."</td></tr>";
					}
				}
		}else{
			$cancelar="cancelar(".$m['id_'.$_POST['tabla']].")";
			$q2=mysql_query("select * from detalle where tipo='".$_POST['tabla']."' and id=".$m['id_'.$_POST['tabla']]);
			if(mysql_num_rows($q2)>0){
				echo "<tr><td align='center'><img src='imagenes/borrar.png' width='20px' height='20px' onclick='".$cancelar."'></td><td align='center'><img src='imagenes/info.png' width='20px' height='20px' onclick='ver(".$m['id_'.$_POST['tabla']].")'></td><td align='center'>".$tipo_folio.$m['id_'.$_POST['tabla']]."</td><td align='center'>".$m['fecha']."</td></tr>";
				}		
		}
	}
	
	if($_POST['tabla']=='compra'){
				echo "</div>";
			}
}else{
	echo "<tr><td colspan='4' align='center'>Error no se encontro el folio</td></tr>";
}

echo "</table>";



function reporte_productos(){
	echo '<input type="button" value="Imprimir" onclick="javascript:imprSelec()" />';
	$q1="select * from producto where nombre like '%".$_POST['folio']."%'order by nombre";
	$r1=mysql_query($q1);
	while($m1=mysql_fetch_array($r1)){
		$unidad1=mysql_fetch_array(mysql_query("select * from unidad where id_unidad=".$m1['id_unidad']));
		$costo1=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$m1['id_producto']));
		$acumulado1=$acumulado1+$costo1['cantidad'];
		$acumulado2=$acumulado2+($costo1['cantidad']*$costo1['precio']);
	}	
	echo "<div id='aaaa' style='position:absolute;top:180px;left:300px;color:white;'>
	Total en piezas:".$acumulado1.".........
	Total en dinero:$".$acumulado2."
	</div>";
	echo "<div id='imptabla' ><br><br><table class='style2' border='1'>";
	echo "<tr><td>Producto</td><td>Unidad</td><td>cantidad  en<br> inventario</td><td>Ultimo Costo</td></tr>";
	$q="select * from producto where nombre like '%".$_POST['folio']."%'order by nombre";
	$r=mysql_query($q);
	while($m=mysql_fetch_array($r)){
		$unidad=mysql_fetch_array(mysql_query("select * from unidad where id_unidad=".$m['id_unidad']));
		$costo=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$m['id_producto']));
		echo "<tr><td>".$m['nombre']."(".$m['descripcion'].")</td><td>".$unidad['nombre']."</td><td>".$costo['cantidad']."</td><td>$".$costo['precio']."</td></tr>";
	}
	echo "<table>
	</div>";
}

?>