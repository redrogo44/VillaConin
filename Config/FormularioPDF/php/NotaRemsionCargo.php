
<?php

include "FormularioPDF/fpdf/fpdf.php";
 
date_default_timezone_set('utf-8');

class MiPDF extends FPDF{
	
	
	public function Header(){
		$con = mysql_connect("localhost","mbrsoluc_villaco","}g8T^Tm7xesi");
	if(!$con){
	die('no hay conexion al servidor');
	
	
}
$base = mysql_select_db('mbrsoluc_villaconin');
if(!$base){
	die('no se pudo conectar a la bd');
}
else{
		// Tabla Cargos
		$q="select max(id)'n' from cargo";
		$r=mysql_query($q);
		while($muestra=mysql_fetch_array($r)){
			$numax=$muestra['n'];
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
$this->SetFont('Arial','B',10);
// Imagenes
$this->Image('Imagenes/villaconin2.png',15,5,100);
$this->Image('Imagenes/villaconin2.png',15,145,100);
$this->Image('Imagenes/villaconin2.png',15,145,100);

// Impresiones  Not< de Cargo 1
$this->Cell(310, 29 , $folio, 100, 100, 'C');
$this->Cell(315, -15 , $fecha, 2, 2, 'C');
$this->Cell(140, 35 , $cliente, 2, 2, 'C');
$this->Cell(270, -36 , $NumeroContrato, 100, 100, 'C');
$this->Cell(145, 59 , $domicilio, 100, 100, 'C');
$this->Cell(120, -43 , $tel, 100, 100, 'C');
$this->Cell(120, 54 , $rfc, 100, 100, 'C');
$this->Cell(270, -50 , $fechaevento, 100, 100, 'C');
$this->Cell(132, 98 , $concepto, 100, 100, 'C');
$this->Cell(253, -74 , $total, 100, 100, 'C');


// Nota de Cargo 2 , 
$this->Cell(302,195,$folio, 100, 100, 'C');
$this->Cell(313, -182 , $fecha, 2, 2, 'C');
$this->Cell(140, 205 , $cliente, 2, 2, 'C');
$this->Cell(270, -207, $NumeroContrato, 100, 100, 'C');
$this->Cell(145, 228 , $domicilio, 100, 100, 'C');
$this->Cell(110, -213 , $tel, 100, 100, 'C');
$this->Cell(110, 227 , $rfc, 100, 100, 'C');
$this->Cell(270, -224 , $fechaevento, 100, 100, 'C');
$this->Cell(132, 270 , $concepto, 100, 100, 'C');
$this->Cell(253, -243 , $total, 100, 100, 'C');



			
			

   	
	
	function Footer()
	{
	
		
	}
	

}
}

$pdf = new MiPDF();	
$pdf->addPage();
$pdf->Output();
	




?>
