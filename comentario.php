<?php
require 'funciones2.php';
conectar();
$insertar=mysql_query('update contrato set comentario="'.$_POST['comentario'].'" where Numero="'.$_POST['numero'].'"');
?>