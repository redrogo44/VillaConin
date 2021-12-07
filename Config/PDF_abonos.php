<?php
session_start();
include "FormularioPDF/fpdf/fpdf.php";
require 'configuraciones.php';

date_default_timezone_set('utf-8');
class MiPDF extends FPDF
{
	
	
		public function Header()
		{
			
		

			conectar();
						
						$q="select max(id)'n' from abonofac";
						$r=mysql_query($q);
						while($muestra=mysql_fetch_array($r))
						{
							$numax=$muestra['n'];
						}
						
						$q2="select * from abonofac where id=".$numax;
						$r2=mysql_query($q2);
						while($muestra2=mysql_fetch_array($r2))
						{
							
							$NumeroContrato=$muestra2['numcontrato'];
						   $folio=$muestra2['numcontrato'];
						   $fechaactual= $muestra2['fechapago'];
						   $recibide=$muestra2['recibide'];
						   $cantidadde=$muestra2['cantidad'];
						   $concepto=$muestra2['concepto'];
						   $fechaevento=$muestra2['fechaevento'];
						   $tipoeveto=utf8_decode($muestra2['tipoevento']);
						   $salon=$muestra2['salon'];
						   $ncontrato=$muestra2['nomcontrato'];
						   $id=$muestra2['id'];
							$var='  folio: ';
						
						
						}
								
						// Logo
						// Arial bold 	15
						$this->Ln(5);
					   
						
						$this->SetFont('Arial','B',14);
						// Cliente
						$this->Cell(150, 2 , $ncontrato.$var.$id, 2, 2, 'C');
						$this->Cell(360, 10 , $folio, 2, 2, 'C'); 
						$this->Cell(360,2,$fechaactual,0,2,'C');
						$this->Cell(100,6,$recibide,0,2,'C');
						$this->Cell(100,6,$cantidadde,0,1,'C');$this->SetFont('Arial','B',10);
						$this->Cell(250,-6,numtoletras($cantidadde),0,1,'C');$this->SetFont('Arial','B',14);
						$this->Cell(100,18,$concepto,0,1,'C');
						$this->Cell(100,-6,$fechaevento,0,1,'C');
						$this->Cell(100,18,$tipoeveto,0,1,'C');
						$this->Cell(100,-6,$salon,0,1,'C');
						
						
						
						
						
						 $this->SetFont('Arial','B',14);
						// Expediente
						
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						   $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						  $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 12 , "" , 10, 30, 'C'); 
						 $this->Cell(150, 2 , $ncontrato.$var.$id, 2, 2, 'C');
						$this->Cell(360, 6.8 , $folio , 2, 6, 'C'); 
						$this->Cell(360,6.3,$fechaactual,0,2,'C');
						$this->Cell(100,6.8,$recibide,0,1,'C');
						$this->Cell(100,6.8,$cantidadde,0,1,'C');$this->SetFont('Arial','B',10);
						$this->Cell(250,-6,numtoletras($cantidadde),0,1,'C');$this->SetFont('Arial','B',14);
						$this->Cell(100,17,$concepto,0,1,'C');
						$this->Cell(100,-6,$fechaevento,0,1,'C');
						$this->Cell(100,18,$tipoeveto,0,1,'C');
						$this->Cell(100,-6.8,$salon,0,1,'C');
						
						
						
						 $this->SetFont('Arial','B',14);
						// Consecutivo
						
						 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						  $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						  $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 10 , "" , 10, 30, 'C'); 
						$this->Cell(150, 2 , $ncontrato.$var.$id, 2, 2, 'C');
						$this->Cell(360, 6.8 ,$folio, 2, 2, 'C'); 
						$this->Cell(360,6,$fechaactual,0,2,'C');
						$this->Cell(100,6.8,$recibide,0,1,'C');
						$this->Cell(100,6.8,$cantidadde,0,1,'C');$this->SetFont('Arial','B',10);
						$this->Cell(250,-6,numtoletras($cantidadde),0,1,'C');$this->SetFont('Arial','B',14);
						$this->Cell(100,17,$concepto,0,1,'C');
						$this->Cell(100,-6,$fechaevento,0,1,'C');
						$this->Cell(100,18,$tipoeveto,0,1,'C');
						$this->Cell(100,-6.8,$salon,0,1,'C');	
   				
  
}
	function Footer()
{

    
}
	
}

// Creación del objeto de la clase heredada

$pdf = new MiPDF();	
$pdf->addPage();
$pdf->Output();
	




?>
