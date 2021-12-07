<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
	require "configuraciones.php";
	validarsesion();
	conectar();
	menuconfiguracion();
?>
	
<html>
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
				  width:700px;
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
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
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
    
</head>
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" onload="cargar_categorias()" >
<br />
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>
<!--ESTILO CUERPO-->
<div align="center"  >
   <!-- Tabala Pre-Registro -->
   <h1>REGISTRAR NUEVO SERVICIO</h1>
   <br />
    <p><button class="button" onclick="location.href='Conf_Servicios.php'">Regresar</button></p> 
    <form action="alta_servicio.php" method="post" name="newregist" onsubmit="return valida_form()">
    <table border="9"   bordercolor="#990000" bordercolordark="#990000"	 bordercolorlight="#990000" >
       <tr>
          <td><b>SERVICIO</b></td>
           <td><input id="name_s" name="servicio" type="text" size="35" maxlength="35" placeholder="		NOMBRE(S)	 " onchange="comprobar(this.value)" required></td>
       </tr>
       <tr> 
        <td><b>DESCRIPCION</b></td> 
        <td><textarea name="descripcion" required></textarea>
      </tr>
    <tr>
       <td><b>TIPO</b></td>
			<td>    
			 <div id="mis_categorias" style="float:left;"></div>
                <a href="#nueva_cat" class="btn btn-primary btn-sm" data-toggle="modal">
                <span class="glyphicon glyphicon-plus-sign glyphicon-lg" aria-hidden="true"></span>
                </a>
                <!--a href="#ver_categorias" class="btn btn-success btn-sm" data-toggle="modal">
                <span class="glyphicon glyphicon-cog glyphicon-lg" aria-hidden="true"></span>
                </a-->
			</td>
    </tr>
    
    <tr>
    	<td><b>PRECIO UNITARIO</b></td>
        <td ><input type="text" name="precio" placeholder="	PRECIO" required/> </td>
    </tr>
    <tr>
    	<td><b>UNIDAD</b></td>
        <td >
        <select name='unidad' size='1' id='unidad' onchange="val_op()" required>
            <option value="">Seleccione una opcion</option>
			<option value='ILIMITADA'>ILIMITADA</option>
            <option value='HORA'>HORA</option>
			<option value='PIEZA'>PIEZA O COMENSAL</option>
            <option valiue="HORA Y PIEZAS">HORA Y PIEZAS</option>
			<option valiue='N/A'>NO APLICA</option>
        </select>
        </td>
    </tr>
        <tr>
         <td colspan='2' align='center'><br>
		  <input type="hidden" id="status" name="status" value="0"/>
   		<p><input id="boton"  name="but" type="submit"  value="Guardar" class="button" /></p>    
        <input type="hidden" name="tipo" value="insertar" />
       </td>
       </tr>
   </table>   
    </form>
       

    
    
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
    <div  class="modal fade" id="ver_categorias" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title">
                    Categorias
                    </h2>
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
    
    
    
  <!-- Pie de PAgina -->
<div class='pie' align="center"> <MARQUEE WIDTH=50% HEIGHT=20 align="top" bgcolor=""><b> Sistema Villa Conin V 1.0 </b></MARQUEE><br />copyright - 2014 powered by MBR soluciones </div>

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

function cargar_categorias(){
    var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        document.getElementById("mis_categorias").innerHTML =xmlhttp.responseText;
                        panel_categorias();
                    }
                }
            xmlhttp.open("POST","Servicios_Action.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("opcion=show");
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
  /* 
function activar(formulario){
 if(document.newregist.tipo.value != "Seleccione una opcion" && document.newregist.medio.value!="Seleccione una opcion") 
document.newregist.but.disabled = false 
else 
document.newregist.but.disabled = true 
}
    function mostrar_formula(){
        v=document.getElementById("unidad").value
        if(v=='HORA'){
            document.getElementById("f").style.display='block'
        }else{
            document.getElementById("f").style.display='none'
            document.getElementById("f").value=''
        }
    }
    
    function val_op(){
        c=document.getElementById("categoria").value;
        u=document.getElementById("unidad").value;
        //alert(u+"jkjhkjhkjh"+c);
        if(c!='' && u!=''){
            document.getElementById("boton").disabled=false;
        }else{
            document.getElementById("boton").disabled=true;
        }
    }*/
	
function valida_form(){
ban=false;
	if(confirm("¿Esta seguro de modificar el servicio?")){
		x=document.getElementById("status");
		y=document.getElementById("name_s");
		if(x.value==1){
			y.setCustomValidity('');
			y.style.background='#FFF';
			ban=true;
		}else{
			ban=false;
			y.setCustomValidity('Error este nombre ya existe');
			y.style.background='#FFDDDD';
		}
		
	}

	return ban;
}
function comprobar(x){
    var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
             }else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        document.getElementById("status").value =xmlhttp.responseText;
						y=document.getElementById("name_s");
						y.setCustomValidity('');
						y.style.background='#FFF';
                    }
                }
            xmlhttp.open("POST","Servicios_Action.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("opcion=verifica_nombre&str="+x);

}
</script>
</body>
</html>