<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
	require "configuraciones.php";
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
   <h1>MESEROS</h1>
   <br />
   
 <div id="formulario" align="center">  
 
   <form action="asignar_meseros.php"><input type="submit" value="Asinar a Evento"  class="button" º/></form>
  <form action="InsertM.php"><input type="submit" value="Crear Nuevo "  class="button"/></form>
   
  </div>
   
   <br />
   <form method="post" onsubmit="confirma()">
  <input type="submit" value="Confirmar Meseros"  class="button"/>
   		<table border="6" bordercolor="#990000">
        	<tr>
            	<td align="center"><b>Nombre</b></td>
                <td align="center"><b>Telefono Movil</b></td>
                <td align="center"><b>Telefono Local</b></td>
                <td align="center"><b>Correo</b></td>
                <td align="center"><b>Tipo</b></td>                
                <td align="center"><b>Estatus</b></td>
                <td align="center"><b>Fecha de Ingreso</b></td>
                <td align="center"><b>Nivel</b></td>
                <td align="center"><b>Comentarios</b></td>
                <td align="center"><h6><b>CONFIRMAR</b></h6></td>
                 <td align="center"><b>MODIFICAR</b></td>
                  <td align="center" style="font:'Comic Sans MS', cursive"><b>ELIMINAR</b></td>
                   
                   
            </tr>
            <tr>
            	<?php
					$selecM="SELECT tipo FROM  `Meseros`  GROUP BY tipo";
					$M=mysql_query($selecM) or die( mysql_error());
					$var=0;
					while($Mm=mysql_fetch_array($M))
					{
						echo "<tr>
						<td colspan='12' align='center' bgcolor='#FF0000'><a style='color:#FAF102'><b>".$Mm['tipo']."</b></a></td></tr>
						";
						$r="SELECT * FROM `Meseros` where tipo='".$Mm['tipo']."'";
						$Mt=mysql_query($r) or die( mysql_error());
						while($Me=mysql_fetch_array($Mt))
						{
							
							echo "
							<tr>
									<td align='center'><b>".$Me['nombre']." ".$Me['ap']." ".$Me['am']."</b></td>
									<td align='center'><b>".$Me['celular']."</b></td>
									<td align='center'><b>".$Me['telefono']."</b></td>
									<td align='center'><b>".$Me['correo']."</b></td>
									<td align='center'><b>".$Me['tipo']."</b></td>
									<td align='center'><b>".$Me['estatus']."</b></td>
									<td align='center'><b>".$Me['fechaingreso']."</b></td>
									<td align='center'><b>".$Me['nivel']."</td>
									<td align='center'><b>".$Me['comentarios']."</b></td>
									<td align='center' bgcolor='#00FF00'><input type='checkbox' name='".$var."' value='".$Me['id']."' /></td>
									<td align='center'><b><a href=modificaME.php?numero=".$Me['id']."&nombre='".$Me['nombre']."' >Modificar</a></b></td>
									<td align='center'><b><a href=cargarmodificai.php?numero=".$muestra['id']."&Eliminar='Eliminar'>Eliminar</a></b></td>
									
								</tr>
							";
							$var++;
						}
					}
			
                ?>
            </tr>
	    </table>
       
   </form>
   <input  type='hidden' name='numero' value=""/>
  <!-- Pie de PAgina -->
<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 3.0 </b></MARQUEE><br />copyright - 2014 Powered By MBR soluciones </div>
</body>
</html>
<script language="javascript">
function confirma()
{
	alert(<?php print_r($_POST); ?>);
	 
}
</script>
