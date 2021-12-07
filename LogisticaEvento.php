<?php
require 'funciones2.php';
session_start;
conectar();
///////////validamos que el contrato no tenga la hoja anexa impresa 
	$imp=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_GET['numero']."'"));
	if($imp['imphojaanexa']=='si'){
		if($_SESSION['niv']!=0 && $_SESSION['niv']!=1){
			header("Location: BuscarContrato.php");
			exit();
		}
	}
//////////////
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
validarsesion();
$nivel=$_SESSION['niv'];
if($nivel==0)
{
menunivel0();				
}
if($nivel==1)
{
menunivel1();				
}
if($nivel==2)
{
menunivel2();
}
if($nivel==3)
{
menunivel3();
}
if($nivel==4)
{
menunivel4();
}

?>
<script src="includes/prototype.js" type="text/javascript"></script>

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
				  width:800px;
				  right:1000px;
				  height:20px;
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
				right:-142px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				.pie {position:relative;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
				.botones 
				{
					 font-family: Geneva, Arial, Helvetica, sans-serif;
					 font-size: 20px;
					 font-weight: bold;
					 color: #990000;
					 text-decoration: blink;
					 background-color: #33CC99;
					 border-top-color: #0000FF;
					 border-right-color: #FFFF00;
					 border-bottom-color: #00FFFF;
					 border-left-color: #0000FF;
					 border-color: #000000;
					 border-top-style: solid;
					 border-right-style: solid;
					 border-bottom-style: solid;
					 border-left-style: solid;
					 border-style: solid;
					}
					.botones1 
					{
						 font-family: Geneva, Arial, Helvetica, sans-serif;
						 font-size: 25px;
						 font-weight: bold;
						 color: #333333;
						 text-decoration: blink;
						 background-color: #00FF00;
						 border-top-color: #000000;
						 border-right-color: #000000;
						 border-bottom-color: #000000;
						 border-left-color: #000000;
						 border-color: #000000;
						 border-top-style: solid;
						 border-right-style: solid;
						 border-bottom-style: solid;
						 border-left-style: solid;
						 border-style: solid;
					}
					.botones2
				{
					 font-family: Geneva, Arial, Helvetica, sans-serif;
					 font-size: 25px;
					 font-weight: bold;
					 color: #333333;
					 text-decoration: blink;
					 background-color: #FF0000;
					 border-top-color: #000000;
					 border-right-color: #000000;
					 border-bottom-color: #000000;
					 border-left-color: #000000;
					 border-color: #000000;
					 border-top-style: solid;
					 border-right-style: solid;
					 border-bottom-style: solid;
					 border-left-style: solid;
					 border-style: solid;
					}
      </style>
       
	 <link rel="stylesheet" type="text/css" href="css/servicios.css">
	 <script>
	 var contrato='<?php echo $_GET['numero'];?>';
     var or="#";
function mostrar(cat){
	var element = document.getElementById("contenedor-padre");
	var arr=element.getElementsByTagName('div');
	for(i=0;i<arr.length;i++){
		if(cat==arr[i].id){
			document.getElementById(arr[i].id).style.display = "block";
		}else{
			document.getElementById(arr[i].id).style.display = "none";
		}
	}
	document.getElementById("descripcion").style.display = "block";
	document.getElementById("abc").innerHTML="";
}
function mostrar_info(id){
	var xmlhttp;

	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
 }
else
 {// code for IE6, IE5
 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("abc").innerHTML=xmlhttp.responseText;
}
 }
xmlhttp.open("POST","info_service.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("id="+id);
}
         
function agregar3(id,hrs){
     var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
         }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    document.getElementById("mi_tabla").innerHTML=xmlhttp.responseText;
                     document.getElementById("alerta_opcional").style.display="none";
                    or='#';
                }
            }
        xmlhttp.open("POST","mis_servicios.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("id="+id+"&hrs="+hrs+"&contrato="+contrato+"&op=agregar_o&or="+or);   
}
         
function agregar2(id,hrs){
     var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
         }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    document.getElementById("mi_tabla").innerHTML=xmlhttp.responseText;
                }
            }
        xmlhttp.open("POST","mis_servicios.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("id="+id+"&hrs="+hrs+"&contrato="+contrato);   
}

function agregar(id){
    
    /////////////validadmos el tipo de unidad para pedir horas o no
    var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	 }else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
                recibido=xmlhttp.responseText;
                recibido2=recibido.split(",");
                
				if(recibido2[0]=='HORA' || recibido2[0]=='PIEZA'){
                    ///////////si el servicio se cobra por hora
                    hrs=prompt("Introduce la cantidad de "+recibido2[0]+"S \n"+recibido2[1])
                    if(hrs==''){
                        hrs='0';
                    }
                    if(or=='#'){////validamos si es un servicio opcional
                        if(hrs!=null){
                            agregar2(id,hrs)
                        }
                    }else{
                        if(hrs!=null){
                            agregar3(id,hrs)
                        }
                    }
                
                }else if(recibido2[0]=='HORA Y PIEZAS'){
                    cantidad=prompt("Introduce el numero de piezas");
                    horas=prompt("Ingresa la cantidad de horas");
                    if(cantidad!=null && cantidad>0){
                        if(horas!=null && horas>0){
                            conc=cantidad+"/"+horas;
                             if(or=='#'){
                                 agregar2(id,conc);
                             }else{
                                 agregar3(id,conc);
                             }
                        }else{
                            alert("la cantidad de HORAS debe de ser mayor o igual a 1");
                        }
                    }else{
                        alert("la cantidad de PIEZAS debe de ser mayor o igual a 1");
                    }
                }else{
                     if(or=='#'){////validamos si es un servicio opcional
                          agregar2(id,xmlhttp.responseText);
                     }else{
                         agregar3(id,xmlhttp.responseText);
                     }
                   
                
                }
			}
		}
	xmlhttp.open("POST","aux_servicios.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id="+id+"&code=1"+"&contrato="+contrato);
}

function mod_hrs(id){
	hrs=prompt("Introduce la cantidad ")
	if(hrs==''){
		hrs='0';
	}
	if(hrs!=null){
		update_hrs(id,hrs)
	}
}
function mod_hrs2(id){
    c=prompt("Introduce la cantidad de PIEZAS");
    h=prompt("Introduce la cantidad de HORAS");
    if(c>1 && c!=null){
         if(h>1 && h!=null){
            update_hrs(id,c+"/"+h);
        }else{
            alert("Error la cantidad de HORAS debe de ser mayor o igual a 1");
        }
    }else{
        alert("Error la cantidad de PIEZAS debe de ser mayor o igual a 1");
    }
}
function update_hrs(id,hrs){
	var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	 }else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("mi_tabla").innerHTML=xmlhttp.responseText;
			}
		}
	xmlhttp.open("POST","mis_servicios.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("op=mod_hrs&id="+id+"&hrs="+hrs+"&contrato="+contrato);
}
function borrar_service(id){
	if(confirm("Esta seguro de eliminar el servicio?")){
		var xmlhttp;
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		 }else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					document.getElementById("mi_tabla").innerHTML=xmlhttp.responseText;
				}
			}
		xmlhttp.open("POST","mis_servicios.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("op=borrar&id="+id+"&contrato="+contrato);
	}
}
function Error(){
	document.getElementById("Error").style.display = "none";
}
function Finalizar(){ 
    c=document.getElementById("comment").value;
	if(confirm("Esta seguro de Guardar los cambio una vez guardada ya no se podrá modificar")){
		window.location.href = 'CreaLogistica.php?contrato='+contrato+"&comentario="+c;
	}
}

function opcional(index){
    or=index;
    document.getElementById("alerta_opcional").style.display="block";
    document.getElementById("alerta_opcional").style.background="red";
}
function cancelarOR(){
    document.getElementById("alerta_opcional").style.display="none";
    or="#";
}

</script>
</head>
<!--




-->
<!-- CUERPO DEL WEB-->
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" onload='agregar2("xdx",0)'>


<?php
$usuario=$_SESSION['usu'];
echo      "<b>&nbsp&nbsp&nbsp usuario:  ".$usuario."</b>";
$id = $_GET["numero"];
?>
</div>
<br />
<br /><br />
<br />
<div align="center">
    Seleccione los Servicios Requeridos</br>
<?php
$info_contrato=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_GET["numero"]."'"));
echo "<b>".$info_contrato['Numero']." ".$info_contrato['nombre']." Adultos=".$info_contrato['c_adultos']."($".number_format($info_contrato["p_adultos"],2,".",",").")"." Jovenes=".$info_contrato['c_jovenes']."($".number_format($info_contrato["p_jovenes"],2,".",",").")".utf8_decode(" Niños").$info_contrato['c_ninos']."($".number_format($info_contrato["p_ninos"],2,".",",").")"."</b>";
?>
 <button id='alerta_opcional' width='310px' onclick='cancelarOR()' style='background:#fff;color:#fff;display:none;'>
    <b id='text_alert'>Cancelar seleccion de servicio</b></button>
<button class='finalizar' onclick='Finalizar()'>Finalizar</button>
</div>
<br /><br />

<?php
	////obtenemos las categorias de los servicios para el menu
	$consulta0=mysql_query("select * from Servicios_categorias order by nombre");
	echo "<div class='menu_servicios'>
	<ul>";
	while($cat_menu=mysql_fetch_array($consulta0)){
		$mcat='"'.$cat_menu['id'].'"';
        if($cat_menu['nombre']!="NO BORRAR" && $cat_menu['nombre']!="MANTELERIA" && $cat_menu['nombre']!="PEWTER EVENTOS" && $cat_menu['nombre']!="MOBILIARIO EVENTOS" && $cat_menu['nombre']!="TEMATICA EVENTOS"){////eliminamos las categorias que no queremos que se muestren
            echo "<li onclick='mostrar(".$mcat.")'><a>".$cat_menu['nombre']."</a></li>";
        }
	}
	echo "</ul></div>";

	echo "<div id='contenedor-padre' >";
		////obtenemos las categorias de los servicios para llenar los input
		$consulta=mysql_query("select tipo from Servicios group by tipo order by tipo");
		$index=0;
		while($categorias=mysql_fetch_array($consulta)){
			$default='';
			if($index==0){
				$default="style='display:block;'";
				$index++;
			}
			echo "<div id='".$categorias["tipo"]."' ".$default." class='categorias_servicio'>";
            $name_cat2=mysql_fetch_array(mysql_query("select * from Servicios_categorias where id=".$categorias["tipo"]));
				echo "<h1>".$name_cat2['nombre']."</h1><br>";
				////obtenemos los servicios segun su categoria
				echo '<select id="select" multiple size="10"  style="width:400px;border-color:#000" onchange="mostrar_info(this.value)"/> ';
				$services=mysql_query("select * from Servicios where tipo='".$categorias['tipo']."' order by Servicio");
				while($m=mysql_fetch_array($services)){
					echo "<option value='".$m['id']."' ondblclick='agregar(".$m['id'].")'>".$m['Servicio']."</option>";
				}
				echo '</select><br>';
			echo "</div>"; 
		}
		echo "<div id='descripcion' class='descripcion'>";
		echo "<h1>Descripcion</h1><br>
				<p id='abc'></p>";
		echo "</div>";
	echo "</div>";
	echo "<div id='mi_tabla' class='mi_tabla'>";
	echo "</div>";
	echo "<div id='observaciones' class='observaciones'>";
	echo "OBSERVACIONES<br><br><textarea id='comment' style='text-indent:0px;width:150px;height:100px;'>".$info_contrato['comentario_H_A']."</textarea>";
	echo "</div>";
?>

<div class='pie' align="center" style='position:fixed;bottom:0px;'> <MARQUEE WIDTH=50% HEIGHT=20 align="bottom" bgcolor=""><b> Sistema Villa Conin V 3.0 </b></MARQUEE><br />copyright - 2014 powered by MBR soluciones </div>

</body>


</html>
