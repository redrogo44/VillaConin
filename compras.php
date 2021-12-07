<?php
require 'funciones.php';
session_start();
$_SESSION['facturado']='si';
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
		<script type="text/javascript" src='js/jquery-2.1.1.js'></script>
		<script type="text/javascript" src='js/jquery-ui.min.js'></script>
		<script type="text/javascript" src="js/shortcut.js"></script>
		<script src="js/modernizr.custom.js"></script>
		<script>
		function nuevo_proveedor(){
				window.open("popup.php?op=proveedor&act=agregar", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
		}
		function modificar_nuevo(){
				p=document.getElementById('product').value;
				window.open("popup.php?act=modificar&op=producto&producto="+p, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
		}
		function agregar_producto(){
			window.open("popup.php?op=producto&act=agregar", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
		}
		function borrar(indice){
			var cantidad = document.getElementById("lista_cantidad").value;
			var producto = document.getElementById("lista_productos").value;
			var costo = document.getElementById("lista_costo").value;
			var impuesto = document.getElementById("lista_impuesto").value;
			var gasto = document.getElementById("lista_gasto").value;
			var res_cantidad = cantidad.split(",");
			var res_producto = producto.split(",");
			var res_costo = costo.split(",");
			var res_impuesto = impuesto.split(",");
			var res_gasto = gasto.split(",");
			for(i=0;i<res_cantidad.length-1;i++){
				if(indice==i){
					res_cantidad.splice(i,1);
					res_producto.splice(i,1);
					res_costo.splice(i,1);
					res_impuesto.splice(i,1);
					res_gasto.splice(i,1);
				}
			}
			var nuevo_cantidad='';
			var nuevo_producto='';
			var nuevo_costo='';
			var nuevo_impuesto='';
			var nuevo_gasto='';
			
			for(i=0;i<res_cantidad.length-1;i++){
				if(res_cantidad[i]!=''){
					nuevo_cantidad=nuevo_cantidad+res_cantidad[i]+',';
					nuevo_producto=nuevo_producto+res_producto[i]+',';
					nuevo_costo=nuevo_costo+res_costo[i]+',';
					nuevo_impuesto=nuevo_impuesto+res_impuesto[i]+',';
					nuevo_gasto=nuevo_gasto+res_gasto[i]+',';
					}
			}
			
			document.getElementById("lista_cantidad").value=nuevo_cantidad;
			document.getElementById("lista_productos").value=nuevo_producto;
			document.getElementById("lista_costo").value=nuevo_costo;
			document.getElementById("lista_impuesto").value=nuevo_impuesto;
			document.getElementById("lista_gasto").value=nuevo_gasto;
			document.formulario.submit();
		}
		function modificar(index){
			var impuesto = document.getElementById("lista_impuesto").value;
			var res_impuesto = impuesto.split(",");
			var n_impuesto = prompt("Introduce el impuesto", "$"+res_impuesto[index]);
			var nuevo_impuesto='';
			if(!isNaN(n_impuesto)){
				for(i=0;i<res_impuesto.length-1;i++){
					if(i==index ){
						nuevo_impuesto=nuevo_impuesto+n_impuesto+',';
					}else{
						nuevo_impuesto=nuevo_impuesto+res_impuesto[i]+',';
					}
				}
				document.getElementById("lista_impuesto").value=nuevo_impuesto;
				document.formulario.submit();
			}else{
				alert("Error no se puede modificar el impuesto introduzca un numero");
			}
		}
		
		function next(){
			document.getElementById("etapa").value=3;
			document.formulario.submit();
		}
		<?php
				if(!isset($_POST['etapa'])){
					echo '
					$(function(){
						$("#proveedor").autocomplete({
						source : "proveedor.php"
						});
					});
					shortcut.add("Ctrl+Alt+S",function() {
					alert("A");
					c=document.getElementById("facturado");
					c.value="si";
					});

					shortcut.add("Ctrl+Alt+N",function() {
					alert("B");
					c=document.getElementById("facturado");
					c.value="no";
					});';
				}else{
					echo "
					$(function(){
					$('#product').autocomplete({
					source : 'producto.php',
					select : function(event, ui){
                       $('#description').slideUp('fast', function(){
                            $('#description').html(
                                '<h3>Detalles del producto</h3>' +
                                '<strong>Nombre: </strong>' + ui.item.value + '<br/>' +
                                '<strong>Descripcion: </strong>' + ui.item.descripcion+'<br/>'+
								'<strong>Unidad: </strong>' + ui.item.unidad+'<br/>'+
                                '<strong>Categoria: </strong>' + ui.item.categoria+'<br/>'+
                                '<strong>Subcategoria: </strong>' + ui.item.subcategoria+'<br/>'+
                                '<strong>Precio de Venta: </strong>' + ui.item.venta+'<br/>'+
                                '<strong>Impuesto: </strong>' + ui.item.impuesto
                            );
                       });
					   $('#nuevo_impuesto').val(ui.item.impuesto);
					   $('#impuesto').slideUp('fast', function(){
                            $('#impuesto').html(
                                '<strong>'+($('#nuevo_costo').val()*$('#nuevo_cantidad').val()*$('#nuevo_impuesto').val())/100+'</strong>'
                            );
                       });
					   
                       $('#importe').slideDown('fast');
                       $('#impuesto').slideDown('fast');
                       $('#description').slideDown('fast');
                   }
				});
			});
					";
				
				}
		?>
			
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
			<h1>Compras</h1>
			<?php
			///////////si no existe la variable de etapa
			if(!isset($_POST['etapa'])){
				echo '
				<div id="formulario">
					<form action="compras.php" method="POST">
					<table>
					<tr><td><h2>Proveedor</h2></td><td align="bottom"><input type="text" id="proveedor" name="proveedor"  required><img src="imagenes/agregar.png"  width="20px" height="20px" onclick="nuevo_proveedor()"></td></tr>
					<tr><td colspan="2" align="center"><input type="submit" name="opcion" value="Siguiente"></td></tr>
					<input type="hidden" 	name="etapa" value="1">
					<input type="hidden" name="facturado" id="facturado" value="si">
					</table>
					</form>
				</div>
				';
			}elseif($_POST['etapa']==2||$_POST['etapa']==1){
			///////////guardar el nuevo regisstro de la compra
			if($_POST['etapa']==2){
					$_POST['lista_cantidad']=$_POST['lista_cantidad'].$_POST['nuevo_cantidad'].',';
					$_POST['lista_productos']=$_POST['lista_productos'].$_POST['producto'].',';
					$_POST['lista_costo']=$_POST['lista_costo'].$_POST['nuevo_costo'].',';
					$_POST['lista_impuesto']=$_POST['lista_impuesto'].$_POST['nuevo_impuesto'].',';
					if(isset($_POST['nuevo_gasto'])){
						$_POST['lista_gasto']=$_POST['lista_gasto'].'si,';
					}else{
						$_POST['lista_gasto']=$_POST['lista_gasto'].'no,';
					}
			}
			/////////////////encabezado////////////////////
			$folio='';
			if($_POST['facturado']=='si'){
				$mfolio="select max(id_compra) as max from comprafac";
				$folio=$folio.'A';
			}else{
				$mfolio="select max(id_compra) as max from compra";
				$folio=$folio.'B';
			}
			$mfolio2=mysql_fetch_array(mysql_query($mfolio));
			$folio=$folio.($mfolio2['max']+1);
				echo "<div id='encabezado'>
				<table border='3'>
				<tr><th align='center'>Folio</th><th align='center'>Proveedor</th><th align='center'>Fecha</th></tr>
				<tr><td>".$folio."</td><td align='center'>".$_POST['proveedor'],"</td><td align='center'>".date('Y-m-d')."</td></tr>
				</table>
				</div><br><br>";
			/////////////////////registros que lleva la compra
			echo '<div id="registros">
					<table class="style2" style="width:850px;">
					<tr><td></td><td></td><td>Cantidad</td><td>Producto</td><td>Costo</td><td>Importe</td><td>Impuesto</td><td>Gasto</td></tr>';
				$lcantidad=explode(',',$_POST['lista_cantidad']);
				$lproducto=explode(',',$_POST['lista_productos']);
				$lcosto=explode(',',$_POST['lista_costo']);
				$limpuesto=explode(',',$_POST['lista_impuesto']);
				$lgasto=explode(',',$_POST['lista_gasto']);
				$t=0;$ti=0;
				if(isset($_POST['lista_cantidad']) && $_POST['lista_cantidad']!=''){
					for($i=0;$i<count($lcantidad)-1;$i++){
						if($lproducto[$i]!=''){
							echo "<tr>";
							echo "<td><img src='imagenes/borrar.png' width='15px' height='15px' onclick='borrar(".$i.")'></td>";
							echo "<td><img src='imagenes/editar.jpg' width='15px' height='15px' onclick='modificar(".$i.")'></td>";
							echo "<td>".$lcantidad[$i]."</td>";
							echo "<td>".$lproducto[$i]."</td>";
							echo "<td>".$lcosto[$i]."</td>";
							echo "<td>".$lcosto[$i]*$lcantidad[$i]."</td>";
							$icx=($lcosto[$i]*$lcantidad[$i])*($limpuesto[$i]/100);
							echo "<td>".round($icx,5)."</td>";
							echo "<td>".$lgasto[$i]."</td>";
							echo "</tr>";
							$t=$t+($lcosto[$i]*$lcantidad[$i]);
							$ti=$ti+(($lcosto[$i]*$lcantidad[$i])*($limpuesto[$i]/100));
						}
					}
					echo "<tr><td colspan='5' align='right'>Total</td><td>$".round($t,5)."</td><td></td><td></td></tr>";
					echo "<tr><td colspan='5' align='right'>Impuesto</td><td>$".round($ti,5)."</td><td></td><td></td></tr>";
				}			
			echo '</table>
			</div><br><br>';			
			////////nuevo registro
			echo '<div id="nuevo_registro">';
			echo'<form action="compras.php" method="POST" name="formulario">';
			echo '<table class="style2" style="width:850px;">
					<tr><td colspan="2"></td><td align="center">Cantidad</td><td>Producto</td><td>Costo</td><td>Importe</td><td>Impuesto</td><td>Gasto</td></tr>';
			echo '<tr>';
			echo '<td align="center"><img src="imagenes/editar.jpg" width="15px" height="15px" onclick="modificar_nuevo()"></td>';
			echo '<td align="center"><img src="imagenes/agregar.png" width="15px" height="15px" onclick="agregar_producto()"></td>';
			echo '<td style="width:75px;"><input style="width:75px;" type="text" id="nuevo_cantidad" name="nuevo_cantidad" onkeyup="calcular_importe()" required></td>';
			echo '<td style="width:250px;"><input type="text" id="product" name="producto" style="width:250px;" required></td>';
			echo '<td style="width:75px;"><input style="width:75px;" type="text" id="nuevo_costo" name="nuevo_costo" onkeyup="calcular_importe()" required></td>';
			echo '<td id="importe"></td>';
			echo '<td align="center"><div id="impuesto"></div></td>';
			echo '<td align="center"><input name="nuevo_gasto" type="checkbox" /></td>';
			echo '</tr>';
			///////input's ocultos necesarios paara llevar la compra
			echo '	<input type="hidden" name="proveedor" value="'.$_POST['proveedor'].'">
					<input type="hidden" name="facturado" value="'.$_POST['facturado'].'">
					<input type="hidden" id="nuevo_impuesto" name="nuevo_impuesto" value="0">
					<input type="hidden" id="etapa" name="etapa" value="2">';
			echo '<tr><td colspan="4" align="center"><br><input type="submit" name="opcion" value="GUARDAR"></td>
				  <td colspan="4" align="center"><br><button onclick="next()">Siguiente</button></td></tr>';
			echo '</table>';	
			
			////////////guardamos los nuevos producto
					echo '<input type="hidden" value="'.$_POST['lista_cantidad'].'" id="lista_cantidad" name="lista_cantidad">';
					echo '<input type="hidden" value="'.$_POST['lista_productos'].'" id="lista_productos" name="lista_productos">';
					echo '<input type="hidden" value="'.$_POST['lista_costo'].'" id="lista_costo" name="lista_costo">';
					echo '<input type="hidden" value="'.$_POST['lista_impuesto'].'" id="lista_impuesto" name="lista_impuesto">';
					if(isset($_POST['nuevo_gasto'])){
						echo '<input type="hidden" value="'.$_POST['lista_gasto'].'" id="lista_gasto" name="lista_gasto">';
					}else{
						echo '<input type="hidden" value="'.$_POST['lista_gasto'].'" id="lista_gasto" name="lista_gasto">';
					}
				
			

			
			echo'</form>';
			echo '</div>';
			//////////detalle de producto
			echo '<div id="description">
			<div>';
			}else{
			///////////////finalizacion de la compra
				$cantidades=explode(",",$_POST['lista_cantidad']);
				$costos=explode(",",$_POST['lista_costo']);
				$impuestos=explode(",",$_POST['lista_impuesto']);
				$subtotal=0;$imp=0;
				for($i=0;$i<count($cantidades);$i++){
					if($cantidades[$i]!=''){
						$subtotal=$subtotal+($cantidades[$i]*$costos[$i]);
						$imp=$imp+(($cantidades[$i]*$costos[$i])*($impuestos[$i]/100));
					}
				}
				echo "<h2>Esta por finalizar el registro de su compra</h2>";
				echo "<h2>Especifique los siguientes montos</h2>";
				echo "<form action='compras2.php' method='POST'>";
				echo "<table>";
				echo "<tr><td>Descuento</td><td><input type='text' id='descuento' name='descuento' min='0' onkeyup='totales();' required></td></tr>";
				echo "<tr><td>Ajuste</td><td><input type='text' id='iva' name='iva' min='0' onkeyup='totales();' required></td></tr>";
				echo "<tr><td>Forma de pago</td><td>".formapago()."</td></tr>";
				echo "<tr><td><div id='cc2' style='display:none;'>Cuenta</div></td><td>".cuentas()."</td></tr>";
				echo "</table><br>";
				//////////////////input type hidden necesarios
				echo "<input type='hidden' name='proveedor' value='".$_POST['proveedor']."'>";
				echo "<input type='hidden' name='facturado' value='".$_POST['facturado']."'>";
				echo "<input type='hidden' name='lista_cantidad' value='".$_POST['lista_cantidad']."'>";
				echo "<input type='hidden' name='lista_productos' value='".$_POST['lista_productos']."'>";
				echo "<input type='hidden' name='lista_costo' value='".$_POST['lista_costo']."'>";
				echo "<input type='hidden' name='lista_impuesto' value='".$_POST['lista_impuesto']."'>";
				echo "<input type='hidden' name='lista_gasto' value='".$_POST['lista_gasto']."'>";
				
				//////////descripcion de la compras con los calculos que se muestran
				echo "<table>";
				echo "<tr><td>Subtotal</td><td>$".round($subtotal,5)."<input type='hidden' id='subtotal' value='".$subtotal."'></td></tr>";
				echo "<tr><td>Impuesto</td><td>$".round($imp,5)."<input type='hidden' id='impuesto' value='".$imp."'></td></tr>";
				echo "<tr><td>Descuento</td><td id='desc'></td></tr>";
				echo "<tr><td>Ajuste</td><td id='ajuste'></td></tr>";
				echo "<tr><td>Total</td><td id='total'></td></tr>";
				echo "<tr><td colspan='2' align='center'><br><br><input id='enviar' type='submit' name='opcion' value='FINALIZAR' disabled='true' ></td></tr>";
				echo "</table>";
				
				echo "</form>";
			}
			?>			
			</header> 
		</div><!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
		<script>
			function calcular_importe(){
				impuesto=document.getElementById("nuevo_impuesto").value;
				cantidad=document.getElementById("nuevo_cantidad").value;
				costo=document.getElementById("nuevo_costo").value;
				num=cantidad*costo;
				tt= num.toFixed(5);
				num2=(cantidad*costo)*(impuesto/100);
				ti= num2.toFixed(5);
				document.getElementById("importe").innerHTML =tt;
				document.getElementById("impuesto").innerHTML =ti;
			}
			function totales(){
				sub=document.getElementById('subtotal').value;
				iva=document.getElementById('iva').value;
				d=document.getElementById('descuento').value;
				document.getElementById("desc").innerHTML =d;
				document.getElementById("ajuste").innerHTML =iva;
				imp=document.getElementById("impuesto").value;
				total=sub-d+(iva*1)+(imp*1);
				document.getElementById("total").innerHTML =total.toFixed(5);	
			}
			function validafp(){
				var x=document.getElementById("formapago").value;
				if(x!='EFECTIVO'){
					document.getElementById('cuenta').style.display = 'block';
					document.getElementById('cc2').style.display = 'block';
					document.getElementById('cuentas').style.display = 'block';
					document.getElementById('enviar').disabled = true;
					cuent=document.getElementById('cuenta').value;
					if(cuent!=''){
						document.getElementById('enviar').disabled =false;
					}
				}else{
					document.getElementById('cuenta').style.display = 'none';
					document.getElementById('cc2').style.display = 'none';
					document.getElementById('cuentas').style.display = 'none';
					document.getElementById('enviar').disabled = false;
				}
			}
		</script>
	</body>
</html>