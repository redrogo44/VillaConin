<?php
	require 'funciones.php';
	conectar();
?>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Inventario Villa Conin</title>
		<link rel="shortcut icon" href="../Imagenes/icono.png">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
		<script type="text/javascript" src='js/jquery-2.1.1.js'></script>
		<script type="text/javascript" src='js/jquery-ui.min.js'></script>
		<script language="javascript" type="text/javascript"></script>
		<script>
$(function()
{
    $("#add").click(function()
    {
        mover("origen", "destino");
    }); 
    
    $("#remove").click(function()
    {
        mover("destino","origen");
    });  

	/////////segundo bloque
	$("#add2").click(function()
    {
        mover("destino", "origen2");
    }); 
    
    $("#remove2").click(function()
    {
        mover("origen2","destino");
    });  
	/////////tercer bloque
	$("#add3").click(function()
    {
        mover("origen2", "destino2");
    }); 
    
    $("#remove3").click(function()
    {
        mover("destino2","origen2");
    }); 
	/////////cuarto bloque
	$("#add4").click(function()
    {
        mover("destino2", "gp");
    }); 
    
    $("#remove4").click(function()
    {
        mover("gp","destino2");
    }); 
});

function mover(origen, destino)
{
    $("#" + origen + " option:selected").remove().appendTo("#" + destino);
}


function guardar(){
	if(confirm("Esta seguro en realizar la actualizacion?")){
		///////GASTOS ACTIVO
		var x = document.getElementById("destino");
		var txt = "";
		var i;
		for (i = 0; i < x.length; i++) {
		txt = txt + x.options[i].value+",";
		}
		//////INSUMOS
		var x2 = document.getElementById("origen");
		var txt2 = "";
		var i2;
		for (i2 = 0; i2 < x2.length; i2++) {
		txt2 = txt2 + x2.options[i2].value+",";
		}
		//////GASTOS OPERATIVO
		var x3 = document.getElementById("origen2");
		var txt3 = "";
		var i3;
		for (i3 = 0; i3 < x3.length; i3++) {
		txt3 = txt3 + x3.options[i3].value+",";
		}
		//////GASTOS INVERSION
		var x4 = document.getElementById("destino2");
		var txt4 = "";
		var i4;
		for (i4 = 0; i4 < x4.length; i4++) {
		txt4 = txt4 + x4.options[i4].value+",";
		}
		//////GASTOS PERSONALES
		var x5 = document.getElementById("gp");
		var txt5 = "";
		var i5;
		for (i5 = 0; i5 < x5.length; i5++) {
		txt5 = txt5 + x5.options[i5].value+",";
		}
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
			document.getElementById("resultado").innerHTML=xmlhttp.responseText;
			window.opener.location.reload();
			window.close();
			}
		  }
		xmlhttp.open("POST","asignar_gastos.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("ids="+txt+"&ids2="+txt2+"&ids3="+txt3+"&ids4="+txt4+"&ids5="+txt5); 
	}
}
</script>
	</head>
	<body style="color:#fff;">
	Coloca en la columna correspondiente cada categoria según su tipo<br>
<table>
    <tr>
        <td align='center'><h2>INSUMOS</h2>
            <select id="origen" multiple="multiple" size="10">
               <?php
				$r=mysql_query("select * from categoria where tipo like '%insumo%'");
				while($m=mysql_fetch_array($r)){
					echo "<option value='".$m['id_categoria']."'>".$m['nombre']."</option>";
				}
			   ?>
            </select>
        </td>
        <td>
            <input type="button" id="add" value=">" /><br />
            <input type="button" id="remove" value="<" />
        </td>
        <td align='center'><h2>GASTOS ACTIVO</h2>
            <select id="destino" size="10">
                 <?php
				$r2=mysql_query("select * from categoria where tipo  like '%activo%'");
				while($m2=mysql_fetch_array($r2)){
					echo "<option value='".$m2['id_categoria']."'>".$m2['nombre']."</option>";
				}
			   ?>
            </select>
        </td>
		<td>
            <input type="button" id="add2" value=">" /><br />
            <input type="button" id="remove2" value="<" />
        </td>
		 <td align='center'><h2>GASTOS OPERATIVO</h2>
            <select id="origen2" size="10">
                 <?php
				$r2=mysql_query("select * from categoria where tipo  like '%operativo%'");
				while($m2=mysql_fetch_array($r2)){
					echo "<option value='".$m2['id_categoria']."'>".$m2['nombre']."</option>";
				}
			   ?>
            </select>
        </td>
		<td>
            <input type="button" id="add3" value=">" /><br />
            <input type="button" id="remove3" value="<" />
        </td>
		 <td align='center'><h2>GASTOS INVERSION</h2>
            <select id="destino2" size="10">
                 <?php
				$r2=mysql_query("select * from categoria where tipo like '%inversion%'");
				while($m2=mysql_fetch_array($r2)){
					echo "<option value='".$m2['id_categoria']."'>".$m2['nombre']."</option>";
				}
			   ?>
            </select>
        </td>
		<td>
            <input type="button" id="add4" value=">" /><br />
            <input type="button" id="remove4" value="<" />
        </td>
		 <td align='center'><h2>GASTOS PERSONALES</h2>
            <select id="gp" size="10">
                 <?php
				$r2=mysql_query("select * from categoria where tipo like '%personal%'");
				while($m2=mysql_fetch_array($r2)){
					echo "<option value='".$m2['id_categoria']."'>".$m2['nombre']."</option>";
				}
			   ?>
            </select>
        </td>
    </tr>
		<td colspan='9' align='center'><br><br>
			<button onclick="guardar()">GUARDAR CAMBIOS</button>
		</td>
	<tr>
	</tr>
</table>
		
		<!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
		
		<DIV id='resultado'>
		</DIV>
	</body>
</html>