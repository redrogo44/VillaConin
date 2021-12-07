<?php
require 'funciones.php';
conectar();
// print_r($_POST);
$array = json_decode($_POST['myArray'], true);
$max=mysql_fetch_array(mysql_query('SELECT max(id_corte_inventario) AS m FROM corte_inventario'));/////obtenemos al corte que pertence
$importe = $array[$i]['consumido'] * $array[$i]['costo'];
if ($max['m']=='') {
    $max['m']=0;
}
$max['m'] = $max['m'] + 1;
for ($i=0; $i < count($array); $i++) { 
   if ($array[$i]['etapa'] == 2){
       //////inventario inicial menos lo consumido se pone como suma porque viene en negativo
       $inv_actual = $array[$i]['ii'] + $array[$i]['consumido'];
       //////////actualizamos la tabla inventario con lo que tenemos actualmente  en existencia
       /*mysql_query("update inventario set cantidad=".$inv_actual.",fecha='".$_POST['fecha']."',hora='".$_POST['hora']."' where id_producto=".$_POST['id']);*/
       mysql_query("UPDATE inventario SET cantidad=".$inv_actual.",precio=".$array[$i]['costo'].",fecha='".$array[$i]['fecha_corte']."',hora='".$array[$i]['hora']."' where id_producto=".$array[$i]['id']);
       //echo "update inventario set cantidad=".$inv_actual.",precio=".$_POST['costo'].",fecha='".$_POST['fecha']."',hora='".$_POST['hora']."' where id_producto=".$_POST['id']."<br>";
       /////////insertamos en detalle para guardar historico de cortes
    //    $max=mysql_fetch_array(mysql_query('SELECT max(id_corte_inventario) AS m FROM corte_inventario'));/////obtenemos al corte que pertence
    //    $importe = $array[$i]['consumido'] * $array[$i]['costo'];
    //    if ($max['m']=='') {
    //        $max['m']=0;
    //    }
    //    $max['m'] = $max['m'] + 1;
       mysql_query("INSERT INTO detalle(id,cantidad,id_producto,precio_adquisicion,precio_venta,importe,tipo) VALUES(".$max['m'].",".$array[$i]['consumido'].",".$array[$i]['id'].",".$array[$i]['costo'].",0,".$importe.",'faltante')");			
       //echo "insert into detalle(id,cantidad,id_producto,precio_adquisicion,precio_venta,importe,tipo) values(".$max['m'].",".$_POST['consumido'].",".$_POST['id'].",".$_POST['costo'].",0,".$importe.",'faltante')"."<br>";
       $producto=mysql_fetch_array(mysql_query("select * from producto where id_producto=".$array[$i]['id']));
       // echo "ACTUALIZANDO ".$producto['nombre']; 
    } else if ($array[$i]['etapa']==3) {
        //mysql_query("insert into corte_inventario(fecha,hora)values('".$_POST['fecha']."','".$_POST['hora']."')");
        echo "FINALIZANDO....";
    }
}

?>