<?php
require 'funciones2.php';
conectar();

/*   poner id de cliente en tabla de contrato
for($i=1;$i<160;$i++){
$q="select * from cliente where id=".$i;
$r=mysql_query($q);
$m=mysql_fetch_array($r);
$rfc=$m['rfc'];
$q= "UPDATE contrato set id_cliente=".$i." where rfc='".$rfc."'";
$r=mysql_query($q);
echo "bien";
}
*/

//cambiar estatus a fechas ya pasadas
			$x="select * from contrato";
			$x2=mysql_query($x);
			$fecha = date('Y-m-d');
			while($x3=mysql_fetch_array($x2)){
			if($x3['Fecha']<=$fecha){
				$y="UPDATE contrato set estatus=0 where Numero='".$x3['Numero']."'";
				$yr=mysql_query($y);
				echo $y.";<br>";
			}
			}
	
			

			/*/ ACTUALIZAR LAS MENSUALIDADES
			$x="select * from contrato where estatus=1";
			$x2=mysql_query($x);
			while($x3=mysql_fetch_array($x2)){
			$total=$x3['si'];//o el calculo de la cantidad de personas + iva si es el caso
			if($x3['si']<=5000){
				$pagos=($total)/numero_de_meses(date('y-m-d'),$x3['Fecha']);
			}else{
				$pagos=($total-5000)/numero_de_meses(date('y-m-d'),$x3['Fecha']);
			}
			
			$d="UPDATE contrato set mensualidad=".number_format($pagos,2,'.','')." where Numero='".$x3['Numero']."'";
			$rr=mysql_query($d);
			echo $pagos."<br>";
			$pagos=0;
			}
*/

///Proximo pago
/*
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
*/
				?>