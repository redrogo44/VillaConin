<?php
require 'funciones.php';
conectar();
session_start();
$nivel=mysql_fetch_array(mysql_query("select * from usuarios where usuario='".$_SESSION['usuario']."'"));
///////////validacion de las fechas
echo "<font color='white'>";
if(isset($_POST['f_inicial'])&&isset($_POST['f_limite'])){
	if(!empty($_POST['f_inicial'])&& !empty($_POST['f_limite'])){
		if($_POST['f_inicial']<=$_POST['f_limite']){
			//echo "=)"; la variables son validas
		}else{
			echo "ERROR LA FECHA INICIAL DEBE DE SER MENOR IGUAL A LA FECHA LIMITE";
			exit();
		}
	}else{
		echo "SELECCIONAR UN RANGO DE FECHAS";
		exit();
	}
}else{
	echo "ERROR NO EXISTEN LA FECHAS";
	exit();
}


if(isset($_POST['tabla'])){
	if(!empty($_POST['tabla'])){
		//la variable cumple con los requerimminetos necsarios
	}else{
		echo "SELECIONE EL REPORTE QUE DESEA VISUALIZAR";
		exit();
	}
}else{
	echo "ERROR NO SE TIENE REGISTRADO EL REPORTE";
	exit();
}
echo "</font>";

/////////////////encabezados
if($_POST['tabla']=="producto"){
	reporte_productos();
	exit();
}
if($_POST['tabla']=='proveedor'){
	reporte_proveedores();
	exit();
}
if($_POST['tabla']=='borrados'){
	reporte_borrados();
	exit();
}

$tipo_folio="A";
if($_POST['tabla']=='cancelacion'){
	echo "<table class='style2'>
	<tr><td>Ver</td><td>Folio</td><td>Fecha</td><td>Tipo</td></tr>";
}else{	
	if($_POST['tabla']!='borrados'){
		echo "<table class='style2'><tr>";
		if($nivel['nivel']<=1){
			echo "<td>Cancelar</td>";
		}
		
		echo "<td>Ver</td><td>Folio</td><td>Fecha</td></tr>";
		
		}
}


if($_POST['tabla']=='compra'){
	$comprasfac=mysql_query("select * from comprafac where id_compra like '%".$_POST['folio']."%' and fecha>='".$_POST['f_inicial']."' and fecha<='".$_POST['f_limite']."'");
	$c=mysql_num_rows($comprasfac);
}
///////////ordenamiento  si son de la tabla cancelaciones
if($_POST['tabla']=='cancelacion'){
	$r=mysql_query("select * from ".$_POST['tabla']." where id like '%".$_POST['folio']."%' and fecha>='".$_POST['f_inicial']."' and fecha<='".$_POST['f_limite']."' order by tipo,id");
}elseif($_POST['tabla']=='borrados'){
	//$r=mysql_query("select * from ".$_POST['tabla']." group by tabla");
}else{
	$r=mysql_query("select * from ".$_POST['tabla']." where id_".$_POST['tabla']." like '%".$_POST['folio']."%' and fecha>='".$_POST['f_inicial']."' and fecha<='".$_POST['f_limite']."'");
}

if(mysql_num_rows($r)>0 || $c>0){
	if($c>0){
	//////////////////compras facturadas
		while($m2=mysql_fetch_array($comprasfac)){
			
			$cancelar="cancelar2(".$m2['id_'.$_POST['tabla']].")";
			$q2=mysql_query("select * from detalle where tipo='".$_POST['tabla']."fac' and id =".$m2['id_'.$_POST['tabla']]);
			//////////filtro para mostrar compras facturadas no canceladas
			if(mysql_num_rows($q2)>0){
				if($nivel['nivel']<=1){
					echo "<tr><td align='center'><img src='imagenes/borrar.png' width='20px' height='20px' onclick='".$cancelar."'></td><td align='center'><img src='imagenes/info.png' width='20px' height='20px' onclick='ver2(".$m2['id_'.$_POST['tabla']].")'></td><td align='center'>".$tipo_folio.$m2['id_'.$_POST['tabla']]."</td><td align='center'>".$m2['fecha']."</td></tr>";
				}else{
					echo "<tr><td align='center'><img src='imagenes/info.png' width='20px' height='20px' onclick='ver2(".$m2['id_'.$_POST['tabla']].")'></td><td align='center'>".$tipo_folio.$m2['id_'.$_POST['tabla']]."</td><td align='center'>".$m2['fecha']."</td></tr>";
				}
			}
		}
		
	}
	//////////separacion si es compra
	if($_POST['tabla']=='compra'){
				echo "</table><br><br>";
				echo "<div id='oculto' style='display:none;'>";
				echo "<table class='style2'><tr>";
				if($nivel['nivel']<=1){
					echo "<td>Cancelar</td>";
				}
				
				echo "<td>Ver</td><td>Folio</td><td>Fecha</td></tr>";
	}
	/////////////borrados
	if($_POST['tabla']=='borrados'){
		/*$rr=mysql_query("select * from borrados order by id_anterior");
		echo "<table class='style2'>
				<tr><td>Folio</td><td>Id anterior</td><td>Nombre</td><td>descripcion</td><td>Fecha</td><td>Restaurar</td></tr>";
		while($mm=mysql_fetch_array($rr)){
			echo "<tr><td colspan='6' align='center' bgcolor='#271964'><b style='color:#fff;'>".strtoupper($mm['tabla'])."</b></td></tr>";
			$rr=mysql_query("select * from ".$_POST['tabla']." where id_".$_POST['tabla']." like '%".$_POST['folio']."%' and fecha>='".$_POST['f_inicial']."' and fecha<='".$_POST['f_limite']."' and tabla='".$mm['tabla']."'");
			while($mm2=mysql_fetch_array($rr)){
				echo "<tr><td>".$mm2['id_borrados']."</td><td>".$mm2['id_anterior']."</td><td>".$mm2['nombre']."</td><td>".$mm2['descripcion']."</td><td>".$mm2['fecha']."</td><td align='center'><img src='imagenes/agregar.png' style='width:15px;' onclick='restaurar(".$mm2['id_borrados'].")'></td></tr>";
			}
		}
		echo "</table>";
		exit();*/
	}
		
	/////////////asignacin de tipo b si tabla es compra	
	if($_POST['tabla']=='compra'){
		$tipo_folio="B";
	}else{
		$tipo_folio="";
	}
	//////////compras no facturadas y todas las otras tablas
	$marcador1=0;$marcador2=0;$marcador3=0;$marcador4=0;
	while($m=mysql_fetch_array($r))
	{
		if($_POST['tabla']=='cancelacion')
		{
			////////////encabezados para el tipo de cancelaciones
			
			if($m['tipo']=='comprafac' || $m['tipo']=='compra'){
				if($marcador1==0){
					echo "<tr><td colspan='4' bgcolor='#271964' align='center'><font color='#fff'><b>COMPRAS</b></font></td></tr>";
					$marcador1++;
				}
			}elseif($m['tipo']=='entrada'){
				if($marcador2==0){
					echo "<tr><td colspan='4' bgcolor='#271964' align='center'><font color='#fff'><b>ENTRADAS</b></font></td></tr>";
					$marcador2++;
				}
			}elseif($m['tipo']=='salida'){
				if($marcador3==0){
					echo "<tr><td colspan='4' bgcolor='#271964' align='center'><font color='#fff'><b>SALIDAS</b></font></td></tr>";
					$marcador3++;
				}
			}else{
				if($marcador4==0){
					echo "<tr><td colspan='4' bgcolor='#271964' align='center'><font color='#fff'><b>VENTAS</b></font></td></tr>";
					$marcador4++;
				}
			}
			
			/////////descripcion de la cancelacion
			$q2=mysql_query("select * from detalle where tipo='".$m['tipo']."-cancelada' and id=".$m['id']);
			if(mysql_num_rows($q2)>0)
			{
				if($m['tipo']=='comprafac')
				{/////////////////compra facturada cancelada
					echo "<tr><td align='center'><img src='imagenes/info.png' width='20px' height='20px' onclick='ver(".$m['id_'.$_POST['tabla']].")'></td><td align='center'>A".$m['id']."</td><td align='center'>".$m['fecha']."</td><td>compra</td></tr>";
				}elseif($m['tipo']=='compra')
				{///////////////compra canceladas
					echo "<tr><td align='center'><img src='imagenes/info.png' width='20px' height='20px' onclick='ver(".$m['id_'.$_POST['tabla']].")'></td><td align='center'>B".$m['id']."</td><td align='center'>".$m['fecha']."</td><td>compra</td></tr>";
				}else{
				//////////7entradas y ventas  cancelada
					echo "<tr><td align='center'><img src='imagenes/info.png' width='20px' height='20px' onclick='ver(".$m['id_'.$_POST['tabla']].")'></td><td align='center'>".$m['id']."</td><td align='center'>".$m['fecha']."</td><td>".$m['tipo']."</td></tr>";
				}					
			}
		}else
		{
			$cancelar="cancelar(".$m['id_'.$_POST['tabla']].")";
			$q2=mysql_query("select * from detalle where tipo='".$_POST['tabla']."' and id=".$m['id_'.$_POST['tabla']]);
			if(mysql_num_rows($q2)>0){
				if($nivel['nivel']<=1){
					echo "<tr><td align='center'><img src='imagenes/borrar.png' width='20px' height='20px' onclick='".$cancelar."'></td><td align='center'><img src='imagenes/info.png' width='20px' height='20px' onclick='ver(".$m['id_'.$_POST['tabla']].")'></td><td align='center'>".$tipo_folio.$m['id_'.$_POST['tabla']]."</td><td align='center'>".$m['fecha']."</td></tr>";
				}else{
					echo "<tr><td align='center'><img src='imagenes/info.png' width='20px' height='20px' onclick='ver(".$m['id_'.$_POST['tabla']].")'></td><td align='center'>".$tipo_folio.$m['id_'.$_POST['tabla']]."</td><td align='center'>".$m['fecha']."</td></tr>";
				}
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
	/*$q1="select * from producto where nombre like '%".$_POST['folio']."%'order by nombre";
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
	</div>";*/
	echo "<div id='imptabla' ><br><br><table class='style2' border='1'>";
	echo "<tr><td>Producto</td><!--td>Costo Ponderado</td--><td>Ultimos Costos</td><td colspan='2'>Compras</td></tr>";
	$q="select * from producto where nombre like '%".$_POST['folio']."%'order by nombre";
	$r=mysql_query($q);
	while($m=mysql_fetch_array($r)){
		$costo=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$m['id_producto']));
		$ultimo_costo=mysql_query("SELECT * FROM (select * from detalle where id_producto=".$m['id_producto'].") as d WHERE d.tipo='compra' or d.tipo='comprafac' order by id_detalle desc LIMIT 3");
		$uc="";
		while($ul_co=mysql_fetch_array($ultimo_costo)){
			if($ul_co["precio_adquisicion"]!=''){
				$uc=$uc."$".$ul_co["precio_adquisicion"]."<br>";				
			}
		}
		echo "<tr><td style='height:50px;'>".$m['nombre']."</td><!--td>$".$costo['precio']."</td--><td>".$uc."</td><td>".round(piezas($m['id_producto']),5)."</td><td>$".dinero($m['id_producto'])."</td></tr>";
	}
	echo "<table>
	</div>";
}

function piezas($id){
	$q=mysql_fetch_array(mysql_query("select sum(cantidad)as c from detalle where id_producto=".$id." and gasto='no' and tipo='compra'"));
	$q2=mysql_fetch_array(mysql_query("select sum(cantidad)as c from detalle where id_producto=".$id." and gasto='no' and tipo='comprafac'"));
	$total=$q['c']+$q2['c'];
	return $total;
}
function dinero($id){
	$q=mysql_query("select * from detalle where id_producto=".$id." and gasto='no'");
	$total=0;
	while($m=mysql_fetch_array($q)){
		if($m['tipo']=='compra' || $m['tipo']=='comprafac'){
			$total=$total+$m['importe'];
		}	
	}
	return $total;
}
 
function reporte_proveedores(){

	$q="SELECT c.id_proveedor,p.nombre FROM comprafac as c,proveedor as p WHERE c.fecha>='".$_POST['f_inicial']."' and c.fecha<='".$_POST['f_limite']."' and c.id_proveedor = p.id_proveedor group by c.id_proveedor order by p.nombre";
	$r=mysql_query($q);
	echo "<table class='style2' border='1'><tr><td>Proveedor</td><td>Total pagado</td></tr>";
	while($m=mysql_fetch_array($r)){///////////recorremos los proveedores a los que le hemos comprado
		$descuento=0;$ajuste=0;$importe=0;$total=0;	
		$compraf="select * from comprafac where id_proveedor=".$m['id_proveedor']." and fecha>='".$_POST['f_inicial']."' and fecha<='".$_POST['f_limite']."'";
		$comprafac=mysql_query($compraf);
		while($m2=mysql_fetch_array($comprafac)){///////////obtenemos descuentos y ajuste de cada compra
			$descuento=$descuento+$m2['descuento'];
			$ajuste=$ajuste+$m2['iva'];
			$d="select sum(importe) as importe from detalle where id=".$m2['id_compra']." and tipo='comprafac'";
			$detalle=mysql_fetch_array(mysql_query($d));//////////////obtenemos los importes por compra
			$importe=$importe+$detalle['importe'];
		}
		$prov=mysql_fetch_array(mysql_query("select * from proveedor where id_proveedor=".$m['id_proveedor']));
		$total=$importe+$ajuste-$descuento;
		echo "<tr><td>".$prov['nombre']."</td><td align='center'>$".number_format($total,2,".",",")."</td></tr>";
	}
	echo "</table><br><br><br>";
	
	
	///////////compras no facturadas
	
	$q="SELECT c.id_proveedor,p.nombre FROM compra as c,proveedor as p WHERE c.fecha>='".$_POST['f_inicial']."' and c.fecha<='".$_POST['f_limite']."' and c.id_proveedor = p.id_proveedor group by c.id_proveedor order by p.nombre";
	$r=mysql_query($q);
    echo "<table id='oculto2' class='style2' style='display:none;' border='1'>
    <tr><td style='width:350px;'>Proveedor</td><td style='width:400px;'>Total pagado</td></tr>";
	while($m=mysql_fetch_array($r)){///////////recorremos los proveedores a los que le hemos comprado
		$descuento=0;$ajuste=0;$importe=0;$total=0;	
		$com="select * from compra where id_proveedor=".$m['id_proveedor']." and fecha>='".$_POST['f_inicial']."' and fecha<='".$_POST['f_limite']."'";
		$compra=mysql_query($com);
		while($m2=mysql_fetch_array($compra)){///////////obtenemos descuentos y ajuste de cada compra
			$descuento=$descuento+$m2['descuento'];
			$ajuste=$ajuste+$m2['iva'];
			$d="select sum(importe) as importe from detalle where id=".$m2['id_compra']." and tipo='compra'";
			$detalle=mysql_fetch_array(mysql_query($d));//////////////obtenemos los importes por compra
			$importe=$importe+$detalle['importe'];
		}
		$prov=mysql_fetch_array(mysql_query("select * from proveedor where id_proveedor=".$m['id_proveedor']));
		$total=$importe+$ajuste-$descuento;
		echo "<tr><td>".$prov['nombre']."</td><td align='center'>$".number_format($total,2,".",",")."</td></tr>";
	}
	echo "</table>";
}

function reporte_borrados(){
    $separacion=mysql_query("select * from borrados group by tabla order by tabla");
   
    while($titulo=mysql_fetch_array($separacion)){
         echo "<table class='style2'>";
	   $rr=mysql_query("select * from borrados where tabla='".$titulo['tabla']."' order by nombre");
        echo "<tr><td colspan='6' align='center'>".strtoupper($titulo['tabla'])."</td></tr>";
	   echo "<tr><td>Folio</td><td>Id anterior</td><td>Nombre</td><td>Descripcion</td><td>Fecha</td><td>Restaurar</td></tr>";
		  while($mm2=mysql_fetch_array($rr)){
              $ex=explode("%",$mm2['descripcion']);
				echo "<tr><td>".$mm2['id_borrados']."</td><td>".$mm2['id_anterior']."</td><td>".$mm2['nombre']."</td><td>".$ex[0]."</td><td>".$mm2['fecha']."</td><td align='center'><img src='imagenes/agregar.png' style='width:15px;' onclick='restaurar(".$mm2['id_borrados'].")'></td></tr>";
		}
    echo "</table>";
    }
    
		
}
?>