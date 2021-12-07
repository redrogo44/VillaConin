<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>PROVEEDOR</title>
	</head>
	<body>
		<form action="acciones_menus.php" method="POST" accept-charset="utf-8">	
		<table>
			<caption><b>PROVEEDOR</b></caption>
			<thead>
				<tr>
					<th align="center" colspan="2">Alta de nuevo Proveedor</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><b>Nombre: </b></td><td><input type="text" name="nombre" id="nombre" placeholder="EMPRESA" required></td></tr>
					<tr><td><b>Razon Social: </b></td><td><input type="text" name="rz" placeholder="EMPRESA X S.A. de C.V." required></td>
				</tr>
			</tbody>
		</table>
		<br>
		<input type="hidden" name="emergente" value="1">
		<input type="hidden" name="accion" value="Nuevo Proveedor">
		<input type="submit"  value="Guardar Proveedor">
	</form>
		<script>
		document.getElementById("nombre").addEventListener("input", VNP, false);
		function VNP(){
			
			var xmlhttp;
			nombre= document.getElementById("nombre").value;
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
							}else{
								document.getElementById("nombre").setCustomValidity('Error nombre duplicado');
								document.getElementById("nombre").style.background='#FFDDDD';
							}
			    			   		
			    		}
			  	}
			xmlhttp.open("POST","validacion2.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("nombre="+nombre+"&opcion=nuevoproveedor");
		}
		</script>
	</body>
	</html>	