<html> 
<head> 
<script> 
function calcular() { 
    ne=eval(document.getElementById('neto').value); 
    iv=eval(document.getElementById('iva').value); 
    tiv = ne * iv /100; 
    tot = ne + tiv; 
    document.getElementById('totiva').value=tiv; 
    document.getElementById('total').value=tot; 
} 
</script> 
</head> 

<body> 
<input type="text" id="neto" value="0" onkeyup="calcular()" /> 
<input type="text" id="iva" value="0" onkeyup="calcular()" /> 
<input type="text" id="totiva" disabled="disabled" /> 
<input type="text" id="total" disabled="disabled" /> <br>
<?php
require 'funciones2.php';
conectar();
$q="select * from abonofac ";
$r=mysql_query($q);
while($m=mysql_fetch_array($r)){
	$n=explode('-',$m['fechapago']);
	$nf=$n[2]."-".$n[1]."-".$n[0];
	echo "update abonofac set fechapago='".$nf."' where id=".$m['id'].";<br>";
}
?>
</body> 
</html>  