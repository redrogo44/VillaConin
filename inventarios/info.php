<?php
require 'funciones.php';
conectar();
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Inventario Villa Conin</title>
		<link rel="shortcut icon" href="../Imagenes/icono.png">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
		<script src="js/modernizr.custom.js"></script>
		<script type="text/javascript" src='js/jquery-2.1.1.js'></script>
		<script type="text/javascript" src='js/jquery-ui.min.js'></script>
		
	</head>
	<body>
		<div class="container">
			<header>
			<?php
			if(isset($_GET['tabla']) && !empty($_GET['tabla'])){
				if(isset($_GET['folio']) && !empty($_GET['folio'])){
					if($_GET['tabla']=="entrada" || $_GET['tabla']=="salida"){
						$q=mysql_query("select * from ".$_GET['tabla']." where id_".$_GET['tabla']."=".$_GET['folio']);
						if(mysql_num_rows($q)>0){
							echo "<table border='2'>";
							echo "<tr><th align='center'>Folio</th><th align='center'>Tipo</th><th align='center'>Fecha</th></tr>";
							while($m=mysql_fetch_array($q)){
								echo "<tr><td align='center' >".$m['id_'.$_GET['tabla']]."</td><td align='center'>".$_GET['tabla']."</td><td align='center'>".$m['fecha']."</td></tr>";
							}
							echo "</table><br><br>";
						
							/////detalle
							$d=mysql_query("select * from detalle where id=".$_GET['folio']." and tipo='".$_GET['tabla']."'");
							
							echo "<table class='style2'>";
							echo "<tr><td>Cantidad</td><td>Producto</td><td>Costo</td><td>Importe</td></tr>";
							$t=0;
							while($m2=mysql_fetch_array($d)){
								$p=mysql_query("select * from producto where id_producto=".$m2['id_producto']);
								$producto=mysql_fetch_array($p);
								echo "<tr><td align='center'>".$m2['cantidad']."</td><td>".$producto['nombre']."  ".$producto['descripcion']."</td>";
								$t=$t+$m2['importe'];
								echo "<td align='center'>".$m2['precio_adquisicion']."</td><td align='center'>".$m2['importe']."</td></tr>";
							}
							echo "<tr><td colspan='3' align='right'>Total</td><td align='center'>".$t."</td></tr>";
							echo "</table>";
						}else{
							echo "<h1>Error no existe informacion disponible</h1>";
						}
						
					}elseif($_GET['tabla']=="venta"){
						$q=mysql_query("select * from ".$_GET['tabla']." where id_".$_GET['tabla']."=".$_GET['folio']);
						if(mysql_num_rows($q)>0){
							echo "<table border='2'>";
							echo "<tr><td>Folio</td><td>Tipo</td><td>Fecha</td></tr>";
							while($m=mysql_fetch_array($q)){
								echo "<tr><td>".$m['id_'.$_GET['tabla']]."</td><td>".$_GET['tabla']."</td><td>".$m['fecha']."</td></tr>";
							}
							echo "</table><br><br>";
					
						/////detalle
							$d=mysql_query("select * from detalle where id=".$_GET['folio']." and tipo='".$_GET['tabla']."'");
							echo "<table class='style2'>";
							echo "<tr><td>Cantidad</td><td>Producto</td><td>Costo</td><td>Precio de venta</td><td>Importe</td></tr>";
							$total=0;
							while($m2=mysql_fetch_array($d)){
								$p=mysql_query("select * from producto where id_producto=".$m2['id_producto']);
								$producto=mysql_fetch_array($p);
								echo "<tr><td>".$m2['cantidad']."</td><td>".$producto['nombre']."  ".$producto['descripcion']."</td><td>".$m2['precio_adquisicion']."</td><td>".$m2['precio_venta']."</td><td>".$m2['importe']."</td></tr>";
								$total=$total+$m2['importe'];
							}
							echo "<tr><td colspan='4' align='right'>Total</td><td>".$total."</td></tr>";
							echo "</table>";
						}
					
					}elseif($_GET['tabla']=="compra" || $_GET['tabla']=="comprafac"){
					$complemento='';
					if($_GET['tabla']=="comprafac"){
						$q=mysql_query("select * from ".$_GET['tabla']." where id_compra=".$_GET['folio']);
						$complemento="A";
					}else{
						$q=mysql_query("select * from ".$_GET['tabla']." where id_compra=".$_GET['folio']);
						$complemento="B";
					}
						
						
						if(mysql_num_rows($q)>0){
							echo "<table border='2'>";
							echo "<tr><td>Folio</td><td>Tipo</td><td>Fecha</td></tr>";
							while($m=mysql_fetch_array($q)){
								echo "<tr><td>".$complemento.$m['id_compra']."</td><td>COMPRA</td><td>".$m['fecha']."</td></tr>";
								$impuesto=$m['iva'];
								$descuento=$m['descuento'];
							}
							echo "</table><br><br>";
					
						/////detalle
							$d=mysql_query("select * from detalle where id=".$_GET['folio']." and tipo='".$_GET['tabla']."'");
							echo "<table class='style2'>";
							echo "<tr><td>Cantidad</td><td>Producto</td><td>Costo</td><td>Importe</td></tr>";
							$total=0;$imp=0;$k=0;$j=0;
                            
							while($m2=mysql_fetch_array($d)){
								$p=mysql_query("select * from producto where id_producto=".$m2['id_producto']);
                                $producto=mysql_fetch_array($p);
                                ///////validamos si estamos mostrando una comra facturada o no para despues validar el importe
                                //if($m2['tipo']=='comprafac'){
                                    /////////////////realizamos la validacion para obtener el impuesto ya que depende si se tenia esa informacion desde un inicio o se agrego posteriormente esto se hace para que cuadre la descripcion con el total
                                    $aux_importe=$m2['cantidad']*$m2['precio_adquisicion'];
                                    /////////si el precio de la cantidad por el precio de adquisicion es igual al importe se agrego el impuesto en los ajustes
                                    if($aux_importe==$m2['importe']){
                                        echo "<tr><td>".$m2['cantidad']."</td><td>".$producto['nombre']."  ".$producto['descripcion']."</td><td align='center'>".$m2['precio_adquisicion']."</td><td align='center'>".$m2['importe']."</td></tr>";
                                         $k=$m2['importe'];
                                         $j=0;
                                    }else{
                                        /////////// es este caso el importe debe de ser mayor asi que eliminamos el impuesto que lo integra para sacar el importe
                                       
                                        echo "<tr><td>".$m2['cantidad']."</td><td>".$producto['nombre']."  ".$producto['descripcion']."</td><td align='center'>".$m2['precio_adquisicion']."</td><td align='center'>".$aux_importe."</td></tr>";
                                         $k=$aux_importe;
                                         $j=$m2['importe']-$aux_importe;
                                    } 
                                    
                                /*}else{
                                    ////////compras no facturadas
                                    echo "<tr><td>".$m2['cantidad']."</td><td>".$producto['nombre']."  ".$producto['descripcion']."</td><td align='center'>".$m2['precio_adquisicion']."</td><td align='center'>".$m2['importe']."</td></tr>";
                                    $k=$m2['importe'];
                                }*/
                                
                                
                                
								$total=$total+$k;
								$imp=$imp+$j;
                                
							}
							echo "<tr><td colspan='3' align='right'>Ssubtotal</td><td align='center'>$".$total."</td></tr>";
							echo "<tr><td colspan='3' align='right'>Impuesto</td><td align='center'>$".$imp."</td></tr>";
							echo "<tr><td colspan='3' align='right'>Ajuste</td><td align='center'>$".$impuesto."</td></tr>";
							echo "<tr><td colspan='3' align='right'>Descuento</td><td align='center'>$".$descuento."</td></tr>";
							$t=$total+$imp+$impuesto-$descuento;
							echo "<tr><td colspan='3' align='right'>Total</td><td align='center'>$".$t."</td></tr>";
							echo "</table>";
						}
						
						
						
					//////////cancelacion
					}elseif($_GET['tabla']=="cancelacion"){
					$total=0;$imp;
						$r=mysql_query("select * from ".$_GET['tabla']." where id_".$_GET['tabla']."=".$_GET['folio']);
						$m=mysql_fetch_array($r);
						$q2=mysql_query("select * from detalle where tipo='".$m['tipo']."-cancelada' and id=".$m['id']);
						
						echo "<table border='2'>";
						echo "<tr><td>Folio</td><td>Tipo</td><td>Fecha</td></tr>";
						$complemento_folio='';
						if($m['tipo']=="comprafac"){///////////////si es copmra facturada para que solo se use la palabra compra
							echo "<tr><td>A".$m['id_cancelacion']."</td><td>compra-cancelada</td><td>".$m['fecha']."</td></tr>";
						}else{
							if($m['tipo']=="compra"){
								echo "<tr><td>B".$m['id_cancelacion']."</td><td>".$m['tipo']."-cancelada</td><td>".$m['fecha']."</td></tr>";
							}else{
								echo "<tr><td>".$m['id_cancelacion']."</td><td>".$m['tipo']."-cancelada</td><td>".$m['fecha']."</td></tr>";
							}
							
						}
						echo "</table><br><br>";
						echo "<table class='style2'>";
						echo "<tr><td>Cantidad</td><td>Producto</td><td>Costo</td><td>Importe</td></tr>";
                        ///////////////descripcion del movimiento
						if(mysql_num_rows($q2)>0){
							while($m2=mysql_fetch_array($q2)){
								$p=mysql_query("select * from producto where id_producto=".$m2['id_producto']);
								$producto=mysql_fetch_array($p);
								echo "<tr><td>".$m2['cantidad']."</td><td>".$producto['nombre']."  ".$producto['descripcion']."</td><td align='center'>".$m2['precio_adquisicion']."</td><td align='center'>".$m2['precio_adquisicion']*$m2['cantidad']."</td></tr>";
								$total=$total+($m2['precio_adquisicion']*$m2['cantidad']);
								$imp=$imp+(($m2['precio_adquisicion']*$m2['cantidad'])*($producto['impuesto']/100));
							}
						}
						
						
						
						if($m['tipo']=='entrada'||$m['tipo']=='salida'||$m['tipo']=='venta'){//////////////si es entrada o salida solo mostramos total
							echo "<tr><td colspan='3' align='right'>Total</td><td>".$total."</td></tr>";	
						}else{
							if($m['tipo']=="comprafac"){
								$last=mysql_fetch_array(mysql_query("select * from comprafac where id_compra=".$m['id']));
							}else{
								$last=mysql_fetch_array(mysql_query("select * from compra where id_compra=".$m['id']));
							}
							echo "<tr><td colspan='3' align='right'>Subtotal</td><td align='center'>".$total."</td></tr>";
							echo "<tr><td colspan='3' align='right'>Impuesto</td><td align='center'>".($imp+$last['iva'])."</td></tr>";
							echo "<tr><td colspan='3' align='right'>Descuento</td><td align='center'>".$last['descuento']."</td></tr>";
							$t=$total+$last['iva']+$imp-$last['descuento'];
							echo "<tr><td colspan='3' align='right'>Total</td><td align='center'>".$t."</td></tr>";
						}
					echo "</table>";	
					}else{
						echo "<h1>Error no existe la tabla indicada</h1>";
					}
				}else{
					echo "<h1>Error la varible folio no existe</h1>";
				}
			}else{
				echo "<h1>Error la variable tabla esta vacia</h1>";
			}
			?>
			</header> 
			<center>
			
	</body>
</html>