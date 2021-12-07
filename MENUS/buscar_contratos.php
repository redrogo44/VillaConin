<?php
require("../funciones2.php");
conectar();
//print_r($_POST);
echo "SIN MENU &nbsp;&nbsp;<input type='button'  value='' style='background:#F00' disabled='true' >&nbsp;&nbsp;
		MODIFICADO &nbsp;&nbsp;<input type='button'  value='' style='background:#FF65CB' disabled='true'>&nbsp;&nbsp;
		INCOMPLETO  &nbsp;&nbsp;<input type='button'  value='' style='background:#FF812C' disabled='true'>&nbsp;&nbsp;
		<br><br>";
	$con=mysql_query("SELECT * FROM contrato WHERE Fecha>='".$_POST['fecha1']."' and Fecha<='".$_POST['fecha2']."' ");
	echo " <table border='5' bordercolor='#6089FC' style='background:#E4E3E0;'>
		<caption>LISTADO DE CONTRATOS ENTRE LAS <br>FECHAS ".$_POST['fecha1']." Y ".$_POST['fecha2']."</caption>
		<thead>
			<tr>
				<th colspan='4'>CONTRATOS</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td align='center'> <b> CONTRATO</b></td>
				<td align='center'><b>TIPO</b></td>
				<td align='center'><b># COMENSALES</b></td>
				<td align='center'><b>PROYECTAR </b> </td>
			</tr>";
			$contratos='';
			while ($c=mysql_fetch_array($con)) 
				{
					$contratos=$contratos.",".$c['Numero'];
					if(strlen ($c['Numero'])<=8)
					{
						$comensal=total_comen($c['Numero'],$c['facturado']);
						$co=$comensal[0]+$comensal[1]+$comensal[2]+$c['c_adultos']+$c['c_jovenes']+$c['ninos'];
						//echo "SELECT * FROM `Proyeccion_menu` WHERE Contrato='".$c['Numero']."' "."<br>".mysql_num_rows(mysql_query("SELECT * FROM `Proyeccion_menu` WHERE Contrato='".$c['Numero']."' "));
						if (mysql_num_rows(mysql_query("SELECT * FROM `Proyeccion_menu` WHERE Contrato='".$c['Numero']."' "))>0) 
						{					
							$come=0;$menus='';
						
						 
							$proye=mysql_query("SELECT * FROM Proyeccion_menu WHERE Contrato='".$c['Numero']."' GROUP BY id_logistica")	;
							$foo=true;
						while ($pp=mysql_fetch_array($proye)) 
											{
												$lo=mysql_fetch_array(mysql_query("SELECT * FROM logistica_menu where id=".$pp['id_logistica']));
													//echo $lo['menu']." == ".$pp['Menu_logistica']."<br>";												
												if ($lo['menu']!=$pp['Menu_logistica']) 
												{
													$foo=false;
												}
											$come=$pp['comensales']+$come;												
											}
						//	echo "Comensales Proyeccion ".$come." ==  Comensales Contrato".$co."<br>";
							
						 if ($foo==false)
							{

								echo "<tr bgcolor='#FF65CB'>
										<td align='center'><b>".$c['Numero']."</b></td>
										<td align='center'><b>".$c['tipo']."</b></td>
										<td align='center'><font color='#000'><b> ALGUNOS PLATILLOS HAN SIDO CAMBIADOS<br> MODIFIQUE LA PROYECCION</b></font></b></td>
										<td align='center'><input type='button' name='".$c['Numero']."' value='Modificar Proyeccion' onclick='modif_proyeccion(this.name);' /></td>
						  			</tr>";		
							}				
							else if ($come<$co) 
							{
								$cc=$come-$co;
								echo "<tr bgcolor='#FF812C'>
										<td align='center'><b>".$c['Numero']."</b></td>
										<td align='center'><b>".$c['tipo']."</b></td>
										<td align='center'><b><font color='#fff'>#  DE COMENSALES DEL CONTRATO <font color='#00FFFC'>".$co."</font><br># DE COMENSALES PROYECTADOS <font color='#00FFFC'>".$come."</font></font><br><font color='#FFFF00'><b> FALTAN  <font color='#00FF1A' SIZE=6 >".abs($cc)."</font>  COMENSALES POR ASIGNAR</b></font></b></td>
										<td align='center'><input type='button' name='".$c['Numero']."' value='Modificar Proyeccion' onclick='modif_proyeccion(this.name);' /></td>
						  			</tr>";		
							}					
							else
							{
								echo "<tr bgcolor='#3CFF00'>
										<td align='center'><b>".$c['Numero']."</b></td>
										<td align='center'><b>".$c['tipo']."</b></td>
										<td align='center'><b>".$co."</b></td>
										<td align='center'><input type='button' name='".$c['Numero']."' value='Imprimir' onclick='imprime_proyeccion(this.name);' /></td>
										<td align='center'><input type='button' name='".$c['Numero']."' value='Modificar Proyeccion' onclick='modif_proyeccion(this.name);' /></td>
								  	</tr>";	
							}
							
						}
						else
						{
							$lm=mysql_query("SELECT * FROM logistica_menu WHERE Contrato='".$c['Numero']."' ");
							if (mysql_num_rows($lm)>0) 
							{
								$ml=mysql_fetch_array($lm);
								if ($ml['menu']=='') 
								{
									echo "<tr bgcolor='#F00'>
										<td align='center'><b>".$c['Numero']."</b></td>
										<td align='center'><b>".$c['tipo']."</b></td>
										<td align='center'><b>".$co."</b></td>
										<td align='center'><font color='#C9FF00'><b>SIN PLATILLOS</b></font></td>
								  	</tr>";	
								}
								else
								{
									echo "<tr>
										<td align='center'><b>".$c['Numero']."</b></td>
										<td align='center'><b>".$c['tipo']."</b></td>
										<td align='center'><b>".$co."</b></td>
										<td align='center'><input type='button' name='".$c['Numero']."' value='Proyectar' onclick='proyectar(this.name);' /></td>
								  </tr>";
								}
							}
							else
							{
								echo "<tr bgcolor='#F00'>
										<td align='center'><b>".$c['Numero']."</b></td>
										<td align='center'><b>".$c['tipo']."</b></td>
										<td align='center'><b>".$co."</b></td>
										<td align='center'><font color='#C9FF00'><b>SIN PLATILLOS</b></font></td>
								  	</tr>";	
							}
							
						}
					}
				}
		echo "</tbody>
	</table> ";



////////////listado de evento extras

echo "<br><br><br><table border='5' bordercolor='#6089FC' style='background:#E4E3E0;'>";
echo "<tr>
		<td align='center'> <b> FECHA</b></td>
		<td align='center'><b>TIPO</b></td>
		<td align='center'><b># COMENSALES</b></td>
		<td align='center'><b>PROYECTAR </b> </td>
</tr>";
$q=mysql_query("select * from Extras where fecha>='".$_POST["fecha1"]."' and fecha<='".$_POST["fecha2"]."'");
while($m=mysql_fetch_array($q)){
	$contratos=$contratos.",".$m['id'];
		$lm=mysql_query("SELECT * FROM logistica_menu WHERE Contrato='".$m['id']."' ");
		if (mysql_num_rows($lm)>0) 
		{
			$proye=mysql_query("SELECT * FROM Proyeccion_menu WHERE Contrato='".$m['id']."' GROUP BY id_logistica")	;
			$foo=true;$come=0;
			while ($pp=mysql_fetch_array($proye)) 
			{
				$lo=mysql_fetch_array(mysql_query("SELECT * FROM logistica_menu where id=".$pp['id_logistica']));
				//echo $lo['menu']." == ".$pp['Menu_logistica']."<br>";												
				if ($lo['menu']!=$pp['Menu_logistica']) 
				{
					$foo=false;
				}
				$come=$pp['comensales']+$come;												
			}
			
			if ($foo==false)
			{
				echo "<tr bgcolor='#FF65CB'>
				<td align='center'><b>".$m['fecha']."</b></td>
				<td align='center'><b>".$m['tipo']."</b></td>
				<td align='center'><font color='#000'><b> ALGUNOS PLATILLOS HAN SIDO CAMBIADOS<br> MODIFIQUE LA PROYECCION</b></font></b></td>
				<td align='center'><input type='button' name='".$m['id']."' value='Modificar Proyeccion' onclick='modif_proyeccion(this.name);' /></td>
				</tr>";		
			}				
			else if ($come<$m["comensales"]) 
			{
				$cc=$come-$m["comensales"];
				echo "<tr bgcolor='#FF812C'>
					<td align='center'><b>".$m['fecha']."</b></td>
					<td align='center'><b>".$m['tipo']."</b></td>
					<td align='center'><b><font color='#fff'>#  DE COMENSALES DEL CONTRATO <font color='#00FFFC'>".$m["comensales"]."</font><br># DE COMENSALES PROYECTADOS <font color='#00FFFC'>".$come."</font></font><br><font color='#FFFF00'><b> FALTAN  <font color='#00FF1A' SIZE=6 >".abs($cc)."</font>  COMENSALES POR ASIGNAR</b></font></b></td>
					<td align='center'><input type='button' name='".$m['id']."' value='Modificar Proyeccion' onclick='modif_proyeccion(this.name);' /></td>
					</tr>";		
			}					
			else
			{
				echo "<tr bgcolor='#3CFF00'>
					<td align='center'><b>".$m['fecha']."</b></td>
					<td align='center'><b>".$m['tipo']."</b></td>
					<td align='center'><b>".$m["comensales"]."</b></td>
					<td align='center'><input type='button' name='".$m['id']."' value='Imprimir' onclick='imprime_proyeccion(this.name);' /></td>
					<td align='center'><input type='button' name='".$m['id']."' value='Modificar Proyeccion' onclick='modif_proyeccion(this.name);' /></td>
					</tr>";	
			}
			
		}
		else
		{
			echo "<tr bgcolor='#F00'>
					<td align='center'><b>".$m['fecha']."</b></td>
					<td align='center'><b>".$m['tipo']."</b></td>
					<td align='center'><b>".$m["comensales"]."</b></td>
					<td align='center'><font color='#C9FF00'><b>SIN PLATILLOS</b></font></td>
			  	</tr>";	
		}
}
echo "</table>";




echo "  <br><form action='PDF_OrdenCompra.php' method='POST' accept-charset='utf-8'  target='_blank'>
	<input type='hidden' name='Contratos' value=".$contratos.">	
	<input type='submit'  value='Reporte Porciones General'>
		</form>"	;

function total_comen($n,$fac){
	$congral=mysql_query("select count(*) as total from contrato where Numero like '".$n."-%'");
	$gral=mysql_fetch_array($congral);

	if($gral['total']>0){//////////////es un contrato gral
		if($fac=='si'){
			$q='select * from cargofac where numcontrato like "'.$n.'%" and tipo="Comensales"';
		}else{
			$q='select * from cargo where numcontrato like "'.$n.'%" and tipo="Comensales"';
		}
	}else{//////es un contrato normal o subcontrato
		if($fac=='si'){
			$q='select * from cargofac where numcontrato="'.$n.'" and tipo="Comensales"';
		}else{
			$q='select * from cargo where numcontrato="'.$n.'" and tipo="Comensales"';
		}
	}
	
	$r=mysql_query($q);
	$cantidades;
	while($m=mysql_fetch_array($r)){
		$arreglo=explode(' ',$m['concepto']);
		$cantidades[0]=$cantidades[0]+$arreglo[4];
		$cantidades[1]=$cantidades[1]+$arreglo[15];
		$cantidades[2]=$cantidades[2]+$arreglo[26];
	}
	
	return $cantidades;
}	
function compara_arrays($ml,$menus)
{
	foreach($array1 as $valor)
	{ //recorremos el array1 valor por valor 
 		if(array_serch($valor,$array2) !== false)
 		{ //y le preguntamos: esta el valor en el que estamos posicionados actualmente, en el array 2? 
    		echo "si esta! " . $valor ; 
   		} 
 	else echo "no esta .." . $valor; 
	}  
}
?>