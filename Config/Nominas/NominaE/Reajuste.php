<?php
require('../../configuraciones.php');
//require('funciones.php');
conectar();

$e=mysql_fetch_array(mysql_query("SELECT * FROM Empleados WHERE id=".$_GET['id']));
$acumulado=$e['acumulado'];
if($acumulado=='')
{
	$acumulado=0;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
 	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/muestra.js"></script>
</head>
<body>
	<div align="center">
	<form action="Acciones_Nomina.php"  method="post" accept-charset="utf-8">
		<table>
			<caption>Reajuste de Puntos, <?php echo $e['nombre'];?></caption>			
			<tbody>
				<tr>
					<td style="width: 180px;">Puntos Actuales:</td>
					<td><p><b><?php echo $acumulado;?></b></p></td>
				</tr>
				<tr>
					<td>Ingrese o Disminuya ciertos Puntos</td>
					<td>
						<input ype="number"name="reajuste" value="" placeholder="     +  ,  -   Puntos">						
					</td>			
				</tr>				
				<tr >
					<td align="center" colspan="2">
					<input type="submit"  class="btn" name="" value="Reajustar Puntos">
					<input type="hidden" name="id" value="<?php echo $e['id'];?>">
					<input type="hidden" name="acumulado" value="<?php echo $acumulado;?>">
					<input type="hidden" name="accion" value="Reajuste-Puntos">
					</td>
				</tr>
			</tbody>
		</table>
	</form>
		
	</div>	
</body>
</html>