<html>
	<head>
		<title>Modificar Categoria</title>
	</head>
	<body>

<?php
require('../funciones2.php');
conectar();
//print_r($_POST);
$ca=mysql_query("SELECT * FROM `Categorias_menu`WHERE id_categoria=".$_GET['id']);
$c=mysql_fetch_array($ca);

echo "<form name='envia' action='acciones_menus.php' method='post' onsubmit='return valida();'>
		<table>
			<caption>MODIFICAR CATEGORIA</caption>
			<thead>
				<tr>
					<th colspan='2'>DATOS DE LA CATEGORIA ".$c['nombre']."</th>
				</tr>
			</thead>
			<tbody>
				<tr>	<td>Nombre</td>		<td><input type='text' id='nombre' name='nombre' value='".$c['nombre']."'></td>	</tr>
				<tr>	<td>Descripcion</td>		<td><textarea name='descripcion' >".$c['descripcion']."</textarea> </td>	</tr>";
				/*<tr>	<td>Estatus</td>		<td>
													<select name='estatus'>";
													if($c['estatus']=="ACTIVO")
													{
														echo '<option value="'.$c['estatus'].'" selected>ACTIVO</option>';
														echo '<option value="SUSPENDIDO" >SUSPENDIDO</option>';													

													}
													else
													{
														echo '<option value="ACTIVO">ACTIVO</option>';														
														echo '<option value="'.$c['estatus'].'" selected>SUSPENDIDO</option>';
													}
													echo '																					
													</select>
												</td>	
				</tr>*/
		echo'</tbody>
		</table>
		<input type="hidden" name="accion" value="Modifica_categoria">
		<input type="hidden" id="id" name="id" value="'.$_GET['id'].'">
		<!--input type="button" name="enviar" value="MODIFICAR" onclick="envia_form();"-->
		<input type="submit" name="enviar" value="MODIFICAR">
	</form>
	 ';


?>
		
		<script>
				document.getElementById("nombre").addEventListener("input", validacion, false);
			 function valida()
			 {
				 if(confirm("Esta seguro de guardar los cambios?")){
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
						xmlhttp.send("nombre="+nombre+"&opcion=nombrecategoria&id="+id);
				 }else{
					 return false;
				 }
			}
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
					xmlhttp.send("nombre="+nombre+"&opcion=nombrecategoria&id="+id);
				 
		}
		</script>
	</body>
</html>