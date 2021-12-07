<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
error_reporting(0);
	require "configuraciones.php";
	conectar();
	validarsesion();
	$nivel=$_SESSION['niv'];
	menuconfiguracion();
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
			 #contenedor-mains { 
			background:#bbb; 
			width:450px; 
			} 
		.uno { 
			margin: 100px 0 0 100px;
			border:2px solid #FF0100; 
			background:#fff; 
			width:20%; 
			height:40%;
			margin:10px; 
			position:absolute;
			left:0px;
			top:45%;
			overflow: scroll;
			} 
		.dos { 
			border:2px solid #FF0100; 
			background:#fff; 
			width:78%; 
			height:40%;
			margin:10px; 
			position:absolute;
			left:20%;
			top:45%;
			overflow: scroll;
			} 
		.tres { 
			border:2px solid #FF0100; 
			background:#fff; 
			width:20%; 
			height:55%;
			margin:10px; 
			position:absolute;
			left:0px;
			top:85%;
			overflow: scroll;
			} 
		.cuatro { 
			border:2px solid #FF0100; 
			background:#fff; 
			width:78%; 
			height:55%;
			margin:10px; 
			position:absolute;
			left:20%;
			top:85%;
			overflow: scroll;
			}
			
		.clear { 
			clear:both; 
			}

    </style>    
</head>
   
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF"  onload="habilitar();">
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
   <h1><font color="#6B00FF"><b> EVENTOS </b></font></h1>
   <br><br>
<h3><font color="#D70CFF"><b>SELECCIONE UN RANGO DE FECHAS</b></font></h3><br>
<form action="" method="post">
<font color="#016406"><b>DE </b></font>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="date" name="fecha1" id="fecha1" onchange='validarFecha()'  required></input>
&nbsp;&nbsp;&nbsp;&nbsp;
<font color="#DA0000"><b>HASTA</b></font>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="date" name="fecha2"  id="fecha2" min='2014-10-1' required></input>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" value="BUSCAR" name='submit' > 
<br>
</form>
</div>
<!--<input type="checkbox" id="check" onchange="habilitar();"  value='Que rollo'checked/> -->
<br><br>
  <div class="wrapper" align="center" >
  
 
<?php
$Array_Contratos;
	if (isset($_POST['submit'])) 
	{	$i=0;
		echo "<form method='post'  action='AsignarMeseros.php' target='_blank'>
		<input type='submit' value='Confirmar Asignacion'  class='button' onclick='confirma()'/>";
	$Ara='SELECT * FROM contrato WHERE Fecha >= "'.$_POST['fecha1'].'" AND Fecha <= "'.$_POST['fecha2'].'" AND estatus=1 ORDER BY Fecha';
		$Fec=mysql_query($Ara);
		while ($Fecas=mysql_fetch_array($Fec)) 
		{
			
				if(empty($Array_Contratos)&&(strlen($Fecas['Numero']))<9)
				{
					$contrato[$i][0]=$Fecas['Numero'];
					$contrato[$i][1]=$Fecas['Fecha'];
					$i++;
				}
				else if(strlen($Fecas['Numero'])<9)
				{
					$contrato[$i][0]=$Fecas['Numero'];
					$contrato[$i][1]=$Fecas['Fecha'];
					$i++;
				}
						
		}
		$i=0;
		$evento[100][100];
		$Ara2='SELECT * FROM Eventos_Adicionales WHERE Fecha >= "'.$_POST['fecha1'].'" AND Fecha <= "'.$_POST['fecha2'].'" ORDER BY Fecha';
		$Fec2=mysql_query($Ara2);
		while ($Fecas2=mysql_fetch_array($Fec2)) 
		{
			
				if(empty($Array_Contratos)&&(strlen($Fecas2['Numero']))<9)
				{
					$evento[$i][0]=$Fecas2['Numero'];
					$evento[$i][1]=$Fecas2['Fecha'];
					$i++;
				}
				else if(strlen($Fecas2['Numero'])<9)
				{
					$evento[$i][0]=$Fecas2['Numero'];
					$evento[$i][1]=$Fecas2['Fecha'];
					$i++;
				}
						
		}
		$first=$_POST['fecha1'];
		$last=$_POST['fecha2'];
		$Array_C='';
		$x=0;$y=0;
		while(strtotime($first)<=strtotime($last)){
			while(strtotime($contrato[$x][1])==strtotime($first)){
				if(empty($Array_C)){
					$Array_C=$contrato[$x][0];
				}else{
					$Array_C=$Array_C.','.$contrato[$x][0];
				}
				$x++;
			}
			while(strtotime($evento[$y][1])==strtotime($first)){
				if(empty($Array_C)){
					$Array_C=$evento[$y][0];
				}else{
					$Array_C=$Array_C.','.$evento[$y][0];
				}
				$y++;
			}
			$nuevafecha = strtotime ( '+1 day' , strtotime ( $first ) ) ;
			$first=date ( 'Y-m-d' , $nuevafecha );
		}
		//echo "Evento:".$Array;

		$array =explode(",", $Array_C);
		
	?>
	  
	<div id='uno' class="uno" onscroll="descripcion(this)" align="left">
			<table border="6">
				<tr><td bgcolor="#F7A3A3"  height="22px"><b>Numero de Contrato</b></td></tr>
				<tr><td bgcolor='#C9EED0'><h5><b>EVENTO</b></td></tr>	
				<tr><td  bgcolor='#FF9F63' height="47px"><b>COMENSALES</b></td></tr>
				<tr><td height="24px" bgcolor='#B2B4FC'><b>SALON</b></td></tr>
				<tr><td><b>DIA</b></td></tr>
				<tr><td bgcolor="#43F649"><b>FECHA</b></td></tr>
				<tr><td bgcolor='#78BA7A'><b>PROMEDIO MESEROS</b></td></tr>
				<tr><td bgcolor="#BEFF09"><b>MESEROS SELECCIONADOS</b></td></tr>
			</table>
		  </div>
	<div id='dos' class="dos" onscroll="horizontal(this)" align="left">
    	<table border=6 border-color="#640404" background-color="fff" id="tabla1" >              
				<?php
	            	echo"	
	            			<tr>";
	            			// CONTRATOS
			               		for ($j=0; $j <count($array) ; $j++) 
			               		{ 
			               			$Se=mysql_query("SELECT * FROM contrato WHERE Numero='".$array[$j]."'");
			               			if (mysql_num_rows($Se)<1) 
			               			{
			               				$See=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$j]."'");				               			
			               				$C=mysql_fetch_array($See);
			               			}
			               			else
			               			{
			               				$C=mysql_fetch_array($Se);
			               			}
			               			echo "<td align='center' bgcolor='#F7A3A3'><b><h3>".$C['Numero']."</b></h3></td>";
			               		}
	               	  echo "</tr>
	               	 		<tr>";

			               	// TIPO DE EVENTO
			               		for ($j=0; $j <count($array) ; $j++) 
			               		{ 
			               			$Se=mysql_query("SELECT * FROM contrato WHERE Numero='".$array[$j]."'");
			               			if (mysql_num_rows($Se)<1) 
			               			{
			               				$See=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$j]."'");				               			
			               				$C=mysql_fetch_array($See);
			               			}
			               			else
			               			{
			               				$C=mysql_fetch_array($Se);
			               			}			            
			               			echo "<td align='center' bgcolor='#C9EED0'><h5><b>".$C['tipo']."</b></h5></td>";
			               		}
	               	  echo "</tr>
	               	  		<tr>";
	               	  			// COMENSALES
			               		for ($j=0; $j <count($array) ; $j++) 
			               		{ 
			               			$esfac=mysql_query("SELECT * FROM contrato WHERE Numero='".$array[$j]."'");
			               		 	if (mysql_num_rows($esfac)<1) 
			               		 	{
			               		 		$efac=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$j]."'");
			               		 		$r=mysql_fetch_array($efac);
			               		 		$total=$r['c_adultos']+$r['c_jovenes']+$r['c_ninos'];							
										$ad=$r['c_adultos'];
										$jo=$r['c_jovenes'];
										$ni=$r['c_ninos'];
										echo "<td style='color:#0015FF' align='center' bgcolor='#FF9F63'><h6><b>Adultos = ".$ad."<br>Jovenes = ".$jo."<br>Niños = ".$ni."<br>Total = ".$total."</b></h6></td>";	               			
			               		 	}
			               		 	else
			               		 	{
				               		 	$esfa=mysql_fetch_array($esfac);
				               		 
				               		 	$Tota=total_comensales($array[$j],$esfa['facturado']);
				               		 	$TTOal=$Tota[0]+$Tota[1]+$Tota[2];

										$C="Select * from contrato Where Numero='".$array[$j]."'";
										$Czz=mysql_fetch_array(mysql_query($C));
										$total=$Czz['c_adultos']+$Czz['c_jovenes']+$Czz['c_ninos'];
										$TTOal=$total+$TTOal;
										$ad=$Tota[0]+$Czz['c_adultos'];
										$jo=$Tota[1]+$Czz['c_jovenes'];
										$ni=$Tota[2]+$Czz['c_ninos'];
										echo "<td style='color:#0015FF' align='center' bgcolor='#FF9F63'><h6><b>Adultos = ".$ad."<br>Jovenes = ".$jo."<br>Niños = ".$ni."<br>Total = ".$TTOal."</b></h6></td>";
									}
			               		}
			         echo "</tr>
	               	  		<tr>";
	               	  			// SALON
			               		for ($j=0; $j <count($array) ; $j++) 
			               		{ 
					               	$S=mysql_query("Select * from contrato Where Numero='".$array[$j]."'");
									if(mysql_num_rows($S)<1)
									{
										$ss=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$j]."'");
										$s=mysql_fetch_array($ss);
											echo "<td width='140px' style='color:#FCFF00' align='center' bgcolor='#D500FF'><h6><b>".$s['salon']."</b></h6></td>";								
									}
									else
									{
										$zzS=mysql_fetch_array($S);
										echo "<td width='140px'  align='center' bgcolor='#B2B4FC' height='20px'><h6><b>".$zzS['salon']."</b></h6></td>";
									}

			               		}			           
			            echo "</tr>
	               	  		<tr>";
	               	  			// DIA
			               		for ($j=0; $j <count($array) ; $j++) 
			               		{ 
			               			  
									$Z=mysql_query("Select * from contrato Where Numero='".$array[$j]."'");
									if (mysql_num_rows($Z)<1) 
									{
										$SA=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$j]."'");
										$zz=mysql_fetch_array($SA);
									}
									else
									{
										$zz=mysql_fetch_array($Z);
									}
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
			            echo "</tr>
	               	  		<tr>";
	               	  			// FECHA
			               		for ($j=0; $j <count($array) ; $j++) 
			               		{ 			               			
								 	$Z=mysql_query("Select * from contrato Where Numero='".$array[$j]."'");
								 	if(mysql_num_rows($Z)<1)
								 	{
								 		$za=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$j]."'");
										$zz=mysql_fetch_array($za);
								 	}
								 	else
								 	{							 		
								 		$zz=mysql_fetch_array($Z);
								 	}
									echo "<td style='color:#0015FF' align='center' bgcolor='#43F649'><b>".$zz['Fecha']."</b></td>";
			               		}
			           echo "</tr>
			           		 <tr>";
			           		  for ($i=0; $i < count($array); $i++) 
			               		 {	  				
									$Com=mysql_query("SELECT * FROM contrato Where Numero='".$array[$i]."'");
									if(mysql_num_rows($Com)<1)
									 	{
									 		$za=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$i]."'");
											$zz=mysql_fetch_array($za);									
											$TAdul=$zz['c_adultos'];
											$TJov=$zz['c_jovenes'];
											$TNin=$zz['c_ninos'];
											$total= $TAdul+$TJov+$TNin;
											$PROM=$total/20;
											echo "<td style='color:#2600FF' align='center' bgcolor='#78BA7A'><b>".$PROM."</b></td>";
											$prom_m=$prom_m.$PROM.",";
									 	}
									 	else
									 	{							 									 		
											$Come=mysql_fetch_array($Com);
											$Tota=total_comensales($array[$i],$Come['facturado']);
					               		 	$TTOal=$Tota[0]+$Tota[1]+$Tota[2];
											$TAdul=$Come['c_adultos'];
											$TJov=$Come['c_jovenes'];
											$TNin=$Come['c_ninos'];
											$total= $TAdul+$TJov+$TNin+$TTOal;
											$PROM=$total/20;
											echo "<td style='color:#2600FF' align='center' bgcolor='#78BA7A'><b>".$PROM."</b></td>";
											$prom_m=$prom_m.$PROM.",";

									 	}
									}
								echo "</tr>
									  <tr>";
									  for ($i=0; $i < count($array); $i++) 
					               		 {	  																		
											echo "<td style='color:#FF0000' align='center' bgcolor='#BEFF09' height='15'><b><p id='CantidadM".$i."'></p></b></td>";
										 }
								echo "</tr>";	               

                echo'</tr>
    		     </table>

	</div>
		<a id="datos2"></a>
	<div id="tres" class="tres" onscroll="vertical(this)">
			<table  border="2" border-color="#640404" background-color="fff" id="tabla2" style="overflow=auto">
						<tr>
    		      			<td  width="300" align="center"><b>Nombre</b></td>
    		      			<td align="center"><h6><b>S</b></h6></td>
    		      			<td align="center"><h6><b>L</b></h6></td>
    		      			<td align="center"><h6><b>E</b></h6></td>
    		      			<td align="center"><h5><b>Comentarios</b><h5></td>    		      			
    		      		</tr>';
    		      		$NCheck=0;
    		      		$Selec=mysql_query("SELECT * FROM Meseros WHERE disponibilidad='si' group by tipo");
    		      		while ($M=mysql_fetch_array($Selec)) 
    		      		{
    		      			echo "<tr>
    		      					<td colspan='5' bgcolor='000000' align='center'><font color='#FFFF00' ><b>".$M['tipo']."</b></font></td>";
    		      					$Selc=mysql_query("SELECT * FROM Meseros WHERE disponibilidad='si' order by ap,am,nombre");
			 						$NMESEROS= mysql_num_rows($Selc);    		      					
			 						$NNN=$NMESEROS *(count($array));			 						
			    		      		while ($Me=mysql_fetch_array($Selc)) 
			    		      		{
			    		      			if ($M['tipo']==$Me['tipo']) 
			    		      			{      		# code...			    		      			
				    		      			$semana=Dias_entre_Fechas((date("Y-m-d")),($Me['fechaingreso']));                                                        	
	                                		$semana=date('W', strtotime($Me['fechaingreso'])) . PHP_EOL;
				    		      			$nombre=$Me['ap']." ".$Me['am']." ".$Me['nombre'];
				    		      			echo "
				    		      					<tr>
				    		      						<td width='300' height='60px' align='center' bgcolor='#BCB2F7'><h6>".$nombre."</h6></td>
				    		      						<td align='center' bgcolor='#BCB2F7'><h6>".$semana."</h6></td>
				    		      						<td align='center' style='color:#FF0000' bgcolor='#BCB2F7'><h6><b>".$Me['porcentaje']."</b></h6></td>
														<td align='center' style='color:#FF0000' bgcolor='#BCB2F7'><h6><b>".$Me['neventos']."</b></h6></td>										
														<td align='center' bgcolor='#BCB2F7'><h5><b>".$Me['comentarios']."</b></h5></td>
				    		      					</tr>
				    		      		
				    		      				 ";
				    		      		}

			    		      		}
    		      				 echo "</tr>
    		      				 ";
    		      		}
    		   
    		echo '</table>	      	
	</div>
	<div id="cuatro" class="cuatro" onscroll="vyh(this);" align="left">
	<table  border-color="#640404" background-color="fff" id="tabla2" style="overflow=auto" border="2">';
				echo "<tr>";
    		      			for ($i=0; $i <count($array) ; $i++) 
    		      			{ 
    		      					echo "<td  bgcolor='#F7A3A3' align='center'><b>".$array[$i]."</b></td>";    		      				
    		      			}
    		      			echo "
    		      	</tr>";
	$Selec=mysql_query("SELECT * FROM Meseros WHERE disponibilidad='si' group by tipo");
    		      		while ($M=mysql_fetch_array($Selec)) 
    		      		{
    		      			Echo "
    		      				<tr>
    		      					<td colspan='".count($array)."' bgcolor='000000' align='center'><font color='#FFFF00'><b>".$M['tipo']."</b></font></td>
    		      				 </tr>";

    		      					$Selc=mysql_query("SELECT * FROM Meseros WHERE disponibilidad='si' order by ap,am,nombre");
			    		      		while ($Me=mysql_fetch_array($Selc)) 
			    		      		{
			    		      			if ($M['tipo']==$Me['tipo']) 
			    		      			{    echo "<tr>";  		# code...			    		      			
				    		      			for ($i=0; $i < count($array); $i++) 
			               					 {	  								
												$Z=mysql_query("Select * from contrato Where Numero='".$array[$i]."'");
												if (mysql_num_rows($Z)<1) 
												{
													$ee=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$i]."'");
													$zz=mysql_fetch_array($ee);													
												}
												else
												{
												$zz=mysql_fetch_array($Z);
												}
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
											$ti='"'.$Me['tipo'].'"'	;
												echo "<td width='140px' height='60px' bgcolor=".$color." align='center'><input type='checkbox' id='".$NCheck."' name='".$NCheck."' value=".$NCheck.",".$Me['id'].",".$Me['tipo']."  onchange='Cuenta(".$ti.");' title='".$NCheck.",".$Me['id']."'/></td>"; $NCheck++;
														
											}
											echo "</tr>";
				    		      		}

			    		      		}
    		      				 echo "</tr>
    		      				 ";
    		      		}

	echo '</table>
	</div>
	<div class="clear"></div>
	';

	}

function total_comensales($n,$fac){
//echo "Es -Facturado ".$fac."<br>";
	$congral=mysql_query("select count(*) as total from contrato where Numero like '".$n."-%'");
	$gral=mysql_fetch_array($congral);

	if($gral['total']>0){//////////////es un contrato gral
		if($fac=='si'){
			$q='select * from cargofac where numcontrato like "'.$n.'%" and tipo="Comensales"';
		}else{
			$q='select * from cargo where numcontrato like "'.$n.'%" and tipo="Comensales"';
		}
	}else{//////es un contrato normal o subcontrato
		if($fac=='si'){
			$q='select * from cargofac where numcontrato="'.$n.'" and tipo="Comensales"';
		}else{
			$q='select * from cargo where numcontrato="'.$n.'" and tipo="Comensales"';
		}
	}
	
	$r=mysql_query($q);
	$cantidades;
	while($m=mysql_fetch_array($r)){
		$arreglo=explode(' ',$m['concepto']);
		$cantidades[0]=$cantidades[0]+$arreglo[4];
		$cantidades[1]=$cantidades[1]+$arreglo[15];
		$cantidades[2]=$cantidades[2]+$arreglo[26];
	}
	
	return $cantidades;
}
echo "<br><br>";

?>

 <input type="hidden" name="ncHECK" value="<?PHP echo $NNN;?>" />
 <input type="hidden" name="contratos" value="<?PHP echo $Array_C;?>" />
 <input type="hidden" name="TTM" value="" id='TTM' />
 <input type="hidden" name="prom" value="<?php echo $prom_m; ?>" />
	
        
</form>        

 </div>
<br><br>
<br><br>

<br><br>
 <?php
echo "<br><br>" ;
echo "<br><br>" ;
echo "<br><br>" ;
// pie();
 ?>
<br><br>

<br>
 <script>
 setTimeout( "habilitar()", 1000 );
 setTimeout( " Cuenta()", 1000 );
 setTimeout( " mostrar()", 1000 );



         function validarFecha()
    {
       	 
        var x = document.getElementById("fecha1").value;
		var y = document.getElementById("fecha2");
		y.setAttribute("min", x);
    }
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
 	alert('SE HAN ASIGNADO LOS MESEROS CONFIRMADOS A LOS DIFERENTES EVENTOS');
 	setTimeout ("redireccionar()", 5000); //tiempo expresado en milisegundos
    }

function redireccionar()
{
    window.location="http:ConfiguracionSistema.php";  
} 

function habilitar()
{
	//alert('Entro');
	//var arrayJS=<?php echo json_encode($array);?>;
	//var variablejs = "<?php echo $NNN; ?>" ;
	
	<?php
		for ($i = 0; $i < count($array); $i++) 
		{			
			$C=mysql_query("SELECT * FROM contrato WHERE Numero='".$array[$i]."'");
			if(mysql_num_rows($C)<1)
			{
				$CX=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$i]."'");
				$ShowContrato=mysql_fetch_array($CX);

			}
			else
			{
				$ShowContrato=mysql_fetch_array($C);
			}
			$Mesero_Contrato=$ShowContrato['Meseros'];
			$IdMesero=explode(',', $Mesero_Contrato);
			//echo "alert('Contrato'+".$array[$i].");";
			//echo "alert('Numero de check sss '+".$NNN.");";			
				//$x=document.getElementById(j).value;
				for ($k = 0; $k <count($IdMesero); $k++) 
				{
					?>
					var cont=0;
					var jj = "<?php echo $NNN; ?>" ;										
					//alert(jj);
					for (var j = 0; j <jj; j++) 
					{
						var NContrato="<?php echo count($array);?>";
						var NumeroContrato="<?php echo $i;?>";						
						var Chec=document.getElementById(j).value;
						var idCheck=Chec.split(",");
						var Mee="<?php echo $IdMesero[$k]; ?>";
						var NNe="<?php echo $ShowContrato['Numero']; ?>";
						cont++;
						//alert('id Mesero del check '+ idCheck[1]+' id mesero del contrato '+Mee+' contador = '+cont+' contrato '+NNe);
						if ((idCheck[0]%NContrato)==NumeroContrato )
							{
								if (idCheck[1]==Mee) 
								{
									document.getElementById(idCheck[0]).checked=true;
								}	
							}
															
						
				};
					<?php

			}


		}
	?>
}
/////////////////
function Cuenta(tipo)
{
	//alert(tipo);	////////////creamos la variables
	<?php
	for($i=0;$i<count($array);$i++){
		echo "var c".$i."=0;";

	}
	 ?>
	 for(j=0;j<<?php echo $NNN; ?>;j++){
	 	if(document.getElementById(j).checked){
	 		var t= document.getElementById(j).value.split(',')
	 		//alert(t[2]);
	 		if (t[2]=='MESEROS_2'||t[2]=='MESEROS_1'||t[2]=='MESERO_ESTRELLA') 
	 		{
		 		<?php
		 			for($i=0;$i<count($array);$i++){
						echo "if(j%".count($array)."==".$i.")
						{";
							echo "c".$i."++;";			
				  echo "}";

						${'TMeseros'.$i}="c".$i;
					}
		 		?>
	 		}

	 	}
	 }

var TTM='';
		<?php
	 			for($i=0;$i<count($array);$i++){
					
					echo "TTM=TTM+c".$i."+',';";
				}
	 		?>

			document.getElementById('TTM').value=TTM;
	 <?php
		for ($i = 0; $i < count($array); $i++){
			//echo "alert('x".$i."');";
			echo "document.getElementById('CantidadM".$i."').innerHTML=c".$i.";";
		}
	 ?>
}	
////////////////  
function mostrar()
{
//document.getElementById('oculto').style.display = 'block';
var ele = document.getElementById("tabla1");
var whi = ele.offsetWidth;
//alert(offSetWidth);
//var vvvv= document.getElementById('tabla1').clientWhidth;
//alert(vvvv);
document.getElementById("tabla2").style.width = whi;
document.getElementById("div1").style.width = whi;
//document.getElementById('tabla2').setAttribute('width', whi);
//document.getElementById('div1').setAttribute('width', whi);
}
	
	function horizontal (div) {
            var info = document.getElementById ("cuatro");
			var v = document.getElementById ("uno");
			v.scrollTop=div.scrollTop;
            //alert("Horizontal: "+div.scrollLeft+"px<br/>Vertical: "+div.scrollTop+"px");
			info.scrollLeft=div.scrollLeft;
        }
	function vertical (div) {
            var info = document.getElementById ("cuatro");
            //alert("Horizontal: "+div.scrollLeft+"px<br/>Vertical: "+div.scrollTop+"px");
			info.scrollTop=div.scrollTop;
        }	
	function vyh(div){
		var v = document.getElementById ("tres");
		var h = document.getElementById ("dos");
		v.scrollTop=div.scrollTop;
		h.scrollLeft=div.scrollLeft;
	}
	function descripcion(div){
		var v = document.getElementById ("dos");
		v.scrollTop=div.scrollTop;
	}



</script>
</body>
</html>