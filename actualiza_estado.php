<?php
require 'funciones2.php';
conectar();
if($_POST['opcion']=="activar"){
	mysql_query("update contrato set urgente=1 where Numero='".$_POST['contrato']."'");
}else if($_POST['opcion']=="desactivar"){
	mysql_query("update contrato set urgente=0 where Numero='".$_POST['contrato']."'");
}
?>