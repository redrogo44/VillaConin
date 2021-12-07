<?php
require('../../configuraciones.php');
		conectar();
		validarsesion();
	$nivel=$_SESSION['niv'];	
	$_SESSION['usu']=$_GET['usuario'];
	date_default_timezone_set('America/Mexico_City');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>LISTA DE PRODUCTOS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<style type="text/css" media="screen">
		table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    font-size: 12px;    margin: 45px;     width: 480px; text-align: left;    border-collapse: collapse; }

th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

td {    padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; }

tr:hover td { background: #d0dafd; color: #339; }
	</style>
</head>
<body>
	<div class="col-lg-12">
		<table>
			<caption>LITADO DE PRODUCTOS VINOS</caption>
			<thead>
				<tr>
					<th>id</th>
					<th>Nombre</th>
					<th>Descripcion</th>					
					<th>SELECCIONAR</th>					
				</tr>
			</thead>
			<tbody>
				<?php
				  $pr=mysql_query("SELECT* FROM producto WHERE id_categoria=1 ORDER BY id_producto");
				  while($p=mysql_fetch_array($pr))
				  {
				  	echo "
				  			<tr>
								<td>".$p['id_producto']."</td>
								<td>".$p['nombre']."</td>
								<td>".$p['descripcion']."</td>
								<td><button type='button' name='".$p['id_producto']."' onclick='seleccion(this.name);'>SELECCIONAR</button></td>
							</tr>
				  		 ";
				  }
				?>
			</tbody>
		</table>
	</div>
	<script type="text/javascript">
		function seleccion(id)
		{
			window.opener.document.getElementById('idp').value = id; 
			window.close();
		}
	</script>
</body>
</html>