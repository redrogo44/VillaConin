<?php
session_start();
require 'funciones2.php';
conectar();
//print_r($_POST);

////////agregamos el registro para el tipo de menu y cantidad de comensales
if($_POST['op']=='agregar'){
    
    $ex=mysql_query("select * from logistica_menu where  titulo='".$_POST['name']."' and contrato='".$_POST["contrato"]."'");
    $n=mysql_num_rows($ex);
    if($n<1){		 ////actualizacion del contacto con el cliente		
	vcontacto($_POST['contrato']);
         mysql_query("insert into logistica_menu(contrato,cantidad,tipo_comensal,user,titulo)
    values('".$_POST["contrato"]."',".$_POST["cantidad"].",'".$_POST["tipo"]."','".$_SESSION['usu']."','".$_POST['name']."')");
    }else{
        ////error de existencia de nombre de menu
        echo "Error en el nombre";
        exit();
    }
}

$insertar_row=0;
 
$menus=mysql_query("select * from logistica_menu where contrato='".$_POST['contrato']."' order by tipo_comensal");

while($m=mysql_fetch_array($menus)){
    
    /////////////insertamos una nueva fila
    if($insertar_row==0){
        echo "<div class='row'>";
        $insertar_row=$insertar_row+1;
    }
    
    echo '<div class="col-sm-12 col-md-6 col-md-4" style="border-style: solid;border-width:1px;position:relative;">';
    echo '<div  style="widht:100%;text-align:center;background:#585858;color:#fff;position:relative;top:-20px;left:-15px;" >
            <h2>'.strtoupper($m['titulo']).'</h2><small>'.strtoupper($m['tipo_comensal']).' </small>';
     echo '<button style="position:absolute;right:0px;top:0px;height:100%;"  type="button" class="btn btn-success dropdown-toggle" onclick="modificar_menu('.$m['id'].')">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span>
        </button>';
     echo '<button style="position:absolute;right:40px;top:0px;height:100%;"  type="button" class="btn btn-danger dropdown-toggle" onclick="eliminar_menu('.$m['id'].')">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
        </button>';
    echo   ' </div>';
    
    $tipo_comensal=0;
    if($m['tipo_comensal']=="adultos"){
        $tipo_comensal=1;
    }elseif($m['tipo_comensal']=="jovenes"){
        $tipo_comensal=2;
    }else{
        $tipo_comensal=3;
    }
    
    
    
    
    echo "<h4><b>CANTIDAD DE COMENSALES: ".$m['cantidad']."</b> &nbsp ";
    echo '<button type="button" class="btn btn-success btn-sm" onclick="add_one('.$m['id'].','.$tipo_comensal.')">
  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
</button> &nbsp';
     echo '<button type="button" class="btn btn-danger btn-sm" onclick="remove_one('.$m['id'].','.$tipo_comensal.')">
  <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
</button></h4>';
   // echo "<button onclick='eliminar_menu(".$m['id'].")'>Borrar</button><br>";
    /////////////////mostramos los platillos previamente seleccionados
    echo '<div class="list-group">';
    $platillo=explode("%",$m['menu']);
     for($i=0;$i<count($platillo);$i++){
        $p=mysql_fetch_array(mysql_query("select * from Menus where id_menu=".$platillo[$i]));
         if($p['nombre']!=""){
             echo '
                  <a  class="list-group-item">'.$p['nombre'].' <span class="badge glyphicon glyphicon-trash" onclick="borrar_platillo('.$i.','.$m['id'].')" style="background:#990000;">&nbspBorrar</span></a>';            
             
         }
     }
    echo "</div>";
    ////////////categorias de menu
    $cat=mysql_query("select * from Categorias_menu");
    echo "<select id='category-".$m['id']."' name='categoria' onchange='buscar(this.value,".$m['id'].")' style='width:25%;float:left;'>";
    echo "<option></option>";
    while($cat2=mysql_fetch_array($cat)){
        echo "<option value='".$cat2['id_categoria']."'>".$cat2['nombre']."</option>";
    }
    echo "</select>";
    ///////////subcategorias de menu
     echo "<div id='subcategoria-".$m['id']."'></div>";
    ///////////platillo
     echo "<div id='platillo-".$m['id']."'></div>";
    echo "<button id='ag_pl-".$m['id']."' onclick='agregar_platillo(".$m['id'].")' style='width:25%;float:left;display:none;background:#000;color:#fff;'>AGREGAR</button><br>";
    
    echo '<br><br><br></div>';
    
    /////////////cerramos la fila insertada
    if($insertar_row==3){
        echo "</div><br><br>";
        $insertar_row=0;
    }else{
        $insertar_row=$insertar_row+1;
    }
}

?>