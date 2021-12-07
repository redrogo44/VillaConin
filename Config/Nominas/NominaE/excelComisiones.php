<?php

error_reporting(0);

//print_r($_POST);

include("../../configuraciones.php");

conectar();

$numeroSemana = date("W");

$Con = "Select * From Cornfirmacion_Nomina_Comision Where id=".$_GET['i'];

$com=mysql_fetch_array(mysql_query($Con));

$fecha=$com['Texto'];

$nombres=explode(",",$com['nombres']);

	$tComensales=0;

	$co=explode(",",$com['comensales']);

	for ($i=1; $i <count($co) ; $i++) 

	{ 

		$tComensales+=$co[$i];

	}



//print_r($nombres);

//echo $com['nombres'];

header('Content-type: application/vnd.ms-excel');

header("Content-Disposition: attachment; filename=NominaComision.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title>Nomina de Comisiones</title>

<?php

function Nombres($n)

{	

	for ($i=1; $i <count($n) ; $i++) 

	{ 

		$nn=explode("-",$n[$i]);

		echo "<td align='center'>Factor</td><td align='center'>".$nn[0]."</td>";

	}

}

function diasTrabajados()

{

	$d = "Select dias_trabajados, sueldos From Cornfirmacion_Nomina_Comision Where id=".$_GET['i'];

	$com=mysql_fetch_array(mysql_query($d));

	$dd=explode(",",$com['dias_trabajados']);

	$s=explode(",",$com['sueldos']);

	for ($i=1; $i <count($dd) ; $i++) { 

		echo "<td align='center'>".$dd[$i]."</td><td align='center'>".$s[$i]."</td>";

	}

}

function Puntos()

{

	$d = "Select puntos From Cornfirmacion_Nomina_Comision Where id=".$_GET['i'];

	$com=mysql_fetch_array(mysql_query($d));

	$dd=explode(",",$com['puntos']);

	for ($i=1; $i <count($dd) ; $i++) { 

		echo "<td colspan='2' align='center'>".$dd[$i]."</td>";

	}

}

function Contratos()

{

	$d = "Select nombres, contratos, comensales,factores,comisiones From Cornfirmacion_Nomina_Comision Where id=".$_GET['i'];

	$co=mysql_fetch_array(mysql_query($d));

	$con=explode(",",$co['contratos']);

	$com=explode(",",$co['comensales']);

	$fac=explode(",",$co['factores']);

	//echo "Los Factores son : ".count($fac);

	$comi=explode(",",$co['comisiones']);

	$nom=explode(",",$co['nombres']);

	//echo "ESTO".count($nom);

	$f=1;

	//echo "El Promedio es".(count($fac)/count($nom));

	$emp=count($nom)-1;

	$ha=0;	

	for ($i=1; $i <count($con) ; $i++) 

	{ 

		echo "<tr>";https://greatmeeting.me/

		echo "<td align='center'>".$con[$i]."</td><td align='center'>".$com[$i]."</td>";		

		$ha+=$emp;

		$cont=0;

			for ($j=$f; $j <=$ha ; $j++) 

			{ 

				echo "<td align='center'>".number_format($fac[$j],3)."</td><td align='center'>".number_format($comi[$j],3)."</td>";

				$cont++;				

				if($cont==$emp)

				{

					$f+=$cont;					

					$cont=1;

				}

			}	

		echo "</tr>";

	}

}

function Comisiones()

{

	$d = "Select suma_comisiones From Cornfirmacion_Nomina_Comision Where id=".$_GET['i'];

	$co=mysql_fetch_array(mysql_query($d));

	$comi=explode(",",$co['suma_comisiones']);

	for ($i=1; $i <count($comi) ; $i++) 

	{ 

		echo "<td align='center' colspan='2'>".number_format($comi[$i],3)."</td>";				

	}

}

function Bruto()

{

	$d = "Select bruto From Cornfirmacion_Nomina_Comision Where id=".$_GET['i'];

	$co=mysql_fetch_array(mysql_query($d));

	$comi=explode(",",$co['bruto']);

	for ($i=1; $i <count($comi) ; $i++) 

	{ 

		echo "<td align='center' colspan='2'>".number_format($comi[$i],3)."</td>";				

	}

}

function Descuentos()

{

	$d = "Select descuentos From Cornfirmacion_Nomina_Comision Where id=".$_GET['i'];

	$co=mysql_fetch_array(mysql_query($d));

	$comi=explode(",",$co['descuentos']);

	for ($i=1; $i <count($comi) ; $i++) 

	{ 

		echo "<td align='center' colspan='2'>".number_format($comi[$i],3)."</td>";				

	}

}

function Neto()

{

	$d = "Select neto From Cornfirmacion_Nomina_Comision Where id=".$_GET['i'];

	$co=mysql_fetch_array(mysql_query($d));

	$comi=explode(",",$co['neto']);

	for ($i=1; $i <count($comi) ; $i++) 

	{ 

		echo "<td align='center' colspan='2'>".number_format($comi[$i],3)."</td>";				

	}

}

function Firmas()

{

	$d = "Select neto From Cornfirmacion_Nomina_Comision Where id=".$_GET['i'];

	$co=mysql_fetch_array(mysql_query($d));

	$comi=explode(",",$co['neto']);

	for ($i=1; $i <count($comi) ; $i++) 

	{ 

		echo "<td align='center' colspan='2' rowspan='2'></td>";				

	}

}

?>

</head>

<body>

<table BORDER ='1'>

<tr><td colspan="16">Eventos Sociales Villa Conin S.A. de C.V </td></tr>

<tr></tr>

<tr></tr>

<img  width="50px" src="http://villaconin.mx/Imagenes/Villa Conin.png" alt="">

<tr></tr>



<tr><td colspan="2"></td><td colspan="2"></td><td colspan="15"><b><font size="3">Fecha del <?php echo $fecha;?></font></b></td></tr>

<tr><td>Contratos</td><td>Comensales</td><?php  Nombres($nombres); ?></tr>

<tr><td colspan="2" align="center">Dias Trabajados</td><?php  diasTrabajados(); ?></tr>

<tr><td colspan="2" align="center">Puntos</td><?php  Puntos(); ?></tr>

<?php  Contratos(); ?>

<tr><td align="center">TOTAL</td><td align="center"><?php echo $tComensales;?></td></tr>

<tr><td  colspan="2" align="center">COMISIONES</td><?php Comisiones();?></tr>

<tr><td  colspan="2" align="center">BRUTO</td><?php  Bruto();?></tr>

<tr><td  colspan="2" align="center">Otros Pagos o Descuentos</td><?php Descuentos();?></tr>

<tr><td  colspan="2" align="center">Neto</td><?php  Neto();?></tr>

<tr><td  colspan="2" rowspan='2' align="center">FIRMA</td><?php Firmas();?></tr>

<tr></tr>

<tr></tr>

<tr><td colspan="6">PAGO RECIBIDO A ENTERA SATISFACCIÓN.</td></tr>

<tr><td colspan="15"></td><td colspan='2'>FECHA</td><td colspan="2"></td></tr>

<tr><td colspan="15"></td><td colspan='2'>NOMBRE DEL RESPONSABLE</td><td colspan='2'></td></tr>

<tr><td colspan="15"></td><td colspan='2'>FIRMA</td><td colspan='2'></td></tr>



</table>

</body>

</html>