<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require '../Config/configuraciones.php';

validarsesion();
$nivel=$_SESSION['niv'];
menuconfiguracion();

?>
<body>
 
 
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
	<p><b><h2>Modificar Deposito Inicial</h2></b></p>
    <br />  <br />
<div class="wrapper wrapper-style4">		
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		 
        <label><b>Ingrese el Monto del Deposito</b></label>
        
            <input type="text" name="campo" size="35" maxlength="35" required="required" placeholder="	Ingresa aqui la Cantidad del Depoito">
			<input type="submit" name="valor"  value="Modificar">
		</form>
		</div>
		<div class="wrapper">
        <?php
					if(isset($_POST['valor'])) {
					conectar();
					ModificarDep();
				}
				pie();
			?>
        
        
   
</body>
</html>