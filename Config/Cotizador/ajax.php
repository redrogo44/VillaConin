<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "./Conexion/conection.php";

	$tipo = $_POST['tipo'];
	//$tipo = "ServiciosBase";
	switch ($tipo) {
		case 'serviciosBase':
			 serviciosBase();
			break;
		default:
			# code...
			break;
	}


	function serviciosBase()
	{
		global $mysqli;
		$servicios = array();	
		$tmp = array();
		$SQL = 'SELECT Servicio, descripcion AS Descripcion,precio as Precio FROM `Servicios` LIMIT 10'; //tu tabla
		$resultado = $mysqli->query($SQL); 
		$rowcount=mysqli_num_rows($resultado);
		$con = 0;
		if ($rowcount > 0)
		{ 
		    while ($row = $resultado->fetch_array()) 
		    {
		    	$infoProducts[] = array(
		    		"Servicio" => utf8_encode($row['Servicio']),
		    		"Descripcion" => utf8_encode($row['Descripcion']),
		    		"Precio" => $row['Precio']
		    	);
		    }

			$contenido = array('infoProducts' => $infoProducts);
			$headers = array("Servicio","Descripcion", "Precio","Modificar");
			//echo "<PRE>".var_dump($infoProducts);
			$result = true;
		}
		$dataObj = array('sql' => $SQL, 'contenido' => $contenido, 'result' => $result,'Headers' => $headers);
		echo json_encode($dataObj);
	}
?>