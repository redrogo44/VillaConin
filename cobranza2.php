<?php
require 'funciones2.php';
conectar();
//validarsesion();
$contratos_cobranza;
//date_default_timezone_set('America/Mexico_City');
$nivel=$_SESSION['niv'];
if($nivel==0){
	menunivel0();				
}else if($nivel==1){
	menunivel1();				
}else if($nivel==3){
	menunivel3();
}else{
	exit();
}
?>
<html>
    <head>
    </head>
    <body>
     <p>HOLA MUNDO</p>
    </body>
</html>