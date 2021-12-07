<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MODIFICAR</title>
	<link rel="stylesheet" href="">
	<?PHP
	require('../funciones2.php');
	conectar();
	?>
</head>
<body>
	<?php

		if ($_GET['tipo']=='unidad') 
		{
			$u=mysql_fetch_array(mysql_query("SELECT * FROM unidades_menu WHERE id=".$_GET['id']));
			echo "
					<form action='acciones_menus.php' name='unidad' method='POST' accept-charset='utf-8' onsubmit='return valida()'>
						<table border='2.5' bgcolor='#99D6FF'>
							<caption>UNIDADES</caption>
							<thead>
								<tr>
									<th align='center' colspan='2'>MODIFICAR UNIDAD</th>
								</tr>
							</thead>
							<tbody>
								
								<tr><td align='center'><b>Nombre: </b></td><td><input type='text' id='nombre' name='nombre' value='".$u['nombre']."' style='width:60px;' ></td></tr>
								<tr><td align='center'><b>Abreviación: </b></td><td><input type='text' name='descripcion' value='".$u['descripcion']."'   style='width:30px;'></td></tr>
						</tbody>
						</table>
						<br>
						<input type='hidden' name='accion' value='Modifica Unidad'>
						<input type='hidden' id='id'  name='id' value='".$_GET['id']."'>
						<!--input type='button' name='unidad' value='MODIFICAR' onclick='valida_formulario(this.name);'-->
						<input type='submit' value='MODIFICAR'>
					</form>
				 ";
		}
		if ($_GET['tipo']=='proveedor') 
		{
			$u=mysql_fetch_array(mysql_query("SELECT * FROM Proveedor_menu WHERE id=".$_GET['id']));
			echo "<center>
					<form action='acciones_menus.php' name='proveedor' method='POST' accept-charset='utf-8' onsubmit='return valida()'>
						<table border='2.5' bgcolor='#99D6FF'>
							<caption>PROVEEDOR</caption>
							<thead>
								<tr>
									<th align='center' colspan='2'>MODIFICAR PROVEEDOR</th>
								</tr>
							</thead>
							<tbody>
								
								<tr><td align='center'><b>Nombre: </b></td><td><input type='text' id='nombre' name='nombre' value='".$u['nombre']."' ></td></tr>
								<tr><td align='center'><b>Razon Social: </b></td><td><input type='text' name='descripcion' value='".$u['razon_social']."'  ></td></tr>
						</tbody>
						</table>
						<br>
						<input type='hidden' name='accion' value='Modifica Proveedor'>
						<input type='hidden' id='id' name='id' value='".$_GET['id']."'>
						<!--input type='button' name='proveedor' value='MODIFICAR' onclick='valida_formulario(this.name);'-->
						<input type='submit' value='MODIFICAR'>
					</form>
				 </center>";
		}
	?>
	
	
	<script>
		document.getElementById("nombre").addEventListener("input", validacion, false);
		function validacion(){
					 nombre= document.getElementById("nombre").value;
				 id= document.getElementById("id").value;
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
							if(xmlhttp.responseText=="OK"){
								document.getElementById("nombre").setCustomValidity('');
  								document.getElementById("nombre").style.background='##bbeffa';
								
							}else{
								document.getElementById("nombre").setCustomValidity('Error nombre duplicado');
  								document.getElementById("nombre").style.background='#FFDDDD';
							}
						}
				}
					xmlhttp.open("POST","validacion2.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("nombre="+nombre+"&opcion=nombre<?php echo $_GET['tipo'];?>&id="+id);
				 
		}
		
		function valida()
			 {
				 if(confirm("¿Esta seguro de guardar los cambios?")){
				 nombre= document.getElementById("nombre").value;
				 id= document.getElementById("id").value;
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
							//alert(xmlhttp.responseText);
							if(xmlhttp.responseText=="OK"){
								document.getElementById("nombre").setCustomValidity('');
  								document.getElementById("nombre").style.background='##bbeffa';
								return true;
							}else{
								document.getElementById("nombre").setCustomValidity('Error nombre duplicado'+xmlhttp.responseText);
  								document.getElementById("nombre").style.background='#FFDDDD';
								return false;
							}
						}
				}
					xmlhttp.open("POST","validacion2.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("nombre="+nombre+"&opcion=nombre<?php echo $_GET['tipo'];?>&id="+id);
				 }else{
					 return false;
				 }
			}
	</script>
	
	
	<!--script type="text/javascript">
	function valida_formulario(a)
	{ var g=''
		if(a=='unidad'){g='LA';}else{g="EL";}
		
	 if(confirm("¿ ESTA SEGURO DE MODIFICAR "+g+" "+a.toUpperCase()+" ?")){
		 if(a=='unidad'){
			 document.unidad.submit();
		 }else{
			 document.proveedor.submit();
		 }
	 }
	}
	</script-->
</body>
</html>