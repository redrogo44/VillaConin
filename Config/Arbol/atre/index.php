<?php
require('../../configuraciones.php');
		conectar();
		validarsesion();
	$nivel=$_SESSION['niv'];
	menuconfiguracion2();				
	$_SESSION['usu']=$_GET['usuario'];
	date_default_timezone_set('America/Mexico_City');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
	<title>Costo Promedio</title>
	<meta name="viewport" content="width=device-width" />
	<meta name="robots" content="index,follow" />
	<link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="./assets/dist/themes/default/style.min.css" />
	<link rel="stylesheet" href="./assets/docs.css" />
	<link rel="stylesheet" href="../menu.css" />

	<link rel="icon" href="./assets/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon-precomposed" href="./assets/apple-touch-icon-precomposed.png" />
	<script>window.$q=[];window.$=window.jQuery=function(a){window.$q.push(a);};</script>
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
    .nav ul, li a
    {
      z-index: 1000;
    }
  </style>
</head>
<div id='preloader'>
<h3 id="texto"></h3>
<div id='loader'/></div>
</div>
<body>
<hr>
<div align="center">
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

<?php if ($_POST['submit']):
		echo "<div id='fechas' align='center'><h2><font><b>FECHAS DE ".$_POST['fecha1']." HASTA ".$_POST['fecha2']."</b></font></h2></div>";		

?>

	<div class="col-md-6">
		<div id="jstree1" class="demo">
			<ul>
				<li id="numeroEventos">Cantidad de eventos:  </li>					
				<li id="comensales">Comensales:  </li>	
				<li id="cobrado">Cobrado:</li>	
				<li id="eventosAdicionales">Eventos Adicionales</li>																		
				<li id="eventosRecaudacion">Eventos Recaudacion</li>
        		<li id="ventasVinos">Ventas Vinos:</li>
        		<li id="ventasT">Ventas:</li>
        		<li id="Cancelaciones">Cancelaciones:</li>
				<li id="totalCobrado">Total cobrado:<font color="blue"><strong id='totalC'></strong></font></li>							
				<li id="gastoInsumo">Gastos insumo:</li>
				<li id="gastoActivo">Gastos activo:</li>
				<li id="gastoOperativo">Gasto Operativo:</li>
				<li id="nomina">Nomina:</li>
				<li id="premioLealtad">Premio Lealtad:</li>
				<li id="totalGastado">Total Gastado: <font color="blue"> $ <strong id='totalG'></strong></font></li>
				<li id="costoPromedio">Costo promedio por Comensal: <font color="blue"> $ <strong id='costo'></strong></font></li>
				<li id="precioPromedio">Precio promedio por Comensal:<font color="blue"> $ <strong id='precio'></strong></font></li>
			</ul>
						
		</div>							
	</div>
	<div class="col-md-4">
		<div id="jstree3" class="demo">
			<ul>
				<li>Utilidad Bruta: <font color="blue"> $ <strong id='utilidad'></strong></font></li>					
				<li id="gastoPersonal">Gastos personales:</li>
				<li id="gastoInversion">Inversion:
        
        </li>
        <li id='vinos'>Inversion Vinos</li>      
			</ul>
		</div>
	</div>
<?php endif?>
<!-- 	JAVASCRIPT		-->
<script>    
    ////////////////////////////////////////////////////////////////////////7      
     $(function() {
            
        //$('body').css({'overflow':'visible'}); 
       // $("#texto").html('Cargando..');
                   $('#preloader').fadeOut('slow');       
         
    });
    var carga=0;  var cont=0;    
    setTimeout(function (){         
      
      //$.each( [ "insumos", "activos","operativos","nomina","premioLealtad" ], function( i, l ){
      $.each( ["numeroEventos","comensales","cobrado","eventosAdicionales","eventosRecaudacion","ventasVinos","ventasT" ,"Cancelaciones","gastoInsumo","gastoActivo","gastoOperativo","nomina","premioLealtad","vinos"], function( i, l ){      
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
                    url: "ajaxCalculos.php",
                    data: datos,
                    dataType: "html",
                    beforeSend: function(){
                          console.log('Conexion correcta ajax '+tipo);
                    },
                    error: function(e){
                          //alert("error petición ajax"+tipo);
                          cargaExternos(tipo);
                    },
                    success: function(data){   
                    carga++;  cont++;                                               
                         //alert(data);  
                         $( "#"+tipo ).append( data );  
                         //console.log('cargo '+tipo+' # = '+carga);                         
             //$('#jstree3').jstree();
						
            cargaDiv1();          

                    }
              });                            
            }     
             function cargaDiv1()
              {
                if(carga==14)
                {
                      $('#jstree1').jstree();
                     
                    
                       cargaExternos('gastoPersonal');
                       cargaExternos('gastoInversion');

                      //cargaPersonal();

                }
                if(carga==16)
                {
                    $('#jstree3').jstree();
                   $('#preloader').fadeOut('slow');
                     var totalGastado=0;
					NuevoTotalCobrado();
					////se cambio de lugar el calculo hasta que se retorne el total de lo cobrado en la funcion anterior
					//$("#totalC").html($("#tcobrado").html());
                         
                }
              }        
              function cargaPersonal() 
              {
                var f1='<?php echo $_POST["fecha1"]?>';
              var f2='<?php echo $_POST["fecha2"]?>';            
              var datos = {
                  "tipo":'gastoPersonal',
                    "fecha1" : f1,
                    "fecha2" : f2
                };
              $.ajax({
                    type: "POST",
                    url: "ajaxCalculos.php",
                    data: datos,
                    dataType: "html",
                    beforeSend: function(){
                          console.log('Conexion correcta a otro Ajax ');
                    },
                    error: function(e){
                          alert("error petición ajax gastoPersonal");
                          //cargaExternos(tipo);
                    },
                    success: function(data){   
                    carga++;                                                 
                         //alert(data);  
                         $( "#gastoPersonal" ).append( data );  
                         console.log('cargo  # = '+carga+ data);                         
             //$('#jstree3').jstree();
            //
            cargaDiv1();  
                   // $('#jstree3').jstree();


                    }
              });                            
              }

		    /*function CalcularCancelaciones(){
			///////////MUY IMPORTANTE LAS CANCELACIONES SE AGREGAN A TOTAL COBRADO
				  var f1='<?php echo $_POST["fecha1"]?>';
				  var f2='<?php echo $_POST["fecha2"]?>';            
				  var datos = {
					  "tipo":'Cancelaciones',
						"fecha1" : f1,
						"fecha2" : f2
                };
              $.ajax({
                    type: "POST",
                    url: "ajaxCalculos.php",
                    data: datos,
                    dataType: "html",
                    beforeSend: function(){
                          console.log('Conexion correcta a otro Ajax ');
                    },
                    error: function(e){
                          alert("error petición ajax gastoPersonal");
                          //cargaExternos(tipo);
                    },
                    success: function(data){   
						alert(data);
						$( "#Cancelaciones" ).append( data ); 
						NuevoTotalCobrado();
                    }
              });                             
              } */

			function NuevoTotalCobrado(){
			///////////MUY IMPORTANTE LAS CANCELACIONES SE AGREGAN A TOTAL COBRADO
				var datos = {
					"tipo":"totalCobrado" };
              $.ajax({
                    type: "POST",
                    url: "ajaxCalculos.php",
                    data: datos,
                    dataType: "html",
                    beforeSend: function(){
                          console.log('Conexion correcta a otro Ajax ');
                    },
                    error: function(e){
                          alert("error petición ajax gastoPersonal");
                          //cargaExternos(tipo);
                    },
                    success: function(data){   
                   		$("#totalC").html(data);
						data2=data.split(' ');
						var totalCobrado=parseFloat(data2[1]);
						 var insumo=($("#gInsumo").html()).split(' ');  
						 var insumo2=parseFloat(insumo[2]);
						 totalGastado=0;
						 totalGastado=totalGastado+insumo2;
						  var activo=($("#gActivo").html()).split(' ');  
						  var activo2=activo=parseFloat(activo[2]);
						  totalGastado=totalGastado+activo2;   
						  var operativo=($("#gOperativo").html()).split(' ');
						  var operativo2=parseFloat(operativo[2]);
						  totalGastado=totalGastado+operativo2;
						  var nomina=($("#gNomina").html()).split(' '); 
						  var nomina2=nomina=parseFloat(nomina[2]);
						  totalGastado=totalGastado+nomina2;
						  var premio=($("#premio").html()).split(' '); 
						  var premio2=premio=parseFloat(premio[2]); 
						  totalGastado=totalGastado+premio2;
						  $("#totalG").html(totalGastado);
						   var costoP=(totalGastado/(parseFloat($('#totalComensales').html())));
						   var cobrado=($("#tcobrado").html()).split(' ');
						   cobrado=cobrado[2];                      
						   var precioP=((parseFloat(cobrado))/parseInt($('#totalComensales').html()));                       
						   $('#costo').html(costoP.toFixed(2));
						   $('#precio').html(precioP.toFixed(2));
							var utilidad=totalCobrado-totalGastado; 
						   $('#utilidad').html(utilidad);  
					//alert(totalCobrado+" - "+totalGastado+" = "+utilidad); 
                    }
              });                             
              } 

    ///////////////////// /////////////////////////////////////////////////////
  
 if(carga == 0 && cont == 0)
    {
      $('#preloader').fadeOut('slow');             
    }
   
	</script>
	<script src="./assets/jquery-1.10.2.min.js"></script>
	<script src="./assets/jquery.address-1.6.js"></script>
	<script src="./assets/vakata.js"></script>
	<script src="./assets/dist/jstree.min.js"></script>
	<script src="./assets/docs.js"></script>
	<script>$.each($q,function(i,f){$(f)});$q=null;</script>
</body>
</html>