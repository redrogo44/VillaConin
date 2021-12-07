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
				right:-110px;
				top:0px;}			 
    </style>
</head>
<script language="javascript" type="text/javascript">
function d1(selectTag){
 if(selectTag.value == 'otro1'){
document.getElementById('prg1').disabled = false;
 }else{
 document.getElementById('prg1').disabled = true;
 }
}
function Redireccionar()
{
	location.href="Cliente-nuevo.php";
}
</script> 
<body>
 
 
 
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>


<!--ESTILO CUERPO-->

<div align="center">
<br /><br /><br  style="background-position:center"/>

	 <table border="9" align="center"  bordercolor="#990000" bordercolordark="#990000"	 bordercolorlight="#990000" >
     
     <div align="center">
	<br /><br /><br  style="background-position:center"/>
	<p><b><h2>Buscar Cliente</h2></b></p>
<div class="wrapper wrapper-style4">		
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  
			<select name="categoria" size="1" id="categoria">
				<option>Apellido paterno</option>
				<option>RFC</option>
			</select>
            <input type="text" name="campo" size="35" maxlength="35" required="required" placeholder="		Ingresa aqui tu texto">
			<input type="submit" name="submit" value="Buscar">
		</form>
		</div>
		<div class="wrapper" align="center">
			<?php
					if(isset($_POST['submit'])) {
					conectar();
					busquedacliente();
				}
				
				pie();
			?>
             <BR/>
            <button onclick="Redireccionar()">Registrar Cliente</button>
            </div>
           

     
     
     <!--
       <form action="altacontrato.php" method="post">
                 <td><b>Nombre de Contrato</b></td>
        <td><input name="nom" type="text" size="35" maxlength="35" placeholder="		Nombre"  required="required">
<tr>
          

      <tr>
         <td><b>Fecha de Contrato</b></td>
         <td align="center">
         		<script > 

var mydate=new Date(); 
var year=mydate.getYear(); 
if (year < 1000) 
year+=1900; 
var day=mydate.getDay(); 
var month=mydate.getMonth()+1; 
if (month<10) 
month="0"+month; 
var daym=mydate.getDate(); 
if (daym<10) 
daym="0"+daym; 
document.write("<small>< font  color='000000' face='Arial'><b >"+daym+"/"+month+"/"+year+"</b></font></small>") 

</script> 
       </td>
      </tr>

    <tr>
       <td><b>Fecha Evento</b></td>
       <td>
       	<input type="date" name="fechaevento" class="tcal" value="" />
       </td>
    </tr>
    <tr>
       <td><b>Saldo Inicial</b></td>
       <td><input name="si" type="text" size="35" maxlength="" placeholder="		$ 00,000.00" required="required"  >
    </tr>
    
    
    
    <tr>
       <td><b>Domicilio</b></td>
       <td><input name="dom" type="text" size="35" maxlength="" placeholder="		Domicilio del Cliente" required="required">
    
    <tr>
         <td><b>RFC</b> </td>
         <td><input name="rfc" type="text" size="35" maxlength="18" required="required" placeholder="		Rfc del cliente"required="required">
    </tr>
   
    <tr>
       <td><b>Correo</b></td>
       <td><input name="mail" type="mail" size="35" maxlength="" placeholder="		ejemplo@dominio.com" required="required">

    </tr>
    
    <tr>
       <td><b>Telefono</b></td>
       <td><input name="tel" type="text" size="35" maxlength="" placeholder="		000-00-00-00-00-00" required="required" >

    </tr>
    <tr>
       <td><b>Tipo de Evento</b></td>
        <td><label for='tipoevento'></label>
<select name='tipo' id='tipo' >
            <option value='Seleccione una opcion'>Seleccione una Opcion</option>
            <option value='Bautizos'>Bautizo</option>
           <option value='Boda'>Boda</option>
            <option value='XV Años'>XV Años</option>
            <option value='Graduaciones'>Empresarial</option>
            <option value='Empresariales'>Graduacion</option>
            <option value='Primera Comunion'>Profesional</option>
           
        </select></td>

    </tr>
    <tr>
       <td><b>Salon</b></td>
        <td><label for='tipoevento'></label>
<select name='salon' id='salon' >
            <option value='Seleccione una opcion'>Seleccione una Opcion</option>
            <option value='	Fundador de Conin'>Fundador de Conin</option>
           <option value='	Real de Conin'>Real de Conin</option>
            <option value='Alcazar Conin'>Alcazar Conin</option>
            <option value='Solar de Conin'>Solar de Conin</option>
           
        </select></td>

    </tr>
   
    
    
      <tr >
          <tr>
         <td></td>
         <td align="center">
       <p><input type="submit" /></p>
</form>
-->
       </td>
       </tr>
      </td>
    
    </tr>

   </table>
</div>


</body>
</html>

