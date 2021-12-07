<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'configuraciones.php';
validarsesion();
$nivel=$_SESSION['niv'];
if($nivel==0)
{
menuconfiguracion();
}

?>
 
 <title>Villa Conin</title>
<head> 
<script type="text/javascript" src="../js/shortcut.js"></script>
</head> 
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
	<p><b><h2>Cancelacion de Contratos</h2></b></p>
    <script>alert("TENGA EN CUENTA QUE AL CANCELAR UN CONTRATO, ESTE SE ELIMINARA DEL SISTEMA Y NO PODRA RECUPERARSE HASTA QUE SE CREE DE NUEVO, POR TANTO LA FECHA, EL SALON, LOS ABONOS Y CARGOS SE PERDERAN PARA ESTE CONTRATO")</script>
    <div class="wrapper wrapper-style4">
<script><?php
conectar(); 
$c2=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='mostrar facturados' and tipo='clave'"));  $c3=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='ocultar factutados' and tipo='clave'"));?>
shortcut.add("Ctrl+Alt+<?php echo $c3['descripcion'];?>",function() {document.getElementById('no_facturados').style.display='none';});
shortcut.add("Ctrl+Alt+<?php echo $c2['descripcion'];?>",function() {document.getElementById('no_facturados').style.display='block';});
</script>

 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  
			<select name="categoria" size="1" id="categoria">
				<option>Numero</option>
                <option>Todos</option>
			</select>
            <input type="text" name="campo" size="35" maxlength="35"  placeholder="		Ingresa aqui tu texto">
		<input type="submit" name="submit" value="Buscar">
		</form>
       </div>
		<div class="wrapper">
			<?php
					if(isset($_POST['submit'])) {
					BUSCARCONTRATO();
				}
				pie();
			?>
			</div>
			<div id="no_facturados" style="display:none;">
			<?php 
			cnf();
			?>
			</div>
			</div>
	
</body>
</html>
