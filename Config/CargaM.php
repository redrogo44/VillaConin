<?php
require("configuraciones.php");
conectar();
//pie();
session_start();
$m="SELECT * FROM MESEROS WHERE";
print_r($_POST);
date_default_timezone_set ( 'America/Mexico_City');
$MontoConfirmacion=0;
for($i=0;$i<$_POST['ncHECK'];$i++)
{	
	if($_POST[$i])
	{ $idm=explode("-",$_POST[$i]);
		// PUNTOS								
			 echo $mmm="Select * from Meseros Where id=".$idm[0];
			 echo "<br>";
			$ne=mysql_fetch_array(mysql_query($mmm));
			$pun=mysql_query("SELECT * FROM Configuraciones WHERE descripcion='".$ne['tipo']."'");
			$puntos=mysql_fetch_array($pun);
			$PunCAT=$puntos['puntos']+$puntos['acumulado'];
			$acumula=$ne['acumulado']+$puntos['puntos'];
			echo "<br>";
			 "Eventos ".$nee=($ne['neventos']);
			echo "Eventos ".$nee=$nee+1;
			$Recon=$puntos['ReConfirma'];
			$Recon=$Recon-1;
			echo "<br>";
			echo $upm="UPDATE `Meseros` SET `neventos`=".$nee.", `acumulado`=".$acumula.", ReConfirmar	=".$Recon." , disponibilidad2='no',`confirmacion`='no' WHERE id=".$idm[0];		 
		 	mysql_query($upm);
		 	$acm=mysql_query("UPDATE `Configuraciones` SET  `acumulado`=".$PunCAT." WHERE id=".$puntos['id']);

echo "<br>";
				echo $meseros=$meseros.",".$_POST[$i];												
				echo "<br>";
				
				$t=explode("-",$_POST[$i]);
				$MontoConfirmacion+=$t[2];
	}
	
}


echo "<br><br>Monto Total: ".$MontoConfirmacion;


//echo "<br><br>";
// GUARDAR REGISTRO DE EVENTOS
	echo $contra="Select * from Confirmacion_Eventos Where id=".$_POST['idEvento'];
	$contrato=mysql_fetch_array(mysql_query($contra));		
	$semana=date("Y");
	echo "<br>";
		echo "Descripcion ".$contrato['Contratos'];
		echo $ire="INSERT INTO `TMeserosEvento`( `semana`, `ano`, `contratos`, `meseros`, `registro`, `fdr`) 
		VALUES ('".(date("W")-1)."','".$semana."','".$contrato['Contratos']."','".$meseros."','".$_SESSION['usr']."','".date("d/m/y H:i:s")."')";
		mysql_query($ire);	

	$fe=mysql_fetch_array(mysql_query("SELECT Fecha FROM contrato WHERE Numero='".$contrato['Contratos']."' "));

////validamos la fecha porque en fiesta de recaudacion pone 0000-00-00

if($fe['Fecha']=="0000-00-00" || $fe['Fecha']==""){
	$fe['Fecha']=date("Y-m-d");
}

////////
//////// falta la validacion de la variable del nuemro de contrato si es NULL no se inserta
////////

mysql_query("INSERT INTO `Movimientos_Cuentas`(`fecha`, `banco_emisor`, `cuenta_emisor`, `banco_receptor`, `cuenta_receptora`, `cantidad`, `concepto`, `facturado`, `estatus`) VALUES ('".$fe['Fecha']."','Efectivo','2','Nomina Meseros','Nomina Meseros',".$MontoConfirmacion.",'Nomina Meseros Contrato:".$contrato['Contratos']." ',0,'activo' ) ");

		mysql_query("DELETE FROM `Confirmacion_Eventos` WHERE `id`=".$_POST['idEvento']);
	
?>

<body onLoad="cerrar()">
<script type="text/javascript">
//window.location="http:ExcelMeseros.php";
setTimeout ("cerrar()", 300); //tiempo expresado en milisegundos
function  cerrar()
{
	window.opener.document.location="Lista_de_Semanas.php";
	window.close();	
}

</script>

</body>