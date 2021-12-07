<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
require 'configuraciones.php';
conectar();
validarsesion();
menuconfiguracion();
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

<script>

function activar(formulario){
 if(document.newcontrato.tipo.value != "Seleccione una opcion") 
document.newcontrato.buto.disabled = false 
else 
document.newcontrato.buto.disabled = true 
}
</script>

<?php
conectar();
$usuario=$_SESSION['usu'];
echo      "&nbsp&nbsp&nbsp usuario:  ".$usuario;


$q="Select * from Meseros where id=".$_GET['numero'];
$co=mysql_query($q) or die(mysql_error());
		while($de=mysql_fetch_array($co))
		{
			$nombre=$de['nombre'];
			$ap=$de['ap'];
			$am=$de['am'];
			$tipo=$de['tipo'];
			$nivel=$de['nivel'];
			$coins=$de['coins'];
	
		}


?>


<!--ESTILO CUERPO-->


<div align="center">		

	<br /><br /><br  style="background-position:center"/>
	
    <p><b><h2 style="color:#FC0316"><?PHP echo "MODIFICAR DATOS DE ".$_GET['nombre'];?></h2></b></p><br /><br />
	<div class="wrapper wrapper-style4">		

    <form method="post" action="cargarmodificai.php">
   <table border="6px" bordercolor="#990000" align="center">
  <tr> <td>Nombre</td><td align="center"><input name="nomenclatura" value="<?php echo $nombre;?>"/></td></tr>
<tr> <td>Apellido Paterno</td><td align="center"><input name="descripcion" value="<?php echo $ap;?>"/></td></tr>
<tr> <td>Apellido Materno</td><td align="center"><input name="buenestado" value="<?php echo $am;?>"/></td></tr>
<tr> <td>Tipo</td>
			<td align="center">
			<select name='categoria' size='1' id='categoria' onchange="activar(this.form)>
			<option>Seleccione Una Opcion</option>
			<option>MESERO ESTRELLA</option>
			<option>MESEROS 1</option>
			<option>MESEROS 2</option>
			<option>GARROTEROS</option>
			<option>CAPITANES</option>
			<option>HOSTESS</option>
			<option>BARISTA</option>
			<option>COCINA O BAÑOS</option>
			</td></tr>
<tr> <td>Nivel</td><td align="center"><input name="comentarios" value="<?php echo $nivel;?>"/></td></tr>
<tr> <td>Coins</td><td align="center"><input name="comentarios" value="<?php echo $coins;?>"/></td></tr>


   </table>
    	<br />    <br />
        <input type="hidden" name="tipo" value="Modificar"/>
    	<input type="submit" name="buto" style="border-color:#000" style="background:#0F0x" value="MODIFICAR" style="color:#900"  border="3px" />
        <input type="hidden" name="numero" value="<?php echo $_GET['numero'];?>"/>
        

    </form>
</div>
</div>
</body>
</body>
</html>


	