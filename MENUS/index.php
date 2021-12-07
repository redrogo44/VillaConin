<!DOCTYPE html>
<?php
session_start();
//print_r($_SESSION);
?>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>MENUS</title>
	<!-- 				MENU	-->
		<link rel="stylesheet" type="text/css" href="pro_dropdown_3/pro_dropdown_3.css" />
		<link rel="stylesheet" type="text/css" href="estilos.css" />
 		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<!-- 			TERMINA	MENU	--> 	
	<!-- 			VENTANA EMERGENTE	--> 	
	 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
 		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
   		<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
	<!-- 			TERMINA VENTANA EMERGENTE	--> 	
	<!-- 			AUTOCOMPLETADOR	--> 	
	<link type="text/css" rel="stylesheet" href="autocomplete.css"></link>	
	<script src="rmm-js/autocomplete.jquery.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script>
	function muestra(n)
{
//alert(n);	
	if(n=='nueva_cat')
	{
		$('#nueva_cat').show();
		$('#ver_cat').hide();
		$('#nuevo_menu').hide();
		$('#ver_menus').hide();
		$('#nuevo_tiempo').hide();
		$('#ver_tiempo').hide();
		$('#edita_menu').hide();
		$('#nuevo_ingrediente').hide();
		$('#ver_ingrediente').hide();		
		$('#nueva_subcat').hide();
		$('#nueva_unidad').hide();
		$('#ver_subcat').hide();
		$('#proyectar').hide();
		$('#nuevo_proveedor').hide();
		$('#ver_unidad').hide();
		$('#ver_proveedor').hide();

	}
	if(n=='ver_cat')
	{
		$('#nueva_cat').hide();
		$('#ver_cat').show();
		$('#ver_menus').hide();
		$('#nuevo_menu').hide();	
		$('#nuevo_tiempo').hide();
		$('#ver_tiempo').hide();	
		$('#edita_menu').hide();
		$('#nuevo_ingrediente').hide();
		$('#ver_ingrediente').hide();	
		$('#nueva_subcat').hide();
		$('#nueva_unidad').hide();
		$('#ver_subcat').hide();
		$('#proyectar').hide();
		$('#nuevo_proveedor').hide();	
$('#ver_unidad').hide();
		$('#ver_proveedor').hide();
	}
	if(n=='nuevo_menu')
	{
		$('#nueva_cat').hide();
		$('#ver_cat').hide();
		$('#ver_menus').hide();
		$('#nuevo_menu').show();
		$('#nuevo_tiempo').hide();
		$('#ver_tiempo').hide();
	$('#edita_menu').hide();
	$('#nuevo_ingrediente').hide();
		$('#ver_ingrediente').hide();
		$('#nueva_subcat').hide();
		$('#nueva_unidad').hide();
		$('#ver_subcat').hide();
		$('#proyectar').hide();
		$('#nuevo_proveedor').hide();
$('#ver_unidad').hide();
		$('#ver_proveedor').hide();
	}

	if(n=='ver_menus')
	{
		$('#nueva_cat').hide();
		$('#ver_cat').hide();
	$('#ver_menus').show();
		$('#nuevo_menu').hide();
		$('#nuevo_tiempo').hide();
		$('#edita_menu').hide();
		$('#ver_tiempo').hide();
		$('#nuevo_ingrediente').hide();
		$('#ver_ingrediente').hide();
		$('#nueva_subcat').hide();
		$('#nueva_unidad').hide();
		$('#ver_subcat').hide();
		$('#nuevo_proveedor').hide();

		$('#proyectar').hide();
	$('#ver_unidad').hide();
		$('#ver_proveedor').hide();
	}
	if(n=='nuevo_tiempo')
	{
		$('#nueva_cat').hide();
		$('#ver_cat').hide();
		$('#ver_menus').hide();
		$('#nuevo_menu').hide();
		$('#nuevo_tiempo').show();
		$('#edita_menu').hide();
		$('#ver_tiempo').hide();
		$('#nuevo_ingrediente').hide();
		$('#ver_ingrediente').hide();
		$('#nueva_subcat').hide();
		$('#nueva_unidad').hide();
		$('#ver_subcat').hide();
		$('#proyectar').hide();
		$('#nuevo_proveedor').hide();
$('#ver_unidad').hide();
		$('#ver_proveedor').hide();
	}
	if(n=='ver_tiempo')
	{
		$('#nueva_cat').hide();
		$('#ver_cat').hide();
		$('#ver_menus').hide();
		$('#nuevo_menu').hide();
		$('#nuevo_tiempo').hide();
		$('#ver_tiempo').show();
		$('#edita_menu').hide();
		$('#nuevo_ingrediente').hide();
		$('#ver_ingrediente').hide();
		$('#nueva_subcat').hide();
		$('#nueva_unidad').hide();
		$('#ver_subcat').hide();
		$('#proyectar').hide();
		$('#nuevo_proveedor').hide();
$('#ver_unidad').hide();
		$('#ver_proveedor').hide();
	}
	if(n=='nuevo_ingrediente')
	{
		$('#nueva_cat').hide();
		$('#ver_cat').hide();
		$('#ver_menus').hide();
		$('#nuevo_menu').hide();
		$('#nuevo_tiempo').hide();
		$('#ver_tiempo').hide();
		$('#edita_menu').hide();
		$('#nuevo_ingrediente').show();
		$('#ver_ingrediente').hide();
		$('#nueva_subcat').hide();
		$('#nueva_unidad').hide();
		$('#ver_subcat').hide();
		$('#proyectar').hide();
		$('#nuevo_proveedor').hide();
$('#ver_unidad').hide();
		$('#ver_proveedor').hide();
	}
	if(n=='ver_ingrediente')
	{
		$('#nueva_cat').hide();
		$('#ver_cat').hide();
		$('#ver_menus').hide();
		$('#nuevo_menu').hide();
		$('#nuevo_tiempo').hide();
		$('#ver_tiempo').hide();
		$('#edita_menu').hide();
		$('#nuevo_ingrediente').hide();
		$('#ver_ingrediente').show();
		$('#nueva_subcat').hide();
		$('#nueva_unidad').hide();
		$('#ver_subcat').hide();
		$('#proyectar').hide();
		$('#nuevo_proveedor').hide();
		$('#ver_unidad').hide();
		$('#ver_proveedor').hide();
	}
	if(n=='nueva_subcat')
	{
		$('#nueva_cat').hide();
		$('#ver_cat').hide();
		$('#ver_menus').hide();
		$('#nuevo_menu').hide();
		$('#nuevo_tiempo').hide();
		$('#ver_tiempo').hide();
		$('#edita_menu').hide();
		$('#nuevo_ingrediente').hide();
		$('#ver_ingrediente').hide();
		$('#nueva_subcat').show();
		$('#nueva_unidad').hide();
		$('#ver_subcat').hide();
		$('#proyectar').hide();
		$('#nuevo_proveedor').hide();
$('#ver_unidad').hide();
		$('#ver_proveedor').hide();
	}
	if(n=='ver_subcat')
	{
		$('#nueva_cat').hide();
		$('#ver_cat').hide();
		$('#ver_menus').hide();
		$('#nuevo_menu').hide();
		$('#nuevo_tiempo').hide();
		$('#ver_tiempo').hide();
		$('#edita_menu').hide();
		$('#nuevo_ingrediente').hide();
		$('#ver_ingrediente').hide();
		$('#nueva_subcat').hide();
		$('#nueva_unidad').hide();
		$('#ver_subcat').show();
		$('#proyectar').hide();
		$('#nuevo_proveedor').hide();
		$('#ver_unidad').hide();
		$('#ver_proveedor').hide();
	}
	if(n=='nueva_unidad')
	{
		$('#nueva_cat').hide();
		$('#ver_cat').hide();
		$('#ver_menus').hide();
		$('#nuevo_menu').hide();
		$('#nuevo_tiempo').hide();
		$('#ver_tiempo').hide();
		$('#edita_menu').hide();
		$('#nuevo_ingrediente').hide();
		$('#ver_ingrediente').hide();
		$('#nueva_subcat').hide();
		$('#nueva_unidad').show();
		$('#ver_subcat').hide();
		$('#proyectar').hide();
		$('#nuevo_proveedor').hide();
$('#ver_unidad').hide();
		$('#ver_proveedor').hide();
	}
	if(n=='proyectar')
	{
		$('#nueva_cat').hide();
		$('#ver_cat').hide();
		$('#ver_menus').hide();
		$('#nuevo_menu').hide();
		$('#nuevo_tiempo').hide();
		$('#ver_tiempo').hide();
		$('#edita_menu').hide();
		$('#nuevo_ingrediente').hide();
		$('#ver_ingrediente').hide();
		$('#nueva_subcat').hide();
		$('#nueva_unidad').hide();
		$('#ver_subcat').hide();
		$('#proyectar').show();
		$('#nuevo_proveedor').hide();
		$('#ver_unidad').hide();
		$('#ver_proveedor').hide();
	}
	if(n=='nuevo_proveedor')
	{
		$('#nueva_cat').hide();
		$('#ver_cat').hide();
		$('#ver_menus').hide();
		$('#nuevo_menu').hide();
		$('#nuevo_tiempo').hide();
		$('#ver_tiempo').hide();
		$('#edita_menu').hide();
		$('#nuevo_ingrediente').hide();
		$('#ver_ingrediente').hide();
		$('#nueva_subcat').hide();
		$('#nueva_unidad').hide();
		$('#ver_subcat').hide();
		$('#proyectar').hide();
		$('#nuevo_proveedor').show();
		$('#ver_unidad').hide();
		$('#ver_proveedor').hide();
	}
	if(n=='ver_proveedor')
	{
		$('#nueva_cat').hide();
		$('#ver_cat').hide();
		$('#ver_menus').hide();
		$('#nuevo_menu').hide();
		$('#nuevo_tiempo').hide();
		$('#ver_tiempo').hide();
		$('#edita_menu').hide();
		$('#nuevo_ingrediente').hide();
		$('#ver_ingrediente').hide();
		$('#nueva_subcat').hide();
		$('#nueva_unidad').hide();
		$('#ver_subcat').hide();
		$('#proyectar').hide();
		$('#nuevo_proveedor').hide();
		$('#ver_unidad').hide();
		$('#ver_proveedor').show();
	}
	if(n=='ver_unidad')
	{
		$('#nueva_cat').hide();
		$('#ver_cat').hide();
		$('#ver_menus').hide();
		$('#nuevo_menu').hide();
		$('#nuevo_tiempo').hide();
		$('#ver_tiempo').hide();
		$('#edita_menu').hide();
		$('#nuevo_ingrediente').hide();
		$('#ver_ingrediente').hide();
		$('#nueva_subcat').hide();
		$('#nueva_unidad').hide();
		$('#ver_subcat').hide();
		$('#proyectar').hide();
		$('#nuevo_proveedor').hide();
		$('#ver_unidad').show();
		$('#ver_proveedor').hide();
	}
}
	</script>
	<?php
	require('../funciones2.php');
	conectar();
	date_default_timezone_set("America/Mexico_City");	
	validarsesion2();	
	?>
	<script>
            $(document).ready(function(){
                /* Una vez que se cargo la pagina , llamo a todos los autocompletes y
                 * los inicializo */
                 //alert('entro el autocompletador');
                $('.autocomplete').autocomplete({
                 select: function( event, ui ) {}
                });
                
            });
        </script>
</head>
<ul id="nav">
	<li class="top"><a href="../index.php" class="top_link"><span>Inicio</span></a></li>
	<?php
	if(!$_SESSION['niv']==6)
	{
	?>
	<li class="top"><a href="#nogo27" id="contacts" class="top_link"><span class="down">CATEGORIAS</span></a>
		<ul class="sub">
			<li><a href="#nogo28">NUEVA</a>
				<ul>
					<li><b>CATEGORIAS</b></li>
					<li><a href="#nogo34" name='nueva_cat' onClick="muestra(this.name);">Nueva Categoria</a></li>
					<li><b>SUB-CATEGORIAS</b></li>
					<li><a  name='nueva_subcat' onClick="muestra(this.name);">Nueva Sub-Categoria</a></li>
				</ul>
			</li>	
			<li><a href="#nogo44" name="ver_cat" onclick="muestra(this.name);">Ver Categorias</a></li>																				
			<li><a href="#nogo44" name="ver_subcat" onclick="muestra(this.name);">Ver Sub-Categorias</a></li>																				
		</ul>		
	</li>
	<!--<li class="top"><a href="#nogo27" id="contacts" class="top_link"><span class="down">TIEMPOS</span></a>
		<ul class="sub">
			<li><a href="#nogo28">NUEVO</a>
				<ul>
					<li><b>TIEMPO</b></li>
					<li><a href="#nogo34" name='nuevo_tiempo' onClick="muestra(this.name);">Nueva Tiempo</a></li>
				</ul>
			</li>	
			<li><a href="#nogo44" name="ver_tiempo" onclick="muestra(this.name);">Ver Tiempo</a></li>																				
		</ul>		
	</li>
	-->
	<li class="top"><a href="#nogo27" id="contacts" class="top_link"><span class="down">INGREDIENTES</span></a>
		<ul class="sub">
			<li><a href="#nogo28">NUEVO</a>
				<ul>
					<!--li><b>INGREDIENTES</b></li>
					<li><a href="#nogo34" name='nuevo_ingrediente' onClick="muestra(this.name);">Nuevo Ingrediente</a></li-->
					<li><b>UNIDADES</b></li>
					<li><a href="#nogo34" name='nueva_unidad' onClick="muestra(this.name);">Nueva Unidad</a></li>
					<li><b>PROVEEDOR</b></li>
					<li><a href="#no4" name='nuevo_proveedor' onClick="muestra(this.name);">Nuevo Proveedor</a></li>
				</ul>
			</li>	
			<li><a href="#nogo44" name="ver_ingrediente" onclick="muestra(this.name);">Ver Ingredientes</a></li>	
			<li><a href="#nogo44" name="ver_unidad" onclick="muestra(this.name);">Ver Unidades</a></li>	
			<li><a href="#nogo44" name="ver_proveedor" onclick="muestra(this.name);">Ver Proveedores</a></li>	
		</ul>		
	</li>

	


	<?php
		}		// TERMINA VALIDACION DE NIVEL 6 DONDE SEOLO MUESTRA EL MENU DE PROYECCION
	?>
	<li class="top"><a href="#nogo27" id="contacts" class="top_link"><span class="down">MENU</span></a>
		<ul class="sub">
			<?php if(!$_SESSION['niv']==6){?>
			<li><a href="#nogo28">NUEVO</a>
				<ul>
					<li><b>MENU</b></li>
					<li><a href="#nogo34" name='nuevo_menu' onClick="muestra(this.name);">Nueva Menu</a></li>
				</ul>
			</li>	
			<?php }?>			
			<li><a href="#nogo44" name="ver_menus" onclick="muestra(this.name);">Ver Menu</a></li>																				
		</ul>		
	</li>
	<li class="top"><a href="#P" name="proyectar" onclick="muestra(this.name);" id="contacts" class="top_link"><span class="down">PROYECTAR</span></a></li>


</ul>
<body>
<!--img id='logo' src="../Imagenes/Villa Conin.png" border="0"-->
<!-- 	NUEVA CATEGORIA -->
<div id="nueva_cat" style="display:none" align="center">
	<form name="nueva_categoria" id="nueva_categoria" action="acciones_menus.php" method="post">
		<table border="5">
			<caption colspan='2'>Nueva Categoria de Menu</caption>
			<thead>
				<tr>
					<th colspan="2">Informacion Nueva Categoria</th>
				</tr>
			</thead>
			<tbody>
				<tr><td><b>Nombre</b></td>		<td><input type="text" name="nombre" id='nombre_nueva_cat' placeholder=" Guaranición " required></td></tr>
				<tr><td><b>Descripción</b></td>	<td><textarea name="descripcion" id='descripcion_cat' required></textarea></td>			</tr>
			</tbody>
		</table>	
		<input type="hidden" name="accion" value="Nueva Categoria">
		<input type="button" name="Guardar Categoria" value="Guardar" onclick="valida_nombre_cat();">
	</form>
</div>
<div id="nueva_subcat" style="display:none" align="center">
	<form  id="nueva_categoria" name='new_subcat' action="acciones_menus.php" method="post">
		<table border="5">
			<caption colspan='2'>Nueva Sub-Categoria de Menu</caption>
			<thead>
				<tr>
					<th colspan="2">Informacion Nueva Sub-Categoria</th>
				</tr>
			</thead>
			<tbody>
				<tr><td><b>Nombre</b></td>		<td><input type="text" name="nombre" id='nombre_nueva_sub' placeholder=" Nombre de la Sub Categoria" required></td></tr>
				<tr><td><b>Descripción</b></td>	<td><textarea name="descripcion" required></textarea></td>			</tr>
				<tr><td><b>Categoria</b></td><td>
								<select name="categoria" id='categoria_sub'>
								<option value="Seleccione una Opcion">Seleccione una Opcion</option>
									<?php
										$ac=mysql_query("SELECT * FROM Categorias_menu");
										while ($c=mysql_fetch_array($ac)) 
										{
										echo '
											<option value="'.$c['id_categoria'].'">'.$c['nombre'].'</option>									
											';
										}
									?>
								</select></td></tr>
			</tbody>
		</table>	
		<input type="hidden" name="accion" value="Nueva Sub-Categoria">
		<input type="button"  value="Guardar" onclick="valida_subcat();">
	</form>
</div>
<div id="nueva_unidad" style="display:none" align="center">
	<form  id="nueva_categoria" name="unidad" action="acciones_menus.php" method="post">
		<table border="5">
			<caption colspan='2'>Nueva Unidad de Medida</caption>
			<thead>
				<tr>
					<th colspan="2">Informacion Nueva Unidad</th>
				</tr>
			</thead>
			<tbody>
				<tr><td><b>Nombre</b></td>		<td><input type="text" name="nombre" id='nombre_nueva_unidad' placeholder=" Nombre de la Unidad" required></td></tr>
				<tr><td><b>Abreviación</b></td>	<td><input type="text" name="descripcion" id='des_unidad' value="" placeholder=" abreviación" required></td>			</tr>				
			</tbody>
		</table>	
		<input type="hidden" name="accion" value="Nueva Unidad">
		<input type="button"  value="Guardar" onclick="valida_unidad();">
	</form>
</div>
<!-- VER CATEGORIAS -->
<div id="ver_cat" style="display:none" align="center">
<table border='1.5' bordercolor='#F00'>
	<caption>CATEGORIAS DE MENU</caption>
	<thead>
		<tr>
			<th colspan="5">LISTADO DE LAS DIFERENTES CATEGORIAS DE MENU</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="center"><b>Nombre</b></td>
			<td align="center"><b>Descripcion</b></td>
<!--			<td align="center"><b>Estatus</b></td>-->
			<td align="center"><b>Modificar</b></td>
			<td align="center"><b>Eliminar</b></td>
		</tr>
		<?php
		$cm=mysql_query("SELECT * FROM Categorias_menu order by nombre,estatus");
		while ($cat=mysql_fetch_array($cm)) 
		{
			echo '<tr>
					<td align="center"><b>'.$cat['nombre'].'</b></td>
					<td align="center"><b>'.$cat['descripcion'].'</b></td>';
					//<td align="center"><b>'.$cat['estatus'].'</b></td>
					echo'<td align="center"><input type="button" name="'.$cat['id_categoria'].'" value="Modificar" onclick="modifica_categoria(this.name);"></td>
					<td align="center"><img src="X.png" style="width:20px;" title="ELIMINAR CATEGORIA" onclick="elimina_categoria('.$cat['id_categoria'].');"></td>
				</tr>';
		}
		?>
	</tbody>
</table>
</div>
<div id="ver_subcat" style="display:none" align="center">
<table border='1.5' bordercolor='#F00'>
	<caption>SUB CATEGORIAS DE MENU</caption>
	<thead>
		<tr>
			<th colspan="5">LISTADO DE LAS DIFERENTES SUB-CATEGORIAS DE MENU</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="center"><b>Nombre</b></td>
			<td align="center"><b>Descripcion</b></td>
			<td align="center"><b>Categoria</b></td>
			<td align="center"><b>Modificar</b></td>
			<td align="center"><b>Eliminar</b></td>
		</tr>
		<?php
		$auxiliar=mysql_query("select * from Categorias_menu order by nombre");
		while($aux=mysql_fetch_array($auxiliar)){
			$cm=mysql_query("SELECT * FROM Subcategoria_menu where id_categoria=".$aux["id_categoria"]." order by nombre");
			while ($cat=mysql_fetch_array($cm)) 
			{
				$cas=mysql_fetch_array(mysql_query("SELECT * FROM Categorias_menu WHERE id_categoria=".$cat['id_categoria']));
				echo '<tr>
						<td align="center"><b>'.$cat['nombre'].'</b></td>
						<td align="center"><b>'.$cat['descripcion'].'</b></td>
						<td align="center"><b>'.$cas['nombre'].'</b></td>	
						<td align="center"><input type="button" name="'.$cat['id'].'" value="Modificar" onclick="modifica_subcategoria(this.name);"></td>
						<td align="center"><img src="X.png" style="width:20px;" title="ELIMINAR SUBCATEGORIA" onclick="elimina_subcategoria('.$cat['id'].');"></td>					
					</tr>';
			}	
		}
		?>
	</tbody>
</table>
</div>
<!-- MODIFICA CATEGORIAS -->
<div id="modifica_cate" style="display:none" align="center">
</div>
<!-- NUEVO MENU -->
<div id="nuevo_menu" style="display:none" align="center">
<form action="acciones_menus.php" method="post" name="platillo" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return validamenu();">
	<table border='1.5' bordercolor='#F00'>
		<caption>CREACION NUEVO MENU</caption>
		<thead>
			<tr>
				<th colspan="2" align="center">ABASTESCA DE INFORMACION EL FORMULARIO</th>
			</tr>
		</thead>
		<tbody>
			<tr>	<td align="center"><b>Nombre</b></td>	<td><input type="text" name="nombre" id='nombre-menu' placeholder="Ensalada de pollo Africano" required></td>		</tr>
			<tr>	<td align="center"><b>Descripción</b></td>	<td><input type="text" name="descripcion_mennu"  placeholder="Ensalada con pollo y papas" required></td>		</tr>
			<tr>	<td align="center"><b>Categoria</b></td>	<td>
													<select name="categoria" onchange="cambia_select(this.value)" required>
														<option value="">Seleccione una Opcion</option>
														<?php
															$c=mysql_query("SELECT * FROM Categorias_menu WHERE estatus='ACTIVO' ORDER BY nombre ");
															while ($ca=mysql_fetch_array($c)) 
															{
																echo '<option value="'.$ca['id_categoria'].'" > '.$ca['nombre'].'</option>';
															}
														?>
													</select>			
												</td>	
			</tr>
			<tr>	<td align="center"><b>Sub-Categoria</b></td>	<td>
													<select name="subcategoria" required>
														
													</select>			
												</td>	
			</tr>
		</tbody>
	</table>
	 <div class="autocomplete" >
            <br>
		 	<p onclick="add_title()" style="display:inline;z-index:0;">Agregar Titulo</p><br><br>
            <input  type="text" value="" data-source="search.php?search=" id='producto' autocomplete="off" style="display:inline-block;" placeholder="      Busca Ingrediente "/>
		 	<b onclick="closeAutocomplete()" style="display:inline-block;color:#F00;border:solid;">X</b>
		 <!--img src="+.png" style="width:20px;" title="BUSCAR INGREDIENTES" onclick="crear_nuevo_producto();"-->
      </div>
      <table border="5" style="display:none" name='tabla_ingredientes' id="tabla_ingredientes" >
      	<thead>
      		<tr>
      			<th colspan="5">Ingredientes</th>
      		</tr>
      	</thead>
      	<tbody>
      		<tr>
      			<td align="center" style="width:50px;"><b>Cantidad</b></td>      			
      			<td align="center"><b>Unidad</b></td>
      			<td align="center"><b>Nombre</b></td>  
				<td align="center"><b>Comentario</b></td>  
      			<td align="center"><b>Eliminar</b></td>
      		</tr> 

      	</tbody>
      </table>

      <br>
      Instrucciones: <textarea name="instrucciones"></textarea>
      <br>

      Desea Agregar alguna Imagen: <input  type="checkbox" onclick="muestra_form_imagen();" id="checkbox">
     	<div style="display:none" id='imegen_menu'><br>
		   <input id="file_url" type="file" name="foto">	<br>	 
		 Nombre de la Imagen:  <input type="hidden" id="nombre_imagen" name='nombre_imagen'>
		    <br><br>		 
		   <img id="img_destino" src="#" alt="Tu imagen" width="300" height="300">
		</div>  
		   <input type="submit" value="Guardar">		   
		    
	<input type="hidden" name="accion" value="Nuevo Menu" />
	<input type="hidden" name="filas" id="filas_ingredientes" />
</form>
</div>

<!-- VER MENUS -->
<div style="display:none" id='ver_menus' align="center"><br>
<table border='1.5' bordercolor='#F00'>
	<th colspan="7"><b>LISTADO DE MENUS</b></th>
	<tr>
		<td align="center"><b>Nombre</b></td>
		<td align="center"><b>Descripcion</b></td>
		<td align="center"><b>Categoria</b></td>
		<td align="center"><b>Sub-Categoria</b></td>
		<td align="center"><b>Ver</b></td>
		<td align="center"><b>Editar</b></td>
		<td align="center"><b>Eliminar</b></td>
	</tr>
	<?php
	
	$categorias=mysql_query("select * from Categorias_menu order by nombre");
		while($cat=mysql_fetch_array($categorias)){
			///subcategorias
			$subcategorias=mysql_query("select * from Subcategoria_menu where id_categoria=".$cat["id_categoria"]." order by nombre");
			while($sub=mysql_fetch_array($subcategorias)){
				$l=mysql_query("SELECT * FROM Menus where id_Categoria_menu=".$cat["id_categoria"]." and id_subcategoria=".$sub["id"]."  order by nombre"); 
				while ($m=mysql_fetch_array($l)) 
				{
					$ca=mysql_fetch_array(mysql_query("SELECT * FROM Categorias_menu WHERE id_categoria=".$m['id_Categoria_menu']));
					$subca=mysql_fetch_array(mysql_query("SELECT * FROM Subcategoria_menu WHERE id=".$m['id_subcategoria']));
					echo "
							<tr>
								<td align='center'>".$m['nombre']."</td>
								<td align='center'>".$m['descripcion']."</td>
								<td align='center'>".$ca['nombre']."</td>
								<td align='center'>".$subca['nombre']."</td>
								";		
								if ($m['imagen']=='.') 
								{
									echo"<td><input type='button' onclick='muestra_informacion_menu(".$m['id_menu'].");' value='Ver' ></td> ";							
								}
								else
								{
									echo"<td><img src='Fotos/".$m['imagen']."' style='width:70px;' value='".$m['id_menu']."' onclick='muestra_informacion_menu(".$m['id_menu'].");'></td>";							
								}
								if(!$_SESSION['niv']==6)
								{
									echo "
							 			<td align='center'><img src='edita.png' style='width:30px;' value='".$m['id_menu']."' onclick='edita_menu(".$m['id_menu'].");'></td>                    				
							  			<td align='center'><img src='X.png' style='width:20px;' title='ELIMINA' onclick='elimina_xx4( ".$m['id_menu'].");' /></td>	
							 			";
								}
								else
								{

								}
						echo "	<td></td><td></td>											 
						</tr>
						 ";
				}
			}
		}
	?>
</table>
</div>
<div style="display:none" id='informacion_menus' align="center"><br>
</div>
<!-- CREAR NUEVO TIEMPO  -->
<div style="display:none" id='nuevo_tiempo' align="center"><br>
  <form action="acciones_menus.php" method="POST">	
	<table border="5">
		<th colspan="2"><b>NUEVO TIEMPO</b></th>
		<tr>
			<td><b>Nombre:</b></td>	<td><input type="text" name="nombre" placeholder="  1er Tiempo  " required ></td></tr>
			<tr><td><b>Descricion:</b></td>	<td><input type="text" name="descripcion" placeholder="  Guarnición  " required></td>
		</tr>
	</table>
	<input type="hidden" name="accion" value="nuevo tiempo"><br>
	<input type="submit" name="guarda" value="Guardar">
  </form>
</div>
<!-- VER Y MODIFIXAR TIEMPOS  -->
<div style="display:none" id='ver_tiempo' align="center"><br>
<table  border='6' bgcolor="#FF8622" bordercolor='#F00' style="color:#fff; font-family: monospace;">
	<caption>Listado de Tiempos</caption>
	<thead>
		<tr>
			<th colspan="3">Tiempos</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="center"><b>Nombre</b></td>
			<td align="center"><b>Descripcion</b></td>
			<td align="center"><b>Editar</b></td>			
		</tr>
		<?php
		 $ti=mysql_query("SELECT * FROM `Tiempos_Menu` ");
		 while ($t=mysql_fetch_array($ti)) 
		 {
		 	echo "<tr> 
                     <td><b>".$t['nombre']."</b></td>
                     <td><b>".$t['descripcion']."</b></td>
					 <td align='center'><img src='edita.png' style='width:30px;' value='".$t['id']."' onclick='modifica_tiempo(".$t['id'].");'></td>                    
		    	</tr>";
		 }
		?>
	</tbody>
</table>
</div>

<div style="display:none" id='modificacion_tiempo' align="center"><br>
</div>



<!-- CREAR NUEVO PRODUCTO  -->
<div style="display:none" id='nuevo_proveedor' align="center"><br>
	<form action="acciones_menus.php"  name="proveedor" method="POST" target="_blank" accept-charset="utf-8">	
		<table border='1.5' bordercolor='#F00'>
			<caption><b>PROVEEDOR</b></caption>
			<thead>
				<tr>
					<th align="center" colspan="2">Alta de nuevo Proveedor</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><b>Nombre: </b></td><td><input type="text" name="nombre" id='nombre_proveedor' placeholder="EMPRESA" required></td></tr>
					<tr><td><b>Razon Social: </b></td><td><input type="text" id='rz' name="rz" placeholder="EMPRESA X S.A. de C.V." required></td>
				</tr>
			</tbody>
		</table>
		<br>
		<input type="hidden" name="accion" value="Nuevo Proveedor">
		<input type="button"  value="Guardar Proveedor" onclick="valida_proveedor();">
	</form>
</div>
<!-- CREAR NUEVO 	INGREDIENTE  -->

<div style="display:none" id='nuevo_ingrediente' align="center"><br>
	<form action="acciones_menus.php" method="POST" target="_blank" name="ingrediente" >
		<table border='1.5' bordercolor='#F00'>
			<caption>NUEVO INGREDIENTE</caption>
			<thead>
				<tr>
					<th colspan="2">LLENA EL FORMULARIO</th>
				</tr>
			</thead>
			<tbody>
				<tr><td><B>Nombre: </B></td> <td><input type="text" name="nombre" id='nombre_ingrediente' value="" placeholder="NOMBRE DEL INGREDIENTE" required></td></tr>
				<tr><td><B>Descripcion: </B></td> <td><input type="text" id="des_ingrediente" name="descripcion" value="" placeholder="NOMBRE DEL INGREDIENTE" required></td></tr>
				<tr><td><B>Unidad: </B></td> <td>
									<select name="unidad" id='unidad_ingrediente' required>
									<option value="0">Seleccione una Opcion</option>

									</select>
										<img src="+.png" style="width:20px;" title="CREAR UNIDAD" onclick="crear_nueva_unidad();">

									</td>
				</tr>
				<tr><td><B>Proveedor: </B></td> <td>
									<select name="proveedor" id='proveedor_ingrediente' required>
									<option value="1">Seleccione una Opcion</option>


									</select>
										<img src="+.png" style="width:20px;" title="CREAR UNIDAD" onclick="nuevo_proveedor();">

									</td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="accion" value="nuevo_ingrediente"><br>
		<!--input type="button"  value="Guardar" onClick="valida_ingrediente();"-->
		<input type="submit"  value="Guardar">
	</form>
</div>
<div style="display:none" id='ver_unidad' align="center"><br>
<table border="2.5" bgcolor="#99D6FF">
	<caption>UNIDADES</caption>
	<thead>
		<tr>
			<th align="center" colspan="4">LISTA DE UNIDADES</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="center"><b>Nombre</b></td>
			<td align="center"><b>Abreviación</b></td>
			<td align="center"><b>Modificar</b></td>
			<td align="center"><b>Eliminar</b></td>

		</tr>
		<?php
			$un=mysql_query("SELECT * FROM unidades_menu order by nombre");
			$op='unidad';
			while ($u=mysql_fetch_array($un)) 
			{
				echo "
						<tr>
							<td ><b>".$u['nombre']."</b></td>
							<td align='center'><b>".$u['descripcion']."</b></td>
							<td align='center'><img src='edita.png' style='width:30px;' value='".$m['id_menu']."' onclick='edita(".$u['id'].",1);'></td>
							<td align='center'><img src='X.png' style='width:20px;' title='ELIMINA' onclick='elimina_xx( ".$u['id'].");' /></td>
						</tr>
					 ";
			}
		?>
	</tbody>
</table>
f</div>
<div style="display:none" id='ver_proveedor' align="center"><br>
<table border="2.5" bgcolor="#99D6FF">
	<caption>PROVEEDORES</caption>
	<thead>
		<tr>
			<th align="center" colspan="4">LISTA DE PROVEEDORES</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="center"><b>Nombre</b></td>
			<td align="center"> <b>Razon Social</b></td>
			<td align="center"> <b>Modificar</b></td>
			<td align="center"> <b>Eliminar</b></td>
		</tr>
		<?php
			$un=mysql_query("SELECT * FROM Proveedor_menu order by nombre");
			while ($u=mysql_fetch_array($un)) 
			{
				echo "
						<tr>
							<td><b>".$u['nombre']."</b></td>
							<td align='center'><b>".$u['razon_social']."</b></td>
							<td align='center'><img src='edita.png' style='width:30px;' value='".$m['id_menu']."' onclick='edita(".$u['id'].",2);'></td>
							<td align='center'><img src='X.png' style='width:20px;' title='ELIMINA' onclick='elimina_xx2( ".$u['id'].");' /></td>
						</tr>
					 ";
			}
		?>
	</tbody>
</table>
</div>
<div style="display:none" id='ver_ingrediente' align="center"><br>
<table border='1.5' bordercolor='#F00'>
	<!-- SE muestran los ingredientes que son el productos en inventario de categoria insumos >
	<caption>LISTADO DE INGREDIENTES</caption-->
	<thead>
		<tr>
			<th colspan="9" align="center">INGREDIENTES</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="center"><b>ID</b></td>
			<td align="center"><b>NOMBRE</b></td>
			<td align="center"><b>DESCRIPCION</b></td>
			<td align="center"><b>UNIDAD<br>RECETARIO</b></td>
			<td align="center"><b>UNIDAD<br>COMPRA</b></td>
			<td align="center"><b>ULTIMO<br>COSTO</b></td>
			<td align="center"><b>PROVEEDOR</b></td>
			<td align="center"><b>EQUIVALENCIA</b></td>
			<td align="center"><b>MODIFICAR</b></td>
		
		</tr>
		<?php
		
		///////obtenemos las categrias de tipo INSUMO
		
		$c1=mysql_query("select * from categoria where tipo='INSUMO'");
		$id_cat=array();
		while($categoria=mysql_fetch_array($c1)){
			array_push($id_cat,$categoria["id_categoria"]);
		}
		
		$condicion="";
		for($i=0;$i<count($id_cat);$i++){
			if($i==0){
				$condicion=$condicion." id_categoria=".$id_cat[$i];
			}else{
				$condicion=$condicion." OR id_categoria=".$id_cat[$i];
			}
		}
		//echo "select * from producto where ".$condicion." ORDER BY  `nombre` ";
		//echo $condicion;
		
		///obtenemos los productos de tipo insumo
		//echo "select * from producto where ".$condicion." ORDER BY nombre";
		$pr=mysql_query("select * from producto where ".$condicion." ORDER BY  `nombre` ");
		
		while($producto=mysql_fetch_array($pr)){
			$unidad=mysql_fetch_array(mysql_query("select * from unidad where id_unidad=".$producto["id_unidad"]));
			$inventario=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$producto["id_producto"]." ORDER BY ProveedorMenu"));
			$ui=mysql_fetch_array(mysql_query("select * from unidades_menu where descripcion='".$inventario['UnidadMenu']."'"));
			$pi=mysql_fetch_array(mysql_query("select * from Proveedor_menu where id='".$inventario['ProveedorMenu']."'"));
			
			//////validamos si hace falta algun dato del producto ya sea unidad de menu, proveedor o equivalencia		
			if($inventario["UnidadMenu"]=="" || $inventario["ProveedorMenu"]=="" || $inventario["Equivalencia"]==""){
				$color="lightpink";
			}else{
				$color="white";
			}
			
			
			
			echo "
					<tr style='background-color:".$color.";'>
						<td align='center'><b>".$producto['id_producto']."</b></td>
						<td align='center'><b>".$producto['nombre']."</b></td>
						<td align='center'><b>".$producto['descripcion']."</b></td>
						<td align='center'><b>".$ui['nombre']."</b></td>
						<td align='center'><b>".$unidad['nombre']."</b></td>
						<td align='center'><b>$".number_format($inventario['precio'],3)."</b></td>
						<td align='center'><b>".$pi['nombre']."</b></td>
						<td align='center'><b>1".$unidad["nombre"]."=".$inventario["Equivalencia"].$ui['nombre']."</b></td>
					 	<td align='center'><img src='edita.png' style='width:30px;' value='".$producto['id']."' onclick='modifica_ingrediente(".$producto['id_producto'].");'>				 	
					</tr>
				 ";
		}
		
	
		
		/*$in=mysql_query("SELECT * FROM `ingredientes` order by nombre");
		while ($i=mysql_fetch_array($in))
		{
			$p=mysql_fetch_array(mysql_query("SELECT * FROM Proveedor_menu WHERE id=".$i['proveedor']." ORDER BY nombre"));
			echo "
					<tr>
						<td align='center'><b>".$i['nombre']."</b></td>
						<td align='center'><b>".$i['descripcion']."</b></td>
						<td align='center'><b>".$i['unidad']."</b></td>
						<td align='center'><b>".$p['nombre']."</b></td>
					 	<td align='center'><img src='edita.png' style='width:30px;' value='".$i['id']."' onclick='modifica_ingrediente(".$i['id'].");'></td>                    						
						<td align='center'><img src='X.png' style='width:20px;' title='ELIMINA' onclick='elimina_xx3( ".$i['id'].");' /></td>					 	
					</tr>
				 ";
		}*/

		/*
		$p=mysql_query("SELECT * FROM Proveedor_menu ORDER BY nombre");
		while ($pr=mysql_fetch_array($p)) 
		{
			$i=mysql_query("SELECT * FROM inventario WHERE ProveedorMenu=".$pr['id']);

			while ($in=mysql_fetch_array($i)) 
			{
				$prod=mysql_fetch_array(mysql_query("SELECT * from producto WHERE id_producto=".$in['id_producto']));
				$unidad=mysql_fetch_array(mysql_query("select * from unidad where id_unidad=".$prod["id_unidad"]));
				$ui=mysql_fetch_array(mysql_query("select * from unidades_menu where descripcion='".$in['UnidadMenu']."'"));
				

			
			//////validamos si hace falta algun dato del producto ya sea unidad de menu, proveedor o equivalencia		
			if($in["UnidadMenu"]=="" || $in["ProveedorMenu"]=="" || $in["Equivalencia"]==""){
				$color="lightpink";
			}else{
				$color="white";
			}
			
				echo "<tr style='background-color:".$color.";'>
						<td>".$prod['id_producto']."</td>
						<td>".$prod['nombre']."</td>
						<td>".$prod['descripcion']."</td>
						<td>".$ui['nombre']."</td>
						<td>".$unidad['nombre']."</td>
						<td align='center'><b>$".number_format($in['precio'],3)."</b></td>
						<td>".$pr['nombre']."</td>
						
						<td align='center'><b>1 ".$unidad["nombre"]." = ".$in["Equivalencia"]." ".$ui['nombre']."</b></td>
					 	<td align='center'><img src='edita.png' style='width:30px;' value='".$prod['id']."' onclick='modifica_ingrediente(".$prod['id_producto'].");'>		


				  </tr>";	
			}			
			
		}


*/
	///////////////////7777
		?>
	</tbody>
</table>

</div>
<div style="display:none" id='modifica_ingrediente' align="center"><br>
</div>
<!-- *********		PROYECCION		*********** -->
<div style="display:none" id='proyectar' align="center"><br>
<font color="#269600"><b>DE: </b></font>&nbsp;&nbsp;<input type="date" id='fecha1' name="fecha1"  min='<?php echo date('Y-m-d');?>' placeholder="2015-01-01" value='<?php echo date('Y-m-d');?>'> &nbsp;&nbsp; <font color="#FF0707"><b>HASTA: </b></font><input type="date" id="fecha2" name="fecha2" onchange="valida_fecha(this.value);" placeholder="2015-12-31"> &nbsp;&nbsp;<input type="button" name="buscar"  value="Buscar" onclick="listar();">
<br>
<br>
	<div style="display:none" id='listado_proyeccion' align="center"><br>
	</div>
	<br>
	<button onclick="extra()">Agregar Extra</button>
	<br><br><br><br><br><br><br><br><br><br><br><br>
</div>

<!-- FUNCIONES -->
<?php
function validarsesion2(){
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expi
	res: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	if(!
		isset($_SESSION['nombre'])  || !isset($_SESSION['esta']) || !isset($_SESSION['usu'])){
		echo '<meta http-equiv="refresh" content="0">';
		echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../login.php'>";
		exit();
	}
	elseif(empty($_SESSION['nombre']) || empty($_SESSION['esta']) || empty($_SESSION['usu'])){
		echo '<meta http-equiv="refresh" content="0">';
		echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../login.php'>";
		exit();
	}else{
//	echo '<script language="javascript">href.location="index.php";</script>';
	}
	
}
?>
<script type="text/javascript">
cargaUnidadYProveedor();
buscaproveedor();
function valida_nombre_cat()
{
	//alert('entro');
	var n=document.getElementById('nombre_nueva_cat').value;
	var d=document.getElementById('descripcion_cat').value;
	if(n == '' || d=='')
	{
		if(n=='')
			{alert("INGRESE UN NOMBRE PARA LA CATEGORIA");}
		if(d==''){alert("INGRESE UNA DESCRIPCION PARA LA CATEGORIA");}
	}
	else
	{	
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
		   	var xx=xmlhttp.responseText;			
		   	//alert(xx);
				if(xx=='no existe')
				{
					////////////////////7777
		   //alert(xx);					
					document.nueva_categoria.submit();
					/////////////////////777
				}
				else
				{
					alert('Error ya Existe esa categoria con la siguiente informacion '+xx);	
				}
		    }	
	    }
		xmlhttp.open("POST","valida_nombre.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("nombre="+n);
	}
	
}
function modifica_categoria(id)
{
/*alert(id);
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
    			document.getElementById("modifica_cate").innerHTML=xmlhttp.responseText;
    		}
  	}
		xmlhttp.open("POST","modifica_categoria.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("id="+id);

      $( "#modifica_cate" ).dialog({
          show: "blind",
          hide: "explode"
      })
    */
	window.open('modifica_categoria.php?id='+id,'popup','width=300,height=200');   
}
var sig=2;
function agrega_filas_ingredientes()
{

	var a=document.getElementById('producto').value;	
	var producto=a.split('-');
	/////////////////////////////////////////////////////////////////////////////////////
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
    			var p=xmlhttp.responseText;
    			//alert(p);
    			datos=p.split(',');
    			//alert(datos[3]);
    			//if (document.getElementById(datos[3])) {alert('EL PRODUCTO YA HA SIDO AGREGADO A LA LISTA DE INGREDIENTES.');}
    			//else{    			    			

					    var table = document.getElementById("tabla_ingredientes");
						var row=table.insertRow(sig);   
						var cel= row.insertCell(0);
						var cel1= row.insertCell(1);
						var cel2= row.insertCell(2);
						var cel3= row.insertCell(3);
						var cel4= row.insertCell(4);
						cel.innerHTML="<td align='center' style='width:50px;'><input type='text' name='cantidad"+sig+"' id='cantidad"+sig+"' style='width:60px;' required/></td>"; 
						cel1.innerHTML="<td align='center'><input type='text' name='unidad"+sig+"' value='"+datos[2]+"' id='unidad"+sig+"' readonly='readonly' style='width:80px;' /><input type='hidden' name='id_producto"+sig+"' value='"+datos[3]+"'/></td>"; 		
						cel2.innerHTML="<td align='center'><input type='text' name='ingrediene"+sig+"' value='"+datos[0]+"' title='"+datos[1]+"' id='ingrediente"+sig+"' readonly='readonly' /><input type='hidden' id='"+datos[3]+"' value='"+datos[3]+"'/></td>";
				
						cel3.innerHTML="<td align='center'><input type='text' name='comentario"+sig+"' value='' id='comentario"+sig+"'  style='width:80px;' placeholder='Comentario'/></td>"; 
				
						cel4.innerHTML="<td align='center'><center><img src='X.png' style='width:20px;' title='BUSCAR INGREDIENTES' onclick='elimina_producto("+sig+");'></center></td>"; 		
						
						sig++;
					//}

    		}
  	}
		xmlhttp.open("POST","informacion_producto.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("producto="+producto[0]);    
	//////////////////////////////////////////////////////////////////////////////////////
	$('#tabla_ingredientes').show();			
	document.getElementById('producto').value='';
	document.getElementById('filas_ingredientes').value=sig;
}
function elimina_producto(f)
{
	//alert(f);
	document.getElementById("tabla_ingredientes").rows[f].innerHTML="";
	document.getElementById("tabla_ingredientes").rows[f].style.display="none";
//	document.getElementById('filas_ingredientes').value=sig;

}
function crear_nuevo_producto()
{
	window.open("nuevo_producto.php", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
}
function crear_nueva_unidad()
{
	window.open("nueva_unidad.php", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
}
function mostrarImagen(input) {
 if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload = function (e) {
   $('#img_destino').attr('src', e.target.result);
  }
  reader.readAsDataURL(input.files[0]);
 }
}
 function muestra_form_imagen()
 {
 	//alert('entro a la imagen');
 	if(document.getElementById('checkbox').checked)
 	{
 		$('#imegen_menu').show(); 	

 		document.getElementById('nombre_imagen').value=document.getElementById('nombre-menu').value;
 	}
 	else
 	{
 		$('#imegen_menu').hide();	 	  		
 	}
 }
 function muestra_informacion_menu(id)
 {
 	/*alert(id);
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
    			//alert(xmlhttp.responseText);
    			document.getElementById("informacion_menus").innerHTML=xmlhttp.responseText;
    		}
  	}
		xmlhttp.open("POST","informacion_menu.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("id="+id);

      $( "#informacion_menus" ).dialog({
          show: "blind",
          hide: "explode"
      })
     */
	window.open("informacion_menu.php?id='"+id+"'", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=500, height=600");    
 }
 function modifica_tiempo(id)
 {
 	//alert(id);
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
    			//alert(xmlhttp.responseText);
    			document.getElementById("modificacion_tiempo").innerHTML=xmlhttp.responseText;
    		}
  	}
		xmlhttp.open("POST","mod_tiempo.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("id="+id);

      $( "#modificacion_tiempo" ).dialog({
          show: "blind",
          hide: "explode"
      })
 }
 function edita_menu(id)
 {
 	//alert(id);
 	//$('#edita_menu').show();
	window.open("edita_menu.php?id="+id+" ", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500, width=800, height=800");
 }
 function modifica_ingrediente(id)
 {
 	/*
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
    			//alert(xmlhttp.responseText);
    			document.getElementById("modifica_ingrediente").innerHTML=xmlhttp.responseText;
    		}
  	}
		xmlhttp.open("POST","mod_ingrediente.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("id="+id);

      $( "#modifica_ingrediente" ).dialog({
          show: "blind",
          hide: "explode"
      })
	*/
	window.open('mod_ingrediente.php?id='+id,'popup','width=300,height=200');

 }
 function cambia_select(id)
 {
 	//alert(id);
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
    			var xx=xmlhttp.responseText;
    			if(xx!=0)
		    	{
		    			mis_provincias=xx.split(",");
		    			num_opciones = mis_provincias.length;
						//marco el número de provincias en el select
						document.platillo.subcategoria.length = num_opciones;
						//para cada provincia del array, la introduzco en el select
						for(i=0;i<num_opciones;i++)
						{
							var op=mis_provincias[i].split("-");
						   document.platillo.subcategoria.options[i].value=op[0]
						   document.platillo.subcategoria.options[i].text=op[1]
						}	
				}
				else{
						//si no había provincia seleccionada, elimino las provincias del select
						document.platillo.subcategoria.length = 1
						//coloco un guión en la única opción que he dejado
						document.platillo.subcategoria.options[0].value = "-"
					    document.platillo.subcategoria.options[0].text = "-"
					}
    		}
  	}
		xmlhttp.open("POST","busca_categorias.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("id="+id);
 }
 function modifica_subcategoria(id)
 {
 /*	alert(id)
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
    			document.getElementById("modifica_cate").innerHTML=xmlhttp.responseText;
    		}
  	}
		xmlhttp.open("POST","modifica_subcategoria.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("id="+id);

      $( "#modifica_cate" ).dialog({
          show: "blind",
          hide: "explode"
      })
*/
	window.open('modifica_subcategoria.php?id='+id,'popup','width=300,height=200');
 }
function muestra_error()
{
	alert('NO EXISTEN CATEGORIAS, POR FAVOR CREE AL MENOS UNA CATEGORIA PARA POSTERIORMENTE CREAR SUB-CATEGORIAS.');
				$('#nueva_subcat').hide();					
}
function modif_proyeccion(c)
{
	window.open("proyecta_contrato.php?Numero="+c+"&Modifica=si", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=800, height=800");    		
}
function proyectar(c)
{
	//alert('entro a proyctar'+c);
	window.open("proyecta_contrato.php?Numero="+c+"", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=800, height=800");    	
}
function listar()
{
//alert("entro a listado");
	var fecha1=document.getElementById("fecha1").value;
	var fecha2=document.getElementById("fecha2").value;
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
    			document.getElementById("listado_proyeccion").innerHTML=xmlhttp.responseText;
    		}
  	}
		xmlhttp.open("POST","buscar_contratos.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("fecha1="+fecha1+"&fecha2="+fecha2);
$("#listado_proyeccion").show();

}

function nuevo_proveedor()
{
	window.open("nuevo_proveedor.php", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");	
}

function imprime_proyeccion(a)
{
	//alert(a);
	window.open("Compra.php?Numero="+a+"", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");	
}
function elimina_categoria(o)
{
if(confirm("¿ ESTAS SEGURO DE ELIMINAR ESTA CATEGORIA..?"))
{
	//alert(o);
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
    			alert(xmlhttp.responseText);
    			if (xmlhttp.responseText=='SE ELIMINO LA CATEGORIA SATISFACTORIAMENTE') 
    				{
						window.location.reload();
    				};
    		}
  	}
		xmlhttp.open("POST","elimina.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("elimina=categoria&id="+o);	
}


}
/*function elimina_categoria(o)
{
	//alert(o);
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
    			alert(xmlhttp.responseText);
    		}
  	}
		xmlhttp.open("POST","elimina.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("elimina=categoria&id="+o);
		window.location.reload();

}
*/
function elimina_subcategoria(o)
{
	if (confirm(" ¿ ESTAS SEGURO DE ELIMINAR LA SUBCATEGORIA.?")) 
		{
			//alert(o);
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
		    			alert(xmlhttp.responseText);
		    			if(xmlhttp.responseText=='SE ELIMINO LA SUB-CATEGORIA SATISFACTORIAMENTE')
		    			{
							window.location.reload();    				
		    			}
		    		}
		  	}
				xmlhttp.open("POST","elimina.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("elimina=subcategoria&id="+o);
		};
	
}
function elimina_xx(o)
{
	if(confirm("¿ ESTAS SEGURO DE BORRAR ESTA UNIDAD.?"))
	{
		/*alert(o);
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
		    			alert(xmlhttp.responseText);
		    			if(xmlhttp.responseText=='SE ELIMINO LA UNIDAD SATISFACTORIAMENTE')
		    			{
							window.location.reload();					    			
		    			}
		    		}
		  	}
				xmlhttp.open("POST","elimina.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("elimina=unidades&id="+o);	
				*/
			window.open('elimina.php?id='+o+'&elimina=unidades','popup','width=300,height=200');
	}
					


}
function elimina_xx2(o)
{
	if(confirm("¿ ESTAS SEGURO DE BORRAR ESTE PROVEEDOR.?"))
	{
		/*alert(o);
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
		    			alert(xmlhttp.responseText);
		    			if(xmlhttp.responseText=='SE ELIMINO EL PROVEEDOR SATISFACTORIAMENTE')
		    			{
							window.location.reload();					    			
		    			}
		    		}
		  	}
				xmlhttp.open("POST","elimina.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("elimina=proveedor&id="+o);
				*/
				window.open('elimina.php?id='+o+'&elimina=proveedor','popup','width=300,height=200');

	}
	
}
function elimina_xx3(o)
{
	if (confirm("¿ ESTAS SEGURO DE ELIMINAR  ESTE INGREDIENTE.?")) 
		{
			/*alert(o);
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
		    			alert(xmlhttp.responseText);
		    			if(xmlhttp.responseText=='SE ELIMINO CORRECTAMENTE EL INGREDIENTE')
		    			{
							window.location.reload();					    			
		    			}
		    		}
		  	}
				xmlhttp.open("POST","elimina.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("elimina=ingrediente&id="+o);
			*/
				window.open('elimina.php?id='+o+'&elimina=ingrediente','popup','width=300,height=200');		
		};	
}
function edita(id,a)
{
	if (a==1)
	{	var tipo='unidad';	}
	if (a==2)
	{	var tipo='proveedor';	}
	
	//alert(a);
	window.open("edita.php?id="+id+"&tipo="+tipo+"", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500, width=300, height=200");	
}
function elimina_xx4(o)
{
	//alert(o);
	if (confirm("ESTA SEGURO DE ELIMINAR ESTE PLATILLO")) 
		{
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
		    			alert(xmlhttp.responseText);
		    			if(xmlhttp.responseText=='SE ELIMINO EL PLATILLO CORRECTAMENTE')
		    			{
							window.location.reload();					    			
		    			}
		    		}
		  	}
				xmlhttp.open("POST","elimina.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("elimina=menu&id="+o);
		};
}
function edita(id,a)
{
	if (a==1)
	{	var tipo='unidad';	}
	if (a==2)
	{	var tipo='proveedor';	}
	
	//alert(a);
	window.open("edita.php?id="+id+"&tipo="+tipo+"", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500, width=300, height=200");	
}
function muestrau()
{
	//alert("kaka");
		$('#ver_unidad').show();
}

$("#file_url").change(function(){
 mostrarImagen(this);
});
function valida_fecha(f2)
{
	var f=document.getElementById("fecha1").value;
	//alert(f+"  =>  "+f2);
	if(Date.parse(f2) < Date.parse(f))
	{
		alert("ERROR, LA FECHA FINAL NO PUEDE SER MENOR A LA FECHA DE INICIO.");
		document.getElementById('fecha2').value='';
	}
}
function valida_subcat()
{ 
	var sub=document.getElementById('categoria_sub').value;
	//alert(sub);
	var nsub=document.getElementById('nombre_nueva_sub').value;
	if(sub!='Seleccione una Opcion')
	{	
		if (confirm("¿ SEGURO DE GUARDAR LA NUEVA SUB CATEGORIA ?")) 
			{
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
			    			//alert(xmlhttp.responseText);
			    			
			    			if(xmlhttp.responseText == 'existe')
			    			{
			    				alert("EL NOMBRE DE LA SUB CATEGORIA YA EXISTE POR FAVOR ESCRIBA OTRO ");
			    			}
			    			else{
			    					new_subcat.submit();
			    			}
			    		}
			  	}
					xmlhttp.open("POST","acciones_menus.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("accion=busca nombres subcat&nombre="+nsub);		
			}

	}
	else{alert("SELECCIONE UNA CATEGORIA VALIDA");}
}
function valida_unidad()
{
	var nu= document.getElementById("nombre_nueva_unidad").value;
	var du= document.getElementById("des_unidad").value;
	if(nu==''||du=='')
		{alert("LLENE TODO EL FORMULARIO PORFAVOR. ");}
	else{
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
			    			//alert(xmlhttp.responseText);
			    			
			    			if(xmlhttp.responseText == 'existe')
			    			{
			    				alert("EL NOMBRE DE LA UNIDAD YA EXISTE POR FAVOR ESCRIBA OTRO ");
			    			}
			    			else{
			    					document.unidad.submit();
			    			}
			    		}
			  	}
					xmlhttp.open("POST","acciones_menus.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("accion=busca nombres unidad&nombre="+nu);	
	}
	

}
function valida_proveedor()
{
	var np=document.getElementById('nombre_proveedor').value;
	var rz=document.getElementById('rz').value;
	if(np=='' || rz==''){	alert(' POR FAVOR LLENE EL FORMULARIO.');}
	else
	{
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
			    			//alert(xmlhttp.responseText);
			    			
			    			if(xmlhttp.responseText == 'existe')
			    			{
			    				alert("EL NOMBRE DEL PROVEEDOR YA EXISTE POR FAVOR ESCRIBA OTRO ");
			    			}
			    			else{
			    					document.proveedor.submit();
			    			}
			    		}
			  	}
					xmlhttp.open("POST","acciones_menus.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("accion=busca nombres proveedor&nombre="+np);
	}

		
}

function cargaUnidadYProveedor()
{

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
			    			//alert(xmlhttp.responseText);
			    			document.getElementById("unidad_ingrediente").innerHTML=xmlhttp.responseText;
			    		}
			  	}
					xmlhttp.open("POST","acciones_menus.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("accion=busca unidades");				
}
function buscaproveedor()
{
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
			    			//alert(xmlhttp.responseText);			    		
			    			document.getElementById('proveedor_ingrediente').innerHTML=xmlhttp.responseText;   		
			    		}
			  	}
					xmlhttp.open("POST","acciones_menus.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("accion=busca proveedores");
	
}


//////////////bloque de nuevas validaaciones

function validamenu(){
	var renglones=document.getElementById("tabla_ingredientes").rows.length;
	//alert(renglones);
	if(renglones>2){
		return true;
	}else{
		alert("Error: El menu debe de contar con almenos un ingrediente");
		return false;
	}
}

	document.getElementById("nombre-menu").addEventListener("input", validacion, false);
	function validacion(){
		var xmlhttp;
		nombre= document.getElementById("nombre-menu").value;
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
			    			//alert(xmlhttp.responseText);
							if(xmlhttp.responseText=="OK"){
								document.getElementById("nombre-menu").setCustomValidity('');
								document.getElementById("nombre-menu").style.background='##bbeffa';
							}else{
								document.getElementById("nombre-menu").setCustomValidity('Error nombre duplicado');
								document.getElementById("nombre-menu").style.background='#FFDDDD';
							}
			    			//document.getElementById('proveedor_ingrediente').innerHTML=xmlhttp.responseText;   		
			    		}
			  	}
			xmlhttp.open("POST","validacion2.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("nombre="+nombre+"&opcion=opcionmenu");
	
		}
	
		document.getElementById("nombre_ingrediente").addEventListener("input", VNI, false);
		function VNI(){
			
			var xmlhttp;
			nombre= document.getElementById("nombre_ingrediente").value;
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
			    			//alert(xmlhttp.responseText);
							if(xmlhttp.responseText=="OK"){
								document.getElementById("nombre_ingrediente").setCustomValidity('');
								document.getElementById("nombre_ingrediente").style.background='##bbeffa';
							}else{
								document.getElementById("nombre_ingrediente").setCustomValidity('Error nombre duplicado');
								document.getElementById("nombre_ingrediente").style.background='#FFDDDD';
							}
			    			   		
			    		}
			  	}
			xmlhttp.open("POST","validacion2.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("nombre="+nombre+"&opcion=nuevoingrediente");
		}

		function extra(){
			 window.open ("Extras.php", "Eventos Extras", "top=100,left=300,width=600,height=400");
		}

		function closeAutocomplete(){
			$(".autocomplete-jquery-results").hide();
		}
		function add_title(){
			var table = document.getElementById("tabla_ingredientes");
			var row=table.insertRow(sig);   
			var cel= row.insertCell(0);
			table.rows[sig].cells[0].colSpan = 5;
			table.rows[sig].cells[0].style.background="lightgray";
			cel.innerHTML="<td><center><input type='text' name='id_producto"+sig+"' id='id_producto"+sig+"' style='width:90%;' placeholder='Escribe el Titulo' required/><b style='color:white;' onclick='deleteTitle("+sig+")'>X</b></center></td>";
			sig++;
			$("#tabla_ingredientes").show();
		}
		function deleteTitle(i){
			document.getElementById("tabla_ingredientes").rows[i].innerHTML="";
			document.getElementById("tabla_ingredientes").rows[i].style.display="none";
		}
</script>	
</body>
</html>	