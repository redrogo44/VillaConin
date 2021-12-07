<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
require 'configuraciones.php';
validarsesion();
$nivel=$_SESSION['niv'];
menuconfiguracion();				
conectar();
$_SESSION['usu']=$_GET['usuario'];
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Villa Conin</title>
    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:900px;
				  right:1000px;
				  height:20px;
				  font-family:Arial, Helvetica, sans-serif;
				  }
			  ul,ol{
				 list-style:none;}
				 
			 .nav li a {
				 background-color:#000;
				 color:#fff;
				 text-decoration:none;
				 padding:10px 15px;
				 display:block;
				 }
			.nav li a:hover 
			{
			 background-color:#434343;
		    }
			 .nav > li{
				 float:left;}
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}
			.nav li:hover> ul{
				display:block;
				}
				.nav li:hover> ul li{
				display:block;
				}
			.nav li ul li{
				position:relative;}
			.nav li ul li ul{
				right:-146px;
				top:10px;
				animation:infinite; 
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
       
</head>

<!-- CUERPO DEL WEB-->
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<div align="center">
<br>
<h2>SELECCIONE SU RANGO DE FECHAS</h2>
<br>
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label><font color="green"> De </font></label>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="date" name="fecha1" />
		&nbsp;&nbsp;&nbsp;&nbsp;
		<label><font color="red"> Hasta </font></label>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="date" name="fecha2" />
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" value="Buscar" name="submit" />
	</form>
</div>
<div align="center">
<br>
<br>
<br>
		<?php
				if(isset($_POST['submit'])) 
					{					
						$d="SELECT * FROM contrato WHERE Fecha >='".$_POST['fecha1']."' and Fecha <='".$_POST['fecha2']."'";
						$C=mysql_query($d);
						echo "
									<table border='3' bgcolor='#F7FCEC'>
										<tr>
											<td align='center'><b>Contrato</b></td>
											<td align='center'><b>Costo</b></td>
											<td align='center'><b>Comensales</b></td>
											<td align='center'><b>Costo Promedio X Comensal</b></td>
											<td align='center'><b>% de Total de Comensales</b></td>
											<td align='center'><b>Gastos de Evento</b></td>
											<td align='center'><b>Ganancia de Evento</b></td>
											<td align='center'><b>Ganancia x Comensal</b></td>
										</tr>
										";
											while ($Co=mysql_fetch_array($C)) 
											{						
												// TOTAL DE CONTRATO MAS CARGOS
												$TContrato=Suma_Cargos($Co['Numero'],$Co['facturado']);
												$TContrato=$TContrato+$Co['si'];
												//////////////////////////////////
												$tc=total_comensales($Co['Numero'],$Co['facturado']);
												// Total de Comensales
												$Tcomensales=$Co['c_adultos']+$Co['c_jovenes']+$Co['c_ninos']+$tc[0]+$tc[1]+$tc[2];
												// Promedio por comensal
												$prom=$TContrato/$Tcomensales;
												$promTotal=$prom+$promTotal;
												// Porcentaje  por Comensal
												$TTComensa=TotalComensales();
												$Porcen_Comensal=($Tcomensales*100)/$TTComensa;
												$Total_Porcentaje=$Porcen_Comensal+$Total_Porcentaje;
			 									// Gastos de Evento
												$GastoEvento=($Porcen_Comensal*Gastos_Insumos())/100;
												$Gastos_Eventos_Totales=$GastoEvento+$Gastos_Eventos_Totales;
												// GANANCIA DEL EVENTO
												$Gananc=$TContrato-$GastoEvento;								
												$Ganancias_Totales=$Gananc+$Ganancias_Totales;
												// GANANCIA POR COMENSAL
												$Ganan_Comensal=$Gananc/$Tcomensales;
												$Ganancias_Comensales=$Ganan_Comensal+$Ganancias_Comensales;
												echo "
													   <tr>
													   		<td align='center'><b>".$Co['Numero']."</b></td>
													   		<td align='center'><b>$".money_format('%i',$TContrato)."</b></td>
													   		<td align='center'><b>".$Tcomensales."</b></td>
													   		<td align='center'><font color='#FFA200'><b>$ ".money_format('%i',$prom)."</b></font></td>
													   		<td align='center'><font color='blue'><b>".round($Porcen_Comensal)." %</b></font></td>
													   		<td align='center'><font color='red'><b>$ ".money_format('%i',round($GastoEvento))."</b></font></td>
													   		<td align='center'><font color='#63A467'><b>$ ".money_format('%i',round($Gananc))."</b></font></td>
													   		<td align='center'><font color='#00F010'><b>$ ".money_format('%i',round($Ganan_Comensal))."</b></font></td>
													   	</tr>
													  ";											
											}
								echo "
								<tr>
									<td align='center'><font><b>TOTALES</b></font></td>
									<td align='center'><font><b>$ ".money_format("%i",Suma_Total_Costos_Eventos())."</b></font></td>
									<td align='center'><font><b>".TotalComensales()."</b></font></td>
									<td align='center'><font><b>".money_format("%i",$promTotal)."</b></font></td>
									<td align='center'><font><b>".$Total_Porcentaje." %</b></font></td>
									<td align='center'><font><b>$ ".money_format("%i", $Gastos_Eventos_Totales)."</b></font></td>
									<td align='center'><font><b>$ ".money_format("%i", $Ganancias_Totales)."</b></font></td>
									<td align='center'><font><b>$ ".money_format("%i", $Ganancias_Comensales)."</b></font></td>
								</tr>
									</table>
									 ";

					
				}
					// Total de Comensales por Evento
	function total_comensales($n,$fac)
	{
		$congral=mysql_query("select count(*) as total from contrato where Numero like '".$n."-%'");
		$gral=mysql_fetch_array($congral);
		if($gral['total']>0)
		{//////////////es un contrato gral
		if($fac=='si')
		{
			$q='select * from cargofac where numcontrato like "'.$n.'%" and tipo="Comensales"';
		}else
		{
			$q='select * from cargo where numcontrato like "'.$n.'%" and tipo="Comensales"';
		}
	}else
	{//////es un contrato normal o subcontrato
		if($fac=='si')
		{
			$q='select * from cargofac where numcontrato="'.$n.'" and tipo="Comensales"';
		}else
		{
			$q='select * from cargo where numcontrato="'.$n.'" and tipo="Comensales"';
		}
	}
	
	$r=mysql_query($q);
	$cantidades;
	while($m=mysql_fetch_array($r))
	{
		$arreglo=explode(' ',$m['concepto']);
		$cantidades[0]=$cantidades[0]+$arreglo[4];
		$cantidades[1]=$cantidades[1]+$arreglo[15];
		$cantidades[2]=$cantidades[2]+$arreglo[26];
	}
	
	return $cantidades;
}
// Total de Comensales de Todos los Eventos
function TotalComensales()
{

	 $aa=mysql_query("SELECT * FROM contrato WHERE Fecha >='".$_POST['fecha1']."' and Fecha <='".$_POST['fecha2']."'"); 
	while ($Ct=mysql_fetch_array($aa)) 
	{
		$to=$Ct['c_ninos']+$Ct['c_jovenes']+$Ct['c_adultos'];
		$extras=total_comensales($Ct['Numero'],$Ct['facturado']);
		$TotalComensalesEvento=$to+$extras[0]+$extras[1]+$extras[2]+$TotalComensalesEvento;		
	}
	return $TotalComensalesEvento;
}
//    AQUI SACAMOS U OBTENEMOS LO QUE SE GASTO DE INSUMOS O SE CONSUMIO EN EL RANGO DE FECHAS ALGOSIMBOLICO SERIA
function Gastos_Insumos()
{
	$f1=$_POST['fecha1'];
	$f2=$_POST['fecha2'];
	//////////////compras no facturadas
	$q="select * from compra where fecha>='".$f1."' and fecha<='".$f2."'";
	$r=mysql_query($q);
	$total=0;
	while($m=mysql_fetch_array($r))
	{
		$q2="select * from detalle where id=".$m['id_compra']." and tipo='compra' and gasto='no' ";
		$r2=mysql_query($q2);
		while($m2=mysql_fetch_array($r2))
		{
			$producto=mysql_fetch_array(mysql_query("select * from producto where id_producto=".$m2['id_producto']));
			if(revisar_categoria($producto['id_categoria']))
			{
				$total=$total+($m2['cantidad']*$m2['precio_adquisicion']*(1+($producto['impuesto']/100)));
			}
		}
		$total=$total-$m['descuento']+$m['iva'];
	}
	//echo "total compras no facturadas:".$total."<br>";
	//////////////compras facturadas
	$qf="select * from comprafac where fecha>='".$f1."' and fecha<='".$f2."'";
	$rf=mysql_query($qf);
	$totalf=0;
	while($mf=mysql_fetch_array($rf)){
		$qf2="select * from detalle where id=".$mf['id_compra']." and tipo='comprafac' and gasto='no' ";
		$rf2=mysql_query($qf2);
		while($mf2=mysql_fetch_array($rf2)){
			$productof=mysql_fetch_array(mysql_query("select * from producto where id_producto=".$mf2['id_producto']));
			if(revisar_categoria($productof['id_categoria']))
			{
				$totalf=$totalf+($mf2['cantidad']*$mf2['precio_adquisicion']*(1+($productof['impuesto']/100)));
			}
		}
		$totalf=$totalf-$mf['descuento']+$mf['iva'];
	}
	//echo "total compras facturadas:".$totalf."<br>";
	$total_final=$total+$totalf;
	return $total_final;
}

function revisar_categoria($ID)
{
	$e1="select * from categoria where nombre not like '%EQUIPO%'";
	$re=mysql_query($e1);
	$respuesta=false;
	while($cat=mysql_fetch_array($re))
	{
		if($cat['id_categoria']==$ID)
		{
			$respuesta=true;
		}
	}
	return $respuesta;
}

function Suma_Cargos($N,$f)
{
	$TSuma=0;
	if ($f=='facturado') 
	{
		$SC=mysql_query("select * from cargofac where numcontrato like '".$N."%'");		
	}
	else
	{
		$SC=mysql_query("select * from cargo where numcontrato like '".$N."%'");				
	}
	while($TSC=mysql_fetch_array($SC))
	{
		$TSuma=$TSC['cantidad']+$TSuma;
	}
	return $TSuma;
}
function Suma_Total_Costos_Eventos()
{
	$x=mysql_query("SELECT * FROM contrato WHERE Fecha >='".$_POST['fecha1']."' and Fecha <='".$_POST['fecha2']."'");	
		while ($STCE=mysql_fetch_array($x)) 
		{
			$TContrato=Suma_Cargos($STCE['Numero'],$STCE['facturado']);
			$TSTCE=$TContrato+$STCE['si']+$TSTCE;		
		}	
	return $TSTCE;
}
	?>

</div>
<footer >
<?php pie();?>
</footer>
</body>
</html>
