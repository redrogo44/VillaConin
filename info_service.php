<?php
require 'funciones2.php';
conectar();
$q=mysql_fetch_array(mysql_query("select * from Servicios where id=".$_POST['id']));
echo $q['descripcion'];
?>