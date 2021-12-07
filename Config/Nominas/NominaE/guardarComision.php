<?php

	require('../../configuraciones.php');
//require('funciones.php');
conectar();

print_r($_POST);

$filas=intval($_POST['Filas']);   
echo "<br/><br/>Filas: ".$filas;

$empleados=$_POST["nEmpleados"];
echo "<br/><br/>Empleados: ".$empleados;

// Dias Trabajados
// 
$diasT="";
for ($i=1; $i <=$empleados; $i++) 
{ 
		$diasT.=",".$_POST['trabaja'.$i];
}
echo "<br/><br/> Dias Trabajados: <br/>";
echo $diasT;

// Sueldos
// 
$sueldos="";
for ($i=1; $i <=$empleados; $i++) 
{ 
		$sueldos.=",".$_POST['Sueldo'.$i];
}
echo "<br/><br/> Sueldos: <br/>";
echo $sueldos;

//Puntos
//
$puntos="";
for ($i=1; $i <=$empleados; $i++) 
{ 
		$puntos.=",".$_POST['Pt-'.$i];
}
echo "<br/><br/> Puntos: <br/>";
echo $puntos;


//		Precio por Comensal
//
$pComensal="";
for ($i=1; $i <=$filas; $i++) 
{ 
	for ($j=1; $j <=$empleados ; $j++) 
	{ 
		$pComensal.=",".$_POST['pComensal-'.$j."-".$i];		
	}
}
echo "<br/><br/> pComensal: <br/>";
echo $pComensal;

//		Contratos
//
$contratos="";
for ($i=1; $i <=$filas; $i++) 
{ 
		$contratos.=",".$_POST['Contrato-'.$i];			
}
echo "<br/><br/> Contratos: <br/>";
echo $contratos;

//		Numero de Comensales por contrato
//
$nComensales="";
for ($i=1; $i <=$filas; $i++) 
{ 
		$nComensales.=",".$_POST['nComensales-'.$i];			
}
echo "<br/><br/> nComensales: <br/>";
echo $nComensales;

//		Factores
//
$factores="";
for ($i=1; $i <=$filas; $i++) 
{ 
	for ($j=1; $j <=$empleados ; $j++) { 
		$factores.=",".$_POST['factor-'.$j.'-'.$i];						
	}
}
echo "<br/><br/> factores: <br/>";
echo $factores;

//		Comisiones por Contrato
//
$comisionContrato="";
for ($i=1; $i <=$filas; $i++) 
{ 
	for ($j=1; $j <=$empleados ; $j++) { 
		$comisionContrato.=",".$_POST['comisionContrato-'.$j.'-'.$i];						
	}
}
echo "<br/><br/> comisionContrato: <br/>";
echo $comisionContrato;

//		Normal
//
$normal="";
for ($i=1; $i <=$filas; $i++) 
{ 
	$normal.=",".$_POST['normal-'.$i];							
}
echo "<br/><br/> normal: <br/>";
echo $normal;

//		Aplicada
//
$aplicada="";
for ($i=1; $i <=$filas; $i++) 
{ 
	$aplicada.=",".$_POST['aplicada-'.$i];							
}
echo "<br/><br/> aplicada: <br/>";
echo $aplicada;

// Comisiones Empleado
// 
$tComision="";
for ($i=1; $i <=$empleados; $i++) 
{ 
		$tComision.=",".$_POST['Comision'.$i];
}
echo "<br/><br/> tComision: <br/>";
echo $tComision;

// Bruto
// 
$bruto="";
for ($i=1; $i <=$empleados; $i++) 
{ 
		$bruto.=",".$_POST['Bruto'.$i];
}
echo "<br/><br/> bruto: <br/>";
echo $bruto;

// Descuento
// 
$descuento="";
for ($i=1; $i <=$empleados; $i++) 
{ 
		$descuento.=",".$_POST['Descuento'.$i];
}
echo "<br/><br/> descuento: <br/>";
echo $descuento;

// Neto
// 
$neto=""; $ttt=0;
for ($i=1; $i <=$empleados; $i++) 
{ 
		$neto.=",".$_POST['Neto'.$i];
		$ttt+=$_POST['Neto'.$i];
}
echo "<br/><br/> neto: <br/>";
echo $neto;

// Nombres Empleados
// 
$nombre="";
for ($i=1; $i <=$empleados; $i++) 
{ 
		$nombre.=",".$_POST['nombre'.$i];
}
echo "<br/><br/> nombre: <br/>";
echo $nombre;

echo "<br/><br/>";

if(isset($_POST['Confirma']))
{
	echo $sql="UPDATE `Cornfirmacion_Nomina_Comision` SET `nombres`='".$nombre."',`dias_trabajados`='".$diasT."',`sueldos`='".$sueldos."',`puntos`='".$puntos."',`costos_comensal`='".$pComensal."',`contratos`='".$contratos."',`comensales`='".$nComensales."',`factores`='".$factores."',`comisiones`='".$comisionContrato."',`suma_comisiones`='".$tComision."',`bruto`='".$bruto."',`descuentos`='".$descuento."',`neto`='".$neto."',`normales`='".$normal."',`aplicadas`='".$aplicada."',`fecha`='".$_POST['fecha']."',`confirmado`='si',`Texto`='".$_POST['texto']."' WHERE id=".$_POST['Confirma'];
		mysql_query($sql);
	$sql2="INSERT INTO `Movimientos_Cuentas`( `fecha`, `banco_emisor`, `cuenta_emisor`, `banco_receptor`, `cuenta_receptora`, `cantidad`, `concepto`, `estatus`) VALUES ('".$_POST['fecha']."','Efectivo','2','Nomina-Comisiones','Nomina-Comision',".$ttt.",'Nomina de Comisiones ','activo')";
	mysql_query($sql2);

}
else
{
echo $sql="INSERT INTO `Cornfirmacion_Nomina_Comision`(`nombres`, `dias_trabajados`, `sueldos`, `puntos`, `costos_comensal`, `contratos`, `comensales`, `factores`, `comisiones`, `suma_comisiones`, `bruto`, `descuentos`, `neto`, `normales`, `aplicadas`, `fecha`, `confirmado`, `Texto`) 
		VALUES ('".$nombre."','".$diasT."','".$sueldos."','".$puntos."','".$pComensal."','".$contratos."','".$nComensales."','".$factores."','".$comisionContrato."','".$tComision."','".$bruto."','".$descuento."','".$neto."','".$normal."','".$aplicada."','".date('Y-m-d')."','no','')";	
		mysql_query($sql);
}
	
	

echo "<script languaje='javascript' type='text/javascript'>
		window.close();
</script>";

?>