<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
error_reporting(0);
session_start();
	require "configuraciones.php";
	conectar();
	validarsesion();
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

$Con=mysql_query("SELECT * FROM Confirmacion_Eventos WHERE id=".$_GET['id']);
$Contr=mysql_fetch_array($Con);
$Contrato=$Contr['Contratos'];
$Meser_Cont=mysql_query("SELECT Meseros FROM contrato WHERE Numero='".$Contrato."'");
if (mysql_num_rows($Meser_Cont)<1) 
{
	$d=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$Contrato."'");
	if (mysql_num_rows($d)<1) 
	{
		$mxmx=mysql_fetch_array(mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$Contrato."' "));
	}
	else{	$mxmx=mysql_fetch_array($d);	}

}
else
{
$mxmx=mysql_fetch_array($Meser_Cont);
}
$Contra_Mese=$mxmx['Meseros'];
$Meseros_x=explode(',',$Contra_Mese);

$Conf=mysql_query("SELECT * FROM Configuraciones");
$MES=mysql_query("SELECT * FROM Meseros");
$Cantidad_Meseros=mysql_num_rows($MES);


$Cantidad_Acumulada=0;
?>
<!--ESTILO CUERPO-->
<div align="center"  >
<br  style="background-position:center"/ >
   <!-- Tabala Pre-Registro -->
   <h1><font color="#0088E9">CONFIRMACION DE ASISTENCIA <br> CONTRATO</font> <font color="#BF0505"> <?PHP echo($Contrato);?></font></h1>
   
   
   <br>
   <br />
   <form method="post" action="CargaM.php" target="_black">
       <?php       	 			
	                echo'<input type="submit" value="Confirmar Asistencias"   name="tipo" class="button"/>
					     <input  type="hidden" name="ncHECK" value="'.$Cantidad_Meseros.'"/>
					     <input  type="hidden" name="idEvento" value="'.$_GET['id'].'"/>';
 	 ?>		
   <br />
   <br />

 	 <div align="center">
 	 <label>ACUMULADO DE NOMINA: </label><h2><b><font id='TotalAcumulado' color="#FF0000"></font></b></h2>
 	 </div>
   <br />
 	 	<div style='overflow:auto;whidth:300px; height:400px; padding:0' align='center'>
 	 	<table border="6" bordercolor="#990000" style="background-color:#FFF" class="table1">
   		    <thead>

        	<tr>
            	<td align="center"><b>NOMBRE</b></td>               
                <td align="center"><b>COMENTARIOS</b></td>
                <td align="center"><b>ASISTIO</b></td>                                                                                          
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
						<th colspan=3><b>".$Mm['tipo']."</b></th>
						";
						$r="SELECT * FROM `Meseros` where tipo='".$Mm['tipo']."' order by ap,am,nombre"	;
						$Mt=mysql_query($r) or die( mysql_error());
						
						while($Me=mysql_fetch_array($Mt))
						{
							$ic=mysql_query("SELECT * FROM Configuraciones WHERE descripcion='".$Me['tipo']."'");
							$idc=mysql_fetch_array($ic);
							echo "
								<tr>
									<td align='center'><b>".$Me['ap']." ".$Me['am']." ".$Me['nombre']."</b></td>									
									<td align='center'><textarea  name='comentario-".$var."' onchange='comentarios(this.value,".$Me['id'].")' width=10px ></textarea></td>
								";
								
								for ($q=0; $q < count($Meseros_x); $q++) 
								{ 
									//echo " Meseros ".$Me['id']." ----- ".$Meseros_x[$q];
									if($Me['id']===$Meseros_x[$q])	
									{
										$existe=1;									
									}
											
								}
								//echo "<br>Existe ".$existe." -- ".$Me['id'];
								if($existe==1)	
									{
										echo "<td align='center' bgcolor='#00FF00'><input type='checkbox' id='".$var."' name='".$var."' value='".$Me['id']."-".$idc['id']."-".$idc['valor']."-".$idc['puntos']."' checked  onchange='Calcula()'/></td>";
									}
									else
									{
										echo "<td align='center' bgcolor='#00FF00'><input type='checkbox' id='".$var."' name='".$var."' value='".$Me['id']."-".$idc['id']."-".$idc['valor']."-".$idc['puntos']."' onchange='Calcula()' /></td>";
									}	
										$existe=0;									
								echo "</tr>";							
							$var++;
						}
					}
		
                ?>
            </tr>
            </tbody>
	    </table>
    </div>               


   </form>
  <!-- Pie de PAgina -->
  <div id='consulta'></div>
</body>
<?php 
if($re){
    header('Location: index.php');
}
?>
<script language="javascript">
 setTimeout( "Calcula()", 100 );
function Calcula()
{
	var NM=<?php echo $Cantidad_Meseros;  $_SESSION['pun']=0;?> 
		//alert('c m'+NM);
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
//document.getElementById("TotalAcumulado").innerHTML=xmlhttp.responseText;
				    }
				  }
					xmlhttp.open("POST","Puntos.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("numero="+mesee+"&op=1");

	for (i = 0; i <NM; i++) 
	{
			if(document.getElementById(i).checked)
			{
				var Mese=document.getElementById(i).value;
				//alert(Mese);
				mes=Mese.split('-');
				//alert(mes[0]);
				var mesee=mes[0];

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
				    	document.getElementById("TotalAcumulado").innerHTML=xmlhttp.responseText;
				    }
				  }
					xmlhttp.open("POST","Puntos.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("numero="+mesee+"&op=2");										 			
			}
	}
}

function Punto2(){
	return 1;
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
	xmlhttp.open("POST","comentarios2.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("comentario="+value+"&numero="+id);
}
</script>
	
	<script>!window.jQuery && document.write(unescape('%3Cscript src="pop/jquery-1.7.1.min.js"%3E%3C/script%3E'))</script>
	<script type="text/javascript" src="pop/demo.js"></script>
	
<?php pie();?>
</body>
</html>