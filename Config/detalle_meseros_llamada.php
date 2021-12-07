<?php
	require "configuraciones.php";
	conectar();
//print_r($_POST);
////////////////////////////////////	MESEROS QUE PROYECTARON PERO NO LLAMARON	////////////////////////////////////////////////////////
$datos='';
$array=explode(",", $_POST['contratos']);
		for($i=0;$i<count($array);$i++)
		{
			$c=mysql_query("SELECT * FROM contrato WHERE Numero='".$array[$i]."' ");
			if (mysql_num_rows($c)<1) 
			{
				$ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$i]."' ");
				if(mysql_num_rows($ea)<1)
				{
					$er=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$array[$i]."' ");
					$ER=mysql_fetch_array($er);
					$datos=$datos."/".$array[$i]."-".$ER['Meseros'];
				}
				else
				{
					$EA=mysql_fetch_array($ea);
					$datos=$datos."/".$array[$i]."-".$EA['Meseros'];
				}
			}
			else
			{
				$C=mysql_fetch_array($c);
				$datos=$datos."/".$array[$i]."-".$C['Meseros'];
			}
		}	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//echo "<br>".$datos;
		$dato=explode("/", $datos);
	 $ant='';
			echo "<table border='5'>
					<th><b>RELACION DE MESEROS SIN LLAMADO</b></th>";
					for ($i=1; $i <count($dato) ; $i++) 
					{
						$c=explode("-",$dato[$i]);
						echo "<tr><th bgcolor='#BCFF00'><font><b>".$c[0]."</b></font></th></tr>";
						$m=explode(",",$c[1]);
						for ($j=0; $j <count($m) ; $j++) 
						{ 
							$mee=mysql_query("SELECT * FROM Meseros WHERE id=".$m[$j]);
							while($me=mysql_fetch_array($mee))
							{
								if ($me['disponibilidad']=='no') 
								{
								echo "
									<tr><td><b>".$me['id']." ".$me['nombre']." ".$me['ap']." ".$me['am']."  ".$me['disponibilidad']."</b></td></tr>
								";	
								$ant=$me['id'];
								}
								
							}
							
						}
					}
			echo "</table>";			
		
?>