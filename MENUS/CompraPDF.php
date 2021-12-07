<?php
session_start();
include "../FormularioPDF/fpdf/fpdf.php";
require '../funciones2.php';
conectar();

date_default_timezone_set('utf-8');
class MiPDF extends FPDF
{
	
	
		public function Header()
		{
				$this->Image('../Imagenes/Villa Conin.png' , 160 ,12, 45 , 48,'PNG', '');

						$q2="SELECT * from contrato where Numero='".$_GET['Numero']."'";
						$r2=mysql_query($q2);
						if(mysql_num_rows($r2)>0)
						{$muestra2=mysql_fetch_array($r2);}
						else
						{
						 $q3="SELECT * from Eventos_Adicionales where Numero='".$_GET['numero']."'";	
							$q33=mysql_query($q3);
							$muestra2=mysql_fetch_array($q33);
						}
												
						   $NumeroContrato=$muestra2['Numero'];						   
						   $fechaactual= getdate('Y-M-D');
						   $salon=$muestra2['salon'];
						   $Tipo=$muestra2['tipo'];
						   $fechaevento=$muestra2['Fecha'];
						   $adultos=$muestra2['c_adultos'];
						   $jovenes=$muestra2['c_jovenes'];
						   $ninos=$muestra2['c_ninos'];
							//$Comensales=total_comensales($NumeroContrato,$muestra2['facturado'])+$Comensales;							
						   $extras=total_comensales($NumeroContrato,$muestra2['facturado']);
						   $Comensales=$adultos+$jovenes+$ninos+$extras[0]+$extras[1]+$extras[2];
						   $Meser=$muestra2['Meseros'];																				

						   $Meseros=explode(",", $Meser);
						// Logo
						// Arial bold 	15
						$this->Ln(5);
					   						
						$this->SetFont('Arial','B',16);$this->SetTextColor(0,0,0);
						// Cliente
						$this->Cell(0, 5 ,"Eventos Sociales Villa Conin S.A. de C.V.", 2, 2, 'C');					
						$this->SetFont('Arial','B',10);
						$this->Cell(70,13,"ORDEN DE COMPRA CONTRATO: ".$_GET['Numero'], 2, 2, 'L');
						$this->Cell(70, 0 , "CONTRATO No. ".$NumeroContrato, 2, 2, 'L'); 
						$this->Cell(70,7,"CANTIDAD DE COMENSALES: ".$Comensales,0,2,'L');	
						$this->Cell(70,0,"SALON: ".$salon,0,2,'L');
						$this->Cell(70,7,"TIPO DE EVENTO: ".utf8_decode($Tipo),0,1,'L');
						$this->Cell(70,0,"FECHA DE EVENTO: ".$fechaevento,0,1,'L');										
						/*$this->Cell(145,0,"( ".fecha_es($fechaevento)." )",0,1,'R');	*/
									
						$this->Cell(70,7,"SEMANA : # ".date(W),0,1,'L');
												$this->Ln(10);						
			}
			
			function pagina1()
			{ 
			
			$this->SetFont('Arial','B',16);$this->SetTextColor(0,0,0);
						// Cliente
						$this->Cell(0, 5 ,"LISTA DE PLATILLOS", 2, 2, 'C');		$this->Ln(10);
						$this->SetFont('Arial','B',10);
				$ORDEN=OrdenaMeseros();
				$q2="SELECT * from contrato where Numero='".$_GET['numero']."'";
						$r2=mysql_query($q2);
						if(mysql_num_rows($r2)>0)
						{$muestra2=mysql_fetch_array($r2);}
						else
						{
						 $q3="SELECT * from Eventos_Adicionales where Numero='".$_GET['numero']."'";	
							$q33=mysql_query($q3);
							$muestra2=mysql_fetch_array($q33);
						}
																		 							
							$pm=mysql_query("SELECT * FROM Proyeccion_menu WHERE Contrato='".$_GET['Numero']."' ");
							$ingredientes='';$ingre2='';									
							while ($pr=mysql_fetch_array($pm)) 
							{
								$in=explode(",",$pr['ingredientes']);
								$tot=explode(",",$pr['total']);
								$alto=(count($in)*2)+(count($in)/4);
						

							$this->SetDrawColor(255,0,0);	
							$this->SetFillColor(66, 5, 3);
										$this->Cell(40,5,'PLATILLO',1,0,'C');
										$this->Cell(60,5,'% UNITARIO',1,0,'C');
										$this->Cell(50,5,'TOTAL DE COMPRA',1,0,'C');
										$this->Ln(5.5);
								//$this->SetFillColor(153,255,100); 										
				
							$this->SetDrawColor(2,0,0);									
								$me=mysql_fetch_array(mysql_query("SELECT * FROM Menus WHERE id_menu=".$pr['menu']));
								$this->MultiCell(40,($alto+1),$me['nombre']."\nComensales :".$pr['comensales'],1,20);
								//$this->MultiCell(40, float h, string txt [, mixed border [, string align [, boolean fill]]])
								$this->Ln(-($alto*2)-2);
								$this->SetX(50);
								
								for ($i=1; $i <count($in) ; $i++) 
								{ $this->SetX(50);
										$iin=mysql_fetch_array(mysql_query("SELECT * FROM ingredientes WHERE id=".$in[$i] ));
										$contador++;
										$this->Cell(60,5,utf8_decode($iin['nombre']),1,0,'C');
										$this->Cell(50,5,$tot[$i]."   ".$iin['unidad'],1,0,'C');
										$this->Ln(5);															

										
								}
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
