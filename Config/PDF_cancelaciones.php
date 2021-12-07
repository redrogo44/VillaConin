<?php
include "FormularioPDF/fpdf/fpdf.php";
require 'configuraciones.php';
	conectar();
	 class PDF extends FPDF
		{
		
			
	function Header()
			{
			
				
			}
	function Footer()
			{
				
			}
			
	function contenido()
			{
			
			$s="select * from Cancelaciones where numcontrato='".$_GET['numero']."' and concepto='cancelacion de contrato' order by id desc";
			$r=mysql_query($s);
			$m=mysql_fetch_array($r);
			$datos=explode('-',$m['fecha']);
			$f=$datos[0].$datos[1].$datos[2];
			$TEXTO='POR ESTE CONDUCTO HAGO DE SU CONOCIMIENTO QUE DESEO CANCELAR LA FECHA APARTADA PARA EL DIA '.cambioFecha($f).' EN EL SALON '.$m['salon'].' CON NUMERO DE CONTRATO '.$_GET['numero'].' A NOMBRE DE '.$m['nombre_contrato'].' PARA EL EVENTO SOCIAL '.$m['tipo_evento'].' DE '.$m["comensales"].' INVITADOS, POR LO CUAL DESLINDO DE TODA RESPONSABILIDAD AL PRESTADOR DEL SERVICIO Y PODRA DISPONER DE LA FECHA A PARTIR DE ESTE MOMENTO, EL MOTIVO DE LA CANCELACION ES POR CAUSAS DE FUERZA MAYOR, QUEDANDO COMO PENALIZACIÓN LA SIGUIENTE CANTIDAD: $'.$m['cantidad']." ".numtoletras($m['cantidad']); 
			$this->Ln(40);
			$F=utf8_decode(cambioFecha(DATE('Ymd')));
			$this->MultiCell(0,5,$F);
			$this->Ln(20);
			$this->SetFont('Arial','',10);
			$this->MultiCell(0,5,'EVENTOS SOCIALES VILLA CONIN S.A. DE C.V.');
			$this->MultiCell(0,5,'P R E S E N T E:.');
			$this->Ln(10);
			$this->MultiCell(0,5,utf8_decode('ESTIMADO(S) SEÑOR(ES):'));
			$this->Ln(7);
			$this->MultiCell(0,5,utf8_decode($TEXTO));
			$this->Ln(10);
			
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,"TOTAL DE ABONOS",1,0,'C');
			$this->Cell(40,7,'$'.$m['abonos'],1,0,'C');
			$this->Ln(7);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,"PENALIZACION",1,0,'C');
			$this->Cell(40,7,'$'.$m['cantidad'],1,0,'C');
			$this->Ln(7);
			
			
			
			//Si el total de abonos no cubre los cargos
			if($m["devuelto"]<0){
				$this->Cell(40,7,"",'C',0,1);
				$this->Cell(40,7,"DEVOLUCION",1,0,'C');
				$dev=$m["devuelto"]*-1;
				$this->Cell(40,7,"$".$dev,1,0,'C');
				$this->Ln(7);
			}
			
			
			if($m["devuelto"]>0){
				$this->Cell(40,7,"",'C',0,1);
				$this->Cell(40,7,"FALTANTE",1,0,'C');
				$this->Cell(40,7,'$'.$m['devuelto'],1,0,'C');
				$this->Ln(7);
			}
		
			$this->Ln(40);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,"ATENTMENTE",0,0,'C');
			$this->Ln(15);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,"___________________________",0,0,'C');
			$this->Ln(7);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,$m['nombre'],0,0,'C');

			
				
				
			}
			}
			
			$pdf= new PDF();
			$pdf->AliasNbPages();
			$pdf->Addpage();
			$pdf->SetFont('Arial','B',7);
			$pdf->contenido();
			$pdf->Output();	

?>
	