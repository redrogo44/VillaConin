<?php
require('../funciones2.php');
conectar();

$t=mysql_fetch_array(mysql_query("SELECT  `nombre`, `descripcion` FROM `Tiempos_Menu` WHERE id=".$_POST['id']));
echo "
	<form action='acciones_menus.php' method='POST'>
	<table border='5' bgcolor='#00A6FF' bordercolor='#012233' style='color:#fff; font-family: monospace;'>
		<th colspan='2'><b>Modificacion Tiempo ".$t['nombre']."</b></th>
		<tr>
			<td><b>Nombre:</b></td>
			<td><input type='text' name='nombre' value='".$t['nombre']."' required></td>
		</tr>
		<tr>
			<td><b>Descripcion:</b></td>
			<td><input type='text' name='descripcion' value='".$t['descripcion']."' required></td>
		</tr>
	 </table>
	 <input type='hidden' name='accion' value='modifica tiempo'>
	 <input type='hidden' name='id' value='".$_POST['id']."'>
	 <br>
	 <input type='submit'  value='Modificar'>
	 </form>";
?>