<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'funciones2.php';
validarsesion();
$nivel=$_SESSION['niv'];
if($nivel==0)
{
menunivel0();				
}
if($nivel==1)
{
menunivel1();				
}
if($nivel==2)
{
menunivel2();
}
if($nivel==3)
{
menunivel3();
}
if($nivel==4)
{
menunivel4();
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
				  width:600px;
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
				 display:block;}
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
				right:140px;
				top:0px;}
			.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#09F;font-size:3;font-family:Arial, Helvetica, sans-serif;} 
				 
    </style>
</head>

<body>
 
  <div id="header"  align="center">
   <ul class="nav">
    <li><a href="index.php">Inicio</a></li>
   
   <li><a href="">Eventos</a>
     <ul>   
       <li><a href="">Reservar Evento</a></li>
       <li><a href="">Ver Status de Evento</a></li>
       <li><a href="">Modificar Evento</a></li>
       <li><a href="">Seguimiento de Evento</a></li>
     </ul>
   </li>
        
   <li><a href="">Clientes</a>
       <ul>   
       <li><a href="buscaridcliente.php">Buscar cliente</a></li>
           <li><a href="Cliente-nuevo.php">Nuevo Cliente</a></li>
           <li><a href="Estado-Cuenta.php">Estado de Cuenta Cliente</a></li>
           <li><a href="Abonos-cliente.php">Abonos Cliente</a>  </li>
           <li><a href="CargosCliente.php">Cargos al Cliente</a></li>
       </ul>
   </li>
          
   <li><a href="">Saldos</a></li>
   <li><a href="">Reportes</a>
       <ul>   
           <li><a href="">Reporte de Clientes</a></li>
           <li><a href="">Reporte Semanal</a></li>
           <li><a href="">Reporte Mensual</a></li>     
       </ul>
   </li>
   <li><a href="cerrar.php">Cerrar sesion</a></li>
   </ul>
  </div>
</body>
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">

<!--FORMULARIO-->

<div align="center">
<br /><br /><br  style="background-position:center"/>
<p>Selecciona una opcion para refinar busqueda</p>
	<div class="wrapper wrapper-style4">		
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  
			<select name="categoria" size="1" id="categoria">
				<option>RFC</option>
				<option>Codigo contrato</option>
			</select>
            <input type="text" name="campo" size="35" maxlength="35" required="required" placeholder="		Ingresa aqui tu texto">
			<input type="submit" name="submit" value="Buscar">
		</form>
		</div>
		<div class="wrapper">
			<?php
					if(isset($_POST['submit'])) {
					conectar();
					busqueda();
				}
			?>
</div>
</body>
</html>
