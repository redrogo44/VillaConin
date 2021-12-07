<?php
require 'funciones.php';
session_start();
if(!isset($_SESSION['usuario'])){
	$_SESSION['usuario']=$_GET['usuario'];
}
if(empty($_SESSION['usuario'])){
	header('Location: ../index.php');
	exit;
}

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
			if($_GET['error']==1){
				echo "<script>";
				echo "alert('ERROR NO EXISTE FOLIO DE COMPRA');";
				echo "</script>";
			}
			menu();
			?>
			<header>
			<!-- Contenido-->			
			<h1>Villa Conin<span>Sistema de Inventario</span></h1>
		</header> 
		</div><!-- /container -->
		
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>