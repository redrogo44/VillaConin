<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'configuraciones.php';
validarsesion();
$nivel=$_SESSION['niv'];
validarsesion();
	$nivel=$_SESSION['niv'];
	menuconfiguracion();

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
<script>
function ventana()
{
alert('que pedo');
	open('AsistioMesero.php','','',top=100,left=100,width=500,height=250) ;
}
</script> 

<!--ESTILO CUERPO-->

<div align="center">
	<br /><br /><br  style="background-position:center"/>
    <p><b><h2 style="color:#FC0316">Buscar</h2></b></p>
<div class="wrapper wrapper-style4">	
<table>	
<tr>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  <td><label>DEL AÑO</label></td>&nbsp;&nbsp;
		  <td>&nbsp;&nbsp;<select name="ano" size="1" >
				<option value="0">Selecciona una opción</option>                
               <?php
			   $Consultas="Select * from TMeserosEvento group by ano";
				$to=mysql_query($Consultas);
			   while($ano=mysql_fetch_array($to))
			   {
				    echo "<option value='".$ano['ano']."'>".$ano['ano']."</option>";
				}
               ?>
               <option value="0">Todos</option>
			</select></td><td>
             <td><label>Y LA SEMANA</label></td>&nbsp;&nbsp;
		  <td>&nbsp;&nbsp;<select name="semana" size="1" >
				<option value="0">Selecciona una opción</option>
                
               <?php
			   $Consultas="Select * from TMeserosEvento group by semana";
				$to=mysql_query($Consultas);
			   while($ano=mysql_fetch_array($to))
			   {
				    echo "<option value='".$ano['semana']."'>".$ano['semana']."</option>";
				}
               ?>
               <option value="todos">Todos</option>
			</select></td><td>
			
			</td>
 </tr>

			<tr>
              <td><label>AL AÑO</label></td>&nbsp;&nbsp;
		  <td>&nbsp;&nbsp;<select name="ano2" size="1" >
				<option value="0">Selecciona una opción</option>
                
               <?php
			   $Consultas="Select * from TMeserosEvento group by ano";
				$to=mysql_query($Consultas);
			   while($ano=mysql_fetch_array($to))
			   {
				    echo "<option value='".$ano['ano']."'>".$ano['ano']."</option>";
				}
               ?>
               <option value="todos">Todos</option>
			</select></td><td>
             <td><label>Y LA SEMANA</label></td>&nbsp;&nbsp;
		  <td>&nbsp;&nbsp;<select name="semana2" size="1" >
				<option value="0">Selecciona una opción</option>
                
               <?php
			   $Consultas="Select * from TMeserosEvento group by semana";
				$to=mysql_query($Consultas);
			   while($ano=mysql_fetch_array($to))
			   {
				    echo "<option value='".$ano['semana']."'>".$ano['semana']."</option>";
				}
               ?>
               <option value="todos">Todos</option>
			</select></td><td>
            <tr>
             <tr><td colspan="8" align="center"><br><br>
		<input type="submit" name="submit" value="Buscar">
		</td><td></td><tr>
		</form>
        
		</div>
		<div class="wrapper">
			<?php
					if(isset($_POST['submit'])) {
					conectar();
					buscar_prospectos();					
				}
				pie();
			?>
</body>
<?php
function buscar_prospectos(){

	$query="select * from TMeserosEvento";
	if($_POST['ano']=="todos" ||$_POST['ano2']=="todos" || $_POST['semana']=="todos" || $_POST['semana2']=="todos")
	{
		
		$r=mysql_query($query);
			 echo"<br><br><table border='0'>";
			 echo "<tr><td>Cantidad de registros </td><td>".mysql_num_rows($r)."</td></tr>";
			 echo "</table><br>";
			 echo "<table border='1' align='center'>";
			 echo "<tr><th>Semana</th><th>Año</th><th>Contratos</th><th>Ver Detalles</th></tr>";
			while($m=mysql_fetch_array($r)){
					echo "<tr>
					<td>".$m['semana']."</td>
					<td>".$m['ano']."</td>
					<td>".$m['contratos']."</td>
			
					<td><a href='DetallesEvento.php?numero=".$m['id']."' target='_blank'>Detalles</a></td>
					<tr>";
			}
	}	
	else
	{
			$r=mysql_query($query);
	 echo"<br><br><table border='0'>";
	 echo "<tr><td>Cantidad de registros </td><td>".mysql_num_rows($r)."</td></tr>";
	 echo "</table><br>";
	 echo "<table border='1' align='center'>";
	 echo "<tr><th>Semana</th><th>Año</th><th>Contratos</th><th>Registro</th></tr>";
			while($m=mysql_fetch_array($r)){
				
				if($m['ano']<=$_POST['ano']&&$m['semana']>=$_POST['semana'])
					echo "<tr>
					<td>".$m['semana']."</td>
					<td>".$m['ano']."</td>
					<td>".$m['contratos']."</td>
					
					<td><a href='DetallesEvento.php?numero=".$m['id']."' target='_blank'>Detalles</a></td>
					<tr>";
			}
	}
	
	echo "</table>";
}
?>

</html>
