<?php
	require('../configuraciones.php');
		conectar();
		validarsesion();
	$nivel=$_SESSION['niv'];
	menuconfiguracion2();				
date_default_timezone_set('America/Mexico_City');		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Costo Promedio</title>
	<link rel="stylesheet" href="menu.css" />
	
</head>

<body>

<div id="contenedor">

    <ul id="menu_arbol">
        <li id="insumos"><a href="#" title="Ver las Cervezas" id="toggle_c">Gastos Insumos</a>
        </li>  
    </ul>
    
</div>

</body>
</html>
