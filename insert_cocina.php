<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
	require "funciones2.php";
	validarsesion();
	conectar();
	$nivel=$_SESSION['niv'];
	if($nivel==0){
	menunivel0();				
	}
	if($nivel==1){
	menunivel1();				
	}
	if($nivel==2){
	menunivel2();
	}
	if($nivel==3){
	menunivel3();
	}
	if($nivel==4){
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
   <h1>Registrar Modulo Cocina</h1>
   <br />
    <table border="9" align="center"  bordercolor="#990000" bordercolordark="#990000"	 bordercolorlight="#990000" >
       <tr>
       <form action="alta_cocina.php" method="post" name="newregist">
          <td><b>Nomenclatura</b></td>
          <td><input name="nomen" type="text" size="35" maxlength="35" placeholder="		Nombre del producto ">
       </tr>
       <tr>
        <td><b>Descripci&oacute;n</b></td>
        <td><input name="desc" type="text" size="35" maxlength="35" placeholder=   "	       Descripci&oacute;n del producto">
      </tr>
      <tr>
         <td><b>Tipo</b></td><td align="center">
         <select name="tipo" id="categoria" onchange="activar(this.form)">
         <option value='Seleccione una opci&oacute;n'>Seleccione una opci&oacute;n</option>
         <option value='COCINA'>COCINA</option>
         </select>
      </tr>
    <tr>
       <td><b>Buen Estado</b></td>
       <td><input name="bue" type="text" size="35" maxlength="" placeholder="	    	Mejor estado" >
    </tr>
      <tr>
       <td><b>Mal Estado</b></td>
       <td><input name="mal" type="text" size="35" maxlength="" placeholder="		Mal estado" >
    </tr>
       <td><b>Comentarios</b></td>
       <td><input name="com" type="text" size="35" maxlength="" placeholder="		Comentarios" >
    </tr>
         <td></td>
         <td align="center">
   		<p><input id="button"  class="button" name="but" type="submit"  value="Guardar"/></p>    
</form>
       </td>
       </tr>
      </td>
      </tr>
   </table>   
  <!-- Pie de PAgina -->
<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 3.0 </b></MARQUEE><br />copyright - 2014 Powered By MBR soluciones </div>
</body>
</html>
<script>
function activar(formulario){
 if(document.newregist.tipo.value != "Seleccione una opcion" && document.newregist.medio.value!="Seleccione una opcion") 
document.newregist.but.disabled = false 
else 
document.newregist.but.disabled = true 
}
</script>