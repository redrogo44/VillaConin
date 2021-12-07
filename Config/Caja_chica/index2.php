<?php
	$ruta=$_SERVER['DOCUMENT_ROOT']."/Config/Arbol/";
	require('../configuraciones.php');
	conectar();
	validarsesion();
	$nivel=$_SESSION['niv'];
	//menuconfiguracion2();				
	$_SESSION['usu']=$_GET['usuario'];
	date_default_timezone_set('America/Mexico_City');
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'menu.php';?>
	<meta charset="UTF-8">
	<title>Caja Chica</title>
	<meta name="robots" content="index,follow" />
	<?php
	?>
	<link rel="stylesheet" href="../Arbol/atre/assets/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../Arbol/atre/assets/dist/themes/default/style.min.css" />
	<link rel="stylesheet" href="../Arbol/atre/assets/docs.css" />
	<link rel="stylesheet" href="../Arbol/menu.css" />
	<!--<link rel="icon" href="../Arbol/atre/assets/favicon.ico" type="image/x-icon" />-->
	<link rel="apple-touch-icon-precomposed" href="../Arbol/atre/assets/apple-touch-icon-precomposed.png" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/shortcut.js"></script>
	<script>window.$q=[];window.$=window.jQuery=function(a){window.$q.push(a);};
	<?php
		 $c2=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='mostrar facturados' and tipo='clave'"));
		 $c3=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='ocultar factutados' and tipo='clave'"));
		?>
		shortcut.add("Ctrl+Alt+<?php echo $c3['descripcion'];?>",function() {
			$('.nofac').show("swing");
			$('.fac').hide("linear");
		});
		shortcut.add("Ctrl+Alt+<?php echo $c2['descripcion'];?>",function() {
			$('.fac').show("swing");
			$('.nofac').hide("linear");
		});
	</script>
   <style type='text/css'>
    body {
    overflow: hidden;
    }
    /* preloader */
    #preloader {
     position: fixed; top:0; left:0; right:0; bottom:0;
     background: #000;
     z-index: 100;
    }
     /* El gif */ 
    #loader {
     width: 500px;
    height: 500px;
    position: fixed;
    left:30%;
    top:20%;
    background: url('carga.gif') no-repeat center 0;
    margin:-50px 0 0 -50px;
     }
    #texto{
      color: #fff;
    }
    #header ul, li
    {
    	z-index: 1;
    }
	   .nofac{
		   display: none;
	   }
  </style>
</head>
<body>
<br><br>
<div class="col-lg-12 dd">
	<div class="col-lg-12 dd" >
		<center>
			<a id='Cuentas'  class="btn btn-primary">Cuentas</a>
				<a id='Nuevo_traspaso'  class="btn btn-primary">Traspaso</a>
			<a id='Nuevo_movimiento'  class="btn btn-success">Movimientos</a>
			<a id='Reporte_movimiento'  class="btn btn-success">Reporte Movimientos</a>
		</center>
	</div>
</div>

<!-- 	RANGO DE FECHAS	-->
<div align="center" class="col-lg-12" style="width:100%;">
<h4>Buscar entre Fechas</h4>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label><font color="green"><b>De</b></font></label>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="date" name="fecha1" />&nbsp;&nbsp;&nbsp;&nbsp;
			<label><font color="red"><b>Hasta</b></font></label>&nbsp;&nbsp;&nbsp;&nbsp;
			<?php
			echo "<input type='date' name='fecha2' max='".date('Y-m-d')."'/>&nbsp;&nbsp;&nbsp;&nbsp;";
			//echo date('Y-m-d');
			?>
		<input type="submit" name='submit'>
		</form>
	</div>
<br>
<?php if ($_POST['submit']):
		echo "<div id='fechas' align='center'><h2><font><b>FECHAS DE ".$_POST['fecha1']." HASTA ".$_POST['fecha2']."</b></font></h2></div>";		

?>

	<div class="col-md-6">
		<div id="jstree1" class="demo">
			<ul>
				<li id="ingresos">Ingresos 
					<ul>
						<li id="abonos">Abonos</li>
						<li id="ventas">Ventas</li>
						<li id="recaudacion">Fiestas de Recaudación</li>
						<li id="cancelaciones-ingresos">Cancelaciones
							<ul>
								<li id="compras-facturadas">Compras  A </li>
								<li class='nofac' style='display:none;' id="compras-no-facturadas">Compras  B </li>
								<li id="contrato-ingresos-fac">Contratos A</li>						
								<li class='nofac' style='display:none;' id="contrato-ingresos">Contratos B</li>					
							</ul>
						</li>
    			        <li id="otrosingresos">Otros Ingresos</li>            
					</ul>					
				</li>	
				<li id="egresos"> Egresos
					<ul>
						<li id="compras">Compras  A </li>
						<li class='nofac' style='display:none;' id="compras-no">Compras  B </li>
						<li id="devoluciones">Devoluciones</li>
						<li id="cancelaciones-egresos">Cancelaciones
							<ul>
								<li id="abonos-egresos"> Abonos</li>
								<!--<li id="cargos-egresos"> Cargos</li>-->
								<li id="ventas-egresos"> Ventas</li>
								<li id="contrato-egresos">Contratos A</li>
								<li class='nofac' style='display:none;' id="contrato-egresos-fac">Contratos B</li>
							</ul>
						</li>
						<li id="nominas"> Nomina</li>
						<li id="otros-egresos">Otros Egresos</li>
					</ul>
				</li>	

			</ul>
						
		</div>							
	</div>
	<div class="col-md-4">
		<div id="jstree3" class="demo">
			<ul>
				<li id="traspasos">Traspasos</li>							
				<li class='fac' id="saldos2">Saldos</li> 
				<li class='nofac' id="saldos">Saldos</li>
			</ul>
			<br><br>
		</div>
	</div>
<div class="col-lg-12"> <br></div>
<?php endif?>
<!-- 	SCRIPT	-->
<script type="text/javascript">

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
    var carga=0;  var cont=0; var val_clic;   
    setTimeout(function (){         
      
      //$.each( [ "insumos", "activos","operativos","nomina","premioLealtad" ], function( i, l ){
      $.each( ["abonos","ventas","recaudacion","compras-facturadas","compras-no-facturadas","contrato-ingresos-fac","contrato-ingresos","otrosingresos","compras","compras-no","devoluciones","abonos-egresos","cargos-egresos","ventas-egresos","contrato-egresos","contrato-egresos-fac","traspasos","saldos","saldos2","nominas","otros-egresos"], function( i, l ){      
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
                          //console.log('Conexion correcta ajax '+tipo);
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

	<script src="../Arbol/atre/assets/jquery-1.10.2.min.js"></script>
	<script src="../Arbol/atre/assets/jquery.address-1.6.js"></script>
	<script src="../Arbol/atre/assets/vakata.js"></script>
	<script src="../Arbol/atre/assets/dist/jstree.min.js"></script>
	<script src="../Arbol/atre/assets/docs.js"></script>
	<script>$.each($q,function(i,f){$(f)});$q=null;</script>
	<script>
		$( "#Cuentas" ).click(function() {
		 	window.open('../Cuentas/Cuentas.php',"Cuentas",'height=400,width=600,left=300,top=150');
		});
		$( "#Nuevo_traspaso" ).click(function() {
		 	window.open('../Cuentas/',"Cuentas",'height=500,width=550,left=300,top=100');
		});
		$( "#Nuevo_movimiento" ).click(function() {
		 	window.open('Movimientos.php',"Cuentas",'height=400,width=250,left=300,top=150');
		});
		$( "#Reporte_movimiento" ).click(function() {
			var f1='<?php echo $_POST["fecha1"]?>';
            var f2='<?php echo $_POST["fecha2"]?>';      
		 	window.open('ReporteMovimientos.php?f1='+f1+'&f2='+f2,"Cuentas",'height=400,width=750,left=300,top=150');
		});
	</script>
</body>
</html>