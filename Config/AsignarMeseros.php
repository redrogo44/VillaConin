<?php
require("configuraciones.php");
conectar();
pie();
print_r($_POST);
mysql_query("UPDATE `Configuraciones` SET `descripcion`='".$_POST['contratos']."' WHERE id=2");
$CONT = explode(",", $_POST['contratos']);
		for ($w=0; $w < count($CONT); $w++) 
		{ 
			echo $xv="UPDATE contrato SET Meseros='' WHERE Numero='".$CONT[$w]."'";
			mysql_query($xv);		
		}
echo  $cons['descripcion'];
echo "Numero de Contratos ".(count($CONT))."<br>";
   print_r($_POST);
echo "<br>";
///////////////////////		MESEROS
	for($i=0;$i<=$_POST['ncHECK'];$i++) // Recorre los Check`s 
	{
		if(isset($_POST[$i])) // Si existe el Check
		{
			echo $_POST[$i]."<br>";
			$VArray=explode(",", $_POST[$i]); // Guardamos el Array de 2 dimensiones, la primera es el Numero de Check y la segunda es el ID del MEsero
			$contrato= $VArray[0] % (count($CONT)); // Sacamos el Modulo de el # de Check / el numero de Contratos para determinar a que Contrato se Asignara
			echo $ME="Select * from Meseros Where id=".$VArray[1]; // Buscamos al MEsero
			echo $ME."<br>";
			$X=mysql_fetch_array(mysql_query($ME));
			$Reconfirma=$X['ReConfirmar'];
			$nevento=$X['porcentaje'];
			$nevento=$nevento+1;
			echo "N Evetnosoooo".$Reconfirma=$Reconfirma+1;
			echo $UPM="UPDATE `Meseros` SET `disponibilidad`='no', `confirmacion`='si' , `ReConfirmar`=".$Reconfirma." WHERE id=".$X['id'];

			mysql_query($UPM);
		 $CONTRAX=mysql_query("Select Meseros from contrato Where Numero='".$CONT[$contrato]."'"); // OBTENEMOS LO QUE HAYA EN MESEROS DE L TABLA CONTRATO
			if (mysql_num_rows($CONTRAX)<1) 
			{
				$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$CONT[$contrato]."' ");	
				if(mysql_num_rows($Ea)<1)
				{
					$Ear=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$CONT[$contrato]."' ");
					$XXMESEROr=mysql_fetch_array($Ear);	
					echo $DIFICAMr="UPDATE Eventos_Recaudacion SET Meseros='".$X['id'].",".$XXMESEROr['Meseros']."' WHERE Numero='".$CONT[$contrato]."'"; // mODIFICAMOS LOS MESEROS DEL CONTRATO
					mysql_query($DIFICAMr);				
				}
				else
				{
				$XXMESERO=mysql_fetch_array($Ea);	
				echo $DIFICAM="UPDATE Eventos_Adicionales SET Meseros='".$X['id'].",".$XXMESERO['Meseros']."' WHERE Numero='".$CONT[$contrato]."'"; // mODIFICAMOS LOS MESEROS DEL CONTRATO
				$e=mysql_query($DIFICAM);			
				}		
				
			}
			else
			{
				$XXMESERO=mysql_fetch_array($CONTRAX);
				echo $mODIFICAM="UPDATE contrato SET Meseros='".$X['id'].",".$XXMESERO['Meseros']."' WHERE Numero='".$CONT[$contrato]."'"; // mODIFICAMOS LOS MESEROS DEL CONTRATO
			$e=mysql_query($mODIFICAM);				

			}
			
			
			echo  "Mesero Nombre = ".$X['id']." Numero de Contrato = ".$contrato." COntrato ".$CONT[$contrato+1]."<br>";
			
			/*for($j=1;$j<=count($CONT)-2;$j++) // Recorremos los Contratos para Asignrles los MESEROS por contrato
			{
				
				
			}*/
			echo "<br>POST  ".$_POST[$i]."<br>";
		}
	}
	// reiniciamos los valores de llamada de los Meseros

echo $re="UPDATE `Meseros` SET nivel='0',disponibilidad='no'WHERE 1";
 mysql_query($re);		
	for ($l=0; $l <count($CONT); $l++) 
	{ 	
		echo $fx="INSERT INTO `Confirmacion_Eventos`(`Semana`, `Contratos`) VALUES (".date('W').",'".$CONT[$l]."')";
		mysql_query($fx) or die(mysql_error());
	}
?>
<body>
<script type="text/javascript">

window.location="https://villaconin.mx/Config/ExcelMeseros.php?cantida=<?php echo $_POST['TTM'];?>&prom=<?php echo $_POST['prom'] ?>";		
setTimeout ("cerrar()", 3500); //tiempo expresado en milisegundos

function  cerrar()
{ 
	window.location ="modifica_comentario_meseros.php";
//	window.close();	
}

</script>
<br>
<br>
</body>