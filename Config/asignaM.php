<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'configuraciones.php';
validarsesion();
menuconfiguracion();
conectar();
?>
 
 <title>Villa Conin</title>

 <style type="text/css">
	
             *{
				 padding:0px;
				 margin:0px;
			  }
			  
			  #header{
				  margin:auto;
				  width:600px;
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
    <p><b><h2 style="color:#FC0316">SE ASIGNARON MESEROS</h2></b></p>

		<div class="wrapper">
		<?php
		conectar();
		print_r  ($_POST);
		echo "El numero de elementos es ".count($_POST)." ";
		 $meseros;
		 for($i=1;$i<count($_POST);$i++)
		 {
			 $meseros=$meseros."".$_POST[$i].",";
		 }
		 echo $meseros;
		 
		 echo $UpCon= "UPDATE contrato SET Meseros='".$meseros."' WHERE Numero='".$_POST['con']."'";
		 mysql_query($UpCon);
		 
		 
		?>
		</div>
</div>	

</body>
</html>
