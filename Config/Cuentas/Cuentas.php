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
		   <link rel='stylesheet', href='icons/flaticon.css'/>
		<link rel="stylesheet" href="screen.css" />
			
		<script src="../Arbol/lib/jquery.js" type="text/javascript"></script>
		<script src="../Arbol/lib/jquery.cookie.js" type="text/javascript"></script>
		<script src="../Arbol/jquery.treeview.js" type="text/javascript"></script>
		
		<script type="text/javascript" src="../Arbol/demo.js"></script>
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
			<a name="nueva_cuenta" onclick="mostrar(this.name);" class="btn btn-primary">Nueva Cuenta</a>
			<a name="ver_cuenta" onclick="mostrar(this.name);" id='Nuevo_traspaso'  class="btn btn-success">Ver Cuentas</a>
			<a onclick="window.close();"  class="btn btn-danger">Cerrar</a>
		</center>
	
		<center>
	<div id="contenido">
		<div id='nueva_cuenta' style="display: none;">
			<h2 align="center"><b>NUEVA CUENTA</b></h2>		
			<div class="form-group text">
				<form action="acciones_cuentas.php" name="nuevo" method="POST" target="_blank" accept-charset="utf-8">
					<label><b>Alias</b></label>
					<input type="text" name="alias" id='alias' placeholder="Alias" class="form-control" required />
					<label><b>Nombre de Cuenta</b></label>
					<input type="text" name="nombre" id='nombre' placeholder="Nombre de la Cuenta" class="form-control"/>
					<label><b>Banco</b></label><br>
					<select name="banco" id='banco'  Class="form-control" style="width:70%; display: inline-block;">
						
					</select>&nbsp;<img src="+.png" style="width:20px;" title="NUEVO BANCO" onclick="nuevo_banco();">
					<br>
					<br>
					<label><b>Numero de Cuenta</b></label>
					<input type="number" name="numero_cuenta"  id="numero_cuenta" placeholder="Numero de Cuenta" min='0' class="form-control numero_cuenta" required/>
					<label><b>Clave Interbancaria</b></label>
					<input type="text" name="clave" id="clave" placeholder="Clave Interbancaria" class="form-control" required/>
					<label><b>Saldo Inicial</b></label>
					<input type="number" min='0' name="saldo_i" id="saldo_i" placeholder="Saldo Inicial" class="form-control" required/>
					<br>
					<input type="hidden" name="accion" value="nueva_cuenta">
				<input type="button"  value="Guardar" class="btn btn-primary" onclick="nueva_cuenta();">
				</form>								
			</div>	
		</div>
		<div id="ver_cuenta" style="display: none;">
			<center><h2><b>Lista de Cuentas</b></h2></center>
			<table class="table">
			    <thead>
			      <tr>
			        <th>Alias</th>
			        <th>Nombre</th>
			        <th>Banco</th>
			        <th># Cuenta</th>
			        <th>Clave</th>
			        <th>Saldo Inicial</th>
			        <th>Saldo Final</th>
			        <th>Modificar</th>
			        <th>Eliminar</th>
			      </tr>
			    </thead>
			    <tbody>
			   	  <?php
					$c=mysql_query("SELECT * FROM Cuentas");
					while ($cuenta=mysql_fetch_array($c)) 
					{
						$banco=mysql_fetch_array(mysql_query("SELECT * FROM bancos WHERE id=".$cuenta['banco']));
						echo "<tr class='success'>
				        		<td>".$cuenta['alias']."</td>
				        		<td>".$cuenta['nombre']."</td>
				        		<td>".$banco['nombre']."</td>
				        		<td>".$cuenta['numero_cuenta']."</td>
				        		<td>".$cuenta['clabe_interbancaria']."</td>
				        		<td>".money_format("%i", $cuenta['saldo_inicial'])."</td>
				        		<td>$ ".money_format("%i",$cuenta['saldo_final'])."</td>				        		
				        		<td><input class='btn btn-success' type='button' value='Modificar' name='".$cuenta['id']."' onclick='modificar_cuenta(this.name);'></td>
				        		<td><input class='btn btn-danger' type='button' value='Eliminar' name='".$cuenta['id']."' onclick='eliminar_cuenta(this.name);'></td>
				      		</tr>";
					}
				?>   
			    </tbody>
			  </table>			
		</div>
		<center>
	<script type="text/javascript">
	setTimeout(busca_bancos,1000);
	//setTimeout(alertFunc, 3000);

	function mostrar(a)
	{
		//alert(a)
		if (a=='nueva_cuenta') 
		{
				$('#nueva_cuenta').show();
				$('#ver_cuenta').hide();
				$('#nuevo_movimiento').hide();
				$('#ver_movimiento').hide();
		}
		if (a=='ver_cuenta') {
			$('#ver_cuenta').show();
			$('#nuevo_movimiento').hide();
			$('#ver_movimiento').hide();
			$('#nueva_cuenta').hide();			
		}
		if (a=='nuevo_movimiento') 
		{
				$('#nueva_cuenta').hide();
				$('#ver_cuenta').hide();
				$('#nuevo_movimiento').show();
				$('#ver_movimiento').hide();
		}
		if (a=='ver_movimiento') 
		{
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
				    	document.getElementById('banco').innerHTML=xx;
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
			$("#cuentas1").text('');
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
</script>
	</body>
</html>

