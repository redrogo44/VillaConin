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
 
 <title>Villa Conin</title>
<head> 
<script type="text/javascript" src="js/shortcut.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
 <link rel="stylesheet" href="subcontratos.css" type="text/css" /> 
 <link rel="stylesheet" href="demo.css">
</head> 
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
				right:-142px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
			#fname{
				font-family: Arial; font-size: 15pt; 
				
				}
			#btn{
				-moz-box-shadow:inset 0px 2px 0px 0px #cae3fc;
				-webkit-box-shadow:inset 0px 2px 0px 0px #cae3fc;
				box-shadow:inset 0px 2px 0px 0px #cae3fc;
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #4197ee) );
				background:-moz-linear-gradient( center top, #79bbff 5%, #4197ee 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#4197ee');
				background-color:#79bbff;
				-webkit-border-top-left-radius:0px;
				-moz-border-radius-topleft:0px;
				border-top-left-radius:0px;
				-webkit-border-top-right-radius:0px;
				-moz-border-radius-topright:0px;
				border-top-right-radius:0px;
				-webkit-border-bottom-right-radius:0px;
				-moz-border-radius-bottomright:0px;
				border-bottom-right-radius:0px;
				-webkit-border-bottom-left-radius:0px;
				-moz-border-radius-bottomleft:0px;
				border-bottom-left-radius:0px;
				text-indent:-3.93px;
				border:1px solid #469df5;
				display:inline-block;
				color:#ffffff;
				font-family:Arial;
				font-size:20px;
				font-weight:bold;
				font-style:normal;
				height:47px;
				line-height:47px;
				width:104px;
				text-decoration:none;
				text-align:center;
				text-shadow:5px 4px 0px #155ba1;
				}
   </style>
	

<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff" align='center' >
<br><br><br><br><br><br><center>
<form action="fechas_subcontrato.php">
<input type='date' name='fecha_nueva' min='<?php echo $_GET['min']; ?>' max='<?php echo $_GET['max']; ?>'>
<input type='hidden' name='index' value='<?php echo $_GET['index']; ?>' >
<input type='hidden' name='op' value='<?php echo $_GET['op']; ?>' >
<input type='hidden' name='numero' value='<?php echo $_GET['numero']; ?>' ><br><br>
<input type='submit' value='Enviar' id='btn'>
</form>
</center>
</body>
</html>