<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require 'funciones2.php';conectar();
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
				  width:800px;
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
    <table border="9" align="center"  bordercolor="#990000" bordercolordark="#990000"	 bordercolorlight="#990000" >
       <tr>
       <form action="alta.php" method="post" name="newregist">
          <td><b>Nombre</b></td>
          <td><input name="nom" type="text" size="35" maxlength="35" placeholder="		Nombre " required>
    
       </tr>

       <tr>
    
        <td><b>Apellido Paterno</b></td>
        <td><input name="ap" type="text" size="35" maxlength="35" placeholder="		Apellido Paterno">

      </tr>

      <tr>
         <td><b>Apellido Materno</b></td>
         <td><input name="am" type="text" size="35" maxlength="35" placeholder="		Apellido Materno">

      </tr>

    <tr>
       <td><b>E-mail</b></td>
       <td><input name="mail" type="email" size="35" maxlength="" placeholder="		ejemplo@dominio.com" >

    </tr>
      <tr>
       <td><b>Comensales</b></td>
       <td><input name="comenzales" type="number" size="35" maxlength="" placeholder="		" >

    </tr>
<tr>
      <td><B>Telefono</B></td>
      <td><input name="tel" type="text" size="35" maxlength="30" placeholder="	Numero a 10 digitos	"></td>
      </tr>
         <tr >
       <td ><b>Fecha Tentativa</b></td>
      <td>
     <label><input type="date" name="fecha" size="25"></label>
	  </td>
      <tr>
       <td><b>Tipo de eventos:</b></td><td>
       <select name="tipo" size="1" id="categoria" onchange="activar(this.form)">
				<option value='Seleccione una opcion'>Seleccione una Opcion</option>
            <option value='Bautizo'>Bautizo</option>
           <option value='Boda'>Boda</option>
            <option value='XV Años'>XV Años</option>
            <option value='Empresarial'>Empresarial</option>
            <option value='Graduacion'>Graduacion</option>
            <option value='Primera Comunion'>Primera Comunion</option>
            <option value='Cumpleaños'>Cumpleaños</option>
 			<option value='Presentacion'>Presentacion</option>
            <option value='Otros'>Otros</option>
               
			</select>
      </tr>
       <td><b>Medio de contacto:</b></td><td>
       <select name="medio" size="1" id="categoria" onchange="activar(this.form)">
       <option value='Seleccione una opcion'>Seleccione una Opcion</option>   
				<option>Bodas.com</option>
					<option>Correo Ventas</option>
					<option>Carteles</option>
					<option>Facebook</option>
					<option>Google</option>
					<option>Pagina Villa</option>
					<option>Recomendacion</option>
					<option>Seccion amarilla(internet)</option>
	                <option>Seccion amarilla(libro)</option>
					<option>Visita</option>					
					<option>Visita de Campo</option>				
			</select>
      </tr>
           <tr>
       <td><b>Vendedor:</b></td><td>
       <select name="vendedor" size="1" id="vendedor" onchange="activar(this.form)">
        <option value='Seleccione una opcion'>Seleccione una Opcion</option>
          
          <?php			$Ve="SELECT * FROM usuarios where nivel=4";			$Vende=mysql_query($Ve);
            while($Vendedor=mysql_fetch_array($Vende))
            {
              $nom=explode(" ",$Vendedor['usuario']);
              echo "  <option value='".$nom[1]."'>".$nom[1]."</option>";
            }
          ?>
               
      </select>
      </tr>   
      
         <td></td>
         <td align="center">
       <p><input id="boton" name="but" type="submit" disabled="true"/></p>
</form>

       </td>
       </tr>
      </td>
      </tr>

   </table>
    
    
  <!-- Pie de PAgina -->
<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 1.0 </b></MARQUEE><br />copyright - 2014 powered by MBR soluciones </div>
<?php pie(); ?>
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
