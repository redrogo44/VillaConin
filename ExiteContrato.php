<?php
require("funciones2.php");
conectar();
$B=mysql_query("SELECT * FROM contrato WHERE Numero='".$_POST['contrato']."'");
echo mysql_num_rows($B);

?>