<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../subcontratos.css" type="text/css" /> 
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Villa Conin</title>
<style type="text/css">
  a.ovalbutton{
background: transparent url('../Imagenes/oval-gray-left.gif') no-repeat top left;
display: block;
float: left;
font: normal 13px Tahoma; /* Change 13px as desired */
line-height: 16px; /* This value + 4px + 4px (top and bottom padding of SPAN) must equal height of button background (default is 24px) */
height: 24px; /* Height of button background height */
padding-left: 11px; /* Width of left menu image */
text-decoration: none;
}

a:link.ovalbutton, a:visited.ovalbutton, a:active.ovalbutton{
color: #494949; /*button text color*/
}

a.ovalbutton span{
background: transparent url('../Imagenes	/oval-gray-right.gif') no-repeat top right;
display: block;
padding: 4px 11px 4px 0; /*Set 11px below to match value of 'padding-left' value above*/
}

a.ovalbutton:hover{ /* Hover state CSS */
background-position: bottom left;
}

a.ovalbutton:hover span{ /* Hover state CSS */
background-position: bottom right;
color: black;
}

.buttonwrapper{ /* Container you can use to surround a CSS button to clear float */
overflow: hidden; /*See: http://www.quirksmode.org/css/clearing.html */
width: 100%;
}
			   
			   </style>
<?php
require("configuraciones.php");
conectar();
//echo print_r($_POST);
$Datos="Select * from Meseros Where id=".$_POST['q'];
$DM=mysql_query($Datos);
$m=mysql_fetch_array($DM);
$Conf="Select * from Configuraciones Where descripcion='".$m['tipo']."'";
$C=mysql_query($Conf);
$Config=mysql_fetch_array($C);

$puntos=$Config['puntos'] * $m['neventos'];
echo "
<div align='center'>
	
 	 	
	<a class= 'ovalbutton' href='Modificaciones_Generales.php?id=".$_POST['q']."'><span>ELIMINAR</span></a>
	<a class= 'ovalbutton' href='modificaME.php?numero=".$_POST['q']."'><span>MODIFICAR</span></a>
    <a class= 'ovalbutton' href='PDF_Informacion_Mesero.php?numero=".$_POST['q']."' target='_black'><span>IMPRIMIR</span></a>
    <a class= 'ovalbutton' href='Reajuste_Puntos.php?numero=".$_POST['q']."'><span>REAJUSTE DE PUNTOS</span></a>

 </div>
 <br>
<div align='center'>
	<label><b>Datos Personales</b></label>
	<br>
		<label><b>Nombre: </b></label>&nbsp&nbsp&nbsp<font color='#000099'><b>".$m['nombre']." ".$m['ap']." ".$m['am']."</b></font><br>
		<label><b>Telefonos: </b></label>&nbsp&nbsp&nbsp<font color='#000099'><b>".$m['telefono']." & ".$m['celular']."</b></font><br>
		<label><b>Correo Electronico: </b></label>&nbsp&nbsp&nbsp<font color='#000099'><b>".$m['correo']."</b></font><br>		
		<label><b>Tipo: </b></label>&nbsp&nbsp&nbsp<font color='#000099'><b>".$m['tipo']."</b></font><br>
		<label><b>Nº de Eventos: </b></label>&nbsp&nbsp&nbsp<font color='#000099'><b>".$m['neventos']."</b></font>&nbsp&nbsp&nbsp
		<label><b>Puntos: </b></label>&nbsp&nbsp&nbsp<font color='#000099'><b>".$puntos."</b></font><br>
		<label><b>Reajuste de Puntos: </b></label>&nbsp&nbsp&nbsp<font color='#000099'><b>".$m['reajuste']."</b></font>
		<label><b>Premio de Lealtad: </b></label>&nbsp&nbsp&nbsp<font color='#000099'><b>".($puntos+$m['reajuste'])."</b></font>

		<br>
		<label><b>Comentarios</b></label>
		
		<table>";
			$porciones = explode(",", $m['comentarios2']);
			for ($i = 0; $i <= count($porciones); $i++) 
			{
			    echo "<tr>	
				<td><label>".$porciones[$i]."</label></td></tr>";
			}
			echo "
		</table>
</div>	
	";
?>
</head></html>
			<!--<img src="jquery/jquery-mark-dark.gif" alt="jquery" /> -->

			