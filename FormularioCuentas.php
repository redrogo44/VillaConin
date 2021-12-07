<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>	
	<link rel="stylesheet" type="text/css" href="Config/Nominas/NominaE/css/style.css" />
 	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="Config/Nominas/NominaE/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="Config/Nominas/NominaE/js/script.js"></script>
	<script type="text/javascript" src="Config/Nominas/NominaE/js/muestra.js"></script>
</head>
<body>
	<div align="center">
	<form action="accionesNomina.php"  name="formulario" method="post" accept-charset="utf-8">
		<table>
			<caption>INDIQUE LA CUENTA EMISORA DE ESTA ACCIÓN</caption>			
			<tbody>
				<tr>
					<td style="width: 180px;">Ingrese una Fecha de aplicaion para la Nomina</td>
					<td><input type="date" name="fecha"  id="fecha" placeholder="fecha" required="true"></td>
					<td><input type="hidden" name="banco"  id="banco" value="Seleccione una Opcion"></td>
				</tr>
				<tr>
					<td>Forma de pago</td>
					<td>
						<select name='formapago' id='formadepago'  required>
							<option value=''>Seleccione una Opcion</option>
							<option value='Pago con Cheque'>Pago con Cheque</option>
							<option value='Pago en Efectivo'>Pago en Efectivo</option>
							<option value='Pago con Tarjeta'>Pago con Tarjeta</option>
							<option value='Deposito'>Deposito</option>
							<option value='Transferencia'>Transferencia</option>
						</select>
						<!-- <select name="banco" id="banco">
							<option value="Seleccione una Opcion">Seleccione una Opción</option>
							<option value="Efectivo">Efectivo</option>															
						</select> -->
					</td>			
				</tr>
				<tr>					
					<td>Seleccione una Cuenta</td>
					<td>
						<select name="cuenta" id="cuenta">

						</select>
					</td>					
				</tr>
				<tr >
					<td align="center" colspan="2"><button type="button" onclick="valida();">Enviar</button></td>
				</tr>
			</tbody>
		</table>
	</form>
		
	</div>
	<script type="text/javascript">
	var tipo="<?php echo $_GET['tipo']?>";

	carga_bancos();
		$("#formadepago").change(function () {
			if ($("#formadepago").val() !== 'Pago en Efectivo') {
				carga_cuentas()
				$("#cuenta").show();
			} else {
				$("#cuenta").hide();
				getBanco(2);
			}
		});

		$("#cuenta").change(function () {
			alert("Cuenta" + $("#cuenta").val());
			getBanco($("#cuenta").val());
		});

		// $("#banco").change(function () {
		// 	if($("#banco").val()=='Seleccioe una Opcion')
		// 	{
		// 		alert("SELECCIONE UNA OPCION CORRECTA");
		// 	}
		// 	else if(this.value=='Efectivo')
		// 	{
		// 		$("#cuenta").empty();  
		// 		$( "#cuenta" ).append("<option value='2'>EFECTIVO </option>");  			
		// 	}
		// 	else
		// 	{
		// 		carga_cuentas(this.value);

		// 	}
		// });
		function carga_bancos()
		{
			//alert(b);
			 var datos = {
	                "accion":"busca_bancos"				    
	            };
	              $.ajax({
	                    type: "POST",
	                    url: "//villaconin.mx/Config/Cuentas/acciones_cuentas.php",
	                    data: datos,
	                    dataType: "html",
	                    beforeSend: function(){
	                          console.log('Conexion correcta ajax ');
	                    },
	                    error: function(e){
	                          alert("error petición ajax");
	                          //cargaExternos(tipo);
	                    },
	                    success: function(data){   
	                           $("#banco").empty();                                       
	                         //alert(data);  
	                         $( "#banco" ).append( data );  
	                         //console.log('cargo '+b+' # = '+h);
	                    }
	              });                
		}
		function carga_cuentas(id)
				{
					//alert(b);
					 var datos = {
			                "accion":"todas_cuentas",
			                "id": id

			            };
			              $.ajax({
			                    type: "POST",
			                    url: "Config/Cuentas/acciones_cuentas.php",
			                    data: datos,
			                    dataType: "html",
			                    beforeSend: function(){
			                          console.log('Conexion correcta ajax ');
			                    },
			                    error: function(e){
			                          alert("error petición ajax");
			                          //cargaExternos(tipo);
			                    },
			                    success: function(data){   
			                           $("#cuenta").empty();                                       
			                         //alert(data);  
			                         $( "#cuenta" ).append( data );
			                         //console.log('cargo '+b+' # = '+h);
			                    }
			              });                
				}
		
		function getBanco (cuenta) {
			var datos = {
				"accion": "getBancoForAccount",
				"id": cuenta
			};
			
			$.post("Config/Cuentas/acciones_cuentas.php", {
				accion: "getBancoForAccount",
				id: cuenta
			},
			function(data, status){
				$("#banco").empty();                                       
				$( "#banco" ).val( data );
			});
		}
				function valida()
				{
					var fecha=$("#fecha").val();
					var banco=$("#banco").val();
					var cuenta=$("#cuenta").val();
					//alert(fecha);
					if ($("#fecha").val().length < 1) 
					{
					    alert("TODOS LOS CAMPOS SON OBLIGATORIOS, SELECCIONE UNA FECHA CORRECTA");					   
					}
					else if(banco=="Seleccione una Opcion")
					{
						alert("SELECCIONE UN BANCO, VERIFIQUE SUS DATOS");
					}
					else if(cuenta=="Seleccione una Opcion")
					{
						alert("SELECCIONE UNA CUENTA CORRECTA");
					}
					
					else
					{
						if ($("#formadepago").val() !== 'Pago en Efectivo') {
							window.opener.document.getElementById('banco').value = 'Efectivo'; 
							window.opener.document.getElementById('cuenta').value = 2; 
						} else {
							window.opener.document.getElementById('banco').value = banco; 
							window.opener.document.getElementById('cuenta').value = cuenta; 
					//	window.opener.document.getElementById('fecha_nomina').value = fecha; 		
						}
						window.opener.$("#devolucion").submit();			
						window.close();

					}

				}
	</script>
</body>
</html>