<?php
include_once 'Unidad.class.php';
$unidad = new Unidad();
echo json_encode($unidad->buscarUnidad($_GET['term']));
?>