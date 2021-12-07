<?php
error_reporting(0);
include "FormularioPDF/fpdf/fpdf.php";
session_start();  
date_default_timezone_set('utf-8');

class MiPDF extends FPDF{
	
	
	public function Header(){
$con = mysql_connect("localhost","qroodigo_usuarios","qroodigo_usuarios");
	if(!$con)
	{
		die('no hay conexion al servidor');
	}
	$base = mysql_select_db('qroodigo_VillaConin');
	if(!$base){
		die('no se pudo conectar a la bd');
	}
	else{
	mysql_set_charset('utf8');
	 //echo "conexion exitosa";		

	if($_SESSION['tipo']=="Modifica")
	{
	$IDD="Select * from TDevoluciones where id=".$_SESSION['Numero'];
	$de=mysql_fetch_array(mysql_query($IDD));
	}
	if($_GET['tipo']=="Imprime")
	{
		$IDD="Select * from TDevoluciones where id=".$_GET['numero'];
	$de=mysql_fetch_array(mysql_query($IDD));		
	
	}
//echo $_GET['numero'];			
	//print_r($_SESSION)."<br>";
$Conceptos=	explode(",",$de['Descripcion']);
$Precios=	explode(",",$de['Precios']);
$Cantidades=	explode(",",$de['Cantidades']);



	// TABLA CONTRATO
		 $q="select * from contrato where Numero='".$de['Numero']."'";				
		$r3=mysql_query($q) or die (mysql_error());
		while($muestra3 = mysql_fetch_array($r3))
		{
			 $idcliente=$muestra3['id_cliente'];
			$nombrecontrato=$muestra3['nombre'];			
			$fechaevento=$muestra3['Fecha'];
			$tipocontrato=$muestra3['tipo'];
			$Cadultos=$muestra3['c_adultos'];
			$Cjovenes=$muestra3['c_jovenes'];
			$Cninos=$muestra3['c_ninos'];
			$Vendedor=$muestra3['vendedor'];
			$deposito=$muestra3['deposito'];
			$Contrato=$muestra3['Numero'];
			$fa=$muestra3['facturado'];
		}
		$totCargos=total_comensales($de['Numero'],$fa);
			$Npersonas=$Cadultos+$Cjovenes+$Cninos;
			$Npersonas=$totCargos[0]+$totCargos[1]+$totCargos[2]+$Npersonas;
			
	// TABLA CLIENTE
	
	 $q="select * from cliente where id='".$idcliente."'";		
		$r3=mysql_query($q);
		while($muestra3=mysql_fetch_array($r3)){
			$nombrecliente=$muestra3['nombre'];			
			}
}

					
$fecha=date("d-m-Y");

$this->Ln(3);

// Imagenes
$this->Image('Imagenes/Devolucion.png',5,0,200,145);
$this->Image('Imagenes/Devolucion.png',5,139,200,145);

// Impresiones  Not< de Cargo 1
$this->SetFont('Arial','B',11);
$this->Cell(350	, 25 , $de['id'], 2, 2, 'C');
$this->Cell(350	, -13 , $fecha, 2, 2, 'C');
$this->SetFont('Arial','B',8);
$this->Cell(130	, 32 , $nombrecontrato, 2, 2, 'C');
$this->SetFont('Arial','B',11);
$this->Cell(300	, -31 , $Contrato, 2, 2, 'C');
$this->Cell(120	, 42 , $tipocontrato, 2, 2, 'C');
$this->Cell(300	, -41 , $fechaevento, 2, 2, 'C');
$this->Cell(120	, 55 , $Npersonas, 2, 2, 'C');
$this->Cell(300	, -55 , $Vendedor, 2, 2, 'C');
$this->SetFont('Arial','B',7);


$this->SetXY( 10, 70); // establece las posición actual x e y
for($i=0;$i<count($Conceptos);$i++)  // Conceptos
{	
	$this->Cell(180	, 3 , $Conceptos[$i], 2, 2, 'C');
}
$this->SetXY( 10, 70); // establece las posición actual x e y
for($i=0;$i<count($Cantidades);$i++)
{	
	$this->Cell(230	, 3 , $Cantidades[$i], 2, 2, 'C');
}
$this->SetXY( 10, 70); // establece las posición actual x e y
for($i=0;$i<count($Precios);$i++)
{	
	$this->Cell(270	, 3 , money_format('%(#10n',$Precios[$i]), 2, 2, 'C');
}

$this->SetXY( 10, 73); // establece las posición actual x e y
for($i=1;$i<count($Precios);$i++)
{	$TotalCargos=($Cantidades[$i]*$Precios[$i])+$TotalCargos;
	$this->Cell(300	, 3 , money_format('%(#10n',($Cantidades[$i]*$Precios[$i])), 2, 2, 'C');
}

$this->SetXY( 10, 88); // establece las posición actual x e y
$this->Cell(300	,5 , money_format('%(#10n', $TotalCargos), 2, 2, 'C');

$this->SetFont('Arial','B',11);
$this->Cell(245	,15 ,money_format('%#10n', $deposito), 2, 2, 'C');
$this->Cell(245	,-3 ,money_format('%#10n', $TotalCargos), 2, 2, 'C');
$devolucion=$deposito-$TotalCargos;
$this->SetFont('Arial','B',11);
$this->Cell(245	,13 ,money_format('%#10n', $devolucion), 2, 2, 'C');
$this->Cell(200	,5 ,"CLIENTE", 0, 0, 'C');

	// SEGUNDA IMPRESION
	$this->SetFont('Arial','B',11);
$this->SetXY( 10, 47); // establece las posición actual x e y
$this->Cell(350	, 234 , $de['id'], 2, 2, 'C');
$this->Cell(350	, -222 , $fecha, 2, 2, 'C');
$this->Cell(140	, 242 , $nombrecontrato, 2, 2, 'C');
$this->Cell(300	, -243 , $Contrato, 2, 2, 'C');
$this->Cell(120	, 257 , $tipocontrato, 2, 2, 'C');
$this->Cell(300	, -258 , $fechaevento, 2, 2, 'C');
$this->Cell(120	, 273 , $Npersonas, 2, 2, 'C');
$this->Cell(300	, -275 , $Vendedor, 2, 2, 'C');
$this->SetFont('Arial','B',7);


$this->SetXY( 10, 209); // establece las posición actual x e y
for($i=0;$i<count($Conceptos);$i++)  // Conceptos
{	
	$this->Cell(180	, 3 , $Conceptos[$i], 2, 2, 'C');
}
$this->SetXY( 10, 209); // establece las posición actual x e y
for($i=0;$i<count($Cantidades);$i++)
{	
	$this->Cell(230	, 3 , $Cantidades[$i], 2, 2, 'C');
}
$this->SetXY( 10, 209); // establece las posición actual x e y
for($i=0;$i<count($Precios);$i++)
{	
	$this->Cell(270	, 3 , money_format('%(#10n',$Precios[$i]), 2, 2, 'C');
}

$this->SetXY( 10, 212); // establece las posición actual x e y
for($i=1;$i<count($Cantidades);$i++)
{	
	$this->Cell(300	, 3 , money_format('%(#10n',($Cantidades[$i]*$Precios[$i])), 2, 2, 'C');
}
$this->SetXY( 10, 227); // establece las posición actual x e y
$this->Cell(300	,5 , money_format('%(#10n', $TotalCargos), 2, 2, 'C');
 
$this->SetFont('Arial','B',11);
$this->SetXY( 10, 240); // establece las posición actual x e y
$this->Cell(245	,2 ,money_format('%#10n', $deposito), 2, 2, 'C');
$this->Cell(245	,6 ,money_format('%#10n', $TotalCargos), 2, 2, 'C');
$this->SetFont('Arial','B',11);

$this->Cell(245	,5 ,money_format('%#10n', $devolucion), 2, 2, 'C');
$this->Cell(200	,8 ,"CONSECUTIVO", 0, 0, 'C');


	function Footer()
	{
	
		
	}
	

}
}

$pdf = new MiPDF('P','mm','letter');	
$pdf->addPage();
$pdf->Output();

function total_comensales($n,$fac){

	$congral=mysql_query("select count(*) as total from contrato where Numero like '".$n."-%'");
	$gral=mysql_fetch_array($congral);

	if($gral['total']>0){//////////////es un contrato gral
		if($fac=='si'){
			$q='select * from cargofac where numcontrato like "'.$n.'%" and tipo="Comensales"';
		}else{
			$q='select * from cargo where numcontrato like "'.$n.'%" and tipo="Comensales"';
		}
	}else{//////es un contrato normal o subcontrato
		if($fac=='si'){
			$q='select * from cargofac where numcontrato="'.$n.'" and tipo="Comensales"';
		}else{
			$q='select * from cargo where numcontrato="'.$n.'" and tipo="Comensales"';
		}
	}
	
	$r=mysql_query($q);
	$cantidades;
	while($m=mysql_fetch_array($r)){
		$arreglo=explode(' ',$m['concepto']);
		$cantidades[0]=$cantidades[0]+$arreglo[4];
		$cantidades[1]=$cantidades[1]+$arreglo[15];
		$cantidades[2]=$cantidades[2]+$arreglo[26];
	}
	
	return $cantidades;
}	
?>

