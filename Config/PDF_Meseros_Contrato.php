<?php
session_start();
include "FormularioPDF/fpdf/fpdf.php";
require 'funciones2.php';
conectar();

date_default_timezone_set('utf-8');
class MiPDF extends FPDF
{
	
	
		public function Header()
		{
				$this->Image('Imagenes/Villa Conin.png' , 160 ,12, 45 , 48,'PNG', '');

						$q2="SELECT * from contrato where Numero='".$_GET['numero']."'";
						$r2=mysql_query($q2);
						$muestra2=mysql_fetch_array($r2);
												
						   $NumeroContrato=$muestra2['Numero'];						   
						   $fechaactual= getdate('Y-M-D');
						   $salon=$muestra2['salon'];
						   $Tipo=$muestra2['tipo'];
						   $fechaevento=$muestra2['Fecha'];
						   $adultos=$muestra2['c_adultos'];
						   $jovenes=$muestra2['c_jovenes'];
						   $ninos=$muestra2['c_ninos'];
						   $Comensales=$adultos+$jovenes+$ninos;
						   $Meser=$muestra2['Meseros'];																				
						   $Meseros=explode(",", $Meser);
						// Logo
						// Arial bold 	15
						$this->Ln(5);
					   						
						$this->SetFont('Arial','B',16);
						// Cliente
						$this->Cell(0, 10 ,"Eventos Sociales Villa Conin S.A. de C.V.", 2, 2, 'C');					
						$this->SetFont('Arial','B',12);
						$this->Cell(70,13,"LISTADO DE PERSONAL", 2, 2, 'L');
						$this->Cell(70, 22 , "CONTRATO No. ".$NumeroContrato, 2, 2, 'L'); 
						$this->Cell(70,5,"CANTIDAD DE COMENSALES: ".$Comensales,0,2,'L');
						$this->Cell(70,5,"SALON: ".$salon,0,2,'L');
						$this->Cell(70,5,"TIPO DE EVENTO: ".utf8_decode($Tipo),0,1,'L');
						$this->Cell(70,5,"FECHA DE EVENTO: ".$fechaevento,0,1,'L');										
						$this->Cell(135,-6,"( ".fecha_es($fechaevento)." )",0,1,'R');										

						$this->Ln(15);
			}
			function pagina1()
			{ 
				$ORDEN=OrdenaMeseros();
				$q2="SELECT * from contrato where Numero='".$_GET['numero']."'";
						$r2=mysql_query($q2);
						$muestra2=mysql_fetch_array($r2);
												
						   $NumeroContrato=$muestra2['Numero'];						   
						   $fechaactual= getdate('Y-M-D');
						   $salon=$muestra2['salon'];
						   $Tipo=$muestra2['tipo'];
						   $fechaevento=$muestra2['Fecha'];
						   $adultos=$muestra2['c_adultos'];
						   $jovenes=$muestra2['c_jovenes'];
						   $ninos=$muestra2['c_ninos'];
						   $Comensales=$adultos+$jovenes+$ninos;
						   $Meser=$muestra2['Meseros'];																				
						   $Meseros=explode(",", $Meser);
						   $Ord=mysql_query("SELECT * FROM Configuraciones WHERE tipo='ORDEN MESEROS'");
						   $Ordena=mysql_fetch_array($Ord);						   
						   $ORDEN=explode(',', $Ordena['descripcion']);$c=0;
						   $contador=0;
						   for ($i=0; $i <count($ORDEN); $i++) 
						   { 
						   		for ($j=0; $j <count($Meseros); $j++) 
						   		{ 
						   			$Con=mysql_query("SELECT * FROM Meseros WHERE id=".$Meseros[$j]);
						   			$Consulta=mysql_fetch_array($Con);
						   			//echo $Consulta['tipo'];
						   			//cho $ORDEN[$i];
						   			if ($Consulta['tipo']==$ORDEN[$i]) 
						   			{
						   				$c++;
						   			}
						   			if ($c>0) 
						   			{
						  				$z[$i]=$c;
						   			}
						   			//echo $z[$i];

						   		}$c=0;
						   }
						   for ($k=0; $k < count($ORDEN); $k++) 
						   { 
						   	if ($z[$k]>0) 
						   	{
								$this->Cell(190,7,$ORDEN[$k],1,0,'C');							   		
										$this->Ln(7);								
										$contador=0;
								for ($l=0; $l <count($Meseros) ; $l++) 
						  		{ 
						  			$Con=mysql_query("SELECT * FROM Meseros WHERE id=".$Meseros[$l]);
						   			$Consulta=mysql_fetch_array($Con);
									if ($ORDEN[$k]==$Consulta['tipo']) 
									{$contador++;
										$this->Cell(10,7,$contador,1,0,'C');											
										$this->Cell(90,7,$Consulta['nombre']." ".$Consulta['ap']." ".$Consulta['am'],1,0,'C');										
										$this->Cell(90,7,'',1,0,'C');											

										$this->Ln(7);
									}						  			
						  		}
										$this->Cell(10,7,'',1,0,'C');											
						  				$this->Cell(90,7,'',1,0,'C');
										$this->Cell(90,7,'',1,0,'C');																	  				
										$this->Ln(7);
										$this->Cell(10,7,'',1,0,'C');											
										$this->Cell(90,7,'',1,0,'C');		
										$this->Cell(90,7,'',1,0,'C');											
										$this->Ln(7);
						   		
						   	}
						  		
						   }

							
			}
			function pagina2()
			{
				$ORDEN=OrdenaMeseros();
				$q2="SELECT * from contrato where Numero='".$_GET['numero']."'";
						$r2=mysql_query($q2);
						$muestra2=mysql_fetch_array($r2);
												
						   $NumeroContrato=$muestra2['Numero'];						   
						   $fechaactual= getdate('Y-M-D');
						   $salon=$muestra2['salon'];
						   $Tipo=$muestra2['tipo'];
						   $fechaevento=$muestra2['Fecha'];
						   $adultos=$muestra2['c_adultos'];
						   $jovenes=$muestra2['c_jovenes'];
						   $ninos=$muestra2['c_ninos'];
						   $Comensales=$adultos+$jovenes+$ninos;
						   $Meser=$muestra2['Meseros'];																				
						   $Meseros=explode(",", $Meser);
						 $Ord=mysql_query("SELECT * FROM Configuraciones WHERE tipo='ORDEN MESEROS'");
						   $Ordena=mysql_fetch_array($Ord);						   
						   $ORDEN=explode(',', $Ordena['descripcion']);$c=0;
						   $contador2=0;
						   $totalacumulado=0;$totalGeneral=0;
						   for ($i=0; $i <count($ORDEN); $i++) 
						   { 
						   		for ($j=0; $j <count($Meseros); $j++) 
						   		{ 
						   			$Con=mysql_query("SELECT * FROM Meseros WHERE id=".$Meseros[$j]);
						   			$Consulta=mysql_fetch_array($Con);
						   			//echo $Consulta['tipo'];
						   			//cho $ORDEN[$i];
						   			if ($Consulta['tipo']==$ORDEN[$i]) 
						   			{
						   				$c++;
						   			}
						   			if ($c>0) 
						   			{
						  				$z[$i]=$c;
						   			}
						   			//echo $z[$i];

						   		}$c=0;
						   }
						   for ($k=0; $k < count($ORDEN); $k++) 
						   { $totalacumulado=0;
						   	if ($z[$k]>0) 
						   	{
								
										$this->SetTextColor(0,0,0);
									$this->SetFillColor(255,255,255);
									$this->SetDrawColor(0,0,0);
								$this->Cell(190,7,$ORDEN[$k],1,0,'C');							   		

										$this->Ln(7);								
						   $contador2=0;

								for ($l=0; $l <count($Meseros) ; $l++) 
						  		{ 
						  			$Con=mysql_query("SELECT * FROM Meseros WHERE id=".$Meseros[$l]);
						   			$Consulta=mysql_fetch_array($Con);
						   			$suel=mysql_query("SELECT * FROM Configuraciones WHERE descripcion='".$Consulta['tipo']."'");
						   			$sueldo=mysql_fetch_array($suel);
									if ($ORDEN[$k]==$Consulta['tipo']) 
									{
										$contador2++;
										$this->Cell(10,7,$contador2,1,0,'C');																					
										$this->Cell(90,7,$Consulta['nombre']." ".$Consulta['ap']." ".$Consulta['am'],1,0,'C');
										$this->Cell(30,7,'$ '.money_format('%i', $sueldo['valor']),1,0,'C');																					
										$this->Cell(60,7,'',1,0,'C');											
										$totalacumulado=$sueldo['valor']+$totalacumulado;
										$totalGeneral=$sueldo['valor']+$totalGeneral;

										$this->Ln(7);
									}						  			
						  		}
										$this->Cell(10,7,'',1,0,'C');																					
						  				$this->Cell(90,7,'',1,0,'C');
										$this->Cell(30,7,'',1,0,'C');																					
										$this->Cell(60,7,'',1,0,'C');																	  				
										$this->Ln(7);
										$this->Cell(10,7,'',1,0,'C');																					
										$this->Cell(90,7,'',1,0,'C');		
										$this->Cell(30,7,'',1,0,'C');																					
										$this->Cell(60,7,'',1,0,'C');								
										$this->Ln(7);
										$this->SetTextColor(255,0,0);
									$this->SetFillColor(255,247,0);
									$this->SetDrawColor(255,247,0);
										$this->Cell(10,7,'',1,0,'C');																					
										$this->Cell(90,7,'Total Acumulado',1,0,'C');		
										$this->Cell(30,7,'$ '.money_format('%i', $totalacumulado),1,0,'C');																					
										//$this->Cell(60,7,'',1,0,'C');	
										$this->Ln(7);

						   		
						   	}
						  	
						   }
						   	$this->Cell(10,7,'',1,0,'C');																					
										$this->Cell(90,7,'Total General',1,0,'C');		
										$this->Cell(30,7,'$ '.money_format('%i', $totalGeneral),1,0,'C');																					
											
						   				
						   		

							
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
function OrdenaMeseros()
{
	$ORD="SELECT descripcion from Configuraciones Where nombre='ORDEN MESEROS'";
            	$ORDE=mysql_query($ORD);
            	$ORDEN=mysql_fetch_array($ORDE);

            	 $ffff=explode(",",$ORDEN['descripcion']);
			$sente;
            	 for ($i=0; $i <count($ffff); $i++) 
            	 { 
            	 	# code...
            	 	if(empty($sente)||$sente=="")
            	 	{
            	 		$sente="tipo='".$ffff[$i]."'";
            	 	}
            	 	else
            	 	{
            	  		$sente= $sente.",tipo='".$ffff[$i]."'";
            	  	}
            	 }

            	return $sente;

}
?>
