<?php
require('../funciones2.php');
conectar();
date_default_timezone_set('America/Mexico_City');
print_r($_POST);
echo "<br>";

	for ($i=1; $i <$_POST['cantidad_menus'] ; $i++) //MENU
	{ 
		$ingredientes='';echo "<br>";$total='';
		for ($j=1; $j <$_POST['cantidad_Ingredientes-'.$i] ; $j++) // INGREDIENTES
		{ 
			$ingredientes=$ingredientes.",".$_POST[$i."ingrediente".$j];
			$total=$total.",".$_POST[$i."total".$j];
		}

		echo "Menu ".$_POST['Menu-'.$i]."<br>";	
		echo "Id Logistica".$_POST['id_logistica-'.$i]."<br>";
		echo "Cantidad de Ingredientes ".$ingred=$_POST['cantidad_Ingredientes-'.$i]."<br>";		
		echo "Ingredientes ".$ingredientes."<br>";
		echo "Totales ".$total."<br>";

echo "INSERT INTO `Proyeccion_menu`(`Contrato`, `menu`, `ingredientes`, `total`, `comensales`, `estatus`, `id_logistica`, `fecha`,`Menu_logistica`) 
		VALUES ('".$_POST['Contrato']."','".$_POST['Menu-'.$i]."','".$ingredientes."','".$total."',".$_POST['Comensales-'.$i].",'1',".$_POST['id_logistica-'.$i].",'".date('Y-m-d')."','".$_POST['menu_logistica-'.$i]."')";
		
		mysql_query("INSERT INTO `Proyeccion_menu`(`Contrato`, `menu`, `ingredientes`, `total`, `comensales`, `estatus`, `id_logistica`, `fecha`,`Menu_logistica`) VALUES ('".$_POST['Contrato']."','".$_POST['Menu-'.$i]."','".$ingredientes."','".$total."',".$_POST['Comensales-'.$i].",'1',".$_POST['id_logistica-'.$i].",'".date('Y-m-d')."', '".$_POST['menu_logistica-'.$i]."' )");	
	}

echo '
		<script type="text/javascript">
		opener.listar();
			window.location="Compra.php?Numero='.$_POST["Contrato"].'";					
		</script>
	';
?>