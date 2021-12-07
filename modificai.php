<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
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
conectar();
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;


$q="Select * from TManteleria where id=".$_GET['numero'];
$co=mysql_query($q) or die(mysql_error());
		while($de=mysql_fetch_array($co))
		{
			$nom=$de['producto'];
			$des=$de['descripcion'];
			$tipo=$de['tipo'];
			$be=$de['buenestado'];
			$me=$de['malestado'];
			$tot=$de['total'];
			$com=$de['comentarios'];
		}


?>


<!--ESTILO CUERPO-->


<div align="center">		

	<br /><br /><br  style="background-position:center"/>
	
    <p><b><h2 style="color:#FC0316">MODIFICAR INVENTARIO</h2></b></p><br /><br />
	<div class="wrapper wrapper-style4">		

    <form method="post" action="cargarmodificai.php">
   <table border="6px" bordercolor="#990000" align="center">
  <tr> <td>Nomenclatura</td><td align="center"><input name="nomenclatura" value="<?php echo $nom;?>"/></td></tr>
<tr> <td>Descripcion</td><td align="center"><input name="descripcion" value="<?php echo $des;?>"/></td></tr>
<tr> <td>Buen Estado</td><td align="center"><input name="buenestado" value="<?php echo $be;?>"/></td></tr>
<tr> <td>Mal Estado</td><td align="center"><input name="malestado" value="<?php echo $me;?>"/></td></tr>
<tr> <td>Comentarios</td><td align="center"><input name="comentarios" value="<?php echo $com;?>"/></td></tr>


   </table>
    	<br />    <br />
        <input type="hidden" name="tipo" value="Modificar"/>
    	<input type="submit" style="border-color:#000" style="background:#0F0x" value="MODIFICAR" style="color:#900"  border="3px" />
        <input type="hidden" name="numero" value="<?php echo $_GET['numero'];?>"/>
        

    </form>
</div>
</div>
</body>
</body>

</html>
	