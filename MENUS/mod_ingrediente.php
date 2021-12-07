<html>
	<head>
		<title>Modificar Ingrediente</title>
	</head>
	<body onload="mostrarunidad()">
<?php
require('../funciones2.php');
conectar();

$t=mysql_fetch_array(mysql_query("SELECT  * FROM producto WHERE id_producto=".$_GET['id']));
$inventario=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$_GET["id"]));
$unidad=mysql_fetch_array(mysql_query("select * from unidad where id_unidad=".$t["id_unidad"]));

		
echo "<b id='result'></b>
	<form action='acciones_menus.php' method='POST'>
	<table border='5' bgcolor='#00A6FF' bordercolor='#012233' style='color:#fff; font-family: monospace;'>
		<th colspan='2'><b>Modificacion Ingrediente ".$t['nombre']."</b></th>
		<tr>
			<td><b>Unidad Recetario:</b></td>
			<td>
			<select name='unidad' id='unidad' onchange='mostrarunidad()' required>";							
							$un=mysql_query("SELECT * FROM `unidades_menu`");
							while($u=mysql_fetch_array($un))
							{
								if($u['descripcion'] == $inventario['UnidadMenu'])
								{
									echo "<option value='".$u['descripcion']."' selected>".$u['nombre']."</option>	";
								}
								else{
									echo "<option value='".$u['descripcion']."'>".$u['nombre']."</option>	";
								}
							}						
		echo "</select></td>
		</tr>
		<tr>
			<td><b>Proveedor:</b></td>
			<td>
					<select name='proveedor' required>";
							
							$pr=mysql_query("SELECT * FROM `Proveedor_menu`");
							while($p=mysql_fetch_array($pr))
							{
								if($p['id'] == $inventario['ProveedorMenu'])
								{
									echo "<option value='".$p['id']."' selected>".$p['nombre']."</option>	";
								}
								else{
									echo "<option value='".$p['id']."'>".$p['nombre']."</option>	";
								}
							}						
			echo "</select></td>
			</td>
		</tr>
			
		<tr>
			<td>Equivalencia</td>
			<td>
			1 ".$unidad["nombre"]." = <input type='text' name='equivalencia' value='".$inventario["Equivalencia"]."'><i id='um'></i>
			</td>
		</tr>		
	 </table>
	 <input type='hidden' name='accion' value='modifica ingrediente'>
	 <input type='hidden' name='id' id='id' value='".$_GET['id']."'>
	 <br>
	 <input type='submit'  value='Modificar'>
	 </form>";
?>
		<script>
			function mostrarunidad(){
				unidad=document.getElementById("unidad").value;
				document.getElementById("um").innerHTML=unidad;
			}
		</script>
	</body>
</html>