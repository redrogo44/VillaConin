<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
error_reporting(0);
	require "configuraciones.php";
	conectar();
	validarsesion();
	$nivel=$_SESSION['niv'];
	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--<!-<link rel="stylesheet" href="../subcontratos.css" type="text/css" /> -->
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Villa Conin</title>
    <style type="text/css">
             *{
				 padding:0px;
				 margin:0px;
			  }
			  #header{
				  margin:auto;
				  width:1000px;
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
			   .checkbox
			   {
				  background: #ededed;
				  width: 40px;
				  height: 40px;
				  margin-left: 10px;
				  border-radius: 50%;
				  position: relative;
				  border: 1px solid rgba(0, 0, 0, 0.15);
				  box-shadow: 1px 2px 5px rgba(0, 0, 0, 0.4);
				}	   
    </style>    
</head>
   <link rel="stylesheet" href="https://villaconin.mx/Config/tablas2.css" type="text/css"/>	
   <link rel="stylesheet" href="https://villaconin.mx/Config/demo.css">
	<link rel="stylesheet" href="https://villaconin.mx/Config/pop/demo.css">

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
$contrato[100][100];
	if (isset($_POST['submit'])) 
	{	$Conf=mysql_query("SELECT * FROM Configuraciones where tipo='Proyeccion'");
		$existe=mysql_fetch_array($Conf);

		if (empty($existe['descripcion'])||$existe['descripcion']=='') 
		{	
			$ii=0;
			$Ara='SELECT * FROM contrato WHERE Fecha >= "'.$_POST['fecha1'].'" AND Fecha <= "'.$_POST['fecha2'].'" AND estatus=1 ORDER BY Fecha';
			$Fec=mysql_query($Ara);
			while ($Fecas=mysql_fetch_array($Fec)) 
			{
				
					if(empty($Array_Contratos)&&(strlen($Fecas['Numero']))<9)
					{
						 $contrato[$ii][0]=$Fecas['Numero'];						
						 $contrato[$ii][1]=$Fecas['Fecha'];		
						 $Array_Contratos=$Fecas['Numero'];							
						
					}
					else if(strlen($Fecas['Numero'])<9)
					{
						$contrato[$ii][0]=$Fecas['Numero'];
						$contrato[$ii][1]=$Fecas['Fecha'];
						$Array_Contratos=$Array_Contratos.",".$Fecas['Numero'];																			
					}
					 $ii++;
			}
			$ei=0;
			$evento[100][100];
			$EA='SELECT * FROM Eventos_Adicionales WHERE Fecha >= "'.$_POST['fecha1'].'" AND Fecha <= "'.$_POST['fecha2'].'" ORDER BY Fecha';
			$Fc=mysql_query($EA);
			while ($Fcas=mysql_fetch_array($Fc)) 
			{
				
					if(empty($Array_Contratos)&&(strlen($Fcas['Numero']))<9)
					{		
						$evento[$ei][0]=$Fcas['Numero'];
						$evento[$ei][1]=$Fcas['Fecha'];			
						$Array_Contratos=$Fcas['Numero'];						
						$ei++;
					}
					else if(strlen($Fcas['Numero'])<9)
					{		
						$evento[$ei][0]=$Fcas['Numero'];
						$evento[$ei][1]=$Fcas['Fecha'];
						$Array_Contratos=$Array_Contratos.",".$Fcas['Numero'];					
						$ei++;
					//	echo $Fecas['Numero']."<br>";			
					}				
									
			}
			$ir=0;
			$eventor[100][100];
			 $ER='SELECT * FROM Eventos_Recaudacion WHERE fecha >= "'.$_POST['fecha1'].'" AND fecha <= "'.$_POST['fecha2'].'" AND estatus = "ACTIVO" ORDER BY fecha';
			$Fcr=mysql_query($ER);
			while ($Fcr=mysql_fetch_array($Fcr)) 
			{
				
					if(empty($Array_Contratos)&&(strlen($Fcr['Numero']))<9)
					{	
						$Array_Contratos=$Fcr['Numero'];
						$eventor[$ir][0]=$Fcr['Numero'];
						$eventor[$ir][1]=$Fcr['fecha'];							
						$ir++;
					}
					else if(strlen($Fcr['Numero'])<9)
					{		
						$Array_Contratos=$Array_Contratos.",".$Fcr['Numero'];
						$eventor[$ir][0]=$Fcr['Numero'];
						$eventor[$ir][1]=$Fcr['fecha'];					
						$ir++;
						//	echo "Si existe ".$Fcr['Numero']."<br>";
					}						
			}
			$first=$_POST['fecha1'];
			$last=$_POST['fecha2'];
		}		
		else
		{ 			
			$i2=0;
			$contrato[100][100];
			echo $existe['descripcion'];
			$Fecha=explode(',', $existe['descripcion']);
			print_r($Fecha);
			$Ara='SELECT * FROM contrato WHERE Fecha >= "'.$Fecha[0].'" AND Fecha <= "'.$Fecha[1].'" AND estatus= 1 ORDER BY Fecha';
			$Fec=mysql_query($Ara);
			while ($Fecas=mysql_fetch_array($Fec)) 
			{
				
					if(empty($Array_Contratos)&&(strlen($Fecas['Numero']))<9)
					{	
						$Array_Contratos=$Fecas['Numero'];
						$contrato[$i2][0]=$Fecas['Numero'];
						$contrato[$i2][1]=$Fecas['Fecha'];
						$i2++;
					}
					else if(strlen($Fecas['Numero'])<9)
					{
						$contrato[$i2][0]=$Fecas['Numero'];
						$contrato[$i2][1]=$Fecas['Fecha'];			
						$Array_Contratos=$Array_Contratos.",".$Fecas['Numero'];						
						$i2++;
					//	echo $Fecas['Numero']."<br>";
					}
				
			}		
			$i3=0;
			$evento[100][100];
			$EA='SELECT * FROM Eventos_Adicionales WHERE Fecha >= "'.$Fecha[0].'" AND Fecha <= "'.$Fecha[1].'"  ORDER BY Fecha';
			$Fc=mysql_query($EA);
			while ($Fcas=mysql_fetch_array($Fc)) 
			{						
					$evento[$i3][0]=$Fcas['Numero'];
					$evento[$i3][1]=$Fcas['Fecha'];		
					$Array_Contratos=$Array_Contratos.",".$Fcas['Numero'];										
					$i3++;
			}
			$i4=0;
			$eventor[100][100];
			 $ER='SELECT * FROM Eventos_Recaudacion WHERE fecha >= "'.$Fecha[0].'" AND fecha <= "'.$Fecha[1].'" AND estatus = "ACTIVO" ORDER BY fecha';
			$Fr=mysql_query($ER);
			while ($Fcr=mysql_fetch_array($Fr)) 
			{												
					$eventor[$i4][0] = $Fcr['Numero'];
					$eventor[$i4][1] = $Fcr['fecha'];		
					$Array_Contratos=$Array_Contratos.",".$Fcr['Numero'];											
					$i4++;
			}	
			$first=$Fecha[0];
		$last=$Fecha[1];
		}
		//echo "Algo aqui de <br>";		
//print_r($eventor);
		
		$Array_C='';
		$xx=0;$yy=0;$zz=0;
		while(strtotime($first)<=strtotime($last)){
			while(strtotime($contrato[$xx][1])==strtotime($first)){
				if(empty($Array_C)){
					 $Array_C=$contrato[$xx][0];
				}else{
					$Array_C=$Array_C.','.$contrato[$xx][0];
				}
				$xx++;
			}
			while(strtotime($evento[$yy][1])==strtotime($first)){
				if(empty($Array_C)){
					$Array_C=$evento[$yy][0];
				}else{
					$Array_C=$Array_C.','.$evento[$yy][0];
				}
				$yy++;
			}
			while(strtotime($eventor[$zz][1])==strtotime($first)){
				if(empty($Array_C)){
					$Array_C=$eventor[$zz][0];
				}else{
					$Array_C=$Array_C.','.$eventor[$zz][0];
				}
				$zz++;
			}
			$nuevafecha = strtotime ( '+1 day' , strtotime ( $first ) ) ;
			$first=date ( 'Y-m-d' , $nuevafecha );
		}
	//	echo "Evento:".$Array_C;
$Array_C;
		$array =explode(",", $Array_C);

//	 $Array_Contratos;
		//$array =explode(",", $Array_Contratos);
		echo
		"<br>
		<form method='post' name='formulario'  action='https://villaconin.mx/Config/proyeccion.php' target='_blank'>
		<input type='hidden' name='tipo' id='tipo' value='' />
	<input type='button' value='Cancelar_Proyeccion' name='tipo' class='button' onclick='cancela()'/>           
 	<input type='button' value='Confirmar_Proyeccion' name='tipo' class='button' onclick='confirma()'/>           
 	<input type='button' value='Guardar_Proyeccion'  name='tipo' class='button' onclick='guarda()'/>  
	<br><br>
	<div align='left'>
				<table border=6 border-color='#640404' background-color='fff'>
					<tr>                
	                <td width='350px' bgcolor='#B1F7FB'><b>No. CONTRATO</b></td>
	                <td width='50px' bgcolor='#FBB1B1'></td>
	                <td width='60px'  bgcolor='#FBB1B1'></td>
	                <td width='50px' bgcolor='#FBB1B1'></td>
	                <td width='90px'bgcolor='#FBB1B1'></td>
	               ";	        
	               $array;$ElArray;
	                $num_rows = mysql_num_rows($Fec);
	                //echo "Numero del Array".$num_rows;
	                for ($i=0; $i < count($array); $i++) 
	                {	        								
							echo "<td width='110px'style='color:#0015FF' align='center'><b>".$array[$i]."</b></td>";							
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
							if(mysql_num_rows($TT)<1)
							{
								$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$i]."' ");
								if (mysql_num_rows($Ea)<1) 
								{
									$Er=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$array[$i]."' ");
									if(mysql_num_rows($Er)>0)									
									{
										echo "<td style='color:#0015FF' align='center'><b>RECAUDACION</b></td>";										
									}
								}
								else
								{
									echo "<td style='color:#0015FF' align='center'><b>ADICIONAL</b></td>";									
								}
							}
							else
							{
							$TIPO=mysql_fetch_array($TT);
							echo "<td style='color:#0015FF' align='center'><b>".utf8_encode(utf8_decode($TIPO['tipo']))."</b></td>";
							}
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
	               		 	$esfac=mysql_query("SELECT * FROM contrato WHERE Numero='".$array[$i]."'");
	               		 	if(mysql_num_rows($esfac)<1)
	               		 	{
	               		 		$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$i]."' ");
	               		 		if (mysql_num_rows($Ea)<1) 
	               		 		{
	               		 			$Er=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$array[$i]."' ");	               		 			
	               		 			$er=mysql_fetch_array($Er);
									echo "<td style='color:#0015FF' align='center'><b>".$er['comensales']."</b></td>";	               		 			
	               		 		}
	               		 		else
	               		 		{
	               		 			$ea=mysql_fetch_array($Ea);
									echo "<td style='color:#0015FF' align='center'><b>Adultos = ".$ea['c_adultos']."<br>Jovenes = ".$ea['c_jovenes']."<br>Niños = ".$ea['c_ninos']."<br>Total = ".$TTOal."</b></td>";	               		 			
	               		 		}
	               		 	}
	               		 	else
	               		 	{
	               		 		$esfa=mysql_fetch_array($esfac);	               		 		
		               		 	$Tota=total_comensales($array[$i],$esfa['facturaado']);
		               		 	$TTOal=$Tota[0]+$Tota[1]+$Tota[2];
								$C="Select * from contrato Where Numero='".$array[$i]."'";
								$Czz=mysql_fetch_array(mysql_query($C));
								$total=$Czz['c_adultos']+$Czz['c_jovenes']+$Czz['c_ninos'];
								$TTOal=$total+$TTOal;
								$ad=$Tota[0]+$Czz['c_adultos'];
								$jo=$Tota[1]+$Czz['c_jovenes'];
								$ni=$Tota[2]+$Czz['c_ninos'];
								echo "<td style='color:#0015FF' align='center'><b>Adultos = ".$ad."<br>Jovenes = ".$jo."<br>Niños = ".$ni."<br>Total = ".$TTOal."</b></td>";
							}
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
							$S=mysql_query("Select * from contrato Where Numero='".$array[$i]."'");
							if(mysql_num_rows($S)<1)
							{
								$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$i]."' ");
								if (mysql_num_rows($Ea)<1) 
								{
									$Er=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$array[$i]."' ");
									$zzS=mysql_fetch_array($Er);
									echo "<td style='color:#0015FF' align='center'><b>".$zzS['salon']."</b></td>";
								}
								else
								{
									$zzS=mysql_fetch_array($Ea);
									echo "<td style='color:#0015FF' align='center'><b>".$zzS['salon']."</b></td>";
								}
							}
							else
							{
								$zzS=mysql_fetch_array($S);
								echo "<td style='color:#0015FF' align='center'><b>".$zzS['salon']."</b></td>";
							}
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
							$Z=mysql_query("Select * from contrato Where Numero='".$array[$i]."'");
							if (mysql_num_rows($Z)<1) 
							{
								$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$i]."' ");
								if(mysql_num_rows($Ea)<1)
								{
									$Er=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$array[$i]."' ");									
									$zz=mysql_fetch_array($Er);
									$ex=explode("-",$zz['fecha']);									
								}
								else
								{
									$zz=mysql_fetch_array($Ea);									
									$ex=explode("-",$zz['Fecha']);									
								}
							}
							else
							{
							$zz=mysql_fetch_array($Z);								
							$ex=explode("-",$zz['Fecha']);							
							}

		 
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
							
							 	$Z=mysql_query("Select * from contrato Where Numero='".$array[$i]."'");
							 	if (mysql_num_rows($Z)<1) 
								{
									$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$i]."' ");
									if(mysql_num_rows($Ea)<1)
									{
										$Er=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$array[$i]."' ");									
										$zz=mysql_fetch_array($Er);
										echo "<td style='color:#0015FF' align='center'><b>".$zz['fecha']."</b></td>";										
									}
									else
									{
										$zz=mysql_fetch_array($Ea);									
										echo "<td style='color:#0015FF' align='center'><b>".$zz['Fecha']."</b></td>";										
									}
								}
								else
								{
								 	$zz=mysql_fetch_array($Z);
									echo "<td style='color:#0015FF' align='center'><b>".$zz['Fecha']."</b></td>";
								}
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
							if (mysql_num_rows($Com)<1) 
							{
								$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$i]."' ");
								if(mysql_num_rows($Ea)<1)
								{
									$Er=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$array[$i]."' ");
									$er=mysql_fetch_array($Er);
									$PROM=$er['comensales']/20;
									echo "<td style='color:#0015FF' align='center'><b>".$PROM."</b></td>";
									$prom_m=$prom_m.$PROM.",";
								}
								else
								{
									$ea=mysql_fetch_array($Ea);
									$TAdul=$Come['c_adultos'];
									$TJov=$Come['c_jovenes'];
									$TNin=$Come['c_ninos'];
									$total= $TAdul+$TJov+$TNin+$TTOal;								
									$PROM=$total/20;
									echo "<td style='color:#0015FF' align='center'><b>".$PROM."</b></td>";
									$prom_m=$prom_m.$PROM.",";
								}
							}
							else
							{
								$Come=mysql_fetch_array($Com);							
								$Tota=total_comensales($array[$i],$Come['facturaado']);
		               		 	$TTOal=$Tota[0]+$Tota[1]+$Tota[2];
								$TAdul=$Come['c_adultos'];
								$TJov=$Come['c_jovenes'];
								$TNin=$Come['c_ninos'];
								$total= $TAdul+$TJov+$TNin+$TTOal;
								$PROM=$total/20;
									echo "<td style='color:#0015FF' align='center'><b>".$PROM."</b></td>";
									$prom_m=$prom_m.$PROM.",";
							}
						}


                		echo"</tr>             

                		<tr><td bgcolor='#B1F7FB'><b>MESEROS SELECCIONADOS</b></td>
	                	<td width='50px' bgcolor='#FBB1B1' ></td>
		                <td  width='50px' bgcolor='#FBB1B1'></td>
		                <td   width='50px' bgcolor='#FBB1B1'></td>
		                <td width='116px' bgcolor='#FBB1B1'></td>";
                		 for ($i=0; $i < count($array); $i++) 
	               		 {	  				
										
								echo "<td style='color:#FF0000' align='center' bgcolor='#F2EBC8'><b><p id='CantidadM".$i."'></p></b></td>								
								";
						 }

                		echo"</tr>                            
                		<tr></tr>";
						$Nfilas=count($array)+5;
    		      echo"    </table>
</div>
        		<div  style='overflow:auto;whidth:250%; height:400px; padding:0' align='left'>
				<table border=6 border-color='#640404' background-color='fff' id='tabla2' style='overflow=auto'>
    		      <tr>

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
									
							 $Z=mysql_query("Select * from contrato Where Numero='".$array[$i]."'");
							 if (mysql_num_rows($Z)<1) 
							{
								$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$i]."' ");
								if(mysql_num_rows($Ea)<1)
								{
									$Er=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$array[$i]."' ");									
									$zz=mysql_fetch_array($Er);
									$ex=explode("-",$zz['fecha']);									
								}
								else
								{
									$zz=mysql_fetch_array($Ea);									
									$ex=explode("-",$zz['Fecha']);									
								}
							}
							else
							{
							 $zz=mysql_fetch_array($Z);
							 $ex=explode("-",$zz['Fecha']);			 
							}
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
																
							echo "<td width='110px' bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$array[$i]."</b></td>";
							
						}
				echo"<td colspan='".$Nfilas."''></td>         
            </tr>	
            		<td colspan=".$Nfilas."></td>         
            </tr>";
                                            	$ORDEN=OrdenaMeseros();
			 $Mes="SELECT tipo FROM Meseros group by ".$ORDEN;
			 $Mese=mysql_query($Mes);
			 $Mes2="SELECT * FROM Meseros WHERE  order by nombre ";
			 $Mese2=mysql_query($Mes2);
			 $NMESEROS= mysql_num_rows($Mese2);
			 $NCheck=0; 
			 $nmeseros=0;
			 $colspan=count($CONT)+2;
			 while($Mesero=mysql_fetch_array($Mese))
			 { 
				 echo "
				 <tr>
				 		<td  colspan=".$Nfilas." align='center' style='color:#F74E9D' bgcolor='#000000' ><b>".$Mesero['tipo']."</b></td></tr>";
			 			 $MMes="Select * from Meseros Where tipo='".$Mesero['tipo']."' order by ap,am,nombre";
				 		 $MMese=mysql_query($MMes);					
					 		while($MMesero=mysql_fetch_array($MMese))
					 		{
					 		$semana=Dias_entre_Fechas((date("Y-m-d")),($MMesero['fechaingreso']));
                                                        
	
                                			$semana=date('W', strtotime($MMesero['fechaingreso'])) . PHP_EOL;
					 			
			 			 		echo " <tr>"; 				 			 		
								 $Nombre=$MMesero['ap']." ".$MMesero['am']." ".$MMesero['nombre'];
			 						echo "
										<td align='center' >".$Nombre."</td>
										<td align='center' style='color:#FF0000'><b>".$semana."</b></td>
										<td align='center' style='color:#FF0000'><b>".$MMesero['porcentaje']."</b></td>
										<td align='center' style='color:#FF0000'><b>".$MMesero['neventos']."</b></td>										
										<td align='center' ><b>".$MMesero['comentarios']."</b></td>
									";
			 
									 for ($i=0; $i < count($array); $i++) 
	               					 {	  
							
										$Z=mysql_query("Select * from contrato Where Numero='".$array[$i]."'");
										if (mysql_num_rows($Z)<1) 
										{
											$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$array[$i]."' ");
											if(mysql_num_rows($Ea)<1)
											{
												$Er=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$array[$i]."' ");									
												$zz=mysql_fetch_array($Er);
												$ex=explode("-",$zz['fecha']);									
											}
											else
											{
												$zz=mysql_fetch_array($Ea);									
												$ex=explode("-",$zz['Fecha']);									
											}
										}
									else{
											$zz=mysql_fetch_array($Z);
											$ex=explode("-",$zz['Fecha']);
							 			}
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
								
									echo "<td bgcolor=".$color." align='center'><input type='checkbox' id='".$NCheck."'name='".$NCheck."' value=".$NCheck.",".$MMesero['id']." title='".$NCheck."'  onchange='Cuenta();'/></td>"; $NCheck++;
												
								}
							
							
							echo "</tr>	";
						}
				$nmeseros++;
			}
   echo"</table>";
}
function total_comensales($n,$fac){

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
			$es2="SELECT * FROM Meseros ";
			 $Mee2=mysql_query($es2);	
			 $NMESEROS= mysql_num_rows($Mee2);
			 $NNN=$NMESEROS *(count($array));

//pie();
?>
 <input type="hidden" name="ncHECK" value="<?PHP echo $NNN;?>" />
 <input type="hidden" name="contratos" value="<?PHP echo $Array_Contratos;?>" />
 <input type="hidden" name="TTM" value="" id='TTM' />
 <input type="hidden" name="prom" value="<?php echo $prom_m; ?>" />
 <input type="hidden" name="fecha1" value="<?php echo $_POST['fecha1'] ?>" />
 <input type="hidden" name="fecha2" value="<?php echo $_POST['fecha2'] ?>" />




 
	
        
</form>        

 </div>

<br>
 <script>
 setTimeout( " Cuenta()", 1000 );
 habilitar();
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
    window.location="https://villaconin.mx/Config/ConfiguracionSistema.php";  
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
			$ShowContrato=mysql_fetch_array($C);
			$Mesero_Contrato=$ShowContrato['Meseros'];
			$IdMesero=explode(',', $Mesero_Contrato);
		//	echo "alert('Numero de check'+".$NNN.");";
			
				//$x=document.getElementById(j).value;
				for ($k = 0; $k <count($IdMesero); $k++) 
				{
					?>
					var cont=0;
					var jj = "<?php echo $NNN; ?>" ;										
					for (var j = 0; j <jj; j++) 
					{
						var NContrato="<?php echo count($array);?>";
						var NumeroContrato="<?php echo $i;?>";						
						var Chec=document.getElementById(j).value;
						var idCheck=Chec.split(",");
						//alert(Chec);
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
function Cuenta()
{


	////////////creamos la variables
	<?php
	for($i=0;$i<count($array);$i++){
		echo "var c".$i."=0;";

	}

	 ?>

	 for(j=0;j<<?php echo $NNN; ?>;j++){
	 	if(document.getElementById(j).checked){
	 		<?php
	 			for($i=0;$i<count($array);$i++){
					echo "if(j%".count($array)."==".$i."){";
					echo "c".$i."++;";
					echo "}";

					${'TMeseros'.$i}="c".$i;
				}
	 		?>

	 	}
	 }

//////////////////
var TTM='';
		<?php
	 			for($i=0;$i<count($array);$i++){
					
					echo "TTM=TTM+c".$i."+',';";
				}
	 		?>

			document.getElementById('TTM').value=TTM;


////////////////



	 <?php
		for ($i = 0; $i < count($array); $i++){
			//echo "alert('x".$i."');";
			echo "document.getElementById('CantidadM".$i."').innerHTML=c".$i.";";
		}
	 ?>


/*


	// CREAMOS LAS VARIABLES A OCUPAR
	var Neventos="<?php echo count($array); ?>";

					for (var a = 0; a <Neventos; a++) 
					{
						//alert(Neventos);


						//eval(“var variable” + indice + ” = ‘valor'”);
						window["x" + a] = 0;
					};

	var NChec="<?php echo $NNN; ?>";
	for (var i = 0; i <NChec; i++) 
	{
		if (document.getElementById(i).checked) 
			{
				<?php 

				//  RECORREMOS LAS VARIABBLES

					for ($j = 0; $j <count($array); $j++) 
					{

					//	echo "alert(Neventos);";
							echo "if(i%".count($array)."==".$j."){";

						echo "window['x' + ".$j."]++;";
							
							echo "};";
							//$variables=$variables."x".$j."+ ',' ";

					}
							//echo "alert(".$variables.");";

				?>
				
			};
	};
	
	<?php  

		for ($i = 0; $i < count($array); $i++) 
		{
			echo "alert('x".$i."');";
			echo "document.getElementById('CantidadM".$i."').inner.HTML=x".$i.";";
		}
	?>
	*/

}	

 	function cancela()
 	{
 		if (confirm("SEGURO DE CANCELAR LA PROYECCION")) {
 			document.getElementById('tipo').value='Cancelar_Proyeccion';
 			document.formulario.submit();
 		};
 	}
 	function confirma()
 	{
 		if (confirm("SEGURO DE CONFIRMAR LA PROYECCION")) {
 			 document.getElementById('tipo').value='Confirmar_Proyeccion';
 			document.formulario.submit();
 		};
 	}
 	function guarda()
 	{
 		if (confirm("SEGURO DE GUARDAR LA PROYECCION")) {
 			document.getElementById('tipo').value='Guardar_Proyeccion';
 			document.formulario.submit();
 		};
 	}
 </script>
</body>
</html>