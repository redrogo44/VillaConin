<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
session_start();	
	require "configuraciones.php";
	validarsesion();
	conectar();
	$nivel=$_SESSION['niv'];
	menuconfiguracion();
	print_r($_POST);
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
				right:-140px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
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
							   font-size: 10px;
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
    
    
    <script type="text/javascript">

function asigna()
	{
		
		<?php
		$contra="";
		for($i=0;$i<=count($_POST);$i++)
		{
			$contra=$contra.$_POST[$i].",";	
		}
			$upd="UPDATE `Configuraciones` SET `valor`='".$numeroSemana = date("W")."' , `descripcion`='".$contra."' WHERE id=2";
			mysql_query($upd);
			$updis="UPDATE `Meseros` SET `disponibilidad`='no',`confirmacion`='no',`comentarios`='' WHERE 1";
			mysql_query($updis);							
		?>
		
		setTimeout ("redirecciona()", 300);
	}
	function redirecciona()
	{	
	//alert('SE GUARDARON CORRECTAMENTE LOS CONTRATOS DE LA SEMANA');	
		document.location =("Insert_Meseros.php");
	}
</script>
    
    
    
    
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
?>
<!--ESTILO CUERPO-->
<div align="center"  >
<br /><br /><br  style="background-position:center"/ >
   <!-- Tabala Pre-Registro -->
   <h1>MESEROS</h1>
   <br />
   <b>Contratos de la semana <a style="color:#F00"><?php echo $valor;?></a></b>
   <br />
   <table border="6" bordercolor="#990000">
   <tr>
   <?php 
   	for($i=1;$i<count($CONT);$i++)
	{
	echo "
			<td style='color:#0015FF'><b>".$CONT[$i]."</b></td>
			";
	}
	
   ?>
   </tr>
   </table>
   <br /><br />
 <div id="formulario" align="center"> 
 		<form  method="post" >
        	<table border="6" bordercolor="#990000">
            	<tr>	
                	<td ><b><a>Numero de Eventos de la Semana</a><a style="color:#00F"> <?php echo $numeroSemana = date("W"); ?></a></b></td><td width="5"><input  width="5px" size="5" type="number" name="campo"  /></td><td><input type="submit" class="button" value="Generar" name="crear" required="required"/></td>
                </tr>
            </table>
        </form>                
  </div>
  <div class="wrapper">
			<?php
			$cont="Select * From contrato Where Numero='".$_POST['campo']."'";
						$C=mysql_query($cont) or die(mysql_error());
						$contrato=mysql_fetch_array($C);
						$tcom=$contrato['c_adultos']+$contrato['c_ninos']+$contrato['c_jovenes'];
			
					
							if(isset($_POST['crear'])) 
							{	$var=1;
								echo "<form method='post'>
								<table align='center' border='6' bordercolor='#990000'>";
								for($i=1;$i<=$_POST['campo'];$i++)
								{
									echo "
											<tr>
												<td>Numero de Contrato # ".$i."</td><td><input type='text' name=".$i." required='required' /></td>
											</tr>
										";	
											
								}
								echo "</table>
								<br/>
								<br/><br/>
								<input type='submit' class='button' value='Guardar Eventos de la Semana ".$numeroSemana = date("W")."' onclick='asigna()'/>
										
									  </form>
									  ";
							}	
							
			?>
            
           

            
 </div>

   
  <!-- Pie de PAgina -->
<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 3.0 </b></MARQUEE><br />copyright - 2014 Powered By MBR soluciones </div>
</body>
</html>
