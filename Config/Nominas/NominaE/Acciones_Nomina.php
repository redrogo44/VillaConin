<?php
require("../../configuraciones.php");
conectar();
date_default_timezone_set('America/Mexico_City');

if ($_POST['accion']=='Nuevo_Registro') 
{ $dep='';
	for ($i=1; $i <6; $i++) 
	{ 
		if (isset($_POST[$i]))
		{
			$dep=$dep.",".$_POST[$i];
		}
	}
	 $dep."<br>";
	$in_e="INSERT INTO `Empleados`( `nombre`, `apellidos`, `Direccion`, `telefono`, `celular`, `correo`,`fecha`, `categorias`, `sueldo`) VALUES ('".$_POST['nombre']."','".$_POST['apellidos']."','".$_POST['domicilio']."','".$_POST['telefono']."','".$_POST['celular']."','".$_POST['correo']."','".$_POST['fecha']."','".$dep."',".$_POST['sueldo'].")";
	$ne=mysql_query($in_e);
	echo "<script type='text/javascript'>
			alert('Se Agrego Correctamente al Empleado');
			 window.location ='Nominas.php';	
		  </script>";
}
if (isset($_GET['accion'])&&$_GET['accion']='elimina') 
{
	mysql_query("DELETE FROM `Empleados` WHERE `id`=".$_GET['id']);	
	echo "<script type='text/javascript'>
			alert('Se Elimino Correctamente al Empleado');
			 window.location ='Nominas.php';	
		  </script>";
}
if($_POST['accion']=='Guardar Nomina Comision')
{
	$Emp=mysql_query("SELECT * FROM Empleados");
	$nombres='';$dias_tr='';$sueldos='';$precio_Come='';$puntos='';
	$num_comensales='';$factores='';$comisiones='';$contratos='';
	$suma_comisiones='';$bruto='';$descuentos='';$neto='';
	$num_Emp=0;
	// NOMBRES DE LOS EMPLEADOS DE TIPO COMISION
	while($emple=mysql_fetch_array($Emp))
	{
		$tipo=explode(",",$emple['categorias']);
		for($i=0;$i<count($tipo);$i++)
		{
			if($tipo[$i]=='Comisiones')
			{	
				$nombres=$nombres.",".$emple['nombre']."-".$emple['id'];
				$num_Emp++;
			}
		}		
	}
	echo "<br> nombres ".$nombres;
	// 	DIAS TRABAJADOS POR EMPLEADO
	for($j=1;$j<=$num_Emp;$j++)
	{
		$dias_tr=$dias_tr.",".$_POST["Dias_T-".$j];
	}
	echo "<br> dias trabajados ".$dias_tr;
	// 	SUELDOS TRABAJADOS POR EMPLEADO
	for($j=1;$j<=$num_Emp;$j++)
	{
		$sueldos=$sueldos.",".$_POST["Sueldo".$j];
	}
	echo "<br>sueldos ".$sueldos;
	//	 PRECIOS POR COMENSAL
	$fila=1;
	for($j=1;$j<=($num_Emp*($_POST['filas']-1));$j++)
	{
		echo "<br>Precio_Comen".$j."-".$fila;
		$precio_Come=$precio_Come.",".$_POST["Precio_Comen".$j."-".$fila];
		if(($j%$num_Emp)==0)
		{
			echo "<br>".$fila++;				
		}
	}
	echo "<br> precios por comensal ".$precio_Come;
	//	 PUNTOS POR COMENSAL
	for($j=1;$j<=$num_Emp;$j++)
	{
		$puntos=$puntos.",".$_POST["Pt-".$j];
	}
	echo "<br> puntos ".$puntos;
	//	 CONTRATOS DE LA SEMANA
	for($j=1;$j<=$_POST['filas'];$j++)
	{
		$contratos=$contratos.",".$_POST["Contrato".$j];
	}
	echo "<br> contratos ".$contratos;
	//	 NUMERO DE COMENSALES POR CONTRATO
	for($j=1;$j<=$_POST['filas']-1;$j++)
	{
		$num_comensales=$num_comensales.",".$_POST["Comensal-".$j];
	}
	echo "<br> comensales por contrrato".$num_comensales;
	//	 FACTORES DE COMENSALES POR CONTRATO
	for($j=1;$j<=(($_POST['filas']-1)*$num_Emp);$j++)
	{
		echo "factor-".$j;
		$factores=$factores.",".$_POST["factor-".$j];
	}
	echo "<br> factores ".$factores;
	//	 COMISIONES DE COMENSALES POR CONTRATO
	for($j=1;$j<=(($_POST['filas']-1)*$num_Emp);$j++)
	{
		$comisiones=$comisiones.",".$_POST["x".$j];
	}
	echo "<br> comisiones ".$comisiones;
	//	SUMA DE COMISIONES
	for($j=1;$j<=($num_Emp);$j++)
	{
		$suma_comisiones=$suma_comisiones.",".$_POST["Comision".$j];
	}
	echo "<br> suma de comisiones   ".$suma_comisiones;
	//	BRUTOS
	for($j=1;$j<=($num_Emp);$j++)
	{
		$bruto=$bruto.",".$_POST["Bruto".$j];
	}
	echo "<br>brutos ".$bruto;
	//	DESCUENTOS
	for($j=1;$j<=($num_Emp);$j++)
	{
		$descuentos=$descuentos.",".$_POST["descuento".$j];
	}
	echo "<br> descuentos ".$descuentos;
	//	NETO
	for($j=1;$j<=($num_Emp);$j++)
	{
		$neto=$neto.",".$_POST["Neto".$j];
	}
	echo "<br> netos ".$neto;
	//	NORMALES y aplicadas
	for($j=1;$j<=($_POST['filas']-1);$j++)
	{
		$normales=$normales.",".$_POST["normal-".$j];
		$aplicadas=$aplicadas.",".$_POST['aplicada-'.$j];
	}
	echo "<br> normales ".$normales;
	echo "<br> aplicadas ".$aplicadas."<br>";

	echo $insert="INSERT INTO `Cornfirmacion_Nomina_Comision`(`nombres`, `dias_trabajados`,`sueldos`, `puntos`,`costos_comensal`,`contratos`,`comensales`,`factores`,`comisiones`,`suma_comisiones`, `bruto`, `descuentos`, `neto`, `normales`, `aplicadas`, `fecha`,`Texto`) 	VALUES ('".$nombres."','".$dias_tr."','".$sueldos."','".$puntos."','".$precio_Come."','".$contratos."','".$num_comensales."','".$factores."','".$comisiones."','".$suma_comisiones."','".$bruto."','".$descuentos."','".$neto."','".$normales."','".$aplicadas."','".date('Y-m-d')."','".$_POST['Texto']."'  )";
	mysql_query($insert);

	echo "<script type='text/javascript'>
			alert('Se Guardo Correctamente la Nomina');
			 window.location ='Nominas.php';	
		  </script>";

}
if($_POST['tipo']=='GUARDA NOMINA EXTRA')
{

	

	$em=mysql_query("SELECT * FROM Empleados");
	$nombres='';$costos='';$checks='';$he='';$hs='';$totales='';
	while($emp=mysql_fetch_array($em))
	{
		$tipo=explode(",",$emp['categorias']);
		for($i=0;$i<count($tipo);$i++)
		{
			if($tipo[$i]=='Extras')
			{	
				$nombres=$nombres.",".$emp['nombre']." ".$emp['apellidos']."-".$emp['id'];
				$num_Emp++;
			}
		}		
	}
	echo "<br>".$nombres;
	// SUEDO POR DIA 
	for($o=1;$o<=$_POST['filas'];$o++)
	{
		$costos=$costos.",".$_POST['lunes'.$o].",".$_POST['martes'.$o].",".$_POST['miercoles'.$o].",".$_POST['jueves'.$o].",".$_POST['viernes'.$o].",".$_POST['sabado'.$o].",".$_POST['domingo'.$o];
	}
	
	echo "<br>".$costos;
	// CHECKS SELECCIONADOS
	for($r=0;$r<$_POST['Checks'];$r++)
	{
		if(isset($_POST[$r])&&$_POST[$r]==$r)
		{
			$checks=$checks.",".$_POST[$r];
		}
	}
	echo $checks;
	// HORAS DE ENTRADA Y SALIDA   y TOTALES
	for($g=1;$g<=$_POST['filas'];$g++)
	{
		$he=$he.",".$_POST['Hora_E'.$g];
		$hs=$hs.",".$_POST['Hora_S'.$g];
		$totales=$totales.",".$_POST['total'.$g];
		$puntos=$puntos.",".$_POST["puntos".$g];
	}
	echo "<br>".$he;
	echo "<br>".$hs;
	echo "<br>".$totales;
	echo "<br> puntos ".$puntos;

 echo $insertt="INSERT INTO `Confirmacion_Nomina_Extras`(`nombres`, `costos`, `checks`, `hora_entrada`, `hora_salida`, `totales`, `puntos`, `fecha`,`Texto`) VALUES ('".$nombres."','".$costos."','".$checks."','".$he."','".$hs."','".$totales."','".$puntos."','".date('Y-m-d')."', '".$_POST['Texto']."' )";	
	mysql_query($insertt);

	echo "<script type='text/javascript'>
			alert('Se Guardo Correctamente la Nomina');
			 window.location ='Nominas.php';	
		  </script>";
header('Location: Nominas.php');
}
if($_POST['tipo']=='GUARDA NOMINA EVENTOS')
{

	$em=mysql_query("SELECT * FROM Empleados");
	$nombres='';$costos='';$checks='';$he='';$hs='';$totales='';
	while($emp=mysql_fetch_array($em))
	{
		$tipo=explode(",",$emp['categorias']);
		for($i=0;$i<count($tipo);$i++)
		{
			if($tipo[$i]=='Eventos')
			{	
				$nombres=$nombres.",".$emp['nombre']." ".$emp['apellidos']."-".$emp['id'];
				$num_Emp++;
			}
		}		
	}
	echo "<br>".$nombres;
	// SUEDO POR DIA 
	for($o=1;$o<=$_POST['filas'];$o++)
	{
		$costos=$costos.",".$_POST['lunes'.$o].",".$_POST['martes'.$o].",".$_POST['miercoles'.$o].",".$_POST['jueves'.$o].",".$_POST['viernes'.$o].",".$_POST['sabado'.$o].",".$_POST['domingo'.$o];
	}
	
	echo "<br>".$costos;
	// CHECKS SELECCIONADOS
	for($r=0;$r<$_POST['Checks'];$r++)
	{
		if(isset($_POST[$r])&&$_POST[$r]==$r)
		{
			$checks=$checks.",".$_POST[$r];
		}
	}
	echo "<br> checks ".$checks;
	// HORAS DE ENTRADA Y SALIDA   y TOTALES
	for($g=1;$g<=$_POST['filas'];$g++)
	{
		$he=$he.",".$_POST['Hora_E'.$g];
		$hs=$hs.",".$_POST['Hora_S'.$g];
		$totales=$totales.",".$_POST['total'.$g];
		$puntos.=",".$_POST["puntos".$g];
	}
	echo "<br>".$he;
	echo "<br>".$hs;
	echo "<br>".$totales;
	echo "<br> puntos ".$puntos;

 echo $insertt="INSERT INTO `Confirmacion_Nomina_Eventos`(`nombres`, `costos`, `checks`, `hora_entrada`, `hora_salida`, `totales`, `puntos`, `fecha`,`Texto`) VALUES ('".$nombres."','".$costos."','".$checks."','".$he."','".$hs."','".$totales."','".$puntos."','".date('Y-m-d')."','".$_POST['Texto']."'  )";	

// echo "<br>POST: <pre>";
// 		print_r($_POST);
// 	echo "</pre>";
// 	die();

mysql_query($insertt);
echo "<script type='text/javascript'>
			alert('Se Guardo Correctamente la Nomina');
			 window.location ='Nominas.php';	
		  </script>";

}
if($_POST['accion']=='guardar_nomina_comision')
{
	$num_Emp=$_POST['NumeroE'];
	// 	DIAS TRABAJADOS POR EMPLEADO
	for($j=1;$j<=$num_Emp;$j++)
	{
		$dias_tr=$dias_tr.",".$_POST["Dias_T-".$j];
	}
	echo "<br> dias trabajados ".$dias_tr;
	// 	SUELDOS TRABAJADOS POR EMPLEADO
	for($j=1;$j<=$num_Emp;$j++)
	{
		$sueldos=$sueldos.",".$_POST["Sueldo".$j];
	}
	echo "<br>sueldos ".$sueldos;
//	 PRECIOS POR COMENSAL
	for($j=1;$j<=($num_Emp*($_POST['Filas']));$j++)
	{
		$precio_Come=$precio_Come.",".$_POST["Precio_Comen".$j];		
	}
	echo "<br> precios por comensal ".$precio_Come;
	//	 PUNTOS POR COMENSAL
	for($j=1;$j<=$num_Emp;$j++)
	{
		$puntos=$puntos.",".$_POST["Pt-".$j];
	}
	echo "<br> puntos ".$puntos;
	//	 CONTRATOS DE LA SEMANA
	for($j=1;$j<=$_POST['Filas'];$j++)
	{
		$contratos=$contratos.",".$_POST["Contrato".$j];
	}
	echo "<br> contratos ".$contratos;
	//	 NUMERO DE COMENSALES POR CONTRATO
	for($j=1;$j<=$_POST['Filas'];$j++)
	{
		$num_comensales=$num_comensales.",".$_POST["Comensales-".$j];
	}
	echo "<br> comensales por contrrato".$num_comensales;
	//	 FACTORES DE COMENSALES POR CONTRATO
	for($j=1;$j<=(($_POST['Filas'])*$num_Emp);$j++)
	{
		$factores=$factores.",".$_POST["factor".$j];
	}
	echo "<br> factores ".$factores;
	//	 COMISIONES DE COMENSALES POR CONTRATO
	for($j=1;$j<=(($_POST['Filas'])*$num_Emp);$j++)
	{
		$comisiones=$comisiones.",".$_POST["x".$j];
	}
	echo "<br> comisiones ".$comisiones;
	//	SUMA DE COMISIONES
	for($j=1;$j<=($num_Emp);$j++)
	{
			$suma_comisiones=$suma_comisiones.",".$_POST["Comision".$j];
	}
	echo "<br> suma de comisiones ".$suma_comisiones;
	//	BRUTOS
	for($j=1;$j<=($num_Emp);$j++)
	{
		
		$bruto=$bruto.",".$_POST["Bruto".$j];
	
	}
	echo "<br>brutos ".$bruto;
	//	DESCUENTOS
	for($j=1;$j<=($num_Emp);$j++)
	{
		$descuentos=$descuentos.",".$_POST["descuento".$j];
	}
	echo "<br> descuentos ".$descuentos;
	//	NETO
	for($j=1;$j<=($num_Emp);$j++)
	{
		
			$neto=$neto.",".$_POST["Neto".$j];	
	}
	echo "<br> netos ".$neto;
	//	NORMALES y aplicadas
	for($j=1;$j<=($_POST['Filas']);$j++)
	{
		$normales=$normales.",".$_POST["normal-".$j];
		$aplicadas=$aplicadas.",".$_POST['aplicada-'.$j];
	}
	echo "<br> normales ".$normales;
	echo "<br> aplicadas ".$aplicadas."<br>";
	$id=explode("-",$_POST['Nomina']);
	echo $up="UPDATE `Cornfirmacion_Nomina_Comision` 
	SET `dias_trabajados`='".$dias_tr."',`sueldos`='".$sueldos."',`puntos`='".$puntos."',
	`costos_comensal`='".$precio_Come."',`contratos`='".$contratos."',`comensales`='".$num_comensales."',
	`factores`='".$factores."',`comisiones`='".$comisiones."',`suma_comisiones`='".$suma_comisiones."',
	`bruto`='".$bruto."',`descuentos`='".$descuentos."',`neto`='".$neto."',`normales`='".$normales."',
	`aplicadas`='".$aplicadas."',`fecha`='".date('Y-m-d')."' WHERE id=".$id[1];
	mysql_query($up);

	echo "<script type='text/javascript'>

			alert('Se Guardo Correctamente la Nomina');			
			 window.location ='Nominas.php';	
		  </script>";
	
}
if($_POST['accion']=='confirma_nomina_comision')
{
	$num_Emp=$_POST['NumeroE'];
	// 	DIAS TRABAJADOS POR EMPLEADO
	for($j=1;$j<=$num_Emp;$j++)
	{
		$dias_tr=$dias_tr.",".$_POST["Dias_T-".$j];
	}
	echo "<br> dias trabajados ".$dias_tr;
	// 	SUELDOS TRABAJADOS POR EMPLEADO
	for($j=1;$j<=$num_Emp;$j++)
	{
		$sueldos=$sueldos.",".$_POST["Sueldo".$j];
	}
	echo "<br>sueldos ".$sueldos;
//	 PRECIOS POR COMENSAL
	for($j=1;$j<=($num_Emp*($_POST['Filas']));$j++)
	{
		$precio_Come=$precio_Come.",".$_POST["Precio_Comen".$j];		
	}
	echo "<br> precios por comensal ".$precio_Come;
	//	 PUNTOS POR COMENSAL
	for($j=1;$j<=$num_Emp;$j++)
	{
		$puntos=$puntos.",".$_POST["Pt-".$j];
	}
	echo "<br> puntos ".$puntos;
	//	 CONTRATOS DE LA SEMANA
	for($j=1;$j<=$_POST['Filas'];$j++)
	{
		$contratos=$contratos.",".$_POST["Contrato".$j];
	}
	echo "<br> contratos ".$contratos;
	//	 NUMERO DE COMENSALES POR CONTRATO
	for($j=1;$j<=$_POST['Filas'];$j++)
	{
		$num_comensales=$num_comensales.",".$_POST["Comensales-".$j];
	}
	echo "<br> comensales por contrrato".$num_comensales;
	//	 FACTORES DE COMENSALES POR CONTRATO
	for($j=1;$j<=(($_POST['Filas'])*$num_Emp);$j++)
	{
		$factores=$factores.",".$_POST["factor".$j];
	}
	echo "<br> factores ".$factores;
	//	 COMISIONES DE COMENSALES POR CONTRATO
	for($j=1;$j<=(($_POST['Filas'])*$num_Emp);$j++)
	{
		$comisiones=$comisiones.",".$_POST["x".$j];
	}
	echo "<br> comisiones ".$comisiones;
	//	SUMA DE COMISIONES
	for($j=1;$j<=($num_Emp);$j++)
	{
		if(isset($_POST["Contrato".$j]))
		{
			$suma_comisiones=$suma_comisiones.",".$_POST["Comision".$j];
		}
		else{
			$suma_comisiones=$suma_comisiones.",0";			
		}
	}
	echo "<br> suma de comisiones ".$suma_comisiones;
	//	BRUTOS
	for($j=1;$j<=($num_Emp);$j++)
	{
		if(isset($_POST["Contrato".$j]))
		{
		$bruto=$bruto.",".$_POST["Bruto".$j];
		}
		else
		{
		$bruto=$bruto.",0";
		}

	}
	echo "<br>brutos ".$bruto;
	//	DESCUENTOS
	for($j=1;$j<=($num_Emp);$j++)
	{
		$descuentos=$descuentos.",".$_POST["descuento".$j];
	}
	echo "<br> descuentos ".$descuentos;
	//	NETO
	for($j=1;$j<=($num_Emp);$j++)
	{
		if(isset($_POST["Contrato".$j]))
		{
			$neto=$neto.",".$_POST["Neto".$j];
			$totalN2+=$_POST["Neto".$j];
		}
		else {
			$neto=$neto.",0";
			//$totalN2+=$_POST["Neto".$j];
		}
	}
	echo "<br> netos ".$neto;
	//	NORMALES y aplicadas
	for($j=1;$j<=($_POST['Filas']);$j++)
	{
		$normales=$normales.",".$_POST["normal-".$j];
		$aplicadas=$aplicadas.",".$_POST['aplicada-'.$j];
	}
	echo "<br> normales ".$normales;
	echo "<br> aplicadas ".$aplicadas."<br>";
	$id=explode("-",$_POST['Nomina']);

	echo $up="UPDATE `Cornfirmacion_Nomina_Comision` 
	SET `dias_trabajados`='".$dias_trabajadosas_tr."',`sueldos`='".$sueldos."',`puntos`='".$puntos."',
	`costos_comensal`='".$precio_Come."',`contratos`='".$contratos."',`comensales`='".$num_comensales."',
	`factores`='".$factores."',`comisiones`='".$comisiones."',`suma_comisiones`='".$suma_comisiones."',
	`bruto`='".$bruto."',`descuentos`='".$descuentos."',`neto`='".$neto."',`normales`='".$normales."',
	`aplicadas`='".$aplicadas."',`fecha`='".$_POST['fecha']."',`confirmado`='si' WHERE id=".$id[1];
	mysql_query($up);
	//		puntos   	///////////////////////////////////////7
	$nomm=mysql_query("SELECT * FROM Cornfirmacion_Nomina_Comision WHERE id=".$id[1]);
	$nno=mysql_fetch_array($nomm);
	$nombres=explode(",", $nno['nombres']);

		for($m=1;$m<=$num_Emp;$m++)
		{$punto=0;			
			$e=explode("-",$nombres[$m]);
			$em=mysql_query("SELECT * FROM Empleados WHERE id=".$e[1]);
			$emp=mysql_fetch_array($em);
			echo "<br> puntos Empleado".$punto=$emp['puntos'];
			echo "<br> Suma de Puntos".$punto=$_POST["Pt-".$m]+$punto;
		 mysql_query("UPDATE `Empleados` SET  `puntos`='".$punto."' WHERE id=".$e[1]);

			//$udpp=mysql_query("UP")
		}
	mysql_query("INSERT INTO `Movimientos_Cuentas`(`fecha`, `banco_emisor`, `cuenta_emisor`, `banco_receptor`, `cuenta_receptora`, `cantidad`, `concepto`)  VALUES ('".$_POST['fecha']."','".$_POST['banco']."','".$_POST['cuenta']."','Nomina-Comision','Nomina-Comision',".$totalN2.",'Nomina de Comision' )");

	colocarPuntos('Cornfirmacion_Nomina_Comision',$id[1]);
	////////////////////////////////////////////////////////////7

	echo "<script type='text/javascript'>

			alert('Se ha Confirmado Correctamente la Nomina');	
			window.open('PDF_Nominas.php?tipo=comision&&id=".$id[1]."','_blank');		
			 window.location ='Nominas.php';	
		  </script>";


}
if($_POST['accion']=='guardar_nomina_eventos')
{
	$costos='';
	for($o=1;$o<=$_POST['Filas']-1;$o++)
	{
		$costos=$costos.",".$_POST['lunes'.$o].",".$_POST['martes'.$o].",".$_POST['miercoles'.$o].",".$_POST['jueves'.$o].",".$_POST['viernes'.$o].",".$_POST['sabado'.$o].",".$_POST['domingo'.$o];
	}
	
	echo "<br>".$costos;
	// CHECKS SELECCIONADOS	
	for($r=0;$r<$_POST['Checks'];$r++)
	{
		if(isset($_POST[$r])&&$_POST[$r]==$r)
		{
			$checks=$checks.",".$_POST[$r];
		}
	}

	echo "<br> checks ".$checks;
	// HORAS DE ENTRADA Y SALIDA   y TOTALES
	for($g=1;$g<$_POST['Filas'];$g++)
	{
		$he=$he.",".$_POST['Hora_E'.$g];
		$hs=$hs.",".$_POST['Hora_S'.$g];
		$totales=$totales.",".$_POST['total'.$g];
		$puntos.=",".$_POST["puntos".$g];
	}
	echo "<br>".$he;
	echo "<br>".$hs;
	echo "<br>".$totales;
	echo "<br> puntos ".$puntos;
	$id=explode("-",$_POST['Nomina']);
	echo $up="UPDATE `Confirmacion_Nomina_Eventos` SET `costos`='".$costos."',`checks`='".$checks."',`hora_entrada`='".$he."',`hora_salida`='".$hs."',`totales`='".$totales."',`puntos`='".$puntos."',`fecha`='".date("Y-m-d")."' WHERE id=".$id[1];
	mysql_query($up);

	echo "<script type='text/javascript'>
			alert('Se ha Guardado Correctamente la Nomina');
			 window.location ='Nominas.php';	
		  </script>";

}
if($_POST['accion']=='guardaExtra')
{
	
	$costos='';
	for($o=1;$o<$_POST['Filas'];$o++)
	{
		$costos=$costos.",".$_POST['lunes'.$o].",".$_POST['martes'.$o].",".$_POST['miercoles'.$o].",".$_POST['jueves'.$o].",".$_POST['viernes'.$o].",".$_POST['sabado'.$o].",".$_POST['domingo'.$o];
	}
	
	echo "<br>".$costos;
	// CHECKS SELECCIONADOS
	for($r=0;$r<$_POST['Checks'];$r++)
	{
		if(isset($_POST[$r])&&$_POST[$r]==$r)
		{
			$checks=$checks.",".$_POST[$r];
		}
	}
	echo "<br> checks ".$checks;
	// HORAS DE ENTRADA Y SALIDA   y TOTALES
	for($g=1;$g<$_POST['Filas'];$g++)
	{
		$he=$he.",".$_POST['Hora_E'.$g];
		$hs=$hs.",".$_POST['Hora_S'.$g];
		$totales=$totales.",".$_POST['total'.$g];
		$puntos=$puntos.",".$_POST["puntos".$g];
	}
	echo "<br>".$he;
	echo "<br>".$hs;
	echo "<br>".$totales;
	echo "<br> puntos ".$puntos;
	$id=explode("-",$_POST['Nomina']);
	echo $up="UPDATE `Confirmacion_Nomina_Extras` SET `costos`='".$costos."',`checks`='".$checks."',`hora_entrada`='".$he."',`hora_salida`='".$hs."',`totales`='".$totales."',`puntos`='".$puntos."',`fecha`='".date("Y-m-d")."' WHERE id=".$id[1];
	mysql_query($up);
	echo "<script type='text/javascript'>
			alert('Se ha Guardado Correctamente la Nomina');
			window.location ='Nominas.php';			
			
		  </script>";
		
}
if($_POST['accion']=='confirma_nomina_eventos')
{
	$costos='';
	for($o=1;$o<=$_POST['Filas']-1;$o++)
	{
		$costos=$costos.",".$_POST['lunes'.$o].",".$_POST['martes'.$o].",".$_POST['miercoles'.$o].",".$_POST['jueves'.$o].",".$_POST['viernes'.$o].",".$_POST['sabado'.$o].",".$_POST['domingo'.$o];
	}
	
	echo "<br>".$costos;
	// CHECKS SELECCIONADOS
	for($r=0;$r<$_POST['Checks'];$r++)
	{
		if(isset($_POST[$r])&&$_POST[$r]==$r)
		{
			$checks=$checks.",".$_POST[$r];
		}
	}
	echo "<br> checks ".$checks;
	// HORAS DE ENTRADA Y SALIDA   y TOTALES
	for($g=1;$g<=$_POST['Filas'];$g++)
	{
		if(isset($_POST['Hora_E'.$g])&&$_POST['Hora_E'.$g]!='')
		{
			$he=$he.",".$_POST['Hora_E'.$g];
			$hs=$hs.",".$_POST['Hora_S'.$g];
			$totales=$totales.",".$_POST['total'.$g];
			$puntos=$puntos.",".$_POST["puntos".$g];
			$totalN2+=$_POST['total'.$g];	
		}
		
	}
	echo "<br>".$he;
	echo "<br>".$hs;
	echo "<br>".$totales;
	echo "<br> puntos ".$puntos;
	$id=explode("-",$_POST['Nomina']);
	echo $up="UPDATE `Confirmacion_Nomina_Eventos` SET `costos`='".$costos."',`checks`='".$checks."',`hora_entrada`='".$he."',`hora_salida`='".$hs."',`totales`='".$totales."',`puntos`='".$puntos."',`fecha`='".$_POST['fecha']."',`confirmado`='si' WHERE id=".$id[1];
	mysql_query($up);
	$n=mysql_query("SELECT * FROM Confirmacion_Nomina_Eventos WHERE id=".$id[1]);
	$es=mysql_fetch_array($n);
	$ev=explode(",",$es['nombres']);
	for($m=1;$m<$_POST['Filas']-1;$m++)
		{$punto=0;			
			$e=explode("-",$ev[$m]);
			$em=mysql_query("SELECT * FROM Empleados WHERE id=".$e[1]);
			$emp=mysql_fetch_array($em);
			echo "<br> puntos Empleado".$punto=$emp['puntos'];
			echo "<br> Suma de Puntos".$punto=$_POST["puntos".$m]+$punto;
			echo "<br>".$empp="UPDATE `Empleados` SET  `puntos`='".$punto."' WHERE id=".$e[1];
		}
		mysql_query($e);
	

	mysql_query("INSERT INTO `Movimientos_Cuentas`(`fecha`, `banco_emisor`, `cuenta_emisor`, `banco_receptor`, `cuenta_receptora`, `cantidad`, `concepto`)  VALUES ('".$_POST['fecha']."','".$_POST['banco']."','".$_POST['cuenta']."','Nomina-Eventos','Nomina-eventos',".$totalN2.",'Nomina de Eventos' )");

		colocarPuntos('Confirmacion_Nomina_Eventos',$id[1]);
	
	
echo "<script type='text/javascript'>
			alert('Se ha Guardado Correctamente la Nomina');
			window.open('PDF_Nominas.php?tipo=eventos&&id=".$id[1]."','_blank');				
			 window.location ='Nominas.php';	
		  </script>";	

}
if($_POST['accion']=='confirma_nomina_extras')
{
	$costos='';
	for($o=1;$o<=$_POST['Filas']-1;$o++)
	{
		$costos=$costos.",".$_POST['lunes'.$o].",".$_POST['martes'.$o].",".$_POST['miercoles'.$o].",".$_POST['jueves'.$o].",".$_POST['viernes'.$o].",".$_POST['sabado'.$o].",".$_POST['domingo'.$o];
	}
	
	echo "<br>".$costos;
	// CHECKS SELECCIONADOS
	for($r=0;$r<$_POST['Checks'];$r++)
	{
		if(isset($_POST[$r])&&$_POST[$r]==$r)
		{
			$checks=$checks.",".$_POST[$r];
		}
	}
	echo "<br> checks ".$checks;
	// HORAS DE ENTRADA Y SALIDA   y TOTALES
	for($g=1;$g<=$_POST['Filas'];$g++)
	{
		if(isset($_POST['Hora_E'.$g])&&$_POST['Hora_E'.$g]!='')
		{
			$he=$he.",".$_POST['Hora_E'.$g];
			$hs=$hs.",".$_POST['Hora_S'.$g];
			$totales=$totales.",".$_POST['total'.$g];
			$puntos.=",".$_POST["puntos".$g];
			$totalN2+=$_POST['total'.$g];
		}
		else
		{
			$puntos+=',';
		}
	}
	echo "<br>".$he;
	echo "<br>".$hs;
	echo "<br>".$totales;
	echo "<br> puntos ".$puntos;
	$id=explode("-",$_POST['Nomina']);
	echo $up="UPDATE `Confirmacion_Nomina_Extras` SET `costos`='".$costos."',`checks`='".$checks."',`hora_entrada`='".$he."',`hora_salida`='".$hs."',`totales`='".$totales."',`puntos`='".$puntos."',`fecha`='".$_POST['fecha']."',`confirmado`='si' WHERE id=".$id[1];
	mysql_query($up);
	
	$n=mysql_query("SELECT * FROM Confirmacion_Nomina_Extras WHERE id=".$id[1]);
	$es=mysql_fetch_array($n);
	$ev=explode(",",$es['nombres']);
	for($m=1;$m<=$_POST['Filas']-1;$m++)
		{$punto=0;			
			$e=explode("-",$ev[$m]);
			$em=mysql_query("SELECT * FROM Empleados WHERE id=".$e[1]);
			$emp=mysql_fetch_array($em);
			echo "<br> puntos Empleado".$punto=$emp['puntos'];
			echo "<br> Suma de Puntos".$punto=$_POST["puntos".$m]+$punto;
			echo "<br>".$empp="UPDATE `Empleados` SET  `puntos`='".$punto."' WHERE id=".$e[1];
		}
		mysql_query($e);
	
	mysql_query("INSERT INTO `Movimientos_Cuentas`(`fecha`, `banco_emisor`, `cuenta_emisor`, `banco_receptor`, `cuenta_receptora`, `cantidad`, `concepto`)  VALUES ('".$_POST['fecha']."','".$_POST['banco']."','".$_POST['cuenta']."','Nomina-Extras','Nomina-Extras',".$totalN2.",'Nomina de Extras' )");
	
	colocarPuntos('Confirmacion_Nomina_Extras',$id[1]);

	echo "<script type='text/javascript'>
			alert('Se ha Guardado Correctamente la Nomina');
			window.open('PDF_Nominas.php?tipo=extras&&id=".$id[1]."','_blank');				
			 window.location ='Nominas.php';	
		  </script>";
	  
}
if($_POST['tipo']=='GUARDA NOMINA PLANTA')
{
	
	echo "<br>";
	$he='';$hs='';$salario='';$diast='';$nombres='';$pagoe='';
	$exs='';$pe='';$neventos='';$descuentos='';$totalSemana='';
	$puntos='';$totalNomina='';
	$em=mysql_query("SELECT * FROM Empleados");
	$nombres='';$costos='';$checks='';$he='';$hs='';$totales='';
	while($emp=mysql_fetch_array($em))
	{
		$tipo=explode(",",$emp['categorias']);
		for($i=0;$i<count($tipo);$i++)
		{
			if($tipo[$i]=='Planta')
			{	
				$nombres=$nombres.",".$emp['nombre']." ".$emp['apellidos']."-".$emp['id'];
				$sueldos=$sueldos.",".$emp['sueldo'];
				$num_Emp++;
			}
		}		
	}
	echo "<br>nombres ".$nombres;
	echo "<br>sueldos ".$sueldos;
	for($i=1; $i <= $_POST['filas']; $i++)
	{
		echo "<br>".$he=$he.",".$_POST['Hora_E'.$i];
		$hs=$hs.",".$_POST['Hora_S'.$i];
		$diast=$diast.",".$_POST['Dias_T'.$i];
		$pagoe=$pagoe.",".$_POST['Pago_E'.$i];
		$neventos=$neventos.",".$_POST['Eventos_Sem'.$i];
		$descuentos=$descuentos.",".$_POST['Descuentos'.$i];
		$total_eventos=$total_eventos.",".$_POST['PagoEventos'.$i];
		$totalSemana=$totalSemana.",".$_POST['Total_Semana'.$i];
		$puntos=$puntos.",".$_POST['Puntos'.$i];
		$totalNomina=$totalNomina.",".$_POST['Total'.$i];
	}
	echo "<br>horas de entrada ".$he;
	echo "<br> horas de salida".$hs;
	echo "<br> dias trabajds".$diast;
	echo "<br> pagos x evento".$pagoe;
	echo "<br> Numero de Evetos ".$neventos;
	echo "<br> Descuentos ".$descuentos;
	echo "<br> Total Evetnos ".$total_eventos;
	echo "<br> Totales x Semana ".$totalSemana;
	echo "<br> Puntos ".$puntos;
	echo "<br> Totales ".$totalNomina."<br>";
	
	echo $ins="INSERT INTO `Confirmacion_Nomina_Planta`(`nombres`, `hora_entrada`, `hora_salida`, `salario`, `dias_trabajados`, `pago_evento`, `neventos_semana`, `total_eventos`, `descuentos`, `salario_semana`, `puntos`, `Total_nomina`, `fecha`,`Texto`) 
							VALUES ('".$nombres."','".$he."','".$hs."','".$sueldos."','".$diast."','".$pagoe."','".$neventos."','".$total_eventos."','".$descuentos."','".$totalSemana."','".$puntos."','".$totalNomina."','".date('Y-m-d')."', '".$_POST['Texto']."')";
							mysql_query($ins);
	
 echo "<script type='text/javascript'>
			alert('Se ha Guardado Correctamente la Nomina');		
			 window.location ='Nominas.php';	
		  </script>";

	
}
if($_POST['accion']=='guardar_nomina_planta')
{
	$he='';$hs='';$salario='';$diast='';$nombres='';$pagoe='';
	$exs='';$pe='';$neventos='';$descuentos='';$totalSemana='';
	$puntos='';$totalNomina='';
	$em=mysql_query("SELECT * FROM Empleados");
	$nombres='';$costos='';$checks='';$he='';$hs='';$totales='';
	while($emp=mysql_fetch_array($em))
	{
		$tipo=explode(",",$emp['categorias']);
		for($i=0;$i<count($tipo);$i++)
		{
			if($tipo[$i]=='Planta')
			{	
				$nombres=$nombres.",".$emp['nombre']." ".$emp['apellidos']."-".$emp['id'];
				$sueldos=$sueldos.",".$emp['sueldo'];
				$num_Emp++;
			}
		}		
	}
	echo "<br>nombres ".$nombres;
	echo "<br>sueldos ".$sueldos;
	for($i=1;$i<=$_POST['filas'];$i++)
	{
		$he=$he.",".$_POST['Hora_E'.$i];
		$hs=$hs.",".$_POST['Hora_S'.$i];
		$diast=$diast.",".$_POST['Dias_T'.$i];
		$pagoe=$pagoe.",".$_POST['Pago_E'.$i];
		$neventos=$neventos.",".$_POST['Eventos_Sem'.$i];
		$descuentos=$descuentos.",".$_POST['Descuentos'.$i];
		$total_eventos=$total_eventos.",".$_POST['PagoEventos'.$i];
		$totalSemana=$totalSemana.",".$_POST['Total_Semana'.$i];
		$puntos=$puntos.",".$_POST['Puntos'.$i];
		$totalNomina=$totalNomina.",".$_POST['Total'.$i];
	}
	echo "<br>horas de entrada ".$he;
	echo "<br> horas de salida".$hs;
	echo "<br> dias trabajds".$diast;
	echo "<br> pagos x evento".$pagoe;
	echo "<br> Numero de Evetos ".$neventos;
	echo "<br> Descuentos ".$descuentos;
	echo "<br> Total Evetnos ".$total_eventos;
	echo "<br> Totales x Semana ".$totalSemana;
	echo "<br> Puntos ".$puntos;
	echo "<br> Totales ".$totalNomina."<br>";
	$id=explode("-",$_POST['Nomina']);
	echo $ins="UPDATE `Confirmacion_Nomina_Planta` SET `nombres`='".$nombres."',`hora_entrada`='".$he."',`hora_salida`='".$hs."',
	`salario`='".$sueldos."',`dias_trabajados`='".$diast."',`pago_evento`='".$pagoe."',`neventos_semana`='".$neventos."',
	`total_eventos`='".$total_eventos."',`descuentos`='".$descuentos."',`salario_semana`='".$totalSemana."',`puntos`='".$puntos."',	`Total_nomina`='".$totalNomina."',`fecha`='".$_POST['fecha']."' WHERE id=".$id[1];
	mysql_query($ins);

	echo "<script type='text/javascript'>
			alert('Se ha Guardado Correctamente la Nomina');		
			 window.location ='Nominas.php';	
		  </script>";
	
}
if($_POST['accion']=='confirma_nomina_planta')
{

	$he='';$hs='';$salario='';$diast='';$nombres='';$pagoe='';
	$exs='';$pe='';$neventos='';$descuentos='';$totalSemana='';
	$puntos='';$totalNomina='';
	$em=mysql_query("SELECT * FROM Empleados");
	$nombres='';$costos='';$checks='';$he='';$hs='';$totales='';
	while($emp=mysql_fetch_array($em))
	{
		$tipo=explode(",",$emp['categorias']);
		for($i=0;$i<count($tipo);$i++)
		{
			if($tipo[$i]=='Planta')
			{	
				$nombres=$nombres.",".$emp['nombre']." ".$emp['apellidos']."-".$emp['id'];
				$sueldos=$sueldos.",".$emp['sueldo'];
				$num_Emp++;
			}
		}		
	}
	echo "<br>nombres ".$nombres;
	echo "<br>sueldos ".$sueldos;
	for($i=1;$i<=$_POST['filas'];$i++)
	{
		if(isset($_POST['Hora_E'.$i])&&$_POST['Hora_E'.$i]!='')
		{

			$he=$he.",".$_POST['Hora_E'.$i];
			$hs=$hs.",".$_POST['Hora_S'.$i];
			$diast=$diast.",".$_POST['Dias_T'.$i];
			$pagoe=$pagoe.",".$_POST['Pago_E'.$i];
			$neventos=$neventos.",".$_POST['Eventos_Sem'.$i];
			$descuentos=$descuentos.",".$_POST['Descuentos'.$i];
			$total_eventos=$total_eventos.",".$_POST['PagoEventos'.$i];
			$totalSemana=$totalSemana.",".$_POST['Total_Semana'.$i];
			$puntos.=",".$_POST['Puntos'.$i];
			$totalNomina=$totalNomina.",".$_POST['Total'.$i];
			$totalN2+=$_POST['Total'.$i];
		}
		else
		{
			$he+=",";
			$hs+=",";
			$diast+=",";
			$pagoe+=",";
			$neventos+=",";
			$descuentos+=",";
			$total_eventos+=",";
			$totalSemana+=",";
			$puntos.=",";
			$totalNomina+=",";		
		}
	}
	echo "<br>horas de entrada ".$he;
	echo "<br> horas de salida".$hs;
	echo "<br> dias trabajds".$diast;
	echo "<br> pagos x evento".$pagoe;
	echo "<br> Numero de Evetos ".$neventos;
	echo "<br> Descuentos ".$descuentos;
	echo "<br> Total Evetnos ".$total_eventos;
	echo "<br> Totales x Semana ".$totalSemana;
	echo "<br> Puntos ".$puntos;
	echo "<br> Totales ".$totalNomina."<br>";
	$id=explode("-",$_POST['Nomina']);
	echo $ins="UPDATE `Confirmacion_Nomina_Planta` SET `nombres`='".$nombres."',`hora_entrada`='".$he."',`hora_salida`='".$hs."',
	`salario`='".$sueldos."',`dias_trabajados`='".$diast."',`pago_evento`='".$pagoe."',`neventos_semana`='".$neventos."',
	`total_eventos`='".$total_eventos."',`descuentos`='".$descuentos."',`salario_semana`='".$totalSemana."',`puntos`='".$puntos."',	`Total_nomina`='".$totalNomina."',`fecha`='".$_POST['fecha']."', `confirmado`='si' WHERE id=".$id[1];
	mysql_query($ins);

	mysql_query("INSERT INTO `Movimientos_Cuentas`(`fecha`, `banco_emisor`, `cuenta_emisor`, `banco_receptor`, `cuenta_receptora`, `cantidad`, `concepto`)  VALUES ('".$_POST['fecha']."','".$_POST['banco']."','".$_POST['cuenta']."','Nomina-Planta','Nomina-Plnata',".$totalN2.",'Nomina de Planta' )");

	colocarPuntos('Confirmacion_Nomina_Planta',$id[1]);

		echo "<script type='text/javascript'>
			alert('Se ha Guardado Correctamente la Nomina');		
			window.open('PDF_Nominas.php?tipo=planta&&id=".$id[1]."','_blank');
			 window.location ='Nominas.php';	
		  </script>";
		 
}
if($_POST['accion']=='guardar_nomina_construccion')
{
	$he='';$hs='';$salario='';$diast='';$nombres='';$pagoe='';
	$exs='';$pe='';$neventos='';$descuentos='';$totalSemana='';
	$puntos='';$totalNomina='';
	$em=mysql_query("SELECT * FROM Empleados");
	$nombres='';$costos='';$checks='';$he='';$hs='';$totales='';
	while($emp=mysql_fetch_array($em))
	{
		$tipo=explode(",",$emp['categorias']);
		for($i=0;$i<count($tipo);$i++)
		{
			if($tipo[$i]=='Construccion')
			{	
				$nombres=$nombres.",".$emp['nombre']." ".$emp['apellidos']."-".$emp['id'];
				$sueldos=$sueldos.",".$emp['sueldo'];
				$num_Emp++;
			}
		}		
	}
	echo "<br>nombres ".$nombres;
	echo "<br>sueldos ".$sueldos;
	for($i=1;$i<=$_POST['filas'];$i++)
	{
		$he=$he.",".$_POST['Hora_E'.$i];
		$hs=$hs.",".$_POST['Hora_S'.$i];
		$diast=$diast.",".$_POST['Dias_T'.$i];
		$pagoe=$pagoe.",".$_POST['Pago_E'.$i];
		$neventos=$neventos.",".$_POST['Eventos_Sem'.$i];
		$descuentos=$descuentos.",".$_POST['Descuentos'.$i];
		$total_eventos=$total_eventos.",".$_POST['PagoEventos'.$i];
		$totalSemana=$totalSemana.",".$_POST['Total_Semana'.$i];
		$puntos=$puntos.",".$_POST['Puntos'.$i];
		$totalNomina=$totalNomina.",".$_POST['Total'.$i];
	}
	echo "<br>horas de entrada ".$he;
	echo "<br> horas de salida".$hs;
	echo "<br> dias trabajds".$diast;
	echo "<br> pagos x evento".$pagoe;
	echo "<br> Numero de Evetos ".$neventos;
	echo "<br> Descuentos ".$descuentos;
	echo "<br> Total Evetnos ".$total_eventos;
	echo "<br> Totales x Semana ".$totalSemana;
	echo "<br> Puntos ".$puntos;
	echo "<br> Totales ".$totalNomina."<br>";
	$id=explode("-",$_POST['Nomina']);
	echo $ins="UPDATE `Confirmacion_Nomina_Construccion` SET `nombres`='".$nombres."',`hora_entrada`='".$he."',`hora_salida`='".$hs."',
	`salario`='".$sueldos."',`dias_trabajados`='".$diast."',`pago_evento`='".$pagoe."',`neventos_semana`='".$neventos."',
	`total_eventos`='".$total_eventos."',`descuentos`='".$descuentos."',`salario_semana`='".$totalSemana."',`puntos`='".$puntos."',	`Total_nomina`='".$totalNomina."',`fecha`='".date('Y-m-d')."' WHERE id=".$id[1];
	mysql_query($ins);

		echo "<script type='text/javascript'>
			alert('Se ha Guardado Correctamente la Nomina');		
			 window.location ='Nominas.php';	
		  </script>";
}
if($_POST['accion']=='confirma_nomina_construccion')
{
	
	$he='';$hs='';$salario='';$diast='';$nombres='';$pagoe='';
	$exs='';$pe='';$neventos='';$descuentos='';$totalSemana='';
	$puntos='';$totalNomina='';
	$em=mysql_query("SELECT * FROM Empleados");
	$nombres='';$costos='';$checks='';$he='';$hs='';$totales='';
	while($emp=mysql_fetch_array($em))
	{
		$tipo=explode(",",$emp['categorias']);
		for($i=0;$i<count($tipo);$i++)
		{
			if($tipo[$i]=='Construccion')
			{	
				$nombres=$nombres.",".$emp['nombre']." ".$emp['apellidos']."-".$emp['id'];
				$sueldos=$sueldos.",".$emp['sueldo'];
				$num_Emp++;
			}
		}		
	}
	echo "<br>nombres ".$nombres;
	echo "<br>sueldos ".$sueldos;
	for($i=1;$i<=$_POST['filas'];$i++)
	{
		if(isset($_POST['Hora_E'.$i])&&$_POST['Hora_E'.$i]!='')
		{
			$he=$he.",".$_POST['Hora_E'.$i];
			$hs=$hs.",".$_POST['Hora_S'.$i];
			$diast=$diast.",".$_POST['Dias_T'.$i];
			$pagoe=$pagoe.",".$_POST['Pago_E'.$i];
			$neventos=$neventos.",".$_POST['Eventos_Sem'.$i];
			$descuentos=$descuentos.",".$_POST['Descuentos'.$i];
			$total_eventos=$total_eventos.",".$_POST['PagoEventos'.$i];
			$totalSemana=$totalSemana.",".$_POST['Total_Semana'.$i];
			$puntos=$puntos.",".$_POST['Puntos'.$i];
			$totalNomina=$totalNomina.",".$_POST['Total'.$i];
			$totalN2+=$_POST['Total'.$i];
		}
		else
		{
			$he+=",";
			$hs+=",";
			$diast+=",";
			$pagoe+=",";
			$neventos+=",";
			$descuentos+=",";
			$total_eventos+=",";
			$totalSemana+=",";
			$puntos+=",";
			$totalNomina+=",";		
		}
	}
	echo "<br>horas de entrada ".$he;
	echo "<br> horas de salida".$hs;
	echo "<br> dias trabajds".$diast;
	echo "<br> pagos x evento".$pagoe;
	echo "<br> Numero de Evetos ".$neventos;
	echo "<br> Descuentos ".$descuentos;
	echo "<br> Total Evetnos ".$total_eventos;
	echo "<br> Totales x Semana ".$totalSemana;
	echo "<br> Puntos ".$puntos;
	echo "<br> Totales ".$totalNomina."<br>";
	$id=explode("-",$_POST['Nomina']);
	echo $ins="UPDATE `Confirmacion_Nomina_Construccion` SET `nombres`='".$nombres."',`hora_entrada`='".$he."',`hora_salida`='".$hs."',
	`salario`='".$sueldos."',`dias_trabajados`='".$diast."',`pago_evento`='".$pagoe."',`neventos_semana`='".$neventos."',
	`total_eventos`='".$total_eventos."',`descuentos`='".$descuentos."',`salario_semana`='".$totalSemana."',`puntos`='".$puntos."',	`Total_nomina`='".$totalNomina."',`fecha`='".$_POST['fecha']."', `confirmado`='si' WHERE id=".$id[1];
	mysql_query($ins);

	mysql_query("INSERT INTO `Movimientos_Cuentas`(`fecha`, `banco_emisor`, `cuenta_emisor`, `banco_receptor`, `cuenta_receptora`, `cantidad`, `concepto`)  VALUES ('".$_POST['fecha']."','".$_POST['banco']."','".$_POST['cuenta']."','Nomina-Construccion','Nomina-Construccion',".$totalN2.",'Nomina de Construccion' )");

colocarPuntos('Confirmacion_Nomina_Construccion',$id[1]);
		echo "<script type='text/javascript'>
			alert('Se ha Guardado Correctamente la Nomina');		
			window.open('PDF_Nominas.php?tipo=construccion&&id=".$id[1]."','_blank');
			 window.location ='Nominas.php';	
		  </script>";
}
if($_POST['tipo']=='GUARDA NOMINA CONSTRUCCION')
{
	$he='';$hs='';$salario='';$diast='';$nombres='';$pagoe='';
	$exs='';$pe='';$neventos='';$descuentos='';$totalSemana='';
	$puntos='';$totalNomina='';
	$em=mysql_query("SELECT * FROM Empleados");
	$nombres='';$costos='';$checks='';$he='';$hs='';$totales='';
	while($emp=mysql_fetch_array($em))
	{
		$tipo=explode(",",$emp['categorias']);
		for($i=0;$i<count($tipo);$i++)
		{
			if($tipo[$i]=='Construccion')
			{	
				$nombres=$nombres.",".$emp['nombre']." ".$emp['apellidos']."-".$emp['id'];
				$sueldos=$sueldos.",".$emp['sueldo'];
				$num_Emp++;
			}
		}		
	}
	echo "<br>nombres ".$nombres;
	echo "<br>sueldos ".$sueldos;
	for($i=1;$i<=$_POST['filas'];$i++)
	{
		$he=$he.",".$_POST['Hora_E'.$i];
		$hs=$hs.",".$_POST['Hora_S'.$i];
		$diast=$diast.",".$_POST['Dias_T'.$i];
		$pagoe=$pagoe.",".$_POST['Pago_E'.$i];
		$neventos=$neventos.",".$_POST['Eventos_Sem'.$i];
		$descuentos=$descuentos.",".$_POST['Descuentos'.$i];
		$total_eventos=$total_eventos.",".$_POST['PagoEventos'.$i];
		$totalSemana=$totalSemana.",".$_POST['Total_Semana'.$i];
		$puntos=$puntos.",".$_POST['Puntos'.$i];
		$totalNomina=$totalNomina.",".$_POST['Total'.$i];
	}
	echo "<br>horas de entrada ".$he;
	echo "<br> horas de salida".$hs;
	echo "<br> dias trabajds".$diast;
	echo "<br> pagos x evento".$pagoe;
	echo "<br> Numero de Evetos ".$neventos;
	echo "<br> Descuentos ".$descuentos;
	echo "<br> Total Evetnos ".$total_eventos;
	echo "<br> Totales x Semana ".$totalSemana;
	echo "<br> Puntos ".$puntos;
	echo "<br> Totales ".$totalNomina."<br>";
	$id=explode("-",$_POST['Nomina']);
	echo $ins="INSERT INTO `Confirmacion_Nomina_Construccion`(`nombres`, `hora_entrada`, `hora_salida`, `salario`, `dias_trabajados`, `pago_evento`, `neventos_semana`, `total_eventos`, `descuentos`, `salario_semana`, `puntos`, `Total_nomina`, `fecha`,`Texto`) 
							VALUES ('".$nombres."','".$he."','".$hs."','".$sueldos."','".$diast."','".$pagoe."','".$neventos."','".$total_eventos."','".$descuentos."','".$totalSemana."','".$puntos."','".$totalNomina."','".date('Y-m-d')."','".$_POST['Texto']."' )";
							mysql_query($ins);

		echo "<script type='text/javascript'>
			alert('Se ha Guardado Correctamente la Nomina');				
			 window.location ='Nominas.php';	
		  </script>";

}
if($_POST['accion']=='ModificarEmpleado')
{
	$dep='';
	for ($i=1; $i <6; $i++) 
	{ 
		if (isset($_POST[$i]))
		{
			$dep=$dep.",".$_POST[$i];
		}
	}	
	mysql_query("UPDATE `Empleados` SET `nombre`='".$_POST['nombre']."',`apellidos`='".$_POST['apellidos']."',`Direccion`='".$_POST['domicilio']."',`telefono`='".$_POST['telefono']."',`celular`='".$_POST['celular']."',`correo`='".$_POST['correo']."',`fecha`='".$_POST['fecha']."',`categorias`='".$dep."',`sueldo`=".$_POST['sueldo']." WHERE id=".$_POST['id']);
	echo "<script>
			opener.location.reload(); 
			setTimeout(function(){ 
			opener.muestra('lista_e'); 
			cerrar();
			 }, 3000);
			 function cerrar()
			 {
			 	window.close();
			 }
		  </script>";

}
if($_POST['accion']=='Reajuste-Puntos')
{

	$e=mysql_fetch_array(mysql_query("SELECT * FROM Empleados WHERE id=".$_POST['id']));
	$t=$_POST['acumulado']+$_POST['reajuste'];
	echo "UPDATE `Empleados` SET `acumulado`='".$t."' WHERE `id`=".$_POST['id']." ";
	mysql_query("UPDATE `Empleados` SET `acumulado`='".$t."', `reajuste`=".($e['reajuste']+$_POST['reajuste'])." WHERE `id`=".$_POST['id']." ");

	echo "<script>			
			opener.location=('Nominas.php');
			window.close();
		 </script>";
	
}
if($_POST['accion']=='Reinicia-Meseros')
{
	mysql_query("UPDATE `Configuraciones` SET `descripcion`='".date('Y-m-d')."' WHERE `id`=3");
	mysql_query("UPDATE `Empleados` SET `fecha`='".date('Y-m-d')."',`acumulado`='0',`puntos`='0' WHERE 1");
	mysql_query("truncate Confirmacion_Nomina_Construccion ");
	mysql_query("truncate Confirmacion_Nomina_Eventos ");
	mysql_query("truncate Confirmacion_Nomina_Extras ");
	mysql_query("truncate Confirmacion_Nomina_Planta ");
	echo "exito";
}
function colocarPuntos($tabla,$id)
{

	echo "<br><br>SELECT * FROM  `".$tabla."` WHERE id=".$id;
	$cx=mysql_fetch_array(mysql_query("SELECT * FROM  ".$tabla." WHERE id=".$id));
	echo "<br>Puntossss xxx: ".$cx['puntos']."<br>";
	$n=explode(",",$cx['nombres']);
	$p=explode(",", $cx['puntos']);

	for ($i=1; $i <count($n) ; $i++) 
	{	$t=0;
		$ide=explode("-", $n[$i]);
		echo "<br>".$ide[0]."-".$ide[1];
		echo "<br>X:".$i." ".$p[$i];
		$e=mysql_fetch_array(mysql_query("SELECT * FROM Empleados WHERE id=".$ide[1]));
		$acumulado=$e['acumulado'];
		if($acumulado=="")
			{$acumulado=0;}
		$t=$acumulado+$p[$i];
		
		//mysql_query("UPDATE `Empleados` SET `acumulado`='".$t."' WHERE `id`=".$ide[1]);
			
	}	
}
?>