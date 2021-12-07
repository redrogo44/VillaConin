<?php
include_once 'producto.class.php';
$producto = new Producto2();
echo json_encode($producto->buscarProducto($_GET['term']));
?>