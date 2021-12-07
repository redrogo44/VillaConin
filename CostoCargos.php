<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require "funciones2.php";
conectar();
session_start();
validarsesion();
$nivel=$_SESSION['niv'];
if($nivel==0)
{
menunivel0();				
}
if($nivel==1)
{
menunivel1();				
}
if($nivel==2)
{
menunivel2();
}
if($nivel==3)
{
menunivel3();
}
if($nivel==4)
{
menunivel4();
}

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
				  width:800px;
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
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>
<!-- CUERPO DEL WEB-->
<!--<body background="/Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" > -->
<BR />
<br />
<div align="center">

<?php 
 $SerAdd="Select * from contrato where Numero='".$_GET['numero']."'";
	$consulta=mysql_query($SerAdd);
	$can=mysql_fetch_array($consulta);
	 $ServiciosA=$can['ServiciosAdicionales'];		
	 $tamaño=substr_count($ServiciosA, ','); // 2
	$menu = explode(",", $ServiciosA);
	$esfactu=$can['facturado'];
	/* tabla de Servicios
	$q="select max(id)'n' from TDevoluciones";
						$r=mysql_query($q);
						$muestra=mysql_fetch_array($r);
						$numax=$muestra['n'];
						$numax++;
			*/
	if ($esfactu=='si') 
	{
		# code...
		$nm="SHOW TABLE STATUS LIKE 'cargofac' ";
	}
	else
	{
		$nm="SHOW TABLE STATUS LIKE 'cargo' ";

	}
	$MN=mysql_query($nm);
	$uax=mysql_fetch_array($MN);
	$numax=$uax["Auto_increment"];
		echo " <form name='CostodeCargo' action='altacargo.php'  method='post'>
							<table border='6' bordercolor='#990000'>
							<tr><td colspan='2'>Folio</td><td align='center'><b>".$numax."</b></td></tr>
							<tr align='center'>
									<td bgcolor='#0099FF'><b>Servicio</b></td><td bgcolor='#FF0000'><b>Descripciòn</b></td> <td bgcolor='#CCFF00'><b>Precio</b></td>
							</tr>";
							
					for($i=0;$i<$tamaño;$i++)
					{
					 $Servicios="Select Servicio from Servicios Where id=".$menu[$i];
						$consulta=mysql_query($Servicios);
						$cans=mysql_fetch_array($consulta);
						 $serv=$cans['Servicio'];		
						
						echo "
						<tr>
								<td bgcolor='#00CCFF'><b>".$serv."</b></td> 
								<td bgcolor='#FF0000'><textarea size='30%' name='".'Descripcion'.$i."' ></textarea></td>
								<td bgcolor='#CCFF10'><input name='".$i."' type='text'; /></td>
					  </tr>
							 ";
					}
			
					echo "
					<tr></tr>					<tr></tr>					<tr></tr>
					<tr >
					<input name='contrato' type='hidden' value ='".$_GET['numero']."' />
					<input name='tipo' type='hidden' value ='".$_GET['tipo']."' />
					<input name='tamano' type='hidden' value ='".$tamaño."' />
					
					</tr>
					<tr>
							<td colspan='3' align='center'><input type='submit'  value='Generar Cargo'/></td>
					</tr>
					</table>
			</form>";
			
			
?>


</div>
</body>
</html>


