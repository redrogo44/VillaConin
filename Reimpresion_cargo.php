<?php
include "FormularioPDF/fpdf/fpdf.php";
require 'funciones2.php'; 
conectar();
session_start();
$_SESSION['tipo']="comensales";
date_default_timezone_set('utf-8');
header('Content-Type: text/html; charset=utf-8;');
class MiPDF extends FPDF
{
	

	
	public function Header()
	{
		$esfacturado="no";

		
			if($esfacturado=='si'||$esfacturado=='SI')
			{
					// Tabla Cargos
					$q="select max(id)'n' from cargofac";
					$r=mysql_query($q);
					while($muestra=mysql_fetch_array($r))
					{
						$numax=$muestra['n'];
					}
					
					$q2="select * from cargofac where id=1014";
					$r2=mysql_query($q2);
					while($muestra2=mysql_fetch_array($r2))
					{
						$folio=$muestra2['id'];
						$fecha=$muestra2['fecha'];
						 $NumeroContrato=$muestra2['numcontrato'];
					   	$total=$muestra2['cantidad'];
				   		$concepto= $muestra2['concepto'];
					}
					
					// Tabla Contrato
					if(strlen($NumeroContrato)>8)
					{
						 $q3="select * from subcontratos where numero='".$NumeroContrato."'";
					}
					else
					{
							$q3="select * from contrato where Numero='".$NumeroContrato."'";
					}
					
					$r3=mysql_query($q3);
					while($muestra31=mysql_fetch_array($r3))
					{
						 $idcliente=$muestra31['id_cliente'];
						 $fechaevento=$muestra31['Fecha'];
						 $nombresub=$muestra31['nombre'];
					}
					// Tabla Cliente
					
					$q3="select * from cliente where id=".$idcliente;
					$r3=mysql_query($q3);
					while($muestra3=mysql_fetch_array($r3))
					{
						$nomcli=$muestra3['nombre'];
						$ap=$muestra3['ap'];
						$am=$muestra3['am'];
						$domicilio=$muestra3['dom'];
						$tel=$muestra3['tel'];
						$rfc=$muestra3['rfc'];									
					}
						if(strlen($NumeroContrato)>8)
						{
						$cliente=$nombresub;
						}
						
						else
						{
							$cliente=$nomcli." ".$ap." ".$am;
						}
						
						
						
						$q_recupera = "SELECT concepto FROM cargofac where id='".$numax."'";
					$recupera = mysql_query($q_recupera) or die (mysql_error());
					$cno=mysql_fetch_array($recupera);
					 $servicios=$cno['concepto'];
					
					$arrayservicios = explode(",", $servicios);	
							
			}
			else
			{
				// Tabla Cargos
					$q="select max(id)'n' from cargo";
					$r=mysql_query($q);
					while($muestra=mysql_fetch_array($r)){
						$numax=$muestra['n'];
						}
					
					$q2="select * from cargo where id=1014";
					$r2=mysql_query($q2);
					while($muestra2=mysql_fetch_array($r2)){
						$folio=$muestra2['id'];
						$fecha=$muestra2['fecha'];
						$NumeroContrato=$muestra2['numcontrato'];
				   $total=$muestra2['cantidad'];
				   $concepto= $muestra2['concepto'];
					}
					
					
					
					// Tabla Contrato
					if(strlen($NumeroContrato)>8)
					{
					$q3="select * from subcontratos where numero='".$NumeroContrato."'";
					}
					else
					{
							$q3="select * from contrato where Numero='".$NumeroContrato."'";
					}
							$r3=mysql_query($q3);
							while($muestra31=mysql_fetch_array($r3))
							{
								 $idcliente=$muestra31['id_cliente'];
								 $fechaevento=$muestra31['Fecha'];
								 $nombresub=$muestra31['nombre'];
							}
					
					// Tabla Cliente
					
					$q3="select * from cliente where id=".$idcliente;
					$r3=mysql_query($q3);
					while($muestra3=mysql_fetch_array($r3))
					{
						$nomcli=$muestra3['nombre'];
							$ap=$muestra3['ap'];
							$am=$muestra3['am'];
							$domicilio=$muestra3['dom'];
							$tel=$muestra3['tel'];
							$rfc=$muestra3['rfc'];									
						
					}
					if(strlen($NumeroContrato)>8)
						{
						$cliente=$nombresub;
						}
						
						else
						{
							$cliente=$nomcli." ".$ap." ".$am;
						}
						
					$q_recupera = "SELECT concepto FROM cargo where id=1014";
					$recupera = mysql_query($q_recupera) or die (mysql_error());
					$cno=mysql_fetch_array($recupera);
					 $servicios=$cno['concepto'];
					
					$arrayservicios = explode(",", $servicios);	
			}
		
			

					
					
			 //$this->Ln(5);
			 $this->SetFont('Arial','B',15);
			
			//  Variables
			
			$this->Ln(4);
			
			// Imagenes
			$this->Image('Imagenes/villaconin2.png',5,5,200,90);
			$this->Image('Imagenes/villaconin2.png',5,95,200,90);
			$this->Image('Imagenes/villaconin2.png',5,186,200,90);
			
			// Impresiones  Not< de Cargo 1
			$this->SetFont('Arial','B',9);
			$this->Cell(350, 20 , $folio, 100, 100, 'C');
			$this->Cell(355, -12 , $fecha, 2, 2, 'C');
			$this->SetXY( 0, 40); // establece las posición actual x e y
			$this->Cell(170, -7, $cliente, 2, 2, 'C');
			$this->SetXY( 0, 40); // establece las posición actual x e y
			$this->Cell(320, -7 , $NumeroContrato, 100, 100, 'C');
			$this->SetXY( 0, 0); // establece las posición actual x e y
	$this->SetXY( 0, 50); // establece las posición actual x e y
				if($_SESSION['tipo']=="servicio")
				{
					for($i=0;$i<count($arrayservicios)-1;$i++)
					{
                        $this->Cell(20,1,' ',0,1,'C');
						//$this->Cell(80,0,$arrayservicios[$i],100,100,'C');
						$this->SetFont('Arial','B',6);
                        if($_SESSION["Des".$i]!=''){
                            $this->Cell(140,0,$_SESSION["Des".$i],100,100,'C'); 
                            $this->SetFont('Arial','B',9);
                            $this->Cell(300,0,"$ ".money_format('%i', $_SESSION["Pre".$i]),100,100,'C');
                        }				
						$this->Ln(3);
					}
				}
				if ($_SESSION['tipo']=="comensales")
				{
					for($i=0;$i<count($arrayservicios)-1;$i++)
					{	
						$this->Cell(180,0,utf8_decode($arrayservicios[$i]),100,100,'C');
						$this->Ln(3);
					}
				}
				
						
			
			$this->SetXY( 10, 69.5); // establece las posición actual x e y
			$this->SetTextColor(0,0,200); // establece el color del texto
			$this->SetFont('Arial','B',7);
			$this->Cell(80, 6 , "$ ".$total, 100, 100, 'C');
			$this->SetFont('Arial','B',7);		
			$this->Cell(255,-7,numtoletras($total),0,1,'C');
			$this->SetFont('Arial','B',9);
            $this->SetTextColor(0,0,0); // establece el color del texto
            $this->Cell(180,16,"CLIENTE",0,1,'C');
			
			// Nota de Cargo 2 , 
					$this->SetTextColor(0,0,0); // establece el color del texto
			$this->SetXY( 0, 62); // establece las posición actual x e y
			$this->Cell(365, 103 , $folio, 100, 100, 'C');
			$this->Cell(365, -94	 , $fecha, 2, 2, 'C');
			$this->SetXY( 0, 79); // establece las posición actual x e y
			$this->Cell(170, 95 , $cliente, 2, 2, 'C');
			$this->SetXY( 0, 136); // establece las posición actual x e y
			$this->Cell(320, -20 , $NumeroContrato, 100, 100, 'C');
			$this->SetFont('Arial','B',9);
			$this->SetXY( 10, 140); // establece las posición actual x e y
			if($_SESSION['tipo']=="servicio")
				{
					for($i=0;$i<count($arrayservicios)-1;$i++)
					{
						//$this->Cell(80,0,$arrayservicios[$i],100,100,'C');
						$this->SetFont('Arial','B',6);
						$this->Cell(140,0,$_SESSION["Des".$i],100,100,'C');
						$this->SetFont('Arial','B',9);
						$this->Cell(300,0,"$ ".money_format('%i', $_SESSION["Pre".$i]),100,100,'C');				
						$this->Ln(3);
					}
				}
				if ($_SESSION['tipo']=="comensales")
				{
					for($i=0;$i<count($arrayservicios)-1;$i++)
					{	
						$this->Cell(180,0,utf8_decode($arrayservicios[$i]),100,100,'C');
						$this->Ln(3);
					}
				}
			$this->SetFont('Arial','B',7);
			$this->SetXY( 10, 164.5); // establece las posición actual x e y
			$this->SetTextColor(0,0,200); // establece el color del texto
			$this->Cell(80, -3 , "$ ".$total, 100, 100, 'C');
			$this->SetFont('Arial','B',7);
			$this->Cell(255,2,numtoletras($total),0,1,'C');	
			$this->SetFont('Arial','B',9);
            $this->SetTextColor(0,0,0); // establece el color del texto
            $this->Cell(180,7,"EXPEDIENTE",0,1,'C');	

			// Nota de Cargo 3 ,
			$this->SetTextColor(0,0,0); // establece el color del texto
			$this->SetXY( 10, 153); // establece las posición actual x e y
			$this->Cell(350, 103 , $folio, 100, 100, 'C');
			$this->Cell(355, -93 , $fecha, 2, 2, 'C');
			$this->SetXY( 10, 176); // establece las posición actual x e y
			$this->Cell(160, 80 , $cliente, 2, 2, 'C');
			$this->Cell(300, -80 , $NumeroContrato, 100, 100, 'C');
		
			$this->SetFont('Arial','B',9);
			$this->Ln(-49);
			$this->SetXY( 10, 230); // establece las posición actual x e y
			if($_SESSION['tipo']=="servicio")
				{
					for($i=0;$i<count($arrayservicios)-1;$i++)
					{
					//	$this->Cell(80,0,$arrayservicios[$i],100,100,'C');
						$this->SetFont('Arial','B',6);
						$this->Cell(140,0,$_SESSION["Des".$i],100,100,'C');
						$this->SetFont('Arial','B',9);
						$this->Cell(300,0,"$ ".money_format('%i', $_SESSION["Pre".$i]),100,100,'C');				
						$this->Ln(3);
					}
				}
				if ($_SESSION['tipo']=="comensales")
				{
					for($i=0;$i<count($arrayservicios)-1;$i++)
					{	
						$this->Cell(180,0,utf8_decode($arrayservicios[$i]),100,100,'C');
						$this->Ln(3);
					}
				}
			$this->SetFont('Arial','B',7);
			$this->SetXY( 10, 164); // establece las posición actual x e y
			$this->SetTextColor(0,0,200); // establece el color del texto
			$this->Cell(80, 180 , "$ ".$total, 100, 100, 'C');
			$this->SetFont('Arial','B',7);
			$this->Cell(255,-180,numtoletras($total),0,1,'C');
			$this->SetFont('Arial','B',9);
            $this->SetTextColor(0,0,0); // establece el color del texto
            $this->Ln(86);
            $this->Cell(180,16,"CONSECUTIVO",0,1,'C');
		}
		
	function Footer()
	{
	
		
	}
	


}

$pdf = new MiPDF('P','mm','letter');	
$pdf->addPage();
$pdf->Output();
	




?>
