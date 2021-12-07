<?php
require 'funciones2.php';
conectar();
$q="select sum(si) as t from contrato where Numero like 'X040715L-%'";
$r=mysql_query($q);
$m=mysql_fetch_array($r);
$up="update contrato set si=".$m['t']." where Numero='X040715L'";
$rup=mysql_query($up);
?>