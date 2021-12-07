<html>
<head>
</head>
<body>
<?php
require 'configuraciones.php';
conectar();
function combo(){
		$r=mysql_query("select categoria from Gastos_categoria group by categoria");
		echo "<select id='categoria' name='categoria'  onchange='load(this.value);ocultar(this.value);'>
		<option value='0'>Seleccione una Opcion</option>";
		while($m=mysql_fetch_array($r)){
			echo "<option value='".$m['categoria']."'>".$m['categoria']."</option>";
		}
		echo "</select>";
}
echo "<script src='sub_categorias.js'></script>";

echo '<form action="popups.php" method="POST">';
if($_GET['op']==1){
	echo "<center><br><label>Nombre de la categoria</label><BR><input type='text' name='categoria'>";
	echo "<input type='hidden' name='opcion' value='1'>";
	echo "<br><input type='submit' name='cat' value='Agregar'></center>";
}elseif($_GET['op']==2){
	echo "<center><br><label>Categoria</label><BR>".combo();
	echo "<br><label>Nuevo nombre</label><input type='text' name='new'>";
	echo "<input type='hidden' name='opcion' value='2'>";
	echo "<br><input type='submit' name='cat' value='Modificar'></center>";

}elseif($_GET['op']==3){
	echo "<center><br><label>Categoria</label><BR>".combo();
	echo "<input type='hidden' name='opcion' value='3'>";
	echo "<br><input type='submit' name='cat' value='Eliminar'></center>";

}elseif($_GET['op']==4){
	echo "<center>".combo();
	echo "<br><label>Sub Categoria</label><input type='text' name='subcategory'>";
	echo "<input type='hidden' name='opcion' value='4'>";
	echo "<br><div  id='cat2' style='display:none;'><input  type='submit' name='cat' value='Agregar'></div></center>";

}elseif($_GET['op']==5){
	echo "<center>".combo();
	echo "<div id='sub'> </div>";
	echo "<br><label>Sub Categoria</label><input type='text' name='subcategoria'>";
	echo "<input type='hidden' name='opcion' value='5'>";
	echo "<br><div  id='cat2' style='display:none;'><input type='submit' name='cat' value='Modificar'></div></center>";

}elseif($_GET['op']==6){
	echo "<center>".combo();
	echo "<div id='sub'> </div>";
	echo "<input type='hidden' name='opcion' value='6'>";
	echo "<br><div  id='cat2' style='display:none;'><input type='submit' name='cat' value='Eliminar'></div></center>";

}
echo "</form>";
if($_POST['opcion']==1){
$r=mysql_query("insert into Gastos_categoria(categoria) value('".$_POST['categoria']."')");
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
}
elseif($_POST['opcion']==2){
$r=mysql_query("update Gastos_categoria set categoria='".$_POST['new']."' where categoria='".$_POST['categoria']."'");
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
}
elseif($_POST['opcion']==3){
$r=mysql_query("delete from Gastos_categoria where categoria='".$_POST['categoria']."'");
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
}
elseif($_POST['opcion']==4){
$r=mysql_query("insert into Gastos_categoria value('".$_POST['categoria']."','".$_POST['subcategory']."')");
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
}
elseif($_POST['opcion']==5){
$r=mysql_query("update Gastos_categoria set sub_categoria='".$_POST['subcategoria']."' where categoria='".$_POST['categoria']."' and sub_categoria='".$_POST['sub_categoria']."'");
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
}
elseif($_POST['opcion']==6){
$r=mysql_query("delete from Gastos_categoria where categoria='".$_POST['categoria']."' and sub_categoria='".$_POST['sub_categoria']."'");
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
}
elseif($_POST['opcion']==7){
	if($_POST['subcat']=="0"){
	echo "<script languaje='javascript' type='text/javascript'>alert('Error al insertar gasto verifique subcategoria');location.href='Gastos.php';</script>";
	}else{
	$r=mysql_query("insert into Gastos(fecha,categoria,subcategoria,concepto,cantidad,cuenta) values('".$_POST['fecha']."','".$_POST['categoria']."','".$_POST['subcat']."','".$_POST['concepto']."',".$_POST['cantidad'].",'".$_POST['cuenta']."')");
	echo "<script languaje='javascript' type='text/javascript'>alert('Gasto registrado');location.href='Gastos.php';</script>";
	}
}
elseif($_POST['traspaso']=='Generar Traspaso'){

	if($_POST['opt']==1){
	$insertar=mysql_query("insert into traspasos(tipo,cuenta,cuenta2,efectivo,fecha) values(1,'".$_POST['cuenta']."','".$_POST['cuenta2']."',".$_POST['cantidad'].",'".date('Y-m-d')."')");
	echo "<script languaje='javascript' type='text/javascript'>alert('Traspaso registrado');location.href='Gastos.php';</script>";
	}elseif($_POST['opt']==2){
	$insertar=mysql_query("insert into traspasos(tipo,cuenta,cuenta2,efectivo,fecha) values(2,'".$_POST['cuenta']."','',".$_POST['cantidad'].",'".date('Y-m-d')."')");
	echo "<script languaje='javascript' type='text/javascript'>alert('Traspaso registrado');location.href='Gastos.php';</script>";
	}
	elseif($_POST['opt']==3){
	$insertar=mysql_query("insert into traspasos(tipo,cuenta,cuenta2,efectivo,fecha) values(3,'".$_POST['cuenta']."','',".$_POST['cantidad'].",'".date('Y-m-d')."')");
	echo "<script languaje='javascript' type='text/javascript'>alert('Traspaso registrado');location.href='Gastos.php';</script>";
	}

}
?>
<script>
function ocultar(op){
	 divT = document.getElementById("cat2");
	if(op!='0'){
         divT.style.display = "block";
	}else{
         divT.style.display = "none";
	}
}
</script>
</body>
</html>