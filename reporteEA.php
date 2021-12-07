<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require 'funciones2.php';
validarsesion();
$nivel=$_SESSION['niv'];
libera_manteles();
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
<script type="text/javascript" src="Config/jquery-2.1.1.min.js"></script>

<title>Villa Conin</title>
    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:900px;
				  right:1000px;
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
				right:-80%;
				top:10px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				.nav ul li ul li ul{
				right:-90%;
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
       
<script type="text/javascript">
function mostrar(id) 
{
	//alert(id);
	if (id== 1) 
	{
		$("#activos").show();
		$("#cancelados").hide();
		$("#finalizados").hide();
		$("#Seleccione").hide();
		
	}
	
	if (id == 2) {
		$("#activos").hide();
		$("#cancelados").hide();
		$("#finalizados").show();
		$("#Seleccione").hide();
		
	}
	if (id == 3) {
		$("#activos").hide();
		$("#cancelados").show();
		$("#finalizados").hide();
		$("#Seleccione").hide();
	}
	if (id == 4) {
		$("#activos").hide();
		$("#cancelados").hide();
		$("#finalizados").hide();
		$("#Seleccione").show();
	}		
}
function redireccionar()
{
		window.location="http:index.php";  
} 
</script>
    <link rel="stylesheet" href="tablas.css" type="text/css"/>	

</head>


<!-- CUERPO DEL WEB-->
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >


<div align="center">
<br><br>
<?php
$usuario=$_SESSION['usu'];
echo      "<b>&nbsp&nbsp&nbsp usuario:  ".$usuario."</b>";
?>
</div>

<br><br>

<div align="center">
	Seleccione el Tipo de Evento: 
     <select id="status" name="status" onChange="mostrar(this.value);">
     <option value='4'  >Seleccione una Opción</option>
     <option value='1'  >Activos</option>
     <option value='2'  >Finalizados</option>
     <option value='3'  >Cancelados</option>
     </select>
<br><br>

<div id="activos" class="element" style="display: none;">
	<table>
		<tr>
			<td align="center">Numero</td>
			<td align="center">Fecha</td>
			<td align="center">Tipo</td>
			<td align="center">Contrato Referencia</td>
			<td align="center">Salon</td>
			<td align="center">Comensales</td>
		</tr>
		<?php 
			// EVENTOS ADICIONALES
			$us=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Meseros='XX' order by Fecha");
			while($E=mysql_fetch_array($us))
			{ $totalc=$E['c_adultos']+$E['c_jovenes']+$E['c_ninos'];
				echo"
						<tr>
							<td >".$E['Numero']."</td>
							<td >".$E['Fecha']."</td>
							<td >".$E['tipo']."</td>
							<td align='center'>".$E['Contrato_Referencia']."</td>
							<td align='center'>".$E['salon']."</td>
							<td >Adultos = ".$E['c_adultos']."<br>Jovenes = ".$E['c_jovenes']."<br>Niños = ".$E['c_ninos']."<br>Total = ".$totalc."</td>
						</tr>
					";
			}
		?>
	</table>

</div>

<div id="finalizados" class="element" style="display: none;">
<table>
		<tr>
			<td align="center">Numero</td>
			<td align="center">Fecha</td>
			<td align="center">Tipo</td>
			<td align="center">Contrato Referencia</td>
			<td align="center">Salon</td>
			<td align="center">Comensales</td>
		</tr>
		<?php 
			// EVENTOS ADICIONALES
			$us=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Meseros!='XX' order by Fecha");
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
						</tr>
					";
			}
		?>
	</table>

</div>
<div id="cancelados" class="element" style="display: none;">
<table>
		<tr>
			<td align="center">Numero</td>
			<td align="center">Fecha</td>
			<td align="center">Tipo</td>
			<td align="center">Contrato Referencia</td>
			<td align="center">Salon</td>
			<td align="center">Comensales</td>
		</tr>
		<?php 
			// EVENTOS ADICIONALES
			$us=mysql_query("SELECT * FROM Cancelacion_Eventos_Adicionales order by Fecha");
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
						</tr>
					";
			}
		?>
	</table>

</div>
<div id="Seleccione" class="element" style="display: none;">
<br><br>

     <h1><font color="#003366"><b>Seleccione una Opción</b></font></h1>
</div>


</div>
<?php
/////
pie();
?>
</body>
</html>
