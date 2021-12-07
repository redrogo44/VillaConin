<html>
<head>
</head>
<body>
<?php
require 'configuraciones.php';
conectar();

$filtro="select count(*)as c from usuarios where nombre='".$_POST['name']."'";
$exe=mysql_query($filtro);
$m=mysql_fetch_array($exe);
	if($m['c']<1){
	$datos="select * from usuarios where id=".$_POST['id'];
	$result=mysql_query($datos);
	$show=mysql_fetch_array($result);
	if($_POST['name']==''){
		$_POST['name']=$show['nombre'];
	}
	if($_POST['user']==''){
		$_POST['user']=$show['usuario'];
	}
	if($_POST['password']==''){
		$_POST['password']=$show['contrasena'];
	}
	if($_POST['nivel']==''){
		$_POST['nivel']=$show['nivel'];
	}
	if($_POST['status']==''){
		$_POST['status']=$show['estatus'];
	}

	$actualiza="UPDATE usuarios set nombre='".$_POST['name']."',usuario='".$_POST['user']."',contrasena='".$_POST['password']."',nivel=".$_POST['nivel'].", estatus=".$_POST['status']." where id=".$_POST['id'];
	$r=mysql_query($actualiza);
	header('Location: Usuarios.php');
}else{
	echo "<script>alert('Error nombre de usuario ya esistente');</script>";
	header('Location: m_usuario.php?id='.$_POST['id']);
}
?>
</body>
</html>
<script type="text/javascript">
window.location="http:Usuarios.php";
</script>
</body>