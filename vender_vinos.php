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
    <p><b><h2 style="color:#FC0316">INVENTARIOS</h2></b></p>

		<div class="wrapper">
		<?php
		conectar();
		$numero=explode(',',$_GET['vinos']);
		$result = count($numero);
		$txt="select * from TInventarios where ";
		for($z=0;$z<$result;$z++){
			if($numero[$z]!="" && $numero[$z+1]!=""){
			$txt=$txt." id=".$numero[$z]." OR";
			}
			if($numero[$z]!="" && $numero[$z+1]==""){
			$txt=$txt." id=".$numero[$z];
			}
		}
		
		$exe=mysql_query($txt);
		echo '<form action="rvv.php" method="POST"><table border="1">';
		echo '<tr><td><b>PRODUCTO</b></td><td><b>DESCRIPCION</b></td><td><b>CANTIDAD</b></td></tr>';
		while($show=mysql_fetch_array($exe)){
		echo '<tr><td><b>'.$show['producto'].'</b></td><td><b>'.$show['descripcion'].'</b></td><td><b><input type="number" min="0" max="'.$show['cantidad'].'" name="'.$show['id'].'"></b></td></tr>';
		}
		echo "<tr><td colspan='3' align='center'><input type='submit' value='Regitrar Venta'></td><tr>";
		echo "</form></table>";
		?>
		</div>
</div>	

</body>
</html>
