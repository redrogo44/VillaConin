<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nueva Unidad</title>
</head>
<body>
	<form  id="nueva_categoria" action="acciones_menus.php" method="post" onsubmit="return ve()">
		<table border="5">
			<caption colspan='2'>Nueva Unidad de Medida</caption>
			<thead>
				<tr>
					<th colspan="2">Informacion Nueva Unidad</th>
				</tr>
			</thead>
			<tbody>
				<tr><td><b>Nombre</b></td>		<td><input type="text" name="nombre" id='nombre_nueva_sub' placeholder=" Nombre de la Unidad" required></td></tr>
				<tr><td><b>Abreviación</b></td>	<td><input type="text" name="descripcion" id="descripcion" placeholder=" abreviación" requied></td>			</tr>				
			</tbody>
		</table>	
		<input type="hidden" name="accion" value="Nueva Unidad">
		<input type="hidden" name="emergente" value="1">
		<input type="submit"  value="Guardar">
	</form>
	<script>
			document.getElementById("nombre_nueva_sub").addEventListener("input", validacion, false);
		function validacion(){
				nombre= document.getElementById("nombre_nueva_sub").value;
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
								document.getElementById("nombre_nueva_sub").setCustomValidity('');
  								document.getElementById("nombre_nueva_sub").style.background='##bbeffa';
								
							}else{
								document.getElementById("nombre_nueva_sub").setCustomValidity('Error nombre duplicado');
  								document.getElementById("nombre_nueva_sub").style.background='#FFDDDD';
							}
						}
				}
					xmlhttp.open("POST","validacion2.php",true); 
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("nombre="+nombre+"&opcion=nuevonombreunidad");
				 
		}

		function ve(){
			ab=document.getElementById("descripcion").value;
			if(ab!=""){
				document.getElementById("descripcion").setCustomValidity('');
  				document.getElementById("descripcion").style.background='##bbeffa';
				return true;
			}else{
				document.getElementById("descripcion").setCustomValidity('Llene el campo');
  				document.getElementById("descripcion").style.background='##bbeffa';
				return false;
			}
		}
		</script>
</body>
</html>