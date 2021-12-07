<?php
require("configuraciones.php");
conectar();

print_r($_POST);
$des='';
for($i=0;$i<=$_POST['numero'];$i++)
{
	if(!empty($_POST['Evento'.$i]))
	{
		if(empty($des))
		{
			$des=$_POST['Evento'.$i].'%'.$_POST['depende'.$i];
		}
		else
		{
			$des=$des.",".$_POST['Evento'.$i].'%'.$_POST['depende'.$i];
		}	
	}
}
mysql_query("UPDATE Configuraciones SET descripcion='".$des."' WHERE nombre='Eventos Adicionales'");
echo '<meta http-equiv="Refresh" content="0;url=http:ConfiguracionSistema.php">';	
?>