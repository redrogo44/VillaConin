<html>
<?php
session_start();
require 'funciones2.php';
//validarsesion();
conectar();
$nivel=$_SESSION['niv'];
?>
 <head>
     <title>Villa Conin</title>
</head>
<body   bgcolor="#fff">
<?php
if($_GET['op']=='agregar'){
    $c=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_GET['contrato']."'"));
    echo "
    <table border='6' bordercolor='#990000'>
    <tr><th colspan='2'>Incio</th><th colspan='2'>Final</th></tr>
    <tr><th>Fecha</th><th>Hora</th><th>Fecha</th><th>Hora</th></tr>
    <tr><th colspan='4' align='center'><br><br></th></tr>
    <form action='popupLogisticaA.php' method='POST' onsubmit='return validacion()'>
    <tr><th colspan='4' align='center'><input type='text' name='actividad' placeholder='____NOMBRE DE LA ACTIVIDAD____' style='width:250px;' required></th></tr>
    <tr><td><input type='date' id='fi' name='fi' value='".$c['Fecha']."' required></td><td><input type='time' id='hi' name='hi' required></td>
    <td><input type='date' id='ff' name='ff' value='".$c['Fecha']."' required></td><td><input type='time' id='hf' name='hf' required></td></tr>
    <input type='hidden' name='contrato' value='".$_GET['contrato']."'>
    <input type='hidden' name='op' value='agregar'>
    <tr><th colspan='4' align='center'><input type='submit' name='submit' value='Guardar'></th></tr>
    </form>
    </table>    
    ";
}else if($_POST['op']=='agregar' && isset($_POST['submit'])){
    $datetime1 = new DateTime($_POST['fi']." ".$_POST['hi']);
	$datetime2 = new DateTime($_POST['ff']." ".$_POST['hf']);
	$interval = date_diff($datetime1, $datetime2);
	$x=$interval->format("%H:%I:%S");
	$d=explode(":",$x);
	$num=$d[0]+($d[1]/60);
    $q="INSERT INTO Actividades(numero, actividad, fecha_i, hora_i, fecha_f, hora_f, tiempo)     VALUES('".$_POST['contrato']."','".$_POST['actividad']."','".$_POST['fi']."','".$_POST['hi']."','".$_POST['ff']."','".$_POST['hf']."',".$num.")";
   ECHO $q;
    mysql_query($q);
    echo "<script>";
    echo "window.opener.location.reload(); window.close();";
    echo "</script>";
}else if($_GET['op']=='modificar'){
    $d=mysql_fetch_array(mysql_query("select * from Actividades where id=".$_GET['id']));
     echo "
    <table border='6' bordercolor='#990000'>
    <tr><th colspan='2'>Incio</th><th colspan='2'>Final</th></tr>
    <tr><th>Fecha</th><th>Hora</th><th>Fecha</th><th>Hora</th></tr>
    <tr><th colspan='4' align='center'><br><br></th></tr>
    <form action='popupLogisticaA.php' method='POST' onsubmit='return validacion()'>
    <tr><th colspan='4' align='center'><input type='text' id='actividad' name='actividad' value='".$d['actividad']."'  style='width:250px;' required></th></tr>
    <tr><td><input type='date' id='fi' name='fi' value='".$d['fecha_i']."' required></td><td><input type='time' id='hi' name='hi'  value='".$d['hora_i']."'required></td>
    <td><input type='date' id='ff' name='ff'  value='".$d['fecha_f']."' required></td><td><input type='time' id='hf' name='hf'  value='".$d['hora_f']."' required></td></tr>
    <input type='hidden' name='id' value='".$_GET['id']."'>
    <input type='hidden' name='contrato' value='".$_GET['contrato']."'>
    <input type='hidden' name='op' value='modificar'>
    <tr><th colspan='4' align='center'><input type='submit' name='submit' value='Guardar'></th></tr>
    </form>
    </table>    
    ";

}else if($_POST['op']=='modificar' && isset($_POST['submit'])){
    $_POST['actividad'] = str_replace('CASIN0', 'CASINO', $_POST['actividad']);
    $datetime1 = new DateTime($_POST['fi']." ".$_POST['hi']);
	$datetime2 = new DateTime($_POST['ff']." ".$_POST['hf']);
	$interval = date_diff($datetime1, $datetime2);
	$x=$interval->format("%H:%I:%S");
	$d=explode(":",$x);
	$num=$d[0]+($d[1]/60);
    $q=mysql_query("update Actividades set  actividad='".$_POST['actividad']."', fecha_i='".$_POST['fi']."', hora_i='".$_POST['hi']."', fecha_f='".$_POST['ff']."', hora_f='".$_POST['hf']."', tiempo=".$num." where id='".$_POST['id']."' ");
    echo "<script>";
    echo "window.opener.location.reload(); window.close();";
    echo "</script>";
}else if($_GET['op']=='borrar'){
    mysql_query("delete from Actividades where id=".$_GET['id']);
    echo "<script>";
    echo "window.opener.location.reload(); window.close();";
    echo "</script>";
}
?>

<script>
function validacion(){
    <?php
    $renta_=mysql_fetch_array(mysql_query("select * from Servicios where Servicio='RENTA'"));
    $lr=mysql_fetch_array(mysql_query("select * from logistica where numero='".$_GET['contrato']."' and servicio=".$renta_['id']));
    echo "var fl='".$lr['fecha_f']."';";
    echo "var hl='".$lr['hora_f']."';";
    ?>
    
    //mod_nom(x);
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
    var d3=new Date(res5[0], res5[1], res5[2], res6[0], res6[1], 0, 0)
	v1=d.getTime();
	v2=d2.getTime();
     v3=d3.getTime();
    if(v2>v3){
        alert("Error la fecha de culminacion no debe de ser mayot a "+fl+" "+hl);
    }else{
        if(v1<v2){
            var str=document.getElementById("actividad").value;
            var str2=str.toUpperCase();
            var res = str2.replace("CASINO", "CASIN0");
            document.getElementById("actividad").value=res;
            r=true;  
        }else{ 
            alert("Error la fecha de culminacion debe ser mayor a la de inicio");
        }
    }
	return r;
}

</script>

</body>
</html>