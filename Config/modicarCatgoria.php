<?php

require('configuraciones.php');
conectar();

	$cat_anterior=$_POST['anterior'];
	$cate=mysql_query("SELECT * FROM Meseros WHERE tipo='".$cat_anterior."'");
	while($CM=mysql_fetch_array($cate))
	{
		echo $CM['nombre']." ".$CM['ap']." ".$CM['am']."  tipo= ".$CM['tipo'];
		//echo "UPDATE Meseros SET tipo='".$_POST['nombre']."' WHERE id=".$CM['id'];
		mysql_query("UPDATE Meseros SET tipo='".$_POST['nombre']."' WHERE id=".$CM['id']);
		mysql_query("UPDATE Configuraciones SET descripcion='".$_POST['nombre']."' where descripcion='".$cat_anterior."'");		
	}
		echo '
	<script>
		alert("SE HA MODIFICADO EL NOMBRE DE LA CATEGORIA CORRECTAMENTE");
	</script>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=Insert_Meseros.php">';
?>