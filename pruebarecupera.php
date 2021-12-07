<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
<meta http-equiv="refresh" content="20; url=index.php" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cancelacion del Cargo</title>
		
<script>
function cargar() {
//	window.open("pruebarecupera.php");
}
</script>

<?php
conectar();

$q_recupera = "SELECT servicios FROM contrato where Numero='X041116O'";
$recupera = mysql_query($q_recupera) or die (mysql_error());
$cno=mysql_fetch_array($recupera);
 $servicios=$cno['servicios'];

$arrayservicios = explode(",", $servicios);

				for($i=0;$i<strlen($servicios);$i++)
				{
			$q2="select * from Servicios where id=".$arrayservicios[$i];
				$serv=mysql_query($q2) or die (mysql_error());
				$des=mysql_fetch_array($serv);
				$this->Cell(0, 5 , $des['Servicio'], 2, 2, 'C');
				$this->Cell(0, 5 , $des['Descripcion'], 2, 2, 'C');
				}
			
?>
</head> 
<body onload="cargar()">
</body>
</html>