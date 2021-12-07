<?php
 require 'funciones2.php';
 conectar();
	$guardar=mysql_query("select * from preregistro where id='".$_GET['numero']."'");
	$guardar2=mysql_fetch_array($guardar);
	$fr=explode(' ',$guardar2['fdr']);
	$guardar3=mysql_query("insert into eliminados(fecha_registro,cliente,vendedor,tipo,medio_contacto,estatus,comentarios) values('".$fr[0]."','".$guardar2['nombre']."','".$guardar2['registro']."','".$guardar2['tipo']."','".$guardar2['medio']."','eliminado','".$_GET['razon']."')");
	$borrar=mysql_query("delete from preregistro where id='".$_GET['numero']."'");
?>
<html>
<head>
<script language="JavaScript" type="text/javascript">
	function r(){
	alert('Se elimino correctamente al Pre-Cliente')
	location.href="index.php"
	}
	</script>
</head>
<body onload="r()">
</body>
</html>