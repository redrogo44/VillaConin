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
<head>
<script type="text/javascript" src="js/shortcut.js"></script>
</head>

<body background="../Imagenes/Villa Conin.png" style="background-repeat:no-repeat"  bgcolor="#fff">
<?php
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;
?>
<script>
<?php
conectar();
 $c2=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='mostrar facturados' and tipo='clave'"));
  $c3=mysql_fetch_array(mysql_query("select * from Configuraciones where nombre='ocultar factutados' and tipo='clave'"));
?>
shortcut.add("Ctrl+Alt+<?php echo $c3['descripcion'];?>",function() {
document.getElementById('no_facturados').style.display='none';
});

shortcut.add("Ctrl+Alt+<?php echo $c2['descripcion'];?>",function() {
document.getElementById('no_facturados').style.display='block';
});
</script>

<!--ESTILO CUERPO-->


<div align="center">
	<br /><br /><br  style="background-position:center"/>
	<p><b><h2>Selecciona un vendedor para refianr busquedas</h2></b></p>
	<br>
<div class="wrapper wrapper-style4">		
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  
			<select name="categoria" size="1" id="categoria">
				<?php
                    $v="Select usuario from usuarios Where nivel=4";
                    $Vende=mysql_query($v);
                    while($Vendedor=mysql_fetch_array($Vende))
                    {
                        $VENDEDOR=explode(" ",$Vendedor['usuario']);
                        echo "<option value='".$VENDEDOR[1]."'>".$VENDEDOR[1]."</option>";					
                    }
                
                ?>
			</select>
           <br><br>
			<input type="submit" name="submit" value="Buscar">
		</form>
		</div>
		<div class="wrapper">
			<?php
					if(isset($_POST['submit']))
					 {
					conectar();
					
						reporconv();
						
				    }
					pie();
			?>
		<div id="no_facturados" style="display:none;">
			<?php 
			qwerty3();
			
			?>
			</div>

</body>
</html>
