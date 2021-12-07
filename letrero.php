<?php
$con = mysql_connect("localhost","qroodigo_usuarios","qroodigo_usuarios");
	if(!$con)
	{
		die('no hay conexion al servidor');
	}
	$base = mysql_select_db('qroodigo_VillaConin2');
	if(!$base){
		die('no se pudo conectar a la bd');
	}
	else{
	mysql_set_charset('utf8');
	 //echo "conexion exitosa";
	}
	$sql="select count(*) as cantidad from cliente where rfc='".strtoupper($_GET['id'])."'";
$res=mysql_query($sql);
while($cant=mysql_fetch_array($res))
	{
		if($cant['cantidad']>0){
			
			echo '<font color="red"><strong><small><center>Error RFC ya Existente</center></small></strong></font>';
			echo '<input type="hidden" id="condicion" value="incorrecto">';
			}else{
				echo '<input type="hidden" id="condicion" value="correcto">';
				}
			}
	
	

	?>