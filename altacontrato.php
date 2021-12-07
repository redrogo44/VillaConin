<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'funciones2.php';
conectar();
validarsesion();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Villaconin</title>
</head>
<body>
<?php
session_start();



//////////comprobacion si esta apartado el salon ese dia se hace la consulta con todos los vendedore
$ex=0;///bandera de exitencia de contratos  en el salon y fecha proporcionada
$nc=nombre_contrato($_POST['fechaevento'],$_POST['salon'],"");
$cantidad_contratos=mysql_fetch_array(mysql_query("select count(*) as t from contrato where Numero like '".$nc."%'"));
$ex=$cantidad_contratos['t'];



if($ex>0){
    echo "<script>alert('Error el salon ya no se encuentra disponible');</script>";
    echo '<meta http-equiv="refresh" content="0; url=Contrato.php?idcliente='.$_POST['idcliente'].'" />';
    die("ERROR");
}else{
$nc=nombre_contrato($_POST['fechaevento'],$_POST['salon'],$_POST['vendedor']);
$registro=$_SESSION['usu'];
$fdr= date("y/m/d H:i:s");
			
			$query="select * from cliente where id=".$_POST['idcliente'];
			$res=mysql_query($query);
		
			while($m=mysql_fetch_array($res)){
			
/*				
			$saldoi;
			if(empty($_POST['si']))
			{
				$saldoi=0;
			}else{
				$saldoi=$_POST['si'];
				}
	*/		
			$servicios=mysql_fetch_array(mysql_query("select * from presupuesto where id_cliente=".$_POST['idcliente']));
			$insertar="insert into contrato(Numero, nombre, fechacontrato, Fecha, tipo, salon,vendedor, estatus, registro, fdr,id_cliente,impreso,festejado,servicios) values('".$nc."','".$_POST['nom']."','".date("Y-m-d")."','".$_POST['fechaevento']."','".$_POST['tipo']."','".$_POST['salon']."','".$_POST['vendedor']."',0,'".$registro."','".$fdr."',".$_POST['idcliente'].",'no','".$_POST['festejado']."','".$servicios["servicios"]."')";
		
			$r=mysql_query($insertar);
				echo "<script>alert('Registro Existoso');</script>";
				echo '<meta http-equiv="refresh" content="0; url=index.php" />';
				}
			}

?>
  

</body>
</html>