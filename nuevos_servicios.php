<?php
require 'funciones2.php';
conectar();
if(isset($_POST['op']) && $_POST['op']=='validacion'){
	//////////validamos si ya existe el el servicio
	$bandera=0;
	$services_v=explode(";",$_POST['s']);
	if(count($services_v)>1){
		for($i=0;$i<count($services_v);$i++){
			$datos_v=explode(",",$services_v[$i]);
			if($_POST['id']==$datos_v[0]){
				echo "<mark id='Error' onclick='Error()'>Erro El servicio ya existe</mark><br><br>";
				$bandera=1;
			}
		}
		if($bandera==0){
			echo "=)";
		}
	}else if(count($services_v)==1){
		$datos_v=explode(",",$services_v[0]);
		if($_POST['id']==$datos_v[0]){
			echo "<mark id='Error' onclick='Error()'>Erro El servicio ya existe</mark><br><br>";
		}else{
			echo "=)";
		}
	}else{
		echo "=)";
	}
	
}elseif($_POST['op']=='ver'){
	$services=explode(";",$_POST['s']);
     $total=0;
	echo "<table border='1'>";
	echo "<tr><th>Servicio</th><th>Cantidad</th><th>Precio<br> Unitario</th><th>Impote</th></tr>";
	for($i=0;$i<count($services);$i++){
		$datos=explode(",",$services[$i]);
		$info=mysql_fetch_array(mysql_query("select * from Servicios where id=".$datos[0]));
        if($datos[2]!=""){
         $info['precio']=$datos[2];
        }
        
		 if(!is_numeric($datos[1])){
             if($info['unidad']=="HORA Y PIEZAS"){
                $ex=explode("/",$datos[1]);
                if(!$ex[0]=="0"){
                    $total=$total+($ex[0]*$datos[2]);
                    echo "<tr><td>".$info['Servicio']."</td><td ondblclick='mod_hrs2(".$i.",1)'>".$ex[0]." pzas</td><td ondblclick='mod_precio(".$i.")'>$".number_format($datos[2],2,".",",")."</td><td>$".number_format($ex[0]*$datos[2],2,".",",")."</td><td><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>";
                }else{
                    $total=$total+($ex[1]*$datos[2]);
                    echo "<tr><td>".$info['Servicio']."</td><td ondblclick='mod_hrs2(".$i.",2)'>".$ex[1]." horas</td><td ondblclick='mod_precio(".$i.")'>$".number_format($datos[2],2,".",",")."</td><td>$".number_format($ex[1]*$datos[2],2,".",",")."</td><td><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>";
                }
            }else{ 
            $total=$total+$datos[2];
            echo "<tr><td>".$info['Servicio']."</td><td>".$datos[1]."</td><td ondblclick='mod_precio(".$i.")'>$".number_format($datos[2],2,".",",")."</td><td>$".number_format($datos[2],2,".",",")."</td><td><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>";
             }
        }else{
            
            $UNITY='';
            $UNITY='';
            if($info['unidad']=='HORA'){
                 $UNITY=" hrs";
            }else if($info['unidad']=='PIEZA'){
                $UNITY=" pzas";
            }else{
                $UNITY=$info['unidad'];
            }
            
            $importe=$info['precio']*$datos[1];
            $total=$total+$importe;
            echo "<tr><td>".$info['Servicio']."</td><td ondblclick='mod_hrs(".$i.")' align='center'> ".$datos[1].$UNITY."</td><td ondblclick='mod_precio(".$i.")'>$".number_format($info['precio'],2,".",",")."</td><td>$".number_format($importe,2,".",",")."</td><td><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>";
        }
        
        
	}
    echo "<tr><td colspan='3' align='right'>Total</td><td>$".number_format($total,2,".",",")."</td></tr>";
	echo "</table>";
    
    
}else{
    $total=0;
	$services=explode(";",$_POST['s']);
	echo "<table border='1'>";
	echo "<tr><th>Servicio</th><th>Cantidad</th><th>Precio<br> Unitario</th><th>Impote</th></tr>";
	for($i=0;$i<count($services);$i++){
		$datos=explode(",",$services[$i]);
		$info=mysql_fetch_array(mysql_query("select * from Servicios where id=".$datos[0]));
       if($datos[2]!=""){
         $info['precio']=$datos[2];
        }
        
        if(!is_numeric($datos[1])){
            ////VALIDAMOS UNIDAD DEL SERVICIO
            
            if($info['unidad']=="HORA Y PIEZAS"){
                $ex=explode("/",$datos[1]);				 echo "<tr><td>".$info['Servicio']."</td><td ondblclick='mod_hrs2(".$i.",1)'>".$ex[0]."pzas/".$ex[1]."hrs</td><td ondblclick='mod_precio(".$i.")'>$".number_format($datos[2],2,".",",")."</td><td>$".number_format($ex[0]*$datos[2],2,".",",")."</td><td><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>";
                /*if(!$ex[0]=="0"){ 
                    $total=$total+($ex[0]*$datos[2]);
                    echo "<tr><td>".$info['Servicio']."</td><td ondblclick='mod_hrs2(".$i.",1)'>".$ex[0]." pzas</td><td ondblclick='mod_precio(".$i.")'>$".number_format($datos[2],2,".",",")."</td><td>$".number_format($ex[0]*$datos[2],2,".",",")."</td><td><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>";
                }else{
                    $total=$total+($ex[1]*$datos[2]);
                    echo "<tr><td>".$info['Servicio']."</td><td ondblclick='mod_hrs2(".$i.",2)'>".$ex[1]." horas</td><td ondblclick='mod_precio(".$i.")'>$".number_format($datos[2],2,".",",")."</td><td>$".number_format($ex[1]*$datos[2],2,".",",")."</td><td><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>";
                }*/
            }else{
                $total=$total+$datos[2];
                echo "<tr><td>".$info['Servicio']."</td><td>".$datos[1]."</td><td ondblclick='mod_precio(".$i.")'>$".number_format($datos[2],2,".",",")."</td><td>$".number_format($datos[2],2,".",",")."</td><td><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>";
            }
        }else{
            $UNITY='';
            if($info['unidad']=='HORA'){
                 $UNITY=" hrs";
            }else if($info['unidad']=='PIEZA'){
                $UNITY=" pzas";
            }else{
                $UNITY=$info['unidad'];
            }
            
            $importe=$info['precio']*$datos[1];
            $total=$total+$importe;
            echo "<tr><td>".$info['Servicio']."</td><td ondblclick='mod_hrs(".$i.")' align='center'> ".$datos[1].$UNITY."</td><td ondblclick='mod_precio(".$i.")'>$".number_format($info['precio'],2,".",",")."</td><td>$".number_format($importe,2,".",",")."</td><td><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>";
        }
	}
    echo "<tr><td colspan='3' align='right'>Total</td><td>$".number_format($total,2,".",",")."</td></tr>";
	echo "</table>";
}

?>