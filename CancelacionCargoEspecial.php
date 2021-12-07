<?php
include "FormularioPDF/fpdf/fpdf.php";
require 'funciones2.php';
conectar();
date_default_timezone_set('utf-8');

class MiPDF extends FPDF{
	
	
	public function Header(){

		// Tabla Cancelaciones
		$q="select max(id)'n' from Cancelaciones";
		$r=mysql_query($q);
		while($muestra=mysql_fetch_array($r)){
			$numax=$muestra['n'];
			
			}
		$q2="select * from Cancelaciones where id=970;";
		$r2=mysql_query($q2);
		while($muestra2=mysql_fetch_array($r2)){
			$folio=$muestra2['folio'];
			$fecha=$muestra2['fechamovimiento'];
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

// Imagenes
$this->Image('Imagenes/villaconin2.png',5,10,200,90);
$this->Image('Imagenes/villaconin2.png',5,105,200,90);
$this->Image('Imagenes/villaconin2.png',5,200,200,90);
$this->Image('Imagenes/cancelado.png',5,10,200,90);
$this->Image('Imagenes/cancelado.png',5,105,200,90);
$this->Image('Imagenes/cancelado.png',5,200,200,90);


// Impresiones  Not< de Cargo 1
$this->SetFont('Arial','B',9);
$this->Cell(350, 19 , $folio, 100, 100, 'C');
$this->Cell(355, -10 , $fecha, 2, 2, 'C');
$this->Cell(130, 24 , $cliente, 2, 2, 'C');
$this->Cell(290, -22 , $NumeroContrato, 100, 100, 'C');
$this->Cell(125, 35 , $domicilio, 100, 100, 'C');
$this->Cell(110, -23 , $tel, 100, 100, 'C');
$this->Cell(330, 11 , $rfc, 100, 100, 'C');
//$this->Cell(330, 0 , $fechaevento, 100, 100, 'C');
$this->SetXY(30, 55);
$this->MultiCell(175,4, utf8_decode($concepto));
$this->SetXY(37, 75);
$this->Cell(175, 4 , $total.'  '.numtoletras($total), 100, 100, 'L');
// Nota de Cargo 2 , 
$this->SetXY(10, 80);
$this->Cell(350,87	,$folio, 100, 100, 'C');
$this->Cell(355, -78 , $fecha, 2, 2, 'C');
$this->Cell(130, 92 , $cliente, 2, 2, 'C');
$this->Cell(290, -90, $NumeroContrato, 100, 100, 'C');
$this->Cell(125, 103 , $domicilio, 100, 100, 'C');
$this->Cell(110, -90 , $tel, 100, 100, 'C');
$this->Cell(330, 77 , $rfc, 100, 100, 'C');
//$this->Cell(330, -65 , $fechaevento, 100, 100, 'C');
$this->SetXY(30, 150);
$this->MultiCell(175,4, utf8_decode($concepto));
$this->SetXY(37, 212);
$this->Cell(345, -79 , $total.'  '.numtoletras($total), 100, 100, 'L');
// Nota de Cargo 3 ,
$this->SetXY(10, 138);
$this->Cell(350,161	,$folio, 100, 100, 'C');
$this->Cell(355, -152 , $fecha, 2, 2, 'C');
$this->Cell(130, 167 , $cliente, 2, 2, 'C');
$this->Cell(290, -167,	 $NumeroContrato, 100, 100, 'C');			
$this->Cell(125, 182 , $domicilio, 100, 100, 'C');
$this->Cell(110, -170 , $tel, 100, 100, 'C');
$this->Cell(330, 158 , $rfc, 100, 100, 'C');		
//$this->Cell(330, -148 , $fechaevento, 100, 100, 'C');
$this->SetXY(30, 242);
$this->MultiCell(175,4, utf8_decode($concepto));
$this->SetXY(37, 307);
$this->Cell(345, -79 , $total.'  '.numtoletras($total), 100, 100, 'L');
	
	function Footer()
	{
	
		
	}
	

}
}

$pdf = new MiPDF();	
$pdf->addPage();
$pdf->Output();
	
?>
