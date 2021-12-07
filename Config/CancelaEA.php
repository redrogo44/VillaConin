<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
require 'configuraciones.php';
validarsesion();
$nivel=$_SESSION['niv'];

menuconfiguracion();


?>
 
 <title>Villa Conin</title>
<head> 
<script type="text/javascript" src="../js/shortcut.js"></script>
</head> 
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
				right:-142px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
	
</body>
<!-- CUERPO DEL WEB-->
    <link rel="stylesheet" href="../tablas.css" type="text/css"/>	

<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<?php
$usuario=$_SESSION['usu'];
echo      "<br/><br/><br/><br><div style = 'width: 500px;
    padding-left: 200px; height30px; align=center;'>&nbsp&nbsp&nbsp usuario:  ".$usuario."</div>";
?>


<!--ESTILO CUERPO-->


<div align="center">
	<br /><br /><br  style="background-position:center"/>
	<p><b><h2>Cancelacion de Contratos</h2></b></p>

    <script>alert("TENGA EN CUENTA QUE AL CANCELAR UN EVENTO ADICIONAL, ESTE SE ELIMINARA DEL SISTEMA Y NO PODRA RECUPERARSE..")</script>
    <div class="wrapper wrapper-style4">
	<script>
shortcut.add("Ctrl+Alt+S",function() {
document.getElementById('no_facturados').style.display='none';
});

shortcut.add("Ctrl+Alt+N",function() {
document.getElementById('no_facturados').style.display='block';
});
</script>
<br><br>
		<div class="wrapper">
			<table>
		<tr>
			<td align="center">Numero</td>
			<td align="center">Fecha</td>
			<td align="center">Tipo</td>
			<td align="center">Contrato Referencia</td>
			<td align="center">Salon</td>
			<td align="center">Comensales</td>
			<td align="center">ELIMINAR</td>
		</tr>
		<?php 
			// EVENTOS ADICIONALES
			$us=mysql_query("SELECT * FROM Eventos_Adicionales where Meseros='XX' order by Fecha");
			while($E=mysql_fetch_array($us))
			{ $totalc=$E['c_adultos']+$E['c_jovenes']+$E['c_ninos'];
				echo"
						<tr>
							<td >".$E['Numero']."</td>
							<td >".$E['Fecha']."</td>
							<td >".$E['tipo']."</td>
							<td align='center'>".$E['Contrato_Referencia']."</td>
							<td >".$E['salon']."</td>
							<td align='center'>Adultos = ".$E['c_adultos']."<br>Jovenes = ".$E['c_jovenes']."<br>Niños = ".$E['c_ninos']."<br>Total = ".$totalc."</td>
							<td ><input type='button' value='ELIMINAR' OnClick='confirma(".$E['id'].")'/></td>

						</tr>
					";

			}
		?>

	</table>
			
		</div>
	
</body>
<script>

function confirma(id)
{
	//alert(id);
	var txt;
		var r = confirm("ESTA COMPLETAMENTE SEGURA DE ELIMINAR ESTE EVENTO...!");
		if (r == true) 
		{
				
			//alert('salon 2 '+ sal);
				var xmlhttp3;
						if (window.XMLHttpRequest)
						  {// code for IE7+, Firefox, Chrome, Opera, Safari
						  xmlhttp3=new XMLHttpRequest();
						  }
						else
						  {// code for IE6, IE5
						  xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");
						  }
							xmlhttp3.onreadystatechange=function()
						  {
						  if (xmlhttp3.readyState==4 && xmlhttp3.status==200)
						    {
						    	var xxzz=xmlhttp3.responseText;	
						    	alert(xxzz);	
						    	location.href="CancelaEA.php";

						    }
						  }				  
							xmlhttp3.open("POST","elimnaEA.php",true);
							xmlhttp3.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							xmlhttp3.send("id="+id);
		} else 
		{
		 
		}
}
</script>
</html>
