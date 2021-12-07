<?php

include "FormularioPDF/fpdf/fpdf.php";
session_start();  
date_default_timezone_set('utf-8');

class MiPDF extends FPDF{
	
	
	public function Header(){
		$con = mysql_connect("localhost","mbrsoluc_villaco","}g8T^Tm7xesi");
	if(!$con){
	die('no hay conexion al servidor');
	
	
}


$base = mysql_select_db('mbrsoluc_pruebasvilla');
if(!$base){
	die('no se pudo conectar a la bd');
}
else{
	
	$q="select * from contrato where Numero='".$_SESSION['lognumero']."'";
	$con=mysql_query($q) or die (mysql_error());
					while($des=mysql_fetch_array($con))
					{
						$numero=$des['Numero'];
						$nombre=$des['nombre'];
						$fechacontrato=$des['Fecha'];
						$salon=$des['salon'];
						$tipo=$des['tipo'];
						$vendedor=$des['vendedor'];
						$cadul=$des['c_adultos'];
						$cjov=$des['c_jovenes'];
						$cnin=$des['c_ninos'];
						$servicios=$des['servicios'];
					}
					$Tinvitados=$cadul+$cjov+$cnin;
	
	
}
$fecha=date("d-m-Y");



// Imagenes
$this->Image('Imagenes/formatologistica.png',5,0,200,290);
$this->SetFont('Arial','B',10);
 $this->Cell(140,35,$fechacontrato,2,2,'C');
 $this->Cell(140,-25,$numero,2,2,'C');
 $this->Cell(330,15,$tipo,2,2,'C');
 $this->Cell(140,6,$Tinvitados,2,2,'C');
 $this->Cell(140,5,$salon,2,2,'C');
 $this->Cell(330,-27,"FESTEJADOS",2,2,'C');
 $this->Cell(330,38,$nombre,2,2,'C');
 $this->Cell(330,-26,$vendedor,2,2,'C');

echo $_GET['ninos'];
 // HORARIOS Y ACTIVIDADES
 $this->SetFont('Arial','B',10);
 $this->Cell(100,100,$_POST	['actividad1'],2,2,'C');
 

//  SERVICIOS

 
        $q_recupera = "SELECT servicios FROM contrato where Numero='".$numero."'";
					$recupera = mysql_query($q_recupera) or die (mysql_error());
					$cno=mysql_fetch_array($recupera);
					 $servicios=$cno['servicios'];
					
					$arrayservicios = explode(",", $servicios);
					$this->MultiCell(0, 88 , "", 2, 2);
				for($i=0;$i<count($arrayservicios)-1;$i++)
				{
			$q2="select * from Servicios where id=".$arrayservicios[$i];
				$serv=mysql_query($q2) or die (mysql_error());
				
					while($des=mysql_fetch_array($serv))
					{$RE=0;$AL=1;$BE=1;$EN=1;$MOV=1;$PLUS=1;
						if($des['tipo']=="RECEPCION")
						{			$RE++;				
						$this->SetFont('Arial','','11');
							if($RE<2)
							{
								$this->Cell(0, 5 , "RECEPCION :", 2, 2);
								$this->Ln(1); 
							}
				
							$this->Cell(60, 5 , $des['Servicio'], 2, 2, 'C');
							$this->SetFont('Arial','','9');
							$this->MultiCell(0, 5 , $des['descripcion'], 2, 1);
							$this->Ln(2);$this->SetFont('Arial','','11');
						}
						else if($des['tipo']=="ALIMENTOS")
						{$this->SetFont('Arial','','11');
							$this->Cell(0, 5 , "ALIMENTOS :", 2, 2);
						$this->Ln(2);$this->SetFont('Arial','','11');
						
							$this->Cell(60, 5 , $des['Servicio'], 2, 2, 'C');
							$this->SetFont('Arial','','9');
							$this->MultiCell(0, 5 , $des['descripcion'], 2, 1);
							$this->Ln(2);$this->SetFont('Arial','','11');
						}
						else if($des['tipo']=="BEBIDAS")
						{$this->SetFont('Arial','','11');
							$this->Cell(0, 5 , "BEBIDAS :", 2, 2);
						$this->Ln(2);$this->SetFont('Arial','','11');
						
							$this->Cell(60, 5 , $des['Servicio'], 2, 2, 'C');
							$this->SetFont('Arial','','9');
							$this->MultiCell(0, 5 , $des['descripcion'], 2, 1);
							$this->Ln(2);$this->SetFont('Arial','','11');
						}
						else if($des['tipo']=="ENTRETENIMEITNO Y SHOW")
						{$this->SetFont('Arial','','11');
							$this->Cell(0, 5 , "ENTRETENIMIENTO Y SHOW :", 2, 2);
						$this->Ln(2);$this->SetFont('Arial','','11');
				
							$this->Cell(60, 5 , $des['Servicio'], 2, 2, 'C');
							$this->SetFont('Arial','','9');
							$this->MultiCell(0, 5 , $des['descripcion'], 2, 1);
							$this->Ln(2);
						}
						else if($des['tipo']=="MOVILIARIO Y EQUIPO")
						{ $this->SetFont('Arial','','11');
							$this->Cell(0, 5 , "MOVILIARIO :", 2, 2);
						$this->Ln(1);
		
							$this->Cell(60, 5 , $des['Servicio'], 2, 2, 'C');
							$this->SetFont('Arial','','9');
							$this->MultiCell(0, 5 , $des['descripcion'], 2, 1);
							$this->Ln(2);
						}
						else if($des['tipo']=="PLUS")
						{ $this->SetFont('Arial','','11');
							$this->Cell(0, 5 , "PLUS :", 2, 2);
						$this->Ln(1);
		
							$this->Cell(60, 5 , $des['Servicio'], 2, 2, 'C');
							$this->SetFont('Arial','','9');
							$this->MultiCell(0, 5 , $des['descripcion'], 2, 1);
							$this->Ln(2);
						}
					}

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

