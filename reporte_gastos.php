<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'funciones2.php';
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
 
 <title>Villa Conin</title>
    <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:700px;
				  height:auto;
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
				right:-142px;
				top:0px;
				animation:infinite;
				color:#F00;
				border-color:#900;
				border-style:solid;
				border-radius:10px;
				}	 
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
</body>
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>

<!--ESTILO CUERPO-->

<div align="center">
	<br /><br /><br  style="background-position:center"/>
    <p><b><h2 style="color:#FC0316">Buscar</h2></b></p>
<div class="wrapper wrapper-style4">	
<table>	<tr>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  <td><label>Fecha de incio</label></td><td><input name="inicio" type="date"></td></tr>
		  <tr><td><label>Fecha de limite</label></td><td><input name="fin" type="date"></td></tr>
		  <tr><td colspan="2" align="center"><br><br>
		<input type="submit" name="submit" value="Buscar">
		</td><td></td><tr>
		</form>
        
		</div>
		<div class="wrapper">
			<?php
					if(isset($_POST['submit'])) {
					conectar();
					buscar_gastos();					
				}
				pie();
			?>
</body>
<?php
function buscar_gastos(){

		if(empty($_POST['inicio']) || empty($_POST['fin'])){
			echo "<script> alert('Seleccione un rango de fecha')</script>";				
		}else{
			$query="select * from Gastos where fecha >= '".$_POST['inicio']."' and fecha <= '".$_POST['fin']."' ";
		}	
	$r=mysql_query($query);
	$query2="select sum(cantidad) as t from Gastos where fecha >= '".$_POST['inicio']."' and fecha <= '".$_POST['fin']."' ";
	$r2=mysql_query($query2);
	$m2=mysql_fetch_array($r2);
	 echo"<br><br><table border='0'>";
	 echo "<tr><td>Cantidad de registros </td><td>".mysql_num_rows($r)."</td></tr>";
	 echo "<tr><td>Total de Gastos </td><td>$".$m2['t']."</td></tr>";
	 echo "</table><br>";
	 echo "<table border='1' align='center'>";
	 echo "<tr><th>id</th><th>fecha</th><th>categoria</th><th>subcategoria</th><th>nombre</th><th>descripcion</th><th>cantidad</th><th>concepto</th></tr>";
	while($m=mysql_fetch_array($r)){
			echo "<tr><td>".$m['id']."</td><td>".$m['fecha']."</td><td>".$m['categoria']."</td><td>".$m['subcategoria']."</td><td>".$m['nombre']."</td><td>".$m['descripcion']."</td><td>".$m['cantidad']."</td><td>".$m['concepto']."</td><tr>";
	}
	echo "</table>";
}
?>
</html>
