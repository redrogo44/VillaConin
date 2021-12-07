<?php
require('../funciones2.php');
conectar();
echo "<table>";
echo "<tr><td>Tipo</td><td>Cantidad</td><td>Precio Adquisicion</td><td>Precio Venta</td><td>Importe</td><tr>";
$q=mysql_query("select * from producto where id_categoria=1");
while($m=mysql_fetch_array($q)){
	$d=mysql_query("select * from detalle where id_producto=".$m["id_producto"]);
	echo "<tr><td colspan='4' align='center'>".$m["nombre"]."</td></tr>";
	$ultimocosto=0;
	while($d2=mysql_fetch_array($d)){
		if($d2["tipo"]=="compra" || $d2["tipo"]=="comprafac"){
			$ultimocosto=$d2["precio_adquisicion"];
			$color="blue";
		}else{
			if($d2["tipo"]=="venta"){
				if($ultimocosto==$d2["precio_adquisicion"]){
					$color="lightblue"; 
				}else{
					$color="RED";
					///actualizamos los valores de precio de adquisicion
					mysql_query("update detalle set precio_adquisicion=".$ultimocosto." where id_detalle=".$d2["id_detalle"]);
				}	
			}else{
				$color="lightblue";
			} 
		}
		
		echo "<tr style='background-color:".$color.";'><td>".$d2["tipo"]."</td><td>".$d2["cantidad"]."</td><td>".$d2["precio_adquisicion"]."</td><td>".$d2["precio_venta"]."</td><td>".$d2["importe"]."</td><tr>";
	}
} 

echo "</table>";
?>