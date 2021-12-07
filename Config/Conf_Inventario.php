<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
	require "configuraciones.php";
	conectar();
	validarsesion();
	$nivel=$_SESSION['niv'];
	menuconfiguracion();
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
				right:-140px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
				
				.button 
						{
							   border-top: 1px solid #8f0d0d;
							   background: #9c132a;
							   background: -webkit-gradient(linear, left top, left bottom, from(#a12a2e), to(#9c132a));
							   background: -webkit-linear-gradient(top, #a12a2e, #9c132a);
							   background: -moz-linear-gradient(top, #a12a2e, #9c132a);
							   background: -ms-linear-gradient(top, #a12a2e, #9c132a);
							   background: -o-linear-gradient(top, #a12a2e, #9c132a);
							   padding: 8px 16px;
							   -webkit-border-radius: 10px;
							   -moz-border-radius: 10px;
							   border-radius: 10px;
							   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
							   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
							   box-shadow: rgba(0,0,0,1) 0 1px 0;
							   text-shadow: rgba(0,0,0,.4) 0 1px 0;
							   color: #ffffff;
							   font-size: 14px;
							   font-family: 'Lucida Grande', Helvetica, Arial, Sans-Serif;
							   text-decoration: none;
							   vertical-align: middle;
							   }
							.button:hover {
							   border-top-color: #b02128;
							   background: #b02128;
							   color: #ffffff;
							   }
							.button:active {
							   border-top-color: #0f2d40;
							   background: #0f2d40;
			   }
			   
			   
			   
			   
    </style>    
</head>
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<br />
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

?>
<!--ESTILO CUERPO-->
<div align="center"  >
<br /><br /><br  style="background-position:center"/ >
   <!-- Tabala Pre-Registro -->
   <h1>NUEVO TIPO DE INVENTARIO</h1>
   <br />
   
 <div id="formulario" align="center">  

   
  </div>
   
   <br />
   <form method="post" action="../alta_manteleria.php">
  
   		<table border="6" bordercolor="#990000">
        	<tr><td align="center" width="170"><b>INGRESA EL NUEVO TIPO DE INVENTARIO <a style="color:#00F"><b>( NOMBRE )</b></a></b></td><td align="center"><input type="text"  name="tipo" required="required"/></td></tr>
                <tr><td align="center"><b>NOMENCLATURA</b></td><td align="center"><input type="text"  name="nomen" required="required"/></td></tr>
                <tr><td align="center"><b>DESCRIPCION</b></td><td align="center"><input type="text"  name="desc" required="required"/></td></tr>
                <tr><td align="center"><b>TOTAL EN BUEN ESTADO</b></td><td align="center"><input type="text"  name="bue" required="required"/></td></tr>
                <tr><td align="center"><b>TOTAL EN MAL ESTADO</b></td><td align="center"><input type="text"  name="mal" required="required"/></td></tr>
                <tr><td align="center"><b>COSTO UNITARIO</b></td><td align="center"><input type="text"  name="cost" required="required"/></td></tr>
                <tr><td align="center"><b>PRECIO</b></td><td align="center"><input type="text"  name="pre" required="required"/></td></tr>
                <tr><td align="center"><b>COMENTARIOS</b></td><td align="center"><input type="text"  name="com" required="required"/></td></tr>
            
	    </table>
        <br />
        <input type="submit" value="Confirmar Meseros"  class="button" onclick="confirma()"/>
   </form>
  
  
<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 3.0 </b></MARQUEE><br />copyright - 2014 Powered By MBR soluciones </div>
</body>
</html>
<script language="javascript">
function confirma()
{
	alert('SE AH CREADO UN UEVO TIPO DE INVENTARIO SERAS REDIRECCIONADO AL INICIO');
}
</script>
