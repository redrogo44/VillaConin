<html>
	<head>
	<title>Movimiento</title>
		<link rel="stylesheet" href="../Arbol/atre/assets/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../Arbol/atre/assets/dist/themes/default/style.min.css" />
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
			document.getElementById('facturado').value="no";
			alert("B");
		});
		shortcut.add("Ctrl+Alt+<?php echo $c2['descripcion'];?>",function() {
			document.getElementById('facturado').value="si";
			alert("A");
		});
		</script>
	</head>
	
	<body>
		<form action="calculosAjax.php" id="movimiento" method="POST">
		<div class="col-lg-4" align="center">
		<h4><strong>Nuevo Movimiento</strong></h4>
			<label><strong>Nombre:</strong></label>
			<input type="text" name="nombre" value="" id="name" placeholder="Nombre del Movimiento">					
			<label><strong>Cantidad:</strong></label>
			<input type="number" name="cantidad" value=""  id ="cant" placeholder="Cantidad del Movimiento">			
			<label><strong>Forma de Pago:</strong></label>			
			<select name="formaPago" id="tipoPago">
				<option value="Seleccione una Opción">Seleccione una Opcion</option>
				<option value="Pago en Efectivo">Efectivo</option>
				<option value='Pago con Cheque'>Pago con Cheque</option>
				<option value='Pago con Tarjeta'>Pago con Tarjeta</option>
				<option value='Deposito'>Deposito</option>
				<option value='Transferencia'>Transferencia</option>	
			</select>
			<div id="cu" hidden="true">						
				<label><strong>Cuenta</strong></label>		<br>
				<select name="cuenta" id="cuentas">	
				</select>
			</div>
			<input type="hidden" id="facturado" name="facturado" value="si">
			<input type="hidden" name="tipo" value="Nuevo_Movimiento"><br>		
			<button type="button"  class="btn btn-warning" onclick='validar();'> Generar Movimiento</button>		
		</div>
	</form>
		<script>
		 $(function() {
            
        //$('body').css({'overflow':'visible'}); 
       // $("#texto").html('Cargando..');
       $('#preloader').fadeOut('slow');       
        $("#tipoPago").change(function(){
            //alert($('#tipoPago').val());    
            if($('#tipoPago').val()!='Seleccione una Opción')
            {
            	$("#cu").show();
            }
            $("#cuentas").empty();
            carga_cuentas($('#tipoPago').val());

        });	
         
    });
	 function validar()
	 {
	 	var n=$("#name").val();
	 	var c=$("#cant").val();
	 	var p=$("#tipoPago").val();
	 	var cu=$("#cuenta").val();
	 	var cont=0;
	 	if(n=='')
	 	{ alert("ESCRIBA UN NOMBRE PARA EL MOVIMIENTO");  cont++;}
	 	if(c=='')
	 	{ alert("ESCRIBA UNA CANTIDAD");   cont++;}
	 	if(p=='Seleccione una Opción')
	 	{ alert("SELECCIONE UN METODO DE PAGO CORRECTO");   cont++;}
	 	if(cu=='')
	 	{ alert("SELECCIONE UNA CUENTA");   cont++;}
	 	
	 	if(cont==0)
	 	{	 	
	 		 $( "#movimiento" ).submit();
	 	}
	 }
	 function carga_cuentas(id)
	 {
	 	var datos = {
              "id":id,
              "accion":"todas_cuentas"
            };
              $.ajax({
                    type: "POST",
                    url: "../Cuentas/acciones_cuentas.php",
                    data: datos,
                    dataType: "html",
                    beforeSend: function(){
                          console.log('Conexion correcta ajax '+id);
                    },
                    error: function(e){
                          alert("error petición ajax"+id);
                          //cargaExternos(tipo);
                    },
                    success: function(data){   
                    carga++;  cont++;                                               
                        //alert(data);  
                         $("#cuentas").append( data );  
                         console.log('cargo '+id);                         
                 

                    }
              });         
	 }
    var carga=0;  var cont=0;    
    setTimeout(function (){         
      
      //$.each( [ "insumos", "activos","operativos","nomina","premioLealtad" ], function( i, l ){
      $.each( ["abonos","ventas","recaudacion","compras-facturadas","compras-no-facturadas","contrato-ingresos","contrato-ingresos-fac","otrosingresos","compras","compras-no","devoluciones","abonos-egresos","cargos-egresos","ventas-egresos","contrato-egresos","contrato-egresos-fac","traspasos","saldos","nominas","otros-egresos"], function( i, l ){      
            //alert( "Index #" + i + ": " + l );
            cargaExternos(l);            
      });       
        //cargaPersonal() ;
    },1000);
  
            function cargaExternos(tipo)
            {                         
            var f1='<?php echo $_POST["fecha1"]?>';
            var f2='<?php echo $_POST["fecha2"]?>';            
            var datos = {
              "tipo":tipo,
                "fecha1" : f1,
                "fecha2" : f2
            };
              $.ajax({
                    type: "POST",
                    url: "calculosAjax.php",
                    data: datos,
                    dataType: "html",
                    beforeSend: function(){
                          console.log('Conexion correcta ajax '+tipo);
                    },
                    error: function(e){
                          alert("error petición ajax"+tipo);
                          //cargaExternos(tipo);
                    },
                    success: function(data){   
                    carga++;  cont++;                                               
                        // alert(data);  
                         $( "#"+tipo ).append( data );  
                         console.log('cargo '+tipo+' # = '+data);                         
             //$('#jstree3').jstree();
            			cargaDiv1();          

                    }
              });                            
            }     
             function cargaDiv1()
              {
                if(carga==17)
                {
                     setTimeout(function(){
                     $('#jstree1').jstree();                     	
                     }, 2000);
                }
                if(carga==20)
                { 
                     
 					setTimeout(function(){
                    $('#jstree3').jstree();                                   
                     }, 2000);
                   $('#preloader').fadeOut('slow');       
                }
              }                     
    ///////////////////// /////////////////////////////////////////////////////    
    
  ////////////////////////////////////////////////////////////////////////////777
 if(carga == 0 && cont == 0)
    {
      $('#preloader').fadeOut('slow');             
    }

		</script>
	</body>
</html>