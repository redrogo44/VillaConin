
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php">
<?php
require 'funciones2.php';
conectar();
print_r($_POST);
 
$q=mysql_query("UPDATE `Eventos_Adicionales` SET `c_adultos`=".$_POST['c_adultos'].",`c_jovenes`=".$_POST['c_jovenes'].",`c_ninos`=".$_POST['c_ninos']." WHERE id=".$_POST['id']);			

?>