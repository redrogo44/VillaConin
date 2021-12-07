<?php
session_start();
include "../fpdf/fpdf.php";
require '../../funciones2.php';
conectar();

date_default_timezone_set('utf-8');

class MiPDF extends fpdf
{
	public function Header()
	{
		//print_r($_SESSION);

		if($_SESSION[niv]==4)
		{

			$this->Image('FormatoAbono.jpg',5,2,200,290);
		}
		
				
						
						
						$q2="select * from abono where id=9317";
						$r2=mysql_query($q2);
						while($muestra2=mysql_fetch_array($r2))
						{
							
							$NumeroContrato=$muestra2['numcontrato'];
						   $folio=$muestra2['numcontrato'];
						   $fa= explode('-',$muestra2['fechapago']);
						   $new=$fa[2].'-'.$fa[1].'-'.$fa[0];
						   $fechaactual= $new;
						   $recibide=$muestra2['recibide'];
						   $cantidadde=$muestra2['cantidad'];
						   $concepto=$muestra2['concepto'];
						   $fechaevento=$muestra2['fechaevento'];
						   $tipoeveto=$muestra2['tipoevento'];
						   $salon=$muestra2['salon'];
						   $ncontrato=$muestra2['nomcontrato'];
						   $id=$muestra2['id'];
							$var='  folio: ';
						
						
						}
												// L../../s
						// Arial bold 	15									
   					
					if ($_SESSION['niv']==4) 
					{
						// Logo
						// Arial bold 	15
						$this->Ln(10);
						$this->SetFont('Arial','B',14);
					   $this->Cell(160, 0 , $ncontrato.$var.$id, 2, 2, 'C');
					   $this->SetXY(0, 20); // establece las posición actual x e y
						$this->Cell(360, 12 , $folio, 2, 2, 'C'); 
						$this->Cell(360,2,$fechaactual,0,2,'C');
						$this->SetXY(0, 38); // establece las posición actual x e y
						$this->Cell(150,0,$recibide,0,2,'C');
						$this->Cell(100,15,$cantidadde,0,1,'C');$this->SetFont('Arial','B',10);
						$this->Cell(250,-15,numtoletras($cantidadde),0,1,'C');$this->SetFont('Arial','B',14);
						$this->Cell(100,28,$concepto,0,1,'C');
						$this->Cell(100,-13,$fechaevento,0,1,'C');
						$this->Cell(100,23,$tipoeveto,0,1,'C');
						$this->Cell(100,-6,$salon,0,1,'C');
						
						
						// Expediente
						
						$this->SetXY(0, 120); // establece las posición actual x e y
						 $this->Cell(185, 0 , $ncontrato.$var.$id, 2, 2, 'C');
						$this->Cell(360, 10 , $folio , 2, 6, 'C'); 
						$this->Cell(360,3,$fechaactual,0,2,'C');
						$this->Cell(150,6.8,$recibide,0,1,'C');
						$this->Cell(100,6.8,$cantidadde,0,1,'C');$this->SetFont('Arial','B',10);
						$this->Cell(250,-6,numtoletras($cantidadde),0,1,'C');$this->SetFont('Arial','B',14);
						$this->Cell(100,20,$concepto,0,1,'C');
						$this->Cell(100,-4,$fechaevento,0,1,'C');
						$this->Cell(100,17,$tipoeveto,0,1,'C');
						$this->Cell(100,-5,$salon,0,1,'C');
						
						
						
						 $this->SetXY(0, 220); // establece las posición actual x e y
						
						$this->Cell(185, 0, $ncontrato.$var.$id, 2, 2, 'C');
						$this->Cell(360, 6.8 ,$folio, 2, 2, 'C'); 
						$this->Cell(360,6,$fechaactual,0,2,'C');
						$this->Cell(150,6.8,$recibide,0,1,'C');
						$this->Cell(100,6.8,$cantidadde,0,1,'C');$this->SetFont('Arial','B',10);
						$this->Cell(250,-6,numtoletras($cantidadde),0,1,'C');$this->SetFont('Arial','B',14);
						$this->Cell(100,17,$concepto,0,1,'C');
						$this->Cell(100,0,$fechaevento,0,1,'C');
						$this->Cell(100,14,$tipoeveto,0,1,'C');
						$this->Cell(100,-4,$salon,0,1,'C');
					}
					else
					{
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
		
		}
		
	function Footer()
	{
	
		
	}
	

}

$pdf = new MiPDF();	
$pdf->addPage();
$pdf->Output();
	


?>
