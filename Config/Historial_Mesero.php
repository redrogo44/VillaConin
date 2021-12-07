<?php
ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", dirname(__FILE__)."/error_log.txt");
error_reporting(E_All);
session_start();
include "../FormularioPDF/fpdf/fpdf.php";
require 'configuraciones.php';
conectar();


date_default_timezone_set('utf-8');
class MiPDF extends FPDF
{
	
	
		public function Header()
		{
				$this->Image('../Imagenes/Villa Conin.png' , 160 ,12, 45 , 48,'PNG', '');			
		}
			function pagina1()
			{ $this->SetFont('Arial','B',12);
						$this->SetTextColor(0,0,100);
				$mm=mysql_query("SELECT * FROM Meseros WHERE id=".$_GET['numero']);
				$mes=mysql_fetch_array($mm);
				
				$this->Cell(40,5,"Nombre: ".utf8_decode($mes['nombre']." ".$mes['ap']." ".$mes['am']),0,0,'L');$this->Ln(5);
				$this->Cell(40,10,"Tipo de Mesero: ".utf8_decode($mes['tipo']),0,0,'L');$this->Ln(5);
				$this->Cell(40,15,"Telefonos: ".($mes['telefono']." , ".$mes['celular']),0,0,'L');$this->Ln(5);
				$this->Cell(40,20,"Correo: ".($mes['correo']),0,0,'L');$this->Ln(5);
				$this->Cell(40,20,"# de Eventos: ".($mes['neventos']),0,0,'L');$this->Ln(20);
						$this->SetTextColor(0,0,0);

							$this->Cell(10,5,"#",1,0,'C');
							$this->Cell(20,5,"SEMANA",1,0,'C');
							$this->Cell(30,5,"CONTRATO",1,0,'C');
							$this->Cell(55,5,"TIPO DE MESERO",1,0,'C');							
							$this->Cell(25,5,"PUNTOS",1,0,'C');							
						$this->Ln(5);
						$inc=0;
						 $fecha="01-01-".date('Y');
				//$m=mysql_query("SELECT * FROM TMeserosEvento WHERE ano='".date('Y')."' ORDER BY id");
				$m=mysql_query("SELECT * FROM TMeserosEvento WHERE fdr2>='".$mes['fechaingreso']." 00:00:00' ORDER BY id");
				while ($me=mysql_fetch_array($m)) 
				{
					$id=explode(",",$me['meseros']);
					for ($i=0; $i <count($id); $i++) 
					{ 
						$mesero=explode("-",$id[$i]);
						if($_GET['numero']==$mesero[0])
						{$inc++;
							$cf=mysql_query("SELECT * FROM Configuraciones WHERE id=".$mesero[1]);
							$ttip=mysql_fetch_array($cf);
							$con=mysql_query("SELECT * FROM contrato WHERE Numero='".$me['contratos']."' AND Fecha>='".$fecha."' ");
							if (mysql_num_rows($con)<1) 
							{
								$Ea=mysql_query("SELECT * FROM Eventos_Adicionales WHERE Numero='".$me['contratos']."' ");
								if (mysql_num_rows($Ea)<1) 
								{
									$Er=mysql_query("SELECT * FROM Eventos_Recaudacion WHERE Numero='".$me['contratos']."' ");									
									$contrato=mysql_fetch_array($Er);
									
								}
								else
								 {
										$contrato=mysql_fetch_array($Ea);									
								 }
							}
							else{
							$contrato=mysql_fetch_array($con);								
							}

							$this->Cell(10,5,$inc,1,0,'C');
							$this->Cell(20,5,(semana($contrato['Fecha'])),1,0,'C');
							$this->Cell(30,5,($contrato['Numero']),1,0,'C');
							$this->Cell(55,5,$ttip['descripcion'],1,0,'C');
							$this->Cell(25,5,$mesero[3],1,0,'C');
							$this->Ln(5);
						}
					}
				}
							$this->Ln(15);				
				$this->Cell(130,5,'COMENTARIOS',0,0,'C');	
							$this->Ln(10);				

				$porciones = explode(",", $mes['comentarios2']);				
			for ($i = 0; $i <= count($porciones); $i++) 
			{
				$this->Cell(80,5,utf8_decode($porciones[$i]),0,0,'C');			    
							$this->Ln(5);				
			}
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

function semana($fecha)
{
	$fecha=$fecha; // fecha.

#separas la fecha en subcadenas y asignarlas a variables
#relacionadas en contenido, por ejemplo dia, mes y anio.

$dia   = substr($fecha,8,2);
$mes = substr($fecha,5,2);
$anio = substr($fecha,0,4);  
$semana = date('W',  mktime(0,0,0,$mes,$dia,$anio));  

//donde:
        
#W (mayúscula) te devuelve el número de semana
#w (minúscula) te devuelve el número de día dentro de la semana (0=domingo, #6=sabado)
return $semana;
}	
?>
