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
	if($_GET['tipo']!='construccion')
	{
		$this->Image('../../../Imagenes/Villa Conin.png' , 230 ,0, 45 , 48,'PNG', '');
	}
		
		$this->Ln(20);
		}
	function Footer()
	{
		$this->SetFont('Arial','B',7);
		$this->SetY(180); 
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

		 $this->SetFont('Arial','B',12);
		 if($_GET["tipo"]=="comision")
		 {
		 	$v="SELECT * FROM Cornfirmacion_Nomina_Comision WHERE id=".$_GET['id'];
		 	$n=mysql_query($v);		 	
		 	$no=mysql_fetch_array($n);
		 	$nombres=explode(',',$no['nombres']);
		 	$dias_trabajados=explode(",",$no['dias_trabajados']);
		 	$sueldos=explode(",",$no['sueldos']);
		 	$puntos=explode(",",$no['puntos']);
			$precioComensal=explode(",",$no['costos_comensal']);
			$comensales=explode(",",$no['comensales']);
			$comisiones=explode(",",$no['comisiones']);
			$bruto=explode(",",$no['bruto']);
			$descuentos=explode(",",$no['descuentos']);
			$neto=explode(",",$no['neto']);
			$contratos=explode(",",$no['contratos']);
			$factor=explode(",",$no['factores']);
			$sum_co=explode(",",$no['suma_comisiones']);
			$normal=explode(",",$no['normales']);
			$aplicada=explode(",",$no['aplicadas']);
		 	//echo "numero de empleados ".count($nombres)." ".$nombres[0];
			$this->Cell(80,0,"Eventos Sociales Villa Conin S.A. de C.V",0,0,'C');
			$this->Ln(15);
			$this->Cell(180,0,"FECHA ".$no['Texto'],0,0,'C');
			$this->Ln(5);
			$this->Cell(180,5,"SEMANA # ".Semana($no['fecha']),1,0,'C');
			$this->Ln(5);
			$this->Cell(30,5,"CONTRATOS",1,0,"C");
			$this->Cell(30,5,"Comensales",1,0,"C");
			// NOMBRES DE LA NOMINA
			for($i=1;$i<count($nombres);$i++)
			{
				$nom=explode("-", $nombres[$i]);
				$this->SetFont('Arial','B',5);
				$this->Cell(10,5,"Factor",1,0,"C");
				$this->SetFont('Arial','B',8);
				$this->Cell(30,5,$nom[0],1,0,"C");									
			}
			// DIAS TRABAJADOS Y SUELDOS
			$this->Ln(5);
			$this->Cell(60,5,"Dias Trabajados",1,0,"C");			
			for($i=1;$i<count($nombres);$i++)
			{
				$this->Cell(10,5,$dias_trabajados[$i],1,0,"C");
				$this->Cell(30,5,money_format("%i",$sueldos[$i]),1,0,"C");
			}
			$this->Ln(5);
			$this->Cell(60,5,"Puntos",1,0,"C");			
			for($i=1;$i<count($nombres);$i++)
			{
				$this->Cell(40,5,$puntos[$i],1,0,"C");			
			}
				$this->Cell(17,5,"NORMAL",1,0,"C");
				$this->Cell(17,5,"APLICADA",1,0,"C");

			//	CONTRATOS FACTORES Y COMISIONES
			$g=0;
			for ($i=1; $i <count($comensales) ; $i++) 
			{ 
				if($contratos[$i]!='')
				{
					$this->Ln(5);				
					$this->Cell(30,5,$contratos[$i],1,0,"C");
					$this->Cell(30,5,$comensales[$i],1,0,"C");
					$totalComensales=$comensales[$i]+$totalComensales;
					for ($j=1; $j <count($nombres) ; $j++) 
					{ 
						$this->Cell(10,5,$factor[($j+$g)],1,0,"C");									
						$this->Cell(30,5,money_format("%i",$comisiones[($j+$g)]),1,0,"C");									
					}
					$this->Cell(17,5,$normal[$i],1,0,"C");
					$this->Cell(17,5,$aplicada[$i],1,0,"C");

				}

				$g=$g+(count($nombres)-1);
			}
				$this->Ln(5);							
			$this->Cell(30,5,"TOTAL",1,0,"C");
			$this->Cell(30,5,$totalComensales,1,0,"C");																										
				$this->Ln(5);				
			$this->Cell(60,5,"COMISIONES",1,0,"C");																						
			for($i=1;$i<count($nombres);$i++)
			{
				$this->Cell(40,5,money_format("%i",$sum_co[$i]),1,0,"C");		
			}
				$this->Ln(5);													
			$this->Cell(60,5,"BRUTO",1,0,"C");	
			for($i=1;$i<count($nombres);$i++)
			{
				$this->Cell(40,5,money_format("%i",$bruto[$i]),1,0,"C");			
			}																									
				$this->Ln(5);							
			$this->Cell(60,5,"Otros Pagos o Descuentos",1,0,"C");
			for($i=1;$i<count($nombres);$i++)
			{
				$this->Cell(40,5,money_format("%i",$descuentos[$i]),1,0,"C");			
			}
				$this->Ln(5);							
			$this->Cell(60,5,"NETO",1,0,"C");
			for($i=1;$i<count($nombres);$i++)
			{
				$this->Cell(40,5,money_format("%i",$neto[$i]),1,0,"C");			
			}
				$this->SetFont('Arial','B',18);
				$this->Ln(5);							
				$this->Cell(60,15,"FIRMA",1,0,"C");
			for($i=1;$i<count($nombres);$i++)
			{
				$this->Cell(40,15,"",1,0,"C");			
			}		
		 }
		 if($_GET["tipo"]=="extras")
		{
			$no=mysql_query("SELECT * FROM Confirmacion_Nomina_Extras WHERE id=".$_GET['id']);
			$nom=mysql_fetch_array($no);
			$nombres=explode(",",$nom['nombres']);
			$costos=explode(",",$nom['costos']);
			$checks=explode(",",$nom['checks']);
			$he=explode(",",$nom['hora_entrada']);
			$hs=explode(",",$nom['hora_salida']);
			$totales=explode(",",$nom['totales']);
			$puntos=explode(",",$nom['puntos']);
			$fecha=$nom['fecha'];
			$ff=mysql_fetch_array(mysql_query("SELECT WEEK(  '".$nom['fecha']."' ) AS f"));

				$this->Cell(100,0,"Eventos Sociales Villa Conin S.A. de C.V",0,0,'C');
				$this->Ln(15);
				$this->SetFont('Arial','B',10);
				$this->Cell(100,0,"CONTRATACIONES EVENTUALES PARA EVENTO ",0,0,'C');
				$this->SetFont('Arial','B',18);
				$this->Cell(5,0,"UNICO",0,0,'C');
				$this->SetFont('Arial','B',10);
				$this->Cell(110,0,"DE FECHA ".$nom['Texto'],0,0,'C');

					$this->SetFont('Arial','B',6);
				$this->Ln(5);
				/*$this->Cell(225,5,"SEMANA # ".Semana($fecha)." Del  ".fechas($ff['f']),1,0,'C');*/
				$this->Cell(225,5,"SEMANA # ".Semana($fecha),1,0,'C');
				$this->Ln(5);
				$this->Cell(70,5,"Nombre",1,0,"C");
				$this->Cell(10,5,"Puntos",1,0,"C");			
				$this->Cell(20,5,"Hora de Entrada",1,0,"C");
				$this->Cell(20,5,"Hora de Saalida",1,0,"C");
				$this->Cell(15,5,"Lunes",1,0,"C");
				$this->Cell(15,5,"Martes",1,0,"C");
				$this->Cell(15,5,"Miercoles",1,0,"C");
				$this->Cell(15,5,"Jueves",1,0,"C");
				$this->Cell(15,5,"Viernes",1,0,"C");
				$this->Cell(15,5,"Sabado",1,0,"C");
				$this->Cell(15,5,"Domingo",1,0,"C");
				$this->Cell(15,5,"Total",1,0,"C");		
				$this->Cell(25,5,"Firma",1,0,"C");		
					$this->Ln(5);$b=0; $total=0;
				for($i=1;$i<=count($nombres)-1;$i++)
				{
					if($i>1)
					{
						$b=$b+7;
					}
					if(isset($he[$i])&&$he[$i]!="")
					{
						$nombre=explode("-", $nombres[$i]);
						$this->Cell(70,5,$nombre[0],1,0,"C");
						$this->Cell(10,5,$puntos[$i],1,0,"C");			
						$this->Cell(20,5,$he[$i],1,0,"C");
						$this->Cell(20,5,$hs[$i],1,0,"C");
						if($costos[1+$b]!='')
						{	$this->Cell(15,5,money_format("%i",$costos[1+$b]),1,0,"C");	}
						else {$this->Cell(15,5,"X",1,0,"C");}
						if($costos[2+$b]!=''){
							$this->Cell(15,5,money_format("%i",$costos[2+$b]),1,0,"C");	}
						else {$this->Cell(15,5,"X",1,0,"C");}
						if($costos[3+$b]!='')
						{	$this->Cell(15,5,money_format("%i",$costos[3+$b]),1,0,"C");	}
						else {$this->Cell(15,5,"X",1,0,"C");}
						if($costos[4+$b]!='')
						{	$this->Cell(15,5,money_format("%i",$costos[4+$b]),1,0,"C");	}
						else {$this->Cell(15,5,"X",1,0,"C");}
						if($costos[5+$b]!='')
						{	$this->Cell(15,5,money_format("%i",$costos[5+$b]),1,0,"C");	}
						else {$this->Cell(15,5,"X",1,0,"C");}
						if($costos[6+$b]!='')
						{	$this->Cell(15,5,money_format("%i",$costos[6+$b]),1,0,"C");	}
						else {$this->Cell(15,5,"X",1,0,"C");}
						if($costos[7+$b]!='')
						{	$this->Cell(15,5,money_format("%i",$costos[7+$b]),1,0,"C");	}
						else {$this->Cell(15,5,"X",1,0,"C");}
						$this->Cell(15,5,money_format("%i",$totales[$i]),1,0,"C");
					
						$total+=$totales[$i];
						$this->Cell(25,5,"",1,0,"C");	
						$this->Ln(5);
					}

				}
				$this->SetX(220); 
				$this->Cell(15,5,"Total:",1,0,"C");							
					$this->Cell(15,5,money_format("%i",$total),1,0,"C");		
					$this->SetFont('Arial','B',12);
					$this->Ln(15);
				$this->Cell(215,5,utf8_decode("PAGO RECIBIDO A ENTERA SATISFACCIÓN."),0,0,"C");		
		}
		 if($_GET["tipo"]=="eventos")
		{
			$no=mysql_query("SELECT * FROM Confirmacion_Nomina_Eventos WHERE id=".$_GET['id']);
			$nom=mysql_fetch_array($no);
			$nombres=explode(",",$nom['nombres']);
			$costos=explode(",",$nom['costos']);
			$checks=explode(",",$nom['checks']);
			$he=explode(",",$nom['hora_entrada']);
			$hs=explode(",",$nom['hora_salida']);
			$totales=explode(",",$nom['totales']);
			$puntos=explode(",",$nom['puntos']);
			$fecha=$nom['fecha'];
			$ff=mysql_fetch_array(mysql_query("SELECT WEEK(  '".$nom['fecha']."' ) AS f"));			

				$this->Cell(100,0,"Eventos Sociales Villa Conin S.A. de C.V",0,0,'C');
				$this->Ln(15);
				$this->SetFont('Arial','B',8);
				$this->Cell(80,0,"CONTRATACIONES EVENTUALES PARA EVENTO ",0,0,'C');
				$this->SetFont('Arial','B',18);			
				$this->Cell(15,0,"UNICO ",0,0,'C');
				$this->SetFont('Arial','B',8);				
				$this->Cell(70,0,"DE FECHA ".$nom['Texto'],0,0,'C');
					$this->SetFont('Arial','B',6);
				$this->Ln(5);
				/*$this->Cell(225,5,"SEMANA # ".Semana($fecha)." Del  ".fechas(),1,0,'C');*/
				$this->Cell(225,5,"SEMANA # ".Semana($fecha),1,0,'C');
				$this->Ln(5);
				$this->Cell(70,5,"Nombre",1,0,"C");
				$this->Cell(10,5,"Puntos",1,0,"C");			
				$this->Cell(20,5,"Hora de Entrada",1,0,"C");
				$this->Cell(20,5,"Hora de Saalida",1,0,"C");
				$this->Cell(15,5,"Lunes",1,0,"C");
				$this->Cell(15,5,"Martes",1,0,"C");
				$this->Cell(15,5,"Miercoles",1,0,"C");
				$this->Cell(15,5,"Jueves",1,0,"C");
				$this->Cell(15,5,"Viernes",1,0,"C");
				$this->Cell(15,5,"Sabado",1,0,"C");
				$this->Cell(15,5,"Domingo",1,0,"C");
				$this->Cell(15,5,"Total",1,0,"C");		
				$this->Cell(25,5,"Firma",1,0,"C");		
					$this->Ln(5);$b=0;
					$total=0;
				for($i=1;$i<=count($nombres)-1;$i++)
				{
					if($i>1)
					{
						$b=$b+7;
					}
					if(isset($he[$i])&&$he[$i]!="")
					{
						$nombre=explode("-", $nombres[$i]);
						$this->Cell(70,5,$nombre[0],1,0,"C");
						$this->Cell(10,5,$puntos[$i],1,0,"C");			
						$this->Cell(20,5,$he[$i],1,0,"C");
						$this->Cell(20,5,$hs[$i],1,0,"C");
						if($costos[1+$b]!="")
						{$this->Cell(15,5,money_format("%i",$costos[1+$b]),1,0,"C");}
						else{$this->Cell(15,5,"X",1,0,"C");	}
						if($costos[2+$b]!=""){
						$this->Cell(15,5,money_format("%i",$costos[2+$b]),1,0,"C");	}
						else{$this->Cell(15,5,"X",1,0,"C");	}
						if($costos[3+$b]!=""){
						$this->Cell(15,5,money_format("%i",$costos[3+$b]),1,0,"C");	}
						else{$this->Cell(15,5,"X",1,0,"C");	}
						if($costos[4+$b]!=""){
						$this->Cell(15,5,money_format("%i",$costos[4+$b]),1,0,"C");	}
						else{$this->Cell(15,5,"X",1,0,"C");	}
						if($costos[5+$b]!=""){
						$this->Cell(15,5,money_format("%i",$costos[5+$b]),1,0,"C");	}
						else{$this->Cell(15,5,"X",1,0,"C");	}
						if($costos[6+$b]!=""){
						$this->Cell(15,5,money_format("%i",$costos[6+$b]),1,0,"C");	}
						else{$this->Cell(15,5,"X",1,0,"C");	}
						if($costos[7+$b]!=""){
						$this->Cell(15,5,money_format("%i",$costos[7+$b]),1,0,"C");	}
						else{$this->Cell(15,5,"X",1,0,"C");	}
					
						$this->Cell(15,5,money_format("%i",$totales[$i]),1,0,"C");	
						$this->Cell(25,5,"",1,0,"C");	
						$this->Ln(5);
						$total+=$totales[$i];
					}

				}
				$this->SetX(220); 
				$this->Cell(15,5,"Total:",1,0,"C");							
					$this->Cell(15,5,money_format("%i",$total),1,0,"C");					
					$this->SetFont('Arial','B',12);
					$this->Ln(15);
				$this->Cell(215,5,utf8_decode("PAGO RECIBIDO A ENTERA SATISFACCIÓN."),0,0,"C");		
		}
		if($_GET['tipo']=='planta')
		{
			$T="SELECT * FROM Confirmacion_Nomina_Planta WHERE id=".$_GET['id'];
			$no=mysql_query($T);
			$nomi=mysql_fetch_array($no);
			$nombres=$nomi['nombres'];					$nombre=explode(",",$nombres);	
			$he=$nomi['hora_entrada'];					$entra=explode(",",$he);
			$hs=$nomi['hora_salida'];					$sal=explode(",",$hs);
			$salario=$nomi['salario'];					$s=explode(",",$salario);
			$diast=$nomi['dias_trabajados'];			$dt=explode(",",$diast);
			$pago_evento=$nomi['pago_evento'];			$pe=explode(",",$pago_evento);	
			$neventos=$nomi['neventos_semana'];			$ne=explode(",",$neventos);
			$total_eventos=$nomi['total_eventos'];		$te=explode(",",$total_eventos);	
			$descuentos=$nomi['descuentos'];			$d=explode(",",$descuentos);
			$salario_semana=$nomi['salario_semana'];	$ss=explode(",",$salario_semana);
			$puntos=$nomi['puntos'];					$p=explode(",",$puntos);
			$totales=$nomi['Total_nomina'];				$t=explode(",",$totales);
			$this->Cell(100,0,"Eventos Sociales Villa Conin S.A. de C.V",0,0,'C');
				$this->Ln(18);$total=0;

				$this->Cell(250,0,"FECHA ".$nomi['Texto'],0,0,'C');$this->Ln(5);
					$this->SetFont('Arial','B',6);
					$this->Cell(223,5,"SEMANA # ".Semana($nomi['fecha']),1,0,'C');
				$this->Ln(5);
			$this->Cell(70,5,"Nombre",1,0,"C");
			$this->Cell(20,5,"Hora de Entrada",1,0,"C");
			$this->Cell(20,5,"Hora de Salida",1,0,"C");
			$this->Cell(20,5,"Salario Diario",1,0,"C");
			$this->Cell(20,5,"Dias Trabajados",1,0,"C");
			
			$this->Cell(25,5,"Pagos o Descuentos",1,0,"C");
			$this->Cell(23,5,"Salario por Semana",1,0,"C");
			$this->Cell(20,5,"Puntos",1,0,"C");
			$this->Cell(20,5,"Total",1,0,"C");
			$this->Cell(25,5,"FIRMA",1,0,"C");
			for($i=1;$i<count($entra);$i++)
			{
					if(isset($entra[$i])&&$entra[$i]!="")
					{
						$this->Ln(5);
						$nombresa=explode("-",$nombre[$i]);
						$this->Cell(70,5,$nombresa[0],1,0,"C");
						$this->Cell(20,5,$entra[$i],1,0,"C");
						$this->Cell(20,5,$sal[$i],1,0,"C");
						$this->Cell(20,5,$s[$i],1,0,"C");
						$this->Cell(20,5,$dt[$i],1,0,"C");
						
						$this->Cell(25,5,$d[$i],1,0,"C");
						$this->Cell(23,5,$ss[$i],1,0,"C");
						$this->Cell(20,5,$p[$i],1,0,"C");
						$this->Cell(20,5,number_format($t[$i],3),1,0,"C");
						$this->Cell(25,5,"",1,0,"C");								
						$total+=$t[$i];
					}
			}
$this->Ln(5);
			$this->SetX(208); 
				$this->Cell(20,5,"Total:",1,0,"C");							
					$this->Cell(20,5,money_format("%i",$total),1,0,"C");	
			
		}
		if($_GET['tipo']=='construccion')
		{
			$T="SELECT * FROM Confirmacion_Nomina_Construccion WHERE id=".$_GET['id'];
			$no=mysql_query($T);
			$nomi=mysql_fetch_array($no);
			$nombres=$nomi['nombres'];					$nombre=explode(",",$nombres);	
			$he=$nomi['hora_entrada'];					$entra=explode(",",$he);
			$hs=$nomi['hora_salida'];					$sal=explode(",",$hs);
			$salario=$nomi['salario'];					$s=explode(",",$salario);
			$diast=$nomi['dias_trabajados'];			$dt=explode(",",$diast);
			$pago_evento=$nomi['pago_evento'];			$pe=explode(",",$pago_evento);	
			$neventos=$nomi['neventos_semana'];			$ne=explode(",",$neventos);
			$total_eventos=$nomi['total_eventos'];		$te=explode(",",$total_eventos);	
			$descuentos=$nomi['descuentos'];			$d=explode(",",$descuentos);
			$salario_semana=$nomi['salario_semana'];	$ss=explode(",",$salario_semana);
			$puntos=$nomi['puntos'];					$p=explode(",",$puntos);
			$totales=$nomi['Total_nomina'];				$t=explode(",",$totales);
			$ff=mysql_fetch_array(mysql_query("SELECT WEEK(  '".$nomi['fecha']."' ) AS f"));
			$this->Cell(150,0,utf8_decode("Saúl Morán Bello"),0,0,'C');

			$total=0;

				$this->Ln(18);

				$this->Cell(250,0,"FECHA ".$nomi['Texto'],0,0,'C');
				$this->Ln(5);
					$this->SetFont('Arial','B',6);

			$this->Cell(223,5,utf8_decode("Semana # ".$ff['f']),1,0,"C");
				$this->Ln(5);			
			$this->Cell(70,5,"Nombre",1,0,"C");
			$this->Cell(20,5,"Hora de Entrada",1,0,"C");
			$this->Cell(20,5,"Hora de Salida",1,0,"C");
			$this->Cell(20,5,"Salario Diario",1,0,"C");
			$this->Cell(20,5,"Dias Trabajados",1,0,"C");		
			$this->Cell(25,5,"Pagos o Descuentos",1,0,"C");
			$this->Cell(23,5,"Salario por Semana",1,0,"C");
			$this->Cell(20,5,"Puntos",1,0,"C");
			$this->Cell(20,5,"Total",1,0,"C");
			$this->Cell(25,5,"FIRMA",1,0,"C");
			for($i=1;$i<count($entra);$i++)
			{
				if(isset($entra[$i])&&$entra[$i]!="")
					{
						$this->Ln(5);
						$nombresa=explode("-",$nombre[$i]);
						$this->Cell(70,5,$nombresa[0],1,0,"C");
						$this->Cell(20,5,$entra[$i]." Hrs",1,0,"C");
						$this->Cell(20,5,$sal[$i]." Hrs",1,0,"C");
						$this->Cell(20,5,$s[$i],1,0,"C");
						$this->Cell(20,5,$dt[$i],1,0,"C");				
						$this->Cell(25,5,$d[$i],1,0,"C");
						$this->Cell(23,5,$ss[$i],1,0,"C");
						$this->Cell(20,5,$p[$i],1,0,"C");
						$this->Cell(20,5,money_format("%i",$t[$i]),1,0,"C");
						$this->Cell(25,5,"",1,0,"C");
						$total+=$t[$i];
					}	
			}
			$this->Ln(5);
			$this->SetX(208); 
				$this->Cell(20,5,"Total:",1,0,"C");							
					$this->Cell(20,5,money_format("%i",$total),1,0,"C");	
			$this->SetFont('Arial','B',12);
					$this->Ln(15);
				$this->Cell(215,5,utf8_decode("PAGO RECIBIDO A ENTERA SATISFACCIÓN."),0,0,"C");		
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