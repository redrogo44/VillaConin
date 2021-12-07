<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<?php
error_reporting(0);
session_start();
require 'configuraciones.php';
conectar();
if($_POST['op']==1){
	$_SESSION['pun']=0;
	}else{
	$Com=mysql_query("SELECT * FROM Meseros WHERE id=".$_POST['numero']);
	$comentari=mysql_fetch_array($Com);

	$Puntos=mysql_query("SELECT * FROM Configuraciones WHERE descripcion='".$comentari['tipo']."'");
	$punto=mysql_fetch_array($Puntos);
	$_SESSION['pun']=$punto['valor']+$_SESSION['pun'];
	/*echo "<script>
		function Punto()
		{
			var punt=".$punto['puntos'].";
			return punt; 
		}
	</script>"; */

	echo "$ ".money_format('%i', $_SESSION['pun']);
}
?>

</body>
</html>