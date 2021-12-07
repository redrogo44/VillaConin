<?php
include_once 'Subcategoria.class.php';
$sub = new Sub();
echo json_encode($sub->buscarSub($_GET['term']));
?>