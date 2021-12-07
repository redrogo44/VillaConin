<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<META HTTP-EQUIV="Refresh" CONTENT="300000000000; URL=http:../../index.php">  -->

<title>Documento sin título</title>
<script>
function cargar() {
	
//window.open("http:verDatos.php");
}
</script>

</head>

<?
require("funciones2.php");
conectar();

//VALIDAR SI ES SUB-CONTRATO
print_r($_POST);
$Contrato=explode("-",$_POST['numero']);
echo $Contrato[0];
echo $Contrato[1];
echo "Num= ".count($Contrato);
//
session_start();
$cons=mysql_query("Select ");
		
		$NumeroContrato=$_POST['nombre'];
       $folio=$_POST['numero'];
	   $fechaactual= date("d-m-Y");
	   $recibide=$_POST['recibide'];
	   $cantidadde=$_POST['cantidadde'];
	   $concepto=$_POST['concepto'];
	   $fechaevento=$_POST['fecha_e'];
	   $tipoeveto=$_POST['tipo'];
	   $salon=$_POST['salon'];
	   $ncontrato=$_POST['nombre'];
	   $cuenta=$_POST['cuenta'];
	
	$esfacturado="select facturado from contrato Where Numero='".$folio."'";
	$r2=mysql_query($esfacturado) or die(mysql_error());
	$factu=mysql_fetch_array($r2);
	$esfac=$factu['facturado'];
	$_SESSION['facturado']=$esfac;
	if($esfac=='si')
	   {
	
			 $insert="insert into abonofac(numcontrato,nomcontrato,cantidad,fechapago,recibide,concepto,tipoevento,salon,fechaevento,cuenta) values('".$folio."','".$ncontrato."',".$cantidadde.",'".$fechaactual."','".$recibide."','".$concepto."','".$tipoeveto."','".$salon."','".$fechaevento."','".$cuenta."')";
				   $r=mysql_query($insert);
					   
	   
				    $cons_q="select * from contrato where Numero='".$folio."'";
					$consulta=mysql_query($cons_q);
					$can=mysql_fetch_array($consulta);	
					$cantidad=$can['sa']-$cantidadde;
						
					$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$folio."'");
					if(count($Contrato)>1)
					{
						$cons_q="select * from contrato where Numero='".$Contrato[0]."'";
						$consulta=mysql_query($cons_q);
						$can=mysql_fetch_array($consulta);	
						$cantidad=$can['sa']-$cantidadde;
						$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$Contrato[0]."'");
					}
			$x="select * from contrato where Numero='".$folio."'";
			$x2=mysql_query($x);
			$x3=mysql_fetch_array($x2);
			$nuevafecha = strtotime ( '+1 month' , strtotime ( $x3['proximo_abono'] )) ;
			$nue = date ( 'Y-m-d' , $nuevafecha );
			$next=mysql_query("UPDATE contrato set proximo_abono='".$nue."' where Numero='".$folio."'");		  
	   }
	   else
	   {			////
			
			 $insert="insert into abono(numcontrato,nomcontrato,cantidad,fechapago,recibide,concepto,tipoevento,salon,fechaevento,cuenta) values('".$folio."','".$ncontrato."',".$cantidadde.",'".$fechaactual."','".$recibide."','".$concepto."','".$tipoeveto."','".$salon."','".$fechaevento."','".$cuenta."')";
				   $r=mysql_query($insert);
					   
	   
				    $cons_q="select * from contrato where Numero='".$folio."'";
					$consulta=mysql_query($cons_q);
					$can=mysql_fetch_array($consulta);
							$cantidad=$can['sa']-$cantidadde;
						
					$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$folio."'");
					if(count($Contrato)>1)
					{
						$cons_q="select * from contrato where Numero='".$Contrato[0]."'";
						$consulta=mysql_query($cons_q);
						$can=mysql_fetch_array($consulta);	
						$cantidad=$can['sa']-$cantidadde;
						$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$Contrato[0]."'");
					}


			$x="select * from contrato where Numero='".$folio."'";
			$x2=mysql_query($x);
			$x3=mysql_fetch_array($x2);
			$nuevafecha = strtotime ( '+1 month' , strtotime ( $x3['proximo_abono'] )) ;
			$nue = date ( 'Y-m-d' , $nuevafecha );
			$next=mysql_query("UPDATE contrato set proximo_abono='".$nue."' where Numero='".$folio."'");	   
	   }

?>
<body onload="cargar()">
</body>
</html>