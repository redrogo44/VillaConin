<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
require 'funciones2.php';
validarsesion();
$nivel=$_SESSION['niv'];
mod_alertas();
libera_manteles();
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

<!-- CUERPO DEL WEB-->
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF" >
<br />
<br /><br />
<br />
<h2 align="center"><font color="#990000"><b>REPORTE DE DEVOLUCIONES</b></font></h2>
<BR />
<br />
<div align="center">
<br><br>
<table <table width=1000px  border=6 bgcolor='#fff' bordercolor='#990000' align='center'>
<tr align='center'><th>Folio</th><th>Numero</th><th>Nombre</th><th>Fecha</th><th>Tipo</th><th>Salon</th><th>Deposito Inicial</th><th>Cargos</th><th>Total</th></tr>
<?php

 $d="SELECT * 
FROM TDevoluciones
WHERE estatus =1
ORDER BY id";
$r=mysql_query($d);
while($m=mysql_fetch_array($r))
{
	 $NC="Select nombre,tipo,salon from contrato where Numero='".$m['Numero']."'";
	$nom=mysql_fetch_array(mysql_query($NC));
echo "<tr><td align='center'>".$m['id']."</td><td>".$m['Numero']."</td><td>".$nom['nombre']."</td><td>".$m['Fecha']."</td><td>".$nom['tipo']."</td><td align='center'>".$nom['salon']."</td><td align='center'>".$m['DepositoInicial']."</td><td align='center'>".$m['Cargos']."</td><td>".$m['Total']."</td></tr>";
}
?>
</table>
</div>


<!--ESTILO CUERPO-->

<div align="center">

</div>

<?php pie();?>
</body>
</html>
