<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', '1');
$server     = 'localhost'; //servidor
$username   = 'qroodigo_usuarios'; //usuario de la base de datos
$password   = 'qroodigo_usuarios'; //password del usuario de la base de datos
$database   = 'qroodigo_VillaConin'; //nombre de la base de datos

$conexion = new mysqli();
@$conexion->connect($server, $username, $password, $database);
/*
 Las 2 lineas de arriba se pueden resumir en:
 $conexion = @new mysqli($server, $username, $password, $database);
 Recuerden que el @ adelante de las funciones significa que no generará error o warnings
 Tema: http://www.elcodigofuente.com/uso-del-arroba-funciones-php-585/
*/
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
}

// $opcion = $_POST['opcion'];
$opcion = "refactorCargos";

switch ($opcion) {
  case 'refactorCargos':
    refactorCargos();
    break;
  default:
    # code...
    break;
}

function refactorCargos () {
  global $conexion;
  // $contrato = [];
  $truncate = "truncate table cargos_facturados_new";
  $conexion->query($truncate);
  $alter = "ALTER TABLE `cargos_facturados_new` AUTO_INCREMENT = 1;";
  $conexion->query($alter);
  $sql = "INSERT INTO cargos_facturados_new (id_cargos, total_adultos, total_jovenes, total_ninos, precio_adultos, precio_jovenes, precio_ninos, total, tipo, fecha, concepto, contrato, tipo_evento) VALUES ";
  $sql3 = "SELECT numcontrato, cargo.fecha, cargo.tipo,cargo.concepto, id, contrato.tipo tipo_evento
            FROM cargofac cargo
            JOIN contrato ON cargo.numcontrato = contrato.Numero
            WHERE cargo.tipo = 'Comensales';";
  $result3 = $conexion->query($sql3); 
  $totalCargos = 0;
  $x = 1;
  while ($row3 = $result3->fetch_array())
  {
    $concepto = explode(",", $row3['concepto']);
    $concepto2 = explode("=", $concepto[0]);
    $concepto21 = explode(" ", $concepto2[1]);
    $concepto211 = explode(" ", $concepto2[2]);
    $concepto3 = explode("=", $concepto[1]);
    $concepto31 = explode(" ", $concepto3[1]);
    $concepto311 = explode(" ", $concepto3[2]);
    $concepto4 = explode("=", $concepto[2]);
    $concepto41 = explode(" ", $concepto4[1]);
    $concepto411 = explode(" ", $concepto4[2]);
    $total = ($concepto21[1] * $concepto211[1]) + ($concepto31[1] * $concepto311[1]) + ($concepto41[1] * $concepto411[1]);
    if (empty($concepto21[1])) {
      $concepto21[1] = 0;
    }
    if (empty($concepto31[1])) {
      $concepto31[1] = 0;
    }
    if (empty($concepto41[1])) {
      $concepto41[1] = 0;
    }
    if (empty($concepto211[1])) {
      $concepto211[1] = 0;
    }
    if (empty($concepto311[1])) {
      $concepto311[1] = 0;
    }
    if (empty($concepto411[1])) {
      $concepto411[1] = 0;
    }

    // print_r($row3);
    // print_r($concepto2);
    // print_r($concepto21);
    // print_r($concepto211);
    // print_r($concepto3);
    // print_r($concepto31);
    // print_r($concepto311);
    // print_r($concepto4);
    // print_r($concepto41);
    // print_r($concepto411);
    $sql .= "(" . $row3['id'] . ", " . $concepto21[1] . ", " . $concepto31[1] . ", " . $concepto41[1] . ", " . $concepto211[1] . ", " . $concepto311[1] . ", " . $concepto411[1] . ", " . $total . ", 'Comensales' , '" . $row3['fecha'] . "', '" . utf8_encode($row3['concepto']) . "', '" . $row3['numcontrato'] . "', '" . $row3['tipo_evento'] . "'),\n";
  }
 
  $sql = substr($sql, 0, -2);

  if ($conexion->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
  }
}
$conexion->close(); //cerramos la conexión
?>