<?php
session_start();
require 'funciones2.php';
conectar();
switch ($_POST['data']) {
	case 'login':
		login();
		break;
}
function login () {
	$query = "SELECT * FROM usuarios WHERE nombre = '".$_POST['user']."' and contrasena = '".$_POST['pass']."';";
	// $query = "SELECT * FROM usuarios";
	$resultado=mysql_query($query) or die(mysql_error());
	$cuantos =mysql_num_rows($resultado);
	$muestra = mysql_fetch_array($resultado);
	if ($cuantos > 0) {
		session_start();
		$_SESSION['nombre']=  $muestra['nombre'];
		$_SESSION['esta'] = $muestra['estatus'];				
		$_SESSION['usu'] = $muestra['usuario'];			
		// $_SESSION['niv'] = $muestra['nivel'];
	}
	echo json_encode($cuantos);
}
?>