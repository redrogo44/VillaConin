<?php
include_once 'proveedor.class.php';
$proveedor = new Proveedor();
echo json_encode($proveedor->buscarProveedor($_GET['term']));
?>