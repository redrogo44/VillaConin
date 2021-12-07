<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'funciones2.php';
conectar();
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
//$passw=mysql_fetch_array(mysql_query("select * from usuarios"));
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
				  width:800px;
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
				 display:block;}
			.nav li a:hover 
			{
			 background-color:#434343;
			}
			 .nav > li{
				 float:left;}
			.nav li ul {
				display:none;
				position:absolute;
				min-width:-140px;
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
				right:-90px;
				top:0px;}			 
	</style>

<script>
var nuevos_servicios='';

function revisar_comensales(){
	c_a=document.getElementById("c_adultos").value;
	p_a=document.getElementById("p_adultos").value;
	c_j=document.getElementById("c_jovenes").value;
	p_j=document.getElementById("p_jovenes").value;
	c_n=document.getElementById("c_ninos").value;
	p_n=document.getElementById("p_ninos").value;
	
	if( isNaN(c_a) && c_a!='') {
		alert("Debe de introducir un numero en la cantidad de adultos");
		return false;
	}else{
		if( isNaN(p_a) && p_a!='') {
			alert("Debe de introducir un numero en el precio por adulto");
			return false;
		}else{
			if( isNaN(c_j) && c_j!='') {
				alert("Debe de introducir un numero en la cantidad de jovenes");
				return false;
			}else{
				if( isNaN(p_j) && p_j!='') {
					alert("Debe de introducir un numero en el precio por joven");
					return false;
				}else{
					if( isNaN(c_n) && c_n!='') {
						alert("Debe de introducir un numero la cantidad de niños");
						return false;
					}else{
						if( isNaN(p_n) && p_n!='') {
							alert("Debe de introducir un numero en el precio por niño");
							return false;
						}else{
							nt=(c_a*p_a)+(c_j*p_j)+(c_n*p_n);
							if(nt>0){
								returntrue;
							}else{
                                <?php $p=mysql_fetch_array(mysql_query("select * from Configuraciones where id=23 and nombre='password'"));
                                echo "var passw='".$p['valor']."';";?>
								pass=prompt("Para poder realizar un cargo en cero introduzca la clave");
								if(pass==passw){
									return true;
								}else{
									alert("contraseña invalida");
									return false;
								}
							}
						}
					}
				}
			}
		}
	}
}

var contrato='<?php echo $_POST['campo'];?>';
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

function agregar2(id,hrs,precio){
	if(id!=0){
		aux=id+","+hrs+","+precio;
		if(nuevos_servicios==''){
			nuevos_servicios=aux;
		}else{
			nuevos_servicios=nuevos_servicios+";"+aux;
		}
		
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
		xmlhttp.open("POST","nuevos_servicios.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("s="+nuevos_servicios);
	}
}

function agregar(id){ 
	var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	 }else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				if(xmlhttp.responseText=="=)"){
					validar_servicio(id);
				}else{
					alert("YA EXISTE EL SERVICIO SOLO SE PUEDE MODIFICAR O ELIMINAR");
					agregar2(0,0,0);
				}
			}
		}
	xmlhttp.open("POST","nuevos_servicios.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("op=validacion"+"&id="+id+"&s="+nuevos_servicios);
}
    
    function validar_servicio(id){
    /////////////validadmos el tipo de unidad para pedir horas o no
    var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	 }else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
                
                //////dividimos la cadena recibida para substraer el tipo de metrica y su precio
                recibido=xmlhttp.responseText;
                recibido2=recibido.split(",");
                //alert(recibido2[0]);
				if(recibido2[0]=='HORA' || recibido2[0]=='PIEZA'){
                    ///////////si el servicio se cobra por hora
                    hrs=prompt("Introduce la cantidad de "+recibido2[0]+"S \n"+recibido2[2]);
					if( isNaN(hrs) || hrs=='') {
						alert("Debe de introducir un cantidad de "+recibido2[0]+"S");
					}else{
						if(hrs!=null){
							agregar2(id,hrs,recibido2[1]);
						}
					}
                }else if(recibido2[0]=="HORA Y PIEZAS"){
					cantidad=prompt("Introduce el numero de piezas");
                    horas=prompt("Ingresa la cantidad de horas");					
                    if(cantidad!=null && cantidad>0){
                        if(horas!=null && horas>0){
                            conc=cantidad+"/"+horas;
							agregar2(id,conc,recibido2[1]);
							
                        }else{
                            alert("la cantidad de HORAS debe de ser mayor 0 igual a 1");
                        }
                    }else{
                        alert("la cantidad de PIEZAS debe de ser mayor 0 igual a 1");
                    }
                   
                }else{
                    agregar2(id,recibido2[0],recibido2[1]);
                }
			}
		}
	xmlhttp.open("POST","aux_servicios.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id="+id+"&code=11&contrato="+contrato);  
    
    } 
    
    
    
function Error(){
	document.getElementById("Error").style.display = "none";
}

function mod_precio2(i){
	np=prompt("Indroduce el precio","0");
	if( isNaN(np) && np!='') {
		alert("Debe de introducir un precio");
	}else{
		if(np!=null){
			modificar='';
			str=nuevos_servicios;
			res=str.split(";");
			for(ind=0;ind<res.length;ind++){
				if(i==ind){
					res2=res[ind].split(",");
					if(modificar==''){
						modificar=res2[0]+","+res2[1]+","+np;
					}else{
						modificar=modificar+";"+res2[0]+","+res2[1]+","+np;
					}
				}else{
					if(modificar==''){
						modificar=res[ind];
					}else{
						modificar=modificar+";"+res[ind];
					}
				}
			}
		}
	}
	nuevos_servicios=modificar;
	//alert(nuevos_servicios);
	ver();
}
function mod_precio(i){
    pass=prompt("Para modificar el precio, introduzca la contraseña");
    var xmlhttp;
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		 }else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if (xmlhttp.responseText=='OK'){
                        mod_precio2(i);
                    }else{
                        alert("Error password incorrecto");
                    }
                    
				}
			}
		xmlhttp.open("POST","aux_servicios.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("p="+pass+"&code=2");
}
    
function ver(){
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
		xmlhttp.open("POST","nuevos_servicios.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("op=ver"+"&s="+nuevos_servicios);
}
function mod_hrs(i){
	nh=prompt("Indroduce la cantidad ");
	if( isNaN(nh) && nh!='') {
		alert("Debe de introducir un numero");
	}else{
		if(nh!=null){
			modificar='';
			str=nuevos_servicios;
			res=str.split(";");
			for(ind=0;ind<res.length;ind++){
				if(i==ind){
					res2=res[ind].split(",");
					if(modificar==''){
						modificar=res2[0]+","+nh+","+res2[2];
					}else{
						modificar=modificar+";"+res2[0]+","+nh+","+res2[2];
					}
				}else{
					if(modificar==''){
						modificar=res[ind];
					}else{
						modificar=modificar+";"+res[ind];
					}
				}
			}
		}
	}
	nuevos_servicios=modificar;
	ver();
}

function mod_hrs2(i,tipo){
	nh=prompt("Indroduce la cantidad ");
	if( isNaN(nh) && nh!='') {
		alert("Debe de introducir un numero");
	}else{
		if(nh!=null){
			modificar='';
			str=nuevos_servicios;
			res=str.split(";");
			for(ind=0;ind<res.length;ind++){
				if(i==ind){
					res2=res[ind].split(",");
                    ///validamos el tipo
                    if(tipo==1){///modificamos el numero de piezas 
                        cantidad=nh+"/0";
                    }else{ //modificamos el numero de horas 
                        cantidad="0/"+nh;
                    }
                    
					if(modificar==''){
						modificar=res2[0]+","+cantidad+","+res2[2];
					}else{
						modificar=modificar+";"+res2[0]+","+cantidad+","+res2[2];
					}
				}else{
					if(modificar==''){
						modificar=res[ind];
					}else{
						modificar=modificar+";"+res[ind];
					}
				}
			}
		}
	}
	nuevos_servicios=modificar;
	ver();
}
    
function Finalizar(){
    <?php
    if(isset($_POST['logistica'])){
        echo "x='logistica';";
    }else{
        echo "x='';";
    }
    ?>
    window.location="altacargo.php?contrato="+contrato+"&servicios="+nuevos_servicios+"&red="+x;
}

function borrar_service(id){
	str=nuevos_servicios;
	nuevo_A='';
	res=str.split(";");
	for(ind=0;ind<res.length;ind++){
		if(id!=ind){
			if(nuevo_A==''){
				nuevo_A=res[ind];
			}else{
				nuevo_A=nuevo_A+";"+res[ind];
			}
		}
	}
	nuevos_servicios=nuevo_A;
	ver();
	
}
</script>
	 <script type="text/javascript" src="js/shortcut.js"></script>
	<script type="text/javascript" src="js/funciones.js"></script>
	 <link rel="stylesheet" type="text/css" href="css/servicios2.css">
	</head>


<body>

 
 
 
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>
<br><br><br><br><br><center>
<b><h2 style='color:#F32D2D;'>Crear Cargo</h2></b>		
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
			<td><b>Numero de Contrato:</b></td>
			<input type="text" name="campo" size="15" maxlength="35" required="required" placeholder="	Contrato">
			<select name="categoria" size="1" id="categoria">
				<option value='Seleccione Una Opcion'>Seleccione Una Opcion</option>
				<option value='Cargo de Servicio'>Cargo de Servicio</option>
				<option value='Cargo de Comensales'>Cargo de Comensales</option>
			<input type="submit" name="submit" value="Buscar">
		</form>
		<br />
<?php
if(isset($_POST['submit'])){
	////validamos si selecciono una opcion correcta del input type select
	if($_POST['categoria']=="Seleccione Una Opcion"){
		echo "<mark style='background:red;color:#fff;'>SELECCIONE UNA OPCION VALIDA PARA EL CONTRATO ".$_POST['campo']."</mark>";
		exit();
	}
	if($_POST['campo']==''){
		echo "<mark style='background:red;color:#fff;'>SELECCIONE UN CONTRATO</mark>";
		exit();
	}
	//////validamos la existencia del contrato
	$c=mysql_query("select * from contrato where Numero='".$_POST['campo']."'");
	if(mysql_num_rows($c)<1){
		echo "<mark style='background:red;color:#fff;'>EL CONTRATO ".$_POST['campo']." NO EXISTE FAVOR DE VERIFICARLO</mark>";
		exit();
	}else{
		/////////validamos si es contrato general
		$s=mysql_query("select * from contrato where Numero like '%".$_POST['campo']."-%'");
		if(mysql_num_rows($s)>1){/////si existe pero es un contrato gral mostramos todos los subcontrato
			echo "<mark style='background:orange;color:#000;'>El CONTRATO SELECCIONADO ES UN CONTRATO GENERAL SELECCIONE UN SUBCONTRATO</mark>";
			$sub=mysql_query("select * from contrato where Numero like '%".$_POST['campo']."-%'");
			echo "<table border='1'>";
			echo "<tr><th>Contrato</th><th>Nombre</th><th></th></tr>";
			while($m=mysql_fetch_array($sub)){
				echo "<tr><td>".$m['Numero']."</td><td>".$m['nombre']."</td><td><form method='post' action=".$_SERVER['PHP_SELF']." ><input type='hidden' name='categoria' value='".$_POST['categoria']."'><input type='hidden' name='campo' value='".$m['Numero']."'><input type='submit' name='submit' value='Realizar Cargo'></td></tr>";
			}
			echo "</table>";
		}elseif(mysql_num_rows($c)==1){//////es que recibimos un contrato normal o un subcontrato
			////////mostramos los formularios correspondietes al tipo de cargo que se selecciono
			if($_POST['categoria']=='Cargo de Comensales'){
				comensales();
				echo "</center>";
			}else{
				echo "</center>";
                $g=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_POST['campo']."'"));
                 $comensales_cargo=total_comensales($g['numero'],$g['facturado']);
                $adultos=$g["c_adultos"]+$comensales_cargo[0];
                $jovenes=$g["c_jovenes"]+$comensales_cargo[1];
                $ninos=$g["c_ninos"]+$comensales_cargo[2];
                $t_comensales=$adultos+$jovenes+$ninos; 
                
                if($g['facturado']=='si'){
                     $qd="SHOW TABLE STATUS LIKE 'cargofac'";
                }else{
                     $qd="SHOW TABLE STATUS LIKE 'cargo'";
                }
               
                $nf=mysql_fetch_array(mysql_query($qd));
                
                echo "<center><b><font color='red'>COMENSALES:</font>".$t_comensales." <font color='red'>NUMERO:</font>".$g['Numero']." <font color='red'>FOLIO: </font>".$nf['Auto_increment']."</b></center>";
                echo "<center><b><font color='red'>NOMBRE:</font>".$g['nombre']."</b></center>";
				servicios();
			}
		}
	}
}
?>

</body>	
</html>

<?php
function comensales(){
		$consulta="select * from contrato where Numero='".$_POST['campo']."'";
		$resultado=mysql_query($consulta);
		$show=mysql_fetch_array($resultado);
		$comensales_cargo=total_comensales($show['Numero'],$show['facturado']);
		$show['c_adultos']=$show['c_adultos']+$comensales_cargo[0];
		$show['c_jovenes']=$show['c_jovenes']+$comensales_cargo[1];
		$show['c_ninos']=$show['c_ninos']+$comensales_cargo[2];
		$t_adultos=$show['p_adultos']*$show['c_adultos'];
		$t_jovenes=$show['p_jovenes']*$show['c_jovenes'];
		$t_ninos=$show['p_ninos']*$show['c_ninos'];
		$tt=$t_adultos+$t_jovenes+$t_ninos;
		if($show['facturado']=='si'){
			$impuesto=$tt*.16;
		}else{
			$impuesto=0;
		}
		$total=$tt+$impuesto+$show['deposito'];
		if($show['facturado']=='si')
		{
			$qd="SHOW TABLE STATUS LIKE 'cargofac'";
			$r=mysql_query($qd);
			$mra=mysql_fetch_array($r);
			$numax=$mra['Auto_increment'];
		}
		else
		{	$qd="SHOW TABLE STATUS LIKE 'cargo'";
			$r=mysql_query($qd);
			$muestra=mysql_fetch_array($r);
			$muestra['Auto_increment'];
			$numax=$muestra['Auto_increment'];
		}
		echo '<table>
		<tr><td><b>Folio: </b></td><td align="center"><b>'.$numax.'</b></td></tr>
		</table>';				
		$nc="Select * from contrato where Numero='".$_POST['campo']."'";
		$nomb=mysql_fetch_array(mysql_query($nc));
		echo "<br><br/>
		<b>Contrato Numero =</b><font color='red'><b>"." ".$_POST['campo']."</b></font><br>
		<b>Nombre del Contrato =</b><font color='red'><b>"." ".$nomb['nombre']."</b></font>
		<br/><br/>";
		echo '<form name="form_com" action="altacargo.php" method="post" onsubmit="return revisar_comensales()">
		<table border="6" bordercolor="#990000" >
		<tr><td>Descipción</td><td align="center"><b>Cantidad</b></td><td align="center"><b>Precio Unitario</b></td><td align="center" ><b>Precio total</b></td></tr> 
		<tr><td>Adultos</td>
			<td><input type="numeric" id="c_adultos" name="c_adultos" onchange="calcular1()" placeholder="'.$show['c_adultos'].'" required></td>
			<td><input type="text" id="p_adultos" name="p_adultos" onchange="calcular1()" placeholder="'.$show['p_adultos'].'" required>	</td>
			<td><b name="t_adultos" id="t_adultos" >$'.$t_adultos.'</b></td></tr> 
		 <tr><td>Jovenes</td><td><input type="text" id="c_jovenes" name="c_jovenes" onchange="calcular2()" placeholder="'.$show['c_jovenes'].'" required></td>																								
			<td><input type="text" id="p_jovenes" name="p_jovenes" onchange="calcular2()" placeholder="'.$show['p_jovenes'].'"></td>
			<td><b id="t_jovenes" >$'.$t_jovenes.'</b></td></tr> 
		<tr><td>Niños  </td><td><input type="text" id="c_ninos" name="c_ninos" onchange="calcular3()" placeholder="'.$show['c_ninos'].'" required></td><td><input type="text" id="p_ninos" name="p_ninos" onchange="calcular3()" placeholder="'.$show['p_ninos'].'" required>	</td><td><b id="t_ninos" >$'.$t_ninos.'</b></td></tr> 
		</table> ';
										
		echo"<input name='contrato' type='hidden' value ='".$_POST['campo']."' />
		<input name='tipo' type='hidden' value ='Comensales' />
		<input name='tadultos' type='hidden' value ='".$_POST['t_adultos']."' />
		<input name='tninos' type='hidden' value ='".$t_ninos."' />
		<input name='tjovenes' type='hidden' value ='".$t_jovenes."' />
		<input name='cadultos' type='hidden' value ='".$c_adultos."' />
		<input name='cninos' type='hidden' value ='".$c_ninos."' />
		<input name='cjovenes' type='hidden' value ='".$c_jovenes."' />	
		<input name='red' type='hidden' value ='".$_POST['logistica']."' />	
		<input type='submit' name='submit' value='Enviar'>
		</form>
		
		";
}



function servicios(){
	////obtenemos las categorias de los servicios para el menu
	$consulta0=mysql_query("select * from Servicios_categorias order by nombre");
	echo "<div class='menu_servicios'>
	<ul>";
	while($cat_menu=mysql_fetch_array($consulta0)){
		$mcat='"'.$cat_menu['id'].'"';
        if($cat_menu['nombre']!="NO BORRAR"){////eliminamos las categorias que no queremos que se muestren
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
                $name_category=mysql_fetch_array(mysql_query("select * from Servicios_categorias where id=".$categorias["tipo"]));
				echo "<h1>".$name_category['nombre']."</h1><br>";
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
				<p id='abc'>";
		echo "</div>";
	echo "</div>";
	echo "<div id='mi_tabla' class='mi_tabla'>";
	echo "</div>";
	echo "<button class='finalizar' onclick='Finalizar()'>Finalizar</button>";
}

?>