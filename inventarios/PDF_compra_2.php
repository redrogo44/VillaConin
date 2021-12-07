<?php
require('fpdf/fpdf.php');
require 'funciones.php';
session_start();
$_GET['folio']='118';///folio de la compra sin la letra
$_GET['type']='si';///si->facturado no->no facturado$_GET['cancelacion']=1; ///1->CANCELADO XXX->NO CANCELADO
//error_reporting(0);
conectar();
header('Content-Type: text/html; charset=utf-8;');

class PDF extends FPDF{
	function Header(){						///////////////cancelacion			if($_GET['cancelacion']==1){				$this->Image('imagenes/cancelado.png' , 40 ,40, 120 , 70);				if($_GET['type']=='si'){				//$insert=mysql_query("insert into cancelacion(id,tipo,fecha) values(".$_GET['folio'].",'comprafac','".date('Y-m-d')."')");				//$update=mysql_query("update detalle set tipo='comprafac-cancelada' where id=".$_GET['folio']." and tipo='comprafac'");			}else{				//$insert=mysql_query("insert into cancelacion(id,tipo,fecha) values(".$_GET['folio'].",'compra','".date('Y-m-d')."')");				//$update=mysql_query("update detalle set tipo='compra-cancelada' where id=".$_GET['folio']." and tipo='compra'");			}			}						
		if(isset($_GET['folio'])&&!empty($_GET['folio'])){
			if($_GET['type']=='si'){
				$query=mysql_query("select * from comprafac where id_compra=".$_GET['folio']);
			}else{
				$query=mysql_query("select * from compra where id_compra=".$_GET['folio']);
			}
			if (!$query){
				die('ERROR AL GENERAR DOCUMENTO: ' . mysql_error());
			}else{
				$datos=mysql_fetch_array($query);
				}
			}else{
				die('ERROR AL GENERAR DOCUMENTO variable: ' . mysql_error());
			}
		/*/ Logo
		$this->Image('logo_pb.png',10,8,33);
		// Arial bold 15*/			
		$this->SetFont('Arial','B',15);
		// Movernos a la derecha
		$this->Cell(80);		
		// Título
		$prov=mysql_query('SELECT * FROM proveedor WHERE id_proveedor='.$datos['id_proveedor']);
		$proveedor=mysql_fetch_array($prov);
		$this->Cell(30,10,$proveedor['nombre'],0,0,'C');
		// Salto de línea
		$this->Ln(20);
		}
	function Footer(){
		 // Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Número de página
		$this->Cell(0,10,'Pagina'.$this->PageNo().'/{nb}',0,0,'C');
		$this->Cell(0,10,'F.I.'.date('Y-m-d'),0,0,'R');
		}
	function cuerpo(){
			if(isset($_GET['folio'])&&!empty($_GET['folio'])){
			if($_GET['type']=='si'){
				$queryi=mysql_query("select * from comprafac where id_compra=".$_GET['folio']);
			}else{
				$queryi=mysql_query("select * from compra where id_compra=".$_GET['folio']);
			}
			if (!$queryi){
				die('ERROR AL GENERAR DOCUMENTO: ' . mysql_error());
			}else{
				$datos=mysql_fetch_array($queryi);
				}
			}else{
				die('ERROR AL GENERAR DOCUMENTO variable: ' . mysql_error());
			}

			$this->Cell(30,5,"Folio",1,0,'C');
			$this->Cell(30,5,"Fecha de compra",1,0,'C');
			$this->Cell(30,5,"Forma de pago",1,0,'C');
			$this->Ln(5);
			///////////serie
			if($_GET['type']=='si'){
				$this->Cell(30,5,'A'.$datos['id_compra'],1,0,'C');
			}else{
				$this->Cell(30,5,'B'.$datos['id_compra'],1,0,'C');
			}
			$this->Cell(30,5,$datos['fecha'],1,0,'C');
			$this->Cell(30,5,$datos['formapago'],1,0,'C');
			$this->Ln(10);
			$this->Cell(20,5,"cantidad",1,0,'C');
			$this->Cell(130,5,"producto",1,0,'C');
			$this->Cell(15,5,"precio",1,0,'C');
			$this->Cell(15,5,"importe",1,0,'C');
			$this->Ln(5);
			/////////////////////listado de productos
			$impuesto_implicito=0;
			if($_GET['type']=='si'){
				$produc=mysql_query("select * from detalle where id=".$_GET['folio']." and tipo='comprafac'");
			}else{
				$produc=mysql_query("select * from detalle where id=".$_GET['folio']." and tipo='compra'");
			}
			while($producto=mysql_fetch_array($produc)){
				$p=mysql_query("select * from producto where id_producto=".$producto['id_producto']);
				$p2=mysql_fetch_array($p);
				$this->Cell(20,5,$producto['cantidad'],1,0,'C');
				$this->Cell(130,5,utf8_decode($p2['nombre'].'('.$p2['descripcion'].')'),1,0,'L');
				$this->Cell(15,5,'$'.$producto['precio_adquisicion'],1,0,'C');
				$importe=$producto['cantidad']*$producto['precio_adquisicion'];
				$importe_total=$importe_total+$importe;
				$impuesto_implicito=$impuesto_implicito+($importe*($p2['impuesto']/100));
				$this->Cell(15,5,"$".$importe,1,0,'C');
				$this->Ln(5);
			}
				/*if($_GET['type']=='si'){
					$importe=mysql_query("select sum(importe)as t from detalle where id=".$datos['id_compra']." and tipo='comprafac'");
				}else{
					$importe=mysql_query("select sum(importe)as t from detalle where id=".$datos['id_compra']." and tipo='compra'");
				}
				*/
				//$importe2=mysql_fetch_array($importe);
				$this->Cell(150,5,'',0,0,'R');
				$this->Cell(15,5,'Subtotal',1,0,'R');
				$this->Cell(15,5,"$".round($importe_total,5),1,0,'C');
				$this->Cell(150,5,'',0,0,'R');
				$this->Ln(5);
				$this->Cell(150,5,'',0,0,'R');
				$this->Cell(15,5,'Impuesto',1,0,'R');
				$this->Cell(15,5,"$".round($impuesto_implicito,5),1,0,'C');
				$this->Ln(5);
				$this->Cell(150,5,'',0,0,'R');
				$this->Cell(15,5,'Descuento',1,0,'R');
				$this->Cell(15,5,"$".round($datos['descuento'],5),1,0,'C');
				$this->Cell(150,5,'',0,0,'R');
				$this->Ln(5);
				$this->Cell(150,5,'',0,0,'R');
				$this->Cell(15,5,'Ajuste',1,0,'R');
				$this->Cell(15,5,"$".round($datos['iva'],5),1,0,'C');
				$this->Ln(5);
				$this->Cell(150,5,'',0,0,'R');
				$this->Cell(15,5,'Total',1,0,'R');
				$t=$importe_total-$datos['descuento']+$datos['iva']+$impuesto_implicito;
				$this->Cell(15,5,"$".round($t,5),1,0,'C');
				//////////////firmas de autorizacion
				$this->Ln(25);
				$this->Cell(15,5,"",0,0,'C');
				$this->Cell(50,5,utf8_decode("Autorizó"),T,0,'C');
				$this->Cell(60,5,"",0,0,'C');
				$this->Cell(50,5,utf8_decode("Realizó"),T,0,'C');
				

		}
	}
	
	
$pdf= new PDF();
$pdf->AliasNbPages();
$pdf->Addpage();
$pdf->SetAutoPageBreak(true,35); 
$pdf->SetFont('Arial','B',7);
$pdf->cuerpo();
$pdf->Output();	
?>