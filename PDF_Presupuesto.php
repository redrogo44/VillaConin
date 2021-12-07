<?php
include "FormularioPDF/fpdf/fpdf.php";
require 'funciones2.php';
conectar();
session_start();
 class PDF extends FPDF
		{
		
		//$_POST['asignatura'] = utf8_decode($_POST['asignatura']);
		
		
	function Header()
			{
			
				$this->SetFont('Arial','','13');				
				$this->Ln(10);
				$this->Cell(40,0,date('d-m-Y'),0,0,'C');		
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
			{$this->SetFont('Arial','','11');
			
				// CONSULTA TABLA CONTRATO
				$cons_q="select * from preregistro where id='".$_GET['numero']."'";
                $consulta=$muestra=mysql_fetch_array(mysql_query($cons_q));						
				$nombre=$muestra['nombre']." ".$muestra['ap']." ".$muestra['am'];
				$fecha=$muestra['fecha'];
				$invitados=$muestra['invitados'];
				$tipo=$muestra['tipo'];
				
				$pre=mysql_fetch_array(mysql_query("select * from presupuesto where id_precliente='".$_GET['numero']."'"));
				
				$this->Ln(5);
				$this->Cell(0,5, 'Presupuesto: '.$nombre, 2, 2, 'L');
				$this->Cell(0,5, 'Tipo de Evento: '.$tipo, 2, 2, 'L');
				$this->Cell(0,5, 'Numero de Invitados: '.$invitados, 2, 2, 'L');
				$this->Cell(0,5, 'Fecha de Evento : '.$fecha, 2, 2, 'L');
				$this->Cell(0,5, 'Precio por Comensal : '."$".number_format($pre["precio"],2,".",","), 2, 2, 'L');
				$this->Ln(5);
                
                
				$arr=$pre['servicios'];
                $comentario=$pre["comentario"];
             
             
				$this->Cell(0,5, 'SERVICIOS ', 2, 2, 'C');
				///  IMPRESION DE TODOS LOS SERVICIOS CON SU DESCRIPCION
				
				////servicios proporcionados desde contrato
				
				////array con los tipos servicos y horas
				$s=explode("%",$arr);
                $s_opcionales[]='';
				$array_auxiliar[]='';$index=0;
                $col1[]='';$col2[]='';$col3[]='';$col4[]='';
				$categorias=mysql_query("select tipo from Servicios group by tipo order by tipo");
				while($cat=mysql_fetch_array($categorias)){
					$services=mysql_query("select * from Servicios where tipo='".$cat['tipo']."'");
                    $name_t=mysql_fetch_array(mysql_query("select * from Servicios_categorias where id=".$cat['tipo']));
					$titulo=$name_t['nombre'];
					while($service=mysql_fetch_array($services)){
						////////recorremos la lista que tenemos de los servicios
						for($i=0;$i<count($s);$i++){
                            ////validamos si tiene servicios opcionales
                            $se_op=explode(",",$s[$i]);
                            if(count($se_op)<=1 || $se_op[1]=='' ){
                                $ss=explode("-",$s[$i]);
                                if($ss[0]==$service['id']){
                                    ////////buscamos la unidad y asignamos las cantidades acordadas 
                                    $add="";
                                    if($service['unidad']=="PIEZA"){
                                        $add=$ss[1]." Pzs";
                                    }elseif($service['unidad']=="HORA"){
                                         $add=$ss[1]." Hrs";
                                    }elseif($service['unidad']=="HORA Y PIEZAS"){
                                        $ex=explode("/",$ss[1]);
                                        $add=$ex[0]." Pzs/".$ex[1]." Hrs";
                                    }else{
                                        $add=$ss[1];
                                    }
                                    //$array_auxiliar[$index]=$service['Servicio']." ".$service['descripcion']." ".$add;
                                    $col1[$index]=$service['Servicio'];
                                    $col2[$index]=$service['descripcion'];
                                    $col3[$index]=$add;																		$col4[$index]=$ss[2];
                                    $index++;
                                }
                            }else{
                                /////obtenemos el servicios principal
                                $add="";
                                    if($service['unidad']=="PIEZA"){
                                        $add=$ss[1]." Pzs";
                                    }elseif($service['unidad']=="HORA"){
                                         $add=$ss[1]." Hrs";
                                    }elseif($service['unidad']=="HORA Y PIEZAS"){
                                        $ex=explode("/",$ss[1]);
                                        $add=$ex[0]." Pzs/".$ex[1]." Hrs";
                                    }else{
                                        $add=$ss[1];
                                    }
                                $col3[$index]=$add;								$col4[$index]=$ss[2];
                                $principal_s=explode("-",$se_op[0]);
                                if($principal_s[0]==$service['id']){
                                    //$array_auxiliar[$index]=$service['Servicio']." ".$service['descripcion'];
                                    $col1[$index]=$service['Servicio'];$col2[$index]=$service['descripcion'];
                                    /////agregamos los revicios restantes
                                    for($o=1;$o<count($se_op);$o++){
                                        $next_op=explode("-",$se_op[$o]);
                                        $nombre_s=mysql_fetch_array(mysql_query("select * from Servicios where id=".$next_op[0]));
                                         //$array_auxiliar[$index]=$array_auxiliar[$index]." O ".$nombre_s['Servicio'];
                                         $col1[$index]=$col1[$index]." O ".$nombre_s['Servicio'];
                                    }
                                    $index++;
                                }
                            }
							
						}
					}
					//////si se encontraron elementos de la categoria se imprime
                    
					if($index>0){
                        $this->SetFont('Arial','','10');
                        $this->Ln(5);
						$this->Cell(0,5,utf8_decode($titulo), 1, 'c');
                        $this->Ln(5);
                        $this->Cell(45,5,Servicio, 1,0, 'c');
                        $this->Cell(120,5,Descripcion, 1,0, 'C');
                        $this->Cell(25,5,Cantidad, 1,0, 'c');                        
                        $this->Ln(5);
                        
						for($i2=0;$i2<count($col1);$i2++){
                            $this->SetFont('Arial','','8');
							//$this->MultiCell(0,5,utf8_decode($array_auxiliar[$i2]));
                            $this->Cell(45,5,utf8_decode($col1[$i2]), 1,0, 'c');
                            if(strlen($col2[$i2])>66){
                                $subcadena=substr($col2[$i2], 0, 70);
                                $this->Cell(120,5,utf8_decode($subcadena."...."), 1,0, 'C');
                            }else{
                                $this->Cell(120,5,utf8_decode($col2[$i2]), 1,0, 'C');
                            }
                            
                            $this->Cell(25,5,utf8_decode($col3[$i2]), 1,1, 'c');                            
							//$this->Cell(20,5,utf8_decode("$".number_format($col4[$i2],2,".",",")), 1,1, 'c');
						}
					}
					////reinicioamos la variable index y el array
					$index=0;
                    unset($col1);
                    unset($col2);
                    unset($col3);                    unset($col4);
				}
             $this->Ln(5);
             $this->Cell(0,5,"OBSERVACIONES", 1, 'c');
             $this->Ln(5);
				
			$com=explode(",",$comentario);
			$ncom="";
			for($ic=0;$ic<count($com);$ic++){
				if($com[$ic]!=''){
					if($ncom==""){
						$ncom="* ".$com[$ic];
					}else{
						$ncom=$ncom."\n* ".$com[$ic];
					}
				}
			}
			$this->MultiCell(0,5,$ncom);
			
			}
			
			
			}
			
			$pdf= new PDF();
			$pdf->AliasNbPages();
			$pdf->Addpage();
			$pdf->SetFont('Arial','B',7);
			$pdf->contenido();
			
			$pdf->Output();	


	?>
