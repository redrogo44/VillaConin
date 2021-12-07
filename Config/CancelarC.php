<?php
	session_start();
?>
<html>
<head>
</head>
<body>
<?php
	require 'configuraciones.php';
	conectar();
	
	//$ri=mysql_query("select * from Cancelaciones where numcontrato='".$_POST['numero']."' and concepto='cancelacion de contrato'");
	//if(mysql_num_rows($ri)<1){
		$s="select * from contrato where Numero='".$_POST['numero']."'";
		$r=mysql_query($s);
		$m=mysql_fetch_array($r);
		$COMENSALES=$m['c_adultos']+$m['c_jovenes']+$m['c_ninos'];
		
		if($m['facturado']=="si"){
				$abonos="select sum(cantidad)as s from abonofac where numcontrato='".$_POST['numero']."'";
				$ra=mysql_query($abonos);
				$ta=mysql_fetch_array($ra);
				$bandM="1";
			}else{
				$abonos="select sum(cantidad)as s from abono where numcontrato='".$_POST['numero']."'";
				$ra=mysql_query($abonos);
				$ta=mysql_fetch_array($ra);
				$bandM="0";
			}
		 
			$max_folio=mysql_fetch_array(mysql_query("select max(folio) as m from Cancelaciones"));
			$nf=$max_folio["m"]++;
			$respaldo="insert into Cancelaciones(numcontrato,concepto,cantidad,devuelto,fechamovimiento,fecha,folio,tipo,usuario,cuenta,facturado,abonos,comensales,nombre_contrato,salon,tipo_evento) values ('".$_POST['numero']."','cancelacion de contrato',".$_POST['cargo'].",".$_POST['devuelto'].",'".date('Y-m-d')."','".$m['Fecha']."',$nf,'Contrato','".$_SESSION['usu']."','2','".$m["facturado"]."',".$ta["s"].",".$COMENSALES.",'".$m["nombre"]."','".$m["salon"]."','".$m["tipo"]."')";
			//echo $respaldo;
			$insert=mysql_query($respaldo);
				
			$b_contrato="delete from contrato where Numero='".$_POST['numero']."'";
			$b_contrato2=mysql_query($b_contrato);
			
				if($m['facturado']=="si"){
							$b_abonos="delete from abonofac where numcontrato='".$_POST['numero']."'";
							$b_abonos2=mysql_query($b_abonos);
							
							$b_cargos="delete from cargofac where numcontrato='".$_POST['numero']."'";
							$b_cargos2=mysql_query($b_cargos);
			
				}else{
						
							$b_abonos="delete from abono where numcontrato='".$_POST['numero']."'";
							$b_abonos2=mysql_query($b_abonos);
							
							$b_cargos="delete from cargo where numcontrato='".$_POST['numero']."'";
							$b_cargos2=mysql_query($b_cargos);
				}
				if(strlen($_POST['numero'])>8){
					$borrar=mysql_query("delete from contrato where Numero='".$_POST['numero']."'");
					$n=explode('-',$_POST['numero']);
					$actualizar=mysql_query("update contrato set si=".si($n[0]).",sa=".sa($n[0]).",deposito=".deposito($n[0]).",c_adultos=".adultos($n[0]).",c_jovenes=".jovenes($n[0]).",c_ninos=".ninos($n[0])." where Numero='".$n[0]."'");
				}
		
		 
		////insercion en movimientos cuentas validando si es un ingreso o un egreso
		
		if($_POST['devuelto']>0){
			/// en este caso de ser positivo es un ingreso a efectivo
			$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=2"));
		$insert_abono=mysql_query("insert into Movimientos_Cuentas(fecha,banco_emisor,cuenta_emisor,banco_receptor,cuenta_receptora,cantidad, concepto,facturado) values('".date('Y-m-d')."','cancelacion_contrato','cancelacion_contrato','".$obtener_cuenta["banco"]."','".$obtener_cuenta["id"]."',".$_POST['devuelto'].",'cancelacion_contrato','".$bandM."')");
				///actualizamos saldo final de la cuenta sumandole el faltante de la cancelacion de contrato 
			$saldo_actual_cuenta=$obtener_cuenta["saldo_final"]+$_POST['devuelto'];
			$actualiza_saldo_cuenta=mysql_query("update Cuentas set saldo_final=".$saldo_actual_cuenta." where id=2");
			
		}else{
			///si lo devuelto es negativo es un egreso y se disminuye en efectivo
			$obtener_cuenta=mysql_fetch_array(mysql_query("select * from Cuentas where id=2"));
			$insert_abono=mysql_query("insert into Movimientos_Cuentas(fecha,banco_emisor,cuenta_emisor,banco_receptor,cuenta_receptora,cantidad, concepto,facturado) values('".date('Y-m-d')."','".$obtener_cuenta["banco"]."','".$obtener_cuenta["id"]."','cancelacion_contrato','cancelacion_contrato',".($_POST['devuelto']*-1).",'cancelacion_contrato','".$bandM."')");

			///actualizamos saldo final de la cuenta restandole lo devuelto al cliente ya viene en negativo por eso se suma 
			$saldo_actual_cuenta=$obtener_cuenta["saldo_final"]+$_POST['devuelto'];
			$actualiza_saldo_cuenta=mysql_query("update Cuentas set saldo_final=".$saldo_actual_cuenta." where id=".$_POST['cuenta']);
		}
		
		
		
		
		 	
	/*	
	}else{
		echo "ya existe";
	} */
 ?>
		<script>
					window.open("PDF_cancelaciones.php?numero=<?php echo $_POST['numero']; ?>");
					location.href='../index.php';
				</script>
	
	<?php
	function adultos($numero){
	$query="select * from contrato where Numero like ('".$numero."%')";
	$result=mysql_query($query);
	$comensales=0;
	while($subcontrato=mysql_fetch_array($result)){
		if(strlen($subcontrato['Numero'])>8){
			$comensales=$comensales+$subcontrato['c_adultos'];
		}
	} 
	return $comensales;
}
function jovenes($numero){
	$query="select * from contrato where Numero like ('".$numero."%')";
	$result=mysql_query($query);
	$comensales=0;
	while($subcontrato=mysql_fetch_array($result)){
		if(strlen($subcontrato['Numero'])>8){
			$comensales=$comensales+$subcontrato['c_jovenes'];
		}
	}
	return $comensales;
}
function ninos($numero){
	$query="select * from contrato where Numero like ('".$numero."%')";
	$result=mysql_query($query);
	$comensales=0;
	while($subcontrato=mysql_fetch_array($result)){
		if(strlen($subcontrato['Numero'])>8){
			$comensales=$comensales+$subcontrato['c_ninos'];
		}
	}
	return $comensales;
}
function deposito($numero){
	$query="select * from contrato where Numero like ('".$numero."%')";
	$result=mysql_query($query);
	$deposito=0;
	while($subcontrato=mysql_fetch_array($result)){
		if(strlen($subcontrato['Numero'])>8){
			$deposito=$deposito+$subcontrato['deposito'];
		}
	}
	return $deposito;
}
function si($numero){
	$query="select * from contrato where Numero like ('".$numero."%')";
	$result=mysql_query($query);
	$si=0;
	while($subcontrato=mysql_fetch_array($result)){
		if(strlen($subcontrato['Numero'])>8){
			$si=$si+$subcontrato['si'];
		}
	}
	return $si;
}

function sa($numero){
	$query="select * from contrato where Numero like ('".$numero."%')";
	$result=mysql_query($query);
	$sa=0;
	while($subcontrato=mysql_fetch_array($result)){
		if(strlen($subcontrato['Numero'])>8){
			$sa=$sa+$subcontrato['sa'];
		}
	}
	return $sa;
}
	?>
</body>
</html>
	