<?php
require('fpdf/fpdf.php');
require 'funciones.php';
session_start();
conectar();
header('Content-Type: text/html; charset=utf-8;');

class PDF extends FPDF{
	function Header(){
		///////////////cancelacion
			if($_GET['cancelacion']==1){
				$this->Image('imagenes/cancelado.png' , 40 ,40, 120 , 70);
			}
		/*/ Logo
		$this->Image('logo_pb.png',10,8,33);
		// Arial bold 15*/
		$this->SetFont('Arial','B',15);
		// Movernos a la derecha
		$this->Cell(80);
		// Título
		$this->Cell(30,10,"Venta",0,0,'C');
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
			$entrada=mysql_query("select * from venta where id_venta=".$_GET['folio']);
			$m_entrada=mysql_fetch_array($entrada);
			$queryi=mysql_query("select * from detalle where id=".$_GET['folio']." and tipo='venta'");
			}else{
				die('ERROR AL GENERAR DOCUMENTO variable: ' . mysql_error());
			}

			$this->Cell(30,5,"Folio",1,0,'C');
			$this->Cell(30,5,"Fecha",1,0,'C');
			$this->Cell(30,5,"Forma de pago",1,0,'C');
			$this->Ln(5);
			///////////serie
			$this->Cell(30,5,$m_entrada['id_venta'],1,0,'C');
			$this->Cell(30,5,$m_entrada['fecha'],1,0,'C');
			$this->Cell(30,5,$m_entrada['formapago'],1,0,'C');
			$this->Ln(10);
			$this->Cell(20,5,"cantidad",1,0,'C');
			$this->Cell(130,5,"producto",1,0,'C');
			$this->Cell(15,5,"precio",1,0,'C');
			$this->Cell(15,5,"importe",1,0,'C');	
			$this->Ln(5);
			/////////////////////listado de productos
			$total=0;
			$cant_prod=0;////////acumulado de productos
			while($producto=mysql_fetch_array($queryi)){
				$p=mysql_query("select * from producto where id_producto=".$producto['id_producto']);
				$p2=mysql_fetch_array($p);
				$superCategoria=mysql_fetch_array(mysql_query("select * from categoria where id_categoria=".$p2["id_categoria"]));
				$this->Cell(20,5,$producto['cantidad'],1,0,'C');
				$cant_prod=$cant_prod+$producto['cantidad'];
				$this->Cell(110,5,utf8_decode($p2['nombre'].'('.$p2['descripcion'].')'),1,0,'C');
				$this->Cell(20,5,utf8_decode($superCategoria['tipo']),1,0,'L');
				$this->Cell(15,5,'$'.$producto['precio_venta'],1,0,'C');
				$importe=$producto['cantidad']*$producto['precio_venta'];
				$total=$total+$importe;
				$this->Cell(15,5,"$".$importe,1,0,'C');
				$this->Ln(5);
			}
				$this->Cell(20,5,$cant_prod,0,0,'C');
				$this->Cell(130,5,'',0,0,'R');
				$this->Cell(15,5,'Total',1,0,'R');
				$this->Cell(15,5,"$".$total,1,0,'C');
				$this->Cell(150,5,'',0,0,'R');
				$this->Ln(5);
				//////////////firmas de autorizacion
				$this->Ln(25);
				$this->Cell(15,5,"",0,0,'C');
				$this->Cell(50,5,utf8_decode("Autorizó"),T,0,'C');
				$this->Cell(60,5,"",0,0,'C');
				$this->Cell(50,5,utf8_decode("Realizó"),T,0,'C');
			///////////////cancelacion
			if($_GET['cancelacion']==1){
				//$this->Image('imagenes/cancelado.png' , 40 ,40, 120 , 70);
				///validacion del registro
				$VR=mysql_query("select * from cancelacion where id=".$_GET["folio"]." and tipo='".$_GET['tabla']."'");
				if(mysql_num_rows($VR)==0){
					$insert=mysql_query("insert into cancelacion(id,tipo,fecha) values(".$_GET['folio'].",'".$_GET['tabla']."','".date('Y-m-d')."')");
					$update=mysql_query("update detalle set tipo='".$_GET['tabla']."-cancelada' where id=".$_GET['folio']." and tipo='".$_GET['tabla']."'");	
				}
				
			}
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