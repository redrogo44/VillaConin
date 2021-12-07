<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Modificar Cuenta</title>
	<link rel="stylesheet" type="text/css" href="../Arbol/Arbol2/_styles.css" media="screen">
	        <linkrel='stylesheet', href='stylesheets/bootstrap.min.css'/>
		   <link rel='stylesheet', href='stylesheets/bootstrap-theme.css'/>
		   <link rel='stylesheet', href='stylesheets/elegant-icons-style.css'/>
		   <link rel='stylesheet', href='stylesheets/font-awesome.css'/>
		   <link rel='stylesheet', href='stylesheets/style.css'/>
		   <link rel='stylesheet', href='stylesheets/style-responsive.css'/>
		   <link rel='stylesheet', href='icons/flaticon.css'/>
		   <?php
		   require('../configuraciones.php');
			conectar();
			validarsesion();
		   	$c=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$_GET['id']));
		   ?>
</head>
<body background="#A4C5E2" color='#A4C5E2'>
<h2 align="center"><b>Modificar Cuenta <?php echo $c['alias']?></b></h2>
<br>
			<form action="acciones_cuentas.php" name="nuevo" method="POST"  accept-charset="utf-8">
					<label><b>Alias</b></label>
					<input type="text" name="alias" id='alias' placeholder="Alias" class="form-control" value="<?php echo $c['alias']; ?>" required />
					<label><b>Nombre de Cuenta</b></label>
					<input type="text" name="nombre" id='nombre' placeholder="Nombre de la Cuenta"  value="<?php echo $c['nombre']; ?>" class="form-control"/>
					<label><b>Banco</b></label><br>
					<select name="banco" id='banco'  Class="form-control" style="width:70%; display: inline-block; readonly">
						
					</select>&nbsp;<img src="+.png" style="width:20px;" title="NUEVO BANCO" onclick="nuevo_banco();">
					<br>
					<br>
					<label><b>Numero de Cuenta</b></label>
					<input type="number" name="numero_cuenta"  id="numero_cuenta"  value="<?php echo $c['numero_cuenta']; ?>" placeholder="Numero de Cuenta" min='0' class="form-control" required readonly/>
					<label><b>Clave Interbancaria</b></label>
					<input type="text" name="clave" id="clave" placeholder="Clave Interbancaria"   value="<?php echo $c['clabe_interbancaria']; ?>" class="form-control" required/>
					<label><b>Saldo Inicial</b></label>
					<input type="number" min='0' name="saldo_i" id="saldo_i" placeholder="Saldo Inicial"  value="<?php echo $c['saldo_inicial']; ?>" class="form-control" required readonly/>
					<br>
					<input type="hidden" name="accion" value="modifica_cuenta">
					<input type="hidden" name="id" value="<?php echo $c['id'] ?>">
					<input type="button"  value="Guardar" class="btn btn-primary" onclick="modifica_cuenta();">
			</form>								
</body>
<script type="text/javascript">
	setTimeout(busca_bancos,1000);

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
	function modifica_cuenta()
	{
		if (document.getElementById('banco').value == 'Seleccione una Opcion') {
			alert('Error, SELECCIONE UN BANCO CORRECTO O CREE ALGUNO PARA PODER CONTINUAR.');
		}
		else if (document.getElementById('alias').value =='') {alert("ESCRIBA UN ALIAS")}
		else if (document.getElementById('nombre').value =='') {alert("ESCRIBA UN NOMBRE")}
		else if (document.getElementById('numero_cuenta').value =='') {alert("ESCRIBA UN NUMERO DE CUENTA")}			
		else if (document.getElementById('saldo_i').value =='') {alert("ESCRIBA UN SALDO INICIAL")}
		else if (document.getElementById('clave').value =='') {alert("ESCRIBA UNA CLAVE")}
		else{
			if (confirm("ESTA SEGURO DE GUARDAR LA NUEVA CUENTA..")) {
				nuevo.submit();

				opener.location.reload();			
			setTimeout(function () { 
				opener.mostrar('ver_cuenta');
				window.close();}, 1000);
			}
		}
	}

</script>
</html>