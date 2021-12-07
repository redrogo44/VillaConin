<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
require 'funciones2.php';
validarsesion();
?>
<meta http-equiv="refresh" content="20; url=index.php" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>cargar hoja anexa</title>
			
<script>
function cargar() {
	window.open("HojaAnexa.php?numero=<?php echo $_GET['contrato']; ?>");
	window.location.href='index.php';
}
</script>

<?php
conectar();
//echo "update contrato set imphojaanexa='si' comentario_H_A='".$_GET['comentario']."' where Numero='".$_GET['contrato']."'";
//print_r($_GET);
//echo "update contrato set imphojaanexa='', comentario_H_A='".$_GET['comentario']."' where Numero='".$_GET['contrato']."'";
mysql_query("update contrato set imphojaanexa='si', comentario_H_A='".$_GET['comentario']."' where Numero='".$_GET['contrato']."'");
$q=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_GET['Numero']."'"));
if(isset($q["id_cliente"])){
	mysql_query("update presupuesto set servicios='".$q["servicios"]."' where id_cliente=".$q["id_cliente"]);
}else{
	mysql_query("insert into presupuesto values(00000,'".$q["servicios"]."',1,".$q["id_cliente"].")");
}

?>
</head> 
<body onload="cargar()">
</body>
</html>