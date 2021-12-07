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
					table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    	font-size: 12px;    margin: 45px;     width: 480px; text-align: left;    border-collapse: collapse; }

			th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
	    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

				td {    padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; }

		tr:hover td { background: #d0dafd; color: #339; }
				
				.pie {position:absolute;bottom:0;width:100%;color:white;background-color:#900;font-size:8;font-family:Arial, Helvetica, sans-serif;} 
    </style>
</head>
<!-- CUERPO DEL WEB-->


<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
$d="SELECT * FROM preregistro WHERE id=".$_GET['numero'];
$p=mysql_query($d);
$pc=mysql_fetch_array($p);
?>
<br><br>
<br>
<br><br>
<div align='center'>
<h2><font color='blue'><b>Modificar Pre-Cliente</b></font></h2>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php	echo "		<table>
			<tr><td><b>Nombre(s)</b></td><td><input type='text' name='nombre' value=".$pc['nombre']." /></td></tr>
			<tr><td><b>A. Paterno</b></td><td><input type='text' name='ap' value=".$pc['ap']." /></td></tr>
			<tr><td><b>A. Materno</b></td><td><input type='text' name='am'  value=".$pc['am']." ></td></tr>
			<tr><td><b>Telefono</b></td><td><input type='text' name='telefono' value=".$pc['telefono']." /></td></tr>
			<tr><td><b>Correo</b></td><td><input type='email' name='correo' value=".$pc['mail']." /></td></tr>
			<tr><td><b>Fecha de Evento</b></td><td><input type='date' name='fecha' value=".$pc['fecha']." /></td></tr>
			<tr><td><b># Comensales</b></td><td><input type='number' name='invitados' value=".$pc['invitados']." /></td></tr>
			<tr><td><b>Tipo</b></td>
			<td>
				<select name='tipo' size='1' id='categoria' onchange='activar(this.form)'>
					<option  value=".$pc['tipo'].">".$pc['tipo']."</option>
		            <option value='Bautizo'>Bautizo</option>
		            <option value='Boda'>Boda</option>
		            <option value='XV Años'>XV Años</option>
		            <option value='Empresarial'>Empresarial</option>
		            <option value='Graduacion'>Graduacion</option>
		            <option value='Primera Comunion'>Primera Comunion</option>
		            <option value='Cumpleaños'>Cumpleaños</option>
		 			<option value='Presentacion'>Presentacion</option>
		            <option value='Otros'>Otros</option>               
				</select>
			</td>
			<tr><td><b>Medio de Contacto</b></td>
			<td>
				 <select name='medio' size='1' id='categoria' onchange='activar(this.form)'>
       				<option  value=".$pc['medio'].">".$pc['medio']."</option>
					<option>Bodas.com</option>
					<option>Correo Ventas</option>
					<option>Carteles</option>
					<option>Facebook</option>
					<option>Google</option>
					<option>Pagina Villa</option>
					<option>Recomendacion</option>
					<option>Seccion amarilla(internet)</option>
	                <option>Seccion amarilla(libro)</option>
					<option>Visita</option>					
					<option>Visita de Campo</option>						        	                
			</select>
			</td></tr>

		</table>
		<input type='hidden' name='id' value=".$_GET['numero'].">
		
		";
			?>

		<input type='submit' value='Modificar' name="submit" />
	</form>
</div>
			<?php
					if(isset($_POST['submit'])) {
					conectar();
					//print_r($_POST);
			 $up="UPDATE `preregistro` SET `nombre`='".$_POST['nombre']."',`ap`='".$_POST['ap']."',`am`='".$_POST['am']."',`fecha`='".$_POST['fecha']."',`invitados`='".$_POST['invitados']."',`telefono`='".$_POST['telefono']."',`mail`='".$_POST['correo']."',`tipo`='".$_POST['tipo']."',`medio`='".$_POST['medio']."',`registro`='".$usuario."',`fdr`='".date("Y-m-d H:i:s")."' WHERE id=".$_POST['id'];
			mysql_query($up);
			echo "<br>
					<script>
						alert('Se Modifico con Exito su Registro');
					</script>
					<META HTTP-EQUIV='Refresh' CONTENT='0; URL=BucarPreCliente.php'>
				";
				}
				pie();
			?>

</body>
<script>
function preguntar(n){
 if(confirm("Desea eliminar al Precliente")){
	razon=prompt("¿Cuál es la razon de cancelacion de contrato?");
	location.href="Eliminar_PreCliente.php?numero="+n+"&&razon="+razon
 }
}
</script>
</html>	
