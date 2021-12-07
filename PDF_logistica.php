<?php
require 'funciones2.php';
conectar();
include "FormularioPDF/fpdf/fpdf.php";

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('Imagenes/pdfvillaconin.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',25); 
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,20,'LOGISTICA DE EVENTO',0,0,'C');
    // Salto de línea
    $this->Ln(25);
}


function informacion(){
    $contratoXD = [];
    $infoEvento = mysql_fetch_array(mysql_query("select * from Actividades where numero='".$_GET['n']."' order by fecha_i,hora_i"));
    $info=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_GET['n']."'"));
    $contratoXD = $info;
    $ol=$info['observaciones_logistica'];
     $this->SetFont('Arial','',9);
     $this->Cell(33,4,'FECHA DE EVENTO');
    $this->Cell(70,4,formato_fecha_log($info['Fecha']),'B',0,'C');
    $this->Cell(30,4,'TIPO DE EVENTO',0,0,'R');
    $this->Cell(70,4,utf8_decode($info['tipo']),'B',1,'C');
     $this->Cell(33,4,'No DE CONTRATO');
    $this->Cell(70,4,$info['Numero'],'B',0,'C');
    $this->Cell(30,4,'FESTEJADO',0,0,'R');	if(strlen($info['festejado'])>34){		$this->SetFont('Times','',6);		$this->Cell(70,4,utf8_decode($info['festejado']),'B',1,'C');		$this->SetFont('Times','',9);	}else{		$this->Cell(70,4,utf8_decode($info['festejado']),'B',1,'C');	}
    
    $comensales_cargo=total_comensales($_GET['n'],$info['facturado']);
    $adultos=$info['c_adultos']+$comensales_cargo[0];
    $jovenes=$info['c_jovenes']+$comensales_cargo[1];
	$ninos=$info['c_ninos']+$comensales_cargo[2];
    $t_comensales=$adultos+$jovenes+$ninos;
     $this->Cell(33,4,'No DE INVITADOS');
    //$this->Cell(70,4,$t_comensales,'B',0,'C');
    $this->Cell(70,4,"Adultos: ".$adultos."\nJovenes: ".$jovenes.utf8_decode("\nNiños: ").$ninos." TOTAL: ".$t_comensales,'B',0,'C');
    $this->Cell(30,4,'CONTACTO',0,0,'R');	if(strlen($info['nombre'])>34){		$this->SetFont('Times','',6);		$this->Cell(70,4,utf8_decode($info['nombre']),'B',1,'C');		$this->SetFont('Times','',9);	}else{		$this->Cell(70,4,utf8_decode($info['nombre']),'B',1,'C');	}
    
     $this->Cell(33,4,'SALON DEL EVENTO');
    $this->Cell(70,4,$info['salon'],'B',0,'C');
    $this->Cell(30,4,'VENDEDOR',0,0,'R');
    $this->Cell(70,4,$info['vendedor'],'B',1,'C');
    $this->Ln(3);   
    /////TABLA DE LOGISTICA  
    $this->SetFillColor(252,219,110);
    $this->Cell(20,4,'INICIO',1,0,'C',true);$this->Cell(20,4,'FIN',1,0,'C',true);$this->Cell(70,4,'ACTIVIDAD',1,1,'C',true);
    
    $log=mysql_query("select * from logistica where numero='".$_GET['n']."' order by fecha_i ASC,hora_i ASC");
    $aux_f="2015-01-01";$aux_h="00:00:00";
    while($m=mysql_fetch_array($log)){
        
         /////actividades
        $act=mysql_query("select * from Actividades where numero='".$_GET['n']."' order by fecha_i,hora_i");
        while($m2=mysql_fetch_array($act)){
            $dt1 = strtotime($m['fecha_i']." ".$m['hora_i']);
	        $dt2 = strtotime($aux_f." ".$aux_h);
	        $dt3 = strtotime($m2['fecha_i']." ".$m2['hora_i']);
            if($dt3>=$dt2 && $dt3<$dt1){				
				if(strlen($m2['actividad'])>36){///validacion de longitud de campo de texto
					$ncarac=strlen($m2['actividad']);
					$renglones=ceil($ncarac/36)*4;
					$this->Cell(20,$renglones,$m2['hora_i'],1,0,'C');
					$this->Cell(20,$renglones,$m2['hora_f'],1,0,'C');
					for($r=0;$r<ceil($ncarac/36);$r++){
						if($r!=0){
							$this->Cell(40,4,"",0,0,'C');
						}						
						$aux_c=$r*36;
						$this->Cell(70,4,substr($m2['actividad'], $aux_c, 36),"R",1,'C');
					}				
				}else{
					$this->Cell(20,4,$m2['hora_i'],1,0,'C');
					$this->Cell(20,4,$m2['hora_f'],1,0,'C');
					$this->Cell(70,4,$m2['actividad'],1,1,'C');							
				}
            }
        }
        $service=mysql_fetch_array(mysql_query("select * from Servicios where id=".$m['servicio']));
		if($service['Servicio']=='RENTA'){
			$service['Servicio']="RENTA DE INSTALACIONES";
		}
        $this->Cell(20,4,$m['hora_i'],1,0,'C');$this->Cell(20,4,$m['hora_f'],1,0,'C');$this->Cell(70,4,$service['Servicio'],1,1,'C');
       
        $aux_f=$m["fecha_i"];
        $aux_h=$m["hora_i"];
    }
	//$this->Cell(20,4,$m['hora_i'],1,0,'C');$this->Cell(20,4,$m['hora_f'],1,0,'C');$this->Cell(70,4, $aux_f." ".$aux_h,1,1,'C');
    //////actividades posteriores al ultmi servicio en tabla logistica
    $act2=mysql_query("select * from Actividades where numero='".$_GET['n']."' order by fecha_i,hora_i");
    while($m3=mysql_fetch_array($act2)){
		$inicial=strtotime($aux_f." ".$aux_h);
		$actual=strtotime($m3["fecha_i"]." ".$m3["hora_i"]);
		//$this->Cell(20,4,$m['hora_i'],1,0,'C');$this->Cell(20,4,$m['hora_f'],1,0,'C');$this->Cell(70,4, $aux_f." ".$aux_h.">=".$m3["fecha_i"]." ".$m3["hora_i"],1,1,'C');
			if($actual>=$inicial){
				if(strlen($m3['actividad'])>36){
				$ncarac=strlen($m3['actividad']);
				$renglones=ceil($ncarac/36)*4;	
				$this->Cell(20,$renglones,$m3['hora_i'],1,0,'C');$this->Cell(20,$renglones,$m3['hora_f'],1,0,'C');
				for($r=0;$r<ceil($ncarac/36);$r++){
					if($r!=0){
						$this->Cell(40,4,"",0,0,'C');
					}
					$aux_c=$r*36;
					$this->Cell(70,4,substr($m3['actividad'], $aux_c, 36),"R",1,'C');
				}		
			}else{	
				$this->Cell(20,4,$m3['hora_i'],1,0,'C');$this->Cell(20,4,$m3['hora_f'],1,0,'C');$this->Cell(70,4,$m3['actividad'],1,1,'C');
			}
				////solo se modifica el rango de fechas si es que entro al ciclo que indica que si es mayor a la fecha y hora aux
			$aux_f=$m3["fecha_i"];
			$aux_h=$m3["hora_i"];
		}
    }
    //////dato de la logistica
    $menu=mysql_query("select * from logistica_menu where contrato='".$_GET['n']."'");
    $str='';
    while($menu2=mysql_fetch_array($menu)){
        $str=$str.$menu2['titulo']."_".$menu2['cantidad']."_".$menu2['tipo_comensal']."(";
        $platillos=explode("%",$menu2['menu']);
        for($a=0;$a<count($platillos);$a++){
            $pl=mysql_fetch_array(mysql_query("select * from Menus where id_menu=".$platillos[$a])); 
             $str=$str.$pl['nombre'].",";
        }
         $str=$str.")";
    }
    
    
    
    
    
    
    
    
    
    
    /*
    $this->MultiCell(110,25,"mobiliario",1,"C");   
    $this->MultiCell(110,25,"observaciones grales",1,"C");*/
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    ///////////////bloque de los servicios
    
     //tabla de servicios
    $this->SetXY(120,54);
    $this->SetFillColor(252,219,110);
    $this->Cell(55,4,'SERVICIO',1,0,"C",true);$this->Cell(39,4,'ESPECIFICACIONES',1,0,"C",true);$this->Ln(4);$this->SetX(120);
    $servicios='';
    /////////servicios incluidos en el contrato
	$default=explode('%',$info['servicios']);
	for($k=0;$k<count($default);$k++){
        
        ////verificamos los servicios que son opcionales
        $opcionales=explode(",",$default[$k]);
        if(count($opcionales)<=1){
            $s1=explode("-",$default[$k]);
            if(isset($servicios[$s1[0]])){
                $servicios[$s1[0]]=$servicios[$s1[0]]+$s1[1];
            }else{
                $servicios[$s1[0]]=$s1[1];
            }
        }else{
             $s1=explode("-",$opcionales[0]);
            if(isset($servicios[$s1[0]])){
                $servicios[$s1[0]]=$servicios[$s1[0]]+$s1[1];
            }else{
                $servicios[$s1[0]]=$s1[1];
            }
        }
		
	}
	
	//////////servicios adicionales
    //	echo $mis_servicios['ServiciosAdicionales']."<br><br>";
	$info=explode("#",$info['ServiciosAdicionales']);
	for($i=0;$i<count($info);$i++){
		$id=explode("_",$info[$i]);
		$service=explode(";",$id[1]);
		for($i2=0;$i2<count($service);$i2++){
			//echo $service[$i2]."<br>";
			$s=explode(',',$service[$i2]);
			if(isset($servicios[$s[0]])){
				$servicios[$s[0]]=$servicios[$s[0]]+$s[1];
			}else{
				$servicios[$s[0]]=$s[1];
			}
		}
		
	}
    
    $ordenar=mysql_query("select * from Servicios order by unidad,Servicio");
	while($q=mysql_fetch_array($ordenar)){
		if(isset($servicios[$q["id"]])){
			if($q['tipo']==3 || $q['tipo']==32 || $q['tipo']==33 || $q['tipo']==34){
                $mym=$mym.",".$servicios[$q["id"]]." ".$q['Servicio'];
            }else{
                $aux='"'.$i.'","'.$servicios[$i].'"';
                $log=mysql_fetch_array(mysql_query("select sum(tiempo) as t from logistica where numero='".$_GET['numero']."' and servicio=".$i));
                if($q['unidad']=="ILIMITADA"){
					$q['unidad']="";
				}
				
				if(strlen($q['Servicio'])>25){
						$this->SetFont('Times','',7);
						$this->Cell(55,4,$q['Servicio'],1,0,"C");
						$this->SetFont('Times','',9);
						$this->Cell(39,4,$servicios[$q["id"]]." ".$q['unidad'],1,0,"C");$this->Ln(4);$this->SetX(120);
						
				   }else{
						$this->Cell(55,4,$q['Servicio'],1,0,"C");
						$this->Cell(39,4,$servicios[$q["id"]]." ".$q['unidad'],1,0,"C");
						$this->Ln(4);$this->SetX(120);
				   }
			}
		}
	}
     
	 /*foreach ($servicios as $i => $value) {
                $q=mysql_fetch_array(mysql_query("select * from Servicios where id=".$i));	
                if($servicios[$i]!=''){
                    if($q['tipo']==3 || $q['tipo']==32 || $q['tipo']==33 || $q['tipo']==34){
                        $mym=$mym.",".$value." ".$q['Servicio'];
                    }else{
                        $aux='"'.$i.'","'.$servicios[$i].'"';
                    $log=mysql_fetch_array(mysql_query("select sum(tiempo) as t from logistica where numero='".$_GET['numero']."' and servicio=".$i));
                   if($servicios[$i]=="ILIMITADA"){
						$servicios[$i]="";
				   }
				   
				   if(strlen($q['Servicio'])>25){
						$this->SetFont('Times','',7);
						$this->Cell(55,4,$q['Servicio'],1,0,"C");
						$this->SetFont('Times','',9);
						$this->Cell(39,4,$servicios[$i]." ".$q['unidad'],1,0,"C");$this->Ln(4);$this->SetX(120);
						
				   }else{
						$this->Cell(55,4,$q['Servicio'],1,0,"C");$this->Cell(39,4,$servicios[$i]." ".$q['unidad'],1,0,"C");$this->Ln(4);$this->SetX(120);
				   }
                   }
                }
            }
    */
    
    
    
    
    /////////////////////////////7
    
    // $this->SetY(228);
    $this->SetX(120);
    $this->SetFont('Arial','B', 8);
    $this->MultiCell(94,3,utf8_decode("¡COMUNICADO!\n 
    Debido a la contingencia sanitaria generada por el virus COVID-19, se hace la siguiente notificación
    a " . $contratoXD['nombre'] . " con No. de contrato " . $contratoXD['Numero'] . ": por disposición oficial por parte de las autoridades, el horario máximo permitido para la finalización de los eventos será a las 1:00 A.M del dia siguiente a la fecha de su evento, para la cual el cliente se compromete desalojar las instalaciones 30 minutos antes de la finalización del evento.
    
    \n Acepto y estoy de acuerdo con la notificación.
    \n Nombre y firma del cliente:"),1,"C",1);
    $this->SetFont('Arial','', 8);
    // $this->Cell(94,20,'AUTORIZO ',1,0,"C");
    $this->Ln(8);
    $this->SetX(130);
    // $this->Cell(80,8,'','B',1,"C");
    $this->SetX(120);
    $this->Cell(94,20,'FECHA DEL PRIMER CONTACTO:',0,0,"C");$this->Ln(4);$this->SetX(120);
    $fech=mysql_fetch_array(mysql_query("select * from logistica_fechas where contrato='".$_GET['n']."'"));
	$this->Cell(94,20,$fech['primer_contacto'],1,0,"C");
	$this->Ln(11);$this->SetX(120);
	$this->Cell(94,3,"FECHA DE LA ULTIMA MODIFICACION",0,1,"C");$this->SetX(120);
	$this->Cell(94,5,$fech['ultima_modificacion'],0,0,"C");
	
	$this->Ln(20);$this->SetX(120);
  
    $this->SetXY(10,150);
    $this->MultiCell(94,4,"\nMENU\n ".$str,1,"C",0);
    $this->MultiCell(94,4,"Manteleria y Equipo\n ".$mym,1,"C",0);
    $this->Ln(1);
	$obs=explode(",",$ol);
	$this->MultiCell(110,4,"\nObservaciones Generales\n",0,"J",0);
	for($iol=0;$iol<count($obs);$iol++){
		if($obs[$iol]!=''){
			$this->MultiCell(110,4,"*".$obs[$iol],0,"J",0);
		}
	}
    
    
    
}   
// Pie de página 
function Footer()
{    
    // Posición: a 1,5 cm del final
    $this->SetY(-3);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
} 
}
function formato_fecha_log($fecha){      
	$week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");      
	$months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");      
	$datos=explode("-",$fecha);	
	$year_now = $datos[0]*1;      
	$month_now = $datos[1]*1;      
	$day_now = $datos[2]*1;      
	$week_day_now = date('w', strtotime($fecha));      
	$date = $week_days[$week_day_now] . ", " . $day_now . " de " . $months[$month_now] . " de " . $year_now;       
	return $date;    
}
// Creación del objeto de la clase heredada
$pdf = new PDF('P', 'mm', 'letter'); 
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->informacion();
$pdf->Output();
?>