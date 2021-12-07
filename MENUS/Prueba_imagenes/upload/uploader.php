<?php
\error_reporting(E_ALL ^ E_NOTICE);
$ruta="images/";
$nom=$_POST['nom'];
$archivo=$_FILES['imagen']['tmp_name'];
$nom_archivo=$_FILES['imagen']['name'];
$ext=  pathinfo($nom_archivo);
$subir = move_uploaded_file($archivo,$ruta."/".$nom.".".$ext['extension']);
if ($subir)
{    echo 'El archivo se subio con exito';}
else
{echo 'Error al subir ';}
?>

