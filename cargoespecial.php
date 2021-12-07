
<?php
session_start();
include "FormularioPDF/fpdf/fpdf.php";
require 'funciones2.php'; 
date_default_timezone_set('utf-8');

class MiPDF extends FPDF
{
	
	
	public function Header()
	{
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
	mysql_set_charset('utf8');
	 //echo "conexion exitosa";
	
			
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
					$q3="select * from contrato where Numero='Y190614L'";
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
			$this->Cell(75, -48 , $total, 100, 100, 'C');
				$this->Cell(180,48,numtoletras($total),0,1,'C');
			// Nota de Cargo 2 , 
			$this->Cell(350,37	,$folio, 100, 100, 'C');
			$this->Cell(355, -28 , $fecha, 2, 2, 'C');
			$this->Cell(120, 44 , $cliente, 2, 2, 'C');
			$this->Cell(300, -44, $NumeroContrato, 100, 100, 'C');
			$this->Cell(125, 55 , $domicilio, 100, 100, 'C');
			$this->Cell(110, -43 , $tel, 100, 100, 'C');
			$this->Cell(110, 55 , $rfc, 100, 100, 'C');
			$this->Cell(300, -57 , $fechaevento, 100, 100, 'C');
			$this->Cell(122, 90 , $concepto, 100, 100, 'C');
			$this->Cell(75, -75 , $total, 100, 100, 'C');$this->Cell(180,75,numtoletras($total),0,1,'C');
			
			// Nota de Cargo 3 ,
			$this->Cell(350,10,$folio, 100, 100, 'C');
			$this->Cell(355, -2 , $fecha, 2, 2, 'C');
			$this->Cell(120, 15 , $cliente, 2, 2, 'C');
			$this->Cell(300, -15,	 $NumeroContrato, 100, 100, 'C');			
			$this->Cell(125, 29 , $domicilio, 100, 100, 'C');
			$this->Cell(110, -20 , $tel, 100, 100, 'C');
			$this->Cell(110, 30 , $rfc, 100, 100, 'C');		
			$this->Cell(300, -28 , $fechaevento, 100, 100, 'C');
			$this->Cell(132, 60 , $concepto, 100, 100, 'C');
			$this->Cell(75, -44 , $total, 100, 100, 'C');$this->Cell(180,44,numtoletras($total),0,1,'C');
				
		}
		
	function Footer()
	{
	
		
	}
	

}
}

$pdf = new MiPDF();	
$pdf->addPage();
$pdf->Output();
	




?>
