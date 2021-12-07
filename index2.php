<?php
require 'funciones2.php';
conectar();
if($_POST['t']==1){
    mysql_query("update Configuraciones set valor='".$_POST['p']."' where nombre='password' and tipo='servicios'");
}else if($_POST['t']==2){
    mysql_query("update Configuraciones set descripcion='".$_POST['p']."' where nombre='mostrar facturados' and tipo='clave'");
}else if($_POST['t']==3){
   
    mysql_query("update Configuraciones set descripcion='".$_POST['p']."' where nombre='ocultar factutados' and tipo='clave'");
}
?>