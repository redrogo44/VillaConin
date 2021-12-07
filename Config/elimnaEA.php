<?PHP 
require('configuraciones.php');
conectar();
$sel="SELECT * FROM Eventos_Adicionales WHERE id=".$_POST['id'];
$Sele=mysql_query($sel);
$M=mysql_fetch_array($Sele);
//echo "quiere Eliminar el id=".$_POST['id'];
$in="INSERT INTO `Cancelacion_Eventos_Adicionales`(`Numero`, `c_jovenes`, `Fecha`, `salon`, `Vendedor`, `Contrato_Referencia`, `tipo`, `c_adultos`, `c_ninos`, `Meseros`) VALUES ('".$M['Numero']."',".$M['c_jovenes'].",'".$M['Fecha']."','".$M['salon']."','".$M['Vendedor']."','".$M['Contrato_Referencia']."','".$M['tipo']."',".$M['c_adultos'].",".$M['c_ninos'].",'".$M['Meseros']."')";
$Insert=mysql_query($in);
mysql_query("DELETE FROM `Eventos_Adicionales` WHERE id=".$_POST['id']) OR die();
echo "SE HA ELIMINADO EL EVENTO ADICIONAL, USTEED PODRA VERLO EN REPORTE DE EVENTOS ADICIONALES..";

?>