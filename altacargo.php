<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
session_start();
require 'funciones2.php';
validarsesion();	
$nivel=$_SESSION['niv'];
/*
if($nivel==0)
{
menunivel0();				
}
if($nivel==1)
{
menunivel1();				
}
if($nivel==2) 
{
menunivel2();
}
if($nivel==3)
{
menunivel3();
}
if($nivel==4)
{
menunivel4();
}
*/
?>
<!--meta http-equiv="refresh" content="0; url=http:index.php" /-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alta cargo</title>

<script>
function cargar() {
	window.open("NotaRemsionCargo.php");
    <?php
        if($_GET['red']=='logistica'){
             echo 'window.location="NuevaLogistica.php?numero='.$_GET['contrato'].'";'; 
        }else if($_POST['red']=='logistica'){
            echo 'window.location="NuevaLogistica.php?numero='.$_POST['contrato'].'";';
        }else{
            echo 'window.location="index.php";';
        }
    ?>
	
}
</script>

<?php
conectar();
//VALIDAR SI ES SUB-CONTRATO
print_r($_GET);
//


$Contrato=explode("-",$_POST['contrato']);
echo $Contrato[0];
echo $Contrato[1];
	
		echo $nom = $_POST["contrato"]; 

						$esfacturado="select * from contrato Where Numero='".$nom."'";
							$r2=mysql_query($esfacturado) or die(mysql_error());
							$factu=mysql_fetch_array($r2);
							$esfac=$factu['facturado'];
							$cadultos=$factu['c_adultos'];
							$cjovenes=$factu['c_jovenes'];
							$cninos=$factu['c_ninos'];
							$padultos=$factu['p_adultos'];
							$pjovenes=$factu['p_jovenes'];
							$pninos=$factu['p_ninos'];
												
							
							$_SESSION['facturado']=$esfac;
							
							
							$ServiciosA=$factu['ServiciosAdicionales'];		
							$menu = explode(",", $ServiciosA);
							
							
							if(isset($_GET['servicios']) && !empty($_GET['servicios']))// si el cargo es de tipo servicio
							{
								/////obtenemos la informacion actual del contrato

								$contrato=mysql_fetch_array(mysql_query("select * from contrato where Numero='".$_GET['contrato']."'"));
								$esfac=$contrato["facturado"];
								/////////formamos la cadena de descripcion del cargo
								$arr=explode(";",$_GET['servicios']);
								$descripcion='';
								$total=0;
								for($i=0;$i<count($arr);$i++){
									$datos=explode(",",$arr[$i]);
									$service=mysql_fetch_array(mysql_query("select * from Servicios where id=".$datos[0]));
                                    $UNITY='';
                                        if($service['unidad']=='HORA'){
                                             $UNITY=" hrs";
                                        }else if($service['unidad']=='PIEZA'){
                                            $UNITY=" pzas";
                                        }else if($service['unidad']=='HORA Y PIEZAS'){
                                            
                                        }else{
                                            $UNITY=$service['unidad'];
                                        }
                                    
                                   
                                    
                                    //////////varficamos unidad
                                    if(is_numeric($datos[1]) || $service['unidad']=='HORA Y PIEZAS' ){
                                        if($service['unidad']=='HORA Y PIEZAS'){
                                            $ex=explode("/",$datos[1]);
                                            $extra="";$varx=0;
                                            if(!$ex[0]=="0"){
                                                $varx=$ex[0];
                                                $extra=$ex[0]." pzas.";
                                            }else{
                                                $varx=$ex[1];
                                                $extra=$ex[1]." hrs.";
                                            }
                                            $descripcion=$descripcion.$service['Servicio']." ".$extra.",";
                                            ///////////validamos si se cambio el costo del servicio
                                            $_SESSION["Des".$i] = $service['Servicio']." ".$extra;
                                            $_SESSION["Pre".$i] = $varx*$datos[2];
                                            $total=$total+($varx*$datos[2]);
                                        }else{
                                             $descripcion=$descripcion.$service['Servicio']." ".$datos[1].$UNITY.",";
                                            ///////////validamos si se cambio el costo del servicio
                                            $_SESSION["Des".$i] = $service['Servicio']." ".$datos[1].$UNITY;
                                            $_SESSION["Pre".$i] = $datos[1]*$datos[2];
                                            $total=$total+($datos[1]*$datos[2]);
                                        }
                                        /*if($datos[2]!=''){
                                            $_SESSION["Pre".$i] = $datos[1]*$datos[2];
									        $total=$total+($datos[1]*$datos[2]);
                                        }else{
                                             $_SESSION["Pre".$i] = $datos[1]*$service['precio'];
                                            $total=$total+($datos[1]*$service['precio']);
                                        }*/
                                    }else if($datos[1]!=""){
                                        
                                         $descripcion=$descripcion.$service['Servicio'].",";
                                        $_SESSION["Des".$i] = $service['descripcion'];
                                        $_SESSION["Pre".$i] = $datos[2];
									    $total=$total+$datos[2]; 
                                        /*if($datos[2]!=''){
                                            $_SESSION["Pre".$i] = $datos[2];
									        $total=$total+$datos[2];
                                        }else{
                                             $_SESSION["Pre".$i] = $service['precio'];
                                            $total=$total+$service['precio'];
                                        }*/
                                    }
								}  
								
								/////////insertamos el cargo en su repectiva tabla
								if($esfac=='si'){
									$cargo="insert into cargofac (numcontrato,cantidad,concepto,fecha,tipo) values('".$_GET['contrato']."',".$total.",'".$descripcion."','".date('Y-m-d')."','Servicio')";
								}else{
									$cargo="insert into cargo (numcontrato,cantidad,concepto,fecha,tipo) values('".$_GET['contrato']."',".$total.",'".$descripcion."','".date('Y-m-d')."','Servicio')";
								}
								///ejecutamos la insercion
								mysql_query($cargo);
								
								/////////////////insertamos en servicios adicionales tabla contrato la referencia de cargo mas su descripcion								
								////contatenamos los nuevos servicio a servicio adicionales con ta siguiente estructura #id_cargo,(id_servico,horas,precio)*n ;
								 
								///obtenemos el id
								
								if($esfac=='si'){
									$cargo_id="select max(id) as i from cargofac";
								}else{
									$cargo_id="select max(id) as i from cargo";
								}
								
								$id_c=mysql_fetch_array(mysql_query($cargo_id));
								///////////construimos la actualizacion de servicios adicionale
								
								$serv_adic=$contrato['ServiciosAdicionales'].$id_c['i']."_".$_GET['servicios']."#";
								///actualizamos
								$saldo_actual=$contrato['sa']+$total;
								mysql_query("update contrato set sa=".$saldo_actual.",ServiciosAdicionales='".$serv_adic."' where Numero='".$_GET['contrato']."'");
								$_SESSION['facturado']=$esfac;
								$_SESSION['tipo']="servicio";	
								//////////actualizamos saldo actual
								//			echo 	$_GET['servicios'];
								
								
								
								
								
								
								
							}if ($_POST['tipo']=="Comensales"){
								
								echo $nom = $_POST["contrato"]; 
								echo$total=$_POST['c_adultos']*$_POST['p_adultos']+$_POST['c_ninos']*$_POST['p_ninos']+$_POST['c_jovenes']*$_POST['p_jovenes'];
								echo $con= "Total de Adultos = ".$_POST['c_adultos']." Precio = ".$_POST['p_adultos']." Total = $ ".$_POST['c_adultos']*$_POST['p_adultos'].","
								."Total de Jovenes = ".$_POST['c_jovenes']." Precio = ".$_POST['p_jovenes']." Total = $ ".$_POST['c_jovenes']*$_POST['p_jovenes'].","
								."Total de Niños = ".$_POST['c_ninos']." Precio = ".$_POST['p_ninos']." Total = $ ".$_POST['c_ninos']*$_POST['p_ninos'].",";
								
								
								
								if($esfac=='si')// si el contrato es Facturado
								{
									$cadultos=$cadultos+$_POST['c_adultos'];
									$cjovenes=$cjovenes+$_POST['c_jovenes'];
									$cninos=$cninos+$_POST['c_ninos'];
									//echo $upcontra="UPDATE `contrato` SET `c_adultos`=".$cadultos.",`c_jovenes`=".$cjovenes.",`c_ninos`=".$cninos." WHERE Numero='".$nom."';";
									// mysql_query($upcontra) or die (mysql_error());
									
									$insertar=mysql_query("INSERT INTO cargofac(numcontrato,cantidad,concepto,fecha,tipo)   VALUES ('".$nom."',".$total.",'".$con."','".date("Y-m-d")."','".$_POST['tipo']."')");									$cons_q="select * from contrato where Numero='".$nom."'";
									$consulta=mysql_query($cons_q);
									while($can=mysql_fetch_array($consulta))
										{
											$cantidad=$can['sa']+$total;
										}
									$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$nom."'");
									// CONTRATO SUB-CONTRATOS
									if(count($Contrato)>1 )
									{
										$cons_q="select * from contrato where Numero='".$Contrato[0]."'";
										$consulta=mysql_query($cons_q);
										$can=mysql_fetch_array($consulta);
										$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$Contrato[0]."'");
										
										// COMENZALES
									$cadu=$_POST['c_adultos']+$can['c_adultos'];
									$cjov=$_POST['c_jovenes']+$can['c_jovenes'];
									$cnin=$_POST['c_ninos']+$can['c_ninos'];
											//mysql_query("UPDATE `contrato` SET `c_adultos`=".$cadu.",`c_jovenes`=".$cjov.",`c_ninos`=".$cnin." WHERE Numero='".$Contrato[0]."';");
								
										
										
									}
									/////////////////////////7
									if (!$insertar) 
										{ 
											die("datos no insertados: " . mysql_error()); 
										}
										$_SESSION['facturado']="si";
										
								}
							  
							   else
							   {
								   $cadultos=$cadultos+$_POST['c_adultos'];
									$cjovenes=$cjovenes+$_POST['c_jovenes'];
									$cninos=$cninos+$_POST['c_ninos'];
									//echo $upcontra="UPDATE `contrato` SET `c_adultos`=".$cadultos.",`c_jovenes`=".$cjovenes.",`c_ninos`=".$cninos." WHERE Numero='".$nom."';";
									 //mysql_query($upcontra) or die (mysql_error());
									

									$insertar=mysql_query("INSERT INTO cargo(numcontrato,cantidad,concepto,fecha,tipo)   VALUES ('".$nom."',".$total.",'".$con."','".date("Y-m-d")."','".$_POST['tipo']."')");			
									$cons_q="select * from contrato where Numero='".$nom."'";
									$consulta=mysql_query($cons_q);
									while($can=mysql_fetch_array($consulta)){
										$cantidad=$can['sa']+$total;
										}
									$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$nom."'");
									// CONTRATO SUB-CONTRATOS
									if(count($Contrato)>1 )
									{
										$cons_q="select * from contrato where Numero='".$Contrato[0]."'";
										$consulta=mysql_query($cons_q);
										$can=mysql_fetch_array($consulta);
										$actualizar=mysql_query("UPDATE contrato SET sa=".$cantidad." WHERE Numero='".$Contrato[0]."'");
											
										// COMENZALES
									$cadu=$_POST['c_adultos']+$can['c_adultos'];
									$cjov=$_POST['c_jovenes']+$can['c_jovenes'];
									$cnin=$_POST['c_ninos']+$can['c_ninos'];
										//mysql_query("UPDATE `contrato` SET `c_adultos`=".$cadu.",`c_jovenes`=".$cjov.",`c_ninos`=".$cnin." WHERE Numero='".$Contrato[0]."';");
								
										
									}
									/////////////////////////7
									if (!$insertar) 
									{ 
										die("datos no insertados: " . mysql_error()); 
							  		}
									$_SESSION['facturado']=$esfac;
								}
								
								$_SESSION['tipo']="comensales";
				
							}	
							
							
							


?>
</head> 
<body onload="cargar()">
</body>
</html>