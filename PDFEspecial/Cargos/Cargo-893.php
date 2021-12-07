<?php
include "../../FormularioPDF/fpdf/fpdf.php";
require '../../funciones2.php'; 
conectar();
session_start();
date_default_timezone_set('utf-8');

class MiPDF extends FPDF
{	public function Header()
	{
						
				// Tabla Cargos
					$q="select id from cargo Where id = 3867";
					$r=mysql_query($q);
					while($muestra=mysql_fetch_array($r)){
						$numax=$muestra['id'];
					}
					
					$q2="select * from cargo where id=".$numax;
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
					while($muestra31=mysql_fetch_array($r3))
					{
						 $idcliente=$muestra31['id_cliente'];
						 $fechaevento=$muestra31['Fecha'];
					}
					// Tabla Cliente
					
					$q3="select * from cliente where id=".$idcliente;
					$r3=mysql_query($q3);
					while($muestra3=mysql_fetch_array($r3))
					{
						$nomcli=$muestra3['nombre'];
						$ap=$muestra3['ap'];
						$am=$muestra3['am'];
						$domicilio=$muestra3['dom'];
						$tel=$muestra3['tel'];
						$rfc=$muestra3['rfc'];									
					}
						$cliente=$nomcli." ".$ap." ".$am;
						
						
						
						
						$q_recupera = "SELECT concepto FROM cargo where id='".$numax."'";
					$recupera = mysql_query($q_recupera) or die (mysql_error());
					$cno=mysql_fetch_array($recupera);
					 $servicios=$cno['concepto'];
					
					$arrayservicios = explode(",", $servicios);	
			
			
		
			

					
					
			 $this->Ln(5);
			 $this->SetFont('Arial','B',15);
			
			//  Variables
			
			$this->Ln(4);
			
			// Imagenes
			$this->Image('../../Imagenes/villaconin2.png',5,10,200,90);
			$this->Image('../../Imagenes/villaconin2.png',5,105,200,90);
			$this->Image('../../Imagenes/villaconin2.png',5,200,200,90);
			
			// Impresiones  Not< de Cargo 1
			$this->SetFont('Arial','B',9);
			$this->Cell(350, 22 , $folio, 100, 100, 'C');
			$this->Cell(355, -13 , $fecha, 2, 2, 'C');
			$this->Cell(124, 33 , $cliente, 2, 2, 'C');
			$this->Cell(300, -39 , $NumeroContrato, 100, 100, 'C');
			$this->Cell(300, 47 , $fechaevento, 100, 100, 'C');
			$this->SetFont('Arial','B',9);
			$this->Ln(-10);
			
				
					for($i=0;$i<count($arrayservicios)-1;$i++)
					{	
						$this->Cell(180,0,$arrayservicios[$i],100,100,'C');
						$this->Ln(3);
					}
				
				
						
			
			$this->SetXY( 10, 73); // establece las posición actual x e y
			$this->SetTextColor(0,0,200); // establece el color del texto
			$this->SetFont('Arial','B',9);
			$this->Cell(115, 16 , "$ ".$total, 100, 100, 'C');
			$this->SetFont('Arial','B',6);
			$this->Cell(215,-16,numtoletras($total),0,1,'C');
			$this->SetFont('Arial','B',9);
			// Nota de Cargo 2 , 
					$this->SetTextColor(0,0,0); // establece el color del texto
			
			$this->Cell(350, 103 , $folio, 100, 100, 'C');
			$this->Cell(355, -93 , $fecha, 2, 2, 'C');
			$this->Cell(124, 113 , $cliente, 2, 2, 'C');
			$this->Cell(300, -119 , $NumeroContrato, 100, 100, 'C');
			$this->Cell(300, 127 , $fechaevento, 100, 100, 'C');
			$this->SetFont('Arial','B',9);
			$this->Ln(-50);
				for($i=0;$i<count($arrayservicios)-1;$i++)
					{	
						$this->Cell(180,0,$arrayservicios[$i],100,100,'C');
						$this->Ln(3);
					}
				
			$this->SetFont('Arial','B',9);
			$this->SetXY( 10, 168); // establece las posición actual x e y
			$this->SetTextColor(0,0,200); // establece el color del texto
			$this->Cell(115, 16 , "$ ".$total, 100, 100, 'C');
			$this->SetFont('Arial','B',6);
			$this->Cell(215,-16,numtoletras($total),0,1,'C');	
$this->SetFont('Arial','B',9);
			// Nota de Cargo 3 ,
			$this->SetTextColor(0,0,0); // establece el color del texto
			$this->Cell(350, 103 , $folio, 100, 100, 'C');
			$this->Cell(355, -92 , $fecha, 2, 2, 'C');
			$this->Cell(120, 110 , $cliente, 2, 2, 'C');
			$this->Cell(300, -115 , $NumeroContrato, 100, 100, 'C');
			$this->Cell(300, 122 , $fechaevento, 100, 100, 'C');
			$this->SetFont('Arial','B',9);
			$this->Ln(-49);
					for($i=0;$i<count($arrayservicios)-1;$i++)
					{	
						$this->Cell(180,0,$arrayservicios[$i],100,100,'C');
						$this->Ln(3);
					}
				
			$this->SetFont('Arial','B',9);
			$this->SetXY( 10, 168); // establece las posición actual x e y
			$this->SetTextColor(0,0,200); // establece el color del texto
			$this->Cell(115, 207 , "$ ".$total, 100, 100, 'C');
			$this->SetFont('Arial','B',6);
			$this->Cell(215,-207,numtoletras($total),0,1,'C');
			
				
		}
		
	function Footer()
	{
	
		
	}
	


}

$pdf = new MiPDF();	
$pdf->addPage();
$pdf->Output();
	




?>
