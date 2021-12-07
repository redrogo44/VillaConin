<?php
	
include "FormularioPDF/fpdf/fpdf.php";
require 'funciones2.php';
conectar();
header('Content-Type: text/html; charset=utf-8');
 class PDF extends FPDF
		{
		
		
		
	function Header()
			{
				
				$this->SetFont('Arial','','9');
				$this->Ln(40);
				$this->Cell(20);
				$this->Cell(20,10,'Contrato:'.$_GET['numero'],0,0,'C');
				$this->Ln(4);
				$this->Cell(20);
				$this->Cell(20,10,cambioFecha(DATE('Ymd')),0,0,'C');
				$this->Ln(20);
			}
	function Footer()
			{
				/*$this->Sety(-15);
				$this->SetFont('Arial','I','8');
				$this->Cell(0,10,'pagina'.$this->PageNo().'/{nb}',0,0,'C');
				*/
			}
			
	function contenido()
			{
			
			$consulta="select * from contrato where Numero='".$_GET['numero']."'";
			$resultado=mysql_query($consulta);
			$mostrar=mysql_fetch_array($resultado);
			
			$contrato='CONTRATO DE PRESTACIÓN DE SERVICIOS DE EVENTOS SOCIALES QUE CELEBRAN POR UNA PARTE EVENTOS SOCIALES VILLA CONIN S.A. DE C.V., REPRESENTADA LEGALMENTE POR EL ING. SAÚL MORÁN BELLO A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ "EL PRESTADOR DEL SERVICIO" Y POR LA OTRA PARTE ';
			$contrato=$contrato.$mostrar['nombre'].' A QUIEN EN LO SUCESIVO SE LE DENOMINARA "CLIENTE" AL TENOR DE LAS SIGUIENTES CLÁUSULAS..';
			
			$c='PRIMERA.- EL PRESENTE CONTRATO SERÁ PARA EL EVENTO SOCIAL '.$mostrar['tipo'].' PARA:';
			
			
			
			
			$this->SetFont('Arial','',8);
			$this->MultiCell(0,3,strtoupper($contrato));
			$this->Ln(1);
			$this->SetFont('Arial','B',9);
			$this->MultiCell(0,"","CLAUSULAS",0,'C');
			$this->Ln(2);
			$this->SetFont('Arial','',8);
			$this->MultiCell(0,3,strtoupper($c));
			$this->Ln(3);
			$this->Cell(40,4,"",'C',0,1);
			$this->Cell(40,4,"Cantidad",1,0,'C');
			$this->Cell(40,4,"Comensales",1,0,'C');
			$this->Cell(40,4,"Precio",1,0,'C');
			$this->Ln(4);
			$this->Cell(40,4,"",'C',0,1);
			$this->Cell(40,4,$mostrar['c_adultos'],1,0,'C');
			$this->Cell(40,4,"ADULTOS",1,0,'C');
			$this->Cell(40,4,"$".$mostrar['p_adultos'],1,0,'C');
			$this->Ln(4);
			$this->Cell(40,4,"",'C',0,1);
			$this->Cell(40,4,$mostrar['c_jovenes'],1,0,'C');
			$this->Cell(40,4,"JOVENES",1,0,'C');
			$this->Cell(40,4,"$".$mostrar['p_jovenes'],1,0,'C');
			$this->Ln(4);
			$this->Cell(40,4,"",'C',0,1);
			$this->Cell(40,4,$mostrar['c_ninos'],1,0,'C');
			$this->Cell(40,4,"NIÑOS",1,0,'C');
			$this->Cell(40,4,"$".$mostrar['p_ninos'],1,0,'C');
			$this->Ln(5);
			$fp=explode('-',$mostrar['Fecha']);
			$rf=$fp[0].$fp[1].$fp[2];
			$this->MultiCell(0,2,"EL DIA ".strtoupper(cambioFecha($rf)).' INCLUYENDO LO ESTABLECIDO EN HOJA ANEXA (VC01 Rev. 0 COTIZACIÓN).');
			$this->Ln(2);
			$t_adultos=$mostrar['p_adultos']*$mostrar['c_adultos'];
			$t_jovenes=$mostrar['p_jovenes']*$mostrar['c_jovenes'];
			$t_ninos=$mostrar['p_ninos']*$mostrar['c_ninos'];
			$tt=$t_adultos+$t_jovenes+$t_ninos;
			
			if($mostrar['facturado']=='si'){
			$o="CON IVA INCLUIDO";
			$impuesto=$tt*.16;
			}else{
			$impuesto=0;
			$o="";
			}
			$depo=$mostrar['deposito'];
			//total  del costo del evento
			$total=$tt+$impuesto+$depo;
			$f="SEGUNDA.- AMBAS PARTES ESTAN DE ACUERDO EN QUE EL MONTO TOTAL POR LOS COMENSALES CONTRATADOS ES POR LA CANTIDAD DE $".$total." ".$o." (".numtoletras($total).") TOMANDO EN CUENTA UN DEPOSITO EN GARANTÍA DE $".$mostrar['deposito']." (".numtoletras($mostrar['deposito']).") A PAGAR DE LA SIGUIENTE MANERA:";
			$this->MultiCell(0,3,strtoupper($f));
			$this->Ln(1);
			//$this->Cell(40,4,numero_de_meses(date('y-m-d'),$mostrar['Fecha']),1,0,'C');
			$this->Cell(40,4,"",'C',0,1);
			$this->Cell(40,4,"Concepto",1,0,'C');
			$this->Cell(40,4,"Fecha",1,0,'C');
			$this->Cell(40,4,"Monto",1,0,'C');
			$next = strtotime ( '+1 month' , strtotime ( date('y-m-d') ) ) ;
			$next2=date ( 'Y-m-d' , $next );
			
//  VALIDACION DE FECHA EN CONFIGURACIONES DEPOSIO INICIAL Y ABONOS HECHOS
			//OBTENEMOS SUMAS DE ABONOS
			if($mostrar['facturado']=='si'){
				$preabonos="select sum(cantidad) as t from abonofac where numcontrato='".$_GET['numero']."'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}else{
				$preabonos="select sum(cantidad) as t from abono where numcontrato='".$_GET['numero']."'";
				$preabonos2=mysql_query($preabonos);
				$total_abonos=mysql_fetch_array($preabonos2);
			}
			
			
			
			///////////////cantidad de abonos
			$cantidad=mysql_query("select fechas from subcontratos where numero='".$_GET['numero']."'");
			$mf=mysql_fetch_array($cantidad);
			$fech=explode('%',$mf['fechas']);
			
			
			////fechas pasadas recalcular pagos
			$hoy=date('Y-m-d');
			$contador=0;
			for($w=0;$w<count($fech)-1;$w++){
				if(strtotime($hoy)<strtotime($fech[$w]) && $fech[$w]!=''){
					$contador++;
				}
			}
			
			$pagos=$total/($contador);
			
				for($i = 0; $i < count($fech)-1; $i++){
				$this->Ln(4);
					if(strtotime($hoy)<strtotime($fech[$i]) && $fech[$i]!=''){
						$this->Cell(40,4,"",'C',0,1);
						$this->Cell(40,4,$i+1 ." ABONO",1,0,'C');
						$this->Cell(40,4,$fech[$i],1,0,'C');
						$this->Cell(40,4,"$".round($pagos,2),1,0,'C');
					}else{
						$this->Cell(40,4,"",'C',0,1);
						$this->Cell(40,4,$i+1 ." ABONO",1,0,'C');
						$this->Cell(40,4,$fech[$i],1,0,'C');
						$this->Cell(40,4,"$0",1,0,'C');
					}
					
				}
			$this->Ln(3);
			$this->MultiCell(0,3,strtoupper($c1));
			$c2="TERCERA.- EL PRESTADOR DEL SERVICIO ENTREGARÁ EL SALÓN ".$mostrar['salon']."  EL DÍA ".cambioFecha($rf)." EN OPTIMAS CONDICIONES EN TODAS Y CADA UNA DE SUS INSTALACIONES, MOBILIARIO Y EQUIPO, POR LO QUE EL CLIENTE ACEPTA ENTREGAR COMO DEPÓSITO EN GARANTÍA LA CANTIDAD DE: $".$mostrar['deposito']." (".numtoletras($mostrar['deposito'])."), IMPORTE QUE LE SERÁ DEVUELTO 8 (OCHO) DIAS DESPUÉS DEL EVENTO, UNA VEZ QUE SE REALICE LA INSPECCIÓN DE TODAS LAS INSTALACIONES ASI COMO DEL MOBILIARIO Y EQUIPO, POR LO CUAL Y EN CASO DE QUE HUBIESE ALGÚN DETERIORO ESTE SE CUBRIRÁ CON ESTE DEPÓSITO. SI EL COSTO DE LOS DAÑOS EXCEDIERA EL DEPÓSITO EN GARANTÍA, EL CLIENTE DEBERÁ CUBRIR LOS GASTOS. EN CASO DE NO ACUDIR POR SU DÉPÓSITO EN UN PERIODO MÁXIMO A 60 (SESENTA) DIAS, ESTE QUEDARA EN UN ESTATUS DE CADUCADO Y POR CONSECUENCIA YA NO PODRÁ SER DEVUELTO.";
			$this->Ln(1);
			$this->MultiCell(0,3,strtoupper($c2));
			
			
			
			$clausulas="select * from clausulas2";
			$rclausulas=mysql_query($clausulas);
			$numero_filas= mysql_num_rows($rclausulas);
			$num=4;
			
			while($m=mysql_fetch_array($rclausulas)){
				$claus=$m['descripcion'];
				$all="";
				if($claus!=''){
					
						$all=consecutivo($num).$claus;
						$this->Ln(1);
						$this->MultiCell(0,3,utf8_decode($all));
					
					$num=$num+1;
				}
			}
			
			}
			function firmas(){
			$consulta="select * from contrato where Numero='".$_GET['numero']."'";
			$resultado=mysql_query($consulta);
			$mostrar=mysql_fetch_array($resultado);
			$this->Ln(3);
			$this->Cell(30,4,"",0,0,'C');
			$this->Cell(40,4,"EL PRESTADOR DEL SERVICIO",0,0,'C');
			$this->Cell(30,4,"",0,0,'C');
			$this->Cell(40,4,"EL CLIENTE",0,0,'C');
			$this->Ln(20);
			$this->Cell(30,4,"",0,0,'C');
			$this->Cell(40,4,"ING. SAUL MORAN BELLO",0,0,'C');
			$this->Cell(30,4,"",0,0,'C');
			$this->Cell(40,4,strtoupper($mostrar['nombre']),0,0,'C');
			
			/// CLIENTE
			
			$consu="select * from subcontratos where numero='".$_GET['numero']."'";
			$resu=mysql_query($consu);
			$mostrar6=mysql_fetch_array($resu);
			
			$this->Ln(5);
			$this->MultiCell(0,2,"-----------------");
			$this->MultiCell(0,3,"TELEFONO: ".$mostrar6['telefono']);
			$this->MultiCell(0,2,"E-MAIL: ".$mostrar6['correo']);
			$this->MultiCell(0,2,"FESTEJADO: ".$mostrar6['festejado']);
			$pag="update contrato set impreso='si',estatus=1 where Numero='".$_GET['numero']."'";
			$pagg=mysql_query($pag);
			$fimp=mysql_query('update subcontratos set fechaimp="'.date('Y-m-d').'" where numero="'.$_GET['numero'].'"');
			}
			
			}
			
			$pdf= new PDF();
			$pdf->AliasNbPages();
			$pdf->Addpage();
			$pdf->SetFont('Arial','B',4);
			$pdf->contenido();
			$pdf->firmas();
			$pdf->Output();	


	?>