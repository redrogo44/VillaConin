<?php
require("funciones2.php");
conectar();

mysql_query("UPDATE `preregistro` SET `comentario`='".$_POST['comen']."' WHERE `id`=".$_POST['id']);
?>