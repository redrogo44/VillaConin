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
		<script type="text/javascript" src='js/jquery-2.1.1.js'></script>
		<script type="text/javascript" src='js/jquery-ui.min.js'></script>
		<script type="text/javascript" src="js/shortcut.js"></script>
		<script src="js/modernizr.custom.js"></script>
		<script>
			$(function(){
				$('#proveedor').autocomplete({
					source : 'proveedor.php'
				});
			});
			$(function(){
				$('#product').autocomplete({
					source : 'producto.php',
					select : function(event, ui){
                       $('#description').slideUp('fast', function(){
                            $('#description').html(
                                '<h3>Detalles del producto</h3>' +
                                '<strong>Nombre: </strong>' + ui.item.value + '<br/>' +
                                '<strong>Descripcion: </strong>' + ui.item.descripcion+'<br/>'+
								'<strong>Uniidad: </strong>' + ui.item.unidad+'<br/>'+
                                '<strong>Categoria: </strong>' + ui.item.categoria+'<br/>'+
                                '<strong>Subcategoria: </strong>' + ui.item.subcategoria+'<br/>'+
                                '<strong>Costo:$ </strong>' + ui.item.costo+'<br/>'+
                                '<strong>Precio de Venta:$ </strong>' + ui.item.venta
                            );
                       });
					   if(ui.item.descripcion=='---SUSPENDIDO---'){
							if(confirm('El producto se encuentra suspendido desea restaurarlo?')){
								restarurar(ui.item.id);
							}
						}
					   $("#pv").val(ui.item.venta);
					    $('#precio_venta').html(ui.item.venta);
					    $('#importe').html($("#pv").val()*$("#cantidad").val());
                       $('#description').slideDown('fast');
                   }
				});
			});
		</script>
		<script >
			function modificar(){
				p=document.getElementById('product').value;
				window.open("popup.php?act=modificarprecio&producto="+p, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
			}
			function agregar(op,tabla){
				//alert(op);
				if(op=='***'){
					window.open("popup.php?op="+tabla+"&act=agregar", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
				}
			}
			function nuevo(tabla){
				window.open("popup.php?op="+tabla+"&act=agregar", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
			}
			function calcular_importe(){
			x=document.getElementById('cantidad').value;
			x2=document.getElementById('pv').value;
			document.getElementById("precio_venta").innerHTML = x2;
			document.getElementById("importe").innerHTML = x*x2;
			}
			function validafp(){
				var x=document.getElementById("formapago").value;
				
				if(x!='EFECTIVO'){
					document.getElementById('cuentas').style.display = 'block';
					cuent=document.getElementById('cuenta').value;
					if(cuent!=''){
						document.getElementById('enviar').disabled =false;
					}else{
						document.getElementById('enviar').disabled =true;
					}
				}else{
					document.getElementById('cuentas').style.display = 'none';
					document.getElementById('enviar').disabled = false;
				}
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
			<div class='sc'>
			<?php
			if(isset($_GET['etapa'])){
				if($_GET['etapa']==2 && isset($_GET['folio'])){//////////////////etapa dos agragar los productos
					tabla_venta($_GET['folio']);
				}elseif($_GET['etapa']==3 && isset($_GET['folio'])){
					finaliza_venta($_GET['folio']);
				}else{///////////////error si no encuentra la etapa 
					echo "<h2>Error al realizar el proceso de venta</h2><br>";
					$link='window.location="venta.php"';
					echo "<button onclick='".$link."'><strong>Continuar</strong></button>";
				}
			}else{//////////////inicio de venta
				if($_SESSION['folio_venta']!=0){
						$delete=mysql_query("delete from detalle where id=".$_SESSION['folio_venta']." and tipo='venta'");
					}
				echo "<h2>Esta por generar una nueva venta</h2><br>";
				$link='window.location="venta2.php?etapa=1"';
				echo "<button onclick='".$link."'><strong>Continuar</strong></button>";
				
			}
			?>
			<div id='description' align='left'> 
			</div>
			</div>
			</header> 
		</div><!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		// Valores des la carga debancos b = id Banco y h elemento Html donde se cargaran los resultados
			$("#formadepago").change(function () {
				//alert("carga este pedo"+ this.value);
				if(this.value!="" && $("#formadepago").val!=""){
					document.getElementById('enviar').disabled = false;
				}else{
					document.getElementById('enviar').disabled = true;
				}
				carga_bancos(this.value, "#cuenta");
			});
			$("#cuenta").change(function () {
				if(this.value!="" && $("#formadepago").val!=""){
					document.getElementById('enviar').disabled = false;
				}else{
					document.getElementById('enviar').disabled = true;
				}
			});



				function carga_bancos(b,h)
				{
					//alert(b);
					if(b=="Pago en Efectivo"){
						$("cc2").hide();
						$(h).hide();
					}else{
						$("cc2").show();
						$(h).show();
					}
					 var datos = {
							"accion":"todas_cuentas",
							"id":b
						};
						  $.ajax({
								type: "POST",
								url: "../Config/Cuentas/acciones_cuentas.php",
								data: datos,
								dataType: "html",
								beforeSend: function(){
									  console.log('Conexion correcta ajax '+b);
								},
								error: function(e){
									  alert("error petición ajax"+b);
									  //cargaExternos(tipo);
								},
								success: function(data){   
									   $(h).empty();                                       
									 //alert(data);  
									 $( h ).append( data );  
									 //console.log('cargo '+b+' # = '+h);
								}
						  });                
				}
		</script>
		
	</body>

</html>