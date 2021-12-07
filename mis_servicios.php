<?php
require 'funciones2.php';
conectar();
if($_POST['id']!='xdx' && !isset($_POST['op'])){////////////lo ejecutamos su solo es no es solo para mostrar los servicios contratados

	////validamos que el servicio añadido no este seleccionado ya 
	$bandera=false;
	$up=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_POST['contrato']."'"));
	$servicios_up=explode('%',$up['servicios']);
	for($i=0;$i<count($servicios_up);$i++){
        ////validamos si es que ya esta esta agregado como opcional
        $opc1=explode(",",$servicios_up[$i]);
        if(count($opc1)>1){
            for($l=0;$l<count($opc1);$l++){
                $s_up=explode("-",$opc1[$l]);
                if($s_up[0]==$_POST['id']){
                    $bandera=true;
                }
            }
        }else{//////si no existen opcionales
            $s_up=explode("-",$servicios_up[$i]);
            if($s_up[0]==$_POST['id']){
                $bandera=true;
            }
        }
		
	}
	
	if($bandera){////////es verdadera si ya existia el servicio
		echo "<mark id='Error' onclick='Error()'>Erro El servicio ya existe</mark>";
	}else{
		$q=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_POST['contrato']."'"));
		if($q['servicios']!=''){
			mysql_query("update contrato set servicios='".$q['servicios']."%".$_POST['id']."-".$_POST['hrs']."' where Numero='".$_POST['contrato']."'");
		}else{
			mysql_query("update contrato set servicios='".$_POST['id']."-".$_POST['hrs']."' where Numero='".$_POST['contrato']."'");
		}
	}
	
}else if($_POST['op']=='mod_hrs'){///modificacion de horas
	$up=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_POST['contrato']."'"));
	$servicios_up=explode('%',$up['servicios']);
	$nuevo_contenido="";
	for($i=0;$i<count($servicios_up);$i++){
		if($i==$_POST['id']){
            ////////////servicios opcionales
            $opc=explode(",",$servicios_up[$i]);
            $ext='';
            for($y=1;$y<count($opc);$y++){
                $ext=$ext.",".$opc[$y];
            }
            $s_up=explode("-",$opc[0]);
            
			if($nuevo_contenido==""){
				$nuevo_contenido=$s_up[0]."-".$_POST['hrs'].$ext;
			}else{
				$nuevo_contenido=$nuevo_contenido."%".$s_up[0]."-".$_POST['hrs'].$ext;
			}
		}else{
			if($nuevo_contenido==""){
				$nuevo_contenido=$servicios_up[$i];
			}else{
				$nuevo_contenido=$nuevo_contenido."%".$servicios_up[$i];
			}
		}
	}
	
	/////actualizamos
	mysql_query("update contrato set servicios='".$nuevo_contenido."' where Numero='".$_POST['contrato']."'");
}else if($_POST['op']=='borrar'){
	$up=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_POST['contrato']."'"));
	$servicios_up=explode('%',$up['servicios']);
	$nuevo_contenido="";
	for($i=0;$i<count($servicios_up);$i++){
		if($i!=$_POST['id']){
			if($nuevo_contenido==""){
				$nuevo_contenido=$servicios_up[$i];
			}else{
				$nuevo_contenido=$nuevo_contenido."%".$servicios_up[$i];
			}
		}
	} 
	
	////actualizamos
	mysql_query("update contrato set servicios='".$nuevo_contenido."' where Numero='".$_POST['contrato']."'");
}else if($_POST['op']=='agregar_o'){
    
    	////validamos que el servicio añadido no este seleccionado ya 
	$bandera=false;
	$up=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_POST['contrato']."'"));
	$servicios_up=explode('%',$up['servicios']);
	for($i=0;$i<count($servicios_up);$i++){
        ////validamos si es que ya esta esta agregado como opcional
        $opc1=explode(",",$servicios_up[$i]);
        if(count($opc1)>1){
            for($l=0;$l<count($opc1);$l++){
                $s_up=explode("-",$opc1[$l]);
                if($s_up[0]==$_POST['id']){
                    $bandera=true;
                }
            }
        }else{//////si no existen opcionales
            $s_up=explode("-",$servicios_up[$i]);
            if($s_up[0]==$_POST['id']){
                $bandera=true;
            }
        }
		
	}
    
    if(!$bandera){
    
        $up=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_POST['contrato']."'"));
        $servicios_up=explode('%',$up['servicios']);
        $nuevo_contenido="";
        for($i=0;$i<count($servicios_up);$i++){
            if($i==$_POST['or']){
                if($nuevo_contenido==""){
                    $nuevo_contenido=$servicios_up[$i].",".$_POST['id']."-".$_POST["hrs"];
                }else{
                    $nuevo_contenido=$nuevo_contenido."%".$servicios_up[$i].",".$_POST['id']."-".$_POST["hrs"];
                }
            }else{
                if($nuevo_contenido==""){
                    $nuevo_contenido=$servicios_up[$i];
                }else{
                    $nuevo_contenido=$nuevo_contenido."%".$servicios_up[$i];
                }
            }
        } 

        ////actualizamos
        mysql_query("update contrato set servicios='".$nuevo_contenido."' where Numero='".$_POST['contrato']."'");
    
    
    } else{
    
        echo "<mark id='Error' onclick='Error()'>Erro El servicio ya existe</mark>";
    
    }
    
    

}

$q2=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_POST['contrato']."'"));
$servicios=explode('%',$q2['servicios']);
if($q2['servicios']!=''){    
echo "<table border='1' width='310px'>";
echo "<tr><th>Servicio</th><th>Cantidad</th><th>Borrar</th></tr>";
for($i=0;$i<count($servicios);$i++){
    
     /////cadena de los servicios opcionales
    $opcional=explode(",",$servicios[$i]);
    if(count($opcional)>1){
         $co='<small>';
        for($f=1;$f<=count($opcional);$f++){ 
            $serviceop=explode("-",$opcional[$f]);
            $co1=mysql_fetch_array(mysql_query("select * from Servicios where id=".$serviceop[0]));
            if($serviceop[0]!=''){
                $co=$co."<br>".$co1['Servicio']."(".$serviceop[1].")";
            }
            
        }
        $co=$co."</small>";
        $time=explode("-",$opcional[0]);
        $se=mysql_fetch_array(mysql_query("select * from Servicios where id=".$time[0]));
        if(is_numeric($time[1])){
            echo "<tr><td style='position:relative;'>".$se['Servicio']."<br>".$co."<button style='position:absolute;right:0px;top:0px;' onclick='opcional(".$i.")'><small>OR</small></button></td><td align='center' ondblclick='mod_hrs(".$i.")'>".$time[1]."</td><td align='center'><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>";
        }else{
            if($se['unidad']=="HORA Y PIEZAS"){
                $ex=explode("/",$time[1]);
                $text=$ex[0]." pzas/".$ex['1']." hrs";
                echo "<tr><td style='position:relative;'>".$se['Servicio']."<br>".$co."<button style='position:absolute;right:0px;top:0px;' onclick='opcional(".$i.")'><small>OR</small></button></td><td align='center'>".$text."</td><td align='center'><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>";
            }else{
                echo "<tr><td style='position:relative;'>".$se['Servicio']."<br>".$co."<button style='position:absolute;right:0px;top:0px;' onclick='opcional(".$i.")'><small>OR</small></button></td><td align='center' ondblclick='mod_hrs2(".$i.")'>".$se['unidad']."</td><td align='center'><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>";
            }
        }
        
        
    }else{
        $s=explode("-",$servicios[$i]);
        $se=mysql_fetch_array(mysql_query("select * from Servicios where id=".$s[0]));
        
        if(is_numeric($s[1])){
            echo "<tr><td style='position:relative;'>".$se['Servicio']."<br><button style='position:absolute;right:0px;top:0px;' onclick='opcional(".$i.")'><small>OR</small></button></td><td align='center' ondblclick='mod_hrs(".$i.")'>".$s[1]."</td><td align='center'><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>";
        }else{
            if($se['unidad']=="HORA Y PIEZAS"){
                $ex=explode("/",$s[1]);
                $text=$ex[0]." pzas/".$ex['1']." hrs";
                 echo "<tr><td style='position:relative;'>".$se['Servicio']."<br><button style='position:absolute;right:0px;top:0px;' onclick='opcional(".$i.")'><small>OR</small></button></td><td align='center' ondblclick='mod_hrs2(".$i.")' >".$text."</td><td align='center'><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>";
            }else{
                 echo "<tr><td style='position:relative;'>".$se['Servicio']."<br><button style='position:absolute;right:0px;top:0px;' onclick='opcional(".$i.")'><small>OR</small></button></td><td align='center'>".$se['unidad']."</td><td align='center'><img src='Imagenes/eliminar.png' width='15px' onclick='borrar_service(".$i.")'></td></tr>"; 
            }
           
        }
        
        
    }
    
	
}
echo "</table>";

}

?>