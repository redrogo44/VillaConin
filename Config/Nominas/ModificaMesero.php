<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
error_reporting(0);
session_start();	
	require "../configuraciones.php";
	validarsesion();
	conectar();
	$nivel=$_SESSION['niv'];
	menunomina();
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
			.pie {position:fixed;bottom:0;width:100%;color:white;background-color:#900;font-size:10;font-family:Arial, Helvetica, sans-serif;} 
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
							   -webkit-border-radius: 8px;
							   -moz-border-radius: 8px;
							   border-radius: 8px;
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

$tip="Select tipo from Meseros group by tipo";
$TT=mysql_query($tip);


?>
<!--ESTILO CUERPO-->
<div align="center"  >
<br /><br /><br  style="background-position:center"/ >
   <!-- Tabala Pre-Registro -->
   <h1>Modificar Nomina de Meseros</h1>
   <br />
   <b>Selecciona a Categoria a Modificar</b>
   <br />
   <br /><br />

  <div class="wrapper">
  
	<form name="form">
    	<table bordercolor="#990000" border="6">
        	<tr>
            	<td><b>Tipo</b></td>
                <td> 
                <select name="tipo" size="1" id="categoria" onchange="activar(this.form)">
					<option>Seleccione Una Opcion</option>
                    <?php
						while($tipo=mysql_fetch_array($TT))
						{
							echo " <option value='".$tipo['tipo']."'>".$tipo['tipo']."</option>";		
						}
                    ?>
   			</select></td>
            </tr>
        </table>
    </form>
     <br /><br />
    <?php
	if(isset($_GET['tipo']))
	{
		 $V="Select * from Configuraciones Where descripcion='".$_GET['tipo']."'";
		$valor=mysql_fetch_array(mysql_query($V));
		
		if(isset($valor['descripcion']))
		{
				echo"<b style='color:#F00505'>Nomina de ".$_GET['tipo']."</b>";
				echo "    <form name='form2' action='Mnomina.php' method='post'>
				<table border='6' bordercolor='#990000'>
				<tr>
					<td><b>Puntos por Evento</b></td><td><input type='text' name='puntos' value=".$valor['puntos']." /></td></tr>
					<tr>
					<td><b>Sueldo por Evento</b></td><td><input type='text'  name='sueldo' value=".$valor['valor']." /></td>
				</tr>
				<tr></tr><tr></tr><tr></tr><tr></tr>
				<tr>
				<td colspan='2' align='center'><input type='submit' class='button' value='GUARDAR'/></td>
				<input type='hidden' name='tipo' value='".$_GET['tipo']."'/>
				<input type='hidden' name='categoria' value='MESERO'/>
				</tr>
				</table>
			 </form>";
		}
		else
		{
		 	?>
            <script>
			alert("LA NOMINA DE ESTA CATEGORIA NO EXISTE.. FAVOR DE REGISTRARLA EN NUEVA CATEGORIA DE MESEROS, DENTRO DE CONFIGURACIONES");
            </script>
            <?php
		}
	}
	?>
 </div>
  <!-- Pie de PAgina -->
<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 3.0 </b></MARQUEE><br />copyright - 2014 Powered By MBR soluciones </div>
</body>
</html>
<script>
function activar(formulario)
{
	//alert(form.tipo.value);
	location.href = "ModificaMesero.php?tipo="+form.tipo.value+"";
	setTimeout ("redireccionar()", 5000); //tiempo expresado en milisegundos
}
function redireccionar()
{
  window.locationf="Nominas.php";
} 
</script>
