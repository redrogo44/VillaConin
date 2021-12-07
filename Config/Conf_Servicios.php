<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
	require "configuraciones.php";
	conectar();
	validarsesion();
	$nivel=$_SESSION['niv'];
	menuconfiguracion();

/////////////AGREGAMOS LOS SERVICIOS DE EQUIPO Y MANTELERIA QUE ESTAN EN INVENTARIO


///////////validamos la existencia de la categoria en servicios si no exsite la creamos
$ns=mysql_query("select * from Servicios_categorias where nombre='MANTELERIA'");
if(mysql_num_rows($ns)==0){
    mysql_query("insert into Servicios_categorias(nombre) values('MANTELERIA')");
}

$manteleria=mysql_query("select * from subcategoria where id_categoria=9 order by nombre");
$manteleria_id=mysql_fetch_array(mysql_query("select * from Servicios_categorias where nombre='MANTELERIA'"));
while($m=mysql_fetch_array($manteleria)){
    ////consultanis si ya existe en la lista de servicios
    $p1=mysql_query("select * from producto where id_categoria=9 and id_subcategoria=".$m['id_subcategoria']." order by nombre");
    while($producto=mysql_fetch_array($p1)){
        ////servicio que vamos a comparar la existencia
        $x=$producto['nombre'];
        $r=mysql_query("select * from Servicios where Servicio='".$x."'");
        ///////si nos regreso un registro es qye si existe y no hay que agragarlo
        if(mysql_num_rows($r)==0){
            mysql_query("insert into Servicios(Servicio,descripcion,tipo,precio,unidad) values('".$x."','".$producto['descripcion']."','".$manteleria_id['id']."',0,'PIEZA')");     
        }
    }
}


///////////validamos la existencia de la categoria en servicios si no exsite la creamos
$ns2=mysql_query("select * from Servicios_categorias where nombre='MOBILIARIO EVENTOS'");
if(mysql_num_rows($ns2)==0){
    mysql_query("insert into Servicios_categorias(nombre) values('MOBILIARIO EVENTOS')");
}

$equipo=mysql_query("select * from producto where id_categoria=15 order by nombre");
$equipo_id=mysql_fetch_array(mysql_query("select * from Servicios_categorias where nombre='MOBILIARIO EVENTOS'"));
$a0=$equipo_id["id"];
while($e=mysql_fetch_array($equipo)){
    ////consultanas si ya existe en la lista de servicios
    ////servicio que vamos a comparar la existencia
    $x2=$e['nombre'];
    $r2=mysql_query("select * from Servicios where Servicio='".$x2."'");
    ///////si nos regreso un registro es qye si existe y no hay que agragarlo
    if(mysql_num_rows($r2)==0){
         mysql_query("insert into Servicios(Servicio,descripcion,tipo,precio,unidad) values('".$x2."','".$e['descripcion']."','".$equipo_id['id']."',0,'PIEZA')");     
        }
}


///////////validamos la existencia de la categoria en servicios si no exsite la creamos
$ns2=mysql_query("select * from Servicios_categorias where nombre='PEWTER EVENTOS'");
if(mysql_num_rows($ns2)==0){
    mysql_query("insert into Servicios_categorias(nombre) values('PEWTER EVENTOS')");
}

$equipo=mysql_query("select * from producto where id_categoria=16 order by nombre");
$equipo_id=mysql_fetch_array(mysql_query("select * from Servicios_categorias where nombre='PEWTER EVENTOS'"));
$a1=$equipo_id["id"];
while($e=mysql_fetch_array($equipo)){
    ////consultanas si ya existe en la lista de servicios
    ////servicio que vamos a comparar la existencia
    $x2=$e['nombre'];
    $r2=mysql_query("select * from Servicios where Servicio='".$x2."'");
    ///////si nos regreso un registro es qye si existe y no hay que agragarlo
    if(mysql_num_rows($r2)==0){
         mysql_query("insert into Servicios(Servicio,descripcion,tipo,precio,unidad) values('".$x2."','".$e['descripcion']."','".$equipo_id['id']."',0,'PIEZA')");     
        }
}


///////////validamos la existencia de la categoria en servicios si no exsite la creamos
$ns2=mysql_query("select * from Servicios_categorias where nombre='TEMATICA EVENTOS'");
if(mysql_num_rows($ns2)==0){
    mysql_query("insert into Servicios_categorias(nombre) values('TEMATICA EVENTOS')");
}

$equipo=mysql_query("select * from producto where id_categoria=17 order by nombre");
$equipo_id=mysql_fetch_array(mysql_query("select * from Servicios_categorias where nombre='TEMATICA EVENTOS'"));
while($e=mysql_fetch_array($equipo)){
    ////consultanas si ya existe en la lista de servicios
    ////servicio que vamos a comparar la existencia
    $x2=$e['nombre'];
    $r2=mysql_query("select * from Servicios where Servicio='".$x2."'");
    ///////si nos regreso un registro es qye si existe y no hay que agragarlo
    if(mysql_num_rows($r2)==0){
         mysql_query("insert into Servicios(Servicio,descripcion,tipo,precio,unidad) values('".$x2."','".$e['descripcion']."','".$equipo_id['id']."',0,'PIEZA')");     
        }
}

$ns5=mysql_fetch_array(mysql_query("select * from Servicios_categorias where nombre='NO BORRAR'"));

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Villa Conin</title>
    <style type="text/css">
             *{
				 padding:0px;
				 margin:0px;
			  }
			  #header{
				  margin:auto;
				  width:1000px;
				  height:auto;
				  font-family:Arial, Helvetica, sans-serif;
				  }
			  ul,ol{
				 list-style:none;} 
			 .nav li a {
				 background-color:#000;
				 color:#fff;
				 text-decoration:none;
				 padding:10px 15px;
				 display:block;
				 }
			.nav li a:hover 
			{
			 background-color:#434343;
		    }
			 .nav > li{
				 float:left;}
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}
			.nav li:hover> ul{
				display:block;
				}
			.nav li ul li{
				position:relative;}
			.nav li ul li ul{
				right:-140px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				.pie {position:fixed;bottom:0px;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
				.button 
						{
							   border-top: 1px solid #8f0d0d;
							   background: #9c132a;
							   background: -webkit-gradient(linear, left top, left bottom, from(#a12a2e), to(#9c132a));
							   background: -webkit-linear-gradient(top, #a12a2e, #9c132a);
							   background: -moz-linear-gradient(top, #a12a2e, #9c132a);
							   background: -ms-linear-gradient(top, #a12a2e, #9c132a);
							   background: -o-linear-gradient(top, #a12a2e, #9c132a);
							   padding: 8px 16px;
							   -webkit-border-radius: 10px;
							   -moz-border-radius: 10px;
							   border-radius: 10px;
							   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
							   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
							   box-shadow: rgba(0,0,0,1) 0 1px 0;
							   text-shadow: rgba(0,0,0,.4) 0 1px 0;
							   color: #ffffff;
							   font-size: 14px;
							   font-family: 'Lucida Grande', Helvetica, Arial, Sans-Serif;
							   text-decoration: none;
							   vertical-align: middle;
							   }
							.button:hover {
							   border-top-color: #b02128;
							   background: #b02128;
							   color: #ffffff;
							   }
							.button:active {
							   border-top-color: #0f2d40;
							   background: #0f2d40;
			   }
			   
			   
			   
			   
    </style> 
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="application/javascript" src="../bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet"  href="../bootstrap/css/bootstrap.css">
    <script>


function cargar_categorias(){
    var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        ///document.getElementById("mis_categorias").innerHTML =xmlhttp.responseText;
                        panel_categorias();
                    }
                }
            xmlhttp.open("POST","Servicios_Action.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("");
}

function panel_categorias(){
    var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        document.getElementById("lista_categorias").innerHTML =xmlhttp.responseText;
                    }
                }
            xmlhttp.open("POST","Servicios_Action.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("opcion=show_panel");
}
 function delete_category(id){
     if(confirm("Esta seguro en eliminar la categoria?")){
        var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        //$("#ver_categorias").modal("hide");
                         cargar_categorias();
                    }
                }
            xmlhttp.open("POST","Servicios_Action.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("opcion=delete_category&id="+id);
     }
}
        function change_name(i){
            document.getElementById("aux_name").value=i;
        }
        function borrar_servicio(identificador){
            if(confirm("¿Esta seguro de ELIMINAR el servicio?")){
                location.href="alta_servicio.php?numero="+identificador+"&Eliminar=Eliminar";
            }
        }
    </script>
</head>
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  onload="cargar_categorias()" bgcolor="#FFFFFF" >
<br />
<?php
$usuario=$_SESSION['nombre'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

?>
<!--ESTILO CUERPO-->
<div align="center"  >
<br  style="background-position:center"/ >
   <!-- Tabala Pre-Registro -->
   <h1>SERVICIOS</h1>
   <br />
   
 <div id="formulario" align="center">  

  </div>
   
   <br />
    <a href="#ver_categorias"  data-toggle="modal">
        <button class="button" style="float:right;margin-right:20%;" >TIPOS DE SERVICIOS</button>
    </a>
   <form method="post" action="Agrega_Servicio.php">
  <input type="submit" value="AGREGAR UN NUEVO ELEMENTO"  class="button"/><br><br>
   		<table border="6" bordercolor="#990000" style="background-color:#FFF;width:80%;">
        	<tr>
            	<td align="center"><b>SERVICIO</b></td>
                <td align="center" ><b>DESCRIPCION</b></td>
                <td align="center" ><b>UNIDAD</b></td>
                <td align="center"><b>PRECIO</b></td>
                 <td align="center"><b>MODIFICAR</b></td>
                  <td align="center" style="font:'Comic Sans MS', cursive"><b>ELIMINAR</b></td>
                   
                   
            </tr>
            <tr>
            	<?php
					$selecM="SELECT * FROM  Servicios_categorias order by nombre";
					$M=mysql_query($selecM) or die( mysql_error());
					$var=0;
					while($Mm=mysql_fetch_array($M))
					{
						echo "<tr>
						<td colspan='12' align='center' bgcolor='#FF0000'><a style='color:#FAF102'><b>".$Mm['nombre']."</b></a></td></tr>
						";
						$r="SELECT * FROM Servicios where tipo='".$Mm['id']."' order by Servicio";
						$Mt=mysql_query($r) or die( mysql_error());
						while($Me=mysql_fetch_array($Mt))
						{
                            if($Me['tipo']==$manteleria_id['id'] || $Me['tipo']==$equipo_id['id'] || $Me['tipo']==$a0 || $Me['tipo']==$a1 || $Me['tipo']==$ns5['id']){
                                echo "<tr>
									<td align='center'><b>".$Me['Servicio']."</b></td>
									<td align='center'><b>".$Me['descripcion']."</b></td>
									<td align='center'><b>".$Me['unidad']."</b></td>
									<td align='center'><b>".$Me['precio']."</b></td>
									<td align='center'><b><a href=modificaSE.php?numero=".$Me['id']."&nombre=".$Me['Servicio']." >Modificar</a></b></td>
									<td align='center'></td>
									
								</tr>
							";
                            
                            }else{
                                echo "
							<tr>
									<td align='center'><b>".$Me['Servicio']."</b></td>
									<td align='center'><b>".$Me['descripcion']."</b></td>
									<td align='center'><b>".$Me['unidad']."</b></td>
									<td align='center'><b>".$Me['precio']."</b></td>
									<td align='center'><b><a href=modificaSE.php?numero=".$Me['id']."&nombre=".$Me['Servicio']." >Modificar</a></b></td>
									<td align='center'><b><a onclick='borrar_servicio(".$Me['id'].")' style='color:blue;'>Eliminar</a></b></td>
									
								</tr>
							";
                            
                            }
							
							
							$var++;
						}
					}
		
                ?>
            </tr>
	    </table>
        
       
   </form>
   <input  type='hidden' name='numero' value=""/>
    
     <!-- Ventana Modal -->
    <div  class="modal fade" id="ver_categorias" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title">
                    Categorias
                    </h2>
                    <a href="#nueva_cat" class="btn btn-primary btn-sm" data-toggle="modal">
                        Agregar &nbsp;&nbsp;<span class="glyphicon glyphicon-plus-sign glyphicon-lg" aria-hidden="true"></span>
                    </a>
                </div>
                <div class="modal-body" style="max-height:450px;overflow:scroll;">
                    <div id="lista_categorias"></div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
 <!-- Fin Ventana Modal -->
 <!-- Ventana Modal -->
    <div  class="modal fade" id="nueva_cat">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title">
                    Agregar Categoria
                     </h2>
                </div>

                <div class="modal-body">
                    <table>
                        <tr><td><label>Nombre : </label></td><td><input type="text" id="service_name"></td></tr>
                        <!--tr><td><label>Descripcion</label></td><td><input type="text" id="descripcion_servicio"></td></tr-->
                    </table>
                </div>
                <div id="alert"></div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="save_cat" disabled="true">Guardar</button>
            </div>
        </div>
    </div>
</div>
 <!-- Fin Ventana Modal -->
    
 <!-- Ventana Modal -->
    <div  class="modal fade" id="cambio_nombre">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title">
                    Cambio de nombre
                     </h2>
                </div>

                <div class="modal-body">
                    <table>
                        <tr><td><label>Nombre : </label></td><td><input type="text" id="service_name2"></td></tr>
                        <!--tr><td><label>Descripcion</label></td><td><input type="text" id="descripcion_servicio"></td></tr-->
                    </table>
                </div>
                <div id="alert2"></div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="change_n" disabled="true">Guardar</button>
            </div>
        </div>
    </div>
</div>
 <!-- Fin Ventana Modal -->
    <input type="hidden" id="aux_name">
  <!-- Pie de PAgina -->
    <br><br><br><br><br><br><br>
<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 3.0 </b></MARQUEE><br />copyright - 2014 Powered By MBR soluciones </div>
    <script>
    
    $("#save_cat").click(function(){
   var request=$.ajax({
            method:"POST",
            url:"Servicios_Action.php",
            data:{ nombre:$("#service_name").val(),opcion:"add"}
        });
        request.done(function( msg ) {
            $("#service_name").val("");
            $("#save_cat").prop("disabled",true);
            $("#nueva_cat").modal("hide");
            $( "#categories" ).html( msg );
            cargar_categorias();
        });

        request.fail(function( jqXHR, textStatus ) {
          alert( "Error en la recepcion de informacion: ");
        });
    });
    
$( "#service_name" ).keyup(function() {
   var request2=$.ajax({
            method:"POST",
            url:"Servicios_Action.php",
            data:{ nombre:$("#service_name").val(),opcion:"consult"}
        });
        request2.done(function( msg ) {
            
            if(msg=="disponible"){
                $("#alert").html('<div class="alert alert-success" role="alert">Nombre disponible</div>');
                $("#save_cat").prop("disabled",false);
            }else{
                $("#alert").html('<div class="alert alert-danger" role="alert">El nombre de la categoria ya existe</div>');
                $("#save_cat").prop("disabled",true);
            }
        });

        request2.fail(function( jqXHR, textStatus ) {
          alert( "Error en la recepcion de informacion: ");
        });
    });
        
     $("#change_n").click(function(){
   var request=$.ajax({
            method:"POST",
            url:"Servicios_Action.php",
            data:{ nombre:$("#service_name2").val(),opcion:"update",id:$('#aux_name').val()}
        });
        request.done(function( msg ) {
            $("#service_name2").val("");
            $("#change_n").prop("disabled",true);
            $("#cambio_nombre").modal("hide");
            $("#ver_categorias").modal("hide");
            location.reload();
        });

        request.fail(function( jqXHR, textStatus ) {
          alert( "Error en la recepcion de informacion: ");
        });
    });
        
    $( "#service_name2" ).keyup(function() {
   var request2=$.ajax({
            method:"POST",
            url:"Servicios_Action.php",
            data:{ nombre:$("#service_name2").val(),opcion:"consult"}
        });
        request2.done(function( msg ) {
            
            if(msg=="disponible"){
                $("#alert2").html('<div class="alert alert-success" role="alert">Nombre disponible</div>');
                $("#change_n").prop("disabled",false);
            }else{
                $("#alert2").html('<div class="alert alert-danger" role="alert">El nombre de la categoria ya existe</div>');
                $("#change_n").prop("disabled",true);
            }
        });

        request2.fail(function( jqXHR, textStatus ) {
          alert( "Error en la recepcion de informacion: ");
        });
    });
    </script>
    
    
</body>
</html>
<script language="javascript">

function confirma()
{
 <?php 
 	for($i=0;$i<count($_POST);$i++)
	{
	 	$up="UPDATE `Meseros` SET `disponibilidad`='si' WHERE id=".$_POST[$i];
		mysql_query($up);
	}
 ?>*/
	
}
</script>
