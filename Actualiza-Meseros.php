<?php
require("funciones2.php");
conectar();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<title>Actualiza Meseros</title>
</head>
<body>
	<div>
		<table>
			<caption>Actualice Meseros</caption>			
			<tbody>
				<tr>
					<td><b>NOMBRE</b></td>
					<td><b>PUNTOS</b></td>
					<td><b>EVENTOS</b></td>
					<td><b>MODIFICAR</b></td>
				</tr>
				<?php
					$t=mysql_query("SELECT * FROM Meseros GROUP BY tipo");
					while ( $c=mysql_fetch_array($t)) 
					{
						$me=mysql_query("SELECT * FROM Meseros WHERE tipo='".$c['tipo']."' AND `modificado`='no' ");
						echo "<tr><td colspan='4' align='center' style='background-color: #000;'><font color='#F00'><b>".$c['tipo']."</b></font></td></tr>";
						while ($m=mysql_fetch_array($me)) 
						{
							echo "<tr>
										<td><b>".$m['nombre']." ".$m['ap']." ".$m['am']."</b></td>
										<td><input type='number' id='puntos-".$m['id']."' value='' placeholder='# de Puntos' ></td>
										<td><input type='number' id='eventos-".$m['id']."' value='' placeholder='# de Eventos' ></td>
										<td><input type='button' value='MODIFICAR' onclick='modifica(".$m['id'].");'></td>
								 </tr>";
						}
					}
				?>
			</tbody>
		</table >
		<form action="modificaMeseros.php" name="cambia" method="post">
			<input type="hidden" name="puntos" id='puntos' value="">
			<input type="hidden" name="eventos" id='eventos' value="">
			<input type="hidden" name="id" id='id' value="">
		</form>
	</div>

<script type="text/javascript">
	function modifica(id)
	{

		var p=$('#puntos-'+id).val();
		var e=$('#eventos-'+id).val();
		if(p=='')
		{
			alert("INGRESE UN VALOR CORRECTO PARA LOS PUNTOS");
		}
		else if(e=='')
		{
			alert("INGRESE UN VALOR CORRECTO PARA EL NUMERO DE EVENTOS");
		}
		else
		{
			if (confirm("CONFIRME LA SIGUENTE INFORMACION \n\n PUNTOS = "+p+",\n NUMERO DE EVENTOS = "+e)) 
			{
				//alert(p+" => "+e);
				$('#puntos').val(p);
				$('#eventos').val(e);
				$('#id').val(id);
				cambia.submit();
			}
			
		}
		
	}
</script>
</body>
</html>