<?php
session_start();
require 'funciones2.php';
conectar();
if($_POST['op']=="agregar"){////actualizacion del contacto con el cliente	
vcontacto($_POST['contrato']);
    $q=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_POST['contrato']."'"));
    ////contatenamos los nuevos servicio a servicio adicionales con ta siguiente estructura #96_185,0/2,1000#97_177,10/0,140
    $nt=$q['ServiciosAdicionales']."M".strtotime("now")."_".$_POST['id'].",".$_POST['cantidad'].",0#";
   $q2="update contrato set ServiciosAdicionales='".$nt."' where Numero='".$_POST['contrato']."'";
   mysql_query($q2);
}else if($_POST['op']=="observaciones"){	////actualizacion del contacto con el cliente	
vcontacto($_POST['contrato']);
    mysql_query("update contrato set observaciones_logistica='".$_POST['str']."' where Numero='".$_POST['contrato']."'");
}elseif($_POST['op']=='menu'){	
vcontacto($_POST['contrato']);
    mysql_query("update logistica_menu set  titulo='".$_POST['str']."' where id=".$_POST['id']);	$s=mysql_fetch_array(mysql_query("select * from logistica_menu where id=".$_POST['id']));	////actualizacion del contacto con el cliente	vcontacto($s['contrato']);	
}elseif($_POST['op']=='borrar_equipo'){
    $q=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_POST['contrato']."'"));
    $nc='';$nc0='';
    $cargos=explode("#",$q["ServiciosAdicionales"]);
    for($i=0;$i<count($cargos);$i++){
        $service=explode("_",$cargos[$i]);
        $ind=explode(";",$service[1]);
        for($x=0;$x<count($ind);$x++){
            $info=explode(",",$ind[$x]);
            if($info[0]==$_POST['id']){
                  //strpos($service[0],'M') === true
            }else{
               if($info[0]!=''){
                    $nc0=$nc0.$service[0]."_".$info[0].",".$info[1].",".$info[2].";";
                }
            }
        }
        if($nc0!=''){
            $nc=$nc.$nc0."#";
            $nc0='';
        }else{
            $nc0='';
        }
        
    }	////actualizacion del contacto con el cliente	
	vcontacto($_POST['contrato']);
    
    mysql_query("UPDATE contrato set ServiciosAdicionales='".$nc."' where Numero='".$_POST['contrato']."'");
}
?>