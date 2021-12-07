<?php
	
include "FormularioPDF/fpdf/fpdf.php";
require 'funciones2.php';
conectar();

header('Content-Type: text/html; charset=utf-8;');


 class PDF extends FPDF
		{
		
		//$_POST['asignatura'] = utf8_decode($_POST['asignatura']);
		
		
	function Header()
			{
				$this->Ln(40);
				$this->SetFont('Arial','','10');
				$this->Cell(20);
				$this->Cell(20,10,'CONTRATO: '.$_GET['numero'],0,0,'C');
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
			$consulta2="select * from cliente where id='".$mostrar['id_cliente']."'";
			$resultado2=mysql_query($consulta2);
			$mostrar2=mysql_fetch_array($resultado2);
			$contrato='CONTRATO DE PRESTACIÓN DE SERVICIOS DE EVENTOS SOCIALES QUE CELEBRAN POR UNA PARTE EVENTOS SOCIALES VILLA CONIN S.A. DE C.V. CON DOMICLIO AV. QUINTANA ROO #1138, SAN ISIDRO MIRANDA, EL MARQUÉS QUERÉTARO., REPRESENTADA LEGALMENTE POR EL ING. SAÚL MORÁN BELLO A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ "EL PRESTADOR DEL SERVICIO" Y POR LA OTRA PARTE ';
			$contrato=$contrato.$mostrar['nombre'].' CON DOMICILIO '.$mostrar2['dom'].' A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ "CLIENTE" AL TENOR DE LAS SIGUIENTES CLÁUSULAS.';
			
			$c='PRIMERA.- EL PRESENTE CONTRATO SERÁ PARA EL ARRENDAMIENTO DEL SALÓN '.$mostrar['salon'].' DEL EVENTO SOCIAL '.$mostrar['tipo'].' PARA:';
			$subc=mysql_query("select count(*) as t from contrato where Numero like '".$_GET['numero']."-%'");
			$subm=mysql_fetch_array($subc);
			if($subm['t']>0){
				$nuevos=mysql_query("SELECT sum(c_adultos) as a,sum(c_jovenes) as b,sum(c_ninos) as c,sum(deposito) as d,sum(si) as e FROM contrato WHERE Numero like '".$_GET['numero']."-%'");
				$nuevos2=mysql_fetch_array($nuevos);
				$mostrar['c_adultos']=$nuevos2['a'];
				$mostrar['c_jovenes']=$nuevos2['b'];
				$mostrar['c_ninos']=$nuevos2['c'];
			}
			
			
			$contrato=utf8_decode($contrato);
			$c=utf8_decode($c);
			$this->SetFont('Arial','',10);
			$this->MultiCell(0,5,strtoupper($contrato));
			$this->Ln(4);
			$this->SetFont('Arial','B',13);
			$this->MultiCell(0,"","CLAUSULAS",0,'C');
			$this->Ln(4);
			$this->SetFont('Arial','',10);
			$this->MultiCell(0,5,strtoupper($c));
			$this->Ln(4);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,"CANTIDAD",1,0,'C');
			$this->Cell(40,7,"COMENSALES",1,0,'C');
			if($subm['t']==0){
				$this->Cell(40,7,"PRECIO",1,0,'C');
			}
			$this->Ln(7);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,$mostrar['c_adultos'],1,0,'C');
			$this->Cell(40,7,"ADULTOS",1,0,'C');
			if($subm['t']==0){
			$this->Cell(40,7,"$".$mostrar['p_adultos'],1,0,'C');
			}
			$this->Ln(7);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,$mostrar['c_jovenes'],1,0,'C');
			$this->Cell(40,7,"JOVENES",1,0,'C');
			if($subm['t']==0){
			$this->Cell(40,7,"$".$mostrar['p_jovenes'],1,0,'C');
			}
			$this->Ln(7);
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,$mostrar['c_ninos'],1,0,'C');
			$this->Cell(40,7,utf8_decode("NIÑOS"),1,0,'C');
			if($subm['t']==0){
			$this->Cell(40,7,"$".$mostrar['p_ninos'],1,0,'C');
			}
			$this->Ln(14);
			$fp=explode('-',$mostrar['Fecha']);
			$rf=$fp[0].$fp[1].$fp[2];
			$this->MultiCell(0,5,utf8_decode("EL DÍA ".strtoupper(cambioFecha($rf)).utf8_decode(' INCLUYENDO LO ESTABLECIDO EN HOJA ANEXA (VC01 REV. 0 COTIZACIÓN).')));
			$this->Ln(7);
			$t_adultos=$mostrar['p_adultos']*$mostrar['c_adultos'];
			$t_jovenes=$mostrar['p_jovenes']*$mostrar['c_jovenes'];
			$t_ninos=$mostrar['p_ninos']*$mostrar['c_ninos'];
			$tt=$t_adultos+$t_jovenes+$t_ninos;
			$mostrador= substr($_GET['numero'], 0, 9);
			if($mostrar['facturado']=='si'){
			$o="CON IVA INCLUIDO";
			$impuesto=$tt*.16;
			}else{
			$impuesto=0;
			$o="";
			}
			if($subm['t']==0){
			$depo=$mostrar['deposito'];
			}else{
			$depo=$nuevos2['d'];
			}
			//total  del costo del evento
			if($subm['t']==0){
				$total=$tt+$impuesto+$depo;
			}else{
				$total=$nuevos2['e']+$depo;
			}
			
			if($mostrador=='MOSTRADOR'){ //validacion para contratos de mostrador para poner saldo actual
				$total=$mostrar['si'];
			}
			$f=utf8_decode("SEGUNDA.- AMBAS PARTES ESTÁN DE ACUERDO EN QUE EL COSTO POR EL ARRENDAMIENTO DEL SALÓN ".$mostrar['salon']." Y LOS SERVICIOS PRESTADOS ES POR LA CANTIDAD DE $".$total." ".$o." (".numtoletras($total).") TOMANDO EN CUENTA UN DEPÓSITO EN GARANTÍA DE $".$depo." (".numtoletras($depo).") A PAGAR DE LA SIGUIENTE MANERA:");
			$this->MultiCell(0,5,strtoupper($f));
			$this->Ln(10);
			//$this->Cell(40,7,numero_de_meses(date('y-m-d'),$mostrar['Fecha']),1,0,'C');
			$this->Cell(40,7,"",'C',0,1);
			$this->Cell(40,7,"CONCEPTO",1,0,'C');
			$this->Cell(40,7,"FECHA",1,0,'C');
			$this->Cell(40,7,"MONTO",1,0,'C');
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
			
			/*/calculamos si los abonos son mayores al apartado
			if($total_abonos['t']<5000){
				$faltante=$total_abonos['t']-5000;
			}elseif($total_abonos['t']==5000){
				$faltante=0;
			}elseif($total_abonos['t']>5000){
				$faltante=$total_abonos['t']-5000;
			}
			
			//asignamos el apartado
			if($faltante<0){
				$apartado=$faltante;
			}elseif($faltante==0){
				$apartado=5000;
			}elseif($faltante>0){
				$apartado=$faltante;
			}			
				$contador=0;
				*/
			if($mostrar['fechas']==''){
				//calculamos la cantidad de pagos a realizar a partir de la fecha de impresion del contrato
				$cantidad_abonos=numero_de_meses(date('Y-m-d'),$mostrar['Fecha']);
			}else{
				////fechas pasadas recalcular pagos
				$hoy=date('Y-m-d');
				$contador=0;
				$fech=explode('%',$mostrar['fechas']);
				$cantidad_abonos=count($fech);
			}
			
			
			
			
			//calculamos el valor de cada abono
			
			$pagos=($total)/$cantidad_abonos;
			
			if($mostrar['fechas']==''){
				//indicamos la siguiente fecha de abono
				$pag="update contrato set mensualidad=".$pagos.", estatus=1, impreso='si',alerta=0,proximo_abono='".$next2."' where Numero='".$_GET['numero']."'";
				$pagg=mysql_query($pag);
				
			}else{
				//indicamos fechas del siguinete abono si contamos con plan de pago

						$pag="update contrato set mensualidad=".$pagos.",estatus=1, impreso='si',alerta=0,proximo_abono='".$fech[0]."' where Numero='".$_GET['numero']."'";
						$pagg=mysql_query($pag);
						$aux=1;
			}
			
			$fecha = date('Y-m-j');
			
				/*/imprimimos primera parte de abonos que es el apartado
			if($faltante<0){
					$this->Ln(7);
					$this->Cell(40,7,"",'C',0,1);
					$this->Cell(40,7,"APARTADO",1,0,'C');
					$this->Cell(40,7,$fecha,1,0,'C');
					$this->Cell(40,7,"$".$total_abonos['t'],1,0,'C');
					$nuevafecha = strtotime ( '+7day' , strtotime ( $fecha ) ) ;
					$fecha=date ( 'Y-m-j' , $nuevafecha );
					$this->Ln(7);
					$this->Cell(40,7,"",'C',0,1);
					$this->Cell(40,7,"FALTANTE APARTADO",1,0,'C');
					$this->Cell(40,7,$fecha,1,0,'C');
					$this->Cell(40,7,"$". $apartado*(-1),1,0,'C');
			}elseif($faltante==0){
					$this->Ln(7);
					$this->Cell(40,7,"",'C',0,1);
					$this->Cell(40,7,"APARTADO",1,0,'C');
					$this->Cell(40,7,$fecha,1,0,'C');
					$this->Cell(40,7,"$".$apartado,1,0,'C');
			}elseif($faltante>0){
					$this->Ln(7);
					$this->Cell(40,7,"",'C',0,1);
					$this->Cell(40,7,"APARTADO",1,0,'C');
					$this->Cell(40,7,$fecha,1,0,'C');
					$this->Cell(40,7,"$5000",1,0,'C');
					$this->Ln(7);
					$this->Cell(40,7,"",'C',0,1);
					$this->Cell(40,7,"EXTRA DE APARTADO",1,0,'C');
					$this->Cell(40,7,$fecha,1,0,'C');
					$this->Cell(40,7,"$".$apartado,1,0,'C');
			}*/
	
			if($mostrar['fechas']==''){
				for($i = 1; $i <= $cantidad_abonos; $i++){
				$nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
				$fecha=date ( 'Y-m-j' , $nuevafecha );
				$this->Ln(7);
				
				if($i==$cantidad_abonos){
					$nuevafecha = strtotime ( '-30day' , strtotime ( $mostrar['Fecha'] ) ) ;
					$fecha=date ( 'Y-m-j' , $nuevafecha );
					$this->Cell(40,7,"",'C',0,1);
					$this->Cell(40,7,"LIQUIDACION",1,0,'C');
					$this->Cell(40,7,$fecha,1,0,'C');
					$this->Cell(40,7,"$".round($pagos,2),1,0,'C');
				}else if($i<$cantidad_abonos){
					$this->Cell(40,7,"",'C',0,1);
					$this->Cell(40,7,$i." ABONO",1,0,'C');
					$this->Cell(40,7,$fecha,1,0,'C');
					$this->Cell(40,7,"$".round($pagos,2),1,0,'C');
				} 
				}
			}else{
				$monto=explode('%',$mostrar['monto']);
				$concepto=explode('%',$mostrar['concepto']);
				for($i=0;$i<$cantidad_abonos-1;$i++){
					$this->Ln(7);
					$this->Cell(40,7,"",'C',0,1);
					$this->Cell(40,7,$concepto[$i],1,0,'C');
					$this->Cell(40,7,$fech[$i],1,0,'C');
					$this->Cell(40,7,"$".$monto[$i],1,0,'C');
				
				}
			}
	
				
			$this->Ln(10);
			$this->MultiCell(0,5,utf8_decode("LOS PAGOS MENCIONADOS DEBERÁN SER EFECTUADOS DIRECTAMENTE EN NUESTRAS OFICINAS,"));
			$c1=utf8_decode("TERCERA.- AMBAS PARTES ESTÁN DE ACUERDO QUE EL COSTO POR LA RENTA DEL SALÓN ".$mostrar['salon']." Y LOS SERVICIOS PRESTADOS DEBERÁ SER PAGADOS DE ACUERDO AL CALENDARIO DE PAGOS ESTIPULADO EN ÉSTE CONTRATO, POR LO CUAL, EN CASO DE QUE EL CLIENTE INCUMPLA CON UN DEPÓSITO, SE DARÁ POR ENTENDIDO QUE EL EVENTO NO SE LLEVARÁ A CABO Y EL PRESTADOR DEL SERVICIO ESTÁ EN TODA LA LIBERTAD DE VENDER LA FECHA QUE FUE APARTADA.");
			$this->Ln(10);
			$this->MultiCell(0,5,strtoupper($c1));
			$c2=utf8_decode("CUARTA.- EL PRESTADOR DEL SERVICIO ENTREGARÁ EL SALÓN ".$mostrar['salon']."  EL DÍA ".cambioFecha($rf)." EN ÓPTIMAS CONDICIONES EN TODAS Y CADA UNA DE SUS INSTALACIONES COMO SON: INSTALACIONES ELÉCTRICAS, DE AGUA, JARDINES Y ÁREAS RECREATIVAS, INCLUYENDO MOBILIARIO Y EQUIPO COMO: MESAS, SILLAS, MANTEL, CUBRE MANTEL, CAMINOS, SERVILLETAS, FUNDAS, MOÑOS, VASOS, COPAS, TARROS, CABALLITOS, PLATOS, SALEROS, CENICEROS, SERVILLETEROS Y CUBIERTOS EN PERFECTO ESTADO, POR LO QUE EL CLIENTE ACEPTA ENTREGAR COMO DEPÓSITO EN GARANTÍA LA CANTIDAD DE: $".$mostrar['deposito']." (".numtoletras($mostrar['deposito'])."), IMPORTE QUE LE SERÁ DEVUELTO 8 (OCHO) DÍAS DESPUÉS DEL EVENTO, UNA VEZ QUE SE REALICE LA INSPECCIÓN DE TODAS LAS INSTALACIONES ASÍ COMO DEL MOBILIARIO Y EQUIPO, POR LO CUAL Y EN CASO DE QUE HUBIESE ALGÚN DETERIORO ÉSTE SE CUBRIRÁ CON ÉSTE DEPÓSITO. SI EL COSTO DE LOS DAÑOS EXCEDIERA EL DEPÓSITO EN GARANTÍA, EL CLIENTE DEBERÁ CUBRIR LOS GASTOS. EN CASO DE NO ACUDIR POR SU DÉPÓSITO EN UN PERÍODO MÁXIMO A 60 (SESENTA) DÍAS, ÉSTE QUEDARÁ EN UN ESTATUS DE CADUCADO Y POR CONSECUENCIA YA NO PODRÁ SER DEVUELTO.");
			$this->Ln(10);
			$this->MultiCell(0,5,strtoupper($c2));
			
			
			
			$clausulas="select * from clausulas";
			$rclausulas=mysql_query($clausulas);
			$numero_filas= mysql_num_rows($rclausulas);
			$num=5;
			
			while($m=mysql_fetch_array($rclausulas)){
				$claus=$m['descripcion'];
				$all="";
				if($claus!=''){
					
						$all=strtoupper(consecutivo($num).($claus));
						$this->Ln(10);
						$this->MultiCell(0,5,utf8_decode(($all)));
						

					$num=$num+1;
				}
			}
			
			}
			function firmas(){
			$consulta="select * from contrato where Numero='".$_GET['numero']."'";

			$resultado=mysql_query($consulta);
			$mostrar=mysql_fetch_array($resultado);
			$this->Ln(30);
			$this->Cell(30,7,"",0,0,'C');
			$this->Cell(40,7,"EL PRESTADOR DEL SERVICIO",0,0,'C');
			$this->Cell(30,7,"",0,0,'C');
			$this->Cell(40,7,"EL CLIENTE",0,0,'C');
			$this->Ln(40);
			$this->Cell(30,7,"",0,0,'C');
			$this->Cell(40,7,utf8_decode("ING. SAÚL MORÁN BELLO"),0,0,'C');
			$this->Cell(30,7,"",0,0,'C');
			$this->Cell(40,7,strtoupper(utf8_decode($mostrar['nombre'])),0,0,'C');
			
			/// CLIENTE
			
			$consu="select * from cliente where id=".$mostrar['id_cliente']."";
			$resu=mysql_query($consu);
			$mostrar6=mysql_fetch_array($resu);
			
			$this->Ln(40);
			$this->MultiCell(0,5,"-----------------");
			$this->MultiCell(0,5,"TELEFONO: ".$mostrar6['tel']);
			$this->MultiCell(0,5,"E-MAIL: ".$mostrar6['mail']);
			
			}
			
			}
			
			$pdf= new PDF();
			$pdf->AliasNbPages();
			$pdf->Addpage();
			$pdf->SetAutoPageBreak(true,40); 
			$pdf->SetFont('Arial','B',7);
			$pdf->contenido();
			$pdf->Addpage();
			$pdf->SetFont('Arial','B',12);
			$pdf->firmas();
			$pdf->Output();	


	?>