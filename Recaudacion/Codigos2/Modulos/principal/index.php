<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Principal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
		body {
			padding-top: 60px;
			padding-bottom: 40px;
		}
		footer {
			left: 0;
			position: fixed;
			bottom: 0;
			width: 100%;
			height: 120px;
		}
    </style>
    <link href="../../css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../../ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="../../ico/favicon.png">
    <!--<link href="../../js_tabla/jquery.dataTables.css" rel="stylesheet">-->
  </head>
  
  <body>

    <?php include_once "../menu.php"; ?>
	<div align="center"><div style="width:60%">
        <table class="table table-bordered">
        	<tr class="well">
            	<td><h4 align="center">Opciones de Codigo de Barras</h4></td>
            </tr>
        	<tr>
        		<td>
                	<center>
                        <form name="form" action="generador.php" method="post">
                        	<strong>Seleccionar Tipo de Codigo de Barras</strong><br>
                            <select name="tipo" style="width:286px">
                                <option value="code39">CODE 39</option>
                                <option value="code11">CODE 11</option>
                                <option value="code39">CODE 39</option>
                                <option value="ean8">EAN 8</option>
                                <option value="code93">CODE 93</option>
                                <option value="code128">CODE 128</option>
                                <option value="codabar">CODABAR</option>
                            </select><br>
                            <div class="row-fluid">
	                            <div class="span6">
                            		<strong>Ancho</strong><br>
		                            <input type="number" name="ancho" value="350" autocomplete="off" required><br>    
                                    <strong>Posicion X</strong><br>
                                    <input type="number" name="x" value="150" autocomplete="off" required><br>  
                                     <strong>Altura del Resultado</strong><br>
                                    <input type="text" name="height" value="50" autocomplete="off" required><br>
                                    <strong>Rotacion</strong><br>
                                    <input type="number" name="angle" value="0" autocomplete="off"><br>  
                                </div>
    	                        <div class="span6">
                            		<strong>Alto</strong><br>
		                            <input type="number" name="alto" value="100" autocomplete="off" required><br>    
                                    <strong>Posicion Y</strong><br>
                                    <input type="number" name="y" value="50" autocomplete="off" required><br>  
                                    <strong>Codigo de Barras</strong><br>
                                    <input type="text" name="codigo" maxlength="5" value="12345" autocomplete="off" required><br>
                                    <strong>Generar Imagen o Visualizar</strong><br>
                                    <select name="generar">
                                        <option value="i">Generar Imagen</option>
                                        <option value="v">Visualizar Imagen</option>
                                    </select>
                                </div>
                            </div><br>
                           	<center><button type="submit" class="btn btn-primary btn-large"><strong>Generar BarCode</strong></button></center>
                            
                        </form>
                    </center>
                </td>
        	</tr>
        </table>
    </div></div>
    <?php include_once "../pie.php"; ?>
    <!-- Le javascript ../../js/jquery.js
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap-transition.js"></script>
    <script src="../../js/bootstrap-alert.js"></script>
    <script src="../../js/bootstrap-modal.js"></script>
    <script src="../../js/bootstrap-dropdown.js"></script>
    <script src="../../js/bootstrap-scrollspy.js"></script>
    <script src="../../js/bootstrap-tab.js"></script>
    <script src="../../js/bootstrap-tooltip.js"></script>
    <script src="../../js/bootstrap-popover.js"></script>
    <script src="../../js/bootstrap-button.js"></script>
    <script src="../../js/bootstrap-collapse.js"></script>
    <script src="../../js/bootstrap-carousel.js"></script>
    <script src="../../js/bootstrap-typeahead.js"></script>
    
     <!--PAGINADOR
    <script src="../../js_tabla/jquery.dataTables.js"></script>
    <script>
		$(document).ready(function(){
			$('#myTable').dataTable();
		});
	</script>-->
	
    <!-- ordenar tablas
	<script>
      new Tablesort(document.getElementById('table-id'));
    </script>-->
    
    <!-- eventos combos
    <script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/eventos.js"></script>-->
    
  </body>
</html>
