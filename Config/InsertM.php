<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
	session_start();
	require "configuraciones.php";
	validarsesion();
	conectar();
	$nivel=$_SESSION['niv'];
	if ($nivel==3) 
	{	
	menunivel3();
	}
	else
	{
	menuconfiguracion();		
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
				.pie {position:fixed;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>    
</head>
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<br />
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

 $TI="SELECT * FROM Meseros GROUP BY tipo";
$TII=mysql_query($TI);
?>
<!--ESTILO CUERPO-->
<div align="center"  >
<br /><br /><br  style="background-position:center"/ >
   <!-- Tabala Pre-Registro -->
   <h1>Registrar Mesero</h1>
   <br />
    <table border="9" align="center"  bordercolor="#990000" bordercolordark="#990000"	 bordercolorlight="#990000" >
       <tr>
       <form action="alta_mesero.php" method="post" name="newregist">
          <td><b>Nombre</b></td>
          <td><input name="nombre" type="text" size="35" maxlength="35" placeholder="		NOMBRE(S)	 " required>
       </tr>
       <tr>
        <td><b>Apellido Paterno</b></td>
        <td><input name="ap" type="text" size="35" maxlength="35" placeholder=   "	       APELLIDO PATERNO" required>
      </tr>
      <tr>
         <td><b>Apellido Materno</b></td>
         <td><input name="am" type="text" size="35" maxlength="35" placeholder=   "	       APELLIDO MATERNO" required>
      </tr>
       <tr>
         <td><b>Telefono Movil</b></td>
         <td><input name="tm" type="text" size="35" maxlength="35" placeholder=   "	       TELEFONO MOVIL" required>
      </tr>
       <tr>
         <td><b>Telefono Casa</b></td>
         <td><input name="tc" type="text" size="35" maxlength="35" placeholder=   "	       TELEFONO DE CASA" required>
    <tr>
         <td><b>Correo Electronico</b></td>
         <td><input name="email" type="text" size="35" maxlength="35" placeholder=   "	   NOMBRE@CORREO.COM.MX" required>
      </tr>
    <tr>
       <td><b>Tipo</b></td>
			<td align="center">
			<select name='categoria' size='1' id='categoria'>
			<option>Seleccione Una Opcion</option>
            <?php
			while($tipp=mysql_fetch_array($TII))
			{
			echo "<option>".$tipp['tipo']."</option>";
			}
			?>
			</td>
    </tr>
    
    <tr>
    	<td>Fecha de Ingreso</td>
        <td align="center"><input type="date" name="fechaingreso" required/> </td>
    </tr>      
    
   
         <td></td>
         <td align="center">
         <input name="tipo" value="insertar" type="hidden" />
   		<p><input id="boton"  name="but" type="submit"  value="Guardar"/></p>    
</form>
       </td>
       </tr>
      </td>
      </tr>
   </table>   
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