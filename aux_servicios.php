<?php
require 'funciones2.php';
conectar();
if($_POST['code']==1){////////////////verifica la unidad  del servicio en hoja anexa
    $q=mysql_fetch_array(mysql_query("select * from Servicios where id=".$_POST['id']));
    
        ////////validamos si es del tipo manteleria o equipo que trae desde inventario
    $idm=mysql_fetch_array(mysql_query("select * from Servicios_categorias where nombre='MOBILIARIO Y PEWTER EVENTOS'"));
    $ide=mysql_fetch_array(mysql_query("select * from Servicios_categorias where nombre='MANTELERIA'"));
    $extra='';$s_o=0;$s_n=0;
    if($q['tipo']==3 || $q['tipo']==32 || $q['tipo']==33 || $q['tipo']==34){
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
        $extra="Recervados:".$s_n." Opcinales ".$s_o." total:".$total;
        //////obtenemos la cantidad que tenemos en el inventario actual
        $producto=mysql_fetch_array(mysql_query("select * from producto where nombre='".$q['Servicio']."'"));				//////////calculamos el inventario actual del producto	
		$c=mysql_fetch_array(mysql_query("select sum(cantidad)as t from detalle where id_producto=".$producto['id_producto']." and tipo='compra' and  gasto='no'"));		$c2=mysql_fetch_array(mysql_query("select sum(cantidad)as t from detalle where id_producto=".$producto['id_producto']." and tipo='comprafac' and  gasto='no'"));		$c3=mysql_fetch_array(mysql_query("select sum(cantidad)as t from detalle where id_producto=".$producto['id_producto']." and tipo='entrada' and  gasto='no'"));		$c4=mysql_fetch_array(mysql_query("select sum(cantidad)as t from detalle where id_producto=".$producto['id_producto']." and tipo='salida' and  gasto='no'"));		$c5=mysql_fetch_array(mysql_query("select sum(cantidad)as t from detalle where id_producto=".$producto['id_producto']." and tipo='venta' and  gasto='no'"));		$inv=$c['t']+$c2['t']+$c3['t']-$c4['t']-$c5['t'];
        $extra=$extra." Inventario:".$inv;
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
        //////////calculamos el inventario actual del producto		
		$acumulado=0;
		$inv_inicial=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$producto["id_producto"]));
		$acumulado=$inv_inicial["cantidad"];
		$u_c=mysql_fetch_array(mysql_query("SELECT MAX( id ) as t FROM  detalle WHERE id_producto=".$producto["id_producto"]." AND tipo =  'faltante'"));
		$ultimo_corte=mysql_fetch_array(mysql_query("SELECT * FROM corte_inventario WHERE id_corte_inventario=".$u_c["t"]));
		
		///compras
		$com=mysql_query("select * from compra where fecha>='".$ultimo_corte["fecha"]."'");
		while($compra=mysql_fetch_array($com)){
			if($compra["fecha"]==$ultimo_corte["fecha"]){
				if($compra["hora"]>$ultimo_corte["hora"]){
					$detalle=mysql_fetch_array(mysql_query("select sum(cantidad) as t from detalle where id=".$compra["id_compra"]." and tipo='compra' and id_producto=".$producto["id"]));
					$acumulado=$acumulado+$detalle["t"];
				}
			}else{
				$detalle=mysql_fetch_array(mysql_query("select sum(cantidad) as t from detalle where id=".$compra["id_compra"]." and tipo='compra' and id_producto=".$producto["id"]));
				$acumulado=$acumulado+$detalle["t"];
			}
		}
		///comprasfac
		$comfac=mysql_query("select * from comprafac where fecha>='".$ultimo_corte["fecha"]."'");
		while($comprafac=mysql_fetch_array($comfac)){
			if($comprafac["fecha"]==$ultimo_corte["fecha"]){
				if($comprafac["hora"]>$ultimo_corte["hora"]){
					$detalle=mysql_fetch_array(mysql_query("select sum(cantidad) as t from detalle where id=".$comprafac["id_compra"]." and tipo='comprafac' and id_producto=".$producto["id"]));
					$acumulado=$acumulado+$detalle["t"];
				}
			}else{
				$detalle=mysql_fetch_array(mysql_query("select sum(cantidad) as t from detalle where id=".$comprafac["id_compra"]." and tipo='comprafac' and id_producto=".$producto["id"]));
				$acumulado=$acumulado+$detalle["t"];
			}
		}
		
		////entradas
		$entra=mysql_query("select * from entrada where fecha>='".$ultimo_corte["fecha"]."'");
		while($entradas=mysql_fetch_array($entra)){
			if($entradas["fecha"]==$ultimo_corte["fecha"]){
				if($entradas["hora"]>$ultimo_corte["hora"]){
					$detalle=mysql_fetch_array(mysql_query("select sum(cantidad) as t from detalle where id=".$entradas["id_entrada"]." and tipo='entrada' and id_producto=".$producto["id"]));
					$acumulado=$acumulado+$detalle["t"];
				}
			}else{
				$detalle=mysql_fetch_array(mysql_query("select sum(cantidad) as t from detalle where id=".$entradas["id_entrada"]." and tipo='entrada' and id_producto=".$producto["id"]));
				$acumulado=$acumulado+$detalle["t"];
			}
		}
		
		////salidas
		$sal=mysql_query("select * from salida where fecha>='".$ultimo_corte["fecha"]."'");
		while($salidas=mysql_fetch_array($sal)){
			if($salidas["fecha"]==$ultimo_corte["fecha"]){
				if($salidas["hora"]>$ultimo_corte["hora"]){
					$detalle=mysql_fetch_array(mysql_query("select sum(cantidad) as t from detalle where id=".$salidas["id_salida"]." and tipo='salida' and id_producto=".$producto["id"]));
					$acumulado=$acumulado-$detalle["t"];
				}
			}else{
				$detalle=mysql_fetch_array(mysql_query("select sum(cantidad) as t from detalle where id=".$salidas["id_salida"]." and tipo='salida' and id_producto=".$producto["id"]));
				$acumulado=$acumulado-$detalle["t"];
			}
		}
		
		////salidas
		$vent=mysql_query("select * from venta where fecha>='".$ultimo_corte["fecha"]."'");
		while($ventas=mysql_fetch_array($vent)){
			if($ventas["fecha"]==$ultimo_corte["fecha"]){
				if($ventas["hora"]>$ultimo_corte["hora"]){
					$detalle=mysql_fetch_array(mysql_query("select sum(cantidad) as t from detalle where id=".$ventas["id_venta"]." and tipo='venta' and id_producto=".$producto["id"]));
					$acumulado=$acumulado-$detalle["t"];
				}
			}else{
				$detalle=mysql_fetch_array(mysql_query("select sum(cantidad) as t from detalle where id=".$ventas["id_venta"]." and tipo='venta' and id_producto=".$producto["id"]));
				$acumulado=$acumulado-$detalle["t"];
			}
		}
		
        $extra=$extra." Inventario:".$acumulado."<br>Disponibles=".($acumulado-$total);
    }
     
    
    
    
    echo $q['unidad'].",".$q['precio'].",".$extra;
    
}
?>