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
			.size{
				WIDTH:140px;
				HEIGHT:25px;
				font-size:.9em;
			}
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
       
</head>

<!-- CUERPO DEL WEB-->
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<br><br><br><br><br><br>
<center>
<?php
$qq="select * from contrato where Numero='".$_GET['numero']."'";
$qr=mysql_query($qq);
$qm=mysql_fetch_array($qr);
 ?>
<table>
<tr><td colspan="2"><img src="Config/img/credencial"></td></tr>
<tr><td><label>Numero de contrato</label></td><td><?php echo $qm['Numero'];?></td></tr>
<tr><td><label>Nombre			 </label></td><td><?php echo $qm['nombre'];?></td></tr>
<tr><td><button class='size'>Crear Cargos	 </button></td><td><button class='size'>Abonar</button></td></tr>
<tr><td><button class='size'>Asignar Meseros	 </button></td><td><button class='size'>Hoja Anexa</button></td></tr>
<tr><td><button class='size'>Logistica 		 </button></td><td><button class='size'>Cancelar</button></td></tr>
</table>
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
