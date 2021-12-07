<?php

include "FormularioPDF/fpdf/fpdf.php";
require 'configuraciones.php'; 
date_default_timezone_set('utf-8');

class MiPDF extends FPDF{
	
	
	public function Header(){
		conectar();
		// Tabla Cargos
		$q="select max(id)'n' from cargofac";
		$r=mysql_query($q);
		while($muestra=mysql_fetch_array($r)){
			$numax=$muestra['n'];
			}
		
		$q2="select * from cargofac where id=".$numax;
		$r2=mysql_query($q2);
		while($muestra2=mysql_fetch_array($r2)){
			$folio=$muestra2['id'];
			$fecha=$muestra2['fecha'];
			$NumeroContrato=$muestra2['numcontrato'];
       $total=$muestra2['cantidad'];
	   $concepto= $muestra2['concepto'];
		}
		// Tabla Contrato
		
		$q3="select * from contrato where Numero='".$NumeroContrato."'";
		$r3=mysql_query($q3);
		while($muestra3=mysql_fetch_array($r3)){
			$cliente=$muestra3['nombre'];
			$domicilio=$muestra3['domicilio'];
			$tel=$muestra3['telefono'];
		    $rfc=$muestra3['rfc'];
			$fechaevento=$muestra3['Fecha'];
						
			}


 $this->Ln(5);
 $this->SetFont('Arial','B',15);

//  Variables

$this->Ln(4);
$this->SetFont('Arial','B',9);
// Imagenes
$this->Image('img/villaconin2.png',15,5,185);
$this->Image('img/villaconin2.png',15,100,185);
$this->Image('img/villaconin2.png',15,185,185);

// Impresiones  Nota de Cargo 1
$this->Cell(156,7,"",'C',0,1);$this->Cell(30,7,$folio,'C',0,1);
$this->Ln(5);
$this->Cell(156,7,"",'C',0,1);$this->Cell(30,7,$fecha,'C',0,1);
$this->Ln(7);
$this->Cell(28,7,"",'C',0,1);$this->Cell(80,7,$cliente,'C',0,1);
$this->Cell(28,7,"",'C',0,1);$this->Cell(30,7,$NumeroContrato,'C',0,1);
$this->Ln(3);
$this->Cell(136,7,"",'C',0,1);$this->Cell(80,7,$fechaevento,'C',0,1);
$this->Ln(13);
$this->Cell(28,7,"",'C',0,1);$this->Cell(135,10,$concepto,'C',0,1);
$this->Ln(19);
$this->Cell(55,7,"",'C',0,1);$this->Cell(100,10,$total,'C',0,1);
$this->Ln(48);

// Impresiones  Nota de Cargo 2
$this->Cell(156,7,"",'C',0,1);$this->Cell(30,7,$folio,'C',0,1);
$this->Ln(5);
$this->Cell(156,7,"",'C',0,1);$this->Cell(30,7,$fecha,'C',0,1);
$this->Ln(7);
$this->Cell(28,7,"",'C',0,1);$this->Cell(80,7,$cliente,'C',0,1);
$this->Cell(28,7,"",'C',0,1);$this->Cell(30,7,$NumeroContrato,'C',0,1);
$this->Ln(3);
$this->Cell(136,7,"",'C',0,1);$this->Cell(80,7,$fechaevento,'C',0,1);
$this->Ln(13);
$this->Cell(28,7,"",'C',0,1);$this->Cell(135,10,$concepto,'C',0,1);
$this->Ln(19);
$this->Cell(55,7,"",'C',0,1);$this->Cell(100,10,$total,'C',0,1);
$this->Ln(38);


// Impresiones  Nota de Cargo 3
$this->Cell(156,7,"",'C',0,1);$this->Cell(30,7,$folio,'C',0,1);
$this->Ln(5);
$this->Cell(156,7,"",'C',0,1);$this->Cell(30,7,$fecha,'C',0,1);
$this->Ln(7);
$this->Cell(28,7,"",'C',0,1);$this->Cell(80,7,$cliente,'C',0,1);
$this->Cell(28,7,"",'C',0,1);$this->Cell(30,7,$NumeroContrato,'C',0,1);
$this->Ln(3);
$this->Cell(136,7,"",'C',0,1);$this->Cell(80,7,$fechaevento,'C',0,1);
$this->Ln(13);
$this->Cell(28,7,"",'C',0,1);$this->Cell(135,10,$concepto,'C',0,1);
$this->Ln(19);
$this->Cell(55,7,"",'C',0,1);$this->Cell(100,10,$total,'C',0,1);
$this->Ln(15);



}
	
}

$pdf = new MiPDF();	
$pdf->addPage('P','Letter');
$pdf->Output();
?>
