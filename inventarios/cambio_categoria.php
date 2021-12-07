<?php
require 'funciones.php';
conectar();
//////se hizo modificaciones en la categoria???
$producto=mysql_fetch_array(mysql_query("select * from producto where nombre='COBERTURA COLONIAL'"));///origen
$_POST['id']=$producto['id_producto'];
$categoria=mysql_fetch_array(mysql_query("select * from categoria where nombre='CERVEZA'"));//destino
$subcategoria=mysql_fetch_array(mysql_query("select * from subcategoria where nombre='CERVEZA'"));//destino
$fecha_inicial='0000-00-00';
$fecha_limite='';
$inv_actual=0;
$sobrantes=0;
$cp=0;
if($producto['id_categoria']!=$categoria['id_categoria']){
	
		////////cortes de la categoria destino
		/////////obtenemos un producto de la categoria destino para obtener los cortes hechos
		$pd=mysql_fetch_array(mysql_query("select * from producto where id_categoria=".$categoria['id_categoria']." LIMIT 1"));
		////obtenemos los cortes
		$cortes=mysql_query("select * from detalle where id_producto=".$pd['id_producto']." and tipo='faltante'");
		
		///////////no se han hecho cortes entonces a la categoria destino asi que se borran los de la categoria de origen y se actualiza el inventario
		if(mysql_num_rows($cortes)==0){
			//mysql_query("delete from detalle where id_producto=".$_POST['id']." and tipo='faltante'");
			//mysql_query("Update inventario set cantidad=0,precio=0,fecha='0000-00-00',hora='00:00:00' where id_producto=".$_POST['id']);
		}else{
			///////si existieron cortes de la categoria destino
			while($m=mysql_fetch_array($cortes)){
				
					//////////////obtenemos las fechas de los cortes y actualizamos
					$fecha=mysql_fetch_array(mysql_query("select * from corte_inventario where id_corte_inventario=".$m['id']));
					///////////sumamos los movimientos
					$fecha_limite=$fecha['fecha'];
					echo "fecha inicial:".$fecha_inicial."___fecha limite:".$fecha_limite."<br>";
					///////////id de compras hechas en el periodo
						$compras=mysql_query("select id_compra from compra where fecha>'".$fecha_inicial."'  and fecha<='".$fecha_limite."'");
						$comprasfac=mysql_query("select id_compra from comprafac where fecha>'".$fecha_inicial."' and fecha<='".$fecha_limite."'");
						$cantidad_compra=0;
						$importe_compras=0;
						while($compras2=mysql_fetch_array($compras)){
							$c=mysql_query("select sum(cantidad)as t,sum(importe) as imp from detalle where id_producto=".$_POST['id']." and tipo='compra' and id=".$compras2['id_compra'].' and gasto="no"');
							$cant=mysql_fetch_array($c);
							$cantidad_compra=$cantidad_compra+$cant['t'];
							$importe_compras=$importe_compras+$cant['imp'];
						}
						
						while($comprasfac2=mysql_fetch_array($comprasfac)){
							$c=mysql_query("select sum(cantidad)as t,sum(importe) as imp from detalle where id_producto=".$_POST['id']." and tipo='comprafac' and id=".$comprasfac2['id_compra'].' and gasto="no"');
							$cant=mysql_fetch_array($c);
							$cantidad_compra=$cantidad_compra+$cant['t'];
							$importe_compras=$importe_compras+$cant['imp'];
						}
						
						echo $cantidad_compra."__".$importe_compras."<br>";
						/////////entradas
						$entradas=mysql_query("select * from entrada where fecha>'".$fecha_inicial."' and fecha<='".$fecha_limite."'");
						$cantidad_entrada=0;
						while($entradas2=mysql_fetch_array($entradas)){
							$ce=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$_POST['id']." and tipo='entrada' and id=".$entradas2['id_entrada']);
							$cante=mysql_fetch_array($ce);
							$cantidad_entrada=$cantidad_entrada+$cante['t'];
						}
						echo $cantidad_entrada."<br>";
						/////////salidas
						$salidas=mysql_query("select * from salida where fecha>'".$$fecha_inicial."' and fecha<='".$fecha_limite."'");
						$cantidad_salida=0;
						while($salidas2=mysql_fetch_array($salidas)){
							$cs=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$_POST['id']." and tipo='salida' and id=".$salidas2['id_salida']);
							$cants=mysql_fetch_array($cs);
							$cantidad_salida=$cantidad_salida+$cants['t'];
						}
						
						echo $cantidad_salida."<br>";
						/////////ventas
						$ventas=mysql_query("select * from venta where fecha>'".$fecha_inicial."' and fecha<='".$fecha_limite."'");
						$cantidad_venta=0;
						while($ventas2=mysql_fetch_array($ventas)){
							$cv=mysql_query("select sum(cantidad)as t from detalle where id_producto=".$_POST['id']." and tipo='venta' and id=".$ventas2['id_venta']);
							$cantv=mysql_fetch_array($cv);
							$cantidad_venta=$cantidad_venta+$cantv['t'];
						}
						echo $cantidad_venta."<br>";
						////////cortes de la categoria de origen
						$p_origen=mysql_query("select * from detalle where id_producto=".$_POST['id']." and tipo='faltante'");
						//////////sumamos los consumidos en el rango de fechas segun los corte hechos en la categoria de origen
						$consumidos=0;
						while($faltante_aux=mysql_fetch_array($p_origen)){
							$cortes_origen=mysql_fetch_array(mysql_query("select * from corte_inventario where id_corte_inventario=".$faltante_aux['id']));
							//////comparamos que sea menor  igual a la fecha del corte osea la fecha limite
							if($cortes_origen['fecha']>$fecha_inicial&&$cortes_origen['fecha']<=$fecha_limite){
								$consumidos=$consumidos+$faltante_aux['cantidad'];
								////////borramos el registro de detalle ya que ya no se utilizar
								mysql_query("delete from detalle where id_detalle=".$faltante_aux['id_detalle']);
							}
						}
						echo $consumidos."<br>";
						//////////////inventario actual
						$inv_inicial=$sobrantes+$cantidad_compra+$cantidad_entrada-$cantidad_salida-$cantidad_venta;
						echo $inv_inicial."<br>";
						//////costo ponderado
						if($inv_inicial<=0){////validacion entre cero
							$cp=(round((($sobrantes*$cp)+$importe_compras),5))/1;
						}else{
							$cp=(round((($sobrantes*$cp)+$importe_compras),5))/$inv_inicial;
						}
						$sobrantes=$inv_inicial+$consumidos;
						echo $sobrantes."<br>";
						//////// se hace la insercion del nuevo corte de inventario es decir el correspondiente a la categoria destino
						mysql_query("insert into detalle(id,cantidad,id_producto,precio_adquisicion,precio_venta,importe,tipo,gasto)
						values(".$m['id'].",".$consumidos.",".$_POST['id'].",".$cp.",0,".($consumidos*$cp).",'faltante','no')");
						
						/////cambiamos la fecha de inico por la del limite
						$fecha_inicial=$fecha_limite;
						
						
			}
		}
		
}

/////////actualizamos a la nueva categoria
mysql_query("update producto set id_categoria=".$categoria['id_categoria'].",id_subcategoria=".$subcategoria['id_subcategoria']." where id_producto=".$_POST['id']);
?>