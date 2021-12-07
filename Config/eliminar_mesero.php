<?PHP
require 'configuraciones.php';
conectar();
 mysql_query("DELETE FROM `Meseros` WHERE id=".$_POST['q']);
 ?>