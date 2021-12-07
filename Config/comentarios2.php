<?php
require 'configuraciones.php';
conectar();
$Com=mysql_query("SELECT comentarios2 FROM Meseros WHERE id=".$_POST['numero']);
$comentari=mysql_fetch_array($Com);
$comentar=$comentari['comentarios2'].",".$_POST['comentario'];
	mysql_query("UPDATE Meseros SET comentarios2='".$comentar."' WHERE id=".$_POST['numero']);
?>