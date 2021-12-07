<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
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

$opcion = $_POST['opcion'];
// $opcion = 'generalChart';
switch ($opcion) {
  case 'salones':
    salones();
    break;
  case 'contratos':
    contratos();
    break;
  case 'tipo_evento':
    tipo_evento();
    break;
  case 'eventos':
    eventos();
    break;
  case 'eventosDiaEjecucion':
    eventosDiaEjecucion();
    break;
  case 'eventosDiaFirma':
    eventosDiaFirma();
    break;
  case 'yearSistem':
    yearSistem();
    break;
  case 'typeEvents':
    typeEvents();
    break;
  case 'generalChart':
    generalChart();
    break;
  case 'generalChart2':
    generalChart2();
    break;
  case 'generalChart3':
    generalChart3();
    break;
  case 'anualComensalesVenta':
    anualComensalesVenta();
    break;
  case 'anualComensalesEjecucion':
    anualComensalesEjecucion();
    break;
  case 'anualDineroEjecucion':
    anualDineroEjecucion();
    break;
  case 'anualDineroVentas':
    anualDineroVentas();
    break;
  case 'mensualComensalesEvento':
    mensualComensalesEvento();
    break;
  case 'mensualComensalesSalon2':
    mensualComensalesSalon2();
    break;
    # code...
  case 'mensualComensalesEventoEjecucion':
    mensualComensalesEventoEjecucion();
    break;
  case 'mensualComensalesSalonejEcucion':
    mensualComensalesSalonejEcucion();
    break;
  case 'mensualDineroEvento':
    mensualDineroEvento();
    break;
  case 'mensualDineroSalon2':
    mensualDineroSalon2();
    break;
  case 'mensualDineroEventoEjecucion':
    mensualDineroEventoEjecucion();
    break;
  case 'mensualDineroSalonejEcucion':
    mensualDineroSalonejEcucion();
    break;
  case 'totalesDineroEjecucionEvento':
    totalesDineroEjecucionEvento();
    break;
  case 'totalesDineroEjecucionSalon':
    totalesDineroEjecucionSalon();
    break;
  case 'totalesComensalesVentaEvento':
    totalesComensalesVentaEvento();
    break;
  case 'totalesComensalesVentaSalon':
    totalesComensalesVentaSalon();
    break;
  case 'totalesDineroVentaEvento':
    totalesDineroVentaEvento();
    break;
  case 'totalesDineroVentaSalon':
    totalesComensalesVentaSalon();
    break;
  default:
    break;
}

function salones () {
  global $conexion;
  $sql = 'SELECT salon FROM contrato GROUP BY salon';
  $result = $conexion->query($sql);
  $response = [];
  if ($result->num_rows > 0) 
  {
    $cont = 0;
    while ($row = $result->fetch_array())
    {
      $evento = utf8_encode($row['salon']);
      $response[$cont] = $evento;
      $cont++;
    }
  }
  echo json_encode($response);
}

function contratos () {
  global $conexion;
  $response = [];
  $sql = "SELECT YEAR(FECHA) year FROM `contrato` WHERE YEAR(FECHA) >= '2017' group by year ORDER BY year";
  // $sql = "SELECT MONTH(Fecha) Mes, COUNT(*) total FROM `contrato` WHERE Fecha >= '2019-01-01' GROUP BY Mes";
  $result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
  if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
  {
    while ($row = $result->fetch_array())
    {
      $contrato = [];
      $sql2 = "SELECT MONTH(Fecha) Mes, COUNT(*) total FROM `contrato` WHERE YEAR(FECHA) = '" . $row['year'] . "' GROUP BY Mes;";
      $result2 = $conexion->query($sql2); //usamos la conexion para dar un resultado a la variable
      if ($result2->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
      {
        $x = 1;
        while ($row2 = $result2->fetch_array())
        {
          $contrato[$x]['mes'] = $row2['Mes'];
          $contrato[$x]['total'] = $row2['total'];
          $x++;

        }
        $response[$row['year']] = $contrato;
      }
    }
    // print_r("<pre>".$response);
    echo json_encode($response);
  }
  else
  {
      echo "No hubo resultados";
  }
}

function tipo_evento () {
  global $conexion;
  $sql = 'SELECT tipo_evento FROM cargos_new GROUP BY tipo_evento;';
  $result = $conexion->query($sql);
  $response = [];
  if ($result->num_rows > 0) 
  {
    $cont = 0;
    while ($row = $result->fetch_array())
    {
      $evento = utf8_encode($row['tipo_evento']);
      $response[$cont] = $evento;
      $cont++;
    }
  }
  echo json_encode($response);
}

function eventos () {
  global $conexion;
  $response = [];
  $years = "SELECT YEAR(FECHA) year FROM `contrato` WHERE YEAR(FECHA) >= '2017' group by year ORDER BY year";
  $result = $conexion->query($years);
  if ($result->num_rows > 0) 
  {
    $cont = 0;
    while ($row = $result->fetch_array())
    {
      $sql = "SELECT SUM(total_adultos + total_jovenes + total_ninos) total_cargos FROM `cargos_new` WHERE tipo_evento = '" . $_POST['tipo'] . "' AND Year(fecha) = '" . $row['year'] . "'";
      $total_cargos = $conexion->query($sql);
      $total_cargos = mysqli_fetch_array($total_cargos);
      $sql3 = "SELECT SUM(total_adultos + total_jovenes + total_ninos) total_cargos FROM `cargos_facturados_new` WHERE tipo_evento = '" . $_POST['tipo'] . "' AND Year(fecha) = '" . $row['year'] . "'";
      $total_cargos_fac = $conexion->query($sql3);
      $total_cargos_fac = mysqli_fetch_array($total_cargos_fac);
      $sql1 = "SELECT SUM(c_adultos + c_jovenes + c_ninos) total_contrato FROM `contrato` WHERE YEAR(FECHA) = '" . $row['year'] . "' AND tipo = '" . $_POST['tipo'] . "'";
      $total_contrato = $conexion->query($sql1);
      $total_contrato = mysqli_fetch_array($total_contrato);

      $response[$row['year']] = $total_cargos['total_cargos'] + $total_contrato['total_contrato'] + $total_cargos_fac['total_cargos'];
    }
  }
  echo json_encode($response);
}

function eventosDiaFirma () {
  global $conexion;
  $response = [];
  $years = "SELECT YEAR(FECHA) year FROM `contrato` WHERE YEAR(FECHA) >= '2017' group by year ORDER BY year";
  $result = $conexion->query($years);
  if ($result->num_rows > 0) 
  {
    $cont = 0;
    while ($row = $result->fetch_array())
    {
      // $sql = "SELECT SUM(total_adultos + total_jovenes + total_ninos) total_cargos FROM `cargos_new` WHERE tipo_evento = '" . $_POST['tipo'] . "' AND Year(fecha) = '" . $row['year'] . "'";
      // $total_cargos = $conexion->query($sql);
      // $total_cargos = mysqli_fetch_array($total_cargos);
      // $sql3 = "SELECT SUM(total_adultos + total_jovenes + total_ninos) total_cargos FROM `cargos_facturados_new` WHERE tipo_evento = '" . $_POST['tipo'] . "' AND Year(fecha) = '" . $row['year'] . "'";
      // $total_cargos_fac = $conexion->query($sql3);
      // $total_cargos_fac = mysqli_fetch_array($total_cargos_fac);
      $sql1 = "SELECT SUM(si) total_contrato FROM `contrato` WHERE YEAR(FECHA) = '" . $row['year'] . "' AND tipo = '" . $_POST['tipo'] . "'";
      $total_contrato = $conexion->query($sql1);
      $total_contrato = mysqli_fetch_array($total_contrato);

      $response[$row['year']] = $total_contrato['total_contrato'];
    }
  }
  echo json_encode($response);
}

function eventosDiaEjecucion () {
  global $conexion;
  $response = [];
  $years = "SELECT YEAR(FECHA) year FROM `contrato` WHERE YEAR(FECHA) >= '2017' group by year ORDER BY year";
  $result = $conexion->query($years);
  if ($result->num_rows > 0) 
  {
    $cont = 0;
    while ($row = $result->fetch_array())
    {
      $sql = "SELECT SUM(total) total_cargos FROM `cargos_new` WHERE tipo_evento = '" . $_POST['tipo'] . "' AND Year(fecha) = '" . $row['year'] . "'";
      $total_cargos = $conexion->query($sql);
      $total_cargos = mysqli_fetch_array($total_cargos);
      $sql3 = "SELECT SUM(total) total_cargos FROM `cargos_facturados_new` WHERE tipo_evento = '" . $_POST['tipo'] . "' AND Year(fecha) = '" . $row['year'] . "'";
      $total_cargos_fac = $conexion->query($sql3);
      $total_cargos_fac = mysqli_fetch_array($total_cargos_fac);
      $sql1 = "SELECT SUM(si) total_contrato FROM `contrato` WHERE YEAR(FECHA) = '" . $row['year'] . "' AND tipo = '" . $_POST['tipo'] . "'";
      $total_contrato = $conexion->query($sql1);
      $total_contrato = mysqli_fetch_array($total_contrato);

      $response[$row['year']] =  $total_cargos['total_cargos'] + $total_contrato['total_contrato'] + $total_cargos_fac['total_cargos'];
    }
  }
  echo json_encode($response);
}

function yearSistem () {
  global $conexion;
  $response = [];
  $years = "SELECT YEAR(FECHA) year FROM `contrato` WHERE YEAR(FECHA) >= '2017' group by year ORDER BY year";
  $result = $conexion->query($years);
  if ($result->num_rows > 0) 
  {
    $cont = 0;
    while ($row = $result->fetch_array())
    {
      $response[$row['year']] =  $row['year'];
    }
  }
  echo json_encode($response);
}

function typeEvents () {
  global $conexion;
  $response = [];
  $years = "SELECT tipo FROM contrato GROUP BY tipo ";
  $result = $conexion->query($years);
  if ($result->num_rows > 0) 
  {
    while ($row = $result->fetch_array())
    {
      $response[utf8_encode($row['tipo'])] =  utf8_encode($row['tipo']);
    }
  }
  echo json_encode($response);
}

function generalChart () { // dia de ejecucion
  global $conexion;
  $response = [];
  $sql = "SELECT
            MONTH(contrato.Fecha) Mes,
            contrato.tipo,
            SUM(c_adultos + c_jovenes + c_ninos) total_contrato,
            IFNULL(SUM(cargos_new.total_adultos + cargos_new.total_jovenes + cargos_new.total_ninos), 0) total_cargos,
            IFNULL(SUM(cargos_facturados_new.total_adultos + cargos_facturados_new.total_jovenes + cargos_facturados_new.total_ninos), 0) total_facturados,
            contrato.fecha
          FROM `contrato` 
          left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
          left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
          WHERE YEAR(contrato.Fecha) = '" . $_POST['year'] . "' AND contrato.tipo = '" . $_POST['tipo'] . "'
          GROUP BY Mes, contrato.tipo ";
  $result = $conexion->query($sql);
  if ($result->num_rows > 0)
  {
    $contrato = [];
    $x = 1;
    while ($row = $result->fetch_array())
    {
        $contrato[$x]['mes'] = $row['Mes'];
        $contrato[$x]['total'] = $row['total_contrato'] + $row['total_cargos'] + $row['total_facturados'];
        $contrato[$x]['tipo'] = utf8_encode($row['tipo']);
        $x++;
      $response['2017'] = $contrato;
    }
    // print_r($contrato);
    echo json_encode($contrato);
  }
}

function anualDineroVentas () {
  global $conexion;
  $response = [];
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
            MONTH(contrato.Fecha) Mes,
            SUM(si) total
          FROM `contrato` 
          left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
          left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
          WHERE YEAR(contrato.Fecha) = '" . $year . "'
          GROUP BY Mes";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato[$x]['mes'] = $row['Mes'];
         $contrato[$x]['total'] = $row['total'];
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response); 
}

function anualComensalesVenta () { // dia de venta por año
  global $conexion;
  $response = [];
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
            MONTH(contrato.Fecha) Mes,
            SUM(c_adultos + c_jovenes + c_ninos) total_contrato
          FROM `contrato` 
          left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
          left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
          WHERE YEAR(contrato.Fecha) = '" . $year . "'
          GROUP BY Mes";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato[$x]['mes'] = $row['Mes'];
         $contrato[$x]['total_contrato'] = $row['total_contrato'];
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function anualDineroEjecucion () {
  global $conexion;
  $response = [];
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
            MONTH(contrato.Fecha) Mes,
            SUM(si) total_contrato,
            IFNULL(SUM(cargos_new.total), 0) total_cargos,
            IFNULL(SUM(cargos_facturados_new.total), 0) total_facturados
          FROM `contrato` 
          left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
          left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
          WHERE YEAR(contrato.Fecha) = '" . $year . "'
          GROUP BY Mes";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato[$x]['mes'] = $row['Mes'];
         $contrato[$x]['total'] = $row['total_contrato'] + $row['total_cargos'] + $row['total_facturados'];
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function anualComensalesEjecucion () { // dia de ejecucion por año
  global $conexion;
  $response = [];
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
            MONTH(contrato.Fecha) Mes,
            SUM(c_adultos + c_jovenes + c_ninos) total_contrato,
            IFNULL(SUM(cargos_new.total_adultos + cargos_new.total_jovenes + cargos_new.total_ninos), 0) total_cargos,
            IFNULL(SUM(cargos_facturados_new.total_adultos + cargos_facturados_new.total_jovenes + cargos_facturados_new.total_ninos), 0) total_facturados
          FROM `contrato` 
          left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
          left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
          WHERE YEAR(contrato.Fecha) = '" . $year . "'
          GROUP BY Mes";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato[$x]['mes'] = $row['Mes'];
         $contrato[$x]['total_comensales'] = $row['total_contrato'] + $row['total_cargos'] + $row['total_facturados'];
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function generalChart2 () { // totales anuales comensales ejecucucion evento
  global $conexion;
  $response = [];
  $event = '';
  $eventos = explode(",", $_POST['evento']);
  foreach ($eventos as &$ev) {
    $event .= "'" . $ev . "',";
  }
  $event =  substr($event, 0, -1);
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
           contrato.tipo,
           SUM(c_adultos + c_jovenes + c_ninos) total_contrato,
           IFNULL(SUM(cargos_new.total_adultos + cargos_new.total_jovenes + cargos_new.total_ninos), 0) total_cargos,
           IFNULL(SUM(cargos_facturados_new.total_adultos + cargos_facturados_new.total_jovenes + cargos_facturados_new.total_ninos), 0) total_facturados,
           contrato.fecha
         FROM `contrato` 
         left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
         left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
         WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.tipo IN (" . $event . ") ";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
        if (($row['total_contrato'] + $row['total_cargos'] + $row['total_facturados']) > 0) {
          $contrato['total'] = $row['total_contrato'] + $row['total_cargos'] + $row['total_facturados'];
          $contrato['tipo'] = utf8_encode($row['tipo']);
          $x++;
        }
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function generalChart3 () { // comensales ejecucion salon
  global $conexion;
  $response = [];
  $event = '';
  $salon = explode(",", $_POST['salon']);
  foreach ($salon as &$ev) {
    $event .= "'" . $ev . "',";
  }
  $event =  substr($event, 0, -1);
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
           contrato.tipo,
           SUM(c_adultos + c_jovenes + c_ninos) total_contrato,
           IFNULL(SUM(cargos_new.total_adultos + cargos_new.total_jovenes + cargos_new.total_ninos), 0) total_cargos,
           IFNULL(SUM(cargos_facturados_new.total_adultos + cargos_facturados_new.total_jovenes + cargos_facturados_new.total_ninos), 0) total_facturados,
           contrato.fecha
         FROM `contrato` 
         left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
         left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
         WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.salon IN (" . $event . ") ";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato['total'] = $row['total_contrato'] + $row['total_cargos'] + $row['total_facturados'];
         $contrato['tipo'] = utf8_encode($row['tipo']);
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function totalesComensalesVentaEvento () { // totales anuales comensales evento  venta
  global $conexion;
  $response = [];
  $event = '';
  $eventos = explode(",", $_POST['evento']);
  foreach ($eventos as &$ev) {
    $event .= "'" . $ev . "',";
  }
  $event =  substr($event, 0, -1);
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
           contrato.tipo,
           SUM(c_adultos + c_jovenes + c_ninos) total_contrato,
           contrato.fecha
         FROM `contrato` 
         WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.tipo IN (" . $event . ") ";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
          $contrato['total'] = $row['total_contrato'];
          $contrato['tipo'] = utf8_encode($row['tipo']);
          $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function totalesComensalesVentaSalon () { // comensales ejecucion salon
  global $conexion;
  $response = [];
  $event = '';
  $salon = explode(",", $_POST['salon']);
  foreach ($salon as &$ev) {
    $event .= "'" . $ev . "',";
  }
  $event =  substr($event, 0, -1);
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
           contrato.salon,
           SUM(c_adultos + c_jovenes + c_ninos) total_contrato,
           contrato.fecha
         FROM `contrato` 
         WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.salon IN (" . $event . ") ";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato['total'] = $row['total_contrato'];
         $contrato['tipo'] = utf8_encode($row['salon']);
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function totalesDineroEjecucionEvento () { // totales anuales comensales ejecucucion evento
  global $conexion;
  $response = [];
  $event = '';
  $eventos = explode(",", $_POST['evento']);
  foreach ($eventos as &$ev) {
    $event .= "'" . $ev . "',";
  }
  $event =  substr($event, 0, -1);
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
           contrato.tipo,
           SUM(si) total_contrato,
           IFNULL(SUM(cargos_new.total), 0) total_cargos,
           IFNULL(SUM(cargos_facturados_new.total), 0) total_facturados,
           contrato.fecha
         FROM `contrato` 
         left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
         left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
         WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.tipo IN (" . $event . ") ";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
        if (($row['total_contrato'] + $row['total_cargos'] + $row['total_facturados']) > 0) {
          $contrato['total'] = $row['total_contrato'] + $row['total_cargos'] + $row['total_facturados'];
          $contrato['tipo'] = utf8_encode($row['tipo']);
          $x++;
        }
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function totalesDineroVentaSalon () {
  global $conexion;
  $response = [];
  $event = '';
  $salon = explode(",", $_POST['salon']);
  foreach ($salon as &$ev) {
    $event .= "'" . $ev . "',";
  }
  $event =  substr($event, 0, -1);
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
           contrato.salon,
           SUM(si) total_contrato,
           contrato.fecha
         FROM `contrato` 
         WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.salon IN (" . $event . ") ";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato['total'] = $row['total_contrato'];
         $contrato['salon'] = utf8_encode($row['salon']);
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function totalesDineroVentaEvento () {
  global $conexion;
  $response = [];
  $event = '';
  $salon = explode(",", $_POST['evento']);
  foreach ($salon as &$ev) {
    $event .= "'" . $ev . "',";
  }
  $event =  substr($event, 0, -1);
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
           contrato.salon,
           SUM(si) total_contrato,
           contrato.fecha
         FROM `contrato` 
         WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.tipo IN (" . $event . ") ";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato['total'] = $row['total_contrato'];
         $contrato['salon'] = utf8_encode($row['salon']);
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function totalesDineroEjecucionSalon () { // comensales ejecucion salon
  global $conexion;
  $response = [];
  $event = '';
  $salon = explode(",", $_POST['salon']);
  foreach ($salon as &$ev) {
    $event .= "'" . $ev . "',";
  }
  $event =  substr($event, 0, -1);
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
           contrato.tipo,
           SUM(si) total_contrato,
           IFNULL(SUM(cargos_new.total), 0) total_cargos,
           IFNULL(SUM(cargos_facturados_new.total), 0) total_facturados,
           contrato.fecha
         FROM `contrato` 
         left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
         left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
         WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.salon IN (" . $event . ") ";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato['total'] = $row['total_contrato'] + $row['total_cargos'] + $row['total_facturados'];
         $contrato['tipo'] = utf8_encode($row['tipo']);
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function mensualComensalesEvento () { // ventaa
  global $conexion;
  $response = [];
  $event = $_POST['evento'];
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
            MONTH(contrato.Fecha) Mes,
            SUM(c_adultos + c_jovenes + c_ninos) total_contrato,
            contrato.tipo
          FROM `contrato` 
          left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
          left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
          WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.tipo = '" . $event . "'
          GROUP BY Mes";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato[$x]['total'] = $row['total_contrato'];
         $contrato[$x]['tipo'] = $row['tipo'];
         $contrato[$x]['mes'] = $row['Mes'];
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function mensualComensalesSalon2 () { // venta
global $conexion;
  $response = [];
  $salon = $_POST['salon'];
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
            MONTH(contrato.Fecha) Mes,
            SUM(c_adultos + c_jovenes + c_ninos) total_contrato,
            contrato.salon
          FROM `contrato` 
          left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
          left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
          WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.salon = '" . $salon . "'
          GROUP BY Mes";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato[$x]['total'] = $row['total_contrato'];
         $contrato[$x]['mes'] = $row['Mes'];
         $contrato[$x]['salon'] = $row['salon'];
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response); 
}

function mensualComensalesEventoEjecucion () {
  global $conexion;
  $response = [];
  $event = $_POST['evento'];
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
            MONTH(contrato.Fecha) Mes,
            SUM(c_adultos + c_jovenes + c_ninos) total_contrato,
            IFNULL(SUM(cargos_new.total_adultos + cargos_new.total_jovenes + cargos_new.total_ninos), 0) total_cargos,
            IFNULL(SUM(cargos_facturados_new.total_adultos + cargos_facturados_new.total_jovenes + cargos_facturados_new.total_ninos), 0) total_facturados,
            contrato.fecha
          FROM `contrato` 
          left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
          left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
          WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.tipo = '" . $event . "'
          GROUP BY Mes";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato[$x]['total'] = $row['total_contrato'] + $row['total_cargos'] + $row['total_facturados'];
         $contrato[$x]['mes'] = $row['Mes'];
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function mensualComensalesSalonEjecucion () {
  global $conexion;
  $response = [];
  $event = $_POST['salon'];
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
            MONTH(contrato.Fecha) Mes,
            SUM(c_adultos + c_jovenes + c_ninos) total_contrato,
            IFNULL(SUM(cargos_new.total_adultos + cargos_new.total_jovenes + cargos_new.total_ninos), 0) total_cargos,
            IFNULL(SUM(cargos_facturados_new.total_adultos + cargos_facturados_new.total_jovenes + cargos_facturados_new.total_ninos), 0) total_facturados,
            contrato.fecha
          FROM `contrato` 
          left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
          left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
          WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.salon = '" . $event . "'
          GROUP BY Mes";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato[$x]['total'] = $row['total_contrato'] + $row['total_cargos'] + $row['total_facturados'];
         $contrato[$x]['mes'] = $row['Mes'];
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function mensualDineroEvento () { // venta
  global $conexion;
  $response = [];
  $event = $_POST['evento'];
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
            MONTH(contrato.Fecha) Mes,
            SUM(si) total_contrato,
            contrato.tipo
          FROM `contrato` 
          left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
          left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
          WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.tipo = '" . $event . "'
          GROUP BY Mes";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato[$x]['total'] = $row['total_contrato'];
         $contrato[$x]['tipo'] = $row['tipo'];
         $contrato[$x]['mes'] = $row['Mes'];
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function mensualDineroSalon2 () {
  global $conexion;
  $response = [];
  $salon = $_POST['salon'];
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
            MONTH(contrato.Fecha) Mes,
            SUM(si) total_contrato,
            contrato.salon
          FROM `contrato` 
          left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
          left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
          WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.salon = '" . $salon . "'
          GROUP BY Mes";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato[$x]['total'] = $row['total_contrato'];
         $contrato[$x]['mes'] = $row['Mes'];
         $contrato[$x]['salon'] = $row['salon'];
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response); 
}

function mensualDineroEventoEjecucion () {
   global $conexion;
  $response = [];
  $event = $_POST['evento'];
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
            MONTH(contrato.Fecha) Mes,
            SUM(si) total_contrato,
            IFNULL(SUM(cargos_new.total), 0) total_cargos,
            IFNULL(SUM(cargos_facturados_new.total), 0) total_facturados,
            contrato.fecha
          FROM `contrato` 
          left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
          left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
          WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.tipo = '" . $event . "'
          GROUP BY Mes";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato[$x]['total'] = $row['total_contrato'] + $row['total_cargos'] + $row['total_facturados'];
         $contrato[$x]['mes'] = $row['Mes'];
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

function mensualDineroSalonejEcucion () {
  global $conexion;
  $response = [];
  $event = $_POST['salon'];
  $years = explode(",", $_POST['years']);
  foreach ($years as &$year) {
    $contrato = [];
    $sql = "SELECT
            MONTH(contrato.Fecha) Mes,
            SUM(si) total_contrato,
            IFNULL(SUM(cargos_new.total), 0) total_cargos,
            IFNULL(SUM(cargos_facturados_new.total), 0) total_facturados,
            contrato.fecha
          FROM `contrato` 
          left JOIN cargos_new ON contrato.Numero = cargos_new.contrato
          left JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
          WHERE YEAR(contrato.Fecha) = '" . $year . "' AND contrato.salon = '" . $event . "'
          GROUP BY Mes";
   $result = $conexion->query($sql);
   if ($result->num_rows > 0)
   {
     $x = 1;
     while ($row = $result->fetch_array())
     {
         $contrato[$x]['total'] = $row['total_contrato'] + $row['total_cargos'] + $row['total_facturados'];
         $contrato[$x]['mes'] = $row['Mes'];
         $x++;
     }
   }
   $response[$year] = $contrato;
  }
  echo json_encode($response);
}

$conexion->close(); //cerramos la conexión
?>