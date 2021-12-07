<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<meta http-equiv="refresh" content="15; url=http:CostoCargos.php?numero=<?php echo $_POST['numero'];?>" />

<body>
<script>
function cargar() {
	window.open("HojaAnexa.php?numero=<?php echo $_GET['numero']; ?>");
}
</script>
<?php
echo $_POST['numero'];
$conexion=mysql_connect("localhost","mbrsoluc_villaco","}g8T^Tm7xesi");
mysql_select_db("mbrsoluc_pruebasvilla",$conexion);

$x = $_POST['select2'];$val="";
foreach($x as $value) {
	echo $val=$val.$value.",";
}
count($value);
$_POST['contrato'];

echo "<br>".$val;


$Servcio = explode(",", $val);
echo "tamaño del array".$tamaño=substr_count($val, ','); // 2
for($i=0;$i<$tamaño;$i++)
{
	echo $Servicios="Select Servicio from Servicios where id='".$Servcio[$i]."'";
	$cas=mysql_fetch_array($Servicios);
	echo $cas['Servicio'];		
}
echo $q="UPDATE contrato SET ServiciosAdicionales='".$val."' Where Numero='".$_POST['contrato']."'";
$consulta=mysql_query($q)or die (mysql_error());

?> 


<script language="javascript">
//location.href='http://www.pruebasvilla.mbrsoluciones.com.mx/index.php';
</script>

  

</body onload="cargar()">
</html>
