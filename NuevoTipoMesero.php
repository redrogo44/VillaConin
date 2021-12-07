<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
	require "configuraciones.php";
	validarsesion();
	conectar();
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
				  width:900px;
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
   <h1 style="color:#F00">Registrar Nueva Categoria de  Meseros</h1>
   <br />
   <h5 style="color:#009"><b>Es Necesario llenar al menos un registro de la nueva categoria</b></h5>
  <form action="alta_mesero.php" method="post" name="newregist">
    <table border="9" align="center"  bordercolor="#990000" bordercolordark="#990000"	 bordercolorlight="#990000" >
      <th></th>
      <tr>
      	<td><b style="color:#F00">Nueva Categoria de Mesero</b></td><td><input  type="text" name="categoria" placeholder="  NUEVA CATEGORIA DE MESEROS"  required="required"size="35"/></td>
      </tr>
       <td><b>Nombre</b></td>
          <td><input name="nombre" type="text" size="35" maxlength="35" placeholder="		NOMBRE(S)	 " re>
       </tr>
       <tr>
        <td><b>Apellido Paterno</b></td>
        <td><input name="ap" type="text" size="35" maxlength="35" placeholder=   "	       APELLIDO PATERNO">
      </tr>
      <tr>
         <td><b>Apellido Materno</b></td>
         <td><input name="am" type="text" size="35" maxlength="35" placeholder=   "	       APELLIDO MATERNO">
      </tr>
       <tr>
         <td><b>Telefono Movil</b></td>
         <td><input name="tm" type="text" size="35" maxlength="35" placeholder=   "	       TELEFONO MOVIL">
      </tr>
       <tr>
         <td><b>Telefono Casa</b></td>
         <td><input name="tc" type="text" size="35" maxlength="35" placeholder=   "	       TELEFONO DE CASA">
    <tr>
         <td><b>Correo Electronico</b></td>
         <td><input name="email" type="text" size="35" maxlength="35" placeholder=   "	   NOMBRE@CORREO.COM.MX">
      </tr>
    
    
    <tr>
    	<td><b>Fecha de Ingreso</b></td>
        <td align="center"><input  align="top" type="date" name="fechaingreso"/> </td>
    </tr>      
    <tr>	
       <td><b>ESTATUS</b></td>
			<td align="center">
			<select name='estatus' size='1' id='categoria'>
			<option>ACTIVO</option>
			<option>INACTIVO</option>
			<option>BETADO</option>
		
			</td>
    </tr>
    <tr>
    <td><b>Sueldo</b></td><td align="center"><input type="number" name="monto" placeholder="	Sueldo Mensual" required="required"/></td>
    </tr>
    <tr>
    <td><b>Puntos por Evento</b></td><td align="center"><input  type="number" name="puntos" placeholder="	Puntos por Evento" required="required"/></td>
    </tr>
   
   </table>   
   <br /><br />
   <input name="tipo" value="NCategoria" type="hidden" />
   		<p><input id="boton"  name="but" type="submit"  value="Guardar" class="button"/></p>    
   </form>
  <!-- Pie de PAgina -->
<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 1.0 </b></MARQUEE><br />copyright - 2014 powered by MBR soluciones </div>
</body>
</html>
<script>
function activar(formulario){
 if(document.newregist.tipo.value != "Seleccione una opcion" && document.newregist.medio.value!="Seleccione una opcion") 
document.newregist.but.disabled = false 
else 
document.newregist.but.disabled = true 
}
</script>