<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<?php
session_start();
require 'funciones2.php';
conectar();
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
<head>
<title>Villa Conin</title>
</head>
<style type="text/css">
* {
	padding: 0px;
	margin: 0px;
}
#header {
	margin: auto;
	width: 600px;
	height: auto;
	font-family: Arial, Helvetica, sans-serif;
}
ul, ol {
	list-style: none;
}
.nav li a {
	background-color: #000;
	color: #fff;
	text-decoration: none;
	padding: 10px 15px;
	display: block;
}
.nav li a:hover {
	background-color: #434343;
}
.nav > li {
	float: left;
}
.nav li ul {
	display: none;
	position: absolute;
	min-width: 140px;
	border-color: #900;
	border-style: solid;
	border-radius: 10px;
}
.nav li:hover> ul {
	display: block;
}
.nav li ul li {
	position: relative;
}
.nav li ul li ul {
	right: -142px;
	top: 0px;
	animation: infinite;
	color: #F00;
	border-color: #900;
	border-style: solid;
	border-radius: 10px;
}
.pie {
	position: absolute;
	bottom: 0;
	width: 100%;
	color: white;
	background-color: #900;
	font-size: 8;
	font-family: Arial, Helvetica, sans-serif;
}
</style>

<!-- CUERPO DEL WEB-->

<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<?php
  
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

$q="select * from contrato  where Numero='".$_GET['numero']."'";

?>
<script>
 
function calcular(idcantidad, idprecio, idtotal) {
	tot=0; 
	<?php for($i=0;$i<=$_POST['cargos'];$i++)
			{
				echo "ne=eval(document.getElementById('cantidad".$i."').value); 
   					 iv=eval(document.getElementById('precio".$i."').value); 
    				 tiv = ne * iv;
					 tot=tiv+tot;
					 document.getElementById('total".$i."').innerHTML='$ '+tiv+'.00';";
					 
					 
			}
			$todev=mysql_fetch_array(mysql_query($q));
			echo $todev['deposito'];
			echo "
				totot=".$todev['deposito']." - tot;	
			";
			?>
	
    document.getElementById('idtot').innerHTML='$ '+tot+'.00'; 
	document.getElementById('totot').innerHTML='$ '+totot+'.00'; 
	
} 
</script> 	

<script>
function cargar() {
			window.open("http:Devolucion.php?numero="+<?php echo $_GET['numero']; ?> );
		
}
</script>

<!--ESTILO CUERPO-->
<?php
						$quu="select max(id) as n from TDevoluciones";
						$ree=mysql_query($quu);
						$muestraa=mysql_fetch_array($ree);
						$numax=$muestraa['n'];
						$numax++;

?>
<div align="center">
<br />
<br />
<br  style="background-position:center"/>
<p>
<b>
<h2 style="color:#900">Realizar Pre-Devolucion</h2>
</b>
</p>
<br />
<div class="wrapper wrapper-style4"> 
<form method="post" action=""/>
 <table  border="3px"> <tr><td width="140px" align="center">Numero de Contrato:</td><td  width="80px"style="color:#900" align="center"><b><?php echo $_GET['numero'];?></b></td></tr>
<tr><td align="center">Nombre de Contrato</td><td align="center"><b><font color="red"><?php echo $todev['nombre'];?></font></b></td></tr> 
    <tr><td width="140px" align="center">Folio</td><td  width="80px"style="color:#900" align="center"><b><?php echo $numax;?></b></td></tr></table>

    <br />
   <b>Numero de Cargos</b>&nbsp;&nbsp;<input type="number" name="cargos"/> <input type="submit" name="submit" value="Generar"   />
   </form>
   <?php
   if(isset($_POST['submit'])) 
		{
		
    		echo "<form method='post' action='CargarDevolucion.php'/>
   
		   <table border='6' bordercolor='#990000'>";
   
   			echo"<tr><td></td><td align='center'><b>Concepto</b></td><td align='center'><b>Cantidad</b></td><td align='center'><b>Precio Unitario</b></td><td width='25%' align='center'><b>Total</b></td></tr>";
			
			for($i=0;$i<=$_POST['cargos'];$i++)
			{
				echo "
						<tr><td><b>Daño ".($i+1)."</b></td><td><input type='text' name='concepto".$i."'/></td><td><input type='number' id='cantidad".$i."' name='cantidad".$i."'  required='required' onkeyup='calcular(\"cantidad".$i."\",\"precio".$i."\",\"total".$i."\")'/></td><td><input type='number' id='precio".$i."' name='precio".$i."' required='required' onkeyup='calcular(\"cantidad".$i."\",\"precio".$i."\",\"total".$i."\")'/></td><td align='center' style='color:#1E00FF' ><p  id='total".$i."' ></p><b></b> </td></tr>
					 ";
			}							
			echo " 
			<tr><td colspan='3'></td><td align='center'><b>Total de Cargos</b></td><td align='center'><p  id='idtot' style='color:#FF0400'></p></td></tr>
			<tr><td colspan='3'></td><td align='center'><b>Total a Devolver</b></td><td align='center'><p  id='totot' style='color:#FF0400'></p></td></tr>
			
			<tr>
		<td colspan='5' align='center'><input type='submit' value='Generar Pre Devolucion' onclick='cambiar()' /></td>
    	<input type='hidden' name='Numero' value='".$_GET['numero']."'/>
		</tr>
    	</table>
  </form>";
			
		}
   

  ?>
</div>

</body>
</html>