<?php
require 'funciones2.php';
conectar();
//print_r($_POST);

if($_POST['type']=='categoria'){////////////si nos mandan la categoria buscamos la subcategoria
    $sub=mysql_query("select * from Subcategoria_menu where id_categoria=".$_POST['val']);
    echo "<select id='subcategory-".$_POST['menu']."' name='subcategoria' onchange='buscar2(this.value,".$_POST['menu'].")' style='width:25%;float:left;'>";
    echo "<option></option>";
    while($sub2=mysql_fetch_array($sub)){
        echo "<option value='".$sub2['id']."'>".$sub2['nombre']."</option>";
    }
    echo "</select>";
    
}elseif($_POST['type']=='subcategoria'){////////////si nos mandan la categoria buscamos el platillo
    $platillo=mysql_query("select * from Menus where id_subcategoria=".$_POST['val']." and estatus='ACTIVO' order by nombre");
    echo "<select id='platillos-".$_POST['menu']."' name='platillo' style='width:25%;float:left;'>";
    echo "<option></option>";
    while($platillo2=mysql_fetch_array($platillo)){
        echo "<option value='".$platillo2['id_menu']."'>".$platillo2['nombre']."</option>";
    }
    echo "</select>";
}elseif($_POST['type']=='borrar'){	////actualizacion del contacto con el cliente	
vcontacto($datos['contrato']);
    $datos=mysql_fetch_array(mysql_query("select * from logistica_menu where id=".$_POST['id']));
    mysql_query("delete from logistica_menu where id=".$_POST['id']);    
    
    ////////////imprimimos los valores actuales de comensales asignados
    $ad=mysql_fetch_array(mysql_query("select sum(cantidad) as t from logistica_menu where tipo_comensal='adultos' and contrato='".$datos['contrato']."'"));
if($ad['t']==''){$ad['t']=0;}
    echo $ad['t'].";";
    $jo=mysql_fetch_array(mysql_query("select sum(cantidad)as t from logistica_menu where tipo_comensal='jovenes' and contrato='".$datos['contrato']."'"));
if($jo['t']==''){$jo['t']=0;}
    echo $jo['t'].";";
$ni=mysql_fetch_array(mysql_query("select sum(cantidad)as t from logistica_menu where tipo_comensal='ninos' and contrato='".$datos['contrato']."'"));
if($ni['t']==''){$ni['t']=0;}
    echo $ni['t'];
}elseif($_POST['type']=='agregar_platillo'){
    $info=mysql_fetch_array(mysql_query("select * from logistica_menu where id=".$_POST['id']));
    ///////////////validamos que el platillo no se encuentre en el menu actual
    $existencia=true;
    $p=explode("%",$info['menu']);
     for($i=0;$i<count($p);$i++){
         if($p[$i]==$_POST['platillo']){
            $existencia=false;
         }
     }
    
    if($existencia){
         if($info['menu']==''){
        $aux=$_POST['platillo'];
        }else{
        $aux=$info['menu']."%".$_POST['platillo'];
        }		
		////actualizacion del contacto con el cliente
		vcontacto($info['contrato']);
        mysql_query("update logistica_menu set menu='".$aux."' where id=".$_POST['id']);
    }else{
        echo "No se puede volver reasignar el mismo menu";
    }    
}elseif($_POST['type']=='borrar_platillo'){
    $info=mysql_fetch_array(mysql_query("select * from logistica_menu where id=".$_POST['id']));
    ///////////////creamos nueva cadena sin el platillo a borrar para actualizar en la base 
    $cadena='';
    $p=explode("%",$info['menu']);
     for($i=0;$i<count($p);$i++){
         if($i!=$_POST['platillo']){
             if($cadena==''){ 
                $cadena=$p[$i];
             }else{
                $cadena=$cadena."%".$p[$i];
             }
         }
     } 	////actualizacion del contacto con el cliente		
	 vcontacto($info['contrato']);
     mysql_query("update logistica_menu set menu='".$cadena."' where id=".$_POST['id']);
}elseif($_POST['type']=='add_one'){
    $r=mysql_fetch_array(mysql_query("select * from logistica_menu where id=".$_POST['id']));
    $c=$r['cantidad']+$_POST['cant'];	////actualizacion del contacto con el cliente	
	vcontacto($r['contrato']);		
    mysql_query("update logistica_menu set cantidad='".$c."' where id=".$_POST['id']);
    //echo $c;
}elseif($_POST['type']=='remove_one'){
    $r=mysql_fetch_array(mysql_query("select * from logistica_menu where id=".$_POST['id']));
    if($_POST['cant']<=$r['cantidad']){
        $c=$r['cantidad']-$_POST['cant'];		////actualizacion del contacto con el cliente		
		vcontacto($r['contrato']);
        mysql_query("update logistica_menu set cantidad='".$c."' where id=".$_POST['id']);
    }else{
        echo "Error";
    }   
}elseif($_POST['type']=='festejado'){	////actualizacion del contacto con el cliente	
vcontacto($_POST['contrato']);
    $q="UPDATE contrato set festejado='".$_POST['nombre']."' where Numero='".$_POST['contrato']."'";
    if(!mysql_query($q)){
        echo "Error";
    }
}elseif($_POST['type']=='cambio-servicio'){
    $index=explode("_",$_POST['ids']);
    $c=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_POST['contrato']."'"));
    
    $all='';
    
    $anterior=explode("%",$c['servicios']);
    for($a=0;$a<count($anterior);$a++){
        if($a==$index[0]){
            $nuevo='';
            $r=explode(",",$anterior[$a]);
            $d=explode("-",$r[0]);
            for($b=0;$b<count($r);$b++){
                
                if($b==$index[1]){
                    $nuevo=$r[$b];
                }
            }
            for($b=0;$b<count($r);$b++){
                if($b!=$index[1]){
                    $nuevo=$nuevo.",".$r[$b];
                }
            }
        }else{
            $nuevo=$anterior[$a];
        }
        
        if($all==''){
            $all=$nuevo; 
        }else{
            $all=$all."%".$nuevo;
        }
        
    }
   // echo $all;
    ////actualizacion del contacto con el cliente	
	vcontacto($_POST['contrato']);
    $q="UPDATE contrato set servicios='".$all."' where Numero='".$_POST['contrato']."'";
    $q2="delete from logistica where numero='".$_POST['contrato']."' and servicio=".$d[0];
    if(!mysql_query($q2)){
        echo "Error";
    }else{
        if(!mysql_query($q)){
        echo "Error";
        }
    }
    
}










?>