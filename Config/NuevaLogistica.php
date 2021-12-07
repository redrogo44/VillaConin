<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
require 'funciones2.php';
validarsesion();
conectar();
$nivel=$_SESSION['niv'];
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
 
 <title>Villa Conin</title>
    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:700px;
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


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">


<?php
print_r($_POST);
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

echo $_SESSION['lognumero']=$_POST['numero'];
// Cantidad de Comensales
echo "selct ".$stockM="select * from contrato where Numero='".$_POST['numero']."'";
$consulta=mysql_query($stockM);
$con=mysql_fetch_array($consulta);
$tcomen=$con['c_adultos']+$con['c_jovenes']+$con['c_ninos'];
echo "Total de manteles requeridos = ".$TMantelesRequeridos=($tcomen/9)+5; 
?> 

<script src="includes/prototype.js" type="text/javascript"></script>



<!--ESTILO CUERPO-->


<div align="center">		

	<br /><br /><br  style="background-position:center"/>
	
    <p><b><h2 style="color:#FC0316">LOGISTICA DEL EVENTO</h2></b></p><br /><br />
	<div class="wrapper wrapper-style4">		
    
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >    
<b>Numero de Activiades</b><input type="number" name="actividades" /><input type="submit" name="submit" class="" /><br /><br />
<input type='hidden' name='numero' value="<?php echo $_GET['numero']; ?>" />
</form>

	<?php
			
					if(isset($_POST['submit'])) 
					{
						
						echo $_POST['actividades'];
						echo "
							<form method='post' action='cargarmante.php'>
								<table border='6' bordercolor='#990000'>
									<tr>
										<td><b>NOMBRE DE LOS FESTEJADOS</b></td><td colspan='4' align='center'><input size='80px' type='text' name='festejados'/></td>									
									</tr>
									<tr>
										<td></td>
										<td align='center' style='color:#00F'><b>HORA DE INICIO</b></td>
										<td align='center' style='color:#060'><b>HORA DE FINALIZACION</b></td>
										<td align='center' style='color:#F00'><b>ACTIVIDAD</b></td>
									</tr>
									<tr>";
										for($i=1;$i<=$_POST['actividades'];$i++)
										{
											echo "
													<td align='center' style='color:#9".$i*$_POST['activiades']."0100'><b>ACTIVIDAD ".$i." :</b></td>
													<td align='center'><input  type='time' name='inicio".$i."'  id='hora".$i."'/> </td>
													<td align='center'><input  type='time' name='fin".$i."'  id='fin".$i."'/> </td>
													<td align='center'><textarea cols='40'  name='actividad".$i."'></textarea></td>
        </tr>		 
												 ";
												 
										}
									echo "</tr>
									
								</table>
							 ";
					}
	?>
    
<!--
    <form method="post" action="cargarmante.php">
    <table align="center" bgcolor="#FFFFFF" border="6px" bordercolor="#990000">
        <tr><td style="color:#00F" > <b>NOMBRE DE LOS FESTEJADOS:</b></td><td colspan="3px" align="center"><input  required="required"  name="festejados"size="80px" type="text"/></td></tr>
            <tr>
            <th></th>
            <th style="color:#060">HORA DE INICIO</th>
            <th style="color:#F00">HORA DE FINALIZACION</th>
            <th>ACTIVIDAD</th>
    
            </tr>
   		  <h3><b> ACTIVIDAD E INDICACIONES</b></h3><br /><br />
    	 <tr>
    		<td align="center"><b>ACTIVIDAD 1:</b></td>
			<td align="center"><input  type="time" name="hora1" name="roberto" id="hora1"/> </td>
		    <td align="center"> <input  type="time" name="fin1"/> </td>
		     <td  width="300px"align="center"><textarea cols="40" type="datetime" name="actividad1"></textarea></td>
	     </tr>
         <tr><td align="center"><b>ACTIVIDAD 2:</b></td>
        <td align="center"><input  type="time" name="hora2"/> </td>
         <td align="center"> <input  type="time" name="fin2"/> </td>
         <td align="center"><textarea cols="40" type="time" name="actividad2"></textarea></td>
        </tr>
         <tr>
		         <td align="center"><b>ACTIVIDAD 3:</b></td>
        <td align="center"><input  type="time" name="hora3"/> </td>
         <td align="center"> <input  typcols="40"type="time" name="fin3"/> </td>
         <td align="center"><textarea  	cols="40" name="actividad3"></textarea></td>
        </tr>
    	 <tr>
         <td align="center"><b>ACTIVIDAD 4:</b></td>
        <td align="center"><input  type="time" name="hora4"/> </td>
         <td align="center"> <input  type="time" name="fin4"/> </td>
         <td align="center"><textarea  cols="40" name="actividad4"></textarea></td>
        </tr>
         <tr>
         <td align="center"><b>ACTIVIDAD 5:</b></td>
        <td align="center"><input  type="time" name="hora5"/> </td>
         <td align="center"> <input type="time" name="fin5"/> </td>
         <td align="center"><textarea  cols="40" name="actividad5"></textarea></td>
        </tr>
         <tr>
         <td align="center"><b>ACTIVIDAD 6:</b></td>
        <td align="center"><input  type="time" name="hora6"/> </td>
         <td align="center"> <input  type="time" name="fin6"/> </td>
         <td align="center"><textarea  cols="40" name="actividad6"></textarea></td>
        </tr>
         <tr>
         <td align="center"><b>ACTIVIDAD 7:</b></td>
        <td align="center"><input type="time" name="hora7"/> </td>
         <td align="center"> <input  type="time" name="fin7"/> </td>
         <td align="center"><textarea  cols="40" name="actividad7"></textarea></td>
        </tr>
         <tr>
         <td align="center"><b>ACTIVIDAD 8:</b></td>
        <td align="center"><input  type="time" name="hora8"/> </td>
         <td align="center"> <input  type="time" name="fin8"/> </td>
         <td align="center"><textarea cols="40"  name="actividad8"></textarea></td>
        </tr>
         <tr>
         <td align="center"><b>ACTIVIDAD 9:</b></td><td align="center"><input  type="time" name="hora9"/> </td>
         <td align="center"> <input  type="time" name="fin9"/> </td><td align="center"><textarea  cols="40" name="actividad9"></textarea></td>
        </tr>
        <tr>
         <td align="center"><b>ACTIVIDAD 10:</b></td><td align="center"><input  type="time" name="hora10"/> </td>
         <td align="center"> <input  type="time" name="fin10"/> </td> <td align="center"><textarea  cols="40" name="actividad10"></textarea></td>
         </tr>
    </table>
 -->
    <table align="center" border="6px" bordercolor="#990000">
            <tr> <td align="center" width="200px"> <b>MENU</b></td><td width="100px" align="center"><textarea cols="40"  style="font-size-adjust:inherit"name="menu"></textarea></td></tr>
            <tr><td align="center"> <b>NIÑOS</b></td><td align="center"><textarea cols="40" name="ninos"></textarea></td></tr>
            
            <tr> <td align="center" >  <b>MANTELERIA</b></td><td align="center" rowspan="1" rowspan="2">
            
            <select multiple id='select'  name="select[]" size=15 style='color:#03F'  style="font-family:'Arial Black', Gadget, sans-serif" onclick="detalles();">
											</select>            
		
    </td>
        
            
            </td></tr></tr>
            	</td> </tr>
                <tr>
    	<td align="center">
        <b>DISPONIBILIDAD DE MANTELERIA</b>
	    </td>
        <td width="100px" colspan="2" align="center" bgcolor="#CCFF00">
        	<div id="descripcion">
    			    <b><small id="desc" ></small></b>
	        </div>
        </td>
    </tr>
            
            <tr> <td align="center"><b>OBSERVACIONES</b></td><td align="center"><textarea cols="40" name="observaciones"></textarea></td></tr>
            
    </table>
   <br />    <br />
   
    	<input type="submit" style="border-color:#000" style="background:#0F0x" value="Generar PDF de Logitica" style="color:#900"  border="3px"   onClick="seleccionar()"/>
        <input type="hidden" name="numero"  value="<?php echo $_POST['numero'];?>"/>
        <input type="hidden" name="actividades"  value="<?php echo $_POST['actividades'];?>"/>
        

    </form>
    <script type="text/javascript">
function imprime()
{
<?php	
	for ($i=0;$i<count($cervezas);$i++)    
	{     
		echo "<br> Cerveza " . $i . ": " . $cervezas[$i];    
	}
?>
}
function add1()
{
	if (getSelectText($('select'))!=null)
	{
		var option=new Element('option',{"value":$F('select')}).update(getSelectText($('select')));
		$('select2').appendChild(option);
		removeOption ($('select'), $F('select'))
	}
}
function add2()
{
	if (getSelectText($('select2'))!=null)
	{
		var option=new Element('option',{"value":$F('select2')}).update(getSelectText($('select2')));
		$('select').appendChild(option);
		removeOption ($('select2'), $F('select2'));
	}
}

function removeOption (element, id)
{
	var n=0;
	while(element.down(n)!=undefined)
	{
		if (element.down(n).getAttribute('value')==id)
		{
			element.down(n).remove();
		}
		n++;
	}
}

// funcion que devuelve el texto
function getSelectText(element)
{
	var n=0;
	while(element.down(n)!=undefined)
	{
		if (element.down(n).getAttribute('value')==element.getValue())
		{
			return(element.down(n).innerHTML)
		}
		n++;
	}
	return null;
}
function seleccionar(){
	select = document.getElementById("select2");
	for (var i = 0; i < select.options.length; i++) {
		select.options[i].selected = true;
	}
}

function detalles(){
	
		
			<?PHP 
							$q="Select total from TManteleria Where tipo='MANTELERIA'";
							$consulta=mysql_query($q);
							$var =1;
							while($con=mysql_fetch_array($consulta))
							{
								if($con['total']>$TMantelesRequeridos)
								{$Mensaje="Existen ".$con['total']." de los cuales se Requieren ".$TMantelesRequeridos." para este evento y sobraran ".($con['total']-$TMantelesRequeridos)." para algun otro Evento";
									echo "if(document.getElementById('select').value==".$var.")
											{
												document.getElementById('desc').innerHTML ='".$Mensaje."';
		 
											}";
								}
								else
								{$Mensaje="NO EXISTE DISPONIBILIDAD DE MATELERIA PARA ESTE EVENTO, SE REQUIEREN ".$TMantelesRequeridos." MANTELES PARA ESTE EVENTO Y SOLO HAY DISPONIBLES ".$con['total'];
								
									echo "if(document.getElementById('select').value==".$var.")
										{
											document.getElementById('desc').innerHTML ='".$Mensaje."';
	 
										}";
								}
										$var=$var+1;
							}
			?>
		
			
				
	}


<?PHP 


$q="Select producto,descripcion,total from TManteleria where tipo='MANTELERIA'";
$consulta=mysql_query($q);
$var =1;
while($con=mysql_fetch_array($consulta))
{
	
	
			$option=$con['producto']." ( ".$con['descripcion']." )";
			echo "var option = new Element('option',{'value':".$var."}).update('".$option."');
			$('select').appendChild(option);";
			$var=$var+1;
	
}


?>
// agrego valores al select


</script>
</div>
</div>
</body>
</body>

</html>
