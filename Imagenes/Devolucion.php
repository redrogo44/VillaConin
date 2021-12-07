<?php

include "FormularioPDF/fpdf/fpdf.php";
session_start();  
date_default_timezone_set('utf-8');

class MiPDF extends FPDF{
	
	
	public function Header(){
		$con = mysql_connect("localhost","mbrsoluc_villaco","}g8T^Tm7xesi");
	if(!$con){
	die('no hay conexion al servidor');
	
	
}


$base = mysql_select_db('mbrsoluc_pruebasvilla');
if(!$base){
	die('no se pudo conectar a la bd');
}
else{
$concepto=$_SESSION['concepto'];
$concepto2=$_SESSION['concepto2']; 
$concepto3=$_SESSION['concepto3']; 
$concepto4=$_SESSION['concepto4']; 
$concepto5=$_SESSION['concepto5']; 
$can=$_SESSION['CD'];
$PreU=$_SESSION['PD'];
$totD=$can*$PreU;
$CanO=$_SESSION['CO'];
$PreciO=$_SESSION['PO'];$totO=$CanO*$PreciO;
$deposito=$_SESSION['deposito'];
$CD2=$_SESSION['CD2'];
$CD3=$_SESSION['CD3'];
$CD4=$_SESSION['CD4'];
$CD5=$_SESSION['CD5'];
$CD6=$_SESSION['CD5'];
$PD2=$_SESSION['PD2'];
$PD3=$_SESSION['PD3'];
$PD4=$_SESSION['PD4'];
$PD5=$_SESSION['PD5'];
$PD6=$_SESSION['PD6'];

	// TABLA CONTRATO
		$q="select * from contrato where Numero='".$_SESSION['Numero']."'";			
		$r3=mysql_query($q);
		while($muestra3=mysql_fetch_array($r3)){
			echo $idcliente=$muestra3['id_cliente'];
			$nombrecontrato=$muestra3['nombre'];			
			$fechaevento=$muestra3['Fecha'];
			$tipocontrato=$muestra3['tipo'];
			$Cadultos=$muestra3['c_adultos'];
			$Cjovenes=$muestra3['c_jovenes'];
			$Cninos=$muestra3['c_ninos'];
			$Vendedor=$muestra3['vendedor'];
			}
			$Npersonas=$Cadultos+$Cjovenes+$Cninos;
			
	// TABLA CLIENTE
	
	$q="select * from cliente where id='".$idcliente."'";		
		$r3=mysql_query($q);
		while($muestra3=mysql_fetch_array($r3)){
			$nombrecliente=$muestra3['nombre'];			
			}
	
}
$fecha=date("d-m-Y");

$this->Ln(4);

// Imagenes
$this->Image('Imagenes/Devolucion.png',5,00,200,150);
$this->Image('Imagenes/Devolucion.png',5,150,200,150);

// Impresiones  Not< de Cargo 1
$this->SetFont('Arial','B',13);
$this->Cell(350	, 25 , $idcliente, 2, 2, 'C');
$this->Cell(350	, -13 , $fecha, 2, 2, 'C');
$this->Cell(120	, 32 , $nombrecontrato, 2, 2, 'C');
$this->Cell(300	, -31 , $_SESSION['Numero'], 2, 2, 'C');
$this->Cell(120	, 42 , $tipocontrato, 2, 2, 'C');
$this->Cell(300	, -41 , $fechaevento, 2, 2, 'C');
$this->Cell(120	, 55 , $Npersonas, 2, 2, 'C');
$this->Cell(300	, -55 , $Vendedor, 2, 2, 'C');
$this->SetFont('Arial','B',7);
$this->Cell(180	, 100 , $concepto, 2, 2, 'C');
$this->Cell(230	, -100 , $can, 2, 2, 'C');
$this->Cell(265	, 100 , money_format('%(#10n', $PreU), 2, 2, 'C');
$this->Cell(300	, -100 , money_format('%(#10n', $totD), 2, 2, 'C');
$this->Cell(180	, 105 , $concepto2, 2, 2, 'C');
$this->Cell(230	,-104 , $CanO, 2, 2, 'C');
$this->Cell(265	, 104, money_format('%(#10n', $PreciO), 2, 2, 'C');
$this->Cell(300	, -104 , money_format('%(#10n', $totO), 2, 2, 'C');
$this->Cell(180	, 109 , $concepto3, 2, 2, 'C');
$this->Cell(230	,-109 , $CD2, 2, 2, 'C');
$this->Cell(265	, 109 , money_format('%(#10n', $PD2), 2, 2, 'C');
$this->Cell(300	, -109 , money_format('%(#10n', $PD2*$CD2), 2, 2, 'C');
$this->Cell(180	, 114 , $concepto4, 2, 2, 'C');
$this->Cell(230	,-113.5 , $CD3, 2, 2, 'C');
$this->Cell(265	, 113.5 , money_format('%(#10n', $PD3), 2, 2, 'C');
$this->Cell(300	, -113.5 , money_format('%(#10n', $PD3*$CD3), 2, 2, 'C');
$this->Cell(180	, 119 , $concepto5, 2, 2, 'C');
$this->Cell(230	,-118.5 , $CD4, 2, 2, 'C');
$this->Cell(265	, 118.5 , money_format('%#10n', $PD4), 2, 2, 'C');
$this->Cell(300	, -118.5 , money_format('%#10n', $PD4*$CD4), 2, 2, 'C');
$total=$total+(($CD2*$PD2)+($CD3*$PD3)+($CD4*$PD4))+$totD+$totO;
$this->Cell(300	,128 , money_format('%(#10n', $total), 2, 2, 'C');

$this->SetFont('Arial','B',13);
$this->Cell(245	,-108 ,money_format('%#10n', $deposito), 2, 2, 'C');
$this->Cell(245	,119 ,money_format('%#10n', $total), 2, 2, 'C');
$devolucion=$deposito-$total;
$this->SetFont('Arial','B',11);
$this->Cell(245	,-109.5 ,money_format('%#10n', $devolucion), 2, 2, 'C');


	// SEGUNDA IMPRESION
	/*
$this->Cell(350	, 233 , $idcliente, 2, 2, 'C');
$this->Cell(350	, -221 , $fecha, 2, 2, 'C');
$this->Cell(120	, 242 , $nombrecontrato, 2, 2, 'C');
$this->Cell(300	, -243 , $_SESSION['Numero'], 2, 2, 'C');
$this->Cell(120	, 257 , $tipocontrato, 2, 2, 'C');
$this->Cell(300	, -258 , $fechaevento, 2, 2, 'C');
$this->Cell(120	, 273 , $Npersonas, 2, 2, 'C');
$this->Cell(300	, -275 , $Vendedor, 2, 2, 'C');
$this->SetFont('Arial','B',7);
$this->Cell(180	, 321 , $concepto, 2, 2, 'C');
$this->Cell(230	, -321 , $can, 2, 2, 'C');
$this->Cell(265	, 320 , money_format('%(#10n', $PreU), 2, 2, 'C');
$this->Cell(300	, -320 , money_format('%(#10n', $totD), 2, 2, 'C');
$this->Cell(170	, 335 , $concepto2, 2, 2, 'C');
$this->Cell(230	,-335 , $CanO, 2, 2, 'C');
	$this->Cell(265	, 335 , money_format('%(#10n', $PreciO), 2, 2, 'C');
$this->Cell(300	, -335 , money_format('%(#10n', $totO), 2, 2, 'C');
$this->Cell(300	,352 , money_format('%(#10n', $total), 2, 2, 'C');
	$this->SetFont('Arial','B',13);
$this->Cell(235	,-330.5 ,money_format('%(#10n', $deposito), 2, 2, 'C');
$this->Cell(235	,342.5 ,money_format('%(#10n', $total), 2, 2, 'C');
$this->Cell(235	,-332.5 ,money_format('%(#10n', $devolucion), 2, 2, 'C');
*/
	function Footer()
	{
	
		
	}
	

}
}

$pdf = new MiPDF();	
$pdf->addPage();
$pdf->Output();
	
?>

