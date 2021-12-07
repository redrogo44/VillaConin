<?php
require_once("class/class.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listado de Productos</title>
</head>

<body>
<h1>Listado de Productos</h1>
<table>
<tr style="background-color:#666; color:#FFF">
<td valign="top" align="center">Producto</td>
<td valign="top" align="center">Precio</td>
<td valign="top" align="center">Fecha</td>
<td valign="top" align="center">Código</td>
</tr>

<?php
$tra=new Trabajo();
$datos=$tra->get_productos();
for ($i=0;$i< sizeof($datos);$i++)
{
	?>
		<tr style="background-color:#f0f0f0">
		<td valign="top" align="center">	<?php echo $datos[$i]["nombre"];?>	</td>
		<td valign="top" align="center">	<?php echo number_format($datos[$i]["precio"],0,"",".");?></td>
		<<td valign="top" align="center">	<?php echo $datos[$i]["fecha"];?>		</td>
		<td valign="top" align="center">
		<img src="barcodegen.1d-php5.v4.0.0/test.php?cod=<?php echo $datos[$i]["codigo"];?>" />
		</td>
		</tr>
	<?php
}
?>
</table>
</body>
</html>