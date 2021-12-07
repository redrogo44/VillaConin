
<?php

include "FormularioPDF/fpdf/fpdf.php";
 
date_default_timezone_set('utf-8');

class MiPDF extends FPDF{
	
	
	public function Header(){
	$con = mysql_connect("localhost","qroodigo_usuarios","qroodigo_usuarios");
	if(!$con)
	{
		die('no hay conexion al servidor');
	}
	$base = mysql_select_db('qroodigo_VillaConin');
	if(!$base){
		die('no se pudo conectar a la bd');
	}
	else{
		/* Tabla Cancelaciones
		$q="select max(id)'n' from Cancelaciones";
		$r=mysql_query($q);
		while($muestra=mysql_fetch_array($r)){
			$numax=$muestra['n'];
			
			}*/
		$q2="select * from cargo where id = 27";
		$r2=mysql_query($q2);
		while($muestra2=mysql_fetch_array($r2)){
			$folio=$muestra2['id'];
			$fecha=$muestra2['fecha'];
			$NumeroContrato=$muestra2['numcontrato'];
       $total=$muestra2['cantidad'];
	   $concepto= $muestra2['concepto'];
	  
	  
		}
		// Tabla Contrato
		
		$q3="select * from contrato where Numero='Y010111L'";
		$r3=mysql_query($q3) or die (mysql_error());
		while($muestra3=mysql_fetch_array($r3)){
			$cliente=$muestra3['nombre'];
			$domicilio=$muestra3['domicilio'];
			$tel=$muestra3['telefono'];
		    $rfc=$muestra3['rfc'];
			$fechaevento=$muestra3['Fecha'];
						
			}
}


 $this->Ln(5);
 $this->SetFont('Arial','B',15);

//  Variables

$this->Ln(4);

// Imagenes
$this->Image('Imagenes/villaconin21.png',5,10,200,90);
$this->Image('Imagenes/villaconin21.png',5,105,200,90);
$this->Image('Imagenes/villaconin21.png',5,200,200,90);

// Impresiones  Not< de Cargo 1
$this->SetFont('Arial','B',9);
$this->Cell(350, 19 , $folio, 100, 100, 'C');
$this->Cell(355, -10 , $fecha, 2, 2, 'C');
$this->Cell(120, 24 , $cliente, 2, 2, 'C');
$this->Cell(330, -22 , $NumeroContrato, 100, 100, 'C');
$this->Cell(125, 35 , $domicilio, 100, 100, 'C');
$this->Cell(110, -23 , $tel, 100, 100, 'C');
$this->Cell(330, 11 , $rfc, 100, 100, 'C');
$this->Cell(330, 0 , $fechaevento, 100, 100, 'C');
$this->Cell(120, 32 , $concepto, 100, 100, 'C');
$this->Cell(345, -5 , $total, 100, 100, 'C');
// Nota de Cargo 2 , 
$this->Cell(350,87	,$folio, 100, 100, 'C');
$this->Cell(355, -78 , $fecha, 2, 2, 'C');
$this->Cell(120, 92 , $cliente, 2, 2, 'C');
$this->Cell(330, -90, $NumeroContrato, 100, 100, 'C');
$this->Cell(125, 103 , $domicilio, 100, 100, 'C');
$this->Cell(110, -90 , $tel, 100, 100, 'C');
$this->Cell(330, 77 , $rfc, 100, 100, 'C');
$this->Cell(330, -65 , $fechaevento, 100, 100, 'C');
$this->Cell(132, 100 , $concepto, 100, 100, 'C');
$this->Cell(345, -78 , $total, 100, 100, 'C');
// Nota de Cargo 3 ,
$this->Cell(350,161	,$folio, 100, 100, 'C');
$this->Cell(355, -152 , $fecha, 2, 2, 'C');
$this->Cell(120, 167 , $cliente, 2, 2, 'C');
$this->Cell(330, -167,	 $NumeroContrato, 100, 100, 'C');			
$this->Cell(125, 182 , $domicilio, 100, 100, 'C');
$this->Cell(110, -170 , $tel, 100, 100, 'C');
$this->Cell(330, 158 , $rfc, 100, 100, 'C');		
$this->Cell(330, -148 , $fechaevento, 100, 100, 'C');
$this->Cell(132, 185 , $concepto, 100, 100, 'C');
$this->Cell(345, -164 , $total, 100, 100, 'C');
	
	function Footer()
	{
	
		
	}
	

}
}

$pdf = new MiPDF();	
$pdf->addPage();
$pdf->Output();
	
?>
