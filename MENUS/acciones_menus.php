<?php
require('../funciones2.php');
conectar();
date_default_timezone_set("America/Mexico_City");
session_start();
//print_r($_POST);
if ($_POST['accion']=='Nueva Categoria') 
{
	 $fdr=date('c');
	 $ins="INSERT INTO `Categorias_menu`(`nombre`, `descripcion`, `fdr`, `estatus`, `registro`) VALUES ('".$_POST['nombre']."','".$_POST['descripcion']."','".$fdr."','ACTIVO','".$_SESSION['usu']."')";
	mysql_query($ins);
	echo '
		<script type="text/javascript">
			window.location="index.php";		
		</script>
		 ';
}
if ($_POST['accion']=='Modifica_categoria') 
{
	 $fdr=date('c');
	mysql_query("UPDATE `Categorias_menu` SET `nombre`='".$_POST['nombre']."',`descripcion`='".$_POST['descripcion']."',`fdr`='".$fdr."',`estatus`='".$_POST['estatus']."',`registro`='".$_SESSION['usu']."' WHERE id_categoria=".$_POST['id']);
	echo '
	<html>
	<head>
	<script>
		function r(){
			window.opener.location.reload();			
			setTimeout(function(){ 
						opener.muestra("ver_cat"); 
						window.close();
					}, 2000);	
		}
	</script>
	</head>
	<body onload="r()">
	</body>
	</html>';

}
if ($_POST['accion']=='Modifica_subcategoria') 
{
	 $fdr=date('c');
	mysql_query("UPDATE `Subcategoria_menu` SET `nombre`='".$_POST['nombre']."',`descripcion`='".$_POST['descripcion']."',`id_categoria`=".$_POST['categoria']." WHERE id=".$_POST['id']);
echo '
	<html>
	<head>
	<script>
		function r(){
			window.opener.location.reload();			
			setTimeout(function(){ 
						opener.muestra("ver_subcat"); 
						window.close();
					}, 2000);	
		}
	</script>
	</head>
	<body onload="r()">
	</body>
	</html>';
}
if ($_POST['accion']=='Nuevo Menu') 
{
	 $fdr=date('c');
	//echo "entro al nuevo menu";
		\error_reporting(E_ALL ^ E_NOTICE);
		$ruta="Fotos";
		$nom=$_POST['nombre_imagen'];
		$archivo=$_FILES['foto']['tmp_name'];
		$nom_archivo=$_FILES['foto']['name'];
		$ext=  pathinfo($nom_archivo);
		//echo "<br>archivo ".$ruta."/".$nom.".".$ext['extension'];
		$subir = move_uploaded_file($archivo,$ruta."/".$nom.".".$ext['extension']);
		if ($subir)
		{   // echo 'El archivo se subio con exito';
			echo '
					<script type="text/javascript">
						//alert("Se Subio con exito la Imagen");
					</script>
				 ';
		 }
		else
		{
			echo 'Error al subir ';
			/*echo '
					<script type="text/javascript">
						alert("Error al Subir la Imagen");
					</script>
				 ';
			}*/
		}
	$ingredientes='';$cantidades="";$comentarios="";
			for ($i=2; $i <=$_POST['filas'] ; $i++) 
			{ 
				if(isset($_POST['id_producto'.$i]) && $_POST['id_producto'.$i]!=''){
					if(is_numeric($_POST['id_producto'.$i])){
						$ingredientes=$ingredientes.",".$_POST['id_producto'.$i];
						$cantidades=$cantidades.",".$_POST['cantidad'.$i];
						$comentarios=$comentarios."|".$_POST['comentario'.$i];	
					}else{
						$ingredientes=$ingredientes.",".$_POST['id_producto'.$i];
						$cantidades=$cantidades.",";
						$comentarios=$comentarios."|";	
					}
				}
			}

			//echo "<br>Ingredientes ".$ingredientes;
			//echo "<br> Cantidades ".$cantidades;
$t="INSERT INTO `Menus`(`nombre`, `descripcion`, `ingredientes`,`cantidades`,`comentarios`,`id_Categoria_menu`, `estatus`, `fdr`, `registro`,`imagen` , `id_subcategoria`, `instrucciones` ) 
VALUES ('".$_POST['nombre']."','".$_POST['descripcion_mennu']."','".$ingredientes."','".$cantidades."','".$comentarios."','".$_POST['categoria']."','ACTIVO','".$fdr."','".$_SESSION['usu']."','".$nom.".".$ext['extension']."', ".$_POST['subcategoria'].",'".$_POST['instrucciones']."' ) ";
mysql_query($t);
		echo '
		<script type="text/javascript">
		window.location="index.php";		
		</script>
		 ';
		 
}
if ($_POST['accion']=='nuevo tiempo') 
{
	mysql_query("INSERT INTO `Tiempos_Menu`(`nombre`, `descripcion`) VALUES ('".$_POST['nombre']."' , '".$_POST['descripcion']."')");
	
	echo '<script type="text/javascript">
	alert("REGISTRO EXITOSO");
		window.location="index.php";		
		</script>';
}
if ($_POST['accion']=='modifica tiempo') 
{
	mysql_query("UPDATE `Tiempos_Menu` SET `nombre`='".$_POST['nombre']."',`descripcion`='".$_POST['descripcion']."' WHERE id=".$_POST['id']);
		echo '<script type="text/javascript">
	alert("MODIFICACION EXITOSA");
		window.location="index.php";		
		</script>';
}
if ($_POST['accion']=='nuevo_ingrediente') 
{

	$q=mysql_query("INSERT INTO `ingredientes`(`nombre`, `descripcion`, `unidad`, `proveedor`) VALUES ('".$_POST['nombre']."','".$_POST['descripcion']."','".$_POST['unidad']."',".$_POST['proveedor'].")");
	
	
	if(isset($_POST['emergente']))
	{
		echo '<script type="text/javascript">					
				window.close();		
			</script>';
	}
	else
	{
		echo '<script type="text/javascript">				
					window.opener.location.reload();			
					setTimeout(
						function(){ 
						opener.muestra("ver_ingrediente"); 
						window.close();
					}, 1000);			
			</script>';	
	}

}
if ($_POST['accion']=='modifica ingrediente')
{
	mysql_query("UPDATE inventario SET UnidadMenu='".$_POST['unidad']."', ProveedorMenu=".$_POST['proveedor'].", Equivalencia=".$_POST["equivalencia"]."  WHERE id_producto=".$_POST['id']); 
	echo '
	<html> 
	<head>
	<script>
		function r(){
			window.opener.location.reload();			
					setTimeout(
						function(){ 
						opener.muestra("ver_ingrediente"); 
						window.close();
					}, 2000);	
		}
	</script>
	</head>
	<body onload="r()">
	</body>
	</html>';
}
if ($_POST['accion']=='Nueva Sub-Categoria')
{
	$r="INSERT INTO `Subcategoria_menu`(`nombre`, `descripcion`, `id_categoria`) VALUES ('".$_POST['nombre']."','".$_POST['descripcion']."',".$_POST['categoria']." )";
	mysql_query($r);		
	echo '<script type="text/javascript">
	alert("REGISTRO EXITOSO");
		window.location="index.php";		
		</script>';
		
}
if ($_POST['accion']=='Nueva Unidad')
{
	mysql_query("INSERT INTO `unidades_menu`(`nombre`, `descripcion`) VALUES ('".$_POST['nombre']."','".$_POST['descripcion']."')");
	if(isset($_POST['emergente']))
	{
		echo '<script type="text/javascript">
				opener.cargaUnidadYProveedor(); 				
				window.close();		
			</script>';
	}
	else
	{
		echo '<script type="text/javascript">
		alert("REGISTRO EXITOSO");
			window.location="index.php";		
			</script>';
	}
}

	/* 			MODIFICA MENU   */
if ($_POST['accion']=='Modifica Menu') 
{
 $fdr=date('c');
	//echo "entro al nuevo menu";
		if($_POST["changefoto"]=="on"){
			$ruta="Fotos";
			$nom=$_POST['nombre'];
			$archivo=$_FILES['foto']['tmp_name'];
			$nom_archivo=$_FILES['foto']['name'];
			$ext=  pathinfo($nom_archivo);
			//echo "<br>archivo ".$ruta."/".$nom.".".$ext['extension'];
			$subir = move_uploaded_file($archivo,$ruta."/".$nom.".".$ext['extension']);
			if ($subir)
			{    //echo 'El archivo se subio con exito';
				//echo '
					//	<script type="text/javascript">
							//alert("Se Subio con exito la Imagen");
					//	</script>
					 //';
			 	////actualizamos 
			 	mysql_query("update Menus set imagen='".$nom.".".$ext['extension']."' where id_menu=".$_POST["id"]);
			 }
			else
			{
				echo 'Error al subir ';
				exit();
			}	
		}
	
		

	$ingredientes='';$cantidades="";$comentarios="";
			for ($i=0; $i <=$_POST['filas'] ; $i++) 
			{ 
				if($_POST['cantidad'.$i]!=""){
					if(is_numeric($_POST['id_producto'.$i])){
						$ingredientes=$ingredientes.",".$_POST['id_producto'.$i];
						$cantidades=$cantidades.",".$_POST['cantidad'.$i];
						$comentarios=$comentarios."|".$_POST["comentario".$i];
					}else{
						$ingredientes=$ingredientes.",".$_POST['id_producto'.$i];
						$cantidades=$cantidades.",";
						$comentarios=$comentarios."|";	
					}
				}	
			}

/*echo "<br>UPDATE `Menus` SET `nombre`='".$_POST['nombre']."',`descripcion`='".$_POST['descripcion_mennu']."',`ingredientes`='".$ingredientes."',`cantidades`='".$cantidades."',`id_Categoria_menu`='".$_POST['categoria']."',`estatus`='ACTIVO',`registro`='".$_SESSION['usu']."',`id_subcategoria`=".$_POST['subcategoria'].",`instrucciones`='".$_POST['instrucciones']."' WHERE id_menu =".$_POST['id'];*/

mysql_query("UPDATE `Menus` SET `nombre`='".$_POST['nombre']."',`descripcion`='".$_POST['descripcion_mennu']."',`ingredientes`='".$ingredientes."',`cantidades`='".$cantidades."',`comentarios`='".$comentarios."',`id_Categoria_menu`='".$_POST['categoria']."',`estatus`='ACTIVO',`registro`='".$_SESSION['usu']."',`id_subcategoria`=".$_POST['subcategoria'].",`instrucciones`='".$_POST['instrucciones']."' WHERE id_menu =".$_POST['id']);
	echo '
	<html>
	<head>
	<script>
		function r(){
			window.opener.location.reload();			
			setTimeout(function(){ 
						opener.muestra("ver_menus"); 
						window.close();
					}, 2000);	
		}
	</script>
	</head>
	<body onload="r()">
	</body></html>';
		
}
if ($_POST['accion']=='Nuevo Proveedor') 
{
	mysql_query("INSERT INTO `Proveedor_menu`(`nombre`, `razon_social`) VALUES ('".$_POST['nombre']."','".$_POST['rz']."' )");
	
		 if(isset($_POST['emergente']))
		{
			
			 echo '
				<html>
				<head>
				<script>
					function r(){
						window.opener.location.reload();			
						setTimeout(function(){
									window.close();
								}, 1000);	
					}
				</script>
				</head>
				<body onload="r()">
				</body></html>';
		}
		else
		{
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
}
if ($_POST['accion']=='Modifica Unidad') 
{
	//echo "UPDATE `unidades_menu` SET `nombre`='".$_POST['nombre']."',`descripcion`='".$_POST['descripcion']."' WHERE id=".$_POST['id'];
	mysql_query("UPDATE `unidades_menu` SET `nombre`='".$_POST['nombre']."',`descripcion`='".$_POST['descripcion']."' WHERE id=".$_POST['id']);
	echo '
	<html>
	<head>
	<script>
		function r(){
			window.opener.location.reload();			
			setTimeout(function(){ 
						opener.muestra("ver_unidad"); 
						window.close();
					}, 2000);	
		}
	</script>
	</head>
	<body onload="r()">
	</body>
	</html>';

}
if ($_POST['accion']=='Modifica Proveedor') 
{
	//echo "UPDATE  `Proveedor_menu` SET `nombre`='".$_POST['nombre']."',`razon_social`='".$_POST['descripcion']."' WHERE id=".$_POST['id'];
	mysql_query("UPDATE `Proveedor_menu` SET `nombre`='".$_POST['nombre']."',`razon_social`='".$_POST['descripcion']."' WHERE id=".$_POST['id']);
	echo '
	<html>
	<head>
	<script>
		function r(){
			window.opener.location.reload();			
			setTimeout(function(){ 
						opener.muestra("ver_proveedor"); 
						window.close();
					}, 2000);	
		}
	</script>
	</head>
	<body onload="r()">
	</body>
	</html>';

}
if($_POST['accion']=='busca nombres subcat')
{
	$qqxx=mysql_query("SELECT * FROM Subcategoria_menu WHERE nombre='".$_POST['nombre']."' ");
	if (mysql_num_rows($qqxx)>0) 
	{
		echo "existe";
	}
}
if($_POST['accion']=='busca nombres unidad')
{
	$qqc=mysql_query("SELECT * FROM unidades_menu WHERE nombre='".$_POST['nombre']."' ");
	if (mysql_num_rows($qqc)>0) 
	{
		echo "existe";
	}
}
if($_POST['accion']=='busca nombres proveedor')
{
	$qqcc=mysql_query("SELECT * FROM Proveedor_menu WHERE nombre='".$_POST['nombre']."' ");
	if (mysql_num_rows($qqcc)>0) 
	{
		echo "existe";
	}
}
if($_POST['accion']=='busca nombres ingrediente')
{
	$qqbc=mysql_query("SELECT * FROM ingredientes WHERE nombre='".$_POST['nombre']."' ");
	if (mysql_num_rows($qqbc)>0) 
	{
		echo "existe";
	}
}
if($_POST['accion']=='busca unidades')
{
	echo "<option value=''>Seleccione una Opcion</option>";
	$qc=mysql_query("SELECT * FROM  `unidades_menu` ");
	while($ui=mysql_fetch_array($qc)) 
	{
		echo "<option value='".$ui['nombre']."'>".$ui['nombre']."</option>";		
	}
}
if($_POST['accion']=='busca proveedores')
{
	echo "<option value=''>Seleccione una Opcion</option>";
	$qbc=mysql_query("SELECT * FROM  `Proveedor_menu` ");
	while($ui=mysql_fetch_array($qbc))
	{
		echo "<option value='".$ui['id']."'>".$ui['nombre']."</option>";		
	}
}if($_POST['accion']=='eliminaIngrediente')
{
	$m=mysql_fetch_array(mysql_query("SELECT * FROM Menus WHERE id_menu=".$_POST['menu']));
	//echo $_POST["ingredientes"];
	$ingrediente=explode(",",$m["ingredientes"]);
	$cantidad=explode(",",$m["cantidades"]);
	$comentario=explode("|",$m["comentarios"]);
	/////
	$nuevo_i="";
	$nuevo_c="";
	$nuevo_com="";
	////agregamoa los ingredintes eliminando el ingrendiente selecionado
	for($y=0;$y<count($ingrediente);$y++){
		if($y!=$_POST["ingrediente"]){
			$nuevo_i=$nuevo_i.",".$ingrediente[$y];
			$nuevo_c=$nuevo_c.",".$cantidad[$y];
			$nuevo_com=$nuevo_com."|".$comentario[$y];
		}
	}
	mysql_query("update Menus set ingredientes='".$nuevo_i."',cantidades='".$nuevo_c."',comentarios='".$nuevo_com."' where id_menu=".$_POST["menu"]);
}if($_POST['accion']=='agregaIngrediente')
{
	$p=mysql_query("SELECT * FROM producto WHERE nombre='".$_POST['producto']."' ");
	$pr=mysql_fetch_array($p);
	$m=mysql_fetch_array(mysql_query("SELECT * FROM Menus WHERE id_menu=".$_POST['menu']));
	//echo $_POST["ingredientes"];
	$ingrediente=$m["ingredientes"].",".$pr["id_producto"];
	$cantidad=$m["cantidades"].",0";
	$comentario=$m["comentarios"]."|";
	mysql_query("update Menus set ingredientes='".$ingrediente."',cantidades='".$cantidad."',comentarios='".$comentario."' where id_menu=".$_POST["menu"]);
}
?>