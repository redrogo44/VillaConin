<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php

require 'msnreajuste.php';
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
<meta http-equiv="refresh" content="0; url=https://villaconin.mx/" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cancelacion del Cargo</title>
			
<script>
function cargar() {
	window.open("https://villaconin.mx/CancelacionAbono.php");
}
</script>

<?php
conectar();
$id=$_GET['numero'];
// Insertar Tabla CargosCancelados
$facturado=$_GET['facturado'];

if($facturado=='si')
{
$buscar="SELECT * from abonofac WHERE id=".$id."";
	$banM="1";
}
else
{
	$buscar="SELECT * from abono WHERE id=".$id."";
	$banM="0";
}
$consulta1=mysql_query($buscar);
while($muestra=mysql_fetch_array($consulta1)){
 	 	 	
    $nom = $muestra["numcontrato"]; 
    $con = $muestra["concepto"]; 
    $total =$muestra["cantidad"]; 
	$fechacargo=$muestra["fechapago"];
	$cuenta=$muestra["cuenta"];

	}
	
$insertar="INSERT INTO Cancelaciones (numcontrato,concepto,cantidad,fechamovimiento,fecha,folio,tipo,cuenta,facturado) VALUES ('".$nom."','".$con."',".$total.",'".$fechacargo."','".date('Y-m-d')."',".$id.",'Abono','".$cuenta."','".$facturado."');";
mysql_query($insertar);// Inserta los Datos


/*//obtenemos los datos de la cuenta para devolver el dinero
$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$cuenta));
$insert_abono=mysql_query("insert into Movimientos_Cuentas(fecha,banco_emisor,cuenta_emisor,banco_receptor,cuenta_receptora,cantidad, concepto,facturado) values('".date('Y-m-d')."','".$obtener_cuenta["banco"]."','".$obtener_cuenta["id"]."','cancelacion_abono','cancelacion_abono',".$total.",'cancelacion_abono','".$banM."')");*/

$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$cuenta));
$upMC="update Movimientos_Cuentas set estatus='suspendido' where facturado='".$banM."' and referencia=".$id." and concepto='abono'";
mysql_query($upMC);
///actualizamos saldo final de la cuenta restandole lo devuelto al cliente ya viene en negativo por eso se suma 
$saldo_actual_cuenta=$obtener_cuenta["saldo_final"]-$total;
$actualiza_saldo_cuenta=mysql_query("update Cuentas set saldo_final=".$saldo_actual_cuenta." where id=".$cuenta);
	
	
	
	
	
	
	
$cons_q="select * from contrato where Numero='".$nom."'";

$consulta=mysql_query($cons_q);
while($can=mysql_fetch_array($consulta)){
	$cantidad=$can['sa']+$total;
	
	
	$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$nom."'");// Modificar el saldo actual
	}


if (!$insertar) { 
die("'".$insertar."' mbr datos no insertados:" . mysql_error()); 
}
///////////////////////7
if($facturado=='si')
{
	$borrarcargo=mysql_query("DELETE FROM `abonofac` WHERE id='".$id."'");// Borrar Cargo de la tabla
}
else
{
	$borrarcargo=mysql_query("DELETE FROM `abono` WHERE id='".$id."'");// Borrar Cargo de la tabla
}
	$msj="Estimado cliente:<br>
	
	
		Este correo electrónico ha sido generado automáticamente por el sistema, por lo que le solicitamos no responder a este mensaje, ya que las respuestas a este correo electrónico no serán leídas. En caso de tener alguna duda referente a la información contenida, llame para su aclaración a los siguientes números telefónicos:
		<br>
		(442) 2.77.40.32 o 2.77.41.17
		De lunes a sábado
		De 10:00am a 6:00pm<br><br>";
		$fin="</body></html>";
		$msj=mensaje().$msj.principal($nom).$fin;
		//mail('benja_map@hotmail.com', 'IMPORTANTE CANCELACION ABONO', utf8_decode($msj), "From: administracion@sistemavc.com \r\nContent-type: text/html\r\n");
		mail($correo, 'IMPORTANTE CANCELACION ABONO', utf8_decode($msj), "From: administracion@sistemavc.com \r\nContent-type: text/html\r\n");
		//mail($correo, 'IMPORTANTE PAGOS', $msj, "From: administracion@sistemavc.com \r\n");

	   function mensaje(){
	   $msj="<html>
<head>
	<style>
		progress {
			width: 500px;
			height: 20px;
			margin-top: 50px;
			/* Important Thing */
			-webkit-appearance: none;
			border: none;
		}

		/* All good till now. Now we'll style the background */
		progress::-webkit-progress-bar {
			background: black;
			border-radius: 50px;
			padding: 2px;
			box-shadow: 0 1px 0px 0 rgba(255, 255, 255, 0.2);
		}

		/* Now the value part */
		progress::-webkit-progress-value {
			border-radius: 50px;
			box-shadow: inset 0 1px 1px 0 rgba(255, 255, 255, 0.4);
			background:
				-webkit-linear-gradient(45deg, transparent, transparent 33%, rgba(0, 0, 0, 0.1) 33%, rgba(0, 0, 0, 0.1) 66%, transparent 66%),
				-webkit-linear-gradient(top, rgba(255, 255, 255, 0.25), rgba(0, 0, 0, 0.2)),
				-webkit-linear-gradient(left, #ba7448, #c4672d);
			
			/* Looks great, now animating it */
			background-size: 25px 14px, 100% 100%, 100% 100%;
			-webkit-animation: move 5s linear 0 infinite;
		}

		/* That's it! Now let's try creating a new stripe pattern and animate it using animation and keyframes properties  */

		@-webkit-keyframes move {
			0% {background-position: 0px 0px, 0 0, 0 0}
			100% {background-position: -100px 0px, 0 0, 0 0}
		}
		#box{
			color:#000;
			width: 100px;
			height: 120px;
			margin-top: 15px;
			padding-top: 15px;
			margin-left: 15px;
			float: left;
			background-color: rgba(43, 132, 255, 0.6);
			background: rgba(43, 132, 255, 0.6);
			
		}
		#box2{
			color:#000;
			width: 100px;
			height: 120px;
			margin-top: 15px;
			padding-top: 15px;
			margin-left: 15px;
			float: left;
			background-color: rgba(222, 150, 69, 1);
			background: rgba(222, 150, 69, 1);
			
		}
		#box3{
			color:#000;
			width: 100px;
			height: 120px;
			margin-top: 15px;
			padding-top: 15px;
			margin-left: 15px;
			float: left;
			background-color: rgba(255, 37, 24, 0.8);
			background: rgba(255, 37, 24, 0.8);
		}
		#box4{
			color:#000;
			width: 100px;
			height: 120px;
			margin-top: 15px;
			padding-top: 15px;
			margin-left: 15px;
			float: left;
			background-color: rgba(87, 192, 65, 0.6);
			background: rgba(87, 192, 65, 0.6);
		}
		#scroll {
			width: 500px;
			height: 250px;
			overflow-y: scroll;
		}
	</style>
</head>
<body>
<center>";
	   return $msj;
	   }
?>
</head> 
<body onload="cargar()">
</body>
</html>