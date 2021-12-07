<?php
require('../funciones2.php');
conectar();
print_r($_POST);
print_r($_GET);
date_default_timezone_set("America/Mexico_City");

if(isset($_POST['accion'])&&$_POST['accion']=='nuevo')
{
$Num=nombrecontrato($_POST['fecha'],$_POST['salon'],$_POST['vendedor']);
echo $inser="INSERT INTO `Eventos_Recaudacion`(`fecha`, `salon`, `referencia`, `comensales`, `cliente`, `vendedor`, `Numero`) VALUES ('".$_POST['fecha']."','".$_POST['salon']."','".$_POST['referencia']."','".$_POST['comensales']."','".$_POST['cliente']."','".$_POST['vendedor']."','".$Num."')";
mysql_query($inser);
echo "
		<script>
			alert('SE GUARDO CORRECTAMENTE EL EVENTO');
			window.location ='recaudacion.php';	
		</script>
	 ";
}
if(isset($_GET['accion'])&&$_GET['accion']=='elimina')
{
	mysql_query("UPDATE `Eventos_Recaudacion` SET `estatus`='CANCELADO' WHERE `id`=".$_GET['id']);
	echo "
		<script>
			alert('SE ELIMINO EL EVENTO.');
			window.location ='recaudacion.php';	
		</script>
	 ";
}
if(isset($_POST['accion'])&&$_POST['accion']=='modifica_evento')
{

	for($i=1;$i<=$_POST['filas'];$i++)
	{
		echo "<br>".$up='UPDATE `Eventos_Recaudacion` SET `comensales`="'.$_POST['comensales'.$i].'",`cliente`="'.$_POST['cliente'.$i].'" WHERE id='.$_POST['id'.$i];
		mysql_query($up);
	}
	echo "
			<script>
				alert('SE MODIFICO LOS EVENTOS.');
				window.location ='recaudacion.php';	
			</script>
		";
}
if(isset($_POST['accion'])&&$_POST['accion']=='Guardar_productos')
{
	echo "Etro a producto";
	for($i=1;$i<$_POST['filas'];$i++)
	{
		//		ID SIGUIENTE
		echo $qd="SHOW TABLE STATUS LIKE 'productos_tiendita'";
		$r=mysql_query($qd);
		$muestra=mysql_fetch_array($r);
		echo "num ".$numax=$muestra['Auto_increment'];
		//  NOMBRE
		$nom=$_POST['nombre'.$i];
		echo $l=strlen($nom);	
		echo $nom="200".$numax;		
		echo $in='INSERT INTO `productos_tiendita`(`nombre`, `descripcion`, `precio`,`codigo`,`fecha`) VALUES ("'.$_POST['nombre'.$i].'","'.$_POST['descripcion'.$i].'","'.$_POST['precio'.$i].'","'.$nom.'","'.date('Y-m-d').'")';
		mysql_query($in);
	echo "<script>	
				window.open('Codigos2/Modulos/principal/generador.php?codigo=".$nom."', '_blank', 'width=200, height=100');								
			</script>";
	
	}
echo "<script>	
				window.location ='recaudacion.php';								
			</script>";

}
if(isset($_POST['accion'])&&$_POST['accion']=='actualiza_productos')
{
	for($i=1;$i<$_POST['n_productos'];$i++)
	{
		$u="UPDATE `productos_tiendita` SET `nombre`='".$_POST['nombre'.$i]."',`descripcion`='".$_POST['descripcion'.$i]."',`precio`='".$_POST['precio'.$i]."' WHERE id=".$_POST['id'.$i];
		mysql_query($u);
	}
	echo "<script>	
			alert('PRODUCTOS ACTUALIZADOS CORRECTAMENTE.');
				window.location ='recaudacion.php';								
		</script>";
}
if(isset($_POST['accion'])&&$_POST['accion']=='registra_ticket')
{
	  $qd="SHOW TABLE STATUS LIKE 'tickets' ";
		$r=mysql_query($qd);
		$muestra=mysql_fetch_array($r);
		$id=$muestra['Auto_increment'];
	
	$producto='';$descripcion='';$precio_u='';$totales='';$Total='';$cantidades='';
	$productov='';$descripcionv='';$precio_uv='';$totalesv='';$Totalv='';$cantidadesv='';$bandera=0;
	$talimento=0;
	$vino=explode(",", $_POST['productos_v']);
	echo "<br>cantidad de vinos ".count($vino)."<br>";
	for($i=2;$i<$_POST['filas'];$i++)
	{
		for ($j=1; $j<count($vino); $j++) 
		{ 
			if ($_POST["producto".$i] == $vino[$j]) 
			{
				echo "<br>".$_POST["producto".$i]."   *****    ".$vino[$j];
				$productov=$productov.",".$_POST['producto'.$i];
				$descripcionv=$descripcionv.",".$_POST['descripcion'.$i];				
				$totalesv=$totalesv.",".$_POST['total-'.$i];
				$cantidadesv=$cantidadesv.",".$_POST['cantidad'.$i];					
				$bandera=1;
			}					
		}
		if($bandera==0)		
		{
			$producto=$producto.",".$_POST['producto'.$i];
						$descripcion=$descripcion.",".$_POST['descripcion'.$i];
						$precio_u=$precio_u.",".$_POST['precio_unitario'.$i];
						$totales=$totales.",".($_POST['precio_unitario'.$i]*$_POST['cantidad'.$i]);
						$cantidades=$cantidades.",".$_POST['cantidad'.$i];	
						$talimento=$talimento+($_POST['precio_unitario'.$i]*$_POST['cantidad'.$i]);
		}
		$bandera=0;
	}
		
echo "<br>".$producto;
echo "<br>".$descripcion;
echo "<br>".$precio_u;
echo "<br>".$totales;
echo "<br>".$cantidades;
echo "<br>v ".$productov;
echo "<br>v ".$descripcionv;
echo "<br>v ".$precio_uv;
echo "<br>v ".$totalesv;
echo "<br>v ".$cantidadesv."<br>";
$id_ali='';
if($cantidades!='')
	{
		//echo "SELECT MAX( folio ) AS id FROM tickets WHERE  `referencia` =  '".$_POST['referencia']."' <br>";
		$t=mysql_fetch_array(mysql_query("SELECT MAX( folio ) AS id FROM tickets WHERE  `referencia` =  '".$_POST['referencia']."' "));
		//echo "Vinos  == ".$t['id'];		
		$idd=$t['id'];
		if ($t['id']==NULL) 
		{
			$idd=1;
		}
		else
		{
			$idd++;
		}

		echo $ins="INSERT INTO `tickets`(`productos`, `descripciones`, `cantidades`, `precios_unitarios`, `totales`,`Total`,`fecha`,`referencia`,`registro`,`paga`,`folio`) 
		VALUES ('".$producto."','".$descripcion."','".$cantidades."','".$precio_u."','".$totales."', '".$talimento."', '".date('Y-m-d')."','".$_POST['referencia']."','".$_POST['registro']."','".$_POST['paga']."', ".$idd." )";
		mysql_query($ins);
	}
	if($cantidadesv!='')
	{
		$t=mysql_fetch_array(mysql_query("SELECT MAX( folio ) AS id FROM tickets_vinos WHERE  `referencia` =  '".$_POST['referencia']."' "));
		//echo "Vinos  == ".$t['id'];		
		$idd=$t['id'];
		if ($t['id']==NULL) 
		{
			$idd=1;
		}
		else
		{
			$idd++;
		}

		echo "<br>".$iv="INSERT INTO `tickets_vinos`(`productos`, `descripciones`, `cantidades`, `totales`,`id_ticket`,`fecha`,`referencia`,`registro`,`paga`,`folio`) VALUES ('".$productov."','".$descripcionv."','".$cantidadesv."','".$totalesv."','".$id."','".date('Y-m-d')."','".$_POST['referencia']."','".$_POST['registro']."','".$_POST['paga']."', ".$idd."  )";
		mysql_query($iv);

	}
	
	//SI HAY TICKET DE ALIMENTOS Y OTRO DE VINOS
	if($producto!=''  && $productov!='')
	{
	echo "<script>	
			window.open('Pruebas/pruba_impresion.php?ticket=alimentos_vinos&contrato=".$_POST['referencia']."', '_blank');
					window.location ='recaudacion.php?venta=1';								
			</script>";	
	}
// SI SOLO HAY TICKET DE ALIMENTOS 
	 else if($producto!='')
	{
		
	echo "<script>	
			window.open('Pruebas/pruba_impresion.php?ticket=alimentos&contrato=".$_POST['referencia']."','_blank');
					window.location ='recaudacion.php?venta=1';								
			</script>";	
	}
	// SI SOLO HAY TICKET DE VINOS
	 else if($productov!='')	
	{
	echo "<script>	
			window.open('Pruebas/pruba_impresion.php?ticket=vinos&contrato=".$_POST['referencia']."', '_blank');
					window.location ='recaudacion.php?venta=1';								
			</script>";	
	}
echo "<br> cantidades= ".$producto;
	echo "<br>cantidadesv =".$productov;

}
///////77		FUNCIONES 			////////////
if(isset($_POST['accion'])&&$_POST['accion']=='modifica_producto_vinos')
{
	for($i=1;$i<$_POST['n_productos'];$i++)
	{
		echo "<br>".$u="UPDATE `inventario` SET `precio_tienda`='".$_POST['precio'.$i]."' WHERE id_producto=".$_POST['id-'.$i];
		mysql_query($u);
	}
	echo "<script>	
			alert('PRODUCTOS ACTUALIZADOS CORRECTAMENTE.');
				window.location ='recaudacion.php';								
		</script>";
	
}
function nombrecontrato($f,$s,$v)
{
	$nombre;
	//salon
	if($s=="Fundador de Conin"){
		$nombre='X';
		}
	else if($s=="Real de Conin"){
		$nombre='Y';
			}
	else if($s=="Alcazar de Conin"){
		$nombre='Z';
		}
	else if($s=="Solar de Conin"){
		$nombre='W';
		}
	else if($s=="Marques"){
		$nombre='V';
		}  
	//fecha	
	$fecha=explode("-",$f);
	$nombre=$nombre . $fecha[2] . $fecha[1];
	$vi=(int)$fecha[0];
	$vi=$vi-2000;
	$nombre=$nombre . $vi;
	//vendedor
	/*
	if($v=="Luis"){
		$nombre=$nombre . "L";
		}
	else if($v=="Oscar"){
		$nombre=$nombre . "O";
		}
		else if($v=="Eduardo"){
		$nombre=$nombre . "E";
		}
		*/
		$L=substr($v,-(strlen($str)),1); 
		$nombre=$nombre.$L;
	return $nombre;
}					
				
?>