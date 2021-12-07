<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
session_start();
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
<script>
var nivel= "<?php echo $_SESSION['niv']?>";

if(nivel==1)
{
	window.location.href="https://greatmeeting.me/Config/ConfiguracionSistema.php";
}
function verifica(id){
	if(confirm("¿Seguro que euiere eliminar al usuario?")){
	location.href='b_usuario.php?id='+id;
	}
}
</script>
<?php
conectar();
$q="select * from usuarios";
$r=mysql_query($q);
echo "<BR><BR><BR><CENTER><a href='agregar.php'><img width='20px' height='20px'src='img/agregar.ico'><strong>Agregar Usuario</a>";
echo "<table border='1'>";
echo"<tr'><td><strong>Usuario</td><td><strong>Modificar</td><td><strong>Eliminar</td><td><center><strong>Ver</td></tr>";
while($m=mysql_fetch_array($r)){
echo"<tr><td>".$m['usuario']."</td><td align='center'><a href='m_usuario.php?id=".$m['id']."'><img width='50px' height='50px'src='img/modificar.ico'></a></td><td align='center'><button  onclick='verifica(".$m['id'].");'><img width='50px' height='50px'src='img/borrar.ico'></button></td><td align='center'><a href='ver_usuario.php?id=".$m['id']."'><img width='50px' height='50px'src='img/ver.ico'></a></td></tr>";
}
echo "</table>";
pie();
 ?>


</body>
</html>
