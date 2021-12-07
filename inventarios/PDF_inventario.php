<?php
require('fpdf/fpdf.php');
require 'funciones.php';
session_start();
conectar();
header('Content-Type: text/html; charset=utf-8;');

class PDF extends FPDF{
	function Header(){
		/*/ Logo
		$this->Image('logo_pb.png',10,8,33);
		// Arial bold 15*/
		$this->SetFont('Arial','B',15);
		// Movernos a la derecha
		$this->Cell(80);
		// Títuloveedor where id_proveedor=".$datos['id_proveedor']);
		$this->Cell(30,10,"Corte de inventario",0,0,'C');
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
			$query=mysql_query("select * from categoria where id_categoria=".$_GET['categoria']);
			if (!$query){
				die('ERROR AL GENERAR DOCUMENTO: ' . mysql_error());
			}else{
				$datos=mysql_fetch_array($query);
				}
			
			$obtener_fecha=mysql_fetch_array(mysql_query("SELECT max(id_corte_inventario) as m FROM corte_inventario"));
			$obtener_fecha2=mysql_fetch_array(mysql_query("SELECT * FROM corte_inventario where id_corte_inventario=".$obtener_fecha['m']));
			
			$this->Cell(30,5,"ID de categoria",1,0,'C');
			$this->Cell(30,5,"Categoria",1,0,'C');
			$this->Cell(30,5,"Fecha",1,0,'C');
			$this->Ln(5);
			$this->Cell(30,5,$datos['id_categoria'],1,0,'C');
			$this->Cell(30,5,$datos['nombre'],1,0,'C');
			$this->Cell(30,5,$obtener_fecha2['fecha'],1,0,'C');
			$this->Ln(10);
			$gran_total=0;
			$gran_total2=0;
			$total_inventario=0;
			$total_inventario2=0;
			$total_inv_inicial=0;
			$sub=mysql_query("select * from subcategoria where id_categoria=".$_GET['categoria']." order by nombre");
			$num=mysql_num_rows($sub);
			if($num>0){
				while($subcategoria=mysql_fetch_array($sub)){
					$this->Cell(30,5,$subcategoria['nombre'],0,0,'C');
					$this->Ln(5);
					$this->Cell(10,5,"ID",1,0,'C');
					$this->Cell(110,5,"Producto",1,0,'C');
					$this->Cell(15,5,"Costo",1,0,'C');
					if($_GET['categoria']==1){
						$this->Cell(15,5,"Faltantes",1,0,'C');
						$this->Cell(15,5,utf8_decode("Pérdida"),1,0,'C');
					}else{
						$this->Cell(15,5,"Utilizados",1,0,'C');
						$this->Cell(15,5,utf8_decode("$$$$"),1,0,'C');

					}
					$this->Cell(15,5,"Inv Inicial",1,0,'C');
					$this->Cell(15,5,"Inv Actual",1,0,'C');
					$this->Ln(5);
					$texto="select * from producto where id_categoria=".$_GET['categoria']." and id_subcategoria=".$subcategoria['id_subcategoria']." order by nombre";
					$producto=mysql_query("select * from producto where id_categoria=".$_GET['categoria']." and id_subcategoria=".$subcategoria['id_subcategoria']." order by nombre");
					$num2=mysql_num_rows($producto);
					if($num2>0){
						$acumulado=0;
						$acumulado2=0;
						$total_inv1=0;
						$total_inv2=0;
						$t_i_i=0;
						while($mp=mysql_fetch_array($producto)){
							$this->Cell(10,5,$mp['id_producto'],1,0,'C');
							$this->Cell(110,5,utf8_decode($mp['nombre']."(".$mp['descripcion'].")"),1,0,'L');
							$inv=mysql_query("select * from inventario where id_producto=".$mp['id_producto']);
							$inventario=mysql_fetch_array($inv);
							$this->Cell(15,5,'$'.$inventario['precio'],1,0,'C');
							$total_inv1=$total_inv1+$inventario['cantidad'];
							//$total_inv2=$total_inv2+($inventario['cantidad']*$inventario['precio']);
							$corte=mysql_fetch_array(mysql_query("SELECT max(id_corte_inventario) as m FROM corte_inventario ORDER BY id_corte_inventario"));
							$texto2="select * from detalle where id_producto=".$mp['id_producto']." and tipo='faltante' and id=".$corte['m'];
							$detalle=mysql_fetch_array(mysql_query("select * from detalle where id_producto=".$mp['id_producto']." and tipo='faltante' and id=".$corte['m']));
							$this->Cell(15,5,$detalle['cantidad'],1,0,'C');
							$this->Cell(15,5,round(($detalle['cantidad']*$detalle['precio_adquisicion']),5),1,0,'C');
							$this->Cell(15,5,($inventario['cantidad']-$detalle['cantidad']),1,0,'C');
							$acumulado=$acumulado+$detalle['cantidad'];
							$acumulado2=$acumulado2+($detalle['cantidad']*$detalle['precio_adquisicion']);
							$t_i_i=$t_i_i+($inventario['cantidad']-$detalle['cantidad']);
							$this->Cell(15,5,$inventario['cantidad'],1,0,'C');
							$this->Ln(5);
							//$this->Cell(110,5,$texto2,1,0,'L');
							//$this->Ln(5);
						}
						$this->Cell(135,5,'Subtotal',0,0,'R');
						//$this->Cell(15,5,round($total_inv2,5),1,0,'C');
						$this->Cell(15,5,$acumulado,1,0,'C');
						$this->Cell(15,5,round($acumulado2,5),1,0,'C');
						$this->Cell(15,5,round($t_i_i,5),1,0,'C');
						$this->Cell(15,5,$total_inv1,1,0,'C');
						$gran_total=$gran_total+$acumulado;
						$gran_total2=$gran_total2+$acumulado2;
						$total_inventario=$total_inventario+$total_inv1;
						//$total_inventario2=$total_inventario2+$total_inv2;
						$total_inv_inicial=$total_inv_inicial+$t_i_i;
						$this->Ln(10);
					}
				}
			}
			$this->Cell(135,5,'Total',0,0,'R');
			//$this->Cell(15,5,round($total_inventario2,5),1,0,'C');
			$this->Cell(15,5,$gran_total,1,0,'C');
			$this->Cell(15,5,round($gran_total2,5),1,0,'C');
			$this->Cell(15,5,round($total_inv_inicial,5),1,0,'C');
			$this->Cell(15,5,$total_inventario,1,0,'C');
			$this->Ln(10);
			//////////////firmas de autorizacion
				$this->Ln(15);
				$this->Cell(15,5,"",0,0,'C');
				$this->Cell(50,5,utf8_decode("Autorizó"),T,0,'C');
				$this->Cell(60,5,"",0,0,'C');
				$this->Cell(50,5,utf8_decode("Realizó"),T,0,'C');
				$this->Ln(15);
				//$this->Cell(15,5,"",0,0,'C');
				//$this->Cell(15,5,"",0,0,'C');
				//$this->Cell(15,5,"",0,0,'C');
				//$this->Cell(15,5,$texto,0,0,'C');
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