<?php

require('../configuraciones.php');
conectar();
//print_r($_POST);
if ($_POST['accion']=='busca_bancos') 
{
	$b=mysql_query("SELECT * FROM bancos");
	echo "<option >Seleccione una Opcion</option>";
	echo "<option >Efectivo</option>";
	while ($banco=mysql_fetch_array($b)) 
	{
	echo "<option value='".$banco['id']."'>".$banco['nombre']."</option>";
	}
}
if ($_POST['accion']=='nuevo_banco') 
{
	mysql_query("INSERT INTO `bancos`( `nombre`, `si`) VALUES ('".$_POST['nombre']."',".$_POST['si'].")");
	echo "<script>
			opener.busca_bancos();
			window.close();
		  </script>
		 ";
}
if ($_POST['accion']=='nueva_cuenta') 
{
	mysql_query("INSERT INTO `Cuentas`(`alias`, `nombre`, `banco`, `numero_cuenta`, `clabe_interbancaria`, `saldo_inicial`,`saldo_final`) VALUES ('".$_POST['alias']."','".$_POST['nombre']."','".$_POST['banco']."','".$_POST['numero_cuenta']."','".$_POST['clave']."',".$_POST['saldo_i'].",".$_POST['saldo_i']." )");
	echo "<script>
			opener.location.reload();			
			setTimeout(function () { 
				opener.mostrar('nueva_cuenta');
				window.close();}, 1000);
		  </script>";
}
if ($_POST['accion']=='modifica_cuenta') 
{
	//echo "UPDATE `Cuentas` SET `alias`='".$_POST['alias']."',`nombre`='".$_POST['nombre']."',`banco`='".$_POST['banco']."',`numero_cuenta`='".$_POST['numero_cuenta']."',`clabe_interbancaria`='".$_POST['clave']."',`saldo_inicial`='".$_POST['saldo_i']."' WHERE id=".$_POST['id'];
	mysql_query("UPDATE `Cuentas` SET `alias`='".$_POST['alias']."',`nombre`='".$_POST['nombre']."',`banco`='".$_POST['banco']."',`numero_cuenta`='".$_POST['numero_cuenta']."',`clabe_interbancaria`='".$_POST['clave']."',`saldo_inicial`='".$_POST['saldo_i']."' WHERE id=".$_POST['id']);
	echo "<script>
	setTimeout(function () { 						
				window.close();}, 1000);
			
		  </script>";
}
if ($_POST['accion']=='busca_cuentas') 
{
	$b=mysql_query("SELECT * FROM Cuentas Where banco='".$_POST['id']."'");
	echo "<option >Seleccione una Opcion</option>";
	while ($cuenta=mysql_fetch_array($b)) 
	{
	echo "<option value='".$cuenta['id']."'>".$cuenta['nombre']."</option>";
	}
}
if ($_POST['accion']=='detalle_cuentas') 
{
	$ca=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas WHERE id=".$_POST['id']));
	echo $ca['saldo_final'];
}
if ($_POST['accion']=='nuevo_movimiento') 
{
	$facturado="";
	//validacion de facturado y no facturado
	if($_POST["facturado"]=="si"){
		$facturado="1";
	}else{
		$facturado="0";
	}
	///validacion de la cuenta emisora si no existe es de efectivo
	if(!isset($_POST['cuenta_emisora'])){
		$_POST['cuenta_emisora']=2;
	}
	/////////calculamos el folio
	$max=mysql_fetch_array(mysql_query("select max(folio_traspaso) as m from Movimientos_Cuentas where facturado='".$facturado."'"));
	$max["m"]++;
	//print_r($_POST);
	//echo "INSERT INTO `Movimientos_Cuentas`(`fecha`, `banco_emisor`, `cuenta_emisor`, `banco_receptor`, `cuenta_receptora`, `cantidad`,`concepto`,`facturado`) VALUES ('".$_POST['fecha']."','".$_POST['banco_emisor']."','".$_POST['cuenta_emisora']."','".$_POST['banco_receptor']."','".$_POST['cuenta_receptora']."',".$_POST['cantidad1'].",'".$_POST['concepto']."','".$facturado."' )";
	//SE CARGA EL NUEVO MOVIMIETO
	mysql_query("INSERT INTO `Movimientos_Cuentas`(`fecha`, `banco_emisor`, `cuenta_emisor`, `banco_receptor`, `cuenta_receptora`, `cantidad`,`concepto`,`facturado`,`folio_traspaso`,`estatus`) VALUES ('".$_POST['fecha']."','".$_POST['banco_emisor']."','".$_POST['cuenta_emisora']."','".$_POST['banco_receptor']."','".$_POST['cuenta_receptora']."',".$_POST['cantidad1'].",'".$_POST['concepto']."','".$facturado."',".$max["m"].",'activo')");
	// SE DESCUENTA DE EL VALOR DE LA CUENTA EMISORA	
	//echo "SELECT * FROM Cuentas where id=".$_POST['cuenta_emisora']."<br>";
	$E=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas where id=".$_POST['cuenta_emisora']));
	$cargo=$E['saldo_final']-$_POST['cantidad1'];
	mysql_query("UPDATE `Cuentas` SET saldo_final='".$cargo."' WHERE id=".$_POST['cuenta_emisora']);
	// SE ABONA A LA CUENTA RECEPTOR	
	$R=mysql_fetch_array(mysql_query("SELECT * FROM Cuentas where id=".$_POST['cuenta_receptora']));
	$abono=$R['saldo_final']+$_POST['cantidad1'];
	mysql_query("UPDATE `Cuentas` SET saldo_final='".$abono."' WHERE id=".$_POST['cuenta_receptora']);	
echo "<html><head><script>
		function r(){
			opener.location.reload();
			window.close();
		}			
	 </script><head><body onload='r()'></body></html>";
}
if ($_POST["accion"]=='todas_cuentas') 
{	
	if($_POST["id"]=="Pago en Efectivo"){
		echo "<option value='2'>EFECTIVO</option>";
	}else{
		$b=mysql_query("SELECT * FROM bancos");
		while ($banco=mysql_fetch_array($b)) 
		{
			$c=mysql_query("SELECT * FROM Cuentas Where banco='".$banco['id']."'");
			while ($cuenta=mysql_fetch_array($c)) 
			{
				echo "<option value='".$cuenta['id']."'>".$cuenta['nombre']."</option>";
			}
		}	
	}	
}
if ($_POST['accion']=='getBancoForAccount') {
	$sql = "SELECT * FROM Cuentas WHERE id=".$_POST['id'];
	$ca=mysql_fetch_array(mysql_query($sql));
	echo $ca['banco'];
}

if ($_GET['accion']=='elimina_c') 
{
	mysql_query("DELETE FROM `Cuentas` WHERE id=".$_GET['id']);
	echo "<script>
		opener.location.reload();			
		setTimeout(function () { 
		opener.mostrar('ver_cuenta');
		window.close();}, 1000);
	 </script>";
}

if($_POST["accion"]=='borrar_traspaso'){
	$datos=mysql_fetch_array(mysql_query("select * from Movimientos_Cuentas where id=".$_POST["id"]));
	///restamos la cantidad de dinero por a la cuenta receptora
	$receptora=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$datos["cuenta_receptora"]));
	$restar=mysql_query("update Cuentas set saldo_final=".($receptora["saldo_final"]-$datos["cantidad"])." where id=".$datos["cuenta_receptora"]);
	
	///sumamos la cantidad a la cuenta emisora
	$emisora=mysql_fetch_array(mysql_query("select * from Cuentas where id=".$datos["cuenta_emisor"]));
	$sumar=mysql_query("update Cuentas set saldo_final=".($emisora["saldo_final"]+$datos["cantidad"])." where id=".$datos["cuenta_emisor"]);
	
	
	$r=mysql_query("update Movimientos_Cuentas set  estatus='suspendido' where id=".$_POST["id"]);
	if(!$r){
		echo "ERROR AL BORRAR EL TRASPASO";
	}
}
?>