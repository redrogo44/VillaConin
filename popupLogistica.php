<html>
<?php
session_start();
require 'funciones2.php';
validarsesion();
conectar();
$nivel=$_SESSION['niv'];
////////obtenemos datos del contrato
 $c=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_GET['contrato']."'"));
?>
 <head>
<title>Villa Conin</title>
<script>
function borrar(i){
	window.location="popupLogistica2.php?op=borrar&contrato=<?php echo $_GET['contrato']."&serv=".$_GET['id']."&hrs=".$_GET['hrs']."&id=";?>"+i;
}
</script>
</head>

<body  bgcolor="#fff">

<table border='6' bordercolor='#990000'>
<?php
	$s=mysql_fetch_array(mysql_query("select * from Servicios where id=".$_GET['id']));
	echo "<tr><th colspan='4' align='center'>".$s['Servicio']."</th></tr>";
	echo "<tr><th colspan='2'>Incio</th><th colspan='2'>Final</th></tr>";
	echo "<tr><th>Fecha</th><th>Hora</th><th>Fecha</th><th>Hora</th></tr>";
	$logi=mysql_query("select * from logistica where servicio=".$_GET['id']." and numero='".$_GET['contrato']."'");
	$hrs_cubiertas=0;
	while($log=mysql_fetch_array($logi)){
		$datetime1 = new DateTime($log['fecha_i']." ".$log['hora_i']);
		$datetime2 = new DateTime($log['fecha_f']." ".$log['hora_f']);
		$interval = date_diff($datetime1, $datetime2);
		$x=$interval->format("%H:%I:%S");
		$d=explode(":",$x);
		$num=$d[0]+($d[1]/60);
		$hrs_cubiertas=$hrs_cubiertas+$num;
		echo "<tr><td>".$log['fecha_i']."</td><td>".$log['hora_i']."</td><td>".$log['fecha_f']."</td><td>".$log['hora_f']."</td><td><img src='Imagenes/eliminar.png' width='15px' onclick='borrar(".$log['id'].")'></td></tr>";
		
	}
	
	$hrs_restantes=$_GET['hrs']-$hrs_cubiertas;

?>
<tr><th colspan='4' align='center'><br><br></th></tr>
<form action='popupLogistica2.php' method='POST' onsubmit="return validacion()">
<tr><td><input type='date' id='fi' name='fi' value='<?php echo $c["Fecha"];?>' required></td><td><input type='time' id='hi' name='hi'  required></td>
<td><input type='date' id='ff' name='ff' value='<?php echo $c["Fecha"];?>'  required></td><td><input type='time' id='hf' name='hf'  required></td></tr>
<input type='hidden' name='contrato' value='<?php echo $_GET['contrato'];?>'>
<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
<input type='hidden' name='hrs' value='<?php echo $_GET['hrs'];?>'>
<tr><th colspan='4' align='center'><input type='submit' name='submit' value='Guardar'></th></tr>
</form>
</table>
<br><br>
<button onclick='salir()'>
Salir y Actualizar
</button>
    <br><br><br><br>
    
    <?php
    $info_s=mysql_fetch_array(mysql_query("select * from Servicios where id=".$_GET['id'])); 
    //////////validamos la exitencia de cruce de horarios solo para los de tipo food
    ///obtenemos los contratos que estan son el mismo dia
    $mis_datos=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_GET['contrato']."'"));
    $others=mysql_query("select * from contrato where Fecha='".$mis_datos['Fecha']."'");
    echo "<table border='2'>";
    echo "<tr><th colspan='5' align='center'>".$info_s['Servicio']."</th></tr>";
    echo "<tr><th>Contrato</th><th colspan='2' align='center'>De</th><th colspan='2' align='center'>Hasta</th></tr>";
    while($m=mysql_fetch_array($others)){
        $cruce=mysql_query("select * from logistica where numero='".$m['Numero']."' and servicio=".$_GET['id']);
        while($m2=mysql_fetch_array($cruce)){
               echo "<tr><td>".$m["Numero"]."</td><td>".$m2['fecha_i']."</td><td>".$m2['hora_i']."</td><td>".$m2['fecha_f']."</td><td>".$m2['hora_f']."</td></tr>";
        }
    }
    echo "</table>";
    ?>
    
</body>
<script>
function validacion(){
     <?php
    $renta_=mysql_fetch_array(mysql_query("select * from Servicios where Servicio='RENTA'"));
    $lr=mysql_fetch_array(mysql_query("select * from logistica where numero='".$_GET['contrato']."' and servicio=".$renta_['id']));
    echo "var fl='".$lr['fecha_f']."';";
    echo "var hl='".$lr['hora_f']."';";
    ?>
	r=false;
	fi=document.getElementById('fi').value;
	hi=document.getElementById('hi').value;
	ff=document.getElementById('ff').value;
	hf=document.getElementById('hf').value;
	var res1 = fi.split("-");
	var res2 = hi.split(":");
	var res3 = ff.split("-");
	var res4 = hf.split(":");
    var res5 = fl.split("-");
	var res6 = hl.split(":");
	var d = new Date(res1[0], res1[1], res1[2], res2[0], res2[1], 0, 0);
	var d2 = new Date(res3[0], res3[1], res3[2], res4[0], res4[1], 0, 0);
    var d3=new Date(res5[0], res5[1], res5[2], res6[0], res6[1], 0, 0);
	v1=d.getTime();
	v2=d2.getTime();
    v3=d3.getTime();
    if(v2>v3){
        alert("Error la fecha de culminacion no debe de ser mayor a "+fl+" "+hl);
    }else{
        if(v1<v2){
            dif=(((v2-v1)/1000)/60)/60;
            if(dif<=<?php echo $hrs_restantes;?>){
                r=true;
            }else{
                alert("Error no puede asignar mas de <?php echo $hrs_restantes;?> hrs")
            }
        }else{
            alert("Error la fecha de culminacion debe ser mayor a la de inicio");
        }
    } 
	return r;
}

function salir(){
	window.opener.location.reload(); window.close();
}
</script>

</html>