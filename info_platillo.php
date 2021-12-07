<?php
require "funciones2.php";
conectar();
 
$q=mysql_fetch_array(mysql_query("select * from Menus where id_menu=".$_POST['id']));
echo $q['descripcion'];
?>