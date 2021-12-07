<?php
require 'funciones.php';
conectar();
session_start();
$nivel=mysql_fetch_array(mysql_query("select * from usuarios where usuario='".$_SESSION['usuario']."'"));
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
		<script type="text/javascript" src="js/shortcut.js"></script>
		<script>
		<?php
		 $c2=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='mostrar facturados' and tipo='clave'"));
		 $c3=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='ocultar factutados' and tipo='clave'"));
		?>
		shortcut.add("Ctrl+Alt+<?php echo $c3['descripcion'];?>",function() {
		document.getElementById('oculto').style.display='none';
		});
		shortcut.add("Ctrl+Alt+<?php echo $c2['descripcion'];?>",function() {
		document.getElementById('oculto').style.display='block';
		});
		shortcut.add("Ctrl+Alt+<?php echo $c3['descripcion'];?>",function() {
		document.getElementById('oculto2').style.display='none';
		});
		shortcut.add("Ctrl+Alt+<?php echo $c2['descripcion'];?>",function() {
		document.getElementById('oculto2').style.display='block';
		});
		</script>
		<script>
/*		shortcut.add("Ctrl+Alt+N",function() {
			document.getElementById('oculto').style.display = 'block';
			});
		shortcut.add("Ctrl+Alt+S",function() {
			document.getElementById('oculto').style.display = 'none';
			});
		shortcut.add("Ctrl+Alt+N",function() {
			document.getElementById('oculto2').style.display = 'block';
			});
		shortcut.add("Ctrl+Alt+S",function() {
			document.getElementById('oculto2').style.display = 'none';
			});*/
				
			function popup(){
			window.open("popup.php?op=producto&act=agregar", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
			}
			function cancelacion(){
				
				tabla=document.getElementById('tabla').value;
				folio=document.getElementById('folio').value;
				f_inicial=document.getElementById('f_inicial').value;
				f_limite=document.getElementById('f_limite').value;
				var xmlhttp;

				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
				xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
					document.getElementById("resultado").innerHTML=xmlhttp.responseText;
					}
				  }
				xmlhttp.open("POST","buscar.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("tabla="+tabla+"&folio="+folio+"&f_inicial="+f_inicial+"&f_limite="+f_limite);
			}
			function ver(folio){
				tabla=document.getElementById('tabla').value;
				window.open("info.php?tabla="+tabla+"&folio="+folio, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
			}
			function ver2(folio){
				window.open("info.php?tabla=comprafac&folio="+folio, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
			}
			<?php
			if($nivel['nivel']==0 ||$nivel['nivel']==1){
				echo'
				function cancelar(folio){
				tabla=document.getElementById("tabla").value;
				if(confirm("Estas seguro de cancelar este movimiento?")){
					window.open("cancelacion.php?tabla="+tabla+"&folio="+folio, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
				}
				}
				function cancelar2(folio){
					if(confirm("Estas seguro de cancelar este movimiento?")){
						window.open("cancelacion.php?tabla=comprafac&folio="+folio, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
					}
				}
				
				';
			}
			?>
			
			function imprSelec()
			{
				var ficha=document.getElementById("imptabla");
				var ventimp=window.open(' ','popimpr');
				ventimp.document.write(ficha.innerHTML);
				ventimp.document.close();
				ventimp.print();
				ventimp.close();
				}
			function restaurar(i){
				if(confirm("Esta seguro de restaurar el producto")){
					window.location="restaurar.php?id="+i;
					}
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
			Fecha 
			<input id='f_inicial' style='width:150px;'type='date' name='f_inicial' max='<?php echo date('Y-m-d');?>' onchange='cancelacion()'>
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			Fecha limite
			<input id='f_limite' type='date' name='f_limite' max='<?php echo date('Y-m-d');?>' onchange='cancelacion()'>
			<br>
			Movimiento
			<select id='tabla'  style='width:150px;' onchange='cancelacion()'>
			<option></option>
			<option value='compra'>Compras</option>
			<option value='cancelacion'>Cancelaciones</option>
			<option value='borrados'>Suspendidos</option>
			<option value='entrada'>Entradas</option>
			<option value='producto'>Producto</option>
			<option value='proveedor'>Proveedor</option>
			<option value='salida'>Salidas</option>
			<option value='venta'>Ventas</option>
			</select>
			Folio o Producto
			<input type='text' id='folio' onkeyup='cancelacion()'>
			<input type='button' value='Refresh' onclick='location.reload();'/>
			</header> 
			<center>
			<div id='resultado'>
			</div>
			</center>
		</div><!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>