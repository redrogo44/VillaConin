<?php
session_start();
require 'funciones2.php';
conectar();

if($_POST['code']=='fin'){
    $renta=mysql_fetch_array(mysql_query("select * from Servicios where Servicio='RENTA'"));
    mysql_query("INSERT INTO logistica(numero,servicio,fecha_i,hora_i,fecha_f,hora_f) VALUES ('".$_POST['contrato']."',".$renta['id'].",'0000-00-00','00:00:00','".$_POST['fecha']."','".$_POST['hora']."')");

    ////actualizacion del contacto con el cliente
	vcontacto($_POST['contrato']);
   header('Location: NuevaLogistica.php?numero='.$_POST['contrato']);
	}
else if($_GET['code']=='modificar'){
    
	$log=mysql_fetch_array(mysql_query("select * from logistica where servicio=".$_GET['id']." and numero='".$_GET['contrato']."'"));
	echo "<table><form action='logistica_form.php' method='POST'>
	<input type='hidden' name='code' value='actualizar_ff'>
	<input type='hidden' name='contrato' value='".$_GET['contrato']."'>";
	echo "<tr><td colspan='2' align='center'><b>Selecciona la hora de finalizacion del evento</b></td></tr>";
	echo "<tr><td>Fecha</td><td><input type='date' name='fecha' value='".$log['fecha_f']."'></td></tr>";
	echo "<tr><td>Hora</td><td><input type='time' name='hora' value='".$log['hora_f']."'></td></tr>";
	echo "<tr><td><button>GUARDAR</button></form></td><td><button onclick='window.close();'>CANCELAR</button></td></tr>";
	echo "</table>";
	
}else if($_POST['code']=='actualizar_ff'){
	 ////actualizacion del contacto con el cliente
	vcontacto($_POST['contrato']);
	$renta=mysql_fetch_array(mysql_query("select * from Servicios where Servicio='RENTA'"));
	mysql_query("update logistica set fecha_f='".$_POST['fecha']."',hora_f='".$_POST['hora']."' where numero='".$_POST['contrato']."' and servicio=".$renta['id']);
	//echo "update logistica set fecha_f='".$_POST['fecha']."',hora_f='".$_POST['hora']."' where numero='".$_POST['contrato']."' and servicio=".$renta['id'];
	echo "<script>";
	echo "window.opener.location.reload();";
	echo "window.close();";
	echo "</script>";

}else if($_GET['code']=='modificar_comida'){
	$log=mysql_fetch_array(mysql_query("select * from logistica where servicio=".$_GET['id']." and numero='".$_GET['contrato']."'"));
	if(!isset($log["servicio"])){
		 mysql_query("INSERT INTO logistica(numero,servicio,fecha_i,hora_i,fecha_f,hora_f) VALUES ('".$_GET['contrato']."',".$_GET['id'].",'0000-00-00','00:00:00','0000-00-00','00:00:00')");
		$log=mysql_fetch_array(mysql_query("select * from logistica where servicio=".$_GET['id']." and numero='".$_GET['contrato']."'"));
	}
	echo "<table><form action='logistica_form.php' method='POST'>
	<input type='hidden' name='code' value='actualizar_comida'>
	<input type='hidden' name='id' value='".$_GET["id"]."'>
	<input type='hidden' name='contrato' value='".$_GET['contrato']."'>";
	echo "<tr><td colspan='2' align='center'><b>Selecciona la hora de la comida</b></td></tr>";
	echo "<tr><td>Fecha inicio</td><td><input type='date' name='fecha_i' value='".$log['fecha_i']."'></td></tr>";
	echo "<tr><td>Hora inicio</td><td><input type='time' name='hora_i' value='".$log['hora_i']."'></td></tr>";
	echo "<tr><td>Fecha fin</td><td><input type='date' name='fecha_f' value='".$log['fecha_f']."'></td></tr>";
	echo "<tr><td>Hora fin</td><td><input type='time' name='hora_f' value='".$log['hora_f']."'></td></tr>";
	echo "<tr><td><button>GUARDAR</button></form></td><td><button onclick='window.close();'>CANCELAR</button></td></tr>";
	echo "</table><br><br><br>";
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
	
}else if($_POST['code']=='actualizar_comida'){
	////actualizacion del contacto con el cliente
	vcontacto($_POST['contrato']);
	
	$datetime1 = new DateTime($_POST['fecha_i']." ".$_POST['hora_i']);
	$datetime2 = new DateTime($_POST['fecha_f']." ".$_POST['hora_f']);
	$interval = date_diff($datetime1, $datetime2);
	$x=$interval->format("%H:%I:%S");
	$d=explode(":",$x);
	$num=$d[0]+($d[1]/60);
	mysql_query("update logistica set fecha_i='".$_POST["fecha_i"]."',hora_i='".$_POST["hora_i"]."',fecha_f='".$_POST['fecha_f']."',hora_f='".$_POST['hora_f']."',tiempo=".$num." where numero='".$_POST['contrato']."' and servicio=".$_POST['id']);
	//echo "update logistica set fecha_f='".$_POST['fecha']."',hora_f='".$_POST['hora']."' where numero='".$_POST['contrato']."' and servicio=".$renta['id'];
	echo "<script>";
	echo "window.opener.location.reload();";
	echo "window.close();";
	echo "</script>";

}else if($_GET["code"]=="modificar_recepcion"){
	$datos=mysql_fetch_array(mysql_query("select * from logistica where servicio=".$_GET["id"]." and numero='".$_GET["contrato"]."'"));
	echo "<form action='logistica_form.php' method='POST'><table>";
	echo "<tr><td colspan='4' align='center'>RECEPCION</td><tr>";
	echo "<tr><td colspan='2' align='center'>INICIO</td><td colspan='2' align='center'>FIN</td><tr>";
	echo "<tr><td><input type='date' name='fi' value='".$datos["fecha_i"]."'></td>";
	echo "<td><input type='time' name='hi' value='".$datos["hora_i"]."'></td>";
	echo "<td><input type='date' name='ff' value='".$datos["fecha_f"]."'></td>";
	echo "<td><input type='time' name='hf' value='".$datos["hora_f"]."'></td></tr>";
	echo "<input type='hidden' name='contrato' value='".$_GET["contrato"]."'>";
	echo "<input type='hidden' name='servicio' value='".$_GET["id"]."'>";
	echo "<input type='hidden' name='code' value='actualiza_recepcion'>";
	echo "<tr><td colspan='4' align='center'><br><br><input type='submit' value='Guardar'></td></tr>";
	echo "</table></form><br><br><br>";
	
	$info_s=mysql_fetch_array(mysql_query("select * from Servicios where id=".$_GET['id'])); 
    //////////validamos la exitencia de cruce de horarios solo para los de tipo recepcion
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
	
}else if($_POST["code"]=="actualiza_recepcion"){
	/////calculamos el tiempo de recepcion 
	$datetime1 = new DateTime($_POST['fi']." ".$_POST['hi']);
	$datetime2 = new DateTime($_POST['ff']." ".$_POST['hf']);
	$interval = date_diff($datetime1, $datetime2);
	$x=$interval->format("%H:%I:%S");
	$d=explode(":",$x);
	$num=$d[0]+($d[1]/60);
	//////actualizamos la renta del salon
	$renta=mysql_fetch_array(mysql_query("select * from Servicios where Servicio='RENTA'"));
    mysql_query("update logistica set fecha_i='".$_POST['fi']."',hora_i='".$_POST['hi']."' where numero='".$_POST['contrato']."' and servicio=".$renta['id']);
	////actualizamos servicio de recepcion
	$ex=mysql_fetch_array(mysql_query("select * from logistica where servicio=".$_POST["servicio"]." and numero='".$_POST["contrato"]."'"));
	//echo "select * from logistica where servicio=".$_POST["servicio"]." and numero='".$_POST["contrato"]."'";
	if(!isset($ex["servicio"])){
		mysql_query("INSERT INTO logistica(numero,servicio,fecha_i,hora_i,fecha_f,hora_f,tiempo) VALUES ('".$_POST['contrato']."',".$_POST['servicio'].",'".$_POST['fi']."','".$_POST['hi']."','".$_POST['ff']."','".$_POST['hf']."',".$num.")");
	}else{
		mysql_query("update logistica set fecha_i='".$_POST["fi"]."',hora_i='".$_POST["hi"]."',fecha_f='".$_POST["ff"]."',hora_f='".$_POST["hf"]."',tiempo=".$num." where numero='".$_POST["contrato"]."' and servicio=".$_POST["servicio"]);
	}
	////actualizamos la version de la logistica
	vcontacto($_POST['contrato']);
	echo "<script>
	window.opener.location.reload(); window.close();
	</script>";
}
	
//header('Location: NuevaLogistica.php?numero='.$_POST['contrato']);
?>