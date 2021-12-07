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
		  <td><label>Fecha de limite</label></td><td><input name="fin" type="date"></td></tr>
		  
			<tr><td><select name="categoria" size="1" >
				<option value="0">Selecciona una opción</option>
                <option value="tipo">Tipo</option>
				<option value="medio_contacto">Medio de contacto</option>
                <option value="estatus">Estatus</option>
                <option value="todos">Todos</option>
			</select></td><td>
			<input type="text" name="campo">
			</td></tr>

			<tr><td><select name="categoria2" size="1" >
				<option value="0">Selecciona una opción</option>
                <option value="tipo">Tipo</option>
				<option value="medio_contacto">Medio de contacto</option>
                <option value="estatus">Estatus</option>
                <option value="todos">Todos</option>
			</select>
			</td><td>
			<input type="text" name="campo2">
			</td></tr>
         
			<tr><td><select name="categoria3" size="1">
				<option value="0">Selecciona una opción</option>
                <option value="tipo">Tipo</option>
				<option value="medio_contacto">Medio de contacto</option>
                <option value="estatus">Estatus</option>
                <option value="todos">Todos</option>
			</select>
			</td><td>
			<input type="text" name="campo3">
			</td></tr>
		  <tr><td colspan="2" align="center"><br><br>
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

	$query="";
	if($_POST['categoria']=="todos" ||$_POST['categoria2']=="todos" || $_POST['categoria3']=="todos"){
		$query="select * from eliminados";
	}else{
		if(empty($_POST['inicio']) || empty($_POST['fin'])){
			echo "<script> alert('Seleccione un rango de fecha')</script>";
			$query="select * from eliminados where 1=1 ";
			if($_POST['categoria']!="0" && !empty($_POST['campo'])){
				$query=$query." and ".$_POST['categoria']."='".$_POST['campo']."'";
			}if($_POST['categoria2']!="0" && !empty($_POST['campo2'])){
				$query=$query." and ".$_POST['categoria2']."='".$_POST['campo2']."'";
			}if($_POST['categoria3']!="0"  && !empty($_POST['campo3'])){
				$query=$query." and ".$_POST['categoria3']."='".$_POST['campo3']."'";
			}
			
		}else{
			$query="select * from eliminados where fecha_registro >= '".$_POST['inicio']."' and fecha_registro <= '".$_POST['fin']."' ";
			if($_POST['categoria']!="0" && !empty($_POST['campo'])){
				$query=$query." and ".$_POST['categoria']."='".$_POST['campo']."'";
			}if($_POST['categoria2']!="0" && !empty($_POST['campo2'])){
				$query=$query." and ".$_POST['categoria2']."='".$_POST['campo2']."'";
			}if($_POST['categoria3']!="0"  && !empty($_POST['campo3'])){
				$query=$query." and ".$_POST['categoria3']."='".$_POST['campo3']."'";
			}
		}	
	}
	$r=mysql_query($query);
	 echo"<br><br><table border='0'>";
	 echo "<tr><td>Cantidad de registros </td><td>".mysql_num_rows($r)."</td></tr>";
	 echo "</table><br>";
	 echo "<table border='1' align='center'>";
	 echo "<tr><th>Fecha de Registro</th><th>Cliente</th><th>Vendedor</th><th>Tipo</th><th>Medio de Contacto</th><th>Estatus</th><th>Comentario</th></tr>";
	while($m=mysql_fetch_array($r)){
			echo "<tr><td>".$m['fecha_registro']."</td><td>".$m['cliente']."</td><td>".$m['vendedor']."</td><td>".$m['tipo']."</td><td>".$m['medio_contacto']."</td><td>".$m['estatus']."</td><td>".$m['comentarios']."</td><tr>";
	}
	echo "</table>";
}
?>
</html>
