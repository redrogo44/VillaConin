<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require 'funciones2.php';
include_once("funciones2.php");
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
<body>
 <title>Villa Conin</title>

    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:800px;
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
				.BOTON 
			{
				border: 3px solid #333333;
  border-radius: 3px;
  color: #FFFC00;
  background-color:#0441DD;
  display: inline-block;
  font: bold 12px/12px HelveticaNeue, Arial;
  padding: 8px 11px;
  text-decoration: none;
			}
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</body>
<!-- CUERPO DEL WEB-->
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
//print_r($_POST);
$clic=0;
?>
<!--ESTILO CUERPO-->
<div align="center">
	<br /><br /><br  style="background-position:center"/>
	<p><b><h2>Crear Abono</h2></b></p>
<div class="wrapper wrapper-style4">		
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		 
        <label><b>Numero de Contrato</b></label>
            <input type="text" name="campo" size="35" maxlength="35" required="required" placeholder="	Ingresa aqui tu numero de Contrato"  value="<?php echo $_POST['contrato']?>">
			<input type="submit" name="submit" value="Buscar">
		</form>
		</div>
		<div class="wrapper">
		
			<?php
			if(isset($_POST['campo'])){
				$q=mysql_query('Select * from contrato where Numero="'.$_POST['campo'].'"');
				$m=mysql_fetch_array($q);
				// echo "<pre>";
				// 	print_r($m);
				// echo "</pre>";
				if($m['estatus']==2 and $m['facturado']=='no'){
					echo "<script>";
					echo "alert('Error no se puede abonar a contratos ya finalizados')";
					echo "</script>";
					echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'>";
				}
			}						
			 $NSub=cantidad_subcontratos($_POST['campo']);
			if($NSub>=2&&$_POST['click']<1)
			{
					if(strlen($_POST['campo'])>=10)
					{
						Abo();
					}
						echo "<br><br>";
					 	$q="select * from contrato where Numero='".$_POST['campo']."'";
						$r=mysql_query($q);

						while($m=mysql_fetch_array($r))
						{
							if(validasubcontrato($_GET['numero']))
							{// valida si tiene subcontratos -> mostramos  listas de subcontratos
								$query="select * from contrato where Numero like ('".$_POST['campo']."%')";
								$result=mysql_query($query);
								echo '<table border="4px" bordercolor="#0033CC">';
								echo '<tr>
															<td align="center"><h6>Sub Contrato</h6></td>
										<td align="center">Nombre</td>
										<td align="center"><h6><b>Ver</b>	</h6></td>
									</tr>';
									while($subcontrato=mysql_fetch_array($result))
									{									
										echo "<tr>
										<td align='center'><h6><b>".$subcontrato['Numero']."</b></h6></td>
										<td align='center'><h6>".$subcontrato['nombre']."</h6></td>
										<td>
										<form action='' method='POST'>
											<input type='hidden' value=".$subcontrato['Numero']."  name='campo'/>
											<input type='hidden' value=".$clic++."  name='click'/>
											<input type='submit'  class='BOTON' value='REALIZAR ABONO'/>
										</form></td>
										</tr>"; 
									}
									echo '</table></div>';
						    }
			       		 }
			}
			
				
				
				else if(strlen($_POST['campo'])==8)
				{
					abonos();
					Abo();
				}
			
			else
			{
			
					if(isset($_POST['campo'])) 
					{
						Abo();
							//abonos();
						
					}					
					else
					{
						Abo();

						//abonos();

					}
					
					
				pie();
			}
			
			?>
</body>
<script>

function activar(valor){
	//alert(valor);
	if(valor != "Seleccione una Opcion" ){
	document.getElementById('enviar').disabled = false 
	}else {
	document.getElementById('enviar').disabled = true 
	}
	/*
	if(valor == "Pago en Efectivo" || valor=="Seleccione una Opcion"){
	document.getElementById('oculto').style.display = 'none';
	document.getElementById('cuenta').value = 'ninguna';
	}else{
	document.getElementById('oculto').style.display = 'block';
	}*/
}
</script>

<?php
function Abo()
{
	 				$nchars=strlen($_POST['campo']);
						if($nchars>=10)
						{

							$NumeroContrato=$_POST['campo'];
							$nc="Select nombre from contrato where Numero='".$NumeroContrato."'";
							$noc=mysql_query($nc);
							$Recibide=mysql_fetch_array($noc);
							$contrato=explode("-",$_POST['campo']);
						
							$se="Select * from contrato Where Numero='".$contrato[0]."'";
							$resultado=mysql_query($se);
							$muestra=mysql_fetch_array($resultado);
							echo "<tr>";
							
							$Nombre=$muestra['nombre']; 
							$fechaevento=$muestra['Fecha'];
							$TipoEvento=$muestra['tipo'];
							$Salon=$muestra['salon'];
							$fac=$muestra['facturado'];
													
					
										
										if($fac=='si')
										{
														$q="select max(id)'n' from abonofac";
														$r=mysql_query($q);
														$muestra=mysql_fetch_array($r);
														$numax=$muestra['n'];
										}
										else
										{
														$q="select max(id)'n' from abono";
														$r=mysql_query($q);
														$muestra=mysql_fetch_array($r);
														$numax=$muestra['n'];
										}
													$numax++;
													echo "</tbody>";echo"<br /><br  /><BR  />	";
													echo '<table>
																<tr><td>Folio</td><td>'.$numax.'</td></tr>
																</table>';
									echo "</table>";
							echo"<div align='center'>";
							echo"<form id='form1' name='form1' method='post' action='FormularioPDF/php/CargaAbono.php'>";
							  echo"<div id='apDiv1' align='center'>";
								echo"<table width='373' height='361' border='6' align='center' 	' border='6px' bordercolor='#990000'>";
								  echo"<tr>";
									echo"<td width='139'>Nombre de Contrato XXX</td>";
									echo"<td width='198' id='nomcontrato' >";echo $Nombre; echo"</td>";
								  echo"</tr>";
								  echo"<tr><td width='139'>Numero Contrato</td>";
									echo"<td width='198'>";echo $NumeroContrato; echo"</td>";
								  echo"</tr>";
								  echo"<tr>";
									echo"<td>Fecha</td>";
									echo"<td>";
									 echo date("d-m-Y");
									echo"</td>";
								  echo"</tr>";
								  echo"<tr>";
									echo"<td>Recibi de</td>";
									echo"<td>";
									echo"<input name='recibide' type='text'size='35' maxlength='35' value='".$Recibide['nombre']."'> </td>";
								  echo"</tr>";
								  echo"<tr>";
									echo"<td>Cantidad de</td>";
									echo"<td><input name='cantidadde' type='text' size='35' maxlength='35' value=''> </td>";
								  echo"</tr>";
								   echo"<tr>";
									echo"<td>Por Concepto de</td>";
									echo"<td><label for='oncepto'></label>";
									  echo"<select name='concepto' id='concepto'>";
										echo"<option value='Seleccione una Opcion'>Seleccione una Opcion</option>";
										echo"<option value='Pago con Cheque'>Pago con Cheque</option>";
										echo"<option value='Pago en Efectivo'>Pago en Efectivo</option>";
										 echo"<option value='Pago con Tarjeta'>Pago con Tarjeta</option>";
										echo"<option value='Deposito'>Deposito</option>";
										echo"<option value='Transferencia'>Transferencia</option>";
									   
								   echo" </select></td>";
								  echo"</tr>";
								  echo"<tr id='oculto'>
									  	<td>Cuenta</td>
											<td   style='display:block;'>
												<select id='cuenta' name='cuenta' >
												</select>
											</td>
									</tr>";
								  echo"<tr>";
									echo"<td>Fecha del Evento</td>";
									echo"<td>";
								  echo $fechaevento;
								  echo"</td>";
								  echo"</tr>";
								  echo"<tr>";
								   echo" <td>Tipo de Evento</td>";
									echo"<td>"; echo $TipoEvento; echo"</td>";
								  echo"</tr>";
								  echo"<tr>";
									echo"<td>Salon</td>";
									echo"<td>";echo $Salon; echo"</td>";
								  echo"</tr>";
							   
								  echo "<tr><td></td><td align='center'><a href='./index.php'><input id='enviar' type='submit' value='Enviar' disabled='true' ></a></td></tr>";
								 
								  echo "<tr><td>";
								  echo "<input type='hidden' name='nombre' value='".$Nombre."'>";
									echo "<input type='hidden' name='numero' value='".$NumeroContrato."'>";
								  echo "<input type='hidden' name='fecha_e' value='".$fechaevento."'>";
									echo "<input type='hidden' name='tipo' value='".$TipoEvento."'>";
									echo "<input type='hidden' name='salon' value='".$Salon."'>";
									echo "</td><td></td></tr>";
								
								echo"</table>";
							 echo" </div>";
		}					  echo"</form>";
			}
?>
<script type="text/javascript">

// Valores des la carga debancos b = id Banco y h elemento Html donde se cargaran los resultados
$("#concepto").change(function () {
	//alert("carga este pedo"+ this.value);
    carga_bancos(this.value, "#cuenta");
	activar(this.value);
});	
	function carga_bancos(b,h)
	{
		//alert(b);
		 var datos = {
                "accion":"todas_cuentas",
			    "id":b
            };
              $.ajax({
                    type: "POST",
                    url: "https://villaconin.mx/Config/Cuentas/acciones_cuentas.php",
                    data: datos,
                    dataType: "html",
                    beforeSend: function(){
                          console.log('Conexion correcta ajax '+b);
                    },
                    error: function(e){
                          alert("error petición ajax"+b);
                          //cargaExternos(tipo);
                    },
                    success: function(data){   
                           $(h).empty();                                       
                         //alert(data);  
                         $( h ).append( data );  
                         //console.log('cargo '+b+' # = '+h);
                    }
              });                
	}
</script>	
</html>