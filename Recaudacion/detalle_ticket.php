<?php
require('../funciones2.php');
conectar();

if($_POST['tipo']=='alimento')
{
	$t=mysql_query("SELECT * FROM tickets WHERE id=".$_POST['id']);
	$ti=mysql_fetch_array($t);
	$tipo='ALIMENTOS';
	$letra='a';
}
if($_POST['tipo']=='bebida')
{
$t=mysql_query("SELECT * FROM tickets_vinos WHERE id=".$_POST['id']);
	$ti=mysql_fetch_array($t);
	$tipo='BEBIDAS';
	$letra='b';	
}

$total_ticket=0;
	
	echo"
		<table border='5'>
		<th colspan='5' align='center'><b>Detalle Ticket ".$tipo." Folio: ".$letra.$_POST['id']." ".$ti['estatus']."</b></th>
		<tr>
			<td align='center'><b>Producto</b></td>
			<td align='center'><b>Descripcion</b></td>
			<td align='center'><b>cantidad</b></td>
			<td align='center' style='width:100px'><b>Precio</b></td>
			<td align='center' style='width:100px'><b>Total</b></td>			
		</tr>";
		$producto=explode(",",$ti['productos']);
		$descripcion=explode(",",$ti['descripciones']);
		$cantidad=explode(",",$ti['cantidades']);
		$precio=explode(",",$ti['precios_unitarios']);
		$total=explode(",",$ti['totales']);
		if($tipo=='ALIMENTOS')
		{
			for ($i=1; $i <count($producto) ; $i++) 
			{ $total_ticket=$total[$i]+$total_ticket;
				echo"
						<tr>
							<td align='center'><b>".$producto[$i]."</b></td>
							<td align='center'><b>".$descripcion[$i]."</b></td>
							<td align='center'><b>".$cantidad[$i]."</b></td>
							<td align='center'><b>$ ".money_format("%i",$precio[$i])."</b></td>
							<td align='center' bgcolor='#EAE3CC'><b>$ ".money_format("%i", $total[$i])."</b></td>												
						</tr>
					";
			}
		}
		if($tipo=='BEBIDAS')
		{
			for ($i=1; $i <count($producto) ; $i++) 
			{ $total_ticket=$total[$i]+$total_ticket;
				$P=mysql_query("SELECT * FROM producto WHERE nombre='".$producto[$i]."' ");
				$pp=mysql_fetch_array($P);
				$ii=mysql_query("SELECT * FROM inventario WHERE id_producto=".$pp['id_producto']);
				$in=mysql_fetch_array($ii);
				echo"
						<tr>
							<td align='center'><b>".$producto[$i]."</b></td>
							<td align='center'><b>".$descripcion[$i]."</b></td>
							<td align='center'><b>".$cantidad[$i]."</b></td>
							<td align='center'><b>$ ".money_format("%i",$in['precio_tienda'])."</b></td>
							<td align='center' bgcolor='#EAE3CC'><b>$ ".money_format("%i", $total[$i])."</b></td>												
						</tr>
					";
			}
		}

		echo "
		<tr><td colspan='4' align='right'><b>Total Ticket </b></td><td bgcolor='#CEF770'><b>$ ".money_format("%i",$total_ticket)."</b></td></tr>
		</table>
		";
?>