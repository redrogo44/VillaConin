<?php
require('../funciones2.php');
conectar();
//print_r($_POST);
if ($_POST['elimina']=='categoria') 
{
	//echo "ENTRO A ELIMINAR SELECT * FROM Subcategoria_menu WHERE id_categoria=".$_POST['id'];
	$c=mysql_query("SELECT * FROM Subcategoria_menu WHERE id_categoria=".$_POST['id']);
	if (mysql_num_rows($c)>0) 
	{
		echo "EXISTEN SUB-CATEGORIAS ASOCIADAS A ESTA CATEGORIA\nELIMINE TODAS LAS SUB-CATEGORIAS PARA PODER ELIMINAR LA CATEGORIA ACTUAL";
	}
	else
	{
		mysql_query('DELETE FROM `Categorias_menu` WHERE id_categoria='.$_POST['id']);
		echo "SE ELIMINO LA CATEGORIA SATISFACTORIAMENTE";

	}
}
if ($_POST['elimina']=='subcategoria') 
{
	//echo "ENTRO A ELIMINAR SELECT * FROM Subcategoria_menu WHERE id_categoria=".$_POST['id'];
	$c=mysql_query("SELECT * FROM Menus WHERE id_subcategoria=".$_POST['id']);
	if (mysql_num_rows($c)>0) 
	{
		echo "EXISTEN PLATILLOS  ASOCIADAS A ESTA SUB-CATEGORIA,\n MODIFIQUE O ELIMINE TODAS LOS PLATILLOS PARA PODER ELIMINAR LA SUB-CATEGORIA ACTUAL";
	}
	else
	{
		mysql_query('DELETE FROM `Subcategoria_menu` WHERE id='.$_POST['id']);
		echo "SE ELIMINO LA SUB-CATEGORIA SATISFACTORIAMENTE";
		
	}
}

if ($_GET['elimina']=='unidades') 
{
	$un=mysql_fetch_array(mysql_query("SELECT * FROM unidades_menu WHERE id=".$_GET['id']));
	$c=mysql_query("SELECT * FROM ingredientes WHERE unidad='".$un['descripcion']."'" );
	if (mysql_num_rows($c)>0) 
	{
		echo "EXISTEN INGREDIENTES CON ESTA UNIDAD,\n MODIFIQUE O ELIMINE TODAS LOS PLATILLOS PARA PODER ELIMINAR LA UNIDAD ACTUAL";
	}
	else
	{
		echo "SE ELIMINO LA UNIDAD SATISFACTORIAMENTE";				
		mysql_query('DELETE FROM `unidades_menu` WHERE id='.$_GET['id']);
	}
	echo '
	<script type="text/javascript">
		window.opener.location.reload();			
		setTimeout(
			function(){ 
			opener.muestra("ver_unidad"); 
			window.close();
		}, 1000);			
		</script>
	';
}
if ($_GET['elimina']=='proveedor') 
{
	//$un=mysql_fetch_array(mysql_query("SELECT * FROM Proveedo WHERE id=".$_POST['id']));
	$c=mysql_query("SELECT * FROM ingredientes WHERE proveedor='".$_GET['id']."'" );
	if (mysql_num_rows($c)>0) 
	{
		echo "EXISTEN INGREDIENTES ASOCIADOS A ESTE PROVEEDOR,\n MODIFIQUE O ELIMINE TODAS LOS INGREDIENTES PARA PODER ELIMINAR EL PROVEEDOR ACTUAL";
	}
	else
	{
		echo "SE ELIMINO EL PROVEEDOR SATISFACTORIAMENTE";				
		mysql_query('DELETE FROM `Proveedor_menu` WHERE id='.$_GET['id']);
	}
	echo '
	<script type="text/javascript">
		window.opener.location.reload();			
		setTimeout(
			function(){ 
			opener.muestra("ver_proveedor"); 
			window.close();
		}, 1000);			
		</script>
	';
}
if ($_GET['elimina']=='ingrediente') 
{
	//$un=mysql_fetch_array(mysql_query("SELECT * FROM Proveedo WHERE id=".$_POST['id']));
	//echo "ENTRO A INGREDIENTE";
	$boot=0;
	$c=mysql_query("SELECT * FROM Menus" );
	while($cc=mysql_fetch_array($c))	
	{
		$ing=explode(",", $cc['ingredientes']);
		for ($i=1; $i <count($ing) ; $i++) 
		{ 
			if ($ing[$i]==$_GET['id']) 
			{
				echo "EXISTEN PLATILLOS QUE UTILIZAN ESTE INGREDIENTE,\n MODIFIQUE O ELIMINE TODOS LOS PLATILLOS \nQUE CONTENGAN AL INGREDIENTE PARA PODER ELIMINARLO ";		
				$boot=1;
				  break; 
			}
		}
	}	
	if ($boot==0) 
	{
		mysql_query("DELETE from ingredientes WHERE id=".$_GET['id']);
		echo "SE ELIMINO CORRECTAMENTE EL INGREDIENTE";
		echo '
	<script type="text/javascript">
		window.opener.location.reload();			
		setTimeout(
			function(){ 
			opener.muestra("ver_ingrediente"); 
			window.close();
		}, 1000);			
		</script>
	';
	}
}
if($_POST['elimina']=='menu')
{
	mysql_query("DELETE FROM Menus WHERE id_menu=".$_POST['id']);
	echo "SE ELIMINO EL PLATILLO CORRECTAMENTE";
}

?>