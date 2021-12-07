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
				right:-140px;
				top:0px;}			 
    </style>
</head>
<script language="javascript" type="text/javascript">
var cond='correcto';
function d1(selectTag){
 if(selectTag.value == 'otro1'){
document.getElementById('prg1').disabled = false;
 }else{
 document.getElementById('prg1').disabled = true;
 }
}



</script> 
<script type="text/javascript" language="javascrip" src="ajax.js"></script>
<body>
 
 
 
 
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" onload="validar();">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

conectar();
$q="select * from preregistro where id=".$_GET['numero'];
$r=mysql_query($q);
while($m=mysql_fetch_array($r))
{
	$nombre=$m['nombre'];
 	$ap=$m['ap'];
	$am=$m['am'];
	$tel=$m['telefono'];
 	$mail=$m['mail'];
}
?>

<!--ESTILO CUERPO-->

<div align="center">
<br /><br /><br  style="background-position:center"/>

	 <table border="9" align="center"  bordercolor="#990000" bordercolordark="#990000"	 bordercolorlight="#990000" >
       <tr>
       <form action="altacliente.php" method="post" >
          <td><b>Nombre</b></td>
          <td><input name="nom" type="text" size="35" maxlength="35" placeholder="		Nombre " onblur="validar();" required value="<?php echo $nombre;?>">
    
       </tr>

       <tr>
    
        <td><b>Apellido Paterno</b></td>
        <td><input name="ap" type="text" size="35" maxlength="35"  required="required" value="<?php echo $ap;?>"placeholder="		Apellido Paterno" onblur="validar();" required>

      </tr>

      <tr>
         <td><b>Apellido Materno</b></td>
         <td><input name="am" type="text" size="35" maxlength="35" required="required" placeholder="		Apellido Materno" value="<?php echo $am;?>"onblur="validar();" required>

      </tr>

    <tr>
       <td><b>E-mail</b></td>
       <td><input name="mail" type="email" size="35" maxlength="" value="<?php echo $mail;?>" placeholder="		ejemplo@dominio.com" onblur="validar();" required>

    </tr>
<tr>
       
    
    <tr>
         <td><b>RFC</b> </td>
         <td><input id="rfc" name="rfc" type="text" size="35" maxlength="18" required="required" placeholder="		Rfc del cliente"   onblur="validar();" required>
   	<div id="rfcdiv" style="display:block;">
  
</div>
    </tr>
   
    <tr>
         <td><b>Regimen</b></td><td>

		<select NAME="pg1" onchange="d1(this)">
		
		<option>Persona fisica
<option value='otro1'>Persona moral
</select><br>
<br>
<i>Denominacion Comercial:</i> <br /><input type='text' id="prg1" name='otro1' size='40' value="<?php echo $otro1_form;?>" disabled="true"><br />

      
             <tr >
       <td><b>Domicilio</b> </td>
      <td><input name="dom" type="text" size="40" maxlength="200" placeholder="		Direccion del cliente" onblur="validar();" required></td>
       <tr >
       <td><b>Codigo Postal</b></td>
      <td><input name="cp" type="text" size="35" maxlength="5" placeholder="		Codigo postal" onblur="validar();" required></td>
       <tr >
       <td><B>Telefono</B></td>
      <td><input name="tel" type="text" size="35" value="<?php echo $tel;?>" maxlength="100" placeholder="	Numero a 10 digitos	" onblur="validar();" required></td>
      <tr >
          <tr>
         <td></td>
         <td align="center">
       <p>
       
     <div id="b" style="display:none;">
  <input type="submit" name="sub" id="sub" /></p>
    </div>
       </form>
       </td>
       </tr>
      </td>
    
    </tr>

   </table>
</div>


</body>

<script>

function validar(){
	var RFC=document.getElementById('rfc').value;
	from(RFC,'rfcdiv','letrero.php');
	if(document.getElementById('condicion').value=='incorrecto'){
			document.getElementById('b').style.display='none';
		}else{
			document.getElementById('b').style.display='block';
				}
	} 
</script>
</html>
