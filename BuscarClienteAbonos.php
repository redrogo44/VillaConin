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
			
				 
    </style>
</head>

<body>

</body>
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>


<!--ESTILO CUERPO-->

<div align="center">
<br /><br /><br  style="background-position:center"/>
     <table border="1" align="center" title="Abonos" width="130px">
     <tr><td align="center"><b>Buscar Cliente</b></td></tr>
	 <table border="1" align="center" title="Buscar Por">
       <tr>
          <td><b>Nombre</b></td>
          <td><input name="nombre" type="text" size="35" maxlength="35"> 
          </td>
          <tr>
              <td><b>apellido Paterno</b></td>
              <td>
              <input name="codigo" type="text" size="35" maxlength="35">   
          	  </td>
          </tr>
           <tr>
              <td><b>Apellido Materno</b></td>
              <td>
              <input name="folio" type="text" size="35" maxlength="35">   
          	  </td>
          </tr>
           <tr>
              <td><b>Codigo Cliente</b></td>
              <td>
              <input name="ncuenta" type="text" size="35" maxlength="35">   
          	  </td>
          </tr>
           <tr>
              <td><b></b></td>
              <td align="center">
             <input name="buscar" type="submit" style="background-image:Imagenes/buscar.png" />
          	  </td>
          </tr>
    
    </tr>

   </table>
</div>


</body>
</html>
