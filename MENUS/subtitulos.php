<?php
//print_r($_POST);
require('../funciones2.php');
conectar();

$m=mysql_fetch_array(mysql_query("SELECT * FROM Menus WHERE id_menu=".$_POST['menu']));
//echo $_POST["ingredientes"];
$platillo=explode(",",$_POST["ingredientes"]);
$cantidad=explode(",",$m["cantidades"]);
$comentario=explode("|",$m["comentarios"]);
/////
$nuevo_i=$_POST["nombre"];
$nuevo_c="";
$nuevo_com="";
$ingredientes=explode(",",$m["ingredientes"]);

////agregamoa los ingredintes al platillo
for($y=0;$y<count($platillo);$y++){
	$nuevo_i=$nuevo_i.",".$ingredientes[$platillo[$y]];
	$nuevo_c=$nuevo_c.",".$cantidad[$platillo[$y]];
	$nuevo_com=$nuevo_com."|".$comentario[$platillo[$y]];
}

///agregamos los ingredientes restantes
for($x=0;$x<count($ingredientes);$x++){
	$agregar=true;
	for($y=0;$y<count($platillo);$y++){
		if($x==$platillo[$y]){
			$agregar=false;
		}
	} 
	
	if($agregar && $ingredientes[$x]!=''){
		$nuevo_i=$nuevo_i.",".$ingredientes[$x];
		$nuevo_c=$nuevo_c.",".$cantidad[$x];
		$nuevo_com=$nuevo_com."|".$comentario[$x];
	}
}
 
/*print_r($nuevo_i);
echo "______________";
print_r($nuevo_c);*/

mysql_query("update Menus set ingredientes='".$nuevo_i."',cantidades='".$nuevo_c."',comentarios='".$nuevo_com."' where id_menu=".$_POST["menu"]);
?>