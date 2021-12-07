<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
error_reporting(0);
session_start();
	require "configuraciones.php";
	conectar();
date_default_timezone_set('America/Mexico_City');
	
	if($_SESSION['niv']=='')
	{
		?>
		<script type="text/javascript">
			window.location="http:../login.php";
		</script>
        <?php
		
	}	

$nivel=$_SESSION['niv'];
	if ($nivel==2||$nivel==5) 
	{	
		menunivel3();
	}
	else
	{
	menuconfiguracion();		
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
$Ultima_fecha_confimada=mysql_query("SELECT * FROM Configuraciones WHERE nombre='Fecha de LLamadas de MEseros' ");
$ultima=mysql_fetch_Array($Ultima_fecha_confimada);
        

?>
<!--ESTILO CUERPO-->
<div align="center"  >
<br  style="background-position:center"/ >
   <!-- Tabala Pre-Registro -->
   <h1>MESEROS</h1>
   
   
 <div id="formulario" align="center"> 

   
  </div>
   
   <br />
    <?php
       //echo $ultima['descripcion'];     
       if ($ultima['descripcion']!=date("Y-m-d"))
       {
	       	if ($nivel==3) 
	       	{
	       	      
	                echo '
 	 				<input type="button" name="Guardar LLamadas" value="Guardar llamadas" onclick="confirma_guarda();" class="button">
	                ';
	       	}      
	       	else
	       	{
	       			echo ' 
	       			 <input type="button" name="Confirmar Llamadas" value="Confirmar LLamadas" onclick="confirma_envio();" class="button">
 	 				<input type="button" name="Guardar LLamadas" value="Guardar llamadas" onclick="confirma_guarda();" class="button">
	             ';
	       	}
	 			
	       }
         			
 	 ?>		
 	
   <form method="post" action="Meseros_Gurada_Confirma.php" name="formulario" id="formulario">      
   <input type="hidden" name="tipo" id='tipo'>
   		<table border="6" bordercolor="#990000" style="background-color:#FFF" class="table1">
   		    <thead>

        	<tr>
            	<td align="center"><b>NOMBRE</b></td>               
                <td align="center"><b>COMENTARIOS</b></td>
                <td align="center"><b>LLAMADA</b></td>
                <td align="center"><b>FECHA INGRESO</b></td>
                <td align="center"><b># LLAMADAS</b></td>
                <td align="center"><b># EVENTOS</b></td>      
                 <td align="center"><b>DETALLE</b></td>               
                                                           
            </tr>
             </thead>
             <tbody>
            <tr>
   	         	<?php
            	$ORDEN=OrdenaMeseros();
					 $selecM="Select * from Meseros Group by ".$ORDEN;
					$M=mysql_query($selecM) or die( mysql_error());
					$var=0;
					while($Mm=mysql_fetch_array($M))
					{
						echo "
						<th colspan=7><b>".$Mm['tipo']."</b></th>
						";
						$r="SELECT * FROM `Meseros` where tipo='".$Mm['tipo']."' order by ap,am,nombre";
						$Mt=mysql_query($r) or die( mysql_error());
						
						while($Me=mysql_fetch_array($Mt))
						{
							
							echo "
								<tr>
									<td align='center'><b>".$Me['ap']." ".$Me['am']." ".$Me['nombre']."</b></td>									
									<td align='center'><textarea  name='comentario-".$var."' onchange='comentarios(this.value,".$Me['id'].")' width=10px >".$Me['comentarios']."</textarea></td>
								";
								if($Me['nivel']=="1")	
								{
									echo "<td align='center' bgcolor='#00FF00'><input type='checkbox' name='".$var."' value='".$Me['id']."' checked /></td>";
								}
								else
								{
									echo "<td align='center' bgcolor='#00FF00'><input type='checkbox' name='".$var."' value='".$Me['id']."' /></td>";
								}

								echo " 
									<td align='center'><b>".$Me['fechaingreso']."</b></td>									
									<td align='center'><b>".$Me['porcentaje']."</b></td>									
									<td align='center'><b>".$Me['neventos']."</b></td>									

								<td><input type='button' value='Detalles' class='button' data-type='zoomin' onclick='load(".$Me['id'].")' /></td>            
					
											</tr>
								
							";
							$var++;
						}
					}
		
                ?>
            </tr>
            </tbody>

	    </table>
        
       
   </form>
   <input  type='hidden' name='numero' value=""/>
  <!-- Pie de PAgina -->
  <div id='consulta'></div>
</body>

<script language="javascript">
function load(str)
{ 
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
function redireccionar(){
  window.locationf="http:Insert_Meseros.php";
} 
function comentarios(value, id)
{
	//alert(value);
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
    document.getElementById("consulta").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","comentario_mesero.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("comentario="+value+"&numero="+id);
}

function confirma_envio()
{
	if(confirm("ESTA COMPLETAMENTE SEGURO DE CONFIRMAR LAS LLAMADAS DE LOS MESEROS.?"))
	{	
		document.getElementById('tipo').value="Confirmar LLamada";
			document.formulario.submit();						
	} 
				
}
function confirma_guarda()
{	
		document.getElementById('tipo').value="Guardar";
			document.formulario.submit();									
}

</script>
  </div>
	<div class="overlay-container" style="width:100%">
		<div class="window-container zoomin">
			<h3>Informacion del Mesero</h3> 
			<br>
			<div id='dialog' style="width:500px;height:300px;line-height:3em;overflow:auto;padding:5px;">

			
			</div>
			<br/>
			<span class="close" class="button">Cerrar</span>
		</div>
		
	</div>
	
	
	<script>!window.jQuery && document.write(unescape('%3Cscript src="pop/jquery-1.7.1.min.js"%3E%3C/script%3E'))</script>
	<script type="text/javascript" src="pop/demo.js"></script>
	
<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 3.0 </b></MARQUEE><br />copyright - 2014 Powered By MBR soluciones </div>

</body>
</html>