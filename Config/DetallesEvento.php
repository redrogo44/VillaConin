<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'configuraciones.php';
validarsesion();
$nivel=$_SESSION['niv'];
validarsesion();
	$nivel=$_SESSION['niv'];
	menuconfiguracion();

?>
 
 <title>Villa Conin</title>
    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:700px;
				  height:auto;
				  font-family:Arial, Helvetica, sans-serif;
				  }
			  ul,ol{
				 list-style:none;}
				 
			 .nav li a {
				 background-color:#000;
				 color:#fff;
				 text-decoration:none;
				 padding:10px 15px;
				 display:block;
				 }
			.nav li a:hover 
			{
			 background-color:#434343;
		    }
			 .nav > li{
				 float:left;}
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}
			.nav li:hover> ul{
				display:block;
				}
			.nav li ul li{
				position:relative;}
			.nav li ul li ul{
				right:-142px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
</body>
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

 $conf="Select contratos from TMeserosEvento Where id=".$_GET['numero'];
		$confi=mysql_query($conf);
		$configu=mysql_fetch_array($confi);
	 $contr=$configu['contratos'];
		$contratos=explode(",",$contr);		
?>
<script>
function ventana()
{
alert('que pedo');
	open('AsistioMesero.php','','',top=100,left=100,width=500,height=250) ;
}
</script> 

<!--ESTILO CUERPO-->

<div align="center">
	<br /><br /><br  style="background-position:center"/>
    <p><b><h2 style="color:#FC0316">Detalles de Registro</h2></b></p>
<div class="wrapper wrapper-style4">	
<table border="6" bordercolor="#990000">
<?php	
for($i=1;$i<count($contratos)-1;$i++)
{			
 $Mc="Select Meseros from contrato Where Numero='".$contratos[$i]."'";
$M=mysql_query($Mc);
$mes=mysql_fetch_array($M);
$Meseros=explode(",",$mes['Meseros']);
														
		echo "<td align='center'  style='background-color:#FA0303' bgcolor='#FFFF00'><font color='Yellow'><b>".$contratos[$i]."</b></font></td>";// todos los contratos
		for($j=1;$j<count($Meseros);$j++)
		{ $Meser="Select * from Meseros Where id=".$Meseros[$j];
		$MM=mysql_query($Meser);
		$MMM=mysql_fetch_array($MM);
		$nombre=$MMM['nombre']." ".$MMM['ap']." ".$MMM['am'];
			echo "<tr><td align='center'>".$nombre."</td></tr>";
		}
		
		
}

?>
</table>


</html>
