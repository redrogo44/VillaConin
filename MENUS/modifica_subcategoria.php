<html>
	<head>
		<title>Modificar Subcategoria</title>
	</head>
	<body>
<?php
require('../funciones2.php');
conectar();
//print_r($_POST);
$ca=mysql_query("SELECT * FROM `Subcategoria_menu` WHERE id=".$_GET['id']);
$c=mysql_fetch_array($ca);

echo "<form name='envia' action='acciones_menus.php' method='post' onsubmit='return valida()'>
		<table>
			<caption>MODIFICAR SUB-CATEGORIA</caption>
			<thead>
				<tr>
					<th colspan='2'>DATOS DE LA SUB-CATEGORIA ".$c['nombre']."</th>
				</tr>
			</thead>
			<tbody>
				<tr>	<td>Nombre</td>		<td><input type='text' id='nombre' name='nombre' value='".$c['nombre']."'></td>	</tr>
				<tr>	<td>Descripcion</td>		<td><input type='text' name='descripcion' value='".$c['descripcion']."'></td>	</tr>
				<tr>
					<td>Categoria</td>
					<td>
						<select name='categoria'>
						";
						$ccc=mysql_query("SELECT * FROM `Categorias_menu`");
						while ($cc=mysql_fetch_array($ccc)) 
						{
							if($cc['id_categoria']==$c['id_categoria'])
							{
							echo "	<option value='".$cc['id_categoria']."' selected>".$cc['nombre']."</option>";
							}
							else{
							echo "	<option value='".$cc['id_categoria']."'>".$cc['nombre']."</option>";
							}
						}
						
						echo "</select>
					</td>
				</tr>
			</tbody>
		</table>
		<input type='hidden' name='accion' value='Modifica_subcategoria'>
		<input type='hidden' id='id' name='id' value='".$_GET['id']."'>
		<!--input type='button' name='enviar' value='MODIFICAR' onclick='envia_form();'-->
		<input type='submit' name='enviar' value='MODIFICAR'>
	</form>
	 ";
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
						xmlhttp.send("nombre="+nombre+"&opcion=nombresubcategoria&id="+id);
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
					xmlhttp.send("nombre="+nombre+"&opcion=nombresubcategoria&id="+id);
				 
		}
		</script>
	</body>
</html>