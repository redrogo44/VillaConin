<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
session_start();	
	require "configuraciones.php";
	validarsesion();
	conectar();
	$nivel=$_SESSION['niv'];
	menuconfiguracion();
	$PO="Select * from Meseros ";
	$PP=mysql_query($PO);
	while($m=mysql_fetch_array($PP))
	{
		$M="select to_days('".date("Y-m-d")."') - to_days('".$m['fechaingreso']."') as ndias ";
		$MM=mysql_fetch_array(mysql_query($M));
		
		$porcentage=($m['neventos']/$MM['ndias'])*100;
		$PORC=round($porcentage);
	 $PU="UPDATE `Meseros` SET `porcentaje`='".$PORC."' WHERE id=".$m['id'];
	mysql_query($PU);
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
				.pie {position:relative;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
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

$conscon="select descripcion, valor from Configuraciones where id=2";
$cons=mysql_fetch_array(mysql_query($conscon));
$valor=$cons['valor'];
$CONT = explode(",", $cons['descripcion']);

$z="Select * FROM contrato Where ";
  $cons['descripcion'];
"Numero de Contratos ".count($CONT);
 
	
		
?>
<!--ESTILO CUERPO-->
<div align="center"  >
<br /><br /><br  style="background-position:center"/ >
   <!-- Tabala Pre-Registro -->
   <h1>MESEROS PRE-CONFIRMADOS</h1>
   <br />
   <b>Contratos de la semana <a style="color:#F00"><?php echo $valor;?></a></b>
   <br />
   <br /><br />

  <div class="wrapper">
  
 <form method="post"  action="AsignarMeseros.php" target="_blank">

 <input type="submit" value="Asignar Meseros Semana <?php echo $numeroSemana = date("W");?>"  class="button" onclick="confirma()"/>           
<br>
  		<table border="6" bordercolor="#990000" style="background-color:#FFF">
        
            	<tr>
                
                <td><b>No. CONTRATO</td></b>
                <td></td><td></td>
                 <?php 
   	for($i=1;$i<count($CONT)-1;$i++)
	{
	echo "
			<td style='color:#0015FF' align='center'><b>".$CONT[$i]."</b></td>
			
			";
	}
	
   ?>
   
   </tr>
                <tr><td><b>EVENTO</b></td>
                <td></td><td></td>
                 <?php 
   	for($i=1;$i<count($CONT)-1;$i++)
	{ $Z="Select * from contrato Where Numero='".$CONT[$i]."'";
		$zz=mysql_fetch_array(mysql_query($Z));
	echo "
			<td style='color:#0015FF' align='center'><b>".$zz['tipo']."</b></td>
			";
	}
	
   ?></tr>
                <tr><td><b>Num. INVITADOS</b></td>
                <td></td><td></td>
                 <?php 
   	for($i=1;$i<count($CONT)-1;$i++)
	{ $Z="Select * from contrato Where Numero='".$CONT[$i]."'";
		$zz=mysql_fetch_array(mysql_query($Z));
		$total=$zz['c_adultos']+$zz['c_jovenes']+$zz['c_ninos'];
	echo "
			<td style='color:#0015FF' align='center'><b>".$total."</b></td>
			";
	}
	
   ?>
                </tr>
                <tr><td><b>SALON</b></td>
                <td></td><td></td>
                 <?php 
   	for($i=1;$i<count($CONT)-1;$i++)
	{ $Z="Select * from contrato Where Numero='".$CONT[$i]."'";
		$zz=mysql_fetch_array(mysql_query($Z));
	echo "
			<td style='color:#0015FF' align='center'><b>".$zz['salon']."</b></td>
			";
	}
	
   ?>
                </tr>
                <tr><td><b>DIA</b></td>
                <td></td><td></td>
                               <?php 
   	for($i=1;$i<count($CONT)-1;$i++)
	{ $Z="Select * from contrato Where Numero='".$CONT[$i]."'";
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
	echo "
			<td style='color:#B3FF00' bgcolor=".$color." align='center'><b>".$Diaa."</b></td>
			";
	}
	
   ?>
                </tr>
                <tr><td><b>FECHA</b></td>
                <td></td><td></td>
                 <?php 
   	for($i=1;$i<count($CONT)-1;$i++)
	{ $Z="Select * from contrato Where Numero='".$CONT[$i]."'";
		$zz=mysql_fetch_array(mysql_query($Z));
		 
		
	echo "
			<td style='color:#0015FF' align='center'><b>".$zz['Fecha']."</b></td>
			";
	}
	
   ?>
                </tr>
                <tr><td><b>HORARIO DE ENTRADA</b></td><td></td><td></td></tr>
                <tr><td><b>HORARIO DE SALIDA</b></td><td></td><td></td></tr>
                <tr><td><b>No. DE MESEROS</b></td><td></td><td></td></tr>               
                
                <tr></tr>
                <tr>
                <td colspan="<?php echo count($CONT)+2;?>" bgcolor="#00FFCC" align="center"><b>ASIGNACION DE MESEROS</b></td>
                </tr>
                <tr>
            	<td align="center" bgcolor="#CC99FF"><b>NOMBRE</b></td>
                <td align="center" bgcolor="#FF99FF"><b>Porcentaje</b></td>
                <td align="center" bgcolor="#12F351"><b>Comentarios</b></td>
                <?php
					for($i=1;$i<count($CONT)-1;$i++)
	{ $Z="Select * from contrato Where Numero='".$CONT[$i]."'";
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
	
					
						if($dia==0){echo "<td bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$CONT[$i]."</b></td>";}
						if($dia==1){echo "<td bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$CONT[$i]."</b></td>";}
						if($dia==2){echo "<td bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$CONT[$i]."</b></td>";}
						if($dia==3){echo "<td bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$CONT[$i]."</b></td>";}
						if($dia==4){echo "<td bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$CONT[$i]."</b></td>";}
						if($dia==5){echo "<td bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$CONT[$i]."</b></td>";}
						if($dia==6){echo "<td bgcolor='".$color."' style='color:#FFEB00'  align='center'><b>".$CONT[$i]."</b></td>";}


						
	}
				?>
							<td colspan="<?php echo count($CONT)-1;?>"></td>         
            </tr>
     <?php 
	 $Mes="SELECT tipo FROM Meseros WHERE disponibilidad =  'si' group by tipo";
	 $Mese=mysql_query($Mes);
	 $Mes2="SELECT * FROM Meseros WHERE disponibilidad =  'si' ";
	 $Mese2=mysql_query($Mes2);
	 echo "Numero de Meseros".$NMESEROS= mysql_num_rows($Mese2);
		     echo "Numero de Check  ".$NNN=$NMESEROS * (count($CONT)-2);
	 $NCheck=0; 
	 $nmeseros=0;
	 $colspan=count($CONT)+2;
	 while($Mesero=mysql_fetch_array($Mese))
	 { 
	 echo "<tr><td  colspan=".$colspan." align='center' style='color:#F74E9D' bgcolor='#000000' ><b>".$Mesero['tipo']."</b></td></tr>";
	 	 $MMes="Select * from Meseros Where tipo='".$Mesero['tipo']."' order by porcentaje";
			 $MMese=mysql_query($MMes);
			
			 while($MMesero=mysql_fetch_array($MMese))
			 {
	 			 echo " <tr>"; 
				 $Nombre=$MMesero['nombre']." ".$MMesero['ap']." ".$MMesero['am'];
	 				echo "
						<td align='center' >".$Nombre."</td>
						<td align='center' style='color:#FF0000'><b>".$MMesero['porcentaje']."</b></td>
						<td align='center' ><b>".$MMesero['comentarios']."</b></td>
						";
			 
		 for($i=1;$i<count($CONT)-1;$i++)
		{ $Z="Select * from contrato Where Numero='".$CONT[$i]."'";
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
			
					
						if($dia==0){echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."'  value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;}
						if($dia==1){echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."' value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;}
						if($dia==2){echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."' value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;}
						if($dia==3){echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."' value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;}
						if($dia==4){echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."' value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;}
						if($dia==5){echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."' value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;}
						if($dia==6){echo "<td bgcolor=".$color." align='center'><input type='checkbox' name='".$NCheck."' value=".$NCheck.",".$MMesero['id']." /></td>"; $NCheck++;}
												
	}
			 }
		
			
			echo "
				
			</tr>	";$nmeseros++;
	}
   ?>
            
            
	        </table>
       
       
        <br />
        <input type="hidden" name="ncHECK" value="<?PHP echo $NNN;?>" />
        
</form>        
 </div>
  <!-- Pie de PAgina -->
<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 3.0 </b></MARQUEE><br />copyright - 2014 Powered By MBR soluciones </div>
</body>
</html>
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

}
</script>