<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Reporte Movimientos</title>
		<link rel="stylesheet" href="../Arbol/atre/assets/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../Arbol/atre/assets/dist/tdemes/default/style.min.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script type="text/javascript" src="../../js/shortcut.js"></script>
		<script>
		<?php
		require("../configuraciones.php");
		conectar();
		 $c2=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='mostrar facturados' and tipo='clave'"));
		 $c3=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='ocultar factutados' and tipo='clave'"));
		?>
		shortcut.add("Ctrl+Alt+<?php echo $c3['descripcion'];?>",function() {
			//document.getElementById('facturado').value="no";
			alert("B");
			$('.no-facturado').show();
		});
		shortcut.add("Ctrl+Alt+<?php echo $c2['descripcion'];?>",function() {
			$('.no-facturado').hide();			
			alert("A");
		});
		</script>
		<style type="text/css" media="screen">
			table 
			{     
				font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
   		 		font-size: 12px;    margin: 45px;     width: 520px; text-align: left;    border-collapse: collapse; 
   		 	}
			th 
			{     
				font-size: 13px;     font-weight: normal;     padding: 8px;     background: #000;
    			border-top: 4px solid #FF0000;    border-bottom: 1px solid #fff; color: #fff;     			
    			text-align: center;
    		}
			td 
			{    
				padding: 8px; background: #656565;     border-bottom: 1px solid #fff;
    			color: #fff;    border-top: 1px solid transparent; 
			}
			tr:hover td 
			{ background: #FF5B5B; color: #000; }
		</style>
</head>
<body>
<?php
	if(isset($_GET['f1'])&&$_GET['f1']=='')
	{
		echo "<div align='center'><h2><strong>NO EXISTEN MOVIMIENTOS, POR FAVOR REGRESE A LA VENTANA ANTERIOR Y SELECCIONE UN RANGO DE FECHAS.</strong></h2><br><br>
			<script>
				setTimeout(function(){ window.close() }, 5000);
			</script>
		</div>";
	}
	else{
?>
	<div class="center-block" align='center'>
		<table>
			<caption>Reporte de Movimientos</caption>
			<tdead align="center">
				<tr align='center'>
					<th align="center">Folio</th>
					<th align="center">Concepto</th>
					<th align="center">Fecha</th>
					<th align="center">Forma de Pago</th>
					<th align="center">Cuenta</th>
					<th align="center">Cantidad</th>
					<th align="center">Cancelar</th>
				</tr>
			</tdead>
			<tbody>
				<?php				
					$pf=mysql_query("SELECT * FROM prestamos WHERE facturado=1 AND estatus='activo' AND fecha>='".$_GET['f1']." 00:00:00' AND fecha <= '".$_GET['f2']." 23:59:59' ORDER BY fecha");
					
					echo "<tr>"	;					
					while($f=mysql_fetch_array($pf))
					{
						$c=mysql_fetch_array(mysql_query("SELECT alias FROM Cuentas WHERE id=".$f['cuenta']));
						echo "<tr class='facturado'>
								<td align='center' ><strong>".$f['folio']."</strong></td>					
								<td align='center'><strong>".$f['nombre']."</strong></td>					
								<td align='center'><strong>".$f['fecha']."</strong></td>				
								<td align='center'><strong>".$f['formapago']."</strong></td>				
								<td align='center'><strong>".$c['alias']."</strong></td>					
								<td align='center'><strong>".$f['cantidad']."</strong></td>					
								<td align='center'><button class='btn btn-danger' name='".$f['folio']."' type='button' value='facturado' onclick='cancelarPrestamo(this.name,this.value)'>Cancelar</button></td>					
							</tr>
							  ";
					}				
					$pfn=mysql_query("SELECT * FROM prestamos WHERE facturado = 0 AND estatus='activo' AND fecha>='".$_GET['f1']." 00:00:00' AND fecha <= '".$_GET['f2']." 23:59:59' ORDER BY fecha");
					echo "<tr class='no-facturado' style='display:none;'>
							<td colspan='7' align='center'><strong>NO FACTURADO</strong></td>
						  </tr>						  
						 ";					
					while($fn=mysql_fetch_array($pfn))
					{
					    $c=mysql_fetch_array(mysql_query("SELECT alias FROM Cuentas WHERE id=".$fn['cuenta']));
						echo "<tr class='no-facturado' style='display:none;'>							
								<td align='center' ><strong>".$fn['folio']."</strong></td>					
								<td align='center'><strong>".$fn['nombre']."</strong></td>					
								<td align='center'><strong>".$fn['fecha']."</strong></td>				
								<td align='center'><strong>".$fn['formapago']."</strong></td>				
								<td align='center'><strong>".$c['alias']."</strong></td>	
								<td align='center'><strong>".$fn['cantidad']."</strong></td>		
								<td align='center'><button class='btn btn-danger' name='".$fn['folio']."' type='button' value='nf' onclick='cancelarPrestamo(this.name,this.value)'>Cancelar</button></td>					
							</tr>
							  ";
					}					
				?>		
			</tbody>
		</table>
		<div class="col-lg-12"><br></div>
		<div align="center">
			<table>
			<caption>Reporte de Movimientos Cancelados</caption>
			<tdead align="center">
				<tr align='center'>
					<th align="center">Folio</th>
					<th align="center">Concepto</th>
					<th align="center">Fecha</th>
					<th align="center">Forma de Pago</th>
					<th align="center">Cuenta</th>
					<th align="center">Cantidad</th>			
				</tr>
			</tdead>
			<tbody>
				<?php
					$pf=mysql_query("SELECT * FROM prestamos WHERE facturado=1 AND estatus='cancelado' AND fecha>='".$_GET['f1']." 00:00:00' AND fecha <= '".$_GET['f2']." 23:59:59' ORDER BY fecha");					
					while($f=mysql_fetch_array($pf))
					{
						$c=mysql_fetch_array(mysql_query("SELECT alias FROM Cuentas WHERE id=".$f['cuenta']));
						echo "<tr class='facturado'>
								<td align='center' ><strong>".$f['folio']."</strong></td>					
								<td align='center'><strong>".$f['nombre']."</strong></td>					
								<td align='center'><strong>".$f['fecha']."</strong></td>				
								<td align='center'><strong>".$f['formapago']."</strong></td>				
								<td align='center'><strong>".$c['alias']."</strong></td>					
								<td align='center'><strong>".$f['cantidad']."</strong></td>			
							  </tr>											
							  ";
					}					
					$pfn=mysql_query("SELECT * FROM prestamos WHERE facturado = 0 AND estatus='cancelado' AND fecha>='".$_GET['f1']." 00:00:00' AND fecha <= '".$_GET['f2']." 23:59:59' ORDER BY fecha");
					echo "<tr class='no-facturado' style='display:none;'>
							<td colspan='7' align='center'><strong>NO FACTURADO</strong></td>
						  </tr>						  
						 ";					
					while($fn=mysql_fetch_array($pfn))
					{
					    $c=mysql_fetch_array(mysql_query("SELECT alias FROM Cuentas WHERE id=".$fn['cuenta']));
						echo "<tr class='no-facturado' style='display:none;'>								
								<td align='center' ><strong>".$fn['folio']."</strong></td>					
								<td align='center'><strong>".$fn['nombre']."</strong></td>					
								<td align='center'><strong>".$fn['fecha']."</strong></td>				
								<td align='center'><strong>".$fn['formapago']."</strong></td>				
								<td align='center'><strong>".$c['alias']."</strong></td>	
								<td align='center'><strong>".$fn['cantidad']."</strong></td>			
							  </tr>							
							  ";
					}						
				?>		
			</tbody>
		</table>
		</div>
	</div>
<?php
// TERMINA ELSE SI EXISTEN FECHAS
	}
?>
	<script type="text/javascript">
		function cancelarPrestamo(id,f) // id o si es facturado o no
		{
			if(confirm("¿ESTA COMPLETAMENTE SEGURO DE CANCELAR ESTE MOVIMIENTO.?"))
			  {
			  	if(confirm("CONFIRME LA CANCELACION DE LA CUENTA CON FOLIO "+id))
			  	{
			  		if(f=='facturado'){f=1;}
			  		if(f=='nf'){f=0;}

			    	var datos = {
		              "tipo":'CancelarMovimiento',
		                "folio" : id,
		                "facturado" : f
		            };
		              $.ajax({
		                    type: "POST",
		                    url: "calculosAjax.php",
		                    data: datos,
		                    dataType: "html",
		                    beforeSend: function(){
		                          //console.log('Conexion correcta ajax '+tipo);
		                    },
		                    error: function(e){
		                          alert("error petición ajax"+id);
		                          //cargaExternos(tipo);
		                    },
		                    success: function(data){   		                                               
		                        alert(data);		                    
		                        opener.location.reload(); 
		                        location.reload();		                      
		                         //console.log('cargo '+tipo+' # = '+data);                  									
		                    }
		              });                  
				}
			  }
		}
	</script>
</body>
</html>