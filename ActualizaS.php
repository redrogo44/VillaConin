	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<?php
require 'funciones2.php';
conectar();
if(strlen($_POST['numero'])<=8){//comparamos el numero para saber si se hace la validacion de el aprtado de la fecha en salon para evento normal
		$g="select * from contrato where Numero='".$_POST['numero']."'";
		$g2=mysql_query($g);
		$g3=mysql_fetch_array($g2);
		if($g3['salon']!=$_POST['salon']){
		$nc=nombre_contrato($_POST['fechaevento'],$_POST['salon'],"");
		$nc1=$nc."L";
		$nc2=$nc."O";
		$nc3=$nc."E";
		//$Existe_numero="select count(Numero)'c' from contrato where Numero='".$nc1."' OR Numero='".$nc2."' OR Numero='".$nc3."'";
		$Existe_numero="select * from contrato where Fecha='".$_POST['fechaevento']."' and salon='".$_POST['salon']."'";
		$res_existe=mysql_query($Existe_numero);
		//$mbr=mysql_fetch_array($res_existe);
		//$ex=$mbr['c'];
		if(mysql_num_rows($res_existe)>0){
						echo "<script>alert('Error salon ya ocupado');</script>";
						echo '<meta http-equiv="refresh" content="0; url=http:BuscarPreContrato.php" />';
						die("ERROR");
					}else{
					}
			}else{
			$ex=0;
			}		
}
		
			
			
			
?>
 
 <title>Villa Conin</title>
 <head>

<script language="JavaScript" type="text/javascript">
function contrato(){
	window.open("contratoPDF.php?numero="+"<?php echo $_POST['numero']; ?>" );
	}
	</script>
 </head>
 
<body   <?php if($_POST['opcion']=='imprimir'){
$ac="UPDATE contrato set impreso='si', estatus= 1 where Numero='".$_POST['numero']."'";
	$re=mysql_query($ac);

 echo 'onload="contrato()"';} ?> >

 
 
<?php



		$z="select * from contrato where Numero='".$_POST['numero']."'";
		$z1=mysql_query($z);
		$z2=mysql_fetch_array($z1);

		if($_POST['nombre']==""){$_POST['nombre']=$z2['nombre'];}
		if($_POST['si']==""){$_POST['si']=$z2['si'];}
		if($_POST['deposito']==""){$_POST['deposito']=$z2['deposito'];}
		//validamos el cambio de facturado -> no facturado o facturado <- no facturado 
		if($_POST['facturado']==$z2['facturado']){
			//no se hace nada no se hizo modificaciones
		}else{
			if($_POST['facturado']=='no'){
				//pasar a no facturado
				$nf=mysql_query("select sum(cantidad) as t from abonofac where numcontrato='".$_POST['numero']."'");
				$nf2=mysql_fetch_array($nf);
				$mid=mysql_query("select max(id) as id from abonofac");
				$mid2=mysql_fetch_array($mid);
				$x=$mid2['id']+1;
				if($nf2['t']==''){$nf2['t']=0;}
				$ins=mysql_query("insert into abono values('".$_POST['numero']."',".$nf2['t'].",'".date('d-m-Y')."','_______','cambio a no facturado','".$z2['tipo']."','".$z2['salon']."','".$z2['Fecha']."',".$x.")");
				$del=mysql_query("delete from abonofac where numcontrato='".$_POST['numero']."'");
				
			}else{
				//pasar a facturado
				$f=mysql_query("select sum(cantidad) as t from abono where numcontrato='".$_POST['numero']."'");
				$f2=mysql_fetch_array($f);
				$mid=mysql_query("select max(id) as id from abono");
				$mid2=mysql_fetch_array($mid);
				$x=$mid2['id']+1;
				if($f2['t']==''){$f2['t']=0;}
				$ins=mysql_query("insert into abonofac values('".$_POST['numero']."',".$f2['t'].",'".date('d-m-Y')."','_______','cambio a facturado','".$z2['tipo']."','".$z2['salon']."','".$z2['Fecha']."',".$x.")");
				$del=mysql_query("delete from abono where numcontrato='".$_POST['numero']."'");
				
			}
		
		}

				
		$total_abonos=0;
		$total_cargos=0;
		$total_neto=0;


		$query_abono="select * from abono where numcontrato='".$_POST['numero']."'";
		$r_abono=mysql_query($query_abono);
		while($ma=mysql_fetch_array($r_abono)){
		$total_abonos=$total_abonos+$ma['cantidad'];
		}

		$query_cargo="select * from cargo where numcontrato='".$_POST['numero']."'";
		$r_cargo=mysql_query($query_cargo);
		while($mc=mysql_fetch_array($r_cargo)){
		$total_cargos=$total_cargos+$mc['cantidad'];
		}

		$saldoi;
		if($_POST['facturado']=="si")
					{
						$ta=($_POST['c_adultos']*$_POST['p_adultos'])+($_POST['c_jovenes']*$_POST['p_jovenes'])+($_POST['c_ninos']*$_POST['p_ninos']);
						
						$saldoi=($ta*1.16)+$_POST['deposito'];
					}else{
						$saldoi=($_POST['c_adultos']*$_POST['p_adultos'])+($_POST['c_jovenes']*$_POST['p_jovenes'])+($_POST['c_ninos']*$_POST['p_ninos'])+$_POST['deposito'];
						
						}

		$total_neto=$saldoi-$total_abonos+$total_cargos;
		//echo $total_neto."=".$_POST['si']."-".$total_abonos."+".$total_cargos;
		if(strlen($_POST['numero'])<=8 && empty($_POST['contratogral'])){
			$var="update contrato set si=".$saldoi.", sa=".$total_neto." Where Numero='".$_POST['numero']."'";
			$res=mysql_query($var);
		}else if ((strlen($_POST['numero'])<=11 && empty($_POST['contratogral']))) 
		{
			# code...
			$var="update contrato set si=".$saldoi.", sa=".$total_neto." Where Numero='".$_POST['numero']."'";
			$res=mysql_query($var);
		}
		{}



		
		$nc=nombre_contrato($_POST['fechaevento'],$_POST['salon'],$_POST['vendedor']);
		if(strlen($_POST['numero'])<=8 && empty($_POST['contratogral'])){//comparamos para hacer la actualizacion de contrato o sub contrato
			$varx='UPDATE contrato SET Numero="'.$nc.'" ,nombre="'.$_POST['nombre'].'",tipo="'.$_POST['tipo'].'",salon="'.$_POST['salon'].'",vendedor="'.$_POST['vendedor'].'",facturado="'.$_POST['facturado'].'",deposito='.$_POST['deposito'].',c_adultos='.$_POST['c_adultos'].',c_jovenes='.$_POST['c_jovenes'].',c_ninos='.$_POST['c_ninos'].',p_adultos='.$_POST['p_adultos'].',p_jovenes='.$_POST['p_jovenes'].',p_ninos='.$_POST['p_ninos'].',festejado="'.$_POST['festejado'].'" where Numero="'.$_POST['numero'].'"'; 
			$resx=mysql_query($varx);
			echo '<META HTTP-EQUIV="Refresh" CONTENT="1; URL=MSaldo.php?numero='.$nc.'">';
		}elseif(strlen($_POST['numero'])<=8 && $_POST['contratogral']==1){
			$varx='UPDATE contrato SET Numero="'.$nc.'" ,nombre="'.$_POST['nombre'].'",tipo="'.$_POST['tipo'].'",salon="'.$_POST['salon'].'",vendedor="'.$_POST['vendedor'].'",facturado="'.$_POST['facturado'].'" where Numero="'.$_POST['numero'].'"'; 
			$resx=mysql_query($varx);
			echo '<META HTTP-EQUIV="Refresh" CONTENT="1; URL=MSaldo.php?numero='.$nc.'&mcontrato=1">';
		}else{
			$varx='UPDATE contrato SET nombre="'.$_POST['nombre'].'",vendedor="'.$_POST['vendedor'].'",facturado="'.$_POST['facturado'].'",deposito='.$_POST['deposito'].',c_adultos='.$_POST['c_adultos'].',c_jovenes='.$_POST['c_jovenes'].',c_ninos='.$_POST['c_ninos'].',p_adultos='.$_POST['p_adultos'].',p_jovenes='.$_POST['p_jovenes'].',p_ninos='.$_POST['p_ninos'].',festejado="'.$_POST['festejado'].'" where Numero="'.$_POST['numero'].'"'; 
			$resx=mysql_query($varx);
			$n=explode('-',$_POST['numero']);
			$actualizar=mysql_query("update contrato set si=".si($n[0]).",sa=".sa($n[0]).",deposito=".deposito($n[0]).",c_adultos=".adultos($n[0]).",c_jovenes=".jovenes($n[0]).",c_ninos=".ninos($n[0])." where Numero='".$n[0]."'");
			$actualizar2=mysql_query("update subcontratos set nombre='".$_POST['nombre']."',correo='".$_POST['correo']."',telefono='".$_POST['telefono']."' where numero='".$_POST['numero']."'");
			echo '<META HTTP-EQUIV="Refresh" CONTENT="1; URL=MSaldo.php?numero='.$n[0].'">';
		}
		

?>

</body>

</html>
