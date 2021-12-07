
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
		while($muestra31=mysql_fetch_array($r3))
		{
			 $idcliente=$muestra31['id_cliente'];
			 $fechaevento=$muestra31['Fecha'];
		}
		// Tabla Cliente
		
		$q3="select * from cliente where id=".$idcliente;
		$r3=mysql_query($q3);
		while($muestra3=mysql_fetch_array($r3)){
			$nomcli=$muestra3['nombre'];
			$ap=$muestra3['ap'];
			$am=$muestra3['am'];
			$domicilio=$muestra3['dom'];
			$tel=$muestra3['tel'];
		    $rfc=$muestra3['rfc'];									
			}
			$cliente=$nomcli." ".$ap." ".$am;
}

 $this->Ln(5);
 $this->SetFont('Arial','B',15);

//  Variables

$this->Ln(4);

// Imagenes
$this->Image('Imagenes/villaconin2.png',5,10,200,90);
$this->Image('Imagenes/villaconin2.png',5,105,200,90);
$this->Image('Imagenes/villaconin2.png',5,200,200,90);

// Impresiones  Not< de Cargo 1
$this->SetFont('Arial','B',9);
$this->Cell(350, 19 , $folio, 100, 100, 'C');
$this->Cell(355, -10 , $fecha, 2, 2, 'C');
$this->Cell(120, 24 , $cliente, 2, 2, 'C');
$this->Cell(300, -22 , $NumeroContrato, 100, 100, 'C');
$this->Cell(125, 35 , $domicilio, 100, 100, 'C');
$this->Cell(110, -25 , $tel, 100, 100, 'C');
$this->Cell(110, 35 , $rfc, 100, 100, 'C');
$this->Cell(300, -35 , $fechaevento, 100, 100, 'C');
$this->Cell(120, 65 , $concepto, 100, 100, 'C');
$this->Cell(25, -48 , $total, 100, 100, 'C');
// Nota de Cargo 2 , 
$this->Cell(350,133	,$folio, 100, 100, 'C');
$this->Cell(355, -124 , $fecha, 2, 2, 'C');
$this->Cell(120, 139 , $cliente, 2, 2, 'C');
$this->Cell(300, -140, $NumeroContrato, 100, 100, 'C');
$this->Cell(125, 153 , $domicilio, 100, 100, 'C');
$this->Cell(110, -143 , $tel, 100, 100, 'C');
$this->Cell(110, 155 , $rfc, 100, 100, 'C');
$this->Cell(300, -157 , $fechaevento, 100, 100, 'C');
$this->Cell(122, 190 , $concepto, 100, 100, 'C');
$this->Cell(295, -175 , $total, 100, 100, 'C');
// Nota de Cargo 3 ,
$this->Cell(350,261	,$folio, 100, 100, 'C');
$this->Cell(355, -252 , $fecha, 2, 2, 'C');
$this->Cell(120, 265 , $cliente, 2, 2, 'C');
$this->Cell(300, -263,	 $NumeroContrato, 100, 100, 'C');			
$this->Cell(125, 279 , $domicilio, 100, 100, 'C');
$this->Cell(110, -270 , $tel, 100, 100, 'C');
$this->Cell(110, 280 , $rfc, 100, 100, 'C');		
$this->Cell(300, -278 , $fechaevento, 100, 100, 'C');
$this->Cell(132, 308 , $concepto, 100, 100, 'C');
$this->Cell(305, -294 , $total, 100, 100, 'C');
	
	function Footer()
	{
	
		
	}
	

}
}

$pdf = new MiPDF();	
$pdf->addPage();
$pdf->Output();
	




?>
