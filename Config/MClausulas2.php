<?php
 header('Content-Type: text/html; charset=UTF-8'); 
require 'configuraciones.php';
conectar();
if($_POST['op']=='Modificar'){
$c='update clausulas2 set descripcion="'.$_POST['contenido'].'" where id='.$_POST['id'];
$r=mysql_query($c);
header('Location: Clausulas2.php');
}
elseif($_POST['op']=='Borrar'){
$r=mysql_query('update clausulas2 set descripcion="" where id='.$_POST['id']);
header('Location: Clausulas2.php');
}
else if($_POST['op']=="Insertar"){
$r=mysql_query('insert into clausulas2(descripcion) values("'.$_POST['contenido'].'")');
header('Location: Clausulas2.php');
}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" /> 
<?php
menuconfiguracion();
?>
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
<br><br><br><center>
<form action="MClausulas2.php" method="POST">
<label>Clausula</label><br>
<textarea rows="10" cols="40" name='contenido'>
</textarea>
<br>
<input type="submit" value="Insertar" name="op">
</form>


<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Configuraciones Sistema Villa Conin V 3.0 </b></MARQUEE><br />copyright - 2014 powered by MBR soluciones </div>
</body>
</html>






<?php
}?>