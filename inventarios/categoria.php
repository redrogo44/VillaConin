<?php
include_once 'categoria.class.php';
$categoria = new Categoria();
json_encode($categoria->buscarCategoria($_GET['term']));
?>