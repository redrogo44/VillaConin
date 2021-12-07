<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
 	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/muestra.js"></script>
</head>
<body>
	<div align="center">
	<form action="accionesNomina.php"  name="formulario" method="post" accept-charset="utf-8">
		<table>
			<caption>Confirmacion Nomina</caption>			
			<tbody>
				<tr>
					<td style="width: 180px;">Ingrese una Fecha de aplicaion para la Nomina</td>
					<td><input type="date" name="fecha"  id="fecha" placeholder="fecha" required="true"></td>
				</tr>
				<tr>
					<td>Seleccione un Banco</td>
					<td>
						<select name="banco" id="banco">
							<option value="Seleccione una Opcion">Seleccione una Opción</option>
							<option value="Efectivo">Efectivo</option>															
						</select>
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

		$("#banco").change(function () {
			if($("#banco").val()=='Seleccioe una Opcion')
			{
				alert("SELECCIONE UNA OPCION CORRECTA");
			}
			else if(this.value=='Efectivo')
			{
				$("#cuenta").empty();  
				$( "#cuenta" ).append("<option value='2'>EFECTIVO </option>");  				
			}
			else
			{
				carga_cuentas(this.value);

			}
		});
		function carga_bancos()
		{
			//alert(b);
			 var datos = {
	                "accion":"busca_bancos"				    
	            };
	              $.ajax({
	                    type: "POST",
	                    url: "../../Cuentas/acciones_cuentas.php",
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
			                "accion":"busca_cuentas",
			                "id": id

			            };
			              $.ajax({
			                    type: "POST",
			                    url: "../../Cuentas/acciones_cuentas.php",
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
						//formulario.submit();
						window.opener.document.getElementById('Banco').value = banco; 
						window.opener.document.getElementById('cuenta').value = cuenta; 
						window.opener.document.getElementById('fecha_nomina').value = fecha; 
						// SE HACE EL SUBMIT
						if(tipo=='planta'){
						window.opener.document.planta.submit();							
						}
						if(tipo=='construccion'){
						window.opener.document.construccion.submit();							
						}
						if(tipo=='extras'){
						window.opener.document.extras.submit();							
						}
						if(tipo=='eventos'){
						window.opener.document.eventos.submit();						
						}
						if(tipo=='comision'){
						window.opener.document.comisiones.submit();						
						}

						window.close();

					}

				}
	</script>
</body>
</html>