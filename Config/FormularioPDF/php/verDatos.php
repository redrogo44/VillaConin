
<?php
session_start();
include "../fpdf/fpdf.php";
require 'funciones2.php';

date_default_timezone_set('utf-8');
class MiPDF extends FPDF
{
	
	
		public function Header()
		{
			$con = mysql_connect("localhost","mbrsoluc_villaco","}g8T^Tm7xesi");
			if(!$con){
			die('no hay conexion al servidor');
		}

		$base = mysql_select_db('mbrsoluc_villaconin');
		if(!$base)
		{
				die('no se pudo conectar a la bd');
		}
			else
			{
					if($_SESSION['facturado']=='si')
					{
						
						$q="select max(id)'n' from abonofac";
						$r=mysql_query($q);
						while($muestra=mysql_fetch_array($r))
						{
							$numax=$muestra['n'];
						}
						
						$q2="select * from abonofac where id=".$numax;
						$r2=mysql_query($q2);
						while($muestra2=mysql_fetch_array($r2))
						{
							
							$NumeroContrato=$muestra2['numcontrato'];
						   $folio=$muestra2['numcontrato'];
						   $fechaactual= $muestra2['fechapago'];
						   $recibide=$muestra2['recibide'];
						   $cantidadde=$muestra2['cantidad'];
						   $concepto=$muestra2['concepto'];
						   $fechaevento=$muestra2['fechaevento'];
						   $tipoeveto=$muestra2['tipoevento'];
						   $salon=$muestra2['salon'];
						   $ncontrato=$muestra2['nomcontrato'];
						   $id=$muestra2['id'];
							$var='  folio: ';
						
						
						}
								
						// Logo
						// Arial bold 	15
						$this->Ln(5);
					   
						
						$this->SetFont('Arial','B',14);
						// Cliente
						$this->Cell(150, 2 , $ncontrato.$var.$id, 2, 2, 'C');
						$this->Cell(360, 10 , $folio, 2, 2, 'C'); 
						$this->Cell(360,2,$fechaactual,0,2,'C');
						$this->Cell(100,6,$recibide,0,2,'C');
						$this->Cell(100,6,$cantidadde,0,1,'C');$this->SetFont('Arial','B',10);
						$this->Cell(250,-6,numtoletras($cantidadde),0,1,'C');$this->SetFont('Arial','B',14);
						$this->Cell(100,18,$concepto,0,1,'C');
						$this->Cell(100,-6,$fechaevento,0,1,'C');
						$this->Cell(100,18,$tipoeveto,0,1,'C');
						$this->Cell(100,-6,$salon,0,1,'C');
						
						
						
						
						
						 $this->SetFont('Arial','B',14);
						// Expediente
						
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						   $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						  $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 12 , "" , 10, 30, 'C'); 
						 $this->Cell(150, 2 , $ncontrato.$var.$id, 2, 2, 'C');
						$this->Cell(360, 6.8 , $folio , 2, 6, 'C'); 
						$this->Cell(360,6.3,$fechaactual,0,2,'C');
						$this->Cell(100,6.8,$recibide,0,1,'C');
						$this->Cell(100,6.8,$cantidadde,0,1,'C');$this->SetFont('Arial','B',10);
						$this->Cell(250,-6,numtoletras($cantidadde),0,1,'C');$this->SetFont('Arial','B',14);
						$this->Cell(100,17,$concepto,0,1,'C');
						$this->Cell(100,-6,$fechaevento,0,1,'C');
						$this->Cell(100,18,$tipoeveto,0,1,'C');
						$this->Cell(100,-6.8,$salon,0,1,'C');
						
						
						
						 $this->SetFont('Arial','B',14);
						// Consecutivo
						
						 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						  $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						  $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 10 , "" , 10, 30, 'C'); 
						$this->Cell(150, 2 , $ncontrato.$var.$id, 2, 2, 'C');
						$this->Cell(360, 6.8 ,$folio, 2, 2, 'C'); 
						$this->Cell(360,6,$fechaactual,0,2,'C');
						$this->Cell(100,6.8,$recibide,0,1,'C');
						$this->Cell(100,6.8,$cantidadde,0,1,'C');$this->SetFont('Arial','B',10);
						$this->Cell(250,-6,numtoletras($cantidadde),0,1,'C');$this->SetFont('Arial','B',14);
						$this->Cell(100,17,$concepto,0,1,'C');
						$this->Cell(100,-6,$fechaevento,0,1,'C');
						$this->Cell(100,18,$tipoeveto,0,1,'C');
						$this->Cell(100,-6.8,$salon,0,1,'C');	
   					}
					else
					{
					
						
						////////////////////////////////////
						
						$q="select max(id)'n' from abono";
						$r=mysql_query($q);
						while($muestra=mysql_fetch_array($r))
						{
							$numax=$muestra['n'];
						}
						
						$q2="select * from abono where id=".$numax;
						$r2=mysql_query($q2);
						while($muestra2=mysql_fetch_array($r2))
						{
							
							$NumeroContrato=$muestra2['numcontrato'];
						   $folio=$muestra2['numcontrato'];
						   $fechaactual= $muestra2['fechapago'];
						   $recibide=$muestra2['recibide'];
						   $cantidadde=$muestra2['cantidad'];
						   $concepto=$muestra2['concepto'];
						   $fechaevento=$muestra2['fechaevento'];
						   $tipoeveto=$muestra2['tipoevento'];
						   $salon=$muestra2['salon'];
						   $ncontrato=$muestra2['nomcontrato'];
						   $id=$muestra2['id'];
							$var='  folio: ';
						
						
						}
								
						// Logo
						// Arial bold 	15
						$this->Ln(5);
					   
						
						$this->SetFont('Arial','B',14);
						// Cliente
						$this->Cell(150, 2 , $ncontrato.$var.$id, 2, 2, 'C');
						$this->Cell(360, 10 , $folio, 2, 2, 'C'); 
						$this->Cell(360,2,$fechaactual,0,2,'C');
						$this->Cell(100,6,$recibide,0,2,'C');
						$this->Cell(100,6,$cantidadde,0,1,'C');$this->SetFont('Arial','B',10);
						$this->Cell(250,-6,numtoletras($cantidadde),0,1,'C');$this->SetFont('Arial','B',14);
						$this->Cell(100,18,$concepto,0,1,'C');
						$this->Cell(100,-6,$fechaevento,0,1,'C');
						$this->Cell(100,18,$tipoeveto,0,1,'C');
						$this->Cell(100,-6,$salon,0,1,'C');
						
						
						
						
						
						 $this->SetFont('Arial','B',14);
						// Expediente
						
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						   $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						  $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 12 , "" , 10, 30, 'C'); 
						 $this->Cell(150, 2 , $ncontrato.$var.$id, 2, 2, 'C');
						$this->Cell(360, 6.8 , $folio , 2, 6, 'C'); 
						$this->Cell(360,6.3,$fechaactual,0,2,'C');
						$this->Cell(100,6.8,$recibide,0,1,'C');
						$this->Cell(100,6.8,$cantidadde,0,1,'C');$this->SetFont('Arial','B',10);
						$this->Cell(250,-6,numtoletras($cantidadde),0,1,'C');$this->SetFont('Arial','B',14);
						$this->Cell(100,17,$concepto,0,1,'C');
						$this->Cell(100,-6,$fechaevento,0,1,'C');
						$this->Cell(100,18,$tipoeveto,0,1,'C');
						$this->Cell(100,-6.8,$salon,0,1,'C');
						
						
						
						 $this->SetFont('Arial','B',14);
						// Consecutivo
						
						 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						  $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						  $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 6 , "" , 10, 30, 'C'); 
						 $this->Cell(330, 10 , "" , 10, 30, 'C'); 
						$this->Cell(150, 2 , $ncontrato.$var.$id, 2, 2, 'C');
						$this->Cell(360, 6.8 ,$folio, 2, 2, 'C'); 
						$this->Cell(360,6,$fechaactual,0,2,'C');
						$this->Cell(100,6.8,$recibide,0,1,'C');
						$this->Cell(100,6.8,$cantidadde,0,1,'C');$this->SetFont('Arial','B',10);
						$this->Cell(250,-6,numtoletras($cantidadde),0,1,'C');$this->SetFont('Arial','B',14);
						$this->Cell(100,17,$concepto,0,1,'C');
						$this->Cell(100,-6,$fechaevento,0,1,'C');
						$this->Cell(100,18,$tipoeveto,0,1,'C');
						$this->Cell(100,-6.8,$salon,0,1,'C');
				}
  }
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
