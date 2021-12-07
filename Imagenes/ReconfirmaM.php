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
<!-<link rel="stylesheet" href="../subcontratos.css" type="text/css" /> 
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
?>
<!--ESTILO CUERPO-->
<div align="center"  >
<br  style="background-position:center"/ >
   <!-- Tabala Pre-Registro -->
   <h1><font color="#6B00FF"><b> PROYECCION DE EVENTOS </b></font></h1>
   <br><br>
<h3><font color="#D70CFF"><b>SELECCIONE UN RANGO DE FECHAS</b></font></h3><br>
<form action="" method="post">
<font color="#016406"><b>DE </b></font>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="date" name="fecha1">
&nbsp;&nbsp;&nbsp;&nbsp;
<font color="#DA0000"><b>HASTA</b></font>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="date" name="fecha2">
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" value="BUSCAR" name='submit'> 
<br>
</form></div>
  <div class="wrapper" align="center">
  
 
<?php
$Array_Contratos;
	if (isset($_POST['submit'])) 
	{	$Conf=mysql_query("SELECT * FROM Configuraciones where id=12");
		$existe=mysql_fetch_array($Conf);
		if (empty($existe['nombre'])||$existe['nombre']=='') 
		{
			$Ara='SELECT * FROM contrato WHERE Fecha >= "'.$_POST['fecha1'].'" AND Fecha <= "'.$_POST['fecha2'].'" AND estatus=1 ORDER BY Fecha';
			$Fec=mysql_query($Ara);
			while ($Fecas=mysql_fetch_array($Fec)) 
			{
				if (empty($Fecas['Meseros']))
				{
					if(empty($Array_Contratos)&&(strlen($Fecas['Numero']))<9)
					{
						$Array_Contratos=$Fecas['Numero'];
					}
					else if(strlen($Fecas['Numero'])<9)
					{
						$Array_Contratos=$Array_Contratos.",".$Fecas['Numero'];
					//	echo $Fecas['Numero']."<br>";
					}
				}			
			}
		}		
		else
		{
			$Array_Contratos=$existe['nombre'];
			$che=explode(",",$existe['descripcion']);
			for ($i=0; $i < count($che); $i++) 
			{ 
				$che[$i]."<br>";
			}
		}	
	
		$array =explode(",", $Array_Contratos);
		echo
		"<br>
		<form method='post'  action='proyeccion.php' target='_blank'>
	<input type='submit' value='Cancelar_Proyeccion' name='tipo' class='button' onclick='cancela()'/>           
 	<input type='submit' value='Confirmar_Proyeccion' name='tipo' class='button' onclick='confirma()'/>           
 	<input type='submit' value='Guardar_Proyeccion'  name='tipo' class='button' onclick='guarda()'/>           

	<br><br>
				<table border=6 border-color='#640404' background-color='fff'>
					<tr>                
	                <td bgcolor='#B1F7FB'><b>No. CONTRATO</b></td>
	                <td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>
	               ";	        
	               $array;$ElArray;
	               if (empty($existe['nombre'])||$existe['nombre'=='']) 
	               {
	                echo $num_rows = mysql_num_rows($Fec);
						               
	               }
	               else
	               {
	                echo $num_rows = count($che);
	               }
	                //echo "Numero del Array".$num_rows;
	                for ($i=0; $i < count($array); $i++) 
	                {	        								
							echo "<td style='color:#0015FF' align='center'><b>".$array[$i]."</b></td>";							
					}
					
				echo"</tr>
					 <tr>
					 	<td bgcolor='#B1F7FB'><b>EVENTO</b></td>
                		 <td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>";                
                		 for ($i=0; $i <count($array); $i++) 
	               		 {	  
							$T="Select * from contrato Where Numero='".$array[$i]."'";
							$TT=mysql_query($T);
							$TIPO=mysql_fetch_array($TT);							
							echo "<td style='color:#0015FF' align='center'><b>".utf8_encode($TIPO['tipo'])	."</b></td>";
						}
   				echo"</tr>
   				 	<tr>
   				 		<td bgcolor='#B1F7FB'><b>COMENSALES</b></td>
               			<td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>";
                		 for ($i=0; $i < count($array); $i++) 
	               		 {	  
							$C="Select * from contrato Where Numero='".$array[$i]."'";
							$Czz=mysql_fetch_array(mysql_query($C));
							$total=$Czz['c_adultos']+$zz['c_jovenes']+$zz['c_ninos'];
							echo "<td style='color:#0015FF' align='center'><b>".$total."</b></td>";
						 }
                echo"</tr>
                	 <tr>
                	 	<td bgcolor='#B1F7FB'><b>SALON</b></td>
                		<td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>";
   						 for ($i=0; $i < count($array); $i++) 
	               		 {	  
							$S="Select * from contrato Where Numero='".$array[$i]."'";
							$zzS=mysql_fetch_array(mysql_query($S));
							echo "<td style='color:#0015FF' align='center'><b>".$zzS['salon']."</b></td>";
						}
               echo "</tr>
              		 <tr>
              		 	<td bgcolor='#B1F7FB'><b>DIA</b></td>
               		<td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>";

   						 for ($i=0; $i < count($array); $i++) 
	               		 {	  
							$Z="Select * from contrato Where Numero='".$array[$i]."'";
							$zz=mysql_fetch_array(mysql_query($Z));
							$ex=explode("-",$zz['Fecha']);
		 
		 					$dia= date("w",mktime(0, 0, 0, $ex[1], $ex[2],$ex[0]))."<br>";// dia de la semana
							 if($dia==0)
							 {$Diaa="Domingo"; $color="#FF00D1";} // rosa mexicano
							 if($dia==1)
							 {$Diaa="Lunes"; $color="#F3FF00";} // Amarillo
							  if($dia==2)
							 {$Diaa="Martes"; $color="#FF0055";} //violeta
							  if($dia==3)
							 {$Diaa="Miercoles"; $color="#FF6600";} // naranja
							  if($dia==4)
							 {$Diaa="Jueves"; $color="#00B2D5";} // Azul
							  if($dia==5)
							 {$Diaa="Viernes"; $color="#7F8181";} // Gris
							  if($dia==6)
							 {$Diaa="Sabado"; $color="#090A0A";} // NEgro
						echo "<td style='color:#B3FF00' bgcolor=".$color." align='center'><b>".$Diaa."</b></td>";
						}
	
              echo"</tr>
              	   <tr>
              	   		<td bgcolor='#B1F7FB'> <b>FECHA</b></td>
                		<td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>
	                <td bgcolor='#FBB1B1'></td>";   						
	   						 for ($i=0; $i < count($array); $i++) 
		               		 {	  
							
							 	$Z="Select * from contrato Where Numero='".$array[$i]."'";
							 	$zz=mysql_fetch_array(mysql_query($Z));
								echo "<td style='color:#0015FF' align='center'><b>".$zz['Fecha']."</b></td>";
							}
             echo "</tr>
             			<tr>
             				<td bgcolor='#B1F7FB'><b>HORARIO DE ENTRADA</b></td>
             				<td bgcolor='#FBB1B1'></td>
	                		<td bgcolor='#FBB1B1'></td>
	                		<td bgcolor='#FBB1B1'></td>
	                		<td bgcolor='#FBB1B1'></td>
             			</tr>
        	        	<tr>
        	        		<td bgcolor='#B1F7FB'><b>HORARIO DE SALIDA</b></td>
        	        		<td bgcolor='#FBB1B1'></td>
	                		<td bgcolor='#FBB1B1'></td>
	                		<td bgcolor='#FBB1B1'></td>
	                		<td bgcolor='#FBB1B1'></td>
        	        	</tr>
                		<tr><td bgcolor='#B1F7FB'><b>PROMEDIO MESEROS</b></td>
	                	<td bgcolor='#FBB1B1'></td>
		                <td bgcolor='#FBB1B1'></td>
		                <td bgcolor='#FBB1B1'></td>
		                <td bgcolor='#FBB1B1'></td>";
                		 for ($i=0; $i < count($array); $i++) 
	               		 {	  				
							$Com=mysql_query("SELECT * FROM contrato Where Numero='".$array[$i]."'");
							$Come=mysql_fetch_array($Com);
							$TAdul=$Come['c_adultos'];
							$TJov=$Come['c_jovenes'];
							$TNin=$Come['c_ninos'];
							$total=$TAdul+$TJov+$TNin;
							$PROM=($total)/20;
								echo "<td style='color:#0015FF' align='center'><b>".$PROM."</b></td>";
						}

                		echo"</tr>                               
                		<tr></tr>";
						$Nfilas=count($array)+5;
    		      echo"  <tr>
            		    <td colspan=".$Nfilas." bgcolor='#00FFCC' align='center'><b>ASIGNACION DE MESEROS</b></td>
                		</tr>
                		<tr>
            			<td align='center' bgcolor='#CC99FF'><b>NOMBRE</b></td>
                		<td align='center' bgcolor='#FF99FF'><h6><b>SEMANAS</b></h6></td>
                		<td align='center' bgcolor='#FF99FF'><h6><b>LLAMADAS</b></h6></td>
                		<td align='center' bgcolor='#FF99FF'><h6><b>EVENTOS</b></h6></td>  
                		<td align='center' bgcolor='#12F351'><b>Comentarios</b></td>";                
				 		for ($i=0; $i < count($array); $i++) 
	               		 {	  
									
							 $Z="Select * from contrato Where Numero='".$array[$i]."'";
							 $zz=mysql_fetch_array(mysql_query($Z));
							 $ex=explode("-",$zz['Fecha']);			 
							 $dia= date("w",mktime(0, 0, 0, $ex[1], $ex[2],$ex[0]))."<br>";// dia de la semana
							 if($dia==0)
							 {$Diaa="Domingo"; $color="#FF00D1";} // rosa mexicano
					 		 if($dia==1)
					 		 {$Diaa="Lunes"; $color="#F3FF00";} // Amarillo
							  if($dia==2)
							 {$Diaa="Martes"; $color="#FF0055";} //violeta
							  if($dia==3)
							 {$Diaa="Miercoles"; $color="#FF6600";} // naranja
							  if($dia==4)
							 {$Diaa="Jueves"; $color="#00B2D5";} // Azul
							  if($dia==5)
							 {$Diaa="Viernes"; $color="#7F8181";} // Gris
							  if($dia==6)
							 {$Diaa="Sabado"; $color="#090A0A";} // NEgro
				
					
							if($dia==0){echo "<td bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$array[$i]."</b></td>";}
							if($dia==1){echo "<td bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$array[$i]."</b></td>";}
							if($dia==2){echo "<td bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$array[$i]."</b></td>";}
							if($dia==3){echo "<td bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$array[$i]."</b></td>";}
							if($dia==4){echo "<td bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$array[$i]."</b></td>";}
							if($dia==5){echo "<td bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$array[$i]."</b></td>";}
							if($dia==6){echo "<td bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$array[$i]."</b></td>";}       
							
						}
				echo"<td colspan='".$Nfilas."''></td>         
            </tr>	
            		<td colspan=".$Nfilas."></td>         
            </tr>";
			 $Mes="SELECT tipo FROM Meseros group by tipo";
			 $Mese=mysql_query($Mes);
			 $Mes2="SELECT * FROM Meseros";
			 $Mese2=mysql_query($Mes2);
			 $NMESEROS= mysql_num_rows($Mese2);
			 if(empty($existe['nombre'])||$existe['nombre']=='')
			 {
			 $NNN=$NMESEROS *($num_rows);

			 }
			 else
			 {
			 $NNN=$NMESEROS *(count($che));			 	
			 }
			 $NCheck=0; 
			 $nmeseros=0;
			 $colspan=count($CONT)+2;
			 while($Mesero=mysql_fetch_array($Mese))
			 { 
				 echo "
				 <tr>
				 		<td  colspan=".$Nfilas." align='center' style='color:#F74E9D' bgcolor='#000000' ><b>".$Mesero['tipo']."</b></td></tr>";
			 			 $MMes="Select * from Meseros Where tipo='".$Mesero['tipo']."'";
				 		 $MMese=mysql_query($MMes);					
					 		while($MMesero=mysql_fetch_array($MMese))
					 		{
					 		$semana=Dias_entre_Fechas((date("Y-m-d")),($MMesero['fechaingreso']));
					 			$semana=$semana/7;
					 			$semana=round($semana, 1, PHP_ROUND_HALF_UP);
					 		
			 			 		echo " <tr>"; 				 			 		
								 $Nombre=$MMesero['nombre']." ".$MMesero['ap']." ".$MMesero['am'];
			 						echo "
										<td align='center' >".$Nombre."</td>
										<td align='center' style='color:#FF0000'><b>".$semana."</b></td>
										<td align='center' style='color:#FF0000'><b>".$MMesero['porcentaje']."</b></td>
										<td align='center' style='color:#FF0000'><b>".$MMesero['neventos']."</b></td>										
										<td align='center' ><b>".$MMesero['comentarios']."</b></td>
									";
			 							
									 for ($i=0; $i < count($array); $i++) 
	               					 {	  $idChe=explode("-",$che[$i]);
	               						//echo $idChe[0]." ++++ ".$idChe[1];
	               							
							
										$Z="Select * from contrato Where Numero='".$array[$i]."'";
										$zz=mysql_fetch_array(mysql_query($Z));
										$ex=explode("-",$zz['Fecha']);
							 
							 			$dia= date("w",mktime(0, 0, 0, $ex[1], $ex[2],$ex[0]))."<br>";// dia de la semana
									 if($dia==0)
									 {$Diaa="Domingo"; $color="#FF00D1";} // rosa mexicano
									 if($dia==1)
									 {$Diaa="Lunes"; $color="#F3FF00";} // Amarillo
									  if($dia==2)
									 {$Diaa="Martes"; $color="#FF0055";} //violeta
									  if($dia==3)
									 {$Diaa="Miercoles"; $color="#FF6600";} // naranja
									  if($dia==4)
									 {$Diaa="Jueves"; $color="#00B2D5";} // Azul
									  if($dia==5)
									 {$Diaa="Viernes"; $color="#7F8181";} // Gris
									  if($dia==6)
										 {$Diaa="Sabado"; $color="#090A0A";} // NEgro
									if (empty($existe['nombre'])||$existe['nombre']=='') 
									{
											if($dia==0){echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."'  value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;}
											if($dia==1){echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."' value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;}
											if($dia==2){echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."' value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;}
											if($dia==3){echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."' value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;}
											if($dia==4){echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."' value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;}
											if($dia==5){echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."' value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;}
											if($dia==6){echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."' value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;}
											
									}
									else
									{
										if(($dia==1)&&($idChe[0]==$NCheck && $idChe[1]==$MMesero['id']))
										{
											echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."'  value=".$NCheck.",".$MMesero['id']."  checked /></td>"; echo $NCheck++;
										}
										else if($dia==1)
										{
											echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."'  value=".$NCheck.",".$MMesero['id']." /></td>";  $NCheck++;
										}
										if(($dia==3)&&($idChe[0]==$NCheck && $idChe[1]==$MMesero['id']))
																
										{
											echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."'  value=".$NCheck.",".$MMesero['id']."  checked /></td>"; $NCheck++;
										}
										else if($dia==2)
										{
											echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."'  value=".$NCheck.",".$MMesero['id']." /></td>";  $NCheck++;
										}
										if(($dia==3)&&($idChe[0]==$NCheck && $idChe[1]==$MMesero['id']))										
										{
											echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."'  value=".$NCheck.",".$MMesero['id']."  checked /></td>"; $NCheck++;
										}
										else if($dia==3)
										{
											echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."'  value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;
										}
										if(($dia==4)&&($idChe[0]==$NCheck && $idChe[1]==$MMesero['id']))	
										{
											echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."'  value=".$NCheck.",".$MMesero['id']."  checked /></td>";  $NCheck++;
										}
										else if($dia==4)
										{
											echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."'  value=".$NCheck.",".$MMesero['id']." /></td>";  $NCheck++;
										}
										if(($dia==5)&&($idChe[0]==$NCheck && $idChe[1]==$MMesero['id']))										
										{
											echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."'  value=".$NCheck.",".$MMesero['id']."  checked /></td>"; $NCheck++;
										}
										else if($dia==5)
										{
											echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."'  value=".$NCheck.",".$MMesero['id']." /></td>";  $NCheck++;
										}	
										if(($dia==6)&&($idChe[0]==$NCheck && $idChe[1]==$MMesero['id']))
										
										{
											echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."'  value=".$NCheck.",".$MMesero['id']."  checked /></td>"; $NCheck++;
										}
										else if($dia==6)
										{
											echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."'  value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;
										}
									}
								}
							
							echo "</tr>	";
						}
				$nmeseros++;
			}
   echo"</table>";
}
pie();

 REDIRECIONAR();
?>



 <input type="hidden" name="ncHECK" value="<?PHP echo $NNN;?>" />
 <input type="hidden" name="contratos" value="<?PHP echo $Array_Contratos;?>" />

        
</form>        
 </div>
<br>
<script type="text/javascript">
	function confirma()
	{
 		<?php 
 		if(isset($_POST)||(count($_POST)>0))
 		{
 		for($i=0;$i<count($_POST);$i++)
		{
	 		$up="UPDATE `Meseros` SET `confirmacion`='si' WHERE id=".$_POST[$i];
			mysql_query($up);
		}
		}
 		?>
 	alert('SE HAN CARGADO LOS MESEROS RE-CONFIRMADOS A LOS EVENTOS DE LA SEMANA ');
	//window.location.href="ConfiguracionSistema.php";	
	}
	
	function guarda()
	{
	window.location.href="ConfiguracionSistema.php";			
	}

</script>
</body>

</html>