<?php
require 'funciones2.php';
conectar();
$r=mysql_fetch_array(mysql_query("select * from presupuesto where id_precliente=".$_POST["id"]));
if(isset($r["servicios"])){
	if($r["servicios"]!=''){
		echo "OK";
	}else{
		echo "ERROR";
	}
}else{
	echo "ERROR";
}
?>