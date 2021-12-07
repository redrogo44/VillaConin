O<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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
           <li><a href="Cliente-nuevo.php">Nuevo Cliente</a></li>
           <li><a href="Estado-Cuenta.php">Estado de Cuenta Cliente</a></li>
           <li><a href="buscar.php">Abonos Cliente</a>  </li>
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
   <li><a href="">Otros Servicios</a></li>
   </ul>
  </div>
</body>
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF">

<!--ESTILO CUERPO-->

<div align="center">
<br /><br /><br  style="background-position:center"/>

	 <table border="9" align="center"  bordercolor="#990000" bordercolordark="#990000"	 bordercolorlight="#990000" >
       <tr>
       <form action="alta.php" method="post">
          <td><b>Nombre</b></td>
          <td><input name="nombre" type="text" size="35" maxlength="35" placeholder="		Nombre Completo">
    
       </tr>

       <tr>
    
        <td><b>Apellido Paterno</b></td>
        <td><input name="apellidoP" type="text" size="35" maxlength="35" placeholder="		Apeliido Paterno">

      </tr>

      <tr>
         <td><b>Apellido Materno</b></td>
         <td><input name="apellidoM" type="text" size="35" maxlength="35" placeholder="		Apellido Materno">

      </tr>

    <tr>
       <td><b>E-mail</b></td>
       <td><input name="email" type="email" size="35" maxlength="" placeholder="		nombre@servidor.com.mx" >

    </tr>

    
    <tr>
         <td><b>RFC</b> </td>
         <td><input name="rfc" type="text" size="35" maxlength="18" required="required" placeholder="		RFC">
    </tr>
    <tr>
         <td><b>Representante Legal</b></td>
         <td><input name="rlegal" type="text" size="35" maxlength="50" placeholder="		REPRESENTANTE LEGAL">
    </tr>
    <tr >
       <td><b>Denominacion Comercial</b> </td>
      <td><input name="dcomercial" type="text" size="35" maxlength="30" placeholder="		DENOMINACION COMERCIAL"></td>
       <tr >
       <td><b>Domicilio</b> </td>
      <td><input name="domicilio" type="text" size="35" maxlength="50" placeholder="		CALLE, # Y COLONIA"></td>
       <tr >
       <td><b>Codigo Postal</b></td>
      <td><input name="codigopostal" type="text" size="35" maxlength="5" placeholder="		CODIGO POSTAL"></td>
       <tr >
       <td><B>Telefono</B></td>
      <td><input name="tel" type="text" size="35" maxlength="30" placeholder="	lada¨+ numero telefonico	"></td>
      <tr >
       <td ><b>Saldo Inicial</b></td>
      <td><input name="saldoinicial" type="text"
       size="35" maxlength="20" placeholder="		$ 0.00"></td>
        </tr></tr>
         <tr >
       <td ><b>Fecha Evento</b></td>
      <td>
      <link rel="stylesheet" type="text/css" href="tcal.css" />
	<script type="text/javascript" src="tcal.js"></script> 
	<form action="#">
		<!-- add class="tcal" to your input field -->
		<div><input type="text" name="date" class="tcal" value="" /></div>
	</form>
      </td>
        <tr >
       <td ><b>Salon de Eveto</b></td>
      <td><input name="Salon del Evento" type="text"
       size="35" maxlength="20" placeholder="		$ 0.00"></td>
       
         <tr >
       <td ><b>Vendedor</b></td>
      <td><input name="vendedor" type="text"
       size="35" maxlength="20" placeholder="		$ 0.00"></td>
        <tr >
        <tr >
       <td ><b>Codigo de Cliente</b></td>
      <td>
      
      <tr>
         <td></td>
         <td align="center">
       <p><input type="submit" /></p>
</form>
       </td>
       </tr>
      </td>
    
    </tr>

   </table>
</div>


</body>
</html>
