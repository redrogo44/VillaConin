<?php
require 'funciones.php';
conectar();
session_start();
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
		<script>
		$(function(){
				$('#producto').autocomplete({
					source : 'producto.php',
					select : function(event, ui){
                       $('#description').slideUp('fast', function(){
                            $('#description').html(
                                '<h3>Detalles del producto</h3>' +
                                '<strong>Nombre: </strong>' + ui.item.value + '<br/>' +
                                '<strong>Descripcion: </strong>' + ui.item.descripcion +'<br/>'+
                                '<strong>Uniidad: </strong>' + ui.item.unidad +'<br/>'+
                                '<strong>Categoria: </strong>' + ui.item.categoria  +'<br/>'+
                                '<strong>Subcategoria: </strong>' + ui.item.subcategoria
                            );
                       });
					   if(ui.item.descripcion=='---SUSPENDIDO---'){
							if(confirm('El producto se encuentra suspendido desea restaurarlo?')){
								restarurar(ui.item.id);
							}
						}
                       $('#description').slideDown('fast');
                   }
				});
			});
			function popup(){
			window.open("popup.php?op=producto&act=agregar", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
			}
			function restarurar(i){
			window.open("restaurar2.php?id="+i, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=200, height=200");
			}
		</script>
	</head>
	<body>
		<div class="container">
			<?php
			/////////////////////////Menu
			menu();
			?>
			<header>
			<!-- Contenido-->	
			<?php
				if(isset($_GET['e_status']) && $_GET['e_status']==3){
				echo"<script>";
				echo "alert('Se a registrado  correctamente la entrada');";
				echo"</script>";
				}
				
				if(isset($_GET['e_status']) && $_GET['e_status']==2){
					if(isset($_GET['folio'])){
						$d['m']=$_GET['folio'];
					}else{
						$dato=mysql_query("select max(id_entrada) as m,fecha from entrada");
						$d=mysql_fetch_array($dato);
					}
					
					echo "<table border='1' style='position:absolute;left:40%;'>";
					echo "<tr><td><h2>FOLIO</h2></td><td><h2>Entrada</h2></td><td><h2>FECHA</h2></td></tr>";
					echo "<tr><td align='center'>".$d['m']."</td><td></td><td align='center'>".$d['fecha']."</td></tr>";
					echo "</table>";
					echo "<br><br><br><br><br>";
					
					echo "<table border='1' class='style2'>";
					echo "<tr><td>Borrar</td><td>Cantidad</td><td>Producto</td><td>Costo</td><td>Importe</td></tr>";
					$entrada=mysql_query("select * from detalle where tipo='entrada' and id=".$d['m']);
					$mostrar_cantidad=0;
					while($show=mysql_fetch_array($entrada)){
						$producto=mysql_query('select * from producto where id_producto='.$show['id_producto']);
						$desc=mysql_fetch_array($producto);
						$inventario=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$show['id_producto']));
						$link='window.location="entrada2.php?opcion=borrar&id_detalle='.$show['id_detalle'].'"';
						echo "<tr><td align='center'><img src='imagenes/borrar.png' width='15px' height='15px' onclick='".$link."'></td><td>".$show['cantidad']."</td><td>".$desc['nombre']."</td><td>".$inventario['precio']."</td><td>".$inventario['precio']*$show['cantidad']."</td></tr>";
						$subtotal=$subtotal+($inventario['precio']*$show['cantidad']);
						$mostrar_cantidad=$mostrar_cantidad+$show['cantidad'];
						//$impuesto=$impuesto+(($inventario['precio']*$show['cantidad'])*($desc['impuesto']/100));
					}
					echo "<tr><td  align='center'>Total</td><td>".$mostrar_cantidad."</td><td colspan='2' align='right'>Total</td><td>$".$subtotal."</td></tr>";
					/*echo "<tr><td colspan='4' align='right'>impuesto</td><td>$".$impuesto."</td></tr>";
					echo "<tr><td colspan='4' align='right'>Total</td><td>$".($subtotal+$impuesto)."</td></tr>";
					*/
					echo "<form action='entrada2.php' method='POST'>";
					$mas="<img src='imagenes/agregar.png' width='15px' height='15px' onclick='popup();'>";
					echo "<tr><td align='center' colspan='2'><input type='text' name='cantidad' required></td><td><input type='text' name='producto' id='producto'>".$mas."</td><td></td><td></td></tr>";
					echo "<tr><td align='center' colspan='3'><input type='submit' name='opcion' value='Guardar'></td>";
					echo "<input type='hidden' name='folio' value='".$d['m']."'>";
					echo "<input type='hidden' name='e_status' value='2'>";
					echo "</form>";
					echo "<form action='entrada2.php' method='POST'>";
					echo "<td colspan='2'><input type='submit' name='opcion' value='Finalizar'></td></tr>";
					echo "<td><input type='hidden' name='folio' value='".$d['m']."'></td></tr>";
					echo "</form>";
					echo "</table>";	
					echo "<div id='description' align='left'>";
					echo "</div>";
				}else{
					if($_SESSION['folio_entrada']!=0){
						$delete=mysql_query("delete from detalle where id=".$_SESSION['folio_entrada']." and tipo='entrada'");
					}
					echo "<h2>Esta por generar una nueva entrada al inventario</h2><br>";
					echo "<a href='entrada2.php?e_status=1'><button><strong>Siguiente</h2></strong></a>";
				}
			
			?>
			</header> 
		</div><!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>