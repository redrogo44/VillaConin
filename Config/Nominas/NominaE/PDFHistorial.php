<?php
require('fpdf/fpdf.php');
require('../../configuraciones.php');
//require('funciones.php');
conectar();
session_start();
//error_reporting(0);
header('Content-Type: text/html; charset=utf-8;');

class PDF extends FPDF
{
	function Header()
	{
		$this->Image('../../../Imagenes/Villa Conin.png' , 230 ,0, 45 , 48,'PNG', '');
	
		
		$this->Ln(20);
		}
	function Footer()
	{
		$this->SetFont('Arial','B',7);
		$this->SetY(160); 
		$this->SetX(190); 
					$this->Cell(40,5,'FECHA: ',1,0,'L');
						$this->Cell(50,5,'',1,0,'L');
						$this->Ln(5);$this->SetX(190); 						
						$this->Cell(40,5,'NOMBRE DE RESPONSABLE: ',1,0,'L');
						$this->Cell(50,5,'',1,0,'L');
						$this->Ln(5);$this->SetX(190); 
						$this->Cell(40,8,'FIRMA: ',1,0,'L');
						$this->Cell(50,8,'',1,0,'L');	 
	}
	function cuerpo()
	{
		$fecha=mysql_fetch_array(mysql_query("SELECT * FROM Configuraciones WHERE id=3"));
		$e=mysql_fetch_array(mysql_query("SELECT * FROM Empleados where id=".$_GET['id']));
		$this->SetFont('Arial','B',14);
		$this->Cell(160,5,'HISTORIAL DE NOMINA DEL EMPLEADO: '.$e['nombre']." ".$e['apellidos'],0,1,'C');
		$this->SetFont('Arial','B',10);


		//	NOMINAS CONSTRUCCION
	$this->Ln(15);
		$nomCons=mysql_query("SELECT * FROM `Confirmacion_Nomina_Construccion` WHERE `fecha`>='".$fecha['descripcion']."' AND `confirmado`= 'si' ");
				$TotalCons=0;
				while($c=mysql_fetch_array($nomCons))
				{

					$Construccion= explode(",", $c['nombres']);
					$TotalCons=explode(",", $c['Total_nomina'] );
					$puntos=explode(",", $c['puntos']);
					for ($i=1; $i <count($Construccion) ; $i++) 
					{	
						$Const=explode("-", $Construccion[$i]);			
						if($Const[1]==$_GET['id'])
						{							
							$this->Cell(60,5,'SEMANA: '.Semana($c['fecha'])." Nomina Construccion: ",0,0,'C');
							if($puntos[$i]!=0&&$puntos[$i]!='')									
							{
								$this->Cell(60,5,'Pagado: '.money_format("%i",$TotalCons[$i]),0,0,'C');
								$this->Cell(60,5,'Puntos: '.$puntos[$i],0,0,'C');	
							}	
							else {
								$this->Cell(60,5,'Pagado: $ '.money_format("%i",0),0,0,'C');
								$this->Cell(60,5,'Puntos: 0',0,0,'C');				
								}				
							$this->Ln(5);
						}
					}
				}
				$this->Ln(15);
						// 	NOMINAS EVENTOS
		// 	
			$nomEve=mysql_query("SELECT * FROM `Confirmacion_Nomina_Eventos` WHERE `fecha`>= '".$fecha['descripcion']."' AND `confirmado`= 'si'");
				$TotalEvento=0;
				while($e=mysql_fetch_array($nomEve))
				{
					$Eventos= explode(",", $e['nombres']);
					$TotalEvento=explode(",", $e['totales']);
					for ($i=1; $i <count($Eventos) ; $i++) 
					{	$puntos=explode(",", $e['puntos']);
						$Eve=explode("-", $Eventos[$i]);			
						if($Eve[1]==$_GET['id'])
						{	
							$this->Cell(60,5,'SEMANA: '.Semana($e['fecha'])." Nomina Eventos: ",0,0,'C');
							if($puntos[$i]!=0&&$puntos[$i]!='')									
							{
								$this->Cell(60,5,'Pagado: $ '.money_format("%i",$TotalEvento[$i]),0,0,'C');
								$this->Cell(60,5,'Puntos: '.$puntos[$i],0,0,'C');	
							}	
							else {
								$this->Cell(60,5,'Pagado:$ '.money_format("%i",0),0,0,'C');
								$this->Cell(60,5,'Puntos: 0',0,0,'C');				
								}				
						$this->Ln(5);
											
						}
					}

				}	
				
				$this->Ln(15);

				//	NOMINA EXTRAS
			//	
				$nomEx=mysql_query("SELECT * FROM `Confirmacion_Nomina_Extras` WHERE `fecha`>='".$fecha['descripcion']."' AND `confirmado`='si' ");
				$TotalExt=0;

				while($ne=mysql_fetch_array($nomEx))
				{
					$TotalExt=explode(",", $ne['totales']);
					$Extras= explode(",", $ne['nombres']);
					for ($i=1; $i <count($Extras) ; $i++) 
					{	$puntos=explode(",", $ne['puntos']);
						$Ext=explode("-", $Extras[$i]);			
						if($Ext[1]==$_GET['id'])
						{	
							$this->Cell(60,5,'SEMANA: '.Semana($ne['fecha'])." Nomina Extras: ",0,0,'C');
							if($puntos[$i]!=0&&$puntos[$i]!='')									
							{
								$this->Cell(60,5,'Pagado: $ '.money_format("%i",$TotalExt[$i]),0,0,'C');
								$this->Cell(60,5,'Puntos: '.$puntos[$i],0,0,'C');	
							}	
							else {
								$this->Cell(60,5,'Pagado:$ '.money_format("%i",0),0,0,'C');
								$this->Cell(60,5,'Puntos: 0',0,0,'C');				
								}				
						$this->Ln(5);			
						}
					}
				}
				$this->Ln(15);
				
				//	NOMINA PLANTA

				$nomPla=mysql_query("SELECT * FROM `Confirmacion_Nomina_Planta` WHERE `fecha`>='".$fecha['descripcion']."' AND `confirmado`='si'");
					$TotalPla=0;

					while($pla=mysql_fetch_array($nomPla))
					{
						$TotalPla=explode(",",$pla['Total_nomina']);
						$Planta= explode(",", $pla['nombres']);
						for ($i=1; $i <count($Planta) ; $i++) 
						{	$puntos=explode(",", $pla['puntos']);
							$Plan=explode("-", $Planta[$i]);			
							if($Plan[1]==$_GET['id'])
							{	
								$this->Cell(60,5,'SEMANA: '.Semana($pla['fecha'])." Nomina Planta: ",0,0,'C');
									if($puntos[$i]!=0&&$puntos[$i]!='')									
									{
										$this->Cell(60,5,'Pagado: $ '.money_format("%i",$TotalPla[$i]),0,0,'C');
										$this->Cell(60,5,'Puntos: '.$puntos[$i],0,0,'C');	
									}	
									else {
										$this->Cell(60,5,'Pagado:$ '.money_format("%i",0),0,0,'C');
										$this->Cell(60,5,'Puntos: 0',0,0,'C');				
										}				
								$this->Ln(5);					
									}
								}
					}					
				$this->Ln(15);

					//	NOMINA COMISION
					//	
					//	
					$nomCo=mysql_query("SELECT * FROM `Cornfirmacion_Nomina_Comision` WHERE `fecha`='".$fecha['descripcion']."' AND `confirmado`='si'");
						$TotalCo=0;

						while($co=mysql_fetch_array($nomCo))
						{
							$TotalCo=explode(",", $co['neto']);
							$Comision= explode(",", $co['nombres']);
							for ($i=1; $i <count($Comision) ; $i++) 
							{	$puntos=explode(",", $co['puntos']);
								$Coo=explode("-", $Comision[$i]);			
								if($Coo[1]==$_GET['id'])
								{	
									 $this->Cell(60,5,'SEMANA: '.Semana($pla['fecha'])." Nomina Comision: ",0,0,'C');
									if($puntos[$i]!=0&&$puntos[$i]!='')									
									{
										$this->Cell(60,5,'Pagado: $ '.money_format("%i",$TotalCo[$i]),0,0,'C');
										$this->Cell(60,5,'Puntos: '.$puntos[$i],0,0,'C');	
									}	
									else {
										$this->Cell(60,5,'Pagado:$ '.money_format("%i",0),0,0,'C');
										$this->Cell(60,5,'Puntos: 0',0,0,'C');				
										}				
										$this->Ln(5);			
								}
							}
						}
						


					
	}
	
		
}
function Semana($fecha)
{
	//$fecha="2009-01-14" ; // fecha.
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
function fechas($s)
 {
		$semana=date($s);
			for($mes=1;$mes<12;$mes++){
				$limite = date('t',mktime(0,0,0,$mes,1,date('Y')));
				for($dia=1;$dia<$limite;$dia++){
					if(date('W',mktime(0, 0, 0, $mes  , $dia, date('Y'))) == $semana){
						if(date('N',mktime(0, 0, 0, $mes  , $dia, date('Y'))) == 1){
				$fecha= date('d',mktime(0, 0, 0, $mes  , $dia,date('Y'))).' al '.(date('d',mktime(0, 0, 0, $mes  , $dia+6, date('Y')))-1);
						}
					}
				}
			}
			
			switch (date('m'))
			{
			case 1:
					$mes=Enero;					
					break;
			case 2:
					$mes=Febrero;					
					break;
			case 3:
					$mes=Marzo;					
					break;
			case 4:
					$mes=Abril;					
					break;
			case 5:
					$mes=Mayo;					
					break;
			case 6:
					$mes=Junio;					
					break;
			case 7:
					$mes=Julio;					
					break;
			case 8:
					$mes=Agosto;					
					break;
			case 9:
					$mes=Septiembre;					
					break;
			case 10:
					$mes=Octubre;					
					break;
			case 11:
					$mes=Noviembre;					
					break;
			case 12:
					$mes=Diciembre;					
					break;		
			}
			$fecha=$fecha." ".$mes." de ".date('Y');
			return $fecha;
 }
	
$pdf= new  PDF('L','mm','A4');
//$pdf->AliasNbPages();
$pdf->Addpage();
//$pdf->SetAutoPageBreak(true,35); 
$pdf->SetFont('Arial','B',7);
$pdf->cuerpo();
$pdf->Output();	
?>