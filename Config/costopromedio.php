<?php
$datos=explode(',',$_POST['costo']);
$q="select costo from TManteleria where Categoria='".$datos[1]."'"." and tipo='".$datos[2]."' and descripcion='".$datos[3]."'";
$r=mysql_query($q);
$m=mysql_fetch_array($r);
$c=($datos[0]+$m['costo'])/2;
echo "$ ".round($c,2);
?>