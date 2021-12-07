<?php
require('../funciones2.php');
conectar();

///////////validaciond de nombre 

if($_POST["opcion"]=="nombreingrediente"){
	$q=mysql_query("select * from  ingredientes where nombre='".$_POST["nombre"]."' and id!=".$_POST["id"]);
	if(mysql_num_rows($q)==0){
		echo "OK";
	}else{
		echo "Error nombre duplicado ".mysql_num_rows($q);	
	}
}else if($_POST["opcion"]=="nombreunidad"){
	$q=mysql_query("select * from  unidades_menu  where nombre='".$_POST["nombre"]."' and id!=".$_POST["id"]);
	if(mysql_num_rows($q)==0){
		echo "OK";
	}else{
		echo "Error nombre duplicado ".mysql_num_rows($q);	
	}
	
}else if($_POST["opcion"]=="nombreproveedor"){
	$q=mysql_query("select * from  Proveedor_menu where nombre='".$_POST["nombre"]."' and id!=".$_POST["id"]);
	if(mysql_num_rows($q)==0){
		echo "OK";
	}else{
		echo "Error nombre duplicado ".mysql_num_rows($q);	
	}
}else if($_POST["opcion"]=="nombrecategoria"){
	//$aux=trim($_POST["nombre"]);
	$q=mysql_query("select * from  Categorias_menu where nombre='".$_POST["nombre"]."' and id_categoria != ".$_POST["id"]);
	if(mysql_num_rows($q)==0){
		echo "OK";
	}else{
		echo "Error nombre duplicado ".mysql_num_rows($q);	
	}
}else if($_POST["opcion"]=="nombresubcategoria"){
	//$aux=trim($_POST["nombre"]);
	$q=mysql_query("select * from  Subcategoria_menu  where nombre='".$_POST["nombre"]."' and id != ".$_POST["id"]);
	if(mysql_num_rows($q)==0){
		echo "OK";
	}else{
		echo "Error nombre duplicado ".mysql_num_rows($q);	
	}
}else if($_POST["opcion"]=="opcionmenu"){
	//$aux=trim($_POST["nombre"]);
	$q=mysql_query("select * from  Menus  where nombre='".$_POST["nombre"]."'");
	if(mysql_num_rows($q)==0){
		echo "OK";
	}else{
		echo "Error nombre duplicado ".mysql_num_rows($q);	
	}
}else if($_POST["opcion"]=="opcionmenumodificacion"){
	//$aux=trim($_POST["nombre"]);
	$q=mysql_query("select * from  Menus  where nombre='".$_POST["nombre"]."' and id_menu !=".$_POST["id"]);
	if(mysql_num_rows($q)==0){
		echo "OK";
	}else{
		echo "Error nombre duplicado ".mysql_num_rows($q);	
	}
}else if($_POST["opcion"]=="nuevoingrediente"){
	//$aux=trim($_POST["nombre"]);
	$q=mysql_query("select * from ingredientes  where nombre='".$_POST["nombre"]."'");
	if(mysql_num_rows($q)==0){
		echo "OK";
	}else{
		echo "Error nombre duplicado ".mysql_num_rows($q);	
	}
}else if($_POST["opcion"]=="nuevonombreunidad"){
	//$aux=trim($_POST["nombre"]);
	$q=mysql_query("select * from unidades_menu  where nombre='".$_POST["nombre"]."'");
	if(mysql_num_rows($q)==0){
		echo "OK";
	}else{
		echo "Error nombre duplicado ".mysql_num_rows($q);	
	}
}else if($_POST["opcion"]=="nuevoproveedor"){
	$q=mysql_query("select * from  Proveedor_menu where nombre='".$_POST["nombre"]."'");
	if(mysql_num_rows($q)==0){
		echo "OK";
	}else{
		echo "Error nombre duplicado ".mysql_num_rows($q);	
	}
}else{
	echo "error";
}
?>