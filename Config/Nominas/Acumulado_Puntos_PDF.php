<?php
session_start();
include "../FormularioPDF/fpdf/fpdf.php";
require '../configuraciones.php';
conectar();

date_default_timezone_set('utf-8');
class MiPDF extends FPDF
{
	
	
		public function Header()
		{
				$this->Image('../../Imagenes/Villa Conin.png' , 160 ,12, 45 , 48,'PNG', '');

						
						$this->Ln(5);					   						
						$this->SetFont('Arial','B',16);
						// Cliente
						$this->Cell(0, 10 ,"PREMIO DE LEALTAD", 2, 2, 'C');					
						$this->SetFont('Arial','B',12);
						$this->Cell(70,13,"LISTADO DE CATEGORIAS", 2, 2, 'L');
						
			}
			function pagina1()
			{ 
				$CAT=mysql_query("SELECT * FROM Meseros GROUP BY tipo");
				$this->SetY(70);
$this->SetDrawColor(116,0,0);
				while ($CATEGORIA=mysql_fetch_array($CAT)) 
				{
	$this->SetX(50);
					
					$Acumulado_Puntos=$Acumulado_Puntos+TotalPuntos($CATEGORIA['tipo']);					

					$this->Cell(70,10,$CATEGORIA['tipo'], 1, 0, 'C');
					$this->Cell(30,10,TotalPuntos($CATEGORIA['tipo']), 1, 0, 'C');
					$this->Ln(10);
				}
	$this->SetX(50);
						$this->Cell(70,10,'PREMIO DE LEALTAD',1,0,'C');
						$this->Cell(30,10,$Acumulado_Puntos,1,0,'C');

			}
			
	function Footer()
	{
	
    
	}
	
}

// Creación del objeto de la clase heredada

$pdf = new MiPDF();	

$pdf->addPage();
$pdf->pagina1();




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
			$TotalPuntos_Categoria=$TotalPuntos_Categoria+($Puntos['puntos']*$TOTAL['neventos'])+$TOTAL['reajuste'];
		}
		return $TotalPuntos_Categoria;
	}
?>
