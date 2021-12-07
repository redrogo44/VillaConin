<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Villa Conin</title>
		<?php
			require('../configuraciones.php');
			conectar();
			validarsesion();
		$nivel=$_SESSION['niv'];				
		$_SESSION['usu']=$_GET['usuario'];
		date_default_timezone_set('America/Mexico_City');
		?>
			<link rel="stylesheet" href="../Arbol/menu.css" />
			<link rel="stylesheet" href="../Arbol/jquery.treeview.css" />        
	        <link rel="stylesheet" type="text/css" href="../Arbol/Arbol2/_styles.css" media="screen">
	        <linkrel='stylesheet', href='stylesheets/bootstrap.min.css'/>
		   <link rel='stylesheet', href='stylesheets/bootstrap-theme.css'/>
		   <link rel='stylesheet', href='stylesheets/elegant-icons-style.css'/>
		   <link rel='stylesheet', href='stylesheets/font-awesome.css'/>
		   <link rel='stylesheet', href='stylesheets/style.css'/>
		   <link rel='stylesheet', href='stylesheets/style-responsive.css'/>
		
			
		<script src="../Arbol/lib/jquery.js" type="text/javascript"></script>
		<script src="../Arbol/lib/jquery.cookie.js" type="text/javascript"></script>
		<script src="../Arbol/jquery.treeview.js" type="text/javascript"></script>
		
		<script type="text/javascript" src="../../js/shortcut.js"></script>
		<script>
		<?php
		 $c2=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='mostrar facturados' and tipo='clave'"));
		 $c3=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='ocultar factutados' and tipo='clave'"));
		?>
		shortcut.add("Ctrl+Alt+<?php echo $c3['descripcion'];?>",function() {
			document.getElementById('facturado').value="no";
			$('.nofac').show('swing');
			alert("B");
		});
		shortcut.add("Ctrl+Alt+<?php echo $c2['descripcion'];?>",function() {
			$('.nofac').hide('lineal');
			document.getElementById('facturado').value="si";
			alert("A");
		});
		</script>
		<style type="text/css">
		#menu_alterno,#contenido{
			/*background: #F00; */
			 display: inline-block; vertical-align:top;
			 width: 330px; height: 200px; position:relative;
			 padding: 2em;
		}
		#contenido{
			/*background: #F60;*/
			vertical-align: top;
			width: 50em;
		}
		</style>
	</head>
	<body background="" style="background-repeat:no-repeat"  bgcolor="#FFF" >
		<center>
			<a href="#" name="nuevo_movimiento"  class="btn btn-primary" onclick="mostrar(this.name);">Nuevo Traspado</a>
			<a href="#" name="ver_movimiento"  class="btn btn-success" onclick="mostrar(this.name);">Ver Traspasos</a>
			<a  class="btn btn-danger" onclick="window.close();">Cerrar</a>
		</center>
	<div id="contenido">
		<div id='nuevo_movimiento' style="display: none;max-width:400px;">
			<h2 align="center"><b>Movimientos entre Cuentas</b></h2>
			<h4><font color='blue'><b>Emisor</b></font></h4>
			<form action="acciones_cuentas.php" name="guarda_movimientos"   method="post" accept-charset="utf-8">
				<label><b>Fecha</b></label><br>
				<input type="date" name="fecha" id='fecha'	Class="form-control">
				<label><b>Banco</b></label><br>
					<select name="banco_emisor" id='banco3'  Class="form-control" style="width:70%; display: inline-block;" onchange="cargar_cuentas(this.value,1);">
							
					</select>&nbsp;<!--img src="+.png" style="width:20px;" title="NUEVO BANCO" onclick="nuevo_banco();"--><br>
				<label><b>Cuenta</b></label><br>
					<select name="cuenta_emisora" id='cuentas1'  Class="form-control" style="width:70%; display: inline-block;" onchange="detalle_cuenta(this.value,1);">
							
					</select><br>
				<label><b>Cantidad</b></label>
				<input type="number" name="cantidad1"  id='cantidad1' min='0' placeholder='Ingrese una cantidad' Class="form-control" onchange="valida_cantidades(this.value,1);"  disabled="false">
				<label><b>Concepto</b></label>
				<input type="text" name="concepto" id='concepto' placeholder='Concepto de Movimiento' Class="form-control">				
				<h4><font color='#01B201'><b>Receptor</b></font></h4>			
				<label><b>Banco</b></label><br>
					<select name="banco_receptor" id='banco2'  Class="form-control" style="width:70%; display: inline-block;" onchange="cargar_cuentas(this.value,2);">
							
					</select>&nbsp;<img src="+.png" style="width:20px;" title="NUEVO BANCO" onclick="nuevo_banco();"><br>
				<label><b>Cuenta</b></label><br>
					<select name="cuenta_receptora" id='cuentas2'  Class="form-control" style="width:70%; display: inline-block;" onchange="detalle_cuenta(this.value,2);">
							
					</select><br>
				<input type="hidden" id="minimo_cuenta1">
				<input type="hidden" id="minimo_cuenta2">
				<input type="hidden" name="accion" value="nuevo_movimiento">
				<br><br>
				<input id="facturado" type="hidden" name="facturado" value="si">
				<input type="button"  value="Guardar" id='boton' Class='btn btn-primary' onclick="guardar_movimiento();">
			</form>
		</div>
		<div id='ver_movimiento' style="display: none;">
			<h2 align="center"><b>Listado de Traspasos</b></h2>
			<table class="table">
			    <thead>
			      <tr>
			        <th>Folio</th>
			        <th>Fecha</th>
			        <th>Concepto</th>
			        <th>Banco Emisor</th>
			        <th>Cuenta Emisora</th>
			        <th>Banco Receptor</th>
			        <th>Cuenta Receptora</th>
			        <th>Cantidad</th>			        
			        <th></th>			        
			      </tr>
			    </thead>
			    <tbody>
			   	  <?php
					$c=mysql_query("SELECT * FROM Movimientos_Cuentas where facturado='1' and cuenta_emisor REGEXP '^[0-9]+$' and cuenta_receptora REGEXP '^[0-9]+$' and estatus='activo'");
					while ($mov=mysql_fetch_array($c)) 
					{
						$bancoe=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$mov['banco_emisor']));
						$cuentae=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$mov['cuenta_emisor']));
						$bancor=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$mov['banco_receptor']));
						$cuentar=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$mov['cuenta_receptora']));
						
						echo "<tr class='success'>
				        		<td>A".$mov['folio_traspaso']."</td>
				        		<td>".$mov['fecha']."</td>
				        		<td>".$mov['concepto']."</td>
				        		<td>".$bancoe['nombre']."</td>
				        		<td>".$cuentae['nombre']."</td>
				        		<td>".$bancor['nombre']."</td>
				        		<td>".$cuentar['nombre']."</td>
				        		<td>$ ".money_format("%i",$mov['cantidad'])."</td>				        		
				        		<td><a class='btn btn-danger' onclick='eliminar_traspaso(".$mov["id"].")'>Eliminar</a></td>				        		
  			        		  </tr>";
					}
					
					$c2=mysql_query("SELECT * FROM Movimientos_Cuentas where facturado='0' and cuenta_emisor REGEXP '^[0-9]+$' and cuenta_receptora REGEXP '^[0-9]+$' and estatus='activo'");
					while ($mov2=mysql_fetch_array($c2)) 
					{
						$bancoe2=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$mov2['banco_emisor']));
						$cuentae2=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$mov2['cuenta_emisor']));
						$bancor2=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$mov2['banco_receptor']));
						$cuentar2=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$mov2['cuenta_receptora']));
						echo "<tr class='success nofac' style='display:none;'>
								<td>B".$mov2['folio_traspaso']."</td>
				        		<td>".$mov2['fecha']."</td>
				        		<td>".$mov2['concepto']."</td>
				        		<td>".$bancoe2['nombre']."</td>
				        		<td>".$cuentae2['nombre']."</td>
				        		<td>".$bancor2['nombre']."</td>
				        		<td>".$cuentar2['nombre']."</td>
				        		<td>$ ".money_format("%i",$mov2['cantidad'])."</td>	
								<td><a class='btn btn-danger' onclick='eliminar_traspaso(".$mov2["id"].")'>Eliminar</a></td>
  			        		  </tr>";
					}
				?>   
			    </tbody>
			  </table>		
			
			<h2 align="center"><b>Traspasos Cancelados</b></h2>
			<table class="table">
			    <thead>
			      <tr>
			        <th>Folio</th>
			        <th>Fecha</th>
			        <th>Concepto</th>
			        <th>Banco Emisor</th>
			        <th>Cuenta Emisora</th>
			        <th>Banco Receptor</th>
			        <th>Cuenta Receptora</th>
			        <th>Cantidad</th>	        
			      </tr>
			    </thead>
			    <tbody>
			   	  <?php
					$cf=mysql_query("SELECT * FROM Movimientos_Cuentas where facturado='1' and cuenta_emisor REGEXP '^[0-9]+$' and cuenta_receptora REGEXP '^[0-9]+$' and estatus='suspendido'");
					while ($movf=mysql_fetch_array($cf)) 
					{
						$bancoef=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$movf['banco_emisor']));
						$cuentaef=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$movf['cuenta_emisor']));
						$bancorf=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$movf['banco_receptor']));
						$cuentarf=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$movf['cuenta_receptora']));
						
						echo "<tr class='success'>
				        		<td>A".$movf['folio_traspaso']."</td>
				        		<td>".$movf['fecha']."</td>
				        		<td>".$movf['concepto']."</td>
				        		<td>".$bancoef['nombre']."</td>
				        		<td>".$cuentaef['nombre']."</td>
				        		<td>".$bancorf['nombre']."</td>
				        		<td>".$cuentarf['nombre']."</td>
				        		<td>$ ".money_format("%i",$movf['cantidad'])."</td>				        					        		
  			        		  </tr>";
					}
					
					$cf2=mysql_query("SELECT * FROM Movimientos_Cuentas where facturado='0' and cuenta_emisor REGEXP '^[0-9]+$' and cuenta_receptora REGEXP '^[0-9]+$' and estatus='suspendido'");
					while ($movf2=mysql_fetch_array($cf2)) 
					{
						$bancoef2=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$movf2['banco_emisor']));
						$cuentaef2=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$movf2['cuenta_emisor']));
						$bancorf2=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$movf2['banco_receptor']));
						$cuentarf2=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$movf2['cuenta_receptora']));
						echo "<tr class='success nofac' style='display:none;'>
								<td>B".$movf2['folio_traspaso']."</td>
				        		<td>".$movf2['fecha']."</td>
				        		<td>".$movf2['concepto']."</td>
				        		<td>".$bancoef2['nombre']."</td>
				        		<td>".$cuentaef2['nombre']."</td>
				        		<td>".$bancorf2['nombre']."</td>
				        		<td>".$cuentarf2['nombre']."</td>
				        		<td>$ ".money_format("%i",$movf2['cantidad'])."</td>	
  			        		  </tr>";
					}
				?>   
			    </tbody>
			  </table>		
		</div>
	</div>
	<script type="text/javascript">
	setTimeout(busca_bancos,1000);
	//setTimeout(alertFunc, 3000);

	function mostrar(a)
	{
		//alert(a)
		
		if (a=='nuevo_movimiento') 
		{
				document.getElementById('facturado').value="si";
				$('.nofac').hide();
				$('#nueva_cuenta').hide();
				$('#ver_cuenta').hide();
				$('#nuevo_movimiento').show();
				$('#ver_movimiento').hide();
		}
		if (a=='ver_movimiento') 
		{
				document.getElementById('facturado').value="si";
				$('.nofac').hide();
				$('#nueva_cuenta').hide();
				$('#ver_cuenta').hide();
				$('#nuevo_movimiento').hide();
				$('#ver_movimiento').show();
		}
	}
	function busca_bancos()
	{
		//alert('entro');
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
				    	document.getElementById('banco2').innerHTML=xx;
				    	document.getElementById('banco3').innerHTML=xx;
							
														
				    }
				  }
				 xmlhttp.open("POST","acciones_cuentas.php",true);
				 xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				 xmlhttp.send("accion=busca_bancos");	
	}
	function nuevo_banco()
	{
		window.open("nuevo_banco.php", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");		
	}
	function nueva_cuenta()
	{
		if (document.getElementById('banco').value == 'Seleccione una Opcion') {
			alert('Error, SELECCIONE UN BANCO CORRECTO O CREE ALGUNO PARA PODER CONTINUAR.');
		}
		else if(document.getElementById('banco').value == 'Efectivo'){
			alert('Error, NO SE PUEDEN CREAR MAS CUENTAS DE EFECTIVO.');			
		}
		else if (document.getElementById('alias').value =='') {alert("ESCRIBA UN ALIAS")}
		else if (document.getElementById('nombre').value =='') {alert("ESCRIBA UN NOMBRE")}
		else if ($(".numero_cuenta").val() =='') {alert("ESCRIBA UN NUMERO DE CUENTA")}			
		else if (document.getElementById('saldo_i').value =='') {alert("ESCRIBA UN SALDO INICIAL")}
		else if (document.getElementById('clave').value =='') {alert("ESCRIBA UNA CLAVE")}
		else{
			if (confirm("ESTA SEGURO DE GUARDAR LA NUEVA CUENTA..")) {
				nuevo.submit();
			}
		}

	}
	function modificar_cuenta(a)
	{
		window.open("modifica_cuenta.php?id="+a, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=500, height=500");				
	}
	function cargar_cuentas(a,n)
	{
		//alert(a);
		if (document.getElementById('banco3').value=='Efectivo' && n==1) 
		{
			document.getElementById('cuentas1').disabled=true; 
			$("#cuentas1").val('2');
			document.getElementById('cantidad1').disabled=false; 
    	}
		else{
//alert('entro');
			document.getElementById('cuentas1').disabled=false; 
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
				    	document.getElementById('cuentas'+n).innerHTML=xx;
														
				    }
				  }
				 xmlhttp.open("POST","acciones_cuentas.php",true);
				 xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				 xmlhttp.send("accion=busca_cuentas&id="+a);	
		}
		
	}
	$('#banco2').change(function(){
		var v1=$("#banco3").val();
		var v2=$("#banco2").val();
	if(v1 =='Efectivo' && v2=='Efectivo')
			{
				alert("ERROR, NO PUEDE HABER MOVIMIENTOS ENTRE EFECTIVO(S) ");
		   		document.getElementById('boton').disabled= true;	
			}

	});
	function detalle_cuenta(a,n){
		//alert(document.getElementById('cuentas'+(n-1)).value);			
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
				    	xx=parseInt(xx);
	   					document.getElementById('minimo_cuenta'+n).value=xx;
					   		document.getElementById('cantidad1').disabled= false;			   						
	   					if (document.getElementById('cuentas1').value ==document.getElementById('cuentas2').value) 
						{
							alert("ERROR, LA CUENTA RECEPTORA NO PUEDE SER LA MISMA QUE LA EMISORA. POR FAVOR CAMBIE LA CUENTA");
					   		document.getElementById('boton').disabled= true;		
						}						
						else{ document.getElementById('boton').disabled= false;}
				    }
				  }
				 xmlhttp.open("POST","acciones_cuentas.php",true);
				 xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				 xmlhttp.send("accion=detalle_cuentas&id="+a);		
	}
	function valida_cantidades(v,n)
	{
		var valor=document.getElementById('minimo_cuenta'+n).value;
		valor=parseInt(valor);
		if (v>valor) {alert('ERROR, NO TIENE LOS SUFICIENTES FONDOS PARA EL MOVIMIENTO, ESTA CUENTA TIENE UN SALDO DE $ '+valor);
		document.getElementById('cantidad'+n).value='';
		}
	}
	function guardar_movimiento()
	{
		
			if(document.getElementById('fecha').value=='')
			 {alert("INGRESE UNA FECHA CORRECTA");}
			else if((document.getElementById('banco3').value) =='Seleccione una Opcion')
			 {alert("SELECCIONE UN BANCO EMISOR");}
			else if(document.getElementById('banco2').value =='Seleccione una Opcion')
			 {alert("SELECCIONE UN BANCO RECEPTOR");}
			else if(document.getElementById('cuentas1').value =='Seleccione una Opcion')
			 {alert("SELECCIONE UNA CUENTA EMISORA");}
			else if(document.getElementById('cuentas2').value =='Seleccione una Opcion')
			 {alert("SELECCIONE UNA CUENTA RECEPTORA");}
			else if(document.getElementById('cantidad1').value =='')
			 {alert("INGRESE UNA CANTIDAD PARA EL MOVIMIENTO");}
			else if(document.getElementById('concepto').value =='')
			 {alert("INGRESE ALGUN CONCEPTO PARA EL MOVIMIENTO");}
			else if($("#banco3").val()=="Efectivo" && $("#banco2").val()=='Efectivo')
			{
				alert("NO ES POSIBLE REALIZAR MOVIMIENTOS ESTRE EFECTIVOS, FAVOR DE VERIFICAR SUS DATOS.");
			}
			else
				{
					if (confirm("ESTA SEGURO DE GUARDAR EL MOVIMIENTO ENTRE CUENTAS.?")) 
					{			guarda_movimientos.submit();
					}

				}
	}
	function eliminar_cuenta(a)
	{
		//alert("jajaj");
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
				    	xx=parseInt(xx);
	   					if(xx>0)
	   					{
	   						alert("ERROR, NO SE PUEDE ELIMINAR ESTA CUENTA, AUN TIENE UN SALDO ACTIVO, \nREALICE UN MOVMIENTO PARA TRASLADAR EL SALDO Y VUELVA A INTENTARLO");
	   					}
	   					else{
	   						if (confirm("ESTA COMPLETAMENTE SEGURO DE ELIMINAR ESTA CUENTA.? ")) {
							window.open("acciones_cuentas.php?accion=elimina_c&id="+a, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=500, height=500");					   						
	   						};
	   					}
					 }
				  }
				 xmlhttp.open("POST","acciones_cuentas.php",true);
				 xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				 xmlhttp.send("accion=detalle_cuentas&id="+a);				
	}
	function eliminar_traspaso(id){
		if(confirm("Esta seguro de eliminar el traspaso")){
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
				    	if(xx!=''){
							alert(xx);
						}else{
							location.reload();
						}
					 }
				  }
				 xmlhttp.open("POST","acciones_cuentas.php",true);
				 xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				 xmlhttp.send("accion=borrar_traspaso&id="+id);
		}
	}
</script>
	</body>
</html>

