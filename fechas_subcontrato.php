<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'funciones2.php';
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
 
 <title>Villa Conin</title>
<head> 
<script type="text/javascript" src="js/shortcut.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
 <link rel="stylesheet" href="subcontratos.css" type="text/css" /> 
 <link rel="stylesheet" href="demo.css">
</head> 
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
				right:-142px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
			#fname{
				font-family: Arial; font-size: 15pt; 
				
				}
			#btn{
				-moz-box-shadow:inset 0px 2px 0px 0px #cae3fc;
				-webkit-box-shadow:inset 0px 2px 0px 0px #cae3fc;
				box-shadow:inset 0px 2px 0px 0px #cae3fc;
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #4197ee) );
				background:-moz-linear-gradient( center top, #79bbff 5%, #4197ee 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#4197ee');
				background-color:#79bbff;
				-webkit-border-top-left-radius:0px;
				-moz-border-radius-topleft:0px;
				border-top-left-radius:0px;
				-webkit-border-top-right-radius:0px;
				-moz-border-radius-topright:0px;
				border-top-right-radius:0px;
				-webkit-border-bottom-right-radius:0px;
				-moz-border-radius-bottomright:0px;
				border-bottom-right-radius:0px;
				-webkit-border-bottom-left-radius:0px;
				-moz-border-radius-bottomleft:0px;
				border-bottom-left-radius:0px;
				text-indent:-3.93px;
				border:1px solid #469df5;
				display:inline-block;
				color:#ffffff;
				font-family:Arial;
				font-size:20px;
				font-weight:bold;
				font-style:normal;
				height:47px;
				line-height:47px;
				width:104px;
				text-decoration:none;
				text-align:center;
				text-shadow:5px 4px 0px #155ba1;
				}
   </style>
	

<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff" align='center' >
<br><br><br><br><br><br><center>

<?php
conectar();

if(isset($_POST['Guardar'])){//validamos para guardar en la base de datos tabla subcontratos
			for($i=1;$i<=$_POST['cantidad'];$i++){//creamos un string con las fechas y poder guardalas
				$sub='f'.$i;
				$f=$f.$_POST[$sub]."%";
			}
			//agragar sentencia de subcontrato o cotrato para hacer el update
			
			$f=fechas_anteriores($_POST['numero']).$f;
			
			$insert='update subcontratos set fechas="'.$f.'" where numero like "%'.$_POST['numero'].'%"';
			$insertar=mysql_query($insert);
			
			echo '<META HTTP-EQUIV="Refresh" CONTENT="1; URL=MSaldo.php?numero='.$_POST['numero'].'">';
		}else{
		$q=mysql_query('select * from contrato where Numero="'.$_GET['numero'].'"');
		$m=mysql_fetch_array($q);
		if(isset($_POST['cantidad'])){//validamos si ya contamos con la cantidad de abonos que se van a realizar insertar fechas
			$q=mysql_query('select * from contrato where Numero="'.$_POST['numero'].'"');
			$m=mysql_fetch_array($q);
			echo "<form action='fechas_subcontrato.php' method='POST'>";
			for($i=1;$i<=$_POST['cantidad'];$i++){
				echo "<label><font size='5'>Fecha ".$i."°&nbsp&nbsp</font></label><input type='date' name='f".$i."'  size='10' id='f".$i."' onchange='repetidos(value)' min='".date('Y-m-d')."' max='".$m['Fecha']."' required><br>";
			}
			echo "<input type='hidden' name='cantidad' value='".$_POST['cantidad']."' >";
			echo "<input type='hidden' name='numero' value='".$_POST['numero']."' >";
			echo "<br><br><input type='submit' value='Guardar' name='Guardar' id='btn' ></form>";
		}elseif(existenfechas($_GET['numero']) && $_GET['op']!='agregar'){
			//Se imprime panel de modificaciones
			
			if($_GET['op']=='borrar'){
				borrarfecha($_GET['numero'],$_GET['index']);
			}elseif($_GET['op']=='modificar'){
				modificarfecha($_GET['numero'],$_GET['index'],$_GET['fecha_nueva']);
			}
			modificar($_GET['numero']);
		}else{//se pide la cantidad de abonos a realizar
		
			echo '<div id="style1"class="style1">';
			echo "<table>";
			echo "<tr></tr>";
			echo "<tr><td><label><font size='4'>Nombre del contrato</font></label></td><td><font size='4'>".$m['nombre']."</font></td></tr>";
			echo "<tr><td><label><font size='4'>Fecha del Evento</font></label></td><td><font size='4'>".$m['Fecha']."</font></td></tr>";
			$meses=round(dias_transcurridos(date('Y-m-d'),$m['Fecha'])/30,0);
			echo "<tr><td><label><font size='4'>Meses faltantes</font></label></td><td><font size='4'>".$meses."</font></td></tr>";
			echo "</table>";
			echo "</div><br><br><br>";
			echo "<form action='fechas_subcontrato.php' method='POST'>
				<label><font size='5'>Cantidad de Abonos&nbsp&nbsp</font></label><input type='number' min='1' name='cantidad' size='10' id='fname' required>
					<input type='hidden' name='numero' value='".$_GET['numero']."' ><br><br>";
			echo "<input type='hidden' name='sub' value='1'>";
			echo"<input type='submit' value='Generar' id='btn'>
				</form>";
			
		}
}

function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias;
}

function existenfechas($n){
	
		$q="select * from subcontratos where numero like '".$n."%'";
		$r=mysql_query($q);
		$m=mysql_fetch_array($r);
		$cantidad=$m['fechas'];
	
	
	if($cantidad!=''){
		$b=true;
	}else{
		$b=false;
	}
	return $b;
}

function subcontrato($n){
	$arreglo=explode('-',$n);//obtenemos un arreglo apartir del numero de contrato y saber si mostramos el contrato general o no
	$c_arreglo=count($arreglo);
	if($c_arreglo==1){
		$b=false;
	}else{
		$b=true;
	}
	return $b;
}
function modificar($n){

	$q="select * from subcontratos where numero like '".$n."%'";
	$r=mysql_query($q);
	$m=mysql_fetch_array($r);
	$cantidad=$m['fechas'];
	$q2="select * from contrato where Numero='".$n."'";
	$r2=mysql_query($q2);
	$m2=mysql_fetch_array($r2);
	
	$arreglo=explode('%',$cantidad);
	echo "<a href='fechas_subcontrato.php?numero=".$n."&op=agregar'><button id='btn'>Agregar</button></a>
	<a href='MSaldo.php?numero=".$n."'><button id='btn'>Regresar</button></a><br><br>";
	echo "<table border='1'>";
	echo "<tr><th>Fecha</th><th>Modificar</th><th>Borrar</th></tr>";
	for($i=0;$i<count($arreglo)-1;$i++){
		if($i+1==count($arreglo)-1){
			$max=$m2['Fecha'];
		}else{
			$max=$arreglo[$i+1];
		}
		if($i-1==-1){
			$min=date('Y-m-d');
		}else{
			$min=$arreglo[$i-1];
		}
		$index='"numero='.$n.'&index='.$i.'&op=modificar&min='.$min.'&max='.$max.'"';
		$index2='"numero='.$n.'&index='.$i.'&op=borrar"';
		echo "<tr><td>".$arreglo[$i]."</td><td align='center'><button onclick='modificar(".$index.")'><img width='25px' height='25px' src='Config/img/modificar.ico'></button></td>
		<td align='center'><button onclick='borrar(".$index2.")'><img width='25px' height='25px' src='Config/img/borrar.ico'></button></td></tr>";
	}
}
function modificarfecha($n,$i,$fecha_nueva){

	$q="select * from subcontratos where numero like '".$n."%'";
	$r=mysql_query($q);
	$m=mysql_fetch_array($r);
	$f=$m['fechas'];
	
	$arreglo=explode('%',$f);
	$all='';
	for($in=0;$in<count($arreglo)-1;$in++){
		if($i==$in){
			$all=$all.$fecha_nueva."%";
		}else{
			$all=$all.$arreglo[$in]."%";
		}
	}
	$r=mysql_query("update subcontratos set fechas='".$all."' where numero like '".$n."%'");
}
function borrarfecha($n,$i){
	
	$q="select * from subcontratos where numero like '".$n."%'";
	$r=mysql_query($q);
	$m=mysql_fetch_array($r);
	$f=$m['fechas'];
	
	$arreglo=explode('%',$f);
	$all='';
	for($in=0;$in<count($arreglo)-1;$in++){
		if($i==$in){
			
		}else{
			$all=$all.$arreglo[$in]."%";
		}
	}
	
	$r=mysql_query("update subcontratos set fechas='".$all."' where numero like '".$n."%'");
	
}
function fechas_anteriores($n){

	$q="select * from subcontratos where numero like '".$n."%'";
	$r=mysql_query($q);
	$m=mysql_fetch_array($r);
	$f=$m['fechas'];
	
	return $f;
} 

?>
<script>

function repetidos(numero){
	c=0;
	<?php
	for($i=1;$i<=$_POST['cantidad'];$i++){
	if($i+1<=$_POST['cantidad']){
		echo'
		var x'.$i.' = document.getElementById("f'.$i.'").value;
		var x'.($i+1).' = document.getElementById("f'.($i+1).'");
		x'.($i+1).'.setAttribute("min", x'.$i.');
		';
	}else{
	}
	}
	for($i=1;$i<=$_POST['cantidad'];$i++){
	echo "if(document.getElementById('f".$i."').value==numero){
		c=c+1;
	}";
	}
	?>
	if(c>1){
		alert('¡¡ ERROR !!   FECHA DUPLICADA');
	}
}
function modificar(index){	
location.href='calendario_subcontratos.php?'+index;
}
function borrar(index){
location.href='fechas_subcontrato.php?'+index;
}
function regresar(n){
location.href='MSaldo.php?'+n;
}
</script>
</center>
</body>
</html>