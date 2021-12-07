<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
error_reporting(0);
session_start();
	require "configuraciones.php";
	conectar();
	validarsesion();
$nivel=$_SESSION['niv'];
	if ($nivel==2) 
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
   <link rel="stylesheet" href="tablas2.css" type="text/css"/>	
   <link rel="stylesheet" href="demo.css">
	<link rel="stylesheet" href="pop/demo.css">

<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<br />
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

//print_r($_POST);

?>
<!--ESTILO CUERPO-->
<script type="text/javascript">
alert('Al modificar el nombre de alguna Categoria de Meseros este cambiara por automatico la de todo el personal con esa Categoria');
	
</script>
<div align="center"  >
<br  style="background-position:center"/ >
   <!-- Tabala Pre-Registro -->
   <h1>MODIFICAR CATEGORIA</h1>
   <br><br>
	  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">      		
			   <select name="Nanterior">
			   	<option value="Seleccione">Seleccione una Opcion</option>
			   	<?php
			   		$c=mysql_query("SELECT * FROM Configuraciones WHERE tipo='Nomina'");
			   		while ($cat=mysql_fetch_array($c)) 
			   		{
			   			echo '<option value="'.$cat['descripcion'].'">'.$cat['descripcion'].'</option> ';
			   		}
			   	?>
			   </select>
					<input type="submit" name="submit" value="Buscar">
		</form>
<br></br>
   <?php
			//print_r($_POST);
		if(isset($_POST['submit'])) 
		{
			$op=$_POST['Nanterior'];
			echo "
					<h3><font color='blue'> Ingrese el Nuevo Nombre de la Categoria</font></h3>
					<h4><font color='red'>Recuerda que el nombre de la nueva categoria no debe llebar espacios.</font></h4>
					<br>
					<label> Nombre de la Categoria Seleccionada: ".$op." </label>
					<br>
					<br>
					<form action='modicarCatgoria.php' method='POST'>
						<label>Nuevo Nombre</label>&nbsp;&nbsp;&nbsp;<input type='text' name='nombre' placeholder='	Nombre Nuevo'/>
						&nbsp;&nbsp;&nbsp;
						<input type='submit' value='Cambiar' />
						<input type='hidden' value='".$op."'  name='anterior'/>
					

					</form>
				";
		}
   ?>
</div>  
 
	

</body>
<?php
pie();
?>
</html>