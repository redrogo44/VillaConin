<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
error_reporting(0);
session_start();	
	require "configuraciones.php";
	validarsesion();
	conectar();
	$nivel=$_SESSION['niv'];
if ($nivel==3) 
	{	
	menunivel3();
	}
	else
	{
	menuconfiguracion();		
	}
	/*$PO="Select * from Meseros ";
	$PP=mysql_query($PO);
	while($m=mysql_fetch_array($PP))
	{
		echo $M="select to_days('".date("Y-m-d")."') - to_days('".$m['fechaingreso']."') as ndias ";
		$MM=mysql_fetch_array(mysql_query($M));
		
		$porcentage=($m['neventos']/$MM['ndias'])*100;
		$PORC=round($porcentage);
	 echo "<br>".$PU="UPDATE `Meseros` SET `porcentaje`='".$PORC."' WHERE id=".$m['id'];
	mysql_query($PU);
	}
	*/
	
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
				/* .pie {position:fixed;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;}  */
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
</head>
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<br />
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

$conscon=mysql_query("SELECT * from Confirmacion_Eventos");
$numero=mysql_num_rows($cons);
$CONT = explode(",", $cons['Contratos']);
$numeroSemana = $CONT['Semana'];
?>
<!--ESTILO CUERPO-->
<div align="center"  >
<br /><br /><br  style="background-position:center"/ >
   <!-- Tabala Pre-Registro -->
   <?php if (mysql_num_rows($conscon)>0)
   		{
   			echo "<h1>EXISTEN EVENTOS SIN CONFIRMACION DE ASISTENCIA</h1>";
   		} 
   		else
   		{
   			echo "<h1>NO EXISTEN EVENTOS</h1> ";
   		}
   ?>
   <br />
   <font color="#001AFF"><b>SELECCIONE UNA SEMANA</a></b></font>
   <br />
   <br /><br />

   	<table>
   	<tr>
   		<td align="center"><b>Semana</b></td>
   		<td align="center"><b>Eventos</b></td>
   		<td align="center"><b>Confirmar Asistencia</b></td>
   	</tr>
   	<tr>
   		<?php
   			while ($cons=mysql_fetch_array($conscon)) 
   			{
   				echo "
   						<tr>
   							<td align='center'><b>".$cons['Semana']."</b></td>
   							<td align='center'><b>".$cons['Contratos']."</b></td>
   							<td align='center'><a href='AsistioMesero.php?id=".$cons['id']."'>Confirmar Asistenciacia</a></td>

   						</tr>
   					 ";
   			}
   		?>
   	</tr>
   		
   	</table>


  
 </div>
  <!-- Pie de PAgina -->
		  <script>
		function activar(formulario){
		 if(document.newregist.tipo.value != "Seleccione una opcion" && document.newregist.medio.value!="Seleccione una opcion") 
		document.newregist.but.disabled = false 
		else 
		document.newregist.but.disabled = true 
		}
		function confirma()
		{
		 <?php 
		 	for($i=0;$i<count($_POST);$i++)
			{
			 	$up="UPDATE `Meseros` SET `confirmacion`='si' WHERE id=".$_POST[$i];
				mysql_query($up);
			}
		 ?>
		 alert('SE HAN CARGADO LOS MESEROS RE-CONFIRMADOS A LOS EVENTOS DE LA SEMANA ');
		setTimeout ("cerrar()", 300); //tiempo expresado en milisegundos

		}
		function  cerrar()
		{
			window.location.href="ConfiguracionSistema.php";	
		}
		</script>	
</body>
</html>
