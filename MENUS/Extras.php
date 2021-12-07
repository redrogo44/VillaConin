<html>
	<head>
		<title>Extras</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
		  Agregar Evento
		</button> 

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar Evento</h4>
			  </div>
			  <div class="modal-body">
				  <form action="Extras2.php" method="post">
					<table>
							<tr><td>Fecha</td><td><input type="date" name="fecha" required></td></tr>	
							<tr><td>Tipo de Evento</td><td><input type="text" name="tipo"  required></td></tr>
							<tr><td>Comensales</td><td><input type="number" name="comensales"  required></td></tr>
							<input type="hidden" name="op" value="agregar_extra">
							<tr><td><br><br></td></tr>
					</table>
					  <input type="submit" class="btn btn-primary" value="Guardar">
					  <button style="right:0px;" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </form>
			  </div> 
			</div>
		  </div> 
		</div>
		<br><br>
		<center><b>buscar Evento extras</b></center><br>
		De:<input type="date" id="f1"> Hasta:<input type="date" id="f2"><button onclick="buscar()">Buscar</button>
		<br>
		<div id="eventos">
		
		</div>
		<script> 
			function buscar()
			{
				f1=document.getElementById("f1").value;
				f2=document.getElementById("f2").value;
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
							document.getElementById('eventos').innerHTML=xmlhttp.responseText;   		
						}
				}
				xmlhttp.open("POST","Extras2.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("op=busca_evento&f1="+f1+"&f2="+f2);
			}
		
			function eliminar(id){
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
							buscar();		
						}
				}
				xmlhttp.open("POST","Extras2.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("op=eliminar_evento&id="+id);
			}
			
			function asignar_menu(id){
				window.open("asignar_menu.php?numero="+id,"top=100px,left=100px,width=600px,height=400px");
			}
		</script>
	</body>
</html>