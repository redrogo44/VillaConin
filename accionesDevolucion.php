<?php
require ('funciones2.php');
conectar();
date_default_timezone_set('America/Mexico_City');
print_r($_POST);
if(isset($_POST['accion'])&&$_POST['accion']=='ConfirmaDevolucion')
{
	// CAMBIA ESTATUS A TABLA TDEVOLUCIONES
	echo $u="UPDATE TDevoluciones SET Fecha='".date('Y-m-d')."', estatus = 1 WHERE id=".$_POST['id'];
	mysql_query($u);
		// INGRESA MOVIMIENTO A LA TABLA MOVIMIENTOS CUENTAS
	mysql_query("INSERT INTO `Movimientos_Cuentas`(`fecha`, `banco_emisor`, `cuenta_emisor`, `banco_receptor`, `cuenta_receptora`, `cantidad`, `concepto`, `facturado`, `referencia`) VALUES ('".date('Y-m-d')."','".$_POST['banco']."','".$_POST['cuenta']."','Devolucion','Devolucion',".$_POST['cantidad'].",'Devolucion',0,'".$_POST['id']."' )");  


	// MODIFICAMOS EL SALDO FINAL DE LA CUENTA AFECTADA
	// 
	$si=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$_POST['cuenta']));
	$sini=$si['saldo_final']-$_POST['cantidad'];
	mysql_query("UPDATE `Cuentas` SET `saldo_final`='".$si."' WHERE `id`=".$_POST['cuenta']);
	?>

	<script>
			var id='<?php echo $_POST['id']?>';
			window.open('Devolucion.php?numero='+id+'&&tipo=Imprime');
			window.location.assign("https://greatmeeting.me/VerPreDevolucion.php");
	</script>"
	<?php

}
?>