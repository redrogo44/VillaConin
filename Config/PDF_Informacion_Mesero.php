<?php
	
include "FormularioPDF/fpdf/fpdf.php";
require '../funciones2.php';
conectar();

header('Content-Type: text/html; charset=utf-8;');


 class PDF extends FPDF
		{
		
		//$_POST['asignatura'] = utf8_decode($_POST['asignatura']);
		
		
	function Header()
			{
				$this->Image('../Imagenes/Villa Conin.png' , 160 ,12, 45 , 48,'PNG', '');				
				$m=mysql_query("SELECT * FROM Meseros WHERE id=".$_GET['numero']);
				$Mesero=mysql_fetch_array($m);
				$this->Ln(40);
				$this->SetFont('Arial','','14');
				$this->Cell(20);
				$this->Cell(0,40,'INFORMACION DE PERSONAL('.$Mesero['nombre'].' '.$Mesero['ap'].' '.$Mesero[am].')',0,0,'C');
				$this->Ln(4);
				$this->Cell(20);
				$this->Cell(20,10,cambioFecha(DATE('Ymd')),0,0,'C');
				$this->Ln(20);
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
				
				$mm=mysql_query("SELECT * FROM Meseros WHERE id=".$_GET['numero']);
				$Mesero=mysql_fetch_array($mm);
				$TI=mysql_query("SELECT * FROM Configuraciones WHERE descripcion='".$Mesero['tipo']."'");
				$Punt=mysql_fetch_array($TI);
				$telefonos=$Mesero['telefono'].' & '.$Mesero['celular'];				
				$Comentarios=$Mesero['comentarios2'];
				$this->SetFont('Arial','','12');
				$this->SetXY(20,100);
				$this->Sety(100);
				$this->Setx(20);
				$this->Cell(0,0,'Nombre: '.$Mesero['nombre'].' '.$Mesero['ap'].' '.$Mesero[am],0,'C');
				$this->Setx(20);
				$this->Cell(0,10,'Telefonos: '.$telefonos,'C',0);
				$this->Setx(20);
				$this->Cell(0,20,'Correo: '.$Mesero['correo'],'C',0);
				$this->Setx(20);
				$this->Cell(0,30,'Tipo de Mesero: '.$Mesero['tipo'],'C',0);
				$this->Setx(20);
				$this->Cell(0,40,'Numero de Eventos: '.$Mesero['neventos'],'C',0);
				$this->Setx(20);
				$this->Cell(0,50,'Puntos: '.$Mesero['acumulado'],'C',0);
				$this->Setx(20);
				$this->Cell(0,60,'Reajuste: '.$Mesero['reajuste'],'C',0);
				$PremioLealtad=($Mesero['acumulado'])+$Mesero['reajuste'];
				$this->Setx(20);
				$this->Cell(0,70,'Premio de Lealtad: $'.money_format('%i', $PremioLealtad),'C',0);
				$Comenta=explode(',',$Comentarios);
				$this->Setx(20);			
				$this->Cell(0,90,'COMENTARIOS',0,0,'C',0);
				$this->Sety(150);
				$this->SetFont('Arial','','10');				
				for ($i=0; $i <count($Comenta) ; $i++) 
				{ 
				$this->Setx(20);				
					$this->Cell(0,10*$i,$Comenta[$i],'C',0);


				}




			
			}

			
	}
			
			$pdf= new PDF();
			$pdf->AliasNbPages();
			$pdf->Addpage();
			//$pdf->SetFont('Arial','B',7);
			$pdf->contenido();

			
			$pdf->Output();	


	?>