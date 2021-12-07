<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require 'funciones2.php';
conectar();
validarsesion();
$nivel=$_SESSION['niv'];
libera_manteles();
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
<script type="text/javascript" src="Config/jquery-2.1.1.min.js"></script>

<title>Villa Conin</title>
    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:900px;
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
				right:-80%;
				top:10px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				.nav ul li ul li ul{
				right:-90%;
				top:10px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				.cajon1
				{
			 		width:870px;
            		height:150px;
            		/*border: 3px solid #FF0000;*/

				}
				.cajon2
				{
					width:-60px;
            		height:0px;				
            		/*border: 3px solid #000000;*/
            		position: left;
				}
				.BOTON 
			{
				border: 3px solid #333333;
  border-radius: 3px;
  color: #940707;
  display: inline-block;
  font: bold 12px/12px HelveticaNeue, Arial;

  padding: 8px 11px;
  text-decoration: none;
			}
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>   
    <link rel="stylesheet" href="tablas.css" type="text/css"/>	

</head>


<!-- CUERPO DEL WEB-->
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >

<br><br>

<div align="center">
<br><br>
<?php
$usuario=$_SESSION['usu'];
echo      "<b>&nbsp&nbsp&nbsp usuario:  ".$usuario."</b>";
$us=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Meseros='XX' order by Fecha");
?>
</div>

<div align="center">
<font color="#5983BD"><b>Eventos Adicionales</b></font>
<br><br>


<TABLE>
	<tr>
		<td align="center"><b>Evento Adicional</b></td>
		<td align="center"><b>Fecha</b></td>
		<td align="center"><b>Tipo</b></td>
		<td align="center"><b>Comensales</b></td>
		<td align="center"><b>Contrato Referencia</b></td>
		<td align="center"><b>Modificar</b></td>
	</tr>
	<?php
		while ($EA=mysql_fetch_array($us)) 
		{$totalc=$EA['c_adultos']+$EA['c_jovenes']+$EA['c_ninos'];
			echo"
					<tr>
						<td>".$EA['Numero']."</td>
						<td>".$EA['Fecha']."</td>
						<td>".$EA['tipo']."</td>
						<td> Adultos = ".$EA['c_adultos']."<br>Jovenes = ".$EA['c_jovenes']."<br> Niños = ".$EA['c_ninos']."<br>Total = ".$totalc."</td>
						<td>".$EA['Contrato_Referencia']."</td>
						<td><a href='ModificaEA.php?id=".$EA['id']."'>Modificar</a></td>
					</tr>
				";
			
		}
	?>


</TABLE>
</div>
<?php
/////
pie();
?>
</body>
</html>
