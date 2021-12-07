<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Ingrediente</title>
</head>
<body>
	<form action="acciones_menus.php" method="POST" name="ingrediente">
<table>
	<caption>NUEVO INGREDIENTE</caption>
	<thead>
		<tr>
			<th colspan="2">LLENA EL FORMULARIO</th>
		</tr>
	</thead>
	<tbody>
		<tr><td><B>Nombre: </B></td> <td><input type="text" name="nombre" id="nombre" value="" placeholder="NOMBRE DEL INGREDIENTE" required></td></tr>
		<tr><td><B>Descripcion: </B></td> <td><input type="text" name="descripcion" value="" placeholder="DESCRIPCION" required></td></tr>
		<tr><td><B>Unidad: </B></td> <td>
		<select name="unidad" required>
							<?php
						require('../funciones2.php');
						conectar();
								$un=mysql_query("SELECT * FROM `unidades_menu` ");
								while($u=mysql_fetch_array($un))
								{
									echo "
												<option value='".$u['descripcion']."'>".$u['nombre']."</option>
									";
								}
							?>
										
							</select></td>
		</tr>
		<tr><td><B>Proveedor: </B></td> <td>
							<select name="proveedor" id='proveedor_ingrediente' required>
						<option value=''>Seleccione una Opcion</option>							
									<?php
										$un=mysql_query("SELECT * FROM `Proveedor_menu` ");
										while($u=mysql_fetch_array($un))
										{
											echo "
														<option value='".$u['id']."'>".$u['nombre']."</option>
											";
										}
									?>	
							</select>
            					<img src="+.png" style="width:20px;" title="CREAR UNIDAD" onclick="nuevo_proveedor();">

							</td>
		</tr>
	</tbody>
</table>
<input type="hidden" name="accion" value="nuevo_ingrediente"><br>
<input type="hidden" name="emergente" value="1"><br>
<input type="submit"  value="Guardar" onclick="activa_segundero();">
</form>
</body>

<script type="text/javascript">
/*function activa_segundero()
{
	setTimeout(cerrar(), 5000);
}
	function cerrar()
	{
		window.close();
	}
*/
		document.getElementById("nombre").addEventListener("input", VNI, false);
		function VNI(){
			
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
			xmlhttp.send("nombre="+nombre+"&opcion=nuevoingrediente");
		}
function nuevo_proveedor(){
	window.open("nuevo_proveedor.php", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
}
</script>
</html>