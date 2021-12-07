<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>NUEVO BANCO</title>
	<link rel="stylesheet" type="text/css" href="../Arbol/Arbol2/_styles.css" media="screen">
	        <linkrel='stylesheet', href='stylesheets/bootstrap.min.css'/>
		   <link rel='stylesheet', href='stylesheets/bootstrap-theme.css'/>
		   <link rel='stylesheet', href='stylesheets/elegant-icons-style.css'/>
		   <link rel='stylesheet', href='stylesheets/font-awesome.css'/>
		   <link rel='stylesheet', href='stylesheets/style.css'/>
		   <link rel='stylesheet', href='stylesheets/style-responsive.css'/>
		   <link rel='stylesheet', href='icons/flaticon.css'/>
</head>
<body>

	<div>
	<h2 align="center"><b>NUEVO BANCO</b></h2>
		<form action="acciones_cuentas.php" name="enviar" method="POST" accept-charset="utf-8">
		  	<label><b>Nombre</label>
			<input type="text" name="nombre" placeholder="Nombre de Banco" class="form-control" required />
			<label><b>Saldo Inicial</label>
			<input type="number" name="si" placeholder="Saldo Inicial" class="form-control"  min='0' required />
			<br><br>
			<input type="hidden" name="accion" value="nuevo_banco">
			<input type="button"  class="btn btn-primary" value="Guardar" onclick="enviar_formulario();">
		</form>
	</div>
	<script type="text/javascript">
	function enviar_formulario()
	{
		if (confirm("ESTA SEGURO DE GUARDAR EL NUEVO BANCO.?")) {
				enviar.submit();

				opener.location.reload();			
				setTimeout(function () { 
				opener.mostrar('ver_cuenta');
				window.close();}, 1000);
		};
	}
	</script>
</body>
</html>