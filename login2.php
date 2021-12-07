<html>
<head>
<title>Villaconin</title><link href="estilo/estilo.css" rel="stylesheet" type="text/css">

<?php

// echo "<br><pre>";
// 	print_r($_POST);
// echo "</pre>";

error_reporting(0);
session_start();
require 'funciones2.php';
conectar();
p_a_c();
p_a_s();  
	  if(strtoupper($_REQUEST["captcha"]) == $_SESSION["captcha"])
	  {
	    
				 $_SESSION["captcha"] = md5(rand()*time());

	 			if(!isset($_POST['enviar']))
				{
					echo "<br><br><center>Debes llenar todo el<a href = 'login.php'> formulario </a> error 1";
				}
				else
				{
					if(empty ($_POST['nombre']) || empty($_POST['contrasena']) )
					{
						echo "<br><br><center>Debes llenar todo el<a href = 'login.php'> formulario</a> campos vac�os";
					}
					else
					{
						$query = "select * from usuarios where nombre = '".$_POST['nombre']."' and contrasena = '".$_POST['contrasena']."';";
						$resultado=mysql_query($query) or die(mysql_error());
						$cuantos =mysql_num_rows($resultado);
			
						if ($cuantos>0)
						{
							echo "<br><br><center>Logeado";
							$muestra = mysql_fetch_array($resultado);
							echo " <CENTER> <H1> BIENVENIDO\t </H1> </CENTER>";
							echo " <CENTER><h1></H1> </CENTER>".$muestra['usuario'];
							session_start();
							$_SESSION['nombre']=  $muestra['nombre'];
							echo $_SESSION['niv'] = $muestra['nivel'];
							$_SESSION['esta'] = $muestra['estatus'];				
							$_SESSION['usu'] = $muestra['usuario'];				
							echo "<br><br><center><a href='index.php'><b>Ir a Sistema Villa Conin</b></a><br><br><br><br>";
							?>
							<script type="text/javascript">
								location.href = 'https://greatmeeting.me/index.php';
							</script>
							<?
						}
						else 
						{
							echo "<br><br><center>Usuario y/o contrase�a incorrectos ".mysql_error();
							echo "<br><br><center><a href='login.php'>Volver a login</a>";
						}
					}
				}
		}
		else
		{
			print_r($_SESSION);
			 $_SESSION["captcha"] = md5(rand()*time());
	 	 	echo "<br><br><center>captcha incorrecto<a href = 'login.php'> intentar nuevamente </a>";
	    }
	
function p_a_c(){
	$q="select * from contrato where Fecha>'2014-11-01' and estatus=1 and Numero not like '%-%' order by proximo_abono";
	$r=mysql_query($q);
	while($m=mysql_fetch_array($r)){
		print_r($r);
		$n=mysql_query("select * from contrato where Numero='".$m['Numero']."'");
		$m2=mysql_fetch_array($n);
		$fechas=explode('%',$m2['fechas']);
		$i=0;$x=0;
		while($x<count($fechas)-2){
			if(strtotime($fechas[$i])<strtotime(date('2014-11-23'))){
				$i++;
			}
			$x++;
		}

		$monto=explode("%",$m2['monto']);
		//echo "contrato ".$m['Numero']." fecha proximo abono: ".$fechas[$i]." monto ".$monto[$i]."<br>";
		mysql_query("UPDATE contrato set proximo_abono='".$fechas[$i]."' where Numero='".$m2['Numero']."'");	
	}
}
function p_a_s(){
	/////////////////subcontratos
	$q="select * from contrato where Fecha>'2014-11-01' and Numero like '%-%' order by proximo_abono";
	$r=mysql_query($q);
	while($m=mysql_fetch_array($r)){
		$n=mysql_query("select * from subcontratos where numero='".$m['Numero']."'");
		$m2=mysql_fetch_array($n);
		$fechas=explode('%',$m2['fechas']);
		$i=0;$x=0;
		while($x<count($fechas)-2){
			if(strtotime($fechas[$i])<strtotime(date('2014-11-23'))){
				$i++;
			}
			$x++;
		}
		//echo "sub contrato ".$m['Numero']." fecha proximo abono: ".$fechas[$i]."<br>";
		mysql_query("UPDATE contrato set proximo_abono='".$fechas[$i]."' where Numero='".$m2['numero']."'");
	}	
}	
?>


</body>
</html>