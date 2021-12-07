<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>EDITAR MENU</title>
	<link rel="stylesheet" type="text/css" href="estilos.css" />
 		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<!-- 			TERMINA	MENU	--> 	
	<!-- 			VENTANA EMERGENTE	--> 	
	 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
 		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
   		<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
	<!-- 			TERMINA VENTANA EMERGENTE	--> 	
	<!-- 			AUTOCOMPLETADOR	--> 
	<link type="text/css" rel="stylesheet" href="autocomplete.css"></link>	
	<script src="rmm-js/autocomplete.jquery.js"></script>
	<script src="js/jquery-ui.min.js"></script>
</head>
<script>
            $(document).ready(function(){
                /* Una vez que se cargo la pagina , llamo a todos los autocompletes y
                 * los inicializo */
                 //alert('entro el autocompletador');
                $('.autocomplete').autocomplete({
                 select: function( event, ui ) {}
                });
                
            });
        </script>
<body >
	
<!--*********************  EDITAR MENU ***************************-->
		<?php
		require("../funciones2.php");
		conectar();
		$m=mysql_fetch_array(mysql_query("SELECT * FROM Menus WHERE id_menu=".$_GET['id']));
		$cat_actual=mysql_fetch_array(mysql_query("select * from Categorias_menu where id_categoria=".$m["id_Categoria_menu"]));
		$cat=mysql_query("select * from Categorias_menu where id_categoria !=".$m["id_Categoria_menu"]." order by nombre");
		$sub_actual=mysql_fetch_array(mysql_query("select * from Subcategoria_menu where id=".$m["id_subcategoria"]));
		$sub=mysql_query("select * from Subcategoria_menu where id != ".$m["id_subcategoria"]." and id_categoria=".$m["id_Categoria_menu"]." order by nombre");
	
	
		echo '<div  id="edita_menu" align="center"><br>
		<form action="acciones_menus.php" method="post"  name="guarda"  enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return validamenu()">
			<table  >
				<caption>MODIFICAR MENU</caption>
				<thead>
					<tr>
						<th colspan="2" align="center">ABASTESCA DE INFORMACION EL FORMULARIO</th>
					</tr>
				</thead>
				<tbody>
					<tr>	<td align="center"><b>Nombre</b></td>	<td><input type="text" id="nombre" name="nombre" value="'.$m['nombre'].'" placeholder="Ensalada de pollo Africano" required></td>		</tr>
					<tr>	<td align="center"><b>Descripción</b></td>	<td><input type="text" name="descripcion_mennu"  value="'.$m['descripcion'].'"   placeholder="Ensalada con pollo y papas" required></td>		</tr>
					<tr>	<td align="center"><b>Categoria</b></td>	<td>
							<select id="categoria" name="categoria"  onchange="cambia_select(this.value)"required>
								<option value="'.$m["id_Categoria_menu"].'">'.$cat_actual["nombre"].'</option>';
									while($categorias=mysql_fetch_array($cat)){
										echo '<option value="'.$categorias["id_categoria"].'">'.$categorias["nombre"].'</option>';
									}							
							echo '</select>			
						</td>	
					</tr>
					<tr>	<td align="center"><b>Sub-Categoria</b></td>	<td>
							<select id="subcategoria" name="subcategoria" required>
								<option value="'.$m["id_subcategoria"].'">'.$sub_actual["nombre"].'</option>';
								while($subcategorias=mysql_fetch_array($sub)){
										echo '<option value="'.$subcategorias["id"].'">'.$subcategorias["nombre"].'</option>';
									}					
						echo '	</select></td>	
					</tr>
				</tbody>
			</table>
			 <div class="autocomplete" >
		            <p onclick="add_title()" style="display:inline;z-index:0;">Agregar Titulo</p><br><br>	
		            <input  type="text" value="" data-source="search.php?search=" id="producto" style="display:inline-block;" autocomplete="off" placeholder="      Busca Ingrediente " />
					<b onclick="closeAutocomplete()" style="display:inline-block;color:#F00;border:solid;">X</b><br>
		      </div>
		      <table border="5"  name="tabla_ingredientes" id="tabla_ingredientes">
		      	<thead>
		      		<tr>
		      			<th colspan="7">Ingredientes</th>
		      		</tr>
		      	</thead>
		      	<tbody>
		      		<tr>
		      			<td align="center" style="width:50px;"><b>Cantidad</b></td>      			
		      			<td align="center"><b>Unidad<br>Recetario</b></td>
		      			<td align="center"><b>Nombre</b></td>		      			
		      			<td align="center"><b>Decripcion</b></td>
						<td align="center"><b>Comentario</b></td>
		      			<td align="center"><b>Ultimo Costo<br>Proporcional</b></td>		      			
		      			<td align="center"><b>Eliminar</b></td>
						<td></td>
		      		</tr>';
		      		$ingre=explode(",", $m['ingredientes']);
		      		$cantidad=explode(",", $m['cantidades']);
					$comentario=explode("|", $m['comentarios']);
					$i2=2;
					$CostoTotal=0;
		      		for($i=0;$i<count($ingre);$i++)
		      		{	
						if($ingre[$i]!=""&& is_numeric($ingre[$i])){
							
							$in=mysql_fetch_array( mysql_query("SELECT * FROM producto WHERE id_producto=".$ingre[$i]));
							$inv=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$ingre[$i]));
							$unidad=mysql_fetch_array(mysql_query("select * from unidades_menu where descripcion='".$inv["UnidadMenu"]."'"));
							$porc=($cantidad[$i]/$inv["Equivalencia"])*$inv["precio"];
							$CostoTotal+=$porc;
							echo "<tr>
									<td align='center' style='width:50px;'>
										<input type='text' name='cantidad".$i."' id='cantidad".$i."' value='".$cantidad[$i]."' style='width:60px;' onchange='calculaCosto(this.value,".$in['id_producto'].")' required/>
									</td>
									<td align='center'>
										<input type='text' name='unidad".$i."' value='".$unidad['nombre']."' id='unidad".$i."' readonly='readonly' style='width:80px;' /><input type='hidden' name='id_producto".$i."' value='".$in['id_producto']."'/>
									</td>
									<td align='center'>
										<input type='text' name='ingrediene".$i."' value='".$in['nombre']."' title='".$in['descripcion']."' id='ingrediente".$i."' readonly='readonly' />
									</td>
									<td>
									".$in['descripcion']."
									</td>
									<td>
									<input type='text' value='".$comentario[$i]."' name='comentario".$i."'>
									</td>
									<td>
									<input type='hidden' id='aux".$in['id_producto']."' value='".$porc."'>
									<p id='CostoP".$in['id_producto']."'>$".number_format($porc,3)."</p>
									</td>
									<td align='center'>
										<img src='X.png' style='width:20px;' title='BUSCAR INGREDIENTES' onclick='elimina_producto(".$i.");'>
									</td>
									<td><input type='checkbox' class='check' value='".$i."'> </td>
								 </tr>";$i2++;
						}else if($ingre[$i]!=""){
							echo "<tr><td colspan='8' align='center' style='background-color:lightgray;'> 
							<input type='text' name='id_producto".$i."' value='".$ingre[$i]."' style='width:90%;display:inline-block;'><b onclick='deleteTitle(".$i.")' style='color:red;display:inline-block;'>&nbsp&nbsp X</b>
							<input type='hidden' name='cantidad".$i."' id='cantidad".$i."'  value='0'>
							<input type='hidden' name='ingrediene".$i."' value='".$in['nombre']."'/>
							</td></tr>"; 
							
							echo '<tr>
								<td align="center" style="width:50px;"><b>Cantidad</b></td>      			
								<td align="center"><b>Unidad</b></td>
								<td align="center"><b>Nombre</b></td>		      			
								<td align="center"><b>Descripcion</b></td>	
								<td align="center"><b>Comentario</b></td>	
								<td align="center"><b>Ultimo Costo<br>Proporcional</b></td>		      			
								<td align="center"><b>Eliminar</b></td>
								<td></td>
							</tr>';
						} 
		      		}
				echo "<tr><td colspan='4' align='right'>Total</td><td><p id='TNT'>$".number_format($CostoTotal,3)."</p></td></td></tr>";
		      	echo '</tbody>
		      </table><br><br>
		      <b>INSTRUCCIONES:</b><br><div align="center"> <textarea name="instrucciones" rows="8" cols="33">'.$m['instrucciones'].'</textarea></div>
		      Desea Cambiar la Imagen: <input name="changefoto" type="checkbox" onclick="muestra_form_imagen();" id="checkbox">
		     	<div style="display:none" id="imegen_menu"><br>
				   <input id="file_url" type="file" name="foto"><br>	 
				
				    <br></br>		 
				   <img id="img_destino" src="#" alt="Tu imagen" width="300" height="300">
				</div>
				<div id="picture">
					<center>
						<img src="Fotos/'.$m['imagen'].'" style="width:200px;">
					</center>
				</div>
				<br><br>
				   <input type="submit" value="Guardar" >		   
			   
			<input type="hidden" name="accion" value="Modifica Menu" />
			<input type="hidden" id="id" name="id" value="'.$_GET['id'].'" />
			<input type="hidden" name="filas" id="filas_ingredientes"/>
		</form>
		</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
		?>

</body>
<script type="text/javascript">

var TotalMenu=<?php echo $CostoTotal; ?>;
	function crear_nuevo_producto()
	{
		window.open("nuevo_producto.php", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
	}
	
	function agrega_filas_ingredientes()
	{

	var a=document.getElementById('producto').value;	
	var producto=a.split('-');

	/////////////////////////////////////////////////////////////////////////////////////
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
    			location.reload();
    			
				//}

    		}
  	} 
		xmlhttp.open("POST","acciones_menus.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("producto="+producto[0]+"&accion=agregaIngrediente&menu=<?php echo $_GET["id"];?>");    
	//////////////////////////////////////////////////////////////////////////////////////
	$('#tabla_ingredientes').show();			
	document.getElementById('producto').value='';
}



	function muestra_form_imagen()
 {
 	//alert('entro a la imagen');
 	if(document.getElementById('checkbox').checked)
 	{
 		$('#imegen_menu').show(); 
		$('#picture').hide();
 	}
 	else
 	{
 		$('#imegen_menu').hide();	
		$('#picture').show();
 	}
 }
 function mostrarImagen(input) {
 if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload = function (e) {
   $('#img_destino').attr('src', e.target.result);
  }
  reader.readAsDataURL(input.files[0]);
 }
}
function elimina_producto(f)
{
	if(confirm("¿Estas seguro en eliminar el producto?")){
		var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				//document.getElementById("demo").innerHTML = xhttp.responseText;
				//alert(xhttp.responseText);
				location.reload();
			}
		 	};
		  	xhttp.open("POST", "acciones_menus.php", true);
		  	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		  	xhttp.send("menu=<?php echo $_GET['id']; ?>&ingrediente="+f+"&accion=eliminaIngrediente");
	}
	
}
function elimina_producto2(f)
{
	//alert(f);
	if(confirm("¿Estas seguro en eliminar el producto?")){
		document.getElementById("tabla_ingredientes").deleteRow(f);
	}
	
}
function guardar()
{
	if (confirm("ESTA USTED SEGUR@ DE GUARDAR LA PROYECCION")) 
			{
				document.getElementById('filas_ingredientes').value="<?php echo $sig;?>";
				guarda.submit();

			}
}
$("#file_url").change(function(){
 mostrarImagen(this);
});


function cambia_select(id)
 {
 	//alert(id);
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
    			document.getElementById("subcategoria").options.length = 0;
				var xx=xmlhttp.responseText;
    			if(xx!=0)
		    	{
		    			mis_provincias=xx.split(",");
		    			num_opciones = mis_provincias.length-1;
						//marco el número de provincias en el select
						document.getElementById("subcategoria").length = num_opciones;
						//para cada provincia del array, la introduzco en el select
						for(i=0;i<num_opciones;i++)
						{
							var op=mis_provincias[i].split("-");
						   document.getElementById("subcategoria").options[i].value=op[0]
						   document.getElementById("subcategoria").options[i].text=op[1]
						}	
				}
				else{
						//si no había provincia seleccionada, elimino las provincias del select
						document.getElementById("subcategoria").length = 1
						//coloco un guión en la única opción que he dejado
						document.getElementById("subcategoria").options[0].value = "-"
					    document.getElementById("subcategoria").options[0].text = "-"
					}
    		}
  	}
		xmlhttp.open("POST","busca_categorias.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("id="+id);
 }

	document.getElementById("nombre").addEventListener("input", validacion, false);
	function validacion(){
		var xmlhttp;
		nombre= document.getElementById("nombre").value;
		id=document.getElementById("id").value;
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
			xmlhttp.send("nombre="+nombre+"&opcion=opcionmenumodificacion&id="+id);
	
		}

	function validamenu(){
		var renglones=document.getElementById("tabla_ingredientes").rows.length;
		//alert(renglones);
		if(renglones>2){
			var c = document.getElementById("tabla_ingredientes").rows.length;
			document.getElementById("filas_ingredientes").value=c
			return true;
		}else{
			alert("Error: El menu debe de contar con almenos un ingrediente");
			return false;
		}
	}

	function add_title(){
		var name =prompt("Escribe el Titulo del platillo");
		if(name!=""){
			if(confirm("¿Estas seguro de guardar los cambios?")){
				var x = document.getElementsByClassName("check");
				var i;var contador=0;ing=[];
				for (i = 0; i < x.length; i++) {
					if(x[i].checked==true){
						ing.push(x[i].value);
						contador++;
					}
				}
				
				if(contador>0){
					loadtitle("<?php echo $_GET["id"]?> ",name,ing);
				}else{
					alert("No se ha seleccionado ningun ingrediente");
				}
			}
		}else{
			alert("Error Introduzca un nombre valido");
		}
	}

	function loadtitle(menu,nombre,ingredientes) {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
		 	//document.getElementById("demo").innerHTML = xhttp.responseText;
			//alert(xhttp.responseText);
			location.reload();
		}
	  };
	  xhttp.open("POST", "subtitulos.php", true);
 	  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("menu="+menu+"&nombre="+nombre+"&ingredientes="+ingredientes);
	}

function calculaCosto(cantidad,id){
	var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("CostoP"+id).innerHTML ="$"+xhttp.responseText;
			var before=document.getElementById("aux"+id).value;
			var diff=parseFloat(xhttp.responseText)-before;
			TotalMenu+=diff;
			document.getElementById("TNT").innerHTML="$"+parseFloat(TotalMenu).toFixed(3);
			//alert(xhttp.responseText);
			//location.reload();
		}
	  };
	  xhttp.open("POST", "CalcularCosto.php", true);
 	  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("id="+id+"&cantidad="+cantidad);
}
function closeAutocomplete(){
			$(".autocomplete-jquery-results").hide();
		}
function deleteTitle(i){
	if(confirm("¿Estas realmente seguro en eliminar el titulo?")){
		var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
		 	//document.getElementById("demo").innerHTML = xhttp.responseText;
			//alert(xhttp.responseText);
			location.reload();
		}
	  };
	  xhttp.open("POST", "acciones_menus.php", true);
 	  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("menu=<?php echo $_GET['id']; ?>&ingrediente="+i+"&accion=eliminaIngrediente");
	}
}
</script>
</html>