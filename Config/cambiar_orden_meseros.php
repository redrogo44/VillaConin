<?php
require "configuraciones.php";
conectar();


print_r($_POST);

echo $_POST['4'];
print_r($_POST['select2']['4']);
echo "la longitud de la matriz es de ".count($_POST['select2']);
$ORDEN;
for ($i=count($_POST['select2']); $i >=0; $i--) 
{ 
	if ($ORDEN=="") 
	{
		$ORDEN=$_POST['select2'][$i];
	}
	else
	{
		$ORDEN=$ORDEN.",".$_POST['select2'][$i];
	}
}

echo "la sentencia es".$ORDEN;

echo $Mod="UPDATE Configuraciones SET descripcion='".$ORDEN."' WHERE nombre ='ORDEN MESEROS'";
mysql_query($Mod);
?>
<script type="text/javascript">
window.location="http:Insert_Meseros.php";
</script>