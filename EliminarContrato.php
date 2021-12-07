<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php

require 'configuraciones.php';
validarsesion();

?>
<meta http-equiv="refresh" content="10; url=http:index.php" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Eliminaar Contrato</title>
			
<script>
function cargar() {
	//window.open("http://www.pruebasvilla.mbrsoluciones.com.mx/CancelacionAbono.php");
}
</script>

<?php
conectar();
$id=$_GET['numero'];
// Insertar Tabla CargosCancelados

// ELIMINACIOND DE CONTRATO DEFINITIVAMENTE DEL SISTEMA
$buscar="DELETE FROM `contrato` WHERE Numero='".$id."';";
$consulta1=mysql_query($buscar);

?>
</head> 
<body onload="cargar()">
</body>
</html>