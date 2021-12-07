<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
require("../configuraciones.php");
conectar();

?>


<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Villa Conin</title>
    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:800px;
				  right:1000px;
				  height:20px;
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
				.nav li:hover> ul li{
				display:block;
				}
			.nav li ul li{
				position:relative;}
			.nav li ul li ul{
				right:-146px;
				top:10px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
       
</head>

<!-- CUERPO DEL WEB-->
<!--<body background="/Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" > -->
<BR />
<br />
<div align="center">

<?php 
 $SerAdd="Select ServiciosAdicionales from contrato where Numero='".$_GET['numero']."'";
	$consulta=mysql_query($SerAdd);
	$can=mysql_fetch_array($consulta);
	 $ServiciosA=$can['ServiciosAdicionales'];		
	 $tamaño=substr_count($ServiciosA, ','); // 2
	$menu = explode(",", $ServiciosA);
	// tabla de Servicios
	
	
		echo " <form name='CostodeCargo' action='NotaRemsionCargo.php' >
					<table border='6' bordercolor='#990000'>
							<tr align='center'>
								<td bgcolor='#0099FF'><b>Servicio</b></td> <td bgcolor='#CCFF00'><b>Precio</b></td>
							</tr>
					";
			
					for($i=0;$i<$tamaño;$i++)
					{
					 $Servicios="Select Servicio from Servicios Where id=".$menu[$i];
						$consulta=mysql_query($Servicios);
						$cans=mysql_fetch_array($consulta);
						 $serv=$cans['Servicio'];		
						
						echo "
						<tr>
								<td bgcolor='#00CCFF'><b>".$serv."</b></td> <td bgcolor='#CCFF10'><input type='text'; /></td>
							  </tr>
							 ";
					}
			
					echo "<tr></tr>
					<tr >
					<td colspan='2' align='center'><input type='submit'  value='Generar Cargo'/></td>
					</tr>
					</table>
			</form>";
?>


</div>
</body>
</html>


