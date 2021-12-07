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

<script src="ajax2.js"></script>
<script src="ajax3.js"></script>
<script src="ajax4.js"></script>
<div align="center">
	<br /><br /><br  style="background-position:center"/>
    <p><b><h2 style="color:#FC0316">Compras</h2></b></p><br>
<div class="wrapper wrapper-style4">		

  <form action="Realizar_compra.php" method="POST">
  <table>
  <tr><td><label>CANTIDAD</label></td><td><input type="number" name="cantidad" min="0" required></td></tr>
  <tr><td><label>CATEGORIA</label></td><td>
  <select  id="categoria" name="categoria" onchange="load(this.value)">
  <option>
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  </option>
  <?php
  conectar();
  $q=mysql_query("select Categoria from TManteleria group by Categoria ");
  while($m=mysql_fetch_array($q)){
	echo "<option  value='".$m['Categoria']."'>".$m['Categoria']."</option>";
  }
  ?>
  </select></td></tr>
  <tr><td><label>TIPO</label></td><td><div id="2"></div></td></tr>
  <tr><td><label>DESCRIPCION</label></td><td><div id="3"></div></td></tr>
  <tr><td><label>COSTO</label></td><td><input type="number" name="costo" min="0" onchange="c(this.value)" required></td></tr>
  <tr><td><label>COSTO PROMEDIO</label></td><td><div id="cost"> </div></td></tr>
  <tr><td><label>PRECIO</label></td><td><input type="number" name="precio" min="0" required></div></td></tr>
  <input type="hidden" name="usuario" value="<?php echo $usuario;?>">
  </table><br><br>
  <input type="submit" value="Comprar">
  </form>
       
		</div>
	<?php pie();?>
</body>
</html>
