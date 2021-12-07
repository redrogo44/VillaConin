<?php
require "configuraciones.php";
	conectar();
	validarsesion();
	$nivel=$_SESSION['niv'];
	//menuconfiguracion();
	print_r($_POST);
	print_r($_GET);

if(isset($_GET['id']))
{
	echo $delete="DELETE FROM `Meseros` WHERE id=".$_GET['id'];
	mysql_query($delete);
	echo '<meta http-equiv="Refresh" content="0;url=http:Insert_Meseros.php">';
}
if($_GET['reinicia']=='reiniciar')
{
	mysql_query('UPDATE `Meseros` SET nivel="0",fechaingreso="'.date('y-m-d').'",comentarios="",estatus="",disponibilidad="no",neventos=0,confirmacion="no",porcentaje=0,comentarios2="" WHERE 1');	
	?>
	<script type="text/javascript">
	alert('Se han Modificado');
	</script>
	<?php
	echo '<meta http-equiv="Refresh" content="0;url=http:ConfiguracionSistema.php">';	
}
if ($_POST['tipo']=='reajuste') 
{
	echo $rea="UPDATE Meseros SET reajuste=".$_POST['reajuste']." WHERE id=".$_POST['id'];
	mysql_query($rea);
	echo '<meta http-equiv="Refresh" content="0;url=http:ConfiguracionSistema.php">';	

}


?>