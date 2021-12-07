<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
date_default_timezone_set("America/Mexico_City");
require('../funciones2.php');
validarsesion2();
//require_once("class/class.php");
//print_r($_GET);

conectar();
$tra=new Trabajo();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="pro_dropdown_3/pro_dropdown_3.css" />
<link rel="stylesheet" type="text/css" href="estilos.css" />
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
		<!-- ALERTAS -->
		<script type="text/javascript" src="lib/alertify.js"></script>
		<link rel="stylesheet" href="themes/alertify.core.css" />
		<link rel="stylesheet" href="themes/alertify.default.css" />
		<!--	TERMINA ALERTAS -->
		<!--	ventana emergente -->
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>

   <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    
		<!--	TERMINA ventana emergente -->


<title>Villa Conin</title>
<!--   		MENU	-->
<ul id="nav">
	<li class="top"><a href="../index.php" class="top_link"><span>Inicio</span></a></li>
	<li class="top"><a  class="top_link"><span class="down">Productos</span></a>
    	<ul class="sub">
			<li><a href="#d" name="productos" onclick="muestra(this.name);" id="products" >Registra</a></li>
			<?php if($_SESSION["niv"]!=4){ ?>
            <li><a href="#red" name="modifica_p" onclick="muestra(this.name);">Modifica Producto</a></li>
			<?php } ?>
		</ul>
    </li>
	<li class="top"><a href="#nogo22" id="services" class="top_link"><span class="down">Eventos de Recaudacion</span></a>
		<ul class="sub">
			<li><a href="#nogo23" name="nuevo_e" onclick="muestra(this.name);">Nuevo Evento</a></li>
			<li><a href="#nogo24" name="ver_e" onclick="muestra(this.name);">Ver Eventos</a></li>
			<?php if($_SESSION["niv"]!=4){ ?>
			<li><a href="#nogo25" name="elimina_e" onclick="muestra(this.name);">Cancelar Eventos</a></li>
			<?php } ?>
			<li><a href="#nogo26" name="modificar" onclick="muestra(this.name);">Modificar</a></li>
		</ul>
	</li>
	<li class="top"><a href="#nogo27" id="contacts" class="top_link"><span class="down">Reportes</span></a>
		<ul class="sub">
			<li><a href="#nogo28">Eventos</a>
				<ul>
					<li><b>Eventos</b></li>
					<li><a href="#nogo34" name='ver_e_final' onClick="muestra(this.name);">Finalizados</a></li>
					<li><a href="#nogo44" name="ver_e" onclick="muestra(this.name);">Pendientes</a></li>													
					<li><a href="#nogo44" name="ver_ecancelado" onclick="muestra(this.name);">Cancelados</a></li>													

				</ul>
			</li>
			<li><a href="#nogo49">Tickets</a>
				<ul>
					<li><b>Tickets</b></li>
					<li><a href="#nogo30" name="muestra_ticket" onclick="muestra(this.name);">Lista de Tickets</a></li>	
					<li><a href="#nogo560" name="muestra_ticket_cancelado" onclick="muestra(this.name);">Tickets Cancelados</a></li>	
				</ul>
			</li>			
		</ul>
	</li>
	<?
	$fg="SELECT * FROM Eventos_Recaudacion WHERE fecha>='".dia_anterior()."' and fecha<='".date('Y-m-d')."'";
	$fr=mysql_query($fg);
	if(mysql_num_rows($fr)>0)
	{
		$uss=mysql_query("SELECT * FROM usuarios WHERE usuario='".$_SESSION['usu']."' ");
		$usc=mysql_fetch_array($uss);
		if($usc=='')
		{

		}
		else
		{
			echo'<li class="top"><a href="#nogo53" id="shop" class="top_link" name="vender" onclick="muestra(this.name);"><span class="down">Vender</span></a></li>';		
		}
	}
	?>
	<li class="top"><a href="#nogo53" id="shop" class="top_link" name='vender' onclick="corte_caja();"><span class="down">Corte Caja</span></a></li>
	<li class="top"><a href="#nogo53" id="shop" class="top_link" name='actualiza invetario' onclick="actuliza_todo();"><span class="down">Actualiza Inventarios</span></a></li>
</ul>
<!--////////////////////////////////////////////////////7-->

</head>
<?php
//print_r($_SESSION);	
?>
<!-- CUERPO DEL WEB-->
<body   bgcolor="#FFFFFF" onload="valida_usr_contrato();">
<img id='logo' src="../Imagenes/Villa Conin.png" border="0">
<div id='contenido'>
				<div id="nuevo_e" style="display: none;" align="center">
				<form action="Accion_Recaudacion.php" method="post" name="recaudacion">
			        <table border="5" >
			           <th colspan="2"><font><b>Nuevo Evento de Recaudación</b></font></th>
			           <tr><td><b>Fecha</b></td><td><input type="date" name="fecha" id="fecha" onchange="valida_Fecha(this.value)" /></td></tr>
			           <tr>
			           		<td><b>Salon</b></td>
			           		<td>          
					 				 <select name="salon" id='salon' onchange="valida_Salon(this.value)">
									      <option >SELECCIONE UNA OPCION</option>
								          <option value='Fundador de Conin'>Fundador de Conin</option>
								          <option value='Alcazar de Conin'>Alcazar de Conin</option>
								          <option value='Real de Conin'>Real de Conin</option>
								          <option value='Solar de Conin'>Solar de Conin</option>
										  <option value='Marques'>Marqués</option> 
								    </select>
			           		</td>
			           </tr>
			           <tr>
			           		<td><b>Con Referencia</b></td>
			           		<td align="center"> Si	<input type="checkbox" name="si_existe" id="si_existe" onchange="mostrar_referencia(this.name);" /> </td>
			           </tr>
			           <tr  style="display: none;" id="referencia"><td><b>Contrato Referencia</b></td><td><input type="text"  name="referencia" id="contrato_referencia" onchange="buscar_contrato(this.value);" /></td></tr>
			           <tr><td><b>Nombre del Cliente</b></td><td><input type="text" name="cliente" id="cliente" /></td></tr>
			           <tr><td><b>Comesales</b></td><td><input type="number" name="comensales" id="comensales"/></td></tr>
			           <tr><td><b>Vendedor</b></td>
			           	   <td>
			           	   	   <select name="vendedor" id='vendedor' onchange="valida_Contrato()">
				               <option>SELECCIONE UNA OPCION</option>
									<?php
									$us=mysql_query("SELECT * FROM usuarios WHERE nivel=4");
						            while($vendedor=mysql_fetch_array($us))
						            {
						                echo "Vendedro ".$vendedor['usuario'];
						                $usua=explode(' ', $vendedor['usuario']);
							               echo " <option value='".$usua[1]."'>".$usua[1]."</option>";
						            }
						             ?>
			      			   </select>
			           	  	</td>
			           	</tr>
			        </table>
			        <input type="hidden" name='accion' value="nuevo"/>
			    </form>
			    <div align="center">
			    <br></br>
			    	<input type="button" value='Guardar Evento' onclick="enviar_formulario();">
			    </div>
			</div>
			<div id="ver_e" style="display: none;" align="center">
				<table border="5">
				<th colspan='5'><b>EVENTOS PENDIENTES</b></th>
					<tr>
					<td align='center'><b>Numero</b></td>
					<td align='center'><b>Fecha</b></td>
					<td align='center'><b>Salon</b></td>
					<td align='center'><b>Comensales</b></td>
					<td align='center'><b>Cliente</b></td>
					</tr>
					<?php
					$Se=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE fecha>='".date('Y-m-d')."' and estatus='ACTIVO'");
					while($Er=mysql_fetch_array($Se))
					{
						echo "

							 <tr>
									<td align='center'>".$Er['Numero']."</td>
									<td align='center'>".$Er['fecha']."</td>
									<td align='center'>".$Er['salon']."</td>
									<td align='center'>".$Er['comensales']."</td>
									<td align='center'>".$Er['cliente']."</td>					
						  	 </tr>";
					}
					
					?>
				</table>
			</div>
			<div id="elimina_e" style="display: none;" align="center">
			<table border="5">
				<th><b>Numero</b></th>
				<th><b>Fecha</b></th>
				<th><b>Salon</b></th>
				<th><b>Comensales</b></th>
				<th><b>Cliente</b></th>
				<th><b>Eliminar</b></th>
				<?php
				echo date('Y-m-d');
				$Se=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE fecha>='".date('Y-m-d')."' and estatus='ACTIVO'");
				while($Er=mysql_fetch_array($Se))
				{
					echo "<tr>
								<td align='center'>".$Er['Numero']."</td>
								<td align='center'>".$Er['fecha']."</td>
								<td align='center'>".$Er['salon']."</td>
								<td align='center'>".$Er['comensales']."</td>
								<td align='center'>".$Er['cliente']."</td>					
								<td align='center'>						
										<input type='button' value='CANCELAR' onclick='enviar_formulario_eliminar(".$Er['id'].");'/>
								</td>					
					  	 </tr>";
				}
				
				?>
			</table>
			</div>

			<div id="modificar" style="display: none;" align="center">
			<form action="Accion_Recaudacion.php" method="post">
			<table border="5">
				<th><b>Id</b></th>
				<th><b>Numero</b></th>
				<th><b>Fecha</b></th>
				<th><b>Salon</b></th>
				<th><b>Comensales</b></th>
				<th><b>Cliente</b></th>			
				<?php
				//echo date('Y-m-d');
				$Se=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE fecha>='".date('Y-m-d')."' AND estatus='ACTIVO'");
				$inc=0;
				$filas=mysql_num_rows($Se);
				while($Er=mysql_fetch_array($Se))
				{
					$inc++;
					echo "<tr>
								<td align='center'>".$Er['id']."</td>
								<td align='center'>".$Er['Numero']."</td>
								<td align='center'><input type='date' name='fecha".$inc."' id='fecha".$inc."' value='".$Er['fecha']."' onchange='valida_Fecha(this.value)' title='fecha".$inc."' readonly='readonly'/></td>
								<td align='center'><b>".$Er['salon']."</b></td>
								<td align='center'><input type='number' value='".$Er['comensales']."' name='comensales".$inc."' id='comensales".$inc."' title='comensales".$inc."' /></td>
								<td align='center'><input type='text' name='cliente".$inc."' value='".$Er['cliente']."' id='cliente".$inc."' title='cliente".$inc."' readonly='readonly' /></td>																								
								<input type='hidden' name='id".$inc."' value='".$Er['id']."' />

					  	 </tr>";
				}
				
				?>
			</table>
			<br></br>
			<input type='hidden' name='filas' value='<?php echo $inc; ?>' />			
			<input type='hidden' name='accion' value='modifica_evento' />					
			<input type="submit" value="Guardar Cambios" />
			</form>
			</div>
			<!--////////////////////		VENTA INICIA		////////////////////////-->
			<div id="vender" style="display: none;" align="center">
			
            <?php
	//		echo 
		function dia_anterior()
		{
    		$sol = (strtotime(date('Y-m-d')) - 3600);
    		return date('Y-m-d', $sol);
		}  
		$fg="SELECT * FROM Eventos_Recaudacion WHERE fecha>='".dia_anterior()."' and fecha<='".date('Y-m-d')."'";
			$f=mysql_query($fg);
			if(mysql_num_rows($f)<1||isset($_GET['error'])and $_GET['error']==1)
			{
			echo"
					<script>
					alertify.alert('EL DIA DE HOY NO EXISTE NINGUN EVENTO DE RECAUDACION');
					$('#vender').hide();				
					$('#ver_e_final').hide();
					$('#datos_compra').hide();	
					$('#muestra_ticket').hide();	
					</script>
				  ";
			}
			else
			{
				
					?>
             			<b>VENTA DE PRODUCTOS CONTRATO: <font color="#4C70FF"><label id="mc"></label></font></b>
	             		<br></br>
	                    <div id="consulta_productos">			
	                        <input type="text" name="codigo" id='codigo' onchange="busca_producto(this.value);" />
	                        <br></br>
	                        <form name="guarda_ticket" id="guarda_ticket" action="Accion_Recaudacion.php" method="post" >
	                            <table  name='productos_activos' id='productos_activos'>
	                                <th colspan="7"><b></b>PRODUCTOS CARGADOS</b></th>
	                                <tr>
	                                    <td align="center"><b>#</b></td>
	                                    <td align="center"><b>Producto</b></td>
	                                    <td align="center"><b>Descripcion</b></td>
	                                    <td align="center"><b>Cantidad</b></td>
	                                    <td align="center"><b>Precio Unitario</b></td>
	                                    <td align="center"><b>Total</b></td>
	                                    <td align="center"><b>Eliminar</b></td>
	                                </tr>						                                                                   
	                            </table>
                                 <div  id='totales' style="display: none;" align="right">
	                                <font color="#F000"><b>TOTAL </b></font><input id='Total-t' type="text" name="Total"  readonly='readonly' style='width:60px;' title='total_venta' />
	                                </div>
	                            <input type="hidden" name="accion" value="registra_ticket" />
	                              <input type="hidden" name="filas" id='filas' />
	                              <input type="hidden" name="ids_vinos" id='id_vinos' />
	                              <input type="hidden" name="productos_v" id='productos_v' />
	                              <input type="hidden" name="paga" id='paga' />
	                             <input type="hidden" name="referencia" id='c_referencia' />
	                            
                                 <input type="hidden" name="registro" value='<?php echo $_SESSION['usu'];?>' />
	    
	                        </form>
	                        <input type="button" value="Imprimir Ticket" onclick="imprime_tiket();"/>
	                    </div>
                	<?php
                }
				?>
			</div>			
			<!--////////////////////		TERMINA VENTA	////////////////////////-->
            <div id="modifica_p" style="display: none;" align="center">
            <font color="#0033FF"><b>ACTUALIZAR PRODUCTOS</b></font>
            <br>
            	<form  action="Accion_Recaudacion.php" method="post" name="actualiza_p">
                	<table border="5">
                    	<th colspan="5">LISTA DE PRODUCTOS ALIMENTOS</th>
                        <tr>
                        	<td align="center"><b>Nombre</b></td>
                            <td align="center"><b> Descripcion</b></td>
                            <td align="center"><b>Precio</b></td>
                        </tr>
                        <?php
						$inc=1;
							$p=mysql_query("SELECT * FROM productos_tiendita order by nombre");
							while($pro=mysql_fetch_array($p))
							{
								echo "<tr>
										<td align='center'><input type='text' name='nombre".$inc."' value='".$pro['nombre']."' /></td>
                          				<td align='center'><input type='text' name='descripcion".$inc."' value='".$pro['descripcion']."' /></td>
			                            <td align='center'><input type='text' name='precio".$inc."' value='".money_format("%i",$pro['precio'])."' style='width:60px;' /></td>
										 <td align='center' style='display: none;'><input type='hidden' name='id".$inc."' value='".$pro['id']."' style='width:60px;' /></td>
									</tr>
									 ";
									 $inc++;
							}
                        ?>
                    </table>
                    <input type="hidden" name='n_productos' value="<?php echo $inc;?>" />
                     <input type="hidden" name='accion' value="actualiza_productos" />
                </form>
                <br>
                <input type="button" value="Guardar Productos" onClick="pregunta44();"/>
                <br></br>
                <br></br>
                <div>
                	<form  action="Accion_Recaudacion.php" method="post" name="actualiza_pv">
                	<table border="5" class="tabla_productos" border="1">
                    	<th colspan="5">LISTA DE PRODUCTOS VINOS</th>
                        <tr>
                        	<td align="center"><b>Nombre</b></td>
                            <td align="center"><b> Descripcion</b></td>
                            <td align="center" ><b>Precio</b></td>
                        </tr>
                        <?php
						$inc=1;
							$p=mysql_query("SELECT * FROM producto WHERE id_categoria=1 order by nombre");
							while($pro=mysql_fetch_array($p))
							{
								$i=mysql_query("SELECT * FROM inventario WHERE id_producto=".$pro['id_producto']);
								$pre=mysql_fetch_array($i);

								echo "<tr>
										<td align='center'><input type='text' name='nombre".$inc."' value='".$pro['nombre']."' readOnly='readOnly' /></td>
                          				<td align='center'><input type='text' name='descripcion".$inc."' value='".$pro['descripcion']."' readOnly='readOnly' /></td>
			                            <td align='center' style='width:100px;' ><input type='text' name='precio".$inc."' value='".money_format("%i",$pre['precio_tienda'])."'  /></td>
										 <td align='center' style='display: none;'><input type='hidden' name='id-".$inc."' value='".$pro['id_producto']."' style='width:60px;' /></td>
									</tr>
									 ";
									 $inc++;
							}
                        ?>
                    </table>
                    <input type="hidden" name='n_productos' value="<?php echo $inc;?>" />
                     <input type="hidden" name='accion' value="modifica_producto_vinos" />
                </form>
                <br>
                <input type="button" value="Guardar Productos" onClick="pregunta444();"/>               
                <br></br>
                </div>
            </div>
			<!--////////////////////		INICIA	PRODUCTOS	////////////////////////-->
			<div id="productos" style="display: none;" align="center">
			<div align="center">
			<font color="#0033FF"><b>REGISTRO DE PRODUCTOS</b></font>
			<br></br>
				<form action='Accion_Recaudacion.php' id='fproductos' name='fproductos' method="post">
					<table border="5" id='nuevo_producto'>
						<th colspan="3"><b>NUEVO PRODUCTO</b></th>
						<tr>
							<th>Nombre</th>
							<th>Descripcion</th>
							<th>Precio</th>					
						</tr>			
					</table>
					<br></br>
					<input type="hidden" name='accion' id='accionnp' />
					<input type="hidden" name='filas' id='filasnp' />
				</form>
				<?php if($_SESSION["niv"]!=4){ ?>
					<input type="button" value='Agregar Fila' onclick=" agregar_fila();" />
					<input type="button" value='Registrar Productos' name='accion' onclick="enviar_nuevos_productos();" />
				<?php } ?>
				<input type="button" value='Imprimir Codigos'  onclick="imprime_productos();" />
				</div>
				<!--  ////////////////////////7//	LISTA DE PRODUCTOS	\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\			-->
				<div align="center">
				<h1>Listado de Productos</h1>
				<table>
				<th colspan="4"><font color="#0080FF"><b>ALIMENTOS</b></font></th>
					<tr style="background-color:#666; color:#FFF">
					<td valign="top" align="center" style="width:350px;">Producto</td>
					<td valign="top" align="center" style="width:100px;">Precio</td>
					<td valign="top" align="center">Fecha</td>
					<td valign="top" align="center" style='width:280px;'>Código</td>
					</tr>
					<?php
						$d=mysql_query("SELECT * FROM productos_tiendita");
						while($da=mysql_fetch_array($d))
						{
							echo "
									<tr>
										<td align='center'>".$da['nombre']." ".$da['descripcion']."</td>
										<td align='center' bgcolor='#DEE9BF'> $ ".money_format("%i",$da['precio'])."</td>
										<td align='center'>".$da['fecha']."</td>
										<td>
											<img id='codigos' src=Codigos2/Modulos/principal/".$da['codigo'].".gif >
											<label>".$da['codigo']."</label>
										</td>	
									</tr>
								 ";
						}
					?>
				</table><br>
				<table>
				<th colspan="4"><font color="#6600CB"><b>BEBIDAS</b></font></th>
					<tr style="background-color:#666; color:#FFF">
					<td valign="top" align="center" style="width:350px;">Producto</td>
					<td valign="top" align="center"  style="width:100px;">Precio</td>
					<td valign="top" align="center" style='width:380px;'>Código</td>
					</tr>
					<?php
						$d=mysql_query("SELECT * FROM producto WHERE id_categoria=1");
						while($da=mysql_fetch_array($d))
						{
							$precio=mysql_query("SELECT * FROM inventario where id_producto=".$da['id_producto']);
							$pre=mysql_fetch_array($precio);
							echo "
									<tr>
										<td align='center'>".$da['nombre']." ".$da['descripcion']."</td>
										<td align='center'  bgcolor='#DEE9BF'> $ ".money_format("%i",$pre['precio_tienda'])."</td>										
										<td align='center'>
											<img id='codigos' src=Codigos2/Modulos/principal/".$da['codigo'].".gif ><span>".$da['codigo']."</span>
										</td>	
									</tr>
								 ";
						}
					?>
				</table>
				</div>
				<!--  ///////////////////////77/	TERMINA LISTA DE PRODUCTOS  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\			-->
			</div>
			<!--////////////////////		TERMINA PRODUCTOS		////////////////////////-->
            
<div id="ver_e_final" style="display: none;" align="center">
<table border="5">
				<th colspan="6"><b>EVENTOS FINALIZADOS</b></th>
				<tr>
					<td align='center'><b>Numero</b></td>
					<td align='center'><b>Fecha</b></td>
					<td align='center'><b>Salon</b></td>
					<td align='center'><b>Comensales</b></td>
					<td align='center'><b>Cliente</b></td>
					<td align='center'><b>Total Vendido</b></td>
				</tr>
					<?php

					$Se=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE fecha<'".date('Y-m-d')."' AND estatus='ACTIVO' ");
					while($Er=mysql_fetch_array($Se))
					{
						$total_Vendido=0;
						 $ref="SELECT * FROM tickets WHERE referencia='".$Er['Numero']."' AND estatus='ACTIVO' ";
						
						$t=mysql_query($ref);
						while ($ti=mysql_fetch_array($t)) 
						{
							$tot=explode(",",$ti['totales']);
							for ($i=1; $i <count($tot); $i++) 
							{ 
								$total_Vendido=$total_Vendido+$tot[$i];
							}
						}
						$tv=mysql_query("SELECT * FROM tickets_vinos WHERE referencia='".$Er['Numero']."' AND estatus='ACTIVO' ");
						while ($tiv=mysql_fetch_array($tv)) 
						{
							$tot=explode(",",$tiv['totales']);
							for ($i=1; $i < count($tot); $i++) 
							{ 
								$total_Vendido=$total_Vendido+$tot[$i];
							}
						}
						
						echo "<tr>
									<td align='center'>".$Er['Numero']."</td>
									<td align='center'>".$Er['fecha']."</td>
									<td align='center'>".$Er['salon']."</td>
									<td align='center'>".$Er['comensales']."</td>
									<td align='center'>".$Er['cliente']."</td>					
									<td align='center' bgcolor='#E6F1C4'>$".money_format("%i",$total_Vendido)."</td>					
						  	 </tr>";
					}
					
					?>
				</table>
</div>
<!-- 	EVENTOS CANCELADOS-->
<div id="ver_ecancelado" style="display: none;" align="center">
<table border="5">
				<th colspan="5"><b>EVENTOS CANCELADOS</b></th>
				<tr>
					<td align='center'><b>Numero</b></td>
					<td align='center'><b>Fecha</b></td>
					<td align='center'><b>Salon</b></td>
					<td align='center'><b>Comensales</b></td>
					<td align='center'><b>Cliente</b></td>
				</tr>
					<?php
					$Se=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE estatus='CANCELADO'");
					while($Er=mysql_fetch_array($Se))
					{
						echo "<tr>
									<td align='center'>".$Er['Numero']."</td>
									<td align='center'>".$Er['fecha']."</td>
									<td align='center'>".$Er['salon']."</td>
									<td align='center'>".$Er['comensales']."</td>
									<td align='center'>".$Er['cliente']."</td>					
						  	 </tr>";
					}
					
					?>
				</table>
</div>

<div id="muestra_ticket_cancelado" style="display: none;" align="center">
<table border="5">

<th colspan="6">Tickets Alimentos Cancelados Usuario: <?php echo $_SESSION['usu']?></th>
	<tr>
		<td align="center">Folio</td>
		<td align="center">Total Vendido</td>
		<td align="center">Fecha</td>
		<td align="center">Contrato Referencia</td>
		<td align="center">Detalles</td>
	</tr>
	<tr>
		<?php
		//echo date('Y-m-d');
		//echo "<'br>".
		if($_GET['error']!=1)
		{
			$t_ticket_cancelado=0;$t_ticket_cancelado_b=0;
		$u=mysql_query("SELECT * FROM usuarios WHERE usuario='".$_SESSION['usu']."'" );
		$nu=mysql_fetch_array($u);
		//print_r($_SESSION);
			$Ti="SELECT * FROM tickets WHERE referencia='".$nu['Contrato']."' and registro='".$_SESSION['usu']."' and estatus='CANCELADO' and corte!='si' ";
			$tii=mysql_query($Ti);
			while($tic=mysql_fetch_array($tii))
			{
				$t_ticket_cancelado=$t_ticket_cancelado+$tic['Total'];
				echo '
				<tr>
					<td align="center">'.$tic['folio'].'</td>
					  <td align="center">'.money_format("%i",$tic['Total']).'</td>
					  <td align="center">'.$tic['fecha'].'</td>
					  <td align="center">'.$tic['referencia'].'</td>
					  <td align="center"><input type="button" id="'.$tic['id'].'" name="alimento" value="Detalle" onclick="abrir_dialog(this.id,this.name)"/></td>
					</tr> ';		
			}
		}
		?>
	</tr>
	<tr><td align="right"><b>Total</b></td><td align="center"><?php echo money_format("%i", $t_ticket_cancelado); ?></td></tr>			
</table>
<div align="center">
<table border="5">
	<th colspan="6">Tickets Bebidas Canceladas Usuario: <?php echo $_SESSION['usu']?></th>
	<tr>
		<td align="center">Folio</td>
		<td align="center">Total Vendido</td>
		<td align="center">Fecha</td>
		<td align="center">Contrato Referencia</td>
		<td align="center">Detalles</td>		
	</tr>
	<tr>
		<?php
		//echo date('Y-m-d');
		//echo "<br>".
		if($_GET['error']!=1)
		{
		$u=mysql_query("SELECT * FROM usuarios WHERE usuario='".$_SESSION['usu']."'" );
		$nu=mysql_fetch_array($u);
		//print_r($_SESSION);
			$Ti="SELECT * FROM tickets_vinos WHERE referencia='".$nu['Contrato']."' and registro='".$_SESSION['usu']."' and estatus='CANCELADO' and corte!='si'";
			$tii=mysql_query($Ti);
			while($tic=mysql_fetch_array($tii))
			{
				  $all="SELECT * FROM tickets_vinos WHERE id=".$tic['id'];
				 	$aa=mysql_query($all);
				 	 $ti=mysql_fetch_array($aa);
			  /// DATOS DE PROSUCTO
			   $total=explode(",",$ti['totales']);			  
			    $tot=0;
				for($i=1;$i<count($total);$i++)
				{
					$tot=$tot+$total[$i];				
				}
		$t_ticket_cancelado_b=$t_ticket_cancelado_b+$tot;		
				echo '
				<tr><td align="center">'.$tic['folio'].'</td>
					  <td align="center">'.money_format("%i",$tot).'</td>
					  <td align="center">'.$tic['fecha'].'</td>
					  <td align="center">'.$tic['referencia'].'</td>
					  <td align="center"><input type="button" id="'.$tic['id'].'" name="bebida" value="Detalle" onclick="abrir_dialog(this.id,this.name);"/></td>
					</tr> ';		
			}
		}
		?>
	</tr>
	<tr><td align="right"><b>Total</b></td><td align="center"><?php echo money_format("%i", $t_ticket_cancelado_b); ?></td></tr>		
</table>
</div>
</div>
<div id="muestra_ticket" style="display: none;" align="center">
<table border="5">
	<th colspan="6">Tickets Alimentos Usuario: <?php echo $_SESSION['usu']?></th>
	<tr>
		<td align="center">Folio</td>
		<td align="center">Total Vendido</td>
		<td align="center">Fecha</td>
		<td align="center">Contrato Referencia</td>
		<td align="center">Detalles</td>
		<td align="center" bgcolor="#F000"><font color="#FFF700"><b>Cancelar</b></font></td>
	</tr>
	<tr>
		<?php
		$t_ticket_activo=0;
		$t_ticket_activo_b=0;
		//echo date('Y-m-d');
		//echo "<'br>".
		if($_GET['error']!=1)
		{
		$u=mysql_query("SELECT * FROM usuarios WHERE usuario='".$_SESSION['usu']."'" );
		$nu=mysql_fetch_array($u);
		//print_r($_SESSION);
			//echo $Ti="SELECT * FROM tickets WHERE referencia='".$nu['Contrato']."' and registro='".$_SESSION['usu']."' and estatus='ACTIVO' and corte!='si'";
			 $Ti="SELECT * FROM tickets WHERE referencia='".$nu['Contrato']."' and registro='".$_SESSION['usu']."' and estatus='ACTIVO'";
			$tii=mysql_query($Ti);
			while($tic=mysql_fetch_array($tii))
			{
				$t_ticket_activo=$t_ticket_activo+$tic['Total'];
				echo '
				<tr><td align="center">'.$tic['folio'].'</td>
					  <td align="center">'.money_format("%i",$tic['Total']).'</td>
					  <td align="center">'.$tic['fecha'].'</td>
					  <td align="center">'.$tic['referencia'].'</td>
					  <td align="center"><input type="button" id="'.$tic['id'].'" name="alimento" value="Detalle" onclick="abrir_dialog(this.id,this.name)"/></td>
					  <td align="center"><img src="X.png" style="width:30px;" name="alimentos" onclick="elimina_ticket('.$tic['id'].' ,this.name);" title="Elimina Ticket" /></td>
					</tr> ';		
			}
		}
		?>
	</tr>
	<tr><td align="right"><b>Total</b></td><td align="center"><?php echo money_format("%i", $t_ticket_activo); ?></td></tr>
</table>
<div align="center">
<table border="5">
	<th colspan="6">Tickets Bebidas Usuario: <?php echo $_SESSION['usu']?></th>
	<tr>
		<td align="center">Folio</td>
		<td align="center">Total Vendido</td>
		<td align="center">Fecha</td>
		<td align="center">Contrato Referencia</td>
		<td align="center">Detalles</td>
		<td align="center" bgcolor="#F000"><font color="#FFF700"><b>Cancelar</b></font></td>
	</tr>
	<tr>
		<?php
		//echo date('Y-m-d');
		//echo "<br>".

		if($_GET['error']!=1)
		{
		$u=mysql_query("SELECT * FROM usuarios WHERE usuario='".$_SESSION['usu']."'" );
		$nu=mysql_fetch_array($u);
		//print_r($_SESSION);
			$Ti="SELECT * FROM tickets_vinos WHERE referencia='".$nu['Contrato']."' and registro='".$_SESSION['usu']."' and estatus='ACTIVO' and corte!='si' ";
			$tii=mysql_query($Ti);
			$t_ticket_activo_b=0;
			while($tic=mysql_fetch_array($tii))
			{
				  $all="SELECT * FROM tickets_vinos WHERE id=".$tic['id'];
				 	$aa=mysql_query($all);
				 	 $ti=mysql_fetch_array($aa);
			  /// DATOS DE PROSUCTO
			   $total=explode(",",$ti['totales']);			  
			    $tot=0;
				for($i=1;$i<count($total);$i++)
				{
					$tot=$tot+$total[$i];				
				}
				$t_ticket_activo_b=$t_ticket_activo_b+$tot;
				echo '
				<tr><td align="center">'.$tic['id'].'</td>
					  <td align="center">'.money_format("%i",$tot).'</td>
					  <td align="center">'.$tic['fecha'].'</td>
					  <td align="center">'.$tic['referencia'].'</td>
					  <td align="center"><input type="button" id="'.$tic['id'].'" value="Detalle" name="bebida" onclick="abrir_dialog(this.id,this.name)"/></td>
					  <td align="center"><img src="X.png" style="width:30px;" name="vinos" onclick="elimina_ticket('.$tic['id'].' ,this.name);" title="Elimina Ticket" /></td>
					</tr> ';		
			}
		}
		?>
	</tr>
	<tr><td align="right"><b>Total</b></td><td align="center"><?php echo money_format("%i", $t_ticket_activo_b); ?></td></tr>	
</table>
</div>
</div>
<!-- PRODUCTO PARA LA COMPRA -->
<div id="dialog" title="Detalle de Ticket" style="display:none;">
  
</div>			
</body>
<?php
class Trabajo
{
	private $pro;
	
	public function __construct()
	{
		$this->pro=array();
	}
	
	public function get_productos()
	{
		$sql="SELECT * FROM `productos_tiendita`";
		$res=mysql_query($sql);
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->pro[]=$reg;
		}
			return $this->pro;
	}
}
function validarsesion2(){
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expi
	res: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	if(!isset($_SESSION['nombre'])  || !isset($_SESSION['esta']) || !isset($_SESSION['usu'])){
		echo '<meta http-equiv="refresh" content="0">';
		echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../login.php'>";
		exit();
	}
	elseif(empty($_SESSION['nombre']) || empty($_SESSION['esta']) || empty($_SESSION['usu'])){
		echo '<meta http-equiv="refresh" content="0">';
		echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../login.php'>";
		exit();
	}else{
//	echo '<script language="javascript">href.location="index.php";</script>';
	}
	
}
?>
<script>
function mostrar_referencia()
{
if (!document.getElementById) return false;
  fila = document.getElementById('referencia');
  if (fila.style.display != "none") {
    fila.style.display = "none"; //ocultar fila 
  } else {
    fila.style.display = ""; //mostrar fila 
  }
}
function valida_Salon(sal)
{
	//alert('salon 2 '+ sal);
		var xmlhttp3;
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp3=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");
				  }
					xmlhttp3.onreadystatechange=function()
				  {
				  if (xmlhttp3.readyState==4 && xmlhttp3.status==200)
				    {
				    	var xxzz=xmlhttp3.responseText;
				    	//alert(xxzz);
				    	if (xxzz!='0')
				    		{
				    			alertify.alert('YA EXISTE UN CONTRATO CON ESA FECHA Y SALON.');
				    			 //botonEnviar.disabled = true;
				    			 $('#tipo2').attr("disabled", true);
				    		}
				    		else
				    		{
				    			$('#tipo2').attr("disabled", false);
				    		}
				    }
				  }
					xmlhttp3.open("POST","../ExiteFecha.php",true);
					xmlhttp3.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp3.send("fecha="+document.getElementById('fecha').value+"&salon="+sal);
}
function valida_Fecha(fecha)
{
    //botonEnviar.disabled = false;

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
				    	var xx=xmlhttp.responseText;
				    	if (xx!='0')
				    		{
				    			alertify.alert('YA EXISTE UN CONTRATO CON ESA FECHA Y SALON.');
				    			 //botonEnviar.disabled = true;
				    			 $('#tipo').attr("disabled", true);
				    		}
				    		else
				    		{
				    			$('#tipo').attr("disabled", false);
				    		}

				    }
				  }
					xmlhttp.open("POST","../ExiteFecha.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("fecha="+fecha+"&salon="+document.getElementById('salon').value);
}
function buscar_contrato(contrato)
{
	//alert(contrato);
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
				    	var xx=xmlhttp.responseText;				    
				    	if (xx!='0')
				    		{
				    			var variables=xx.split(',');
				    			document.getElementById('cliente').value=variables[0];
				    			document.getElementById('vendedor').value=variables[1];
				    		}
				    		else
				    		{
				    			
				    		}

				    }
				  }
					xmlhttp.open("POST","Busca_Contrato.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("contrato="+contrato);
}
function enviar_formulario()
{
	alertify.confirm("<b>¿Estas seguro de Guardar el nuevo Evento.?</b>", function (e) {
		if (document.getElementById('salon').value=='SELECCIONE UNA OPCION') 
			{
				alertify.error('ERROR, SELECCIONE UN SALON PARA PODER CONTINUAR.');
			}
			else if (document.getElementById('vendedor').value=='SELECCIONE UNA OPCION') {
				alertify.error('ERROR, SELECCIONE UN VENDEDOR PARA PODER CONTINUAR.');				

			}
			else if (document.getElementById('comensales').value=='') {
				alertify.error('ERROR, INGRESE UNA CANTIDAD DE COMENSALES'	);				
			}
			else if (document.getElementById('cliente').value=='') {
				alertify.error('ERROR, INGRESE UN NOMBRE DE CLIENTE'	);				
			}
			else if (e) {
						alertify.success("Enviando Informacion. Espere porfavo.... '" + alertify.labels.ok + "'");
						setTimeout(function(){ document.recaudacion.submit();}, 3000);
						
					} else { alertify.error("Has pulsado '" + alertify.labels.cancel + "'");

					}
				}); 
				return false
	
}
function enviar_formulario_eliminar(id)
{
	alertify.confirm("<b>'¿Estas seguro de CANCELAR el Evento.?'</b>", function (e) {
					if (e) {
						alertify.success("Enviando Informacion. Espere porfavo.... '" + alertify.labels.ok + "'");
						setTimeout(function(){ window.location ='Accion_Recaudacion.php?accion=elimina&&id='+id;}, 3000);
						
					} else { alertify.error("Has pulsado '" + alertify.labels.cancel + "'");

					}
				}); 
				return false
}
function activa_casillas(f)
{
	alert('comensales'+f);
	document.getElementById('fecha'+f).readOnly=true;
	document.getElementById('salon'+f).readOnly=true;
	document.getElementById('comensales'+f).readOnly=true;
	document.getElementById('cliente'+f).readOnly=false;
}

	function muestra(a)
	{					
		//alert('entro '+a);
		if (a=='nuevo_e')
		{
			$("#nuevo_e").show();		$("#ver_e").hide();
			$("#elimina_e").hide();		$("#modificar").hide();			
			$("#vender").hide();				$("#productos").hide();	
			$("#productos_cargados").hide();	$("#datos_compra").hide();	
			$("#modifica_p").hide();
			$("#muestra_ticket").hide();	$("#ver_e_final").hide();
			$("#ver_ecancelado").hide();
			$("#muestra_ticket_cancelado").hide();

			
		}
		if (a=='ver_e')
		{
			$("#nuevo_e").hide();		$("#ver_e").show();
			$("#elimina_e").hide();		$("#modificar").hide();			
			$("#vender").hide();				$("#productos").hide();	
			$("#productos_cargados").hide();	$("#datos_compra").hide();	
			$("#modifica_p").hide();
			$("#muestra_ticket").hide();	$("#ver_e_final").hide();
			$("#ver_ecancelado").hide();
			$("#muestra_ticket_cancelado").hide();

		}
		if (a=='elimina_e')
		{
			$("#nuevo_e").hide();		$("#ver_e").hide();
			$("#elimina_e").show();		$("#modificar").hide();			
			$("#vender").hide();				$("#productos").hide();	
			$("#productos_cargados").hide();	$("#datos_compra").hide();	
			$("#modifica_p").hide();
			$("#muestra_ticket").hide();	$("#ver_e_final").hide();
			$("#ver_ecancelado").hide();
			$("#muestra_ticket_cancelado").hide();

		}
		if (a=='modificar')
		{//alert('si es ese');
			$("#nuevo_e").hide();		$("#ver_e").hide();
			$("#elimina_e").hide();		$("#modificar").show();						
			$("#vender").hide();				$("#productos").hide();	
			$("#productos_cargados").hide();	$("#datos_compra").hide();	
			$("#muestra_ticket").hide();
			$("#modifica_p").hide();		$("#ver_e_final").hide();
			$("#ver_ecancelado").hide();
			$("#muestra_ticket_cancelado").hide();

		}
		if (a=='vender')
		{//alert('si es ese');
			$("#nuevo_e").hide();		$("#ver_e").hide();
			$("#elimina_e").hide();		$("#modificar").hide();						
			$("#vender").show();		$("#productos").hide();	
			$("#productos_cargados").show();	
			sf('codigo');			$("#datos_compra").hide();				
			$("#modifica_p").hide();
			$("#muestra_ticket").hide();		$("#ver_e_final").hide();
			$("#ver_ecancelado").hide();
			$("#muestra_ticket_cancelado").hide();

		}
		if (a=='productos')
		{//alert('si es ese');
			$("#nuevo_e").hide();		$("#ver_e").hide();
			$("#elimina_e").hide();		$("#modificar").hide();						
			$("#vender").hide();		$("#productos").show();	
			$("#productos_cargados").hide(); $("#datos_compra").hide();				
			$("#modifica_p").hide();
			$("#muestra_ticket").hide();	$("#ver_e_final").hide();
			$("#ver_ecancelado").hide();
			$("#muestra_ticket_cancelado").hide();

		}
		if (a=='modifica_p')
		{//alert('si es ese');
			$("#nuevo_e").hide();		$("#ver_e").hide();
			$("#elimina_e").hide();		$("#modificar").hide();						
			$("#vender").hide();		$("#productos").hide();	
			$("#productos_cargados").hide(); $("#datos_compra").hide();				
			$("#modifica_p").show();
			$("#muestra_ticket").hide();	$("#ver_e_final").hide();
			$("#ver_ecancelado").hide();
			$("#muestra_ticket_cancelado").hide();

		}
		if (a=='muestra_ticket')
		{//alert('si es ese');
			$("#nuevo_e").hide();		$("#ver_e").hide();
			$("#elimina_e").hide();		$("#modificar").hide();						
			$("#vender").hide();		$("#productos").hide();	
			$("#productos_cargados").hide(); $("#datos_compra").hide();				
			$("#modifica_p").hide();
			$("#muestra_ticket").show();	$("#ver_e_final").hide();
			$("#ver_ecancelado").hide();
			$("#muestra_ticket_cancelado").hide();
			
		}
		if (a=='ver_e_final')
		{//alert('si es ese');
			$("#nuevo_e").hide();		$("#ver_e").hide();
			$("#elimina_e").hide();		$("#modificar").hide();						
			$("#vender").hide();		$("#productos").hide();	
			$("#productos_cargados").hide(); $("#datos_compra").hide();				
			$("#modifica_p").hide();
			$("#muestra_ticket").hide();	$("#ver_e_final").show();
			$("#ver_ecancelado").hide();
			$("#muestra_ticket_cancelado").hide();
			
		}
		if (a=='ver_ecancelado')
		{//alert('si es ese');
			$("#nuevo_e").hide();		$("#ver_e").hide();
			$("#elimina_e").hide();		$("#modificar").hide();						
			$("#vender").hide();		$("#productos").hide();	
			$("#productos_cargados").hide(); $("#datos_compra").hide();				
			$("#modifica_p").hide();
			$("#muestra_ticket").hide();	$("#ver_e_final").hide();
			$("#ver_ecancelado").show();
			$("#muestra_ticket_cancelado").hide();
			
		}if (a=='muestra_ticket_cancelado')
		{//alert('si es ese');
			$("#nuevo_e").hide();		$("#ver_e").hide();
			$("#elimina_e").hide();		$("#modificar").hide();						
			$("#vender").hide();		$("#productos").hide();	
			$("#productos_cargados").hide(); $("#datos_compra").hide();				
			$("#modifica_p").hide();
			$("#muestra_ticket").hide();	$("#ver_e_final").hide();
			$("#ver_ecancelado").hide();
			$("#muestra_ticket_cancelado").show();
			
		}
	}


function sf(ID){
	//alert('entro');
	document.getElementById(ID).focus();
}

////////////////////////////////////////////////////////77
//Funcion para recuperar la posición


/////////////////////////////////////////////////////////7
var inc=1;
function agregar_fila()
{	
	var table = document.getElementById("nuevo_producto");		
    var row = table.insertRow(inc+1); 
    var cel= row.insertCell(0);
    	cel.innerHTML="<td colspan='2'><input type='text' name='nombre"+inc+"' title='nombre"+inc+"'/></td>";
    var cel2= row.insertCell(1);
    	cel2.innerHTML="<td colspan='2'><input type='text' name='descripcion"+inc+"' title='descripcion"+inc+"' /></td>";
    var cel3= row.insertCell(2);
    	cel3.innerHTML="<td colspan='2'><input type='text' name='precio"+inc+"' title='precio"+inc+"' /></td>";
    	inc++;
    	document.getElementById('filasnp').value=inc;
}
function enviar_nuevos_productos()
{
	alertify.confirm("<b>¿Esta Seguro de Registrar estos Productos.?</b>", function (e) {
					if (e) {
						alertify.success("Enviando Informacion. Espere porfavo.... '" + alertify.labels.ok + "'");
						setTimeout(function(){ 
												document.getElementById('accionnp').value="Guardar_productos";
			 									document.fproductos.submit();		    }, 3000);
						
					} else { alertify.error("Has pulsado '" + alertify.labels.cancel + "'");

					}
				}); 
				return false
}
var sig=2;var o=0;var idv='';var pv='';var bandera=0;
function busca_producto(codigo)
{
	//alert(codigo);
	codigo=parseInt(codigo);
	//alert(codigo);	
	document.getElementById('codigo').focus();	
	o=document.getElementById('Total-t').value;		
	if(o==''){o=0;}		
	o=parseFloat(o);			
	//alert(o);		
	$("#datos_compra").show();	
	$("#totales").show();
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
								var xx=xmlhttp.responseText;				    							
							if (xx!='0')
								{
									//alert(xx);
									var datos=xx.split(',');
									// si el array es mayor a 4 es vino si es 4 es alimentos
//									datos[4];
//alert(datos.length);
									if(datos[0]=='')
									{alertify.alert("Este Producto no Esta Registrado. Registrelo, o verifique su codigo.");}
									else{
												if(datos.length>5)
												{
															//alert('es vino');

													if(document.getElementById(datos[3]))
													{
													var can=document.getElementById(datos[3]).value;
													can++;
														if(datos[4]>0)
														{
																idv=idv+","+datos[3];
																document.getElementById('id_vinos').value=idv;
																o=o+parseFloat(datos[2]);					
																document.getElementById('Total-t').value=o;
																document.getElementById(datos[3]).value=can;
																var pre=document.getElementById('Precio-'+datos[3]+'').value;
																pre=parseFloat(pre);
																var total= pre*can;
																document.getElementById('total-'+datos[3]+'').value=total;
																modifica_vinos_venta(datos[0]);		
														}else{alertify.alert('ESTE PRODUCTO SE HA AGOTADO.. POR FAVOR SELECCIONE OTRO.');}
													}
													else
													{
														if(datos[4]>0)
														{
															modifica_vinos_venta(datos[0]);
																idv=idv+","+datos[3];
																document.getElementById('id_vinos').value=idv;
																pv=pv+","+datos[0];
																document.getElementById('productos_v').value=pv;
																o=o+parseFloat(datos[2]);					
																document.getElementById('Total-t').value=o;
																var table = document.getElementById("productos_activos");	
																var row=table.insertRow(sig);   
																var cel0= row.insertCell(0);
																var cel= row.insertCell(1);   
																 var cel1= row.insertCell(2);
																var cel2= row.insertCell(3);
																var cel3= row.insertCell(4);
																var cel4= row.insertCell(5);
																var cel5= row.insertCell(6);
																var cel6= row.insertCell(7);
																cel0.innerHTML="<td align='center'>"+(sig-1)+"</td>";
																cel.innerHTML="<td align='center'> <input type='text' name='producto"+sig+"' id='producto"+sig+"' value='"+datos[0]+"' readonly='readonly' /></td>";    
																cel1.innerHTML="<td align='center'><input type='text' name='descripcion"+sig+"' value='"+datos[1]+"' readonly='readonly' /></td>";
																cel2.innerHTML="<td align='center'><input type='text' name='cantidad"+sig+"' id='"+datos[3]+"'value='1' readonly='readonly' style='width:60px;'/></td>";
																cel3.innerHTML="<td align='center'><input type='text' name='precio_unitario"+sig+"' id='Precio-"+datos[3]+"' value='"+datos[2]+"' readonly='readonly' style='width:60px;' /></td>";
																cel4.innerHTML="<td align='center'><input type='text'  id='total-"+datos[3]+"'  name='total-"+sig+"' title='total-"+sig+"' value='"+datos[2]+"' readonly='readonly' style='width:60px;' /></td>";
																cel5.innerHTML="<td align='center'><img src='X.png' style='width:30px;' value='"+(sig)+"' name='"+datos[3]+"' onclick='elimina_fila("+sig+",this.name);' title='"+(sig)+"''' /></td>";
																cel6.innerHTML="<td align='center' style='display: none;'><input type='hidden' name='id-"+sig+"' value='"+datos[3]+"' /></td>";									
																cel4.bgColor='#FAFFBF';
																sig++;
																document.getElementById('total_producto').value='';				
														}
														else{alertify.alert('ESTE PRODUCTO SE HA AGOTADO.. POR FAVOR SELECCIONE OTRO.');}
													}
											
												}
												if(datos.length<=5)
												{ //alert('Es Alimento '+datos[0]);
													if(document.getElementById(datos[3]))
													{		
													//alert('Dice que existe Registro '+datos[3]);													
																var can=document.getElementById(datos[3]).value;
																can++;																																												
																o=o+parseFloat(datos[2]);					
																document.getElementById('Total-t').value=o;
																document.getElementById(datos[3]).value=can;
																var pre=document.getElementById('Precio-'+datos[3]+'').value;
																pre=parseFloat(pre);
																var total= pre*can;
																document.getElementById('total-'+datos[3]+'').value=total;																													
													}
													else
													{					
													//alert('No existia Registro');																								
																															
																o=o+parseFloat(datos[2]);					
																document.getElementById('Total-t').value=o;
																var table = document.getElementById("productos_activos");	
																var row=table.insertRow(sig);   
																var cel0= row.insertCell(0);
																var cel= row.insertCell(1);   
																 var cel1= row.insertCell(2);
																var cel2= row.insertCell(3);
																var cel3= row.insertCell(4);
																var cel4= row.insertCell(5);
																var cel5= row.insertCell(6);
																var cel6= row.insertCell(7);
																cel0.innerHTML="<td align='center'>"+(sig-1)+"</td>";
																cel.innerHTML="<td align='center'> <input type='text' name='producto"+sig+"' id='producto"+sig+"' value='"+datos[0]+"' readonly='readonly' /></td>";    
																cel1.innerHTML="<td align='center'><input type='text' name='descripcion"+sig+"' value='"+datos[1]+"' readonly='readonly' /></td>";
																cel2.innerHTML="<td align='center'><input type='text' name='cantidad"+sig+"' id='"+datos[3]+"'value='1' readonly='readonly' style='width:60px;'/></td>";
																cel3.innerHTML="<td align='center'><input type='text' name='precio_unitario"+sig+"' id='Precio-"+datos[3]+"' value='"+datos[2]+"' readonly='readonly' style='width:60px;' /></td>";
																cel4.innerHTML="<td align='center'><input type='text'  id='total-"+datos[3]+"'  name='total-"+sig+"' title='total-"+sig+"' value='"+datos[2]+"' readonly='readonly' style='width:60px;' /></td>";
																cel5.innerHTML="<td align='center'><img src='X.png' style='width:30px;' value='"+(sig)+"' name='"+datos[3]+"' onclick='elimina_fila("+sig+",this.name);' title='"+(sig)+"''' /></td>";
																cel6.innerHTML="<td align='center' style='display: none;'><input type='hidden' name='id-"+sig+"' value='"+datos[3]+"' /></td>";									
																cel4.bgColor='#FAFFBF';
																sig++;
																document.getElementById('total_producto').value='';																		
													}
												}
											}
								}
						}
				  }
					xmlhttp.open("POST","Busca_producto.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("codigo="+codigo);
/////////////////////////		FILAS DE LA TABLA	////////////////////////////////7
						document.getElementById('codigo').value='';
							document.getElementById('codigo').focus();										//o=119;
}
function calcula_total(c)
{
	//alert('entro al total');
	var total=0;	
	var precio=document.getElementById('precio_producto').value;
	precio=parseFloat(precio);
	total=precio*c;
//	alert(total);
	document.getElementById('total_producto').value=total;
}
function imprime_productos()
{
	window.open('PDF-Codigo_Barras.php', '_blank', 'width=700, height=600');	
}

function Agrega_ticket()
{
	
	
}
function elimina_fila(fila,id)
{
	//alert('entro a eliminar'+" "+fila +" "+id);
	var p=document.getElementById('producto'+fila+'').value;
	//alert(p);
	var c=document.getElementById(id).value;
	//alert(c);
	
	//alert('entro '+fila);

	alertify.confirm("<b>¿Esta seguro de eliminar el Producto.?</b>", function (e) {
					if (e) {
						var de=document.getElementById('total-'+id).value;		
						de=parseFloat(de);		
						var tde=document.getElementById('Total-t').value;		
						tde=parseFloat(tde);				
						var del=tde-de;		
						document.getElementById('Total-t').value=del;				
						document.getElementById("productos_activos").deleteRow(fila);		
						document.getElementById('codigo').focus();			
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
								    	var xx=xmlhttp.responseText;
										
								    	if(xx!='')
										{
											
										}
								    }	
								  }
									xmlhttp.open("POST","Cancela_producto_vino.php",true);
									xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
									xmlhttp.send("producto="+p+"&cantidad="+c);
									sig=sig-1;									
						alertify.success("<b>PRODUCTO ELIMINADO</b>");								
					} else { alertify.error("Has pulsado '" + alertify.labels.cancel + "'");

					}
				}); 
				return false

	
}
function pregunta44()
{
	alertify.confirm("<b>¿Esta Seguro de Actualizar los Productos.?</b>", function (e) {
					if (e) {
						alertify.success("<b>Enviando Informacion. Espere porfavo.... '" + alertify.labels.ok + "'</b>");
						setTimeout(function(){document.actualiza_p.submit(); }, 3000);
						
					} else { alertify.error("<b>Has pulsado '" + alertify.labels.cancel + "'</b>");

					}
				}); 
				return false
	
}
function pregunta444()
{
	alertify.confirm("<b>¿Esta Seguro de Actualizar los Productos.?</b>", function (e) {
					if (e) {
						alertify.success("<b>Enviando Informacion. Espere porfavo.... '" + alertify.labels.ok + "'</b>");
						setTimeout(function(){ document.actualiza_pv.submit();	 }, 3000);
						
					} else { alertify.error("<b>Has pulsado '" + alertify.labels.cancel + "'</b>");

					}
				}); 
				return false
}
function imprime_tiket()
{
	alertify.confirm("<b>Confirma Compra. Presiona Aceptar para Continuar</b>", function (e) {
					if (e) {
						alertify.prompt("<b>Paga con:</b>", function (i, str) 
						{ 
							if (i)
								{
									if (str>0) 
										{
											str=parseFloat(str);
									
											var ttt=document.getElementById('Total-t').value;
											document.getElementById('paga').value=str;
											//alert(ttt);
											ttt=parseFloat(ttt);
											var cambio=str-ttt;
											cambio=currency(cambio);											
											alertify.alert("El Cambio es de: $ "+cambio);
											alertify.success("<b>Cambio: $" + cambio+"</b>");
										};																			
										alertify.success("<b>Enviando Informacion. Espere PORFAVOR.... '" + alertify.labels.ok + "'</b>");
										setTimeout(function(){ 
								 		document.getElementById('filas').value=sig;
					 					document.guarda_ticket.submit();	
					 						sig=2;		 
												
				 						 }, 2000);
								}else
								{
									alertify.error("Se CANCELO la acción");
								}
						});	
						
					} else { alertify.error("<b>Has CANCELADO la compra</b>");

					}
				}); 
				return false		
}
function corte_caja()
{
	
	alertify.prompt("<b>Ingrese el Numero de Evento de Recaudacion</b>", function (e, str) { 
					if (e){


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
							    	var xx=xmlhttp.responseText;
								//alert(xx);
							    	if(xx==str)
									{
										// window.location ="corte_ventas_tiendita.php?numero="+xx;
										 window.open('genera_corte.php?numero='+xx+'', '_blank');

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

									}
									else if(xx=='ya hay corte')
									{
										alertify.alert('YA SE REALIZO EL CORTE DE ESTE CONTRATO. PORFAVOR REVISE SUS DATOS.');
									}
									else
									{
										alertify.alert('EL contrato ingresado no existe por favor verifica tus datos..');
									}
							    }
							  }
								xmlhttp.open("POST","Busca_Evento_Recaudacion.php",true);
								xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
								xmlhttp.send("numero="+str);	
						alertify.success("Buscando informacion para los datos ingresados: " + str);
					}else{
						alertify.error("Se CANCELO la acción");
					}
				});
				return false;
	
}
function elimina_ticket(id, tipo)
{
	//alert(tipo);
	alertify.confirm("<b>ESTA SEGURO DE CANCELAR ESTE TICKET. ? SI ES ASI PRECIONE ACEPTAR.</b>", function (e) {
					if (e) {
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
							    	var xx=xmlhttp.responseText;
							    	//alert(xx);
							    	if(xx=='alimento')
							    	{									
									window.open('Pruebas/cancelacion_ticket.php?tipo=alimento&&id='+id, '_blank', 'width:700, height:600');	
										window.location ='recaudacion.php'; 										
							    	}
							    	else if (xx=='vino')
								     {
								     	window.open('Pruebas/cancelacion_ticket.php?tipo=vino&&id='+id, '_blank', 'width:700, height:600');	
										window.location ='recaudacion.php';
								     }
							    }
							  }
								xmlhttp.open("POST","elimina_ticket.php",true);
								xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
								xmlhttp.send("id="+id+"&tipo="+tipo);
									alertify.success("<b>Enviando Informacion. Espere porfavo.... '" + alertify.labels.ok + "'</b>");									
									
					} else { alertify.error("<b>Has pulsado '" + alertify.labels.cancel + "'</b>");

					}
				}); 
				return false	
}
function valida_usr_contrato()
{
	var nombreusr = "<?php echo $_SESSION['nombre']; ?>" ;
	var usuario = "<?php echo $_SESSION['usu']; ?>" ;
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
				    	var xx=xmlhttp.responseText;
						//	alert(xx);
						 var ex=xx.split(',');
						 var l=xx.length;
						 var res = xx.slice(10,(l-1));						 
						// alert(res);
				    	if(ex[0]=='no existe')
				    	{

							alertify.prompt("Ingrese el contrato al que se le asignaran las ventas de este equipo", function (e, str) { 
							if (e){
								var xmlhttp2;
												if (window.XMLHttpRequest)
												  {// code for IE7+, Firefox, Chrome, Opera, Safari
												  xmlhttp2=new XMLHttpRequest();
												  }
												else
												  {// code for IE6, IE5
												  xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
												  }
													xmlhttp2.onreadystatechange=function()
												  {
												  if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
													{
														var xx2=xmlhttp2.responseText;
														//alert(xx2);																	
														window.location="recaudacion.php";
													}
												  }
													xmlhttp2.open("POST","modifica_contrato_usr.php",true);
													xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
													xmlhttp2.send("nombre="+nombreusr+"&usuario="+usuario+"&&contrato="+str);
												alertify.success("<b>ENVIANDO INFORMACION</b> " + str);
								  }else{
										alertify.error("Has pulsado '" + alertify.labels.cancel + "'");
										$('#vender').hide();
										}
								},res);
								return false;
				    	}
				    	 if(ex[0]=='no hay eventos')
				    	{
				    		alertify.error("Hoy no existen Eventos.'" + alertify.labels.cancel + "'");
							//setTimeout(function(){ window.location="recaudacion.php?error=1";	 }, 2000);				    		
				    		$("#vender").hide();
				    	}
						else
						{
							document.getElementById('c_referencia').value=xx;
							document.getElementById('mc').innerHTML=xx;
							//alert('que rollo');
						

/////////////////////////////////////////
									var xmlhttp2;
												if (window.XMLHttpRequest)
												  {// code for IE7+, Firefox, Chrome, Opera, Safari
												  xmlhttp2=new XMLHttpRequest();
												  }
												else
												  {// code for IE6, IE5
												  xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
												  }
													xmlhttp2.onreadystatechange=function()
												  {
												  if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
													{
														var xx3=xmlhttp2.responseText;
														if(xx3=='no')
														{	$("#vender").show(); }
													else{
														alertify.error("<b>YA SE HA RELIZADO EL CORTE DE CAJA A ESTE CONTRATO.</b>");
														$("#vender").hide();
														setTimeout(function(){ window.location="recaudacion.php?error=1";	 }, 2000);
													}
													}
												  }
													xmlhttp2.open("POST","contrato_finalizado.php",true);
													xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
													xmlhttp2.send("contrato="+xx);
												alertify.success("<b>ENVIANDO INFORMACION</b> " + xx);
//////////////////////////////////////////

						}
				    }
				  }
					xmlhttp.open("POST","valida_contrato_usr.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("nombre="+nombreusr+"&usuario="+usuario);
					document.getElementById('Total-t').value=0;				

}
function redirecciona()
{
	window.locationf="http://www.cristalab.com";	
}
function actuliza_todo()
{
	window.open('actualiza_inv.php', '_blank', 'width:700, height:600');	
}
function modifica_vinos_venta(producto)
{
	var xmlhttp2;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp2=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
			  xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
		  }
			xmlhttp2.onreadystatechange=function()
		  {
		  if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
			{
		  	  var xx2=xmlhttp2.responseText;
				//alert(xx2);																	
			}
			 }
			xmlhttp2.open("POST","modifica_cantidad_vinos.php",true);
			xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp2.send("producto="+producto);	
}
function currency(value, decimals, separators) {
    decimals = decimals >= 0 ? parseInt(decimals, 0) : 2;
    separators = separators || ['.', "'", ','];
    var number = (parseFloat(value) || 0).toFixed(decimals);
    if (number.length <= (4 + decimals))
        return number.replace('.', separators[separators.length - 1]);
    var parts = number.split(/[-.]/);
    value = parts[parts.length > 1 ? parts.length - 2 : 0];
    var result = value.substr(value.length - 3, 3) + (parts.length > 1 ?
        separators[separators.length - 1] + parts[parts.length - 1] : '');
    var start = value.length - 6;
    var idx = 0;
    while (start > -3) {
        result = (start > 0 ? value.substr(start, 3) : value.substr(0, 3 + start))
            + separators[idx] + result;
        idx = (++idx) % 2;
        start -= 3;
    }
    return (parts.length == 3 ? '-' : '') + result;
}

 function abrir_dialog(str,tipo) {
 	//alert(tipo);
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
		xmlhttp.open("POST","detalle_ticket.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("id="+str+"&tipo="+tipo);

      $( "#dialog" ).dialog({
          show: "blind",
          hide: "explode"
      });
    };
/*function actualiza_totales(m){	var to=0;	alert('entro al m '+m);		for(i=1;i<=m;i++)	{		to=to+p2001		arseFloat(document.getElementsByName("total-"+i+"")[0].value);	}	alert(to);	document.getElementById('Total-t').value=to;}*/
</script>
<?php
if(isset($_GET['venta'])&&$_GET['venta']=='1')
{
	echo"<script>	
	$('#vender').show();
document.getElementById('codigo').focus();	
	</script>";
}
if(isset($_GET['ticket'])&&$_GET['ticket']=='1')
{
	echo"<script>
			$('#muestra_ticket').show();			
			alert('SE CACELO EL TICKET CORRECTAMENTE');
		window.open('Pruebas/cancelacion_ticket.php?id=".$_GET['id']."' , 'Alta de Empresa' );				
	</script>";
}

?>
</html>