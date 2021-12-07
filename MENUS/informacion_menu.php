<?php
require('../funciones2.php');
conectar();
//print_r($_POST);
$m=mysql_query("SELECT * FROM Menus WHERE id_menu=".$_GET['id'] );
$me=mysql_fetch_array($m);
$c=mysql_query("SELECT * FROM Categorias_menu WHERE id_categoria=".$me['id_Categoria_menu']);
$ca=mysql_fetch_array($c);
$sb=mysql_query("SELECT * FROM `Subcategoria_menu` WHERE id=".$me['id_subcategoria']);
$s=mysql_fetch_array($sb);
$can=explode(",", $me['cantidades']);
$in=explode(",", $me['ingredientes']);
$comentario=explode("|",$me["comentarios"]);
echo "<div align='center'>
		<table id='tabla_informacion_menu'  border='5'>
			<th colspan='2'>Informacion de Menu ".$me['nombre']."</th>
			
				<tr><td align='center'><b>Nombre</b></td>	<td align=><b>".$me['nombre']."</b></td></tr>
				<tr><td align='center'><b>Descripcion</b></td>	<td align=><b>".$me['descripcion']."</b></td></tr>
				<tr><td align='center'><b>Categoria</b></td>	<td align=><b>".$ca['nombre']."</b></td></tr>
				<tr><td align='center'><b>Sub-Categoria</b></td>	<td align=><b>".$s['nombre']."</b></td></tr>				
				<tr><td align='center'><b>estatus</b></td>	<td align=><b>".$me['estatus']."</b></td></tr>
		
		</table>
	 ";

echo "
		<table id='tabla_informacion_menu2' border='5'>
			<th colspan='4' align='center'>LISTA DE INGREDIENTES</th>
			<tr>
				<td align='center'><b>Nombre</b></td>
				<td align='center'><b>Materia prima<br>Unitaria</b></td>
				<td align='center'><b>Unidad</b></td>
				<td align='center'><b>Comentario</b></td>
				<td align='center'><b>Costo</b></td>
			</tr>		
	";
	$acumulado=0;
	 for ($i=0; $i <count($can) ; $i++) 
		{ 
		 if($in[$i]!=""){
			 ////validamos que si e un titulo de platillo
			 $p=mysql_query("SELECT * FROM producto WHERE id_producto=".$in[$i]);
			 $pr=mysql_fetch_array($p);			
			 
			 if(!is_numeric($in[$i])){
				 echo "<tr><td colspan='5' style='background:lightgray;' align='center'>".$in[$i]."</td></tr>";
			 }else{
				echo "<tr><td title='".$pr['descripcion']."' align='center'>".$pr['nombre']."</td>";
				echo "<td align='center'>".$can[$i]."</td>";
				$inv=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$pr["id_producto"]));
				$unidad=mysql_fetch_array(mysql_query("select * from unidades_menu where descripcion='".$inv["UnidadMenu"]."'"));
				echo "<td align='center'>".$unidad['nombre']."</td><td>".$comentario[$i]."</td><td>$ <i style='float:right;'>".number_format((($can[$i]/$inv["Equivalencia"])*$inv["precio"]),2)."</i></td></tr>"; 
				 $acumulado=$acumulado+(($can[$i]/$inv["Equivalencia"])*$inv["precio"]);
			 }
				 
		 }
		}

		echo "<tr><td colspan='4'><br>Costo por persona</td><td><br>$<i style='float:right;'>".number_format($acumulado,2)."</i></td></tr>";

		echo "
		<tr><td colspan='4' align='center'><b>INSTRUCCIONES</b></td></tr>
		<tr><td colspan='4'><textarea cols='33' rows='8'>".$me['instrucciones']."</textarea></td></tr>";
		echo "</table>
		</div>
		<br></br>";
		if ($me['imagen']!='.') 
		{
			echo "<img src='Fotos/".$me['imagen']."' style='width:200px;' value='".$m['id_menu']."' onclick='muestra_informacion_menu(".$m['id_menu'].");'>";			
		}

?>