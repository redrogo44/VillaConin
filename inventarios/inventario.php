<?php
require 'funciones.php';
conectar();
session_start();
$_SESSION['table'] = $_GET['op'];
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
		<script src="js/mostrar_inventario.js"></script>
		<script type="text/javascript" src='js/jquery-2.1.1.js'></script>
		<script type="text/javascript" src='js/jquery-ui.min.js'></script>
		<script type="text/javascript">
			$(function(){
				$('#b_inv').autocomplete({
					source : 'categoria.php'
				});
			});
		</script>
	</head>
	<body>
		<div class="container">
			<?php
			/////////////////////////Menu
			menu();
			?>
		<header>	
		<input style='position:absolute;right:130px;' placeholder="Buscar Categoria" id="b_inv" onkeyup='b_inv(this.value)' onblur='b_inv(this.value)' >
		
		</header>
		<center><div id='resultado' name='resultado'>
		</div>
		</center>
		</div><!-- /container -->
	</body>
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
		
</html>