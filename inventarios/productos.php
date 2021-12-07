<?php
include_once 'productos.class.php';
$producto = new Producto();
echo json_encode($producto->buscarProducto($_GET['term']));
?>