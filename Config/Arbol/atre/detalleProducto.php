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
	<title>Detalle de Productos</title>
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
	<div class="col-lg-12" align="center">
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
		<h3>INGRESE EL ID DEL PRODUCTO</h3><input type="text" id='idp' name="idp" value="" placeholder="id del Producto">
		<input type="submit" name='submit'>
		
	</form><br><br>
	<button onclick="listado();">LISTADO DE PRODUCTOS</button>
	</div>

	<?php if ($_POST['submit']):
	
		$p=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$_POST['idp']));
	?>
		<div class="col-lg-12"><h3>Nombre del Producto: <?php echo $p['nombre']." ".$p['descripcion'];?></h3></div>
<div style="display: block; vertical-align: top; position: static; float: left;">
		<div class="compras">
			<?php $t=0;
				$co=mysql_query("SELECT * FROM detalle WHERE tipo='compra' and id_producto=".$p['id_producto']);
				echo "
						<table>
							<caption>HISTORICO DE COMPRAS</caption>
							<thead>
								<tr>
									<th>Cantidad</th>
									<th>Precio Adquisición</th>
									<th>Total</th>									
								</tr>
							</thead>
							<tbody>";

								while ($c=mysql_fetch_array($co)) 
								{
									echo "
										<tr>
											<td>".$c['cantidad']."</td>
											<td>".$c['precio_adquisicion']."</td>
											<td>".($c['importe'])."</td>
											
										</tr>
										";
										$t+=($c['importe']);
										
								}
								
					  echo "	<tr>
					  				<td colspan='2'>Total: </td>
					  				<td><b id='compras'>".$t."</b></td>
					  			</tr>
					  		</tbody>
						</table>
					 ";
			?>

		</div>
		<div class="comprasfac">
			<?php 
				$co=mysql_query("SELECT * FROM detalle WHERE tipo='comprafac' and id_producto=".$p['id_producto']);
				echo "
						<table>
							<caption>HISTORICO DE COMPRAS FACTURADAS</caption>
							<thead>
								<tr>
									<th>Cantidad</th>
									<th>Precio Adquisición</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>";
								$t=0;
								while ($c=mysql_fetch_array($co)) 
								{
									echo "
										<tr>
											<td>".$c['cantidad']."</td>
											<td>".$c['precio_adquisicion']."</td>
											<td>".($c['importe'])."</td>
										</tr>
										";
										$t+=($c['importe']);
								}
								
					  echo "	<tr>
					  				<td colspan='2'>Total: </td>					  			
					  				<td><b id='comprasfactu'>".$t."</b></td>
					  			</tr>
					  		</tbody>
						</table>
					 ";
			?>

		</div>
		<div class="entradas">
			<?php 
				$co=mysql_query("SELECT * FROM detalle WHERE tipo='entrada' and id_producto=".$p['id_producto']);
				echo "
						<table>
							<caption>HISTORICO DE ENTRADAS</caption>
							<thead>
								<tr>
									<th>Cantidad</th>
									<th>Precio Adquisición</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>";
								$t=0;
								while ($c=mysql_fetch_array($co)) 
								{
									echo "
										<tr>
											<td>".$c['cantidad']."</td>
											<td>".$c['precio_adquisicion']."</td>
											<td>".($c['importe'])."</td>
										</tr>
										";
										$t+=($c['importe']);
								}
								
					  echo "	<tr>
					  				<td colspan='2'>Total: </td>					  			
					  				<td><b id='tentradas'>".$t."</b></td>
					  			</tr>
					  		</tbody>
						</table>
					 ";
			?>

		</div>
		<div class="salidas">
			<?php 
				$co=mysql_query("SELECT * FROM detalle WHERE tipo='salida' and id_producto=".$p['id_producto']);
				echo "
						<table>
							<caption>HISTORICO DE SALIDAS</caption>
							<thead>
								<tr>
									<th>Cantidad</th>
									<th>Precio Adquisición</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>";
								$t=0;
								while ($c=mysql_fetch_array($co)) 
								{
									echo "
										<tr>
											<td>".$c['cantidad']."</td>
											<td>".$c['precio_adquisicion']."</td>
											<td>".($c['importe'])."</td>
										</tr>
										";
										$t+=($c['importe']);
								}
								
					  echo "	<tr>
					  				<td colspan='2'>Total: </td>					  			
					  				<td><b id='tsalidas'>".$t."</b></td>
					  			</tr>
					  		</tbody>
						</table>
					 ";
			?>

		</div>
			<div class="ventas">
			<?php 
				$co=mysql_query("SELECT * FROM detalle WHERE tipo='venta' and id_producto=".$p['id_producto']);
				echo "
						<table>
							<caption>HISTORICO DE VENTAS</caption>
							<thead>
								<tr>
									<th>Cantidad</th>
									<th>Precio Adquisición</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>";
								$t=0;
								while ($c=mysql_fetch_array($co)) 
								{
									echo "
										<tr>
											<td>".$c['cantidad']."</td>
											<td>".$c['precio_adquisicion']."</td>
									
											<td>".($c['cantidad']*$c['precio_adquisicion'])."</td>
										</tr>
										";
										//$t+=($c['importe']);
										$t+=($c['cantidad']*$c['precio_adquisicion']);
								}
								
					  echo "	<tr>
					  				<td colspan='2'>Total: </td>					  			
					  				<td><b id='tventas'>".$t."</b></td>
					  			</tr>
					  		</tbody>
						</table>
					 ";
			?>

		</div>
</div>
		<div class="resumen col-lg-6" style="display: block; vertical-align: top; position: static; float: right;">
			<h3>RESUMEN</h3>
			<h4>Total de Compras: <font color="#f00"><b id="tc"></b></font></h4><br>
			<h4>Total de Compras Facturadas: <font color="#f00"><b id="tcf"></b></font></h4><br>
			<h4>Total de Entradas: <font color="#f00"><b id="te"></b></font></h4><br>
			<h4>Total de Salidas: <font color="#f00"><b id="ts"></b></font></h4><br>
			<h4>Total de Ventas: <font color="#f00"><b id="tv"></b></font></h4><br>

			<br>

			<h3>TOTAL INVERSION: <font color="#002FFF"><b id="totalInversion"></b></font></h3>
			<p>El calculo de la inversion de hace la siguiente manera.</p>
			<p>(LA SUMATORIA DE LAS ENTRADAS, COMPRAS Y COMPRAS FACTURADAS) MENOS(-) (LA SUMA DE LAS VENTAS Y SALIDAS)	</p>

		</div>
	<?php endif?>
	<script type="text/javascript">
		var ve= parseFloat($("#tventas").text());
		var sa= parseFloat($("#tsalidas").text());
		var en= parseFloat($("#tentradas").text());
		var cof= parseFloat($("#comprasfactu").text());
		var co= parseFloat($("#compras").text());

var t=(co+cof+en)-(sa+ve);
		$("#tv").text(ve);
		$("#ts").text(sa);
		$("#te").text(en);
		$("#tcf").text(cof);
		$("#tc").text(co);
		$("#totalInversion").text(t);

	function listado()
	{
		window.open("listaProductos.php", "Lista de Productos", "width=500, height=500");
	}
	</script>
}
</body>
</html>