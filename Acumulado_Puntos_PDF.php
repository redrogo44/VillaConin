<?php
session_start();
include "FormularioPDF/fpdf/fpdf.php";
require 'configuraciones.php';
conectar();
date_default_timezone_set('utf-8');
class MiPDF extends FPDF
{
	
	
		public function Header()
		{
				$this->Image('Imagenes/Villa Conin.png' , 160 ,12, 45 , 48,'PNG', '');
				$Acumulado_Puntos=0;
				$se="SELECT * FROM Meseros GROUP BY tipo";
				$CAT=mysql_query($se);
				$this->SetTextColor(0, 0, 0); //Letra color blanco
				$this->SetFillColor(2,157,116);//Fondo verde de celda
				while($CATE = mysql_fetch_array ($CAT)) 
				{
					$this->Cell(80,7,$CATE['tipo'],1,0,'C');							
					$this->Cell(40,7,TotalPuntos($CATEGORIA['tipo']),1,0,'C');			
					$this->Cell(40,7,"que rollo",1,0,'C');			

									$this->Ln(7);		
					$Acumulado_Puntos=$Acumulado_Puntos+TotalPuntos($CATEGORIA['tipo']);					

				}
						$this->Cell(0, 10 ,"Eventos Sociales Villa Conin S.A. de C.V.", 2, 2, 'C');											
					$this->Cell(40,7,'kk',1,0,'C',0);			
						   
		}
									
			
 
	function Footer()
	{
	
    
	}
	
}

// Creación del objeto de la clase heredada

$pdf = new MiPDF();	
$pdf->addPage();

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
function TotalPuntos($tipo)
	{	
		$PP="SELECT * FROM Configuraciones WHERE descripcion='".$tipo."'";
		$Pun=mysql_query($PP);		
		$Puntos=mysql_fetch_array($Pun);
		$TT=mysql_query("SELECT * FROM Meseros WHERE tipo='".$tipo."'");
		$TotalPuntos_Categoria=0;
		while($TOTAL=mysql_fetch_array($TT))
		{
			$TotalPuntos_Categoria=$TotalPuntos_Categoria+$Puntos['puntos']*$TOTAL['neventos'];
		}
		return $TotalPuntos_Categoria;
	}
?>
