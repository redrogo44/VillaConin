<?php
require 'funciones.php';
session_start();
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
		<!--script type="text/javascript">
			$(function(){
				$('#buscar').autocomplete({
					source : 'productos.php'
				});
			});
		</script-->
	</head>
	<body>
	
		<div class="container">
		
			<?php
			/////////////////////////Menu
			
			menu();
			?>
			<header>
			<!-- Contenido-->			
			<h1>Villa Conin<span>Sistema de Inventario</span></h1>
			<form method='POST' action='formato.php' target='_blanck'>
			<label>Tipo</label>
			<select name='categoria'>
			<?php
			$q=mysql_query("select * from categoria");
			while($m=mysql_fetch_array($q)){
				echo "<option value='".$m['id_categoria']."-".$m['nombre']."'>".$m['nombre']."</option>";
			}
			?>
			</select>
			<input type='submit' name='opcion' value='Imprimir formato'>
			</form>
		</header> 
		</div><!-- /container -->
		
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>