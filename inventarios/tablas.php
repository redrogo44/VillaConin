<?php
require 'funciones.php';
conectar();
//print_r($_POST);
if(isset($_POST['table'])){
	if($_POST['table']=='categoria'){
		echo '<h1>CATEGORIAS</h1>';
		FORM('categoria',$_POST['str']);
	}elseif($_POST['table']=='producto'){
		echo '<h1>PRODUCTOS</h1>';
		FORM('producto',$_POST['str']);
	}elseif($_POST['table']=='proveedor'){
		echo '<h1>PROVEEDORES</h1>';
		FORM('proveedor',$_POST['str']);
	}elseif($_POST['table']=='marca'){
		echo '<h1>MARCAS</h1>';
		FORM('marca',$_POST['str']);
	}elseif($_POST['table']=='subcategoria'){
		echo '<h1>SUBCATEGORIAS</h1>';
		FORM('subcategoria',$_POST['str']);
	}elseif($_POST['table']=='unidad'){
		echo '<h1>UNIDAD</h1>';
		FORM('unidad',$_POST['str']);
	}elseif($_POST['table']=='compra'){
		FORM('compra',$_POST['str']);
	}else{
		echo "<h1>ERROR NO SE PUEDE ACCEDER <BR>ERROR EN TABLAS.PHP</h1>";
	}
}
?>