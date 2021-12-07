<?php
require('fpdf/fpdf.php');
require 'funciones.php';
session_start();
conectar();
header('Content-Type: text/html; charset=utf-8;');

class PDF extends FPDF{
	function Header(){
		
		/*/ Logo
		$this->Image('logo_pb.png',10,8,33);
		// Arial bold 15*/
		$this->SetFont('Arial','B',15);
		// Movernos a la derecha
		$this->Cell(80);
		// Título
		$a=explode('-',$_POST['categoria']);
		$this->Cell(30,10,"INVENTARIO ".$a[1],0,0,'C');
		// Salto de línea
		$this->Ln(20);
		}
	function Footer(){
		 // Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Número de página
		$this->Cell(0,10,'Pagina'.$this->PageNo().'/{nb}',0,0,'C');
		$this->Cell(0,10,'F.I.'.date('Y-m-d'),0,0,'R');
		}
	function cuerpo(){
			$a=explode('-',$_POST['categoria']);
			$this->Cell(15,5,"Fecha",1,0,'L');$this->Cell(30,5,"",1,0,'L');
			$this->Ln(5);
			$this->Cell(15,5,utf8_decode("Elaboró"),1,0,'L');$this->Cell(80,5,"",1,0,'L');
			$this->Ln(5);
			$this->Cell(15,20,"Firma",1,0,'L');$this->Cell(45,20,"",1,0,'L');
			$this->Ln(25);
			
			$this->Cell(90,5,utf8_decode("DESCRIPCIÓN"),1,0,'C');
			$this->Cell(20,5,"BUEN ESTADO",1,0,'C');
			$this->Cell(20,5,"MAL ESTADO",1,0,'C');
			$this->Cell(20,5,"TOTAL",1,0,'C');
			$this->Cell(40,5,"COMENTARIO",1,0,'C');
			$this->Ln(5);
			$query=mysql_query("select * from subcategoria where id_categoria=".$a[0]." order by nombre asc");
			while($mostrar=mysql_fetch_array($query)){////subcategorias
				$this->Cell(90,5,utf8_decode($mostrar['nombre']),0,0,'C');
				$this->Ln(5);
				$prod=mysql_query("select * from producto where id_categoria=".$a[0]." and id_subcategoria=".$mostrar['id_subcategoria']." order by nombre asc");
				while($producto=mysql_fetch_array($prod)){///////////producto
					$this->Cell(90,5,utf8_decode($producto['nombre'].'('.$producto['descripcion'].')'),1,0,'L');
					$this->Cell(20,5,"",1,0,'C');
					$this->Cell(20,5,"",1,0,'C');
					$this->Cell(20,5,"",1,0,'C');
					$this->Cell(40,5,"",1,0,'C');
					$this->Ln(5);
				}
			}
			$this->Ln(5);$this->Ln(5);
			$this->Cell(15,5,"Fecha",1,0,'L');$this->Cell(30,5,"",1,0,'L');
			$this->Ln(5);
			$this->Cell(15,5,utf8_decode("Recibe"),1,0,'L');$this->Cell(80,5,"",1,0,'L');
			$this->Ln(5);
			$this->Cell(15,20,"Firma",1,0,'L');$this->Cell(45,20,"",1,0,'L');
			$this->Ln(25);
			$this->Cell(15,30,"Comentario",1,0,'L');$this->Cell(90,30,"",1,0,'L');
		}
	}
	
	
$pdf= new PDF();
$pdf->AliasNbPages();
$pdf->Addpage();
$pdf->SetAutoPageBreak(true,35); 
$pdf->SetFont('Arial','B',7);
$pdf->cuerpo();
$pdf->Output();	
?>