<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
</head>
<body>
<?php
require 'configuraciones.php';
conectar();
if($_POST['cantidad']==""){
$_POST['cantidad']=0;
}
if($_POST['costo']==""){
$_POST['costo']=0;
}
$q="select * from TManteleria where Categoria='".$_POST['categoria']."' and tipo='".$_POST['tipo']."' and descripcion='".$_POST['descripcion']."'";
$r=mysql_query($q);
$m=mysql_fetch_array($r);
$total1=$m['buenestado']+$_POST['cantidad'];
$total2=$m['total']+$_POST['cantidad'];;
$costo=($_POST['costo']+$m['costo'])/2;
$q2="UPDATE TManteleria set buenestado=".$total1.",total=".$total2.",costo=".$costo.",precio=".$_POST['precio']." where Categoria='".$_POST['categoria']."' and tipo='".$_POST['tipo']."' and descripcion='".$_POST['descripcion']."'";
$r2=mysql_query($q2);
$fecha=date("Y-m-d");
$q3="insert into compras values('".$_POST['cantidad']."','".$m['producto']."',".$_POST['costo'].",'".$fecha."','".$_POST['usuario']."')";
$r3=mysql_query($q3);
/*echo $q."<br>";
echo $q2."<br>";
echo $q3."<br>";*/
echo '<script>alert("Registro Existoso");location.href="compras.php";</script>';
?>
</body>
</html>