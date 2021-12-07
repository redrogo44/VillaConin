<?php
require('../funciones2.php');
conectar();
//print_r($_POST);
 $ee="SELECT * FROM Eventos_Recaudacion WHERE Numero='".$_POST['numero']."'";
$e=mysql_query($ee);
	if(mysql_num_rows($e)>=1)
	{
		 $er=mysql_fetch_array($e);
		if($er['corte']=='si')
		{
			echo "ya hay corte";
		}
		else
		{
		mysql_query("UPDATE Eventos_Recaudacion SET corte='si' WHERE Numero='".$_POST['numero']."' ");	
		mysql_query("UPDATE `usuarios` SET `Contrato`='' WHERE `Contrato`='".$_POST['numero']."' ");	

			echo $er['Numero'];
		}
	}
?>