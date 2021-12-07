<?php
require('../funciones2.php');
conectar();
if($_POST["op"]=="agregar_extra"){
	$q="insert into Extras(fecha,tipo,comensales)values('".$_POST["fecha"]."','".$_POST["tipo"]."',".$_POST["comensales"].")";
	mysql_query($q);
	header('Location:Extras.php');
}else if($_POST["op"]=="busca_evento"){
	
	$q=mysql_query("select * from Extras where fecha>='".$_POST["f1"]."' and fecha<='".$_POST["f2"]."'");
	echo "<br><br><table border='1'>";
	echo "<tr><td>FECHA</td><td>TIPO</td><td>COMENSALES</td><td>ELIMINAR</td><td>MENU</td></tr>";
	while($m=mysql_fetch_array($q)){
		echo "<tr><td>".$m["fecha"]."</td><td>".$m["tipo"]."</td><td>".$m["comensales"]."</td><td><button class='btn btn-danger' onclick='eliminar(".$m["id"].")'>Eliminar</button></td><td><button class='btn btn-success' onclick='asignar_menu(".$m["id"].")'>Ver Menu</button></td></tr>";
	}
}else if($_POST["op"]=="eliminar_evento"){
	
	mysql_query("delete from Extras where id=".$_POST["id"]);
} 
?>