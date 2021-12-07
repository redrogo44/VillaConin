<?php


require "funciones2.php";
conectar();
$t;
foreach($_POST as $r){
if($r!=""){
$t=$t.$r.",";
}else{
$t=$t."---,";
}
}
$datos=explode(",",$t);
$result = count($datos);

for($i=0;$i<$result-2;$i++){
	if($datos[$i]=="---" || $datos[$i+1]=="---" || $datos[$i+2]=="---" || $datos[$i+3]=="---" || $datos[$i+4]=="---"){
		$i=$i+4;
	}else{
		$query="INSERT INTO TInventarios(producto,descripcion,cantidad,precio,costo) values('".$datos[$i]."','".$datos[$i+1]."',".$datos[$i+2].",".$datos[$i+3].",".$datos[$i+4].");";
		$re=mysql_query($query);
		$i=$i+4;
	}
}

echo '<script>alert("Se ha agregado nuevos vinos");</script>';
echo '<meta http-equiv="Refresh" content="0;url=Inventario.php">';
 ?>