<?php
session_start();
include "../FormularioPDF/fpdf/fpdf.php";
require '../funciones2.php';
conectar();

date_default_timezone_set('utf-8');
class MiPDF extends FPDF
{
	
	
		public function Header()
		{
				$this->Image('../Imagenes/Villa Conin.png' , 160 ,12, 45 , 48,'PNG', '');		
				$this->SetFont('Arial','B',8);
					$this->SetTextColor(0,0,0);	
		}
			function pagina1()
			{$Total_Alimentos=0;
				 $u=mysql_query("SELECT  `registro` FROM tickets WHERE referencia =  '".$_GET['numero']."' GROUP BY  `registro");
				//$ut="SELECT * FROM usuarios WHERE Contrato='".$_GET['numero']."' ";
				//$u=mysql_query($ut);
				while($usr=mysql_fetch_array($u))
				{
								
					 $ti="SELECT * FROM tickets WHERE referencia='".$_GET['numero']."' and registro='".$usr['registro']."' and estatus='ACTIVO' ";
						$tic=mysql_query($ti);
							$total_alimentos=0;
						$this->SetFont('Arial','B',10);
						$this->Cell(160,5,"Lista de Alimentos Vendidos contrato: ".$_GET['numero']." Cajero: ".$usr['registro']  ,0,0,'C');
						$this->Ln(15);
							$this->SetTextColor(45,135,254);	
								$this->Cell(40,5,"Producto",1,0,'C');		
								$this->Cell(40,5,"Descripcion",1,0,'C');		
								$this->Cell(20,5,"Cantidad",1,0,'C');		
								$this->Cell(20,5,"Total",1,0,'C');
								$this->Cell(10,5,"Folio",1,0,'C');
								$this->Ln(5);
								$this->SetFont('Arial','B',8);
							$this->SetTextColor(0,0,0);	
						while($tk=mysql_fetch_array($tic))
						{
							$producto	=explode(',' , $tk['productos']);
							$descripcion=explode("," , $tk['descripciones']);
							$cantidad	=explode(",",$tk["cantidades"]);
							$total		=explode(",","$ ".$tk['totales']);
							//echo count($producto)."<br>";
							for($i=1;$i<count($producto);$i++)
							{
								$this->Cell(40,5,$producto[$i],1,0,'L');		
								$this->Cell(40,5,$descripcion[$i],1,0,'C');		
								$this->Cell(20,5,$cantidad[$i],1,0,'C');		
								$this->Cell(20,5,"$ ".money_format("%i",$total[$i]),1,0,'C');
								$this->Cell(10,5,$tk['folio'],1,0,'C');
								$total_alimentos=$total[$i]+$total_alimentos;
								$this->Ln(5);						
							}
						}
						$this->Cell(100,5,"Total ",1,0,'R');
						$this->Cell(20,5,"$ ".money_format("%i",$total_alimentos),1,0,'C');
						$Total_Alimentos=$total_alimentos+$Total_Alimentos;
						$this->Ln(10);
				}
						$this->Cell(100,5,"Total Alimentos",1,0,'R');
						$this->Cell(20,5,"$ ".money_format("%i",$Total_Alimentos),1,0,'C');	
			}
		function pagina2()
			{										
			$Total_Vinos=0;$total_alimentos=0;
				$u=mysql_query("SELECT  `registro` FROM tickets_vinos WHERE referencia =  '".$_GET['numero']."' GROUP BY  `registro");			
			//$ut="SELECT * FROM usuarios WHERE Contrato='".$_GET['numero']."' ";
				//$u=mysql_query($ut);
				while($usr=mysql_fetch_array($u))
				{
					//				$this->Cell(0,15,"Que rollo",1,0,'C');		
						 $ti="SELECT * FROM tickets_vinos WHERE referencia='".$_GET['numero']."' and registro='".$usr['registro']."' and estatus='ACTIVO' ";
						$tic=mysql_query($ti);
						$total_alimentos=0;
						$this->SetFont('Arial','B',10);
						$this->Cell(120,5,"Lista de Vinos Vendidos contrato: ".$_GET['numero']." Cajero: ".$usr['registro'],0,0,'C');
						$this->Ln(10);
							$this->SetTextColor(45,135,254);	
								$this->Cell(40,5,"Producto",1,0,'C');		
								$this->Cell(40,5,"Descripcion",1,0,'C');		
								$this->Cell(20,5,"Cantidad",1,0,'C');		
								$this->Cell(20,5,"Total",1,0,'C');		
								$this->Cell(10,5,"Folio",1,0,'C');
								$this->Ln(5);
								$this->SetFont('Arial','B',8);
							$this->SetTextColor(0,0,0);	
						while($tk=mysql_fetch_array($tic))
						{
							$producto	=explode(',' , $tk['productos']);
							$descripcion=explode("," , $tk['descripciones']);
							$cantidad	=explode(",",$tk["cantidades"]);
							$total		=explode(",","$ ".$tk['totales']);
							//echo count($producto)."<br>";
							for($i=1;$i<count($producto);$i++)
							{
								$this->Cell(40,5,$producto[$i],1,0,'L');		
								$this->Cell(40,5,$descripcion[$i],1,0,'C');		
								$this->Cell(20,5,$cantidad[$i],1,0,'C');		
								$this->Cell(20,5,"$ ".money_format("%i",$total[$i]),1,0,'C');
								$this->Cell(10,5,$tk['id'],1,0,'C');
								$total_alimentos=$total[$i]+$total_alimentos;
								$this->Ln(5);						
							}
						}
						$this->Cell(100,5,"Total ",1,0,'R');
						$this->Cell(20,5,"$ ".money_format("%i",$total_alimentos),1,0,'C');
						$Total_Vinos=$total_alimentos+$Total_Vinos;
						$this->Ln(10);
				}
				$this->Cell(100,5,"Total Vinos ",1,0,'R');
						$this->Cell(20,5,"$ ".money_format("%i",$Total_Vinos),1,0,'C');

			}
		function pagina3()
		{
			$mv="SELECT MAX(id_venta) AS id_venta FROM venta";
			$uv=mysql_query($mv);
			$venta=mysql_fetch_array($uv);
			
			$entrada=mysql_query("select * from venta where id_venta=".$venta['id_venta']);
			$m_entrada=mysql_fetch_array($entrada);
			$queryi=mysql_query("select * from detalle where id=".$venta['id_venta']." and tipo='venta'");
			
			$this->Ln(20);

			$this->Cell(30,5,"Folio",1,0,'C');
			$this->Cell(30,5,"Fecha",1,0,'C');
			$this->Cell(30,5,"Forma de pago",1,0,'C');
			$this->Ln(5);
			///////////serie
			$this->Cell(30,5,$m_entrada['id_venta'],1,0,'C');
			$this->Cell(30,5,$m_entrada['fecha'],1,0,'C');
			$this->Cell(30,5,$m_entrada['formapago'],1,0,'C');
			$this->Ln(10);
			$this->Cell(20,5,"CANTIDAD",1,0,'C');
			$this->Cell(100,5,"PRODUCTO",1,0,'C');
			$this->Cell(15,5,"PRECIO",1,0,'C');
			$this->Cell(15,5,"IMPORTE",1,0,'C');	
			$this->Ln(5);
			/////////////////////listado de productos
			$total=0;
			$cant_prod=0;////////acumulado de productos
			while($producto=mysql_fetch_array($queryi)){
				$p=mysql_query("select * from producto where id_producto=".$producto['id_producto']);
				$p2=mysql_fetch_array($p);
				$this->Cell(20,5,$producto['cantidad'],1,0,'C');
				$cant_prod=$cant_prod+$producto['cantidad'];
				$this->Cell(100,5,utf8_decode($p2['nombre'].'('.$p2['descripcion'].')'),1,0,'C');
				$this->Cell(15,5,'$'.$producto['precio_venta'],1,0,'C');
				$importe=$producto['cantidad']*$producto['precio_venta'];
				$total=$total+$importe;
				$this->Cell(15,5,"$".$importe,1,0,'C');
				$this->Ln(5);
			}
				$this->Cell(20,5,$cant_prod,0,0,'C');
				$this->Cell(100,5,'',0,0,'R');
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
		
		}
function pagina4()
		{$total_cancelado=0;$total_alimentos=0;
				$u=mysql_query("SELECT  `registro` FROM tickets WHERE referencia =  '".$_GET['numero']."' GROUP BY  `registro");			
			//$ut="SELECT * FROM usuarios WHERE Contrato='".$_GET['numero']."' ";
				//$u=mysql_query($ut);
				while($usr=mysql_fetch_array($u))
				{
					 $ti="SELECT * FROM tickets WHERE referencia='".$_GET['numero']."' and registro='".$usr['registro']."' and estatus='CANCELADO' ";
						$tic=mysql_query($ti);
						$total_alimentos=0;
						$this->SetFont('Arial','B',10);
						$this->Cell(160,5,"Lista de Alimentos Cancelados contrato: ".$_GET['numero']." Cajero: ".$usr['registro'],0,0,'C');
						$this->Ln(10);
							$this->SetTextColor(45,135,254);	
								$this->Cell(40,5,"Producto",1,0,'C');		
								$this->Cell(40,5,"Descripcion",1,0,'C');		
								$this->Cell(20,5,"Cantidad",1,0,'C');		
								$this->Cell(20,5,"Total",1,0,'C');		
								$this->Cell(10,5,"Folio",1,0,'C');
								$this->Ln(5);
								$this->SetFont('Arial','B',8);
							$this->SetTextColor(0,0,0);	
						while($tk=mysql_fetch_array($tic))
						{
							$producto	=explode(',' , $tk['productos']);
							$descripcion=explode("," , $tk['descripciones']);
							$cantidad	=explode(",",$tk["cantidades"]);
							
							$total		=explode(",","$ ".$tk['totales']);
							//echo count($producto)."<br>";
							for($i=1;$i<count($producto);$i++)
							{
								$this->Cell(40,5,$producto[$i],1,0,'L');		
								$this->Cell(40,5,$descripcion[$i],1,0,'C');		
								$this->Cell(20,5,$cantidad[$i],1,0,'C');		
								$this->Cell(20,5,"$ ".money_format("%i",$total[$i]),1,0,'C');
								$this->Cell(10,5,$tk['id'],1,0,'C');
								$total_alimentos=$total[$i]+$total_alimentos;
								$this->Ln(5);						
							}
						}
						$this->Cell(100,5,"Total ",1,0,'R');
						$this->Cell(20,5,"$ ".money_format("%i",$total_alimentos),1,0,'C');
		
						$this->Ln(30);
					//$this->Cell(0,15,"LISTADO DE VINOS CANCELADOS",1,0,'C');		
						 $ti="SELECT * FROM tickets_vinos WHERE referencia='".$_GET['numero']."' and estatus='CANCELADO'";
						$tic=mysql_query($ti);
						$total_alimentos=0;
						$this->SetFont('Arial','B',10);
						$this->Cell(150,5,"Lista de Vinos Cancelados contrato: ".$_GET['numero']." Cajero: ".$usr['registro'],0,0,'C');
						$this->Ln(10);
							$this->SetTextColor(45,135,254);	
								$this->Cell(40,5,"Producto",1,0,'C');		
								$this->Cell(40,5,"Descripcion",1,0,'C');		
								$this->Cell(20,5,"Cantidad",1,0,'C');		
								$this->Cell(20,5,"Total",1,0,'C');		
									$this->Cell(10,5,"Folio",1,0,'C');
								$this->Ln(5);
								$this->SetFont('Arial','B',8);
							$this->SetTextColor(0,0,0);	
						while($tk=mysql_fetch_array($tic))
						{
							$producto	=explode(',' , $tk['productos']);
							$descripcion=explode("," , $tk['descripciones']);
							$cantidad	=explode(",",$tk["cantidades"]);
							$total		=explode(",","$ ".$tk['totales']);
							//echo count($producto)."<br>";
							for($i=1;$i<count($producto);$i++)
							{
								$this->Cell(40,5,$producto[$i],1,0,'L');		
								$this->Cell(40,5,$descripcion[$i],1,0,'C');		
								$this->Cell(20,5,$cantidad[$i],1,0,'C');		
								$this->Cell(20,5,"$ ".money_format("%i",$total[$i]),1,0,'C');
									$this->Cell(10,5,$tk['id'],1,0,'C');
								$total_alimentos=$total[$i]+$total_alimentos;
								$this->Ln(5);						
							}
						}
						$this->Cell(100,5,"Total ",1,0,'R');
						$this->Cell(20,5,"$ ".money_format("%i",$total_alimentos),1,0,'C');
						$total_cancelado=$total_cancelado+$total_alimentos;
						$this->Ln(10);
				}
			$this->Cell(100,5,"Total Cancelado",1,0,'R');
						$this->Cell(20,5,"$ ".money_format("%i",$total_cancelado),1,0,'C');
		}
	function Footer()
	{
	
	}
	
}

// Creación del objeto de la clase heredada

$pdf = new MiPDF();	

$pdf->addPage();
$pdf->pagina1();
$pdf->addPage();
$pdf->pagina2();
$pdf->addPage();
$pdf->pagina3();
$pdf->addPage();
$pdf->pagina4();
$pdf->Output();



?>
