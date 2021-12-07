<?php
require('../configuraciones.php');
	conectar();	
	date_default_timezone_set('America/Mexico_City');
if (isset($_POST['tipo'])&&$_POST['tipo']=='gastoPersonal') 
{
	$fc=mysql_query("SELECT * FROM compra WHERE fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."'");
	$idsc='';
		while ($m=mysql_fetch_array($fc)) 
		{
			if (empty($idsc)) 
			{
			$idsc="id=".$m['id_compra'];																	
			}
			else 
			{
				$idsc=$idsc." OR id=".$m['id_compra'];
			}
		}
	$fcf=mysql_query("SELECT * FROM comprafac WHEre fecha>='".$_POST['fecha1']."' AND fecha<='".$_POST['fecha2']."'");							
		$idscf='';
		while ($m=mysql_fetch_array($fcf)) 
		{
			if (empty($idscf)) 
			{
			$idscf="id=".$m['id_compra'];																	
			}
			else 
			{
				$idscf=$idscf." OR id=".$m['id_compra'];
			}
		}
		$totalPersonal=0;
	echo "<ul>";
			$tabla5="select * from (SELECT * FROM detalle WHERE ".$idsc." OR ".$idscf.") as x where x.gasto='si'";					
			$c=mysql_query("SELECT * FROM categoria");
			while ($ca=mysql_fetch_array($c)) 
			{
				echo '
						<li>'.$ca['nombre'].'
							<ul>';
								$tcat2=0;					
							$s=mysql_query("SELECT * FROM subcategoria WHERE  id_categoria=".$ca['id_categoria']." order by nombre");
							while ($su=mysql_fetch_array($s)) 
							{$tsub2=0;
								echo'
										<li>'.$su['nombre'].'
											<ul>';																											
											$p=mysql_query("SELECT id_producto, nombre, descripcion FROM producto WHERE id_subcategoria=".$su['id_subcategoria']." order by nombre" );
											while (($pr=mysql_fetch_array($p))!=NULL) 
											{ 		$tproducto2=(gasto_personal($pr['id_producto'],$tabla5));										
													 if ($tproducto2>0) 
													 {
													 	echo '<li><span>'.$pr["nombre"]." (".$pr["descripcion"].')<font color="red"><b> $ '.money_format("%i",$tproducto2).'</b></font></span></li>';
													 	 $tsub2+=$tproducto2;	
													 }																													
											}															
									   echo'</ul><font color="red"><b>$ '.money_format("%i",$tsub2).'</b></font>
										</li>										
									';
							 $tcat2=$tsub2+$tcat2;													
							}
				  	  echo '</ul><font color="red"><b>$ '.money_format("%i",$tcat2).'</b></font>
						</li>
				  	 ';				
			$totalPersonal+=$tcat2;			 				 
			}
	echo "</ul><font color='green'><b>$ ".money_format("%i",$totalPersonal)."</b></font>";
}

function gasto_personal($idp,$idsc)
	{
	  	   $t=0; 			
			$r=mysql_query("SELECT * FROM (".$idsc.") as x WHERE id_producto=".$idp." AND  tipo='comprafac'");
			while($m=mysql_fetch_array($r))
			{														
				 $t+=($m['cantidad']*$m['precio_adquisicion']); 											
			}				
			$r=mysql_query("SELECT * FROM (".$idsc.") as x WHERE id_producto=".$idp." AND  tipo='compra'");
			while($m=mysql_fetch_array($r))
			{												
				 	$t+=($m['cantidad']*$m['precio_adquisicion']); 				
			}
			 
			return $t;
	}
?>