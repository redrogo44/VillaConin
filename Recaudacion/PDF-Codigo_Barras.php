<?php
ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", dirname(__FILE__)."/error_log.txt");
error_reporting(E_All);
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
		}
			function pagina1()
			{ $inc=10;$ii=1;
				$pr=mysql_query("SELECT * FROM `productos_tiendita`");
				while($pro=mysql_fetch_array($pr))
				{
					$this->SetFont('Arial','B',10);
					$this->SetTextColor(0,0,0);
					$this->Cell(40,5,$pro['nombre']." ".$pro['descripcion'],0,0,'L');
					$this->Ln(5);											
					$this->Cell(40,5,"( Codigo: ".$pro['codigo'].")",0,0,'L');								
					$this->Image('Codigos2/Modulos/principal/'.$pro["codigo"].'.gif',90,$inc,80,10);						
					$inc=$inc+35;				
					$this->ln(30);
					if ($ii==8||$ii==16||$ii==24||$ii==32||$ii==40||$ii==48||$ii==56||$ii==64||$ii==72||$ii==80||$ii==88||$ii==96||$ii==104||$ii==112||$ii==120||$ii==128||$ii==136) 					
					{
						$inc=10;
					}
					$ii++;
				}
				
			}
		function pagina2()
			{										
				
				$ii=1;
				$prr=mysql_query("SELECT * FROM subcategoria WHERE id_categoria=1");			
				while($pro=mysql_fetch_array($prr))				
				{		$inc2=20;
					
					$spr=mysql_query("SELECT * FROM producto WHERE id_subcategoria=".$pro['id_subcategoria']);				
					$this->SetFont('Arial','B',15);
						$this->SetTextColor(0,0,100);
					$this->Cell(100,5,$pro['nombre'],0,0,'C');
					$this->Ln(20);
					while($sub=mysql_fetch_array($spr))
					{			
					//echo "<br>".$sub['codigo'];
						//$pro=mysql_fetch_array($prr);
						$this->SetFont('Arial','B',10);
						$this->SetTextColor(08,50,20);
						$this->Cell(40,5,utf8_decode($sub['nombre'])." ".utf8_decode($sub['descripcion']),0,0,'L');
						$this->Ln(5);											
						$this->Cell(40,5,"( Codigo: ".$sub['codigo'].")",0,0,'L');	
						$this->Image('Codigos2/Modulos/principal/'.$sub["codigo"].'.gif',100,$inc2,70,30);						
						$inc2=$inc2+35;				
						$this->Ln(30);					
						if($inc2>=250)
						{
							$inc2=20;
					$this->addPage();
						$this->Ln(30);					
						
						}
					}
					$this->addPage();
					$inc2=0;
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
