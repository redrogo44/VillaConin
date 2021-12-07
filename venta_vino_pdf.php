<?php
	
include "FormularioPDF/fpdf/fpdf.php";
require 'funciones2.php';
conectar();

 class PDF extends FPDF
		{
		
		
		
	function Header()
			{
			
				$this->SetFont('Arial','','10');
				$this->Cell(20);
				$hoy = date("d/m/Y");
				$this->Cell(140,10,'Venta de Vino 		                                                                                                     '.$hoy,0,0,'C');
				$this->Ln(10);
			}
	function Footer()
			{
				/*$this->Sety(-15);
				$this->SetFont('Arial','I','8');
				$this->Cell(0,10,'pagina'.$this->PageNo().'/{nb}',0,0,'C');
				*/
			}
			
	function contenido()
			{
			$this->SetFont('Arial','',10);
			$this->Ln(7);
			$this->Cell(20,7,"",'C',0,1);
			$this->Cell(10,7,"ID",1,0,'C');
			$this->Cell(40,7,"PRODUCTO",1,0,'C');
			$this->Cell(40,7,"DESCRIPCION",1,0,'C');
			$this->Cell(20,7,"CANTIDAD",1,0,'C');
			$this->Cell(20,7,"PRECIO",1,0,'C');
			$this->Cell(20,7,"TOTAL",1,0,'C');
			$this->Ln(7);
			$total;
			$datos=explode(",",$_GET['t']);
			$result = count($datos)-1;
			for($f=0;$f<$result;$f++){
			$qr="select * from TInventarios where id=".$datos[$f];
			$rr=mysql_query($qr);
			$mr=mysql_fetch_array($rr);
			$this->Cell(20,7,"",'C',0,1);
			$this->Cell(10,7,$mr['id'],1,0,'C');
			$this->Cell(40,7,$mr['producto'],1,0,'C');
			$this->Cell(40,7,$mr['descripcion'],1,0,'C');
			$this->Cell(20,7,$datos[$f+1],1,0,'C');
			$this->Cell(20,7,$mr['precio'],1,0,'C');
			$subtotal=$datos[$f+1]*$mr['precio'];
			$this->Cell(20,7,"$".$subtotal,1,0,'C');
			$total=$total+$subtotal;
			$f++;
			$this->Ln(7);
			}
			$this->Cell(20,7,"",'C',0,1);
			$this->Cell(110,7,"",0,0,'C');
			$this->Cell(20,7,"Total",1,0,'C');
			$this->Cell(20,7,$total,1,0,'C');
			
			}
			
			
			}
			
			$pdf= new PDF();
			$pdf->AliasNbPages();
			$pdf->Addpage();
			$pdf->SetFont('Arial','B',7);

			$pdf->contenido();
			$pdf->Ln(30);
			$pdf->Cell(20,7,"",0,0,'C');
			$pdf->Cell(50,7,"",'B',0,'C');
			$pdf->Cell(60,7,"",0,0,'C');
			$pdf->Cell(50,7,"",'B',0,'C');
			$pdf->Ln(7);
			$pdf->Cell(20,7,"",0,0,'C');
			$pdf->Cell(50,7,"REALIZO",0,0,'C');
			$pdf->Cell(60,7,"",0,0,'C');
			$pdf->Cell(50,7,"AUTORIZO",0,0,'C');
			$pdf->Output();	


	?>