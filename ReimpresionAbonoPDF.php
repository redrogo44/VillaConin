O<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
require 'funciones2.php';
validarsesion();
conectar();
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

$Abonore="Select * from abonosforaneos";
$Abono=mysql_query($Abonore);

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
				  width:700px;
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
			.nav li ul li{
				position:relative;}
			.nav li ul li ul{
				right:-150px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
    <link rel="stylesheet" href="tablas.css" type="text/css"/>	
<script language="javascript" type="text/javascript">
function d1(selectTag){
 if(selectTag.value == 'otro1'){
document.getElementById('prg1').disabled = false;
 }else{
 document.getElementById('prg1').disabled = true;
 }
}
</script> 
<body> 
<!-- CUERPO DEL WEB-->

<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#FFFFFF">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>
<!--ESTILO CUERPO-->
	<div align="center">
	<br>	<br>
		<b><h2>Abonos Imresos</h2></b>
		<br>
		<font color="#576BE1"><h4><b>Seleccione el Abono para su reimpresión</b></h4></font>
		<br>
			<div class="" style="width:600px;height:150px;">

			<table >
				<tr> 
					<td align="center">
						<b>Numero</b>
					</td>
					<td align="center">
						<b>Nombre</b>
					</td>
					<td align="center">
						<b>Folio</b>
					</td>
					<td align="center">
						<b>Re-Imprimir</b>
					</td>
				</tr>
				<?php
				while($Abo=mysql_fetch_array($Abono))
				{
				echo "
						<tr>
							<td align='center'>
							<font color='#742064'><b>".$Abo['numcontrato']."</b></font>
							</td>
							<td align='center'>
								<b>".$Abo['nomcontrato']."</b>
							</td>
							<td align='center'>
								<font color='#010978'><b>".$Abo['folio']."</b></font>
							</td>
							<td align='center'>
								<a href='PDF-ReimpresionAbono.php?id=".$Abo['id']."' target='_blank' ><bottom ><font color='#FF0900'><b>Imprimir</b></font></bottom></a>
							</td>
						</tr>
					";
				}

			?>

			</table>
		</div>
		
	</div>
</body>
</html>

