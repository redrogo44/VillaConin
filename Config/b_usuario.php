<?php
require 'configuraciones.php';
conectar();
$d="delete from usuarios where id=".$_GET['id'];
$dd=mysql_query($d);
header('Location: Usuarios.php');
?>