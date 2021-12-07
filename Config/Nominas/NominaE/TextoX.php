<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ingrese Texto</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
 	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<div align="center"><br>
		<label>ESPECIFIQUE FECHAS, O DIAS DE LA NOMINA:</label>
		<br><br>
		<input type="text" name="texto" id="texto" placeholder=" INGRESE EL TEXTO QUE DESEA VER EN EL PDF">
		<br><br>
		<input type="button" name="boton"  value="Guardar" onclick="regresa();">
	</div>
	<script type="text/javascript">
	var t="<?php echo $_GET['t']?>";

		function regresa()
		{
			alert($("#texto").val());			
			if(confirm("POR FAVOR CONFIRME SI EL TEXTO '"+$("#texto").val()+"' ES CORRECTO."))
			{
				if(confirm("CONFIRME GUARDAR LA NOMINA ACTUAL"))	
				{
					
					if(t=='NominaEventos')
					{
						window.opener.document.getElementById('textoEv').value = $("#texto").val(); 							
						window.opener.document.NominaEventos.submit();
					}if(t=='NominaExtra')
					{
						window.opener.document.getElementById('textoEx').value = $("#texto").val(); 							
						window.opener.document.NominaExtra.submit();
					}if(t=='comision')
					{
						window.opener.document.getElementById('textoCo').value = $("#texto").val(); 							
						window.opener.document.comision.submit();
					}if(t=='construccion')
					{
						window.opener.document.getElementById('textoC').value = $("#texto").val(); 							
						window.opener.document.construccion.submit();
					}if(t=='planta')
					{
						window.opener.document.getElementById('textoP').value = $("#texto").val(); 							
						window.opener.document.planta.submit();
					}
				
				
					setTimeout(function(){
						window.close();
					},2000);
				}
			}
		}
	</script>
</body>
</html>