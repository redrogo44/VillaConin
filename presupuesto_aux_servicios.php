<?php
require 'funciones2.php';
conectar();
if($_POST['code']==1){////////////////verifica la unidad  del servicio en hoja anexa
    $q=mysql_fetch_array(mysql_query("select * from Servicios where id=".$_POST['id']));
    
        ////////validamos si es del tipo manteleria o equipo que trae desde inventario
    $idm=mysql_fetch_array(mysql_query("select * from Servicios_categorias where nombre='MOBILIARIO Y PEWTER EVENTOS'"));
    $ide=mysql_fetch_array(mysql_query("select * from Servicios_categorias where nombre='MANTELERIA'"));
    $extra='';$s_o=0;$s_n=0;
    if($idm["id"]==$q['tipo'] || $ide["id"]==$q['tipo']){
        ////obtenemos los contratos del mismo dia
        $c=mysql_fetch_array(mysql_query("select * from presupuesto where id_precliente='".$_POST['contrato']."'"));
        $otros=mysql_query("select * from contrato where Fecha='".$c['Fecha']."'");
        ////recorremos los servicios de los contratos en busca de la cantidad de manteles que han apartado
        while($m=mysql_fetch_array($otros)){
            ////servicios en hoja anexa
            	$default=explode('%',$m['servicios']);
                for($k=0;$k<count($default);$k++){
                    ////verificamos los servicios que son opcionales
                    $opcionales=explode(",",$default[$k]);
                    if(count($opcionales)==1){
                        $service=explode("-",$opcionales[0]);
                         if($service[0]==$_POST['id']){
                                $s_n=$s_n+$service[1];
                            }
                    }else{
                        for($in=0;$in<count($opcionales);$in++){
                            $service=explode("-",$opcionales[$in]);
                            if($service[0]==$_POST['id']){
                                $s_o=$s_o+$service[1];
                            }
                        }
                         
                    }

                }
            ///servicios adicionales
                	$info2=explode("#",$m['ServiciosAdicionales']);
                    for($i=0;$i<count($info2);$i++){
                        $idx=explode("_",$info2[$i]);///elimindamos el id del cargo
                        $service=explode(";",$idx[1]);/////separamos los servicios
                        for($i2=0;$i2<count($service);$i2++){
                            $s=explode(',',$service[$i2]);//////////obtenemos id_servicio,cantidad,precio
                            if($s[0]==$_POST['id']){
                                $s_n=$s_n+$s[1];
                            }
                        }
                    }
        }////fin del while
        $total=$s_n+$s_o;
        $extra="Recervados:".$s_n." Opcinales ".$s_o." total:".$total;
        //////obtenemos la cantidad que tenemos en el inventario actual
        $producto=mysql_fetch_array(mysql_query("select * from producto where nombre='".$q['Servicio']."'"));
        $inv=mysql_fetch_array(mysql_query("select * from inventario  where id_producto=".$producto['id_producto']));
        $extra=$extra." Inventario:".$inv['cantidad'];
    }
     
    
    echo $q['unidad'].",".$extra;
    
    
    
}else if($_POST['code']==2){//validamos la contraseña para modificar el precio de Servicio
    $r=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='password' and tipo='servicios'"));
    if($_POST['p']==$r['valor']){
        echo "OK";
    }else{
        echo "ERROR";
    }
}else if($_POST['code']==11){////////////////verifica la unidad  del servicio en agregar cargo
    $q=mysql_fetch_array(mysql_query("select * from Servicios where id=".$_POST['id']));
   
    ////////validamos    si es del tipo manteleria o equipo que trae desde inventario
    $idt=mysql_fetch_array(mysql_query("select * from Servicios_categorias where nombre='TEMATICA EVENTOS'"));
    $idp=mysql_fetch_array(mysql_query("select * from Servicios_categorias where nombre='PEWTER EVENTOS'"));
    $idm=mysql_fetch_array(mysql_query("select * from Servicios_categorias where nombre='MOBILIARIO EVENTOS'"));
    $ide=mysql_fetch_array(mysql_query("select * from Servicios_categorias where nombre='MANTELERIA'"));
    $extra='';$s_o=0;$s_n=0;
    if($idm["id"]==$q['tipo'] || $ide["id"]==$q['tipo'] || $idp["id"]==$q['tipo'] || $idt["id"]==$q['tipo']){
        ////obtenemos los contratos del mismo dia
        $c=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_POST['contrato']."'"));
        $otros=mysql_query("select * from contrato where Fecha='".$c['Fecha']."'");
        ////recorremos los servicios de los contratos en busca de la cantidad de manteles que han apartado
        while($m=mysql_fetch_array($otros)){
            ////servicios en hoja anexa
            	$default=explode('%',$m['servicios']);
                for($k=0;$k<count($default);$k++){
                    ////verificamos los servicios que son opcionales
                    $opcionales=explode(",",$default[$k]);
                    if(count($opcionales)==1){
                        $service=explode("-",$opcionales[0]);
                         if($service[0]==$_POST['id']){
                                $s_n=$s_n+$service[1];
                            }
                    }else{
                        for($in=0;$in<count($opcionales);$in++){
                            $service=explode("-",$opcionales[$in]);
                            if($service[0]==$_POST['id']){
                                $s_o=$s_o+$service[1];
                            }
                        }
                         
                    }

                }
            ///servicios adicionales
                	$info2=explode("#",$m['ServiciosAdicionales']);
                    for($i=0;$i<count($info2);$i++){
                        $idx=explode("_",$info2[$i]);///elimindamos el id del cargo
                        $service=explode(";",$idx[1]);/////separamos los servicios
                        for($i2=0;$i2<count($service);$i2++){
                            $s=explode(',',$service[$i2]);//////////obtenemos id_servicio,cantidad,precio
                            if($s[0]==$_POST['id']){
                                $s_n=$s_n+$s[1];
                            }
                        }
                    }
        }////fin del while
        $total=$s_n+$s_o;
        //$extra="Recervados:".$s_n." Opcinales ".$s_o." total:".$total;
        $extra="Recervados:".$total."<br>";
        //////obtenemos la cantidad que tenemos en el inventario actual
        $producto=mysql_fetch_array(mysql_query("select * from producto where nombre='".$q['Servicio']."'"));
        $inv=mysql_fetch_array(mysql_query("select * from inventario  where id_producto=".$producto['id_producto']));
        $extra=$extra." Inventario:".$inv['cantidad']."<br>Disponibles=".($inv['cantidad']-$total);
    }
     
    
    
    
    echo $q['unidad'].",".$q['precio'].",".$extra;
    
}
?>