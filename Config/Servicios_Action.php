<?PHP
	require "configuraciones.php";
	validarsesion();
	conectar();
//print_r($_POST);
    $_POST['nombre']=strtoupper($_POST['nombre']);
    if($_POST['opcion']=="add"){
        mysql_query("insert into Servicios_categorias(nombre) values('".strtoupper($_POST['nombre'])."')");

    }else if($_POST['opcion']=="consult"){
        $c=mysql_query("select * from Servicios_categorias where nombre='".strtoupper($_POST['nombre'])."'");
        $n=mysql_num_rows($c);
        if($n==0){
             echo "disponible";
        }else{
             echo " NO disponible"; 
        }
    }else if($_POST['opcion']=="update"){
        mysql_query("UPDATE Servicios_categorias set nombre='".strtoupper($_POST['nombre'])."' where id='".$_POST['id']."'");
        
    }else if($_POST['opcion']=="show"){
        $c=mysql_query("select * from Servicios_categorias");
        echo "<select name='categoria' size='1' id='categoria' onchange='val_op()' required>";
        echo "<option value=''>Seleccione una opcion</option>";
        while($m=mysql_fetch_array($c)){
            if($m['nombre']!='NO BORRAR' && $m['nombre']!='TEMATICA EVENTOS' && $m['nombre']!='PEWTER EVENTOS' && $m['nombre']!='MOBILIARIO EVENTOS' && $m['nombre']!='MANTELERIA'){
                echo "<option value='".$m['id']."'>".$m['nombre']."</option>";
            }
        }
        echo "</select>";
    }else if($_POST['opcion']=="show_modificar"){
        $default=mysql_fetch_array(mysql_query("select * from Servicios_categorias where id=".$_POST['tipo']));
        $c=mysql_query("select * from Servicios_categorias");
        echo "<select name='categoria' size='1' id='categoria'>";
        echo "<option value='".$default['id']."'>".$default['nombre']."</option>";
        while($m=mysql_fetch_array($c)){
             if($m['nombre']!='NO BORRAR' && $m['nombre']!='TEMATICA EVENTOS' && $m['nombre']!='PEWTER EVENTOS' && $m['nombre']!='MOBILIARIO EVENTOS' && $m['nombre']!='MANTELERIA'){
                echo "<option value='".$m['id']."'>".$m['nombre']."</option>";
             }
        }
        echo "</select>";
    }else if($_POST['opcion']=="show_panel"){
        $c=mysql_query("select * from Servicios_categorias order by nombre");
        echo "<table class='table'>"; 
        echo "<tr><td>NOMBRE</td><td align='center'>ELIMINAR</td><td align='center'>MODIFICAR</td></tr>";
        while($m=mysql_fetch_array($c)){
             //////////////validacion de cero existencia de sercivios de la categoria
                $can_ser=mysql_query("select * from Servicios where tipo=".$m['id']); 
                if(mysql_num_rows($can_ser)>0){ 
                    echo "<tr><td>".$m['nombre']."</td><td align='center'><button type='button' class='btn btn-warning' title='Para eliminarlo se debe de borrar todos los servicios de esta categoria' disabled='true' >
                    <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
                    </button></td>";
                }else{
                     echo "<tr><td '>".$m['nombre']."</td><td align='center'><button type='button' class='btn btn-danger' onclick='delete_category(".$m['id'].")'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td>";
                }
            
            if($m['nombre']=='NO BORRAR' || $m['nombre']=='TEMATICA EVENTOS' || $m['nombre']=='PEWTER EVENTOS' || $m['nombre']=='MOBILIARIO EVENTOS' || $m['nombre']=='MANTELERIA'){
                echo "<td align='center'><button type='button' class='btn btn-success' title='No se puede cambiar el nombre' disabled='true'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></td></tr>";
            }else{
                echo "<td align='center'> <a href='#cambio_nombre'  data-toggle='modal'><button type='button' class='btn btn-success' onclick='change_name(".$m['id'].")'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></a></td></tr>";
            }
        } 
        echo "</table>";
    }else if($_POST['opcion']=="delete_category"){
        mysql_query("delete from Servicios_categorias where id=".$_POST['id']);
    }else if($_POST["opcion"]=="verifica_nombre"){			$r=mysql_query("select * from Servicios where Servicio='".$_POST["str"]."'");		if(mysql_num_rows($r)==0){			echo "1";		}else{			echo "0";		}	}
?>