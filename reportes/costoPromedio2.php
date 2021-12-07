<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("Content-Type: text/html;charset=utf-8");
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', '1');
$server     = 'localhost'; //servidor
$username   = 'qroodigo_usuarios'; //usuario de la base de datos
$password   = 'qroodigo_usuarios'; //password del usuario de la base de datos
$database   = 'qroodigo_VillaConin'; //nombre de la base de datos

$conexion = new mysqli();
@$conexion->connect($server, $username, $password, $database);

if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
}

$post = (isset($_POST['fecha1']) && !empty($_POST['fecha2']));
if ($post) {
  $feha1 = $_POST['fecha1'];
  // $fecha1 = '2019-01-01';
  $feha2 = $_POST['fecha2'];  
}

$opcion = $_POST['opcion'];
// $opcion = 'numeroEventos';

// $fecha2 = '2019-02-01';
// print_r($_POST);
switch ($opcion) {
  case 'Eventos & Comenzales':
    eventos_Comenzales();
    break;
  case 'Eventos adicionales':
    eventosAdicionales();
    break;
  case 'Eventos de recaudación':
    eventosRecaudacion();
    break;
  case 'Cobrado en contratos':
    totalCobrado();
    break;
  case 'Ventas':
    ventas();
    break;
  case 'Cancelaciones':
    cancelaciones();
    break;
  case 'Insumos':
    gastoInsumo();
    break;
  case 'Gasto operativo':
    gastoOperativo();
    break;
  case 'Gasto activo':
    gastoActivo();
    break;
  case 'Gasto personal':
    gastoPersonal();
    break;
  case 'Eventos & Comenzales Detalle':
    eventos_Comenzales_detalle();
    break;
  case 'Eventos adicionales Detalle':
    eventosAdicionalesDetalle();
    break;
  case 'Eventos recaudación Detalle':
    eventosAdicionalesDetalle();
    break;
  case 'Cobrado en contratos Detalle':
    cobradoDetalle();
    break;
  case 'Inversion':
    Inversion();
    break;
  case 'Cancelaciones Detalle':
    CanceladionesDetalle();
    break;
  case 'Insumos Detalle':
    detalleInsumo();
    break;
  case 'Detalle Categoria':
    detalleCategoria();
    break;
  case 'Gasto operativo Detalle':
    gastoOperativoDetalle();
    break;
  case 'Gasto activo Detalle':
    gastoActivoDetalle();
    break;
  case 'Ventas Detalle':
    detalleVentas();
    break;
  case 'Ventas recaudación Detalle':
    detalleVentasRecaudacion();
    break;
  case 'Ventas vinos Detalle':
    detalleVentasVinos();
    break;
  case 'Gasto personal Detalle':
    detalleGastoPersonal();
    break;
  case 'Numero de Comensales':
    numeroComensales();
    break;
  case 'Detalle Gasto Operativo':
    gastoOperativoDetalleSubcategoria();
    break;
  case 'Detalle Gasto Activo':
    gastoActivoDetalleSubcategoria();
    break;
  case 'Detalle Gastos Personales':
    gastoPersonalDetalleSubcategoria();
    break;
  case 'Inventario vinos':
    vinos();
    break;
  case 'getProducts':
    getProducts();
    break;
  case 'addComment':
    addComment();
    break;
  case 'Comentario':
    getComment();
    break;
  default:
}

function numeroComensales () {
  global $conexion;
  $result = [];
  $sql1 = "SELECT
              SUM(c_adultos + c_jovenes + c_ninos) total_contrato
            FROM contrato
            WHERE contrato.Fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result1 = $conexion->query($sql1); //usamos la conexion para dar un resultado a la variable
  $totalContrato = mysqli_fetch_array($result1);

  $sql2 = "SELECT IFNULL(SUM(cargos_new.total_adultos + cargos_new.total_jovenes + cargos_new.total_ninos), 0) total_cargos FROM `cargos_new` WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result2 = $conexion->query($sql2); //usamos la conexion para dar un resultado a la variable
  $totalCargos = mysqli_fetch_array($result2);

  
  $sql3 = "SELECT
        IFNULL(SUM(cargos_facturados_new.total_adultos + cargos_facturados_new.total_jovenes + cargos_facturados_new.total_ninos), 0) total_facturados
          FROM `cargos_facturados_new` WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result3 = $conexion->query($sql3); //usamos la conexion para dar un resultado a la variable
  $totalCargosFacturados = mysqli_fetch_array($result3);

  $result['total_contrato'] = $totalContrato['total_contrato'];
  $result['total_cargos'] = $totalCargos['total_cargos'];
  $result['total_facturados'] = $totalCargosFacturados['total_facturados'];
  $total = $totalContrato['total_contrato'] + $totalCargos['total_cargos'] +$totalCargosFacturados['total_facturados'];
  echo json_encode($total);
}

function eventos_Comenzales () {
   global $conexion;
  $response = [];
  $totalEventos=0;
  $sql = "SELECT COUNT( Numero ) AS t FROM contrato WHERE Fecha >=  '" . $_POST['fecha1'] . "' AND Fecha <=  '" . $_POST['fecha2'] . "' AND tipo!='MOSTRADOR' AND LENGTH(Numero) <= 8; ";
  // $sql = "SELECT MONTH(Fecha) Mes, COUNT(*) total FROM `contrato` WHERE Fecha >= '2019-01-01' GROUP BY Mes";
  $result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
  $totalEventos = mysqli_fetch_array($result);
  $total = 0;
  if ($totalEventos['t'] > 0)
  {
    $total = $totalEventos['t'];
  }

  // Numero de Comensales
  $sql1 = "SELECT
              SUM(c_adultos) adultos,
              SUM(c_jovenes) jovenes,
              SUM(c_ninos) ninos
            FROM contrato
            WHERE contrato.Fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result1 = $conexion->query($sql1); //usamos la conexion para dar un resultado a la variable
  $totalContrato = mysqli_fetch_array($result1);

  $sql2 = "SELECT
            IFNULL(SUM(cargos_new.total_adultos), 0) adultos,
            IFNULL(SUM(cargos_new.total_jovenes), 0) jovenes,
            IFNULL(SUM(cargos_new.total_ninos), 0) ninos
          FROM `cargos_new` WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result2 = $conexion->query($sql2); //usamos la conexion para dar un resultado a la variable
  $totalCargos = mysqli_fetch_array($result2);

  
  $sql3 = "SELECT
            IFNULL(SUM(cargos_facturados_new.total_adultos), 0) adultos,
            IFNULL(SUM(cargos_facturados_new.total_jovenes), 0) jovenes,
            IFNULL(SUM(cargos_facturados_new.total_ninos), 0) ninos
          FROM `cargos_facturados_new` WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result3 = $conexion->query($sql3); //usamos la conexion para dar un resultado a la variable
  $totalCargosFacturados = mysqli_fetch_array($result3);

  $response['adultos'] = $totalContrato['adultos'] + $totalCargos['adultos'] + $totalCargosFacturados['adultos'];
  $response['jovenes'] = $totalContrato['jovenes'] + $totalCargos['jovenes'] + $totalCargosFacturados['jovenes'];
  $response['ninos'] = $totalContrato['ninos'] + $totalCargos['ninos'] + $totalCargosFacturados['ninos'];
  echo "( " . $total . "/ " . $response['adultos'] . " Adultos, " . $response['jovenes'] . " Jovenes, " . $response['ninos'] . " Niños. )";
}

function eventosAdicionales () {
  global $conexion;
  $total = 0;
  $sql = "SELECT COUNT('Numero') as c FROM `Eventos_Adicionales` WHERE Fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result = $conexion->query($sql);
  $totalEventosAdicionales = mysqli_fetch_array($result);
  echo $totalEventosAdicionales['c'];
}

function eventosRecaudacion () {
  global $conexion;
  $total = 0;
  $sql = "SELECT Count(id) total FROM `Eventos_Recaudacion` WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result = $conexion->query($sql);
  $totalEventosRecaudacion = mysqli_fetch_array($result);
  if($totalEventosRecaudacion['total'] > 0 ) {
    $total = $totalEventosRecaudacion['total'];
  }

  echo $total;
}

function totalCobrado () {
  global $conexion;
  $total = 0;
  $sql = "SELECT 
            SUM(si) si,
            SUM(TDevoluciones.Total) devolucion
          FROM contrato
          LEFT JOIN TDevoluciones on contrato.Numero = TDevoluciones.Numero
          WHERE contrato.Fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "'  AND contrato.tipo !='MOSTRADOR' AND LENGTH(contrato.Numero)<=8;";
  $result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
  $totalContrato = mysqli_fetch_array($result);
  $sql2 = "SELECT 
            SUM(total) total
          FROM cargos_new
          WHERE cargos_new.fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' AND cargos_new.tipo !='MOSTRADOR';";
  $result2 = $conexion->query($sql2); //usamos la conexion para dar un resultado a la variable
  $totalCargos = mysqli_fetch_array($result2);
  $sql3 = "SELECT 
            SUM(total) total
          FROM cargos_facturados_new
          WHERE cargos_facturados_new.fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' AND cargos_facturados_new.tipo !='MOSTRADOR';";
  $result3 = $conexion->query($sql3); //usamos la conexion para dar un resultado a la variable
  $totalCargosFac = mysqli_fetch_array($result3);

  $total = ($totalContrato['si'] - $totalContrato['devolucion']) +  $totalCargos['total'] + $totalCargosFac['total'];
  echo $total;
}

function ventas () {
  global $conexion;
  $sql = "SELECT * FROM venta WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' ";
  $result = $conexion->query($sql);
  $tt=0;
  while ($row = $result->fetch_array())
  {
    $sql2 = "SELECT * FROM detalle where tipo='venta' AND id=".$row['id_venta'];
    $result2 = $conexion->query($sql2);
    while ($d = $result2->fetch_array()) {
      $sql3 = "SELECT * FROM producto WHERE id_producto=".$d['id_producto'];
      $result3 = $conexion->query($sql3);
      $p = mysqli_fetch_array($result3);
      if($p['id_categoria']!='1') {
        $t=($d['cantidad']*($d['precio_venta']-$d['precio_adquisicion']));
        if($t>0) {       
          $tt+=$t;
        }     
      } 
    }
  }
  $sql2 = "SELECT SUM(Total) total FROM `tickets` WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result2 = $conexion->query($sql2);
  $totalVentaRecaudacion = mysqli_fetch_array($result2);
  echo $tt + $totalVentaRecaudacion['total'];
}

function cancelaciones () {
  global $conexion;
  $sql = "SELECT SUM(cantidad) total FROM Cancelaciones WHERE fechamovimiento BETWEEN '" . $_POST['fecha1'] . "' AND  '" . $_POST['fecha2'] . "' AND concepto = 'cancelacion de contrato' ";
  $result3 = $conexion->query($sql);
  $cancelaciones = mysqli_fetch_array($result3);
  echo $cancelaciones['total'];
}

function gastoInsumo () {
  global $conexion;
  $sql = "SELECT 
            SUM((cantidad*precio_adquisicion)*-1) TotalInumos 
          FROM GastoInsumo
          WHERE fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' 
              AND `tipo`='faltante' 
              AND `gasto`='no'
              AND id_producto IN (
                SELECT id_producto 
                FROM Categorias_Subcategorias
                WHERE id_categoria in (18,5,2,8,6,4,7) );";
  $result = $conexion->query($sql);
  $insumo = mysqli_fetch_array($result);
  echo $insumo['TotalInumos'];
}

function gastoOperativo () {
  global $conexion;
  $sql = "SELECT SUM(cantidad * precio_adquisicion) total FROM `comprasGenerales` WHERE fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ";
  $result = $conexion->query($sql);
  $insumo = mysqli_fetch_array($result);
  echo $insumo['total'];
}

function gastoActivo () {
  global $conexion;
  $sql = "SELECT id_compra
          FROM comprafac
          WHERE fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ";
  $result = $conexion->query($sql);
  $totalFacturado = 0;
  while ($row = $result->fetch_array())
  {
    $sql2 = "SELECT SUM(cantidad * precio_adquisicion) T 
            FROM Compras_Facturadas
            WHERE tipo='comprafac' 
                  AND nombreCategoria != 'VINOS'
                  AND tipoCategoria='ACTIVO'
                  AND id=".$row['id_compra'];
    $result2 = $conexion->query($sql2);
    $activoFac = mysqli_fetch_array($result2);
    $totalFacturado += $activoFac['T'];
  }

  $sql3 = "SELECT *
            FROM compra
            WHERE fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ";
  $result3 = $conexion->query($sql3);
  $total= 0;
  while ($row2 = $result3->fetch_array())
  {
    $sql4 = "SELECT
                SUM(cantidad * precio_adquisicion) T
            FROM Compras
            WHERE tipo = 'compra'
                  AND nombreCategoria != 'VINOS'
                  AND tipoCategoria = 'ACTIVO'
                  AND id = ".$row2['id_compra'];
    $result4 = $conexion->query($sql4);
    $activo = mysqli_fetch_array($result4);
    $total += $activo['T'];
  }

  echo $total + $totalFacturado;
}

function gastoPersonal () {
  global $conexion;
  $totalGasto=0;
  $total=0;
  $sql = "SELECT SUM( importe ) total FROM  `vista_gasto_personal` WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result = $conexion->query($sql);
  $gastoPersonal = mysqli_fetch_array($result);
  $sql2 = "SELECT SUM( importe ) total FROM vista_gasto_personal_facturado WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result2 = $conexion->query($sql2);
  $gastoPersonalFacturado = mysqli_fetch_array($result2);

  echo $gastoPersonal['total'] + $gastoPersonalFacturado['total'];
}

function eventos_Comenzales_detalle () {
  global $conexion;
  $response = [];
  $sql = "SELECT Numero,
    nombre,
    contrato.tipo,
    salon,
    contrato.Fecha,
    IFNULL(SUM(cargos_new.total_adultos),0) cargos_adultos,
    IFNULL(SUM(cargos_new.total_jovenes),0) cargos_jovenes,
    IFNULL(SUM(cargos_new.total_ninos),0) cargos_ninos,
    IFNULL(SUM(cargos_facturados_new.total_adultos),0) cargosFac_adultos,
    IFNULL(SUM(cargos_facturados_new.total_jovenes),0) cargosFac_jovenes,
    IFNULL(SUM(cargos_facturados_new.total_ninos),0) cargosFac_ninos,
    IFNULL(SUM(contrato.c_adultos),0) contrato_adultos,
    IFNULL(SUM(contrato.c_jovenes),0) contrato_jovenes,
    IFNULL(SUM(contrato.c_ninos),0) contrato_ninos
FROM `contrato`
LEFT JOIN cargos_new ON cargos_new.contrato = contrato.Numero 
LEFT JOIN cargos_facturados_new ON cargos_new.contrato = contrato.Numero 
WHERE contrato.Fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' AND contrato.tipo <> 'MOSTRADOR' 
GROUP BY contrato.Numero";
  $result = $conexion->query($sql);
  $cont = 0;
  while ($row = $result->fetch_array()) {
    $response[$cont]['detalle'] = $row['Numero'] . " ( ". utf8_decode($row['tipo']) . "/ " . ($row['cargos_adultos'] + $row['cargosFac_adultos'] + $row['contrato_adultos']) . " Adultos, " . ($row['cargos_jovenes'] + $row['cargosFac_jovenes'] + $row['contrato_jovenes']) . " Jovenes, " . ($row['cargos_ninos'] + $row['cargosFac_ninos'] + $row['contrato_ninos']) ." Niños )";
    $response[$cont]['tipo'] = $row['Numero'];
    $cont++;
  }
  echo json_encode($response);
}

function eventosAdicionalesDetalle () {
  global $conexion;
  $response = [];
  $sql = "SELECT * FROM `Eventos_Adicionales` WHERE Fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result = $conexion->query($sql);
  if ($result->num_rows > 0) 
  {
    $cont = 0;
    while ($row = $result->fetch_array())
    {
      $response[$cont]['tipo'] =  $row['Numero'];
      $response[$cont]['detalle'] =  $row['Numero'] . " = ( ". $row['tipo'] . " )";
      $cont++;
    }
  }
  echo json_encode($response);
}

function eventosRecaudacionDetalle () {
  global $conexion;
  $response = [];
  $sql = "SELECT * FROM `Eventos_Recaudacion` WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result = $conexion->query($sql);
  if ($result->num_rows > 0) 
  {
    $cont = 0;
    while ($row = $result->fetch_array())
    {
      $response[$cont]['tipo'] =  $row['Numero'];
      $response[$cont]['detalle'] =  $row['Numero'] . " = ( Tipo: ". $row['tipo'] . ", Salon: " .$row['salon'] . " )";
      $cont++;
    }
  }
  echo json_encode($response);
}

function cobradoDetalle () {
  global $conexion;
  $response = [];
  $sql = "SELECT contrato.Numero,
   nombre,
   contrato.si si,
   contrato.tipo,
   contrato.Fecha,
   IFNULL(SUM(cargos_new.total),0) cargo,
   IFNULL(SUM(cargos_facturados_new.total),0) cargoFac,
   IFNULL(TDevoluciones.Total,0) devolucion 
FROM `contrato` 
LEFT JOIN cargos_new ON cargos_new.contrato = contrato.Numero LEFT JOIN cargos_facturados_new ON cargos_facturados_new.contrato = contrato.Numero 
LEFT JOIN TDevoluciones ON TDevoluciones.Numero = contrato.Numero 
WHERE contrato.Fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' AND contrato.tipo <> 'MOSTRADOR'
GROUP BY contrato.Numero";
  $result = $conexion->query($sql);
  $cont = 0;
  while ($row = $result->fetch_array()) {
    $response[$cont]['detalle'] = $row['Numero'] . " ( Cargos: " . ($row['cargo'] + $row['cargoFac']) . ", Devolución:, " . ($row['devolucion']) . ") = Total: " . (($row['si'] + $row['cargo'] + $row['cargoFac']) - $row['devolucion']);
    $response[$cont]['tipo'] = $row['Numero'];
    $cont++;
  }
  echo json_encode($response);
}

function totalVentaRecaudacion () {
  global $conexion;
  $response = [];
  $sql = "SELECT SUM(Total) total FROM `tickets` WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result = $conexion->query($sql);
  $totalVentaRecaudacion = mysqli_fetch_array($result);
  return $totalVentaRecaudacion['total'];
}

function CanceladionesDetalle () {
  global $conexion;
  $response = [];
  $sql = "SELECT numcontrato, cantidad FROM Cancelaciones WHERE fechamovimiento BETWEEN '" . $_POST['fecha1'] . "' AND  '" . $_POST['fecha2'] . "' AND concepto = 'cancelacion de contrato' ";
  $result3 = $conexion->query($sql);
  $cont = 0;
  while ($row = $result3->fetch_array()) {
    $response[$cont]['detalle'] = $row['numcontrato'] . " = " . $row['cantidad'] ;
    $response[$cont]['tipo'] = $row['numcontrato'];
    $cont++;
  }
  echo json_encode($response);
}

function detalleInsumo () {
  global $conexion;
  $response = [];
  $cont = 0;
  $sql2 = "
    SELECT
      nombreSubcategoria,
        Categorias_Subcategorias.id_subcategoria,
        nombreCategoria,
        id_categoria,
        Categorias_Subcategorias.id_producto,
        SUM((GastoInsumo.cantidad * GastoInsumo.precio_adquisicion)*-1) as total
    FROM Categorias_Subcategorias 
    JOIN GastoInsumo ON Categorias_Subcategorias.id_producto = GastoInsumo.id_producto
    WHERE  
      tipoCategoria = 'INSUMO'
        AND (GastoInsumo.fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "')
        AND GastoInsumo.tipo = 'faltante'
        AND GastoInsumo.gasto = 'no'
    GROUP BY nombreCategoria;
  ";
  $result2 = $conexion->query($sql2);
  while($row2 = $result2->fetch_array())
  {
    $response[$cont]['detalle'] = $row2['nombreCategoria'] . " = " . $row2['total'];
    $response[$cont]['tipo'] = 'detalle';
    $response[$cont]['key'] = $row2['nombreCategoria'];
    $cont++;
  }
  echo json_encode($response);
}

function detalleCategoria () {
  global $conexion;
  $response = [];
  $getSubcategoria = "SELECT * FROM `Categorias_Subcategorias` WHERE `nombreCategoria` LIKE '".$_POST['detalle']."' GROUP BY id_subcategoria";
  $resultX = $conexion->query($getSubcategoria);
  $cont = 0;
  while ($rowxd = $resultX->fetch_array()) {
     $sql = "
      SELECT `d`.`id` AS `id`,
          `d`.`cantidad` AS `cantidad`,
          `d`.`id_producto` AS `id_producto`,
          `d`.`precio_adquisicion` AS `precio_adquisicion`,
          `d`.`precio_venta` AS `precio_venta`,
          SUM(`d`.`importe`) AS `importe`,
          `d`.`tipo` AS `tipo`,
          `d`.`id_detalle` AS `idDetaelle`,
          `d`.`gasto` AS `gasto`,
          `c`.`fecha` AS `fecha` ,
          `p`.`nombre` AS `nombre_producto`,
          `p`.`id_subcategoria`
      FROM `detalle` `d` 
        join `qroodigo_VillaConin`.`corte_inventario` `c` ON `c`.`id_corte_inventario` = `d`.`id`
        join `qroodigo_VillaConin`.`producto` `p` ON `d`.`id_producto` = `p`.`id_producto`
      WHERE c.fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."'
        AND p.id_subcategoria = ".$rowxd['id_subcategoria']."
      GROUP BY d.id_producto
    ";
    $result = $conexion->query($sql);
    $cont = 0;
    while ($row = $result->fetch_array())
    {
      if ($row['importe'] !== 0) {
        $response[$cont]['detalle'] = $row['nombre_producto'] . " = ". $row['importe'];
        $response[$cont]['tipo'] = $row['nombre_producto'];
        $response[$cont]['key'] = 'Comentario';
        $cont++;
      }
    }
  }
  echo json_encode($response);  
}

function gastoOperativoDetalle () {
  global $conexion;
  $response = [];
    $sql = "SELECT 
        nombre, SUM(cantidad * precio_adquisicion) total FROM `comprasGenerales` WHERE fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' GROUP BY nombre";
  $result = $conexion->query($sql);
  $cont = 0;
  while ($row = $result->fetch_array())
  {
    $response[$cont]['detalle'] = $row['nombre'] . " = " .  $row['total'];
    $response[$cont]['tipo'] = 'detalle';
    $response[$cont]['key'] = 'Gasto operativo';
    $cont++;
  }
  echo json_encode($response);
}

function gastoActivoDetalle () {
  global $conexion;
  $response = [];
  $sql = "
    SELECT
        compra.fecha,
        cantidad,
        precio_adquisicion,
        precio_venta,
        importe,
        tipo,
        nombreCategoria categoria,
        nombre producto,
        descripcion,
        SUM(cantidad * precio_adquisicion) total
    FROM compra
    JOIN Compras ON compra.id_compra = Compras.id
    JOIN producto ON Compras.id_producto = producto.id_producto
    WHERE
      compra.fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "'
        AND Compras.tipo = 'compra'
        AND Compras.nombreCategoria != 'VINOS'
        AND Compras.tipoCategoria = 'ACTIVO'
    GROUP BY nombreCategoria
  ;";
  $result = $conexion->query($sql);
  $cont = 0;
  while ($row = $result->fetch_array())
  {
    $response[$cont]['fecha'] = $row['fecha'];
    $response[$cont]['cantidad'] = $row['cantidad'];
    $response[$cont]['precio_adquisicion'] = $row['precio_adquisicion'];
    $response[$cont]['precio_venta'] = $row['precio_venta'];
    $response[$cont]['importe'] = $row['importe'];
    $response[$cont]['detalle'] = $row['categoria'] . " = " . $row['total'];
    $response[$cont]['tipo'] = 'detalle';
    $response[$cont]['descripcion'] = $row['descripcion'];
    $response[$cont]['total'] = $row['total'];
    $response[$cont]['key'] = 'Gasto activo';
    $cont++;
  }

  $sql2 = "
    SELECT
      comprafac.fecha,
        cantidad,
        precio_adquisicion,
        precio_venta,
        importe,
        tipo,
        nombreCategoria categoria,
        nombre producto,
        descripcion,
        SUM(cantidad * precio_adquisicion) total
    FROM comprafac
    JOIN Compras_Facturadas ON comprafac.id_compra = Compras_Facturadas.id
    JOIN producto ON Compras_Facturadas.id_producto = producto.id_producto
    WHERE
      comprafac.fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "'
        AND Compras_Facturadas.tipo='comprafac' 
        AND Compras_Facturadas.nombreCategoria != 'VINOS'
        AND Compras_Facturadas.tipoCategoria='ACTIVO'
    GROUP BY nombreCategoria;";
  $result2 = $conexion->query($sql2);
  while ($row2 = $result2->fetch_array())
  {
    $response[$cont]['fecha'] = $row2['fecha'];
    $response[$cont]['cantidad'] = $row2['cantidad'];
    $response[$cont]['precio_adquisicion'] = $row2['precio_adquisicion'];
    $response[$cont]['precio_venta'] = $row2['precio_venta'];
    $response[$cont]['importe'] = $row2['importe'];
    $response[$cont]['detalle'] = $row2['categoria'] . " = " . $row2['total'];
    $response[$cont]['tipo'] = $row2['producto'];
    $response[$cont]['descripcion'] = $row2['descripcion'];
    $response[$cont]['total'] = $row2['total'];
    $cont++;
  }
  echo json_encode($response);
}

function detalleVentas () {
  global $conexion;
  $response = [];
  $sql = "SELECT * FROM venta WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' ";
  $result = $conexion->query($sql);
  $tt=0;
  while ($row = $result->fetch_array())
  {
    $sql2 = "SELECT * FROM detalle where tipo='venta' AND id=".$row['id_venta'];
    $result2 = $conexion->query($sql2);
    while ($d = $result2->fetch_array()) {
      $sql3 = "SELECT * FROM producto WHERE id_producto=".$d['id_producto'];
      $result3 = $conexion->query($sql3);
      $p = mysqli_fetch_array($result3);
      if($p['id_categoria']!='1') {
        $t=($d['cantidad']*($d['precio_venta']-$d['precio_adquisicion']));
        if($t>0) {       
          $tt+=$t;
        }     
      } 
    }
  }
  $response[0]['detalle'] = 'Ventas Generales = ' . $tt;
  $response[0]['tipo'] = "Ventas Generales";

  $sql2 = "SELECT SUM(Total) total FROM `tickets` WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' ";
  $result2 = $conexion->query($sql2);
  $totalVentaRecaudacion = mysqli_fetch_array($result2);
  $response[1]['detalle'] = "Ventas recaudación = " . $totalVentaRecaudacion['total'];
  $response[1]['tipo'] = "Ventas recaudación";

  $sql = "SELECT id_venta FROM venta WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' ";
    $result = $conexion->query($sql);
    $tt=0;
    while ($row = $result->fetch_array())
    {
      $totv=0;
      $sql2 = "SELECT cantidad, precio_venta, precio_adquisicion, id_producto FROM detalle where tipo='venta' AND id=".$row['id_venta'];
      $result2 = $conexion->query($sql2);
      while ($d = $result2->fetch_array()) 
      {
        $sql3 = "SELECT * FROM producto WHERE id_producto=".$d['id_producto'];
        $result3 = $conexion->query($sql3);
        $p = mysqli_fetch_array($result3);
        if($p['id_categoria']=='1')
        {  
          $t=($d['cantidad']*($d['precio_venta']-$d['precio_adquisicion']));
          if($t>0)
          {       
            $tt+=$t;
          }
        }
      }     
    }
     $response[2]['detalle'] = "Ventas vinos = " . $tt;
     $response[2]['tipo'] = "Ventas vinos";

  echo json_encode($response);
}

function detalleVentasRecaudacion() {
   global $conexion;
  $response = [];
  $sql2 = "SELECT referencia, SUM(Total) total FROM `tickets` WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' GROUP BY referencia";
  $result2 = $conexion->query($sql2);
  $cont = 0;
  while ($row2 = $result2->fetch_array())
  {
    $response[$cont]['detalle'] = $row2['referencia'] . " = " . $row2['total'];
    $response[$cont]['tipo'] = $row2['referencia'];
    $response[$cont]['key'] = 'Eventos Recaudacion';
    $cont++;
  }
  echo json_encode($response);
}

function detalleVentasVinos () {
  global $conexion;
  $response = [];
  $sql = "
    SELECT
      cantidad,
      precio_adquisicion,
      precio_venta,
      SUM((detalle.precio_venta - detalle.precio_adquisicion) * detalle.cantidad ) total,
      nombre producto,
      producto.descripcion detalle_producto
FROM venta
JOIN detalle ON venta.id_venta = detalle.id
JOIN producto ON detalle.id_producto = producto.id_producto
WHERE
  fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "'
  AND producto.id_categoria = 1
GROUP BY producto ";
  $result = $conexion->query($sql);
  if ($result->num_rows > 0) 
  {
    $cont = 0;
    while ($row = $result->fetch_array())
    {
      $response[$cont]['detalle'] =  $row['producto'] . "( " . $row['detalle_producto'] . ") = " . $row['total'];
      $response[$cont]['tipo'] =  $row['producto'];
      $cont++;
    }
  }
  echo json_encode($response);
}

function detalleGastoPersonal () {
  global $conexion;
  $response = [];
  $cont = 0;
  $sql2 = "
    SELECT 
      subcategoria.id_subcategoria,
      subcategoria.nombre,
      SUM( importe ) total 
    FROM  `vista_gasto_personal`
    JOIN producto ON vista_gasto_personal.id_producto = producto.id_producto
    JOIN subcategoria ON producto.id_subcategoria = subcategoria.id_subcategoria
    WHERE vista_gasto_personal.fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "'
    GROUP BY subcategoria.nombre
  ";
  $result2 = $conexion->query($sql2);
  while ($row2 = $result2->fetch_array())
  {
    $response[$cont]['tipo'] = $row2['nombre'];
    $response[$cont]['detalle'] = $row2['nombre']. " = " . $row2['total'];
    $response[$cont]['key'] = "Gastos Personales";
    $response[$cont]['tipo'] = "detalle";
    $cont++;
  }
  $sql = "
    SELECT 
      subcategoria.id_subcategoria,
      subcategoria.nombre,
      SUM( importe ) total 
    FROM  `vista_gasto_personal_facturado`
    JOIN producto ON vista_gasto_personal_facturado.id_producto = producto.id_producto
    JOIN subcategoria ON producto.id_subcategoria = subcategoria.id_subcategoria
    WHERE vista_gasto_personal_facturado.fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "'
    GROUP BY subcategoria.nombre
  ";
  $result = $conexion->query($sql);
  while ($row = $result->fetch_array())
  {
    $response[$cont]['tipo'] = $row['nombre'];
    $response[$cont]['detalle'] = $row['nombre'] . " = ". $row['total'];
    $response[$cont]['key'] = "Gastos Personales";
    $cont++;
  }
  echo json_encode($response);
}

function gastoOperativoDetalleSubcategoria () {
  global $conexion;
  $response = [];
  $sql = "
    SELECT 
        producto.nombre producto,
        producto.descripcion,
        cantidad,
        precio_adquisicion,
        SUM( cantidad * precio_adquisicion ) total 
    FROM ProductosCategoria 
    JOIN producto ON ProductosCategoria.id_producto = producto.id_producto JOIN subcategoria ON producto.id_subcategoria = subcategoria.id_subcategoria 
    WHERE tipo = 'compra' AND `tipoCategoria` = 'OPERATIVO' AND fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' AND subcategoria.nombre = '" . $_POST['detalle'] . "' GROUP BY producto.nombre";
  $result = $conexion->query($sql);
  if ($result->num_rows > 0) 
  {
    $cont = 0;
    while ($row = $result->fetch_array())
    {
      $response[$cont]['detalle'] =  $row['producto'] . "( " . $row['descripcion'] . ") = " . $row['total'];
      $response[$cont]['tipo'] =  $row['producto'];
      $response[$cont]['key'] =  'Comentario';
      $cont++;
    }
  }
  echo json_encode($response);
}

function gastoActivoDetalleSubcategoria () {
  global $conexion;
  $response = [];
  $sql = "
  SELECT 
        producto.nombre producto,
        producto.descripcion,
        cantidad,
        precio_adquisicion,
        SUM( cantidad * precio_adquisicion ) total 
    FROM ProductosCategoria 
    JOIN producto ON ProductosCategoria.id_producto = producto.id_producto JOIN subcategoria ON producto.id_subcategoria = subcategoria.id_subcategoria 
    WHERE tipo = 'compra'
        AND nombreCategoria = '" . $_POST['detalle'] . "'
        AND tipoCategoria = 'ACTIVO'
    AND fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' GROUP BY producto.nombre
    ";
  $result = $conexion->query($sql);
  if ($result->num_rows > 0) 
  {
    $cont = 0;
    while ($row = $result->fetch_array())
    {
      $response[$cont]['detalle'] =  $row['producto'] . "( " . $row['descripcion'] . ") = " . $row['total'];
      $response[$cont]['tipo'] =  $row['producto'];
      $response[$cont]['key'] =  'Comentario';
      $cont++;
    }
  }
  echo json_encode($response);
}
function gastoPersonalDetalleSubcategoria () {
  global $conexion;
  $response = [];
  $cont = 0;
  $sql2 = "
    SELECT
        subcategoria.id_subcategoria,
        subcategoria.nombre subcategoria,
        producto.nombre,
        producto.descripcion,
        SUM(importe) total 
    FROM `vista_gasto_personal`
    JOIN producto ON vista_gasto_personal.id_producto = producto.id_producto 
    JOIN subcategoria ON producto.id_subcategoria = subcategoria.id_subcategoria
    WHERE subcategoria.nombre = '" . $_POST['detalle'] . "' 
      AND  vista_gasto_personal.fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' 
    GROUP BY producto.nombre
  ";
  $result2 = $conexion->query($sql2);
  while ($row2 = $result2->fetch_array())
  {
    $response[$cont]['tipo'] = $row2['nombre'];
    $response[$cont]['key'] = 'Comentario';
    $response[$cont]['detalle'] = $row2['nombre'] . " = " . $row2['total'];
    $cont++;
  }
  echo json_encode($response);
}

function vinos()
  {
    global $conexion;
    $response = [];
    $totalVinos=0;
    $sql = "SELECT * FROM subcategoria WHERE id_categoria=1 ORDER BY nombre";
    $result = $conexion->query($sql);
      while($row = $result->fetch_array())
      {
        
        $totalCategoria=0;
        $sql2 = "SELECT * FROM producto where id_subcategoria=".$row['id_subcategoria']." ORDER BY nombre ";
        $result2 = $conexion->query($sql2);
        while($p = $result2->fetch_array())
        {
          $t=buscaVinos($p['id_producto']);                           
          $totalCategoria+=$t;              
        }
        $totalVinos+=$totalCategoria;
        
      }
  echo json_encode(money_format("%i",$totalVinos));

  }
  function buscaVinos($id)
  {
    global $conexion;
       // INICIALIZAMOS LAS VARIABLES 
    $c=0;//COMPRAS
    $cf=0;// COMPRAS FACTURADAS
    $e=0; // ENTRADAS
    $s=0;  // SALIDAS
    $v=0; // VENTAS
    $f=0; ///faltante corte de inventario
    // BUSCAMOS DE LA TABLA DETALLE TODAS LAS COMPRAS, COMPRAS FAC Y ENTRADAS  DE ESE PRODUCTO

     // $c=->fetch_array()($conexion->query("SELECT SUM(`cantidad`) AS c FROM `detalle` WHERE `tipo`='compra' and `id_producto`=".$id));
     $c = $conexion->query("SELECT SUM(`cantidad`) AS c FROM `detalle` WHERE `tipo`='compra' and `id_producto`=".$id); //usamos la conexion para dar un resultado a la variable
    $c = mysqli_fetch_array($c);
    // $cf=->fetch_array()($conexion->query("SELECT SUM(`cantidad`) AS cf FROM `detalle` WHERE `tipo`='comprafac' and `id_producto`=".$id));
    $cf = $conexion->query("SELECT SUM(`cantidad`) AS cf FROM `detalle` WHERE `tipo`='comprafac' and `id_producto`=".$id); //usamos la conexion para dar un resultado a la variable
    $cf = mysqli_fetch_array($cf);
    // $e=->fetch_array()($conexion->query("SELECT SUM(`cantidad`) AS e FROM `detalle` WHERE `tipo`='entrada' and `id_producto`=".$id));
    $e = $conexion->query("SELECT SUM(`cantidad`) AS e FROM `detalle` WHERE `tipo`='entrada' and `id_producto`=".$id); //usamos la conexion para dar un resultado a la variable
    $e = mysqli_fetch_array($e);

    //  BUSCAMOS TODAS LAS SALIDAS Y VENTAS DE LA TABLA DETALLE DE EL PRODUCTO EN TURNO
    //$s=->fetch_array()($conexion->query("SELECT SUM(`cantidad`) AS s FROM `detalle` WHERE `tipo`='salida' and `id_producto`=".$id));
    $s = $conexion->query("SELECT SUM(`cantidad`) AS s FROM `detalle` WHERE `tipo`='salida' and `id_producto`=".$id); //usamos la conexion para dar un resultado a la variable
    $s = mysqli_fetch_array($s);
    // $v=->fetch_array()($conexion->query("SELECT SUM(`cantidad`) AS v FROM `detalle` WHERE `tipo`='venta' and `id_producto`=".$id));
    $v = $conexion->query("SELECT SUM(`cantidad`) AS v FROM `detalle` WHERE `tipo`='venta' and `id_producto`=".$id); //usamos la conexion para dar un resultado a la variable
    $v = mysqli_fetch_array($v);
    // $f=->fetch_array()($conexion->query("SELECT SUM(`cantidad`) AS f FROM `detalle` WHERE `tipo`='faltante' and `id_producto`=".$id));
    $f = $conexion->query("SELECT SUM(`cantidad`) AS f FROM `detalle` WHERE `tipo`='faltante' and `id_producto`=".$id); //usamos la conexion para dar un resultado a la variable
    $f = mysqli_fetch_array($f);

    // LA IVERSION ACTUAL DE VINOS SE CALCULARIA CON LA SUMATORIA DE ENTRADAS,COMPRAS Y COMPRAS FAC MENOS LA SUMATORIA DE VENTAS Y SALIDAS POR PRODUCTO EN TURNO..
    
    $total=($c['c']+$cf['cf']+$e['e'])-($s['s']+$v['v'])+$f['f'];
    // $ucosto=->fetch_array()($conexion->query("select * from inventario where id_producto=".$id));
    $ucosto = $conexion->query("SELECT * from inventario where id_producto=".$id);
    $ucosto = mysqli_fetch_array($ucosto);
    $total=$total*$ucosto["precio"];
    
    return $total;
  }

function Inversion() {
  global $conexion;
  $response = [];
  $tgp=0;
          $ttp2=0;    
          // $catt=$conexion->query("SELECT nombreSubcategoria,id_subcategoria FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' GROUP BY nombreSubcategoria");
          $result = $conexion->query("SELECT nombreSubcategoria,id_subcategoria FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' GROUP BY nombreSubcategoria");
          while($ct = $result->fetch_array())
          {
            $tsub=0;
            $cf=$conexion->query("SELECT * FROM Compras WHERE tipo='compra' AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ");
            while ($cfa= $cf->fetch_array())
            {
              $p=$conexion->query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND  id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
              while ($pr = $p->fetch_array())
              {               
                  $tsub+=($cfa['cantidad']*$cfa['precio_adquisicion']);
                $tgp+=$tsub;
              }
            }
            $ttp2 +=$tsub;            
                    $t=0;  // COMPRAS 
            $cf=$conexion->query("SELECT * FROM Compras WHERE tipo='compra' AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ");
            while ($cfa= $cf->fetch_array())
            {
              $p=$conexion->query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
              while ($pr=$p->fetch_array())
              {                     
                $t+=($cfa['cantidad']*$cfa['precio_adquisicion']);                                       
              }
            }
          }
          $nc=$conexion->query("SELECT Total_nomina, fecha FROM Confirmacion_Nomina_Construccion WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
            $tt=0;
            $tEm=0;
            $tEmp=0;
            while($nco= $nc->fetch_array())
            { 
              $t=explode(",",$nco['Total_nomina']);
              for ($i=1; $i <count($t); $i++) { 
                $tt+=$t[$i];
              }
            }
            $tEm+=$tt;            
           $nc=$conexion->query("SELECT puntos, fecha FROM Confirmacion_Nomina_Construccion WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
            $ttp=0;           
            $ttpp=0;
            while($nco= $nc->fetch_array())
            { 
              $t=explode(",",$nco['puntos']);
              for ($i=1; $i <count($t); $i++) { 
                $ttp+=$t[$i];
              }
            }
            $ttpp+=$ttp;
            $tEmp+=$ttp;            
            $tttggi = $ttp2+$ttpp+$tEm;                
      //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////77
                 $tgif=0;          
          $catt=$conexion->query("SELECT nombreSubcategoria,id_subcategoria FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' GROUP BY nombreSubcategoria");
          while($ct= $catt->fetch_array())
          {
            $tsub=0;
            $cf=$conexion->query("SELECT * FROM Compras_Facturadas WHERE tipo='comprafac' AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ");
            while ($cfa= $cf->fetch_array())
            {
              $p=$conexion->query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND  id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
              while ($pr= $p->fetch_array())
              {               
                  $tsub+=($cfa['cantidad']*$cfa['precio_adquisicion']);               
              }
            }           
                          $t=0;  // COMPRAS 
                  $cf=$conexion->query("SELECT * FROM Compras_Facturadas WHERE tipo='comprafac' AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ");
                  while ($cfa= $cf->fetch_array())
                  {
                    $p=$conexion->query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
                    while ($pr= $p->fetch_array())
                    {                     
                      $t+=($cfa['cantidad']*$cfa['precio_adquisicion']);                                
                    }
                  }
                  $tgif+=$t;
          }            
      echo json_encode(money_format("%i",($tttggi + $tgif )));
}

function getProducts () {
  global $conexion;
  $response = [];
  $cont = 0;
  $sql = "
    SELECT
        producto.id_producto,
        producto.nombre producto,
        producto.descripcion producto_descripcion,
        categoria.nombre categoria,
        categoria.descripcion 'descripcion_categoria',
        subcategoria.nombre subcategoria,
        subcategoria.descripcion 'descripcion_subcategoria',
        productComment.comment
    FROM `producto`
    LEFT JOIN productComment ON productComment.id_producto = producto.id_producto
    JOIN categoria ON categoria.id_categoria = producto.id_categoria
    JOIN subcategoria ON subcategoria.id_subcategoria = producto.id_subcategoria
    GROUP BY producto.id_producto";
  $result = $conexion->query($sql);
  while ($row2 = $result->fetch_array())
  {
    $response[$cont]['value'] = $row2['producto'];
    $response[$cont]['id_producto'] = $row2['id_producto'];
    $response[$cont]['producto_descripcion'] = $row2['producto_descripcion'];
    $response[$cont]['categoria'] = $row2['categoria'];
    $response[$cont]['descripcion_categoria'] = $row2['descripcion_categoria'];
    $response[$cont]['subcategoria'] = $row2['subcategoria'];
    $response[$cont]['descripcion_subcategoria'] = $row2['descripcion_subcategoria'];
    $response[$cont]['comment'] = $row2['comment'];
    $cont++;
  }
  echo json_encode($response);
}

function addComment () {
  global $conexion;
  $sql0 = "DELETE FROM productComment WHERE id_producto = ".$_POST['id_producto'];
  $conexion->query($sql0);
  $sql = "INSERT INTO productComment (id_producto, comment) VALUES (". $_POST['id_producto'] .", '" . $_POST['comment'] . "')";
  echo $conexion->query($sql);
  
}

function getComment () {
  global $conexion;
  $response = [];
  $sql = "SELECT
            productComment.comment 
          FROM `producto`
          JOIN productComment on productComment.id_producto = producto.id_producto 
          WHERE nombre = '" . $_POST['detalle'] . "'";
  $result2 = $conexion->query($sql);
  $comment = mysqli_fetch_array($result2);
  $response[0]['tipo'] = $comment['comment'];
  $response[0]['detalle'] = 'Comentario: '. $comment['comment'];
  echo json_encode($response);
}

$conexion->close(); //cerramos la conexión
?>