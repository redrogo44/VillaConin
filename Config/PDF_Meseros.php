<?php
include 'FormularioPDF/fpdf/fpdf.php';
session_start();  
date_default_timezone_set('utf-8');

class MiPDF extends FPDF{
	
	
	public function Header(){
		$con = mysql_connect("localhost","sistem68_mbr","qrodigo44");
	if(!$con){
	die('no hay conexion al servidor');
	
	
}

$base = mysql_select_db('sistem68_mbrsoluc_villaconin2');
if(!$base){
	die('no se pudo conectar a la bd');
}
else{
	
	print_r($_POST);
	
//print_r($_SESSION);
  $select="SELECT * FROM contrato where Numero='".$_SESSION['numerolog']."'";
	$conec=mysql_query($select) or die (mysql_error());
					while($des=mysql_fetch_array($conec))
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
						 $manteleria=$des['mantel'];
					$serviciosA=$des['ServiciosAdicionales'];
					}
					$Tinvitados=$cadul+$cjov+$cnin;
	
	
}
$fecha=date("d-m-Y");

//print_r($_REQUEST); 
//echo $_post["hora1"];
// Imagenes
//$this->Image('Imagenes/formatologistica.png',5,0,200,290);
$this->SetFont('Arial','B',10);

 $this->Cell(140,35,$fechacontrato,2,2,'C');
 $this->Cell(140,-25,$numero,2,2,'C');
 $this->Cell(330,15,$tipo,2,2,'C');
 $this->Cell(140,6,$Tinvitados,2,2,'C');
 $this->Cell(140,5,$salon,2,2,'C');
 $this->SetFont('Arial','B',8);
 $this->Cell(335,-27,$_SESSION['FESTEJADOS'],2,2,'C');
 $this->Cell(335,38,$nombre,2,2,'C');
 $this->SetFont('Arial','B',10);
 $this->Cell(330,-26,$vendedor,2,2,'C');

 // HORARIOS Y ACTIVIDADES
 
 /// VARIABLES DE SESION

//
 
 
 
 // ACTIVIDADES
 $this->SetXY( 10, 68); // establece las posición actual x e y
$this->SetTextColor(0,0,200); // establece el color del texto
					
 for($i=1;$i<=$_SESSION['actividades'];$i++)
 {
	$this->SetFont('Arial','B',10);
    $this->Cell(218,0,$_SESSION["hora".$i.""],2,2,'C');
    $this->Cell(258,0,$_SESSION["fin".$i.""],2,2,'C');
  	$this->SetFont('Arial','B',6);
	$this->Cell(335, 0 ,$_SESSION["actividad".$i.""], 2, 3,'C');
	$this->Ln(3);
 }
 

// MENU

$this->SetXY( 112, 152); // establece las posición actual x e y
$this->SetTextColor(250,16,0); // establece el color del texto
			
	$this->MultiCell(0, 3 ,$_SESSION['menu']);

// mMENU NIÑOS
$this->SetXY( 115, 189); // establece las posición actual x e y
$this->SetTextColor(250,16,0); // establece el color del texto

	$this->MultiCell(0, 3 ,$_SESSION['ninos']);
	

// MANTELERIA 
$this->SetFont('Arial','B',14);
$this->SetXY( 10, 227); // establece las posición actual x e y
$this->SetTextColor(3,9,7); // establece el color del texto
	 $q22="select * from TManteleria where id=".$manteleria;//$descr[$k];
	$se=mysql_query($q22) or die (mysql_error());
	$es=mysql_fetch_array($se);
	$this->Cell(285, 5 , $es['descripcion'], 2, 2, 'C');											
	
	///////////////////////7

// SERVICIOS ADICIONALES
$this->SetFont('Arial','B',8);
$this->SetXY( 15, 220); // establece las posición actual x e y
$this->SetTextColor(3,9,7); // establece el color del texto

$menu = explode(",",$serviciosA);
	for($i=0;$i<count($menu)-1;$i++)
	{
		
			$sera="Select Servicio From Servicios Where id =".$menu[$i]."";
			$re = mysql_query($sera) or die (mysql_error());
			$cno=mysql_fetch_array($re);
						
		$this->Cell(90, 4 ,$cno['Servicio'], 3, 3,'C');
	}
	
	/// EN BLANCO

$this->SetFont('Arial','B',14);
$this->SetXY( 110, 260); // establece las posición actual x e y
$this->SetTextColor(30,30,100); // establece el color del texto
$this->Cell(0, 3 ,"		", 3, 3,'C');

////////////77


////////////////////////////////


//  SERVICIOS

        $q_recupera = "SELECT servicios FROM contrato where Numero='".$numero."'";
					$recupera = mysql_query($q_recupera) or die (mysql_error());
					$cno=mysql_fetch_array($recupera);
					 $servicios=$cno['servicios'];
					
					$arrayservicios = explode(",", $servicios);					
									
$this->SetXY( 5, 60); // establece las posición actual x e y
$this->SetTextColor(26,0,225); // establece el color del texto

				for($i=0;$i<count($arrayservicios)-1;$i++)
				{
					$q2="select * from Servicios where id=".$arrayservicios[$i];
						$serv=mysql_query($q2) or die (mysql_error());
		
							while($des=mysql_fetch_array($serv))
							{
								if($des['tipo']=='RECEPCION')
								{
									$this->SetTextColor(239,0,225); // establece el color del 
									$this->Cell(0, 3 ,'RECEPCION : ', 3, 3,'L');	
								}
								if($des['tipo']=='ALIMENTOS')
								{$this->SetTextColor(239,0,225); // establece el color 
									$this->Cell(0, 3 ,'ALIMENTOS : ', 3, 3,'L');	
								}
								if($des['tipo']=='BEBIDAS')
								{$this->SetTextColor(239,0,225); // establece el color 
									$this->Cell(0, 3 ,'BEBIDAS : ', 3, 3,'L');	
								}
								if($des['tipo']=='ENTRETENIMIENTO Y SHOW')
								{$this->SetTextColor(239,0,225); // establece el color 
									$this->Cell(0, 3 ,'ENTRETENIMIENTO Y SHOW : ', 3, 3,'L');	
								}
								if($des['tipo']=='MOBILIARIO Y EQUIPO')
								{$this->SetTextColor(239,0,225); // establece el color 
									$this->Cell(0, 3 ,'MOBILIARIO Y EQUIPO : ', 3, 3,'L');	
								}
								if($des['tipo']=='PLUS')
								{$this->SetTextColor(239,0,225); // establece el color 
									$this->Cell(0, 3 ,'PLUS : ', 3, 3,'L');	
								}
								if($des['tipo']=='PERSONAL')
								{$this->SetTextColor(239,0,225); // establece el color 
									$this->Cell(0, 3 ,'PERSONAL : ', 3, 3,'L');	
								}
								if($des['tipo']=='RENTA DE INSTALACIONES')
								{$this->SetTextColor(239,0,225); // establece el color 
									$this->Cell(0, 3 ,'RENTA DE INSTALACIONES : ', 3, 3,'L');	
								}
							
								$this->SetTextColor(26,0,225); // establece el color del texto
								$this->Cell(0, 3 ,$des['Servicio'], 3, 3,'L');
								
							}
				}
				
				//////////////////// OBSERVACIONES
				
				/// OBSERVACIONES
$this->SetFont('Arial','B',8);
$this->SetXY( 0, 56); // establece las posición actual x e y
$this->SetTextColor(255,128,0); // establece el color del texto
echo $_SESSION['observaciones'];
	$this->MultiCell(90, 3 ,$_SESSION['observaciones']);
}
	

	function Footer()
	{

	}
	

}


$pdf = new MiPDF();	
$pdf->addPage();
$pdf->Output();
	
?>

