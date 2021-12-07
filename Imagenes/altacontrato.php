<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'funciones2.php';
validarsesion();
$nivel=$_SESSION['niv'];
if($nivel==0)
{
menunivel0();				
}
if($nivel==1)
{
menunivel1();				
}
if($nivel==2)
{
menunivel2();
}
if($nivel==3)
{
menunivel3();
}
if($nivel==4)
{
menunivel4();
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="0; url=http://www.pruebasvilla.mbrsoluciones.com.mx/index.php" />
<title>Villaconin</title>
</head>
<body>
<?php
conectar();

$nc=nombre_contrato($_POST['fechaevento'],$_POST['salon'],$_POST['vendedor']);




echo $insertar;

if(ValidarNombreContrato($_POST['nom']))
{
   echo"<script>
   alert('Nombre de Contrato Existente, Verifique sus datos');
   location.href('Contrato.php');
   </script>";
   
}
else
{
	echo  '<table><tr><td>Numero de contrato</td><td>'.$nc;
	echo  '<tr><td>Nombre del Contrato</td><td>'.$_POST['nom'].'</td></tr>';
	echo  '<tr><td>Fech de evento</td><td>'.$_POST['fechaevento'];
	echo  '<tr><td>Saldo inicial</td><td>'.$_POST['si'];
	
		
		$query="select * from cliente where id=".$_POST['idcliente'];
		$res=mysql_query($query);
	
		while($m=mysql_fetch_array($res)){
		
			echo '<tr>
		   <td><b>Domicilio</b></td>
		   <td><small>
		'.$m['dom'].'</small>
		<tr>
		<tr><td>RFC</td><td>'.$m['rfc'].'</td></tr>
		<tr><td>Correo</td><td>'.$m['mail'].'</td></tr>
		<tr><td>Telefono</td><td>'.$m['tel'].'</td></tr>
		<tr><td>CP</td><td>'.$m['cp'].'</td></tr>
		';
		$saldoi;
		if(empty($_POST['si']))
		{
			$saldoi=0;
		}else{
			$saldoi=$_POST['si'];
			}
		
		
		$insertar="insert into contrato values('".$nc."','".$_POST['nom']."','".date("Y-m-d")."','".$_POST['fechaevento']."','".$m['mail']."','".$m['rfc']."','".$m['dom']."','".$m['cp']."','".$m['tel']."',". 0 .",'".$_POST['tipo']."','".$_POST['salon']."','".$_POST['vendedor']."',".$saldoi.",".$saldoi.",". 1 .")";
	
		$r=mysql_query($insertar);
			
			}

		echo  '<tr><td>Tipo de evento</td><td>'.$_POST['tipo'];
		echo  '<tr><td>Salon</td><td>'.$_POST['salon'];
		echo  '<tr><td>Vendedor</td><td>'.$_POST['vendedor'];
		echo '</table>';
}
?>
  

</body>
</html>