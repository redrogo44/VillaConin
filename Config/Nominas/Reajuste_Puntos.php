<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
	require "configuraciones.php";
	conectar();
	validarsesion();
	$nivel=$_SESSION['niv'];
	menuconfiguracion();
	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../subcontratos.css" type="text/css" /> 
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Villa Conin</title>
    <style type="text/css">
             *{
				 padding:0px;
				 margin:0px;
			  }
			  #header{
				  margin:auto;
				  width:900px;
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
a.boton { 
color: #FF0000; 
border: 2px #0000FF solid; 
padding: 5px 20px 5px 40px; 
background-color: #90777C; 
font-family: Comic Sans MS, Calibri, Arial; 
font-size: 12px; 
font-weight: bold; 
text-decoration: none; 
background-image: url(http://k14.kn3.net/65D0EE7C0.png); 
background-repeat: no-repeat; 
border-radius: 15px; 
} 
a.boton:hover { 
font-style: italic; 
box-shadow: 0px 0px 5px 0px #000000; 
} 
a.boton:active { 
color: #FFFF99; 
background-color: #FF0000; 
box-shadow: 0px 0px 10px 0px #000000; 
}			 
			   
    </style>    
</head>
   <link rel="stylesheet" href="tablas2.css" type="text/css"/>	
   <link rel="stylesheet" href="demo.css">
	<link rel="stylesheet" href="pop/demo.css">

<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<br />
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

//print_r($_POST);
$MEseros=mysql_query("SELECT * FROM Meseros WHERE id=".$_GET['numero']);
$TMeseros=mysql_fetch_Array($MEseros);

$Pu=mysql_query("SELECT * FROM Configuraciones WHERE descripcion='".$TMeseros['tipo']."'");
$Puntos=mysql_fetch_array($Pu);
?>
<br>
<br>
<!--ESTILO CUERPO-->
<div align="center">
	<h1><b>REAJUSTE DE PUNTOS</b></h1>
	<br><br>
	<font color="blue"><h4><b>Reajuste de Puntos para <?php echo "<font color='#FF0000'>".$TMeseros['nombre']." ".$TMeseros['ap']." ".$TMeseros['am']."</font>";?></b></h4></font>
	<br><br>
	<form action="Modificaciones_Generales.php" method="post">
	<table border="6"  bordercolor='#7F0000'>
	<tr>
		<td align="center" bgcolor="#B4FD2C"><b>DESCRIPCION</b></td><td aling='center' bgcolor="#2CFD30"> <b>TOTAL</b></td>
	</tr>
		<tr><td bgcolor="#DAE4A9"><b>Numero de Eventos</b></td><td align="center" bgcolor="#A9E4AA"><b><?php echo $TMeseros['neventos'];?></b></td></tr>
		<tr><td bgcolor="#DAE4A9"><b>Puntos por Eventos</b></td><td align="center" bgcolor="#A9E4AA"><b><?php echo $Puntos['puntos'];?></b></td></tr>
		<tr><td bgcolor="#DAE4A9"><b>Puntos Acumulados</b></td><td align="center"  bgcolor="#A9E4AA"><b><?php echo $Puntos['puntos']*$TMeseros['neventos'];?></b></td></tr>
		<tr><td bgcolor="#DAE4A9"><b>Reajuste de Puntos</b></td><td align="center"  bgcolor="#A9E4AA"> <input type="number" name='reajuste'></input></td></tr>
		<input type="hidden" name="tipo" value="reajuste">
		<input type="hidden" name="id" value="<?php echo $TMeseros['id'] ?>">


	</table>
	<br><br>
		<input type="submit"  value="Reajustar Puntos" />

	</form>


	<br>
	<br>
	

</div>

<?php
		// TOTAL DE PUNTOS * CATEGORIA
	function TotalPuntos($tipo)
	{	
		$PP="SELECT * FROM Configuraciones WHERE descripcion='".$tipo."'";
		$Pun=mysql_query($PP);		
		$Puntos=mysql_fetch_array($Pun);
		$TT=mysql_query("SELECT * FROM Meseros WHERE tipo='".$tipo."'");
		$TotalPuntos_Categoria=0;
		while($TOTAL=mysql_fetch_array($TT))
		{
			$TotalPuntos_Categoria=$TotalPuntos_Categoria+$Puntos['puntos']*$TOTAL['neventos'];
		}
		return $TotalPuntos_Categoria;
	}
?>
</body>
</html>