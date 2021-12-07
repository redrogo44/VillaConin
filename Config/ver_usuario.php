<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
require 'configuraciones.php';
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
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<?php
conectar();
$datos="select * from usuarios where id=".$_GET['id'];
$result=mysql_query($datos);
$show=mysql_fetch_array($result);echo "<BR><BR><BR><CENTER>";
echo "<center><img src='img/credencial.png' width='140px' height='120px'>";
echo "<table border='1'>";
echo "<tr><td COLSPAN='2'><center><STRONG>DATOS DE USUARIO</td></tr>";
echo "<tr><td><label>Nombre</label></td><td>".$show['nombre']."</td></tr>";
echo "<tr><td><label>Usuario</label></td><td>".$show['usuario']."</td></tr>";
echo "<tr><td><label>Contraseña</label></td><td>".$show['contrasena']."</td></tr>";
echo "<tr><td><label>Nivel</label></td><td>".$show['nivel']."</td></tr>";
echo "<tr><td><label>Estatus</label></td><td>".$show['estatus']."</td></tr>";
echo "</table>";
?>

<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Configuraciones Sistema Villa Conin V 3.0 </b></MARQUEE><br />copyright - 2014 powered by MBR soluciones </div>
</body>
</html>
