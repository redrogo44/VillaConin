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
conectar();
if(empty($_GET['numero'])){
	$n=$_POST['numero'];
}else{
	$n=$_GET['numero'];
}

$q="select * from contrato where Numero='".$n."'";
$r=mysql_query($q);
$m=mysql_fetch_array($r);

$fechas=explode('%',$m['fechas']);
$conceptos=explode('%',$m['concepto']);
$montos=explode('%',$m['monto']);
global $fecha_limite;
$fecha_limite=$m['Fecha'];
global $fecha_minima;
global $saldo;
$fecha_minima=date('2012-01-01');
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
			#button {
			   border-top: 1px solid #96d1f8;
			   background: #65a9d7;
			   background: -webkit-gradient(linear, left top, left bottom, from(#3e779d), to(#65a9d7));
			   background: -webkit-linear-gradient(top, #3e779d, #65a9d7);
			   background: -moz-linear-gradient(top, #3e779d, #65a9d7);
			   background: -ms-linear-gradient(top, #3e779d, #65a9d7);
			   background: -o-linear-gradient(top, #3e779d, #65a9d7);
			   padding: 9.5px 19px;
			   -webkit-border-radius: 40px;
			   -moz-border-radius: 40px;
			   border-radius: 40px;
			   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
			   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
			   box-shadow: rgba(0,0,0,1) 0 1px 0;
			   text-shadow: rgba(0,0,0,.4) 0 1px 0;
			   color: white;
			   font-size: 15px;
			   font-family: 'Lucida Grande', Helvetica, Arial, Sans-Serif;
			   text-decoration: none;
			   vertical-align: middle;
			   }
			#button:hover {
			   border-top-color: #28597a;
			   background: #28597a;
			   color: #ccc;
			   }
			#button:active {
			   border-top-color: #175c87;
			   background: #175c87;
			   }
   </style>
	

<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff" align='center' >
<br><br><br><br><br><br><center>

<form action='qwerty.php' method='POST' onsubmit='return error1()'>
<input type='hidden' name='numero' value='<?php echo $n; ?>'>
<input type='hidden' name='opcion' value='agregar'>
<?php if(sumamontos($m['monto'])<$m['si'] || $m['si']<=0){
	echo "<button id='button'>AGREGAR</button>";
} 
?>
</form><br><br>
<div id="style1"class="style1">
	<table border='1'>
		<tr><td>#</td><td>Concepto</td><td>Fecha</td><td>Monto</td><td>Ajuste</td><td></td></tr>
		<?php
		global $saldo;
		
		$si=$m['si'];
			if($_POST['opcion']=='agregar'){
				mostrar($n,$fechas,$conceptos,$montos,$si);
				vacios($n,$m['Fecha']);
			}elseif($_POST['opcion']=='insertar'){
				insertar($n,$_POST);
				echo "<script>";
				echo "location.href='qwerty.php?numero=".$_POST['numero']."'";
				echo "</script>";
			}elseif($_POST['opcion']=='borrar'){
				borrar($n,$fechas,$conceptos,$montos,$_POST['index']);
				echo "<script>";
				echo "location.href='qwerty.php?numero=".$_POST['numero']."'";
				echo "</script>";
			}else{
				mostrar($n,$fechas,$conceptos,$montos,$si);
			}
		?>
	</table>
</div>
<br><br>
	<?php
	if($saldo<=0 && $m['si']>0){
			echo "<button id='button' onclick='abrir()'>Imprimir Contrato</button>";
		}
	?>
</body>
<script>
function abrir(){
window.open('contratoPDF.php?numero='+'<?php echo $n;?>');
window.location='index.php';
}
function error1(){
<?php
if($_POST['opcion']=='agregar'){
echo "alert('PARA AGREGAR UNA NUEVA FECHA PRIMERO DEBE DE GUARDAR LA NUEVA FECHA');return false;";
}
?>
}
</script>

</html>

<?php
function sumamontos($m){
	$monto=explode('%',$m);
	$sum=0;
	for($w=0;$w<count($monto);$w++){
		$sum=$sum+$monto[$w];
	}
	return $sum;
}
function mostrar($n,$fecha,$concepto,$monto,$saldo_inicial){
	global $fecha_minima,$saldo;
	$cantidad=count($fecha);
	echo "<form action='qwerty.php' method='POST'>";
	echo "<input type='hidden' name='numero' value='".$n."'>";
	echo "<input type='hidden' name='opcion' value='borrar'>";
	for($i=0;$i<$cantidad-1;$i++){
		echo "<tr>";
		echo "<td>".($i+1)."</td>";
		echo "<td>".$concepto[$i]."</td>";
		echo "<td>".$fecha[$i]."</td>";
		echo "<td>".$monto[$i]."</td>";
		echo "<td>".$saldo_inicial."</td>";
		$saldo_inicial=$saldo_inicial-$monto[$i];
		echo "<td><button id='btn' name='index' value='".$i."'>Eliminar</button></td>";
		echo "</tr>";
		$fecha_minima=$fecha[$i];
	}
	echo "</form>";
	$saldo=$saldo_inicial;
}
function vacios($n){
global $fecha_minima,$fecha_limite,$saldo;
	echo "<form action='qwerty.php' method='POST'>";
	echo "<input type='hidden' name='numero' value='".$n."'>";
	echo "<input type='hidden' name='opcion' value='insertar'>";
	echo "<tr>";
		echo "<td>".($i+1)."</td>";
		echo "<td><input type='text' name='concepto' required></td>";
		echo "<td><input type='date' name='fecha' min='".$fecha_minima."' max='".$fecha_limite."' required></td>";
		//calculamos para evitar los decimales 
		$r=round($saldo/1,0);
		if($saldo-$r>0){
			$saldo=$saldo+1;
		}
		$can=round($saldo,0);
		
		echo "<td><input type='number' name='monto' min='0' max='".$can."' placeholder='".$can."' required></td>";
		echo "<td>".round($saldo,0)."</td>";
		echo "<td><button id='btn'>Guardar</button></td>";
		echo "</tr>";
		echo "</form>";
}
function insertar($n,$nuevo){
$query="select * from contrato where Numero='".$n."'";
$result=mysql_query($query);
$mostrar=mysql_fetch_array($result);

$conceptos=$mostrar['concepto'].$nuevo['concepto']."%";
$montos=$mostrar['monto'].$nuevo['monto']."%";
$fechas=$mostrar['fechas'].$nuevo['fecha']."%";

$sentencia="update contrato set fechas='".$fechas."',monto='".$montos."',concepto='".$conceptos."' where Numero='".$n."'";
$actualizar=mysql_query($sentencia);

}
function borrar($n,$fecha,$concepto,$monto,$index){
$cantidad=count($fecha);

for($i=0;$i<$cantidad-1;$i++){
	if($i!=$index){
		$fechas=$fechas.$fecha[$i]."%";
		$montos=$montos.$monto[$i]."%";
		$conceptos=$conceptos.$concepto[$i]."%";
	}
}
$sentencia="update contrato set fechas='".$fechas."',monto='".$montos."',concepto='".$conceptos."' where Numero='".$n."'";
$actualizar=mysql_query($sentencia);
}

?>