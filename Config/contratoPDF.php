<?php
	
include "FormularioPDF/fpdf/fpdf.php";
require 'funciones2.php';
conectar();

 class PDF extends FPDF
		{
		
		//$_POST['asignatura'] = utf8_decode($_POST['asignatura']);
		
		
	function Header()
			{
			
				$this->SetFont('Arial','','10');
				$this->Cell(20);
				$this->Cell(20,10,'Contrato:'.$_GET['numero'],0,0,'C');
				$this->Ln(50);
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
			$consulta2="select * from cliente where id='".$mostrar['id_cliente']."'";
			$resultado2=mysql_query($consulta2);
			$mostrar2=mysql_fetch_array($resultado2);
			$contrato='CONTRATO DE PRESTACIÓN DE SERVICIOS DE EVENTOS SOCIALES QUE CELEBRAN POR UNA PARTE EVENTOS SOCIALES VILLA CONIN S.A. DE C.V. CON DOMICLIO AV. QUINTANA ROO #1138, SAN ISIDRO MIRANDA, EL MARQUÉS QUERÉTARO., REPRESENTADA LEGALMENTE POR EL ING. SAÚL MORÁN BELLO A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ "EL PRESTADOR DEL SERVICIO" Y POR LA OTRA PARTE ';
			$contrato=$contrato.$mostrar['nombre'].' CON DOMICILIO '.$mostrar2['dom'].' A QUIEN EN LO SUCESIVO SE LE DENOMINARA "CLIENTE" AL TENOR DE LAS SIGUIENTES CLÁUSULAS.';
			
			$c='PRIMERA.- EL PRESENTE CONTRATO SERÁ PARA EL ARRENDAMIENTO DEL SALÓN '.$mostrar['salon'].' DEL EVENTO SOCIAL '.$mostrar['tipo'].' PARA:';
			
			
			
			$contrato=utf8_decode($contrato);
			$c=utf8_decode($c);
			$this->SetFont('Arial','',10);
			$this->MultiCell(0,5,$contrato);
			$this->Ln(4);
			$this->SetFont('Arial','B',13);
			$this->MultiCell(0,"","CLAUSULAS",0,'C');
			$this->Ln(4);
			$this->SetFont('Arial','',10);
			$this->MultiCell(0,5,$c);
			$this->Ln(4);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,"Cantidad",1,0,'C');
			$this->Cell(40,7,"Comensales",1,0,'C');
			$this->Cell(40,7,"Precio",1,0,'C');
			$this->Ln(7);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,$mostrar['c_adultos'],1,0,'C');
			$this->Cell(40,7,"Adultos",1,0,'C');
			$this->Cell(40,7,"$".$mostrar['p_adultos'],1,0,'C');
			$this->Ln(7);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,$mostrar['c_jovenes'],1,0,'C');
			$this->Cell(40,7,"Jovenes",1,0,'C');
			$this->Cell(40,7,"$".$mostrar['p_jovenes'],1,0,'C');
			$this->Ln(7);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,$mostrar['c_ninos'],1,0,'C');
			$this->Cell(40,7,utf8_decode("Niños"),1,0,'C');
			$this->Cell(40,7,"$".$mostrar['p_ninos'],1,0,'C');
			$this->Ln(14);
			$fp=explode('-',$mostrar['Fecha']);
			$rf=$fp[0].$fp[1].$fp[2];
			$this->MultiCell(0,5,"El dia ".cambioFecha($rf).utf8_decode(' INCLUYENDO LO ESTABLECIDO EN HOJA ANEXA (VC01 Rev. 0 COTIZACIÓN).'));
			$this->Ln(7);
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
			$total=$tt+$impuesto;
			$f=utf8_decode("SEGUNDA.- AMBAS PARTES ESTAN DE ACUERDO EN QUE EL COSTO POR EL ARRENDAMIENTO DEL SALON ".$mostrar['salon']." Y LOS SERVICIOS PRESTADOS ES POR LA CANTIDAD DE $".$total." ".$o." (".numtoletras($total).") TOMANDO EN CUENTA UN DEPOSITO EN GARANTÍA DE $".$mostrar['deposito']." (".numtoletras($mostrar['deposito']).") A PAGAR DE LA SIGUIENTE MANERA:");
			$this->MultiCell(0,5,$f);
			$this->Ln(10);
			//$this->Cell(40,7,numero_de_meses(date('y-m-d'),$mostrar['Fecha']),1,0,'C');
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,"Concepto",1,0,'C');
			$this->Cell(40,7,"Fecha",1,0,'C');
			$this->Cell(40,7,"Monto",1,0,'C');
			$next = strtotime ( '+1 month' , strtotime ( date('y-m-d') ) ) ;
			$next2=date ( 'Y-m-d' , $next );
//  VALIDACION DE FECHA EN CONFIGURACIONES DEPOSIO INICIAL

$CantidadDeposito="select valor from Configuraciones where id=1";
	   $CanDep=mysql_query($CantidadDeposito);
	   $Re=mysql_fetch_array($CanDep);


			$pagos=($total-$Re['valor'])/numero_de_meses(date('y-m-d'),$mostrar['Fecha']);
			$pag="update contrato set mensualidad=".$pagos.", alerta=0,proximo_abono='".$next2."'";
			$pagg=mysql_query($pag);
			
			$fecha = date('Y-m-j');
			
			$this->Ln(7);
			$this->Cell(40,7,"",'C',0,1);
					$this->Cell(40,7,"Apartado",1,0,'C');
					$this->Cell(40,7,$fecha,1,0,'C');
					$this->Cell(40,7,"$5000",1,0,'C');

				for($i = 1; $i <= numero_de_meses(date('y-m-d'),$mostrar['Fecha']); $i++){
				$nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
				$fecha=date ( 'Y-m-j' , $nuevafecha );
				$this->Ln(7);
				
				if($i==numero_de_meses(date('y-m-d'),$mostrar['Fecha'])){
					$nuevafecha = strtotime ( '-15day' , strtotime ( $fecha ) ) ;
					$fecha=date ( 'Y-m-j' , $nuevafecha );
					$this->Cell(40,7,"",'C',0,1);
					$this->Cell(40,7,"Liquidacion evento",1,0,'C');
					$this->Cell(40,7,$fecha,1,0,'C');
					$this->Cell(40,7,"$".$pagos,1,0,'C');
				}else{
				
					$this->Cell(40,7,"",'C',0,1);
					$this->Cell(40,7,"Abono",1,0,'C');
					$this->Cell(40,7,$fecha,1,0,'C');
					$this->Cell(40,7,"$".$pagos,1,0,'C');
				}
				}
			$this->Ln(10);
			$this->MultiCell(0,5,"LOS PAGOS MENCIONADOS DEBERAN SER EFECTUADOS DIRECTAMENTE EN NUESTRAS OFICINAS,");
			$c1=utf8_decode("TERCERA.- AMBAS PARTES ESTAN DE ACUERDO QUE EL COSTO POR LA RENTA DEL SALÓN ".$mostrar['salon']." Y LOS SERVICIOS PRESTADOS DEBERÁ SER PAGADOS DE ACUERDO AL CALENDARIO DE PAGOS ESTIPULADO EN ESTE CONTRATO, POR LO CUAL, EN CASO DE QUE EL CLIENTE INCUMPLA CON UN DEPÓSITO, SE DARÁ POR ENTENDIDO QUE EL EVENTO NO SE LLEVARÁ A CABO Y EL PRESTADOR DEL SERVICIO ESTA EN TODA LA LIBERTAD DE VENDER LA FECHA QUE FUE APARTADA");
			$this->Ln(10);
			$this->MultiCell(0,5,$c1);
			$c2=utf8_decode("CUARTA.- EL PRESTADOR DEL SERVICIO ENTREGARÁ EL SALÓN ".$mostrar['salon']." ) EL DÍA ".$mostrar['Fecha']."EN OPTIMAS CONDICIONES EN TODAS Y CADA UNA DE SUS INSTALACIONES COMO SON: INSTALACIONES ELÉCTRICAS, DE AGUA, JARDINES Y ÁREAS RECREATIVAS, INCLUYENDO MOBILIARIO Y EQUIPO COMO: MESAS, SILLAS, MANTEL, CUBRE MANTEL, CAMINOS, SERVILLETAS, FUNDAS, MOÑOS, VASOS, COPAS, TARROS, CABALLITOS, PLATOS, SALEROS, CENICEROS, SERVILLETEROS Y CUBIERTOS EN PERFECTO ESTADO, POR LO QUE EL CLIENTE ACEPTA ENTREGAR COMO DEPÓSITO EN GARANTÍA LA CANTIDAD DE: $3,000.00 (TRES MIL PESOS 00/100 M.N.) ), IMPORTE QUE LE SERÁ DEVUELTO 8 (OCHO) DIAS DESPUÉS DEL EVENTO, UNA VEZ QUE SE REALICE LA INSPECCIÓN DE TODAS LAS INSTALACIONES ASI COMO DEL MOBILIARIO Y EQUIPO, POR LO CUAL Y EN CASO DE QUE HUBIESE ALGÚN DETERIORO ESTE SE CUBRIRÁ CON ESTE DEPÓSITO. SI EL COSTO DE LOS DAÑOS EXCEDIERA EL DEPÓSITO EN GARANTÍA, EL CLIENTE DEBERÁ CUBRIR LOS GASTOS. EN CASO DE NO ACUDIR POR SU DÉPÓSITO EN UN PERIODO MÁXIMO A 60 (SESENTA) DIAS, ESTE QUEDARA EN UN ESTATUS DE CADUCADO Y POR CONSECUENCIA YA NO PODRÁ SER DEVUELTO.");
			$this->Ln(10);
			$this->MultiCell(0,5,$c2);
			$c3=utf8_decode("QUINTA.- EL TIEMPO DE LA RENTA DEL SALÓN ".$mostrar['salon']."SERÁ DE 15 HORAS, TENIENDO COMO LÍMITE LAS 24:00 HRS. SIN PASAR DE LAS 07:00 HRS. DEL DÍA SIGUIENTE AL EVENTO. ESTE HORARIO POR NINGUNA RAZÓN SE PODRÁ PROLONGAR YA QUE SON DISPOSICIONES DEL MUNICIPIO EL MARQUÉS, POR LO ANTERIOR EL HORARIO DE LA RENTA DEL SALON SERÁ DE LAS __________ A LAS __________ ESTABLECIDO EN HOJA ANEXA (VC01 Rev. 0 LOGISTICA).");
			$this->Ln(10);
			$this->MultiCell(0,5,$c3);
			
			
			$clausulas="select * from clausulas";
			$rclausulas=mysql_query($clausulas);
			$numero_filas= mysql_num_rows($rclausulas);
			$num=6;
			
			while($m=mysql_fetch_array($rclausulas)){
				$claus=$m['descripcion'];
				$all="";
				if($claus!=''){
					if($num==$numero_filas+5){
						$all=utf8_decode(consecutivo($num).$claus.cambioFecha(DATE('Ymd')));
						$this->Ln(10);
						$this->MultiCell(0,5,$all);
					}else{
						$all=utf8_decode(consecutivo($num).$claus);
						$this->Ln(10);
						$this->MultiCell(0,5,$all);
					}
					$num=$num+1;
				}
			}
			}
			
			function firmas(){
			$this->Ln(30);
			$this->Cell(30,7,"",0,0,'C');
			$this->Cell(40,7,"EL PRESTADOR DEL SERVICIO",0,0,'C');
			$this->Cell(30,7,"",0,0,'C');
			$this->Cell(40,7,"EL CLIENTE",0,0,'C');
			$this->Ln(40);
			$this->Cell(30,7,"",0,0,'C');
			$this->Cell(40,7,"ING. SAUL MORAN BELLO",0,0,'C');
			$this->Cell(30,7,"",0,0,'C');
			$this->Cell(40,7,$mostrar['nombre'],0,0,'C');
			
			$this->Ln(40);
			$this->MultiCell(0,5,"-------------------------------");
			$this->MultiCell(0,5,"TELEFONO: ".$mostrar2['tel']);
			$this->MultiCell(0,5,"E-MAIL: ".$mostrar2['mail']);
			
			}
			
			}
			
			$pdf= new PDF();
			$pdf->AliasNbPages();
			$pdf->Addpage();
			$pdf->SetFont('Arial','B',7);
			$pdf->contenido();
			$pdf->Addpage();
			$pdf->SetFont('Arial','B',7);
			$pdf->firmas();
			$pdf->Output();	


	?>