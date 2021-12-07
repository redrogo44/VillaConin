<?php
require 'funciones.php';
conectar();

$ids=explode(",",$_POST['ids']);
for($i=0;$i<count($ids);$i++){
	if($ids[$i]!=''){
		//echo "update categoria set tipo='GASTO ACTIVO' where id_categoria=".$ids[$i]."<br>";
		$r1=mysql_query("update categoria set tipo='ACTIVO' where id_categoria=".$ids[$i]);
	}
}
$ids2=explode(",",$_POST['ids2']);
for($i2=0;$i2<count($ids2);$i2++){
	if($ids2[$i2]!=''){
		//echo "update categoria set tipo='insumo' where id_categoria=".$ids2[$i2]."<br>";
		$r2=mysql_query("update categoria set tipo='INSUMO' where id_categoria=".$ids2[$i2]);
	}
}
$ids3=explode(",",$_POST['ids3']);
for($i3=0;$i3<count($ids3);$i3++){
	if($ids3[$i3]!=''){
		//echo "update categoria set tipo='GASTO OPERATIVO' where id_categoria=".$ids3[$i3]."<br>";
		$r3=mysql_query("update categoria set tipo='OPERATIVO' where id_categoria=".$ids3[$i3]);
	}
}
$ids4=explode(",",$_POST['ids4']);
for($i4=0;$i4<count($ids4);$i4++){
	if($ids4[$i4]!=''){
		//echo "update categoria set tipo='GASTO INVERSION' where id_categoria=".$ids4[$i4]."<br>";
		$r4=mysql_query("update categoria set tipo='INVERSION' where id_categoria=".$ids4[$i4]);
	}
}
$ids5=explode(",",$_POST['ids5']);
for($i5=0;$i5<count($ids5);$i5++){
	if($ids5[$i5]!=''){
		//echo "update categoria set tipo='GASTO INVERSION' where id_categoria=".$ids4[$i4]."<br>";
		$r4=mysql_query("update categoria set tipo='PERSONAL' where id_categoria=".$ids5[$i5]);
	}
}
?>