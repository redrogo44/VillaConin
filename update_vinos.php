<?php
require "funciones2.php";
conectar();
$index=1;
foreach($_POST as $r){

if($r=="" || $r=="Actualizar Existencias"){
$index++;
}else{
$query="UPDATE TInventarios set cantidad=".$r." where id=".$index;
$ejecuta=mysql_query($query);
$index++;
}
}
echo '<script>alert("Actualizacion conrrecta");</script>';
echo '<meta http-equiv="Refresh" content="0;url=Inventario.php">';

//print_r($_POST);
?>