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
				$cons_q="select * from contrato where Numero='".$_GET['numero']."'";
                $consulta=$muestra=mysql_fetch_array(mysql_query($cons_q));						
				$idcliente=$muestra['id_cliente'];
				$tipoevento=utf8_decode($muestra['tipo']);
				$salon=$muestra['salon'];
				$na=$muestra['c_adultos'];
   				$nj=$muestra['c_jovenes'];
   				$nn=$muestra['c_ninos'];
				$pa=$muestra['p_adultos'];
   				$pj=$muestra['p_jovenes'];
   				$pn=$muestra['p_ninos'];
				$fechaevento=$muestra['Fecha'];
				$deposito=$muestra['deposito'];
				$observaciones=$muestra["comentario_H_A"];			
				$festejado=$muestra['festejado'];
				$arr=$muestra['servicios'];
					
					$ninvitados=$na+$nj+$nn;// numero de invitads
					// precio de Cada invitado
					// CNOSULTA TABLA CLIENTE
					$cons="select * from cliente where id='".$idcliente."'";
					$consul=mysql_query($cons);
					while($muestra=mysql_fetch_array($consul))
					{						
					  $nombrecliente=$muestra['nombre']." ".$muestra['ap']." ".$muestra['am'];
					}
					$this->Ln(5);
			
				$this->Cell(0,5, $nombrecliente, 2, 2, 'L');
				$this->Cell(0,5, 'Hoja Anexa del Contrato: '.$_GET['numero'], 2, 2, 'L');
				$this->Cell(0,5, 'Tipo de Evento: '.$tipoevento, 2, 2, 'L');
				$this->Cell(0,5, 'Numero de Invitados: '.$ninvitados, 2, 2, 'L');
				$this->Cell(0,5, 'Fecha de Evento : '.$fechaevento, 2, 2, 'L');
				$this->Cell(0,5, 'Salon: '.$salon, 2, 2, 'L');
				$this->Cell(0,5, 'Nombre del Festejado(s): '.utf8_decode($festejado), 2, 2, 'L');
				$this->Ln(5);
				
				$this->Cell(0,5, 'SERVICIOS ', 2, 2, 'C');
				///  IMPRESION DE TODOS LOS SERVICIOS CON SU DESCRIPCION
				
				////servicios proporcionados desde contrato
				
				////array con los tipos servicos y horas
				$s=explode("%",$arr);
                $s_opcionales[]='';
				$array_auxiliar[]='';$index=0;
                $col1[]='';$col2[]='';$col3[]='';$col_aux[]='';
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
                                    $col3[$index]=$add;
                                    $index++;
                                }
                            }else{
                                /////obtenemos el servicios principal
                                $add="";
								$ss=explode("-",$se_op[0]);
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
                                $col3[$index]=$add;
                                $principal_s=explode("-",$se_op[0]);
                                if($principal_s[0]==$service['id']){
                                    //$array_auxiliar[$index]=$service['Servicio']." ".$service['descripcion'];
                                    $col1[$index]=$service['Servicio'];$col2[$index]=$service['descripcion'];
                                    /////agregamos los revicios restantes
                                    for($o=1;$o<count($se_op);$o++){
										$add="";
                                        $next_op=explode("-",$se_op[$o]);
                                        $nombre_s=mysql_fetch_array(mysql_query("select * from Servicios where id=".$next_op[0]));
                                         //$array_auxiliar[$index]=$array_auxiliar[$index]." O ".$nombre_s['Servicio'];
                                         $col1[$index]=$col1[$index]." # ".$nombre_s['Servicio'];
										 $col2[$index]=$col2[$index]." # ".$nombre_s['descripcion'];
										 if($nombre_s['unidad']=="PIEZA"){
											$add=$next_op[1]." Pzs";
										}elseif($nombre_s['unidad']=="HORA"){
											 $add=$next_op[1]." Hrs";
										}elseif($nombre_s['unidad']=="HORA Y PIEZAS"){
											$ex=explode("/",$next_op[1]);
											$add=$ex[0]." Pzs/".$ex[1]." Hrs";
										}else{
											$add=$next_op[1];
										}
										$col3[$index]=$col3[$index]." # ".$add;
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
							$opc1=explode(" # ",$col1[$i2]);
							$opc2=explode(" # ",$col2[$i2]);
							$opc3=explode(" # ",$col3[$i2]);
							if(count($opc1)==1){
								$this->SetFont('Arial','','8');
								//$this->MultiCell(0,5,utf8_decode($array_auxiliar[$i2]));
								$this->Cell(45,5,utf8_decode($col1[$i2]), 1,0, 'c');
								if(strlen($col2[$i2])>60){
									$subcadena=substr($col2[$i2], 0, 60);
									$this->Cell(120,5,utf8_decode($subcadena."...."), 1,0, 'C');
								}else{
									$this->Cell(120,5,utf8_decode($col2[$i2]), 1,0, 'C');
								}
								$this->Cell(25,5,utf8_decode($col3[$i2]), 1,1, 'c');
							}else{
								for($opc_in=0;$opc_in<count($opc1);$opc_in++){
									$this->SetFont('Arial','','8');
									$this->Cell(45,5,utf8_decode($opc1[$opc_in]), "LR",0, 'c');
									if(strlen($opc2[$opc_in])>60){
										$subcadena=substr($opc2[$opc_in], 0, 60);
										$this->Cell(120,5,utf8_decode($subcadena."...."), "LR",0, 'C');
									}else{
										$this->Cell(120,5,utf8_decode($opc2[$opc_in]), "LR",0, 'C');
									}
									$this->Cell(25,5,utf8_decode($opc3[$opc_in]), "LR",1, 'c');
								}
							}
							
						}
					}
					////reinicioamos la variable index y el array
					$index=0;
                    unset($col1);
                    unset($col2);
                    unset($col3);
				}
             $this->Ln(5);
             $this->Cell(0,5,"OBSERVACIONES", 1, 'c');
             $this->Ln(5);
			 $n_obs="";
			 $arro=explode(",",$observaciones);
			 for($ii=0;$ii<count($arro);$ii++){
				$n_obs=$n_obs.$arro[$ii]."\n";
			 }
			$this->MultiCell(0,5,"Adulos ".$na."($".number_format($pa,2,".",",").")".",Jovenes ".$nj."($".number_format($pj,2,".",",").")".utf8_decode(",Niños ").$nn."($".number_format($pn,2,".",",").")");	
			$this->MultiCell(0,5, utf8_decode($n_obs));	

			}
			
			
			}
			
			$pdf= new PDF();
			$pdf->AliasNbPages();
			$pdf->Addpage();
			$pdf->SetFont('Arial','B',7);
			$pdf->contenido();
			
			$pdf->Output();	


	?>
