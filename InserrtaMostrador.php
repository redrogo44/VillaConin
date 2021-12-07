<?php
include"funciones2.php";
conectar();
print_r($_POST);
print_r($_GET);

if(count($_POST) > 0)
{
	
	
	
	if($_POST['tipo']=='inserta_contrato')
	{
		print_r($_POST);
		echo 	$insertar=
		"insert into contrato
		(Numero, nombre, fechacontrato, Fecha, tipo, salon,vendedor, estatus, registro, fdr,id_cliente,impreso,si,sa,facturado) 
		values(
		'MOSTRADOR".date('my')."','PUBLICO EN GENERAL','".date("Y-m-d")."','".date("Y-m-d")."','MOSTRADOR','SIN SALON','MOSTRADOR',0,'MOSTRADOR','".date("Y-m-d")."',0,'si',0,0,'si')";
		mysql_query($insertar) or die('Error no se inserto el cntrato');
				
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php">';
	}
	
}
if(count($_GET) > 0)
{
	print_r($_GET);
	echo $busca="SELECT * FROM `contrato` WHERE `estatus`=0 and`Numero` LIKE 'MOSTRADOR%'";
		$f=mysql_query($busca);
		$CM=mysql_fetch_array($f);
		$contrato=$CM['Numero'];
		echo "Saldo Actual".$CM['sa'];
		echo "Saldo Actual ".$sa=$_GET['saldo']-$CM['sa'];
		echo $up="UPDATE `contrato` SET `estatus`=2, si=".$_GET['saldo'].",`sa`=".$sa." WHERE Numero='".$contrato."'";
		mysql_query($up) or die ('Error');
		?>
		<script>
		alert('Contrato Finalizado');
	window.open("Contrato_Mostrador.php?numero=<?php echo "$contrato"?>","MOSTRADOR","width=385,height=180,top=0,left=0',status,toolbar =1,scrollbars,location");
	location.href="index.php";
		</script>
	<?php
		echo '<META HTTP-EQUIV="Refresh" CONTENT="3000; URL=index.php>';
	
	
}


?>
</body>