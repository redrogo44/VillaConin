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
		<script src="js/contenido.js"></script>
		<script type="text/javascript" src='js/jquery-2.1.1.js'></script>
		<script type="text/javascript" src='js/jquery-ui.min.js'></script>
		<script type="text/javascript">
			$(function(){
				$('#buscar_tabla').autocomplete({
					source : 'productos.php'
				});
			});
		</script>

	</head>
	<body onload='load("","<?php echo$_GET['op'];?>")'>
		<div class="container">
			<?php
			/////////////////////////Menu
			menu();
			?>
		<header>	
		<input style='position:absolute;right:0px;' placeholder="Buscar" id="buscar_tabla" onkeyup='load(this.value,"<?php echo$_GET['op'];?>")' onchange='load(this.value,"<?php echo$_GET['op'];?>")'>
		</header>
		<center>
		<div id='resultado' name='resultado'>
		</div>
		</center>
		</div><!-- /container -->
	</body>
	
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
			function redireccionar(n){
				if(n==1){
					window.location="configuraciones.php?op=proveedor";
				}else if(n==2){
					window.location="configuraciones.php?op=producto";
				}else{
					window.location="configuraciones.php?op=categoria";
				}
			}
			
			function popup(){
				window.open("popup.php?op=<?php echo $_GET['op']; ?>&act=agregar", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
			}
			
			function asignar_tipo(){
				window.open("asignacion.php", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
			}
			
			function popup2(op,num){
				//alert("operacion"+op+" numero "+num);
				if(op==1){//////////////modificar
					window.open("popup.php?op=<?php echo $_GET['op']; ?>&act=modificar&num="+num, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
				}else if(op==2){////////////////borrar
					if(confirm("Esta seguro de suspender el registro?")){
						window.open("popup.php?op=<?php echo $_GET['op']; ?>&act=borrar&num="+num, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
					}
			}				
			}
		</script>
</html>