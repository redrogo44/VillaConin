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
	<br /><br /><br  style="background-position:center"/>
	<p><b><h2>Buscar Cliente</h2></b></p>
<div class="wrapper wrapper-style4">		
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  <select name="categoria" size="1" id="categoria">
				<option value="0">Selecciona una opción</option>
                <option value="nombre">Nombre</option>
				<option value="ap">Apellido Paterno</option>
                 <option value="rfc">RFC</option>
                <option value="todos">Todos </option>
			</select>
			<input type="text" name="campo" size="35" maxlength="35"  placeholder="	Ingresa aqui tu texto"><br><br>
			<select name="categoria2" size="1" id="categoria2">
				<option value="0">Selecciona una opción</option>
                <option value="nombre">Nombre</option>
				<option value="ap">Apellido Paterno</option>
                 <option value="rfc">RFC</option>
                <option value="todos">Todos </option>
			</select>
			<input type="text" name="campo2" size="35" maxlength="35"  placeholder="	Ingresa aqui tu texto">
            <br><br>
             Fechas &nbsp;&nbsp;<font color="green"><b>DE</b></font>&nbsp;&nbsp;<input type="date" name="fecha1">&nbsp;&nbsp;<font color="#F00"><b>HASTA</b></font>&nbsp;&nbsp;<input type="date" name="fecha2">
            <br><br>

		<input type="submit" name="submit" value="Buscar">
		</form>
		</div>
		<div class="wrapper">
			<?php
					if(isset($_POST['submit'])) {
					conectar();
					busquedaclienteXX();
				}
				pie();
			?>
</body>
</html>

