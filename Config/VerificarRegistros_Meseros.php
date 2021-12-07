<?php
require('configuraciones.php');
conectar();
$M=mysql_query("SELECT * FROM Meseros WHERE tipo='".$_POST['categoria']."'");
echo mysql_num_rows($M);
?>