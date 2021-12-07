<?php
include "../fpdf/fpdf.php";

date_default_timezone_set('utf-8');
class MiPDF extends FPDF{
		
	public function Header(){
		
		$NumeroContrato=("Folio: 8007");
       $folio=("Y061214L");
	   $fechaactual=("12-03-2014");
	   $recibide=("MONSERRAT UGALDE RODRIGUEZ");
	   $cantidadde=("10000.00");
	   $concepto=("Pago en Efectivo");
	   $fechaevento=("2014-12-06");
	   $tipoeveto=("Graduacion");
	   $salon=("Real de Conin");
	   $ncontrato=("MONSERRAT UGALDE RODRIGUEZ");

    // Logo
    // Arial bold 	15
    $this->Ln(5);
	
    $this->SetFont('Arial','B',14);
    // Cliente
	$this->Cell(140, 2 , $ncontrato, 2, 2, 'C');
    $this->Cell(280, 2 , $NumeroContrato, 2, 2, 'C');
    $this->Cell(360, 7 , $folio, 2, 2, 'C'); 
    $this->Cell(360,2,$fechaactual,0,2,'C');
	$this->Cell(130,6,$recibide,0,2,'C');
    $this->Cell(100,6,$cantidadde,0,1,'C');
	$this->Cell(100,7,$concepto,0,1,'C');
	$this->Cell(100,7,$fechaevento,0,1,'C');
	$this->Cell(100,7,$tipoeveto,0,1,'C');
	$this->Cell(100,7,$salon,0,1,'C');	
	
	 $this->SetFont('Arial','B',14);
    // Expediente
	
	 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
	   $this->Cell(330, 6 , "" , 10, 30, 'C'); 
	 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
	  $this->Cell(330, 6 , "" , 10, 30, 'C'); 
	 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
	 $this->Cell(330, 12 , "" , 10, 30, 'C'); 
	 $this->Cell(150, 0 , $ncontrato, 2, 2, 'C');
	 $this->Cell(280, 2 , $NumeroContrato, 2, 2, 'C');
    $this->Cell(360, 6.8 , $folio , 2, 6, 'C'); 
    $this->Cell(360,6.3,$fechaactual,0,2,'C');
    $this->Cell(160,6.8,$recibide,0,1,'C');
	$this->Cell(100,6.8,$cantidadde,0,1,'C');
	$this->Cell(100,6.8,$concepto,0,1,'C');
	$this->Cell(100,6.8,$fechaevento,0,1,'C');
	$this->Cell(100,6.8,$tipoeveto,0,1,'C');
	$this->Cell(100,6.8,$salon,0,1,'C');
		
	 $this->SetFont('Arial','B',14);
    // Consecutivo
		 
	 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
	  $this->Cell(330, 6 , "" , 10, 30, 'C'); 
	 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
	  $this->Cell(330, 6 , "" , 10, 30, 'C'); 
	 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
	 $this->Cell(330, 10 , "" , 10, 30, 'C'); 
	 $this->Cell(150, 2 , $ncontrato, 2, 2, 'C');
	 $this->Cell(280, 2 , $NumeroContrato, 2, 2, 'C');
    $this->Cell(360, 6.8 ,$folio, 2, 2, 'C'); 
    $this->Cell(360,6,$fechaactual,0,2,'C');
    $this->Cell(160,6.8,$recibide,0,1,'C');
	$this->Cell(100,6.8,$cantidadde,0,1,'C');
	$this->Cell(100,6.8,$concepto,0,1,'C');
	$this->Cell(100,6.8,$fechaevento,0,1,'C');
	$this->Cell(100,6.8,$tipoeveto,0,1,'C');
	$this->Cell(100,6.8,$salon,0,1,'C');
	
   	
	}
	function Footer()
{

    
}
	
}

// Creación del objeto de la clase heredada

$pdf = new MiPDF();	

$pdf->addPage();
$rs = mysql_query("SELECT MAX(idsolicitud) FROM solicitud");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);
}
$consulta = mysql_query("Select *  FROM solicitud where idsolicitud=".$id. "");

while ( $datos = mysql_fetch_array($consulta))
{
						$nombre = $datos[ 'nombre' ];
						$correo = $datos['correo'];
						$director = $datos['director'];
						$correodirector = $datos['correodirector'];
						$materia = $datos['materia'];
						$clave = $datos['clave'];
						$curso = $datos['curso'];
						$cuatri = $datos['cuatri'];
						$unidades = $datos['unidades'];
						$numestudiantes = $datos['numestudiantes'];
						$carrera = $datos['carrera'];
						$fechai = $datos['fechai'];
						$fechaf = $datos['fechaf'];
						$profesores = $datos['profesores'];
						$justificacion = $datos['justificacion'];
						$actividades = $datos['actividades'];
						
						$pdf->Text(62,80,$nombre);
						$pdf->Text(137,80,$carrera);
						$pdf->Text(62,90,$materia);
						$pdf->Text(140,90,$clave);
						$pdf->Text(62,104,$curso);
						$pdf->Text(62,111,$fechai);
						$pdf->Text(62,116,$fechaf);
						$pdf->Text(140,111,$numestudiantes);
						$pdf->Text(20,140,$justificacion);
						$pdf->Text(20,190,$actividades);
						$pdf->Text(40,234,$nombre);
						$pdf->Text(140,234,$director);
						$pdf->Text(120,247,$carrera);
						
						
}
$pdf->Output();
	




?>
