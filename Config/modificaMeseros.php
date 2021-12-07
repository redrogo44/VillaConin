<?php
	
	require('configuraciones.php');
	conectar();

	$sel=mysql_query("SELECT * FROM TMeserosEvento Where id=97");
	$M=mysql_fetch_array($sel);
	echo $M['meseros']."<br>";
	$N=explode(",", $M['meseros']);
	for ($i=0; $i <count($N); $i++) 
	{ 
		$MS=mysql_query("SELECT * FROM Meseros WHERE id=".$N[$i]);
		while ($NM=mysql_fetch_array($MS))
		{

			echo $i.".-  ".$NM['nombre']." ".$NM['ap']." ".$NM['am']."<br>";
			$pun=mysql_query("SELECT * FROM Configuraciones WHERE descripcion='".$NM['tipo']."'");
			$puntos=mysql_fetch_array($pun);
			$PunCAT=$puntos['acumulado']-$puntos['puntos'];
			$acumula=$NM['acumulado']-$puntos['puntos'];
			echo "<br>";
			 "Eventos ".$nee=($NM['neventos']);
			echo "Eventos ".$nee=$nee-1;
			$Recon=$puntos['ReConfirma'];
			$Recon=$Recon-1;
			echo "<br>";
			echo $upm="UPDATE `Meseros` SET `neventos`=".$nee.", `acumulado`=".$acumula." WHERE id=".$N[$i];		 
		 	mysql_query($upm);
		 	$acm=mysql_query("UPDATE `Configuraciones` SET  `acumulado`=".$PunCAT." WHERE id=".$puntos['id']);
				$meseros=$meseros.",".$_POST[$i];		
		}
							
	}
	// PUNTOS								
			
?>