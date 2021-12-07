<!DOCTYPE html>
<?PHP
session_start();	
	require "configuraciones.php";
	validarsesion();
	conectar();
	$nivel=$_SESSION['niv'];
	menuconfiguracion();
?>

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
			.pie {position:relative;bottom:0;width:100%;color:white;background-color:#900;font-size:10;font-family:Arial, Helvetica, sans-serif;} 
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
							   -webkit-border-radius: 8px;
							   -moz-border-radius: 8px;
							   border-radius: 8px;
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
	<meta charset="UTF-8">
	<link rel="stylesheet" href="pop/demo.css">
</head>
<body background="../../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<br />
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

$tip="Select * from Meseros";
$TT=mysql_query($tip);


?>
<div align="center"  >
<br /><br /><br  style="background-position:center"/ >
   <!-- Tabala Pre-Registro -->
   <h1>HISTORIAL DE MESEROS</h1>
   <br />
   <br /><br />


  <div class="wrapper">
  <form method="post">
    	<table bordercolor="#990000" border="6">
        	<tr>
            	<td align="center">NOMBRE</td> 
                <td align="center">TIPO</td> 
                <td align="center">ESTATUS</td> 
                <td align="center">DETALLES</td>           
            </tr>
            <?PHP 
			while($me=mysql_fetch_array($TT))
			{
				echo " 	<tr>
							 <td align='center'>".$me['nombre']." ".$me['ap']." ".$me['am']."</td>
							 <td align='center'>".$me['tipo']."</td>
							 <td align='center'>".$me['estatus']."</td>
							 <td align='center'>
							 <input type='button' value='Detalles' class='button' data-type='zoomin' onclick='load(".$me['id'].")' /></td>            
						</tr>
					";
			}
			?>
        </table>
    </form>
  
 </div>
	<div class="overlay-container">
		<div class="window-container zoomin">
			<h3>Informacion</h3> 
			<br>
			<div id='dialog'>
			
			</div>
			<br/>
			<span class="close">Cerrar</span>
		</div>
		
	</div>
	
	
	<script>!window.jQuery && document.write(unescape('%3Cscript src="pop/jquery-1.7.1.min.js"%3E%3C/script%3E'))</script>
	<script type="text/javascript" src="pop/demo.js"></script>
	
<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 3.0 </b></MARQUEE><br />copyright - 2014 Powered By MBR soluciones </div>

</body>
<script>
function load(str){
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("dialog").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","inf_meseros.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("q="+str);

}
</script>
</html>