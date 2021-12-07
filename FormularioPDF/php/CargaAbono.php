<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- <META HTTP-EQUIV="Refresh" CONTENT="00; URL=http:../../index.php"> -->
	<title>Cargo de abono</title>
	<script>
	// function cargar() {	
		// window.open("verDatos.php");
		// window.location="../../index.php";
	// }
	</script>
</head>

<?php
	//print_r($_POST);
	//include"../../funciones2.php";
	/////////////////en msnreajuste esta la llamada a funciones2.php
	require 'msnreajuste.php';
	conectar();
	date_default_timezone_set("America/Mexico_City");
	//VALIDAR SI ES SUB-CONTRATO
	$Contrato=explode("-",$_POST['numero']);
	$Contrato[0];
	$Contrato[1];
 "Num= ".count($Contrato);
//
session_start();
$cons=mysql_query("SELECT ");
		
	$NumeroContrato=$_POST['nombre'];
    $folio=$_POST['numero'];
	$fechaactual= date("Y-m-d");
	$recibide=$_POST['recibide'];
	$cantidadde=$_POST['cantidadde'];
	$concepto=$_POST['concepto'];
	$fechaevento=$_POST['fecha_e'];
	$tipoeveto=$_POST['tipo'];
	$salon=$_POST['salon'];
	$ncontrato=$_POST['nombre'];
	$cuenta=$_POST['cuenta'];
	
	$esfacturado="SELECT facturado FROM contrato WHERE Numero ='".$folio."'";
	$r2=mysql_query($esfacturado) or die(mysql_error());
	$factu=mysql_fetch_array($r2);
	$esfac=$factu['facturado'];
	$_SESSION['facturado']=$esfac;
	if($esfac=='si')
	   {
		$insert="
		INSERT INTO abonofac (
			numcontrato,
			nomcontrato,
			cantidad,
			fechapago,
			recibide,
			concepto,
			tipoevento,
			salon,
			fechaevento,
			cuenta
		)
		VALUES (
			'".$folio."',
			'".$ncontrato."',".$cantidadde.",
			'".$fechaactual."',
			'".$recibide."',
			'".$concepto."',
			'".$tipoeveto."',
			'".$salon."',
			'".$fechaevento."',
			'".$cuenta."'
		)";
		$r=mysql_query($insert);
		$set = $r == '1' ? true : false;
		echo "set => " . $set;
		if ($set) {
			?>
				<script>
					window.open("verDatos.php");
				</script>
			<?php 
		} else {
			echo "<h1>OCURRIO ALGUN ERROR AL INSERTAR EL ADELANTO, POR FAVOR INTENTELO DE NUEVO</h1>";
			?>
				<script>
				setTimeout(function () {
					window.location="../../index.php";
				}, 5000);
				</script>
			<?php 
		}
		$id_abono=mysql_fetch_array(mysql_query("SELECT max(id) as m FROM abonofac"));
		////insercion en movimientos cuetas
		$obtener_cuenta=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$cuenta));
		$insert_abono=mysql_query("INSERT INTO Movimientos_Cuentas(fecha,banco_emisor,cuenta_emisor,banco_receptor,cuenta_receptora,cantidad, concepto,facturado,referencia) values('".date('Y-m-d')."','abono','abono','".$obtener_cuenta["banco"]."','".$obtener_cuenta["id"]."',".$cantidadde.",'abono','1',".$id_abono["m"].")");
		///actualizamos saldo final de la cuneta sumandole el abonos 
		$saldo_actual_cuenta=$obtener_cuenta["saldo_final"]+$cantidadde;
		$actualiza_saldo_cuenta=mysql_query("update Cuentas set saldo_final=".$saldo_actual_cuenta." WHERE id=".$cuenta);
	
		// si el usuario es Nivel 4 Duplicar PFD
		if ($_SESSION['niv']=='4') 
		{
			$q="SELECT max(id)'n' FROM abonofac";
			$r=mysql_query($q);
			while($muestra=mysql_fetch_array($r)) {
				echo $numax=$muestra['n'];	
			}
			$insert="INSERT INTO abonosforaneos(numcontrato,nomcontrato,cantidad,fechapago,recibide,concepto,tipoevento,salon,fechaevento,cuenta,folio) values('".$folio."','".$ncontrato."',".$cantidadde.",'".$fechaactual."','".$recibide."','".$concepto."','".$tipoeveto."','".$salon."','".$fechaevento."','".$cuenta."',".$numax.")";
			$r=mysql_query($insert);
		}

		$cons_q="SELECT * FROM contrato WHERE Numero='".$folio."'";
		$consulta=mysql_query($cons_q);
		$can=mysql_fetch_array($consulta);	
		$cantidad=$can['sa']-$cantidadde;
			
		$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$folio."'");
		if(count($Contrato)>1)
		{
			$cons_q="SELECT * FROM contrato WHERE Numero='".$Contrato[0]."'";
			$consulta=mysql_query($cons_q);
			$can=mysql_fetch_array($consulta);	
			$cantidad=$can['sa']-$cantidadde;
			$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$Contrato[0]."'");
								
			
		}
				/*/agragamos el proximo abono que se debe de realizar
				$arreglo=explode('-',$folio);
				if(count($arreglo)>1){//validamos si es subcontrato
					$subq=mysql_query('SELECT * FROM subcontratos WHERE numero="'.$folio.'"');
					$subm=mysql_fetch_array($subq);
					if($subm['fechas']==''){
						$today=date('Y-m-d');
						$nuevafecha = strtotime ( '+1 month' , strtotime ( $today )) ;
						$nue = date ( 'Y-m-d' , $nuevafecha );
						$next=mysql_query("UPDATE contrato set proximo_abono='".$nue."' WHERE Numero='".$folio."'");
					}else{
						$g=nueva_fecha($subm['fechas']);
						$next=mysql_query("UPDATE contrato set proximo_abono='".$g."' WHERE Numero='".$folio."'");				
						echo "UPDATE contrato set proximo_abono='".$g."' WHERE Numero='".$folio."'";
					}
				}else{
					if($can['fechas']==''){//validamos si no tiene fechas
						$today=date('Y-m-d');
						$nuevafecha = strtotime ( '+1 month' , strtotime ( $today )) ;
						$nue = date ( 'Y-m-d' , $nuevafecha );
						$next=mysql_query("UPDATE contrato set proximo_abono='".$nue."' WHERE Numero='".$folio."'");
					}else{
						$g=nueva_fecha($can['fechas']);
						$next=mysql_query("UPDATE contrato set proximo_abono='".$g."' WHERE Numero='".$folio."'");				
						echo "UPDATE contrato set proximo_abono='".$g."' WHERE Numero='".$folio."'";
						}
				}*/
				?>
					<script>
						window.location="../../index.php";
					</script>
				<?php
	   }
	   else
	   {			////
		if ($_SESSION['niv']=='4') {
			$q="SELECT max(id)'n' FROM abono";
			$r=mysql_query($q);
			while($muestra=mysql_fetch_array($r)) {
				echo $numax=$muestra['n'];
			}
			$numax++;

			$insert="INSERT INTO abonosforaneos(numcontrato,nomcontrato,cantidad,fechapago,recibide,concepto,tipoevento,salon,fechaevento,cuenta,folio) values('".$folio."','".$ncontrato."',".$cantidadde.",'".$fechaactual."','".$recibide."','".$concepto."','".$tipoeveto."','".$salon."','".$fechaevento."','".$cuenta."',".$numax.")";
			$r=mysql_query($insert);
		}			
		$insert="INSERT INTO abono(numcontrato,nomcontrato,cantidad,fechapago,recibide,concepto,tipoevento,salon,fechaevento,cuenta) values('".$folio."','".$ncontrato."',".$cantidadde.",'".$fechaactual."','".$recibide."','".$concepto."','".$tipoeveto."','".$salon."','".$fechaevento."','".$cuenta."')";
		$r=mysql_query($insert);
		$set = $r == '1' ? true : false;
		if ($set) {
			?>
				<script>
					window.open("verDatos.php");
					window.location="../../index.php";
				</script>
			<?php 
		} else {
			echo "<h1>OCURRIO ALGUN ERROR AL INSERTAR EL ADELANTO, POR FAVOR INTENTELO DE NUEVO</h1>";
			?>
				<script>
				setTimeout(function () {
					window.location="../../index.php";
				}, 5000);
				</script>
			<?php 
		}

		$id_abono=mysql_fetch_array(mysql_query("SELECT max(id) as m FROM abono"));    
	   		////insercion en movimientos cuetas
		$obtener_cuenta=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$cuenta));
		$insert_abono=mysql_query("INSERT INTO Movimientos_Cuentas(fecha,banco_emisor,cuenta_emisor,banco_receptor,cuenta_receptora,cantidad, concepto,facturado,referencia) values('".date('Y-m-d')."','abono','abono','".$obtener_cuenta["banco"]."','".$obtener_cuenta["id"]."',".$cantidadde.",'abono','0',".$id_abono["m"].")");
	
		   ///actualizamos saldo final de la cuneta sumandole el abonos 
		$saldo_actual_cuenta=$obtener_cuenta["saldo_final"]+$cantidadde;
		$actualiza_saldo_cuenta=mysql_query("update Cuentas set saldo_final=".$saldo_actual_cuenta." WHERE id=".$cuenta);
		   
		   
				    $cons_q="SELECT * FROM contrato WHERE Numero='".$folio."'";
					$consulta=mysql_query($cons_q);
					$can=mysql_fetch_array($consulta);
							$cantidad=$can['sa']-$cantidadde;
						
					$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$folio."'");
					if(count($Contrato)>1)
					{
						$cons_q="SELECT * FROM contrato WHERE Numero='".$Contrato[0]."'";
						$consulta=mysql_query($cons_q);
						$can=mysql_fetch_array($consulta);	
						$cantidad=$can['sa']-$cantidadde;
						$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$Contrato[0]."'");
						echo "Total de Abonnos es de ". $TA=ABONOSUB($Contrato[0])." del contrato ".$Contrato[0];
					}

				/*/agragamos el proximo abono que se debe de realizar
				$arreglo=explode('-',$folio);
				if(count($arreglo)>1){//validamos si es subcontrato
					$subq=mysql_query('SELECT * FROM subcontratos WHERE numero="'.$folio.'"');
					$subm=mysql_fetch_array($subq);
					if($subm['fechas']==''){
						$today=date('Y-m-d');
						$nuevafecha = strtotime ( '+1 month' , strtotime ( $today )) ;
						$nue = date ( 'Y-m-d' , $nuevafecha );
						$next=mysql_query("UPDATE contrato set proximo_abono='".$nue."' WHERE Numero='".$folio."'");
					}else{
						$g=nueva_fecha($subm['fechas']);
						$next=mysql_query("UPDATE contrato set proximo_abono='".$g."' WHERE Numero='".$folio."'");				
						echo "UPDATE contrato set proximo_abono='".$g."' WHERE Numero='".$folio."'";}
				}else{
					if($can['fechas']==''){//validamos si no tiene fechas
						$today=date('Y-m-d');
						$nuevafecha = strtotime ( '+1 month' , strtotime ( $today )) ;
						$nue = date ( 'Y-m-d' , $nuevafecha );
						$next=mysql_query("UPDATE contrato set proximo_abono='".$nue."' WHERE Numero='".$folio."'");
					}else{
						$g=nueva_fecha($can['fechas']);
						$next=mysql_query("UPDATE contrato set proximo_abono='".$g."' WHERE Numero='".$folio."'");				
						echo "UPDATE contrato set proximo_abono='".$g."' WHERE Numero='".$folio."'";}
				}
				*/
				?>
					<script>
						window.location="../../index.php";
					</script>
				<?php
				   
	   }
	   
///////////////////////////////envio de correo de abono
 $sub=explode('-',$folio);
	   if(count($sub)==1){
			$q="SELECT * FROM contrato WHERE Numero='".$folio."'";
			$m=mysql_query($q);
			$r=mysql_fetch_array($m);
			$q2="SELECT * FROM cliente WHERE id='".$r['id_cliente']."'";
			$m2=mysql_query($q2);
			$r2=mysql_fetch_array($m2);
			$correo=$r2['mail'];
		}else{
			$q="SELECT * FROM subcontratos WHERE numero='".$folio."'";
			$m=mysql_query($q);
			$r=mysql_fetch_array($m);
			$correo=$r['correo'];
	   }
	   

	   	$msj="Estimado cliente:<br>
	
	
		Este correo electrónico ha sido generado automáticamente por el sistema, por lo que le solicitamos no responder a este mensaje, ya que las respuestas a este correo electrónico no serán leídas. En caso de tener alguna duda referente a la información contenida, llame para su aclaración a los siguientes números telefónicos:
		<br>
		(442) 2.77.40.32 o 2.77.41.17
		De lunes a sábado
		De 10:00am a 6:00pm<br><br>";
		$fin="</body></html>";
		$msj=mensaje().utf8_decode($msj)."<center>".utf8_decode(principal($folio)).$fin;
		//mail('benja_map@hotmail.com', 'IMPORTANTE PAGO ABONO',$msj, "FROM: administracion@sistemavc.com \r\nContent-type: text/html\r\n");
		mail($correo, 'IMPORTANTE PAGO ABONO',$msj, "FROM: administracion@sistemavc.com \r\nContent-type: text/html\r\n");
		


	   function nueva_fecha($fechas){
		$fecha=explode('%',$fechas);
		$hoy=date('Y-m-d');
		$aux=0;
		for($i=0;$i<count($fecha)-1;$i++){
			if(strtotime($hoy)<=strtotime($fecha[$i])){
				$aux=$aux+1;
			}
			if($aux==1){
				$nf=$fecha[$i];
			}
		}
		return $nf;
	   }
	   
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
";
	   return $msj;
	   }
	   
?>
<!-- <body onload="cargar()"> -->
<body>
</body>
</html>