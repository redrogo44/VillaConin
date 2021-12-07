<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
require 'funciones2.php';
validarsesion();
conectar();
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
if($nivel==5)
{
menunivel5();
}

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
				right:-146px;
				top:10px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	
			.size{
				WIDTH:140px;
				HEIGHT:25px;
				font-size:.9em;
			}
				
				.pie {position:fixed;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
				a.ovalbutton{
background: transparent url('Imagenes/oval-blue-left.gif') no-repeat top left;
display: block;
float: left;
font: normal 13px Tahoma; /* Change 13px as desired */
line-height: 16px; /* This value + 4px + 4px (top and bottom padding of SPAN) must equal height of button background (default is 24px) */
height: 24px; /* Height of button background height */
padding-left: 11px; /* Width of left menu image */
text-decoration: none;
}

a:link.ovalbutton, a:visited.ovalbutton, a:active.ovalbutton{
color: #494949; /*button text color*/
}

a.ovalbutton span{
background: transparent url('Imagenes/oval-blue-right.gif') no-repeat top right;
display: block;
padding: 4px 11px 4px 0; /*Set 11px below to match value of 'padding-left' value above*/
}

a.ovalbutton:hover{ /* Hover state CSS */
background-position: bottom left;
}

a.ovalbutton:hover span{ /* Hover state CSS */
background-position: bottom right;
color: black;
}

.buttonwrapper{ /* Container you can use to surround a CSS button to clear float */
overflow: hidden; /*See: http://www.quirksmode.org/css/clearing.html */
width: 100%;
}
    </style>
       
</head>

<!-- CUERPO DEL WEB-->
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<br><br><br><br><br><br>
<center>
<?php
$qq="select * from contrato where Numero='".$_GET['numero']."'";
$qr=mysql_query($qq);
//echo "Numero de Filas".mysql_num_rows($qr);
	if (mysql_num_rows($qr)<1) 
	{
				 $Se="SELECT * FROM Eventos_Adicionales WHERE Numero='".$_GET['numero']."'";
				$Se=mysql_query($Se);
			if (mysql_num_rows($Se)<1) 
			{
				 $er=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$_GET['numero']."'");		 
				 //echo "Cantidad de Filas".mysql_num_rows($Se);
				 
					$err=mysql_fetch_array($er);
					$comensales=$err['comensales'];
					ECHO "<h1><font color='red'><b>Evento de Recaudacion</b></font></h1><br><br>";
					echo "<table>
						<tr><td colspan='3' align='center'><img src='Config/img/credencial.png' width='40%' height='50%'></td></tr>		
							<tr><td>Numero de Evento de Recaudacion</td><td align='center'>".$err['Numero']."</td></tr>
							<tr><td>Fecha de Evento</td><td align='center'>".$err['fecha']."</td></tr>				
							<tr><td>Tipo de Evento</td><td align='center'>Evento de Recaudacion</td></tr>
							<tr><td>Salon</td><td align='center'>".$err['salon']."</td></tr>
							<tr><td>Total de Comensales</td><td align='center'>".$comensales."</td></tr>				
					      ";
					if (!empty($err['referencia'])||$err['referencia']!='') 
					{
					echo "<tr><td>Contrato de Referncia</td><td align='center'>".$err['referencia']."</td></tr>";
					}
					else
					{
					echo "<tr><td>Contrato de Referncia</td><td align='center'>SIN REFERENCIA</td></tr>";			
					}
				echo "
				<tr><td align='center' ><a  class='ovalbutton' href='PDF_Meseros_Contrato_recaudacion.php?numero=".$_GET['numero']."' target='_blank'><span>IMPRIME LISTA DE MESEROS</span></a></td></tr>
				</table>";
			}else
			{
				//echo "Cantidad de Filas".mysql_num_rows($Se);
					$EA=mysql_fetch_array($Se);
					$comensales=$EA['c_adultos']+$EA['c_jovenes']+$EA['c_ninos'];
					ECHO "<h1><font color='red'><b>Evento Adicional</b></font></h1><br><br>";
					echo "<table>
						<tr><td colspan='3' align='center'><img src='Config/img/credencial.png' width='40%' height='50%'></td></tr>		
							<tr><td>Numero de Evento Adicional</td><td align='center'>".$EA['Numero']."</td></tr>
							<tr><td>Fecha de Evento</td><td align='center'>".$EA['Fecha']."</td></tr>				
							<tr><td>Tipo de Evento</td><td align='center'>".$EA['tipo']."</td></tr>
							<tr><td>Salon</td><td align='center'>".$EA['salon']."</td></tr>
							<tr><td>Total de Comensales</td><td align='center'>".$comensales."</td></tr>				
					      ";
					if (!empty($EA['Contrato_Referencia'])||$EA['Contrato_Referencia']!='') 
					{
					echo "<tr><td>Contrato de Referncia</td><td align='center'>".$EA['Contrato_Referencia']."</td></tr>";
					}
					else
					{
					echo "<tr><td>Contrato de Referncia</td><td align='center'>SIN REFERENCIA</td></tr>";			
					}
				echo "
				<tr><td align='center' ><a  class='ovalbutton' href='PDF_Meseros_Contrato.php?numero=".$_GET['numero']."' target='_blank'><span>IMPRIME LISTA DE MESEROS</span></a></td></tr>
				</table>";
			}

	
	}
else
{
	$qm=mysql_fetch_array($qr);	

 ?>
 <h1><font color='red'><b>Contrato</b></font></h1><br><br>
			<table>
			<tr><td colspan="3" align="center"><img src="Config/img/credencial.png" width="35%" height="50%"></td></tr>
			<tr><td><label>Numero de contrato</label></td><td><b><?php echo $qm['Numero'];?></b></td></tr>
			<tr><td><label>Nombre			 </label></td><td WIDTH="140px" colspan="2" align="left"><b><?php echo $qm['nombre'];?></b></td></tr>
			<tr><td><label>Numero de Comensales</label></td><td WIDTH="140px" colspan="2" align="left"><b><?php "   ".$TC=total_comensales($qm['Numero'],$qm['facturado']);echo "Adultos = ".$TC[0]+$qm['c_adultos']."<br>Jovenes".$TC[1]+$qm['c_ninos']+$qm['c_jovenes']+$TC[0]+$TC[1]+$TC[2];?></b></td></tr>
			<tr><td><label>Tipo de Evento</label></td><td WIDTH="140px" colspan="2" align="left"><b><?php echo $qm['tipo']?></b></td></tr>
			<tr><td><label>Festejado</label></td><td WIDTH="140px" colspan="2" align="left"><b><?php echo $qm['festejado']?></b></td></tr>
			<?PHP
			if($nivel==0)
			{ 
			echo "

			<tr><td><form action='Abonos-cliente.php' method='POST'><input type='hidden' name='campo' value=".$_GET['numero']."><input class='size' type='submit' name='submit' value='ABONAR'></form></td>
			<td><form action='Cargos.php' method='POST'><input type='hidden' name='campo' value=".$_GET['numero']."><input type='hidden' name='categoria' value='Cargo de Comensales'><input class='size' type='submit' name='submit' value='Cargo(Comensales)'></form></td>
			<td><form action='Cargos.php' method='POST'><input type='hidden' name='campo' value=".$_GET['numero']."><input type='hidden' name='categoria' value='Cargo de Servicio'><input class='size' type='submit' name='submit' value='CARGO(Servicios)'></form></td></tr>
			";			
			?>
			<tr><td><button class='size' onclick='location.href ="LogisticaEvento.php?numero=<?php echo $_GET['numero'];?>"'>HOJA ANEXA</button></td>
			<td><button class='size' onclick="location.href='NuevaLogistica.php?numero=<?php echo $_GET['numero'];?>'">LOGISTICA 		 </button></td>
			<td><button class='size' onclick="location.href='Config/EliminarContrato.php?numero=<?php echo $_GET['numero'];?>'">CANCELAR 		 </button></td></tr>
			<td><button class='size' onclick="location.href='EstadoDeCuenta.php?numero=<?php echo $_GET['numero'];?>'">EDO CUENTA</button></td>

			<?php
			if(empty($qm['Meseros']))
			{
			}
			else
			{
			echo "<div class='buttonwrapper'>
			<td><a class='ovalbutton' href='PDF_Meseros_Contrato.php?numero=".$_GET['numero']."'  target='_blank'><span>IMPRIME LISTA DE MESEROS</span</a></td>	
				</div>";	
				
			}
			}
			if($nivel==1)
			{
			echo "

			<tr><td><form action='Abonos-cliente.php' method='POST'><input type='hidden' name='campo' value=".$_GET['numero']."><input class='size' type='submit' name='submit' value='ABONAR'></form></td>
			<td><form action='Cargos.php' method='POST'><input type='hidden' name='campo' value=".$_GET['numero']."><input type='hidden' name='categoria' value='Cargo de Comensales'><input class='size' type='submit' name='submit' value='Cargo(Comensales)'></form></td>
			<td><form action='Cargos.php' method='POST'><input type='hidden' name='campo' value=".$_GET['numero']."><input type='hidden' name='categoria' value='Cargo de Servicio'><input class='size' type='submit' name='submit' value='CARGO(Servicios)'></form></td></tr>
			";			
			?>
			<tr><td><button class='size' onclick='location.href ="LogisticaEvento.php?numero=<?php echo $_GET['numero'];?>"'>HOJA ANEXA</button></td>
			<td><button class='size' onclick="location.href='NuevaLogistica.php?numero=<?php echo $_GET['numero'];?>'">LOGISTICA 		 </button></td>
			<td><button class='size' onclick="location.href='Config/EliminarContrato.php?numero=<?php echo $_GET['numero'];?>'">CANCELAR 		 </button></td></tr>
			<td><button class='size' onclick="location.href='EstadoDeCuenta.php?numero=<?php echo $_GET['numero'];?>'">EDO CUENTA</button></td>
			<?php
			if(empty($qm['Meseros']))
			{
			}
			else
			{
			echo "<div class='buttonwrapper'>
			<td><a  class='ovalbutton' href='PDF_Meseros_Contrato.php?numero=".$_GET['numero']."' target='_blank'><span>IMPRIME LISTA DE MESEROS</span></a></td>	
				</div>";
			}
			}

			if($nivel==2)
			{
			echo "<tr><td><form action='Abonos-cliente.php' method='POST'><input type='hidden' name='campo' value=".$_GET['numero']."><input class='size' type='submit' name='submit' value='ABONAR'></form></td>
			";
			echo "<div class='buttonwrapper'>
			<td><a  class='ovalbutton' href='PDF_Meseros_Contrato.php?numero=".$_GET['numero']."' target='_blank'><span>IMPRIME LISTA DE MESEROS</span></a></td>	
				</div>";
			?>
			<td><button class='size' onclick="location.href='EstadoDeCuenta.php?numero=<?php echo $_GET['numero'];?>'">EDO CUENTA</button></td>
			<?PHP
			}
			if($nivel==3)
			{
				?>
			<td><button class='size' onclick="location.href='DEV.php?numero=<?php echo $_GET['numero'];?>'">PRE DEVOLUCION</button></td>
			<td><button class='size' onclick="location.href='EstadoDeCuenta.php?numero=<?php echo $_GET['numero'];?>'">EDO CUENTA</button></td>			<td><a target="_blank" href="HojaAnexa.php?numero=<?php echo $_GET['numero'];?>"><button  class='size'>HOJA ANEXA</button></a></td></tr><tr>
			<?php
			if(empty($qm['Meseros']))
			{
			}
			else
			{
				echo "<div class='buttonwrapper'>
			<td><a class='ovalbutton' href='PDF_Meseros_Contrato.php?numero=".$_GET['numero']."'  target='_blank'>IMPRIME LISTA DE MESEROS</a></td>	
				</div>";
			}
			}

			if($nivel==4)
			{
				echo "
				<td><form action='Cargos.php' method='POST'><input type='hidden' name='campo' value=".$_GET['numero']."><input type='hidden' name='categoria' value='Cargo de Comensales'><input class='size' type='submit' name='submit' value='Cargo(Comensales)'></form></td>
				<td><form action='Cargos.php' method='POST'><input type='hidden' name='campo' value=".$_GET['numero']."><input type='hidden' name='categoria' value='Cargo de Servicio'><input class='size' type='submit' name='submit' value='CARGO(Servicios)'></form></td></tr>
				";
				?>
				<td><button class='size' onclick="location.href='NuevaLogistica.php?numero=<?php echo $_GET['numero'];?>'">LOGISTICA 		 </button></td>
				<td><button class='size' onclick="location.href='EstadoDeCuenta.php?numero=<?php echo $_GET['numero'];?>'">EDO CUENTA</button></td>				<td><a target="_blank" href="HojaAnexa.php?numero=<?php echo $_GET['numero'];?>"><button  class='size'>HOJA ANEXA</button></a></td>				<?php
			}
			if($nivel==5)
			{		
				echo "<td><a  class='ovalbutton' href='PDF_Meseros_Contrato.php?numero=".$_GET['numero']."' target='_blank'><span>IMPRIME LISTA DE MESEROS</span></a></td>									
					  <td><a target='_blank' href='HojaAnexa.php?numero=".$_GET['numero']."'><button  class='size'>HOJA ANEXA</button></a></td>";			
			}
			?>
			</table>
<?php
}
?>
<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 2.0 </b></MARQUEE><br />copyright - 2014 powered by MBR soluciones </div>
<div id="reloj" style="color: #FFF;
background: #900;
position:absolute;
 bottom:0;
 right:0;
height:39px; /*alto del div*/
Width:150px;
z-index:99999;
" >
<span id="liveclock" style="position:absolute;left:0;top:0;" onclick="window.location='calendario.php';"></span><script language="JavaScript" type="text/javascript">

function show5(){
if (!document.layers&&!document.all&&!document.getElementById)
return

 var Digital=new Date()
 var hours=Digital.getHours()
 var minutes=Digital.getMinutes()

var dn="PM"
if (hours<12)
dn="AM"
if (hours>12)
hours=hours-12
if (hours==0)
hours=12

 if (minutes<=9)
 minutes="0"+minutes
//change font size here to your desire
myclock="<font size='5' face='Arial' ><b><font size='2'><?php echo date('d-m-Y'); ?></font></br>"+hours+":"+minutes+" "+dn+"</b></font>"
if (document.layers){
document.layers.liveclock.document.write(myclock)
document.layers.liveclock.document.close()
}
else if (document.all)
liveclock.innerHTML=myclock
else if (document.getElementById)
document.getElementById("liveclock").innerHTML=myclock
setTimeout("show5()",1000)
 }
window.onload=show5
 
 </script>   
</div>
</body>
</html>