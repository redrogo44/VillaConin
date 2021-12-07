<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
require 'funciones2.php';
validarsesion();
?>
<meta http-equiv="refresh" content="20; url=index.php" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>cargar presupuesto</title>
			
<script>
function cargar() {
	window.open("PDF_Presupuesto.php?numero=<?php echo $_GET['precliente']; ?>");
	window.location.href='index.php';
}
</script>

<?php
conectar();
mysql_query("update presupuesto set comentario='".$_GET['comentario']."' where id_precliente='".$_GET['precliente']."'");
?>
</head>
<body onload="cargar()">
</body>
</html>