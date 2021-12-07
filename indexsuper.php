<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php

require 'funciones.php';
conectar();
validarsesion();
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
				  width:600px;
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
       
</head>


<!-- CUERPO DEL WEB-->
<?php
menusuperusuario();
?>


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >

<!--ESTILO CUERPO-->

<div align="center"  >
<br /><br /><br  style="background-position:center"/ >

	<h1>Bienvenido</h1>
    
    <br /><BR />
    <br /><BR />
    
    <font size="10" face="Arial Black, Gadget, sans-serif"<b ><script language="javascript">
	<!--	
	today= new Date()
	if(today.getMinutes()<10)
	{
	  pad=0	
	}
	else
	pad="";
	document.write; if ((today.getHours()>=6)&&(today.getHours()<=9))
	{
		document.writeln(" ¡ Buen Dia ! ")
	}
	if ((today.getHours()>=10)&&(today.getHours()<=11))
	{
		document.writeln(" ¡ Buen Dia ! ")
	}
	if ((today.getHours()>=12)&&(today.getHours()<=19))
	{
		document.writeln(" ¡ Buenas Tardes ! ")
	}
	if ((today.getHours()>=20)&&(today.getHours()<=23))
	{
		document.writeln(" ¡ Buenas Noches ! ")
	}
	if ((today.getHours()>=4)&&(today.getHours()<=5))
	{
		document.writeln(" ¡ Buenas Noches ! ")
	}
	//-->

	
	
	</script>
    </font>
    
    <!-- Copiar este código dentro del tag BODY -->
    
    <!-- Búsqueda Google --> 
    <div>
    <br /><br />
        <br /><br />
    <p> </p> <center> <form action="http://www.google.com/search" method="get"> <table bgcolor="#ffffff"> <tbody> <tr> <td><a href="www.google.es/" _fcksavedurl="www.google.es/" _fcksavedurl="www.google.es/"><img alt="Google" align="absMiddle" border="0" src="http://www.google.com/logos/Logo_40wht.gif" _fcksavedurl="http://www.google.com/logos/Logo_40wht.gif" _fcksavedurl="http://www.google.com/logos/Logo_40wht.gif" /></a> <input maxlength="255" size="31" name="q" /> <input type="hidden" name="hl" value="es" /> <input type="submit" name="btnG" value="Búsqueda Google" />
</td>
</tr></tbody></table></form></center></div>
</div>

<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 1.0 </b></MARQUEE><br />copyright - 2014 powered by MBR soluciones </div>

</body>
</html>
