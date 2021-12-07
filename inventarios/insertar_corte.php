<?php
require 'funciones.php';
conectar();
mysql_query("insert into corte_inventario(fecha,hora)values('".$_GET['fecha']."','".$_GET['hora']."')");
?>
<html>
<head>
<script>
function c(){
	window.close();
	}
</script>
</head>
<body onload="c()">
</body>
<html> 