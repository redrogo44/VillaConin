<?php 
	session_start();
	include_once "../php_conexion.php";
	include_once "../funciones.php";
	if($_SESSION['tipo_user']=='admin' or $_SESSION['tipo_user']=='s' or $_SESSION['tipo_user']=='d'){
		
	}else{
		header("Location: ../error.php");
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title></title>
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
	<div align="center"><div style="width:98%">
        <table class="table table-bordered">
        	<tr class="well">
        		<td></td>
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
