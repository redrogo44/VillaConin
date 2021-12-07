<?php
require 'configuraciones.php';
conectar();
$filtro="select count(*)as c from usuarios where nombre='".$_POST['name']."'";
$exe=mysql_query($filtro);
$m=mysql_fetch_array($exe);
if($m['c']<1){
	$agregar="insert into usuarios(nombre,usuario,contrasena,nivel,estatus) values ('".$_POST['name']."','".$_POST['user']."','".$_POST['password']."',".$_POST['nivel'].",".$_POST['status'].")";
	$r=mysql_query($agregar);
	echo "<script>alert('Usuario agregado correctamente');</script>";
	header('Location:Usuarios.php');
}else{
	echo "<script>alert('Error nombre de usuario ya esistente');</script>";
	header('Location:agregar.php');
	header('Location:	Usuarios.php');
}

header('Location:Usuarios.php');
?>
<script type="text/javascript">
window.location="http:Usuarios.php";
</script>
</body>