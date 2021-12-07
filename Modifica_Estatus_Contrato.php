<!DOCTYPE html>
<html lang="es">
<head>

    <!-- aqui pondremos el contenido html -->
</head>

<body>
<?php
require("funciones2.php");
conectar();
$TD=mysql_query("SELECT * FROM TDevoluciones");
while ($TM=mysql_fetch_array($TD)) 
{
	$TC=mysql_query("SELECT * FROM contrato WHERE Numero='".$TM['Numero']."'");
	$TMC=mysql_fetch_array($TC);
	//echo $TM['Numero']." Estatus TDevluciones ".$TM['estatus']." Estatus T Contrato ".$TMC['estatus']."<br>";
	if ($TM['estatus']==0) 
	{
		echo $f="UPDATE contrato SET estatus=1 WHERE Numero='".$TM['Numero']."'";
		mysql_query($f);
		echo "<br>";
	}
}
?>

</body>
</html>