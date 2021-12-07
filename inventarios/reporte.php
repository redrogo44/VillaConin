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
		<script type="text/javascript" src="js/shortcut.js"></script>
		<script src="js/modernizr.custom.js"></script>
		<script>
		shortcut.add("Ctrl+Alt+N",function() {
			document.getElementById('compras').style.display = 'block';
			});
		shortcut.add("Ctrl+Alt+S",function() {
			document.getElementById('compras').style.display = 'none';
			});
		</script>

	</head>
	<body>
		<div class="container">
			<?php
			/////////////////////////Menu
			menu();
			?>
			<header><table>
			<form action='reporte.php' method='POST'>
			<tr><td colspan='5' align='center'>Selecciona el periodo<br></td></tr>
			<tr><td><label>Fecha Inicial<label></td><td><input type='date' name='fecha_inicial' required></td><td><label>Fecha Limite<label></td><td><input type='date' name='fecha_limite' required></td>
			<td>
			<select name='tipo'>
			<option value='compra'>Compras</option>
			<option value='entrada'>Entradas</option>
			<option value='salida'>Salidas</option>
			<option value='venta'>Ventas</option>
			</select>
			</td><td><input type='submit' name='mostrar' value='mostrar'></td></tr>
			</form>
			</table>
			<!-- Contenido-->	
			<div class='sc'>
			
			
			<?php
			if(isset($_POST['mostrar'])){
				if($_POST['tipo']=='compra'){
					reporte_comprasfac($_POST['fecha_inicial'],$_POST['fecha_limite']);
				}else if($_POST['tipo']=='entrada'){
					reporte_entradas($_POST['fecha_inicial'],$_POST['fecha_limite']);
				}else if($_POST['tipo']=='salida'){
					reporte_salidas($_POST['fecha_inicial'],$_POST['fecha_limite']);
				}else{//////////venta
					repòrte_ventas($_POST['fecha_inicial'],$_POST['fecha_limite']);
				}
			}
			?>
			</div>
			</header> 
		</div><!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>