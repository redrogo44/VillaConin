<?
session_start();
include "../FormularioPDF/fpdf/fpdf.php";
require '../funciones2.php';
conectar();
$q2="SELECT * from contrato where Numero='".$_GET['Numero']."'";
$r2=mysql_query($q2);
if(mysql_num_rows($r2)>0)
{
	$muestra2=mysql_fetch_array($r2);
}
else
{
	$q3="SELECT * from Eventos_Adicionales where Numero='".$_GET['numero']."'";	
	$q33=mysql_query($q3);
	$muestra2=mysql_fetch_array($q33);
}

$NumeroContrato=$muestra2['Numero'];						   
$fechaactual= getdate('Y-M-D');
$salon=$muestra2['salon'];
$Tipo=$muestra2['tipo'];
$fechaevento=$muestra2['Fecha'];
$adultos=$muestra2['c_adultos'];
$jovenes=$muestra2['c_jovenes'];
$ninos=$muestra2['c_ninos'];
//$Comensales=total_comensales($NumeroContrato,$muestra2['facturado'])+$Comensales;							
$extras=total_comensales($NumeroContrato,$muestra2['facturado']);
$Comensales=$adultos+$jovenes+$ninos+$extras[0]+$extras[1]+$extras[2];
$Meser=$muestra2['Meseros'];																				
$Meseros=explode(",", $Meser);
?>
<html>
<head>
<title>Compra <? echo $_GET["Numero"];?></title>
	<style>
		b{
			font-size: 8px;
		}
		h2{
			font-size: 12px
		}
		i{
			font-size: 8px;
		}
		th{
			font-size: 12px;
		}
	</style>
</head>
<body onload="window.print();">
	<div id="content">
		<center>
			<h2>Eventos Sociales Villa Conin S.A. de C.V.</h2>
			<table border="0" >
				<tr>
					<td>
					<b>
						ORDEN DE COMPRA CONTRATO: <?php echo $_GET["Numero"];?> <br>
						CONTRATO No. <?php echo $_GET["Numero"];?> <br>
						CANTIDAD DE COMENSALES: <?php echo $Comensales;?> <br>
						SALON: <?php echo $salon;?> <br>
						TIPO DE EVENTO: <?php echo utf8_decode($Tipo);?> <br>
						FECHA DE EVENTO: <?php echo $fechaevento;?><br>
						SEMANA : # <?php echo date(W);?><br>
					</b>
					</td>
					<td>
						<img src="../Imagenes/Villa Conin.png" width="30%" style="float:right;">
					</td>
				</tr>
			</table>
			<h2>Lista de Platillos</h2>
			
			<?php
				$ORDEN=OrdenaMeseros();
				$q2="SELECT * from contrato where Numero='".$_GET['numero']."'";
				$r2=mysql_query($q2);
				if(mysql_num_rows($r2)>0)
				{
					$muestra2=mysql_fetch_array($r2);
				}
				else
				{
					$q3="SELECT * from Eventos_Adicionales where Numero='".$_GET['numero']."'";	
					$q33=mysql_query($q3);
					$muestra2=mysql_fetch_array($q33);
				}
				
			
				//////ordernarlo como aparece en  logistica
				
				$log=mysql_query("select * from logistica_menu where contrato='".$_GET['Numero']."'");
				while($logistica=mysql_fetch_array($log)){
					echo "<table border='1'>";
					$menu=explode("%",$logistica["menu"]);
					
					echo "<th colspan='5' align='center'>".$logistica['titulo']." # de Comensales: <font color='#F00'><b>".$logistica['cantidad']."</b></font></th>";
					for($ii=0;$ii<count($menu);$ii++){
						$pm=mysql_query("SELECT * FROM Proyeccion_menu WHERE Contrato='".$_GET['Numero']."' and menu=".$menu[$ii]);
						$ingredientes='';$ingre2='';	
						while ($pr=mysql_fetch_array($pm)) 
						{
							
							$tot=explode(",",$pr['total']);

							//if($in[1]>0){
					$me=mysql_fetch_array(mysql_query("SELECT * FROM Menus WHERE id_menu=".$pr['menu']));
							$comentarios=explode("|",$me['comentarios']);
							//$name= explode(",", $me['ingredientes']);
							$in=explode(",",$me['ingredientes']);
								echo "<tr><th>PLATILLO</th><th>INSUMO UNITARIO</th><th>TOTAL</th></tr>";

								for ($i=0; $i <count($in) ; $i++) 
								{
									echo "<tr>";
									if($i==1){
										echo "<td rowspan='".(count($in)-1)."' style='vertical-align:top'><b>".$me['nombre']."</b><br><i>Comensales:".$pr['comensales']."</i></td>";
									}
									///*/*/*/*///7
									 if(!is_numeric($in[$i])){
				 							echo "<tr><td colspan='5' style='background:lightgray;' align='center'>".$in[$i]."</td></tr>";
			 						}else{
									/*/*/////7/*/*/
									//if(is_numeric($in[$i])){
										$iin=mysql_fetch_array(mysql_query("SELECT * FROM producto WHERE id_producto=".$in[$i] ));
										$inv=mysql_fetch_array(mysql_query("select * from inventario where id_producto=".$in[$i]));
										echo "<td><b>".$iin['nombre']."</b></td><td>".$comentarios[$i]."</td>";
										echo "<td><b>".number_format($tot[$i],3)."</b> <i>".$inv['UnidadMenu']."</i></td>";
										echo "</tr>";	
									}
																													
								}
								echo "<tr><td colspan='4' style='background-color:#D8D8D8;'><br></td></tr>";	
							//}

						}
					}
				echo "</table>";
				}
				
			
			
				
			  
function fecha_es($Fecha)
{

//echo $Fecha;
	$FechaLetras=explode("-",$Fecha);
//echo date($FechaLetras[2]);

//echo $dia=$FechaLetras[2];
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
    $nu=$FechaLetras[2];
  //  echo $dias[2];
    $meses=array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
    return $dias[date('N', strtotime($Fecha))]." ".$FechaLetras[2]." de ".$meses[$FechaLetras[1]]." del ".$FechaLetras[0];   
   
}	
function OrdenaMeseros()
{
	$ORD="SELECT descripcion from Configuraciones Where nombre='ORDEN MESEROS'";
            	$ORDE=mysql_query($ORD);
            	$ORDEN=mysql_fetch_array($ORDE);

            	 $ffff=explode(",",$ORDEN['descripcion']);
			$sente;
            	 for ($i=0; $i <count($ffff); $i++) 
            	 { 
            	 	# code...
            	 	if(empty($sente)||$sente=="")
            	 	{
            	 		$sente="tipo='".$ffff[$i]."'";
            	 	}
            	 	else
            	 	{
            	  		$sente= $sente.",tipo='".$ffff[$i]."'";
            	  	}
            	 }

            	return $sente;

}
			?>
		</center>
	</div>
</body>

</html>