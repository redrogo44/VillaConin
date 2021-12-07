<?php
require 'configuraciones.php';
conectar();
	mysql_query("UPDATE Meseros SET comentarios='".$_POST['comentario']."' WHERE id=".$_POST['numero']);
?>