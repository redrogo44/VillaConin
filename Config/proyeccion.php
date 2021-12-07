<?php
require("configuraciones.php");
conectar();
pie();
print_r($_POST);
if($_POST['tipo']=='Confirmar_Proyeccion')
{
		mysql_query("UPDATE `Configuraciones` SET `descripcion`='".$_POST['contratos']."' WHERE id=2");
		$CONT = explode(",", $_POST['contratos']);
		echo  $cons['descripcion'];
		echo "Numero de Contratos ".(count($CONT))."<br>";
		   print_r($_POST);
		echo "<br>";$v=1;
		///////////////////////		MESEROS
			for($i=0;$i<$_POST['ncHECK']-1;$i++) // Recorre los Check`s 
			{
				if(isset($_POST[$i])) // Si existe el Check
				{
					echo $_POST[$i]."<br>";
					$VArray=explode(",", $_POST[$i]); // Guardamos el Array de 2 dimensiones, la primera es el Numero de Check y la segunda es el ID del MEsero
					$contrato= $VArray[0] % (count($CONT)); // Sacamos el Modulo de el # de Check / el numero de Contratos para determinar a que Contrato se Asignara
					echo $ME="Select id from Meseros Where id=".$VArray[1]; // Buscamos al MEsero
					echo $ME."<br>";
					$X=mysql_fetch_array(mysql_query($ME));
					//$UPM="UPDATE `Meseros` SET `confirmacion`='si' WHERE id=".$X['id'];
					//mysql_query($UPM);
					echo $CONTRAX="Select Meseros from contrato Where Numero='".$CONT[$contrato]."'"; // OBTENEMOS LO QUE HAYA EN MESEROS DE L TABLA CONTRATO
					$XXMESERO=mysql_fetch_array(mysql_query($CONTRAX));

					echo $mODIFICAM="UPDATE contrato SET Meseros='".$X['id'].",".$XXMESERO['Meseros']."' WHERE Numero='".$CONT[$contrato]."'"; // mODIFICAMOS LOS MESEROS DEL CONTRATO
					$e=mysql_query($mODIFICAM);
					echo  "Mesero Nombre = ".$X['id']." Numero de Contrato = ".$contrato." COntrato ".$CONT[$contrato+1]."<br>";
					$v++;
					/*for($j=1;$j<=count($CONT)-2;$j++) // Recorremos los Contratos para Asignrles los MESEROS por contrato
					{
						
						
					}*/
					echo "<br>POST  ";$_POST[$i];
				}
			}
		mysql_query("UPDATE `Configuraciones` SET `descripcion`='' WHERE tipo='Proyeccion'");			
			?>
			<script languaje="javascript"> 
			window.location="https://villaconin.mx/Config/ExcelMeseros2.php?cantida=<?php echo $_POST['TTM'];?>&prom=<?php echo $_POST['prom'] ?>";		
			setTimeout("window.close()",3000);				
			</script> 
			<?php
			
}
if($_POST['tipo']=='Guardar_Proyeccion')
{

	$CONTRATOS_SELECC=explode(',',$_POST['contratos']);
	for ($l=0; $l < count($CONTRATOS_SELECC); $l++) 
	{ 
		echo $xv="UPDATE contrato SET Meseros='' WHERE Numero='".$CONTRATOS_SELECC[$l]."'";
		mysql_query($xv);		
	}
	
	echo "CONTRATOS ".count($CONTRATOS_SELECC);
	//print_r($_POST);
	for($i=0;$i<$_POST['ncHECK'];$i++) // Recorre los Check`s 
	{
		if(isset($_POST[$i])) // Si existe el Check
		{
				
				$id_check=explode(',', $_POST[$i]);// SEPARO LO QUE TRAE EL CHECK POSICION 0 ES EL NUMERO DE CHECK POSICION 1 ES EL ID DEL MESERO
				for ($p=0; $p <count($CONTRATOS_SELECC); $p++) 
				{ 
					if(($id_check[0] % count($CONTRATOS_SELECC))==$p)
					{	
						$CONTR=mysql_query("SELECT * FROM contrato WHERE Numero='".$CONTRATOS_SELECC[$p]."'");
						$contR=mysql_fetch_array($CONTR);
						mysql_query("UPDATE contrato SET Meseros='".$id_check[1].",".$contR['Meseros']."' WHERE NUMERO ='".$CONTRATOS_SELECC[$p]."'");
					}		
				}				
		}
	}
	$UPContrato=mysql_query();
	$ids;
		for ($i=0; $i < $_POST['ncHECK']; $i++) 
			{ 		
				if (isset($_POST[$i])) 
				{
					# code...
				
					$VArray=explode(",", $_POST[$i]); // Guardamos el Array de 2 dimensiones, la primera es el Numero de Check y la segunda es el ID del MEsero	
					if (empty($ids)||$ids=='')
					{
						$ids=$VArray[0]."-".$VArray[1];
					}
					else
					{
						 $ids=$ids.",".$VArray[0]."-".$VArray[1];				
					}
				}
									
			}
			$fechas=$_POST['fecha1'].",".$_POST['fecha2'];

		mysql_query("UPDATE `Configuraciones` SET `descripcion`='".$fechas."', valor=".$_POST['ncHECK']." WHERE tipo='Proyeccion'");
		?>
			<script languaje="javascript"> 
				//window.location="http:ExcelMeseros.php";	
				alert('Proyeccion Guardada');
				setTimeout ("cerrar()", 3000); //tiempo expresado en milisegundos					
			</script> 
			<?php
}
if ($_POST['tipo']=='Cancelar_Proyeccion') 
{
	$CONTRATOS_SELECC=explode(',',$_POST['contratos']);
	echo "CONTRATOS ".count($CONTRATOS_SELECC);	
	for ($v=0; $v <count($CONTRATOS_SELECC); $v++) 
	{ 
		mysql_query("UPDATE `contrato` SET Meseros='' WHERE Numero='".$CONTRATOS_SELECC[$v]."'");
	}
		echo $Conf="UPDATE `Configuraciones` SET `descripcion`='', valor=0 WHERE tipo='Proyeccion'";
		mysql_query($Conf);

		?>
		<script languaje="javascript"> 
				//window.location="http:ExcelMeseros.php";	
				setTimeout ("cerrar()", 3000); //tiempo expresado en milisegundos					
			</script> 
			<?php

}
?>

<body>
<script type="text/javascript">
function  cerrar()
{
	window.close();	
}
</script>
</body>