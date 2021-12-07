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



					 $q2="SELECT * from Eventos_Recaudacion where Numero='".$_GET['numero']."'";

						$r2=mysql_query($q2);						

						$muestra2=mysql_fetch_array($r2);															

												

						   $NumeroContrato=$muestra2['Numero'];						   

						   $fechaactual= getdate('Y-M-D');

						   $salon=$muestra2['salon'];

						   $Tipo="RECAUDACION";

						   $fechaevento=$muestra2['fecha'];

						   $comensales=$muestra2['comensales'];				

							//$Comensales=total_comensales($NumeroContrato,$muestra2['facturado'])+$Comensales;												   															



						   $Meseros=explode(",", $Meser);

						// Logo

						// Arial bold 	15

						$this->Ln(5);

					   						

						$this->SetFont('Arial','B',16);$this->SetTextColor(0,0,0);

						// Cliente

						$this->Cell(0, 5 ,"Eventos Sociales Villa Conin S.A. de C.V.", 2, 2, 'C');					

						$this->SetFont('Arial','B',10);

						$this->Cell(70,13,"LISTADO DE PERSONAL", 2, 2, 'L');

						$this->Cell(70, 0 , "CONTRATO No. ".$NumeroContrato, 2, 2, 'L'); 

						$this->Cell(70,7,"CANTIDAD DE COMENSALES: ".$comensales,0,2,'L');	

						$this->Cell(70,0,"SALON: ".$salon,0,2,'L');

						$this->Cell(70,7,"TIPO DE EVENTO: RECAUDACION",0,1,'L');

						$this->Cell(70,0,"FECHA DE EVENTO: ".$fechaevento,0,1,'L');										

						/*$this->Cell(145,0,"( ".fecha_es($fechaevento)." )",0,1,'R');	*/

									

						$this->Cell(70,7,"SEMANA : # ".date(W),0,1,'L');

												$this->Ln(15);						

			}

			

			function pagina1()

			{ 

			

				$ORDEN=OrdenaMeseros();

				 $q2="SELECT * from Eventos_Recaudacion where Numero='".$_GET['numero']."'";

						$r2=mysql_query($q2);

						

						$muestra2=mysql_fetch_array($r2);

							

												

						   $NumeroContrato=$muestra2['Numero'];						   

						   $fechaactual= getdate('Y-M-D');

						   $salon=$muestra2['salon'];

						   $Tipo="RECAUDACION";

						   $fechaevento=$muestra2['fecha'];						  

						   $Comensales=$muestra2['comensales'];

						   $Meser=$muestra2['Meseros'];																				

						   $Meseros=explode(",", $Meser);

						   $Ord=mysql_query("SELECT * FROM Configuraciones WHERE tipo='ORDEN MESEROS'");

						   $Ordena=mysql_fetch_array($Ord);						   

						   $ORDEN=explode(',', $Ordena['descripcion']);$c=0;

						   $contador=0;

						   //    LEYENDA DE EVENTO UNICO

							   $this->SetFont('Arial','B',10);

								// Cliente

								$this->SetTextColor(0,0,0);

								$this->Cell(100, 0,"LISTADO DE PERSONAL PARTICIPANTE PARA EVENTO", 2, 2, 'C');	

								$this->SetFont('Arial','B',18);

								$this->Cell(218,  0,"UNICO", 2, 2, 'C');	

								$this->SetFont('Arial','B',10);

								$this->Cell(260, 0 ,"DE FECHA ", 2, 2, 'C');	

								$this->Cell(198,0,"( ".fecha_es($fechaevento)." )",0,1,'R');

							   $this->Ln(15);

						   

						   /////////////////////////////////////

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

							$this->SetFillColor(255,0,0);

							$this->SetDrawColor(255,0,0);	

							$this->SetTextColor(0,0,255);

						  $this->Cell(15,5,'#',1,0,'C');											

						  $this->Cell(90,5,'NOMBRE',1,0,'C');								 					  

						  $this->Cell(75,5,'FIRMA',1,0,'C');	

							$this->Ln(5);

							$this->SetFillColor(0,0,0);

							$this->SetDrawColor(0,0,0);

							$this->SetTextColor(0,0,0);

							

						   for ($k=count($ORDEN); $k >=0;  $k--) 

						   { 

							$this->SetFont('Arial','B',10);

										 

						   	if ($z[$k]>0) 

						   	{

								$this->Cell(180,5,$ORDEN[$k],1,0,'C');							   		

										$this->Ln(5);

										$contador=0;

								for ($l=0; $l <count($Meseros) ; $l++) 

						  		{ 

						  			$Con=mysql_query("SELECT * FROM Meseros WHERE id=".$Meseros[$l]);

						   			$Consulta=mysql_fetch_array($Con);

									if ($ORDEN[$k]==$Consulta['tipo']) 

									{$contador++;

										$this->Cell(15,5,$contador,1,0,'C');

										$this->SetFont('Arial','B',10);										

										$this->Cell(90,5,utf8_decode($Consulta['nombre']." ".$Consulta['ap']." ".$Consulta['am']),1,0,'C');																						

										$this->Cell(75,5,'',1,0,'C');

										$this->Ln(5);

									}						  			

						  		} 		
						   	}				
						   }
						   				$this->Cell(180,5,'EXTRAS',1,0,'C');										
										$this->Ln(5);

						   				$this->Cell(15,5,'',1,0,'C');											

						  				$this->Cell(90,5,'',1,0,'C');										

										$this->Cell(75,5,'',1,0,'C');																	  				

										$this->Ln(5);

										$this->Cell(15,5,'',1,0,'C');											

										$this->Cell(90,5,'',1,0,'C');																						

										$this->Cell(75,5,'',1,0,'C');									

										$this->Ln(5);						   
											$this->Cell(15,5,'',1,0,'C');											

						  				$this->Cell(90,5,'',1,0,'C');										

										$this->Cell(75,5,'',1,0,'C');																	  				

										$this->Ln(5);

										$this->Cell(15,5,'',1,0,'C');											

										$this->Cell(90,5,'',1,0,'C');																						

										$this->Cell(75,5,'',1,0,'C');									

										$this->Ln(5);

			}

			function pagina2()

			{

				$ORDEN=OrdenaMeseros();

				$q2="SELECT * from Eventos_Recaudacion where Numero='".$_GET['numero']."'";

						$r2=mysql_query($q2);

							$muestra2=mysql_fetch_array($r2);

						   $NumeroContrato=$muestra2['Numero'];						   

						   $fechaactual= getdate('Y-M-D');

						   $salon=$muestra2['salon'];

						   $Tipo="RECAUDACION";

						   $fechaevento=$muestra2['fecha'];						  

						   $Comensales=$muestra2['comensales'];

						   $Meser=$muestra2['Meseros'];																				

						   $Meseros=explode(",", $Meser);

						 $Ord=mysql_query("SELECT * FROM Configuraciones WHERE tipo='ORDEN MESEROS'");

						   $Ordena=mysql_fetch_array($Ord);						   

						   $ORDEN=explode(',', $Ordena['descripcion']);$c=0;

						   $contador2=0;

						   $totalacumulado=0;$totalGeneral=0;

						   

						   

						   //   LEYENDA DE EVENTO UNICO

						   $this->SetFont('Arial','B',10);

							// Cliente

							$this->SetTextColor(0,0,0);

							$this->Cell(100, 0,"LISTADO DE PERSONAL PARTICIPANTE PARA EVENTO", 2, 2, 'C');	

							$this->SetFont('Arial','B',18);

							$this->Cell(218,  0,"UNICO", 2, 2, 'C');	

							$this->SetFont('Arial','B',10);

							$this->Cell(260, 0 ,"DE FECHA ", 2, 2, 'C');	

							$this->Cell(198,0,"( ".fecha_es($fechaevento)." )",0,1,'R');

						   $this->Ln(15);

						   ///////////////////////////////

						   

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

						   $this->SetFillColor(255,0,0);

							$this->SetDrawColor(255,0,0);	

							$this->SetTextColor(0,0,255);

						  $this->Cell(10,5,'#',1,0,'C');											

						  $this->Cell(50,5,'NOMBRE',1,0,'C');		

						  $this->Cell(30,5,'HORA ENTRADA',1,0,'C');											

						  $this->Cell(30,5,'HORA SALIDA',1,0,'C');

						  $this->Cell(30,5,'PAGO',1,0,'C');

						  $this->Cell(40,5,'FIRMA',1,0,'C');	

							$this->Ln(5);

							$this->SetFillColor(0,0,0);

							$this->SetDrawColor(0,0,0);

							$this->SetTextColor(0,0,0);

						   for ($k=count($ORDEN); $k >=0; $k--) 

						   { $totalacumulado=0;

							$this->SetFont('Arial','B',10);



						   	if ($z[$k]>0) 

						   	{

								

										$this->SetTextColor(0,0,0);

									$this->SetFillColor(255,255,255);

									$this->SetDrawColor(0,0,0);

								$this->Cell(190,5,$ORDEN[$k],1,0,'C');							   		



										$this->Ln(5);								

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

										$this->Cell(10,5,$contador2,1,0,'C');		

										$this->SetFont('Arial','B',7);		

										$this->Cell(50,5,$Consulta['nombre']." ".$Consulta['ap']." ".$Consulta['am'],1,0,'C');

										$this->SetFont('Arial','B',10);

										$this->Cell(30,5,'',1,0,'C');	

										$this->Cell(30,5,'',1,0,'C');	

										$this->Cell(30,5,'$ '.money_format('%i', $sueldo['valor']),1,0,'C');																					

										$this->Cell(40,5,'',1,0,'C');											

										$totalacumulado=$sueldo['valor']+$totalacumulado;

										$totalGeneral=$sueldo['valor']+$totalGeneral;



										$this->Ln(5);

									}						  			

						  		}

									
										$this->SetX(40); 							

										$this->SetTextColor(255,0,0);

										$this->SetFillColor(255,247,0);

										$this->SetDrawColor(255,247,0);																															

										$this->Cell(90,5,'Total Acumulado',1,0,'C');		

										$this->Cell(30,5,'$ '.money_format('%i', $totalacumulado),1,0,'C');																					

										//$this->Cell(60,7,'',1,0,'C');	

										$this->Ln(5);



						   		

						   	}

						  	

						   }
$this->SetTextColor(0,0,0);
										$this->SetFillColor(0,0,0);
										$this->SetDrawColor(0,0,0);		
						$this->Cell(190, 5,utf8_decode("EXTRAS"), 1, 2, 'C');	
										$this->Cell(10,5,'',1,0,'C');											
						  				$this->Cell(50,5,'',1,0,'C');
										$this->Cell(30,5,'',1,0,'C');											
										$this->Cell(30,5,'',1,0,'C');
										$this->Cell(30,5,'',1,0,'C');
										$this->Cell(40,5,'',1,0,'C');																	  																													  			
										$this->Ln(5);
										$this->Cell(10,5,'',1,0,'C');											
										$this->Cell(50,5,'',1,0,'C');		
										$this->Cell(30,5,'',1,0,'C');											
										$this->Cell(30,5,'',1,0,'C');
										$this->Cell(30,5,'',1,0,'C');
										$this->Cell(40,5,'',1,0,'C');
										$this->Ln(5);
										$this->Cell(10,5,'',1,0,'C');											
										$this->Cell(50,5,'',1,0,'C');		
										$this->Cell(30,5,'',1,0,'C');											
										$this->Cell(30,5,'',1,0,'C');
										$this->Cell(30,5,'',1,0,'C');
										$this->Cell(40,5,'',1,0,'C');
										$this->Ln(5);
										$this->Cell(10,5,'',1,0,'C');											
										$this->Cell(50,5,'',1,0,'C');		
										$this->Cell(30,5,'',1,0,'C');											
										$this->Cell(30,5,'',1,0,'C');
										$this->Cell(30,5,'',1,0,'C');
										$this->Cell(40,5,'',1,0,'C');
										$this->Ln(5);
										$this->Cell(10,5,'',1,0,'C');											
										$this->Cell(50,5,'',1,0,'C');		
										$this->Cell(30,5,'',1,0,'C');											
										$this->Cell(30,5,'',1,0,'C');
										$this->Cell(30,5,'',1,0,'C');
										$this->Cell(40,5,'',1,0,'C');
										$this->Ln(5);
										$this->Cell(10,5,'',1,0,'C');											
										$this->Cell(50,5,'',1,0,'C');		
										$this->Cell(30,5,'',1,0,'C');											
										$this->Cell(30,5,'',1,0,'C');
										$this->Cell(30,5,'',1,0,'C');
										$this->Cell(40,5,'',1,0,'C');
										$this->Ln(5);										
										$this->SetX(40); 							
										$this->SetTextColor(255,0,0);
										$this->SetFillColor(255,247,0);
										$this->SetDrawColor(255,247,0);																															

										$this->Cell(90,5,'Total Acumulado Extras',1,0,'C');		
										$this->Cell(30,5,'',1,0,'C');			
							 $this->SetX(40); 			
							 $this->SetTextColor(0,0,0);
										$this->SetFillColor(0,247,0);
										$this->SetDrawColor(0,247,0);		
										$this->Ln(5);							 						  
										$this->Cell(90,7,'Total General',1,0,'C');		
										$this->Cell(30,7,'$ '.money_format('%i', $totalGeneral),1,0,'C');	
										$this->Ln(15);	
										$this->Cell(90,7,'Total General + Extras',1,0,'C');		
										$this->Cell(30,7,'',1,0,'C');	
										$this->Ln(15);																
											
											

						   				

						   		$this->SetFont('Arial','B',10);

						// Cliente

						$this->SetTextColor(0,0,0);

						$this->Cell(100, 0,utf8_decode("PAGO RECIBIDO A ENTERA SATISFACCIÓN."), 2, 2, 'C');	

						$this->Ln(15);	

						   $this->SetFont('Arial','B',7);

						   $this->SetFillColor(255,0,0);

							$this->SetDrawColor(255,0,0);

						$this->SetTextColor(0,0,255);

						$this->SetX(110);  

						$this->Cell(40,5,'FECHA: ',1,0,'L');

						$this->Cell(50,5,'',1,0,'L');

						$this->Ln(5);$this->SetX(110); 						

						$this->Cell(40,5,'NOMBRE DE RESPONSABLE: ',1,0,'L');

						$this->Cell(50,5,'',1,0,'L');

						$this->Ln(5);$this->SetX(110); 

						$this->Cell(40,8,'FIRMA: ',1,0,'L');

						$this->Cell(50,8,'',1,0,'L');

							$this->SetTextColor(0,0,0);

							$this->SetFont('Arial','B',10);

							$this->SetTextColor(0,0,0);



							

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

/*function total_comensales($n,$fac)

{



	$congral=mysql_query("select count(*) as total from contrato where Numero like '".$n."-%'");

	$gral=mysql_fetch_array($congral);



	if($gral['total']>0){//////////////es un contrato gral

		if($fac=='si'){

			$q='select * from cargofac where numcontrato like "'.$n.'%" and tipo="Comensales"';

		}else{

			$q='select * from cargo where numcontrato like "'.$n.'%" and tipo="Comensales"';

		}

	}else{//////es un contrato normal o subcontrato

		if($fac=='si'){

			$q='select * from cargofac where numcontrato="'.$n.'" and tipo="Comensales"';

		}else{

			$q='select * from cargo where numcontrato="'.$n.'" and tipo="Comensales"';

		}

	}

	

	$r=mysql_query($q);

	$cantidades;

	while($m=mysql_fetch_array($r)){

		$arreglo=explode(' ',$m['concepto']);

		$cantidades[0]=$cantidades[0]+$arreglo[4];

		$cantidades[1]=$cantidades[1]+$arreglo[15];

		$cantidades[2]=$cantidades[2]+$arreglo[26];

	}

	

	return $cantidades;

}*/

?>

