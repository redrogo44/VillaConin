<?php
session_start();
include "FormularioPDF/fpdf/fpdf.php";
require '../funciones2.php';
conectar();

date_default_timezone_set('utf-8');
class MiPDF extends FPDF
{
	
	
		public function Header()
		{
				$this->Image('../Imagenes/Villa Conin.png' , 160 ,12, 45 , 48,'PNG', '');

						$q2="SELECT * from Meseros where Numero='".$_GET['numero']."'";
						$r2=mysql_query($q2);
						$muestra2=mysql_fetch_array($r2);


						$nombre=$muestra2['nombre']." ".$muestra2['ap']." ".$muestra2['am'];
						$telefonos=$muestra2['celular']." , ".$muestra2['telefono'];
						$Correo=$muestra2['correo'];
						$tipo=$muestra2['tipo'];
						$eventos=$muestra2['neventos'];
						$puntos=$muestra2['puntos'];
						$Comentarios=$muestra2['comentrarios2'];
												
						$Come=explode(",",$Comentarios);

									$this->Cell(0,7,'INFORMACION DEL PERSONAL',1,0,'C');									
									$this->Cell(60,20,$nombre,1,0,'C');
									$this->Cell(60,20,$telefonos,1,0,'C');
									$this->Cell(60,20,$Correo,1,0,'C');
									$this->Cell(60,20,$tipo,1,0,'C');
									$this->Cell(60,20,$eventos,1,0,'C');
									$this->Cell(60,20,$puntos,1,0,'C');

									for ($i=0; $i <count($Come); $i++) 
									{ 
										$this->Cell(0,7,$Come[$i],1,0,'C');		

									}




									$this->Ln(7);		
						
						   
		}
									
			
 
	function Footer()
	{
	
    
	}
	
}

// Creación del objeto de la clase heredada

$pdf = new MiPDF();	

$pdf->addPage();
$pdf->pagina1();
$pdf->addPage();
$pdf->pagina2();



$pdf->Output();
	


				
				
  
function fecha_es($Fecha)
{

//echo $Fecha;
	$FechaLetras=explode("-",$Fecha);
//echo date($FechaLetras[2]);

//echo $dia=$FechaLetras[2];
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
    $nu=$FechaLetras[2];
  //  echo $dias[2];
    $meses=array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
    return $dias[date('N', strtotime($Fecha))]." ".$FechaLetras[2]." de ".$meses[$FechaLetras[1]]." del ".$FechaLetras[0];   
   
}	

?>
