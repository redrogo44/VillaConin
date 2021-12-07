<?php
require "funciones2.php";
conectar();
    echo "update Actividades set actividad='".$_POST['actividad']."' where id=".$_POST['id'];
    //mysql_query("update Actividades set actividad='".$_POST['actividad']."' where id=".$_POST['id']); 
?>