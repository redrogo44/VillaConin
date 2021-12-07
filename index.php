<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require 'funciones2.php';
validarsesion();
$nivel=$_SESSION['niv'];
mod_alertas();
?>


<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php
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
if($nivel==5)
{
menunivel5();
}
if($nivel==6)
{
menunivel6();
}
?>
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
				 /* right:1000px;/*/
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
				left:100%;
				min-width:160px;
				top:10px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				z-index: 100;
				}	 
				.nav ul li ul li ul{
				right:-80%;
				top:10px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				.cajon1
				{
			 		width:870px;
            		height:150px;
            		/*border: 3px solid #FF0000;*/

				}
				.cajon2
				{
					width:-60px;
            		height:0px;				
            		/*border: 3px solid #000000;*/
            		position: left;
				}
				.BOTON 
			{
				border: 3px solid #333333;
  border-radius: 3px;
  color: #940707;
  display: inline-block;
  font: bold 12px/12px HelveticaNeue, Arial;

  padding: 8px 11px;
  text-decoration: none;
			}
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
    <script> 
    function mod_pass(){
     var f=document.getElementById("pas").value;
     var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        //////////validacion por si se desea eliminar mas comensale de los asignados
                       //alert(xmlhttp.responseText);
                    }
                }
            xmlhttp.open("POST","index2.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("p="+f+"&t=1");
    }
    function mod_mostrarfac(){
     var f=document.getElementById("mostrar").value;
     var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        //////////validacion por si se desea eliminar mas comensale de los asignados
                       //alert(xmlhttp.responseText);
                    }
                }
            xmlhttp.open("POST","index2.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("p="+f+"&t=2");
    }
   function mod_ocultarfac(){
       
     var f=document.getElementById("ocultar").value;
     var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        //////////validacion por si se desea eliminar mas comensale de los asignados
                       //alert(xmlhttp.responseText);
                    }
                }
            xmlhttp.open("POST","index2.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("p="+f+"&t=3");
    }
    </script>
</head>

<!-- CUERPO DEL WEB-->
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >

<BR />
<br />
<div align="center">
<br><br>
<?php
$usuario=$_SESSION['usu'];
echo      "<b>&nbsp&nbsp&nbsp usuario:  ".$usuario."</b>";
?>
</div>


<!--ESTILO CUERPO-->
<div align="right" style="width:95%">
<?php
if($_SESSION['niv']==1||$_SESSION['niv']==0)
{
	$MeS=date('m');
	$Ano=date('y');
	$MeS=$MeS-1;
	if(count($MeS)==1)
	{
		$MeS="0".$MeS;
	}
	

		$busca="SELECT * FROM `contrato` WHERE `estatus`=0 and`Numero` LIKE 'MOSTRADOR%'";
		$f=mysql_query($busca);
		$CM=mysql_fetch_array($f);
		echo $contrato=$CM['Numero'];
		 mysql_num_rows($CM);
	if(mysql_num_rows($f)!=0)
	{
	
	
	echo "<form action='Abonos-cliente.php' method='post' >
	<input type='submit'  value='Realizar Abono Contrato Mostrador' class='BOTON'/>
	<input type='hidden' value='".$contrato."' name='contrato' />
	</form>";
	echo"<br>";
	echo "<form action='Abonos-cliente.php' method='post' >
	<input type='button'  onclick='PedirSaldo()' value='Terminar Contrato Mostrador'  class='BOTON'/>
	<input type='hidden' value='".$contrato."' name='contrato' />

	</form>
	";
	
	}
	else
	{
		echo "<form action='InserrtaMostrador.php' method='post'>
				<input type='submit'  value='Insertar Contrato de Mostrador' onclick='' class='BOTON'/>
				<input type='hidden' value='".$contrato."' name='contrato' />
				<input type='hidden' value='inserta_contrato' name='tipo' />
			</fomr>";
	}
}

if($nivel<=1){
    $c=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='password' and tipo='servicios'"));
    echo "<br><br>Password Servicios<br>";
    echo "<input id='pas' type='password' value='".$c['valor']."' onkeyup='mod_pass()'>";
    $c2=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='mostrar facturados' and tipo='clave'"));
    echo "<br><br>Mostrar o facturar<br>";
    echo "<input id='mostrar' type='text' value='".$c2['descripcion']."' onkeyup='mod_mostrarfac()' maxlength='1' >";
    $c3=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='ocultar factutados' and tipo='clave'"));
    echo "<br><br>Ocultar o no facturar<br>";
    echo "<input id='ocultar' type='text' value='".$c3['descripcion']."' onkeyup='mod_ocultarfac()' maxlength='1'>";
    
}

?><br>

<!--button class='BOTON' onclick='window.location="inventarios/"'><strong>INVENTARIO</strong></button-->
<!--<br><br><button align='left' onclick='location.href="contratos_faltantes.php"'>
	<strong>Generar Fechas faltantes</strong>
</button>
<br><button align='left' onclick='location.href="comensales_faltantes.php"'>
	<strong>Generar comensales faltantes</strong>
</button><br>
<button align='left' onclick='location.href="depositos_faltantes.php"'>
	<strong>Generar deposito faltantes</strong>
</button>
</div>
-->
<div align="center"  >
<!-- IMAGEN DE ACTUALIZACION DEL SERVIDOR  -->
<!--<img src="Imagenes/mantenimientoServidor.jpg" alt="Suspension Servicios"> -->
<br /><br  style="background-position:center"/ >


	<h1>Bienvenido(@)</h1>
    
    <br /><BR />
    <br /><BR />
	
    <!-- Mensaje segun la Hora -->
    <font size="+4" color="#990000">
    <script Language="Javascript" >
	today = new Date() 
	if(today.getMinutes() < 10)
	{ pad = "0"} 
	else pad = ""; 
	document.write ;
	if((today.getHours() >=6) && (today.getHours() <=9))
	{ document.write("<?php echo utf8_decode("Buen día"); ?> ") } 
	if((today.getHours() >=10) && (today.getHours() <=11))
	{ document.write("<?php echo utf8_decode("Buen día"); ?> " )} 
	if((today.getHours() >=12) && (today.getHours() <=19))
	{ document.write("Buenas tardes") } 
	if((today.getHours() >=20) && (today.getHours() <=23))
	{ document.write("Buenas noches") } 
	if((today.getHours() >=0) && (today.getHours() <=3))
	{ document.write("Buenas noches") } 
	if((today.getHours() >=4) && (today.getHours() <=5))
	{ document.write("Buenas noches" )} </script>
    </font>
    <!-- Copiar este código dentro del tag BODY -->
    
    <!-- Búsqueda Google --> 

<div class="cajon2" align="left" >
	<?php

////// VALIDAR EL NIVEL SI ES 0,1,2
if($_SESSION['niv']==0||$_SESSION['niv']==1||$_SESSION['niv']==2)
{
	$Abo=mysql_query("Select * from abonosforaneos");
	$Abono=mysql_fetch_array($Abo);
		count($Abono);
	if(!empty($Abono))
	{
		echo 
		"
			<marquee direction='up' onmouseout='this.start()' 
			onmouseover='this.stop()' scrollamount='5' 
			style='border 2px solid #000; height:-200px; padding:3px; text-align:center; width:250px;'>
			<a href='ReimpresionAbonoPDF.php'><font color='#FE0000'><h1><b>Tienes Abonos Por Imprimir</b></h1></font></a>
			</marquee>
		
		";
	}
}

?>

</div>
    <div class="cajon1" align="center">

    <br /><br />
        <br /><br />
    <p> </p> <center> <form action="http://www.google.com/search" method="get"> <table bgcolor="#ffffff"> <tbody> <tr> <td><a href="www.google.es/" _fcksavedurl="www.google.es/" _fcksavedurl="www.google.es/"><img alt="Google" align="absMiddle" border="0" src="http://www.google.com/logos/Logo_40wht.gif" _fcksavedurl="http://www.google.com/logos/Logo_40wht.gif" _fcksavedurl="http://www.google.com/logos/Logo_40wht.gif" /></a> <input maxlength="255" size="31" name="q" /> <input type="hidden" name="hl" value="es" /> <input type="submit" name="btnG" value="Búsqueda Google" />
</td>
</tr></tbody></table></form></center></div>
</div>
<?php
/////
pie();
?>
<script>
function PedirSaldo()
{ 	
	saldoInicial=prompt("¿Cuál es el Saldo Inicial para el contrato de Mostrador?");
	location.href="InserrtaMostrador.php?saldo="+saldoInicial
	//InsertarContrato(saldoInicial);
}
function AbonoMostrador()
{
	alert('entro');
	location.href="InserrtaMostrador.php?numero="
}
</script>
</body>
</html>
