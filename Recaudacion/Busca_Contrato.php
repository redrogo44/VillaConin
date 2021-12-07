<?php
require('../funciones2.php');
conectar();

$contrato=$_POST['contrato'];

$se=mysql_query("SELECT * FROM contrato WHERE Numero='".$contrato."'");
$con=mysql_fetch_array($se);
echo $con['nombre'].",".$con['vendedor'];
?>