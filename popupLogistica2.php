<?php
require "funciones2.php";
conectar();
if(isset($_GET['op']) && $_GET['op']=='borrar'){
	mysql_query("delete from logistica where id=".$_GET['id']);
	//echo "delete from logistica where id=".$_GET['id'];
	////actualizacion del contacto con el cliente
	vcontacto($_GET['contrato']);
    header("Location:popupLogistica.php?contrato=".$_GET['contrato']."&id=".$_GET['serv']."&hrs=".$_GET['hrs']);
}else{
	$datetime1 = new DateTime($_POST['fi']." ".$_POST['hi']);
	$datetime2 = new DateTime($_POST['ff']." ".$_POST['hf']);
	$interval = date_diff($datetime1, $datetime2);
	$x=$interval->format("%H:%I:%S");
	$d=explode(":",$x);
	$num=$d[0]+($d[1]/60);
	$flag_asignacion=true;
    $info_serv=mysql_fetch_array(mysql_query("select * from Servicios where id=".$_POST['id']." and numero='".$_GET['contrato']."'"));
    if($info_serv['Servicio']=="RECEPCION" || $info_serv['Servicio']=="COMIDA"){
        $cant_log=mysql_fetch_array(mysql_query("select count(*) as t from logistica where servicio=".$_POST['id']));
        if($cant_log['t']>0){
            echo "ya se esncuentra asignado el servicio para poder reasignarlo primero debe de eliminar lo ya asignado";
echo "select count(*) as t from logistica where servicio=".$_POST['id'];
            $flag_asignacion=false;
        }
    }
    
    if($flag_asignacion){
         mysql_query("insert into logistica (numero,servicio,fecha_i,hora_i,fecha_f,hora_f,tiempo) values('".$_POST['contrato']."',".$_POST['id'].",'".$_POST['fi']."','".$_POST['hi']."','".$_POST['ff']."','".$_POST['hf']."',".$num.")");
        ////actualizacion del contacto con el cliente
		vcontacto($_POST['contrato']);
        ///VALIDAMOS SI ESTAMOS AGREGANDO RECEPCION PARA ACTUALIZAR EL HORARIO DE RENTA DE INSTALACIONES
        $s_com=mysql_fetch_array(mysql_query("select * from Servicios where Servicio='RECEPCION'"));
        if($s_com['id']==$_POST['id']){
             $renta=mysql_fetch_array(mysql_query("select * from Servicios where Servicio='RENTA'"));
			 ////actualizacion del contacto con el cliente
			vcontacto($_POST['contrato']);
            mysql_query("update logistica set fecha_i='".$_POST['fi']."',hora_i='".$_POST['hi']."' where numero='".$_POST['contrato']."' and servicio=".$renta['id']);
            
        }
        header("Location:popupLogistica.php?contrato=".$_POST['contrato']."&id=".$_POST['id']."&hrs=".$_POST['hrs']);
    }
   
        
	
    
    
}




function log_validar($f1,$h1,$f2,$h2,$f3,$h3){
    $dt1 = strtotime($f1." ".$h1);
	$dt2 = strtotime($f2." ".$h2);
	$dt3 = strtotime($f3." ".$h3);
     $r=false;
    if($dt1>$dt3 && $dt3<$dt2){
        $r=true;
     }
    
    return $r;
}

?>