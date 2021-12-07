<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Modifica Contraseña</title>

	<link rel="stylesheet" href="">

	<?php

		require 'configuraciones.php';

		session_start();

		validarsesion();

		$nivel=$_SESSION['niv'];

		menuconfiguracion();				

		$_SESSION['usu']=$_GET['usuario'];



		$pass=mysql_fetch_array(mysql_query("SELECT * FROM Configuraciones WHERE id=23"));

	?>

 <style type="text/css">

	

             *{

				 padding:0px;

				 margin:0px;

			  }

			  

			  #header{

				  margin:auto;

				  width:1000px;

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
https://greatmeeting.me/
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

<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">       

</head>



<!-- CUERPO DEL WEB-->

<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >

<br><br>

<form action="Modificaciones_Generales.php" method="post" accept-charset="utf-8">

	<div align="center">	

		<table border="9">

			<caption align="center"  colspan='2'>Modificar la Contraseña</caption>

			<thead>

				<tr align="center">

					<th colspan="2" align="center">Contraseña de Confirmacion <br>para Cargos y Servicios</th>

				</tr>

			</thead>

			<tbody>	

				<tr>

					<td  style='width:190px;'><font color="blue"><h3>Contraseña</h3></font></td><td><input type="text" name="pass" value="<?php echo $pass['valor']?>" style='width:100px;'></td>			

				</tr>

			<tr>

				<td align="right" colspan="2"><input type="submit" class="btn-block" name="cambia" value="Cambiar Contraseña" ></td>

			</tr>

			</tbody>

		</table>

		<input type="hidden" name="accion" value="Modifica Contrasena">

	</form>

	</div>

	<script type="text/javascript">

		var nivel= "<?php echo $_SESSION['niv']?>";



		if(nivel==1)

		{

			window.location.href="http://villaconin.mx/Config/ConfiguracionSistema.php";

		}

	</script>

</body>

</html>