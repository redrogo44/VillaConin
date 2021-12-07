<?php
include "conexion.php";

						$nombre = $_POST[ 'nombre' ];
						$correo = $_POST['correo'];
						$director = $_POST['director'];
						$correodirector = $_POST['correodirector'];
						$materia = $_POST['materia'];
						$clave = $_POST['clave'];
						$curso = $_POST['curso'];
						$cuatri = $_POST['cuatri'];
						$unidades = $_POST['unidades'];
						$numestudiantes = $_POST['numestudiantes'];
						$carrera = $_POST['carrera'];
						$fechai = $_POST['fechai'];
						$fechaf = $_POST['fechaf'];
						$profesores = $_POST['profesores'];
						$justificacion = $_POST['justificacion'];
						$actividades = $_POST['actividades'];
						
						
$insertar = mysql_query("INSERT INTO solicitud VALUES 
(NULL ,'".$nombre. "','".$correo. "','".$director. "','".$correodirector. "','".$materia. "','".$clave. "','".$curso. "','".$cuatri. "','".$unidades. "','".$numestudiantes. "','".$carrera. "','".$fechai. "','".$fechaf. "','".$profesores. "','".$justificacion. "','".$actividades. "' )" );

if($insertar)
{
	echo "<a href = '#' id='verPDF'>Ver en PDF </a>";
}
else
{
	echo "Mal";
}


?>