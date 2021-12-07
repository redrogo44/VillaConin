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

$opcion = $_POST['opcion'];
// $opcion = 'numeroEventos';
$feha1 = $_POST['fecha1'];
// $fecha1 = '2019-01-01';
$feha2 = $_POST['fecha2'];
// $fecha2 = '2019-02-01';

switch ($opcion) {
  case 'numeroEventos2':
    numeroEventos2();
    break;
  case 'numeroEventos':
    numeroEventos();
    break;
  case 'numeroComensales':
    numeroComensales();
    break;
  case 'totalCobrado':
    totalCobrado();
    break;
  case 'eventosAdicionales':
    eventosAdicionales();
    break;
  case 'eventosRecaudacion':
    eventosRecaudacion();
    break;
  case 'ventaVinos':
    ventaVinos();
    break;
  case 'ventas':
    ventas();
    break;
  case 'gastoInsumo':
    gastoInsumo();
    # code...
    break;
  case 'gastoActivo':
    gastoActivo();
    break;
  case 'gastoOperativo':
    gastoOperativo();
    break;
  case 'nomina':
    nomina();
    break;
  case 'premioDeLealtad':
    premioDeLealtad();
    break;
  case 'gastoPersonal':
    gastoPersonal();
    break;
  case 'numeroEventosDetalle':
    numeroEventosDetalle();
    break;
  case 'eventosAdicionalesDetalle':
    eventosAdicionalesDetalle();
    break;
  case 'eventosRecaudacionDetalle':
    eventosRecaudacionDetalle();
    break;
  case 'totalCobradoDetalle':
    detalleTotalCobrado();
    break;
  case 'ventaVinosDetalle':
    ventaVinosDetalle();
    break;
  case 'gastoInsumoDetalle2':
    gastoInsumoDetalle();
    break;
  case 'gastoActivoDetalle':
    gastoActivoDetalle();
    break;
  case 'detalleGastoOperativo2':
    gastoOperativoDetalle();
    break;
  case 'detalleGastoPersonal':
    detalleGastoPersonal();
    break;
  case 'detalleComensalesComensales':
    detalleComensalesComensales();
    break;
  case 'detalleComensalesCargo':
    detalleComensalesCargo();
    break;
  case 'detalleComensalesCargosFacturados':
    detalleComensalesCargosFacturados();
    break;
  case 'detalleCobradoContratos':
    detalleCobradoContratos();
    break;
  case 'gastoInsumoDetalle':
    gastoInsumoDetalle2();
    break;
  case 'detalleGastoPersonalSubcategoria':
    detalleGastoPersonalSubcategoria();
    break;
  case 'detalleGastoPersonal2':
    detalleGastoPersonal2();
    break;
  case 'gastoOperativoDetalle':
    detalleGastoOperativo2();
    # code...
    break;
  case 'numeroComensalesDetalle':
    numeroComensalesDetalle();
    # code...
    break;
  case 'detalle-producto':
    detalleProducto();
    break;
  default:
}

function numeroEventos2 () {
  global $conexion;
  $response = [];
  $totalEventos=0;
  $sql = "SELECT COUNT( Numero ) AS t FROM contrato WHERE Fecha >=  '" . $_POST['fecha1'] . "' AND Fecha <=  '" . $_POST['fecha2'] . "' AND tipo!='MOSTRADOR' AND LENGTH(Numero) <= 8; ";
  // $sql = "SELECT MONTH(Fecha) Mes, COUNT(*) total FROM `contrato` WHERE Fecha >= '2019-01-01' GROUP BY Mes";
  $result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
  $totalEventos = mysqli_fetch_array($result);
  if ($totalEventos['t'] > 0)
  {
    echo $totalEventos['t'];
  } else {
    echo 0;
  }
}

function numeroEventos () {
  global $conexion;
  $response = [];
  $totalEventos=0;
  $sql = "SELECT COUNT( Numero ) AS t FROM contrato WHERE Fecha >=  '" . $_POST['fecha1'] . "' AND Fecha <=  '" . $_POST['fecha2'] . "' AND tipo!='MOSTRADOR' AND LENGTH(Numero) <= 8; ";
  // $sql = "SELECT MONTH(Fecha) Mes, COUNT(*) total FROM `contrato` WHERE Fecha >= '2019-01-01' GROUP BY Mes";
  $result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
  $totalEventos = mysqli_fetch_array($result);
  if ($totalEventos['t'] > 0)
  {
    echo $totalEventos['t'];
  } else {
    echo 0;
  }
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

function ventaVinos() {
    global $conexion;
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
    echo $tt;
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
  echo $tt;
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

function gastoOperativo () {
  global $conexion;
  $ttFcturado=0;
  $array = array('Compras', 'Compras_Facturadas');
  // foreach ($array as &$valor) {
  // }
  $sql = "SELECT * 
            FROM  Compras
            WHERE tipoCategoria = 'OPERATIVO'
            GROUP BY nombreCategoria
            ORDER BY nombreCategoria ";
    $result = $conexion->query($sql);
    while ($row = $result->fetch_array())
    {
      $sql2 = "SELECT id_subcategoria
               FROM Categorias_Subcategorias
               WHERE tipoCategoria='OPERATIVO' 
               AND id_categoria = ".$row['id_categoria']."
               GROUP BY nombreSubcategoria";
      $result2 = $conexion->query($sql2);
      while ($row2 = $result2->fetch_array())
      {
        $sql3 = "SELECT id_producto FROM Categorias_Subcategorias WHERE id_subcategoria = " . $row2['id_subcategoria'];
        $result3 = $conexion->query($sql3);
        while ($row3 = $result3->fetch_array()) {
          $sql4 = "SELECT
                      SUM( cantidad * precio_adquisicion ) T
                   FROM Compras
                   WHERE tipo = 'compra'
                        AND `tipoCategoria` =  'OPERATIVO'
                        AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."'
                        AND id_producto =".$row3['id_producto'];
           $result4 = $conexion->query($sql4);
           while ($row4 = $result4->fetch_array()) {
            $ttFcturado += $row4['T'];
           }
        } 
      }
    }
    $sql = "SELECT * 
            FROM  Compras_Facturadas
            WHERE tipoCategoria = 'OPERATIVO'
            GROUP BY nombreCategoria
            ORDER BY nombreCategoria ";
    $result = $conexion->query($sql);
    while ($row = $result->fetch_array())
    {
      $sql2 = "SELECT id_subcategoria
               FROM Categorias_Subcategorias
               WHERE tipoCategoria='OPERATIVO' 
               AND id_categoria = ".$row['id_categoria']."
               GROUP BY nombreSubcategoria";
      $result2 = $conexion->query($sql2);
      while ($row2 = $result2->fetch_array())
      {
        $sql3 = "SELECT id_producto FROM Categorias_Subcategorias WHERE id_subcategoria = " . $row2['id_subcategoria'];
        $result3 = $conexion->query($sql3);
        while ($row3 = $result3->fetch_array()) {
          $sql4 = "SELECT
                      SUM( cantidad * precio_adquisicion ) T
                   FROM Compras_Facturadas
                   WHERE tipo = 'comprafac'
                        AND `tipoCategoria` =  'OPERATIVO'
                        AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."'
                        AND id_producto =".$row3['id_producto'];
           $result4 = $conexion->query($sql4);
           while ($row4 = $result4->fetch_array()) {
            $ttFcturado += $row4['T'];
           }
        } 
      }
    }

  echo $ttFcturado;
}
function nomina () {
  global $conexion;
  /*
  SEPARAMOS EL REGISTRO DE MESEROS 
  RECORDANDO QUE: 
  LA POSICION 0 ES EL ID DEL MESERO
  LA POSICION 1 ES EL ID DE LA CATEGORIA
  LA POSISION 2 ES EL PAGO POR EVENTO
  Y LA POSICION 3 SON LOS PUNTOS
  */
  $totalMeseros = 0;
  $array = array('MeserosContrato', 'MeserosAdicionales');
  foreach ($array as &$valor) {
    $sql = "SELECT * FROM " . $valor . " WHERE Fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ";
    $result = $conexion->query($sql);
    while ($row = $result->fetch_array()) {
      $m=explode(",", $row['meseros']);
      for ($i=1; $i <count($m) ; $i++) 
      { 
        $me=explode("-", $m[$i]);
        $totalMeseros += $me[2];
      }
    }
  }
  echo $totalMeseros;
} 

function premioDeLealtad () {
  global $conexion;
  /*
  SEPARAMOS EL REGISTRO DE MESEROS 
  RECORDANDO QUE: 
  LA POSICION 0 ES EL ID DEL MESERO
  LA POSICION 1 ES EL ID DE LA CATEGORIA
  LA POSISION 2 ES EL PAGO POR EVENTO
  Y LA POSICION 3 SON LOS PUNTOS
  */
  $totalMeseros = 0;
  $array = array('MeserosContrato', 'MeserosAdicionales');
  foreach ($array as &$valor) {
    $sql = "SELECT * FROM " . $valor . " WHERE Fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ";
    $result = $conexion->query($sql);
    while ($row = $result->fetch_array()) {
      $m=explode(",", $row['meseros']);
      for ($i=1; $i <count($m) ; $i++) 
      { 
        $me=explode("-", $m[$i]);
        $totalMeseros += $me[3];
      }
    }
  }
  echo $totalMeseros;
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

function gastoInventario () {
  global $conexion;
  foreach ($array as &$valor) {
    $sql = "SELECT * FROM " . $valor . " WHERE Fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ";
    $result = $conexion->query($sql);
    while ($row = $result->fetch_array()) {
      $m=explode(",", $row['meseros']);
      for ($i=1; $i <count($m) ; $i++) 
      { 
        $me=explode("-", $m[$i]);
      }
    }
  }

  $sql = "SELECT * FROM Compras WHERE tipo='compra' AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ";
  $result = $conexion->query($sql);
  while ($row = $result->fetch_array()) {
  }

  $tgp=0;
          $ttp2=0;    
          $catt=mysql_query("SELECT nombreSubcategoria,id_subcategoria FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' GROUP BY nombreSubcategoria");
          while($ct=mysql_fetch_array($catt))
          {
            $tsub=0;
            $cf=mysql_query("SELECT * FROM Compras WHERE tipo='compra' AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ");
            while ($cfa=mysql_fetch_array($cf) )
            {
              $p=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND  id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
              while ($pr=mysql_fetch_array($p) )
              {               
                  $tsub+=($cfa['cantidad']*$cfa['precio_adquisicion']);
                $tgp+=$tsub;
              }
            }
            $ttp2 +=$tsub;            
                    $t=0;  // COMPRAS 
            $cf=mysql_query("SELECT * FROM Compras WHERE tipo='compra' AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ");
            while ($cfa=mysql_fetch_array($cf) )
            {
              $p=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
              while ($pr=mysql_fetch_array($p) )
              {                     
                $t+=($cfa['cantidad']*$cfa['precio_adquisicion']);                                       
              }
            }
          }
          $nc=mysql_query("SELECT Total_nomina, fecha FROM Confirmacion_Nomina_Construccion WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
            $tt=0;
            $tEm=0;
            while($nco=mysql_fetch_array($nc))
            { 
              $t=explode(",",$nco['Total_nomina']);
              for ($i=1; $i <count($t); $i++) { 
                $tt+=$t[$i];
              }
            }
            $tEm+=$tt;            
           $nc=mysql_query("SELECT puntos, fecha FROM Confirmacion_Nomina_Construccion WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."' AND confirmado='si' ");
            $ttp=0;           
            $ttpp=0;
            while($nco=mysql_fetch_array($nc))
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
          $catt=mysql_query("SELECT nombreSubcategoria,id_subcategoria FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' GROUP BY nombreSubcategoria");
          while($ct=mysql_fetch_array($catt))
          {
            $tsub=0;
            $cf=mysql_query("SELECT * FROM Compras_Facturadas WHERE tipo='comprafac' AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ");
            while ($cfa=mysql_fetch_array($cf) )
            {
              $p=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND  id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
              while ($pr=mysql_fetch_array($p) )
              {               
                  $tsub+=($cfa['cantidad']*$cfa['precio_adquisicion']);               
              }
            }           
                          $t=0;  // COMPRAS 
                  $cf=mysql_query("SELECT * FROM Compras_Facturadas WHERE tipo='comprafac' AND fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ");
                  while ($cfa=mysql_fetch_array($cf) )
                  {
                    $p=mysql_query("SELECT * FROM Categorias_Subcategorias WHERE tipoCategoria='INVERSION' AND id_producto=".$cfa['id_producto']." AND id_subcategoria=".$ct['id_subcategoria']);
                    while ($pr=mysql_fetch_array($p) )
                    {                     
                      $t+=($cfa['cantidad']*$cfa['precio_adquisicion']);                                
                    }
                  }
                  $tgif+=$t;
          }            
          echo  ($tttggi + $tgif );
}

function numeroEventosDetalle () {
  global $conexion;
  $response = [];
  $sql = "SELECT Numero, nombre, tipo, salon, Fecha FROM `contrato` WHERE Fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' AND tipo <> 'MOSTRADOR'";
  $result = $conexion->query($sql);
  $cont = 0;
  while ($row = $result->fetch_array()) {
    $response[$cont]['contrato'] =  utf8_decode($row['Numero']);
    $response[$cont]['fecha'] =  utf8_decode($row['Fecha']);
    $response[$cont]['nombre'] =  utf8_decode($row['nombre']);
    $response[$cont]['tipo'] =  utf8_encode(utf8_decode($row['tipo']));
    $response[$cont]['salon'] =  utf8_decode($row['salon']);
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
      $response[$cont]['contrato'] =  $row['Numero'];
      $response[$cont]['fecha'] =  $row['Fecha'];
      $response[$cont]['tipo'] =  $row['tipo'];
      $response[$cont]['salon'] =  $row['salon'];
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
      $response[$cont]['contrato'] =  $row['Numero'];
      $response[$cont]['fecha'] =  $row['fecha'];
      $response[$cont]['referencia'] =  $row['referencia'];
      $response[$cont]['salon'] =  $row['salon'];
      $cont++;
    }
  }
  echo json_encode($response);
}

function detalleTotalCobrado () {
 global $conexion;
 $response = [];
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
  $response[0]['tipo'] = 'Contratos';
  $response[0]['total'] = ($totalContrato['si'] - $totalContrato['devolucion']);
  $response[1]['tipo'] = 'Cargos';
  $response[1]['total'] = $totalCargos['total'];
  $response[2]['tipo'] = 'Cargos facturados';
  $response[2]['total'] = $totalCargosFac['total'];
  echo json_encode($response);
}

function ventaVinosDetalle () {
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
      $response[$cont]['cantidad'] =  $row['cantidad'];
      $response[$cont]['precio_adquisicion'] =  $row['precio_adquisicion'];
      $response[$cont]['precio_venta'] =  $row['precio_venta'];
      $response[$cont]['total'] =  $row['total'];
      $response[$cont]['tipo'] =  $row['producto'];
      $response[$cont]['detalle_producto'] =  $row['detalle_producto'];
      $cont++;
    }
  }
  echo json_encode($response);
}

function gastoInsumoDetalle () {
  global $conexion;
  $response = [];
  $sql = "
    SELECT
      cantidad,
      precio_adquisicion,
      precio_venta,
      importe,
      tipo,
      nombre producto,
      descripcion,
      SUM((cantidad*precio_adquisicion)*-1) totalInumos 
  FROM GastoInsumo
  JOIN producto ON GastoInsumo.id_producto = producto.id_producto
  WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "' 
  AND `tipo`='faltante' 
  AND `gasto`='no'
  AND GastoInsumo.id_producto
  IN (
      SELECT Categorias_Subcategorias.id_producto
      FROM Categorias_Subcategorias
      WHERE id_categoria in ('".$_POST['detalle']."')
  )
  GROUP BY producto;";
  $result = $conexion->query($sql);
  if ($result->num_rows > 0) 
  {
    $cont = 0;
    while ($row = $result->fetch_array())
    {
      $response[$cont]['cantidad'] =  $row['cantidad'];
      $response[$cont]['precio_adquisicion'] =  $row['precio_adquisicion'];
      $response[$cont]['precio_venta'] =  $row['precio_venta'];
      $response[$cont]['importe'] =  $row['importe'];
      $response[$cont]['tipo'] =  $row['tipo'];
      $response[$cont]['producto'] =  $row['producto'];
      $response[$cont]['descripcion'] =  $row['descripcion'];
      $response[$cont]['totalInumos'] =  $row['totalInumos'];
      $cont++;
    }
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
    GROUP BY compra.id_compra
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
    $response[$cont]['categoria'] = $row['categoria'];
    $response[$cont]['tipo'] = $row['producto'];
    $response[$cont]['descripcion'] = $row['descripcion'];
    $response[$cont]['total'] = $row['total'];
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
    GROUP BY id;";
  $result2 = $conexion->query($sql2);
  while ($row2 = $result2->fetch_array())
  {
    $response[$cont]['fecha'] = $row2['fecha'];
    $response[$cont]['cantidad'] = $row2['cantidad'];
    $response[$cont]['precio_adquisicion'] = $row2['precio_adquisicion'];
    $response[$cont]['precio_venta'] = $row2['precio_venta'];
    $response[$cont]['importe'] = $row2['importe'];
    $response[$cont]['categoria'] = $row2['categoria'];
    $response[$cont]['tipo'] = $row2['producto'];
    $response[$cont]['descripcion'] = $row2['descripcion'];
    $response[$cont]['total'] = $row2['total'];
    $cont++;
  }
  echo json_encode($response);
}

function gastoOperativoDetalle () {
  global $conexion;
  $response = [];
  $sql = "
   SELECT
  cantidad,
    precio_adquisicion,
    precio_venta,
    importe,
    nombre producto,
    descripcion,
    SUM( cantidad * precio_adquisicion ) total
    FROM Compras
    JOIN producto ON Compras.id_producto = producto.id_producto
    WHERE tipo = 'compra'
    AND `tipoCategoria` =  'OPERATIVO'
    AND fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "'
    GROUP BY Compras.id_producto;";
  $result = $conexion->query($sql);
  $cont = 0;
  while ($row = $result->fetch_array())
  {
    $response[$cont]['cantidad'] = $row['cantidad'];
    $response[$cont]['precio_adquisicion'] = $row['precio_adquisicion'];
    $response[$cont]['precio_venta'] = $row['precio_venta'];
    $response[$cont]['importe'] = $row['importe'];
    $response[$cont]['producto'] = $row['producto'];
    $response[$cont]['descripcion'] = $row['descripcion'];
    $response[$cont]['total'] = $row['total'];
    $cont++;
  }

  $sql2 = "
  SELECT
  cantidad,
    precio_adquisicion,
    precio_venta,
    importe,
    nombre producto,
    descripcion,
  SUM( cantidad * precio_adquisicion ) total
FROM Compras_Facturadas
JOIN producto ON Compras_Facturadas.id_producto = producto.id_producto
WHERE tipo = 'comprafac'
AND `tipoCategoria` =  'OPERATIVO'
AND fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "'
GROUP BY Compras_Facturadas.id_producto;
  ";
  $result2 = $conexion->query($sql2);
  while ($row2 = $result2->fetch_array())
  {
    $response[$cont]['cantidad'] = $row2['cantidad'];
    $response[$cont]['precio_adquisicion'] = $row2['precio_adquisicion'];
    $response[$cont]['precio_venta'] = $row2['precio_venta'];
    $response[$cont]['importe'] = $row2['importe'];
    $response[$cont]['producto'] = $row2['producto'];
    $response[$cont]['descripcion'] = $row2['descripcion'];
    $response[$cont]['total'] = $row2['total'];
    $cont++;
  }
  echo json_encode($response);
}

function detalleGastoPersonal () {
  global $conexion;
  $response = [];
  $cont = 0;
  if ($_POST['detalle2'] === "Tipo A") {
      $sql2 = "
      SELECT
        nombre,
        descripcion,
        fecha,
        'no' facturado,
        importe
    FROM  `vista_gasto_personal`
    JOIN producto ON vista_gasto_personal.id_producto = producto.id_producto
    WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "'
        AND producto.id_subcategoria = " . intval($_POST['detalle']);
    $result2 = $conexion->query($sql2);
    while ($row2 = $result2->fetch_array())
    {
      $response[$cont]['nombre'] = $row2['nombre'];
      $response[$cont]['descripcion'] = $row2['descripcion'];
      $response[$cont]['fecha'] = $row2['fecha'];
      $response[$cont]['facturado'] = $row2['facturado'];
      $response[$cont]['importe'] = $row2['importe'];
      $cont++;
    }
  }
  if ($_POST['detalle2'] === "Tipo B") {
      $sql = "
      SELECT
        nombre,
        descripcion,
        fecha,
        'si' facturado,
        importe
    FROM  `vista_gasto_personal_facturado`
    JOIN producto ON vista_gasto_personal_facturado.id_producto = producto.id_producto
    WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "'
        AND producto.id_subcategoria = " .intval($_POST['detalle']);
    $result = $conexion->query($sql);
    while ($row = $result->fetch_array())
    {
      $response[$cont]['nombre'] = $row['nombre'];
      $response[$cont]['descripcion'] = $row['descripcion'];
      $response[$cont]['fecha'] = $row['fecha'];
      $response[$cont]['facturado'] = $row['facturado'];
      $response[$cont]['importe'] = $row['importe'];
      $cont++;
    }
  }

  echo json_encode($response);
}

function numeroComensalesDetalle () {
  global $conexion;
  $response = [];
  $sql = "  
      SELECT
        SUM(c_adultos) adultos,
        SUM(c_jovenes) jovenes,
        SUM(c_ninos) ninos
      FROM contrato
      WHERE Fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "';
  ";
  $result = $conexion->query($sql);
  $row = mysqli_fetch_array($result);

  $sql2 = "  
      SELECT
        SUM(total_adultos) adultos,
        SUM(total_jovenes) jovenes,
        SUM(total_ninos) ninos
      FROM cargos_new
      WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "';
  ";
  $result2 = $conexion->query($sql2);
  $row2 = mysqli_fetch_array($result2);

  $sql3 = "  
      SELECT
        SUM(total_adultos) adultos,
        SUM(total_jovenes) jovenes,
        SUM(total_ninos) ninos
      FROM cargos_facturados_new
      WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "';
  ";
  $result3 = $conexion->query($sql3);
  $row3 = mysqli_fetch_array($result3);

  $response[0]['tipo'] = 'Adultos';
  $response[0]['total'] = $row['adultos'] + $row2['adultos'] + $row3['adultos'];
  $response[1]['tipo'] = 'Jovenes';
  $response[1]['total'] = $row['jovenes'] + $row2['jovenes'] + $row3['jovenes'];
  $response[2]['tipo'] = utf8_encode('Niños');
  $response[2]['total'] = $row['ninos'] + $row2['ninos'] + $row3['ninos'];
  echo json_encode($response);
  // echo $sql;
}

function detalleComensalesCargo () {
  global $conexion;
  $response = [];
  $sql = "  
      SELECT
        SUM(total_adultos) adultos,
        SUM(total_jovenes) jovenes,
        SUM(total_ninos) ninos
      FROM cargos_new
      WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "';
  ";
  $result = $conexion->query($sql);
  $row = mysqli_fetch_array($result);
  $response['adultos'] = $row['adultos'];
  $response['jovenes'] = $row['jovenes'];
  $response['ninos'] = $row['ninos'];
  $response['facturado'] = 'no';
  echo json_encode($response);
}

function detalleComensalesCargosFacturados () {
  global $conexion;
  $response = [];
   $sql2 = "  
      SELECT
        SUM(total_adultos) adultos,
        SUM(total_jovenes) jovenes,
        SUM(total_ninos) ninos
      FROM cargos_facturados_new
      WHERE fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "';
  ";
  $result2 = $conexion->query($sql2);
  $row2 = mysqli_fetch_array($result2);
  $response['adultos'] = $row2['adultos'];
  $response['jovenes'] = $row2['jovenes'];
  $response['ninos'] = $row2['ninos'];
  $response['facturado'] = 'si';
  echo json_encode($response);
}

function detalleCobradoContratos () {
global $conexion;
  $response = [];
  $cont = 0;
  $sql2 = "
    SELECT
        contrato.Numero,
        si,
        IFNULL(TDevoluciones.Total, 0 ) devolucion,
        IFNULL(SUM(cargos_new.total), 0 ) cargos,
        IFNULL(SUM(cargos_facturados_new.total), 0 ) cargos_Facturados
    FROM contrato
    LEFT JOIN cargos_facturados_new ON contrato.Numero = cargos_facturados_new.contrato
    LEFT JOIN cargos_new ON contrato.Numero = cargos_new.contrato
    LEFT JOIN TDevoluciones on contrato.Numero = TDevoluciones.Numero
    WHERE contrato.Fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "'
    AND contrato.tipo!='MOSTRADOR' AND LENGTH(contrato.Numero)<=8
    GROUP BY contrato.Numero;
  ";
  $result2 = $conexion->query($sql2);
  while ($row2 = $result2->fetch_array())
  {
    $response[$cont]['contrato'] = $row2['Numero'];
    $response[$cont]['devolucion'] = $row2['devolucion'];
    $response[$cont]['saldo_inicial'] = $row2['si'];
    $response[$cont]['cargos'] = $row2['cargos'];
    $response[$cont]['cargos_Facturados'] = $row2['cargos_Facturados'];
    $response[$cont]['total'] = $row2['cargos_Facturados'] + $row2['cargos'] + $row2['si'] - $row2['devolucion'];
    $cont++;
  }
  echo json_encode($response);
}

function gastoInsumoDetalle2 () {
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
    $response[$cont]['id_categoria'] = $row2['id_categoria'];
    $response[$cont]['tipo'] = $row2['nombreCategoria'];
    $response[$cont]['total'] = $row2['total'];
    $cont++;
  }
  echo json_encode($response);
}

function detalleGastoPersonal2 () {
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
    $response[$cont]['id_subcategoria'] = $row2['id_subcategoria'];
    $response[$cont]['gasto'] = 'Tipo A';
    $response[$cont]['tipo'] = $row2['nombre'];
    $response[$cont]['total'] = $row2['total'];
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
    $response[$cont]['id_subcategoria'] = $row['id_subcategoria'];
    $response[$cont]['gasto'] = 'Tipo B';
    $response[$cont]['tipo'] = $row['nombre'];
    $response[$cont]['total'] = $row['total'];
    $cont++;
  }
  echo json_encode($response);
}

function detalleGastoOperativo2 () {
  global $conexion;
  $response = [];
  $sql = "
    SELECT
      subcategoria.nombre,
      SUM( cantidad * precio_adquisicion ) total
    FROM Compras
    JOIN producto ON Compras.id_producto = producto.id_producto
    JOIN subcategoria ON producto.id_subcategoria = subcategoria.id_subcategoria
    WHERE tipo = 'compra'
    AND `tipoCategoria` =  'OPERATIVO'
    AND fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "'
    GROUP BY subcategoria.nombre;
  ";
  $result = $conexion->query($sql);
  $cont = 0;
  while ($row = $result->fetch_array())
  {
    $response[$cont]['tipo'] = $row['nombre'];
    $response[$cont]['gasto'] = 'Tipo A';
    $response[$cont]['total'] = $row['total'];
    $cont++;
  }

  $sql2 = "
  SELECT
      subcategoria.nombre,
      SUM( cantidad * precio_adquisicion ) total
  FROM Compras_Facturadas
  JOIN producto ON Compras_Facturadas.id_producto = producto.id_producto
  JOIN subcategoria ON producto.id_subcategoria = subcategoria.id_subcategoria
  WHERE tipo = 'comprafac'
  AND `tipoCategoria` =  'OPERATIVO'
  AND fecha BETWEEN '" . $_POST['fecha1'] . "' AND '" . $_POST['fecha2'] . "'
   GROUP BY subcategoria.nombre;
  ";
  $result2 = $conexion->query($sql2);
  while ($row2 = $result2->fetch_array())
  {
    $response[$cont]['tipo'] = $row2['nombre'];
    $response[$cont]['gasto'] = 'Tipo B';
    $response[$cont]['total'] = $row2['total'];
    $cont++;
  }
  echo json_encode($response);
}

function detalleGastoPersonalSubcategoria () {
  global $conexion;
  $response = [];
  $cont = 0;
  if ($_POST['detalle2'] === "Tipo A") {
      $sql = "
      SELECT
          producto.nombre producto,
          producto.descripcion,
          cantidad,
          precio_adquisicion,
          SUM( cantidad * precio_adquisicion ) total 
      FROM Compras
      JOIN producto ON Compras.id_producto = producto.id_producto
      JOIN subcategoria ON producto.id_subcategoria = subcategoria.id_subcategoria 
      WHERE tipo = 'compra' AND `tipoCategoria` = 'OPERATIVO'
          AND fecha BETWEEN '2019-08-01' AND '2019-08-10'
          AND subcategoria.nombre = '" . $_POST['detalle'] . "'
      GROUP BY producto.nombre;
    ";
    $result = $conexion->query($sql);
    while ($row = $result->fetch_array())
    {
      $response[$cont]['producto'] = $row['producto'];
      $response[$cont]['descripcion'] = $row['descripcion'];
      $response[$cont]['facturado'] = 'No';
      $response[$cont]['cantidad'] = $row['cantidad'];
      $response[$cont]['precio_adquisicion'] = $row['precio_adquisicion'];
      $response[$cont]['total'] = $row['total'];
      $cont++;
    }
  }
  if ($_POST['detalle2'] === "Tipo B") {
    $sql = "
      SELECT
          producto.nombre producto,
          producto.descripcion,
          cantidad,
          precio_adquisicion,
          SUM( cantidad * precio_adquisicion ) total 
      FROM Compras_Facturadas
      JOIN producto ON Compras_Facturadas.id_producto = producto.id_producto
      JOIN subcategoria ON producto.id_subcategoria = subcategoria.id_subcategoria 
      WHERE tipo = 'compra' AND `tipoCategoria` = 'OPERATIVO'
          AND fecha BETWEEN '2019-08-01' AND '2019-08-10'
          AND subcategoria.nombre = '" . $_POST['detalle'] . "'
      GROUP BY producto.nombre;
    ";
    $result = $conexion->query($sql);
    while ($row = $result->fetch_array())
    {
      $response[$cont]['producto'] = $row['producto'];
      $response[$cont]['descripcion'] = $row['descripcion'];
      $response[$cont]['facturado'] = 'Si';
      $response[$cont]['cantidad'] = $row['cantidad'];
      $response[$cont]['precio_adquisicion'] = $row['precio_adquisicion'];
      $response[$cont]['total'] = $row['total'];
      $cont++;
    }
  }
  echo json_encode($response);
}

function detalleProducto () {
  global $conexion;
  $response = [];
  $getSubcategoria = "SELECT * FROM `Categorias_Subcategorias` WHERE `nombreCategoria` LIKE '".$_POST['detail']."' GROUP BY id_subcategoria";
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
        $response[$cont]['tipo'] = $row['nombre_producto'];
        $response[$cont]['total'] = $row['importe'];
        $cont++;
      }
    }
  }
  echo json_encode($response);  
}

$conexion->close(); //cerramos la conexión
?>