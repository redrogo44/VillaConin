<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

?>
<title>Villa Conin</title>
<style type="text/css">
* {
	padding: 0px;
	margin: 0px;
}
#header {
	margin: auto;
	width: 900px;
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
</body>
<!-- CUERPO DEL WEB-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;

$Con="SELECT * FROM TDevoluciones WHERE estatus = 0";
$Conc=mysql_query($Con);
?>

<!--ESTILO CUERPO-->

<div align="center">
<br />
<br />
<br  style="background-position:center"/>
<p>
<b>
<h2 style="color:#FC0316">PRE-DEVOLUCION</h2>
</b>
</p>
<br /><br /><br /><br />
<div class="wrapper wrapper-style4"> 

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table border="6" bordercolor="#990000"  style="background:#FFF">
      <tr>
        <td align='center'><b>Folio</b></td>
        <td align='center'><b>Numero de Contrato</b></td>
        <td align='center'><b>Nombre de Contrato</b></td>
        <td align='center'><b>Deposito Inicial</b></td>	
        <td align='center'><b>Descripcion de Cargos</b></td>
        <td align='center'><b>Total de Cargo</b></td>
        <td align='center' style='color:#F00'><b>Total de Devolucion</b></td>
        <td align='center'><b>Modificar Datos</b></td>
        <td align='center' ><b>Realizar Devolucion</b></td>
        
      
      </tr>
      
      <?php
	  while($Dev=mysql_fetch_array($Conc))
	  { 
	  $d="Select nombre from contrato where Numero='".$Dev['Numero']."'";
	 $Devv= mysql_fetch_array(mysql_query($d));
	  	echo "
				<tr>
					<td align='center'>".$Dev['id']."</td>
					<td align='center'>".$Dev['Numero']."</td>
					<td align='center'>".$Devv['nombre']."</td>					
					<td align='center'>".$Dev['DepositoInicial']."</td>
					<td align='center'>".$Dev['Descripcion']."</td>
					<td align='center'>".$Dev['Cargos']."</td>
					<td align='center' style='color:#F00'><b>".$Dev['Total']."</b></td>
					<td align='center'><a href='ModificaDevolucion.php?numero=".$Dev['id']."'>Modificar</a></td>
					<td align='center'>						
					<button type='button' id='boton' value='".$Dev['Total']."' onclick='envia(this.value,".$Dev['id'].")'>Generar Devolucion</button>
					</td>					
				</tr>
			 ";
	  }
      ?>
    </table>
  </form>
</div>
<div style="display: none;">
<form action="accionesDevolucion.php" name="devolucion" id="devolucion" method="POST" accept-charset="utf-8">
	<input type="text" name="banco"  id="banco" value="" >
	<input type="text" name="cuenta" id="cuenta" value="" >
	<input type="text" name="id" id="id" value="" >
	<input type="text" name="tipo" id="tipo" value="imprime" >
	<input type="text" name="accion" value="ConfirmaDevolucion" >
	<input type="text" name="cantidad" id="cantidad" value="" >
</form>
</div>
<div class="wrapper">
<?php
					if(isset($_POST['submit'])) {
					conectar();
					Devoluciones();
										
				}
			?>


<script>
  alert("Tenga en Cuenta que al realizar una devolucion de dinero sobre el contrato, este se da por terminado y pasa a estar INACTIVO, Si no esta convencido de realizarlo por favor regrese al inicio")
  function imprime(id)
   {
   	alert('Algo' +id);
   		//
	   //window.open("Devolucion.php?numero="+id+"&&tipo=Imprime");
 	}

	function envia(v,r)
	{
		if(confirm("ESTA SEGURO DE REALIZAR DE DEVULCION DE ESTE CONTRATO"))
		{
 			window.open("FormularioCuentas.php", "Carga Cuentas", "width=400, height=300");
 		}		
		$("#id").val(r);
		$("#cantidad").val(v);
	}
  </script>
</body>
</html>