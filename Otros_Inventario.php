<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require 'funciones2.php';
conectar();
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
				.button 
						{
							   border-top: 1px solid #8f0d0d;
							   background: #9c132a;
							   background: -webkit-gradient(linear, left top, left bottom, from(#a12a2e), to(#9c132a));
							   background: -webkit-linear-gradient(top, #a12a2e, #9c132a);
							   background: -moz-linear-gradient(top, #a12a2e, #9c132a);
							   background: -ms-linear-gradient(top, #a12a2e, #9c132a);
							   background: -o-linear-gradient(top, #a12a2e, #9c132a);
							   padding: 8px 16px;
							   -webkit-border-radius: 10px;
							   -moz-border-radius: 10px;
							   border-radius: 10px;
							   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
							   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
							   box-shadow: rgba(0,0,0,1) 0 1px 0;
							   text-shadow: rgba(0,0,0,.4) 0 1px 0;
							   color: #ffffff;
							   font-size: 14px;
							   font-family: 'Lucida Grande', Helvetica, Arial, Sans-Serif;
							   text-decoration: none;
							   vertical-align: middle;
							   }
							.button:hover {
							   border-top-color: #b02128;
							   background: #b02128;
							   color: #ffffff;
							   }
							.button:active {
							   border-top-color: #0f2d40;
							   background: #0f2d40;
			   }
			   
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
shortcut.add("Ctrl+Alt+S",function() {
document.getElementById('no_facturados').style.display='none';
});

shortcut.add("Ctrl+Alt+N",function() {
document.getElementById('no_facturados').style.display='block';
});
</script>

<!--ESTILO CUERPO-->

<div align="center">
	<br /><br /><br  style="background-position:center"/>
    <br /><br />
    <p><b><h2 style="color:#FC0316">OTROS INVENTARIOS</h2></b></p>
    
<div class="wrapper wrapper-style4">		

<br /><br />
<form action="insert_manteleria.php" method="POST">
<input type='submit' value='Agregar Elemento al Inventario' name='agregar' class='button' hspace='45'></form>				
				
        <table border='6' bordercolor='#990000' style="background-color:#FFF">
								<tr>
									<td align='center'><b> NOMENCLATURA </b></td>
									<td align='center'><b> DESCRIPCION </b></td>
									<td align='center'><b> TIPO </b></td>
									<td align='center'><b> BUEN ESTADO </b></td>
									<td align='center'><b> MAL ESTADO </b></td>
									<td align='center'><b> TOTAL </b></td>
									<td align='center'><b> COMENTARIOS </b></td>
                                    <td align='center'><b> MODIFICAR </b></td>
                                    <td align='center'><b> ELIMINAR </b></td>
								</tr>
			<?php

print_r($_GET);
						$selecM="SELECT tipo FROM  `TManteleria`  GROUP BY tipo";
					$M=mysql_query($selecM) or die( mysql_error());
					$var=0;
					
								echo "<tr>
								<td colspan='12' align='center' bgcolor='#FF0000'><a style='color:#FAF102'><b>".$Mm['tipo']."</b></a></td></tr>
								";
							
						echo $r="SELECT * FROM `TManteleria` where tipo='".$_GET['numero']."'";
						$Mt=mysql_query($r) or die( mysql_error());
						while($que=mysql_fetch_array($Mt))
						{
							
								echo "<tr>
									<td align='center'><b>".$que['producto']."</b></td>
									<td align='center'><b> ".$que['descripcion']." </b></td>
									<td align='center'><b>".$que['tipo']."</b></td>
									<td align='center'><b>".$que['buenestado']." </b></td>
									<td align='center'><b>".$que['malestado']." </b></td>
									<td align='center'><b> ".$que['total']." </b></td>
									<td align='center'><b> ".$que['comentarios']." </b></td>
									<td><a href=modificai.php?numero=".$que['id'].">Modificar</a></td>
									<td><a href=cargarmodificai.php?numero=".$que['id']."&Eliminar='Eliminar'>Eliminar</a></td>
						
									</tr>
							";
						
						  }
						
						 
						echo "
							</table>";
						
					
					
					
					
					
					
				pie();
			?>
			<div id="no_facturados" style="display:none;">
			<?php 
			qwerty2();
			?>
			</div>
</body>
</html>