<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<?php 
require("configuraciones.php");
conectar();
	mysql_query("UPDATE Meseros SET comentarios='' WHERE 1");
	
?>
<script>
	setTimeout ("cerrar()", 1500); //tiempo expresado en milisegundos	
	function  cerrar()
	{ 
		//window.location ="http://www.dominio.com";
		window.close();	
	}
</script>
<body>
</body>
</html>