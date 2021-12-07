<?php
require('funciones2.php');
conectar();
if(isset($_GET['op'])){
	if($_GET['op']=='crear'){
		crear_subcontrato($_GET['numero']);
		header('Location: MSaldo.php?numero='.$_GET['numero']);
	}elseif($_GET['op']=='agregar'){
		$i=subcontratomax($_GET['numero'])+1;
		if(contratolleno($_GET['numero'],$i-1)){
			$query=mysql_query("select * from contrato where Numero='".$_GET['numero']."'");
			$contrato=mysql_fetch_array($query);
			$insert="insert into contrato(Numero,Fecha,tipo,salon,vendedor,c_adultos,c_jovenes,c_ninos,p_adultos,p_jovenes,p_ninos)values('".$_GET['numero']."-".$i."','".$contrato['Fecha']."','".$contrato['tipo']."','".$contrato['salon']."','".$contrato['vendedor']."',0,0,0,0,0,0)";
			$insertar=mysql_query($insert);
			$insert_sub=mysql_query("insert into subcontratos (numero,fechas) values('".$_GET['numero']."-".$i."','".fechas($_GET['numero'])."')");
			header('Location: MSaldo.php?numero='.$_GET['numero']);
		}else{
			echo "<script>";
			echo "alert('se deben de llenar los campos del subcontrato anterior')";
			echo "</script>";
			echo '<meta http-equiv="Refresh" content="0;url=MSaldo.php?numero='.$_GET['numero'].'">';
		}
		
	}elseif($_GET['op']=='eliminar' && strlen($_GET['numero'])>8){
		$borrar=mysql_query("delete from contrato where Numero='".$_GET['numero']."'");
		$n=explode('-',$_GET['numero']);
		$actualizar=mysql_query("update contrato set si=".si($n[0]).",sa=".sa($n[0]).",deposito=".deposito($n[0]).",c_adultos=".adultos($n[0]).",c_jovenes=".jovenes($n[0]).",c_ninos=".ninos($n[0])." where Numero='".$n[0]."'");
		header('Location: MSaldo.php?numero='.$n[0]);
	}else{
		$n=explode('-',$_GET['numero']);
		header('Location: MSaldo.php?numero='.$n[0]);
	}
}else{
	header('Location: BuscarPreContrato.php');
}

function contratolleno($n,$i){
$numero=$n."-".$i;
$q=mysql_query("select * from contrato where Numero='".$numero."'");
$m=mysql_fetch_array($q);
$q2=mysql_query("select * from subcontratos where numero='".$numero."'");
$m2=mysql_fetch_array($q2);

if(empty($m['nombre']) || empty($m2['correo']) || empty($m2['telefono'])){
	$b=false;
}else{
	$b=true;
}
return $b;
}
function fechas($n){
	$q=mysql_query('select fechas from subcontratos where numero like "'.$n.'%"');
	$m=mysql_fetch_array($q);
	return $m['fechas'];
}
?>